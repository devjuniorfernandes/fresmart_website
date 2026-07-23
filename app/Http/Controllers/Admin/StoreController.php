<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stores = Store::orderBy('created_at', 'desc')->get();
        return view('admin.stores.index', compact('stores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.stores.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:stores,slug',
            'city' => 'required|string|max:255',
            'bairro' => 'required|string|max:255',
            'address' => 'required|string',
            'lat' => 'nullable|numeric',
            'lng' => 'nullable|numeric',
            'opening_time' => 'nullable|string',
            'closing_time' => 'nullable|string',
            'phone' => 'nullable|string|max:255',
            'whatsapp' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'status' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'services' => 'nullable|array'
        ]);

        $validated['services_json'] = $request->input('services', []);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/stores'), $filename);
            $validated['image'] = 'uploads/stores/' . $filename;
        }

        Store::create($validated);

        return redirect()->route('admin.stores.index')->with('success', 'Loja criada com sucesso.');
    }

    public function show(string $id)
    {
    }

    public function edit(string $id)
    {
        $store = Store::findOrFail($id);
        return view('admin.stores.edit', compact('store'));
    }

    public function update(Request $request, string $id)
    {
        $store = Store::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:stores,slug,' . $store->id,
            'city' => 'required|string|max:255',
            'bairro' => 'required|string|max:255',
            'address' => 'required|string',
            'lat' => 'nullable|numeric',
            'lng' => 'nullable|numeric',
            'opening_time' => 'nullable|string',
            'closing_time' => 'nullable|string',
            'phone' => 'nullable|string|max:255',
            'whatsapp' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'status' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'services' => 'nullable|array'
        ]);

        $validated['services_json'] = $request->input('services', []);

        if ($request->hasFile('image')) {
            if ($store->image) {
                $oldPath = public_path($store->image);
                if (file_exists($oldPath)) {
                    @unlink($oldPath);
                } else {
                    $legacyPath = public_path('storage/' . $store->image);
                    if (file_exists($legacyPath)) {
                        @unlink($legacyPath);
                    }
                }
            }
            $file = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/stores'), $filename);
            $validated['image'] = 'uploads/stores/' . $filename;
        }

        $store->update($validated);
        return redirect()->route('admin.stores.index')->with('success', 'Loja atualizada.');
    }

    public function destroy(string $id)
    {
        $store = Store::findOrFail($id);
        if ($store->image) {
            $oldPath = public_path($store->image);
            if (file_exists($oldPath)) {
                @unlink($oldPath);
            } else {
                $legacyPath = public_path('storage/' . $store->image);
                if (file_exists($legacyPath)) {
                    @unlink($legacyPath);
                }
            }
        }
        $store->delete();
        return redirect()->route('admin.stores.index')->with('success', 'Loja apagada.');
    }
}
