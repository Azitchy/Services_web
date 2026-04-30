<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WhyChooseUs;
use Illuminate\Http\Request;

class WhyChooseUsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = WhyChooseUs::orderBy('order', 'asc')->get();
        return view('admin.why-choose-us.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.why-choose-us.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'text' => 'required|string',
            'order' => 'required|integer|min:0',
        ]);

        WhyChooseUs::create($request->all());

        return redirect()->route('admin.why-choose-us.index')->with('success', 'Why Choose Us item created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WhyChooseUs $why_choose_u)
    {
        return view('admin.why-choose-us.edit', ['whyChooseUs' => $why_choose_u]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WhyChooseUs $why_choose_u)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'text' => 'required|string',
            'order' => 'required|integer|min:0',
        ]);

        $why_choose_u->update($request->all());

        return redirect()->route('admin.why-choose-us.index')->with('success', 'Why Choose Us item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WhyChooseUs $why_choose_u)
    {
        $why_choose_u->delete();

        return redirect()->route('admin.why-choose-us.index')->with('success', 'Why Choose Us item deleted successfully.');
    }
}
