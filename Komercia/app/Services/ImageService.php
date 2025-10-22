<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class ImageService
{
    public static function upload(UploadedFile $file, $folder)
    {
        $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();

        $path = $file->storeAs($folder, $filename, 'public');

        return 'storage/' . $path;
    }

    public static function delete($path)
    {
        if (!$path) return;

        $path = ltrim($path, '/');

        $file = str_replace('storage/', '', $path);

        if (Storage::disk('public')->exists($file)) {
            Storage::disk('public')->delete($file);
        }
    }
}
