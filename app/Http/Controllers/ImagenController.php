<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImagenController extends Controller
{
    public function form() {
        return view ('agregarImagen');
    }

    public function agregar() {
        $file = request()->file('imagen')->store('storage/imgs');
        return redirect ('/imagen');
    }

    public function ver() {
        return view ('verImagen');
    }
}
