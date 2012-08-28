<?php
session_start();
require_once("../../../connect/conexion.php");
require_once("../../../connect/function.php");
require_once("../../../connect/sesion/verificar_sesion.php");

//VARIABLES
$dtecnicos_id=$_POST["dtecnicos_id"];
$cliente=$_POST["dtecnicos_cliente"];
$producto=$_POST["dtecnicos_articulo"];
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
$rst_guardar=mysql_query("UPDATE syCoesa_costo_produccion SET grm2total=$grm2total, 
cantproduccion=$cantproduccion, 
metrosproducir=$metrosproducir, 
proc_extrusion_maq=$maquina1, 
proc_impresion_maq=$maquina2, 
proc_bilaminado_maq=$maquina3, 
proc_trilaminado_maq=$maquina4, 
proc_rebobinado_maq=$maquina7, 
proc_habilitado_maq=$maquina8, 
proc_cortefinal_maq=$maquina5, 
proc_sellado_maq=$maquina6, 
insumo_tinta=$insumo_tinta, 
insumo_bilaminado=$insumo_bilaminado, 
insumo_trilaminado=$insumo_trilaminado, 
insumo_cushion=$insumo_cushion, 
insumo_clises=$insumo_clises WHERE id_costo_produccion=$dtecnicos_id;", $conexion);

if (mysql_errno()!=0){
	echo "ERROR: ". mysql_errno() . " - ". mysql_error();
	mysql_close($conexion);
} else {
	mysql_close($conexion);
	header("Location:lista.php?m=2");
}

?>