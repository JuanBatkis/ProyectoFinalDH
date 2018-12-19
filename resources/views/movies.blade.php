<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Movies</title>
</head>
<body>
  <h1>{{ $genres->name }}</h1>

  <ul>
    @foreach($genres->movies as $movie)
      <li><a href="/movie/{{$movie->id}}">{{ $movie->title }}</a></li>
    @endforeach
  </ul>
</body>
</html>