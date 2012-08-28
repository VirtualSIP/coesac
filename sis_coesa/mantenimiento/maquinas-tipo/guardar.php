<?php
session_start();
require_once("../../../connect/conexion.php");
require_once("../../../connect/function.php");
require_once("../../../connect/sesion/verificar_sesion.php");

//VARIABLES
$maquina_nombre=$_POST["maquina_nombre"];
$maquina_proceso=$_POST["maquina_proceso"];

//DATOS USUARIO
$dato_fecha=$fechaActual;
$dato_usuario=$usuario_user;

//GUARDAR
$rst_guardar=mysql_query("INSERT INTO syCoesa_mantenimiento_maquinas_tipo (nombre_tipo_maquina, proceso_tipo_maquina, dato_fecha, dato_usuario)
VALUES ('$maquina_nombre', '$maquina_proceso', '$dato_fecha', '$dato_usuario')", $conexion);

if (mysql_errno()!=0){
	mysql_close($conexion);
	header("Location:lista.php?m=2");
} else {
	mysql_close($conexion);
	header("Location:lista.php?m=1");
}

?>