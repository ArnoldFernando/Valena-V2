<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(): View
    {
        return view('cart.index', [
            'items' => Auth::user()->cartItems()->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $product = Product::findOrFail($request->input('product_id'));

        $item = CartItem::firstOrNew([
            'prod_id' => $product->prod_id,
            'user_id' => Auth::id(),
        ]);

        $item->product_name = $product->title;
        $item->price = $product->price;
        $item->quantity = ($item->exists ? $item->quantity : 0) + ($request->input('quantity', 1));
        $item->save();

        return redirect()->route('cart.index');
    }

    public function update(Request $request, CartItem $cart): RedirectResponse
    {
        $cart->quantity = max(1, (int) $request->input('quantity', 1));
        $cart->save();

        return back();
    }

    public function destroy(CartItem $cart): RedirectResponse
    {
        $cart->delete();

        return back();
    }
}
