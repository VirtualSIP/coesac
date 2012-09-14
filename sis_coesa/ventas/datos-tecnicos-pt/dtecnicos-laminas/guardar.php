<?php
session_start();
require_once("../../../../connect/conexion.php");
require_once("../../../../connect/function.php");
require_once("../../../../connect/sesion/verificar_sesion.php");

//VARIABLES
$did=$_POST["dato_tecnico"];
$dart=$_POST["dart"];
$clt=$_POST["clt"];
$codUnico=$_POST["cun"];

//LAMINA 1
if($_POST["dt_articulo1"]==""){ $lamina1=0;}else{ $lamina1=$_POST["dt_articulo1"]; };
if($_POST["extrusion1"]==""){ $lamina1_extrusion=0;}else{ $lamina1_extrusion=$_POST["extrusion1"]; };
if($_POST["impresion1"]==""){ $lamina1_impresion=0;}else{ $lamina1_impresion=$_POST["impresion1"]; };
if($_POST["grm2_tintaseca"]==""){ $lamina1_impresion_grm2=0;}else{ $lamina1_impresion_grm2=$_POST["grm2_tintaseca"]; };
if($_POST["rebobinado1"]==""){ $lamina1_rebobinado=0;}else{ $lamina1_rebobinado=$_POST["rebobinado1"]; };

//LAMINA 2
if($_POST["dt_articulo2"]==""){ $lamina2=0;}else{ $lamina2=$_POST["dt_articulo2"]; };
if($_POST["extrusion2"]==""){ $lamina2_extrusion=0;}else{ $lamina2_extrusion=$_POST["extrusion2"]; };
if($_POST["bilaminado2"]==""){ $lamina2_bilaminado=0;}else{ $lamina2_bilaminado=$_POST["bilaminado2"]; };
if($_POST["grm2_bilaminado"]==""){ $lamina2_bilaminado_grm2=0;}else{ $lamina2_bilaminado_grm2=$_POST["grm2_bilaminado"]; };

//LAMINA 3
if($_POST["dt_articulo3"]==""){ $lamina3=0;}else{ $lamina3=$_POST["dt_articulo3"]; };
if($_POST["extrusion3"]==""){ $lamina3_extrusion=0;}else{ $lamina3_extrusion=$_POST["extrusion3"]; };
if($_POST["trilaminado3"]==""){ $lamina3_trilaminado=0;}else{ $lamina3_trilaminado=$_POST["trilaminado3"]; };
if($_POST["grm2_trilaminado"]==""){ $lamina3_trilaminado_grm2=0;}else{ $lamina3_trilaminado_grm2=$_POST["grm2_trilaminado"]; };

//ACABADO
if($_POST["cortefinal"]==""){ $lamina1_cortefinal=0;}else{ $lamina1_cortefinal=$_POST["cortefinal1"]; };
if($_POST["sellado"]==""){ $lamina1_sellado=0;}else{ $lamina1_sellado=$_POST["sellado1"]; };

//GUARDAR
$rst_guardar=mysql_query("INSERT INTO syCoesa_datos_tecnicos_laminas_procesos (id_articulo_prin, 
id_cliente, 
id_datos_tecnicos,
lamina1,
lamina1_extrusion,
lamina1_impresion,
lamina1_impresion_grm2,
lamina1_rebobinado,
lamina2,
lamina2_extrusion,
lamina2_bilaminado,
lamina2_bilaminado_grm2,
lamina3,
lamina3_extrusion,
lamina3_trilaminado,
lamina3_trilaminado_grm2,
lamina1_cortefinal,
lamina1_sellado,
cod_unico)
VALUES ($dart, 
$clt,   
$did,
$lamina1,
$lamina1_extrusion,
$lamina1_impresion,
$lamina1_impresion_grm2,
$lamina1_rebobinado,
$lamina2,
$lamina2_extrusion,
$lamina2_bilaminado,
$lamina2_bilaminado_grm2,
$lamina3,
$lamina3_extrusion,
$lamina3_trilaminado,
$lamina3_trilaminado_grm2,
$lamina1_cortefinal,
$lamina1_sellado,
'$codUnico');", $conexion);

if (mysql_errno()!=0){
	echo "ERROR: ". mysql_errno() . " - ". mysql_error();
	mysql_close($conexion);
} else {	
	mysql_close($conexion);
	header("Location:lista.php?did=$did&dart=$dart&clt=$clt&m=1");
}

?>