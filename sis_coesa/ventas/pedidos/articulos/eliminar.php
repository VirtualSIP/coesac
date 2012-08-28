<?php
session_start();
require_once("../../../../connect/conexion.php");
require_once("../../../../connect/function.php");
require_once("../../../../connect/sesion/verificar_sesion.php");

//VARIABLES
$articulo_id=$_REQUEST["id"];
$articulo_cliente=$_REQUEST["clt"];
$pedido=$_REQUEST["pedido"];

//ELIMINAR
$rst_eliminar=mysql_query("DELETE FROM syCoesa_pedidos_articulos WHERE id_pedido_articulo=$articulo_id;", $conexion);
	
if (mysql_errno()!=0){
	//echo "ERROR: ".mysql_errno()." - ".mysql_error();
	mysql_close($conexion);
	header("Location:lista.php?id=$pedido&clt=$articulo_cliente&m=4");
} else {
	mysql_close($conexion);
	header("Location:lista.php?id=$pedido&clt=$articulo_cliente&m=3");
}

?>