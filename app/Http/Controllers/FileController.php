<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class FileController extends Controller
{
    /**
     * Obtener un archivo.
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    function getFile(Request $request){
        if ($request->path) {
            $path_1 = storage_path("app/" . $request->path);
            if (file_exists($path_1)) {
                $path = $path_1;
            }
        }
        return response()->file($path);
    }
}
