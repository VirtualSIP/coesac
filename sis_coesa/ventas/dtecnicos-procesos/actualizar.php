<?php
session_start();
require_once("../../../connect/conexion.php");
require_once("../../../connect/function.php");
require_once("../../../connect/sesion/verificar_sesion.php");

//VARIABLES
$procesos_id=$_POST["procesos_id"];
$procesos_maquina=$_POST["procesos_maquina"];
$procesos_grm2=$_POST["procesos_grm2"];
$procesos_velocidad=$_POST["procesos_velocidad"];

//ACTUALIZAR
$rst_guardar=mysql_query("UPDATE syCoesa_datos_tecnicos_procesos SET id_maquina=$procesos_maquina,
grm2_proceso='$procesos_grm2',
velocidad_proceso='$procesos_velocidad' WHERE id_proceso=$procesos_id;", $conexion);

if (mysql_errno()!=0){
	echo "ERROR: ". mysql_errno() . " - ". mysql_error();
	mysql_close($conexion);
} else {
	mysql_close($conexion);
	header("Location:lista.php?m=2");
}

?>