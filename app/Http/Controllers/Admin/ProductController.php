<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:products,slug',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'gallery' => 'nullable|array',
            'gallery.*' => 'image|max:5000'
        ]);

        $validated['show_title'] = $request->has('show_title');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/products'), $filename);
            $validated['image'] = 'uploads/products/' . $filename;
        }

        // Upload Gallery Images
        $galleryPaths = [];
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $file) {
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/products'), $filename);
                $galleryPaths[] = 'uploads/products/' . $filename;
            }
        }
        $validated['gallery'] = count($galleryPaths) > 0 ? json_encode($galleryPaths) : null;

        Product::create($validated);
        return redirect()->route('admin.products.index')->with('success', 'Produto criado com sucesso.');
    }

    public function show(string $id)
    {
    }

    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:products,slug,' . $product->id,
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'gallery' => 'nullable|array',
            'gallery.*' => 'image|max:5000'
        ]);

        $validated['show_title'] = $request->has('show_title');

        if ($request->hasFile('image')) {
            if ($product->image) {
                $oldPath = public_path($product->image);
                if (file_exists($oldPath)) {
                    @unlink($oldPath);
                } else {
                    $legacyPath = public_path('storage/' . $product->image);
                    if (file_exists($legacyPath)) {
                        @unlink($legacyPath);
                    }
                }
            }
            $file = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/products'), $filename);
            $validated['image'] = 'uploads/products/' . $filename;
        }

        // Manage existing and new gallery images
        $currentGallery = $product->gallery ? json_decode($product->gallery, true) : [];

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
                $file->move(public_path('uploads/products'), $filename);
                $currentGallery[] = 'uploads/products/' . $filename;
            }
        }

        $validated['gallery'] = count($currentGallery) > 0 ? json_encode($currentGallery) : null;

        $product->update($validated);
        return redirect()->route('admin.products.index')->with('success', 'Produto atualizado com sucesso.');
    }

    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        
        // Delete main image
        if ($product->image) {
            $oldPath = public_path($product->image);
            if (file_exists($oldPath)) {
                @unlink($oldPath);
            } else {
                $legacyPath = public_path('storage/' . $product->image);
                if (file_exists($legacyPath)) {
                    @unlink($legacyPath);
                }
            }
        }

        // Delete gallery images
        if ($product->gallery) {
            $gallery = json_decode($product->gallery, true);
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

        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Produto apagado.');
    }
}
