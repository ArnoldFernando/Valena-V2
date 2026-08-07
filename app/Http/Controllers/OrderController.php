<?php

namespace App\Http\Controllers;

use App\Models\GCashPayment;
use App\Models\GCashPaymentSetting;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();

        if (! $user instanceof User) {
            abort(403);
        }

        return view('orders.index', [
            'orders' => $user->orders()->with('gcashPayment')->orderByDesc('date')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $gcashSetting = GCashPaymentSetting::query()->first();

        if (! $gcashSetting?->qr_image_path) {
            return back()->withErrors([
                'payment' => 'GCash QR is not available yet. Please wait for admin setup.',
            ]);
        }

        $request->validate([
            'reference_number' => ['required', 'string', 'max:50', 'unique:gcash_payments,reference_number'],
            'sender_name' => ['required', 'string', 'max:255'],
            'sender_number' => ['nullable', 'string', 'max:20'],
        ]);

        $user = Auth::user();

        if (! $user instanceof User) {
            abort(403);
        }

        $items = $user->cartItems()->get();

        if ($items->isEmpty()) {
            return back()->withErrors(['cart' => 'Your cart is empty.']);
        }

        $totalAmount = $items->sum(fn($item) => $item->price * $item->quantity);

        $payment = GCashPayment::create([
            'user_id' => Auth::id(),
            'reference_number' => $request->input('reference_number'),
            'sender_name' => $request->input('sender_name'),
            'sender_number' => $request->input('sender_number'),
            'paid_amount' => $totalAmount,
            'status' => 'pending',
        ]);

        foreach ($items as $item) {
            Order::create([
                'user_id' => Auth::id(),
                'gcash_payment_id' => $payment->id,
                'title' => $item->product_name,
                'quantity' => $item->quantity,
                'price' => $item->price,
                'status' => 'pending',
                'trans_total' => $item->price * $item->quantity,
            ]);
        }

        $user->cartItems()->delete();

        return redirect()->route('orders.index')->with('success', 'Order placed. Please wait for admin payment verification.');
    }
}
