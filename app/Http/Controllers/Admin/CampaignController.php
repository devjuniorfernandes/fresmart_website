<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    public function index()
    {
        $campaigns = Campaign::orderBy('created_at', 'desc')->get();
        return view('admin.campaigns.index', compact('campaigns'));
    }

    public function create()
    {
        return view('admin.campaigns.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'link' => 'nullable|string',
            'is_active' => 'required|boolean',
            'show_text' => 'nullable|boolean',
            'image' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/campaigns'), $filename);
            $validated['image'] = 'uploads/campaigns/' . $filename;
        }

        $validated['show_text'] = $request->has('show_text');

        Campaign::create($validated);
        return redirect()->route('admin.campaigns.index')->with('success', 'Campanha criada.');
    }

    public function show(string $id)
    {
    }

    public function edit(string $id)
    {
        $campaign = Campaign::findOrFail($id);
        return view('admin.campaigns.edit', compact('campaign'));
    }

    public function update(Request $request, string $id)
    {
        $campaign = Campaign::findOrFail($id);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:campaigns,slug,' . $campaign->id,
            'link' => 'nullable|string',
            'is_active' => 'required|boolean',
            'show_text' => 'nullable|boolean',
            'image' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('image')) {
            if ($campaign->image) {
                $oldPath = public_path($campaign->image);
                if (file_exists($oldPath)) {
                    @unlink($oldPath);
                } else {
                    $legacyPath = public_path('storage/' . $campaign->image);
                    if (file_exists($legacyPath)) {
                        @unlink($legacyPath);
                    }
                }
            }
            $file = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/campaigns'), $filename);
            $validated['image'] = 'uploads/campaigns/' . $filename;
        }

        $validated['show_text'] = $request->has('show_text');

        $campaign->update($validated);
        return redirect()->route('admin.campaigns.index')->with('success', 'Campanha atualizada.');
    }

    public function destroy(string $id)
    {
        $campaign = Campaign::findOrFail($id);
        if ($campaign->image) {
            $oldPath = public_path($campaign->image);
            if (file_exists($oldPath)) {
                @unlink($oldPath);
            } else {
                $legacyPath = public_path('storage/' . $campaign->image);
                if (file_exists($legacyPath)) {
                    @unlink($legacyPath);
                }
            }
        }
        $campaign->delete();
        return redirect()->route('admin.campaigns.index')->with('success', 'Campanha apagada.');
    }
}
