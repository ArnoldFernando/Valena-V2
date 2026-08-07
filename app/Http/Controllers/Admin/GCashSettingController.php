<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GCashPaymentSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class GCashSettingController extends Controller
{
    public function edit(): View
    {
        return view('admin.gcash-settings.edit', [
            'setting' => GCashPaymentSetting::query()->firstOrCreate([], []),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'qr_image' => ['required', 'file', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
        ]);

        $setting = GCashPaymentSetting::query()->firstOrCreate([], []);

        if ($setting->qr_image_path) {
            Storage::disk('public')->delete($setting->qr_image_path);
        }

        $path = $validated['qr_image']->store('gcash-qr', 'public');

        $setting->update([
            'qr_image_path' => $path,
        ]);

        return back()->with('success', 'GCash QR image updated successfully.');
    }
}
