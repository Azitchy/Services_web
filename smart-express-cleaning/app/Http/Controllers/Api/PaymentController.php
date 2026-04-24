<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        return Payment::query()->with('user')->latest()->paginate(15);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'invoice_number' => ['nullable', 'string', 'max:255', 'unique:payments,invoice_number'],
            'amount' => ['required', 'numeric', 'min:0'],
            'currency' => ['nullable', 'string', 'size:3'],
            'payment_status' => ['nullable', 'in:pending,paid,failed,refunded'],
            'stripe_payment_intent_id' => ['nullable', 'string', 'max:255', 'unique:payments,stripe_payment_intent_id'],
            'due_date' => ['nullable', 'date'],
            'paid_at' => ['nullable', 'date'],
        ]);

        $payment = Payment::create($validated);

        return response()->json($payment, 201);
    }

    public function show(Payment $payment)
    {
        return $payment->load('user');
    }

    public function update(Request $request, Payment $payment)
    {
        $validated = $request->validate([
            'user_id' => ['sometimes', 'exists:users,id'],
            'invoice_number' => ['nullable', 'string', 'max:255', 'unique:payments,invoice_number,'.$payment->id],
            'amount' => ['sometimes', 'numeric', 'min:0'],
            'currency' => ['sometimes', 'string', 'size:3'],
            'payment_status' => ['sometimes', 'in:pending,paid,failed,refunded'],
            'stripe_payment_intent_id' => ['nullable', 'string', 'max:255', 'unique:payments,stripe_payment_intent_id,'.$payment->id],
            'due_date' => ['nullable', 'date'],
            'paid_at' => ['nullable', 'date'],
        ]);

        $payment->update($validated);

        return $payment->fresh();
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();

        return response()->noContent();
    }
}
