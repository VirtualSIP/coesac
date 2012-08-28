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
if($_POST["almart_solido"]<>""){ $articulo_solido=$_POST["almart_solido"]; }else{ $articulo_solido=0; }
$articulo_unidad_medida=$_POST["almart_unidad_medida"];
$articulo_observaciones=$_POST["almart_observaciones"];

//ACTUALIZAR
$rst_guardar=mysql_query("UPDATE syCoesa_articulo SET id_tipo_articulo=$articulo_tipo_articulo,
nombre_articulo='".htmlspecialchars($articulo_nombre)."', 
abreviado_articulo='".htmlspecialchars($articulo_abreviacion)."', 
grm2_articulo=$articulo_grm2, 
ancho_articulo=$articulo_ancho, 
precio_articulo=$articulo_precio, 
solido_tinta=$articulo_solido,
unidad_medida_articulo=$articulo_unidad_medida,
observaciones_articulo='".htmlspecialchars($articulo_observaciones)."' WHERE id_articulo=$articulo_id;", $conexion);

if (mysql_errno()!=0){
	header("Location:lista.php?m=4");
	mysql_close($conexion);
} else {
	mysql_close($conexion);
	header("Location:lista.php?m=3");
}

?>