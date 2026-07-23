<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    public function index()
    {
        $recipes = Recipe::orderBy('created_at', 'desc')->get();
        return view('admin.recipes.index', compact('recipes'));
    }

    public function create()
    {
        return view('admin.recipes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'prep_time_minutes' => 'required|integer',
            'portions' => 'required|integer',
            'category' => 'required|string',
            'ingredients' => 'nullable|string',
            'instructions' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'is_featured' => 'boolean'
        ]);

        $validated['is_featured'] = $request->has('is_featured');
        if ($validated['is_featured']) {
            Recipe::query()->update(['is_featured' => false]);
        }

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/recipes'), $filename);
            $validated['image'] = 'uploads/recipes/' . $filename;
        }

        Recipe::create($validated);
        return redirect()->route('admin.recipes.index')->with('success', 'Receita criada com sucesso.');
    }

    public function show(string $id)
    {
    }

    public function edit(string $id)
    {
        $recipe = Recipe::findOrFail($id);
        return view('admin.recipes.edit', compact('recipe'));
    }

    public function update(Request $request, string $id)
    {
        $recipe = Recipe::findOrFail($id);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:recipes,slug,' . $recipe->id,
            'prep_time_minutes' => 'required|integer',
            'portions' => 'required|integer',
            'category' => 'required|string',
            'ingredients' => 'nullable|string',
            'instructions' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'is_featured' => 'boolean'
        ]);

        $validated['is_featured'] = $request->has('is_featured');
        if ($validated['is_featured']) {
            Recipe::query()->where('id', '!=', $recipe->id)->update(['is_featured' => false]);
        }

        if ($request->hasFile('image')) {
            if ($recipe->image) {
                $oldPath = public_path($recipe->image);
                if (file_exists($oldPath)) {
                    @unlink($oldPath);
                } else {
                    $legacyPath = public_path('storage/' . $recipe->image);
                    if (file_exists($legacyPath)) {
                        @unlink($legacyPath);
                    }
                }
            }
            $file = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/recipes'), $filename);
            $validated['image'] = 'uploads/recipes/' . $filename;
        }

        $recipe->update($validated);
        return redirect()->route('admin.recipes.index')->with('success', 'Receita atualizada com sucesso.');
    }

    public function destroy(string $id)
    {
        $recipe = Recipe::findOrFail($id);
        if ($recipe->image) {
            $oldPath = public_path($recipe->image);
            if (file_exists($oldPath)) {
                @unlink($oldPath);
            } else {
                $legacyPath = public_path('storage/' . $recipe->image);
                if (file_exists($legacyPath)) {
                    @unlink($legacyPath);
                }
            }
        }
        $recipe->delete();
        return redirect()->route('admin.recipes.index')->with('success', 'Receita apagada.');
    }
}
