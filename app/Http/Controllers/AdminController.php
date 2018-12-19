<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function view() {
        if (\Auth::user()->admin == '0') {
            return redirect('/home');
        } else {
            return view('final\admin\adminTools');
        }        
    }
}
