<?php
session_start();
require_once("../../../connect/conexion.php");
require_once("../../../connect/function.php");
require_once("../../../connect/sesion/verificar_sesion.php");

//VARIABLES
$insumo=$_POST["insumo"];

//FACTOR DE CONVERSION
$rst_factor=mysql_query("SELECT * FROM syCoesa_mantenimiento_factor_conversion ORDER BY id_factor ASC;");

$rst_factor_bus=mysql_query("SELECT * FROM syCoesa_mantenimiento_factor_conversion ORDER BY id_factor ASC;");

while($fila_factor=mysql_fetch_array($rst_factor)){
	$factor_material=$fila_factor["material"];
	$factor_lista=$factor_material."|".$factor_lista;
}

$lista=substr($factor_lista, 0, -1);
if(BuscarPalabraFactor($lista,$insumo)==1){ 
	while($fila_factor_bus=mysql_fetch_array($rst_factor_bus)){
		$factor_id_bus=$fila_factor_bus["id_factor"];
		$factor_material_bus=$fila_factor_bus["material"];
		$factor_tipo_bus=$fila_factor_bus["tipo"];
		if(BuscarPalabra($factor_material_bus, $insumo)==1 and $factor_tipo_bus==1){
?>
<fieldset class="alto50 w110">
    <label for="almart_milpul">Mil. Pulgada:</label>
    <input name="almart_milpul" type="text" class="texto_cen w90" id="almart_milpul" value="0" size="50">
    <input name="almart_material" id="almart_material" type="hidden" value="<?php echo $factor_id_bus; ?>">
    <input name="almart_micra" id="almart_micra" type="hidden" value="">
    <input name="almart_grm2" id="almart_grm2" type="hidden" value="">
</fieldset>
<?php
		}elseif(BuscarPalabra($factor_material_bus, $insumo)==1 and $factor_tipo_bus==2){
?>
<fieldset class="alto50 w110">
    <label for="almart_micra">Micras:</label>
    <input name="almart_micra" type="text" class="texto_cen w90" id="almart_micra" value="0" size="50">
    <input name="almart_material" id="almart_material" type="hidden" value="<?php echo $factor_id_bus; ?>">
    <input name="almart_milpul" id="almart_milpul" type="hidden" value="">
    <input name="almart_grm2" id="almart_grm2" type="hidden" value="">
</fieldset>
<?php
		}
	}
}elseif(BuscarPalabraFactor($lista,$insumo)==0){
?>
<fieldset class="alto50 w110">
    <label for="almart_grm2">Gr/m2:</label>
    <input name="almart_grm2" type="text" class="texto_cen w90" id="almart_grm2" value="0" size="50">
    <input name="almart_material" id="almart_material" type="hidden" value="">
    <input name="almart_milpul" id="almart_milpul" type="hidden" value="">
    <input name="almart_micra" id="almart_micra" type="hidden" value="">
</fieldset>
<?php
}
?>