<?php
session_start();
require_once("../../../connect/conexion.php");
require_once("../../../connect/function.php");
require_once("../../../connect/sesion/verificar_sesion.php");

//VARIABLES
$cliente=$_POST["dtecnicos_cliente"];
$producto=$_POST["dtecnicos_articulo"];

$tolerancia=$_POST["dtecnicos_tolerancia"];
$cantcliente=$_POST["dtecnicos_cantidadclt"];
$precio=$_POST["dtecnicos_precio"];

$grm2total=$_POST["dtecnicos_grm2_total"];
$cantproduccion=$_POST["dtecnicos_cantrequerida"];
$metrosproducir=$_POST["dtecnicos_metrosproducir"];

//MAQUINAS
if($_POST["maquina1"]==""){ $maquina1=0; }else{ $maquina1=$_POST["maquina1"]; }; //EXTRUSION
if($_POST["maquina2"]==""){ $maquina2=0; }else{ $maquina2=$_POST["maquina2"]; }; //IMPRESION
if($_POST["maquina3"]==""){ $maquina3=0; }else{ $maquina3=$_POST["maquina3"]; }; //BILAMINADO
if($_POST["maquina4"]==""){ $maquina4=0; }else{ $maquina4=$_POST["maquina4"]; }; //TRILAMINADO
if($_POST["maquina5"]==""){ $maquina5=0; }else{ $maquina5=$_POST["maquina5"]; }; //CORTE FINAL
if($_POST["maquina6"]==""){ $maquina6=0; }else{ $maquina6=$_POST["maquina6"]; }; //SELLADO
if($_POST["maquina7"]==""){ $maquina7=0; }else{ $maquina7=$_POST["maquina7"]; }; //REBOBINADO
if($_POST["maquina8"]==""){ $maquina8=0; }else{ $maquina8=$_POST["maquina8"]; }; //HABILITADO

//INSUMOS
if($_POST["insumotinta"]==""){ $insumo_tinta=0; }else{ $insumo_tinta=$_POST["insumotinta"]; }
if($_POST["insumo2"]==""){ $insumo_bilaminado=0; }else{ $insumo_bilaminado=$_POST["insumo2"]; }
if($_POST["insumo3"]==""){ $insumo_trilaminado=0; }else{ $insumo_trilaminado=$_POST["insumo3"]; }
if($_POST["insumo4"]==""){ $insumo_cushion=0; }else{ $insumo_cushion=$_POST["insumo4"]; }
if($_POST["insumo5"]==""){ $insumo_clises=0; }else{ $insumo_clises=$_POST["insumo5"]; }

//GUARDAR
$rst_guardar=mysql_query("INSERT INTO syCoesa_costo_produccion (id_cliente, 
id_articulo, 
grm2total, 
cantproduccion, 
metrosproducir, 
tolerancia,
cantcliente,
precio,
proc_extrusion_maq, 
proc_impresion_maq, 
proc_bilaminado_maq, 
proc_trilaminado_maq, 
proc_rebobinado_maq, 
proc_habilitado_maq, 
proc_cortefinal_maq, 
proc_sellado_maq, 
insumo_tinta, 
insumo_bilaminado, 
insumo_trilaminado, 
insumo_cushion, 
insumo_clises) 
VALUES ($cliente, 
$producto, 
$grm2total, 
$cantproduccion, 
$metrosproducir, 
$tolerancia,
$cantcliente,
$precio,
$maquina1, 
$maquina2, 
$maquina3, 
$maquina4, 
$maquina7, 
$maquina8, 
$maquina5, 
$maquina6, 
$insumo_tinta, 
$insumo_bilaminado, 
$insumo_trilaminado, 
$insumo_cushion, 
$insumo_clises)", $conexion);

if (mysql_errno()!=0){
	mysql_close($conexion);
	header("Location:lista.php?m=2");
} else {
	mysql_close($conexion);
	header("Location:lista.php?m=1");
}

?>