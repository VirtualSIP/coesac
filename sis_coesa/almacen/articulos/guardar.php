<?php
session_start();
require_once("../../../connect/conexion.php");
require_once("../../../connect/function.php");
require_once("../../../connect/sesion/verificar_sesion.php");

//VARIABLES
$articulo_nombre=$_POST["almart_articulo"];
$articulo_tipo_articulo=$_POST["almart_tipo_articulo"];
$articulo_abreviacion=$_POST["almart_abreviacion"];
$articulo_grm2=$_POST["almart_grm2"];
$articulo_ancho=$_POST["almart_ancho"];
$articulo_precio=$_POST["almart_precio"];
$articulo_solido=$_POST["almart_solido"];
$articulo_unidad_medida=$_POST["almart_unidad_medida"];
$articulo_observaciones=$_POST["almart_observaciones"];
$producto_terminado="I";

//GUARDAR
$rst_guardar=mysql_query("INSERT INTO syCoesa_articulo (id_tipo_articulo, 
nombre_articulo, 
abreviado_articulo, 
grm2_articulo, 
ancho_articulo, 
precio_articulo,
solido_tinta, 
unidad_medida_articulo,
observaciones_articulo,
producto_terminado)
VALUES ($articulo_tipo_articulo, 
'".htmlspecialchars($articulo_nombre)."', 
'".htmlspecialchars($articulo_abreviacion)."', 
$articulo_grm2, 
$articulo_ancho, 
$articulo_precio, 
$articulo_solido,
$articulo_unidad_medida,
'".htmlspecialchars($articulo_observaciones)."',
'$producto_terminado')", $conexion);

if (mysql_errno()!=0){
	header("Location:lista.php?m=2");
	mysql_close($conexion);
} else {
	mysql_close($conexion);
	header("Location:lista.php?m=1");
}

?>