<?php

namespace App\Http\Controllers\Admin;

use App\Concerns\HandlesImageUpload;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    use HandlesImageUpload;

    public function index(): View
    {
        return view('admin.products.index', [
            'products' => Product::with('supplier')->orderByDesc('id')->paginate(20),
        ]);
    }

    public function create(): View
    {
        return view('admin.products.create', ['suppliers' => Supplier::orderBy('title')->get()]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'sup_id'       => ['required', 'exists:supplier,sup_id'],
            'title'        => ['required', 'string', 'max:222'],
            'slogan'       => ['required', 'string', 'max:222'],
            'price'        => ['required', 'numeric', 'min:0'],
            'stocks'       => ['required', 'integer', 'min:0'],
            'promo_status' => ['required', 'in:Yes,No'],
            'img'          => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:4096'],
        ]);

        // prod_id groups images of the same product together
        $data['prod_id'] = Product::max('prod_id') + 1;
        $data['img'] = $this->storeImage($request, 'img');

        Product::create($data);

        return redirect()->route('admin.products.index')->with('success', 'Product created.');
    }

    public function edit(Product $product): View
    {
        return view('admin.products.edit', [
            'product'   => $product,
            'suppliers' => Supplier::orderBy('title')->get(),
        ]);
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $data = $request->validate([
            'sup_id'       => ['required', 'exists:supplier,sup_id'],
            'title'        => ['required', 'string', 'max:222'],
            'slogan'       => ['required', 'string', 'max:222'],
            'price'        => ['required', 'numeric', 'min:0'],
            'stocks'       => ['required', 'integer', 'min:0'],
            'promo_status' => ['required', 'in:Yes,No'],
            'img'          => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:4096'],
        ]);

        $data['img'] = $this->replaceImage($request, 'img', $product->img);

        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Product updated.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        if ($product->img) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete('images/' . $product->img);
        }
        $product->delete();

        return back()->with('success', 'Product deleted.');
    }
}
