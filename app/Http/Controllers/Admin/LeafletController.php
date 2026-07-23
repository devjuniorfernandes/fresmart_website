<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Leaflet;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LeafletController extends Controller
{
    public function index()
    {
        $leaflets = Leaflet::orderBy('id', 'desc')->get();
        return view('admin.leaflets.index', compact('leaflets'));
    }

    public function create()
    {
        return view('admin.leaflets.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:leaflets,slug',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'pdf_path' => 'nullable|file|mimes:pdf|max:15000',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:5000',
            'is_active' => 'boolean',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        if ($request->hasFile('pdf_path')) {
            $file = $request->file('pdf_path');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/leaflets'), $filename);
            $validated['pdf_path'] = 'uploads/leaflets/' . $filename;
        }

        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $imgFile) {
                $filename = time() . '_' . uniqid() . '.' . $imgFile->getClientOriginalExtension();
                $imgFile->move(public_path('uploads/leaflets/pages'), $filename);
                $imagePaths[] = 'uploads/leaflets/pages/' . $filename;
            }
        }
        $validated['images'] = $imagePaths;
        $validated['is_active'] = $request->has('is_active');

        Leaflet::create($validated);

        return redirect()->route('admin.leaflets.index')->with('success', 'Folheto criado com sucesso.');
    }

    public function edit(Leaflet $leaflet)
    {
        return view('admin.leaflets.edit', compact('leaflet'));
    }

    public function update(Request $request, Leaflet $leaflet)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:leaflets,slug,' . $leaflet->id,
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'pdf_path' => 'nullable|file|mimes:pdf|max:15000',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:5000',
            'is_active' => 'boolean',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        if ($request->hasFile('pdf_path')) {
            if ($leaflet->pdf_path) {
                $oldPath = public_path($leaflet->pdf_path);
                if (file_exists($oldPath)) {
                    @unlink($oldPath);
                }
            }
            $file = $request->file('pdf_path');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/leaflets'), $filename);
            $validated['pdf_path'] = 'uploads/leaflets/' . $filename;
        }

        $currentImages = $leaflet->images ?: [];
        if ($request->has('remove_images')) {
            foreach ($request->input('remove_images') as $imgToRemove) {
                if (($key = array_search($imgToRemove, $currentImages)) !== false) {
                    unset($currentImages[$key]);
                    $filePath = public_path($imgToRemove);
                    if (file_exists($filePath)) {
                        @unlink($filePath);
                    }
                }
            }
            $currentImages = array_values($currentImages);
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $imgFile) {
                $filename = time() . '_' . uniqid() . '.' . $imgFile->getClientOriginalExtension();
                $imgFile->move(public_path('uploads/leaflets/pages'), $filename);
                $currentImages[] = 'uploads/leaflets/pages/' . $filename;
            }
        }

        $validated['images'] = $currentImages;
        $validated['is_active'] = $request->has('is_active');

        $leaflet->update($validated);

        return redirect()->route('admin.leaflets.index')->with('success', 'Folheto atualizado com sucesso.');
    }

    public function destroy(Leaflet $leaflet)
    {
        if ($leaflet->pdf_path) {
            $oldPath = public_path($leaflet->pdf_path);
            if (file_exists($oldPath)) {
                @unlink($oldPath);
            }
        }

        if ($leaflet->images) {
            foreach ($leaflet->images as $img) {
                $filePath = public_path($img);
                if (file_exists($filePath)) {
                    @unlink($filePath);
                }
            }
        }

        $leaflet->delete();

        return redirect()->route('admin.leaflets.index')->with('success', 'Folheto removido com sucesso.');
    }
}
