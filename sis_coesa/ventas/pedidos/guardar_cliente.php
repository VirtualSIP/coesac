<?php
session_start();
require_once("../../../connect/conexion.php");
require_once("../../../connect/function.php");
require_once("../../../connect/sesion/verificar_sesion.php");

//VARIABLES
$pedido_cliente=$_POST["pedido_cliente"];
$codigo_unico=codigoAleatorio(20,true,true,false);

//GUARDAR
$rst_guardar=mysql_query("INSERT INTO syCoesa_pedidos (id_cliente, cod_unico)
VALUES ($pedido_cliente, '$codigo_unico')", $conexion);

//EXTRAER ID DEL NUEVO CLIENTE
$rst_cod=mysql_query("SELECT * FROM syCoesa_pedidos WHERE cod_unico='$codigo_unico' LIMIT 1;", $conexion);
$fila_cod=mysql_fetch_array($rst_cod);
$codId=$fila_cod["id_pedido"];
$codCliente=$fila_cod["id_cliente"];

if (mysql_errno()!=0){
	mysql_close($conexion);
	header("Location:lista.php?m=2");
} else {
	mysql_close($conexion);
	header("Location:articulos/lista.php?id=".$codId."&clt=".$codCliente."");
}

?>