<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Movies</title>
</head>
<body>
  <h1>{{ $movies->title }}</h1>

  <ul>
        <li><a href="/genre/{{$movies->genres->id}}">{{ $movies->genres->name }}</a></li>
    </ul>
  
  {{--<ul>
    @foreach($movies->genres as $genre)
      <li><a href="/genre/{{$genre->id}}">{{ $genre->name }}</a></li>
    @endforeach
  </ul>--}}
</body>
</html>