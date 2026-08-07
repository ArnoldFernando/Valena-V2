<?php

namespace App\Http\Controllers\Admin;

use App\Concerns\HandlesImageUpload;
use App\Http\Controllers\Controller;
use App\Models\Facility;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FacilityController extends Controller
{
    use HandlesImageUpload;

    public function index(): View
    {
        return view('admin.facilities.index', [
            'facilities' => Facility::orderByDesc('id')->paginate(20),
        ]);
    }

    public function create(): View
    {
        return view('admin.facilities.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'fac_id'            => ['required', 'integer'],
            'name'              => ['required', 'string', 'max:255'],
            'intro_description' => ['required', 'string'],
            'full_description'  => ['required', 'string'],
            'image'             => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:4096'],
        ]);

        $data['image'] = $this->storeImage($request, 'image');

        Facility::create($data);

        return redirect()->route('admin.facilities.index')->with('success', 'Facility image added.');
    }

    public function edit(Facility $facility): View
    {
        return view('admin.facilities.edit', ['facility' => $facility]);
    }

    public function update(Request $request, Facility $facility): RedirectResponse
    {
        $data = $request->validate([
            'fac_id'            => ['required', 'integer'],
            'name'              => ['required', 'string', 'max:255'],
            'intro_description' => ['required', 'string'],
            'full_description'  => ['required', 'string'],
            'image'             => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:4096'],
        ]);

        $data['image'] = $this->replaceImage($request, 'image', $facility->image);

        $facility->update($data);

        return redirect()->route('admin.facilities.index')->with('success', 'Facility updated.');
    }

    public function destroy(Facility $facility): RedirectResponse
    {
        if ($facility->image) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete('images/' . $facility->image);
        }
        $facility->delete();

        return back()->with('success', 'Facility deleted.');
    }
}
