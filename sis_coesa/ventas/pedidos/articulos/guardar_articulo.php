<?php
session_start();
require_once("../../../../connect/conexion.php");
require_once("../../../../connect/function.php");
require_once("../../../../connect/sesion/verificar_sesion.php");

//VARIABLES
$pedido_id=$_POST["pedido"];
$pedido_cliente=$_POST["cliente"];
$pedido_articulo=$_POST["pedido_articulo"];
$pedido_precio=$_POST["pedido_precio"];
$pedido_cantidad=$_POST["pedido_cantidad"];
$pedido_tolerancia=$_POST["tolerancia_pedido"];
$pedido_utilidad=$_POST["utilidad_pedido"];
$pedido_grm2=$_POST["grm2_pedido"];
$pedido_cantidad_produccion=$_POST["pedido_cantidad_produccion"];
$pedido_metros=$_POST["metros_producir"];

//EXTRAER CODIGO UNICO DE PRODUCTO TERMINADO
$codUnico=seleccionTabla($pedido_articulo, "id_articulo", "syCoesa_articulo", $conexion);

//GUARDAR
$rst_guardar=mysql_query("INSERT INTO syCoesa_pedidos_articulos (id_pedido,
id_cliente,
id_articulo,
precio_pedido,
cantidad_pedido,
tolerancia_pedido,
utilidad_pedido,
grm2_total,
cantidad_produccion,
metros_producir,
cod_unico)
VALUES ($pedido_id,
$pedido_cliente,
$pedido_articulo,
$pedido_precio,
$pedido_cantidad,
$pedido_tolerancia,
$pedido_utilidad,
$pedido_grm2,
$pedido_cantidad_produccion,
$pedido_metros,
'".$codUnico["cod_unico"]."')", $conexion);

if (mysql_errno()!=0){
	echo "ERROR: ". mysql_errno() . " - ". mysql_error();
	mysql_close($conexion);
} else {
	mysql_close($conexion);
	header("Location:lista.php?id=$pedido_id&clt=$pedido_cliente&m=1");
}

?>