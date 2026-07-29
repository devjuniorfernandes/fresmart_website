<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display a listing of managed pages.
     */
    public function index()
    {
        $pages = Page::all();
        return view('admin.pages.index', compact('pages'));
    }

    /**
     * Show the form for editing the specified page.
     */
    public function edit(Page $page)
    {
        return view('admin.pages.edit', compact('page'));
    }

    /**
     * Update the specified page in storage.
     */
    public function update(Request $request, Page $page)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string',
            'content_title' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'extra_content_1' => 'nullable|string',
            'extra_content_2' => 'nullable|string',
            'extra_content_3' => 'nullable|string',
            'extra_content_4' => 'nullable|string',
            'extra_content_5' => 'nullable|string',
            'timeline' => 'nullable|array',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'banner_image' => 'nullable|file|mimes:jpeg,jpg,png,webp,svg,gif|max:10240',
            'section_image_1' => 'nullable|file|mimes:jpeg,jpg,png,webp,svg,gif|max:10240',
            'section_image_2' => 'nullable|file|mimes:jpeg,jpg,png,webp,svg,gif|max:10240',
            'section_image_3' => 'nullable|file|mimes:jpeg,jpg,png,webp,svg,gif|max:10240',
            'section_image_4' => 'nullable|file|mimes:jpeg,jpg,png,webp,svg,gif|max:10240',
            'section_image_5' => 'nullable|file|mimes:jpeg,jpg,png,webp,svg,gif|max:10240',
            'section_image_6' => 'nullable|file|mimes:jpeg,jpg,png,webp,svg,gif|max:10240',
            'section_image_7' => 'nullable|file|mimes:jpeg,jpg,png,webp,svg,gif|max:10240',
        ]);

        // Process timeline data
        if ($request->has('timeline') && is_array($request->input('timeline'))) {
            $filteredTimeline = [];
            foreach ($request->input('timeline') as $item) {
                if (!empty($item['year']) || !empty($item['title']) || !empty($item['description'])) {
                    $filteredTimeline[] = [
                        'year' => $item['year'] ?? '',
                        'title' => $item['title'] ?? '',
                        'description' => $item['description'] ?? '',
                    ];
                }
            }
            $validated['timeline'] = array_values($filteredTimeline);
        } else {
            $validated['timeline'] = [];
        }

        $uploadDirectory = public_path('uploads/pages');
        if (!file_exists($uploadDirectory)) {
            mkdir($uploadDirectory, 0755, true);
        }

        // Upload Banner Image
        if ($request->hasFile('banner_image')) {
            if ($page->banner_image && file_exists(public_path($page->banner_image))) {
                @unlink(public_path($page->banner_image));
            }
            $file = $request->file('banner_image');
            $filename = 'page_' . $page->slug . '_banner_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move($uploadDirectory, $filename);
            $validated['banner_image'] = 'uploads/pages/' . $filename;
        }

        // Upload or Remove Section Images (1 through 7)
        foreach ([1, 2, 3, 4, 5, 6, 7] as $num) {
            $fieldName = "section_image_{$num}";
            $removeFlag = "remove_section_image_{$num}";

            if ($request->boolean($removeFlag)) {
                if ($page->$fieldName && file_exists(public_path($page->$fieldName))) {
                    @unlink(public_path($page->$fieldName));
                }
                $validated[$fieldName] = null;
            } elseif ($request->hasFile($fieldName)) {
                if ($page->$fieldName && file_exists(public_path($page->$fieldName))) {
                    @unlink(public_path($page->$fieldName));
                }
                $file = $request->file($fieldName);
                $filename = 'page_' . $page->slug . "_sec{$num}_" . time() . '.' . $file->getClientOriginalExtension();
                $file->move($uploadDirectory, $filename);
                $validated[$fieldName] = 'uploads/pages/' . $filename;
            }
        }

        $page->update($validated);

        return redirect()->route('admin.pages.index')->with('success', "Página '{$page->name}' atualizada com sucesso!");
    }
}
