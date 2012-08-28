<?php
session_start();
require_once("../../../connect/conexion.php");
require_once("../../../connect/function.php");
require_once("../../../connect/sesion/verificar_sesion.php");

//VARIABLES
$proceso_nombre=$_POST["proceso_nombre"];
$url=UrlAmigable($proceso_nombre);
$merma_permitida=$_POST["merma_permitida"];
$merma_tipo=$_POST["merma_tipo"];
$orden=$_POST["orden"];
$proceso_observaciones=$_POST["proceso_observaciones"];

//DATOS USUARIO
$dato_fecha=$fechaActual;
$dato_usuario=$usuario_user;

//GUARDAR
$rst_guardar=mysql_query("INSERT INTO syCoesa_mantenimiento_procesos_productivos (nombre_proceso,
url,
merma_proceso,
merma_proceso_tipo, 
orden_proceso,
observaciones_proceso,
dato_fecha,
dato_usuario)
VALUES ('$proceso_nombre', 
'$url',
$merma_permitida,
'$merma_tipo',
$orden,
'$proceso_observaciones',
'$dato_fecha',
'$dato_usuario')", $conexion);

if (mysql_errno()!=0){
	mysql_close($conexion);
	header("Location:lista.php?m=2");
} else {
	mysql_close($conexion);
	header("Location:lista.php?m=1");
}

?>