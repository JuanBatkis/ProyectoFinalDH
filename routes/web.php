<?php
    require_once("C:\Users\Juan\blog\app\Http\Controllers\PeliculasController.php");
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/miPrimerRuta', function () {
    return 'Creé mi primer ruta en Laravel';
});

Route::get('/resultado/{numero1}/{numero2?}', function ($numero1, $numero2=null) {
    if ($numero2===null) {
        if ($numero1%2==0){
            return "$numero1 es par";
        } else{
            return "$numero1 es impar";
        }
    } else {
        return "$numero1 x $numero2 = " . $numero1*$numero2;
    }
});

Route::get('/peliculas/{id}', 'PeliculasController@buscarPeliculaId');

Route::get('/peliculas/buscar/{nombre}', 'PeliculasController@buscarPeliculaNombre');

Route::get('/blade/ej2', 'PeliculasController@blade');

Route::post('/agregarPelicula', 'PeliculasController@postPelicula');

Route::get('/actors', 'ActorController@getNombrecompleto');

Route::get('/actores/{id}', 'ActorController@show');

Route::get('/actores/{id}/info', 'ActorController@showPlus');

Route::get('/agregarPelicula', 'PeliculasController@formPelicula');

Route::post('/agregarPelicula', 'PeliculasController@agregarPelicula');

Route::get('/listaPelicula', 'PeliculasController@listaPelicula');

Route::get('/editarPelicula/{id}/form', 'PeliculasController@editarPeliculaForm');

Route::put('/editarPelicula/{id}/form', 'PeliculasController@editarPelicula');

Route::get('/genre/{id}', 'GenreController@show');

//Route::get('/movie/{id}', 'MovieController@show');

Route::get('/movie/{id}', 'PeliculasController@detalle');

Route::get('/imagen/agregar', 'ImagenController@form');

Route::post('/imagen/agregar', 'ImagenController@agregar');

Route::get('/imagen', 'ImagenController@ver');

//////////////////////

Route::get('/home', 'MainController@index');
Route::get('/homeOLD', 'MainController@indexOLD');
//Route::view('/main', 'final\index');

Route::get('/search', 'MainController@search');

Route::get('/settings', 'MainController@settings');

Route::post('/settings', 'UserController@change');

Route::get('/build', 'BuildController@view');

Route::get('/build/step1', 'BuildController@step1');

Route::get('/build/step2', 'BuildController@step2');

Route::get('/build/step3', 'BuildController@step3');

Route::get('/build/step4', 'BuildController@step4');

Route::post('/build/step4', 'BuildController@step4_post');

Route::get('/build/step5', 'BuildController@step5');

Route::get('/build/builder', 'BuildController@builder');

Route::post('/build/builder', 'BuildController@builder_post');

Route::get('/profile/{id}', 'MainController@profile');

Route::get('/like/{id}', 'MainController@like_post');


Route::get('/admin', 'AdminController@view');


Route::get('/gpuForm', 'GpuController@view');

Route::post('/gpuForm', 'GpuController@save');

Route::get('/gpuList', 'GpuController@list');

Route::get('/gpuEdit/{id}', 'GpuController@editView');

Route::post('/gpuEdit/{id}', 'GpuController@edit');


Route::get('/cpuForm', 'CpuController@view');

Route::post('/cpuForm', 'CpuController@save');

Route::get('/cpuList', 'CpuController@list');

Route::get('/cpuEdit/{id}', 'CpuController@editView');

Route::post('/cpuEdit/{id}', 'CpuController@edit');


Route::get('/softwareForm', 'SoftwareController@view');

Route::post('/softwareForm', 'SoftwareController@save');

Route::get('/softwareList', 'SoftwareController@list');

Route::get('/softwareEdit/{id}', 'SoftwareController@editView');

Route::post('/softwareEdit/{id}', 'SoftwareController@edit');

Route::get('/softwareAdd/{id}', 'SoftwareController@addView');

Route::post('/softwareAdd/{id}', 'SoftwareController@add');








Auth::routes();

Route::get('/Laravelhome', 'HomeController@index')->name('home');
