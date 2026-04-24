<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CleaningJob;
use Illuminate\Http\Request;

class CleaningJobController extends Controller
{
    public function index()
    {
        return CleaningJob::query()
            ->with(['property', 'booking', 'cleaner'])
            ->orderBy('scheduled_start')
            ->paginate(15);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'booking_id' => ['nullable', 'exists:bookings,id'],
            'property_id' => ['required', 'exists:properties,id'],
            'cleaner_id' => ['nullable', 'exists:cleaners,id'],
            'scheduled_start' => ['required', 'date'],
            'scheduled_end' => ['nullable', 'date', 'after:scheduled_start'],
            'status' => ['nullable', 'in:pending,assigned,in_progress,completed,missed,cancelled'],
            'priority' => ['nullable', 'integer', 'min:1', 'max:5'],
            'manual_override' => ['nullable', 'boolean'],
            'completed_at' => ['nullable', 'date'],
            'notes' => ['nullable', 'string'],
        ]);

        $job = CleaningJob::create($validated);

        return response()->json($job, 201);
    }

    public function show(CleaningJob $cleaningJob)
    {
        return $cleaningJob->load(['property', 'booking', 'cleaner', 'supplies.inventoryItem']);
    }

    public function update(Request $request, CleaningJob $cleaningJob)
    {
        $validated = $request->validate([
            'booking_id' => ['nullable', 'exists:bookings,id'],
            'property_id' => ['sometimes', 'exists:properties,id'],
            'cleaner_id' => ['nullable', 'exists:cleaners,id'],
            'scheduled_start' => ['sometimes', 'date'],
            'scheduled_end' => ['nullable', 'date', 'after:scheduled_start'],
            'status' => ['sometimes', 'in:pending,assigned,in_progress,completed,missed,cancelled'],
            'priority' => ['sometimes', 'integer', 'min:1', 'max:5'],
            'manual_override' => ['sometimes', 'boolean'],
            'completed_at' => ['nullable', 'date'],
            'notes' => ['nullable', 'string'],
        ]);

        $cleaningJob->update($validated);

        return $cleaningJob->fresh();
    }

    public function destroy(CleaningJob $cleaningJob)
    {
        $cleaningJob->delete();

        return response()->noContent();
    }
}
