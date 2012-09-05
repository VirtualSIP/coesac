<?php
require_once("../../../connect/conexion.php");
require_once("../../../connect/function.php");

//VARIABLES
$did_ancho_final=$_POST["anchofinal"];
$did_nro_bandas=$_POST["nrobandas"];

//SELECCIONAR REFILE DE MAQUINAS
$rst_maq=mysql_query("SELECT * FROM syCoesa_mantenimiento_maquinas_datos ORDER BY refile_maquina DESC;", $conexion);
$fila_maq=mysql_fetch_array($rst_maq);
$maq_refile=$fila_maq["refile_maquina"];

//FILTRO
$formula_filtro_lamina=$did_ancho_final * $did_nro_bandas + $maq_refile;
$formula_filtro_manga=$did_ancho_final * $did_nro_bandas;

//LAMINAS
$rst_lamina1=mysql_query("SELECT * FROM syCoesa_articulo WHERE (id_tipo_articulo=3 AND mostrar_articulo=1) OR (id_tipo_articulo=6 AND mostrar_articulo=1) OR (id_tipo_articulo=13 AND mostrar_articulo=1) ORDER BY nombre_articulo ASC;", $conexion); //LAMINAS
$rst_lamina2=mysql_query("SELECT * FROM syCoesa_articulo WHERE (id_tipo_articulo=3 AND mostrar_articulo=1) OR (id_tipo_articulo=6 AND mostrar_articulo=1) OR (id_tipo_articulo=13 AND mostrar_articulo=1) ORDER BY nombre_articulo ASC;", $conexion); //LAMINAS
$rst_lamina3=mysql_query("SELECT * FROM syCoesa_articulo WHERE (id_tipo_articulo=3 AND mostrar_articulo=1) OR (id_tipo_articulo=6 AND mostrar_articulo=1) OR (id_tipo_articulo=13 AND mostrar_articulo=1) ORDER BY nombre_articulo ASC;", $conexion); //LAMINAS
?> 

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

<div class="w235 float_left border_der margin_r10">
	
    <h2>Monocapa</h2><br>
                            
    <fieldset class="alto50 w245">
      <label for="dt_articulo1">Laminas:</label>
      <select name="dt_articulo1" id="dt_articulo1" class="cmbSlc">
        <option value>[ Seleccionar opcion ]</option>
        <?php while($fila_lamina1=mysql_fetch_array($rst_lamina1)){
                //VARIABLES
                $lamina1_id=$fila_lamina1["id_articulo"];
                $lamina1_nombre=$fila_lamina1["nombre_articulo"];
                $lamina1_ancho=$fila_lamina1["ancho_articulo"];
				$lamina1_tipo=$fila_lamina1["id_tipo_articulo"];
				
				if($lamina1_tipo<>13){
					if($lamina1_ancho>=$formula_filtro_lamina){?>
            <option value="<?php echo $lamina1_id; ?>"><?php echo $lamina1_nombre; ?></option>
        <?php }}elseif($lamina1_tipo==13){
				if($lamina1_ancho>=$formula_filtro_manga){?>
        	<option value="<?php echo $lamina1_id; ?>"><?php echo $lamina1_nombre; ?></option>	
        <?php }}} ?>
      </select>
    </fieldset>
    
    <fieldset class="w245">
        <label><input id="procesos_maquinas_3" class="procesos_maquinas" name="extrusion1" type="checkbox" value="1">&nbsp;Extrusión</label>
    </fieldset>
    
    <fieldset class="w245">
        <label><input id="procesos_maquinas_4" class="procesos_maquinas" name="impresion1" type="checkbox" value="1">&nbsp;Impresión</label>
    </fieldset>
    <fieldset class="w245">
        <label for="grm2_tintaseca_1">GR / m2 (Tinta seca)</label>
        <input class="w140 texto_der" name="grm2_tintaseca_1" type="text" id="grm2_tintaseca_1" value="0">
    </fieldset>
    
    <fieldset class="w245">
        <label><input id="procesos_maquinas_9" class="procesos_maquinas" name="rebobinado1" type="checkbox" value="1">&nbsp;Rebobinado</label>
    </fieldset>
    
    <input id="procesos_maquinas_5" name="bilaminado1" type="hidden" value="0">
    
    <input id="procesos_maquinas_6" name="trilaminado1" type="hidden" value="0">
    
	<input name="habilitado1" type="hidden" value="0">
    
    <fieldset class="w245">
        <label><input id="procesos_maquinas_7" class="procesos_maquinas" name="cortefinal1" type="checkbox" value="1">&nbsp;Corte</label>
    </fieldset>
    
    <fieldset class="w245">
        <label><input id="procesos_maquinas_8" class="procesos_maquinas" name="sellado1" type="checkbox" value="1">&nbsp;Sellado</label>
    </fieldset>
    
</div><!-- FIN LAMINA 1 -->

<div class="w235 float_left border_der margin_r10">

	<h2>Bilaminado</h2><br>
	
    <fieldset class="alto50 w245">
      <label for="dt_articulo2">Laminas:</label>
      <select name="dt_articulo2" id="dt_articulo2" class="cmbSlc">
        <option value>[ Seleccionar opcion ]</option>
        <?php while($fila_lamina2=mysql_fetch_array($rst_lamina2)){
                //VARIABLES
                $lamina2_id=$fila_lamina2["id_articulo"];
                $lamina2_nombre=$fila_lamina2["nombre_articulo"];
                $lamina2_ancho=$fila_lamina2["ancho_articulo"];
				$lamina2_tipo=$fila_lamina1["id_tipo_articulo"];
				
				if($lamina2_tipo<>13){
					if($lamina2_ancho>=$formula_filtro_lamina){?>
            <option value="<?php echo $lamina2_id; ?>"><?php echo $lamina2_nombre; ?></option>
        <?php }}elseif($lamina2_tipo==13){
				if($lamina2_ancho>=$formula_filtro_manga){?>
        	<option value="<?php echo $lamina2_id; ?>"><?php echo $lamina2_nombre; ?></option>	
        <?php }}} ?>
      </select>
    </fieldset>
    
    <fieldset class="w245">
        <label><input id="procesos_maquinas_3" class="procesos_maquinas" name="extrusion2" type="checkbox" value="1">&nbsp;Extrusión</label>
    </fieldset>
    
    <fieldset class="w245">
        <label><input id="procesos_maquinas_5" class="procesos_maquinas" name="bilaminado2" type="checkbox" value="1">&nbsp;Bilaminado</label>
    </fieldset>
    <fieldset class="w245">
        <label for="bilaminado_proceso_2">GR / m2 (Adhesivo)</label>
        <input class="w140 texto_der" name="bilaminado_proceso_2" type="text" id="bilaminado_proceso_2" value="0">
    </fieldset>
    
    <input id="procesos_maquinas_6" name="trilaminado2" type="hidden" value="0">
    
    <input name="rebobinado2" type="hidden" value="0">
    
    <input name="habilitado2" type="hidden" value="0">
    
    <fieldset class="w245">
        <label><input id="procesos_maquinas_7" class="procesos_maquinas" name="cortefinal2" type="checkbox" value="1">&nbsp;Corte</label>
    </fieldset>
    
    <fieldset class="w245">
        <label><input id="procesos_maquinas_8" class="procesos_maquinas" name="sellado2" type="checkbox" value="1">&nbsp;Sellado</label>
    </fieldset>
    
</div><!-- FIN LAMINA 2 -->

<div class="w235 float_left border_der margin_r10">
	
    <h2>Trilaminado</h2><br>
    
    <fieldset class="alto50 w245">
      <label for="dt_articulo3">Laminas:</label>
      <select name="dt_articulo3" id="dt_articulo3" class="cmbSlc">
        <option value>[ Seleccionar opcion ]</option>
        <?php while($fila_lamina3=mysql_fetch_array($rst_lamina3)){
                //VARIABLES
                $lamina3_id=$fila_lamina3["id_articulo"];
                $lamina3_nombre=$fila_lamina3["nombre_articulo"];
                $lamina3_ancho=$fila_lamina3["ancho_articulo"];
				$lamina3_tipo=$fila_lamina1["id_tipo_articulo"];
				
				if($lamina3_tipo<>13){
					if($lamina3_ancho>=$formula_filtro_lamina){?>
            <option value="<?php echo $lamina3_id; ?>"><?php echo $lamina3_nombre; ?></option>
        <?php }}elseif($lamina3_tipo==13){
				if($lamina3_ancho>=$formula_filtro_manga){?>
        	<option value="<?php echo $lamina3_id; ?>"><?php echo $lamina3_nombre; ?></option>	
        <?php }}} ?>
        </select>
    </fieldset>
    
    <fieldset class="w245">
        <label><input id="procesos_maquinas_3" class="procesos_maquinas" name="extrusion3" type="checkbox" value="1">&nbsp;Extrusión</label>
    </fieldset>
    
    <fieldset class="w245">
        <label><input id="procesos_maquinas_6" class="procesos_maquinas" name="trilaminado3" type="checkbox" value="1">&nbsp;Trilaminado</label>
    </fieldset>
    <fieldset class="w245">
        <label for="trilaminado_proceso_3">GR / m2 (Adhesivo)</label>
        <input class="w140 texto_der" name="trilaminado_proceso_3" type="text" id="trilaminado_proceso_3" value="0">
    </fieldset>
    
    <input name="rebobinado3" type="hidden" value="0">
    
    <input name="habilitado3" type="hidden" value="0">
    
    <fieldset class="w245">
        <label><input id="procesos_maquinas_7" class="procesos_maquinas" name="cortefinal3" type="checkbox" value="1">&nbsp;Corte</label>
    </fieldset>
    
    <fieldset class="w245">
        <label><input id="procesos_maquinas_8" class="procesos_maquinas" name="sellado3" type="checkbox" value="1">&nbsp;Sellado</label>
    </fieldset>
    
</div><!-- FIN LAMINA 3 -->