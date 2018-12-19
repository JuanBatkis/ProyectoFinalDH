<?php
  if(!isset($_GET['orderBy'])) {
    $_GET['orderBy']='id';
  }
  if(!isset($_GET['order'])) {
    $_GET['order']='norm';
  }
  $orderBy=$_GET['orderBy'];
  $order=$_GET['order'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="icon" href="imagenes/circle.ico">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>SOFTWARE List</title>
  <style>
    body {
      margin-left: 15px;
    }
    div {
      padding-bottom: 10px;
    }
    input {
      margin-left: 10px;
    }
    ul {
      margin: 0;
      padding-left: 20px;
    }
    table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
    }

    td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #dddddd;
    }
  </style>
</head>
<body>
    <a href="/softwareForm">Add Software</a>
    <a href="/home" style="float: right; margin-left: 25px;">Return to Page</a>
    <a href="/admin" style="float: right;">Admin Tools</a>

    <h1 style="margin-bottom: 0px;">SOFTWARE List:</h1>

    <form action="/softwareList" method="get">
      <label for="orderBy">Order By:</label>
      <select name="orderBy">
        <option value="software_id" <?php if ($orderBy=='software_id') echo "selected";?>>id</option>
        <option value="os_name" <?php if ($orderBy=='os_name') echo "selected";?>>os</option>
      </select>
      <input type="checkbox" name="order" value="inv" <?php if ($order=='inv') echo "checked";?>>invertir
      <input type="submit" value="update">
    </form>
    <br>
    
    <table>
      <tr>
        <th>ID</th>
        <th>NAME</th>
        <th>+OS</th>
        <th>OS</th>
        <th>RAM</th>
        <th>CPU BRAND</th>
        <th>BIT</th>
        <th>MULTICORE</th>
        <th>GPU BRAND</th>
        <th>V RAM</th>
        <th>OPEN GL</th>
        <th>DISK</th>
        <th></th>
      </tr>
      @foreach ($op_systems as $op_system)
        <tr>
          <td>{{$op_system->softwares->id}}</td>
          <td>{{$op_system->softwares->name}}</td>
          <td><a href="/softwareAdd/{{$op_system->id}}">add</a></td>
          <td>
            {{$op_system->os_name}}
          </td>
          <td>
            {{$op_system->requirements->ram}} gb
          </td>
          <td>
            {{$op_system->requirements->soft_cpus->cpu_brand}}
          </td>
          <td>
            @if($op_system->requirements->soft_cpus->bit==2){{'32 & 64'}}@else{{$op_system->requirements->soft_cpus->bit}}@endif
          </td>
          <td>
            @if($op_system->requirements->soft_cpus->multicore==1){{'yes'}}@else{{'no'}}@endif
          </td>
          <td>
            {{$op_system->requirements->soft_gpus->gpu_brand}}
          </td>
          <td>
            {{$op_system->requirements->soft_gpus->v_ram}} gb
          </td>
          <td>
            @if($op_system->requirements->soft_gpus->openGl==1){{'yes'}}@else{{'no'}}@endif
          </td>
          <td>
            {{$op_system->requirements->disk}} gb
          </td>
          <td><a href="/softwareEdit/{{$op_system->id}}">edit</a></td>
        </tr>
      @endforeach
    </table>
</body>
</html>