<?php
session_start();
require_once("../../../../connect/conexion.php");
require_once("../../../../connect/function.php");
require_once("../../../../connect/sesion/verificar_sesion.php");

//VARIABLES
$pedido=$_POST["pedido"];
$cliente=$_POST["cliente"];
$pedido_id=$_POST["pda"];
$pedido_cantidad=$_POST["almart_cantidad"];
$pedido_precio=$_POST["almart_precio"];
$tolerancia_pedido=$_POST["tolerancia_pedido"];
$utilidad_pedido=$_POST["utilidad_pedido"];
$grm2_pedido=$_POST["grm2_pedido"];
$cantidad_pedido_produccion=$_POST["cantidad_pedido_produccion"];
$metros_pedido=$_POST["metros_pedido"];

//ACTUALIZAR
$rst_guardar=mysql_query("UPDATE syCoesa_pedidos_articulos SET precio_pedido=$pedido_precio, cantidad_pedido=$pedido_cantidad, tolerancia_pedido=$tolerancia_pedido, 
utilidad_pedido=$utilidad_pedido, grm2_total=$grm2_pedido, cantidad_produccion=$cantidad_pedido_produccion, metros_producir=$metros_pedido WHERE id_pedido_articulo=$pedido_id;", $conexion);

if (mysql_errno()!=0){
	echo "ERROR: ". mysql_errno() . " - ". mysql_error();
	mysql_close($conexion);
} else {
	mysql_close($conexion);
	header("Location:lista.php?id=$pedido&clt=$cliente&m=2");
}

?>