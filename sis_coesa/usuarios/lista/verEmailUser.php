<?php
session_start();
require_once("../../../connect/conexion.php");
require_once("../../../connect/function.php");
require_once("../../../connect/sesion/verificar_sesion.php");

//VARIABLES POST
$verEmail=$_POST["email"];
$verUser=$_POST["usuario"];
$verTipo=$_POST["tipo"];

if($verTipo=="email"){
	$rst_verEmail=mysql_query("SELECT email FROM syCoesa_usuario WHERE email='$verEmail' LIMIT 1;", $conexion);
	$num_verEmail=mysql_num_rows($rst_verEmail);
	if($num_verEmail==1){
?>
	<img src="/imagenes/icons/icon-problema.png" width="24" height="24" title="El Email ya existe.">
<?php }}
if($verTipo=="usuario"){
	$rst_verUser=mysql_query("SELECT usuario FROM syCoesa_usuario WHERE usuario='$verUser' LIMIT 1;", $conexion);
	$num_verUser=mysql_num_rows($rst_verUser);
	if($num_verUser==1){
?>
	<img src="/imagenes/icons/icon-problema.png" width="24" height="24" title="El usuario ya existe.">
<?php }} ?>