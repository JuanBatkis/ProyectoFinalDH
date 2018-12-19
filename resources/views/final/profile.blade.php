<!DOCTYPE html>
<html>
<head>
	<link rel="icon" href="/imagenes/icon_thicc.ico">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css" integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
	<link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:100,300,400,500,700,800,900" rel="stylesheet">
  <link rel="stylesheet" href="\css\homeProfile.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<title>YPC</title>

	
</head>
<body id="body">
  <div class="total_background"></div>
  <div id="all">
		<div class="top">
			<nav>
				<div class="name">
					<a href="/home" class="name-link"><img src="\imagenes\NewLogo_long_thicc_400.png" alt="logo" class="main_logo" draggable="false"></a>
				</div>
        <div class="log-block">								
          <a id="user-name" href="/profile/{{\Auth::user()->id}}" class="user-name user-name-col" style="user-select: none;text-decoration: underline;text-decoration-color: rgba(61, 95, 219, 0);"> {{ \Auth::user()->name }} </a>
        </div>
			</nav>
    </div>
    <div class="main_settings">
      <div class="main_settings2">
        <h2 class="title_settings">Your Builds:</h2>
        <div class="all_builds">
          @if(empty($builds))
            <div><p>You haven't made any builds yet</p></div>
          @else
            @foreach($builds as $build)
              <div class="build_card" id="build_card">
                <h3>{{$build->build_name}}</h3>
                <p class="specifications">Specifications:</p>
                <ul>
                  <li>Operating System: <div>{{ucfirst($build->op_system) . '.'}}</div></li>
                  <div id="duda_ram{{$build->id}}" class="duda_ram" ><p>RAM memory modules usually only come in capacities of 1, 2, 4, 8, 16, 32, 64 or 128 gb.</p><div class="bubble_arrow"></div></div>
                  <?php 
                    $pack_ram=1;
                    while ($pack_ram < $build->ram) {
                        $pack_ram= $pack_ram*2;
                    }
                  ?>
                  <li>RAM: <i id="{{$build->id}}" class="far fa-question-circle" onmouseover="duda_ram('in', this.id)" onmouseout="duda_ram('out', this.id)"></i><div>{{'Your programs will use ' . $build->ram . " gb. You'll need to get a " . $pack_ram . ' gb kit.'}}</div></li>
                  <li>CPU brand: <div>
                      @if($build->cpu_brand=='any')
                        {{'Intel or AMD'}}
                      @else
                        {{ucfirst($build->cpu_brand) . '.'}}
                      @endif
                  </div></li>
                  <li>System bit: <div>
                    @if($build->bit==2)
                      {{'32 or 64 bit.'}}
                    @else
                      {{$build->bit . ' bit.'}}
                    @endif
                  </div></li>
                  <li>Multicore processor: <div>
                    @if($build->multicore==1)
                      {{'Yes.'}}
                    @else
                      {{'No.'}}
                    @endif
                  </div></li>
                  <li>GPU brand: <div>
                    @switch($build->gpu_brand)
                      @case('any')
                        {{'Nvidia, Intel or AMD.'}}
                        @break
                      @case('intel')
                        {{'Intel.'}}
                        @break
                      @case('amd')
                        {{'AMD.'}}
                        @break
                      @case('both')
                        {{'Nvidia or AMD.'}}
                        @break
                      @case('nvidia')
                        {{'Nvidia.'}}
                        @break
                    @endswitch
                  </div></li>
                  <li>VRAM: <div>{{$build->v_ram . ' gb.'}}</div></li>
                  <li>Graphics card with OpenGL: <div>
                    @if($build->openGl==1)
                      {{'Yes.'}}
                    @else
                      {{'No.'}}
                    @endif
                  </div></li>
                  <li>Storage Capacity: <div>{{$build->disk . ' gb.'}}</div></li>
                </ul>
              </div>
            @endforeach
          @endif
        </div>
      </div>
    </div>
  </div>
</body>
<script>
  function duda_ram($do, $id){
    if ($do=='in') {
      document.getElementById('duda_ram'+$id).style= "display: block;";
    } else{
      document.getElementById('duda_ram'+$id).style= "display: none;";
    }
  }
</script>
</html>