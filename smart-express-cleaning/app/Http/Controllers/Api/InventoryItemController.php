<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\InventoryItem;
use Illuminate\Http\Request;

class InventoryItemController extends Controller
{
    public function index()
    {
        return InventoryItem::query()->with('property')->latest()->paginate(15);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'property_id' => ['nullable', 'exists:properties,id'],
            'name' => ['required', 'string', 'max:255'],
            'sku' => ['nullable', 'string', 'max:255', 'unique:inventory_items,sku'],
            'unit' => ['nullable', 'string', 'max:30'],
            'quantity' => ['nullable', 'numeric', 'min:0'],
            'low_stock_threshold' => ['nullable', 'numeric', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $item = InventoryItem::create($validated);

        return response()->json($item, 201);
    }

    public function show(InventoryItem $inventoryItem)
    {
        return $inventoryItem->load(['property', 'jobSupplies.cleaningJob']);
    }

    public function update(Request $request, InventoryItem $inventoryItem)
    {
        $validated = $request->validate([
            'property_id' => ['nullable', 'exists:properties,id'],
            'name' => ['sometimes', 'string', 'max:255'],
            'sku' => ['nullable', 'string', 'max:255', 'unique:inventory_items,sku,'.$inventoryItem->id],
            'unit' => ['sometimes', 'string', 'max:30'],
            'quantity' => ['sometimes', 'numeric', 'min:0'],
            'low_stock_threshold' => ['sometimes', 'numeric', 'min:0'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $inventoryItem->update($validated);

        return $inventoryItem->fresh();
    }

    public function destroy(InventoryItem $inventoryItem)
    {
        $inventoryItem->delete();

        return response()->noContent();
    }
}
