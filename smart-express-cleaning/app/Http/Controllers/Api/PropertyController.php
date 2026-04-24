<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function index()
    {
        return Property::query()->latest()->paginate(15);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'host_user_id' => ['required', 'exists:users,id'],
            'name' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:255'],
            'property_type' => ['nullable', 'in:apartment,house,villa,studio,other'],
            'bedrooms' => ['nullable', 'integer', 'min:0', 'max:30'],
            'bathrooms' => ['nullable', 'integer', 'min:0', 'max:30'],
            'square_feet' => ['nullable', 'integer', 'min:0'],
            'listing_platform' => ['nullable', 'in:airbnb,pms,manual'],
            'external_listing_id' => ['nullable', 'string', 'max:255'],
            'default_cleaning_minutes' => ['nullable', 'integer', 'min:30', 'max:1440'],
            'notes' => ['nullable', 'string'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $property = Property::create($validated);

        return response()->json($property, 201);
    }

    public function show(Property $property)
    {
        return $property->load(['host', 'bookings', 'cleaningJobs']);
    }

    public function update(Request $request, Property $property)
    {
        $validated = $request->validate([
            'host_user_id' => ['sometimes', 'exists:users,id'],
            'name' => ['sometimes', 'string', 'max:255'],
            'location' => ['sometimes', 'string', 'max:255'],
            'property_type' => ['sometimes', 'in:apartment,house,villa,studio,other'],
            'bedrooms' => ['sometimes', 'integer', 'min:0', 'max:30'],
            'bathrooms' => ['sometimes', 'integer', 'min:0', 'max:30'],
            'square_feet' => ['sometimes', 'integer', 'min:0'],
            'listing_platform' => ['sometimes', 'in:airbnb,pms,manual'],
            'external_listing_id' => ['nullable', 'string', 'max:255'],
            'default_cleaning_minutes' => ['sometimes', 'integer', 'min:30', 'max:1440'],
            'notes' => ['nullable', 'string'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $property->update($validated);

        return $property->fresh();
    }

    public function destroy(Property $property)
    {
        $property->delete();

        return response()->noContent();
    }
}
