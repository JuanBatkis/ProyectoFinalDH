<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="icon" href="imagenes/circle.ico">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Add  SOFTWARE</title>
  <style>
    body {
      margin-left: 15px;
    }
    div {
      padding-bottom: 10px;
    }

    .cpu_div, .gpu_div {
      margin-left: 16px;
    }
  </style>
</head>
<body>
  {{--<a href="/gpuList">View Gpu List</a>
  <a href="/cpuForm" style="margin-left: 15%;">Add Cpu</a>
  <a href="/cpuList" style="margin-left: 25px;">View Cpu List</a>--}}
  <a href="/softwareList">View Software List</a>
  <a href="/home" style="float: right; margin-left: 25px;">Return to Page</a>
  <a href="/admin" style="float: right;">Admin Tools</a>

  <h1>Add SOFTWARE</h1>

  <form action="/softwareForm" name="agregarSoftware" method="POST">
    @csrf
    <div>
      <label for="name">Name:</label>
      <input type="text" name="name" value="{{ old('name') }}">
    </div>
    @if(!empty($errors->first('name')))
    <div style="color:crimson; font-size:16px;">{{ $errors->first('name') }}</div>
    @endif
    <div>
      <label for="os_name">Operating System:</label>
      <select name="os_name">
        <option value="windows" <?php if (old('os_name')=='windows') echo "selected";?>>windows</option>
        <option value="macOS" <?php if (old('os_name')=='macOS') echo "selected";?>>macOS</option>
        <option value="linux" <?php if (old('os_name')=='linux') echo "selected";?>>linux</option>
      </select>
    </div>
    @if(!empty($errors->first('os_name')))
      <div style="color:crimson; font-size:16px;">{{ $errors->first('os_name') }}</div>
    @endif
    <div>
      <label for="ram">Ram:</label>
      <select name="ram">
        @for($i=1; $i<=128; $i=$i*2)
          <option value="{{$i}}" <?php if (old('ram')==$i) echo "selected";?>>{{$i}} gb</option>
        @endfor
      </select>
    </div>
    @if(!empty($errors->first('ram')))
      <div style="color:crimson; font-size:16px;">{{ $errors->first('ram') }}</div>
    @endif
    <h3>CPU Info:</h3>
    <div class="cpu_div">
      <div>
        <label for="cpu_brand">Brand:</label>
        <select name="cpu_brand">
          <option value="any" <?php if (old('cpu_brand')=='any') echo "selected";?>>intel and amd</option>
          <option value="intel" <?php if (old('cpu_brand')=='intel') echo "selected";?>>intel</option>
          <option value="amd" <?php if (old('cpu_brand')=='amd') echo "selected";?>>amd</option>
        </select>
      </div>
      @if(!empty($errors->first('cpu_brand')))
        <div style="color:crimson; font-size:16px;">{{ $errors->first('cpu_brand') }}</div>
      @endif
      <div>
        <label for="bit">Bit:</label>
        <input type="radio" name="bit" value="2" checked> both
        <input type="radio" name="bit" value="64" <?php if (old('bit')=='64') echo "checked";?>> 64
        <input type="radio" name="bit" value="32" <?php if (old('bit')=='32') echo "checked";?>> 32
      </div>
      @if(!empty($errors->first('bit')))
        <div style="color:crimson; font-size:16px;">{{ $errors->first('bit') }}</div>
      @endif
      <div>
        <label for="multicore">Multicore:</label>
        <input type="radio" name="multicore" value="no" checked> no
        <input type="radio" name="multicore" value="yes" <?php if (old('multicore')=='yes') echo "checked";?>> yes
      </div>
      @if(!empty($errors->first('multicore')))
        <div style="color:crimson; font-size:16px;">{{ $errors->first('multicore') }}</div>
      @endif
    </div>
    <h3>GPU Info:</h3>
    <div class="gpu_div">
      <div>
        <label for="gpu_brand">Brand:</label>
        <select name="gpu_brand">
          <option value="both" <?php if (old('gpu_brand')=='both') echo "selected";?>>nvidia and amd</option>
          <option value="nvidia" <?php if (old('gpu_brand')=='nvidia') echo "selected";?>>nvidia</option>
          <option value="amd" <?php if (old('gpu_brand')=='amd') echo "selected";?>>amd</option>
          <option value="intel" <?php if (old('gpu_brand')=='intel') echo "selected";?>>intel</option>
          <option value="any" <?php if (old('gpu_brand')=='any') echo "selected";?>>any</option>
        </select>
      </div>
      @if(!empty($errors->first('gpu_brand')))
        <div style="color:crimson; font-size:16px;">{{ $errors->first('gpu_brand') }}</div>
      @endif
      <div>
        <label for="v_ram">v_ram:</label>
        <input type="number" step=".1" name="v_ram" min="0" value="{{ old('v_ram') }}">
      </div>
      @if(!empty($errors->first('v_ram')))
        <div style="color:crimson; font-size:16px;">{{ $errors->first('v_ram') }}</div>
      @endif
      <div>
        <label for="openGl">OpenGL:</label>
        <input type="radio" name="openGl" value="yes" checked> yes
        <input type="radio" name="openGl" value="no" <?php if (old('openGl')=='no') echo "checked";?>> no
      </div>
      @if(!empty($errors->first('openGl')))
        <div style="color:crimson; font-size:16px;">{{ $errors->first('openGl') }}</div>
      @endif
    </div>
    <div>
      <label for="disk">Disk Space:</label>
      <input type="number" step=".1" name="disk" min="0" value="{{ old('disk') }}">
    </div>
    @if(!empty($errors->first('disk')))
      <div style="color:crimson; font-size:16px;">{{ $errors->first('disk') }}</div>
    @endif
    <input type="submit" value="Add" name="submit"/>
  </form>
</body>
</html>