<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(): View
    {
        return view('orders.index', [
            'orders' => Auth::user()->orders()->orderByDesc('date')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'proof_file' => ['required', 'file', 'mimes:jpg,jpeg,png', 'max:5120'],
        ]);

        $file = $request->file('proof_file');
        $filename = uniqid() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('proofs', $filename, 'public');

        $items = Auth::user()->cartItems()->get();

        if ($items->isEmpty()) {
            return back()->withErrors(['cart' => 'Your cart is empty.']);
        }

        foreach ($items as $item) {
            Order::create([
                'user_id'     => Auth::id(),
                'title'       => $item->product_name,
                'quantity'    => $item->quantity,
                'price'       => $item->price,
                'trans_total' => $item->price * $item->quantity,
                'proof_file'  => $filename,
            ]);
        }

        Auth::user()->cartItems()->delete();

        return redirect()->route('orders.index')->with('success', 'Order placed successfully!');
    }
}
