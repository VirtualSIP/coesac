<?php
session_start();
require_once("../../../../connect/conexion.php");
require_once("../../../../connect/function.php");
require_once("../../../../connect/sesion/verificar_sesion.php");

//VARIABLES
$id_registro=$_POST["id_registro"];
$did=$_POST["did"];
$dart=$_POST["dart"];
$clt=$_POST["clt"];

//LAMINA 1
if($_POST["dt_articulo1"]==""){ $lamina1=0;}else{ $lamina1=$_POST["dt_articulo1"]; };
if($_POST["extrusion1"]==""){ $lamina1_extrusion=0;}else{ $lamina1_extrusion=$_POST["extrusion1"]; };
if($_POST["impresion1"]==""){ $lamina1_impresion=0; $lamina1_impresion_grm2=0; }else{ $lamina1_impresion=$_POST["impresion1"]; $lamina1_impresion_grm2=$_POST["grm2_tintaseca"]; };
if($_POST["rebobinado1"]==""){ $lamina1_rebobinado=0;}else{ $lamina1_rebobinado=$_POST["rebobinado1"]; };

//LAMINA 2
if($_POST["dt_articulo2"]==""){ $lamina2=0;}else{ $lamina2=$_POST["dt_articulo2"]; };
if($_POST["extrusion2"]==""){ $lamina2_extrusion=0;}else{ $lamina2_extrusion=$_POST["extrusion2"]; };
if($_POST["bilaminado2"]==""){ $lamina2_bilaminado=0; $lamina2_bilaminado_grm2=0; }else{ $lamina2_bilaminado=$_POST["bilaminado2"]; $lamina2_bilaminado_grm2=$_POST["grm2_bilaminado"]; };

//LAMINA 3
if($_POST["dt_articulo3"]==""){ $lamina3=0;}else{ $lamina3=$_POST["dt_articulo3"]; };
if($_POST["extrusion3"]==""){ $lamina3_extrusion=0;}else{ $lamina3_extrusion=$_POST["extrusion3"]; };
if($_POST["trilaminado3"]==""){ $lamina3_trilaminado=0; $lamina3_trilaminado_grm2=0; }else{ $lamina3_trilaminado=$_POST["trilaminado3"]; $lamina3_trilaminado_grm2=$_POST["grm2_trilaminado"]; };

//ACABADO
if($_POST["cortefinal"]==""){ $lamina1_cortefinal=0;}else{ $lamina1_cortefinal=$_POST["cortefinal"]; };
if($_POST["sellado"]==""){ $lamina1_sellado=0;}else{ $lamina1_sellado=$_POST["sellado"]; };

//ACTUALIZAR
$rst_guardar=mysql_query("UPDATE syCoesa_datos_tecnicos_laminas_procesos SET id_articulo_prin=$dart, 
	id_cliente=$clt, 
	id_datos_tecnicos=$did,
	lamina1=$lamina1,
	lamina1_extrusion=$lamina1_extrusion,
	lamina1_impresion=$lamina1_impresion,
	lamina1_impresion_grm2=$lamina1_impresion_grm2,
	lamina1_rebobinado=$lamina1_rebobinado,
	lamina2=$lamina2,
	lamina2_extrusion=$lamina2_extrusion,
	lamina2_bilaminado=$lamina2_bilaminado,
	lamina2_bilaminado_grm2=$lamina2_bilaminado_grm2,
	lamina3=$lamina3,
	lamina3_extrusion=$lamina3_extrusion,
	lamina3_trilaminado=$lamina3_trilaminado,
	lamina3_trilaminado_grm2=$lamina3_trilaminado_grm2,
	lamina1_cortefinal=$lamina1_cortefinal,
	lamina1_sellado=$lamina1_sellado WHERE id_laminas_procesos=$id_registro;", $conexion);

if (mysql_errno()!=0){
	echo "ERROR: ". mysql_errno() . " - ". mysql_error();
	mysql_close($conexion);
} else {
	mysql_close($conexion);
	header("Location:lista.php?did=$did&dart=$dart&clt=$clt&idlmpr=$id_registro&m=2");
}

?>