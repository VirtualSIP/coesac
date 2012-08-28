<?php
session_start();
require_once("../../../connect/conexion.php");
require_once("../../../connect/function.php");
require_once("../../../connect/sesion/verificar_sesion.php");

//VARIABLES
$articulo_id=$_POST["almart_id"];
$articulo_nombre=$_POST["almart_articulo"];
$articulo_tipo_articulo=$_POST["almart_tipo_articulo"];
$articulo_abreviacion=$_POST["almart_abreviacion"];
$articulo_grm2=$_POST["almart_grm2"];
$articulo_ancho=$_POST["almart_ancho"];
$articulo_precio=$_POST["almart_precio"];
$articulo_observaciones=$_POST["almart_observaciones"];

//ACTUALIZAR
$rst_guardar=mysql_query("UPDATE syCoesa_articulo_tipo SET nombre_tipo_articulo='$articulo_nombre', 
abreviado_tipo_articulo='$articulo_abreviacion', 
observaciones_tipo_articulo='$articulo_observaciones' WHERE id_tipo_articulo=$articulo_id;", $conexion);

if (mysql_errno()!=0){
	mysql_close($conexion);
	header("Location:lista.php?m=4");
} else {
	mysql_close($conexion);
	header("Location:lista.php?m=3");
}

?>