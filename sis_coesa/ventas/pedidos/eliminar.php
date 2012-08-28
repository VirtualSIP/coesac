<?php
session_start();
require_once("../../../connect/conexion.php");
require_once("../../../connect/function.php");
require_once("../../../connect/sesion/verificar_sesion.php");

//VARIABLES
$pedido_id=$_REQUEST["id"];

//ELIMINAR
$rst_eliminar=mysql_query("DELETE FROM syCoesa_pedidos WHERE id_pedido=$pedido_id;", $conexion);
	
if (mysql_errno()!=0){
	echo "ERROR: ".mysql_errno()." - ".mysql_error();
	mysql_close($conexion);
	header("Location:lista.php?m=6");
} else {
	mysql_close($conexion);
	header("Location:lista.php?m=5");
}

?>