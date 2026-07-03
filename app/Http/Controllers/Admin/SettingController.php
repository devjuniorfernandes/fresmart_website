<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function edit()
    {
        $setting = Setting::first() ?? new Setting();
        return view('admin.settings.edit', compact('setting'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'facebook' => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
            'tiktok' => 'nullable|url|max:255',
            'linkedin' => 'nullable|url|max:255',
            'youtube' => 'nullable|url|max:255',
            'app_store' => 'nullable|url|max:255',
            'google_play' => 'nullable|url|max:255',
            'description' => 'nullable|string',
            'logo' => 'nullable|image|max:2048',
            'contact_email' => 'nullable|email|max:255',
            'contact_phone' => 'nullable|string|max:255',
            'contact_address' => 'nullable|string|max:255',

            // Banner fields validation
            'banner_products_image' => 'nullable|image|max:3072',
            'banner_products_title' => 'nullable|string|max:255',
            'banner_products_subtitle' => 'nullable|string|max:255',
            
            'banner_services_image' => 'nullable|image|max:3072',
            'banner_services_title' => 'nullable|string|max:255',
            'banner_services_subtitle' => 'nullable|string|max:255',
            
            'banner_campaigns_image' => 'nullable|image|max:3072',
            'banner_campaigns_title' => 'nullable|string|max:255',
            'banner_campaigns_subtitle' => 'nullable|string|max:255',
            
            'banner_stores_image' => 'nullable|image|max:3072',
            'banner_stores_title' => 'nullable|string|max:255',
            'banner_stores_subtitle' => 'nullable|string|max:255',
            
            'banner_contacts_image' => 'nullable|image|max:3072',
            'banner_contacts_title' => 'nullable|string|max:255',
            'banner_contacts_subtitle' => 'nullable|string|max:255',
            
            'banner_recipes_image' => 'nullable|image|max:3072',
            'banner_recipes_title' => 'nullable|string|max:255',
            'banner_recipes_subtitle' => 'nullable|string|max:255',
        ]);

        $setting = Setting::first() ?? new Setting();

        if ($request->hasFile('logo')) {
            if ($setting->logo) {
                $oldPath = public_path($setting->logo);
                if (file_exists($oldPath)) {
                    @unlink($oldPath);
                }
            }
            $file = $request->file('logo');
            $filename = 'logo_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);
            $validated['logo'] = 'uploads/' . $filename;
        }

        // Generic banner uploads
        $banners = ['products', 'services', 'campaigns', 'stores', 'contacts', 'recipes'];
        foreach ($banners as $b) {
            $fieldName = "banner_{$b}_image";
            if ($request->hasFile($fieldName)) {
                if ($setting->$fieldName) {
                    $oldPath = public_path($setting->$fieldName);
                    if (file_exists($oldPath)) {
                        @unlink($oldPath);
                    }
                }
                $file = $request->file($fieldName);
                $filename = "banner_{$b}_" . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/banners'), $filename);
                $validated[$fieldName] = 'uploads/banners/' . $filename;
            }
        }

        if ($setting->exists) {
            $setting->update($validated);
        } else {
            Setting::create($validated);
        }

        return redirect()->route('admin.settings.edit')->with('success', 'Configurações atualizadas com sucesso.');
    }
}
