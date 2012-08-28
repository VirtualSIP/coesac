<?php
session_start();
require_once("../../../connect/conexion.php");
require_once("../../../connect/function.php");
require_once("../../../connect/sesion/verificar_sesion.php");

//VARIABLES
$pedido_cliente=$_POST["pedido_cliente"];

//GUARDAR
$rst_guardar=mysql_query("INSERT INTO syCoesa_pedidos (id_cliente)
VALUES ($pedido_cliente)", $conexion);

if (mysql_errno()!=0){
	echo "ERROR: ". mysql_errno() . " - ". mysql_error();
	mysql_close($conexion);
} else {
	mysql_close($conexion);
	header("Location:lista.php?m=1");
}

?>