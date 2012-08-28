<?php
session_start();
require_once("../../../connect/conexion.php");
require_once("../../../connect/function.php");
require_once("../../../connect/sesion/verificar_sesion.php");

//VARIABLES
$cliente_nombre=$_POST["cliente_nombre"];
$cliente_documento_tipo=$_POST["cliente_documento_tipo"];
$cliente_documento_numero=$_POST["cliente_documento_numero"];
$cliente_logo=guardarArchivo("../../../imagenes/clientes/", $_FILES["cliente_logo"]);
$cliente_contacto=$_POST["cliente_contacto"];
$cliente_contacto_email=$_POST["cliente_contacto_email"];
$cliente_observaciones=$_POST["cliente_observaciones"];

//GUARDAR
$rst_guardar=mysql_query("INSERT INTO syCoesa_clientes (nombre_cliente,
documento_cliente,
documento_tipo_cliente,
logo_cliente,
cliente_contacto_nombre,
cliente_contacto_email,
observaciones_cliente)
VALUES ('$cliente_nombre',
'$cliente_documento_numero',
'$cliente_documento_tipo',
'$cliente_logo',
'$cliente_contacto',
'$cliente_contacto_email',
'$cliente_observaciones')", $conexion);

if (mysql_errno()!=0){
	echo "ERROR: ". mysql_errno() . " - ". mysql_error();
	mysql_close($conexion);
} else {
	mysql_close($conexion);
	header("Location:lista.php?m=1");
}

?>