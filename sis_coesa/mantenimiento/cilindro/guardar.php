<?php
session_start();
require_once("../../../connect/conexion.php");
require_once("../../../connect/function.php");
require_once("../../../connect/sesion/verificar_sesion.php");

//VARIABLES
$cilindro=$_POST["cilindro"];
$engranaje=$_POST["engranaje"];
$cilindro_observaciones=$_POST["cilindro_observaciones"];

//GUARDAR
$rst_guardar=mysql_query("INSERT INTO syCoesa_mantenimiento_cilindro (cilindro, engranaje, observaciones_cilindro)
VALUES ($cilindro, $engranaje, '$cilindro_observaciones')", $conexion);

if (mysql_errno()!=0){
	mysql_close($conexion);
	header("Location:lista.php?m=2");
} else {
	mysql_close($conexion);
	header("Location:lista.php?m=1");
}

?>