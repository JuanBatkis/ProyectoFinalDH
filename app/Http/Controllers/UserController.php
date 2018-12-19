<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function change() {
        if (request()->input('type')=='name') {
            request()->validate([
                'name' => 'required|max:12',
            ]);

            $datos= request()->all();
            $id= request()->input('id');
            $user = User::find($id);
            $user->update($datos);

            return redirect('/settings');
        } elseif (request()->input('type')=='password') {
            request()->validate([
                'name' => 'required|max:12',
            ]);

            $datos= request()->all();
            $id= request()->input('id');
            $user = User::find($id);
            $user->update($datos);

            return redirect('/settings');
        } else {
            return redirect('/home');
        }
    }
}
