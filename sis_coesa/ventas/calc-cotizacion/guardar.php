<?php
session_start();
require_once("../../../connect/conexion.php");
require_once("../../../connect/function.php");
require_once("../../../connect/sesion/verificar_sesion.php");

//VARIABLES
$cliente=$_POST["dtecnicos_cliente"];
$producto=$_POST["dtecnicos_articulo"];
$grm2=$_POST["dtecnicos_grm2"];
$repeticion=$_POST["dtecnicos_repeticion"];
$frecuencia=$_POST["dtecnicos_frecuencia"];
$cilindro=$_POST["dtecnicos_cilindro"];
$anchofinal=$_POST["dtecnicos_anchofinal"];
$nrobandas=$_POST["dtecnicos_numbandas"];
$nrocolores=$_POST["dtecnicos_numcolores"];
$cantcliente=$_POST["dtecnicos_cantrq"];
$tolerancia=$_POST["dtecnicos_tolerancia"];
$unidadmedida=$_POST["dtecnicos_unidadmedida"];
$precio=$_POST["dtecnicos_precio"];
$grm2total=$_POST["dtecnicos_grm2_total"];
$cantproduccion=$_POST["dtecnicos_cantrequerida"];
$metrosproducir=$_POST["dtecnicos_metrosproducir"];

//LAMINA 1
if($_POST["dt_articulo1"]==""){ $lamina1=0; }else{ $lamina1=$_POST["dt_articulo1"]; };
if($_POST["extrusion1"]==""){ $lamina1_extrusion=0; }else{ $lamina1_extrusion=$_POST["extrusion1"]; };
if($_POST["impresion1"]==""){ $lamina1_impresion=0; }else{ $lamina1_impresion=$_POST["impresion1"]; };
if($_POST["bilaminado1"]==""){ $lamina1_bilaminado=0; }else{ $lamina1_bilaminado=$_POST["bilaminado1"]; };
if($_POST["trilaminado1"]==""){ $lamina1_trilaminado=0; }else{ $lamina1_trilaminado=$_POST["trilaminado1"]; };
if($_POST["rebobinado1"]==""){ $lamina1_rebobinado=0; }else{ $lamina1_rebobinado=$_POST["rebobinado1"]; };
if($_POST["habilitado1"]==""){ $lamina1_habilitado=0; }else{ $lamina1_habilitado=$_POST["habilitado1"]; };
if($_POST["cortefinal1"]==""){ $lamina1_cortefinal=0; }else{ $lamina1_cortefinal=$_POST["cortefinal1"]; };
if($_POST["sellado1"]==""){ $lamina1_sellado=0; }else{ $lamina1_sellado=$_POST["sellado1"]; };
$lamina1_impresion_grm2=$_POST["grm2_tintaseca_1"];
$lamina1_bilaminado_grm2=$_POST["bilaminado_proceso_1"];
$lamina1_trilaminado_grm2=$_POST["trilaminado_proceso_1"];

//LAMINA 2
if($_POST["dt_articulo2"]==""){ $lamina2=0; }else{ $lamina2=$_POST["dt_articulo2"]; };
if($_POST["extrusion2"]==""){ $lamina2_extrusion=0; }else{ $lamina2_extrusion=$_POST["extrusion2"]; };
//if($_POST["impresion2"]==""){ $lamina2_impresion=0; }else{ $lamina2_impresion=$_POST["impresion2"]; };
if($_POST["bilaminado2"]==""){ $lamina2_bilaminado=0; }else{ $lamina2_bilaminado=$_POST["bilaminado2"]; };
if($_POST["trilaminado2"]==""){ $lamina2_trilaminado=0; }else{ $lamina2_trilaminado=$_POST["trilaminado2"]; };
if($_POST["rebobinado2"]==""){ $lamina2_rebobinado=0; }else{ $lamina2_rebobinado=$_POST["rebobinado2"]; };
if($_POST["habilitado2"]==""){ $lamina2_habilitado=0; }else{ $lamina2_habilitado=$_POST["habilitado2"]; };
if($_POST["cortefinal2"]==""){ $lamina2_cortefinal=0; }else{ $lamina2_cortefinal=$_POST["cortefinal2"]; };
if($_POST["sellado2"]==""){ $lamina2_sellado=0; }else{ $lamina2_sellado=$_POST["sellado2"]; };
$lamina2_impresion_grm2=$_POST["grm2_tintaseca_2"];
$lamina2_bilaminado_grm2=$_POST["bilaminado_proceso_2"];
$lamina2_trilaminado_grm2=$_POST["trilaminado_proceso_2"];

//LAMINA 3
if($_POST["dt_articulo3"]==""){ $lamina3=0; }else{ $lamina3=$_POST["dt_articulo3"]; };
if($_POST["extrusion3"]==""){ $lamina3_extrusion=0; }else{ $lamina3_extrusion=$_POST["extrusion3"]; };
//if($_POST["impresion3"]==""){ $lamina3_impresion=0; }else{ $lamina3_impresion=$_POST["impresion3"]; };
//if($_POST["bilaminado3"]==""){ $lamina3_bilaminado=0; }else{ $lamina3_bilaminado=$_POST["bilaminado3"]; };
if($_POST["trilaminado3"]==""){ $lamina3_trilaminado=0; }else{ $lamina3_trilaminado=$_POST["trilaminado3"]; };
if($_POST["rebobinado3"]==""){ $lamina3_rebobinado=0; }else{ $lamina3_rebobinado=$_POST["rebobinado3"]; };
if($_POST["habilitado3"]==""){ $lamina3_habilitado=0; }else{ $lamina3_habilitado=$_POST["habilitado3"]; };
if($_POST["cortefinal3"]==""){ $lamina3_cortefinal=0; }else{ $lamina3_cortefinal=$_POST["cortefinal3"]; };
if($_POST["sellado3"]==""){ $lamina3_sellado=0; }else{ $lamina3_sellado=$_POST["sellado3"]; };
$lamina3_impresion_grm2=$_POST["grm2_tintaseca_3"];
$lamina3_bilaminado_grm2=$_POST["bilaminado_proceso_3"];
$lamina3_trilaminado_grm2=$_POST["trilaminado_proceso_3"];

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
$rst_guardar=mysql_query("INSERT INTO syCoesa_cotizacion (cliente_cotizacion, 
producto_cotizacion, 
grm2_cotizacion, 
repeticion_cotizacion, 
frecuencia_cotizacion,
cilindro_cotizacion, 
ancho_final_cotizacion, 
nrobandas_cotizacion, 
nrocolores_cotizacion, 
cantcliente_cotizacion, 
tolerancia_cotizacion, 
unidad_medida_cotizacion, 
precio_cotizacion, 
lamina1_cotizacion, 
extrusion1_cotizacion, 
impresion1_cotizacion, 
impresion1_grm2_cotizacion, 
bilaminado1_cotizacion,  
trilaminado1_cotizacion, 
rebobinado1_cotizacion, 
habilitado1_cotizacion, 
cortefinal1_cotizacion, 
sellado1_cotizacion, 
lamina2_cotizacion, 
extrusion2_cotizacion, 
bilaminado2_cotizacion, 
bilaminado2_grm2_cotizacion, 
trilaminado2_cotizacion, 
rebobinado2_cotizacion, 
habilitado2_cotizacion, 
cortefinal2_cotizacion, 
sellado2_cotizacion, 
lamina3_cotizacion, 
extrusion3_cotizacion, 
trilaminado3_cotizacion, 
trilaminado3_grm2_cotizacion, 
rebobinado3_cotizacion, 
habilitado3_cotizacion, 
cortefinal3_cotizacion, 
sellado3_cotizacion, 
grm2total_cotizacion, 
cantproduccion_cotizacion, 
metrosproducir_cotizacion, 
proc_extrusion_maq_cotizacion, 
proc_impresion_maq_cotizacion, 
proc_bilaminado_maq_cotizacion, 
proc_trilaminado_maq_cotizacion, 
proc_rebobinado_maq_cotizacion, 
proc_habilitado_maq_cotizacion, 
proc_cortefinal_maq_cotizacion, 
proc_sellado_maq_cotizacion, 
insumo_tinta, 
insumo_bilaminado, 
insumo_trilaminado, 
insumo_cushion, 
insumo_clises) 
VALUES ('".htmlspecialchars($cliente)."', 
'".htmlspecialchars($producto)."', 
$grm2, 
$repeticion, 
$frecuencia, 
$cilindro, 
$anchofinal, 
$nrobandas, 
$nrocolores, 
$cantcliente, 
$tolerancia, 
$unidadmedida, 
$precio, 
$lamina1, 
$lamina1_extrusion, 
$lamina1_impresion, 
$lamina1_impresion_grm2, 
$lamina1_bilaminado, 
$lamina1_trilaminado, 
$lamina1_rebobinado, 
$lamina1_habilitado, 
$lamina1_cortefinal, 
$lamina1_sellado, 
$lamina2, 
$lamina2_extrusion, 
$lamina2_bilaminado, 
$lamina2_bilaminado_grm2, 
$lamina2_trilaminado, 
$lamina2_rebobinado, 
$lamina2_habilitado, 
$lamina2_cortefinal, 
$lamina2_sellado, 
$lamina3, 
$lamina3_extrusion, 
$lamina3_trilaminado, 
$lamina3_trilaminado_grm2, 
$lamina3_rebobinado, 
$lamina3_habilitado, 
$lamina3_cortefinal, 
$lamina3_sellado, 
$grm2total, 
$cantproduccion, 
$metrosproducir, 
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
	header("Location:lista.php?msj=2");
} else {
	mysql_close($conexion);
	header("Location:lista.php?msj=1");
}

?>