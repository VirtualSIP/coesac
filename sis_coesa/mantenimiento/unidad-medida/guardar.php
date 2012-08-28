<?php
session_start();
require_once("../../../connect/conexion.php");
require_once("../../../connect/function.php");
require_once("../../../connect/sesion/verificar_sesion.php");

//VARIABLES
$unidad_medida_nombre=$_POST["nombre_unidad_medida"];
$unidad_medida_factor_conversion=$_POST["factor_conversion_unidad_medida"];

//DATOS USUARIO
$dato_fecha=$fechaActual;
$dato_usuario=$usuario_user;

//GUARDAR
$rst_guardar=mysql_query("INSERT INTO syCoesa_unidad_medida (nombre_unidad_medida, 
factor_conversion_unidad_medida,
dato_fecha, dato_usuario)
VALUES ('$unidad_medida_nombre', 
'$unidad_medida_factor_conversion',
'$dato_fecha', '$dato_usuario')", $conexion);

if (mysql_errno()!=0){
	mysql_close($conexion);
	header("Location:lista.php?m=2");
} else {
	mysql_close($conexion);
	header("Location:lista.php?m=1");
}

?>