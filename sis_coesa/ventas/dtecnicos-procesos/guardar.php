<?php
session_start();
require_once("../../../connect/conexion.php");
require_once("../../../connect/function.php");
require_once("../../../connect/sesion/verificar_sesion.php");

//VARIABLES
$procesos_maquina=$_POST["procesos_maquina"];
$procesos_grm2=$_POST["procesos_grm2"];
$procesos_velocidad=$_POST["procesos_velocidad"];

//GUARDAR
$rst_guardar=mysql_query("INSERT INTO syCoesa_datos_tecnicos_procesos (id_maquina,
grm2_proceso,
velocidad_proceso)
VALUES ($procesos_maquina,
'$procesos_grm2',
'$procesos_velocidad')", $conexion);

if (mysql_errno()!=0){
	echo "ERROR: ". mysql_errno() . " - ". mysql_error();
	mysql_close($conexion);
} else {
	mysql_close($conexion);
	header("Location:lista.php?m=1");
}

?>