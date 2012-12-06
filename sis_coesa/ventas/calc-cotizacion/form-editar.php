<?php
session_start();
require_once("../../../connect/conexion.php");
require_once("../../../connect/function.php");
require_once("../../../connect/sesion/verificar_sesion.php");

//VARIABLES
$id_cotizacion=$_REQUEST["id"];
$aux=0;

//COTIZACION
$cotizacion=seleccionTabla($id_cotizacion, "id_cotizacion", "syCoesa_cotizacion", $conexion);
$cotizacion_cliente=$cotizacion["cliente_cotizacion"];
$cotizacion_producto=$cotizacion["producto_cotizacion"];
$cotizacion_grm2=$cotizacion["grm2_cotizacion"];
$cotizacion_repeticion=$cotizacion["repeticion_cotizacion"];
$cotizacion_frecuencia=$cotizacion["frecuencia_cotizacion"];
$cotizacion_cilindro=$cotizacion["cilindro_cotizacion"];
$cotizacion_anchofinal=$cotizacion["ancho_final_cotizacion"];
$cotizacion_nrobandas=$cotizacion["nrobandas_cotizacion"];
$cotizacion_nrocolores=$cotizacion["nrocolores_cotizacion"];
$cotizacion_cantcliente=$cotizacion["cantcliente_cotizacion"];
$cotizacion_tolerancia=$cotizacion["tolerancia_cotizacion"];
$cotizacion_unidadmedida=$cotizacion["unidad_medida_cotizacion"];
$cotizacion_precio=$cotizacion["precio_cotizacion"];
$cotizacion_formato=$cotizacion["formato_cotizacion"];

$cotizacion_lamina1=$cotizacion["lamina1_cotizacion"];
$lamina1_dato=seleccionTabla($cotizacion_lamina1, "id_articulo", "syCoesa_articulo", $conexion);
$cotizacion_lamina1_ancho=$cotizacion["lamina1_ancho_cotizacion"];
$cotizacion_lamina1_factor_milpul=$cotizacion["lamina1_factor_milpul"];
$cotizacion_lamina1_factor_micra=$cotizacion["lamina1_factor_micra"];
$cotizacion_lamina1_factor_material=$cotizacion["lamina1_factor_material"];
$cotizacion_conversion1_factor=$cotizacion["conversion1_factor"];
$cotizacion_conversion1_grm2=$cotizacion["conversion1_grm2"];
$cotizacion_lamina1_grm2=$cotizacion["lamina1_grm2_cotizacion"];
$cotizacion_lamina1_extrusion=$cotizacion["extrusion1_cotizacion"];
$cotizacion_lamina1_impresion=$cotizacion["impresion1_cotizacion"];
$cotizacion_lamina1_impresion_grm2=$cotizacion["impresion1_grm2_cotizacion"];
$cotizacion_lamina1_rebobinado=$cotizacion["rebobinado1_cotizacion"];

$cotizacion_lamina2=$cotizacion["lamina2_cotizacion"];
$lamina2_dato=seleccionTabla($cotizacion_lamina2, "id_articulo", "syCoesa_articulo", $conexion);
$cotizacion_lamina2_ancho=$cotizacion["lamina2_ancho_cotizacion"];
$cotizacion_lamina2_factor_milpul=$cotizacion["lamina2_factor_milpul"];
$cotizacion_lamina2_factor_micra=$cotizacion["lamina2_factor_micra"];
$cotizacion_lamina2_factor_material=$cotizacion["lamina2_factor_material"];
$cotizacion_conversion2_factor=$cotizacion["conversion2_factor"];
$cotizacion_conversion2_grm2=$cotizacion["conversion2_grm2"];
$cotizacion_lamina2_grm2=$cotizacion["lamina2_grm2_cotizacion"];
$cotizacion_lamina2_extrusion=$cotizacion["extrusion2_cotizacion"];
$cotizacion_lamina2_bilaminado=$cotizacion["bilaminado2_cotizacion"];
$cotizacion_lamina2_bilaminado_grm2=$cotizacion["bilaminado2_grm2_cotizacion"];
$cotizacion_lamina2_rebobinado=$cotizacion["rebobinado2_cotizacion"];

$cotizacion_lamina3=$cotizacion["lamina3_cotizacion"];
$lamina3_dato=seleccionTabla($cotizacion_lamina3, "id_articulo", "syCoesa_articulo", $conexion);
$cotizacion_lamina3_ancho=$cotizacion["lamina3_ancho_cotizacion"];
$cotizacion_lamina3_factor_milpul=$cotizacion["lamina3_factor_milpul"];
$cotizacion_lamina3_factor_micra=$cotizacion["lamina3_factor_micra"];
$cotizacion_lamina3_factor_material=$cotizacion["lamina3_factor_material"];
$cotizacion_conversion3_factor=$cotizacion["conversion3_factor"];
$cotizacion_conversion3_grm2=$cotizacion["conversion3_grm2"];
$cotizacion_lamina3_grm2=$cotizacion["lamina3_grm2_cotizacion"];
$cotizacion_lamina3_extrusion=$cotizacion["extrusion3_cotizacion"];
$cotizacion_lamina3_trilaminado=$cotizacion["trilaminado3_cotizacion"];
$cotizacion_lamina3_trilaminado_grm2=$cotizacion["trilaminado3_grm2_cotizacion"];
$cotizacion_lamina3_rebobinado=$cotizacion["rebobinado3_cotizacion"];

$cotizacion_lamina1_cortefinal=$cotizacion["cortefinal1_cotizacion"];
$cotizacion_lamina1_sellado=$cotizacion["sellado1_cotizacion"];

$cotizacion_grm2total=$cotizacion["grm2total_cotizacion"];
$cotizacion_cantproduccion=$cotizacion["cantproduccion_cotizacion"];
$cotizacion_metrosproducir=$cotizacion["metrosproducir_cotizacion"];

$proc_extrusion_impresion=$cotizacion["proc_extrusion_impresion_maq_cotizacion"];
$proc_extrusion_bilaminado=$cotizacion["proc_extrusion_bilaminado_maq_cotizacion"];
$proc_extrusion_trilaminado=$cotizacion["proc_extrusion_trilaminado_maq_cotizacion"];
$proc_impresion=$cotizacion["proc_impresion_maq_cotizacion"];
$proc_bilaminado=$cotizacion["proc_bilaminado_maq_cotizacion"];
$proc_trilaminado=$cotizacion["proc_trilaminado_maq_cotizacion"];
$proc_rebobinado=$cotizacion["proc_rebobinado_maq_cotizacion"];
$proc_habilitado=$cotizacion["proc_habilitado_maq_cotizacion"];
$proc_cortefinal=$cotizacion["proc_cortefinal_maq_cotizacion"];
$proc_sellado=$cotizacion["proc_sellado_maq_cotizacion"];

$insumo_tinta=$cotizacion["insumo_tinta"];
$insumo_bilaminado=$cotizacion["insumo_bilaminado"];
$insumo_trilaminado=$cotizacion["insumo_trilaminado"];
$insumo_cushion=$cotizacion["insumo_cushion"];
$insumo_clises=$cotizacion["insumo_clises"];
$mtrprod=$cotizacion_metrosproducir;
$cant_colores=$cotizacion_nrocolores;

/*-------------------------- AGREGANDO METROS DE PROCESO + METROS A PRODUCIR --------------------------*/
if($proc_cortefinal>0){ //CORTE FINAL
	$procprod_merma_cortefinal=seleccionTabla("'corte-final'", "url", "syCoesa_mantenimiento_procesos_productivos", $conexion);
	$mtrprod_cortefinal=($mtrprod + ($mtrprod * ($procprod_merma_cortefinal["merma_proceso"] / 100)));
}else{ $mtrprod_cortefinal=0; $procprod_merma_cortefinal=0; }

if($proc_sellado>0){ //SELLADO
	$procprod_merma_sellado=seleccionTabla("'sellado'", "url", "syCoesa_mantenimiento_procesos_productivos", $conexion);
	$mtrprod_sellado=($mtrprod + ($mtrprod * ($procprod_merma_sellado["merma_proceso"] / 100)));
	$proc_sellado_merma=($mtrprod * ($procprod_merma_sellado["merma_proceso"] / 100));
	$mtrprod_sellado_total=(($mtrprod_sellado + $proc_sellado_merma) * $cotizacion_nrobandas) / ($cotizacion_repeticion / 1000);
}else{ $mtrprod_sellado_total=0; $procprod_merma_sellado=0; }

if($proc_trilaminado>0){ //TRILAMINADO
	$procprod_merma_trilaminado=seleccionTabla("'trilaminado'", "url", "syCoesa_mantenimiento_procesos_productivos", $conexion);
	$mtrprod_trilaminado=($mtrprod + $procprod_merma_trilaminado["merma_proceso"]) + ($mtrprod * ($procprod_merma_sellado["merma_proceso"] / 100)) + ($mtrprod * ($procprod_merma_cortefinal["merma_proceso"] / 100));
}else{ $mtrprod_trilaminado=0; $procprod_merma_trilaminado=0; }

if($proc_bilaminado>0){ //BILAMINADO
	$procprod_merma_bilaminado=seleccionTabla("'bilaminado'", "url", "syCoesa_mantenimiento_procesos_productivos", $conexion);
	$mtrprod_bilaminado=($mtrprod + $procprod_merma_bilaminado["merma_proceso"]) + ($procprod_merma_trilaminado["merma_proceso"]) + ($mtrprod * ($procprod_merma_sellado["merma_proceso"] / 100)) + ($mtrprod * ($procprod_merma_cortefinal["merma_proceso"] / 100));
}else{ $mtrprod_bilaminado=0; $procprod_merma_bilaminado=0; }

if($proc_rebobinado>0){ //REBOBINADO	
	$mtrprod_rebobinado=$mtrprod_bilaminado;
}else{ $mtrprod_rebobinado=0; }

if($proc_impresion>0){ //IMPRESION
	$procprod_merma=seleccionTabla("'impresion'", "url", "syCoesa_mantenimiento_procesos_productivos", $conexion);
	$mtrprod_impresion=($mtrprod + ($procprod_merma["merma_proceso"] * $cant_colores)) + ($procprod_merma_bilaminado["merma_proceso"]) + ($procprod_merma_trilaminado["merma_proceso"]) + ($mtrprod * ($procprod_merma_sellado["merma_proceso"] / 100)) + ($mtrprod * ($procprod_merma_cortefinal["merma_proceso"] / 100));
}else{ $mtrprod_impresion=0; }

if($proc_extrusion_impresion>0 or $proc_extrusion_bilaminado>0 or $proc_extrusion_trilaminado>0){ //EXTRUSION
	$procprod_merma=seleccionTabla("'extrusion'", "url", "syCoesa_mantenimiento_procesos_productivos", $conexion);
	
	if($cotizacion_lamina1_extrusion>0){
		if($cotizacion_lamina1_impresion>0){
			$totalKg_impresion=(($mtrprod_impresion * $cotizacion_lamina1_ancho * $cotizacion_lamina1_grm2) / 1000000) + $procprod_merma["merma_proceso"];
		}elseif($cotizacion_lamina1_cortefinal>0){
			$totalKg_impresion=(($mtrprod_cortefinal * $cotizacion_lamina1_ancho * $cotizacion_lamina1_grm2) / 1000000) + $procprod_merma["merma_proceso"];
		}
	}else{ $totalKg_impresion=0; }
	
	if($cotizacion_lamina2_extrusion>0){
		if($cotizacion_lamina2_bilaminado>0){
			$totalKg_bilaminado=(($mtrprod_bilaminado * $cotizacion_lamina2_ancho * $cotizacion_lamina2_grm2) / 1000000) + $procprod_merma["merma_proceso"];
		}elseif($cotizacion_lamina2_cortefinal>0){
			$totalKg_bilaminado=(($mtrprod_cortefinal * $cotizacion_lamina2_ancho * $cotizacion_lamina2_grm2) / 1000000) + $procprod_merma["merma_proceso"];
		}
	}else{ $totalKg_bilaminado=0; }
	
	if($cotizacion_lamina3_extrusion>0){
		if($cotizacion_lamina3_trilaminado>0){
			$totalKg_trilaminado=(($mtrprod_trilaminado * $cotizacion_lamina3_ancho * $cotizacion_lamina3_grm2) / 1000000) + $procprod_merma["merma_proceso"];
		}elseif($cotizacion_lamina3_cortefinal>0){
			$totalKg_trilaminado=(($mtrprod_cortefinal * $cotizacion_lamina1_ancho * $cotizacion_lamina3_grm2) / 1000000) + $procprod_merma["merma_proceso"];
		}
	}else{ $totalKg_trilaminado=0; }

}

//UNIDAD DE MEDIDA
$rst_unmedida=mysql_query("SELECT * FROM syCoesa_unidad_medida WHERE id_unidad_medida=1 OR id_unidad_medida=3 ORDER BY nombre_unidad_medida ASC;", $conexion);

//NUMERO DE BANDAS
$rst_mqdt_bandas=mysql_query("SELECT * FROM syCoesa_mantenimiento_maquinas_datos ORDER BY ancho_max_maquina DESC LIMIT 1;", $conexion);
$fila_mqdt_bandas=mysql_fetch_array($rst_mqdt_bandas);
$mqdt_bandas_ancho=$fila_mqdt_bandas["ancho_max_maquina"];

//NRO DE BANDAS = (ANCHO MAX / ANCHO FINAL)
$nroBandas=($mqdt_bandas_ancho / $cotizacion_anchofinal);

//SELECCIONAR REFILE DE MAQUINAS
$rst_maq=mysql_query("SELECT * FROM syCoesa_mantenimiento_maquinas_datos ORDER BY refile_maquina DESC;", $conexion);
$fila_maq=mysql_fetch_array($rst_maq);
$maq_refile=$fila_maq["refile_maquina"];

//FILTRO
$formula_filtro_lamina=$cotizacion_anchofinal * $cotizacion_nrobandas + $maq_refile;
$formula_filtro_manga=$cotizacion_anchofinal * $cotizacion_nrobandas;
$formula_filtro_polietileno=0;

//NUMERO DE COLORES
$rst_mqdt_colores=mysql_query("SELECT * FROM syCoesa_mantenimiento_maquinas_datos ORDER BY estacion_cuerpo_maquina DESC LIMIT 1;", $conexion);
$fila_mqdt_colores=mysql_fetch_array($rst_mqdt_colores);
$mqdt_colores_estacion=$fila_mqdt_colores["estacion_cuerpo_maquina"];

//LAMINAS - POLIETILENO
$rst_lamina1=mysql_query("SELECT * FROM syCoesa_articulo WHERE (id_tipo_articulo=3 AND mostrar_articulo=1) OR (id_tipo_articulo=6 AND mostrar_articulo=1) OR (id_tipo_articulo=13 AND mostrar_articulo=1) ORDER BY nombre_articulo ASC;", $conexion); //LAMINAS
$rst_lamina2=mysql_query("SELECT * FROM syCoesa_articulo WHERE (id_tipo_articulo=3 AND mostrar_articulo=1) OR (id_tipo_articulo=6 AND mostrar_articulo=1) OR (id_tipo_articulo=13 AND mostrar_articulo=1) ORDER BY nombre_articulo ASC;", $conexion); //LAMINAS
$rst_lamina3=mysql_query("SELECT * FROM syCoesa_articulo WHERE (id_tipo_articulo=3 AND mostrar_articulo=1) OR (id_tipo_articulo=6 AND mostrar_articulo=1) OR (id_tipo_articulo=13 AND mostrar_articulo=1) ORDER BY nombre_articulo ASC;", $conexion); //LAMINAS

//CILINDROS
$rst_cilindro=mysql_query("SELECT * FROM syCoesa_mantenimiento_cilindro ORDER BY id_cilindro ASC;", $conexion);

//INSUMOS
$rst_insTinta=mysql_query("SELECT * FROM syCoesa_articulo WHERE id_tipo_articulo=2 ORDER BY precio_articulo DESC;", $conexion);
$fila_insTinta=mysql_fetch_array($rst_insTinta);
$insTinta_id=$fila_insTinta["id_articulo"];

?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>COESA</title>

<!-- ESTILOS -->
<link rel="stylesheet" type="text/css" href="/css/normalize.css">
<link rel="stylesheet" type="text/css" href="/css/estilos_sis_coesa.css">

<!-- FUENTES -->
<link href='http://fonts.googleapis.com/css?family=Cuprum:400,700' rel='stylesheet' type='text/css'>

<!-- DESHABILITAR ENTER -->
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script>
var jEnter = jQuery.noConflict();
jEnter(document).ready(function() {
    jEnter("form").keypress(function(e) {
        if (e.which == 13) {
            return false;
        }
    });
});
</script>

<!-- MENU -->
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript" src="/libs_js/effc_menu/jscript_jzScrollHorizontalPane.js"></script>
<script type="text/javascript" src="/libs_js/effc_menu/jscript_jquery.dimensions.js"></script>
<script type="text/javascript" src="/libs_js/effc_menu/jscript_jquery.mousewheel.min.js"></script>
<script type="text/javascript">
var jmenu = jQuery.noConflict();
jmenu(document).ready(function(){
	if(jmenu("#nav")) {
		jmenu("#nav dd").hide();
		jmenu("#nav dt b").click(function() {
			if(this.className.indexOf("clicked") != -1) {
				jmenu(this).parent().next().slideUp(200);
				jmenu(this).removeClass("clicked");
			}
			else {
				jmenu("#nav dt b").removeClass();
				jmenu(this).addClass("clicked");
				jmenu("#nav dd:visible").slideUp(200);
				jmenu(this).parent().next().slideDown(500);
			}
			return false;
		});
	}
});
</script>

<!-- COMBO -->
<link rel="stylesheet" href="/libs_js/jquery_ui/themes/base/jquery.ui.all.css">
<script src="/libs_js/jquery-1.7.2.min.js"></script>
<script src="/libs_js/jquery_ui/ui/jquery.ui.core.js"></script>
<script src="/libs_js/jquery_ui/ui/jquery.ui.widget.js"></script>
<script src="/libs_js/jquery_ui/ui/jquery.ui.button.js"></script>
<script src="/libs_js/jquery_ui/ui/jquery.ui.position.js"></script>
<script src="/libs_js/jquery_ui/ui/jquery.ui.autocomplete.js"></script>
<link rel="stylesheet" href="/libs_js/combo/css-select.css">
<script src="/libs_js/combo/js-select.js"></script>

<!-- NUMERO DE BANDAS -->
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
<script>
var jnrobd = jQuery.noConflict();
jnrobd(document).ready(function(){
	jnrobd("#dtecnicos_anchofinal").change(function(){
		jnrobd("#progressbar").removeClass("ocultar");
		var anchofinal = jnrobd("#dtecnicos_anchofinal").val();
		jnrobd.post("formula.php", {anchofinal: anchofinal, anchomax: <?php echo $mqdt_bandas_ancho; ?>},
			function(data){
				jnrobd("#progressbar").addClass("ocultar");
				jnrobd("#item-nrobandas").html(data);
			});
	});	
});
</script>

<!-- SELECCIONAR LAMINAS -->
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script>
var jlamproc = jQuery.noConflict();
jlamproc(document).ready(function(){
	jlamproc("#dtecnicos_formato").change(function(){
		jlamproc("#progressbar").removeClass("ocultar");
		var formato = jlamproc(this).val();
		jlamproc.post("seleccionar-laminas.php", {formato: formato},
			function(data){
				jlamproc("#progressbar").addClass("ocultar");
				jlamproc("#datos_lamproc").html(data);
			});
	});
});
</script>

<!-- UNIDAD DE MEDIDA -->
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script>
var jundmed = jQuery.noConflict();
jundmed(document).ready(function(){
	
	var unidadmedida = jundmed("#dtecnicos_unidadmedida").val();
	jundmed.post("undad-medida.php", {unidadmedida: unidadmedida},
		function(data){
			jundmed("#progressbar").addClass("ocultar");
			jundmed("#dtecnicos_cantrq_texto").html(data);
		});
	
	jundmed("#dtecnicos_unidadmedida").change(function(){
		jundmed("#progressbar").removeClass("ocultar");
		var unidadmedida = jundmed(this).val();
		jundmed.post("undad-medida.php", {unidadmedida: unidadmedida},
			function(data){
				jundmed("#progressbar").addClass("ocultar");
				jundmed("#dtecnicos_cantrq_texto").html(data);
			});
	});	
});
</script>

<!-- SELECCION DE PROCESOS -->
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script>
var jLamProcSelc=jQuery.noConflict();
jLamProcSelc(document).ready(function(){
	
	jLamProcSelc("#lamina1_select").click(function(){	
		jLamProcSelc("#progressbar").removeClass("ocultar");
		var lamina1=jLamProcSelc("#dt_articulo1").val();
		
		jLamProcSelc.post("seleccionar-laminas-procesos.php", {lamina1: lamina1},
			function(data){
				jLamProcSelc("#lamina1_procesos").html(data);
				jLamProcSelc("#progressbar").addClass("ocultar");
			});
	});
	
	jLamProcSelc("#lamina2_select").click(function(){
		jLamProcSelc("#progressbar").removeClass("ocultar");
		var lamina2=jLamProcSelc("#dt_articulo2").val();
		
		jLamProcSelc.post("seleccionar-laminas-procesos.php", {lamina2: lamina2},
			function(data){
				jLamProcSelc("#lamina2_procesos").html(data);
				jLamProcSelc("#progressbar").addClass("ocultar");
			});
	});
	
	jLamProcSelc("#lamina3_select").click(function(){
		jLamProcSelc("#progressbar").removeClass("ocultar");
		var lamina3=jLamProcSelc("#dt_articulo3").val();
		
		jLamProcSelc.post("seleccionar-laminas-procesos.php", {lamina3: lamina3},
			function(data){
				jLamProcSelc("#lamina3_procesos").html(data);
				jLamProcSelc("#progressbar").addClass("ocultar");
			});
	});
	
});
</script>

<!-- CONVERSION DE FACTOR A GRM2 O VICEVERSA -->
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script>
var jLamFactorConv=jQuery.noConflict();
jLamFactorConv(document).ready(function(){
	
	//LAMINA 1
	jLamFactorConv("#factor1_convertir").click(function(){	
		jLamFactorConv("#progressbar").removeClass("ocultar");
		var lam1_milpul=jLamFactorConv("#lamina1_milpul").val();
		var lam1_material=jLamFactorConv("#lamina1_material").val();
		var lam1_micra=jLamFactorConv("#lamina1_micra").val();
		var lam1_grm2=jLamFactorConv("#lamina1_grm2").val();
		var conversion1_factor=jLamFactorConv("#conversion1_factor").val();
		var conversion1_grm2=jLamFactorConv("#conversion1_grm2").val();
		var convertir1="OK";
		jLamFactorConv("#lamina1_factconv").empty();		
		jLamFactorConv.post("formula-factor-conversion.php", {lam1_milpul: lam1_milpul, lam1_material: lam1_material, convertir1: convertir1,
		lam1_micra: lam1_micra, lam1_grm2: lam1_grm2, conversion1_factor: conversion1_factor, conversion1_grm2: conversion1_grm2},
			function(data){
				jLamFactorConv("#lamina1_factconv").html(data);
				jLamFactorConv("#progressbar").addClass("ocultar");
			});
	});
	
	//LAMINA 2
	jLamFactorConv("#factor2_convertir").click(function(){	
		jLamFactorConv("#progressbar").removeClass("ocultar");
		var lam2_milpul=jLamFactorConv("#lamina2_milpul").val();
		var lam2_material=jLamFactorConv("#lamina2_material").val();
		var lam2_micra=jLamFactorConv("#lamina2_micra").val();
		var lam2_grm2=jLamFactorConv("#lamina2_grm2").val();
		var conversion2_factor=jLamFactorConv("#conversion2_factor").val();
		var conversion2_grm2=jLamFactorConv("#conversion2_grm2").val();
		var convertir2="OK";
		jLamFactorConv("#lamina2_factconv").empty();		
		jLamFactorConv.post("formula-factor-conversion.php", {lam2_milpul: lam2_milpul, lam2_material: lam2_material, convertir2: convertir2,
		lam2_micra: lam2_micra, lam2_grm2: lam2_grm2, conversion2_factor: conversion2_factor, conversion2_grm2: conversion2_grm2},
			function(data){
				jLamFactorConv("#lamina2_factconv").html(data);
				jLamFactorConv("#progressbar").addClass("ocultar");
			});
	});
	
	//LAMINA 3
	jLamFactorConv("#factor3_convertir").click(function(){	
		jLamFactorConv("#progressbar").removeClass("ocultar");
		var lam3_milpul=jLamFactorConv("#lamina3_milpul").val();
		var lam3_material=jLamFactorConv("#lamina3_material").val();
		var lam3_micra=jLamFactorConv("#lamina3_micra").val();
		var lam3_grm2=jLamFactorConv("#lamina3_grm2").val();
		var conversion3_factor=jLamFactorConv("#conversion3_factor").val();
		var conversion3_grm2=jLamFactorConv("#conversion3_grm2").val();
		var convertir3="OK";
		jLamFactorConv("#lamina3_factconv").empty();		
		jLamFactorConv.post("formula-factor-conversion.php", {lam3_milpul: lam3_milpul, lam3_material: lam3_material, convertir3: convertir3,
		lam3_micra: lam3_micra, lam3_grm2: lam3_grm2, conversion3_factor: conversion3_factor, conversion3_grm2: conversion3_grm2},
			function(data){
				jLamFactorConv("#lamina3_factconv").html(data);
				jLamFactorConv("#progressbar").addClass("ocultar");
			});
	});
	
});
</script>

<!-- CAMBIAR POSICION DE FACTORES DE CONVERSION -->
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script>
var jLamCambPos=jQuery.noConflict();
jLamCambPos(document).ready(function(){
	//LAMINA 1
	jLamCambPos("#factor1_cambiar").click(function(){
		var lam1_material=jLamCambPos("#lamina1_material").val();
		var conversion1_factor=jLamCambPos("#conversion1_factor").val();
		var conversion1_grm2=jLamCambPos("#conversion1_grm2").val();
		var posicion1="OK";
		jLamCambPos.post("formula-factor-conversion.php", {lam1_material: lam1_material, conversion1_factor: conversion1_factor, 
		conversion1_grm2: conversion1_grm2, posicion1: posicion1},
			function(data){
				jLamCambPos("#lamina1_factconv").html(data);
				jLamCambPos("#progressbar").addClass("ocultar");
			});
	});
	
	//LAMINA 2
	jLamCambPos("#factor2_cambiar").click(function(){
		var lam2_material=jLamCambPos("#lamina2_material").val();
		var conversion2_factor=jLamCambPos("#conversion2_factor").val();
		var conversion2_grm2=jLamCambPos("#conversion2_grm2").val();
		var posicion2="OK";
		jLamCambPos.post("formula-factor-conversion.php", {lam2_material: lam2_material, conversion2_factor: conversion2_factor, 
		conversion2_grm2: conversion2_grm2, posicion2: posicion2},
			function(data){
				jLamCambPos("#lamina2_factconv").html(data);
				jLamCambPos("#progressbar").addClass("ocultar");
			});
	});
	
	//LAMINA 3
	jLamCambPos("#factor3_cambiar").click(function(){
		var lam3_material=jLamCambPos("#lamina3_material").val();
		var conversion3_factor=jLamCambPos("#conversion3_factor").val();
		var conversion3_grm2=jLamCambPos("#conversion3_grm2").val();
		var posicion3="OK";
		jLamCambPos.post("formula-factor-conversion.php", {lam3_material: lam3_material, conversion3_factor: conversion3_factor, 
		conversion3_grm2: conversion3_grm2, posicion3: posicion3},
			function(data){
				jLamCambPos("#lamina3_factconv").html(data);
				jLamCambPos("#progressbar").addClass("ocultar");
			});
	});
});
</script>

<!-- CILINDRO -->
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script>
var jCilRep=jQuery.noConflict();
jCilRep(document).ready(function(){
	jCilRep("#dtecnicos_repeticion").change(function(){
		jCilRep("#progressbar").removeClass("ocultar");
		var cilindro = jCilRep("#dtecnicos_cilindro").val();
		var distancia = jCilRep(this).val();
		var tipo = "repeticion";
		jCilRep.post("cilindro-repeticion.php", {distancia: distancia, cilindro: cilindro, tipo: tipo},
			function(data){
				jCilRep("#dato_nrorepeticion").html(data);
				jCilRep("#progressbar").addClass("ocultar");
			});
	});	
});
</script>

<!-- SELECCIONAR MAQUINAS -->
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript" src="/libs_js/jnotify/lib/jquery.jnotify.min.js"></script>
<link type="text/css" href="/libs_js/jnotify/css/jquery.jnotify.css" rel="stylesheet" title="default" media="all" />
<link type="text/css" href="/libs_js/jnotify/css/jquery.jnotify-alt.css" rel="alternate stylesheet" title="alt" media="all" />
<script>
var jslcmaq = jQuery.noConflict();
jslcmaq(document).ready(function(){
	
	jslcmaq("#dtp_selecmaq").click(function(){
		if(jslcmaq("#dtecnicos_cliente").val() == ""){
		    jslcmaq("#dtecnicos_cliente").focus();
			jslcmaq.jnotify("Ingrese dato del Cliente.", "error", 5000);
		    return false;
		}else if(jslcmaq("#dtecnicos_articulo").val() == ""){
		    jslcmaq("#dtecnicos_articulo").focus();
			jslcmaq.jnotify("Ingrese dato del Producto.", "error", 5000);
		    return false;
		}else if(jslcmaq("#dtecnicos_repeticion").val() == 0) {
		    jslcmaq("#dtecnicos_repeticion").focus();
			jslcmaq.jnotify("Ingrese Distancia de Repetición.", "error", 5000);
		    return false;
		}else if(jslcmaq("#dtecnicos_cilindro").val() == "") {
		    jslcmaq("#dtecnicos_cilindro").focus();
			jslcmaq.jnotify("Seleccione Cilindro.", "error", 5000);
		    return false;
		}else if(jslcmaq("#dtecnicos_anchofinal").val() == 0) {
		    jslcmaq("#dtecnicos_anchofinal").focus();
			jslcmaq.jnotify("Ingrese Ancho Final.", "error", 5000);
		    return false;
		}else if(jslcmaq("#dtecnicos_numbandas").val() == "") {
		    jslcmaq("#dtecnicos_numbandas").focus();
			jslcmaq.jnotify("Seleccione Número de Bandas.", "error", 5000);
		    return false;
		}else if(jslcmaq("#dtecnicos_numcolores").val() == "") {
		    jslcmaq("#dtecnicos_numcolores").focus();
			jslcmaq.jnotify("Seleccione Número de Colores.", "error", 5000);
		    return false;
		}else if(jslcmaq("#dtecnicos_tolerancia").val() == 0) {
		    jslcmaq("#dtecnicos_tolerancia").focus();
			jslcmaq.jnotify("Ingrese Porcentaje de Tolerancia.", "error", 5000);
		    return false;
		}else if(jslcmaq("#dtecnicos_unidadmedida").val() == "") {
		    jslcmaq("#dtecnicos_unidadmedida").focus();
			jslcmaq.jnotify("Seleccione Unidad de Medida.", "error", 5000);
		    return false;
		}else if(jslcmaq("#dtecnicos_cantrq").val() == 0) {
		    jslcmaq("#dtecnicos_cantrq").focus();
			jslcmaq.jnotify("Ingrese Cantidad Requerida.", "error", 5000);
		    return false;
		}else if(jslcmaq("#dtecnicos_precio").val() == 0) {
		    jslcmaq("#dtecnicos_precio").focus();
			jslcmaq.jnotify("Ingrese Precio (US$).", "error", 5000);
		    return false;
		}else if(jslcmaq("#dtecnicos_formato").val() == "") {
		    jslcmaq("#dtecnicos_formato").focus();
			jslcmaq.jnotify("Seleccione Formato de Producto Terminado.", "error", 5000);
		    return false;
		}else if(jslcmaq("#procesos_maquinas_4").attr("checked") == "checked" && jslcmaq("#grm2_tintaseca_1").val() == 0) {
			jslcmaq("#grm2_tintaseca_1").focus();
			jslcmaq.jnotify("Ingrese Gr/m2 (Tinta seca) para Impresión.", "error", 5000);
			return false;
		}else if(jslcmaq("#procesos_maquinas_5").val() == 1 && jslcmaq("#bilaminado_proceso_2").val() == 0) {
			jslcmaq("#bilaminado_proceso_2").focus();
			jslcmaq.jnotify("Ingrese Gr/m2 (Adhesivo) para Bilaminado.", "error", 5000);
			return false;
		}else if(jslcmaq("#procesos_maquinas_6").val() == 1 && jslcmaq("#trilaminado_proceso_3").val() == 0) {
			jslcmaq("#trilaminado_proceso_3").focus();
			jslcmaq.jnotify("Ingrese Gr/m2 (Adhesivo) para Trilaminado.", "error", 5000);
			return false;
		}else{
			jslcmaq("#progressbar").removeClass("ocultar");
			var datos = jslcmaq("#formGuardar").serialize();
			jslcmaq.ajax({
				type: "POST", url: "seleccionar-maquinas.php", data: datos,
				success: function(data){
					jslcmaq("#progressbar").addClass("ocultar");
					jslcmaq("#selccion_procesos_maquinas").html(data);
				}
			});
		}
		
	});
});
</script>

</head>

<body>	

<?php include("../../../sis_coesa/header.php"); ?>

<section id="cuerpo">
  <?php require_once("../../../sis_coesa/menu.php"); ?>
  <section id="contenido">
    	
  <div id="datos_procesos">
        	
            <div class="formulario_datos">

              <div class="frmdt_cabecera">
                <h6>Cotización</h6></div>
            
                <div class="frmdt_contenido">
                    
                  <form id="formGuardar" action="actualizar.php" method="post">
                        
                    	<fieldset class="alto50">
                          <label for="dtecnicos_cliente">Cliente:</label>
                          <input name="dtecnicos_cliente" type="text" id="dtecnicos_cliente" value="<?php echo $cotizacion_cliente; ?>">
						</fieldset>
                        
                        <fieldset class="alto50">
                          <label for="dtecnicos_articulo">Producto:</label>
                          <input name="dtecnicos_articulo" type="text" id="dtecnicos_articulo" value="<?php echo $cotizacion_producto; ?>">
						</fieldset>
                        
                        <input name="dtecnicos_grm2" type="hidden" value="0">
                        
                        <fieldset class="alto50 w180">
                          <label for="dtecnicos_cilindro">Cilindro (mm):</label>
                            <select name="dtecnicos_cilindro" id="dtecnicos_cilindro" class="w140">
                                <option value>Seleccione</option>
                                <?php while($fila_cilindro=mysql_fetch_array($rst_cilindro)){
									$cilindro_id=$fila_cilindro["id_cilindro"];
									$cilindro_nombre=$fila_cilindro["cilindro"]."/".$fila_cilindro["engranaje"];
								?>
									<?php if ($cotizacion_cilindro==$cilindro_id){ ?>
                                        <option selected value="<?php echo $cilindro_id; ?>"><?php echo $cilindro_nombre; ?></option>
                                    <?php }else{ ?>
                                        <option value="<?php echo $cilindro_id; ?>"><?php echo $cilindro_nombre; ?></option>
                                    <?php } ?>
                              	<?php } ?>
                            </select>
                        </fieldset>
                        
                        <fieldset class="alto50 w180">
                          <label for="dtecnicos_repeticion">Distancia de repeticion (mm):</label>
                          <input name="dtecnicos_repeticion" type="text" id="dtecnicos_repeticion" class="w130" value="<?php echo $cotizacion_repeticion; ?>">
						</fieldset>
                        
                        <div class="float_left w180" id="dato_nrorepeticion">
                        <fieldset class="alto50 w180">
                          <label for="dtecnicos_frecuencia">Nro de Repeticiones (Und):</label>
                          <input name="dtecnicos_frecuencia" type="text" id="dtecnicos_frecuencia" class="w130" value="<?php echo $cotizacion_frecuencia; ?>" readonly>
						</fieldset>
                        </div>
                        
                        <fieldset class="alto50 w180">
                          <label for="dtecnicos_anchofinal">Ancho Final (mm):</label>
                          <input name="dtecnicos_anchofinal" type="text" id="dtecnicos_anchofinal" class="w130" value="<?php echo $cotizacion_anchofinal; ?>">
						</fieldset>
                        
                        <fieldset class="alto50 w180" id="item-nrobandas">
                          <label for="dtecnicos_numbandas">Número de bandas:</label>
                            <select name="dtecnicos_numbandas" id="dtecnicos_numbandas" class="w140">
                                <option value>Seleccione</option>
                                <?php for($i=1; $i<=$nroBandas; $i++){ ?>
									<?php if ($cotizacion_nrobandas==$i){ ?>
                                        <option selected='' value="<?php echo $cotizacion_nrobandas; ?>"><?php echo $cotizacion_nrobandas; ?></option>
                                    <?php }else{ ?>
                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php } ?>
                              	<?php } ?>
                            </select>
                        </fieldset>
                        
              			<fieldset class="alto50 w180">
                            <label for="dtecnicos_numcolores">Número de colores:</label>
                            <select name="dtecnicos_numcolores" id="dtecnicos_numcolores" class="w140">
                              <option value>Seleccione</option>
                              <?php for($j=1; $j<=$mqdt_colores_estacion; $j++){ ?>
									<?php if ($cotizacion_nrocolores==$j){ ?>
                                        <option selected='' value="<?php echo $cotizacion_nrocolores; ?>"><?php echo $cotizacion_nrocolores; ?></option>
                                    <?php }else{ ?>
                                        <option value="<?php echo $j; ?>"><?php echo $j; ?></option>
                                    <?php } ?>
                              	<?php } ?>
                            </select>
						</fieldset>                        
                        
                        <fieldset class="alto50 w180">
                          <label for="dtecnicos_tolerancia">% Tolerancia:</label>
                          <input name="dtecnicos_tolerancia" type="text" id="dtecnicos_tolerancia" class="w130" value="<?php echo $cotizacion_tolerancia; ?>">
						</fieldset>
                        
                        <fieldset class="alto50 w180">
                            <label for="dtecnicos_unidadmedida">Unidad de medida:</label>
                            <select name="dtecnicos_unidadmedida" id="dtecnicos_unidadmedida" class="w140">
                              <option value>Seleccione</option>
                              	<?php while($fila_unmedida=mysql_fetch_array($rst_unmedida)){
									$unmedida_id=$fila_unmedida["id_unidad_medida"];
									$unmedida_nombre=$fila_unmedida["nombre_unidad_medida"];
									
									if ($cotizacion_unidadmedida==$unmedida_id){ 								  
								?>
                                	<option selected value="<?php echo $unmedida_id; ?>"><?php echo $unmedida_nombre; ?></option>
                                <?php }else{ ?>
                                	<option value="<?php echo $unmedida_id; ?>"><?php echo $unmedida_nombre; ?></option>
                                <?php }} ?>
                            </select>
						</fieldset>
                        
                        <fieldset class="alto50 w180">
                        	<div id="dtecnicos_cantrq_texto"><label for="dtecnicos_cantrq">Cantidad Requerida:</label></div>
                          <input name="dtecnicos_cantrq" type="text" id="dtecnicos_cantrq" class="w130" value="<?php echo $cotizacion_cantcliente; ?>">
						</fieldset>
                        
                        <fieldset class="alto50 w180">
                          <label for="dtecnicos_precio">Precio (US$):</label>
                          <input name="dtecnicos_precio" type="text" id="dtecnicos_precio" class="w130" value="<?php echo $cotizacion_precio; ?>">
						</fieldset>
                        
                        <fieldset class="alto50 w215">
                            <label for="dtecnicos_formato">Formato de Producto Terminado:</label>
                            <select name="dtecnicos_formato" id="dtecnicos_formato" class="w140">
                              <option value>Seleccione</option>
                              <?php if($cotizacion_formato==1){ ?>
                              <option selected value="1">Lamina</option>
                              <option value="2">Manga</option>
                              <?php }elseif($cotizacion_formato==2){ ?>
                              <option value="1">Lamina</option>
                              <option selected value="2">Manga</option>
                              <?php } ?>
                            </select>
						</fieldset>
                        
                        <div id="datos_lamproc" class="an100 float_left">
                        	
                            <div class="w245 float_left border_der margin_r10">
                            	
                                <h2>Monocapa</h2><br>
                                
                                <fieldset class="alto50 w235">
                                  <label for="dt_articulo1">Laminas:</label>
                                  <select name="dt_articulo1" id="dt_articulo1" class="cmbSlc w180">
                                    <option value>[ Seleccionar opcion ]</option>
                                    <?php while($fila_lamina1=mysql_fetch_array($rst_lamina1)){
											//VARIABLES
											$lamina1_id=$fila_lamina1["id_articulo"];
											$lamina1_nombre=$fila_lamina1["nombre_articulo"];
											$lamina1_ancho=$fila_lamina1["ancho_articulo"];
											$lamina1_tipo=$fila_lamina1["id_tipo_articulo"];
											
											//FILTRO POLIETILENO
											$filtro1_polietileno=BuscarPalabra("POLIETILENO", $lamina1_nombre);
											$filtro1_pebd=BuscarPalabra("PEBD", $lamina1_nombre);
											$filtro1_pead=BuscarPalabra("PEAD", $lamina1_nombre);
											$filtro1_ppp=BuscarPalabra("PPP", $lamina1_nombre);
											
											if($cotizacion_lamina1==$lamina1_id){?>
										<option selected value="<?php echo $lamina1_id; ?>"><?php echo $lamina1_nombre; ?></option>
									<?php }elseif($filtro1_polietileno==1 or $filtro1_pead==1 or $filtro1_pebd==1 or $filtro1_ppp==1){
												if($lamina1_ancho>=$formula_filtro_polietileno){ ?>
										<option value="<?php echo $lamina1_id; ?>"><?php echo $lamina1_nombre; ?></option>
                                    <?php }}elseif($lamina1_tipo<>13){
												if($lamina1_ancho>=$formula_filtro_lamina){ ?>
										<option value="<?php echo $lamina1_id; ?>"><?php echo $lamina1_nombre; ?></option>
                                    <?php }}elseif($lamina1_tipo==13){
												if($lamina1_ancho>=$formula_filtro_manga){?>
										<option value="<?php echo $lamina1_id; ?>"><?php echo $lamina1_nombre; ?></option>
                                    <?php }}} ?>
                                    
                                  </select>
                                  
                                    <a id="lamina1_select" class="boton_lamina"  href="javascript:;"></a>
                                  
                                </fieldset>

                                <div id="lamina1_procesos" class="w245 float_left">
                                	
                                    <?php if($cotizacion_lamina1>0){
											$lamina1_material=seleccionTabla($cotizacion_lamina1_factor_material, "id_factor", "syCoesa_mantenimiento_factor_conversion", $conexion);
									?>
                                    
                                    <?php if($lamina1_material["tipo"]==1 and $cotizacion_conversion1_factor==1){ ?>
			                        	<div id="lamina1_factconv">
                                        <fieldset class="alto50 w120" id="factor_lam1">
                                            <label for="lamina1_milpul">Mil. Pulgada:</label>
                                            <input name="lamina1_milpul" type="text" class="texto_cen w90 factor_conversion_lam1" id="lamina1_milpul" value="<?php echo $cotizacion_lamina1_factor_milpul; ?>" >
                                            <input name="lamina1_material" id="lamina1_material" type="hidden" value="<?php echo $cotizacion_lamina1_factor_material; ?>">
                                            <input name="lamina1_micra" id="lamina1_micra" type="hidden" value="0">
                                            <input name="conversion1_factor" id="conversion1_factor" type="hidden" value="1">
                                        </fieldset>
                                        <fieldset class="alto50 w120" id="grm2_lam1">
                                            <label for="lamina1_grm2">GR / M2</label>
                                            <input class="texto_cen w90" name="lamina1_grm2" type="text" id="lamina1_grm2" value="0" readonly>
                                            <input name="conversion1_grm2" id="conversion1_grm2" type="hidden" value="0">
                                        </fieldset>
                                        </div>
                                        <fieldset class="w120">
                                            <a href="javascript:;" class="boton_conv" id="factor1_cambiar">Cambiar</a>
                                        </fieldset>
                                        <fieldset class="w120">
                                            <a href="javascript:;" class="boton_conv" id="factor1_convertir">Convertir</a>
                                        </fieldset>
			                        <?php }elseif($cotizacion_lamina1_factor_micra>0 and $cotizacion_lamina1_grm2>0){ ?>
			                        	 <fieldset class="alto50 w120">
			                              <label for="lamina1_micra">Micra:</label>
			                              <input name="lamina1_micra" type="text" class="w100 texto_cen" id="lamina1_micra" value="<?php echo $cotizacion_laminacotizacion_lamina1_factor_micra; ?>" size="50">
			                              <input name="lamina1_grm2" type="hidden" id="lamina1_grm2" value="<?php echo $cotizacion_lamina1_grm2; ?>">
			                              <input name="lamina1_milpul" type="hidden" id="lamina1_milpul" value="<?php echo $cotizacion_lamina1_factor_milpul; ?>">
			                              <input name="lamina1_material" id="lamina1_material" type="hidden" value="<?php echo $cotizacion_lamina1_factor_material; ?>">
			                            </fieldset>
			                        <?php }elseif($cotizacion_lamina1_factor_micra==0 and $cotizacion_lamina1_factor_milpul==0 and $cotizacion_lamina1_grm2>0){ ?>
			                            <fieldset class="w120">
	                                        <label for="lamina1_grm2">GR / M2</label>
	                                        <input name="lamina1_grm2" type="text" id="lamina1_grm2" class="w100 texto_der" value="<?php echo $cotizacion_lamina1_grm2; ?>">
	                                        <input name="lamina1_milpul" type="hidden" id="lamina1_milpul" value="<?php echo $cotizacion_lamina1_factor_milpul; ?>">
			                                <input name="lamina1_micra" type="hidden" id="lamina1_micra" value="<?php echo $cotizacion_lamina1_factor_micra; ?>">
			                                <input name="lamina1_material" id="lamina1_material" type="hidden" value="<?php echo $cotizacion_lamina1_factor_material; ?>">
	                                    </fieldset>
			                        <?php } ?>
                                    
                                    <fieldset class="w120">
                                        <label for="lamina1_ancho">Ancho</label>
                                        <input class="w100 texto_der" name="lamina1_ancho" type="text" id="lamina1_ancho" value="<?php echo $cotizacion_lamina1_ancho; ?>">
                                    </fieldset>
                                    
                                    <?php if($filtro1_polietileno==1 or $filtro1_pebd==1 or $filtro1_pead==1 or $filtro1_ppp==1){ ?>
                                    <fieldset class="w235">
                                        <?php if($cotizacion_lamina1_extrusion==1){ ?>
                                        <label><input checked id="procesos_maquinas_3" class="procesos_maquinas" name="extrusion1" type="checkbox" value="1">&nbsp;Extrusión</label>
                                        <?php }else{ ?>
                                        <label><input id="procesos_maquinas_3" class="procesos_maquinas" name="extrusion1" type="checkbox" value="1">&nbsp;Extrusión</label>
                                        <?php } ?>
                                    </fieldset>
                                    <?php } ?>
                                    
                                    <fieldset class="w235">
                                        <?php if($cotizacion_lamina1_impresion==1){ ?>
                                        <label><input checked id="procesos_maquinas_4" class="procesos_maquinas" name="impresion1" type="checkbox" value="1">&nbsp;Impresión</label>
                                        <?php }else{ ?>
                                        <label><input id="procesos_maquinas_4" class="procesos_maquinas" name="impresion1" type="checkbox" value="1">&nbsp;Impresión</label>
                                        <?php } ?>
                                    </fieldset>
                                    
                                    <fieldset class="w235">
                                        <label for="grm2_tintaseca_1">GR / m2 (Tinta seca)</label>
                                      <input class="w140 texto_der" name="grm2_tintaseca_1" type="text" id="grm2_tintaseca_1" value="<?php echo $cotizacion_lamina1_impresion_grm2; ?>">
                                    </fieldset>
                                    
                                    <fieldset class="w235">
                                        <?php if($cotizacion_lamina1_rebobinado==1){ ?>
                                        <label><input checked id="procesos_maquinas_9" class="procesos_maquinas" name="rebobinado1" type="checkbox" value="1">&nbsp;Rebobinado</label>
                                        <?php }else{ ?>
                                        <label><input id="procesos_maquinas_9" class="procesos_maquinas" name="rebobinado1" type="checkbox" value="1">&nbsp;Rebobinado</label>
                                        <?php } ?>
                                    </fieldset>
                                	
                                    <?php } ?>
                                    
                                </div>
                                
                            </div><!-- FIN LAMINA 1 -->
                            
                            <div class="w245 float_left border_der margin_r10">
                            	
                                <h2>Bilaminado</h2><br>
                                
                                <fieldset class="alto50 w235">
                                  <label for="dt_articulo2">Laminas:</label>
                                  <select name="dt_articulo2" id="dt_articulo2" class="cmbSlc">
                                    <option value>[ Seleccionar opcion ]</option>
                                    <?php while($fila_lamina2=mysql_fetch_array($rst_lamina2)){
											//VARIABLES
											$lamina2_id=$fila_lamina2["id_articulo"];
											$lamina2_nombre=$fila_lamina2["nombre_articulo"];
											$lamina2_ancho=$fila_lamina2["ancho_articulo"];
											$lamina2_tipo=$fila_lamina2["id_tipo_articulo"];
											
											//FILTRO POLIETILENO
											$filtro2_polietileno=BuscarPalabra("POLIETILENO", $lamina2_nombre);
											$filtro2_pebd=BuscarPalabra("PEBD", $lamina2_nombre);
											$filtro2_pead=BuscarPalabra("PEAD", $lamina2_nombre);
											$filtro2_ppp=BuscarPalabra("PPP", $lamina2_nombre);
											
									if($cotizacion_lamina2==$lamina2_id){?>
										<option selected value="<?php echo $lamina2_id; ?>"><?php echo $lamina2_nombre; ?></option>
									<?php }elseif($filtro2_polietileno==1 or $filtro2_pead==1 or $filtro2_pebd==1 or $filtro2_ppp==1){
												if($lamina2_ancho>=$formula_filtro_polietileno){ ?>
										<option value="<?php echo $lamina2_id; ?>"><?php echo $lamina2_nombre; ?></option>
                                    <?php }}elseif($lamina2_tipo<>13){
												if($lamina2_ancho>=$formula_filtro_lamina){ ?>
										<option value="<?php echo $lamina2_id; ?>"><?php echo $lamina2_nombre; ?></option>
                                    <?php }}elseif($lamina2_tipo==13){
												if($lamina2_ancho>=$formula_filtro_manga){?>
										<option value="<?php echo $lamina2_id; ?>"><?php echo $lamina2_nombre; ?></option>
                                    <?php }}} ?>
                                                                       
                                  </select>
                                  
                                    <a id="lamina2_select" class="boton_lamina"  href="javascript:;"></a>
                                  
                                </fieldset>
                                
                                <div id="lamina2_procesos" class="w245 float_left">
                                	
                                    <?php if($cotizacion_lamina2>0){ ?>
                                    
                                    <fieldset class="w120">
                                        <label for="lamina2_ancho">Ancho</label>
                                        <input class="w100 texto_der" name="lamina2_ancho" type="text" id="lamina2_ancho" value="<?php echo $cotizacion_lamina2_ancho; ?>">
                                    </fieldset>
                                    
                                    <?php if($cotizacion_lamina2_factor_milpul>0 and $cotizacion_lamina2_grm2>0){ ?>
			                        	<fieldset class="alto50 w120">
			                              <label for="lamina2_milpul">Milesima de Pulgada:</label>
			                              <input name="lamina2_milpul" type="text" class="w100 texto_cen" id="lamina2_milpul" value="<?php echo $cotizacion_lamina2_factor_milpul; ?>" size="50">
			                              <input name="lamina2_grm2" type="hidden" id="lamina2_grm2" value="<?php echo $cotizacion_lamina2_grm2; ?>">
			                              <input name="lamina2_micra" type="hidden" id="lamina2_micra" value="<?php echo $cotizacion_lamina2_factor_micra; ?>">
			                              <input name="lamina2_material" id="lamina2_material" type="hidden" value="<?php echo $cotizacion_lamina2_factor_material; ?>">
			                          	</fieldset>
			                        <?php }elseif($cotizacion_lamina2_factor_micra>0 and $cotizacion_lamina2_grm2>0){ ?>
			                        	 <fieldset class="alto50 w120">
			                              <label for="lamina2_micra">Micra:</label>
			                              <input name="lamina2_micra" type="text" class="w100 texto_cen" id="lamina2_micra" value="<?php echo $cotizacion_lamina2_factor_micra; ?>" size="50">
			                              <input name="lamina2_grm2" type="hidden" id="lamina2_grm2" value="<?php echo $cotizacion_lamina2_grm2; ?>">
			                              <input name="lamina2_milpul" type="hidden" id="lamina2_milpul" value="<?php echo $cotizacion_lamina2_factor_milpul; ?>">
			                              <input name="lamina2_material" type="hidden" id="lamina2_material" value="<?php echo $cotizacion_lamina2_factor_material; ?>">
			                            </fieldset>
			                        <?php }elseif($cotizacion_lamina2_factor_micra==0 and $cotizacion_lamina2_factor_milpul==0 and $cotizacion_lamina2_grm2>0){ ?>
			                            <fieldset class="w120">
	                                        <label for="lamina2_grm2">GR / M2</label>
	                                        <input name="lamina2_grm2" type="text" id="lamina2_grm2" class="w100 texto_der" value="<?php echo $cotizacion_lamina2_grm2; ?>">
	                                        <input name="lamina2_milpul" type="hidden" id="lamina2_milpul" value="<?php echo $cotizacion_lamina2_factor_milpul; ?>">
			                                <input name="lamina2_micra" type="hidden" id="lamina2_micra" value="<?php echo $cotizacion_lamina2_micra; ?>">
			                                <input name="lamina2_material" type="hidden" id="lamina2_material" value="<?php echo $cotizacion_lamina2_material; ?>">
	                                    </fieldset>
			                        <?php } ?>

                                    <?php if($filtro2_polietileno==1 or $filtro2_pebd==1 or $filtro2_pead==1 or $filtro2_ppp==1){ ?>
                                    <fieldset class="w235">
                                        <?php if($cotizacion_lamina2_extrusion==1){ ?>
                                        <label><input checked id="procesos_maquinas_3" class="procesos_maquinas" name="extrusion2" type="checkbox" value="1">&nbsp;Extrusión</label>
                                        <?php }else{ ?>
                                        <label><input id="procesos_maquinas_3" class="procesos_maquinas" name="extrusion2" type="checkbox" value="1">&nbsp;Extrusión</label>
                                        <?php } ?>
                                    </fieldset>
                                    <?php } ?>
                                    
									<input id="procesos_maquinas_5" name="bilaminado2" type="hidden" value="1">
                                    
                                    <fieldset class="w235">
                                        <label for="bilaminado_proceso_2">GR / m2 (Adhesivo)</label>
                                      <input class="w140 texto_der" name="bilaminado_proceso_2" type="text" id="bilaminado_proceso_2" value="<?php echo $cotizacion_lamina2_bilaminado_grm2; ?>">
                                    </fieldset>
                                                                    
                                    <input name="rebobinado2" type="hidden" value="0">
                                	
                                    <?php } ?>
                                    
                                </div>
                                
                            </div><!-- FIN LAMINA 2 -->
                            
                            <div class="w245 float_left border_der margin_r10">
                            	
                                <h2>Trilaminado</h2><br>
                            
                                <fieldset class="alto50 w235">
                                  <label for="dt_articulo3">Laminas:</label>
                                  <select name="dt_articulo3" id="dt_articulo3" class="cmbSlc">
                                    <option value>[ Seleccionar opcion ]</option>
                                    <?php while($fila_lamina3=mysql_fetch_array($rst_lamina3)){
											//VARIABLES
											$lamina3_id=$fila_lamina3["id_articulo"];
											$lamina3_nombre=$fila_lamina3["nombre_articulo"];
											$lamina3_ancho=$fila_lamina3["ancho_articulo"];
											$lamina3_tipo=$fila_lamina3["id_tipo_articulo"];
											
											$filtro3_polietileno=BuscarPalabra("POLIETILENO", $lamina3_nombre);
											$filtro3_pebd=BuscarPalabra("PEBD", $lamina3_nombre);
											$filtro3_pead=BuscarPalabra("PEAD", $lamina3_nombre);
											$filtro3_ppp=BuscarPalabra("PPP", $lamina3_nombre);
											
									if($cotizacion_lamina3==$lamina3_id){?>
										<option selected value="<?php echo $lamina3_id; ?>"><?php echo $lamina3_nombre; ?></option>
									<?php }elseif($filtro3_polietileno==1 or $filtro3_pead==1 or $filtro3_pebd==1 or $filtro3_ppp==1){
												if($lamina3_ancho>=$formula_filtro_polietileno){ ?>
										<option value="<?php echo $lamina3_id; ?>"><?php echo $lamina3_nombre; ?></option>
                                    <?php }}elseif($lamina3_tipo<>13){
												if($lamina3_ancho>=$formula_filtro_lamina){ ?>
										<option value="<?php echo $lamina3_id; ?>"><?php echo $lamina3_nombre; ?></option>
                                    <?php }}elseif($lamina3_tipo==13){
												if($lamina3_ancho>=$formula_filtro_manga){?>
										<option value="<?php echo $lamina3_id; ?>"><?php echo $lamina3_nombre; ?></option>
                                    <?php }}} ?>
                                    
                                  </select>
                                  
                                    <a id="lamina3_select" class="boton_lamina"  href="javascript:;"></a>
                                  
                                </fieldset>
                                                            
                                <div id="lamina3_procesos" class="w245 float_left">
                                	
                                    <?php if($cotizacion_lamina3>0){ ?>
                                    
                                    <fieldset class="w120">
                                        <label for="lamina3_ancho">Ancho</label>
                                        <input class="w100 texto_der" name="lamina3_ancho" type="text" id="lamina3_ancho" value="<?php echo $cotizacion_lamina3_ancho; ?>">
                                    </fieldset>
                                    

                                    <?php if($cotizacion_lamina3_factor_milpul>0 and $cotizacion_lamina3_grm2>0){ ?>
			                        	<fieldset class="alto50 w120">
			                              <label for="lamina3_milpul">Milesima de Pulgada:</label>
			                              <input name="lamina3_milpul" type="text" class="w100 texto_cen" id="lamina3_milpul" value="<?php echo $cotizacion_lamina3_factor_milpul; ?>" size="50">
			                              <input name="lamina3_grm2" type="hidden" id="lamina3_grm2" value="<?php echo $cotizacion_lamina3_grm2; ?>">
			                              <input name="lamina3_micra" type="hidden" id="lamina3_micra" value="<?php echo $cotizacion_lamina3_factor_micra; ?>">
			                              <input name="lamina3_material" id="lamina3_material" type="hidden" value="<?php echo $cotizacion_lamina3_factor_material; ?>">
			                          	</fieldset>
			                        <?php }elseif($cotizacion_lamina3_factor_micra>0 and $cotizacion_lamina3_grm2>0){ ?>
			                        	 <fieldset class="alto50 w120">
			                              <label for="lamina3_micra">Micra:</label>
			                              <input name="lamina3_micra" type="text" class="w100 texto_cen" id="lamina3_micra" value="<?php echo $cotizacion_lamina3_factor_micra; ?>" size="50">
			                              <input name="lamina3_grm2" type="hidden" id="lamina3_grm2" value="<?php echo $cotizacion_lamina3_grm2; ?>">
			                              <input name="lamina3_milpul" type="hidden" id="lamina3_milpul" value="<?php echo $cotizacion_lamina3_factor_milpul; ?>">
			                              <input name="lamina3_material" type="hidden" id="lamina3_material" value="<?php echo $cotizacion_lamina3_factor_material; ?>">
			                            </fieldset>
			                        <?php }elseif($cotizacion_lamina3_micra==0 and $cotizacion_lamina3_milpul==0 and $cotizacion_lamina3_grm2>0){ ?>
			                            <fieldset class="w120">
	                                        <label for="lamina3_grm2">GR / M2</label>
	                                        <input name="lamina3_grm2" type="text" id="lamina3_grm2" class="w100 texto_der" value="<?php echo $cotizacion_lamina3_grm2; ?>">
	                                        <input name="lamina3_milpul" type="hidden" id="lamina3_milpul" value="<?php echo $cotizacion_lamina3_factor_milpul; ?>">
			                                <input name="lamina3_micra" type="hidden" id="lamina3_micra" value="<?php echo $cotizacion_lamina3_micra; ?>">
			                                <input name="lamina3_material" type="hidden" id="lamina3_material" value="<?php echo $cotizacion_lamina3_material; ?>">
	                                    </fieldset>
			                        <?php } ?>

                                    
                                    <?php if($filtro3_polietileno==1 or $filtro3_pebd==1 or $filtro3_pead==1 or $filtro3_ppp==1){ ?>
                                    <fieldset class="w235">
                                        <?php if($cotizacion_lamina3_extrusion==1){ ?>
                                        <label><input checked id="procesos_maquinas_3" class="procesos_maquinas" name="extrusion3" type="checkbox" value="1">&nbsp;Extrusión</label>
                                        <?php }else{ ?>
                                        <label><input id="procesos_maquinas_3" class="procesos_maquinas" name="extrusion3" type="checkbox" value="1">&nbsp;Extrusión</label>
                                        <?php } ?>                                    
                                    </fieldset>
                                    <?php } ?>
                                    
                                    <input id="procesos_maquinas_6" name="trilaminado3" type="hidden" value="1">
                                    
                                    <fieldset class="w235">
                                        <label for="trilaminado_proceso_3">GR / m2 (Adhesivo)</label>
                                      <input class="w140 texto_der" name="trilaminado_proceso_3" type="text" id="trilaminado_proceso_3" value="<?php echo $cotizacion_lamina3_trilaminado_grm2; ?>">
                                    </fieldset>
                                    
                                    <input name="rebobinado2" type="hidden" value="0">
                                	
                                    <?php } ?>
                                    
                                </div>
                                
                            </div><!-- FIN LAMINA 3 -->
                        	
                            <div class="w245 float_left border_der margin_r10">
                            	
                                <h2>Acabado</h2><br>
                                <fieldset class="w245">
                                	<?php if($cotizacion_lamina1_cortefinal==1){ ?>
                                    <label><input checked id="procesos_maquinas_7" class="procesos_maquinas" name="cortefinal" type="checkbox" value="1">&nbsp;Corte</label>
                                    <?php }else{ ?>
                                    <label><input id="procesos_maquinas_7" class="procesos_maquinas" name="cortefinal" type="checkbox" value="1">&nbsp;Corte</label>
                                    <?php } ?>
                                </fieldset>
                                
                                <fieldset class="w245">
                                	<?php if($cotizacion_lamina1_sellado==1){ ?>
                                    <label><input checked id="procesos_maquinas_8" class="procesos_maquinas" name="sellado" type="checkbox" value="1">&nbsp;Sellado</label>
                                    <?php }else{ ?>
                                    <label><input id="procesos_maquinas_8" class="procesos_maquinas" name="sellado" type="checkbox" value="1">&nbsp;Sellado</label>
                                    <?php } ?>
                                </fieldset>
                            
                            </div>
                            
                </div><!-- FIN datos_lamproc -->
                        
                        <fieldset class="an100 float_left">
                            <a href="javascript:;" name="dtp_selecmaq" id="dtp_selecmaq">Seleccionar maquinas</a>
                        </fieldset>
                        	
                        <div id="selccion_procesos_maquinas" class="an100 float_left padding_tb10">
                        	
                            <fieldset class="alto50 w180 float_left">
                                <label for="dtecnicos_grm2_total">Gr / m2:</label>
                                <input name="dtecnicos_grm2_total" type="text" id="dtecnicos_grm2_total" class="w130" value="<?php echo number_format($cotizacion_grm2total,1); ?>">
                            </fieldset>
                            
                            <fieldset class="alto50 w180 float_left">
                                <label for="dtecnicos_cantrequerida">Cantidad requerida:</label>
                                <input name="dtecnicos_cantrequerida" type="text" id="dtecnicos_cantrequerida" class="w130" value="<?php echo $cotizacion_cantproduccion; ?>">
                            </fieldset>
                            
                            <fieldset class="alto50 w180 float_left">
                                <label for="dtecnicos_metrosproducir">Metros a producir:</label>
                                <input name="dtecnicos_metrosproducir" type="text" id="dtecnicos_metrosproducir" class="w130" value="<?php echo $cotizacion_metrosproducir; ?>">
                            </fieldset>
                            
                            <div class="float_left an100"><h2>Procesos</h2></div>
                            
                            <table width="100%" border="1" cellspacing="5" cellpadding="5" class="float_left">
                                    <thead>
                                        <tr>
                                            <td width="8.3%" class="texto_cen texto_10 fondo_c1 texto_bold">Procesos</td>
                                            <td width="13%" class="texto_cen texto_10 fondo_c1 texto_bold">Maquinas</td>
                                            <td width="8%" class="texto_cen texto_10 fondo_c1 texto_bold">Cantidad</td>
                                            <td width="8%" class="texto_cen texto_10 fondo_c1 texto_bold">Velocidad <br>por minuto</td>
                                            <td width="8.3%" class="texto_cen texto_10 fondo_c1 texto_bold">Prepar. <br>(HH:mm)</td>
                                            <td width="8.3%" class="texto_cen texto_10 fondo_c1 texto_bold">Regulac. <br>(HH:mm)</td>
                                            <td width="8%" class="texto_cen texto_10 fondo_c1 texto_bold">Tiempo (HH:mm)</td>
                                            <td width="8%" class="texto_cen texto_10 fondo_c1 texto_bold">Costo <br>Kw / <br>Hora</td>
                                            <td width="8%" class="texto_cen texto_10 fondo_c1 texto_bold">Costo <br>Hora / <br>Hombre</td>
                                            <td width="8%" class="texto_cen texto_10 fondo_c1 texto_bold">Costo <br>Deprec. <br>/ Hora</td>
                                            <td width="8%" class="texto_cen texto_10 fondo_c1 texto_bold">Gastos <br>Fábrica <br>/ Hora </td>
                                            <td width="8.3%" class="texto_cen texto_10 fondo_c1 texto_bold">Importe</td>
                                        </tr>
                                    </thead>
                          </table>
                                
                            <div class="float_left" style="width:100%;">
                            
                            <?php if($proc_extrusion_impresion>0){ ?>
                                <div style="width:8.3%; height:20px; padding:1% 0;" class="float_left texto_izq">Extrusión Impr.</div>
								<div style="width:13%; height:20px; padding:1% 0;" class="float_left texto_cen">
                                        
                                  <!-- SELECCIONAR -->
                                  <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
                                  <script>
                                        var jcmbPro1 = jQuery.noConflict();
                                        jcmbPro1(document).ready(function(){
											var maq = jcmbPro1("select#maquina_1 option:selected").val();
											jcmbPro1.post("consulta-maquinas-datos.php", {maquina: maq, metroproducir: <?php echo $totalKg_impresion; ?>},
												function(data){
													jcmbPro1("#progressbar").addClass("ocultar");
													jcmbPro1('.datos_maquina_1').html(data);
												});
																						
                                            jcmbPro1("#maquina_1").change(function() {
												jcmbPro1("#progressbar").removeClass("ocultar");
												var maq = jcmbPro1("select#maquina_1 option:selected").val();
												
												jcmbPro1.post("consulta-maquinas-datos.php", {maquina: maq, metroproducir: <?php echo $totalKg_impresion; ?>},
													function(data){
														jcmbPro1("#progressbar").addClass("ocultar");
														jcmbPro1('.datos_maquina_1').html(data);
													});
											});
                                        });
                                        </script>
                                        
                                        <select name="maquina1" id="maquina_1" class="w130">
                                            <option value="0">------------------</option>
                                            <?php
                                            //EXTRAER MAQUINAS RELACIONADAS AL PROCESO
                                            $rst_maq=mysql_query("SELECT * FROM syCoesa_mantenimiento_maquinas_datos WHERE mostrar_maquina=1 ORDER BY id_maquina ASC", $conexion);
                                            while($fila_maq=mysql_fetch_array($rst_maq)){
                                
                                                $maq_procesos=$fila_maq["procesos_productivos_maquina"];
                                                $maquina=seleccionTabla($fila_maq["id_maquina"],"id_maquina", "syCoesa_mantenimiento_maquinas", $conexion);
                                            
                                                if(ereg(3, $maq_procesos)){
													if($proc_extrusion_impresion==$maquina["id_maquina"]){
											?>
                                                <option selected value="<?php echo $maquina["id_maquina"]; ?>"><?php echo $maquina["nombre_maquina"]; ?></option>
                                                <?php }else{ ?>
                                            	<option value="<?php echo $maquina["id_maquina"]; ?>"><?php echo $maquina["nombre_maquina"]; ?></option>
                                            <?php }}} ?>
                                            
                                        </select>
                                </div>
                                <div class="datos_maquina_1"></div>
                            <?php } //FIN EXTRUSION ?>
                            
                            <?php if($proc_extrusion_bilaminado>0){ ?>
                                <div style="width:8.3%; height:20px; padding:1% 0;" class="float_left texto_izq">Extrusión Bi.</div>
								<div style="width:13%; height:20px; padding:1% 0;" class="float_left texto_cen">
                                        
                                  <!-- SELECCIONAR -->
                                  <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
                                  <script>
                                        var jcmbProExbi = jQuery.noConflict();
                                        jcmbProExbi(document).ready(function(){
											var maq = jcmbProExbi("select#maquina_exbi option:selected").val();
											jcmbProExbi.post("consulta-maquinas-datos.php", {maquina: maq, metroproducir: <?php echo $totalKg_bilaminado; ?>},
												function(data){
													jcmbProExbi("#progressbar").addClass("ocultar");
													jcmbProExbi('.datos_maquina_exbi').html(data);
												});
																						
                                            jcmbProExbi("#maquina_exbi").change(function() {
												jcmbProExbi("#progressbar").removeClass("ocultar");
												var maq = jcmbProExbi("select#maquina_exbi option:selected").val();
												
												jcmbProExbi.post("consulta-maquinas-datos.php", {maquina: maq, metroproducir: <?php echo $totalKg_bilaminado; ?>},
													function(data){
														jcmbProExbi("#progressbar").addClass("ocultar");
														jcmbProExbi('.datos_maquina_exbi').html(data);
													});
											});
                                        });
                                        </script>
                                        
                                        <select name="maquina_exbi" id="maquina_exbi" class="w130">
                                            <option value="0">------------------</option>
                                            <?php
                                            //EXTRAER MAQUINAS RELACIONADAS AL PROCESO
                                            $rst_maq=mysql_query("SELECT * FROM syCoesa_mantenimiento_maquinas_datos WHERE mostrar_maquina=1 ORDER BY id_maquina ASC", $conexion);
                                            while($fila_maq=mysql_fetch_array($rst_maq)){
                                
                                                $maq_procesos=$fila_maq["procesos_productivos_maquina"];
                                                $maquina=seleccionTabla($fila_maq["id_maquina"],"id_maquina", "syCoesa_mantenimiento_maquinas", $conexion);
                                            
                                                if(ereg(3, $maq_procesos)){
													if($proc_extrusion_bilaminado==$maquina["id_maquina"]){
											?>
                                                <option selected value="<?php echo $maquina["id_maquina"]; ?>"><?php echo $maquina["nombre_maquina"]; ?></option>
                                                <?php }else{ ?>
                                            	<option value="<?php echo $maquina["id_maquina"]; ?>"><?php echo $maquina["nombre_maquina"]; ?></option>
                                            <?php }}} ?>
                                            
                                        </select>
                                </div>
                                <div class="datos_maquina_exbi"></div>
                            <?php } //FIN EXTRUSION ?>
                            
                            <?php if($proc_extrusion_trilaminado>0){ ?>
                                <div style="width:8.3%; height:20px; padding:1% 0;" class="float_left texto_izq">Extrusión Tri.</div>
								<div style="width:13%; height:20px; padding:1% 0;" class="float_left texto_cen">
                                        
                                  <!-- SELECCIONAR -->
                                  <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
                                  <script>
                                        var jcmbProExtri = jQuery.noConflict();
                                        jcmbProExtri(document).ready(function(){
											var maq = jcmbProExtri("select#maquina_extri option:selected").val();
											jcmbProExtri.post("consulta-maquinas-datos.php", {maquina: maq, metroproducir: <?php echo $totalKg_trilaminado; ?>},
												function(data){
													jcmbProExtri("#progressbar").addClass("ocultar");
													jcmbProExtri('.datos_maquina_extri').html(data);
												});
																						
                                            jcmbProExtri("#maquina_extri").change(function() {
												jcmbProExtri("#progressbar").removeClass("ocultar");
												var maq = jcmbProExtri("select#maquina_extri option:selected").val();
												
												jcmbProExtri.post("consulta-maquinas-datos.php", {maquina: maq, metroproducir: <?php echo $totalKg_trilaminado; ?>},
													function(data){
														jcmbProExtri("#progressbar").addClass("ocultar");
														jcmbProExtri('.datos_maquina_extri').html(data);
													});
											});
                                        });
                                        </script>
                                        
                                        <select name="maquina_extri" id="maquina_extri" class="w130">
                                            <option value="0">------------------</option>
                                            <?php
                                            //EXTRAER MAQUINAS RELACIONADAS AL PROCESO
                                            $rst_maq=mysql_query("SELECT * FROM syCoesa_mantenimiento_maquinas_datos WHERE mostrar_maquina=1 ORDER BY id_maquina ASC", $conexion);
                                            while($fila_maq=mysql_fetch_array($rst_maq)){
                                
                                                $maq_procesos=$fila_maq["procesos_productivos_maquina"];
                                                $maquina=seleccionTabla($fila_maq["id_maquina"],"id_maquina", "syCoesa_mantenimiento_maquinas", $conexion);
                                            
                                                if(ereg(3, $maq_procesos)){
													if($proc_extrusion_trilaminado==$maquina["id_maquina"]){
											?>
                                                <option selected value="<?php echo $maquina["id_maquina"]; ?>"><?php echo $maquina["nombre_maquina"]; ?></option>
                                                <?php }else{ ?>
                                            	<option value="<?php echo $maquina["id_maquina"]; ?>"><?php echo $maquina["nombre_maquina"]; ?></option>
                                            <?php }}} ?>
                                            
                                        </select>
                                </div>
                                <div class="datos_maquina_extri"></div>
                            <?php } //FIN EXTRUSION ?>
                            
                            <?php if($proc_impresion>0){ ?>    
                                <div style="width:8.3%; height:20px; padding:1% 0;" class="float_left texto_izq">Impresión</div>
                                <div style="width:13%; height:20px; padding:1% 0;" class="float_left texto_cen">
                                        
                                        <!-- SELECCIONAR -->
                                  <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
                                  <script>
                                        var jcmbPro2 = jQuery.noConflict();
                                        jcmbPro2(document).ready(function(){
											var impresion = <?php echo $proc_impresion; ?>;
											var maq = jcmbPro2("select#maquina_2 option:selected").val();
											var mtrprod = <?php echo $mtrprod_impresion; ?>;
											var cantcolores = jcmbPro2("select#dtecnicos_numcolores option:selected").val();
											
											jcmbPro2.post("consulta-maquinas-datos.php", {colores: cantcolores, maquina: maq, metroproducir: mtrprod, impresion: impresion},
												function(data){
													jcmbPro2("#progressbar").addClass("ocultar");
													jcmbPro2('.datos_maquina_2').html(data);
												});
											
                                            jcmbPro2("#maquina_2").change(function() {
                                                jcmbPro2("#progressbar").removeClass("ocultar");
												var impresion = <?php echo $proc_impresion; ?>;
                                                var maq = jcmbPro2("select#maquina_2 option:selected").val();
                                                var mtrprod = <?php echo $mtrprod_impresion; ?>;
												var cantcolores = jcmbPro2("select#dtecnicos_numcolores option:selected").val();
                                                
                                                jcmbPro2.post("consulta-maquinas-datos.php", {colores: cantcolores, maquina: maq, metroproducir: mtrprod, impresion: impresion},
                                                    function(data){
                                                        jcmbPro2("#progressbar").addClass("ocultar");
                                                        jcmbPro2('.datos_maquina_2').html(data);
                                                    });
                                            });
                                        });
                                        </script>
                                        
                                        <select name="maquina2" id="maquina_2" class="w130">
                                            <option value="0">------------------</option>
                                            <?php
                                            
                                            //EXTRAER MAQUINAS RELACIONADAS AL PROCESO
                                            $rst_maq=mysql_query("SELECT * FROM syCoesa_mantenimiento_maquinas_datos WHERE mostrar_maquina=1 ORDER BY id_maquina ASC", $conexion);
                                            while($fila_maq=mysql_fetch_array($rst_maq)){
                                
                                                $maq_procesos=$fila_maq["procesos_productivos_maquina"];
                                                $maquina=seleccionTabla($fila_maq["id_maquina"],"id_maquina", "syCoesa_mantenimiento_maquinas", $conexion);
                                            
                                                if(ereg(4, $maq_procesos)){
													if($proc_impresion==$maquina["id_maquina"]){
											?>
                                                <option selected value="<?php echo $maquina["id_maquina"]; ?>"><?php echo $maquina["nombre_maquina"]; ?></option>
                                            	<?php }else{ ?>
                                                <option value="<?php echo $maquina["id_maquina"]; ?>"><?php echo $maquina["nombre_maquina"]; ?></option>
                                            <?php }}} ?>
                                            
                                        </select>
                                </div>
                                <div class="datos_maquina_2"></div>
                            <?php } ?>
                            
                            <?php if($proc_rebobinado>0){ ?>
                                <div style="width:8.3%; height:20px; padding:1% 0;" class="float_left texto_izq">Rebobinado</div>
                                <div style="width:13%; height:20px; padding:1% 0;" class="float_left texto_cen">
                                        
                                        <!-- SELECCIONAR -->
                                  <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
                                  <script>
                                        var jcmbPro7 = jQuery.noConflict();
                                        jcmbPro7(document).ready(function(){
											var rebobinado = <?php echo $proc_rebobinado; ?>;
											var maq = jcmbPro7("select#maquina_7 option:selected").val();
											var mtrprod = <?php echo $mtrprod_rebobinado; ?>;
											
											jcmbPro7.post("consulta-maquinas-datos.php", {maquina: maq, metroproducir: mtrprod, rebobinado: rebobinado},
												function(data){
													jcmbPro7("#progressbar").addClass("ocultar");
													jcmbPro7('.datos_maquina_7').html(data);
												});
											
                                            jcmbPro7("#maquina_7").change(function() {
                                                jcmbPro7("#progressbar").removeClass("ocultar");
                                                //VALORES
												var rebobinado = <?php echo $proc_rebobinado; ?>;
                                                var maq = jcmbPro7("select#maquina_7 option:selected").val();
                                                var mtrprod = <?php echo $mtrprod_rebobinado; ?>;
                                                
                                                jcmbPro7.post("consulta-maquinas-datos.php", {maquina: maq, metroproducir: mtrprod, rebobinado: rebobinado},
                                                    function(data){
                                                        jcmbPro7("#progressbar").addClass("ocultar");
                                                        jcmbPro7('.datos_maquina_7').html(data);
                                                    });
                                            });
                                        });
                                        </script>
                                        
                                        <select name="maquina7" id="maquina_7" class="w130">
                                            <option value="0">------------------</option>
                                            <?php
                                            
                                            //EXTRAER MAQUINAS RELACIONADAS AL PROCESO
                                            $rst_maq=mysql_query("SELECT * FROM syCoesa_mantenimiento_maquinas_datos WHERE mostrar_maquina=1 ORDER BY id_maquina ASC", $conexion);
                                            while($fila_maq=mysql_fetch_array($rst_maq)){
                                
                                                $maq_procesos=$fila_maq["procesos_productivos_maquina"];
                                                $maquina=seleccionTabla($fila_maq["id_maquina"],"id_maquina", "syCoesa_mantenimiento_maquinas", $conexion);
                                            
                                                if(ereg(9, $maq_procesos)){
													if($proc_rebobinado==$maquina["id_maquina"]){
											?>
                                                <option selected value="<?php echo $maquina["id_maquina"]; ?>"><?php echo $maquina["nombre_maquina"]; ?></option>
                                                <?php }else{ ?>
                                            	<option value="<?php echo $maquina["id_maquina"]; ?>"><?php echo $maquina["nombre_maquina"]; ?></option>
                                            <?php }}} ?>
                                            
                                        </select>
                                </div>
                                <div class="datos_maquina_7"></div>
                            <?php } ?>
                                
                            <?php if($proc_bilaminado>0){ ?>
                                <div style="width:8.3%; height:20px; padding:1% 0;" class="float_left texto_izq">Bilaminado</div>
                                <div style="width:13%; height:20px; padding:1% 0;" class="float_left texto_cen">
                                        
                                        <!-- SELECCIONAR -->
                                  <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
                                  <script>
                                        var jcmbPro3 = jQuery.noConflict();
                                        jcmbPro3(document).ready(function(){
											var bilaminado = <?php echo $proc_bilaminado; ?>;
											var maq = jcmbPro3("select#maquina_3 option:selected").val();
											var mtrprod = <?php echo $mtrprod_bilaminado; ?>;
																
											jcmbPro3.post("consulta-maquinas-datos.php", {maquina: maq, metroproducir: mtrprod, bilaminado: bilaminado},
												function(data){
													jcmbPro3("#progressbar").addClass("ocultar");
													jcmbPro3('.datos_maquina_3').html(data);
												});
											
                                            jcmbPro3("#maquina_3").change(function() {
                                                jcmbPro3("#progressbar").removeClass("ocultar");
                                                //VALORES
												var bilaminado = <?php echo $proc_bilaminado; ?>;
                                                var maq = jcmbPro3("select#maquina_3 option:selected").val();
                                                var mtrprod = <?php echo $mtrprod_bilaminado; ?>;
                                                                    
                                                jcmbPro3.post("consulta-maquinas-datos.php", {maquina: maq, metroproducir: mtrprod, bilaminado: bilaminado},
                                                    function(data){
                                                        jcmbPro3("#progressbar").addClass("ocultar");
                                                        jcmbPro3('.datos_maquina_3').html(data);
                                                    });
                                            });
                                        });
                                        </script>
                                        
                                        <select name="maquina3" id="maquina_3" class="w130">
                                            <option value="0">------------------</option>
                                            <?php
                                            //EXTRAER MAQUINAS RELACIONADAS AL PROCESO
                                            $rst_maq=mysql_query("SELECT * FROM syCoesa_mantenimiento_maquinas_datos WHERE mostrar_maquina=1 ORDER BY id_maquina ASC", $conexion);
                                            while($fila_maq=mysql_fetch_array($rst_maq)){
                                
                                                $maq_procesos=$fila_maq["procesos_productivos_maquina"];
                                                $maquina=seleccionTabla($fila_maq["id_maquina"],"id_maquina", "syCoesa_mantenimiento_maquinas", $conexion);
                                            
                                                if(ereg(5, $maq_procesos)){
													if($proc_bilaminado==$maquina["id_maquina"]){
											?>
                                                <option selected value="<?php echo $maquina["id_maquina"]; ?>"><?php echo $maquina["nombre_maquina"]; ?></option>
                                                <?php }else{ ?>
                                            	<option value="<?php echo $maquina["id_maquina"]; ?>"><?php echo $maquina["nombre_maquina"]; ?></option>
                                            <?php }}} ?>
                                            
                                        </select>
                                </div>
                                <div class="datos_maquina_3"></div>
                            <?php } ?>
                            
                            <?php if($proc_trilaminado>0){ ?>
                                <div style="width:8.3%; height:20px; padding:1% 0;" class="float_left texto_izq">Trilaminado</div>
                                <div style="width:13%; height:20px; padding:1% 0;" class="float_left texto_cen">
                                        
                                        <!-- SELECCIONAR -->
                                  <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
                                  <script>
                                        var jcmbPro4 = jQuery.noConflict();
                                        jcmbPro4(document).ready(function(){
											var trilaminado = <?php echo $proc_trilaminado; ?>;
											var maq = jcmbPro4("select#maquina_4 option:selected").val();
											var mtrprod = <?php echo $mtrprod_trilaminado; ?>;
																
											jcmbPro4.post("consulta-maquinas-datos.php", {maquina: maq, metroproducir: mtrprod, trilaminado: trilaminado},
												function(data){
													jcmbPro4("#progressbar").addClass("ocultar");
													jcmbPro4('.datos_maquina_4').html(data);
												});
											
                                            jcmbPro4("#maquina_4").change(function() {
                                                jcmbPro4("#progressbar").removeClass("ocultar");                
                                                //VALORES
												var trilaminado = <?php echo $proc_trilaminado; ?>;
                                                var maq = jcmbPro4("select#maquina_4 option:selected").val();
                                                var mtrprod = <?php echo $mtrprod_trilaminado; ?>;
                                                                    
                                                jcmbPro4.post("consulta-maquinas-datos.php", {maquina: maq, metroproducir: mtrprod, trilaminado: trilaminado},
                                                    function(data){
                                                        jcmbPro4("#progressbar").addClass("ocultar");
                                                        jcmbPro4('.datos_maquina_4').html(data);
                                                    });
                                            });
                                        });
                                        </script>
                                        
                                        <select name="maquina4" id="maquina_4" class="w130">
                                            <option value="0">------------------</option>
                                            <?php
                                            
                                            //EXTRAER MAQUINAS RELACIONADAS AL PROCESO
                                            $rst_maq=mysql_query("SELECT * FROM syCoesa_mantenimiento_maquinas_datos WHERE mostrar_maquina=1 ORDER BY id_maquina ASC", $conexion);
                                            while($fila_maq=mysql_fetch_array($rst_maq)){
                                
                                                $maq_procesos=$fila_maq["procesos_productivos_maquina"];
                                                $maquina=seleccionTabla($fila_maq["id_maquina"],"id_maquina", "syCoesa_mantenimiento_maquinas", $conexion);
                                            
                                                if(ereg(6, $maq_procesos)){
													if($proc_trilaminado==$maquina["id_maquina"]){
											?>
                                                <option selected value="<?php echo $maquina["id_maquina"]; ?>"><?php echo $maquina["nombre_maquina"]; ?></option>
                                                <?php }else{ ?>
                                                <option value="<?php echo $maquina["id_maquina"]; ?>"><?php echo $maquina["nombre_maquina"]; ?></option>
                                            <?php }}} ?>
                                        </select>
                                </div>
                                <div class="datos_maquina_4"></div>
                            <?php } ?>
                            
                            <?php if($proc_habilitado==1656548){ ?>
                                <div style="width:8.3%; height:20px; padding:1% 0;" class="float_left texto_izq">Habilitado</div>
                                <div style="width:13%; height:20px; padding:1% 0;" class="float_left texto_cen">
                                        
                                        <!-- SELECCIONAR -->
                                  <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
                                  <script>
                                        var jcmbPro8 = jQuery.noConflict();
                                        jcmbPro8(document).ready(function(){
											var habilitado = <?php echo $proc_habilitado; ?>;
											var maq = jcmbPro8("select#maquina_8 option:selected").val();
											var mtrprod = <?php echo $mtrprod_habilitado; ?>;
											
											jcmbPro8.post("consulta-maquinas-datos.php", {maquina: maq, metroproducir: mtrprod, habilitado: habilitado},
												function(data){
													jcmbPro8("#progressbar").addClass("ocultar");
													jcmbPro8('.datos_maquina_8').html(data);
												});
											
                                            jcmbPro8("#maquina_8").change(function() {
                                                jcmbPro8("#progressbar").removeClass("ocultar");
                                                //VALORES
												var habilitado = <?php echo $proc_habilitado; ?>;
                                                var maq = jcmbPro8("select#maquina_8 option:selected").val();
                                                var mtrprod = <?php echo $mtrprod_habilitado; ?>;
                                                
                                                jcmbPro8.post("consulta-maquinas-datos.php", {maquina: maq, metroproducir: mtrprod, habilitado: habilitado},
                                                    function(data){
                                                        jcmbPro8("#progressbar").addClass("ocultar");
                                                        jcmbPro8('.datos_maquina_8').html(data);
                                                    });
                                            });
                                        });
                                        </script>
                                        
                                        <select name="maquina8" id="maquina_8" class="w130">
                                            <option value="0">------------------</option>
                                            <?php
                                            
                                            //EXTRAER MAQUINAS RELACIONADAS AL PROCESO
                                            $rst_maq=mysql_query("SELECT * FROM syCoesa_mantenimiento_maquinas_datos WHERE mostrar_maquina=1 ORDER BY id_maquina ASC", $conexion);
                                            while($fila_maq=mysql_fetch_array($rst_maq)){
                                
                                                $maq_procesos=$fila_maq["procesos_productivos_maquina"];
                                                $maquina=seleccionTabla($fila_maq["id_maquina"],"id_maquina", "syCoesa_mantenimiento_maquinas", $conexion);
                                            
                                                if(ereg(10, $maq_procesos)){
													if($proc_habilitado==$maquina["id_maquina"]){
											?>
                                                <option selected value="<?php echo $maquina["id_maquina"]; ?>"><?php echo $maquina["nombre_maquina"]; ?></option>
                                                <?php }else{ ?>
                                            	<option value="<?php echo $maquina["id_maquina"]; ?>"><?php echo $maquina["nombre_maquina"]; ?></option>
                                            <?php }}} ?>
                                            
                                        </select>
                                </div>
                                <div class="datos_maquina_8"></div>
                            <?php } ?>
                            
                            <?php if($proc_cortefinal>0){ ?>
                                <div style="width:8.3%; height:20px; padding:1% 0;" class="float_left texto_izq">Corte</div>
                                <div style="width:13%; height:20px; padding:1% 0;" class="float_left texto_cen">
                                        
                                        <!-- SELECCIONAR -->
                                  <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
                                  <script>
                                        var jcmbPro5 = jQuery.noConflict();
                                        jcmbPro5(document).ready(function(){
											var cortefinal = <?php echo $proc_cortefinal; ?>;
											var maq = jcmbPro5("select#maquina_5 option:selected").val();
											var mtrprod = <?php echo $mtrprod_cortefinal; ?>;
											
											jcmbPro5.post("consulta-maquinas-datos.php", {maquina: maq, metroproducir: mtrprod, cortefinal: cortefinal},
												function(data){
													jcmbPro5("#progressbar").addClass("ocultar");
													jcmbPro5('.datos_maquina_5').html(data);
												});
											
                                            jcmbPro5("#maquina_5").change(function() {
                                                jcmbPro5("#progressbar").removeClass("ocultar");
                                                //VALORES
												var cortefinal = <?php echo $proc_cortefinal; ?>;
                                                var maq = jcmbPro5("select#maquina_5 option:selected").val();
                                                var mtrprod = <?php echo $mtrprod_cortefinal; ?>;
                                                
                                                jcmbPro5.post("consulta-maquinas-datos.php", {maquina: maq, metroproducir: mtrprod, cortefinal: cortefinal},
                                                    function(data){
                                                        jcmbPro5("#progressbar").addClass("ocultar");
                                                        jcmbPro5('.datos_maquina_5').html(data);
                                                    });
                                            });
                                        });
                                        </script>
                                        
                                        <select name="maquina5" id="maquina_5" class="w130">
                                            <option value="0">------------------</option>
                                            <?php
                                            
                                            //EXTRAER MAQUINAS RELACIONADAS AL PROCESO
                                            $rst_maq=mysql_query("SELECT * FROM syCoesa_mantenimiento_maquinas_datos WHERE mostrar_maquina=1 ORDER BY id_maquina ASC", $conexion);
                                            while($fila_maq=mysql_fetch_array($rst_maq)){
                                
                                                $maq_procesos=$fila_maq["procesos_productivos_maquina"];
                                                $maquina=seleccionTabla($fila_maq["id_maquina"],"id_maquina", "syCoesa_mantenimiento_maquinas", $conexion);
                                            
                                                if(ereg(7, $maq_procesos)){
													if($proc_cortefinal==$maquina["id_maquina"]){
											?>
                                                <option selected value="<?php echo $maquina["id_maquina"]; ?>"><?php echo $maquina["nombre_maquina"]; ?></option>
                                                <?php }else{ ?>
                                                <option value="<?php echo $maquina["id_maquina"]; ?>"><?php echo $maquina["nombre_maquina"]; ?></option>
                                            <?php }}} ?>
                                            
                                        </select>
                                </div>
                                <div class="datos_maquina_5"></div>
                            <?php } ?>
                            
                            <?php if($proc_sellado>0){ ?>
                                <div style="width:8.3%; height:20px; padding:1% 0;" class="float_left texto_izq">Sellado</div>
                                <div style="width:13%; height:20px; padding:1% 0;" class="float_left texto_cen">
                                        
                                        <!-- SELECCIONAR -->
                                  <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
                                  <script>
                                        var jcmbPro6 = jQuery.noConflict();
                                        jcmbPro6(document).ready(function(){
											var sellado = <?php echo $proc_sellado; ?>;
											var maq = jcmbPro6("select#maquina_6 option:selected").val();
											var mtrprod = <?php echo $mtrprod_sellado_total; ?>;
											var unidadmedida = jcmbPro6("select#dtecnicos_unidadmedida option:selected").val();
											var nrobandas = jcmbPro6("select#dtecnicos_numbandas option:selected").val();
											var repeticion = jcmbPro6("#dtecnicos_repeticion").val();
																						
											jcmbPro6.post("consulta-maquinas-datos.php", {maquina: maq, metroproducir: mtrprod, sellado: sellado, unidadmedida: unidadmedida, nrobandas: nrobandas, repeticion: repeticion},
												function(data){
													jcmbPro6("#progressbar").addClass("ocultar");
													jcmbPro6('.datos_maquina_6').html(data);
												});
											
                                            jcmbPro6("#maquina_6").change(function() {
                                                jcmbPro6("#progressbar").removeClass("ocultar");
                                                //VALORES
												var sellado = <?php echo $proc_sellado; ?>;
                                                var maq = jcmbPro6("select#maquina_6 option:selected").val();
                                                var mtrprod = <?php echo $mtrprod_sellado_total; ?>;
												var unidadmedida = jcmbPro6("select#dtecnicos_unidadmedida option:selected").val();
												var nrobandas = jcmbPro6("select#dtecnicos_numbandas option:selected").val();
												var repeticion = jcmbPro6("#dtecnicos_repeticion").val();
                                                                    
                                                jcmbPro6.post("consulta-maquinas-datos.php", {maquina: maq, metroproducir: mtrprod, sellado: sellado, unidadmedida: unidadmedida, nrobandas: nrobandas, repeticion: repeticion},
                                                    function(data){
                                                        jcmbPro6("#progressbar").addClass("ocultar");
                                                        jcmbPro6('.datos_maquina_6').html(data);
                                                    });
                                            });
                                        });
                                        </script>
                                        
                                        <select name="maquina6" id="maquina_6" class="w130">
                                            <option value="0">------------------</option>
                                            <?php
                                            
                                            //EXTRAER MAQUINAS RELACIONADAS AL PROCESO
                                            $rst_maq=mysql_query("SELECT * FROM syCoesa_mantenimiento_maquinas_datos WHERE mostrar_maquina=1 ORDER BY id_maquina ASC", $conexion);
                                            while($fila_maq=mysql_fetch_array($rst_maq)){
                                
                                                $maq_procesos=$fila_maq["procesos_productivos_maquina"];
                                                $maquina=seleccionTabla($fila_maq["id_maquina"],"id_maquina", "syCoesa_mantenimiento_maquinas", $conexion);
                                            
                                                if(ereg(8, $maq_procesos)){
													if($proc_sellado==$maquina["id_maquina"]){
											?>
                                                <option selected value="<?php echo $maquina["id_maquina"]; ?>"><?php echo $maquina["nombre_maquina"]; ?></option>
                                                <?php }else{ ?>
                                                <option value="<?php echo $maquina["id_maquina"]; ?>"><?php echo $maquina["nombre_maquina"]; ?></option>                                            
                                            <?php }}} ?>
                                            
                                        </select>
                                </div>
                                <div class="datos_maquina_6"></div>
                            <?php } ?>
                            
                            </div>
                            	
                           	<div class="float_left an100">
                                <hr>
                                <h2>Insumos</h2>
                                <table width="800px" border="1" cellspacing="5" cellpadding="5">
                                    <thead>
                                        <tr>
                                            <td width="150" class="texto_cen texto_11 fondo_c1 texto_bold">Tipo</td>
                                            <td width="200" class="texto_cen texto_11 fondo_c1 texto_bold">Insumos</td>
                                            <td width="150" class="texto_cen texto_11 fondo_c1 texto_bold">Costo</td>
                                            <td width="150" class="texto_cen texto_11 fondo_c1 texto_bold">Cant. Requerida</td>
                                            <td width="150" class="texto_cen texto_11 fondo_c1 texto_bold">Importe</td>
                                        </tr>
                                    </thead>
                                </table>
                                
                                <?php if($proc_impresion>0){ ?>
                                <div class="float_left" style="width:800px;">
                                    <div style="width:146px; height:20px; padding:1% 0;" class="float_left texto_izq">Tinta (Kg)</div>
                                    <div style="width:200px; height:0px; padding:1% 0;" class="float_left texto_cen">
                                    </div>
                                    <!-- SELECCIONAR -->
                                    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
                                    <script>
                                    var jcmbIns1 = jQuery.noConflict();
                                    jcmbIns1(document).ready(function(){
                                        jcmbIns1("#progressbar").removeClass("ocultar");
										var Idinsumo = <?php echo $insumo_tinta; ?>;
                                        var grm2total = jcmbIns1("#dtecnicos_grm2_total").val();
                                        var anchofinal = jcmbIns1("#dtecnicos_anchofinal").val();
                                        var nrobandas = jcmbIns1("#dtecnicos_numbandas").val();
                                        var metrototal = <?php echo $mtrprod_impresion; ?>;
                                        var grm2 = <?php echo $cotizacion_lamina1_impresion_grm2; ?>;
                                        var tipo = "tinta";
                                        jcmbIns1.post("insumos-costos.php", {id: Idinsumo, grm2total: grm2total, anchofinal: anchofinal, nrobandas: nrobandas, metrototal: metrototal, grm2: grm2, tipo: tipo}, 
                                            function(data){
                                                jcmbIns1("#progressbar").addClass("ocultar");
                                                jcmbIns1('.datos_insumos_1').html(data);
                                            });
                                    });
                                    </script>
                                    <div class="datos_insumos_1" style="width:452px; float:left; padding:1% 0;"></div>
                                </div>
                                <?php } ?>
                                
                                <?php if($proc_bilaminado>0){ ?>
                                <div class="float_left" style="width:800px;">
                                    <div style="width:146px; height:20px; padding:1% 0;" class="float_left texto_izq">Adhesivo Bilaminado (Kg)</div>
                                    <div style="width:200px; height:0px; padding:1% 0;" class="float_left texto_cen">
                                                
                                        <!-- SELECCIONAR -->
                                        <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
                                        <script>
                                        var jcmbIns2 = jQuery.noConflict();
                                        jcmbIns2(document).ready(function(){
											
											var insumo = <?php echo $insumo_bilaminado; ?>;
											var grm2total = jcmbIns2("#dtecnicos_grm2_total").val();
											var anchofinal = jcmbIns2("#dtecnicos_anchofinal").val();
											var nrobandas = jcmbIns2("#dtecnicos_numbandas").val();
											var metrototal = <?php echo $mtrprod_bilaminado; ?>;
											var grm2 = <?php echo $cotizacion_lamina2_bilaminado_grm2; ?>;
											jcmbIns2.post("insumos-costos.php", {insumo: insumo, grm2total: grm2total, anchofinal: anchofinal, nrobandas: nrobandas, metrototal: metrototal, grm2: grm2}, 
												function(data){
													jcmbIns2('.datos_insumos_2').html(data);
												});
											
                                            jcmbIns2("#insumo2").change(function() {
                                                jcmbIns2("#progressbar").removeClass("ocultar");
                                                var insumo = jcmbIns2("select#insumo2 option:selected").val();
                                                var grm2total = jcmbIns2("#dtecnicos_grm2_total").val();
                                                var anchofinal = jcmbIns2("#dtecnicos_anchofinal").val();
                                                var nrobandas = jcmbIns2("#dtecnicos_numbandas").val();
                                                var metrototal = <?php echo $mtrprod_bilaminado; ?>;
                                                var grm2 = jcmbIns2("#bilaminado_proceso_2").val();
                                                jcmbIns2.post("insumos-costos.php", {insumo: insumo, grm2total: grm2total, anchofinal: anchofinal, nrobandas: nrobandas, metrototal: metrototal, grm2: grm2}, 
                                                    function(data){
                                                        jcmbIns2("#progressbar").addClass("ocultar");
                                                        jcmbIns2('.datos_insumos_2').html(data);
                                                    });
                                            });
                                        });
                                        </script>
                                        
                                        <select name="insumo2" id="insumo2" class="w180">
                                            <option value="0">------------------</option>
                                            <?php
											$rst_insumo=mysql_query("SELECT * FROM syCoesa_articulo WHERE id_tipo_articulo=4 AND mostrar_articulo=1 ORDER BY nombre_articulo ASC;", $conexion);
                                            while($fila_insumo=mysql_fetch_array($rst_insumo)){
                                                $insumo_id=$fila_insumo["id_articulo"];
                                                $insumo_nombre=$fila_insumo["nombre_articulo"];
												
												if($insumo_bilaminado==$insumo_id){
                                            ?>
                                                <option selected value="<?php echo $insumo_id; ?>"><?php echo $insumo_nombre; ?></option>
                                                <?php }else{ ?>
                                                <option value="<?php echo $insumo_id; ?>"><?php echo $insumo_nombre; ?></option>
                                            <?php }} ?>
                                            
                                        </select>
                                    </div>
                                    <div class="datos_insumos_2" style="width:452px; float:left; padding:1% 0;"></div>
                                </div>
                                <?php } ?>
                                
                                <?php if($proc_trilaminado>0){ ?>
                                <div class="float_left" style="width:800px;">
                                    <div style="width:146px; height:20px; padding:1% 0;" class="float_left texto_izq">Adhesivo Trilaminado (Kg)</div>
                                    <div style="width:200px; height:0px; padding:1% 0;" class="float_left texto_cen">
                                                
                                        <!-- SELECCIONAR -->
                                        <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
                                        <script>
                                        var jcmbIns3 = jQuery.noConflict();
                                        jcmbIns3(document).ready(function(){
											
											var insumo = <?php echo $insumo_trilaminado; ?>;
											var grm2total = jcmbIns3("#dtecnicos_grm2_total").val();
											var anchofinal = jcmbIns3("#dtecnicos_anchofinal").val();
											var nrobandas = jcmbIns3("#dtecnicos_numbandas").val();
											var metrototal = <?php echo $mtrprod_trilaminado; ?>;
											var grm2 = <?php echo $cotizacion_lamina3_trilaminado_grm2; ?>;
											jcmbIns3.post("insumos-costos.php", {insumo: insumo, grm2total: grm2total, anchofinal: anchofinal, nrobandas: nrobandas, metrototal: metrototal, grm2: grm2},
												function(data){
													jcmbIns3('.datos_insumos_3').html(data);
												});
											
                                            jcmbIns3("#insumo3").change(function() {
                                                jcmbIns3("#progressbar").removeClass("ocultar");
                                                var insumo = jcmbIns3("select#insumo3 option:selected").val();
                                                var grm2total = jcmbIns3("#dtecnicos_grm2_total").val();
                                                var anchofinal = jcmbIns3("#dtecnicos_anchofinal").val();
                                                var nrobandas = jcmbIns3("#dtecnicos_numbandas").val();
                                                var metrototal = <?php echo $mtrprod_trilaminado; ?>;
                                                var grm2 = jcmbIns3("#trilaminado_proceso_3").val();
                                                jcmbIns3.post("insumos-costos.php", {insumo: insumo, grm2total: grm2total, anchofinal: anchofinal, nrobandas: nrobandas, metrototal: metrototal, grm2: grm2},
                                                    function(data){
                                                        jcmbIns3("#progressbar").addClass("ocultar");
                                                        jcmbIns3('.datos_insumos_3').html(data);
                                                    });
                                            });
                                        });
                                        </script>
                                        
                                        <select name="insumo3" id="insumo3" class="w180">
                                            <option value="0">------------------</option>
                                            <?php
											$rst_insumo=mysql_query("SELECT * FROM syCoesa_articulo WHERE id_tipo_articulo=4 AND mostrar_articulo=1 ORDER BY nombre_articulo ASC;", $conexion);
                                            while($fila_insumo=mysql_fetch_array($rst_insumo)){
                                                $insumo_id=$fila_insumo["id_articulo"];
                                                $insumo_nombre=$fila_insumo["nombre_articulo"];
												
												if($insumo_trilaminado==$insumo_id){
                                            ?>
                                                <option selected value="<?php echo $insumo_id; ?>"><?php echo $insumo_nombre; ?></option>
                                                <?php }else{ ?>
                                                <option value="<?php echo $insumo_id; ?>"><?php echo $insumo_nombre; ?></option>
                                            <?php }} ?>
                                            
                                        </select>
                                    </div>
                                    <div class="datos_insumos_3" style="width:452px; float:left; padding:1% 0;"></div>
                                </div>
                                <?php } ?>
                                
                                <?php if($proc_impresion>0){ ?>
                                <div class="float_left" style="width:800px;">
                                    <div style="width:146px; height:20px; padding:1% 0;" class="float_left texto_izq">Cushion (cm2)</div>
                                    
                                    <!-- SELECCIONAR -->
                                    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
                                    <script>
                                    var jcmbIns4 = jQuery.noConflict();
                                    jcmbIns4(document).ready(function(){
										
										var insumo = <?php echo $insumo_cushion; ?>;
										var anchofinal = jcmbIns4("#dtecnicos_anchofinal").val();
										var nrobandas = jcmbIns4("#dtecnicos_numbandas").val();
										var nrocolores = jcmbIns4("#dtecnicos_numcolores").val();
										var repeticion = jcmbIns4("#dtecnicos_repeticion").val();
										var frecuencia = jcmbIns4("#dtecnicos_frecuencia").val();
										var tipo = "cushion";
										jcmbIns4.post("insumos-costos.php", {insumo: insumo, anchofinal: anchofinal, nrobandas: nrobandas, nrocolores: nrocolores, repeticion: repeticion, frecuencia: frecuencia, tipo: tipo}, 
											function(data){
												jcmbIns4('.datos_insumos_4').html(data);
											});
										
                                        jcmbIns4("#insumo4").change(function() {
                                            jcmbIns4("#progressbar").removeClass("ocultar");
                                            var insumo = jcmbIns4("select#insumo4 option:selected").val();
                                            var anchofinal = jcmbIns4("#dtecnicos_anchofinal").val();
                                            var nrobandas = jcmbIns4("#dtecnicos_numbandas").val();
                                            var nrocolores = jcmbIns4("#dtecnicos_numcolores").val();
                                            var repeticion = jcmbIns4("#dtecnicos_repeticion").val();
                                            var frecuencia = jcmbIns4("#dtecnicos_frecuencia").val();
                                            var tipo = "cushion";
                                            jcmbIns4.post("insumos-costos.php", {insumo: insumo, anchofinal: anchofinal, nrobandas: nrobandas, nrocolores: nrocolores, repeticion: repeticion, frecuencia: frecuencia, tipo: tipo}, 
                                                function(data){
                                                    jcmbIns4("#progressbar").addClass("ocultar");
                                                    jcmbIns4('.datos_insumos_4').html(data);
                                                });
                                        });
                                    });
                                    </script>
                                    
                                    <div style="width:200px; height:0px; padding:1% 0;" class="float_left texto_cen">
                                        
                                        <select name="insumo4" id="insumo4" class="w180">
                                            <option value="0">------------------</option>
                                            <?php
											$rst_insumo=mysql_query("SELECT * FROM syCoesa_articulo WHERE id_tipo_articulo=8 AND mostrar_articulo=1 ORDER BY nombre_articulo ASC;", $conexion);
                                            while($fila_insumo=mysql_fetch_array($rst_insumo)){
                                                $insumo_id=$fila_insumo["id_articulo"];
                                                $insumo_nombre=$fila_insumo["nombre_articulo"];
												
												if($insumo_cushion==$insumo_id){
                                            ?>
                                                <option selected value="<?php echo $insumo_id; ?>"><?php echo $insumo_nombre; ?></option>
                                                <?php }else{ ?>
                                                <option value="<?php echo $insumo_id; ?>"><?php echo $insumo_nombre; ?></option>
                                            <?php }} ?>
                                            
                                        </select>
                                    </div>
                                    <div class="datos_insumos_4" style="width:452px; float:left; padding:1% 0;"></div>
                                </div>
                                <?php } ?>
                                
                                <?php if($proc_impresion>0){ ?>
                                <div class="float_left" style="width:800px;">
                                    <div style="width:146px; height:20px; padding:1% 0;" class="float_left texto_izq">Clises (cm2)</div>
                                    
                                    <!-- SELECCIONAR -->
                                    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
                                    <script>
                                    var jcmbIns5 = jQuery.noConflict();
                                    jcmbIns5(document).ready(function(){
										
										var insumo = <?php echo $insumo_clises; ?>;
										var anchofinal = jcmbIns5("#dtecnicos_anchofinal").val();
										var nrobandas = jcmbIns5("#dtecnicos_numbandas").val();
										var nrocolores = jcmbIns5("#dtecnicos_numcolores").val();
										var repeticion = jcmbIns5("#dtecnicos_repeticion").val();
										var frecuencia = jcmbIns5("#dtecnicos_frecuencia").val();
										var tipo = "clises";
										jcmbIns5.post("insumos-costos.php", {insumo: insumo, anchofinal: anchofinal, nrobandas: nrobandas, nrocolores: nrocolores, repeticion: repeticion, frecuencia: frecuencia, tipo: tipo}, 
											function(data){
												jcmbIns5("#progressbar").addClass("ocultar");
												jcmbIns5('.datos_insumos_5').html(data);
											});
										
                                        jcmbIns5("#insumo5").change(function() {
                                            jcmbIns5("#progressbar").removeClass("ocultar");
                                            var insumo = jcmbIns5("select#insumo5 option:selected").val();
                                            var anchofinal = jcmbIns5("#dtecnicos_anchofinal").val();
                                            var nrobandas = jcmbIns5("#dtecnicos_numbandas").val();
                                            var nrocolores = jcmbIns5("#dtecnicos_numcolores").val();
                                            var repeticion = jcmbIns5("#dtecnicos_repeticion").val();
                                            var frecuencia = jcmbIns5("#dtecnicos_frecuencia").val();
                                            var tipo = "clises";
                                            jcmbIns5.post("insumos-costos.php", {insumo: insumo, anchofinal: anchofinal, nrobandas: nrobandas, nrocolores: nrocolores, repeticion: repeticion, frecuencia: frecuencia, tipo: tipo}, 
                                                function(data){
                                                    jcmbIns5("#progressbar").addClass("ocultar");
                                                    jcmbIns5('.datos_insumos_5').html(data);
                                                });
                                        });
                                    });
                                    </script>
                                    
                                    <div style="width:200px; height:0px; padding:1% 0;" class="float_left texto_cen">
                                        <select name="insumo5" id="insumo5" class="w180">
                                            <option value="0">------------------</option>
                                            <?php
											$rst_insumo=mysql_query("SELECT * FROM syCoesa_articulo WHERE id_tipo_articulo=11 AND mostrar_articulo=1 ORDER BY nombre_articulo ASC;", $conexion);
                                            while($fila_insumo=mysql_fetch_array($rst_insumo)){
                                                $insumo_id=$fila_insumo["id_articulo"];
                                                $insumo_nombre=$fila_insumo["nombre_articulo"];
												
												if($insumo_clises==$insumo_id){
                                            ?>
                                                <option selected value="<?php echo $insumo_id; ?>"><?php echo $insumo_nombre; ?></option>
                                                <?php }else{ ?>
                                                <option value="<?php echo $insumo_id; ?>"><?php echo $insumo_nombre; ?></option>
                                            <?php }} ?>
                                            
                                        </select>
                                    </div>
                                    <div class="datos_insumos_5" style="width:452px; float:left; padding:1% 0;"></div>
                                </div>
                                <?php } ?>
                        	</div>
                		</div>
                            
                    	<fieldset>
                            <input name="dtp_btnenviar" type="submit" id="dtp_btnenviar" value="Guardar datos">
                            <input name="id_cotizacion" id="id_cotizacion" type="hidden" value="<?php echo $id_cotizacion; ?>">
                            <input name="dtp_btnenviar" type="button" id="dtp_btnenviar" value="Cancelar" onClick="parent.location='lista.php'">
                        </fieldset>
                        
                    </form>
                    
                </div>
                     
            </div><!-- FIN FORMULARIO DATOS -->
        
        </div><!-- FIN DATOS PROCESOS -->
    
    </section><!-- FIN SECTION CONTENIDO -->
    
</section><!-- FIN SECTION -->
</body>
</html>