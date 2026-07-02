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
            'image' => 'nullable|image|max:2048'
        ]);

        $validated['show_title'] = $request->has('show_title');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/services'), $filename);
            $validated['image'] = 'uploads/services/' . $filename;
        }

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
            'image' => 'nullable|image|max:2048'
        ]);

        $validated['show_title'] = $request->has('show_title');

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

        $service->update($validated);
        return redirect()->route('admin.services.index')->with('success', 'Serviço atualizado com sucesso.');
    }

    public function destroy(string $id)
    {
        $service = Service::findOrFail($id);
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
        $service->delete();
        return redirect()->route('admin.services.index')->with('success', 'Serviço apagado.');
    }
}
