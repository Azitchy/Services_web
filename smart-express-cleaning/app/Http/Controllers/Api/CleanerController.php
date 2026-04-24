<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cleaner;
use Illuminate\Http\Request;

class CleanerController extends Controller
{
    public function index()
    {
        return Cleaner::query()->with('user')->latest()->paginate(15);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => ['required', 'exists:users,id', 'unique:cleaners,user_id'],
            'employee_code' => ['nullable', 'string', 'max:255', 'unique:cleaners,employee_code'],
            'phone' => ['nullable', 'string', 'max:50'],
            'hourly_rate' => ['nullable', 'numeric', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $cleaner = Cleaner::create($validated);

        return response()->json($cleaner, 201);
    }

    public function show(Cleaner $cleaner)
    {
        return $cleaner->load(['user', 'cleaningJobs']);
    }

    public function update(Request $request, Cleaner $cleaner)
    {
        $validated = $request->validate([
            'user_id' => ['sometimes', 'exists:users,id', 'unique:cleaners,user_id,'.$cleaner->id],
            'employee_code' => ['nullable', 'string', 'max:255', 'unique:cleaners,employee_code,'.$cleaner->id],
            'phone' => ['nullable', 'string', 'max:50'],
            'hourly_rate' => ['nullable', 'numeric', 'min:0'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $cleaner->update($validated);

        return $cleaner->fresh();
    }

    public function destroy(Cleaner $cleaner)
    {
        $cleaner->delete();

        return response()->noContent();
    }
}
