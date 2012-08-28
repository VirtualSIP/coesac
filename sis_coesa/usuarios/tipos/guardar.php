<?php
session_start();
require_once("../../../connect/conexion.php");
require_once("../../../connect/function.php");
require_once("../../../connect/sesion/verificar_sesion.php");
require_once("../../../connect/sesion/PasswordHash.php");

//VARIABLES
$dtusuario_nombre=$_POST["usuario_nombre"];
$dtusuario_apellido=$_POST["usuario_apellidos"];
$dtusuario_email=$_POST["usuario_email"];
$dtusuario_user=$_POST["dt_usuario"];
$dtusuario_pass=$_POST["dt_pass"];
$dtusuario_usuario_tipo=$_POST["tipo_usuario"];
$dtusuario_estado="A";
$crypt_pass = hash("sha512", $dtusuario_pass);
$crypt_user = hash("sha256", $dtusuario_user);
$pass=$crypt_pass.$crypt_user;

//GUARDAR
$rst_guardar=mysql_query("INSERT INTO syCoesa_usuario (usuario, 
clave, 
nombre,
apellidos,
email,
estadoErrorSession,
tipo_acceso)
VALUES ('$dtusuario_user',
'$pass',
'$dtusuario_nombre',
'$dtusuario_apellido',
'$dtusuario_email',
'$dtusuario_estado',
$dtusuario_usuario_tipo)", $conexion);

if (mysql_errno()!=0){
	mysql_close($conexion);
	header("Location:lista.php?m=2");
} else {
	mysql_close($conexion);
	header("Location:lista.php?m=1");
}

?>