<?php
session_start();
require_once("../../../connect/conexion.php");
require_once("../../../connect/function.php");
require_once("../../../connect/sesion/verificar_sesion.php");

//VARIABLES URL
$id_registro=$_REQUEST["id"];

//PEDIDO
$rst_cproduccion=mysql_query("SELECT * FROM syCoesa_costo_produccion WHERE id_costo_produccion=$id_registro", $conexion);
$fila_cproduccion=mysql_fetch_array($rst_cproduccion);
$num_cproduccion=mysql_num_rows($rst_cproduccion);

//ARTICULOS - VARIABLES
$cproduccion_id=$fila_cproduccion["id_costo_produccion"];
$cproduccion_cliente=seleccionTabla($fila_cproduccion["id_cliente"], "id_cliente", "syCoesa_clientes", $conexion);
$cproduccion_articulo=seleccionTabla($fila_cproduccion["id_articulo"], "id_articulo", "syCoesa_articulo", $conexion);

$cproduccion_grm2total=$fila_cproduccion["grm2total"];
$cproduccion_cantproduccion=$fila_cproduccion["cantproduccion"];
$cproduccion_metrosproducir=$fila_cproduccion["metrosproducir"];
$cproduccion_tolerancia=$fila_cproduccion["tolerancia"];
$cproduccion_cantcliente=$fila_cproduccion["cantcliente"];
$cproduccion_precio=$fila_cproduccion["precio"];
$cproduccion_proc_extrusion_maq=$fila_cproduccion["proc_extrusion_maq"];
$cproduccion_proc_impresion_maq=$fila_cproduccion["proc_impresion_maq"];
$cproduccion_proc_bilaminado_maq=$fila_cproduccion["proc_bilaminado_maq"];
$cproduccion_proc_trilaminado_maq=$fila_cproduccion["proc_trilaminado_maq"];
$cproduccion_proc_rebobinado_maq=$fila_cproduccion["proc_rebobinado_maq"];
$cproduccion_proc_habilitado_maq=$fila_cproduccion["proc_habilitado_maq"];
$cproduccion_proc_cortefinal_maq=$fila_cproduccion["proc_cortefinal_maq"];
$cproduccion_proc_sellado_maq=$fila_cproduccion["proc_sellado_maq"];
$cproduccion_insumo_tinta=$fila_cproduccion["insumo_tinta"];
$cproduccion_insumo_bilaminado=$fila_cproduccion["insumo_bilaminado"];
$cproduccion_insumo_trilaminado=$fila_cproduccion["insumo_trilaminado"];
$cproduccion_insumo_cushion=$fila_cproduccion["insumo_cushion"];
$cproduccion_insumo_clises=$fila_cproduccion["insumo_clises"];

//CLIENTES
$rst_cliente=mysql_query("SELECT * FROM syCoesa_clientes ORDER BY nombre_cliente ASC;", $conexion);

//ARTICULOS
$rst_articulo=mysql_query("SELECT * FROM syCoesa_articulo WHERE id_tipo_articulo=1 ORDER BY nombre_articulo ASC;", $conexion);

//SELECCIONAR LAMINAS
$cliente=$cproduccion_cliente["id_cliente"];
$articulo=$cproduccion_articulo["id_articulo"];
$codUnico=$cproduccion_articulo["cod_unico"];
$rst_ver=mysql_query("SELECT * FROM syCoesa_datos_tecnicos_laminas_procesos WHERE cod_unico='".$codUnico."';", $conexion);
$fila_ver=mysql_fetch_array($rst_ver);

$articulo_lamina1=seleccionTabla($fila_ver["lamina1"], "id_articulo", "syCoesa_articulo", $conexion);
$articulo_lamina2=seleccionTabla($fila_ver["lamina2"], "id_articulo", "syCoesa_articulo", $conexion);
$articulo_lamina3=seleccionTabla($fila_ver["lamina3"], "id_articulo", "syCoesa_articulo", $conexion);

//TIPOS DE INSUMOS
$rst_insTinta=mysql_query("SELECT * FROM syCoesa_articulo WHERE id_tipo_articulo=2 ORDER BY precio_articulo DESC;", $conexion);
$fila_insTinta=mysql_fetch_array($rst_insTinta);
$rst_insAdhBi=mysql_query("SELECT * FROM syCoesa_articulo WHERE id_tipo_articulo=4 ORDER BY nombre_articulo ASC;", $conexion);
$rst_insAdhTri=mysql_query("SELECT * FROM syCoesa_articulo WHERE id_tipo_articulo=4 ORDER BY nombre_articulo ASC;", $conexion);
$rst_insCush=mysql_query("SELECT * FROM syCoesa_articulo WHERE id_tipo_articulo=8 ORDER BY nombre_articulo ASC;", $conexion);
$rst_insClis=mysql_query("SELECT * FROM syCoesa_articulo WHERE id_tipo_articulo=11 ORDER BY nombre_articulo ASC;", $conexion);

//ARTICULO TERMINADO DE DATOS TECNICOS
$rst_dtart=mysql_query("SELECT * FROM syCoesa_datos_tecnicos WHERE cod_unico='".$codUnico."';", $conexion);
$fila_dtart=mysql_fetch_array($rst_dtart);
$dtart_anchofinal=$fila_dtart["ancho_final_datos_tecnicos"];
$dtart_nrobandas=$fila_dtart["nro_bandas_datos_tecnicos"];
$dtart_nrocolores=$fila_dtart["nro_colores_datos_tecnicos"];
$dtart_repeticion=$fila_dtart["distancia_repeticion"];
$dtart_frecuencia=$fila_dtart["frecuencia"];
$dtart_cilindro=$fila_dtart["cilindro"];

$articulo_datos=seleccionTabla($articulo, "id_articulo", "syCoesa_articulo", $conexion);

//LAMINAS PROCESO
$rst_pro=mysql_query("SELECT * FROM syCoesa_datos_tecnicos_laminas_procesos WHERE cod_unico='".$codUnico."';", $conexion);
$fila_pro=mysql_fetch_array($rst_pro);

//PROCESOS SELECCIONADOS
$lamina1=seleccionTabla($fila_pro["lamina1"], "id_articulo", "syCoesa_articulo", $conexion);
$lamina1_extrusion=$fila_pro["lamina1_extrusion"];
$lamina1_impresion=$fila_pro["lamina1_impresion"];
$lamina1_impresion_grm2=$fila_pro["lamina1_impresion_grm2"];
$lamina1_bilaminado=$fila_pro["lamina1_bilaminado"];
$lamina1_trilaminado=$fila_pro["lamina1_trilaminado"];
$lamina1_rebobinado=$fila_pro["lamina1_rebobinado"];
$lamina1_habilitado=$fila_pro["lamina1_habilitado"];
$lamina1_cortefinal=$fila_pro["lamina1_cortefinal"];
$lamina1_sellado=$fila_pro["lamina1_sellado"];

$lamina2=seleccionTabla($fila_pro["lamina2"], "id_articulo", "syCoesa_articulo", $conexion);
$lamina2_extrusion=$fila_pro["lamina2_extrusion"];
$lamina2_impresion=$fila_pro["lamina2_impresion"];
$lamina2_bilaminado=$fila_pro["lamina2_bilaminado"];
$lamina2_bilaminado_grm2=$fila_pro["lamina2_bilaminado_grm2"];
$lamina2_trilaminado=$fila_pro["lamina2_trilaminado"];
$lamina2_rebobinado=$fila_pro["lamina2_rebobinado"];
$lamina2_habilitado=$fila_pro["lamina2_habilitado"];
$lamina2_cortefinal=$fila_pro["lamina2_cortefinal"];
$lamina2_sellado=$fila_pro["lamina2_sellado"];

$lamina3=seleccionTabla($fila_pro["lamina3"], "id_articulo", "syCoesa_articulo", $conexion);
$lamina3_extrusion=$fila_pro["lamina3_extrusion"];
$lamina3_impresion=$fila_pro["lamina3_impresion"];
$lamina3_bilaminado=$fila_pro["lamina3_bilaminado"];
$lamina3_trilaminado=$fila_pro["lamina3_trilaminado"];
$lamina3_trilaminado_grm2=$fila_pro["lamina3_trilaminado_grm2"];
$lamina3_rebobinado=$fila_pro["lamina3_rebobinado"];
$lamina3_habilitado=$fila_pro["lamina3_habilitado"];
$lamina3_cortefinal=$fila_pro["lamina3_cortefinal"];
$lamina3_sellado=$fila_pro["lamina3_sellado"];

//CANTIDAD REQUERIDA
$grm2_total=round($cproduccion_grm2total);

//CANTIDAD REQUERIDA
$cantidad_requerida=round($cproduccion_cantproduccion);

//METROS A PRODUCIR
$mtrprod=round($cproduccion_metrosproducir);

//AGREGANDO METROS DE PROCESO + METROS A PRODUCIR
if($lamina1_sellado>0 or $lamina2_sellado>0 or $lamina3_sellado>0){ //SELLADO
	$procprod_merma_sellado=seleccionTabla("'sellado'", "url", "syCoesa_mantenimiento_procesos_productivos", $conexion);
	$mtrprod_sellado=$mtrprod + ($mtrprod * ($procprod_merma_sellado["merma_proceso"] / 100));
}else{ $mtrprod_sellado=0; $procprod_merma_sellado=0; }

if($lamina1_habilitado>0 or $lamina2_habilitado>0 or $lamina3_habilitado>0){ //HABILITADO
	$mtrprod_habilitado=$mtrprod_sellado;
}else{ $mtrprod_habilitado=0; }

if($lamina1_cortefinal>0 or $lamina2_cortefinal>0 or $lamina3_cortefinal>0){ //CORTE FINAL
	$procprod_merma_cortefinal=seleccionTabla("'corte-final'", "url", "syCoesa_mantenimiento_procesos_productivos", $conexion);
	$mtrprod_cortefinal=($mtrprod + ($mtrprod * ($procprod_merma_cortefinal["merma_proceso"] / 100)));
}else{ $mtrprod_cortefinal=0; $procprod_merma_cortefinal=0; }

if($lamina1_trilaminado>0 or $lamina2_trilaminado>0 or $lamina3_trilaminado>0){ //TRILAMINADO
	$procprod_merma_trilaminado=seleccionTabla("'trilaminado'", "url", "syCoesa_mantenimiento_procesos_productivos", $conexion);
	$mtrprod_trilaminado=($mtrprod + $procprod_merma_trilaminado["merma_proceso"]) + ($mtrprod * ($procprod_merma_sellado["merma_proceso"] / 100)) + ($mtrprod * ($procprod_merma_cortefinal["merma_proceso"] / 100));
}else{ $mtrprod_trilaminado=0; $procprod_merma_trilaminado=0; }

if($lamina1_bilaminado>0 or $lamina2_bilaminado>0 or $lamina3_bilaminado>0){ //BILAMINADO
	$procprod_merma_bilaminado=seleccionTabla("'bilaminado'", "url", "syCoesa_mantenimiento_procesos_productivos", $conexion);
	$mtrprod_bilaminado=($mtrprod + $procprod_merma_bilaminado["merma_proceso"]) + ($procprod_merma_trilaminado["merma_proceso"]) + ($mtrprod * ($procprod_merma_sellado["merma_proceso"] / 100)) + ($mtrprod * ($procprod_merma_cortefinal["merma_proceso"] / 100));
}else{ $mtrprod_bilaminado=0; $procprod_merma_bilaminado=0; }

if($lamina1_rebobinado>0 or $lamina2_rebobinado>0 or $lamina3_rebobinado>0){ //REBOBINADO
	$mtrprod_rebobinado=$mtrprod_bilaminado;
}else{ $mtrprod_rebobinado=0; }

if($lamina1_impresion>0 or $lamina2_impresion>0 or $lamina3_impresion>0){ //IMPRESION
	$procprod_merma=seleccionTabla("'impresion'", "url", "syCoesa_mantenimiento_procesos_productivos", $conexion);
	$mtrprod_impresion=($mtrprod + ($procprod_merma["merma_proceso"] * $dtart_nrocolores)) + ($procprod_merma_bilaminado["merma_proceso"]) + ($procprod_merma_trilaminado["merma_proceso"]) + ($mtrprod * ($procprod_merma_sellado["merma_proceso"] / 100)) + ($mtrprod * ($procprod_merma_cortefinal["merma_proceso"] / 100));
}else{ $mtrprod_impresion=0; }

if($lamina1_extrusion>0 or $lamina2_extrusion>0 or $lamina3_extrusion>0){ //EXTRUSION
	$procprod_merma=seleccionTabla("'extrusion'", "url", "syCoesa_mantenimiento_procesos_productivos", $conexion);
	
	if($lamina1_extrusion>0){
		if($lamina1_impresion>0){
			$totalKg=(($mtrprod_impresion * $lamina1["ancho_articulo"] * $lamina1["grm2_articulo"]) / 1000000) + $procprod_merma["merma_proceso"];
		}elseif($lamina1_bilaminado>0){
			$totalKg=(($mtrprod_bilaminado * $lamina1["ancho_articulo"] * $lamina1["grm2_articulo"]) / 1000000) + $procprod_merma["merma_proceso"];
		}elseif($lamina1_trilaminado>0){
			$totalKg=(($mtrprod_trilaminado * $lamina1["ancho_articulo"] * $lamina1["grm2_articulo"]) / 1000000) + $procprod_merma["merma_proceso"];
		}elseif($lamina1_cortefinal>0){
			$totalKg=(($mtrprod_cortefinal * $lamina1["ancho_articulo"] * $lamina1["grm2_articulo"]) / 1000000) + $procprod_merma["merma_proceso"];
		}
	}elseif($lamina2_extrusion>0){
		if($lamina2_bilaminado>0){
			$totalKg=(($mtrprod_bilaminado * $lamina2["ancho_articulo"] * $lamina2["grm2_articulo"]) / 1000000) + $procprod_merma["merma_proceso"];
		}elseif($lamina2_trilaminado>0){
			$totalKg=(($mtrprod_trilaminado * $lamina2["ancho_articulo"] * $lamina2["grm2_articulo"]) / 1000000) + $procprod_merma["merma_proceso"];
		}elseif($lamina2_cortefinal>0){
			$totalKg=(($mtrprod_cortefinal * $lamina2["ancho_articulo"] * $lamina2["grm2_articulo"]) / 1000000) + $procprod_merma["merma_proceso"];
		}
	}elseif($lamina3_extrusion>0){
		if($lamina3_trilaminado>0){
			$totalKg=(($mtrprod_trilaminado * $lamina3["ancho_articulo"] * $lamina3["grm2_articulo"]) / 1000000) + $procprod_merma["merma_proceso"];
		}elseif($lamina3_cortefinal>0){
			$totalKg=(($mtrprod_cortefinal * $lamina3["ancho_articulo"] * $lamina3["grm2_articulo"]) / 1000000) + $procprod_merma["merma_proceso"];
		}
	}

}else{ $totalKg=0; }

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

<!-- SELECCIONAR MAQUINAS -->
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript">
var jefform = jQuery.noConflict();
jefform(document).ready(function(){
	jefform("#dtp_selecmaq").click(function() {
		jefform("#progressbar").removeClass("ocultar");
		var cliente = <?php echo $cproduccion_cliente["id_cliente"]; ?>;
		var articulo = <?php echo $cproduccion_articulo["id_articulo"]; ?>;
		var tolerancia = jefform("#dtecnicos_tolerancia").val();
		var cantidad = jefform("#dtecnicos_cantidadclt").val();
		var precio = jefform("#dtecnicos_precio").val();
		jefform.post("consulta-laminas.php", {articulo: articulo, cliente: cliente, tolerancia: tolerancia, cantidad: cantidad, precio: precio},
			function(data){
				jefform("#progressbar").addClass("ocultar");
				jefform('#laminas').html(data);
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
                <h6>Costos de Produccion <?php echo $dtecnicos_id; ?></h6></div>
            
                <div class="frmdt_contenido">
                    
                  <form action="actualizar.php" method="post" enctype="multipart/form-data">
                        
                        <fieldset class="alto50">
                          	<label for="dtecnicos_cliente">Cliente:</label>
							<input name="dtecnicos_cliente" id="dtecnicos_cliente" type="text" value="<?php echo $cproduccion_cliente["nombre_cliente"]; ?>">
                        </fieldset>
                        
                        <fieldset class="alto50">
                          	<label for="dtecnicos_producto">Producto terminado:</label>
							<input name="dtecnicos_producto" id="dtecnicos_producto" type="text" value="<?php echo $cproduccion_articulo["nombre_articulo"]; ?>">
                        </fieldset>
                        
                        <fieldset class="alto50 w180">
                        	<label>% Tolerancia:</label>
                            <input name="dtecnicos_tolerancia" id="dtecnicos_tolerancia" type="text" class="w130 texto_der" value="<?php echo $cproduccion_tolerancia; ?>">
                        </fieldset>
                        
                        <fieldset class="alto50 w180">
                        	<label>Cantidad:</label>
                            <input name="dtecnicos_cantidadclt" id="dtecnicos_cantidadclt" type="text" class="w130 texto_der" value="<?php echo $cproduccion_cantcliente; ?>">
                        </fieldset>
                        
                        <fieldset class="alto50 w180">
                        	<label>Precio:</label>
                            <input name="dtecnicos_precio" id="dtecnicos_precio" type="text" class="w130 texto_der" value="<?php echo $cproduccion_precio; ?>">
                        </fieldset>
                        
                        <fieldset class="float_left w180">
                            <a href="javascript:;" name="dtp_selecmaq" id="dtp_selecmaq">Seleccionar maquinas</a>
                        </fieldset>
                        
                        <div id="laminas">
                        	
                            <table width="100%" border="1" cellspacing="5" cellpadding="5">
                                <thead>
                                    <tr>
                                        <td width="55%" class="texto_cen texto_11 fondo_c1 texto_bold">Lamina</td>
                                        <td width="15%" class="texto_cen texto_11 fondo_c1 texto_bold">GR / m2</td>
                                        <td width="15%" class="texto_cen texto_11 fondo_c1 texto_bold">Ancho</td>
                                        <td width="15%" class="texto_cen texto_11 fondo_c1 texto_bold">Precio</td>
                                    </tr>
                                </thead>
                                <tbody>

                            	<?php if($fila_ver["lamina1"]>0){ ?>
                                <tr>
                                    <td class="texto_izq"><?php echo $articulo_lamina1["nombre_articulo"]; ?></td>
                                    <td class="texto_der"><?php echo $articulo_lamina1["grm2_articulo"]; ?></td>
                                    <td class="texto_der"><?php echo $articulo_lamina1["ancho_articulo"]; ?></td>
                                    <td class="texto_der"><?php echo $articulo_lamina1["precio_articulo"]; ?></td>
                                </tr>
                                <?php } ?>
                                
                                <?php if($fila_ver["lamina2"]>0){ ?>
                                <tr>
                                    <td class="texto_izq"><?php echo $articulo_lamina2["nombre_articulo"]; ?></td>
                                    <td class="texto_der"><?php echo $articulo_lamina2["grm2_articulo"]; ?></td>
                                    <td class="texto_der"><?php echo $articulo_lamina2["ancho_articulo"]; ?></td>
                                    <td class="texto_der"><?php echo $articulo_lamina2["precio_articulo"]; ?></td>
                                </tr>
                                <?php } ?>
                                
                                <?php if($fila_ver["lamina3"]>0){ ?>
                                <tr>
                                    <td class="texto_izq"><?php echo $articulo_lamina3["nombre_articulo"]; ?></td>
                                    <td class="texto_der"><?php echo $articulo_lamina3["grm2_articulo"]; ?></td>
                                    <td class="texto_der"><?php echo $articulo_lamina3["ancho_articulo"]; ?></td>
                                    <td class="texto_der"><?php echo $articulo_lamina3["precio_articulo"]; ?></td>
                                </tr>
                                <?php } ?>
                                  
                                </tbody>
                            </table>
                            
                            <div id="maquinas_articulo" class="float_left">
                            	
                                <div class="padding_tb10">

                                    <fieldset class="alto50 w180">
                                        <label for="dtecnicos_grm2_total">Gr / m2:</label>
                                        <input readonly name="dtecnicos_grm2_total" type="text" id="dtecnicos_grm2_total" class="w130" value="<?php echo $grm2_total; ?>">
                                    </fieldset>
                                    
                                    <fieldset class="alto50 w180">
                                        <label for="dtecnicos_cantrequerida">Cantidad requerida:</label>
                                        <input readonly name="dtecnicos_cantrequerida" type="text" id="dtecnicos_cantrequerida" class="w130" value="<?php echo $cantidad_requerida; ?>">
                                    </fieldset>
                                    
                                    <fieldset class="alto50 w180">
                                        <label for="dtecnicos_metrosproducir">Metros a producir:</label>
                                        <input readonly name="dtecnicos_metrosproducir" type="text" id="dtecnicos_metrosproducir" class="w130" value="<?php echo $mtrprod; ?>">
                                    </fieldset>
                                    </div>
                                    
                                    <table width="100%" border="1" cellspacing="5" cellpadding="5">
                                            <thead>
                                                <tr>
                                                    <td width="8.3%" class="texto_cen texto_10 fondo_c1 texto_bold">Procesos</td>
                                                    <td width="13%" class="texto_cen texto_10 fondo_c1 texto_bold">Maquinas</td>
                                                    <td width="8%" class="texto_cen texto_10 fondo_c1 texto_bold">Metros</td>
                                                    <td width="8%" class="texto_cen texto_10 fondo_c1 texto_bold">Velocidad</td>
                                                    <td width="8.3%" class="texto_cen texto_10 fondo_c1 texto_bold">Prepar.</td>
                                                    <td width="8.3%" class="texto_cen texto_10 fondo_c1 texto_bold">Regulac.</td>
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
                                    
                                    <?php if($lamina1_extrusion>0 or $lamina2_extrusion>0 or $lamina3_extrusion>0){ ?>
                                        <div style="width:8.3%; height:20px; padding:1% 0;" class="float_left texto_izq">Extrusión</div>
                                        <div style="width:13%; height:20px; padding:1% 0;" class="float_left texto_cen">
                                                
                                                <!-- SELECCIONAR -->
                                                <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
                                                <script>
                                                var jcmbPro1 = jQuery.noConflict();
                                                jcmbPro1(document).ready(function(){
													
													jcmbPro1("#progressbar").removeClass("ocultar");
													var maq = jcmbPro1("select#maquina_1 option:selected").val();
													
													jcmbPro1.post("consulta-maquinas-datos.php", {maquina: maq, metroproducir: <?php echo $totalKg; ?>},
														function(data){
															jcmbPro1("#progressbar").addClass("ocultar");
															jcmbPro1('.datos_maquina_1').html(data);
														});
													
                                                    jcmbPro1("#maquina_1").change(function() {
                                                        jcmbPro1("#progressbar").removeClass("ocultar");
                                                        var maq = jcmbPro1("select#maquina_1 option:selected").val();
                                                        
                                                        jcmbPro1.post("consulta-maquinas-datos.php", {maquina: maq, metroproducir: <?php echo $totalKg; ?>},
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
                                                    
                                                        if(ereg(3, $maq_procesos)){ ?>
                                                        
                                                        <?php if($cproduccion_proc_extrusion_maq==$maquina["id_maquina"]){ ?>
                                                        <option selected value="<?php echo $maquina["id_maquina"]; ?>"><?php echo $maquina["nombre_maquina"]; ?></option>
                                                    	<?php }else{ ?>
                                                        <option value="<?php echo $maquina["id_maquina"]; ?>"><?php echo $maquina["nombre_maquina"]; ?></option>
                                                        <?php } ?>
                                                    
                                                    <?php }} ?>
                                                    
                                                </select>
                                        </div>
                                        <div class="datos_maquina_1"></div>
                                    <?php } //FIN EXTRUSION ?>
                                    
                                    <?php if($lamina1_impresion>0 or $lamina2_impresion>0 or $lamina3_impresion>0){ ?>    
                                      <div style="width:8.3%; height:20px; padding:1% 0;" class="float_left texto_izq">Impresión</div>
                                    <div style="width:13%; height:20px; padding:1% 0;" class="float_left texto_cen">
                                                
                                                <!-- SELECCIONAR -->
                                                <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
                                                <script>
                                                var jcmbPro2 = jQuery.noConflict();
                                                jcmbPro2(document).ready(function(){
													
													jcmbPro2("#progressbar").removeClass("ocultar");
													var maq = jcmbPro2("select#maquina_2 option:selected").val();
													var mtrprod = jcmbPro2("#dtecnicos_metrosproducir").val();
													
													jcmbPro2.post("consulta-maquinas-datos.php", {maquina: maq, metroproducir: <?php echo $mtrprod_impresion; ?>},
														function(data){
															jcmbPro2("#progressbar").addClass("ocultar");
															jcmbPro2('.datos_maquina_2').html(data);
														});
													
                                                    jcmbPro2("#maquina_2").change(function() {
                                                        jcmbPro2("#progressbar").removeClass("ocultar");
                                                        var maq = jcmbPro2("select#maquina_2 option:selected").val();
                                                        var mtrprod = jcmbPro2("#dtecnicos_metrosproducir").val();
                                                        
                                                        jcmbPro2.post("consulta-maquinas-datos.php", {maquina: maq, metroproducir: <?php echo $mtrprod_impresion; ?>},
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
                                                    
                                                        if(ereg(4, $maq_procesos)){ ?>
                                                        
                                                        <?php if($cproduccion_proc_impresion_maq==$maquina["id_maquina"]){ ?>
                                                        <option selected value="<?php echo $maquina["id_maquina"]; ?>"><?php echo $maquina["nombre_maquina"]; ?></option>
                                                    	<?php }else{ ?>
                                                        <option value="<?php echo $maquina["id_maquina"]; ?>"><?php echo $maquina["nombre_maquina"]; ?></option>
                                                        <?php } ?>
                                                    
                                                    <?php }} ?>
                                                    
                                                </select>
                                        </div>
                                        <div class="datos_maquina_2"></div>
                                    <?php } ?>
                                        
                                    <?php if($lamina1_bilaminado>0 or $lamina2_bilaminado>0 or $lamina3_bilaminado>0){ ?>
                                      <div style="width:8.3%; height:20px; padding:1% 0;" class="float_left texto_izq">Bilaminado</div>
                                    <div style="width:13%; height:20px; padding:1% 0;" class="float_left texto_cen">
                                                
                                                <!-- SELECCIONAR -->
                                                <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
                                                <script>
                                                var jcmbPro3 = jQuery.noConflict();
                                                jcmbPro3(document).ready(function(){
													
													jcmbPro3("#progressbar").removeClass("ocultar")
													var maq = jcmbPro3("select#maquina_3 option:selected").val();
													var mtrprod = jcmbPro3("#dtecnicos_metrosproducir").val();
																		
													jcmbPro3.post("consulta-maquinas-datos.php", {maquina: maq, metroproducir: <?php echo $mtrprod_bilaminado; ?>},
														function(data){
															jcmbPro3("#progressbar").addClass("ocultar");
															jcmbPro3('.datos_maquina_3').html(data);
														});
													
                                                    jcmbPro3("#maquina_3").change(function() {
                                                        jcmbPro3("#progressbar").removeClass("ocultar")
                                                        var maq = jcmbPro3("select#maquina_3 option:selected").val();
                                                        var mtrprod = jcmbPro3("#dtecnicos_metrosproducir").val();
                                                                            
                                                        jcmbPro3.post("consulta-maquinas-datos.php", {maquina: maq, metroproducir: <?php echo $mtrprod_bilaminado; ?>},
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
                                                    
                                                        if(ereg(5, $maq_procesos)){ ?>
                                                        
                                                        <?php if($cproduccion_proc_bilaminado_maq==$maquina["id_maquina"]){ ?>
                                                        <option selected value="<?php echo $maquina["id_maquina"]; ?>"><?php echo $maquina["nombre_maquina"]; ?></option>
                                                    	<?php }else{ ?>
                                                        <option value="<?php echo $maquina["id_maquina"]; ?>"><?php echo $maquina["nombre_maquina"]; ?></option>
                                                        <?php } ?>
                                                    
                                                    <?php }} ?>
                                                    
                                                </select>
                                        </div>
                                        <div class="datos_maquina_3"></div>
                                    <?php } ?>
                                    
                                    <?php if($lamina1_trilaminado>0 or $lamina2_trilaminado>0 or $lamina3_trilaminado>0){ ?>
                                      <div style="width:8.3%; height:20px; padding:1% 0;" class="float_left texto_izq">Trilaminado</div>
                                    <div style="width:13%; height:20px; padding:1% 0;" class="float_left texto_cen">
                                                
                                                <!-- SELECCIONAR -->
                                                <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
                                                <script>
                                                var jcmbPro4 = jQuery.noConflict();
                                                jcmbPro4(document).ready(function(){
													
													jcmbPro4("#progressbar").removeClass("ocultar");                
													var maq = jcmbPro4("select#maquina_4 option:selected").val();
													var mtrprod = jcmbPro4("#dtecnicos_metrosproducir").val();
																		
													jcmbPro4.post("consulta-maquinas-datos.php", {maquina: maq, metroproducir: <?php echo $mtrprod_trilaminado; ?>},
														function(data){
															jcmbPro4("#progressbar").addClass("ocultar");
															jcmbPro4('.datos_maquina_4').html(data);
														});
													
                                                    jcmbPro4("#maquina_4").change(function() {
                                                        jcmbPro4("#progressbar").removeClass("ocultar");                
                                                        var maq = jcmbPro4("select#maquina_4 option:selected").val();
                                                        var mtrprod = jcmbPro4("#dtecnicos_metrosproducir").val();
                                                                            
                                                        jcmbPro4.post("consulta-maquinas-datos.php", {maquina: maq, metroproducir: <?php echo $mtrprod_trilaminado; ?>},
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
                                                    
                                                        if(ereg(6, $maq_procesos)){ ?>
                                                    	
                                                        <?php if($cproduccion_proc_trilaminado_maq==$maquina["id_maquina"]){ ?>
                                                        <option selected value="<?php echo $maquina["id_maquina"]; ?>"><?php echo $maquina["nombre_maquina"]; ?></option>
                                                    	<?php }else{ ?>
                                                        <option value="<?php echo $maquina["id_maquina"]; ?>"><?php echo $maquina["nombre_maquina"]; ?></option>
                                                        <?php } ?>
                                                        
                                                    <?php }} ?>
                                                    
                                                </select>
                                        </div>
                                        <div class="datos_maquina_4"></div>
                                    <?php } ?>
                                    
                                    <?php if($lamina1_rebobinado>0 or $lamina2_rebobinado>0 or $lamina3_rebobinado>0){ ?>
                                      <div style="width:8.3%; height:20px; padding:1% 0;" class="float_left texto_izq">Rebobinado</div>
                                    <div style="width:13%; height:20px; padding:1% 0;" class="float_left texto_cen">
                                                
                                                <!-- SELECCIONAR -->
                                                <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
                                                <script>
                                                var jcmbPro7 = jQuery.noConflict();
                                                jcmbPro7(document).ready(function(){
													
													jcmbPro7("#progressbar").removeClass("ocultar");
													var maq = jcmbPro7("select#maquina_7 option:selected").val();
													var mtrprod = jcmbPro7("#dtecnicos_metrosproducir").val();
													
													jcmbPro7.post("consulta-maquinas-datos.php", {maquina: maq, metroproducir: <?php echo $mtrprod_rebobinado; ?>},
														function(data){
															jcmbPro7("#progressbar").addClass("ocultar");
															jcmbPro7('.datos_maquina_7').html(data);
														});
													
                                                    jcmbPro7("#maquina_7").change(function() {
                                                        jcmbPro7("#progressbar").removeClass("ocultar");
                                                        var maq = jcmbPro7("select#maquina_7 option:selected").val();
                                                        var mtrprod = jcmbPro7("#dtecnicos_metrosproducir").val();
                                                        
                                                        jcmbPro7.post("consulta-maquinas-datos.php", {maquina: maq, metroproducir: <?php echo $mtrprod_rebobinado; ?>},
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
                                                    
                                                        if(ereg(9, $maq_procesos)){ ?>
                                                    	
                                                        <?php if($cproduccion_proc_rebobinado_maq==$maquina["id_maquina"]){ ?>
                                                        <option selected value="<?php echo $maquina["id_maquina"]; ?>"><?php echo $maquina["nombre_maquina"]; ?></option>
                                                    	<?php }else{ ?>
                                                        <option value="<?php echo $maquina["id_maquina"]; ?>"><?php echo $maquina["nombre_maquina"]; ?></option>
                                                        <?php } ?>
                                                        
                                                    <?php }} ?>
                                                    
                                                </select>
                                        </div>
                                        <div class="datos_maquina_7"></div>
                                    <?php } ?>
                                    
                                    <?php if($lamina1_habilitado>0 or $lamina2_habilitado>0 or $lamina3_habilitado>0){ ?>
                                      <div style="width:8.3%; height:20px; padding:1% 0;" class="float_left texto_izq">Habilitado</div>
                                    <div style="width:13%; height:20px; padding:1% 0;" class="float_left texto_cen">
                                                
                                                <!-- SELECCIONAR -->
                                                <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
                                                <script>
                                                var jcmbPro8 = jQuery.noConflict();
                                                jcmbPro8(document).ready(function(){
													
													jcmbPro8("#progressbar").removeClass("ocultar");
													var maq = jcmbPro8("select#maquina_8 option:selected").val();
													var mtrprod = jcmbPro8("#dtecnicos_metrosproducir").val();
													
													jcmbPro8.post("consulta-maquinas-datos.php", {maquina: maq, metroproducir: <?php echo $mtrprod_habilitado; ?>},
														function(data){
															jcmbPro8("#progressbar").addClass("ocultar");
															jcmbPro8('.datos_maquina_8').html(data);
														});
													
                                                    jcmbPro8("#maquina_8").change(function() {
                                                        jcmbPro8("#progressbar").removeClass("ocultar");
                                                        var maq = jcmbPro8("select#maquina_8 option:selected").val();
                                                        var mtrprod = jcmbPro8("#dtecnicos_metrosproducir").val();
                                                        
                                                        jcmbPro8.post("consulta-maquinas-datos.php", {maquina: maq, metroproducir: <?php echo $mtrprod_habilitado; ?>},
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
                                                    
                                                        if(ereg(10, $maq_procesos)){ ?>
                                                        
                                                        <?php if($cproduccion_proc_habilitado_maq==$maquina["id_maquina"]){ ?>
                                                        <option selected value="<?php echo $maquina["id_maquina"]; ?>"><?php echo $maquina["nombre_maquina"]; ?></option>
                                                    	<?php }else{ ?>
                                                        <option value="<?php echo $maquina["id_maquina"]; ?>"><?php echo $maquina["nombre_maquina"]; ?></option>
                                                        <?php } ?>
                                                        
                                                    <?php }} ?>
                                                    
                                                </select>
                                        </div>
                                        <div class="datos_maquina_8"></div>
                                    <?php } ?>
                                    
                                    <?php if($lamina1_cortefinal>0 or $lamina2_cortefinal>0 or $lamina3_cortefinal>0){ ?>
                                      <div style="width:8.3%; height:20px; padding:1% 0;" class="float_left texto_izq">Corte Final</div>
                                    <div style="width:13%; height:20px; padding:1% 0;" class="float_left texto_cen">
                                                
                                                <!-- SELECCIONAR -->
                                                <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
                                                <script>
                                                var jcmbPro5 = jQuery.noConflict();
                                                jcmbPro5(document).ready(function(){
													
													jcmbPro5("#progressbar").removeClass("ocultar");
													var maq = jcmbPro5("select#maquina_5 option:selected").val();
													var mtrprod = jcmbPro5("#dtecnicos_metrosproducir").val();
													
													jcmbPro5.post("consulta-maquinas-datos.php", {maquina: maq, metroproducir: <?php echo $mtrprod_cortefinal; ?>},
														function(data){
															jcmbPro5("#progressbar").addClass("ocultar");
															jcmbPro5('.datos_maquina_5').html(data);
														});
													
                                                    jcmbPro5("#maquina_5").change(function() {
                                                        jcmbPro5("#progressbar").removeClass("ocultar");
                                                        var maq = jcmbPro5("select#maquina_5 option:selected").val();
                                                        var mtrprod = jcmbPro5("#dtecnicos_metrosproducir").val();
                                                        
                                                        jcmbPro5.post("consulta-maquinas-datos.php", {maquina: maq, metroproducir: <?php echo $mtrprod_cortefinal; ?>},
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
                                                    
                                                        if(ereg(7, $maq_procesos)){ ?>
                                                        
                                                        <?php if($cproduccion_proc_cortefinal_maq==$maquina["id_maquina"]){ ?>
                                                        <option selected value="<?php echo $maquina["id_maquina"]; ?>"><?php echo $maquina["nombre_maquina"]; ?></option>
                                                    	<?php }else{ ?>
                                                        <option value="<?php echo $maquina["id_maquina"]; ?>"><?php echo $maquina["nombre_maquina"]; ?></option>
                                                        <?php } ?>
                                                        
                                                    <?php }} ?>
                                                    
                                                </select>
                                        </div>
                                        <div class="datos_maquina_5"></div>
                                    <?php } ?>
                                    
                                    <?php if($lamina1_sellado>0 or $lamina2_sellado>0 or $lamina3_sellado>0){ ?>
                                        <div style="width:8.3%; height:20px; padding:1% 0;" class="float_left texto_izq">Sellado</div>
                                        <div style="width:13%; height:20px; padding:1% 0;" class="float_left texto_cen">
                                                
                                                <!-- SELECCIONAR -->
                                                <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
                                                <script>
                                                var jcmbPro6 = jQuery.noConflict();
                                                jcmbPro6(document).ready(function(){
													
													jcmbPro6("#progressbar").removeClass("ocultar");
													var maq = jcmbPro6("select#maquina_6 option:selected").val();
													var mtrprod = jcmbPro6("#dtecnicos_metrosproducir").val();
																		
													jcmbPro6.post("consulta-maquinas-datos.php", {maquina: maq, metroproducir: <?php echo $mtrprod_sellado; ?>},
														function(data){
															jcmbPro6("#progressbar").addClass("ocultar");
															jcmbPro6('.datos_maquina_6').html(data);
														});
													
                                                    jcmbPro6("#maquina_6").change(function() {
                                                        jcmbPro6("#progressbar").removeClass("ocultar");
                                                        var maq = jcmbPro6("select#maquina_6 option:selected").val();
                                                        var mtrprod = jcmbPro6("#dtecnicos_metrosproducir").val();
                                                                            
                                                        jcmbPro6.post("consulta-maquinas-datos.php", {maquina: maq, metroproducir: <?php echo $mtrprod_sellado; ?>},
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
                                                    
                                                        if(ereg(8, $maq_procesos)){ ?>
                                                    	
                                                        <?php if($cproduccion_proc_sellado_maq==$maquina["id_maquina"]){ ?>
                                                        <option selected value="<?php echo $maquina["id_maquina"]; ?>"><?php echo $maquina["nombre_maquina"]; ?></option>
                                                    	<?php }else{ ?>
                                                        <option value="<?php echo $maquina["id_maquina"]; ?>"><?php echo $maquina["nombre_maquina"]; ?></option>
                                                        <?php } ?>
                                                        
                                                    <?php }} ?>
                                                    
                                                </select>
                                        </div>
                                        <div class="datos_maquina_6"></div>
                                    <?php } ?>
                                    
                                    </div>
                                    
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
                                    
                                    <?php if($lamina1_impresion>0 or $lamina2_impresion>0 or $lamina3_impresion>0){ ?>
                                    
                                    <div class="float_left" style="width:800px;">
                                    
                                        <div style="width:146px; height:20px; padding:1% 0;" class="float_left texto_izq">Tinta (Kg)</div>
                                        <div style="width:200px; height:0px; padding:1% 0;" class="float_left texto_cen">
                                        <!-- SELECCIONAR -->
                                        <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
                                        <script>
                                            var jcmbIns1 = jQuery.noConflict();
                                            jcmbIns1(document).ready(function(){
                                                jcmbIns1("#progressbar").removeClass("ocultar");
                                                var grm2total = <?php echo $articulo_datos["grm2_articulo"]; ?>;
                                                var anchofinal = <?php echo $dtart_anchofinal; ?>;
                                                var nrobandas = <?php echo $dtart_nrobandas; ?>;
                                                var metrototal = <?php echo $mtrprod_impresion; ?>;
                                                var grm2 = <?php echo $lamina1_impresion_grm2; ?>;
                                                var tipo = "tinta";
												var insumo_tinta = <?php echo $cproduccion_insumo_tinta; ?>;
                                                jcmbIns1.post("insumos-costos.php", {insumo_tinta: insumo_tinta,  grm2total: grm2total, anchofinal: anchofinal, nrobandas: nrobandas, metrototal: metrototal, grm2: grm2, tipo: tipo}, 
                                                    function(data){
                                                        jcmbIns1("#progressbar").addClass("ocultar");
                                                        jcmbIns1('.datos_insumos_1').html(data);
                                                    });
                                            });
                                        </script>
                                        </div>    
                                        <div class="datos_insumos_1" style="width:452px; float:left; padding:1% 0;"></div>
                                    </div>
                                    <?php } ?>
                                    
                                    <?php if($lamina1_bilaminado>0 or $lamina2_bilaminado>0 or $lamina3_bilaminado>0){ ?>
                                    <div class="float_left" style="width:800px;">
                                        <div style="width:146px; height:20px; padding:1% 0;" class="float_left texto_izq">Adhesivo Bilaminado (Kg)</div>
                                        <div style="width:200px; height:0px; padding:1% 0;" class="float_left texto_cen">
                                                    
                                            <!-- SELECCIONAR -->
                                            <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
                                            <script>
                                            var jcmbIns2 = jQuery.noConflict();
                                            jcmbIns2(document).ready(function(){
												
												jcmbIns2("#progressbar").removeClass("ocultar");
												var insumo = jcmbIns2("select#insumo2 option:selected").val();
												var grm2total = <?php echo $articulo_datos["grm2_articulo"]; ?>;
												var anchofinal = <?php echo $dtart_anchofinal; ?>;
												var nrobandas = <?php echo $dtart_nrobandas; ?>;
												var metrototal = <?php echo $mtrprod_bilaminado; ?>;
												var grm2 = <?php echo $lamina2_bilaminado_grm2; ?>;
												jcmbIns2.post("insumos-costos.php", {insumo: insumo, grm2total: grm2total, anchofinal: anchofinal, nrobandas: nrobandas, metrototal: metrototal, grm2: grm2}, 
													function(data){
														jcmbIns2("#progressbar").addClass("ocultar");
														jcmbIns2('.datos_insumos_2').html(data);
													});
												
                                                jcmbIns2("#insumo2").change(function() {
                                                    jcmbIns2("#progressbar").removeClass("ocultar");
                                                    var insumo = jcmbIns2("select#insumo2 option:selected").val();
                                                    var grm2total = <?php echo $articulo_datos["grm2_articulo"]; ?>;
                                                    var anchofinal = <?php echo $dtart_anchofinal; ?>;
                                                    var nrobandas = <?php echo $dtart_nrobandas; ?>;
                                                    var metrototal = <?php echo $mtrprod_bilaminado; ?>;
                                                    var grm2 = <?php echo $lamina2_bilaminado_grm2; ?>;
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
                                                <?php while($fila_insumo=mysql_fetch_array($rst_insAdhBi)){
                                                    $insumo_id=$fila_insumo["id_articulo"];
                                                    $insumo_nombre=$fila_insumo["nombre_articulo"];
                                                ?>
                                                	<?php if($cproduccion_insumo_bilaminado==$insumo_id){ ?>
                                                    <option selected value="<?php echo $insumo_id; ?>"><?php echo $insumo_nombre; ?></option>
                                                    <?php }else{ ?>
                                                    <option value="<?php echo $insumo_id; ?>"><?php echo $insumo_nombre; ?></option>
                                                    <?php } ?>
                                                <?php } ?>
                                                
                                            </select>
                                        </div>
                                        <div class="datos_insumos_2" style="width:452px; float:left; padding:1% 0;"></div>
                                    </div>
                                    <?php } ?>
                                    
                                    <?php if($lamina1_trilaminado>0 or $lamina2_trilaminado>0 or $lamina3_trilaminado>0){ ?>
                                    <div class="float_left" style="width:800px;">
                                        <div style="width:146px; height:20px; padding:1% 0;" class="float_left texto_izq">Adhesivo Trilaminado (Kg)</div>
                                        <div style="width:200px; height:0px; padding:1% 0;" class="float_left texto_cen">
                                                    
                                            <!-- SELECCIONAR -->
                                            <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
                                            <script>
                                            var jcmbIns3 = jQuery.noConflict();
                                            jcmbIns3(document).ready(function(){
												
												jcmbIns3("#progressbar").removeClass("ocultar");
												var insumo = jcmbIns3("select#insumo3 option:selected").val();
												var grm2total = <?php echo $articulo_datos["grm2_articulo"]; ?>;
												var anchofinal = <?php echo $dtart_anchofinal; ?>;
												var nrobandas = <?php echo $dtart_nrobandas; ?>;
												var metrototal = <?php echo $mtrprod_trilaminado; ?>;
												var grm2 = <?php echo $lamina3_trilaminado_grm2; ?>;
												jcmbIns3.post("insumos-costos.php", {insumo: insumo, grm2total: grm2total, anchofinal: anchofinal, nrobandas: nrobandas, metrototal: metrototal, grm2: grm2},
													function(data){
														jcmbIns3("#progressbar").addClass("ocultar");
														jcmbIns3('.datos_insumos_3').html(data);
													});
												
                                                jcmbIns3("#insumo3").change(function() {
                                                    jcmbIns3("#progressbar").removeClass("ocultar");
                                                    var insumo = jcmbIns3("select#insumo3 option:selected").val();
                                                    var grm2total = <?php echo $articulo_datos["grm2_articulo"]; ?>;
                                                    var anchofinal = <?php echo $dtart_anchofinal; ?>;
                                                    var nrobandas = <?php echo $dtart_nrobandas; ?>;
                                                    var metrototal = <?php echo $mtrprod_trilaminado; ?>;
                                                    var grm2 = <?php echo $lamina3_trilaminado_grm2; ?>;
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
                                                <?php while($fila_insumo=mysql_fetch_array($rst_insAdhTri)){
                                                    $insumo_id=$fila_insumo["id_articulo"];
                                                    $insumo_nombre=$fila_insumo["nombre_articulo"];
                                                ?>
                                                    <?php if($cproduccion_insumo_trilaminado==$insumo_id){ ?>
                                                    <option selected value="<?php echo $insumo_id; ?>"><?php echo $insumo_nombre; ?></option>
                                                    <?php }else{ ?>
                                                    <option value="<?php echo $insumo_id; ?>"><?php echo $insumo_nombre; ?></option>
                                                    <?php } ?>
                                                <?php } ?>
                                                
                                            </select>
                                        </div>
                                        <div class="datos_insumos_3" style="width:452px; float:left; padding:1% 0;"></div>
                                    </div>
                                    <?php } ?>
                                    
                                    <?php if($lamina1_impresion>0 or $lamina2_impresion>0 or $lamina3_impresion>0){ ?>
                                    <div class="float_left" style="width:800px;">
                                        <div style="width:146px; height:20px; padding:1% 0;" class="float_left texto_izq">Cushion (cm2)</div>
                                        
                                        <!-- SELECCIONAR -->
                                        <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
                                        <script>
                                        var jcmbIns4 = jQuery.noConflict();
                                        jcmbIns4(document).ready(function(){
											
											jcmbIns4("#progressbar").removeClass("ocultar");
											var insumo = jcmbIns4("select#insumo4 option:selected").val();		
											var anchofinal = <?php echo $dtart_anchofinal; ?>;
											var nrobandas = <?php echo $dtart_nrobandas; ?>;
											var nrocolores = <?php echo $dtart_nrocolores; ?>;
											var repeticion = <?php echo $dtart_repeticion; ?>;
											var frecuencia = <?php echo $dtart_frecuencia; ?>;
											var tipo = "cushion";
											jcmbIns4.post("insumos-costos.php", {insumo: insumo, anchofinal: anchofinal, nrobandas: nrobandas, nrocolores: nrocolores, repeticion: repeticion, frecuencia: frecuencia, tipo: tipo}, 
												function(data){
													jcmbIns4("#progressbar").addClass("ocultar");
													jcmbIns4('.datos_insumos_4').html(data);
												});
											
                                            jcmbIns4("#insumo4").change(function() {
                                                jcmbIns4("#progressbar").removeClass("ocultar");
                                                var insumo = jcmbIns4("select#insumo4 option:selected").val();		
                                                var anchofinal = <?php echo $dtart_anchofinal; ?>;
                                                var nrobandas = <?php echo $dtart_nrobandas; ?>;
                                                var nrocolores = <?php echo $dtart_nrocolores; ?>;
                                                var repeticion = <?php echo $dtart_repeticion; ?>;
                                                var frecuencia = <?php echo $dtart_frecuencia; ?>;
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
                                                <?php while($fila_insumo=mysql_fetch_array($rst_insCush)){
                                                    $insumo_id=$fila_insumo["id_articulo"];
                                                    $insumo_nombre=$fila_insumo["nombre_articulo"];
                                                ?>
                                                    <?php if($cproduccion_insumo_cushion==$insumo_id){ ?>
                                                    <option selected value="<?php echo $insumo_id; ?>"><?php echo $insumo_nombre; ?></option>
                                                    <?php }else{ ?>
                                                    <option value="<?php echo $insumo_id; ?>"><?php echo $insumo_nombre; ?></option>
                                                    <?php } ?>
                                                <?php } ?>
                                                
                                            </select>
                                        </div>
                                        <div class="datos_insumos_4" style="width:452px; float:left; padding:1% 0;"></div>
                                    </div>
                                    <?php } ?>
                                    
                                    <?php if($lamina1_impresion>0 or $lamina2_impresion>0 or $lamina3_impresion>0){ ?>
                                    <div class="float_left" style="width:800px;">
                                        <div style="width:146px; height:20px; padding:1% 0;" class="float_left texto_izq">Clises (cm2)</div>
                                        
                                        <!-- SELECCIONAR -->
                                        <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
                                        <script>
                                        var jcmbIns5 = jQuery.noConflict();
                                        jcmbIns5(document).ready(function(){
											
											jcmbIns5("#progressbar").removeClass("ocultar");
											var insumo = jcmbIns5("select#insumo5 option:selected").val();
											var anchofinal = <?php echo $dtart_anchofinal; ?>;
											var nrobandas = <?php echo $dtart_nrobandas; ?>;
											var nrocolores = <?php echo $dtart_nrocolores; ?>;
											var repeticion = <?php echo $dtart_repeticion; ?>;
											var frecuencia = <?php echo $dtart_frecuencia; ?>;
											var tipo = "clises";
											jcmbIns5.post("insumos-costos.php", {insumo: insumo, anchofinal: anchofinal, nrobandas: nrobandas, nrocolores: nrocolores, repeticion: repeticion, frecuencia: frecuencia, tipo: tipo}, 
												function(data){
													jcmbIns5("#progressbar").addClass("ocultar");
													jcmbIns5('.datos_insumos_5').html(data);
												});
											
                                            jcmbIns5("#insumo5").change(function() {
                                                jcmbIns5("#progressbar").removeClass("ocultar");
                                                var insumo = jcmbIns5("select#insumo5 option:selected").val();
                                                var anchofinal = <?php echo $dtart_anchofinal; ?>;
                                                var nrobandas = <?php echo $dtart_nrobandas; ?>;
                                                var nrocolores = <?php echo $dtart_nrocolores; ?>;
                                                var repeticion = <?php echo $dtart_repeticion; ?>;
                                                var frecuencia = <?php echo $dtart_frecuencia; ?>;
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
                                                <?php while($fila_insumo=mysql_fetch_array($rst_insClis)){
                                                    $insumo_id=$fila_insumo["id_articulo"];
                                                    $insumo_nombre=$fila_insumo["nombre_articulo"];
                                                ?>
                                                    <?php if($cproduccion_insumo_clises==$insumo_id){ ?>
                                                    <option selected value="<?php echo $insumo_id; ?>"><?php echo $insumo_nombre; ?></option>
                                                    <?php }else{ ?>
                                                    <option value="<?php echo $insumo_id; ?>"><?php echo $insumo_nombre; ?></option>
                                                    <?php } ?>
                                                <?php } ?>
                                                
                                            </select>
                                        </div>
                                        <div class="datos_insumos_5" style="width:452px; float:left; padding:1% 0;"></div>
                                    </div>
                                    <?php } ?>
                                
                            </div>
                        
                        </div>
                        
                    	<fieldset>
                        	<input name="dtecnicos_id" type="hidden" id="dtecnicos_id" value="<?php echo $id_registro; ?>">
                            <input name="dtp_btnenviar" type="submit" id="dtp_btnenviar" value="Guardar datos">
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