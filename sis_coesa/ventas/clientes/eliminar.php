<?php
session_start();
require_once("../../../connect/conexion.php");
require_once("../../../connect/function.php");
require_once("../../../connect/sesion/verificar_sesion.php");

//VARIABLES
$cliente_id=$_REQUEST["id"];

//ELIMINAR
$rst_eliminar=mysql_query("DELETE FROM syCoesa_clientes WHERE id_cliente=$cliente_id;", $conexion);
	
if (mysql_errno()!=0){
	mysql_close($conexion);
	header("Location:lista.php?m=6");
} else {
	mysql_close($conexion);
	header("Location:lista.php?m=5");
}

?>