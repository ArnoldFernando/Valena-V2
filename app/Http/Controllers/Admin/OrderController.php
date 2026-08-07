<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class OrderController extends Controller
{
    private const ALLOWED_STATUSES = ['pending', 'processing', 'shipped', 'closed'];

    public function index(): View
    {
        return view('admin.orders.index', [
            'orders' => Order::with(['user', 'gcashPayment'])->orderByDesc('date')->paginate(25),
        ]);
    }

    public function show(Order $order): View
    {
        return view('admin.orders.show', ['order' => $order->load(['user', 'gcashPayment.receiver'])]);
    }

    public function update(Request $request, Order $order): RedirectResponse
    {
        $request->validate([
            'status' => ['required', 'string', 'in:' . implode(',', self::ALLOWED_STATUSES)],
        ]);

        $nextStatus = $request->input('status');
        $payment = $order->gcashPayment;

        if ($nextStatus !== 'pending' && (! $payment || $payment->status !== 'received')) {
            return back()->withErrors([
                'status' => 'You must verify payment first before moving this order beyond pending.',
            ]);
        }

        $order->update(['status' => $nextStatus]);

        return back()->with('success', 'Order status updated.');
    }

    public function verifyPayment(Request $request, Order $order): RedirectResponse
    {
        $request->validate([
            'status' => ['required', 'string', 'in:received,rejected'],
            'admin_note' => ['nullable', 'string', 'max:1000'],
        ]);

        $payment = $order->gcashPayment;

        if (! $payment) {
            return back()->withErrors(['payment' => 'No GCash payment is linked to this order.']);
        }

        $status = $request->input('status');

        $payment->update([
            'status' => $status,
            'admin_note' => $request->input('admin_note'),
            'received_by' => Auth::id(),
            'received_at' => $status === 'received' ? now() : null,
        ]);

        if ($status === 'rejected') {
            $order->update(['status' => 'pending']);
        }

        return back()->with('success', 'Payment status updated.');
    }
}
