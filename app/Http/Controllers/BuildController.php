<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Software;

use App\Op_system;

use App\Requirement;

use App\Soft_cpu;

use App\Soft_gpu;

use App\Build;

class BuildController extends Controller
{
    public function view() {
        if (isset($_COOKIE['builds'])) {
            unset($_COOKIE['builds']);
            setcookie('builds', '', time() - 3600, '/build');
        }

        if (isset($_COOKIE['groups'])) {
            unset($_COOKIE['groups']);
            setcookie('groups', '', time() - 3600, '/build');
        }

        return view('final/build/build');
    }

    public function step1() {
        //request()->session()->flush();
        $i=0;
        if (Auth::check()) {
            $count=3;
        } else {
            $count=2;
        }
        foreach (request()->session()->all() as $key => $value) {
            if ($i> $count) {
                request()->session()->forget($key);
            }
            $i=$i+1;
        }
        return view('final/build/step1');
    }

    public function step2() {
        $os=request()->input('select');

        $search=request()->input('search');

        $selected=request()->input('selected');

        foreach ($_GET as $key => $value) {
            session([$key => $value]);
        };

        request()->session()->forget('search');

        if ($os!=='windows'&&$os!=='macOS'&&$os!=='linux') {
            return redirect('/home');
        };
        
        $op_systems = Op_system::where('os_name', 'like', $os)->get();

        if (!empty($search)) {
            $softwares = Software::join('op_systems', 'softwares.id', '=', 'op_systems.software_id')
            ->where('os_name', 'like', $os)
            ->where('softwares.name', 'like', '%'.$search.'%')
            ->get();
            
            return view('final/build/step2', ['softwares' => $softwares]);
        } else {
            return view('final/build/step2');
        };
        /*Op_system::where('os_name', 'like', $os)->where()->get();*/
    }

    public function step3() {
        $i=0;
        $num_list="";
        $os=request()->session()->get('select');
        if (Auth::check()) {
            $count=4;
        } else {
            $count=3;
        }

        foreach(request()->session()->all() as $key => $value) {
        if($i>$count) {
            //$num_list[]=$value;
            if ($i+1 < count(request()->session()->all())) {
                $num_list=$num_list . $value . ", ";
            } else {
                $num_list=$num_list.$value;
            }
        }
        $i=$i+1;
        }
        $num_list = array_map('intval', explode(',', $num_list));
        
        $softwares = Software::join('op_systems', 'softwares.id', '=', 'op_systems.software_id')->where('os_name', 'like', $os)->findMany($num_list);
            
        return view('final/build/step3' ,['softwares' => $softwares]);  
        
    }

    public function step4() {
        //request()->session()->flush();
        
        //request()->session()->regenerate();
        
        foreach ($_GET as $key => $value) {
            //session()->push("datos", [$key => $value]);
            session([$key => $value]);
        };
        
        /*$i=0;
        $num_list="";
        $os=request()->session()->get('select');        

        foreach(request()->session()->all() as $key => $value) {
        if($i>0) {
            //$num_list[]=$value;
            if ($i+1 < count(request()->session()->all())) {
                $num_list=$num_list . $value . ", ";
            } else {
                $num_list=$num_list.$value;
            }
        }
        $i=$i+1;
        }
        $num_list = array_map('intval', explode(',', $num_list));
        
        $softwares = Software::join('op_systems', 'softwares.id', '=', 'op_systems.software_id')
        ->where('os_name', 'like', $os)->findMany($num_list);*/
                
        return view('final/build/step4');
        
    }

    public function step4_post() {
        request()->validate([
            'name' => 'required',
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

        //dd($datos);

        return redirect('/build/step4');
    }

    public function step5(){
        if (isset($_COOKIE['builds'])) {
            $my_cookie=json_decode($_COOKIE['builds']);
        } else {
            $my_cookie=null;
        }
        $my_session=request()->session()->all();
        return view('final/build/step5' ,['my_cookie' => $my_cookie], ['my_session' => $my_session]);
    }

    public function builder(){
        $i=0;
        $num_list="";
        $os=request()->session()->get('select');
        if (Auth::check()) {
            $count=4;
        } else {
            $count=3;
        }
        
        foreach(request()->session()->all() as $key => $value) {
            if($i>$count && $key!=='_old_input' && $key!=='errors') {
                //$num_list[]=$value;
                if ($i+1 < count(request()->session()->all())) {
                    
                    $num_list=$num_list . $value . ", ";
                } else {
                    $num_list=$num_list.$value;
                }
            }
            $i=$i+1;
        }

        $num_list = array_map('intval', explode(',', $num_list));
        //dd($num_list);
        $softwares = Software::join('op_systems', 'softwares.id', '=', 'op_systems.software_id')
        ->join('requirements', 'op_systems.req_id', '=', 'requirements.id')
        ->join('soft_cpus', 'requirements.soft_cpu_id', '=', 'soft_cpus.id')
        ->join('soft_gpus', 'requirements.soft_gpu_id', '=', 'soft_gpus.id')
        ->where('os_name', 'like', $os)->findMany($num_list);
        //dd($softwares);

        if (isset($_COOKIE['groups'])) {
            $user_groups=json_decode($_COOKIE['groups']);
        }
        if (isset($_COOKIE['builds'])) {
            $user_softwares=json_decode($_COOKIE['builds']);
        }
        
        $database=array();
      
        $user_database=array();

        $all_softwares=array();
      
        $conjuntos=array();
      
        $user_conjuntos=array();
      
        $ram_total= array();
      
        $disk_total= array();
      
        $vram_total= array();
      
        $cpu_brand= '';
      
        $bit= 0;
      
        $multicore= 0;
      
        $gpu_brand= '';
      
        $openGl= 0;

        switch ($os) {
            case 'windows':
                $ram_s= 2;
                $disk= 20;
                break;
            case 'macOS':
                $ram_s= 2;
                $disk= 7;
                break;
            case 'linux':
                $ram_s= 2;
                $disk= 25;
                break;
        }
        $vram= 0;

        if (isset($user_groups)) {
            foreach($user_groups as $key => $value){
                switch ($os) {
                    case 'windows':
                        $ram= 2;
                        $disk= 20;
                        break;
                    case 'macOS':
                        $ram= 2;
                        $disk= 7;
                        break;
                    case 'linux':
                        $ram= 2;
                        $disk= 25;
                        break;
                }
                $vram= 0;
                foreach($value->group_selected as $key => $value){
                    foreach($softwares as $software){
                        if($value==$software->name){
                            $ram= $ram + $software->ram;
                            $vram= $vram + $software->v_ram;
                        }
                    }
                    if (isset($user_softwares)){
                        foreach($user_softwares as $user_softwares_value){
                            if($value==$user_softwares_value->name){
                                $ram= $ram + $user_softwares_value->ram;
                                $vram= $vram + $user_softwares_value->v_ram;
                            }
                        }
                    }
                }
                array_push($ram_total, $ram);
                array_push($vram_total, $vram);
            }
        }

        foreach($softwares as $software){
            if($software->cpu_brand=='any'){$cpu_brand='Intel or AMD';}
            if($software->bit==2){$bit=2;}
            if($software->multicore==1){$multicore=1;}
            if($software->gpu_brand=='any'){$gpu_brand='Nvidia, Intel or AMD';}
            if($software->openGl==1){$openGl=1;}
            $ram= $software->ram + $ram_s;
            array_push($ram_total, $ram);
            $disk= $disk + $software->disk;
            $vram= $software->v_ram;
            array_push($vram_total, $vram);
            array_push($database, $software->name);
        }

        if (isset($user_softwares)){
            foreach($user_softwares as $user_softwares_value){
                if($user_softwares_value->cpu_brand=='any'){$cpu_brand='Intel or AMD';}
                if($user_softwares_value->bit==2){$bit=2;}
                if($user_softwares_value->multicore==1){$multicore=1;}
                if($user_softwares_value->gpu_brand=='any'){$gpu_brand='Nvidia, Intel or AMD';}
                if($user_softwares_value->openGl==1){$openGl=1;}
                $ram= $user_softwares_value->ram + $ram_s;
                array_push($ram_total, $ram);
                $disk= $disk + $user_softwares_value->disk;
                $vram= $user_softwares_value->v_ram;
                array_push($vram_total, $vram);
                array_push($user_database, $user_softwares_value->name);
            }
        }
        foreach($softwares as $software){
            if($software->cpu_brand=='amd'){$cpu_brand='AMD';}
            if($software->bit==32){$bit=32;}
            if($software->gpu_brand=='intel'){$gpu_brand='Intel';}
        }

        if (isset($user_softwares)){
            foreach($user_softwares as $user_softwares_value){
                if($user_softwares_value->cpu_brand=='amd'){$cpu_brand='AMD';}
                if($user_softwares_value->bit==32){$bit=32;}
                if($user_softwares_value->gpu_brand=='intel'){$gpu_brand='Intel';}
            }
        }
        foreach($softwares as $software){
            if($software->cpu_brand=='intel'){$cpu_brand='Intel';}
            if($software->bit==64){$bit=64;}
            if($software->gpu_brand=='amd'){$gpu_brand='AMD';}
        }

        if (isset($user_softwares)){
            foreach($user_softwares as $user_softwares_value){
                if($user_softwares_value->cpu_brand=='intel'){$cpu_brand='Intel';}
                if($user_softwares_value->bit==64){$bit=64;}
                if($user_softwares_value->gpu_brand=='amd'){$gpu_brand='AMD';}
            }
        }
        foreach($softwares as $software){
            if($software->gpu_brand=='both'){$gpu_brand='Nvidia or AMD';}
        }

        if (isset($user_softwares)){
            foreach($user_softwares as $user_softwares_value){
                if($user_softwares_value->gpu_brand=='both'){$gpu_brand='Nvidia or AMD';}
            }
        }
        foreach($softwares as $software){
            if($software->gpu_brand=='nvidia'){$gpu_brand='Nvidia';}
        }

        if (isset($user_softwares)){
            foreach($user_softwares as $user_softwares_value){
                if($user_softwares_value->gpu_brand=='nvidia'){$gpu_brand='Nvidia';}
            }
        }

        $max_ram= max($ram_total);
        $max_vram= max($vram_total);
        array_push($all_softwares, $database);
        if (isset($user_database)){
            array_push($all_softwares, $user_database);
        }
        $all_softwares= json_encode($all_softwares);

        $pack_ram=1;

        while ($pack_ram < $max_ram) {
            $pack_ram= $pack_ram*2;
        }
            

        return view('final/build/builder', ['softwares' => $softwares, 'all_softwares' => $all_softwares, 'os' => $os, 'max_ram' => $max_ram, 'pack_ram' => $pack_ram, 'disk' => $disk, 'max_vram' => $max_vram, 'cpu_brand' => $cpu_brand, 'bit' => $bit, 'multicore' => $multicore, 'gpu_brand' => $gpu_brand, 'openGl' => $openGl]);  
    }

    public function builder_post(){
        if (Auth::check()) {
            request()->validate([
                'build_name' => 'required|max:25',
                'op_system' => 'required',
                'softwares' => 'required',
                'ram' => 'required',
                'cpu_brand' => 'required',
                'bit' => 'required',
                'multicore' => 'required',
                'gpu_brand' => 'required',
                'v_ram' => 'required',
                'openGl' => 'required',
                'disk' => 'required'
            ]);

            $datos= request()->all();

            $datos['user_id']=Auth::id();

            if(isset($datos['is_public'])){
                $datos['is_public']=1;
            } else {
                $datos['is_public']=0;
            }
                
            switch ($datos['cpu_brand']) {
                case 'Intel or AMD':
                    $datos['cpu_brand']='any';
                    break;
                case 'AMD':
                    $datos['cpu_brand']='amd';
                    break;
                case 'Intel':
                    $datos['cpu_brand']='intel';
                    break;
            }

            switch ($datos['gpu_brand']) {
                case 'Nvidia, Intel or AMD':
                    $datos['gpu_brand']='any';
                    break;
                case 'AMD':
                    $datos['gpu_brand']='amd';
                    break;
                case 'Intel':
                    $datos['gpu_brand']='intel';
                    break;
                case 'Nvidia or AMD':
                    $datos['gpu_brand']='both';
                    break;
                case 'Nvidia':
                    $datos['gpu_brand']='nvidia';
                    break;
            }

            Build::create($datos);

            return redirect('/profile/'.\Auth::user()->id);
        } else {
            return redirect('/home');
        }
    }
}
