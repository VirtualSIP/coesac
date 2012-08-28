<?php
session_start();
require_once("../../../connect/conexion.php");
require_once("../../../connect/function.php");
require_once("../../../connect/sesion/verificar_sesion.php");

//VARIABLES
$cliente_id=$_POST["cliente_id"];
$cliente_nombre=$_POST["cliente_nombre"];
$cliente_documento_tipo=$_POST["cliente_documento_tipo"];
$cliente_documento_numero=$_POST["cliente_documento_numero"];
$cliente_logo=actualizarArchivo("../../../imagenes/clientes/", $_FILES["cliente_logo"], $_POST["cliente_logo_actual"]);
$cliente_contacto=$_POST["cliente_contacto"];
$cliente_contacto_email=$_POST["cliente_contacto_email"];
$cliente_observaciones=$_POST["cliente_observaciones"];

//ACTUALIZAR
$rst_guardar=mysql_query("UPDATE syCoesa_clientes SET nombre_cliente='$cliente_nombre',
documento_cliente=$cliente_documento_numero, 
documento_tipo_cliente='$cliente_documento_tipo',
logo_cliente='$cliente_logo',
cliente_contacto_nombre='$cliente_contacto',
cliente_contacto_email='$cliente_contacto_email',
observaciones_cliente='$cliente_observaciones' WHERE id_cliente=$cliente_id;", $conexion);

if (mysql_errno()!=0){
	mysql_close($conexion);
	header("Location:lista.php?m=4");
} else {
	mysql_close($conexion);
	header("Location:lista.php?m=3");
}

?>