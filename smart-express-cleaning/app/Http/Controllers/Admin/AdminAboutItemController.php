<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutItem;
use Illuminate\Http\Request;

class AdminAboutItemController extends Controller
{
    public function index()
    {
        $items = AboutItem::orderBy('type')->orderBy('sort_order')->get();
        return view('admin.about-items.index', compact('items'));
    }

    public function create()
    {
        return view('admin.about-items.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|string|in:who_we_are,deliver',
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'image' => 'nullable|string|max:2048',
            'sort_order' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ]);

        AboutItem::create($validated);

        return redirect()->route('admin.about-items.index')->with('success', 'About item created successfully.');
    }

    public function edit(AboutItem $about_item)
    {
        return view('admin.about-items.edit', compact('about_item'));
    }

    public function update(Request $request, AboutItem $about_item)
    {
        $validated = $request->validate([
            'type' => 'required|string|in:who_we_are,deliver',
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'image' => 'nullable|string|max:2048',
            'sort_order' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $about_item->update($validated);

        return redirect()->route('admin.about-items.index')->with('success', 'About item updated successfully.');
    }

    public function destroy(AboutItem $about_item)
    {
        $about_item->delete();

        return redirect()->route('admin.about-items.index')->with('success', 'About item deleted successfully.');
    }
}
