<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Agregar Imagen</title>
</head>
<body>
    <form action="/imagen/agregar" id="agregarImagen" name="agregarImagen" method="POST" enctype="multipart/form-data">
      @csrf
      <div>
        <input type="file" name="imagen" id="imagen"/>
      </div>
      <input type="submit" value="Agregar Imagen" name="submit"/>
    </form>
</body>
</html>