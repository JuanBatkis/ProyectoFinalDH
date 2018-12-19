<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Actors</title>
  <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
</head>
<body>
  <h1 style="margin-bottom: 0px;">Search Actors:</h1>
  {{--<ul style="margin-top: 6px;">
      @foreach ($actors as $actor)
        <li>{{ $actor->last_name . ", " . $actor->first_name }}</li>
      @endforeach
  </ul>
  <a href="http://localhost:8000/actores/{{$actors->id}}/info"> {{ $actors->last_name . ", " . $actors->first_name }} </a>--}}

  <form action="/actors" id="actors" name="actors" method="get">
    <div>
        <input type="text" name="name" id="name" value="<?php echo !empty($_GET['name'])? $_GET['name']:"" ?>"/>
        <br>
        <input type="submit" value="search"/>
    </div>
  </form>
  @if(!empty($_GET['name']))
    <ul style="margin-top: 6px;">
        @foreach ($actors as $actor)
          <li>{{ $actor->last_name . ", " . $actor->first_name }}</li>
        @endforeach
    </ul>
  @endif
</body>
</html>