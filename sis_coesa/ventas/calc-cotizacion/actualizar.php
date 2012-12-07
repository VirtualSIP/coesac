<?php
session_start();
require_once("../../../connect/conexion.php");
require_once("../../../connect/function.php");
require_once("../../../connect/sesion/verificar_sesion.php");

//VARIABLES
$id_cotizacion=$_POST["id_cotizacion"];
$cliente=$_POST["dtecnicos_cliente"];
$producto=$_POST["dtecnicos_articulo"];
$grm2=$_POST["dtecnicos_grm2"];
$anchofinal=$_POST["dtecnicos_anchofinal"];
$repeticion=$_POST["dtecnicos_repeticion"];
$frecuencia=$_POST["dtecnicos_frecuencia"];
$nrobandas=$_POST["dtecnicos_numbandas"];
$nrocolores=$_POST["dtecnicos_numcolores"];
$cantcliente=$_POST["dtecnicos_cantrq"];
$tolerancia=$_POST["dtecnicos_tolerancia"];
$unidadmedida=$_POST["dtecnicos_unidadmedida"];
$precio=$_POST["dtecnicos_precio"];
$formato=$_POST["dtecnicos_formato"];
$grm2total=$_POST["dtecnicos_grm2_total"];
$cantproduccion=$_POST["dtecnicos_cantrequerida"];
$metrosproducir=$_POST["dtecnicos_metrosproducir"];

/*VARIABLES DE MILESIMA DE PULGADA Y MICRA*/
//LAMINA 1
if($_POST["lamina1_milpul"]==""){ $lamina1_factor_milpul=0; }else{ $lamina1_factor_milpul=$_POST["lamina1_milpul"]; }
if($_POST["lamina1_micra"]==""){ $lamina1_factor_micra=0; }else{ $lamina1_factor_micra=$_POST["lamina1_micra"]; }
if($_POST["lamina1_material"]==""){ $lamina1_factor_material=0; }else{ $lamina1_factor_material=$_POST["lamina1_material"]; }
if($_POST["lamina1_grm2"]==""){ $lamina1_grm2=0; }else{ $lamina1_grm2=$_POST["lamina1_grm2"]; }
if($_POST["conversion1_factor"]==""){ $conversion1_factor=0; }else{ $conversion1_factor=$_POST["conversion1_factor"]; }
if($_POST["conversion1_grm2"]==""){ $conversion1_grm2=0; }else{ $conversion1_grm2=$_POST["conversion1_grm2"]; }

//LAMINA 2
if($_POST["lamina2_milpul"]==""){ $lamina2_factor_milpul=0; }else{ $lamina2_factor_milpul=$_POST["lamina2_milpul"]; }
if($_POST["lamina2_micra"]==""){ $lamina2_factor_micra=0; }else{ $lamina2_factor_micra=$_POST["lamina2_micra"]; }
if($_POST["lamina2_material"]==""){ $lamina2_factor_material=0; }else{ $lamina2_factor_material=$_POST["lamina2_material"]; }
if($_POST["lamina2_grm2"]==""){ $lamina2_grm2=0; }else{ $lamina2_grm2=$_POST["lamina2_grm2"]; }
if($_POST["conversion2_factor"]==""){ $conversion2_factor=0; }else{ $conversion2_factor=$_POST["conversion2_factor"]; }
if($_POST["conversion2_grm2"]==""){ $conversion2_grm2=0; }else{ $conversion2_grm2=$_POST["conversion2_grm2"]; }

//LAMINA 3
if($_POST["lamina3_milpul"]==""){ $lamina3_factor_milpul=0; }else{ $lamina3_factor_milpul=$_POST["lamina3_milpul"]; }
if($_POST["lamina3_micra"]==""){ $lamina3_factor_micra=0; }else{ $lamina3_factor_micra=$_POST["lamina3_micra"]; }
if($_POST["lamina3_material"]==""){ $lamina3_factor_material=0; }else{ $lamina3_factor_material=$_POST["lamina3_material"]; }
if($_POST["lamina3_grm2"]==""){ $lamina3_grm2=0; }else{ $lamina3_grm2=$_POST["lamina3_grm2"]; }
if($_POST["conversion3_factor"]==""){ $conversion3_factor=0; }else{ $conversion3_factor=$_POST["conversion3_factor"]; }
if($_POST["conversion3_grm2"]==""){ $conversion3_grm2=0; }else{ $conversion3_grm2=$_POST["conversion3_grm2"]; }

/* VARIABLES */
//LAMINA 1
if($_POST["dt_articulo1"]==""){ $lamina1=0; }else{ $lamina1=$_POST["dt_articulo1"]; };
if($_POST["lamina1_ancho"]<>""){ $lamina1_ancho=$_POST["lamina1_ancho"]; }else{ $lamina1_ancho=0; }
if($_POST["extrusion1"]==""){ $lamina1_extrusion=0; }else{ $lamina1_extrusion=$_POST["extrusion1"]; };
if($_POST["impresion1"]==""){ $lamina1_impresion=0; }else{ $lamina1_impresion=$_POST["impresion1"]; };
if($_POST["rebobinado1"]==""){ $lamina1_rebobinado=0; }else{ $lamina1_rebobinado=$_POST["rebobinado1"]; };
if($_POST["grm2_tintaseca_1"]==""){ $lamina1_impresion_grm2=0; }else{ $lamina1_impresion_grm2=$_POST["grm2_tintaseca_1"]; }

//LAMINA 2
if($_POST["dt_articulo2"]==""){ $lamina2=0; }else{ $lamina2=$_POST["dt_articulo2"]; };
if($_POST["lamina2_ancho"]<>""){ $lamina2_ancho=$_POST["lamina2_ancho"]; }else{ $lamina2_ancho=0; }
if($_POST["extrusion2"]==""){ $lamina2_extrusion=0; }else{ $lamina2_extrusion=$_POST["extrusion2"]; };
if($_POST["bilaminado2"]==""){ $lamina2_bilaminado=0; }else{ $lamina2_bilaminado=$_POST["bilaminado2"]; };
if($_POST["rebobinado2"]==""){ $lamina2_rebobinado=0; }else{ $lamina2_rebobinado=$_POST["rebobinado2"]; };
if($_POST["bilaminado_proceso_2"]==""){ $lamina2_bilaminado_grm2=0; }else{ $lamina2_bilaminado_grm2=$_POST["bilaminado_proceso_2"]; }

//LAMINA 3
if($_POST["dt_articulo3"]==""){ $lamina3=0; }else{ $lamina3=$_POST["dt_articulo3"]; };
if($_POST["lamina3_ancho"]<>""){ $lamina3_ancho=$_POST["lamina3_ancho"]; }else{ $lamina3_ancho=0; }
if($_POST["extrusion3"]==""){ $lamina3_extrusion=0; }else{ $lamina3_extrusion=$_POST["extrusion3"]; };
if($_POST["trilaminado3"]==""){ $lamina3_trilaminado=0; }else{ $lamina3_trilaminado=$_POST["trilaminado3"]; };
if($_POST["rebobinado3"]==""){ $lamina3_rebobinado=0; }else{ $lamina3_rebobinado=$_POST["rebobinado3"]; };
if($_POST["trilaminado_proceso_3"]==""){ $lamina3_trilaminado_grm2=0; }else{ $lamina3_trilaminado_grm2=$_POST["trilaminado_proceso_3"]; }

//ACABADO
if($_POST["cortefinal"]==""){ $lamina1_cortefinal=0; }else{ $lamina1_cortefinal=$_POST["cortefinal"]; };
if($_POST["sellado"]==""){ $lamina1_sellado=0; }else{ $lamina1_sellado=$_POST["sellado"]; };

//MAQUINAS
if($_POST["maquina1"]==""){ $maquina1=0; }else{ $maquina1=$_POST["maquina1"]; }; //EXTRUSION IMPRESION
if($_POST["maquina_exbi"]==""){ $maquina_exbi=0; }else{ $maquina_exbi=$_POST["maquina_exbi"]; }; //EXTRUSION BILAMINADO
if($_POST["maquina_extri"]==""){ $maquina_extri=0; }else{ $maquina_extri=$_POST["maquina_extri"]; }; //EXTRUSION TRILAMINADO
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

//ACTUALIZAR
$rst_guardar=mysql_query("UPDATE syCoesa_cotizacion SET cliente_cotizacion='$cliente',
producto_cotizacion='$producto',
grm2_cotizacion=$grm2,
repeticion_cotizacion=$repeticion,
frecuencia_cotizacion=$frecuencia,
ancho_final_cotizacion=$anchofinal,
nrobandas_cotizacion=$nrobandas,
nrocolores_cotizacion=$nrocolores,
cantcliente_cotizacion=$cantcliente,
tolerancia_cotizacion=$tolerancia,
unidad_medida_cotizacion=$unidadmedida,
precio_cotizacion=$precio,
formato_cotizacion=$formato,
lamina1_cotizacion=$lamina1,
lamina1_ancho_cotizacion=$lamina1_ancho,
lamina1_factor_micra=$lamina1_factor_micra,
lamina1_factor_milpul=$lamina1_factor_milpul,
lamina1_factor_material=$lamina1_factor_material,
conversion1_factor=$conversion1_factor,
conversion1_grm2=$conversion1_grm2,
lamina1_grm2_cotizacion=$lamina1_grm2,
extrusion1_cotizacion=$lamina1_extrusion,
impresion1_cotizacion=$lamina1_impresion,
impresion1_grm2_cotizacion=$lamina1_impresion_grm2,
rebobinado1_cotizacion=$lamina1_rebobinado,
lamina2_cotizacion=$lamina2,
lamina2_ancho_cotizacion=$lamina2_ancho,
lamina2_factor_micra=$lamina2_factor_micra,
lamina2_factor_milpul=$lamina2_factor_milpul,
lamina2_factor_material=$lamina3_factor_material,
conversion2_factor=$conversion2_factor,
conversion2_grm2=$conversion2_grm2,
lamina2_grm2_cotizacion=$lamina2_grm2,
extrusion2_cotizacion=$lamina2_extrusion,
bilaminado2_cotizacion=$lamina2_bilaminado,
bilaminado2_grm2_cotizacion=$lamina2_bilaminado_grm2,
rebobinado2_cotizacion=$lamina2_rebobinado,
lamina3_cotizacion=$lamina3,
lamina3_ancho_cotizacion=$lamina3_ancho,
lamina3_factor_micra=$lamina3_factor_micra,
lamina3_factor_milpul=$lamina3_factor_milpul,
lamina3_factor_material=$lamina3_factor_material,
conversion3_factor=$conversion3_factor,
conversion3_grm2=$conversion3_grm2,
lamina3_grm2_cotizacion=$lamina3_grm2,
extrusion3_cotizacion=$lamina3_extrusion,
trilaminado3_cotizacion=$lamina3_trilaminado,
trilaminado3_grm2_cotizacion=$lamina3_trilaminado_grm2,
rebobinado3_cotizacion=$lamina3_rebobinado,
cortefinal1_cotizacion=$lamina1_cortefinal,
sellado1_cotizacion=$lamina1_sellado,
grm2total_cotizacion=$grm2total,
cantproduccion_cotizacion=$cantproduccion,
metrosproducir_cotizacion=$metrosproducir,
proc_extrusion_impresion_maq_cotizacion=$maquina1, 
proc_extrusion_bilaminado_maq_cotizacion=$maquina_exbi,
proc_extrusion_trilaminado_maq_cotizacion=$maquina_extri,
proc_impresion_maq_cotizacion=$maquina2,
proc_bilaminado_maq_cotizacion=$maquina3,
proc_trilaminado_maq_cotizacion=$maquina4,
proc_rebobinado_maq_cotizacion=$maquina7,
proc_habilitado_maq_cotizacion=$maquina8,
proc_cortefinal_maq_cotizacion=$maquina5, 
proc_sellado_maq_cotizacion=$maquina6,
insumo_tinta=$insumo_tinta,
insumo_bilaminado=$insumo_bilaminado,
insumo_trilaminado=$insumo_trilaminado,
insumo_cushion=$insumo_cushion,
insumo_clises=$insumo_clises WHERE id_cotizacion=$id_cotizacion", $conexion);

if (mysql_errno()!=0){
	//echo "ERROR: ". mysql_errno() . " - ". mysql_error();
	mysql_close($conexion);
	header("Location:lista.php?msj=4");
} else {
	mysql_close($conexion);
	header("Location:lista.php?msj=3&imp=$id_cotizacion"); 
}
?>