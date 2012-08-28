<?php
session_start();
require_once("../../../connect/conexion.php");
require_once("../../../connect/function.php");
require_once("../../../connect/sesion/verificar_sesion.php");

//VARIABLES
$pedido_id=$_POST["pedido_id"];
$pedido_cliente=$_POST["pedido_cliente"];

//VERIFICAR SI CLIENTE EXISTE
$rst_ver=mysql_query("SELECT * FROM syCoesa_pedidos WHERE id_pedido=$pedido_id AND id_cliente=$pedido_cliente LIMIT 1;", $conexion);
$num_ver=mysql_num_rows($rst_ver);

if($num_ver==0){
	//GUARDAR
	$rst_guardar=mysql_query("INSERT INTO syCoesa_pedidos (id_cliente)
	VALUES ($pedido_cliente)", $conexion);
	
	if (mysql_errno()!=0){
		echo "ERROR: ". mysql_errno() . " - ". mysql_error();
		mysql_close($conexion);
	} else {
		mysql_close($conexion);
		header("Location:lista.php?m=2");
	}
}else{
	if (mysql_errno()!=0){
		echo "ERROR: ". mysql_errno() . " - ". mysql_error();
		mysql_close($conexion);
	} else {
		mysql_close($conexion);
		header("Location:lista.php?m=2");
	}
}





?>