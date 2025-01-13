<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with('user')->latest()->get();
        return view('admin.payments.index', compact('payments'));
    }

    public function updateStatus(Request $request, Payment $payment)
    {
        $payment->update([
            'status' => $request->status
        ]);

        if ($request->status === 'confirmed') {
            $payment->user->update(['user_role' => 'premium']);
        }

        return response()->json(['success' => true]);
    }
}
