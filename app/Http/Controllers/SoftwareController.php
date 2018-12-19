<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Software;

use App\Op_system;

use App\Requirement;

use App\Soft_cpu;

use App\Soft_gpu;

class SoftwareController extends Controller
{
    public function view() {
        if (\Auth::user()->admin == '0') {
            return redirect('/home');
        } else {
            return view('final\admin\software\softwareForm');
        }        
    }

    public function save() {

        request()->validate([
            'name' => 'required|unique:softwares,name',
            'os_name' => 'required|max:8',
            'ram' => 'required|numeric|min:1',
            'cpu_brand' => 'required|alpha|max:8',
            'bit' => 'required|numeric',
            'multicore' => 'required',
            'gpu_brand' => 'required|alpha|max:8',
            'v_ram' => 'required|numeric|min:0',
            'openGl' => 'required',
            'disk' => 'required|numeric|min:0.1',
        ]);

        $datos= request()->all();

        if ($datos['openGl']=='yes') {
            $datos['openGl']=1;
        } else {
            $datos['openGl']=0;
        }

        if ($datos['multicore']=='yes') {
            $datos['multicore']=1;
        } else {
            $datos['multicore']=0;
        }

        Software::create($datos);

        $soft= Software::orderBy('created_at', 'desc')->first();

        $datos['software_id']=$soft->id;

        Soft_cpu::create($datos);

        $cpu= Soft_cpu::orderBy('created_at', 'desc')->first();

        $datos['soft_cpu_id']=$cpu->id;

        Soft_gpu::create($datos);

        $gpu= Soft_gpu::orderBy('created_at', 'desc')->first();

        $datos['soft_gpu_id']=$gpu->id;

        Requirement::create($datos);

        $req= Requirement::orderBy('created_at', 'desc')->first();

        $datos['req_id']=$req->id;

        Op_system::create($datos);

        return redirect('/softwareList');

        /*$address = new App\Address(['city' = Input::get('city')]);
        $payment = new App\Payment(['account_num' = Input::get('acct_num')]); 

        $user = User::create(Input::all());
        $user->address()->save($address);
        $user->payment()->save($payment);*/
    }

    public function list() {
        if (\Auth::user()->admin == '0') {
            return redirect('/home');
        } else {
            $orderBy = (isset($_GET['orderBy'])) ? $_GET['orderBy'] : 'id';
            $inv = (isset($_GET['order'])) ? 'desc' : 'asc';
            $op_systems = Op_system::orderBy($orderBy, $inv)->get();
            return view('final\admin\software\softwareList', ['op_systems' => $op_systems]);
            /*$softs = Software::orderBy($orderBy, $inv)->get();
            return view('final\admin\software\softwareList', ['softs' => $softs]);*/
        }
    }

    public function editView($id) {
        if (\Auth::user()->admin == '0') {
            return redirect('/home');
        } else {
            $op_system = Op_system::find($id);
    
            return view('final\admin\software\softwareEdit', ['op_system' => $op_system]);
        }
    }

    public function edit($id) {
        request()->validate([
        'name' => ['required',/* Rule::unique('softwares')->ignore($id, 'software_id'),*/],
            'os_name' => 'required|max:8',
            'ram' => 'required|numeric|min:1',
            'cpu_brand' => 'required|alpha|max:8',
            'bit' => 'required|numeric',
            'multicore' => 'required',
            'gpu_brand' => 'required|alpha|max:8',
            'v_ram' => 'required|numeric|min:0',
            'openGl' => 'required',
            'disk' => 'required|numeric|min:0.1',
        ]);

        $datos= request()->all();

        if ($datos['openGl']=='yes') {
            $datos['openGl']=1;
        } else {
            $datos['openGl']=0;
        }

        if ($datos['multicore']=='yes') {
            $datos['multicore']=1;
        } else {
            $datos['multicore']=0;
        }

        $op_system = Op_system::find($id);
        $op_system->update($datos);
        
        $software = Software::find($op_system->software_id);
        $software->update($datos);
        
        $req = Requirement::find($op_system->req_id);
        $req->update($datos);

        $cpu = Soft_cpu::find($req->soft_cpu_id);
        $cpu->update($datos);

        $gpu = Soft_gpu::find($req->soft_gpu_id);
        $gpu->update($datos);

        return redirect('/softwareList');
    }

    public function addView($id) {
        if (\Auth::user()->admin == '0') {
            return redirect('/home');
        } else {
            $op_system = Op_system::find($id);
    
            return view('final\admin\software\softwareAdd', ['op_system' => $op_system]);
        }
    }

    public function add($id) {
        request()->validate([
            'os_name' => 'required|max:8',
            'ram' => 'required|numeric|min:1',
            'cpu_brand' => 'required|alpha|max:8',
            'bit' => 'required|numeric',
            'multicore' => 'required',
            'gpu_brand' => 'required|alpha|max:8',
            'v_ram' => 'required|numeric|min:0',
            'openGl' => 'required',
            'disk' => 'required|numeric|min:0.1',
        ]);

        $datos= request()->all();

        if ($datos['openGl']=='yes') {
            $datos['openGl']=1;
        } else {
            $datos['openGl']=0;
        }

        if ($datos['multicore']=='yes') {
            $datos['multicore']=1;
        } else {
            $datos['multicore']=0;
        }

        $op_system = Op_system::find($id);

        $software = Software::find($op_system->software_id);
        $datos['software_id']=$software->id;
        
        Soft_cpu::create($datos);

        $cpu= Soft_cpu::orderBy('created_at', 'desc')->first();

        $datos['soft_cpu_id']=$cpu->id;

        Soft_gpu::create($datos);

        $gpu= Soft_gpu::orderBy('created_at', 'desc')->first();

        $datos['soft_gpu_id']=$gpu->id;

        Requirement::create($datos);

        $req= Requirement::orderBy('created_at', 'desc')->first();

        $datos['req_id']=$req->id;

        Op_system::create($datos);

        return redirect('/softwareList');
    }
}
