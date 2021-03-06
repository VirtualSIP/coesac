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
$articulo_ancho=$_POST["almart_ancho"];
$articulo_precio=$_POST["almart_precio"];
if($_POST["almart_solido"]<>""){ $articulo_solido=$_POST["almart_solido"]; }else{ $articulo_solido=0; }
$articulo_unidad_medida=$_POST["almart_unidad_medida"];
$articulo_observaciones=$_POST["almart_observaciones"];
$producto_terminado="I";
$articulo_codUnico=$_POST["cod_unico"]; //HISTORIA
$codigo_unico=codigoAleatorio(20, true, true, false);
$mostrar=1;
$mostrar_anterior=2;

//FACTOR DE CONVERSION
$factor_material=seleccionTabla($_POST["almart_material"], "id_factor", "syCoesa_mantenimiento_factor_conversion", $conexion);
$factor_milpul=$_POST["almart_milpul"];
$factor_micra=$_POST["almart_micra"];

if($factor_milpul<>0){
	$articulo_grm2=$factor_milpul * $factor_material["factor"];
	$factor_micra=0;
}elseif($factor_micra<>0){
	$articulo_grm2=$factor_micra * $factor_material["factor"];
	$factor_milpul=0;
}else{
	$articulo_grm2=$_POST["almart_grm2"];
	$factor_milpul=0;
	$factor_micra=0;
}

//DATOS USUARIO
$dato_fecha=$fechaActual;
$dato_usuario=$usuario_user;

//CAMBIAR MOSTRAR ARTICULO A ANTERIOR
$rst_upd=mysql_query("UPDATE syCoesa_articulo SET mostrar_articulo=$mostrar_anterior WHERE id_articulo=$articulo_id;", $conexion);

//GUARDAR
$rst_guardar=mysql_query("INSERT INTO syCoesa_articulo (id_tipo_articulo, 
nombre_articulo, 
factor_milpul,
factor_micra,
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
$articulo_grm2, 
$articulo_ancho, 
$articulo_precio, 
$articulo_solido,
$articulo_unidad_medida,
'$producto_terminado',
$mostrar,
'$codigo_unico',
'$articulo_codUnico',
'$dato_fecha',
'$dato_usuario')", $conexion);

if (mysql_errno()!=0){
	header("Location:lista.php?m=4");
	mysql_close($conexion);
} else {
	mysql_close($conexion);
	header("Location:lista.php?m=3");
}

?>