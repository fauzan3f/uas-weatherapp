<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


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
    public function store(Request $request)
    {
        $payment = Payment::create([
            'user_id' => Auth::user()->id,
            'amount' => $request->amount,
            'payment_method' => $request->payment_method,
            'status' => 'pending'
        ]);

        return response()->json(['success' => true, 'payment' => $payment]);
    }
}

namespace App\Http\Controllers;

