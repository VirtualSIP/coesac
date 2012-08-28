<?php
session_start();
require_once("../../../../connect/conexion.php");
require_once("../../../../connect/function.php");
require_once("../../../../connect/sesion/verificar_sesion.php");

//VARIABLES
$laminas_id=$_POST["laminas_id"];
$laminas_articulo=$_POST["laminas_articulo"];
$laminas_mezcla=$_POST["laminas_mezcla"];
$laminas_calculo_kg=$_POST["laminas_calculo_kg"];

//ACTUALIZAR
$rst_guardar=mysql_query("UPDATE syCoesa_datos_tecnicos_laminas_polietileno SET id_articulo=$laminas_articulo,
mezcla_lamina_polietileno=$laminas_mezcla,
calculo_kg_lamina_polietileno=$laminas_calculo_kg WHERE id_lamina_polietileno=$laminas_id;", $conexion);

if (mysql_errno()!=0){
	echo "ERROR: ". mysql_errno() . " - ". mysql_error();
	mysql_close($conexion);
} else {
	mysql_close($conexion);
	header("Location:lista.php?m=2");
}

?>