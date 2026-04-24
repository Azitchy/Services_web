<?php

namespace App\Http\Controllers;

use App\Models\ContactInquiry;
use Illuminate\Http\Request;

class ContactInquiryController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:255'],
            'company_name' => ['nullable', 'string', 'max:255'],
            'message' => ['required', 'string', 'min:15', 'max:3000'],
        ]);

        ContactInquiry::create([
            ...$validated,
            'status' => 'new',
            'ip_address' => $request->ip(),
            'submitted_from' => $request->userAgent(),
        ]);

        return back()
            ->withFragment('contact')
            ->with('success', 'Thanks for reaching out. We received your details and will contact you shortly.');
    }
}
