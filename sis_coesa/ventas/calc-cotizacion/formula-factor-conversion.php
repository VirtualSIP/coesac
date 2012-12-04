<?php
session_start();
require_once("../../../connect/conexion.php");
require_once("../../../connect/function.php");
require_once("../../../connect/sesion/verificar_sesion.php");

/*VARIABLES DE MILESIMA DE PULGADA Y MICRA*/
//LAMINA 1
$lamina1_factor_milpul=$_POST["lam1_milpul"];
$lamina1_factor_micra=$_POST["lam1_micra"];
$lamina1_factor_material=$_POST["lam1_material"];
$lamina1_grm2=$_POST["lam1_grm2"];
$conversion1_factor=$_POST["conversion1_factor"];
$conversion1_grm2=$_POST["conversion1_grm2"];
$convertir1=$_POST["convertir1"];
$posicion1=$_POST["posicion1"];

//LAMINA 2
$lamina2_factor_milpul=$_POST["lam2_milpul"];
$lamina2_factor_micra=$_POST["lam2_micra"];
$lamina2_factor_material=$_POST["lam2_material"];
$lamina2_grm2=$_POST["lam2_grm2"];

//LAMINA 3
$lamina3_factor_milpul=$_POST["lam3_milpul"];
$lamina3_factor_micra=$_POST["lam3_micra"];
$lamina3_factor_material=$_POST["lam3_material"];
$lamina3_grm2=$_POST["lam3_grm2"];
?>
<?php if($posicion1=="OK"){ ?>
	<?php if($conversion1_factor==1 and $conversion1_grm2==0){
            $lamina1_material=seleccionTabla($lamina1_factor_material, "id_factor", "syCoesa_mantenimiento_factor_conversion", $conexion);
            if($lamina1_material["tipo"]==1){ ?>
        <fieldset class="alto50 w120" id="grm2_lam1">
            <label for="lamina1_grm2">GR / M2</label>
            <input class="texto_cen w90" name="lamina1_grm2" type="text" id="lamina1_grm2" value="0">
            <input name="conversion1_grm2" id="conversion1_grm2" type="hidden" value="1">
        </fieldset>
        <fieldset class="alto50 w120" id="factor_lam1">
            <label for="lamina1_milpul">Mil. Pulgada:</label>
            <input name="lamina1_milpul" type="text" class="texto_cen w90 factor_conversion_lam1" id="lamina1_milpul" value="0" readonly>
            <input name="lamina1_material" id="lamina1_material" type="hidden" value="<?php echo $lamina1_factor_material; ?>">
            <input name="lamina1_micra" id="lamina1_micra" type="hidden" value="0">
            <input name="conversion1_factor" id="conversion1_factor" type="hidden" value="0">
        </fieldset>
    <?php }elseif($lamina1_material["tipo"]==2){ ?>
        <fieldset class="alto50 w120" id="grm2_lam1">
            <label for="lamina1_grm2">GR / M2</label>
            <input class="texto_cen w90" name="lamina1_grm2" type="text" id="lamina1_grm2" value="0">
            <input name="conversion1_grm2" id="conversion1_grm2" type="hidden" value="1">
        </fieldset>
        <fieldset class="alto50 w120" id="factor_lam1">
            <label for="lamina1_micra">Micras:</label>
            <input name="lamina1_micra" type="text" class="texto_cen w90 factor_conversion_lam1" id="lamina1_micra" value="0" readonly>
            <input name="lamina1_material" id="lamina1_material" type="hidden" value="<?php echo $lamina1_factor_material; ?>">
            <input name="lamina1_milpul" id="lamina1_milpul" type="hidden" value="0">
            <input name="conversion1_factor" id="conversion1_factor" type="hidden" value="0">
        </fieldset>    
    <?php }}elseif($conversion1_factor==0 and $conversion1_grm2==1){
            $lamina1_material=seleccionTabla($lamina1_factor_material, "id_factor", "syCoesa_mantenimiento_factor_conversion", $conexion);
            if($lamina1_material["tipo"]==1){ ?>
        <fieldset class="alto50 w120" id="factor_lam1">
            <label for="lamina1_milpul">Mil. Pulgada:</label>
            <input name="lamina1_milpul" type="text" class="texto_cen w90 factor_conversion_lam1" id="lamina1_milpul" value="0" >
            <input name="lamina1_material" id="lamina1_material" type="hidden" value="<?php echo $lamina1_factor_material; ?>">
            <input name="lamina1_micra" id="lamina1_micra" type="hidden" value="0">
            <input name="conversion1_factor" id="conversion1_factor" type="hidden" value="1">
        </fieldset>
        <fieldset class="alto50 w120" id="grm2_lam1">
            <label for="lamina1_grm2">GR / M2</label>
            <input class="texto_cen w90" name="lamina1_grm2" type="text" id="lamina1_grm2" value="0" readonly>
            <input name="conversion1_grm2" id="conversion1_grm2" type="hidden" value="0">
        </fieldset>
    <?php }elseif($lamina1_material["tipo"]==2){ ?>
        <fieldset class="alto50 w120" id="factor_lam1">
            <label for="lamina1_micra">Micras:</label>
            <input name="lamina1_micra" type="text" class="texto_cen w90 factor_conversion_lam1" id="lamina1_micra" value="0">
            <input name="lamina1_material" id="lamina1_material" type="hidden" value="<?php echo $lamina1_factor_material; ?>">
            <input name="lamina1_milpul" id="lamina1_milpul" type="hidden" value="0">
            <input name="conversion1_factor" id="conversion1_factor" type="hidden" value="1">
        </fieldset>  
        <fieldset class="alto50 w120" id="grm2_lam1">
            <label for="lamina1_grm2">GR / M2</label>
            <input class="texto_cen w90" name="lamina1_grm2" type="text" id="lamina1_grm2" value="0" readonly>
            <input name="conversion1_grm2" id="conversion1_grm2" type="hidden" value="0">
        </fieldset>
    <?php }} ?>
<?php } ?>

<?php if($convertir1=="OK"){ ?>
	<?php if($conversion1_factor==1 and $conversion1_grm2==0){
            $lamina1_material=seleccionTabla($lamina1_factor_material, "id_factor", "syCoesa_mantenimiento_factor_conversion", $conexion);
            if($lamina1_material["tipo"]==1){
				$lamina1_grm2=$lamina1_factor_milpul * $lamina1_material["factor"];
	?>
        <fieldset class="alto50 w120" id="factor_lam1">
            <label for="lamina1_milpul">Mil. Pulgada:</label>
            <input name="lamina1_milpul" type="text" class="texto_cen w90 factor_conversion_lam1" id="lamina1_milpul" value="<?php echo $lamina1_factor_milpul; ?>">
            <input name="lamina1_material" id="lamina1_material" type="hidden" value="<?php echo $lamina1_factor_material; ?>">
            <input name="lamina1_micra" id="lamina1_micra" type="hidden" value="0">
            <input name="conversion1_factor" id="conversion1_factor" type="hidden" value="1">
        </fieldset>
        <fieldset class="alto50 w120" id="grm2_lam1">
            <label for="lamina1_grm2">GR / M2</label>
            <input class="texto_cen w90" name="lamina1_grm2" type="text" id="lamina1_grm2" value="<?php echo $lamina1_grm2; ?>" readonly>
            <input name="conversion1_grm2" id="conversion1_grm2" type="hidden" value="0">
        </fieldset>
    <?php }elseif($lamina1_material["tipo"]==2){
			$lamina1_grm2=$lamina1_factor_micra * $lamina1_material["factor"];
	?>
        <fieldset class="alto50 w120" id="factor_lam1">
            <label for="lamina1_micra">Micras:</label>
            <input name="lamina1_micra" type="text" class="texto_cen w90 factor_conversion_lam1" id="lamina1_micra" value="<?php echo $lamina1_factor_micra; ?>" >
            <input name="lamina1_material" id="lamina1_material" type="hidden" value="<?php echo $lamina1_factor_material; ?>">
            <input name="lamina1_milpul" id="lamina1_milpul" type="hidden" value="0">
            <input name="conversion1_factor" id="conversion1_factor" type="hidden" value="1">
        </fieldset>
        <fieldset class="alto50 w120" id="grm2_lam1">
            <label for="lamina1_grm2">GR / M2</label>
            <input class="texto_cen w90" name="lamina1_grm2" type="text" id="lamina1_grm2" value="<?php echo $lamina1_grm2; ?>" readonly>
            <input name="conversion1_grm2" id="conversion1_grm2" type="hidden" value="0">
        </fieldset>        
    <?php } ?>
    <?php } ?>
<?php } ?>