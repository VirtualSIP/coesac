<?php
session_start();
require_once("../../../../connect/conexion.php");
require_once("../../../../connect/function.php");
require_once("../../../../connect/sesion/verificar_sesion.php");

//VARIABLES
$laminas_id=$_REQUEST["id"];
$did=$_REQUEST["did"];
$dart=$_REQUEST["dart"];
$clt=$_REQUEST["clt"];

//ELIMINAR
$rst_eliminar=mysql_query("DELETE FROM syCoesa_datos_tecnicos_laminas_procesos WHERE id_laminas_procesos=$laminas_id;", $conexion);
	
if (mysql_errno()!=0){
	echo "ERROR: ".mysql_errno()." - ".mysql_error();
	mysql_close($conexion);
	header("Location:lista.php?did=$did&dart=$dart&clt=$clt&m=4");
} else {
	mysql_close($conexion);
	header("Location:lista.php?did=$did&dart=$dart&clt=$clt&m=3");
}

?>