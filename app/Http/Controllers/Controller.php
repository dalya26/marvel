<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected function saveThumbnail($url, $folder)
    {
        // obtener el contenido de la imagen desde la URL
        $imageContents = file_get_contents($url);
        
        // generar el nombre de la imagen
        $filename = $folder . '/' . Str::random(40) . '.jpg';

        // guardar la imagen 
        Storage::disk('public')->put($filename, $imageContents);
        return $filename;
    }
}
