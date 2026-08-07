<?php

namespace App\Concerns;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

trait HandlesImageUpload
{
    protected function storeImage(Request $request, string $field, string $dir = 'images'): ?string
    {
        if (! $request->hasFile($field)) {
            return null;
        }

        $file = $request->file($field);
        $filename = uniqid() . '.' . $file->getClientOriginalExtension();
        $file->storeAs($dir, $filename, 'public');

        return $filename;
    }

    protected function replaceImage(Request $request, string $field, ?string $old, string $dir = 'images'): ?string
    {
        if (! $request->hasFile($field)) {
            return $old;
        }

        if ($old) {
            Storage::disk('public')->delete($dir . '/' . $old);
        }

        return $this->storeImage($request, $field, $dir);
    }
}
