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
        $recipes = Recipe::latest()->take(6)->get();
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
        return view('frontend.campaigns.index', compact('campaigns'));
    }

    public function campaignShow(Campaign $campaign)
    {
        return view('frontend.campaigns.show', compact('campaign'));
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
}
