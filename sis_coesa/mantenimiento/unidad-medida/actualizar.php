<?php
session_start();
require_once("../../../connect/conexion.php");
require_once("../../../connect/function.php");
require_once("../../../connect/sesion/verificar_sesion.php");

//VARIABLES
$unidad_medida_id=$_POST["id_unidad_medida"];
$unidad_medida_nombre=$_POST["nombre_unidad_medida"];
$unidad_medida_factor_conversion=$_POST["factor_conversion_unidad_medida"];

//DATOS USUARIO
$dato_fecha=$fechaActual;
$dato_usuario=$usuario_user;

//ACTUALIZAR
$rst_guardar=mysql_query("UPDATE syCoesa_unidad_medida SET nombre_unidad_medida='$unidad_medida_nombre', 
factor_conversion_unidad_medida='$unidad_medida_factor_conversion',
dato_fecha='$dato_fecha', dato_usuario='$dato_usuario' WHERE id_unidad_medida=$unidad_medida_id;", $conexion);

if (mysql_errno()!=0){
	mysql_close($conexion);
	header("Location:lista.php?m=4");
} else {
	mysql_close($conexion);
	header("Location:lista.php?m=3");
}

?>