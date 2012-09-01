<?php
session_start();
require_once("../../../../connect/conexion.php");
require_once("../../../../connect/function.php");
require_once("../../../../connect/sesion/verificar_sesion.php");

//VARIABLES
$articulo_id=$_REQUEST["id"];
$cliente=$_REQUEST["clt"];
$pedido=$_REQUEST["pedido"];
$cod_unico=$_REQUEST["cun"];

//ELIMINAR
$rst_eliminar=mysql_query("DELETE FROM syCoesa_pedidos_final WHERE id_pedidos_final=$articulo_id;", $conexion);
	
if (mysql_errno()!=0){
	mysql_close($conexion);
	header("Location:lista-ped.php?id=".$pedido."&clt=".$cliente."&cun=".$cod_unico."&m=6");
} else {
	mysql_close($conexion);
	header("Location:lista-ped.php?id=".$pedido."&clt=".$cliente."&cun=".$cod_unico."&m=5");
}

?>