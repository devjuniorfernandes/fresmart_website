<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;

Route::get('/', [FrontendController::class, 'home'])->name('home');

Route::get('/locale/{lang}', function ($lang) {
    if (in_array($lang, ['pt', 'en'])) {
        session(['locale' => $lang]);
    }
    return redirect()->back();
})->name('locale.set');

Route::get('/quem-somos', [FrontendController::class, 'about'])->name('about.index');

Route::get('/receitas', [FrontendController::class, 'recipes'])->name('recipes.index');
Route::get('/receitas/{recipe}', [FrontendController::class, 'recipeShow'])->name('recipes.show');

Route::get('/lojas', [FrontendController::class, 'stores'])->name('stores.index');
Route::get('/lojas/{store}', [FrontendController::class, 'storeShow'])->name('stores.show');

Route::get('/produtos', [FrontendController::class, 'products'])->name('products.index');
Route::get('/produtos/{product}', [FrontendController::class, 'productShow'])->name('products.show');

Route::get('/servicos', [FrontendController::class, 'services'])->name('services.index');
Route::get('/servicos/{service}', [FrontendController::class, 'serviceShow'])->name('services.show');

Route::get('/ofertas', [FrontendController::class, 'campaigns'])->name('campaigns.index');
Route::get('/ofertas/{campaign}', [FrontendController::class, 'campaignShow'])->name('campaigns.show');

Route::get('/noticias', [FrontendController::class, 'posts'])->name('posts.index');
Route::get('/noticias/{post}', [FrontendController::class, 'postShow'])->name('posts.show');

Route::get('/contactos', [FrontendController::class, 'contacts'])->name('contacts.index');
Route::post('/contactos', [FrontendController::class, 'contactSubmit'])
    ->middleware('throttle:3,1')
    ->name('contacts.submit');

Route::post('/candidatura', [FrontendController::class, 'submitApplication'])
    ->middleware('throttle:5,1')
    ->name('candidatura.submit');

Route::get('/pesquisa', [FrontendController::class, 'search'])->name('search');

Route::get('/sitemap.xml', [FrontendController::class, 'sitemapXml'])->name('sitemap.xml');
Route::get('/mapa-do-site', [FrontendController::class, 'sitemapHtml'])->name('sitemap.html');

Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rotas do CMS (Admin)
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('stores', \App\Http\Controllers\Admin\StoreController::class);
        Route::resource('recipes', \App\Http\Controllers\Admin\RecipeController::class);
        Route::resource('campaigns', \App\Http\Controllers\Admin\CampaignController::class);
        Route::resource('slides', \App\Http\Controllers\Admin\SlideController::class);
        Route::resource('services', \App\Http\Controllers\Admin\ServiceController::class);
        Route::resource('products', \App\Http\Controllers\Admin\ProductController::class);
        Route::resource('contacts', \App\Http\Controllers\Admin\ContactMessageController::class)->only(['index', 'show', 'destroy']);
        Route::resource('posts', \App\Http\Controllers\Admin\BlogPostController::class);
        Route::resource('leaflets', \App\Http\Controllers\Admin\LeafletController::class);
        Route::resource('applications', \App\Http\Controllers\Admin\JobApplicationController::class)->only(['index', 'show', 'destroy']);

        // Configurações Globais
        Route::get('settings', [\App\Http\Controllers\Admin\SettingController::class, 'edit'])->name('settings.edit');
        Route::put('settings', [\App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');
    });
});

require __DIR__.'/auth.php';

/** */