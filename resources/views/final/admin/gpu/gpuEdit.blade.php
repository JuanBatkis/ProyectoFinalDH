<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="icon" href="/imagenes/circle.ico">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Edit GPU</title>
  <style>
    body {
      margin-left: 15px;
    }
    div {
      padding-bottom: 10px;
    }
    h1, h5 {
      display: inline-block;
    }
  </style>
</head>
<body>
  <a href="/gpuList">View Gpu List</a>
  <a href="/gpuForm" style="margin-left: 15%;">Add Gpu</a>
  <a href="/cpuForm" style="margin-left: 25px;">Add Cpu</a>
  <a href="/cpuList" style="margin-left: 25px;">View Cpu List</a>
  <a href="/home" style="float: right; margin-left: 25px;">Return to Page</a>
  <a href="/admin" style="float: right;">Admin Tools</a>

  <div><h1>Edit GPU</h1><h5> → ({{ $gpu->name }})</h5></div>

  <form action="/gpuEdit/{{$gpu->id}}" name="EditarGpu" method="POST">
    @csrf
    <div>
      <label for="brand">Brand:</label>
      <select name="brand">
        <option value="nvidia" <?php if ($gpu->brand=='nvidia') echo "selected";?>>nvidia</option>
        <option value="amd" <?php if ($gpu->brand=='amd') echo "selected";?>>amd</option>
        <option value="intel" <?php if ($gpu->brand=='intel') echo "selected";?>>intel</option>
      </select>
    </div>
    @if(!empty($errors->first('brand')))
      <div style="color:crimson; font-size:16px;">{{ $errors->first('brand') }}</div>
    @endif
    <div>
      <label for="name">Name:</label>
      <input type="text" name="name" value="{{ $gpu->name }}">
    </div>
    @if(!empty($errors->first('name')))
      <div style="color:crimson; font-size:16px;">{{ $errors->first('name') }}</div>
    @endif
    <div>
      <label for="v_ram">v_ram:</label>
      <input type="number" name="v_ram" min="1" value="{{ $gpu->v_ram }}">
    </div>
    @if(!empty($errors->first('v_ram')))
      <div style="color:crimson; font-size:16px;">{{ $errors->first('v_ram') }}</div>
    @endif
    <div>
      <label for="openGl">OpenGL:</label>
      <input type="radio" name="openGl" value="yes" checked> yes
      <input type="radio" name="openGl" value="no" <?php if ($gpu->openGl=='0') echo "checked";?>> no
    </div>
    @if(!empty($errors->first('openGl')))
      <div style="color:crimson; font-size:16px;">{{ $errors->first('openGl') }}</div>
    @endif
    <div>
      <label for="laptop">Laptop:</label>
      <input type="radio" name="laptop" value="no" checked> no
      <input type="radio" name="laptop" value="yes" <?php if ($gpu->laptop=='1') echo "checked";?>> yes
    </div>
    @if(!empty($errors->first('laptop')))
      <div style="color:crimson; font-size:16px;">{{ $errors->first('laptop') }}</div>
    @endif
    <div>
      <label for="release_date">Release Date:</label>
      <input type="date" name="release_date" value="{{ $gpu->release_date }}">
    </div>
    @if(!empty($errors->first('release_date')))
      <div style="color:crimson; font-size:16px;">{{ $errors->first('release_date') }}</div>
    @endif
    <input type="submit" value="Edit" name="submit"/>
  </form>
</body>
</html>