<?php
session_start();
require_once("../../../connect/conexion.php");
require_once("../../../connect/function.php");
require_once("../../../connect/sesion/verificar_sesion.php");

//VARIABLES
$dtecnicos_id=$_REQUEST["id"];
$dtecnicos_art=$_REQUEST["art"];

//ELIMINAR
$rst_eliminar=mysql_query("DELETE FROM syCoesa_datos_tecnicos WHERE id_datos_tecnicos=$dtecnicos_id;", $conexion);

$rst_eliminar_art=mysql_query("DELETE FROM syCoesa_articulo WHERE id_articulo=$dtecnicos_art;", $conexion);
	
if (mysql_errno()!=0){
	mysql_close($conexion);
	header("Location:lista.php?m=6");
} else {
	mysql_close($conexion);
	header("Location:lista.php?m=5");
}

?>