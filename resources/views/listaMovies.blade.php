<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Movies</title>
  <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
  <style>
    body {
      margin: 25px;
    }
    .movies_list {
      margin-bottom: 75px;
    }
  </style>
</head>
<body>
  <h1 style="margin-bottom: 0px;">Search Movies:</h1>
  <ul class="movies_list" style="margin-top: 6px;">
      @foreach ($movies as $movie)
        <li><a href="/movie/{{$movie->id}}"> {{ $movie->title }}</li>
      @endforeach
  </ul>
  {{--<a href="http://localhost:8000/actores/{{$actors->id}}/info"> {{ $actors->last_name . ", " . $actors->first_name }} </a>--}}
</body>
</html>