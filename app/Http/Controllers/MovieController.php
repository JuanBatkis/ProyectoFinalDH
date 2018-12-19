<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Movie;

class MovieController extends Controller
{
    public function show($id){
        $movies = Movie::find($id);
        return view('genres', ['movies' => $movies]);
    }
}
