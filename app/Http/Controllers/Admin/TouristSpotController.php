<?php

namespace App\Http\Controllers\Admin;

use App\Concerns\HandlesImageUpload;
use App\Http\Controllers\Controller;
use App\Models\TouristSpot;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TouristSpotController extends Controller
{
    use HandlesImageUpload;

    public function index(): View
    {
        return view('admin.tourist-spots.index', [
            'spots' => TouristSpot::orderByDesc('id')->paginate(20),
        ]);
    }

    public function create(): View
    {
        return view('admin.tourist-spots.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'ts_id'             => ['required', 'integer'],
            'name'              => ['required', 'string', 'max:255'],
            'intro_description' => ['required', 'string'],
            'full_description'  => ['required', 'string'],
            'image'             => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:4096'],
        ]);

        $data['image'] = $this->storeImage($request, 'image');

        TouristSpot::create($data);

        return redirect()->route('admin.tourist-spots.index')->with('success', 'Tourist spot added.');
    }

    public function edit(TouristSpot $touristSpot): View
    {
        return view('admin.tourist-spots.edit', ['spot' => $touristSpot]);
    }

    public function update(Request $request, TouristSpot $touristSpot): RedirectResponse
    {
        $data = $request->validate([
            'ts_id'             => ['required', 'integer'],
            'name'              => ['required', 'string', 'max:255'],
            'intro_description' => ['required', 'string'],
            'full_description'  => ['required', 'string'],
            'image'             => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:4096'],
        ]);

        $data['image'] = $this->replaceImage($request, 'image', $touristSpot->image);

        $touristSpot->update($data);

        return redirect()->route('admin.tourist-spots.index')->with('success', 'Tourist spot updated.');
    }

    public function destroy(TouristSpot $touristSpot): RedirectResponse
    {
        if ($touristSpot->image) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete('images/' . $touristSpot->image);
        }
        $touristSpot->delete();

        return back()->with('success', 'Tourist spot deleted.');
    }
}
