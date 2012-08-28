<?php
session_start();
require_once("../../../connect/conexion.php");
require_once("../../../connect/function.php");
require_once("../../../connect/sesion/verificar_sesion.php");

//VARIABLES
$pedido_cliente=$_POST["pedido_cliente"];
$pedido_articulo=$_POST["pedido_articulo"];
$pedido_precio=$_POST["pedido_precio"];
$pedido_cantidad=$_POST["pedido_cantidad"];

//GUARDAR
$rst_guardar=mysql_query("INSERT INTO syCoesa_pedidos (id_cliente,
id_articulo,
precio_pedido,
cantidad_pedido)
VALUES ($pedido_cliente,
$pedido_articulo,
'$pedido_precio',
$pedido_cantidad)", $conexion);

if (mysql_errno()!=0){
	echo "ERROR: ". mysql_errno() . " - ". mysql_error();
	mysql_close($conexion);
} else {
	mysql_close($conexion);
	header("Location:lista.php?m=1");
}

?>