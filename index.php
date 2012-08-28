<?php
//VARIABLES
$nosesion=$_REQUEST["nosesion"];

//MENSAJES
if($nosesion==1){
	$mensaje="Inicie sesion para ingresar al sistema.";
}elseif($nosesion==2){
	$mensaje="Los datos ingresados no coinciden.";
}elseif($nosesion==3){
	$mensaje="Se cerro sesión.";
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="robots" content="noindex, nofollow" />
    <title>COESA - Iniciar sesión</title>
    
    <link rel="stylesheet" href="css/estilos_login.css" />
    
    <!--[if lt IE 9]>
      <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

	<style type="text/css">
		body,td,th {
			font-family: "Segoe UI", Arial, sans-serif;
		}
    </style>
</head>

<body>

<div id="formContainer">
        <form id="login" method="post" action="/connect/sesion/verificar.php">
            <input type="text" name="loginUser" id="loginUser" value="" />
            <input type="password" name="loginPass" id="loginPass" value="" />
            <button class="login_sesion">Iniciar sesión</button>
  		</form>
</div>

<div id="formTexto">
	<p><a href="recuperar">Recuperar contraseña</a></p>
</div>

<div id="formTexto">
	<p><?php echo $mensaje; ?></p>
</div>
   
</body>
</html>

