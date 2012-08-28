<?php
session_start();
require_once("../../../connect/conexion.php");
require_once("../../../connect/function.php");
require_once("../../../connect/sesion/verificar_sesion.php");

//VARIABLES
$estado_nombre=$_POST["estado_nombre"];

//DATOS USUARIO
$dato_fecha=$fechaActual;
$dato_usuario=$usuario_user;

//GUARDAR
$rst_guardar=mysql_query("INSERT INTO syCoesa_mantenimiento_estado (nombre_estado, dato_fecha, dato_usuario)
VALUES ('$estado_nombre', '$dato_fecha', '$dato_usuario')", $conexion);

if (mysql_errno()!=0){
	mysql_close($conexion);
	header("Location:lista.php?m=2");
} else {
	mysql_close($conexion);
	header("Location:lista.php?m=1");
}

?>