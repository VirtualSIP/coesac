<?php
session_start();
require_once("../../../connect/conexion.php");
require_once("../../../connect/function.php");
require_once("../../../connect/sesion/verificar_sesion.php");

//VARIABLES
$proceso_id=$_POST["proceso_id"];
$proceso_nombre=$_POST["proceso_nombre"];
$url=UrlAmigable($proceso_nombre);
$merma_permitida=$_POST["merma_permitida"];
$merma_tipo=$_POST["merma_tipo"];
$orden=$_POST["orden"];
$proceso_observaciones=$_POST["proceso_observaciones"];

//DATOS USUARIO
$dato_fecha=$fechaActual;
$dato_usuario=$usuario_user;

//ACTUALIZAR
$rst_guardar=mysql_query("UPDATE syCoesa_mantenimiento_procesos_productivos SET nombre_proceso='$proceso_nombre', url='$url',
merma_proceso=$merma_permitida, merma_proceso_tipo='$merma_tipo', orden_proceso=$orden, observaciones_proceso='$proceso_observaciones',
dato_fecha='$dato_fecha', dato_usuario='$dato_usuario' WHERE id_proceso=$proceso_id;", $conexion);

if (mysql_errno()!=0){
	mysql_close($conexion);
	header("Location:lista.php?m=4");
} else {
	mysql_close($conexion);
	header("Location:lista.php?m=3");
}

?>