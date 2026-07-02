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
        ]);

        $setting = Setting::first();
        if ($setting) {
            $setting->update($validated);
        } else {
            Setting::create($validated);
        }

        return redirect()->route('admin.settings.edit')->with('success', 'Configurações atualizadas com sucesso.');
    }
}
