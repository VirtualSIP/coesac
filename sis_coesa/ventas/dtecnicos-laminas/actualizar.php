<?php
session_start();
require_once("../../../connect/conexion.php");
require_once("../../../connect/function.php");
require_once("../../../connect/sesion/verificar_sesion.php");

//VARIABLES
$laminas_id=$_POST["laminas_id"];
$laminas_articulo=$_POST["laminas_articulo"];
$laminas_ancho=$_POST["laminas_ancho"];
$laminas_grm2=$_POST["laminas_grm2"];
$laminas_calculo_kg=$_POST["laminas_calculo_kg"];

//ACTUALIZAR
$rst_guardar=mysql_query("UPDATE syCoesa_datos_tecnicos_laminas SET id_articulo=$laminas_articulo,
ancho_lamina=$laminas_ancho,
grm2_lamina=$laminas_grm2,
calculo_kg_lamina=$laminas_calculo_kg WHERE id_lamina=$laminas_id;", $conexion);

if (mysql_errno()!=0){
	echo "ERROR: ". mysql_errno() . " - ". mysql_error();
	mysql_close($conexion);
} else {
	mysql_close($conexion);
	header("Location:lista.php?m=2");
}

?>