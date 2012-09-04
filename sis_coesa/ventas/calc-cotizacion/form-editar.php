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

$cotizacion_lamina1=$cotizacion["lamina1_cotizacion"];
$cotizacion_lamina1_extrusion=$cotizacion["extrusion1_cotizacion"];
$cotizacion_lamina1_impresion=$cotizacion["impresion1_cotizacion"];
$cotizacion_lamina1_impresion_grm2=$cotizacion["impresion1_grm2_cotizacion"];
$cotizacion_lamina1_bilaminado=$cotizacion["bilaminado1_cotizacion"];
$cotizacion_lamina1_trilaminado=$cotizacion["trilaminado1_cotizacion"];
$cotizacion_lamina1_rebobinado=$cotizacion["rebobinado1_cotizacion"];
$cotizacion_lamina1_habilitado=$cotizacion["habilitado1_cotizacion"];
$cotizacion_lamina1_cortefinal=$cotizacion["cortefinal1_cotizacion"];
$cotizacion_lamina1_sellado=$cotizacion["sellado1_cotizacion"];

$cotizacion_lamina2=$cotizacion["lamina2_cotizacion"];
$cotizacion_lamina2_extrusion=$cotizacion["extrusion2_cotizacion"];
$cotizacion_lamina2_impresion=$cotizacion["impresion2_cotizacion"];
$cotizacion_lamina2_bilaminado=$cotizacion["bilaminado2_cotizacion"];
$cotizacion_lamina2_bilaminado_grm2=$cotizacion["bilaminado2_grm2_cotizacion"];
$cotizacion_lamina2_trilaminado=$cotizacion["trilaminado2_cotizacion"];
$cotizacion_lamina2_rebobinado=$cotizacion["rebobinado2_cotizacion"];
$cotizacion_lamina2_habilitado=$cotizacion["habilitado2_cotizacion"];
$cotizacion_lamina2_cortefinal=$cotizacion["cortefinal2_cotizacion"];
$cotizacion_lamina2_sellado=$cotizacion["sellado2_cotizacion"];

$cotizacion_lamina3=$cotizacion["lamina3_cotizacion"];
$cotizacion_lamina3_extrusion=$cotizacion["extrusion3_cotizacion"];
$cotizacion_lamina3_impresion=$cotizacion["impresion3_cotizacion"];
$cotizacion_lamina3_bilaminado=$cotizacion["bilaminado3_cotizacion"];
$cotizacion_lamina3_trilaminado=$cotizacion["trilaminado3_cotizacion"];
$cotizacion_lamina3_trilaminado_grm2=$cotizacion["trilaminado3_grm2_cotizacion"];
$cotizacion_lamina3_rebobinado=$cotizacion["rebobinado3_cotizacion"];
$cotizacion_lamina3_habilitado=$cotizacion["habilitado3_cotizacion"];
$cotizacion_lamina3_cortefinal=$cotizacion["cortefinal3_cotizacion"];
$cotizacion_lamina3_sellado=$cotizacion["sellado3_cotizacion"];
$cotizacion_grm2total=$cotizacion["grm2total_cotizacion"];
$cotizacion_cantproduccion=$cotizacion["cantproduccion_cotizacion"];
$cotizacion_metrosproducir=$cotizacion["metrosproducir_cotizacion"];
$proc_extrusion=$cotizacion["proc_extrusion_maq_cotizacion"];
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

//AGREGANDO METROS DE PROCESO + METROS A PRODUCIR
if($proc_sellado>0){ //SELLADO
	$procprod_merma_sellado=seleccionTabla("'sellado'", "url", "syCoesa_mantenimiento_procesos_productivos", $conexion);
	$mtrprod_sellado=$mtrprod + ($mtrprod * ($procprod_merma_sellado["merma_proceso"] / 100));
}else{ $mtrprod_sellado=0; $procprod_merma_sellado=0; }

if($proc_habilitado>0){ //HABILITADO
	$mtrprod_habilitado=$mtrprod_sellado;
}else{ $mtrprod_habilitado=0; }

if($proc_cortefinal>0){ //CORTE FINAL
	$procprod_merma_cortefinal=seleccionTabla("'corte-final'", "url", "syCoesa_mantenimiento_procesos_productivos", $conexion);
	$mtrprod_cortefinal=($mtrprod + ($mtrprod * ($procprod_merma_cortefinal["merma_proceso"] / 100)));
}else{ $mtrprod_cortefinal=0; $procprod_merma_cortefinal=0; }

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
$formula_filtro=$cotizacion_anchofinal * $cotizacion_nrobandas + $maq_refile;

//NUMERO DE COLORES
$rst_mqdt_colores=mysql_query("SELECT * FROM syCoesa_mantenimiento_maquinas_datos ORDER BY estacion_cuerpo_maquina DESC LIMIT 1;", $conexion);
$fila_mqdt_colores=mysql_fetch_array($rst_mqdt_colores);
$mqdt_colores_estacion=$fila_mqdt_colores["estacion_cuerpo_maquina"];

//LAMINAS - POLIETILENO
$rst_lamina1=mysql_query("SELECT * FROM syCoesa_articulo WHERE id_tipo_articulo=3 OR id_tipo_articulo=6 ORDER BY nombre_articulo ASC;", $conexion); //LAMINAS
$rst_lamina2=mysql_query("SELECT * FROM syCoesa_articulo WHERE id_tipo_articulo=3 OR id_tipo_articulo=6 ORDER BY nombre_articulo ASC;", $conexion); //LAMINAS
$rst_lamina3=mysql_query("SELECT * FROM syCoesa_articulo WHERE id_tipo_articulo=3 OR id_tipo_articulo=6 ORDER BY nombre_articulo ASC;", $conexion); //LAMINAS

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
var jlamprocEd = jQuery.noConflict();
jlamprocEd(document).ready(function(){
	jlamprocEd("#dtecnicos_numbandas").change(function(){
		jlamprocEd("#progressbar").removeClass("ocultar");
		var anchofinal = jlamprocEd("#dtecnicos_anchofinal").val();
		var nrobandas = jlamprocEd("select#dtecnicos_numbandas option:selected").val();
		jlamprocEd.post("seleccionar-laminas.php", {anchofinal: anchofinal, nrobandas: nrobandas},
			function(data){
				jlamprocEd("#progressbar").addClass("ocultar");
				jlamprocEd("#datos_lamproc").html(data);
			});
	});
});
</script>

<!-- SELECCIONAR MAQUINAS -->
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script>
var jslcmaq = jQuery.noConflict();
jslcmaq(document).ready(function(){
	
	jslcmaq("#dtp_selecmaq").click(function(){
		var datos = jslcmaq("#formGuardar").serialize();
		jslcmaq("#progressbar").removeClass("ocultar");
		jslcmaq.ajax({
            type: "POST", url: "seleccionar-maquinas.php", data: datos,
            success: function(data){
				jslcmaq("#progressbar").addClass("ocultar");
				jslcmaq("#selccion_procesos_maquinas").html(data);
            }
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

<!-- FRECUENCIA -->
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script>
var jFrec = jQuery.noConflict();
jFrec(document).ready(function(){
	jFrec("#dtecnicos_repeticion").change(function(){
		var cilindro = jFrec("#dtecnicos_cilindro").val();
		var repeticion = jFrec(this).val();
		jFrec.post("frecuencia.php", {cilindro: cilindro, repeticion: repeticion},
			function(data){
				jFrec("#frecuencia").html(data);
			});
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
                        
                        <div id="frecuencia" class="w180 float_left">
                        <fieldset class="alto50 w180">
                          <label for="dtecnicos_frecuencia">Frecuencia (mm):</label>
                          <input name="dtecnicos_frecuencia" type="text" class="w130" id="dtecnicos_frecuencia" value="<?php echo $cotizacion_frecuencia; ?>" readonly>
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
                        	<div id="dtecnicos_cantrq_texto">
                          <label for="dtecnicos_cantrq">Cantidad Requerida:</label></div>
                          <input name="dtecnicos_cantrq" type="text" id="dtecnicos_cantrq" class="w130" value="<?php echo $cotizacion_cantcliente; ?>">
						</fieldset>
                        
                        <fieldset class="alto50 w180">
                          <label for="dtecnicos_precio">Precio (US$):</label>
                          <input name="dtecnicos_precio" type="text" id="dtecnicos_precio" class="w130" value="<?php echo $cotizacion_precio; ?>">
						</fieldset>
                        
                        <div id="datos_lamproc" class="an100 float_left">
                        	
                            <div class="w235 float_left border_der margin_r10">
                            	
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
                                            
                                            if($lamina1_ancho>=$formula_filtro){
												if ($cotizacion_lamina1==$lamina1_id){
									?>
                                            <option selected value=<?php echo $lamina1_id; ?>><?php echo $lamina1_nombre; ?></option>
                                        	<?php }else{ ?>
                                            <option value="<?php echo $lamina1_id; ?>"><?php echo $lamina1_nombre; ?></option>
                                    <?php }}} ?>
                                  </select>
                                </fieldset>
                                
                                <fieldset class="w235">
                                	<?php if($cotizacion_lamina1_extrusion==1){ ?>
                                    <label><input checked id="procesos_maquinas_3" class="procesos_maquinas" name="extrusion1" type="checkbox" value="1">&nbsp;Extrusión</label>
                                    <?php }else{ ?>
                                    <label><input id="procesos_maquinas_3" class="procesos_maquinas" name="extrusion1" type="checkbox" value="1">&nbsp;Extrusión</label>
                                    <?php } ?>
                                </fieldset>
                                
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
                                
                                <fieldset class="w235">
                                	<?php if($cotizacion_lamina1_bilaminado==1){ ?>
                                    <label><input checked id="procesos_maquinas_5" class="procesos_maquinas" name="bilaminado1" type="checkbox" value="1">&nbsp;Bilaminado</label>
                                    <?php }else{ ?>
                                    <label><input id="procesos_maquinas_5" class="procesos_maquinas" name="bilaminado1" type="checkbox" value="1">&nbsp;Bilaminado</label>
                                    <?php } ?>
                                </fieldset>
                                
                                <fieldset class="w235">
                                	<?php if($cotizacion_lamina1_trilaminado==1){ ?>
                                    <label><input checked id="procesos_maquinas_6" class="procesos_maquinas" name="trilaminado1" type="checkbox" value="1">&nbsp;Trilaminado</label>
                                    <?php }else{ ?>
                                    <label><input id="procesos_maquinas_6" class="procesos_maquinas" name="trilaminado1" type="checkbox" value="1">&nbsp;Trilaminado</label>
                                    <?php } ?>
                                </fieldset>
                                
							    <input name="habilitado1" type="hidden" value="0">
                                
                                <fieldset class="w235">
                                	<?php if($cotizacion_lamina1_cortefinal==1){ ?>
                                    <label><input checked id="procesos_maquinas_7" class="procesos_maquinas" name="cortefinal1" type="checkbox" value="1">&nbsp;Corte</label>
                                    <?php }else{ ?>
                                    <label><input id="procesos_maquinas_7" class="procesos_maquinas" name="cortefinal1" type="checkbox" value="1">&nbsp;Corte</label>
                                    <?php } ?>
                                </fieldset>
                                
                                <fieldset class="w235">
                                	<?php if($cotizacion_lamina1_sellado==1){ ?>
                                    <label><input checked id="procesos_maquinas_8" class="procesos_maquinas" name="sellado1" type="checkbox" value="1">&nbsp;Sellado</label>
                                    <?php }else{ ?>
                                    <label><input id="procesos_maquinas_8" class="procesos_maquinas" name="sellado1" type="checkbox" value="1">&nbsp;Sellado</label>
                                    <?php } ?>
                                </fieldset>
                                
                            </div><!-- FIN LAMINA 1 -->
                            
                            <div class="w235 float_left border_der margin_r10">
                            	
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
                                            
                                            if($lamina2_ancho>=$formula_filtro){
												if($cotizacion_lamina2==$lamina2_id){
                                        ?>
                                        <option selected value="<?php echo $lamina2_id; ?>"><?php echo $lamina2_nombre; ?></option>
                                        <?php }else{ ?>
                                        <option value="<?php echo $lamina2_id; ?>"><?php echo $lamina2_nombre; ?></option>
                                    <?php }}} ?>
                                  </select>
                                </fieldset>
                                
                                <fieldset class="w235">
                                	<?php if($cotizacion_lamina2_extrusion==1){ ?>
                                    <label><input checked id="procesos_maquinas_3" class="procesos_maquinas" name="extrusion2" type="checkbox" value="1">&nbsp;Extrusión</label>
                                    <?php }else{ ?>
                                    <label><input id="procesos_maquinas_3" class="procesos_maquinas" name="extrusion2" type="checkbox" value="1">&nbsp;Extrusión</label>
                                    <?php } ?>
                                </fieldset>
                                
                                <fieldset class="w235">
                                	<?php if($cotizacion_lamina2_bilaminado==1){ ?>
                                    <label><input checked id="procesos_maquinas_5" class="procesos_maquinas" name="bilaminado2" type="checkbox" value="1">&nbsp;Bilaminado</label>
                                    <?php }else{ ?>
                                    <label><input id="procesos_maquinas_5" class="procesos_maquinas" name="bilaminado2" type="checkbox" value="1">&nbsp;Bilaminado</label>
                                    <?php } ?>
                                </fieldset>
                                <fieldset class="w235">
                                    <label for="bilaminado_proceso_2">GR / m2 (Adhesivo)</label>
                                  <input class="w140 texto_der" name="bilaminado_proceso_2" type="text" id="bilaminado_proceso_2" value="<?php echo $cotizacion_lamina2_bilaminado_grm2; ?>">
                                </fieldset>
                                
                                <fieldset class="w235">
                                	<?php if($cotizacion_lamina2_trilaminado==1){ ?>
                                    <label><input checked id="procesos_maquinas_6" class="procesos_maquinas" name="trilaminado2" type="checkbox" value="1">&nbsp;Trilaminado</label>
                                    <?php }else{ ?>
                                    <label><input id="procesos_maquinas_6" class="procesos_maquinas" name="trilaminado2" type="checkbox" value="1">&nbsp;Trilaminado</label>
                                    <?php } ?>
                                </fieldset>
                                                                
                                <input name="rebobinado2" type="hidden" value="0">
    
    							<input name="habilitado2" type="hidden" value="0">
                                
                                <fieldset class="w235">
                                	<?php if($cotizacion_lamina2_cortefinal==1){ ?>
                                    <label><input checked id="procesos_maquinas_7" class="procesos_maquinas" name="cortefinal2" type="checkbox" value="1">&nbsp;Corte</label>
                                    <?php }else{ ?>
                                    <label><input id="procesos_maquinas_7" class="procesos_maquinas" name="cortefinal2" type="checkbox" value="1">&nbsp;Corte</label>
                                    <?php } ?>
                                </fieldset>
                                
                                <fieldset class="w235">
                                	<?php if($cotizacion_lamina2_sellado==1){ ?>
                                    <label><input checked id="procesos_maquinas_8" class="procesos_maquinas" name="sellado2" type="checkbox" value="1">&nbsp;Sellado</label>
                                    <?php }else{ ?>
                                    <label><input id="procesos_maquinas_8" class="procesos_maquinas" name="sellado2" type="checkbox" value="1">&nbsp;Sellado</label>
                                    <?php } ?>
                                </fieldset>
                                
                            </div><!-- FIN LAMINA 2 -->
                            
                            <div class="w235 float_left border_der margin_r10">
                            	
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
                                            
                                            if($lamina3_ancho>=$formula_filtro){
												if($cotizacion_lamina3==$lamina3_id){
                                        ?>
                                        <option selected value="<?php echo $lamina3_id; ?>"><?php echo $lamina3_nombre; ?></option>
                                        <?php }else{ ?>
                                        <option value="<?php echo $lamina3_id; ?>"><?php echo $lamina3_nombre; ?></option>
                                    <?php }}} ?>
                                  </select>
                                </fieldset>
                                
                                <fieldset class="w235">
                                	<?php if($cotizacion_lamina3_extrusion==1){ ?>
                                    <label><input checked id="procesos_maquinas_3" class="procesos_maquinas" name="extrusion3" type="checkbox" value="1">&nbsp;Extrusión</label>
                                    <?php }else{ ?>
                                    <label><input id="procesos_maquinas_3" class="procesos_maquinas" name="extrusion3" type="checkbox" value="1">&nbsp;Extrusión</label>
                                    <?php } ?>                                    
                                </fieldset>
                                
                                <fieldset class="w235">
                                	<?php if($cotizacion_lamina3_trilaminado==1){ ?>
                                    <label><input checked id="procesos_maquinas_6" class="procesos_maquinas" name="trilaminado3" type="checkbox" value="1">&nbsp;Trilaminado</label>
                                    <?php }else{ ?>
                                    <label><input id="procesos_maquinas_6" class="procesos_maquinas" name="trilaminado3" type="checkbox" value="1">&nbsp;Trilaminado</label>
                                    <?php } ?>
                                </fieldset>
                                <fieldset class="w235">
                                    <label for="trilaminado_proceso_3">GR / m2 (Adhesivo)</label>
                                  <input class="w140 texto_der" name="trilaminado_proceso_3" type="text" id="trilaminado_proceso_3" value="<?php echo $cotizacion_lamina3_trilaminado_grm2; ?>">
                                </fieldset>
                                
                                <input name="rebobinado2" type="hidden" value="0">
    
    							<input name="habilitado2" type="hidden" value="0">
                                
                                <fieldset class="w235">
                                	<?php if($cotizacion_lamina3_cortefinal==1){ ?>
                                    <label><input checked id="procesos_maquinas_7" class="procesos_maquinas" name="cortefinal3" type="checkbox" value="1">&nbsp;Corte</label>
                                    <?php }else{ ?>
                                    <label><input id="procesos_maquinas_7" class="procesos_maquinas" name="cortefinal3" type="checkbox" value="1">&nbsp;Corte</label>
                                    <?php } ?>
                                </fieldset>
                                
                                <fieldset class="w235">
                                	<?php if($cotizacion_lamina3_sellado==1){ ?>
                                    <label><input checked id="procesos_maquinas_8" class="procesos_maquinas" name="sellado3" type="checkbox" value="1">&nbsp;Sellado</label>
                                    <?php }else{ ?>
                                    <label><input id="procesos_maquinas_8" class="procesos_maquinas" name="sellado3" type="checkbox" value="1">&nbsp;Sellado</label>
                                    <?php } ?>
                                </fieldset>
                                
                            </div><!-- FIN LAMINA 3 -->
                        
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
                            
                            <table width="100%" border="1" cellspacing="5" cellpadding="5" class="float_left">
                                    <thead>
                                        <tr>
                                            <td width="8.3%" class="texto_cen texto_10 fondo_c1 texto_bold">Procesos</td>
                                            <td width="13%" class="texto_cen texto_10 fondo_c1 texto_bold">Maquinas</td>
                                            <td width="8%" class="texto_cen texto_10 fondo_c1 texto_bold">Metros</td>
                                            <td width="8%" class="texto_cen texto_10 fondo_c1 texto_bold">Velocidad <br>Mts/Min</td>
                                            <td width="8.3%" class="texto_cen texto_10 fondo_c1 texto_bold">Prepar. <br>(HH:mm)</td>
                                            <td width="8.3%" class="texto_cen texto_10 fondo_c1 texto_bold">Regulac. <br>(HH:mm)</td>
                                            <td width="8%" class="texto_cen texto_10 fondo_c1 texto_bold">Tiempo (HH:mm)</td>
                                            <td width="8%" class="texto_cen texto_10 fondo_c1 texto_bold">Costo <br>Kw / <br>Hora</td>
                                            <td width="8%" class="texto_cen texto_10 fondo_c1 texto_bold">Costo <br>Hora / <br>Hombre</td>
                                            <td width="8%" class="texto_cen texto_10 fondo_c1 texto_bold">Costo <br>Deprec. <br>/ Hora</td>
                                            <td width="8%" class="texto_cen texto_10 fondo_c1 texto_bold">Gastos <br>Fábrica <br>/ Hora </td>
                                            <td width="8.3%" class="texto_cen texto_10 fondo_c1 texto_bold">Total</td>
                                        </tr>
                                    </thead>
                          </table>
                                
                            <div class="float_left" style="width:100%;">
                            
                            <?php if($proc_extrusion>0){ ?>
                                <div style="width:8.3%; height:20px; padding:1% 0;" class="float_left texto_izq">Extrusión</div>
								<div style="width:13%; height:20px; padding:1% 0;" class="float_left texto_cen">
                                        
                                  <!-- SELECCIONAR -->
                                  <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
                                  <script>
                                        var jcmbPro1 = jQuery.noConflict();
                                        jcmbPro1(document).ready(function(){
											var lamina1 = jcmbPro1("#dt_articulo1").val();
											var lamina2 = jcmbPro1("#dt_articulo2").val();
											var lamina3 = jcmbPro1("#dt_articulo3").val();
											var extrusion1 = <?php echo $cotizacion_lamina1_extrusion; ?>;
											var extrusion2 = <?php echo $cotizacion_lamina2_extrusion; ?>;
											var extrusion3 = <?php echo $cotizacion_lamina3_extrusion; ?>;
											var impresion1 = <?php echo $cotizacion_lamina1_impresion; ?>;										
											var bilaminado2 = <?php echo $cotizacion_lamina2_bilaminado; ?>;
											var trilaminado3 = <?php echo $cotizacion_lamina3_trilaminado; ?>;
											var cortefinal1 = <?php echo $cotizacion_lamina1_cortefinal; ?>;
											var cortefinal2 = <?php echo $cotizacion_lamina2_cortefinal; ?>;
											var cortefinal3 = <?php echo $cotizacion_lamina3_cortefinal; ?>;
											var impresion = <?php echo $proc_impresion; ?>;
											var bilaminado = <?php echo $proc_bilaminado; ?>;
											var trilaminado = <?php echo $proc_trilaminado; ?>;
											var cortefinal = <?php echo $proc_cortefinal; ?>;
											var sellado = <?php echo $proc_sellado; ?>;
											var maq = jcmbPro1("select#maquina_1 option:selected").val();
											var metrosproducir = jcmbPro1("#dtecnicos_metrosproducir").val();
											jcmbPro1.post("consulta-maquinas-datos.php", {dt_articulo1: lamina1, dt_articulo2: lamina2, dt_articulo3: lamina3,
											maquina: maq, metroproducir: metrosproducir, extrusion1: extrusion1, extrusion2: extrusion2, extrusion3: extrusion3, 
											impresio1: impresion1, bilaminado2: bilaminado2, trilaminado3: trilaminado3, cortefinal1: cortefinal1, cortefinal2: cortefinal2, 
											cortefinal3: cortefinal3, impresion: impresion, bilaminado: bilaminado, trilaminado: trilaminado, cortefinal: cortefinal, 
											sellado: sellado, metrosproducir: metrosproducir},
												function(data){
													jcmbPro1("#progressbar").addClass("ocultar");
													jcmbPro1('.datos_maquina_1').html(data);
												});
											
                                            jcmbPro1("#maquina_1").change(function() {
												jcmbPro1("#progressbar").removeClass("ocultar");
												//VALORES
												var lamina1 = jcmbPro1("#dt_articulo1").val();
												var lamina2 = jcmbPro1("#dt_articulo2").val();
												var lamina3 = jcmbPro1("#dt_articulo3").val();
												var extrusion1 = <?php echo $cotizacion_lamina1_extrusion; ?>;
												var extrusion2 = <?php echo $cotizacion_lamina2_extrusion; ?>;
												var extrusion3 = <?php echo $cotizacion_lamina3_extrusion; ?>;
												var impresion1 = <?php echo $cotizacion_lamina1_impresion; ?>;
												var bilaminado2 = <?php echo $cotizacion_lamina2_bilaminado; ?>;
												var trilaminado3 = <?php echo $cotizacion_lamina3_trilaminado; ?>;
												var cortefinal1 = <?php echo $cotizacion_lamina1_cortefinal; ?>;
												var cortefinal2 = <?php echo $cotizacion_lamina2_cortefinal; ?>;
												var cortefinal3 = <?php echo $cotizacion_lamina3_cortefinal; ?>;
												var impresion = <?php echo $proc_impresion; ?>;
												var bilaminado = <?php echo $proc_bilaminado; ?>;
												var trilaminado = <?php echo $proc_trilaminado; ?>;
												var cortefinal = <?php echo $proc_cortefinal; ?>;
												var maq = jcmbPro1("select#maquina_1 option:selected").val();
												var metrosproducir = jcmbPro1("#dtecnicos_metrosproducir").val();
												jcmbPro1.post("consulta-maquinas-datos.php", {dt_articulo1: lamina1, dt_articulo2: lamina2, dt_articulo3: lamina3,
												maquina: maq, metroproducir: metrosproducir, extrusion1: extrusion1, 
												extrusion2: extrusion2, extrusion3: extrusion3, impresio1: impresion1, bilaminado2: bilaminado2, trilaminado3: trilaminado3, 
												cortefinal1: cortefinal1, cortefinal2: cortefinal2, cortefinal3: cortefinal3,
												impresion: impresion, bilaminado: bilaminado, trilaminado: trilaminado, 
												cortefinal: cortefinal, metrosproducir: metrosproducir},
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
                                            $rst_maq=mysql_query("SELECT * FROM syCoesa_mantenimiento_maquinas_datos WHERE mostrar_maquina=1", $conexion);
                                            while($fila_maq=mysql_fetch_array($rst_maq)){
                                
                                                $maq_procesos=$fila_maq["procesos_productivos_maquina"];
                                                $maquina=seleccionTabla($fila_maq["id_maquina"],"id_maquina", "syCoesa_mantenimiento_maquinas", $conexion);
                                            
                                                if(ereg(3, $maq_procesos)){
													if($proc_extrusion==$maquina["id_maquina"]){
											?>
                                                <option selected value="<?php echo $maquina["id_maquina"]; ?>"><?php echo $maquina["nombre_maquina"]; ?></option>
                                                <?php }else{ ?>
                                            	<option value="<?php echo $maquina["id_maquina"]; ?>"><?php echo $maquina["nombre_maquina"]; ?></option>
                                            <?php }}} ?>
                                            
                                        </select>
                                </div>
                                <div class="datos_maquina_1"></div>
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
                                            $rst_maq=mysql_query("SELECT * FROM syCoesa_mantenimiento_maquinas_datos WHERE mostrar_maquina=1", $conexion);
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
                                            $rst_maq=mysql_query("SELECT * FROM syCoesa_mantenimiento_maquinas_datos WHERE mostrar_maquina=1", $conexion);
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
                                            $rst_maq=mysql_query("SELECT * FROM syCoesa_mantenimiento_maquinas_datos WHERE mostrar_maquina=1", $conexion);
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
                                            $rst_maq=mysql_query("SELECT * FROM syCoesa_mantenimiento_maquinas_datos WHERE mostrar_maquina=1", $conexion);
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
                                            $rst_maq=mysql_query("SELECT * FROM syCoesa_mantenimiento_maquinas_datos WHERE mostrar_maquina=1", $conexion);
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
                                            $rst_maq=mysql_query("SELECT * FROM syCoesa_mantenimiento_maquinas_datos WHERE mostrar_maquina=1", $conexion);
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
											var mtrprod = jcmbPro6("#dtecnicos_metrosproducir").val();
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
                                                var mtrprod = jcmbPro6("#dtecnicos_metrosproducir").val();
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
                                            $rst_maq=mysql_query("SELECT * FROM syCoesa_mantenimiento_maquinas_datos WHERE mostrar_maquina=1", $conexion);
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
                                            <td width="150" class="texto_cen texto_11 fondo_c1 texto_bold">Total</td>
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