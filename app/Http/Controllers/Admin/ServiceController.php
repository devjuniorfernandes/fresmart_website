<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::orderBy('created_at', 'desc')->get();
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:services,slug',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'gallery' => 'nullable|array',
            'gallery.*' => 'image|max:5000',
            'additional_image' => 'nullable|image|max:2048',
            'btn_text' => 'nullable|string|max:255',
            'btn_link' => 'nullable|string|max:255',
            'pdf_file' => 'nullable|file|mimes:pdf|max:15000'
        ]);

        $validated['show_title'] = $request->has('show_title');

        if ($request->hasFile('pdf_file')) {
            $file = $request->file('pdf_file');
            $filename = 'catalog_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/services'), $filename);
            $validated['btn_link'] = 'uploads/services/' . $filename;
        }

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/services'), $filename);
            $validated['image'] = 'uploads/services/' . $filename;
        }

        if ($request->hasFile('additional_image')) {
            $file = $request->file('additional_image');
            $filename = 'add_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/services'), $filename);
            $validated['additional_image'] = 'uploads/services/' . $filename;
        }

        // Upload Gallery Images
        $galleryPaths = [];
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $file) {
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/services'), $filename);
                $galleryPaths[] = 'uploads/services/' . $filename;
            }
        }
        $validated['gallery'] = count($galleryPaths) > 0 ? json_encode($galleryPaths) : null;

        Service::create($validated);
        return redirect()->route('admin.services.index')->with('success', 'Serviço criado com sucesso.');
    }

    public function show(string $id)
    {
    }

    public function edit(string $id)
    {
        $service = Service::findOrFail($id);
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, string $id)
    {
        $service = Service::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:services,slug,' . $service->id,
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'gallery' => 'nullable|array',
            'gallery.*' => 'image|max:5000',
            'additional_image' => 'nullable|image|max:2048',
            'btn_text' => 'nullable|string|max:255',
            'btn_link' => 'nullable|string|max:255',
            'pdf_file' => 'nullable|file|mimes:pdf|max:15000'
        ]);

        $validated['show_title'] = $request->has('show_title');

        if ($request->hasFile('pdf_file')) {
            if ($service->btn_link && file_exists(public_path($service->btn_link))) {
                @unlink(public_path($service->btn_link));
            }
            $file = $request->file('pdf_file');
            $filename = 'catalog_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/services'), $filename);
            $validated['btn_link'] = 'uploads/services/' . $filename;
        }

        if ($request->hasFile('image')) {
            if ($service->image) {
                $oldPath = public_path($service->image);
                if (file_exists($oldPath)) {
                    @unlink($oldPath);
                } else {
                    $legacyPath = public_path('storage/' . $service->image);
                    if (file_exists($legacyPath)) {
                        @unlink($legacyPath);
                    }
                }
            }
            $file = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/services'), $filename);
            $validated['image'] = 'uploads/services/' . $filename;
        }

        if ($request->hasFile('additional_image')) {
            if ($service->additional_image) {
                $oldPath = public_path($service->additional_image);
                if (file_exists($oldPath)) {
                    @unlink($oldPath);
                }
            }
            $file = $request->file('additional_image');
            $filename = 'add_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/services'), $filename);
            $validated['additional_image'] = 'uploads/services/' . $filename;
        }

        // Manage existing and new gallery images
        $currentGallery = $service->gallery ? json_decode($service->gallery, true) : [];

        // Remove marked images from disk and gallery array
        if ($request->has('remove_images')) {
            foreach ($request->input('remove_images') as $imgToRemove) {
                if (($key = array_search($imgToRemove, $currentGallery)) !== false) {
                    unset($currentGallery[$key]);
                    $filePath = public_path($imgToRemove);
                    if (file_exists($filePath)) {
                        @unlink($filePath);
                    } else {
                        $legacyPath = public_path('storage/' . $imgToRemove);
                        if (file_exists($legacyPath)) {
                            @unlink($legacyPath);
                        }
                    }
                }
            }
            $currentGallery = array_values($currentGallery); // Re-index array
        }

        // Upload and append new gallery images
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $file) {
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/services'), $filename);
                $currentGallery[] = 'uploads/services/' . $filename;
            }
        }

        $validated['gallery'] = count($currentGallery) > 0 ? json_encode($currentGallery) : null;

        $service->update($validated);
        return redirect()->route('admin.services.index')->with('success', 'Serviço updated com sucesso.');
    }

    public function destroy(string $id)
    {
        $service = Service::findOrFail($id);
        
        // Delete main image
        if ($service->image) {
            $oldPath = public_path($service->image);
            if (file_exists($oldPath)) {
                @unlink($oldPath);
            } else {
                $legacyPath = public_path('storage/' . $service->image);
                if (file_exists($legacyPath)) {
                    @unlink($legacyPath);
                }
            }
        }

        // Delete additional image
        if ($service->additional_image) {
            $oldPath = public_path($service->additional_image);
            if (file_exists($oldPath)) {
                @unlink($oldPath);
            }
        }

        // Delete gallery images
        if ($service->gallery) {
            $gallery = json_decode($service->gallery, true);
            if (is_array($gallery)) {
                foreach ($gallery as $img) {
                    $filePath = public_path($img);
                    if (file_exists($filePath)) {
                        @unlink($filePath);
                    } else {
                        $legacyPath = public_path('storage/' . $img);
                        if (file_exists($legacyPath)) {
                            @unlink($legacyPath);
                        }
                    }
                }
            }
        }

        $service->delete();
        return redirect()->route('admin.services.index')->with('success', 'Serviço apagado.');
    }
}
