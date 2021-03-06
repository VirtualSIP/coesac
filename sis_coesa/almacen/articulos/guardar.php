<?php
session_start();
require_once("../../../connect/conexion.php");
require_once("../../../connect/function.php");
require_once("../../../connect/sesion/verificar_sesion.php");

//VARIABLES
$articulo_nombre=$_POST["almart_articulo"];
$articulo_tipo_articulo=$_POST["almart_tipo_articulo"];
$articulo_abreviacion=$_POST["almart_abreviacion"];
$articulo_ancho=$_POST["almart_ancho"];
$articulo_precio=$_POST["almart_precio"];
$articulo_solido=$_POST["almart_solido"];
$articulo_unidad_medida=$_POST["almart_unidad_medida"];
$articulo_observaciones=$_POST["almart_observaciones"];

//FACTOR DE CONVERSION
$factor_milpul=$_POST["almart_milpul"];
$factor_micra=$_POST["almart_micra"];
$factor_material=$_POST["almart_material"];
$factor_conversion=seleccionTabla($factor_material, "id_factor", "syCoesa_mantenimiento_factor_conversion", $conexion);

if($factor_milpul<>0){
	$articulo_grm2=$factor_milpul * $factor_conversion["factor"];
	$factor_micra=0;
}elseif($factor_micra<>0){
	$articulo_grm2=$factor_micra * $factor_conversion["factor"];
	$factor_milpul=0;
}else{
	$articulo_grm2=$_POST["almart_grm2"];
	$factor_milpul=0;
	$factor_micra=0;
}

$mostrar=1;
$producto_terminado="I";
$codigo_unico=codigoAleatorio(20, true, true, false);

//DATOS USUARIO
$dato_fecha=$fechaActual;
$dato_usuario=$usuario_user;

//GUARDAR
$rst_guardar=mysql_query("INSERT INTO syCoesa_articulo (id_tipo_articulo, 
nombre_articulo, 
factor_milpul,
factor_micra,
factor_material,
grm2_articulo, 
ancho_articulo, 
precio_articulo,
solido_tinta, 
unidad_medida_articulo,
producto_terminado,
mostrar_articulo,
cod_unico,
cod_unico_historia,
dato_fecha,
dato_usuario)
VALUES ($articulo_tipo_articulo, 
'".htmlspecialchars($articulo_nombre)."', 
$factor_milpul,
$factor_micra,
$factor_material,
$articulo_grm2, 
$articulo_ancho, 
$articulo_precio, 
$articulo_solido,
$articulo_unidad_medida,
'$producto_terminado',
$mostrar,
'$codigo_unico',
'$codigo_unico',
'$dato_fecha',
'$dato_usuario')", $conexion);


if (mysql_errno()!=0){
	header("Location:lista.php?m=2");
	mysql_close($conexion);
} else {
	mysql_close($conexion);
	header("Location:lista.php?m=1");
}

?>