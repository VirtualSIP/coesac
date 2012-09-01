<?php
session_start();
require_once("../../../../connect/conexion.php");
require_once("../../../../connect/function.php");
require_once("../../../../connect/sesion/verificar_sesion.php");

//VARIABLES
$articulo_id=$_REQUEST["id"];
$cliente=$_REQUEST["clt"];
$pedido=$_REQUEST["ped"];
$pedido_final=$_REQUEST["pedfinal"];
$cod_unico=$_REQUEST["cun"];
$cod_unico_final=$_REQUEST["cunf"];

//ELIMINAR
$rst_eliminar=mysql_query("DELETE FROM syCoesa_pedidos_articulos WHERE id_pedido_articulo=$articulo_id;", $conexion);
	
if (mysql_errno()!=0){
	mysql_close($conexion);
	header("Location:lista.php?ped=".$pedido."&pedf=".$pedido_final."&clt=".$cliente."&cun=".$cod_unico."&cunf=".$cod_unico_final."&m=6");
} else {
	mysql_close($conexion);
	header("Location:lista.php?ped=".$pedido."&pedf=".$pedido_final."&clt=".$cliente."&cun=".$cod_unico."&cunf=".$cod_unico_final."&m=5");
}

?>