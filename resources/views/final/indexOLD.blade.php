<?php
	session_start();
	//require_once("functions.php");

	if (!isset($_POST["register"])) {
		$_POST["register"] = "false";
	}
	if (!isset($_POST["logIn"])) {
		$_POST["logIn"] = "false";
	}

	if ($_POST && $_POST["register"] == "true") {
		//pueden hacer el if ternario mientras asignan la variable O directamente en el value de HTML
		$email = $_POST["email"];
		$user= $_POST["username"];
		$errores=validarDatos($_POST);
		$erroresExiste=yaExiste($_POST);
			if(empty($errores) && empty($erroresExiste)){
				$usuario= crearUsuario($_POST);
				subirArchivo($_FILES);
				guardarUsuario($usuario);
				$logIn = loginUsuario($_POST);
			}
		}

	if ($_POST && $_POST["logIn"] == "true") {
		$user= $_POST["username"];
		$erroresLogin = validarLogin($_POST);
		if (empty($erroresLogin)) {
			$logIn = loginUsuario($_POST);
			if (isset($_POST["remember"])){
				setcookie("user", $user, time() + 604800);
			}
		}
	}

	if (isset($logIn["error"])) {
		if ($logIn["error"] == "no") {
			$_SESSION["user"] = $user;
			
		}
	}

	if (isset($_POST["logOut"])) {
		if ($_POST["logOut"] == "true") {
			session_destroy();
			setcookie("user", $user, time() - 604800);
			header('Location: '.$_SERVER['REQUEST_URI']);
		}
	}
	/*echo "POST: "; var_dump($_POST);
	echo "<br>";
	echo "SESSION: "; var_dump($_SESSION);
	echo "<br>";
	echo "COOKIE: "; var_dump($_COOKIE);*/
?>

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
	<div class="container_log_in" id="demo" style="display:<?php echo (!empty($erroresLogin) || (!empty($logIn) && $logIn["error"] !== "no"))?"block":"none" ?>;"><!--Log In!-->
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
			<form class="form_form" action="" method="post">
			@csrf
			<input type="hidden" name="logIn" value="true">
				<div class="form_all">
					<label for="username" >Username or E-mail:</label>
					<input type="text" name="username" id="username" value='<?php echo !empty($user)? $user:"" ?>'>
					<span id='logIn_username_errorloc' class='error'style="font-size: 14px;color: #c22424;font-weight: 500;">
						@if (!empty($erroresLogin["username"]))
							{{ $erroresLogin["username"] }}
						@else
							{{ "" }}
						@endif
					</span>

					<label for="pass" >Password:</label>
					<input type="password" name="password" id="pass" value="<?php echo isset($_POST["remember"])? $_POST["password"]:"" ?>">
					<span id='logIn_username_errorloc' class='error'style="font-size: 14px;color: #c22424;font-weight: 500;">
						@if (!empty($erroresLogin["password"]))
							{{ $erroresLogin["password"] }}
						@elseif (!empty($logIn["error"]) && $logIn["error"] !== "no")
							{{ $logIn["error"] }}
						@else
							{{ "" }}
						@endif
					</span>

					<div class="acepto_cont">
						<label class="check_container">Remember me
							<input type="checkbox" name="remember" value="true">
							<span class="checkmark"></span>
						</label>
					</div>
					<div class="forg"><a href="#" class="log-link">Forgot your password?</a></div>
				</div>
				<input type="submit" name="send" id="send_log" class="send" value="Log In!">
			</form>
			<p class="log-link" onclick="signUpBlock()">Don't have an account? Sign up!</p>
		</div>
	</div>
	<div class="container_log_in" id="demo2" style="display:<?php echo (!empty($errores) || !empty($erroresExiste))?"block":"none" ?>;"><!--Sign Up!-->
		<div class="title">
			<h1 class="main-title"><p class="brand y">Y</p><p class="brand p">P</p><p class="brand c">C</p></h1>
			<i class="exit fas fa-times" onclick="unlockAll()"></i>
		</div>
		<div class="form" id='fg_membersite'>
			<form id='register' class="form_form" action="" method="post" enctype="multipart/form-data">
			<input type="hidden" name="register" value="true">
			<input type='hidden' name='submitted' id='submitted' value='1'/>
				<div class="form_all">
					<label for='username' >Username:</label>
					<input type='text' name='username' id='username' value='<?php echo !empty($user)? $user:"" ?>' maxlength="50" />
					<span id='register_username_errorloc' class='error'style="font-size: 14px;color: #c22424;font-weight: 500;">
						@if (!empty($errores["user"]))
							{{ $errores["user"] }}
						@elseif (!empty($erroresExiste["username"]))
							{{ $erroresExiste["username"] }}
						@else
							{{ "" }}
						@endif
					</span>

					<label for='email' >E-mail:</label>
					<input type='email' name='email' id='email' value='<?php echo !empty($email)? $email:"" ?>' maxlength="50" />
					<span id='register_email_errorloc' class='error'style="font-size: 14px;color: #c22424;font-weight: 500;">
						@if (!empty($errores["email"]))
							{{ $errores["email"] }}
						@elseif (!empty($erroresExiste["email"]))
							{{ $erroresExiste["email"] }}
						@else
							{{ "" }}
						@endif
					</span>

					<label for='password' >Password:</label>
					<div class='pwdwidgetdiv' id='thepwddiv' ></div>
					<input type='password' name='password' id='password' maxlength="50" />
					<span id='register_password_errorloc' class='error' style='clear:both;font-size: 14px;color: #c22424;font-weight: 500;'>
						@if (!empty($errores["password"]))
							{{ $errores["password"] }}
						@else
							{{ "" }}
						@endif
					</span>

					<label for='conpassword' >Confirm Password:</label>
					<div class='pwdwidgetdiv' id='thepwddiv' ></div>
					<input type='password' name='cpassword' id='password' maxlength="50" />
					<span id='register_password_errorloc' class='error' style='clear:both;font-size: 14px;color: #c22424;font-weight: 500;'>
						@if (!empty($errores["password"]))
							{{ $errores["password"] }}
						@elseif (!empty($errores["match"]))
							{{ $errores["match"] }}
						@else
							{{ "" }}
						@endif
					</span>

					<!--<label for='email' >Upload profile picture (optional):</label>
					<div id="upload-file-container" >
						<input type="file" name="archivo"/>
					</div>-->

					<div class="acepto_cont">
						<label class="check_container" style="color:<?php echo (!empty($errores["acepto"]))?"#c22424":"" ?>;">I have read and accepted the <a href="#" class="log-link">Terms and Conditions</a>
							<input type="checkbox" name="acepto" value="yes">
							<span class="checkmark"></span>
						</label>
					</div>
				</div>
				<input type="submit" name="logIn" id="send" class="send" value="Sign Up!">
			</form>
			<p class="log-link" onclick="logInBlock()">Already have an account? Log in!</p>
		</div>
	</div>
	<div id="all" style="position:<?php echo (!empty($errores) || !empty($erroresExiste) || !empty($erroresLogin) || (!empty($logIn) && $logIn["error"] !== "no"))?"fixed":"unset" ?>;overflow:<?php echo (!empty($errores) || !empty($erroresExiste) || !empty($erroresLogin) || (!empty($logIn) && $logIn["error"] !== "no"))?"hidden":"auto" ?>;">
		<div class="top">
			<nav>
				<div class="name">
					<a href="home" class="name-link"><img src="imagenes\NewLogo_long_thicc_400.png" alt="logo" class="main_logo" draggable="false"></a>
				</div>

					@if (isset($_SESSION["user"]) || isset($_COOKIE["user"]))
						<div class="log-block">								
							<div class="user-name user-name-col"> <?php echo (isset($_SESSION["user"]))?$_SESSION["user"]:$_COOKIE["user"] ?> </div>
							<div class="setting_cont">
								<div class="setting_arrow user-name"><i class="fas fa-angle-left"></i><i class="fas fa-cog"></i></div>
								<div class="setting_text"><a class="setting_text_link" href="settings">Settings</a></div>
							</div>
							<form action="" method="post">
								<input type="hidden" name="logOut" value="true">
								<input type="submit" name="logOut_bt" id="logOut" class="logOut" value="Log Out?">
							</form>
						</div>
					@else
						<div class="log">
							<ul class="log-list">
								<li class="log-block"><a href="#" class="log-link-main" onclick="logInBlock()">Log In</a></li>
								<li class="log-line">|</li>
								<li class="log-block"><a href="#" class="log-link-main" onclick="signUpBlock()">Sign Up</a></li>
							</ul>
						</div>
					@endif

			</nav>
		</div>
		<div class="main_nav">
			<div class="nav_left_cont">
				<ul class="nav_left_ul">
					<li class="bar_li"> 
						<div class="bar_a"><i class="big-icon fas fa-desktop"></i><i class="link-arrow fas fa-angle-right"></i><a href="#">Start a Build</a></div>
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
				<p class="bout_us_p">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Saepe deleniti quibusdam non velit, tempore amet harum fugiat labore reprehenderit nisi minima. Magnam, quisquam sit mollitia ea cupiditate impedit ducimus odit?Lorem ipsum, dolor sit amet consectetur adipisicing elit. Saepe deleniti quibusdam non velit, tempore amet harum fugiat labore reprehenderit nisi minima. Magnam, quisquam sit mollitia ea cupiditate impedit ducimus odit?Lorem ipsum, dolor sit amet consectetur adipisicing elit. Saepe deleniti quibusdam non velit, tempore amet harum fugiat labore reprehenderit nisi minima. Magnam, quisquam sit mollitia ea cupiditate impedit ducimus odit?</p>
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
						@for ($i=0; $i < 10; $i++)
							<div class="build_card" id="build_card">
								<h3>Build Name</h3>
								<p>Specifications:</p>
								<ul>
									<li>Cpu: <div>PlaceHolder</div></li>
									<li>Gpu: <div>PlaceHolder</div></li>
									<li>RAM: <div>PlaceHolder</div></li>
									<li>Storage Capacity: <div>PlaceHolder</div></li>
								</ul>
							</div>
						@endfor
					</div>
					<span class="navigate"> 
						<a id="scrollLeft1" href="#"><i class="fas fa-angle-right"></i></a>
						<a id="endLeft1" href="#"><i class="fas fa-angle-double-right"></i></a>
					</span>
					<script class="por_paso">
						var step = ($("#build_card").outerWidth(true)+4);

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
							@for ($i=0; $i < 10; $i++)
							<div class="build_card" id="build_card">
								<h3>Build Name</h3>
								<p>Specifications:</p>
								<ul>
									<li>Cpu: <div>PlaceHolder</div></li>
									<li>Gpu: <div>PlaceHolder</div></li>
									<li>RAM: <div>PlaceHolder</div></li>
									<li>Storage Capacity: <div>PlaceHolder</div></li>
								</ul>
							</div>
						@endfor
					</div>
					<span class="navigate"> 
						<a id="scrollLeft2" href="#"><i class="fas fa-angle-right"></i></a>
						<a id="endLeft2" href="#"><i class="fas fa-angle-double-right"></i></a>
					</span>
					<script class="por_paso">
						var step = ($("#build_card").outerWidth(true)+4);

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
</body>
<div class="back" id="demo_back" style="display:<?php echo (!empty($errores) || !empty($erroresExiste) || !empty($erroresLogin) || (!empty($logIn) && $logIn["error"] !== "no"))?"block":"none" ?>;" onclick="unlockAll()">

</div>
<div id="invento">

</div>
</html>
