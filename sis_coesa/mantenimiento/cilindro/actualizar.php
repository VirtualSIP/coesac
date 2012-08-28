<?php
session_start();
require_once("../../../connect/conexion.php");
require_once("../../../connect/function.php");
require_once("../../../connect/sesion/verificar_sesion.php");

//VARIABLES
$cilindro_id=$_POST["cilindro_id"];
$cilindro=$_POST["cilindro"];
$engranaje=$_POST["engranaje"];
$cilindro_observaciones=$_POST["cilindro_observaciones"];

//DATOS USUARIO
$dato_fecha=$fechaActual;
$dato_usuario=$usuario_user;

//ACTUALIZAR
$rst_guardar=mysql_query("UPDATE syCoesa_mantenimiento_cilindro SET cilindro=$cilindro, 
engranaje=$engranaje, observaciones_cilindro='$cilindro_observaciones',
dato_fecha='$dato_fecha', dato_usuario='$dato_usuario' WHERE id_cilindro=$cilindro_id;", $conexion);

if (mysql_errno()!=0){
	mysql_close($conexion);
	header("Location:lista.php?m=4");
} else {
	mysql_close($conexion);
	header("Location:lista.php?m=3");
}

?>