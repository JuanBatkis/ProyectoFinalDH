<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Hard_cpu;

class CpuController extends Controller
{
    public function view() {
        return view('final\admin\cpu\cpuForm');
    }

    public function save() {

        request()->validate([
            'brand' => 'required|alpha|max:8',
            'name' => 'required|unique:hard_cpus,name',
            'bit_32' => 'required',
            'bit_64' => 'required',
            'n_cores' => 'required|numeric|min:1',
            'laptop' => 'required',
            'release_date' => 'required|date'
        ]);

        $datos= request()->all();

        if ($datos['bit_32']=='yes') {
            $datos['bit_32']=1;
        } else {
            $datos['bit_32']=0;
        }

        if ($datos['bit_64']=='yes') {
            $datos['bit_64']=1;
        } else {
            $datos['bit_64']=0;
        }

        if ($datos['laptop']=='yes') {
            $datos['laptop']=1;
        } else {
            $datos['laptop']=0;
        }

        Hard_cpu::create($datos);

        return redirect('/cpuList');
    }

    public function list() {
        $orderBy = (isset($_GET['orderBy'])) ? $_GET['orderBy'] : 'id';
        $inv = (isset($_GET['order'])) ? 'desc' : 'asc';
        $cpus = Hard_cpu::orderBy($orderBy, $inv)->get();
        return view('final\admin\cpu\cpuList', ['cpus' => $cpus]);
    }

    public function editView($id) {

        $cpu = Hard_cpu::find($id);

        return view('final\admin\cpu\cpuEdit', ['cpu' => $cpu]);
    }

    public function edit($id) {

        request()->validate([
            'brand' => 'required|alpha|max:8',
            'name' => ['required', Rule::unique('hard_cpus')->ignore($id),],
            'bit_32' => 'required',
            'bit_64' => 'required',
            'n_cores' => 'required|numeric|min:1',
            'laptop' => 'required',
            'release_date' => 'required|date'
        ]);

        $datos= request()->all();

        if ($datos['bit_32']=='yes') {
            $datos['bit_32']=1;
        } else {
            $datos['bit_32']=0;
        }

        if ($datos['bit_64']=='yes') {
            $datos['bit_64']=1;
        } else {
            $datos['bit_64']=0;
        }

        if ($datos['laptop']=='yes') {
            $datos['laptop']=1;
        } else {
            $datos['laptop']=0;
        }

        $cpu = Hard_cpu::find($id);
        $cpu->update($datos);

        return redirect('/cpuList');
    }
}
