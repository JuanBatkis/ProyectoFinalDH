<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Hard_gpu;

use Illuminate\Validation\Rule;

class GpuController extends Controller
{
    public function view() {
        if (\Auth::user()->admin == '0') {
            return redirect('/home');
        } else {
            return view('final\admin\gpu\gpuForm');
        }        
    }

    public function save() {

        request()->validate([
            'brand' => 'required|alpha|max:8',
            'name' => 'required|unique:hard_gpus,name',
            'v_ram' => 'required|numeric|min:1',
            'openGl' => 'required',
            'laptop' => 'required',
            'release_date' => 'required|date'
        ]);

        $datos= request()->all();

        if ($datos['openGl']=='yes') {
            $datos['openGl']=1;
        } else {
            $datos['openGl']=0;
        }

        if ($datos['laptop']=='yes') {
            $datos['laptop']=1;
        } else {
            $datos['laptop']=0;
        }

        Hard_gpu::create($datos);

        return redirect('/gpuList');
    }

    public function list() {
        if (\Auth::user()->admin == '0') {
            return redirect('/home');
        } else {
            $orderBy = (isset($_GET['orderBy'])) ? $_GET['orderBy'] : 'id';
            $inv = (isset($_GET['order'])) ? 'desc' : 'asc';
            $gpus = Hard_gpu::orderBy($orderBy, $inv)->get();
            return view('final\admin\gpu\gpuList', ['gpus' => $gpus]);
        }
    }

    public function editView($id) {
        if (\Auth::user()->admin == '0') {
            return redirect('/home');
        } else {
            $gpu = Hard_gpu::find($id);
    
            return view('final\admin\gpu\gpuEdit', ['gpu' => $gpu]);
        }
    }

    public function edit($id) {

        request()->validate([
            'brand' => 'required|alpha|max:8',
            'name' => ['required', Rule::unique('hard_gpus')->ignore($id),],
            'v_ram' => 'required|numeric|min:1',
            'openGl' => 'required',
            'laptop' => 'required',
            'release_date' => 'required|date'
        ]);

        $datos= request()->all();

        if ($datos['openGl']=='yes') {
            $datos['openGl']=1;
        } else {
            $datos['openGl']=0;
        }

        if ($datos['laptop']=='yes') {
            $datos['laptop']=1;
        } else {
            $datos['laptop']=0;
        }

        $gpu = Hard_gpu::find($id);
        $gpu->update($datos);

        return redirect('/gpuList');
    }
}
