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
$formula_filtro_polietileno=0;

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

<div class="w245 float_left border_der margin_r10">
	
    <h2>Monocapa</h2><br>
                            
    <fieldset class="alto50 w235">
      <label for="dt_articulo1">Laminas:</label>
      <select name="dt_articulo1" id="dt_articulo1" class="cmbSlc">
        <option value>[ Seleccionar opcion ]</option>
        <?php while($fila_lamina1=mysql_fetch_array($rst_lamina1)){
                //VARIABLES
                $lamina1_id=$fila_lamina1["id_articulo"];
                $lamina1_nombre=$fila_lamina1["nombre_articulo"];
                $lamina1_ancho=$fila_lamina1["ancho_articulo"];
				$lamina1_tipo=$fila_lamina1["id_tipo_articulo"];
				
				//FILTRO
				$filtro1_polietileno=BuscarPalabra("POLIETILENO", $lamina1_nombre);
				$filtro1_pebd=BuscarPalabra("PEBD", $lamina1_nombre);
				$filtro1_pead=BuscarPalabra("PEAD", $lamina1_nombre);
				$filtro1_ppp=BuscarPalabra("PPP", $lamina1_nombre);
				
		if($filtro1_polietileno==1 or $filtro1_pead==1 or $filtro1_pebd==1 or $filtro1_ppp==1){
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
    
    <div id="lamina1_procesos" class="w245 float_left"></div>
    
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
				$lamina2_tipo=$fila_lamina1["id_tipo_articulo"];
				
				//FILTRO LAMINA2
				$filtro2_polietileno=BuscarPalabra("POLIETILENO", $lamina2_nombre);
				$filtro2_pebd=BuscarPalabra("PEBD", $lamina2_nombre);
				$filtro2_pead=BuscarPalabra("PEAD", $lamina2_nombre);
				$filtro2_ppp=BuscarPalabra("PPP", $lamina2_nombre);
		
		if($filtro2_polietileno==1 or $filtro2_pead==1 or $filtro2_pebd==1 or $filtro2_ppp==1){
				if($lamina2_ancho>=$formula_filtro_polietileno){ ?>
            <option value="<?php echo $lamina2_id; ?>"><?php echo $lamina2_nombre; ?></option>	    
		<?php }}elseif($lamina2_tipo<>13){
					if($lamina2_ancho>=$formula_filtro_lamina){ ?>
            <option value="<?php echo $lamina2_id; ?>"><?php echo $lamina2_nombre; ?></option>
        <?php }}elseif($lamina2_tipo==13){
				if($lamina2_ancho>=$formula_filtro_manga){ ?>
        	<option value="<?php echo $lamina2_id; ?>"><?php echo $lamina2_nombre; ?></option>	
        <?php }}} ?>
      </select>
      <a id="lamina2_select" class="boton_lamina"  href="javascript:;"></a>
    </fieldset>
    
    <div id="lamina2_procesos" class="w245 float_left"></div>
    
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
				$lamina3_tipo=$fila_lamina1["id_tipo_articulo"];
				
				//FILTRO LAMINA3
				$filtro3_polietileno=BuscarPalabra("POLIETILENO", $lamina3_nombre);
				$filtro3_pebd=BuscarPalabra("PEBD", $lamina3_nombre);
				$filtro3_pead=BuscarPalabra("PEAD", $lamina3_nombre);
				$filtro3_ppp=BuscarPalabra("PPP", $lamina3_nombre);
				
		if($filtro3_polietileno==1 or $filtro3_pead==1 or $filtro3_pebd==1 or $filtro3_ppp==1){
				if($lamina3_ancho>=$formula_filtro_polietileno){ ?>
			<option value="<?php echo $lamina3_id; ?>"><?php echo $lamina3_nombre; ?></option>
		<?php }}elseif($lamina3_tipo<>13){
					if($lamina3_ancho>=$formula_filtro_lamina){?>
            <option value="<?php echo $lamina3_id; ?>"><?php echo $lamina3_nombre; ?></option>
        <?php }}elseif($lamina3_tipo==13){
				if($lamina3_ancho>=$formula_filtro_manga){?>
        	<option value="<?php echo $lamina3_id; ?>"><?php echo $lamina3_nombre; ?></option>	
        <?php }}} ?>
        </select>
        <a id="lamina3_select" class="boton_lamina"  href="javascript:;"></a>
    </fieldset>
    
    <div id="lamina3_procesos" class="w245 float_left"></div>
    
</div><!-- FIN LAMINA 3 -->

<div class="w130 float_left border_der margin_r10">
                            	
    <h2>Acabado</h2><br>
    <fieldset class="w130">
        <label><input id="procesos_maquinas_7" class="procesos_maquinas" name="cortefinal" type="checkbox" value="1">&nbsp;Corte</label>
    </fieldset>
    
    <fieldset class="w130">
        <label><input id="procesos_maquinas_8" class="procesos_maquinas" name="sellado" type="checkbox" value="1">&nbsp;Sellado</label>
    </fieldset>

</div><!-- FIN ACABADO -->