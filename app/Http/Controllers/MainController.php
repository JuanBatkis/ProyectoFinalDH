<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Build;

use App\Liked_build;

use App\User;

class MainController extends Controller
{
    public function index() {
        $builds = Build::where('is_public', '=', 1)->orderBy('updated_at', 'desc')->limit(10)->get();

        $builds_top = Build::where('is_public', '=', 1)->orderBy('likes', 'desc')->limit(10)->get();
        return view('/final/index', ['builds' => $builds, 'builds_top' => $builds_top]);
    }

    public function indexOLD() {
        return view('final\indexOLD');
    }

    public function search() {
        return view('/final/search');
    }

    public function settings() {
        if (!\Auth::check()) {
            return redirect('/home');
        } else {
            return view('/final/settings');
        }
    }

    public function profile($id) {
        if (!\Auth::check()) {
            return redirect('/home');
        } else {
            if (\Auth::user()->id!==intval($id)) {
                return redirect('/profile'.'/'.\Auth::user()->id);
            } else {
                $builds = Build::where('user_id', 'like', $id)->get();

                return view('/final/profile', ['builds' => $builds]);
            }
        }
    }

    public function like_post($id) {

        $build = Build::find($id);
        
        $user_liked = Liked_build::where([
            ['user_id', 'like', \Auth::user()->id],
            ['build_id', 'like', $id],
        ])->get();

        if ($build->user_id == \Auth::user()->id) {
            return (1);
        } elseif (count($user_liked)>0) {
            return (2);
        } else {
            Build::where('id', $id)->increment('likes');

            Liked_build::create(
                ['user_id' => \Auth::user()->id, 'build_id' => $id]
            );

            return (0);
        }
        
        /*if ($user->build_id == $build->id) {
            return redirect('/search');
        }*/
        //return view('/final/like', ['id' => $id, 'build' => $build, 'user_liked' => $user_liked]);
    }
}
