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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5000',
            'is_active' => 'boolean',
            'published_at' => 'nullable|date',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/posts'), $filename);
            $validated['image'] = 'uploads/posts/' . $filename;
        }

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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5000',
            'is_active' => 'boolean',
            'published_at' => 'nullable|date',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        if ($request->hasFile('image')) {
            if ($post->image) {
                $oldPath = public_path($post->image);
                if (file_exists($oldPath)) {
                    @unlink($oldPath);
                }
            }
            $file = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/posts'), $filename);
            $validated['image'] = 'uploads/posts/' . $filename;
        }

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
        $post->delete();

        return redirect()->route('admin.posts.index')->with('success', 'Notícia removida com sucesso.');
    }
}
