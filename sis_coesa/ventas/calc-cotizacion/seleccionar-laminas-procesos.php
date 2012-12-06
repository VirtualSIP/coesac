<?php
session_start();
require_once("../../../connect/conexion.php");
require_once("../../../connect/function.php");
require_once("../../../connect/sesion/verificar_sesion.php");

//VARIABLES
$lamina1=$_POST["lamina1"];
$lamina2=$_POST["lamina2"];
$lamina3=$_POST["lamina3"];
$ancho=$_POST["anchofinal"];
$nrobandas=$_POST["nrobandas"];
$formato=$_POST["formato"];

//LAMINAS
$lamina1_dato=seleccionTabla($lamina1, "id_articulo", "syCoesa_articulo", $conexion);
$lamina2_dato=seleccionTabla($lamina2, "id_articulo", "syCoesa_articulo", $conexion);
$lamina3_dato=seleccionTabla($lamina3, "id_articulo", "syCoesa_articulo", $conexion);

//FILTRO LAMINA1
$filtro1_polietileno=BuscarPalabra("POLIETILENO", $lamina1_dato["nombre_articulo"]);
$filtro1_pebd=BuscarPalabra("PEBD", $lamina1_dato["nombre_articulo"]);
$filtro1_pead=BuscarPalabra("PEAD", $lamina1_dato["nombre_articulo"]);
$filtro1_ppp=BuscarPalabra("PPP", $lamina1_dato["nombre_articulo"]);

//FILTRO LAMINA2
$filtro2_polietileno=BuscarPalabra("POLIETILENO", $lamina2_dato["nombre_articulo"]);
$filtro2_pebd=BuscarPalabra("PEBD", $lamina2_dato["nombre_articulo"]);
$filtro2_pead=BuscarPalabra("PEAD", $lamina2_dato["nombre_articulo"]);
$filtro2_ppp=BuscarPalabra("PPP", $lamina2_dato["nombre_articulo"]);

//FILTRO LAMINA3
$filtro3_polietileno=BuscarPalabra("POLIETILENO", $lamina3_dato["nombre_articulo"]);
$filtro3_pebd=BuscarPalabra("PEBD", $lamina3_dato["nombre_articulo"]);
$filtro3_pead=BuscarPalabra("PEAD", $lamina3_dato["nombre_articulo"]);
$filtro3_ppp=BuscarPalabra("PPP", $lamina3_dato["nombre_articulo"]);

//FACTOR DE CONVERSION
$rst_factor=mysql_query("SELECT * FROM syCoesa_mantenimiento_factor_conversion ORDER BY id_factor ASC;", $conexion);

//LISTA DE MATERIALES PARA FACTORES DE CONVERSION
while($fila_factor=mysql_fetch_array($rst_factor)){
	$factor_material=$fila_factor["material"];
	$factor_lista=$factor_material."|".$factor_lista;
}
$lista=substr($factor_lista, 0, -1);

//MATERIALES PARA LAMINAS
$rst_factor_lam1=mysql_query("SELECT * FROM syCoesa_mantenimiento_factor_conversion ORDER BY id_factor ASC;", $conexion);
$rst_factor_lam2=mysql_query("SELECT * FROM syCoesa_mantenimiento_factor_conversion ORDER BY id_factor ASC;", $conexion);
$rst_factor_lam3=mysql_query("SELECT * FROM syCoesa_mantenimiento_factor_conversion ORDER BY id_factor ASC;", $conexion);

//SELECCION DE FORMATO (LAMINA O MANGA)
if($formato==1){ $anchofinal=($ancho * $nrobandas) + 20; }//ANCHO PARA LAMINAS - SOLO PARA LAMINAS
elseif($formato==2){ $anchofinal=$ancho; } //ANCHO PARA LAMINAS - SOLO PARA MANGAS

?>
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

<!-- LAMINA 1 -->
<?php if($lamina1>0){ ?>

<?php
if(BuscarPalabraFactor($lista, $lamina1_dato["nombre_articulo"])==1){ 

	while($fila_factor_lam1=mysql_fetch_array($rst_factor_lam1)){
		
		$factor_id_lam1=$fila_factor_lam1["id_factor"];
		$factor_material_lam1=$fila_factor_lam1["material"];
		$factor_tipo_lam1=$fila_factor_lam1["tipo"];
		
		if(BuscarPalabra($factor_material_lam1, $lamina1_dato["nombre_articulo"])==1 and $factor_tipo_lam1==1){
?>
<div id="lamina1_factconv">
<fieldset class="alto50 w120" id="factor_lam1">
    <label for="lamina1_milpul">Mil. Pulgada:</label>
    <input name="lamina1_milpul" type="text" class="texto_cen w90 factor_conversion_lam1" id="lamina1_milpul" value="0" >
    <input name="lamina1_material" id="lamina1_material" type="hidden" value="<?php echo $factor_id_lam1; ?>">
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
<?php }elseif(BuscarPalabra($factor_material_lam1, $lamina1_dato["nombre_articulo"])==1 and $factor_tipo_lam1==2){ ?>
<div id="lamina1_factconv">
<fieldset class="alto50 w120" id="factor_lam1">
    <label for="lamina1_micra">Micras:</label>
    <input name="lamina1_micra" type="text" class="texto_cen w90 factor_conversion_lam1" id="lamina1_micra" value="0">
    <input name="lamina1_material" id="lamina1_material" type="hidden" value="<?php echo $factor_id_lam1; ?>">
    <input name="lamina1_milpul" id="lamina1_milpul" type="hidden" value="0">
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
<?php } } }elseif(BuscarPalabraFactor($lista, $lamina1_dato["nombre_articulo"])==0){ ?>
<fieldset class="alto50 w120">
    <label for="lamina1_grm2">GR / M2</label>
    <input class="texto_cen w90" name="lamina1_grm2" type="text" id="lamina1_grm2" value="0">
    <input name="lamina1_milpul" id="lamina1_milpul" type="hidden" value="0">
     <input name="lamina1_micra" id="lamina1_micra" type="hidden" value="0">
</fieldset>
<?php } ?>

<fieldset class="w120">
    <label for="lamina1_ancho">Ancho</label>
    <input class="w100 texto_der" name="lamina1_ancho" type="text" id="lamina1_ancho" value="<?php echo $anchofinal; ?>">
</fieldset>

<?php if($filtro1_polietileno==1 or $filtro1_pebd==1 or $filtro1_pead==1 or $filtro1_ppp==1){ ?>
<fieldset class="w245">
    <label><input id="procesos_maquinas_3" class="procesos_maquinas" name="extrusion1" type="checkbox" value="1">&nbsp;Extrusión</label>
</fieldset>
<?php } ?>

<fieldset class="w245">
    <label><input id="procesos_maquinas_4" class="procesos_maquinas" name="impresion1" type="checkbox" value="1">
        &nbsp;Impresión</label>
</fieldset>

<fieldset class="w245">
    <label for="grm2_tintaseca_1">GR / M2 (Tinta seca)</label>
    <input class="w140 texto_der" name="grm2_tintaseca_1" type="text" id="grm2_tintaseca_1" value="0">
</fieldset>

<fieldset class="w245">
    <label><input id="procesos_maquinas_9" class="procesos_maquinas" name="rebobinado1" type="checkbox" value="1">&nbsp;Rebobinado</label>
</fieldset>
<?php } ?>

<!-- LAMINA 2 -->
<?php if($lamina2>0){ ?>

<?php
if(BuscarPalabraFactor($lista, $lamina2_dato["nombre_articulo"])==1){ 
	while($fila_factor_lam2=mysql_fetch_array($rst_factor_lam2)){		
		$factor_id_lam2=$fila_factor_lam2["id_factor"];
		$factor_material_lam2=$fila_factor_lam2["material"];
		$factor_tipo_lam2=$fila_factor_lam2["tipo"];		
		if(BuscarPalabra($factor_material_lam2, $lamina2_dato["nombre_articulo"])==1 and $factor_tipo_lam2==1){
?>
<div id="lamina2_factconv">
<fieldset class="alto50 w120" id="factor_lam12">
    <label for="lamina2_milpul">Mil. Pulgada:</label>
    <input name="lamina2_milpul" type="text" class="texto_cen w90 factor_conversion_lam2" id="lamina2_milpul" value="0">
    <input name="lamina2_material" id="lamina2_material" type="hidden" value="<?php echo $factor_id_lam2; ?>">
    <input name="lamina2_micra" id="lamina2_micra" type="hidden" value="0">
    <input name="conversion2_factor" id="conversion2_factor" type="hidden" value="1">
</fieldset>
<fieldset class="alto50 w120" id="grm2_lam2">
    <label for="lamina2_grm2">GR / M2</label>
    <input class="texto_cen w90" name="lamina2_grm2" type="text" id="lamina2_grm2" value="0" readonly>
    <input name="conversion2_grm2" id="conversion2_grm2" type="hidden" value="0">
</fieldset>
</div>
<fieldset class="w120">
    <a href="javascript:;" class="boton_conv" id="factor2_cambiar">Cambiar</a>
</fieldset>
<fieldset class="w120">
	<a href="javascript:;" class="boton_conv" id="factor2_convertir">Convertir</a>
</fieldset>
<?php }elseif(BuscarPalabra($factor_material_lam2, $lamina2_dato["nombre_articulo"])==1 and $factor_tipo_lam2==2){ ?>
<div id="lamina2_factconv">
<fieldset class="alto50 w120" id="factor_lam12">
    <label for="lamina2_micra">Micras:</label>
    <input name="lamina2_micra" type="text" class="texto_cen w90 factor_conversion_lam2" id="lamina2_micra" value="0">
    <input name="lamina2_material" id="lamina2_material" type="hidden" value="<?php echo $factor_id_lam2; ?>">
    <input name="lamina2_milpul" id="lamina2_milpul" type="hidden" value="0">
    <input name="conversion2_factor" id="conversion2_factor" type="hidden" value="1">
</fieldset>
<fieldset class="alto50 w120" id="grm2_lam2">
    <label for="lamina2_grm2">GR / M2</label>
    <input class="texto_cen w90" name="lamina2_grm2" type="text" id="lamina2_grm2" value="0" readonly>
    <input name="conversion2_grm2" id="conversion2_grm2" type="hidden" value="0">
</fieldset>
</div>
<fieldset class="w120">
    <a href="javascript:;" class="boton_conv" id="factor2_cambiar">Cambiar</a>
</fieldset>
<fieldset class="w120">
	<a href="javascript:;" class="boton_conv" id="factor2_convertir">Convertir</a>
</fieldset>
<?php } } }elseif(BuscarPalabraFactor($lista, $lamina2_dato["nombre_articulo"])==0){ ?>
<fieldset class="alto50 w120">
    <label for="lamina2_grm2">GR / M2</label>
    <input class="texto_cen w90" name="lamina2_grm2" type="text" id="lamina2_grm2" value="0">
    <input name="lamina2_milpul" id="lamina2_milpul" type="hidden" value="0">
    <input name="lamina2_micra" id="lamina2_micra" type="hidden" value="0">
</fieldset>
<?php } ?>

<fieldset class="w120">
    <label for="lamina2_ancho">Ancho</label>
    <input class="w100 texto_der" name="lamina2_ancho" type="text" id="lamina2_ancho" value="<?php echo $anchofinal; ?>">
</fieldset>

<?php if($filtro2_polietileno==1 or $filtro2_pebd==1 or $filtro2_pead==1 or $filtro2_ppp==1){ ?>
<fieldset class="w245">
    <label><input id="procesos_maquinas_3" class="procesos_maquinas" name="extrusion2" type="checkbox" value="1">&nbsp;Extrusión</label>
</fieldset>
<?php } ?>

<fieldset class="w245">
	<input id="procesos_maquinas_5" name="bilaminado2" type="hidden" value="1">
    <label for="bilaminado_proceso_2">GR / m2 (Adhesivo)</label>
    <input class="w140 texto_der" name="bilaminado_proceso_2" type="text" id="bilaminado_proceso_2" value="0">
    <input name="rebobinado2" type="hidden" value="0">
</fieldset>

<?php } ?>

<!-- LAMINA 3 -->
<?php if($lamina3>0){ ?>

<?php
if(BuscarPalabraFactor($lista, $lamina3_dato["nombre_articulo"])==1){ 
	while($fila_factor_lam3=mysql_fetch_array($rst_factor_lam3)){
		$factor_id_lam3=$fila_factor_lam3["id_factor"];
		$factor_material_lam3=$fila_factor_lam3["material"];
		$factor_tipo_lam3=$fila_factor_lam3["tipo"];
		if(BuscarPalabra($factor_material_lam3, $lamina3_dato["nombre_articulo"])==1 and $factor_tipo_lam3==1){
?>
<div id="lamina3_factconv">
<fieldset class="alto50 w120" id="factor_lam13">
    <label for="lamina3_milpul">Mil. Pulgada:</label>
    <input name="lamina3_milpul" type="text" class="texto_cen w90 factor_conversion_lam3" id="lamina3_milpul" value="0">
    <input name="lamina3_material" id="lamina3_material" type="hidden" value="<?php echo $factor_id_lam3; ?>">
    <input name="lamina3_micra" id="lamina3_micra" type="hidden" value="0">
    <input name="conversion3_factor" id="conversion3_factor" type="hidden" value="1">
</fieldset>
<fieldset class="alto50 w120" id="grm2_lam3">
    <label for="lamina3_grm2">GR / M2</label>
    <input class="texto_cen w90" name="lamina3_grm2" type="text" id="lamina3_grm2" value="0" readonly>
    <input name="conversion3_grm2" id="conversion3_grm2" type="hidden" value="0">
</fieldset>
</div>
<fieldset class="w120">
    <a href="javascript:;" class="boton_conv" id="factor3_cambiar">Cambiar</a>
</fieldset>
<fieldset class="w120">
	<a href="javascript:;" class="boton_conv" id="factor3_convertir">Convertir</a>
</fieldset>
<?php }elseif(BuscarPalabra($factor_material_lam3, $lamina3_dato["nombre_articulo"])==1 and $factor_tipo_lam3==2){ ?>
<div id="lamina3_factconv">
<fieldset class="alto50 w120" id="factor_lam13">
    <label for="lamina3_micra">Micras:</label>
    <input name="lamina3_micra" type="text" class="texto_cen w90 factor_conversion_lam3" id="lamina3_micra" value="0">
    <input name="lamina3_material" id="lamina3_material" type="hidden" value="<?php echo $factor_id_lam3; ?>">
    <input name="lamina3_milpul" id="lamina3_milpul" type="hidden" value="0">
    <input name="conversion3_factor" id="conversion3_factor" type="hidden" value="1">
</fieldset>
<fieldset class="alto50 w120" id="grm2_lam3">
    <label for="lamina3_grm2">GR / M2</label>
    <input class="texto_cen w90" name="lamina3_grm2" type="text" id="lamina3_grm2" value="0" readonly>
    <input name="conversion3_grm2" id="conversion3_grm2" type="hidden" value="0">
</fieldset>
</div>
<fieldset class="w120">
    <a href="javascript:;" class="boton_conv" id="factor3_cambiar">Cambiar</a>
</fieldset>
<fieldset class="w120">
	<a href="javascript:;" class="boton_conv" id="factor3_convertir">Convertir</a>
</fieldset>
<?php } } }elseif(BuscarPalabraFactor($lista, $lamina3_dato["nombre_articulo"])==0){ ?>
<fieldset class="alto50 w120">
    <label for="lamina3_grm2">GR / M2</label>
    <input class="texto_cen w90" name="lamina3_grm2" type="text" id="lamina3_grm2" value="0">
    <input name="lamina3_milpul" id="lamina3_milpul" type="hidden" value="0">
     <input name="lamina3_micra" id="lamina3_micra" type="hidden" value="0">
</fieldset>
<?php } ?>

<fieldset class="w120">
    <label for="lamina3_ancho">Ancho</label>
    <input class="w100 texto_der" name="lamina3_ancho" type="text" id="lamina3_ancho" value="<?php echo $anchofinal; ?>">
</fieldset>

<?php if($filtro3_polietileno==1 or $filtro3_pebd==1 or $filtro3_pead==1 or $filtro3_ppp==1){ ?>
<fieldset class="w245">
    <label><input id="procesos_maquinas_3" class="procesos_maquinas" name="extrusion3" type="checkbox" value="1">&nbsp;Extrusión</label>
</fieldset>
<?php } ?>

<fieldset class="w245">
    <input id="procesos_maquinas_6" name="trilaminado3" type="hidden" value="1">
    <label for="trilaminado_proceso_3">GR / m2 (Adhesivo)</label>
    <input class="w140 texto_der" name="trilaminado_proceso_3" type="text" id="trilaminado_proceso_3" value="0">
    <input name="rebobinado3" type="hidden" value="0">
</fieldset>

<?php } ?>