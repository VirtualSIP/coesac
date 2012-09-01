<?php
session_start();
require_once("../../../../connect/conexion.php");
require_once("../../../../connect/function.php");
require_once("../../../../connect/sesion/verificar_sesion.php");

//VARIABLES
$pedido=$_REQUEST["ped"];
$cliente=$_REQUEST["clt"];
$codigo_unico=$_REQUEST["cun"];
$codigo_unico_final=codigoAleatorio(20,true,true,false);

//FECHA Y USUARIO
$dato_fecha=$fechaActual;
$dato_usuario=$usuario_user;

//GUARDAR
$rst_guardar=mysql_query("INSERT INTO syCoesa_pedidos_final (id_pedido,
id_cliente,
dato_fecha,
dato_usuario,
cod_unico,
cod_unico_final	)
VALUES ($pedido,
$cliente,
'$dato_fecha',
'$dato_usuario',
'$codigo_unico',
'$codigo_unico_final')", $conexion);


//EXTRAER ID DEL NUEVO PEDIDO
$rst_cod=mysql_query("SELECT * FROM syCoesa_pedidos_final WHERE cod_unico_final	='$codigo_unico_final' LIMIT 1;", $conexion);
$fila_cod=mysql_fetch_array($rst_cod);
$codId=$fila_cod["id_pedidos_final"];

if (mysql_errno()!=0){
	echo "ERROR: ". mysql_errno() . " - ". mysql_error();
	mysql_close($conexion);
} else {
	mysql_close($conexion);
	header("Location:lista.php?cun=$codigo_unico&pedf=$codId&ped=$pedido&clt=$cliente&cunf=$codigo_unico_final&m=1");
}

?>