<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\Store;
use App\Models\Campaign;
use App\Models\Service;
use App\Models\Slide;
use App\Models\Page;

class FrontendController extends Controller
{
    public function home()
    {
        $page = Page::where('slug', 'home')->first();
        $slides = Slide::where('is_active', true)->orderBy('id', 'asc')->get();
        $stores = Store::all();
        $recipes = Recipe::orderByRaw('is_featured DESC, created_at DESC')->take(6)->get();
        $campaigns = Campaign::where('is_active', true)->latest()->take(3)->get();
        $services = Service::latest()->take(3)->get();

        return view('welcome', compact('stores', 'recipes', 'campaigns', 'services', 'slides', 'page'));
    }

    public function about()
    {
        $page = Page::where('slug', 'about')->first();
        return view('frontend.about.index', compact('page'));
    }

    public function sustainability()
    {
        $page = Page::where('slug', 'sustainability')->first();
        return view('frontend.sustainability', compact('page'));
    }

    public function socialResponsibility()
    {
        $page = Page::where('slug', 'social_responsibility')->first();
        return view('frontend.social_responsibility', compact('page'));
    }

    public function careers()
    {
        $page = Page::where('slug', 'careers')->first();
        return view('frontend.careers', compact('page'));
    }

    public function candidaturaForm()
    {
        return view('frontend.candidatura');
    }

    public function recipes()
    {
        $page = Page::where('slug', 'recipes')->first();
        $recipes = Recipe::latest()->paginate(12);
        return view('frontend.recipes.index', compact('recipes', 'page'));
    }

    public function recipeShow(Recipe $recipe)
    {
        return view('frontend.recipes.show', compact('recipe'));
    }

    public function stores()
    {
        $page = Page::where('slug', 'stores')->first();
        $stores = Store::all();
        return view('frontend.stores.index', compact('stores', 'page'));
    }

    public function storeShow(Store $store)
    {
        return view('frontend.stores.show', compact('store'));
    }

    public function services()
    {
        $page = Page::where('slug', 'services')->first();
        $services = Service::all();
        return view('frontend.services.index', compact('services', 'page'));
    }

    public function serviceShow(Service $service)
    {
        return view('frontend.services.show', compact('service'));
    }

    public function products()
    {
        $page = Page::where('slug', 'products')->first();
        $products = \App\Models\Product::all();
        return view('frontend.products.index', compact('products', 'page'));
    }

    public function productShow(\App\Models\Product $product)
    {
        return view('frontend.products.show', compact('product'));
    }

    public function campaigns()
    {
        $page = Page::where('slug', 'campaigns')->first();
        $campaigns = Campaign::where('is_active', true)->latest()->paginate(10);
        $leaflets = \App\Models\Leaflet::where('is_active', true)
            ->whereDate('start_date', '<=', now())
            ->whereDate('end_date', '>=', now())
            ->latest()
            ->get();
        return view('frontend.campaigns.index', compact('campaigns', 'leaflets', 'page'));
    }

    public function campaignShow(Campaign $campaign)
    {
        return view('frontend.campaigns.show', compact('campaign'));
    }

    public function posts()
    {
        $page = Page::where('slug', 'posts')->first();
        $posts = \App\Models\BlogPost::where('is_active', true)->latest()->paginate(9);
        return view('frontend.posts.index', compact('posts', 'page'));
    }

    public function postShow($slug)
    {
        $post = \App\Models\BlogPost::where('slug', $slug)->where('is_active', true)->firstOrFail();
        $recentPosts = \App\Models\BlogPost::where('id', '!=', $post->id)->where('is_active', true)->latest()->take(3)->get();
        return view('frontend.posts.show', compact('post', 'recentPosts'));
    }

    public function contacts()
    {
        $page = Page::where('slug', 'contacts')->first();
        return view('frontend.contacts.index', compact('page'));
    }

    public function contactSubmit(Request $request)
    {
        // 1. Anti-bot: Honeypots
        if ($request->filled('website_url') || $request->filled('honeypot_field')) {
            return redirect()->route('contacts.index')->with('success', 'A sua mensagem foi enviada com sucesso! Entraremos em contacto brevemente.');
        }

        // 2. Anti-bot: Fast submission check
        $submissionTime = $request->input('submission_time');
        if (!$submissionTime || (time() - $submissionTime) < 3) {
            return redirect()->route('contacts.index')->with('error', 'Detectamos uma atividade incomum de envio rápido. Por favor, aguarde uns segundos e tente novamente.');
        }

        // 3. Validation
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        \App\Models\ContactMessage::create($validated);

        return redirect()->route('contacts.index')->with('success', 'A sua mensagem foi enviada com sucesso! A equipa Fresmart entrará em contacto muito em breve.');
    }
}
