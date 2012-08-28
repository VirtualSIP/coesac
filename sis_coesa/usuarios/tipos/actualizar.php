<?php
session_start();
require_once("../../../connect/conexion.php");
require_once("../../../connect/function.php");
require_once("../../../connect/sesion/verificar_sesion.php");

//VARIABLES
$dtusuario_id=$_POST["usuario_id"];
$dtusuario_nombre=$_POST["usuario_nombre"];
$dtusuario_obs=$_POST["observaciones"];

//ACTUALIZAR
$rst_guardar=mysql_query("UPDATE syCoesa_usuario_tipo SET usuario_tipo='$dtusuario_nombre', observaciones='$dtusuario_obs' 
WHERE id_usuario_tipo='$dtusuario_id';", $conexion);

if (mysql_errno()!=0){
	mysql_close($conexion);
	header("Location:lista.php?m=4");
} else {
	mysql_close($conexion);
	header("Location:lista.php?m=3");
}

?>