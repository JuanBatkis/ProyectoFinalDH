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
  <title>CPU List</title>
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
    <a href="/cpuForm">Add Cpu</a>
    <a href="/gpuForm" style="margin-left: 15%;">Add Gpu</a>
    <a href="/gpuList" style="margin-left: 25px;">View Gpu List</a>
    <a href="/home" style="float: right; margin-left: 25px;">Return to Page</a>   <a href="/admin" style="float: right;">Admin Tools</a>
    
    <h1 style="margin-bottom: 0px;">CPU List:</h1>

    <form action="/cpuList" method="get">
      <label for="orderBy">Order By:</label>
      <select name="orderBy">
        <option value="id" <?php if ($orderBy=='id') echo "selected";?>>id</option>
        <option value="brand" <?php if ($orderBy=='brand') echo "selected";?>>brand</option>
        <option value="name" <?php if ($orderBy=='name') echo "selected";?>>name</option>
        <option value="n_cores" <?php if ($orderBy=='n_cores') echo "selected";?>>number of cores</option>
        <option value="laptop" <?php if ($orderBy=='laptop') echo "selected";?>>laptop</option>
        <option value="release_date" <?php if ($orderBy=='release_date') echo "selected";?>>release date</option>
      </select>
      <input type="checkbox" name="order" value="inv" <?php if ($order=='inv') echo "checked";?>>invertir
      <input type="submit" value="update">
    </form>
    <br>
    
    <table>
      <tr>
        <th>ID</th>
        <th>BRAND</th>
        <th>NAME</th> 
        <th>32 BIT</th>
        <th>64 BIT</th>
        <th>NUMBER OF CORES</th>
        <th>LAPTOP</th>
        <th>RELEASE DATE</th>
        <th></th>
      </tr>
      @foreach ($cpus as $cpu)
        <tr>
          <td>{{$cpu->id}}</td>
          <td>{{$cpu->brand}}</td>
          <td>{{$cpu->name}}</td>
          <td>@if($cpu->bit_32==1){{'yes'}}@else{{'no'}}@endif</td>
          <td>@if($cpu->bit_64==1){{'yes'}}@else{{'no'}}@endif</td>
          <td>{{$cpu->n_cores}}</td>
          <td>@if($cpu->laptop==1){{'yes'}}@else{{'no'}}@endif</td>
          <td>{{$cpu->release_date}}</td>
          <td><a href="/cpuEdit/{{$cpu->id}}">edit</a></td>
        </tr>
      @endforeach
    </table>
</body>
</html>