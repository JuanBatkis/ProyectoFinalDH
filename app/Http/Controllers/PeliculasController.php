<?php

namespace App\Http\Controllers;

use App\Http\Requests\PeliculasRequest;

use App\Movie;

use App\Genre;

use App\Actor;

class PeliculasController extends Controller
{
    public function buscarPeliculaId($id) {
        $peliculas = [
            1 => "Toy Story",
            2 => "Buscando a Nemo",
            3 => "Avatar",
            4 => "Star Wars: Episodio V",
            5 => "Up",
            6 => "Mary and Max"
            ];

        $resultado;

        if (isset($peliculas[$id])) {
            $resultado = $peliculas[$id];
        } else {
            $resultado = 'id invalido';
        }

        return view('peliculas', ['resultado' => $resultado]);
    }

    public function buscarPeliculaNombre($nombre) {
        $peliculas = [
            1 => "Toy Story",
            2 => "Buscando a Nemo",
            3 => "Avatar",
            4 => "Star Wars: Episodio V",
            5 => "Up",
            6 => "Mary and Max"
            ];

        foreach ($peliculas as $name) {
            if ($name==$nombre) {
                return $name;
                exit;
            }
        }
        return 'No se encontraron resultados';
    }

    public function blade() {
        $peliculas = [
            1 => "Toy Story",
            2 => "Buscando a Nemo",
            3 => "Avatar",
            4 => "Star Wars: Episodio V",
            5 => "Up",
            6 => "Mary and Max"
            ];
        return view('peliculas', ['peliculas' => $peliculas]);
    }

    public function formPelicula() {
        $genres = Genre::all();
        return view('agregarPelicula', ['genres' => $genres]);
    }

    public function agregarPelicula(PeliculasRequest $request) {
        /* request()->validate([
            'title' => 'required|unique:movies,title',
            'rating' => 'required|numeric|between:0,10',
            'awards' => 'required|numeric|min:0',
            'length' => 'required|numeric',
            'dia' => 'required|numeric',
            'mes' => 'required|numeric',
            'anio' => 'required|numeric',
            'genre' => 'required'
        ]); */

        $release_date= request()->input('anio') . "-" . request()->input('mes') . "-" . request()->input('dia') . " 00:00:00";

        $genero=request()->input('genre');
       
        $datos= request()->all();
        $datos['release_date']=$release_date;
        $datos['genre_id']=$genero;

        Movie::create($datos);

        return redirect('/listaPelicula');
    }

    public function listaPelicula() {
        $movies = Movie::all();
        return view('listaMovies', ['movies' => $movies]);
    }

    public function editarPeliculaForm($id) {
        $movies = Movie::find($id);
        return view('editarPelicula', ['movies' => $movies]);
    }

    public function editarPelicula($id) {

        request()->validate([
            'title' => 'required',
            'rating' => 'required|numeric|between:0,10',
            'awards' => 'required|numeric|min:0',
            'length' => 'required|numeric',
            'dia' => 'required|numeric',
            'mes' => 'required|numeric',
            'anio' => 'required|numeric'
        ]);

        $release_date= request()->input('anio') . "-" . request()->input('mes') . "-" . request()->input('dia') . " 00:00:00";
       
        $datos= request()->all();
        $datos['release_date']=$release_date;

        $movies = Movie::find($id);
        $movies->update($datos);

        return redirect('/listaPelicula');
    }

    public function detalle($id) {
        $movies = Movie::find($id);
        
        return view('detalle', ['movies' => $movies]);
    }

    public function apiGet($id) {
        $movie = Movie::find($id);
        return view('apiMovie', ['movie' => $movie]);
    }

    public function apiEdit($id) {

        //dd(request());

        request()->validate([
            'title' => 'required',
            'rating' => 'required|numeric|between:0,10',
            'awards' => 'required|numeric|min:0',
            'length' => 'required|numeric',
            'dia' => 'required|numeric',
            'mes' => 'required|numeric',
            'anio' => 'required|numeric'
        ]);

        $release_date= request()->input('anio') . "-" . request()->input('mes') . "-" . request()->input('dia') . " 00:00:00";
       
        $datos= request()->all();
        $datos['release_date']=$release_date;

        $movies = Movie::find($id);
        $movies->update($datos);

        return view('apiMovie', ['movies' => $movies]);
    }
}
