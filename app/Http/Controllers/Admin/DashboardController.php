<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Store;
use App\Models\Service;
use App\Models\Product;
use App\Models\Recipe;
use App\Models\ContactMessage;
use App\Models\Visit;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Stats Counters
        $visitsCount = Visit::count();
        $campaignsCount = Campaign::count();
        $storesCount = Store::count();
        $servicesCount = Service::count();
        $productsCount = Product::count();
        $recipesCount = Recipe::count();
        $unreadMessagesCount = ContactMessage::where('is_read', false)->count();

        // 2. Latest Messages
        $latestMessages = ContactMessage::latest()->take(5)->get();

        // 3. Visits Line Chart (last 30 days)
        $chartData = [];
        $chartLabels = [];
        
        for ($i = 29; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $dateString = $date->toDateString();
            $label = $date->format('d/m');
            
            $count = Visit::where('visited_date', $dateString)->count();
            
            $chartLabels[] = $label;
            $chartData[] = $count;
        }

        // 4. Content Proportion Chart (Lojas, Campanhas, Serviços, Receitas, Produtos)
        $proportionLabels = ['Lojas', 'Campanhas', 'Serviços', 'Receitas', 'Produtos'];
        $proportionData = [$storesCount, $campaignsCount, $servicesCount, $recipesCount, $productsCount];

        return view('dashboard', compact(
            'visitsCount',
            'campaignsCount',
            'storesCount',
            'servicesCount',
            'productsCount',
            'recipesCount',
            'unreadMessagesCount',
            'latestMessages',
            'chartLabels',
            'chartData',
            'proportionLabels',
            'proportionData'
        ));
    }
}
