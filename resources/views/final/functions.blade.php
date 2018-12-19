<?php 
  if (isset($_POST["register"])) {
    if ($_POST["register"] == "true") {
      function validarDatos($datos){
        $errores=[];
        $uppercase = preg_match('@[a-zA-Z0-9]@', $datos["password"]);
        
        // var_dump($uppercase);exit;
        // $lowercase = preg_match('@[a-z]@', $datos["password"]);
        // $number    = preg_match('@[0-9]@', $datos["password"]);
        if ($datos["username"]==""){
          $errores["user"]= "Please, enter a username";
        }
  
        if ($datos["email"]=="") {
          $errores["email"]= "Please, enter your email";
        }elseif (filter_var($datos["email"],FILTER_VALIDATE_EMAIL)==false) {
          $errores["email"]="Please, enter a valid email";
        }
        
        if ($datos["password"]=="") {
          $errores["password"]= "Please, enter a password";
        } 
        
        if ($datos["cpassword"]=="") {
          $errores["cpassword"]= "Please, confirm your password";
        }elseif ($datos["password"]!=$datos["cpassword"]) {
          $errores["match"]= "Passwords don't match, please try again";
        }

        if (!isset($datos["acepto"])) {
          $errores["acepto"]= "yes";
        } 
  
        return $errores;
      }
    }
  }
  
  if (isset($_POST["logIn"])) {
    if ($_POST["logIn"] == "true") {
      function validarLogin($datos){
        $errores_LogIn = [];
        if($datos["username"]==""){
          $errores_LogIn["username"]="Please, enter your username";
        }
        if ($datos["password"]=="") {
          $errores_LogIn["password"]= "Please, enter your password";
        }
        return $errores_LogIn;
      }
    }
  }

  if (isset($_POST["register"])) {
    if ($_POST["register"] == "true") {
      function yaExiste($datos){
        $erroresExiste=[];
        $usuarios = file_get_contents("usuario.json");
        $usuarios = json_decode($usuarios,true);
        $usuarios = $usuarios["usuarios"];
        for ($i=0; $i < count($usuarios); $i++) { 
          $user= json_decode($usuarios[$i],true);
          if ($datos["username"]==$user["usuario"]) {
            $erroresExiste["username"]="That username already exists, please try another one";
          }
          if ($datos["email"]==$user["email"]) {
            $erroresExiste["email"] ="That email is already in use, if you have forgotten your password, please reset it";
          }
          }
          return $erroresExiste;
      }
    }
  }

    function crearUsuario ($datos){
      return [
        "usuario" => $datos["username"],
        "email" => $datos["email"],
        "password" => password_hash($datos["password"],PASSWORD_DEFAULT),
      ];
    }

    function guardarUsuario ($usuario){
    $usuarios = file_get_contents("usuario.json");
    $arrayUsuarios = json_decode ($usuarios,true);
    $json = json_encode($usuario);
    $arrayUsuarios["usuarios"][] = $json;
    $arrayUsuarios = json_encode($arrayUsuarios);
    file_put_contents("usuario.json",$arrayUsuarios);
    }

    function subirArchivo ($file){
      $directory = "img/";
      $filecount = 0;
      $files = glob($directory . "*.{jpg,png,gif}",GLOB_BRACE);
      if ($files){
      $filecount = count($files);
      }

      if ($file["archivo"]["error"] === UPLOAD_ERR_OK) {
        $nombre = $file["archivo"]["name"];
        $archivo = $file["archivo"]["tmp_name"];
        $ext = pathinfo($nombre,  PATHINFO_EXTENSION);

        $miArchivo = dirname(__FILE__);
        $miArchivo = $miArchivo . "\\" . "img" . "\\";
        $miArchivo = $miArchivo . "archivoNuevo" . "_" . "$filecount" . "." . $ext;

        move_uploaded_file($archivo, $miArchivo);
      }

      //$nombre = $_FILES["archivo"]["name"];
      //$archivo = $_FILES["archivo"]["tmp_name"];
      //move_uploaded_file("img/".$archivo, $nombre);
    }

  if (isset($_POST["logIn"])) {
    if ($_POST["logIn"] == "true" || $_POST["logIn"] == "Sign Up!") {
      function loginUsuario($datos){
        $conf_logIn = [];
        $errores_conf_logIn = [];
        $usuarios = file_get_contents("usuario.json");
        $usuarios = json_decode($usuarios,true);
        $usuarios = $usuarios["usuarios"];
        
        for ($i=0; $i < count($usuarios); $i++) {
          $user= json_decode($usuarios[$i],true);
          if ($datos["username"]==$user["usuario"]) {
            $conf_logIn["username"] = "true";
          } else {
            $conf_logIn["username"] = "false";
          }
          if (password_verify($datos["password"],$user["password"])) {
            $conf_logIn["password"] = "true";
          } else {
            $conf_logIn["password"] = "false";
          }
          if ($conf_logIn["username"] == "true" && $conf_logIn["password"] == "true") {
            $errores_conf_logIn["error"] = "no";
          } else {
            $errores_conf_logIn["error"] = "Incorrect username or password, please try again";
          }
          if ($conf_logIn["username"] == "true" && $conf_logIn["password"] == "true" && $errores_conf_logIn["error"] == "no") {
            return $errores_conf_logIn;
            exit;
          }
        }
        return $errores_conf_logIn;
      }
    }
  }

