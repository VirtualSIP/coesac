<?php
require_once("../../../connect/conexion.php");
require_once("../../../connect/function.php");
require_once("../../../connect/sesion/verificar_sesion.php");

/*VARIABLES DE MILESIMA DE PULGADA Y MICRA*/
//LAMINA 1
$lamina1_factor_milpul=$_POST["lam1_milpul"];
$lamina1_factor_micra=$_POST["lam1_micra"];
$lamina1_factor_material=$_POST["lam1_material"];

//LAMINA 2
$lamina2_factor_milpul=$_POST["lam2_milpul"];
$lamina2_factor_micra=$_POST["lam2_micra"];
$lamina2_factor_material=$_POST["lam2_material"];

//LAMINA 3
$lamina3_factor_milpul=$_POST["lam3_milpul"];
$lamina3_factor_micra=$_POST["lam3_micra"];
$lamina3_factor_material=$_POST["lam3_material"];

/* LAMINA 1 - MILESIMA DE PULGADA Y MICRA */
if($lamina1_factor_milpul>0){ 
	$lamina1_material=seleccionTabla($lamina1_factor_material, "id_factor", "syCoesa_mantenimiento_factor_conversion", $conexion);
	$lamina1_grm2=$lamina1_factor_milpul * $lamina1_material["factor"];
?>
	<label for="lamina1_grm2">GR / M2</label>
    <input class="w100 texto_der" name="lamina1_grm2" type="text" id="lamina1_grm2" value="<?php echo $lamina1_grm2; ?>">
<?php
}elseif($lamina1_factor_micra>0){
	$lamina1_material=seleccionTabla($lamina1_factor_material, "id_factor", "syCoesa_mantenimiento_factor_conversion", $conexion);
	$lamina1_grm2=$lamina1_factor_micra * $lamina1_material["factor"];
?>
	<label for="lamina1_grm2">GR / M2</label>
    <input class="w100 texto_der" name="lamina1_grm2" type="text" id="lamina1_grm2" value="<?php echo $lamina1_grm2; ?>">
<?php
}

/* LAMINA 2 - MILESIMA DE PULGADA Y MICRA */
if($lamina2_factor_milpul>0){ 
	$lamina2_material=seleccionTabla($lamina2_factor_material, "id_factor", "syCoesa_mantenimiento_factor_conversion", $conexion);
	$lamina2_grm2=$lamina2_factor_milpul * $lamina2_material["factor"];
?>
	<label for="lamina2_grm2">GR / M2</label>
    <input class="w100 texto_der" name="lamina2_grm2" type="text" id="lamina2_grm2" value="<?php echo $lamina2_grm2; ?>">
<?php
}elseif($lamina2_factor_micra>0){
	$lamina2_material=seleccionTabla($lamina2_factor_material, "id_factor", "syCoesa_mantenimiento_factor_conversion", $conexion);
	$lamina2_grm2=$lamina2_factor_micra * $lamina2_material["factor"];
?>
	<label for="lamina2_grm2">GR / M2</label>
    <input class="w100 texto_der" name="lamina2_grm2" type="text" id="lamina2_grm2" value="<?php echo $lamina2_grm2; ?>">
<?php
}

/* LAMINA 3 - MILESIMA DE PULGADA Y MICRA */
if($lamina3_factor_milpul>0){ 
	$lamina3_material=seleccionTabla($lamina3_factor_material, "id_factor", "syCoesa_mantenimiento_factor_conversion", $conexion);
	$lamina3_grm2=$lamina3_factor_milpul * $lamina3_material["factor"];
?>
	<label for="lamina3_grm2">GR / M2</label>
    <input class="w100 texto_der" name="lamina3_grm2" type="text" id="lamina3_grm2" value="<?php echo $lamina3_grm2; ?>">
<?php
}elseif($lamina3_factor_micra>0){
	$lamina3_material=seleccionTabla($lamina3_factor_material, "id_factor", "syCoesa_mantenimiento_factor_conversion", $conexion);
	$lamina3_grm2=$lamina3_factor_micra * $lamina3_material["factor"];
?>
	<label for="lamina3_grm2">GR / M2</label>
    <input class="w100 texto_der" name="lamina3_grm2" type="text" id="lamina3_grm2" value="<?php echo $lamina3_grm2; ?>">
<?php
}

?>