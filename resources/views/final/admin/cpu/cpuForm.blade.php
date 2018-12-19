<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="icon" href="imagenes/circle.ico">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Add GPU</title>
  <style>
    body {
      margin-left: 15px;
    }
    div {
      padding-bottom: 10px;
    }
  </style>
</head>
<body>
  <a href="/cpuList">View Cpu List</a>
  <a href="/gpuForm" style="margin-left: 15%;">Add Gpu</a>
  <a href="/gpuList" style="margin-left: 25px;">View Gpu List</a>
  <a href="/home" style="float: right; margin-left: 25px;">Return to Page</a>   <a href="/admin" style="float: right;">Admin Tools</a>

  <h1>Add CPU</h1>

  <form action="/cpuForm" name="agregarGpu" method="POST">
    @csrf
    <div>
      <label for="brand">Brand:</label>
      <select name="brand">
        <option value="intel" <?php if (old('brand')=='intel') echo "selected";?>>intel</option>
        <option value="amd" <?php if (old('brand')=='amd') echo "selected";?>>amd</option>
      </select>
    </div>
    @if(!empty($errors->first('brand')))
      <div style="color:crimson; font-size:16px;">{{ $errors->first('brand') }}</div>
    @endif
    <div>
      <label for="name">Name:</label>
      <input type="text" name="name" value="{{ old('name') }}">
    </div>
    @if(!empty($errors->first('name')))
      <div style="color:crimson; font-size:16px;">{{ $errors->first('name') }}</div>
    @endif
    <div>
      <label for="bit_32">32 bit:</label>
      <input type="radio" name="bit_32" value="yes" checked> yes
      <input type="radio" name="bit_32" value="no" <?php if (old('bit_32')=='no') echo "checked";?>> no
    </div>
    @if(!empty($errors->first('bit_32')))
      <div style="color:crimson; font-size:16px;">{{ $errors->first('bit_32') }}</div>
    @endif
    <div>
      <label for="bit_64">64 bit:</label>
      <input type="radio" name="bit_64" value="yes" checked> yes
      <input type="radio" name="bit_64" value="no" <?php if (old('bit_64')=='no') echo "checked";?>> no
    </div>
    @if(!empty($errors->first('bit_64')))
      <div style="color:crimson; font-size:16px;">{{ $errors->first('bit_64') }}</div>
    @endif
    <div>
      <label for="n_cores">Number of Cores:</label>
      <input type="number" name="n_cores" min="1" value="{{ old('n_cores') }}">
    </div>
    @if(!empty($errors->first('n_cores')))
      <div style="color:crimson; font-size:16px;">{{ $errors->first('n_cores') }}</div>
    @endif
    <div>
      <label for="laptop">Laptop:</label>
      <input type="radio" name="laptop" value="no" checked> no
      <input type="radio" name="laptop" value="yes" <?php if (old('laptop')=='yes') echo "checked";?>> yes
    </div>
    @if(!empty($errors->first('laptop')))
      <div style="color:crimson; font-size:16px;">{{ $errors->first('laptop') }}</div>
    @endif
    <div>
      <label for="release_date">Release Date:</label>
      <input type="date" name="release_date" value="{{ old('release_date') }}">
    </div>
    @if(!empty($errors->first('release_date')))
      <div style="color:crimson; font-size:16px;">{{ $errors->first('release_date') }}</div>
    @endif
    <input type="submit" value="Add" name="submit"/>
  </form>
</body>
</html>