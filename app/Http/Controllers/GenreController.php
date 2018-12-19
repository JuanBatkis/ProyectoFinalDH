<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Genre;

class GenreController extends Controller
{
    public function show($id){
        $genres = Genre::find($id);
        return view('movies', ['genres' => $genres]);
    }
}
