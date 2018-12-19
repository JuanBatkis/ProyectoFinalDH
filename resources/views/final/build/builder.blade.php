<!DOCTYPE html>
<html>
<head>
	<link rel="icon" href="/imagenes/icon_thicc.ico">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css" integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
	<link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:100,300,400,500,700,800,900" rel="stylesheet">
	<link rel="stylesheet" href="\css\homeSteps.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<title>YPC - build</title>

	<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
		<script type="text/javascript">
			function logInBlock() {
				document.getElementById("demo").style.display = "block";
				document.getElementById("demo_back").style.display = "block";
				document.getElementById("demo2").style.display = "none";
				document.getElementById("all").style.position = "fixed";
				document.getElementById("all").style.overflow = "hidden";
			}
			function signUpBlock() {
				document.getElementById("demo2").style.display = "block";
				document.getElementById("demo_back").style.display = "block";
				document.getElementById("demo").style.display = "none";
				document.getElementById("all").style.position = "fixed";
				document.getElementById("all").style.overflow = "hidden";
			}
			function unlockAll() {
				document.getElementById("demo").style.display = "none";
				document.getElementById("demo2").style.display = "none";
				document.getElementById("demo_back").style.display = "none";
				document.getElementById("all").style.position = "unset";
				document.getElementById("all").style.overflow = "auto";
				document.body.scrollTop = 0;
				document.documentElement.scrollTop = 0;
			}
		</script>
</head>
<body id="body">
	<div class="container_log_in" id="demo" style="display:<?php echo (old('logIn')=='true')?"block":"none" ?>;"><!--Log In!-->
		<div class="title">
			<h1 class="main-title"><p class="brand y">Y</p><p class="brand p">P</p><p class="brand c">C</p></h1>
			<i class="exit fas fa-times" onclick="unlockAll()"></i>
		</div>
		<!--<div class="logo_form">
			<img src="imagenes\JustLogo_400_transp.png" alt="logo">
		</div>
		<div class="logo_fake">
			<img src="imagenes\JustLogo_400_transp.png" alt="logo">
		</div>-->
		<div class="form">
				<form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}" class="form_form">
					@csrf
					<input type="hidden" name="logIn" value="true">
					<input type="hidden" name="location" value="build">
					<div class="form_all">
						<label for="email">{{ __('E-Mail:') }}</label>
							<input id="email_log" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" autofocus>
							@if ($errors->has('email') && old('logIn')=='true')
									<span role="alert" class="error">
											{{ $errors->first('email') }}
									</span>
							@endif

						<label for="password">{{ __('Password:') }}</label>
							<input id="password_log" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password">
							@if ($errors->has('password') && old('logIn')=='true')
								<span role="alert" class="error">
									{{ $errors->first('password') }}
								</span>
							@endif

						<div class="acepto_cont">
							<label class="check_container">Remember me
								<input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
								<span class="checkmark"></span>
							</label>
						</div>
						
						<div class="forg">
							<a class="log-link" href="{{ route('password.request') }}">
								{{ __('Forgot Your Password?') }}
							</a>
						</div>
					</div>

					<input type="submit" name="send" id="send_log" class="send" value="Log In!">

				</form>
			<p class="log-link" onclick="signUpBlock()">Don't have an account? Sign up!</p>
		</div>
	</div>
	<div class="container_log_in" id="demo2" style="display:<?php echo (old('register')=='true')?"block":"none" ?>;"><!--Sign Up!-->
		<div class="title">
			<h1 class="main-title"><p class="brand y">Y</p><p class="brand p">P</p><p class="brand c">C</p></h1>
			<i class="exit fas fa-times" onclick="unlockAll()"></i>
		</div>
		<div class="form" id='fg_membersite'>
				<form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}" class="form_form">
					<input type="hidden" name="register" value="true">
					<input type='hidden' name='submitted' id='submitted' value='1'/>
					<input type="hidden" name="location" value="build">
					@csrf
					<div class="form_all">
						<label for="name">{{ __('Username:') }}</label>
							<input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" autofocus>
							@if ($errors->has('name') && old('register')=='true')
								<span class="error" role="alert">
									{{ $errors->first('name') }}
								</span>
							@endif
						
						<label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail:') }}</label>
							<input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}">
							@if ($errors->has('email') && old('register')=='true')
								<span class="error" role="alert">
									{{ $errors->first('email') }}
								</span>
							@endif
	
						<label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password:') }}</label>
							<input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password">
							@if ($errors->has('password') && $errors->first('password') !== 'The password confirmation does not match.' && old('register')=='true')
								<span class="error" role="alert">
									{{ $errors->first('password') }}
								</span>
							@endif
	
						<label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password:') }}</label>
							<input id="password-confirm" type="password" class="form-control" name="password_confirmation" >
							@if ($errors->has('password') && $errors->first('password') == 'The password confirmation does not match.' && old('register')=='true')
								<span class="error" role="alert">
									{{ $errors->first('password') }}
								</span>
							@endif
					</div>
					<input type="submit" name="logIn" id="send" class="send" value="Sign Up!">
				</form>
			<p class="log-link" onclick="logInBlock()">Already have an account? Log in!</p>
		</div>
	</div>
	<div id="all" style="position:<?php echo (old('logIn')=='true' || old('register')=='true')?"fixed":"unset" ?>;overflow:<?php echo (old('logIn')=='true' || old('register')=='true')?"hidden":"inherit" ?>;">
		<div class="top">
			<nav>
				<div class="name">
					<a href="/home" class="name-link"><img src="\imagenes\NewLogo_long_thicc_400.png" alt="logo" class="main_logo" draggable="false"></a>
				</div>
				<div class="log">
					@auth
						<div class="log-block">
              <a id="user-name" href="/profile/{{\Auth::user()->id}}" class="user-name user-name-col" style="user-select: none;text-decoration: underline;text-decoration-color: rgba(61, 95, 219, 0);"> {{ \Auth::user()->name }} </a>
							<div class="setting_cont">
								<div class="setting_arrow user-name"><i class="fas fa-angle-left"></i><i class="fas fa-cog"></i></div>
								<div class="setting_text"><a class="setting_text_link" href="settings">Settings</a></div>
							</div>
							<form action="/logout" method="post">
								@csrf
								<input type="hidden" name="logOut" value="true">
								<input type="hidden" name="location" value="build">
								<input type="submit" name="logOut_bt" id="logOut" class="logOut" value="Log Out?">
							</form>
							@if(\Auth::user()->admin == "1")
								<a href="/admin" class="log-link-main" style="margin-left: 10px; font-size: 14px;">Admin Tools</a>
							@endif
						</div>
					@else
						<div class="log">
							<ul class="log-list">
								<li class="log-block"><a href="#" class="log-link-main" onclick="logInBlock()">Log In</a></li>
								<li class="log-line">|</li>
								<li class="log-block"><a href="#" class="log-link-main" onclick="signUpBlock()">Sign Up</a></li>
							</ul>
						</div>
					@endauth
				</div>

			</nav>
		</div>
		<div class="main">
      <h2 class="generic_h2"><div>Your personal build</div></h2>
    </div>
    <div class="div_line not_loaded"></div>
    <div>
      <form class="build_form" action="/build/builder" method="post">
        @csrf
        <div class="generic_cont1">
          <div class="build_card" id="build_card">
            @auth
              <h3>Build Name:</h3>
              <input class="build_name" type="text" name="build_name" placeholder="Please choose a descriptive name" value="{{ old('build_name') }}" autofocus>
              @if(!empty($errors->first('build_name')))
                <div style="color:crimson;font-size:16px;padding-left: 12px;padding-bottom: 4px;margin-top: -8px;background-color: #eaecf2;">{{ $errors->first('build_name') }}</div>
              @endif
            @else
              <h3>Your Build:</h3>
            @endauth
            <p class="specifications">Specifications:</p>
            <ul>
              <li>Operating System: <div>{{ucfirst($os) . '.'}}</div></li>
              <div id="duda_ram" class="duda_ram" ><p>RAM memory modules usually only come in capacities of 1, 2, 4, 8, 16, 32, 64 or 128 gb.</p><div class="bubble_arrow"></div></div>
              <li>RAM: <i class="far fa-question-circle" onmouseover="duda_ram('in')" onmouseout="duda_ram('out')"></i><div>{{'Your programs will use ' . $max_ram . " gb. You'll need to get a " . $pack_ram . ' gb kit.'}}</div></li>
              <li>CPU brand: <div>{{$cpu_brand . '.'}}</div></li>
              <li>System bit: <div>
                @if($bit==2)
                  {{'32 or 64 bit.'}}
                @else
                  {{$bit . ' bit.'}}
                @endif
              </div></li>
              <li>Multicore processor: <div>
                @if($multicore==1)
                  {{'Yes.'}}
                @else
                  {{'No.'}}
                @endif
              </div></li>
              <li>GPU brand: <div>{{$gpu_brand . '.'}}</div></li>
              <li>VRAM: <div>{{$max_vram . ' gb.'}}</div></li>
              <li>Graphics card with OpenGL: <div>
                @if($openGl==1)
                  {{'Yes.'}}
                @else
                  {{'No.'}}
                @endif
              </div></li>
              <li>Storage Capacity: <div>{{$disk . ' gb.'}}</div></li>
            </ul>
          </div>
        </div>
        @auth
          <input class="build_info" type="text" name="op_system" value="{{$os}}">
          <input class="build_info" type="text" name="softwares" value="{{$all_softwares}}">
          <input class="build_info" type="number" name="ram" value="{{$max_ram}}">
          <input class="build_info" type="text" name="cpu_brand" value="{{$cpu_brand}}">
          <input class="build_info" type="number" name="bit" value="{{$bit}}">
          <input class="build_info" type="number" name="multicore" value="{{$multicore}}">
          <input class="build_info" type="text" name="gpu_brand" value="{{$gpu_brand}}">
          <input class="build_info" type="number" name="v_ram" value="{{$max_vram}}">
          <input class="build_info" type="number" name="openGl" value="{{$openGl}}">
          <input class="build_info" type="number" name="disk" value="{{$disk}}">
        @endauth
        <div id="full_software_list" onclick="expandir()">
          <h3 class="all_softwares">Click to see all your selected softwares <i id="fa-angle-right" class="fas fa-angle-right"></i></h3>
          <div class="database_softwares"><p>Softwares from our database:</p>
            <ul>
              @foreach(json_decode($all_softwares)[0] as $value)
                <li>{{$value}}</li>
              @endforeach
            </ul>
					</div>
					@if(!empty(json_decode($all_softwares)[1]))
						<div class="user_softwares"><p>Softwares you added:</p>
							<ul>
								@foreach(json_decode($all_softwares)[1] as $value)
									<li>{{$value}}</li>
								@endforeach
							</ul>
						</div>
					@endif
        </div>
        @auth
          <label class="container_step5">I want my build to be public.
            <input type="checkbox" class="styled-checkbox" name="is_public" checked>
            <span class="checkmark_step5"></span>
          </label>
          <div class="final_button_div">
            <input type="submit" class="bar_li bar_a final_button" value="Save build">
            <div class="bar_li bar_a final_button discard" onclick="discard()">Discard</div>
          </div>
        @else
          <a href="/home" class="bar_li bar_a final_button">Finish</a>
        @endauth
      </form>
    </div>
  </div>
  <script>function go_back(){history.back()}</script>
	<div class="bar_li bar_a go_back" onclick="go_back()">Go back</div>
</body>
<div class="back" id="demo_back" style="display:<?php echo (old('logIn')=='true' || old('register')=='true')?"block":"none" ?>;" onclick="unlockAll()">

</div>
<div id="invento">

</div>
<script>
	h3_height= document.querySelector('.all_softwares').clientHeight;

	if (document.querySelector('.user_softwares') !== null) {
    user_softwares=document.querySelector('.user_softwares').clientHeight;
	} else{
		user_softwares=0;
	}

  full_height= h3_height + document.querySelector('.database_softwares').clientHeight +user_softwares;
  expand= 0;

  document.getElementById('full_software_list').style= "height: " + (h3_height+ 47) + "px; opacity: 1;";

  function expandir(){
    if (expand==0) {
      document.getElementById('full_software_list').style= "height: " + (full_height+ 95) + "px; opacity: 1;";
      document.getElementById('fa-angle-right').style= "transform: rotate(90deg);";
      expand=1;
    } else {
      document.getElementById('full_software_list').style= "height: " + (h3_height+ 47) + "px; opacity: 1;";
      document.getElementById('fa-angle-right').style= "transform: rotate(0deg);";
      expand=0;
    }
  }

  function duda_ram($do){
    if ($do=='in') {
      document.getElementById('duda_ram').style= "display: block;";
    } else{
      document.getElementById('duda_ram').style= "display: none;";
    }
  }

  function discard() {
    window.location.href = "/home";
  }
</script>
</html>