<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactInquiry;
use Illuminate\Http\Request;

class AdminContactInquiryController extends Controller
{
    public function index(Request $request)
    {
        $selectedStatus = $request->query('status');

        $inquiries = ContactInquiry::query()
            ->when($selectedStatus, fn ($query) => $query->where('status', $selectedStatus))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.contact-inquiries.index', compact('inquiries', 'selectedStatus'));
    }

    public function show(ContactInquiry $contactInquiry)
    {
        return view('admin.contact-inquiries.show', compact('contactInquiry'));
    }

    public function update(Request $request, ContactInquiry $contactInquiry)
    {
        $validated = $request->validate([
            'status' => ['required', 'in:new,in_progress,resolved'],
            'admin_notes' => ['nullable', 'string', 'max:3000'],
        ]);

        $contactInquiry->update($validated);

        return redirect()
            ->route('admin.contact-inquiries.show', $contactInquiry)
            ->with('success', 'Inquiry updated successfully.');
    }

    public function destroy(ContactInquiry $contactInquiry)
    {
        $contactInquiry->delete();

        return redirect()
            ->route('admin.contact-inquiries.index')
            ->with('success', 'Inquiry deleted successfully.');
    }
}
