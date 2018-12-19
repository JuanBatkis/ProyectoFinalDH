<?php

  $movies_paginate = $movies->actors()->paginate(1);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
  <title>{{ $movies->title }}</title>
  <style>
    body {
      margin: 25px;
    }
    .actors_list {
      margin-bottom: 75px;
    }
  </style>
</head>
<body>
  <h1>{{ $movies->title }}</h1>
  <ul class="actors_list">
    @foreach($movies_paginate as $actor)
      <li>{{$actor->last_name}}, {{$actor->first_name}}</li>
    @endForeach
  </ul>
  {{ $movies_paginate->links() }}

  <a href="/listaPelicula">Back to list</a>

</body>
</html>