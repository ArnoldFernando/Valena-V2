<?php

namespace App\Http\Controllers\Admin;

use App\Concerns\HandlesImageUpload;
use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SupplierController extends Controller
{
    use HandlesImageUpload;

    public function index(): View
    {
        return view('admin.suppliers.index', [
            'suppliers' => Supplier::orderByDesc('sup_id')->paginate(20),
        ]);
    }

    public function create(): View
    {
        return view('admin.suppliers.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title'   => ['required', 'string', 'max:222'],
            'email'   => ['required', 'email', 'max:222'],
            'phone'   => ['required', 'string', 'max:50'],
            'url'     => ['nullable', 'string', 'max:222'],
            'o_hr'    => ['nullable', 'string'],
            'c_hr'    => ['nullable', 'string'],
            'o_days'  => ['nullable', 'string'],
            'address' => ['required', 'string'],
            'image'   => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:4096'],
        ]);

        $data['image'] = $this->storeImage($request, 'image');
        $data['url'] ??= '';
        $data['o_hr'] ??= '';
        $data['c_hr'] ??= '';
        $data['o_days'] ??= '';

        Supplier::create($data);

        return redirect()->route('admin.suppliers.index')->with('success', 'Supplier created.');
    }

    public function edit(Supplier $supplier): View
    {
        return view('admin.suppliers.edit', ['supplier' => $supplier]);
    }

    public function update(Request $request, Supplier $supplier): RedirectResponse
    {
        $data = $request->validate([
            'title'   => ['required', 'string', 'max:222'],
            'email'   => ['required', 'email', 'max:222'],
            'phone'   => ['required', 'string', 'max:50'],
            'url'     => ['nullable', 'string', 'max:222'],
            'o_hr'    => ['nullable', 'string'],
            'c_hr'    => ['nullable', 'string'],
            'o_days'  => ['nullable', 'string'],
            'address' => ['required', 'string'],
            'image'   => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:4096'],
        ]);

        $data['image'] = $this->replaceImage($request, 'image', $supplier->image);

        $supplier->update($data);

        return redirect()->route('admin.suppliers.index')->with('success', 'Supplier updated.');
    }

    public function destroy(Supplier $supplier): RedirectResponse
    {
        $supplier->delete();

        return back()->with('success', 'Supplier deleted.');
    }
}
