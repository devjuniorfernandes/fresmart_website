<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\Store;
use App\Models\Campaign;
use App\Models\Service;
use App\Models\Slide;

class FrontendController extends Controller
{
    public function home()
    {
        $slides = Slide::where('is_active', true)->orderBy('id', 'asc')->get();
        $stores = Store::all();
        
        $recipes = Recipe::orderByRaw('is_featured DESC, created_at DESC')->take(6)->get();
        
        $campaigns = Campaign::where('is_active', true)->latest()->get();
        $services = Service::latest()->take(3)->get();

        return view('welcome', compact('stores', 'recipes', 'campaigns', 'services', 'slides'));
    }

    public function about()
    {
        return view('frontend.about.index');
    }

    public function recipes()
    {
        $recipes = Recipe::latest()->paginate(12);
        return view('frontend.recipes.index', compact('recipes'));
    }

    public function recipeShow(Recipe $recipe)
    {
        return view('frontend.recipes.show', compact('recipe'));
    }

    public function stores()
    {
        $stores = Store::all();
        return view('frontend.stores.index', compact('stores'));
    }

    public function storeShow(Store $store)
    {
        return view('frontend.stores.show', compact('store'));
    }

    public function services()
    {
        $services = Service::all();
        return view('frontend.services.index', compact('services'));
    }

    public function serviceShow(Service $service)
    {
        return view('frontend.services.show', compact('service'));
    }

    public function products()
    {
        $products = \App\Models\Product::all();
        return view('frontend.products.index', compact('products'));
    }

    public function productShow(\App\Models\Product $product)
    {
        return view('frontend.products.show', compact('product'));
    }

    public function campaigns()
    {
        $campaigns = Campaign::where('is_active', true)->latest()->paginate(10);
        $leaflets = \App\Models\Leaflet::where('is_active', true)
            ->whereDate('start_date', '<=', now())
            ->whereDate('end_date', '>=', now())
            ->latest()
            ->get();
        return view('frontend.campaigns.index', compact('campaigns', 'leaflets'));
    }

    public function campaignShow(Campaign $campaign)
    {
        return view('frontend.campaigns.show', compact('campaign'));
    }

    public function posts()
    {
        $posts = \App\Models\BlogPost::where('is_active', true)->latest()->paginate(9);
        return view('frontend.posts.index', compact('posts'));
    }

    public function postShow($slug)
    {
        $post = \App\Models\BlogPost::where('slug', $slug)->where('is_active', true)->firstOrFail();
        $recentPosts = \App\Models\BlogPost::where('id', '!=', $post->id)->where('is_active', true)->latest()->take(3)->get();
        return view('frontend.posts.show', compact('post', 'recentPosts'));
    }

    public function contacts()
    {
        return view('frontend.contacts.index');
    }

    public function contactSubmit(Request $request)
    {
        // 1. Anti-bot: Honeypots
        if ($request->filled('website_url') || $request->filled('honeypot_field')) {
            // Trick the bot into thinking it succeeded
            return redirect()->route('contacts.index')->with('success', 'A sua mensagem foi enviada com sucesso! Entraremos em contacto brevemente.');
        }

        // 2. Anti-bot: Fast submission check (minimum 3 seconds)
        $submissionTime = $request->input('submission_time');
        if (!$submissionTime || (time() - $submissionTime) < 3) {
            return redirect()->route('contacts.index')->with('error', 'Detectamos uma atividade incomum de envio rápido (possível bot/automação). Por favor, aguarde uns segundos e tente novamente.');
        }

        // 3. Validation
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string'
        ]);

        // 4. Sanitization (strip HTML tags, prevent XSS script executions)
        $validated['name'] = strip_tags($validated['name']);
        $validated['subject'] = strip_tags($validated['subject']);
        $validated['message'] = htmlspecialchars(strip_tags($validated['message']), ENT_QUOTES, 'UTF-8');

        // 5. Store message in Database
        $contact = \App\Models\ContactMessage::create($validated);

        // 6. Safe Email Sending with try-catch fallback
        try {
            if (class_exists('\App\Mail\ContactFormMail')) {
                \Illuminate\Support\Facades\Mail::to('geral@fresmart.ao')->send(new \App\Mail\ContactFormMail($contact));
            }
        } catch (\Exception $e) {
            // Log the error but don't crash the form response
            \Illuminate\Support\Facades\Log::error("Failed sending contact email: " . $e->getMessage());
        }

        return redirect()->route('contacts.index')->with('success', 'A sua mensagem foi enviada com sucesso! Entraremos em contacto brevemente.');
    }

    public function search(Request $request)
    {
        $q = $request->input('q');
        
        if (empty($q)) {
            $recipes = collect();
            $products = collect();
            $stores = collect();
            $posts = collect();
            return view('frontend.search', compact('recipes', 'products', 'stores', 'posts', 'q'));
        }

        $recipes = Recipe::where('title', 'like', "%{$q}%")
            ->orWhere('ingredients', 'like', "%{$q}%")
            ->orWhere('category', 'like', "%{$q}%")
            ->get();

        $products = \App\Models\Product::where('name', 'like', "%{$q}%")
            ->orWhere('description', 'like', "%{$q}%")
            ->get();

        $stores = Store::where('name', 'like', "%{$q}%")
            ->orWhere('address', 'like', "%{$q}%")
            ->orWhere('city', 'like', "%{$q}%")
            ->get();

        $posts = \App\Models\BlogPost::where('is_active', true)
            ->where(function($query) use ($q) {
                $query->where('title', 'like', "%{$q}%")
                      ->orWhere('content', 'like', "%{$q}%");
            })->get();

        return view('frontend.search', compact('recipes', 'products', 'stores', 'posts', 'q'));
    }

    public function submitApplication(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'cv' => 'required|file|mimes:pdf,doc,docx|max:5120',
            'cover_letter' => 'nullable|string',
        ]);

        if ($request->hasFile('cv')) {
            $file = $request->file('cv');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            // Ensure public/uploads/cvs directory exists
            $destinationPath = public_path('uploads/cvs');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            $file->move($destinationPath, $filename);
            $validated['cv_path'] = 'uploads/cvs/' . $filename;
        }

        \App\Models\JobApplication::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Candidatura submetida com sucesso!'
        ]);
    }

    public function sitemapXml()
    {
        $urls = [
            route('home'),
            route('about.index'),
            route('recipes.index'),
            route('stores.index'),
            route('services.index'),
            route('campaigns.index'),
            route('posts.index'),
            route('contacts.index'),
        ];

        foreach (\App\Models\Recipe::all() as $item) {
            $urls[] = route('recipes.show', $item->slug);
        }
        foreach (Store::all() as $item) {
            $urls[] = route('stores.show', $item->slug);
        }
        foreach (Service::all() as $item) {
            $urls[] = route('services.show', $item->slug);
        }
        foreach (Campaign::where('is_active', true)->get() as $item) {
            $urls[] = route('campaigns.show', $item->slug);
        }
        foreach (\App\Models\BlogPost::where('is_active', true)->get() as $item) {
            $urls[] = route('posts.show', $item->slug);
        }

        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
        foreach ($urls as $url) {
            $xml .= '<url>';
            $xml .= '<loc>' . htmlspecialchars($url) . '</loc>';
            $xml .= '<changefreq>weekly</changefreq>';
            $xml .= '<priority>0.8</priority>';
            $xml .= '</url>';
        }
        $xml .= '</urlset>';

        return response($xml, 200, [
            'Content-Type' => 'application/xml'
        ]);
    }

    public function sitemapHtml()
    {
        $recipes = Recipe::latest()->get();
        $stores = Store::all();
        $services = Service::all();
        $campaigns = Campaign::where('is_active', true)->get();
        $posts = \App\Models\BlogPost::where('is_active', true)->get();

        return view('frontend.sitemap', compact('recipes', 'stores', 'services', 'campaigns', 'posts'));
    }
}
