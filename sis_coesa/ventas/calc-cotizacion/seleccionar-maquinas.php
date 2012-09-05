<?php
session_start();
require_once("../../../connect/conexion.php");
require_once("../../../connect/function.php");
require_once("../../../connect/sesion/verificar_sesion.php");

//VARIABLES
$cliente=$_POST["dtecnicos_cliente"];
$articulo=$_POST["dtecnicos_articulo"];
$precio=$_POST["dtecnicos_precio"];
$cant_colores=$_POST["dtecnicos_numcolores"];
$unidad_medida=$_POST["dtecnicos_unidadmedida"];
$repeticion=$_POST["dtecnicos_repeticion"];
$ancho_final=$_POST["dtecnicos_anchofinal"];
$nro_bandas=$_POST["dtecnicos_numbandas"];
$cantidad=$_POST["dtecnicos_cantrq"];
$tolerancia=$_POST["dtecnicos_tolerancia"];

//TIPOS DE INSUMOS
$rst_insTinta=mysql_query("SELECT * FROM syCoesa_articulo WHERE id_tipo_articulo=2 AND mostrar_articulo=1 ORDER BY precio_articulo DESC;", $conexion);
$fila_insTinta=mysql_fetch_array($rst_insTinta);
$rst_insAdhBi=mysql_query("SELECT * FROM syCoesa_articulo WHERE id_tipo_articulo=4 AND mostrar_articulo=1 ORDER BY nombre_articulo ASC;", $conexion);
$rst_insAdhTri=mysql_query("SELECT * FROM syCoesa_articulo WHERE id_tipo_articulo=4 AND mostrar_articulo=1 ORDER BY nombre_articulo ASC;", $conexion);
$rst_insCush=mysql_query("SELECT * FROM syCoesa_articulo WHERE id_tipo_articulo=8 AND mostrar_articulo=1 ORDER BY nombre_articulo ASC;", $conexion);
$rst_insClis=mysql_query("SELECT * FROM syCoesa_articulo WHERE id_tipo_articulo=11 AND mostrar_articulo=1 ORDER BY nombre_articulo ASC;", $conexion);

//PROCESOS SELECCIONADOS
$proc_extrusion=$_POST["extrusion1"].$_POST["extrusion2"].$_POST["extrusion3"];
$proc_impresion=$_POST["impresion1"].$_POST["impresion2"].$_POST["impresion3"];
$proc_bilaminado=$_POST["bilaminado1"].$_POST["bilaminado2"].$_POST["bilaminado3"];
$proc_trilaminado=$_POST["trilaminado1"].$_POST["trilaminado2"].$_POST["trilaminado3"];
$proc_rebobinado=$_POST["rebobinado1"].$_POST["rebobinado2"].$_POST["rebobinado3"];
$proc_habilitado=$_POST["habilitado1"].$_POST["habilitado2"].$_POST["habilitado3"];
$proc_cortefinal=$_POST["cortefinal1"].$_POST["cortefinal2"].$_POST["cortefinal3"];
$proc_sellado=$_POST["sellado1"].$_POST["sellado2"].$_POST["sellado3"];

//GRM2 TOTAL
if($_POST["dt_articulo1"]<>""){ $lamina1=seleccionTabla($_POST["dt_articulo1"], "id_articulo", "syCoesa_articulo", $conexion); };
if($_POST["dt_articulo2"]<>""){ $lamina2=seleccionTabla($_POST["dt_articulo2"], "id_articulo", "syCoesa_articulo", $conexion); };
if($_POST["dt_articulo3"]<>""){ $lamina3=seleccionTabla($_POST["dt_articulo3"], "id_articulo", "syCoesa_articulo", $conexion); };

$grm2_producto=$_POST["dtecnicos_grm2"];

$lamina_grm2=$lamina1["grm2_articulo"] + $lamina2["grm2_articulo"] + $lamina3["grm2_articulo"];

if($_POST["impresion1"]<>""){ $tintaseca_lamina=$_POST["grm2_tintaseca_1"]; }
if($_POST["bilaminado2"]<>""){ $bilaminado_lamina=$_POST["bilaminado_proceso_2"]; }
if($_POST["trilaminado3"]<>""){ $trilaminado_lamina=$_POST["trilaminado_proceso_3"]; }

$grm2_total=$grm2_producto + $lamina_grm2 + $tintaseca_lamina + $bilaminado_lamina + $trilaminado_lamina;

//CANTIDAD REQUERIDA
if($unidad_medida==3){
	$cantidad_requerida=($cantidad * (1 + ($tolerancia/100)));
	$TotalFactorConvMillar=($ancho_final * $repeticion * $grm2_total) / 1000000;
	$cantidad_requerida=$cantidad_requerida * $TotalFactorConvMillar;
}else{
	$cantidad_requerida=($cantidad * (1 + ($tolerancia/100)));
}

//METROS A PRODUCIR
$mtrprod=round(($cantidad_requerida / ($ancho_final * $nro_bandas) / $grm2_total) * 1000000);

if($proc_cortefinal>0){ //CORTE FINAL
	$procprod_merma_cortefinal=seleccionTabla("'corte-final'", "url", "syCoesa_mantenimiento_procesos_productivos", $conexion);
	$mtrprod_cortefinal=round($mtrprod + ($mtrprod * ($procprod_merma_cortefinal["merma_proceso"] / 100)));
}else{ $mtrprod_cortefinal=0; $procprod_merma_cortefinal=0; }

if($proc_sellado>0){ //SELLADO
	$procprod_merma_sellado=seleccionTabla("'sellado'", "url", "syCoesa_mantenimiento_procesos_productivos", $conexion);
	$mtrprod_sellado=round($mtrprod + ($mtrprod * ($procprod_merma_sellado["merma_proceso"] / 100)));
	$mtrprod_sellado_total=round($mtrprod + ($mtrprod * ($procprod_merma_sellado["merma_proceso"] / 100)));
	$proc_sellado_merma=round($mtrprod * ($procprod_merma_sellado["merma_proceso"] / 100));
	if($impresion_unidadmedida["unidad_medida"]==3){
		$mtrprod_sellado_total=(($mtrprod_sellado + $proc_sellado_merma) * $impresion_nrobandas) / ($impresion_repeticion / 1000);
	}
}else{ $mtrprod_sellado=0; $procprod_merma_sellado=0; }

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

if($proc_extrusion<>""){ //EXTRUSION
	$procprod_merma=seleccionTabla("'extrusion'", "url", "syCoesa_mantenimiento_procesos_productivos", $conexion);
	
	if($_POST["extrusion1"]>0){
		$lamina1=seleccionTabla($_POST["dt_articulo1"], "id_articulo", "syCoesa_articulo", $conexion);
		if($_POST["impresion1"]>0){
			$totalKg=(($mtrprod_impresion * $lamina1["ancho_articulo"] * $lamina1["grm2_articulo"]) / 1000000) + $procprod_merma["merma_proceso"];
		}elseif($_POST["cortefinal1"]>0){
			$totalKg=(($mtrprod_cortefinal * $lamina1["ancho_articulo"] * $lamina1["grm2_articulo"]) / 1000000) + $procprod_merma["merma_proceso"];
		}
	}elseif($_POST["extrusion2"]>0){
		$lamina2=seleccionTabla($_POST["dt_articulo2"], "id_articulo", "syCoesa_articulo", $conexion);
		if($_POST["bilaminado2"]>0){
			$totalKg=(($mtrprod_bilaminado * $lamina2["ancho_articulo"] * $lamina2["grm2_articulo"]) / 1000000) + $procprod_merma["merma_proceso"];
		}elseif($_POST["cortefinal2"]>0){
			$totalKg=(($mtrprod_cortefinal * $lamina2["ancho_articulo"] * $lamina2["grm2_articulo"]) / 1000000) + $procprod_merma["merma_proceso"];
		}
	}elseif($_POST["extrusion3"]>0){
		$lamina3=seleccionTabla($_POST["dt_articulo3"], "id_articulo", "syCoesa_articulo", $conexion);
		if($_POST["trilaminado3"]>0){
			$totalKg=(($mtrprod_trilaminado * $lamina3["ancho_articulo"] * $lamina3["grm2_articulo"]) / 1000000) + $procprod_merma["merma_proceso"];
		}elseif($_POST["cortefinal3"]>0){
			$totalKg=(($mtrprod_cortefinal * $lamina3["ancho_articulo"] * $lamina3["grm2_articulo"]) / 1000000) + $procprod_merma["merma_proceso"];
		}
	}

}else{ $totalKg=0; }

?>

<fieldset class="alto50 w180">
    <label for="dtecnicos_grm2_total">Gr / m2:</label>
    <input name="dtecnicos_grm2_total" type="text" id="dtecnicos_grm2_total" class="w130" value="<?php echo number_format($grm2_total,1); ?>">
</fieldset>

<fieldset class="alto50 w180">
    <label for="dtecnicos_cantrequerida">Cantidad requerida:</label>
    <input name="dtecnicos_cantrequerida" type="text" id="dtecnicos_cantrequerida" class="w130" value="<?php echo round($cantidad_requerida); ?>">
</fieldset>

<fieldset class="alto50 w180">
    <label for="dtecnicos_metrosproducir">Metros a producir:</label>
    <input name="dtecnicos_metrosproducir" type="text" id="dtecnicos_metrosproducir" class="w130" value="<?php echo round($mtrprod); ?>">
</fieldset>

<div class="float_left an100"><h2>Máquinas</h2></div>

<table width="100%" border="1" cellspacing="5" cellpadding="5">
        <thead>
            <tr>
                <td width="8.3%" class="texto_cen texto_10 fondo_c1 texto_bold">Procesos</td>
                <td width="13%" class="texto_cen texto_10 fondo_c1 texto_bold">Maquinas</td>
                <td width="8%" class="texto_cen texto_10 fondo_c1 texto_bold">Metros</td>
                <td width="8%" class="texto_cen texto_10 fondo_c1 texto_bold">Velocidad <br>Mts/Min</td>
                <td width="8.3%" class="texto_cen texto_10 fondo_c1 texto_bold">Prepar. <br>(HH:mm)</td>
                <td width="8.3%" class="texto_cen texto_10 fondo_c1 texto_bold">Regulac. <br>(HH:mm)</td>
                <td width="8%" class="texto_cen texto_10 fondo_c1 texto_bold">Tiempo <br>(HH:mm)</td>
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
                $rst_maq=mysql_query("SELECT * FROM syCoesa_mantenimiento_maquinas_datos WHERE mostrar_maquina=1 ORDER BY id_maquina ASC", $conexion);
                while($fila_maq=mysql_fetch_array($rst_maq)){
    
                    $maq_procesos=$fila_maq["procesos_productivos_maquina"];
                    $maquina=seleccionTabla($fila_maq["id_maquina"],"id_maquina", "syCoesa_mantenimiento_maquinas", $conexion);
                
                    if(ereg(3, $maq_procesos)){ ?>
                    
                    <option value="<?php echo $maquina["id_maquina"]; ?>"><?php echo $maquina["nombre_maquina"]; ?></option>
                
                <?php }} ?>
                
            </select>
    </div>
    <div class="datos_maquina_1">
        <div style="width:8%; height:20px; padding:1% 0;" class="float_left texto_cen"></div>
        <div style="width:8%; height:20px; padding:1% 0;" class="float_left texto_cen"></div>
        <div style="width:8.3%; height:20px; padding:1% 0;" class="float_left texto_cen"></div>
        <div style="width:8.3%; height:20px; padding:1% 0;" class="float_left texto_cen"></div>
        <div style="width:8%; height:20px; padding:1% 0;" class="float_left texto_cen"></div>
        <div style="width:8%; height:20px; padding:1% 0;" class="float_left texto_cen"></div>
        <div style="width:8%; height:20px; padding:1% 0;" class="float_left texto_cen"></div>
        <div style="width:8%; height:20px; padding:1% 0;" class="float_left texto_cen"></div>
        <div style="width:8%; height:20px; padding:1% 0;" class="float_left texto_cen"></div>
        <div style="width:6.1%; height:20px; padding:1% 0;" class="float_left texto_cen"></div>
    </div>
<?php } //FIN EXTRUSION ?>

<?php if($proc_impresion>0){ ?>    
  <div style="width:8.3%; height:20px; padding:1% 0;" class="float_left texto_izq">Impresión</div>
<div style="width:13%; height:20px; padding:1% 0;" class="float_left texto_cen">
            
            <!-- SELECCIONAR -->
            <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
            <script>
            var jcmbPro2 = jQuery.noConflict();
            jcmbPro2(document).ready(function(){
                jcmbPro2("#maquina_2").change(function() {
                	jcmbPro2("#progressbar").removeClass("ocultar");
                    //VALORES
					var maq = jcmbPro2("select#maquina_2 option:selected").val();
					var mtrprod = jcmbPro2("#dtecnicos_metrosproducir").val();
					var cantcolores = jcmbPro2("select#dtecnicos_numcolores option:selected").val();
					var impresion = <?php echo $proc_impresion; ?>;
					
                    jcmbPro2.post("consulta-maquinas-datos.php", {colores: cantcolores, maquina: maq, metroproducir: <?php echo $mtrprod_impresion; ?>, impresion: impresion},
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
                
                    if(ereg(4, $maq_procesos)){ ?>
                    
                    <option value="<?php echo $maquina["id_maquina"]; ?>"><?php echo $maquina["nombre_maquina"]; ?></option>
                
                <?php }} ?>
                
            </select>
    </div>
    <div class="datos_maquina_2">
        <div style="width:8%; height:20px; padding:1% 0;" class="float_left texto_cen"></div>
        <div style="width:8%; height:20px; padding:1% 0;" class="float_left texto_cen"></div>
        <div style="width:8.3%; height:20px; padding:1% 0;" class="float_left texto_cen"></div>
        <div style="width:8.3%; height:20px; padding:1% 0;" class="float_left texto_cen"></div>
        <div style="width:8%; height:20px; padding:1% 0;" class="float_left texto_cen"></div>
        <div style="width:8%; height:20px; padding:1% 0;" class="float_left texto_cen"></div>
        <div style="width:8%; height:20px; padding:1% 0;" class="float_left texto_cen"></div>
        <div style="width:8%; height:20px; padding:1% 0;" class="float_left texto_cen"></div>
        <div style="width:8%; height:20px; padding:1% 0;" class="float_left texto_cen"></div>
        <div style="width:6.1%; height:20px; padding:1% 0;" class="float_left texto_cen"></div>
    </div>
<?php } ?>

<?php if($proc_rebobinado>0){ ?>
  <div style="width:8.3%; height:20px; padding:1% 0;" class="float_left texto_izq">Rebobinado</div>
<div style="width:13%; height:20px; padding:1% 0;" class="float_left texto_cen">
            
            <!-- SELECCIONAR -->
            <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
            <script>
            var jcmbPro7 = jQuery.noConflict();
            jcmbPro7(document).ready(function(){
                jcmbPro7("#maquina_7").change(function() {
                	jcmbPro7("#progressbar").removeClass("ocultar");
                    //VALORES
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
                $rst_maq=mysql_query("SELECT * FROM syCoesa_mantenimiento_maquinas_datos WHERE mostrar_maquina=1 ORDER BY id_maquina ASC", $conexion);
                while($fila_maq=mysql_fetch_array($rst_maq)){
    
                    $maq_procesos=$fila_maq["procesos_productivos_maquina"];
                    $maquina=seleccionTabla($fila_maq["id_maquina"],"id_maquina", "syCoesa_mantenimiento_maquinas", $conexion);
                
                    if(ereg(9, $maq_procesos)){ ?>
                    
                    <option value="<?php echo $maquina["id_maquina"]; ?>"><?php echo $maquina["nombre_maquina"]; ?></option>
                
                <?php }} ?>
                
            </select>
    </div>
    <div class="datos_maquina_7">
        <div style="width:8%; height:20px; padding:1% 0;" class="float_left texto_cen"></div>
        <div style="width:8%; height:20px; padding:1% 0;" class="float_left texto_cen"></div>
        <div style="width:8.3%; height:20px; padding:1% 0;" class="float_left texto_cen"></div>
        <div style="width:8.3%; height:20px; padding:1% 0;" class="float_left texto_cen"></div>
        <div style="width:8%; height:20px; padding:1% 0;" class="float_left texto_cen"></div>
        <div style="width:8%; height:20px; padding:1% 0;" class="float_left texto_cen"></div>
        <div style="width:8%; height:20px; padding:1% 0;" class="float_left texto_cen"></div>
        <div style="width:8%; height:20px; padding:1% 0;" class="float_left texto_cen"></div>
        <div style="width:8%; height:20px; padding:1% 0;" class="float_left texto_cen"></div>
        <div style="width:6.1%; height:20px; padding:1% 0;" class="float_left texto_cen"></div>
    </div>
<?php } ?>

<?php if($proc_bilaminado>0){ ?>
  <div style="width:8.3%; height:20px; padding:1% 0;" class="float_left texto_izq">Bilaminado</div>
<div style="width:13%; height:20px; padding:1% 0;" class="float_left texto_cen">
            
            <!-- SELECCIONAR -->
            <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
            <script>
            var jcmbPro3 = jQuery.noConflict();
            jcmbPro3(document).ready(function(){
                jcmbPro3("#maquina_3").change(function() {
                	jcmbPro3("#progressbar").removeClass("ocultar");
                    //VALORES
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
                $rst_maq=mysql_query("SELECT * FROM syCoesa_mantenimiento_maquinas_datos WHERE mostrar_maquina=1 ORDER BY id_maquina ASC", $conexion);
                while($fila_maq=mysql_fetch_array($rst_maq)){
    
                    $maq_procesos=$fila_maq["procesos_productivos_maquina"];
                    $maquina=seleccionTabla($fila_maq["id_maquina"],"id_maquina", "syCoesa_mantenimiento_maquinas", $conexion);
                
                    if(ereg(5, $maq_procesos)){ ?>
                    
                    <option value="<?php echo $maquina["id_maquina"]; ?>"><?php echo $maquina["nombre_maquina"]; ?></option>
                
                <?php }} ?>
                
            </select>
    </div>
    <div class="datos_maquina_3">
        <div style="width:8%; height:20px; padding:1% 0;" class="float_left texto_cen"></div>
        <div style="width:8%; height:20px; padding:1% 0;" class="float_left texto_cen"></div>
        <div style="width:8.3%; height:20px; padding:1% 0;" class="float_left texto_cen"></div>
        <div style="width:8.3%; height:20px; padding:1% 0;" class="float_left texto_cen"></div>
        <div style="width:8%; height:20px; padding:1% 0;" class="float_left texto_cen"></div>
        <div style="width:8%; height:20px; padding:1% 0;" class="float_left texto_cen"></div>
        <div style="width:8%; height:20px; padding:1% 0;" class="float_left texto_cen"></div>
        <div style="width:8%; height:20px; padding:1% 0;" class="float_left texto_cen"></div>
        <div style="width:8%; height:20px; padding:1% 0;" class="float_left texto_cen"></div>
        <div style="width:6.1%; height:20px; padding:1% 0;" class="float_left texto_cen"></div>
    </div>
<?php } ?>

<?php if($proc_trilaminado>0){ ?>
  <div style="width:8.3%; height:20px; padding:1% 0;" class="float_left texto_izq">Trilaminado</div>
<div style="width:13%; height:20px; padding:1% 0;" class="float_left texto_cen">
            
            <!-- SELECCIONAR -->
            <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
            <script>
            var jcmbPro4 = jQuery.noConflict();
            jcmbPro4(document).ready(function(){
                jcmbPro4("#maquina_4").change(function() {
					jcmbPro4("#progressbar").removeClass("ocultar");                
                    //VALORES
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
                $rst_maq=mysql_query("SELECT * FROM syCoesa_mantenimiento_maquinas_datos WHERE mostrar_maquina=1 ORDER BY id_maquina ASC", $conexion);
                while($fila_maq=mysql_fetch_array($rst_maq)){
    
                    $maq_procesos=$fila_maq["procesos_productivos_maquina"];
                    $maquina=seleccionTabla($fila_maq["id_maquina"],"id_maquina", "syCoesa_mantenimiento_maquinas", $conexion);
                
                    if(ereg(6, $maq_procesos)){ ?>
                    
                    <option value="<?php echo $maquina["id_maquina"]; ?>"><?php echo $maquina["nombre_maquina"]; ?></option>
                
                <?php }} ?>
                
            </select>
    </div>
    <div class="datos_maquina_4">
        <div style="width:8%; height:20px; padding:1% 0;" class="float_left texto_cen"></div>
        <div style="width:8%; height:20px; padding:1% 0;" class="float_left texto_cen"></div>
        <div style="width:8.3%; height:20px; padding:1% 0;" class="float_left texto_cen"></div>
        <div style="width:8.3%; height:20px; padding:1% 0;" class="float_left texto_cen"></div>
        <div style="width:8%; height:20px; padding:1% 0;" class="float_left texto_cen"></div>
        <div style="width:8%; height:20px; padding:1% 0;" class="float_left texto_cen"></div>
        <div style="width:8%; height:20px; padding:1% 0;" class="float_left texto_cen"></div>
        <div style="width:8%; height:20px; padding:1% 0;" class="float_left texto_cen"></div>
        <div style="width:8%; height:20px; padding:1% 0;" class="float_left texto_cen"></div>
        <div style="width:6.1%; height:20px; padding:1% 0;" class="float_left texto_cen"></div>
    </div>
<?php } ?>

<?php if($proc_habilitado==1656548){ ?>
  <div style="width:8.3%; height:20px; padding:1% 0;" class="float_left texto_izq">Habilitado</div>
<div style="width:13%; height:20px; padding:1% 0;" class="float_left texto_cen">
            
            <!-- SELECCIONAR -->
            <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
            <script>
            var jcmbPro8 = jQuery.noConflict();
            jcmbPro8(document).ready(function(){
                jcmbPro8("#maquina_8").change(function() {
                	jcmbPro8("#progressbar").removeClass("ocultar");
                    //VALORES
					var maq = jcmbPro8("select#maquina_8 option:selected").val();
					var mtrprod = jcmbPro8("#dtecnicos_metrosproducir").val();
					
                    jcmbPro8.post("consulta-maquinas-datos.php", {maquina: maq},
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
                
                    if(ereg(10, $maq_procesos)){ ?>
                    
                    <option value="<?php echo $maquina["id_maquina"]; ?>"><?php echo $maquina["nombre_maquina"]; ?></option>
                
                <?php }} ?>
                
            </select>
    </div>
    <div class="datos_maquina_8">
        <div style="width:8%; height:20px; padding:1% 0;" class="float_left texto_cen"></div>
        <div style="width:8%; height:20px; padding:1% 0;" class="float_left texto_cen"></div>
        <div style="width:8.3%; height:20px; padding:1% 0;" class="float_left texto_cen"></div>
        <div style="width:8.3%; height:20px; padding:1% 0;" class="float_left texto_cen"></div>
        <div style="width:8%; height:20px; padding:1% 0;" class="float_left texto_cen"></div>
        <div style="width:8%; height:20px; padding:1% 0;" class="float_left texto_cen"></div>
        <div style="width:8%; height:20px; padding:1% 0;" class="float_left texto_cen"></div>
        <div style="width:8%; height:20px; padding:1% 0;" class="float_left texto_cen"></div>
        <div style="width:8%; height:20px; padding:1% 0;" class="float_left texto_cen"></div>
        <div style="width:6.1%; height:20px; padding:1% 0;" class="float_left texto_cen"></div>
    </div>
<?php } ?>

<?php if($proc_cortefinal>0){ ?>
  <div style="width:8.3%; height:20px; padding:1% 0;" class="float_left texto_izq">Corte</div>
<div style="width:13%; height:20px; padding:1% 0;" class="float_left texto_cen">
            
            <!-- SELECCIONAR -->
            <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
            <script>
            var jcmbPro5 = jQuery.noConflict();
            jcmbPro5(document).ready(function(){
                jcmbPro5("#maquina_5").change(function() {
                	jcmbPro5("#progressbar").removeClass("ocultar");
                    //VALORES
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
                $rst_maq=mysql_query("SELECT * FROM syCoesa_mantenimiento_maquinas_datos WHERE mostrar_maquina=1 ORDER BY id_maquina ASC", $conexion);
                while($fila_maq=mysql_fetch_array($rst_maq)){
    
                    $maq_procesos=$fila_maq["procesos_productivos_maquina"];
                    $maquina=seleccionTabla($fila_maq["id_maquina"],"id_maquina", "syCoesa_mantenimiento_maquinas", $conexion);
                
                    if(ereg(7, $maq_procesos)){ ?>
                    
                    <option value="<?php echo $maquina["id_maquina"]; ?>"><?php echo $maquina["nombre_maquina"]; ?></option>
                
                <?php }} ?>
                
            </select>
    </div>
    <div class="datos_maquina_5">
        <div style="width:8%; height:20px; padding:1% 0;" class="float_left texto_cen"></div>
        <div style="width:8%; height:20px; padding:1% 0;" class="float_left texto_cen"></div>
        <div style="width:8.3%; height:20px; padding:1% 0;" class="float_left texto_cen"></div>
        <div style="width:8.3%; height:20px; padding:1% 0;" class="float_left texto_cen"></div>
        <div style="width:8%; height:20px; padding:1% 0;" class="float_left texto_cen"></div>
        <div style="width:8%; height:20px; padding:1% 0;" class="float_left texto_cen"></div>
        <div style="width:8%; height:20px; padding:1% 0;" class="float_left texto_cen"></div>
        <div style="width:8%; height:20px; padding:1% 0;" class="float_left texto_cen"></div>
        <div style="width:8%; height:20px; padding:1% 0;" class="float_left texto_cen"></div>
        <div style="width:6.1%; height:20px; padding:1% 0;" class="float_left texto_cen"></div>
    </div>
<?php } ?>

<?php if($proc_sellado>0){ ?>
  	<div style="width:8.3%; height:20px; padding:1% 0;" class="float_left texto_izq">Sellado</div>
	<div style="width:13%; height:20px; padding:1% 0;" class="float_left texto_cen">
            
            <!-- SELECCIONAR -->
            <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
            <script>
            var jcmbPro6 = jQuery.noConflict();
            jcmbPro6(document).ready(function(){
                jcmbPro6("#maquina_6").change(function() {
                	jcmbPro6("#progressbar").removeClass("ocultar");
                    //VALORES
					var maq = jcmbPro6("select#maquina_6 option:selected").val();
					var unidadmedida = jcmbPro6("select#dtecnicos_unidadmedida option:selected").val();
					var nrobandas = jcmbPro6("select#dtecnicos_numbandas option:selected").val();
					var repeticion = jcmbPro6("#dtecnicos_repeticion").val();
					var mtrprod = jcmbPro6("#dtecnicos_metrosproducir").val();
					var sellado = <?php echo $proc_sellado; ?>;
										
                    jcmbPro6.post("consulta-maquinas-datos.php", {nrobandas: nrobandas, repeticion: repeticion, unidadmedida: unidadmedida, maquina: maq, metroproducir: <?php echo $mtrprod_sellado_total; ?>, sellado: sellado},
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
                
                    if(ereg(8, $maq_procesos)){ ?>
                    
                    <option value="<?php echo $maquina["id_maquina"]; ?>"><?php echo $maquina["nombre_maquina"]; ?></option>
                
                <?php }} ?>
                
            </select>
    </div>
    <div class="datos_maquina_6">
        <div style="width:8%; height:20px; padding:1% 0;" class="float_left texto_cen"></div>
        <div style="width:8%; height:20px; padding:1% 0;" class="float_left texto_cen"></div>
        <div style="width:8.3%; height:20px; padding:1% 0;" class="float_left texto_cen"></div>
        <div style="width:8.3%; height:20px; padding:1% 0;" class="float_left texto_cen"></div>
        <div style="width:8%; height:20px; padding:1% 0;" class="float_left texto_cen"></div>
        <div style="width:8%; height:20px; padding:1% 0;" class="float_left texto_cen"></div>
        <div style="width:8%; height:20px; padding:1% 0;" class="float_left texto_cen"></div>
        <div style="width:8%; height:20px; padding:1% 0;" class="float_left texto_cen"></div>
        <div style="width:8%; height:20px; padding:1% 0;" class="float_left texto_cen"></div>
        <div style="width:6.1%; height:20px; padding:1% 0;" class="float_left texto_cen"></div>
    </div>
<?php } ?>

</div>
<hr>
<h2>Insumos</h2>
<table width="800px" border="1" cellspacing="5" cellpadding="5">
    <thead>
        <tr>
        	<td width="150" class="texto_cen texto_10 fondo_c1 texto_bold">Tipo</td>
            <td width="200" class="texto_cen texto_10 fondo_c1 texto_bold">Insumos</td>
            <td width="150" class="texto_cen texto_10 fondo_c1 texto_bold">Costo</td>
            <td width="150" class="texto_cen texto_10 fondo_c1 texto_bold">Cant. Requerida</td>
            <td width="150" class="texto_cen texto_10 fondo_c1 texto_bold">Total</td>
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
		var grm2total = jcmbIns1("#dtecnicos_grm2_total").val();
		var anchofinal = jcmbIns1("#dtecnicos_anchofinal").val();
		var nrobandas = jcmbIns1("#dtecnicos_numbandas").val();
		var metrototal = <?php echo $mtrprod_impresion; ?>;
		var grm2 = <?php echo $tintaseca_lamina; ?>;
		var tipo = "tinta";
		jcmbIns1.post("insumos-costos.php", {grm2total: grm2total, anchofinal: anchofinal, nrobandas: nrobandas, metrototal: metrototal, grm2: grm2, tipo: tipo}, 
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
            jcmbIns2("#insumo2").change(function() {
                jcmbIns2("#progressbar").removeClass("ocultar");
                var insumo = jcmbIns2("select#insumo2 option:selected").val();
				var grm2total = jcmbIns2("#dtecnicos_grm2_total").val();
				var anchofinal = jcmbIns2("#dtecnicos_anchofinal").val();
				var nrobandas = jcmbIns2("#dtecnicos_numbandas").val();
				var metrototal = <?php echo $mtrprod_bilaminado; ?>;
				var grm2 = <?php echo $bilaminado_lamina; ?>;
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
                <option value="<?php echo $insumo_id; ?>"><?php echo $insumo_nombre; ?></option>
            <?php } ?>
            
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
            jcmbIns3("#insumo3").change(function() {
                jcmbIns3("#progressbar").removeClass("ocultar");
                var insumo = jcmbIns3("select#insumo3 option:selected").val();
				var grm2total = jcmbIns3("#dtecnicos_grm2_total").val();
				var anchofinal = jcmbIns3("#dtecnicos_anchofinal").val();
				var nrobandas = jcmbIns3("#dtecnicos_numbandas").val();
				var metrototal = <?php echo $mtrprod_trilaminado; ?>;
				var grm2 = <?php echo $trilaminado_lamina; ?>;
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
                <option value="<?php echo $insumo_id; ?>"><?php echo $insumo_nombre; ?></option>
            <?php } ?>
            
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
            <?php while($fila_insumo=mysql_fetch_array($rst_insCush)){
                $insumo_id=$fila_insumo["id_articulo"];
                $insumo_nombre=$fila_insumo["nombre_articulo"];
            ?>
                <option value="<?php echo $insumo_id; ?>"><?php echo $insumo_nombre; ?></option>
            <?php } ?>
            
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
        jcmbIns5("#insumo5").change(function() {
            jcmbIns5("#progressbar").removeClass("ocultar");
			var insumo = jcmbIns5("select#insumo5 option:selected").val();
            var anchofinal = jcmbIns5("#dtecnicos_anchofinal").val();
            var nrobandas = jcmbIns5("#dtecnicos_numbandas").val();
            var nrocolores = jcmbIns5("#dtecnicos_numcolores").val();
            var repeticion = jcmbIns5("#dtecnicos_repeticion").val();
            var frecuencia = jcmbIns5("#dtecnicos_frecuencia").val();
			var cantidad = jcmbIns5("#dtecnicos_cantrequerida").val();
            var tipo = "clises";
            jcmbIns5.post("insumos-costos.php", {cantidad: cantidad, insumo: insumo, anchofinal: anchofinal, nrobandas: nrobandas, nrocolores: nrocolores, repeticion: repeticion, frecuencia: frecuencia, tipo: tipo}, 
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
                <option value="<?php echo $insumo_id; ?>"><?php echo $insumo_nombre; ?></option>
            <?php } ?>
            
        </select>
    </div>
    <div class="datos_insumos_5" style="width:452px; float:left; padding:1% 0;"></div>
</div>
<?php } ?>