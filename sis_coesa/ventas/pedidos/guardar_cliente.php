<?php
session_start();
require_once("../../../connect/conexion.php");
require_once("../../../connect/function.php");
require_once("../../../connect/sesion/verificar_sesion.php");

//VARIABLES
$pedido_cliente=$_POST["pedido_cliente"];
$codigo_unico=codigoAleatorio(20,true,true,false);

//FECHA Y USUARIO
$dato_fecha=$fechaActual;
$dato_usuario=$usuario_user;

//GUARDAR
$rst_guardar=mysql_query("INSERT INTO syCoesa_pedidos_cliente (id_cliente, cod_unico, dato_fecha, dato_usuario)
VALUES ($pedido_cliente, '$codigo_unico', '$dato_fecha', '$dato_usuario')", $conexion);

//EXTRAER ID DEL NUEVO CLIENTE
$rst_cod=mysql_query("SELECT * FROM syCoesa_pedidos_cliente WHERE cod_unico='$codigo_unico' LIMIT 1;", $conexion);
$fila_cod=mysql_fetch_array($rst_cod);
$codId=$fila_cod["id_pedido"];
$codCliente=$fila_cod["id_cliente"];

if (mysql_errno()!=0){
	mysql_close($conexion);
	header("Location:lista.php?m=2");
} else {
	mysql_close($conexion);
	header("Location:articulos/lista-ped.php?id=".$codId."&clt=".$codCliente."&cun=".$codigo_unico."");
}

?>