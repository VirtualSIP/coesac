<?php
//CONEXION CON EL SERVIDOR
$conexion=mysql_connect("localhost","marost2_admin","master@18073");
mysql_select_db("marost2_scoesacpry12-1",$conexion);

//ZONA HORARIA
date_default_timezone_set('America/Lima');

//ERROR REPORTING
error_reporting(0);

//VARIABLES GLOBALES
global $tabla_suf;
global $sesion_pre;
global $fila_empresa;
global $fila_prv_user;
global $usuario_user;
global $usuario_nombre;
global $usuario_apellido;
global $usuario_email;
global $usuario_priv;
global $web;
global $web_nombre;
global $fechaActual;

//VARIABLES
$tabla_suf="syCoesa";
$sesion_pre="syCoesaUsw";
$fechaActual=date("Y-m-d H:i:s");

//EMPRESA
$rst_empresa=mysql_query("SELECT * FROM syCoesa_empresa WHERE id=1;", $conexion);
$fila_empresa=mysql_fetch_array($rst_empresa);
$web=$fila_empresa["web"];
$web_nombre=$fila_empresa["nombre"];

if ($_SESSION["user-".$sesion_pre.""]<>""){
	$usuario_user=$_SESSION["user-".$sesion_pre.""];
	$usuario_nombre=$_SESSION["user_nombre-".$sesion_pre.""];
	$usuario_apellido=$_SESSION["user_apellido-".$sesion_pre.""];
	$usuario_email=$_SESSION["user_email-".$sesion_pre.""];
	$usuario_priv=$_SESSION["user_priv-".$sesion_pre.""];
}
?>