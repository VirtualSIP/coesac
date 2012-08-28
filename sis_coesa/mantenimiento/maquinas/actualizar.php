<?php
session_start();
require_once("../../../connect/conexion.php");
require_once("../../../connect/function.php");
require_once("../../../connect/sesion/verificar_sesion.php");

//VARIABLES
$maquina_id=$_POST["maquina_id"];
$maquina_nombre=$_POST["maquina_nombre"];

//ACTUALIZAR
$rst_guardar=mysql_query("UPDATE syCoesa_mantenimiento_maquinas SET nombre_maquina='$maquina_nombre' WHERE id_maquina=$maquina_id;", $conexion);

if (mysql_errno()!=0){
	mysql_close($conexion);
	header("Location:lista.php?m=4");
} else {
	mysql_close($conexion);
	header("Location:lista.php?m=3");
}

?>