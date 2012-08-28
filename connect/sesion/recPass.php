<?php
require_once("../conexion.php");
require_once("../function.php");

//VARIABLES
$recEmail=mysql_real_escape_string($_POST["recoverEmail"]);

//VERIFICAR CORREO
$rst_recEmail=mysql_query("SELECT * FROM syCoesa_usuario WHERE email='".$recEmail."' LIMIT 1;", $conexion);
$num_recEmail=mysql_num_rows($rst_recEmail);

if($num_recEmail==1){
	//VARIABLES DE USUARIO
	$fila_recEmail=mysql_fetch_array($rst_recEmail);
	$recEmail_usuario=$fila_recEmail["usuario"];
	$recEmail_nombre=$fila_recEmail["nombre"];
	$recEmail_pass=codigoAleatorio(10,true,true,false);
	$crypt_pass=hash("sha512", $recEmail_pass);
	$crypt_user=hash("sha256", $recEmail_usuario);
	$pass_final=$crypt_pass.$crypt_user;	
	
	//CAMBIAR CONTRASEÑA POR CLAVE ALEATORIA
	$rst_cmbClave=mysql_query("UPDATE syCoesa_usuario SET clave='".$pass_final."' WHERE usuario='".$recEmail_usuario."';", $conexion);	
	
	//ENVAIR AL CORREO
	$body = '<!DOCTYPE html>
	<html lang="es">
	<head>
	<meta charset="utf-8" />
	<title>'.$web_nombre.'</title>
	<style type="text/css">
		body{ font-family: Arial, Helvetica, sans-serif; font-size: 12px;}
		body{ margin:0;}
	</style>
	</head>
	<body>
	<p><img src="'.$web.'imagenes/logo-coesa.png" height="39" />
	</p>
	<p>Hola <strong>'.$recEmail_nombre.'</strong>,</p>
	<p>Has solicitado la recuperacion de tu contraseña.</p>
	<p>A continuacion te brindamos una contraseña temporal.</p>
	<p>Contraseña: <strong>'.$recEmail_pass.'</strong></p>
	<p><a href="'.$web.'" target="_blank">Inicia sesión</a> con esta nueva contraseña, y para cambiar la contraseña, dirigete a la opción Mi Perfil.</p>
	</body>
	</html>';
	
	$from="soporte@virtualsip.net";
	$asunto=$web_nombre." | Recuperación de contraseña";
	$headers= "From: '".$web_nombre."' <".strip_tags($from)."> \r\n";
	$headers.= "MIME-Version: 1.0\r\n";
	$headers.= "Content-Type: text/html; charset=UTF-8\r\n";

	mail($recEmail, $asunto, $body, $headers);
	
	header("Location: ../../recuperar?msj=1");
}else{
	header("Location: ../../recuperar?msj=2");
}
?>