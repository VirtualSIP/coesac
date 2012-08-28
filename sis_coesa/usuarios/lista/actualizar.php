<?php
session_start();
require_once("../../../connect/conexion.php");
require_once("../../../connect/function.php");
require_once("../../../connect/sesion/verificar_sesion.php");

//VARIABLES
$dtusuario_id=$_POST["usuario_id"];
$dtusuario_nombre=$_POST["usuario_nombre"];
$dtusuario_apellidos=$_POST["usuario_apellido"];
$dtusuario_email=$_POST["usuario_email"];
$dtusuario_pass=$_POST["dt_pass"];
$dtusuario_tipo=$_POST["tipo_usuario"];
$dtusuario_estado=$_POST["estado"];

//VERIFICAR CONTRASEÑA DE USUARIO
$rst_ver=mysql_query("SELECT * FROM syCoesa_usuario WHERE usuario='$dtusuario_id';", $conexion);
$fila_ver=mysql_fetch_array($rst_ver);

if($dtusuario_pass<>""){
	$crypt_pass = hash("sha512", $dtusuario_pass);
	$crypt_user = hash("sha256", $dtusuario_id);
	$dtusuario_passfinal=$crypt_pass.$crypt_user;
}else{
	$dtusuario_passfinal=$fila_ver["clave"];
}

if($dtusuario_estado=="A"){
	$dtusuario_error=0;
}else{
	$dtusuario_error=$fila_ver["error_sesion"];
}

//ACTUALIZAR
$rst_guardar=mysql_query("UPDATE syCoesa_usuario SET nombre='$dtusuario_nombre', apellidos='$dtusuario_apellidos', email='$dtusuario_email', 
clave='$dtusuario_passfinal', estadoErrorSession='$dtusuario_estado', tipo_acceso=$dtusuario_tipo, error_sesion=$dtusuario_error WHERE usuario='$dtusuario_id';", $conexion);

if (mysql_errno()!=0){
	mysql_close($conexion);
	header("Location:lista.php?m=4");
} else {
	mysql_close($conexion);
	header("Location:lista.php?m=3");
}

?>