<?php
require_once("../../../connect/conexion.php");
require_once("../../../connect/function.php");

//VARIABLES
$lamina1=$_POST["lamina1"];
$lamina2=$_POST["lamina2"];
$lamina3=$_POST["lamina3"];

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
$rst_factor=mysql_query("SELECT * FROM syCoesa_mantenimiento_factor_conversion ORDER BY id_factor ASC;");

//LISTA DE MATERIALES PARA FACTORES DE CONVERSION
while($fila_factor=mysql_fetch_array($rst_factor)){
	$factor_material=$fila_factor["material"];
	$factor_lista=$factor_material."|".$factor_lista;
}
$lista=substr($factor_lista, 0, -1);

//MATERIALES PARA LAMINAS
$rst_factor_lam1=mysql_query("SELECT * FROM syCoesa_mantenimiento_factor_conversion ORDER BY id_factor ASC;");
$rst_factor_lam2=mysql_query("SELECT * FROM syCoesa_mantenimiento_factor_conversion ORDER BY id_factor ASC;");
$rst_factor_lam3=mysql_query("SELECT * FROM syCoesa_mantenimiento_factor_conversion ORDER BY id_factor ASC;");

?>

<?php if($lamina1>0){ ?>

<?php if($filtro1_polietileno==1 or $filtro1_pebd==1 or $filtro1_pead==1 or $filtro1_ppp==1){ ?>
<fieldset class="w120">
    <label for="lamina1_ancho">Ancho</label>
    <input class="w100 texto_der" name="lamina1_ancho" type="text" id="lamina1_ancho" value="0">
</fieldset>

<?php
if(BuscarPalabraFactor($lista, $lamina1_dato["nombre_articulo"])==1){ 

	while($fila_factor_lam1=mysql_fetch_array($rst_factor_lam1)){
		
		$factor_id_lam1=$fila_factor_lam1["id_factor"];
		$factor_material_lam1=$fila_factor_lam1["material"];
		$factor_tipo_lam1=$fila_factor_lam1["tipo"];
		
		if(BuscarPalabra($factor_material_lam1, $lamina1_dato["nombre_articulo"])==1 and $factor_tipo_lam1==1){
?>
<fieldset class="alto50 w110">
    <label for="lamina1_milpul">Mil. Pulgada:</label>
    <input name="lamina1_milpul" type="text" class="texto_cen w90" id="lamina1_milpul" value="0" size="50">
    <input name="lamina1_material" id="lamina1_material" type="hidden" value="<?php echo $factor_id_lam1; ?>">
    <input name="lamina1_micra" id="lamina1_micra" type="hidden" value="">
    <input name="lamina1_grm2" id="lamina1_grm2" type="hidden" value="">
</fieldset>
<?php } } }elseif(BuscarPalabraFactor($lista, $lamina1_dato["nombre_articulo"])==0){ ?>
<fieldset class="w120">
    <label for="lamina1_grm2">GR / M2</label>
    <input class="w100 texto_der" name="lamina1_grm2" type="text" id="lamina1_grm2" value="0">
    <input name="lamina1_milpul" id="lamina1_milpul" type="hidden" value="">
     <input name="lamina1_micra" id="lamina1_micra" type="hidden" value="">
</fieldset>
<?php } ?>

<fieldset class="w245">
    <label><input id="procesos_maquinas_3" class="procesos_maquinas" name="extrusion1" type="checkbox" value="1">&nbsp;Extrusión</label>
</fieldset>

<?php }else{ ?>
<fieldset class="w120">
    <label for="lamina1_ancho">Ancho</label>
    <input class="w100 texto_der" name="lamina1_ancho" type="text" id="lamina1_ancho" value="<?php echo $lamina1_dato["ancho_articulo"]; ?>">
</fieldset>

<?php
if(BuscarPalabraFactor($lista, $lamina1_dato["nombre_articulo"])==1){ 

	while($fila_factor_lam1=mysql_fetch_array($rst_factor_lam1)){
		
		$factor_id_lam1=$fila_factor_lam1["id_factor"];
		$factor_material_lam1=$fila_factor_lam1["material"];
		$factor_tipo_lam1=$fila_factor_lam1["tipo"];
		
		if(BuscarPalabra($factor_material_lam1, $lamina1_dato["nombre_articulo"])==1 and $factor_tipo_lam1==2){
?>
<fieldset class="alto50 w110">
    <label for="lamina1_micra">Micras:</label>
    <input name="lamina1_micra" type="text" class="texto_cen w90" id="lamina1_micra" value="0" size="50">
    <input name="lamina1_material" id="lamina1_material" type="hidden" value="<?php echo $factor_id_lam1; ?>">
    <input name="lamina1_milpul" id="lamina1_milpul" type="hidden" value="">
    <input name="lamina1_grm2" id="lamina1_grm2" type="hidden" value="">
</fieldset>
<?php } } }elseif(BuscarPalabraFactor($lista, $lamina1_dato["nombre_articulo"])==0){ ?>
<fieldset class="w120">
    <label for="lamina1_grm2">GR / M2</label>
    <input class="w100 texto_der" name="lamina1_grm2" type="text" id="lamina1_grm2" value="0">
    <input name="lamina1_milpul" id="lamina1_milpul" type="hidden" value="">
     <input name="lamina1_micra" id="lamina1_micra" type="hidden" value="">
</fieldset>
<?php } } ?>

<fieldset class="w245">
    <label><input id="procesos_maquinas_4" class="procesos_maquinas" name="impresion1" type="checkbox" value="1">&nbsp;Impresión</label>
</fieldset>
<fieldset class="w245">
    <label for="grm2_tintaseca_1">GR / M2 (Tinta seca)</label>
    <input class="w140 texto_der" name="grm2_tintaseca_1" type="text" id="grm2_tintaseca_1" value="0">
</fieldset>

<fieldset class="w245">
    <label><input id="procesos_maquinas_9" class="procesos_maquinas" name="rebobinado1" type="checkbox" value="1">&nbsp;Rebobinado</label>
</fieldset>
<?php } ?>

<?php if($lamina2>0){ ?>
<?php if($filtro2_polietileno==1 or $filtro2_pebd==1 or $filtro2_pead==1 or $filtro2_ppp==1){ ?>
<fieldset class="w120">
    <label for="lamina2_ancho">Ancho</label>
    <input class="w100 texto_der" name="lamina2_ancho" type="text" id="lamina2_ancho" value="0">
</fieldset>

<?php
if(BuscarPalabraFactor($lista, $lamina2_dato["nombre_articulo"])==1){ 

	while($fila_factor_lam2=mysql_fetch_array($rst_factor_lam2)){
		
		$factor_id_lam2=$fila_factor_lam2["id_factor"];
		$factor_material_lam2=$fila_factor_lam2["material"];
		$factor_tipo_lam2=$fila_factor_lam2["tipo"];
		
		if(BuscarPalabra($factor_material_lam2, $lamina2_dato["nombre_articulo"])==1 and $factor_tipo_lam2==1){
?>
<fieldset class="alto50 w110">
    <label for="lamina2_milpul">Mil. Pulgada:</label>
    <input name="lamina2_milpul" type="text" class="texto_cen w90" id="lamina2_milpul" value="0" size="50">
    <input name="lamina2_material" id="lamina2_material" type="hidden" value="<?php echo $factor_id_lam2; ?>">
    <input name="lamina2_micra" id="lamina2_micra" type="hidden" value="">
    <input name="lamina2_grm2" id="lamina2_grm2" type="hidden" value="">
</fieldset>
<?php } } }elseif(BuscarPalabraFactor($lista, $lamina2_dato["nombre_articulo"])==0){ ?>
<fieldset class="w120">
    <label for="lamina2_grm2">GR / M2</label>
    <input class="w100 texto_der" name="lamina2_grm2" type="text" id="lamina2_grm2" value="0">
    <input name="lamina2_milpul" id="lamina2_milpul" type="hidden" value="">
     <input name="lamina2_micra" id="lamina2_micra" type="hidden" value="">
</fieldset>
<?php } ?>

<fieldset class="w245">
    <label><input id="procesos_maquinas_3" class="procesos_maquinas" name="extrusion2" type="checkbox" value="1">&nbsp;Extrusión</label>
</fieldset>

<?php }else{ ?>
<fieldset class="w120">
    <label for="lamina2_ancho">Ancho</label>
    <input class="w100 texto_der" name="lamina2_ancho" type="text" id="lamina2_ancho" value="<?php echo $lamina2_dato["ancho_articulo"]; ?>">
</fieldset>

<?php
if(BuscarPalabraFactor($lista, $lamina2_dato["nombre_articulo"])==1){ 

	while($fila_factor_lam2=mysql_fetch_array($rst_factor_lam2)){
		
		$factor_id_lam2=$fila_factor_lam2["id_factor"];
		$factor_material_lam2=$fila_factor_lam2["material"];
		$factor_tipo_lam2=$fila_factor_lam2["tipo"];
		
		if(BuscarPalabra($factor_material_lam2, $lamina2_dato["nombre_articulo"])==1 and $factor_tipo_lam2==2){
?>
<fieldset class="alto50 w110">
    <label for="lamina2_micra">Micras:</label>
    <input name="lamina2_micra" type="text" class="texto_cen w90" id="lamina2_micra" value="0" size="50">
    <input name="lamina2_material" id="lamina2_material" type="hidden" value="<?php echo $factor_id_lam2; ?>">
    <input name="lamina2_milpul" id="lamina2_milpul" type="hidden" value="">
    <input name="lamina2_grm2" id="lamina2_grm2" type="hidden" value="">
</fieldset>
<?php } } }elseif(BuscarPalabraFactor($lista, $lamina2_dato["nombre_articulo"])==0){ ?>
<fieldset class="w120">
    <label for="lamina2_grm2">GR / M2</label>
    <input class="w100 texto_der" name="lamina2_grm2" type="text" id="lamina2_grm2" value="0">
    <input name="lamina2_milpul" id="lamina2_milpul" type="hidden" value="">
     <input name="lamina2_micra" id="lamina2_micra" type="hidden" value="">
</fieldset>
<?php } } ?>

<fieldset class="w245">
	<input id="procesos_maquinas_5" name="bilaminado2" type="hidden" value="1">
    <label for="bilaminado_proceso_2">GR / m2 (Adhesivo)</label>
    <input class="w140 texto_der" name="bilaminado_proceso_2" type="text" id="bilaminado_proceso_2" value="0">
    <input name="rebobinado2" type="hidden" value="0">
</fieldset>

<?php } ?>

<?php if($lamina3>0){ ?>
<?php if($filtro3_polietileno==1 or $filtro3_pebd==1 or $filtro3_pead==1 or $filtro3_ppp==1){ ?>
<fieldset class="w120">
    <label for="lamina3_ancho">Ancho</label>
    <input class="w100 texto_der" name="lamina3_ancho" type="text" id="lamina3_ancho" value="0">
</fieldset>

<?php
if(BuscarPalabraFactor($lista, $lamina3_dato["nombre_articulo"])==1){ 

	while($fila_factor_lam3=mysql_fetch_array($rst_factor_lam3)){
		
		$factor_id_lam3=$fila_factor_lam3["id_factor"];
		$factor_material_lam3=$fila_factor_lam3["material"];
		$factor_tipo_lam3=$fila_factor_lam3["tipo"];
		
		if(BuscarPalabra($factor_material_lam3, $lamina3_dato["nombre_articulo"])==1 and $factor_tipo_lam3==1){
?>
<fieldset class="alto50 w110">
    <label for="lamina3_milpul">Mil. Pulgada:</label>
    <input name="lamina3_milpul" type="text" class="texto_cen w90" id="lamina3_milpul" value="0" size="50">
    <input name="lamina3_material" id="lamina3_material" type="hidden" value="<?php echo $factor_id_lam3; ?>">
    <input name="lamina3_micra" id="lamina3_micra" type="hidden" value="">
    <input name="lamina3_grm2" id="lamina3_grm2" type="hidden" value="">
</fieldset>
<?php } } }elseif(BuscarPalabraFactor($lista, $lamina3_dato["nombre_articulo"])==0){ ?>
<fieldset class="w120">
    <label for="lamina3_grm2">GR / M2</label>
    <input class="w100 texto_der" name="lamina3_grm2" type="text" id="lamina3_grm2" value="0">
    <input name="lamina3_milpul" id="lamina3_milpul" type="hidden" value="">
     <input name="lamina3_micra" id="lamina3_micra" type="hidden" value="">
</fieldset>
<?php } ?>

<fieldset class="w245">
    <label><input id="procesos_maquinas_3" class="procesos_maquinas" name="extrusion3" type="checkbox" value="1">&nbsp;Extrusión</label>
</fieldset>

<?php }else{ ?>
<fieldset class="w120">
    <label for="lamina3_ancho">Ancho</label>
    <input class="w100 texto_der" name="lamina3_ancho" type="text" id="lamina3_ancho" value="<?php echo $lamina3_dato["ancho_articulo"]; ?>">
</fieldset>

<?php
if(BuscarPalabraFactor($lista, $lamina3_dato["nombre_articulo"])==1){ 

	while($fila_factor_lam3=mysql_fetch_array($rst_factor_lam3)){
		
		$factor_id_lam3=$fila_factor_lam3["id_factor"];
		$factor_material_lam3=$fila_factor_lam3["material"];
		$factor_tipo_lam3=$fila_factor_lam3["tipo"];
		
		if(BuscarPalabra($factor_material_lam3, $lamina3_dato["nombre_articulo"])==1 and $factor_tipo_lam3==2){
?>
<fieldset class="alto50 w110">
    <label for="lamina3_micra">Micras:</label>
    <input name="lamina3_micra" type="text" class="texto_cen w90" id="lamina3_micra" value="0" size="50">
    <input name="lamina3_material" id="lamina3_material" type="hidden" value="<?php echo $factor_id_lam3; ?>">
    <input name="lamina3_milpul" id="lamina3_milpul" type="hidden" value="">
    <input name="lamina3_grm2" id="lamina3_grm2" type="hidden" value="">
</fieldset>
<?php } } }elseif(BuscarPalabraFactor($lista, $lamina3_dato["nombre_articulo"])==0){ ?>
<fieldset class="w120">
    <label for="lamina3_grm2">GR / M2</label>
    <input class="w100 texto_der" name="lamina3_grm2" type="text" id="lamina3_grm2" value="0">
    <input name="lamina3_milpul" id="lamina3_milpul" type="hidden" value="">
     <input name="lamina3_micra" id="lamina3_micra" type="hidden" value="">
</fieldset>
<?php } } ?>

<fieldset class="w245">
	<input id="procesos_maquinas_6" name="trilaminado3" type="hidden" value="1">
    <label for="trilaminado_proceso_3">GR / m2 (Adhesivo)</label>
    <input class="w140 texto_der" name="trilaminado_proceso_3" type="text" id="trilaminado_proceso_3" value="0">
    <input name="rebobinado3" type="hidden" value="0">
</fieldset>

<?php } ?>