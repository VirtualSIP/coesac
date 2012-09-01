<?php
session_start();
require_once("../../../../connect/conexion.php");
require_once("../../../../connect/function.php");
require_once("../../../../connect/sesion/verificar_sesion.php");

//VARIABLES
$articulo=$_POST["pedido_articulo"];
$pedido=$_POST["pedido"];
$pedido_final=$_POST["pedido_final"];
$cliente=$_POST["cliente"];
$cod_unico=$_POST["cod_unico"];
$cod_unico_final=$_POST["cod_unico_final"];

//FECHA Y USUARIO
$dato_fecha=$fechaActual;
$dato_usuario=$usuario_user;

//GUARDAR
$rst_guardar=mysql_query("INSERT INTO syCoesa_pedidos_articulos (id_pedido,
id_pedido_final,
id_cliente,
id_articulo,
cod_unico,
cod_unico_final,
dato_fecha,
dato_usuario)
VALUES ($pedido,
$pedido_final,
$cliente,
$articulo,
'$cod_unico',
'$cod_unico_final',
'$dato_fecha',
'$dato_usuario')", $conexion);

if (mysql_errno()!=0){
	mysql_close($conexion);
	header("Location:lista.php?m=4");
} else {
	mysql_close($conexion);
	header("Location:lista.php?cun=$cod_unico&pedf=$pedido_final&ped=$pedido&clt=$cliente&cunf=$cod_unico_final&m=3");
}

?>