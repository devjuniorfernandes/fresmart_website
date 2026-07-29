<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogPostController extends Controller
{
    public function index()
    {
        $posts = BlogPost::orderBy('id', 'desc')->paginate(15);
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:blog_posts,slug',
            'content' => 'required|string',
            'excerpt' => 'nullable|string',
            'image' => 'nullable|file|mimes:jpeg,png,jpg,webp,svg,gif|max:10240',
            'gallery' => 'nullable|array',
            'gallery.*' => 'file|mimes:jpeg,png,jpg,webp,svg,gif|max:10240',
            'is_active' => 'boolean',
            'published_at' => 'nullable|date',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        // Upload main thumbnail image
        if ($request->hasFile('image')) {
            $uploadDir = public_path('uploads/posts');
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            $file = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($uploadDir, $filename);
            $validated['image'] = 'uploads/posts/' . $filename;
        }

        // Upload gallery images
        $galleryPaths = [];
        if ($request->hasFile('gallery')) {
            $galleryDir = public_path('uploads/posts/gallery');
            if (!file_exists($galleryDir)) {
                mkdir($galleryDir, 0755, true);
            }
            foreach ($request->file('gallery') as $gFile) {
                $gFilename = time() . '_' . uniqid() . '.' . $gFile->getClientOriginalExtension();
                $gFile->move($galleryDir, $gFilename);
                $galleryPaths[] = 'uploads/posts/gallery/' . $gFilename;
            }
        }
        $validated['gallery'] = $galleryPaths;

        $validated['is_active'] = $request->has('is_active');
        if ($validated['is_active'] && empty($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        BlogPost::create($validated);

        return redirect()->route('admin.posts.index')->with('success', 'Notícia criada com sucesso.');
    }

    public function edit(BlogPost $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    public function update(Request $request, BlogPost $post)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:blog_posts,slug,' . $post->id,
            'content' => 'required|string',
            'excerpt' => 'nullable|string',
            'image' => 'nullable|file|mimes:jpeg,png,jpg,webp,svg,gif|max:10240',
            'gallery' => 'nullable|array',
            'gallery.*' => 'file|mimes:jpeg,png,jpg,webp,svg,gif|max:10240',
            'remove_gallery_images' => 'nullable|array',
            'is_active' => 'boolean',
            'published_at' => 'nullable|date',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        // Main cover image upload
        if ($request->hasFile('image')) {
            if ($post->image) {
                $oldPath = public_path($post->image);
                if (file_exists($oldPath)) {
                    @unlink($oldPath);
                }
            }
            $uploadDir = public_path('uploads/posts');
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            $file = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($uploadDir, $filename);
            $validated['image'] = 'uploads/posts/' . $filename;
        }

        // Handle gallery updates
        $currentGallery = is_array($post->gallery) ? $post->gallery : [];

        // Remove selected gallery images
        if ($request->has('remove_gallery_images')) {
            $toRemove = $request->input('remove_gallery_images');
            foreach ($toRemove as $imgPath) {
                $fullPath = public_path($imgPath);
                if (file_exists($fullPath)) {
                    @unlink($fullPath);
                }
                $currentGallery = array_values(array_filter($currentGallery, fn($item) => $item !== $imgPath));
            }
        }

        // Upload new gallery files
        if ($request->hasFile('gallery')) {
            $galleryDir = public_path('uploads/posts/gallery');
            if (!file_exists($galleryDir)) {
                mkdir($galleryDir, 0755, true);
            }
            foreach ($request->file('gallery') as $gFile) {
                $gFilename = time() . '_' . uniqid() . '.' . $gFile->getClientOriginalExtension();
                $gFile->move($galleryDir, $gFilename);
                $currentGallery[] = 'uploads/posts/gallery/' . $gFilename;
            }
        }

        $validated['gallery'] = $currentGallery;
        $validated['is_active'] = $request->has('is_active');

        $post->update($validated);

        return redirect()->route('admin.posts.index')->with('success', 'Notícia atualizada com sucesso.');
    }

    public function destroy(BlogPost $post)
    {
        if ($post->image) {
            $oldPath = public_path($post->image);
            if (file_exists($oldPath)) {
                @unlink($oldPath);
            }
        }
        if (is_array($post->gallery)) {
            foreach ($post->gallery as $imgPath) {
                $fullPath = public_path($imgPath);
                if (file_exists($fullPath)) {
                    @unlink($fullPath);
                }
            }
        }
        $post->delete();

        return redirect()->route('admin.posts.index')->with('success', 'Notícia removida com sucesso.');
    }
}
