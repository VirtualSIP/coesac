<?php
//VARIABLES
$nosesion=$_REQUEST["msj"];

//MENSAJES
if($nosesion==1){
	$mensaje="Una contraseña temporal fue enviada a tu correo electrónico.";
}elseif($nosesion==2){
	$mensaje="No hay ningun usuario registrado con ese email.";
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <title>COESA - Recuperar contraseña</title>
    
    <!-- Our CSS stylesheet file -->
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
        <form id="recover" method="post" action="connect/sesion/recPass.php">
            <input type="text" name="recoverEmail" id="recoverEmail" />
            <button class="login_sesion">Recuperar Contraseña</button>
        </form>
</div>
<div id="formTexto">
	<p><a href="/">Iniciar sesión</a></p>
</div>

<div id="formTexto">
	<p><?php echo $mensaje; ?></p>
</div>
   
</body>
</html>

