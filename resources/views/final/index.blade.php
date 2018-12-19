<!DOCTYPE html>
<html>
<head>
	<link rel="icon" href="imagenes/icon_thicc.ico">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css" integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
	<link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:100,300,400,500,700,800,900" rel="stylesheet">
	<link rel="stylesheet" href="css\home.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<title>YPC</title>

	<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
		<script type="text/javascript">
			enable = "<?php echo (!empty($errores) || !empty($erroresExiste))?"not_black":"black" ?>";
			function logInBlock() {
				enable = "not_black";
				$('.selling-text').removeClass('black');
				document.getElementById("demo").style.display = "block";
				document.getElementById("demo_back").style.display = "block";
				document.getElementById("demo2").style.display = "none";
				document.getElementById("all").style.position = "fixed";
				document.getElementById("all").style.overflow = "hidden";
				document.getElementsByClassName("black").style.opacity = "1";
			}
			function signUpBlock() {
				enable = "not_black";
				$('.selling-text').removeClass('black');
				document.getElementById("demo2").style.display = "block";
				document.getElementById("demo_back").style.display = "block";
				document.getElementById("demo").style.display = "none";
				document.getElementById("all").style.position = "fixed";
				document.getElementById("all").style.overflow = "hidden";
				document.getElementsByClassName("black").style.opacity = "1";
			}
			function unlockAll() {
				enable = "black";
				document.getElementById("demo").style.display = "none";
				document.getElementById("demo2").style.display = "none";
				document.getElementById("demo_back").style.display = "none";
				document.getElementById("all").style.position = "unset";
				document.getElementById("all").style.overflow = "auto";
				document.body.scrollTop = 0;
				document.documentElement.scrollTop = 0;
			}

				$(window).on('scroll', function() {
					if ($(window).scrollTop()) {
						$('.selling-text').addClass(enable);
						$('.main_page').addClass('main_page_scroll');
						$('.gen-ref').addClass('gen-ref-scroll');
					} else {
						$('.selling-text').removeClass(enable);
						$('.main_page').removeClass('main_page_scroll');
						$('.gen-ref').removeClass('gen-ref-scroll');
					}
				})
		</script>
</head>
<body id="body">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<div class="build_more_info" id="build_more_info"></div>
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
					<input type="hidden" name="location" value="home">
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
				<input type="hidden" name="location" value="home">
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
	<div id="all" style="position:<?php echo (old('logIn')=='true' || old('register')=='true')?"fixed":"unset" ?>;overflow:<?php echo (old('logIn')=='true' || old('register')=='true')?"hidden":"auto" ?>;">
		<div class="top">
			<nav>
				<div class="name">
					<a href="home" class="name-link"><img src="imagenes\NewLogo_long_thicc_400.png" alt="logo" class="main_logo" draggable="false"></a>
				</div>

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
								<input type="hidden" name="location" value="home">
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

			</nav>
		</div>
		<div class="main_nav">
			<div class="nav_left_cont">
				<ul class="nav_left_ul">
					<li class="bar_li"> 
						<div class="bar_a"><i class="big-icon fas fa-desktop"></i><i class="link-arrow fas fa-angle-right"></i><a href="/build">Start a Build</a></div>
					</li>
					<li class="bar_li"> 
						<div class="bar_a"><i class="big-icon fas fa-search"></i><i class="link-arrow fas fa-angle-right"></i><a href="search">Browse by Software</a></div>
					</li>
					<li class="bar_li"> 
						<div class="bar_a"><i class="big-icon far fa-clock"></i><i class="link-arrow fas fa-angle-right"></i><a href="#new">Newest Builds</a></div>
					</li>
					<li class="bar_li"> 
						<div class="bar_a"><i class="big-icon fas fa-trophy"></i><i class="link-arrow fas fa-angle-right"></i><a href="#top">Top Builds</a></div>
					</li>
					<li class="bar_li"> 
						<div class="bar_a"><i class="big-icon fas fa-question"></i><i class="link-arrow fas fa-angle-right"></i><a href="#faq">FAQ</a></div>
					</li>
				</ul>
			</div>
		</div>
		<div class="main_cont_back">
			<div class="back_cont"></div>
		</div>
		<div class="floating_text_cont">
				<div class="floating_text">
						<p class="selling-text" id="selling-text">tell us what you do and we'll tell you what you need</p>
				</div>
		</div>
		<div class="main_page">
			<div class="bout_us">
				<h2 class="bout_us_h2">About <span>US</span></h2>
				<p class="bout_us_p">Your Personal Computer is your one stop page for figuring out what you'll need to run all your favorite applications. After a few very simple steps, you'll know exactly what to get for your next build.
				<br>Our interface is intuitive and very simple to use, you don't need any prior technical knowledge.
				<br>If you create an account, all your builds will be stored for you to check them out whenever you want. Don't worry, you'll be able to decide if you want them to be public or not.</p>
			</div>
			<div class="gen-ref" id="new"></div>
			<div class="generic">
				<h2 class="generic_h2">Newest Builds</h2>
				<div class="comodin">
						<span class="navigate">
							<a id="scrollRight1" href="#"><i class="fas fa-angle-left"></i></a>
							<a id="endRight1" href="#"><i class="fas fa-angle-double-left"></i></a>
						</span>
					<div class="generic_cont1">
						@foreach($builds as $build)
							<div class="build_card" id="build_card_latest{{$build->id}}" onclick="ver(this.id)">
								<h3>{{$build->build_name}}</h3>
								<br>
								<ul>
									<li>Operating System: <div>{{ucfirst($build->op_system) . '.'}}</div></li>
									<li class="ram">RAM: <div>{{$build->ram . " gb"}}</div></li>
									<li>CPU brand: <div>
											@if($build->cpu_brand=='any')
												{{'Intel or AMD'}}
											@else
												{{ucfirst($build->cpu_brand) . '.'}}
											@endif
									</div></li>
									<li>System bit: <div>
										@if($build->bit==2)
											{{'32 or 64 bit.'}}
										@else
											{{$build->bit . ' bit.'}}
										@endif
									</div></li>
									<li>Multicore processor: <div>
										@if($build->multicore==1)
											{{'Yes.'}}
										@else
											{{'No.'}}
										@endif
									</div></li>
									<li>GPU brand: <div>
										@switch($build->gpu_brand)
											@case('any')
												{{'Nvidia, Intel or AMD.'}}
												@break
											@case('intel')
												{{'Intel.'}}
												@break
											@case('amd')
												{{'AMD.'}}
												@break
											@case('both')
												{{'Nvidia or AMD.'}}
												@break
											@case('nvidia')
												{{'Nvidia.'}}
												@break
										@endswitch
									</div></li>
									<li>VRAM: <div>{{$build->v_ram . ' gb.'}}</div></li>
									<li>OpenGL: <div>
										@if($build->openGl==1)
											{{'Yes.'}}
										@else
											{{'No.'}}
										@endif
									</div></li>
									<li>Storage Capacity: <div>{{$build->disk . ' gb.'}}</div></li>
								</ul>
								<div id="build_card_latest{{$build->id}}_list" style="display: none;">
									<h4>Softwares used:</h4>
									<div class="database_softwares"><p>Softwares from our database:</p>
										<ul>
											@foreach(json_decode($build->softwares)[0] as $value)
												<li>{{$value}}</li>
											@endforeach
										</ul>
									</div>
									@if(!empty(json_decode($build->softwares)[1]))
										<div class="user_softwares"><p>Softwares the user added:</p>
											<ul>
												@foreach(json_decode($build->softwares)[1] as $value)
													<li>{{$value}}</li>
												@endforeach
											</ul>
										</div>	
									@endif	
								</div>
							</div>
						@endforeach
					</div>
					<span class="navigate"> 
						<a id="scrollLeft1" href="#"><i class="fas fa-angle-right"></i></a>
						<a id="endLeft1" href="#"><i class="fas fa-angle-double-right"></i></a>
					</span>
					<script class="por_paso">
						var step = ($(".build_card").outerWidth(true)+4);

						var w = window.innerWidth;
						if (w<542) {
							var mult = 1;
						} else {
							if (w<768) {
								var mult = 2;
							} else {
								if (w<842) {
									var mult = 1;
								} else {
									var mult = 2;
								}
							}
						}
						
						var scrolling = false;

						// Wire up events for the 'scrollUp' link:
						$("#scrollRight1").bind("click", function(event) {
							event.preventDefault();
							// Animates the scrollTop property by the specified
							// step.
							$(".generic_cont1").animate({
								scrollLeft: "-=" + step + "px"
							});
						}).bind("mouseover", function(event) {
							scrolling = false;
							// scrollContent("right");
						}).bind("mouseout", function(event) {
							scrolling = false;
						});


						$("#scrollLeft1").bind("click", function(event) {
							event.preventDefault();
							$(".generic_cont1").animate({
								scrollLeft: "+=" + step + "px"
							});
						}).bind("mouseover", function(event) {
							scrolling = false;
							// scrollContent("down");
						}).bind("mouseout", function(event) {
							scrolling = false;
						});

						function scrollContent(direction) {
							var amount = (direction === "right" ? "-=1px" : "+=1px");
							$(".generic_cont1").animate({
								scrollLeft: amount
							}, 1, function() {
								if (scrolling) {
									scrollContent(direction);
								}
							});
						}
					</script>
					<script class="final">
						var end = 10000;

						var scrolling = false;

						// Wire up events for the 'scrollUp' link:
						$("#endRight1").bind("click", function(event) {
							event.preventDefault();
							// Animates the scrollTop property by the specified
							// step.
							$(".generic_cont1").animate({
								scrollLeft: "-=" + end + "px"
							});
						}).bind("mouseover", function(event) {
							scrolling = false;
							// scrollContent("right");
						}).bind("mouseout", function(event) {
							scrolling = false;
						});


						$("#endLeft1").bind("click", function(event) {
							event.preventDefault();
							$(".generic_cont1").animate({
								scrollLeft: "+=" + end + "px"
							});
						}).bind("mouseover", function(event) {
							scrolling = false;
							// scrollContent("down");
						}).bind("mouseout", function(event) {
							scrolling = false;
						});

						function scrollContent(direction) {
							var amount = (direction === "right" ? "-=1px" : "+=1px");
							$(".generic_cont1").animate({
								scrollLeft: amount
							}, 1, function() {
								if (scrolling) {
									scrollContent(direction);
								}
							});
						}
					</script>
				</div>
			</div>
			<div class="gen-ref" id="top"></div>
			<div class="generic">
				<h2 class="generic_h2">Top Builds</h2>
				<div class="comodin">
					<span class="navigate">
						<a id="scrollRight2" href="#"><i class="fas fa-angle-left"></i></a>
						<a id="endRight2" href="#"><i class="fas fa-angle-double-left"></i></a>
					</span>
					<div class="generic_cont2">
						@foreach($builds_top as $build)
							<div class="build_card" id="build_card_latest{{$build->id}}" onclick="ver(this.id)">
								<h3>{{$build->build_name}}</h3>
								<br>
								<ul>
									<li>Operating System: <div>{{ucfirst($build->op_system) . '.'}}</div></li>
									<li class="ram">RAM: <div>{{$build->ram . " gb"}}</div></li>
									<li>CPU brand: <div>
											@if($build->cpu_brand=='any')
												{{'Intel or AMD'}}
											@else
												{{ucfirst($build->cpu_brand) . '.'}}
											@endif
									</div></li>
									<li>System bit: <div>
										@if($build->bit==2)
											{{'32 or 64 bit.'}}
										@else
											{{$build->bit . ' bit.'}}
										@endif
									</div></li>
									<li>Multicore processor: <div>
										@if($build->multicore==1)
											{{'Yes.'}}
										@else
											{{'No.'}}
										@endif
									</div></li>
									<li>GPU brand: <div>
										@switch($build->gpu_brand)
											@case('any')
												{{'Nvidia, Intel or AMD.'}}
												@break
											@case('intel')
												{{'Intel.'}}
												@break
											@case('amd')
												{{'AMD.'}}
												@break
											@case('both')
												{{'Nvidia or AMD.'}}
												@break
											@case('nvidia')
												{{'Nvidia.'}}
												@break
										@endswitch
									</div></li>
									<li>VRAM: <div>{{$build->v_ram . ' gb.'}}</div></li>
									<li>OpenGL: <div>
										@if($build->openGl==1)
											{{'Yes.'}}
										@else
											{{'No.'}}
										@endif
									</div></li>
									<li>Storage Capacity: <div>{{$build->disk . ' gb.'}}</div></li>
								</ul>
								<div id="build_card_latest{{$build->id}}_list" style="display: none;">
									<h4>Softwares used:</h4>
									<div class="database_softwares"><p>Softwares from our database:</p>
										<ul>
											@foreach(json_decode($build->softwares)[0] as $value)
												<li>{{$value}}</li>
											@endforeach
										</ul>
									</div>
									@if(!empty(json_decode($build->softwares)[1]))
										<div class="user_softwares"><p>Softwares the user added:</p>
											<ul>
												@foreach(json_decode($build->softwares)[1] as $value)
													<li>{{$value}}</li>
												@endforeach
											</ul>
										</div>	
									@endif
								</div>
							</div>
						@endforeach
					</div>
					<span class="navigate"> 
						<a id="scrollLeft2" href="#"><i class="fas fa-angle-right"></i></a>
						<a id="endLeft2" href="#"><i class="fas fa-angle-double-right"></i></a>
					</span>
					<script class="por_paso">
						var step = ($(".build_card").outerWidth(true)+4);

						var w = window.innerWidth;
						if (w<542) {
							var mult = 1;
						} else {
							if (w<768) {
								var mult = 2;
							} else {
								if (w<842) {
									var mult = 1;
								} else {
									var mult = 2;
								}
							}
						}

						var scrolling = false;

						// Wire up events for the 'scrollUp' link:
						$("#scrollRight2").bind("click", function(event) {
							event.preventDefault();
							// Animates the scrollTop property by the specified
							// step.
							$(".generic_cont2").animate({
								scrollLeft: "-=" + step + "px"
							});
						}).bind("mouseover", function(event) {
							scrolling = false;
							// scrollContent("right");
						}).bind("mouseout", function(event) {
							scrolling = false;
						});


						$("#scrollLeft2").bind("click", function(event) {
							event.preventDefault();
							$(".generic_cont2").animate({
								scrollLeft: "+=" + step + "px"
							});
						}).bind("mouseover", function(event) {
							scrolling = false;
							// scrollContent("down");
						}).bind("mouseout", function(event) {
							scrolling = false;
						});

						function scrollContent(direction) {
							var amount = (direction === "right" ? "-=1px" : "+=1px");
							$(".generic_cont2").animate({
								scrollLeft: amount
							}, 1, function() {
								if (scrolling) {
									scrollContent(direction);
								}
							});
						}
					</script>
					<script class="final">
						var end = 10000;

						var scrolling = false;

						// Wire up events for the 'scrollUp' link:
						$("#endRight2").bind("click", function(event) {
							event.preventDefault();
							// Animates the scrollTop property by the specified
							// step.
							$(".generic_cont2").animate({
								scrollLeft: "-=" + end + "px"
							});
						}).bind("mouseover", function(event) {
							scrolling = false;
							// scrollContent("right");
						}).bind("mouseout", function(event) {
							scrolling = false;
						});


						$("#endLeft2").bind("click", function(event) {
							event.preventDefault();
							$(".generic_cont2").animate({
								scrollLeft: "+=" + end + "px"
							});
						}).bind("mouseover", function(event) {
							scrolling = false;
							// scrollContent("down");
						}).bind("mouseout", function(event) {
							scrolling = false;
						});

						function scrollContent(direction) {
							var amount = (direction === "right" ? "-=1px" : "+=1px");
							$(".generic_cont2").animate({
								scrollLeft: amount
							}, 1, function() {
								if (scrolling) {
									scrollContent(direction);
								}
							});
						}
					</script>
				</div>
			</div>
			<div class="gen-ref" id="faq"></div>
			<div class="generic">
					<h2 class="generic_h2">FAQ</h2>
					<div class="generic_cont_q">
						<div class="question">
							<h3>Do I need to pay for this service? <i class="indic fas fa-angle-right"></i></h3>
							<p class="answer">Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas, dicta beatae quidem saepe corrupti molestias doloremque, ullam nam impedit, qui amet non. Voluptates, officiis adipisci. Dolor consequuntur odio quas ratione!Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas, dicta beatae quidem saepe corrupti molestias doloremque, ullam nam impedit, qui amet non. Voluptates, officiis adipisci. Dolor consequuntur odio quas ratione!</p>
						</div>
						<div class="question">
							<h3>How do I save my builds? <i class="indic fas fa-angle-right"></i></h3>
							<p class="answer">Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas, dicta beatae quidem saepe corrupti molestias doloremque, ullam nam impedit, qui amet non. Voluptates, officiis adipisci. Dolor consequuntur odio quas ratione!Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas, dicta beatae quidem saepe corrupti molestias doloremque, ullam nam impedit, qui amet non. Voluptates, officiis adipisci. Dolor consequuntur odio quas ratione!</p>
						</div>
						<div class="question">
							<h3>Can everyone see my builds? <i class="indic fas fa-angle-right"></i></h3>
							<p class="answer">Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas, dicta beatae quidem saepe corrupti molestias doloremque, ullam nam impedit, qui amet non. Voluptates, officiis adipisci. Dolor consequuntur odio quas ratione!Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas, dicta beatae quidem saepe corrupti molestias doloremque, ullam nam impedit, qui amet non. Voluptates, officiis adipisci. Dolor consequuntur odio quas ratione!</p>
						</div>
						<div class="question">
							<h3>Do I need to sign up to use this service? <i class="indic fas fa-angle-right"></i></h3>
							<p class="answer">Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas, dicta beatae quidem saepe corrupti molestias doloremque, ullam nam impedit, qui amet non. Voluptates, officiis adipisci. Dolor consequuntur odio quas ratione!Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas, dicta beatae quidem saepe corrupti molestias doloremque, ullam nam impedit, qui amet non. Voluptates, officiis adipisci. Dolor consequuntur odio quas ratione!</p>
						</div>
						<div class="question">
							<h3>The software I use is not listed. What do I do? <i class="indic fas fa-angle-right"></i></h3>
							<p class="answer">Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas, dicta beatae quidem saepe corrupti molestias doloremque, ullam nam impedit, qui amet non. Voluptates, officiis adipisci. Dolor consequuntur odio quas ratione!Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas, dicta beatae quidem saepe corrupti molestias doloremque, ullam nam impedit, qui amet non. Voluptates, officiis adipisci. Dolor consequuntur odio quas ratione!</p>
						</div>
						<div class="question">
							<h3>How are the top builds chosen? <i class="indic fas fa-angle-right"></i></h3>
							<p class="answer">Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas, dicta beatae quidem saepe corrupti molestias doloremque, ullam nam impedit, qui amet non. Voluptates, officiis adipisci. Dolor consequuntur odio quas ratione!Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas, dicta beatae quidem saepe corrupti molestias doloremque, ullam nam impedit, qui amet non. Voluptates, officiis adipisci. Dolor consequuntur odio quas ratione!</p>
						</div>
						<div class="question">
							<h3>For how long will I have my builds stored? <i class="indic fas fa-angle-right"></i></h3>
							<p class="answer">Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas, dicta beatae quidem saepe corrupti molestias doloremque, ullam nam impedit, qui amet non. Voluptates, officiis adipisci. Dolor consequuntur odio quas ratione!Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas, dicta beatae quidem saepe corrupti molestias doloremque, ullam nam impedit, qui amet non. Voluptates, officiis adipisci. Dolor consequuntur odio quas ratione!</p>
						</div>
						<div class="question">
							<h3>What can I do to support this page? <i class="indic fas fa-angle-right"></i></h3>
							<p class="answer">Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas, dicta beatae quidem saepe corrupti molestias doloremque, ullam nam impedit, qui amet non. Voluptates, officiis adipisci. Dolor consequuntur odio quas ratione!Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas, dicta beatae quidem saepe corrupti molestias doloremque, ullam nam impedit, qui amet non. Voluptates, officiis adipisci. Dolor consequuntur odio quas ratione!</p>
						</div>
					</div>
			</div>
		</div>
	</div>
	<?php
		if (Auth::check()) {
			$log=1;
		} else {
			$log=0;
		}
	?>
</body>
<div class="back" id="demo_back" style="display:<?php echo (old('logIn')=='true' || old('register')=='true')?"block":"none" ?>;" onclick="unlockAll()">

</div>
<div id="invento">

</div>

<script>
		auth= {{ $log }} ;
</script>
<script src="\js\ver.js"></script>
</html>
