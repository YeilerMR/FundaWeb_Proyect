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

// SUBIDA DE IMAGENES A CLOUDINARY

// <?php

// namespace App\Services;

// use Cloudinary\Cloudinary;
// use Illuminate\Http\UploadedFile;

// class ImageService
// {
//     /**
//      * Instancia del cliente de Cloudinary.
//      */
//     protected static function client(): Cloudinary
//     {
//         return new Cloudinary([
//             'cloud' => [
//                 'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
//                 'api_key'    => env('CLOUDINARY_API_KEY'),
//                 'api_secret' => env('CLOUDINARY_API_SECRET'),
//             ],
//             'url' => ['secure' => true],
//         ]);
//     }

//     /**
//      * Sube una imagen a Cloudinary y devuelve la URL segura.
//      */
//     public static function upload(UploadedFile $file, string $folder): string
//     {
//         $cloudinary = self::client();

//         $upload = $cloudinary->uploadApi()->upload(
//             $file->getRealPath(),
//             [
//                 'folder'         => $folder,
//                 'resource_type'  => 'image',
//                 'quality'        => 'auto',
//                 'fetch_format'   => 'auto',
//             ]
//         );

//         return $upload['secure_url'];
//     }

//     /**
//      * Elimina una imagen de Cloudinary si la URL es válida.
//      */
//     public static function delete(?string $url): void
//     {
//         if (!$url || !str_contains($url, 'res.cloudinary.com')) {
//             return; // no hace nada si no es de Cloudinary
//         }

//         // Extrae el public_id de la URL
//         $parts = explode('/', parse_url($url, PHP_URL_PATH));
//         $publicId = preg_replace('/\.[^.]+$/', '', implode('/', array_slice($parts, 5)));

//         try {
//             $cloudinary = self::client();
//             $cloudinary->uploadApi()->destroy($publicId);
//         } catch (\Exception $e) {
//             // evita errores si la imagen ya fue eliminada
//             report($e);
//         }
//     }
// }