<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Actor;

class ActorController extends Controller
{
    public function getNombrecompleto() {
        if (isset($_GET['name'])) {
            $nombre = $_GET['name'];
        } else {
            $nombre = "";
        }
        $actors = Actor::where('first_name', 'like', $nombre . '%')->orWhere('last_name', 'like', $nombre . '%')->get();
        return view('actors', ['actors' => $actors]);
    }

    public function show($id) {
        $actors = Actor::find($id);
        return view('actors', ['actors' => $actors]);
    }

    public function showPlus($id) {
        $actors = Actor::find($id);
        return view('actorsPlus', ['actors' => $actors]);
    }
}
