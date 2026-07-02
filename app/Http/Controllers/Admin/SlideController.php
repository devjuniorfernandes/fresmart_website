<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SlideController extends Controller
{
    public function index()
    {
        $slides = Slide::orderBy("id", "desc")->get();
        return view("admin.slides.index", compact("slides"));
    }

    public function create()
    {
        return view("admin.slides.create");
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "title" => "nullable|string|max:255",
            "subtitle" => "nullable|string|max:255",
            "image" => "required|image|mimes:jpeg,png,jpg,webp|max:5000",
            "link" => "nullable|string",
            "is_active" => "boolean"
        ]);

        if ($request->hasFile("image")) {
            $file = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/slides'), $filename);
            $validated['image'] = 'uploads/slides/' . $filename;
        }
        $validated["is_active"] = $request->has("is_active") ? $request->is_active : true;

        Slide::create($validated);
        return redirect()->route("admin.slides.index")->with("success", "Slide adicionado com sucesso.");
    }

    public function edit(Slide $slide)
    {
        return view("admin.slides.edit", compact("slide"));
    }

    public function update(Request $request, Slide $slide)
    {
        $validated = $request->validate([
            "title" => "nullable|string|max:255",
            "subtitle" => "nullable|string|max:255",
            "image" => "nullable|image|mimes:jpeg,png,jpg,webp|max:5000",
            "link" => "nullable|string",
            "is_active" => "boolean"
        ]);

        if ($request->hasFile("image")) {
            if ($slide->image) {
                $oldPath = public_path($slide->image);
                if (file_exists($oldPath)) {
                    @unlink($oldPath);
                } else {
                    $legacyPath = public_path('storage/' . $slide->image);
                    if (file_exists($legacyPath)) {
                        @unlink($legacyPath);
                    }
                }
            }
            $file = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/slides'), $filename);
            $validated['image'] = 'uploads/slides/' . $filename;
        }

        $slide->update($validated);
        return redirect()->route("admin.slides.index")->with("success", "Slide atualizado com sucesso.");
    }

    public function destroy(Slide $slide)
    {
        if ($slide->image) {
            $oldPath = public_path($slide->image);
            if (file_exists($oldPath)) {
                @unlink($oldPath);
            } else {
                $legacyPath = public_path('storage/' . $slide->image);
                if (file_exists($legacyPath)) {
                    @unlink($legacyPath);
                }
            }
        }
        $slide->delete();
        return redirect()->route("admin.slides.index")->with("success", "Slide removido com sucesso.");
    }
}