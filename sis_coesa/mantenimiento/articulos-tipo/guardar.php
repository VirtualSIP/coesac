<?php
session_start();
require_once("../../../connect/conexion.php");
require_once("../../../connect/function.php");
require_once("../../../connect/sesion/verificar_sesion.php");

//VARIABLES
$articulo_nombre=$_POST["almart_articulo"];
$articulo_abreviacion=$_POST["almart_abreviacion"];
$articulo_observaciones=$_POST["almart_observaciones"];

//DATOS USUARIO
$dato_fecha=$fechaActual;
$dato_usuario=$usuario_user;

//GUARDAR
$rst_guardar=mysql_query("INSERT INTO syCoesa_articulo_tipo (nombre_tipo_articulo, 
abreviado_tipo_articulo, 
observaciones_tipo_articulo,
dato_fecha,
dato_usuario)
VALUES ('$articulo_nombre', 
'$articulo_abreviacion', 
'$articulo_observaciones',
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