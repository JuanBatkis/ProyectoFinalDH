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
  <link rel="stylesheet" href="css\homeSettings.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<title>YPC</title>

	
</head>
<body id="body">
  <div id="all">
		<div class="top">
			<nav>
				<div class="name">
					<a href="home" class="name-link"><img src="imagenes\NewLogo_long_thicc_400.png" alt="logo" class="main_logo" draggable="false"></a>
				</div>
        <div class="log-block">								
          <a id="user-name" href="/profile/{{\Auth::user()->id}}" class="user-name user-name-col" style="user-select: none;text-decoration: underline;text-decoration-color: rgba(61, 95, 219, 0);"> {{ \Auth::user()->name }} </a>
        </div>
			</nav>
    </div>
    <div class="main_settings">
      <div class="main_settings2">
        <h2 class="title_settings">Settings</h2>
        <form class="username_settings" action="/settings" method="post">
          @csrf
          <input type="hidden" name="id" value="{{ \Auth::user()->id }}">
          <input type="hidden" name="type" value="name">
          <h3>Username</h3>
          <div>Current username:  <strong>{{ \Auth::user()->name }}</strong></div>
          <label for="name">New username: </label>
          <input type="text" name="name" id="username" value='{{ old('name') }}'>

          <input type="submit" name="send" class="change" value="Change">
        </form>
        <br>
        <form class="username_settings" action="/settings" method="post">
            @csrf
            <input type="hidden" name="id" value="{{ \Auth::user()->id }}">
            <input type="hidden" name="type" value="password">
            <h3>Password</h3>
            <label for="current_pass">Current password: </label>
            <input type="password" name="current_pass" value=''>
            <label for="new_pass">New password: </label>
            <input type="password" name="new_pass" value=''>
            <label for="conf_pass">Confirm password: </label>
            <input type="password" name="conf_pass" value=''>

            <input type="submit" name="send" class="change" value="Change">
        </form>
      </div>
      <div class="logo_back">
        
      </div>
    </div>
  </div>
</body>
</html>