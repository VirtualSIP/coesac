<?php
session_start();
require_once("../../../connect/conexion.php");
require_once("../../../connect/function.php");
require_once("../../../connect/sesion/verificar_sesion.php");

//VARIABLES
$laminas_articulo=$_POST["laminas_articulo"];
$laminas_mezcla=$_POST["laminas_mezcla"];
$laminas_calculo_kg=$_POST["laminas_calculo_kg"];

//GUARDAR
$rst_guardar=mysql_query("INSERT INTO syCoesa_datos_tecnicos_laminas_polietileno (id_articulo,
mezcla_lamina_polietileno,
calculo_kg_lamina_polietileno)
VALUES ($laminas_articulo,
$laminas_mezcla,
$laminas_calculo_kg)", $conexion);

if (mysql_errno()!=0){
	echo "ERROR: ". mysql_errno() . " - ". mysql_error();
	mysql_close($conexion);
} else {
	mysql_close($conexion);
	header("Location:lista.php?m=1");
}

?>