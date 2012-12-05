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
$conversion2_factor=$_POST["conversion2_factor"];
$conversion2_grm2=$_POST["conversion2_grm2"];
$convertir2=$_POST["convertir2"];
$posicion2=$_POST["posicion2"];

//LAMINA 3
$lamina3_factor_milpul=$_POST["lam3_milpul"];
$lamina3_factor_micra=$_POST["lam3_micra"];
$lamina3_factor_material=$_POST["lam3_material"];
$lamina3_grm2=$_POST["lam3_grm2"];
$conversion3_factor=$_POST["conversion3_factor"];
$conversion3_grm2=$_POST["conversion3_grm2"];
$convertir3=$_POST["convertir3"];
$posicion3=$_POST["posicion3"];
?>
<?php if($posicion1=="OK"){ ?>
	<!-- LAMINA 1 -->
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

<?php if($posicion2=="OK"){ ?>
	<!-- LAMINA 2 -->
	<?php if($conversion2_factor==1 and $conversion2_grm2==0){
            $lamina2_material=seleccionTabla($lamina2_factor_material, "id_factor", "syCoesa_mantenimiento_factor_conversion", $conexion);
            if($lamina2_material["tipo"]==1){ ?>
        <fieldset class="alto50 w120" id="grm2_lam2">
            <label for="lamina2_grm2">GR / M2</label>
            <input class="texto_cen w90" name="lamina2_grm2" type="text" id="lamina2_grm2" value="0">
            <input name="conversion2_grm2" id="conversion2_grm2" type="hidden" value="1">
        </fieldset>
        <fieldset class="alto50 w120" id="factor_lam2">
            <label for="lamina2_milpul">Mil. Pulgada:</label>
            <input name="lamina2_milpul" type="text" class="texto_cen w90 factor_conversion_lam2" id="lamina2_milpul" value="0" readonly>
            <input name="lamina2_material" id="lamina2_material" type="hidden" value="<?php echo $lamina2_factor_material; ?>">
            <input name="lamina2_micra" id="lamina2_micra" type="hidden" value="0">
            <input name="conversion2_factor" id="conversion2_factor" type="hidden" value="0">
        </fieldset>
    <?php }elseif($lamina2_material["tipo"]==2){ ?>
        <fieldset class="alto50 w120" id="grm2_lam2">
            <label for="lamina2_grm2">GR / M2</label>
            <input class="texto_cen w90" name="lamina2_grm2" type="text" id="lamina2_grm2" value="0">
            <input name="conversion2_grm2" id="conversion2_grm2" type="hidden" value="1">
        </fieldset>
        <fieldset class="alto50 w120" id="factor_lam2">
            <label for="lamina2_micra">Micras:</label>
            <input name="lamina2_micra" type="text" class="texto_cen w90 factor_conversion_lam2" id="lamina2_micra" value="0" readonly>
            <input name="lamina2_material" id="lamina2_material" type="hidden" value="<?php echo $lamina2_factor_material; ?>">
            <input name="lamina2_milpul" id="lamina2_milpul" type="hidden" value="0">
            <input name="conversion2_factor" id="conversion2_factor" type="hidden" value="0">
        </fieldset>    
    <?php }}elseif($conversion2_factor==0 and $conversion2_grm2==1){
            $lamina2_material=seleccionTabla($lamina2_factor_material, "id_factor", "syCoesa_mantenimiento_factor_conversion", $conexion);
            if($lamina2_material["tipo"]==1){ ?>
        <fieldset class="alto50 w120" id="factor_lam2">
            <label for="lamina2_milpul">Mil. Pulgada:</label>
            <input name="lamina2_milpul" type="text" class="texto_cen w90 factor_conversion_lam2" id="lamina2_milpul" value="0" >
            <input name="lamina2_material" id="lamina2_material" type="hidden" value="<?php echo $lamina2_factor_material; ?>">
            <input name="lamina2_micra" id="lamina2_micra" type="hidden" value="0">
            <input name="conversion2_factor" id="conversion2_factor" type="hidden" value="1">
        </fieldset>
        <fieldset class="alto50 w120" id="grm2_lam2">
            <label for="lamina2_grm2">GR / M2</label>
            <input class="texto_cen w90" name="lamina2_grm2" type="text" id="lamina2_grm2" value="0" readonly>
            <input name="conversion2_grm2" id="conversion2_grm2" type="hidden" value="0">
        </fieldset>
    <?php }elseif($lamina2_material["tipo"]==2){ ?>
        <fieldset class="alto50 w120" id="factor_lam2">
            <label for="lamina2_micra">Micras:</label>
            <input name="lamina2_micra" type="text" class="texto_cen w90 factor_conversion_lam2" id="lamina2_micra" value="0">
            <input name="lamina2_material" id="lamina2_material" type="hidden" value="<?php echo $lamina2_factor_material; ?>">
            <input name="lamina2_milpul" id="lamina2_milpul" type="hidden" value="0">
            <input name="conversion2_factor" id="conversion2_factor" type="hidden" value="1">
        </fieldset>  
        <fieldset class="alto50 w120" id="grm2_lam2">
            <label for="lamina2_grm2">GR / M2</label>
            <input class="texto_cen w90" name="lamina2_grm2" type="text" id="lamina2_grm2" value="0" readonly>
            <input name="conversion2_grm2" id="conversion2_grm2" type="hidden" value="0">
        </fieldset>
    <?php }} ?>
    
<?php } ?>

<?php if($posicion3=="OK"){ ?>
	<!-- LAMINA 3 -->
	<?php if($conversion3_factor==1 and $conversion3_grm2==0){
            $lamina3_material=seleccionTabla($lamina3_factor_material, "id_factor", "syCoesa_mantenimiento_factor_conversion", $conexion);
            if($lamina3_material["tipo"]==1){ ?>
        <fieldset class="alto50 w120" id="grm2_lam3">
            <label for="lamina3_grm2">GR / M2</label>
            <input class="texto_cen w90" name="lamina3_grm2" type="text" id="lamina3_grm2" value="0">
            <input name="conversion3_grm2" id="conversion3_grm2" type="hidden" value="1">
        </fieldset>
        <fieldset class="alto50 w120" id="factor_lam3">
            <label for="lamina3_milpul">Mil. Pulgada:</label>
            <input name="lamina3_milpul" type="text" class="texto_cen w90 factor_conversion_lam3" id="lamina3_milpul" value="0" readonly>
            <input name="lamina3_material" id="lamina3_material" type="hidden" value="<?php echo $lamina3_factor_material; ?>">
            <input name="lamina3_micra" id="lamina3_micra" type="hidden" value="0">
            <input name="conversion3_factor" id="conversion3_factor" type="hidden" value="0">
        </fieldset>
    <?php }elseif($lamina3_material["tipo"]==2){ ?>
        <fieldset class="alto50 w120" id="grm2_lam3">
            <label for="lamina3_grm2">GR / M2</label>
            <input class="texto_cen w90" name="lamina3_grm2" type="text" id="lamina3_grm2" value="0">
            <input name="conversion3_grm2" id="conversion3_grm2" type="hidden" value="1">
        </fieldset>
        <fieldset class="alto50 w120" id="factor_lam3">
            <label for="lamina3_micra">Micras:</label>
            <input name="lamina3_micra" type="text" class="texto_cen w90 factor_conversion_lam3" id="lamina3_micra" value="0" readonly>
            <input name="lamina3_material" id="lamina3_material" type="hidden" value="<?php echo $lamina3_factor_material; ?>">
            <input name="lamina3_milpul" id="lamina3_milpul" type="hidden" value="0">
            <input name="conversion3_factor" id="conversion3_factor" type="hidden" value="0">
        </fieldset>    
    <?php }}elseif($conversion3_factor==0 and $conversion3_grm2==1){
            $lamina3_material=seleccionTabla($lamina3_factor_material, "id_factor", "syCoesa_mantenimiento_factor_conversion", $conexion);
            if($lamina3_material["tipo"]==1){ ?>
        <fieldset class="alto50 w120" id="factor_lam3">
            <label for="lamina3_milpul">Mil. Pulgada:</label>
            <input name="lamina3_milpul" type="text" class="texto_cen w90 factor_conversion_lam3" id="lamina3_milpul" value="0" >
            <input name="lamina3_material" id="lamina3_material" type="hidden" value="<?php echo $lamina3_factor_material; ?>">
            <input name="lamina3_micra" id="lamina3_micra" type="hidden" value="0">
            <input name="conversion3_factor" id="conversion3_factor" type="hidden" value="1">
        </fieldset>
        <fieldset class="alto50 w120" id="grm2_lam3">
            <label for="lamina3_grm2">GR / M2</label>
            <input class="texto_cen w90" name="lamina3_grm2" type="text" id="lamina3_grm2" value="0" readonly>
            <input name="conversion3_grm2" id="conversion3_grm2" type="hidden" value="0">
        </fieldset>
    <?php }elseif($lamina3_material["tipo"]==2){ ?>
        <fieldset class="alto50 w120" id="factor_lam3">
            <label for="lamina3_micra">Micras:</label>
            <input name="lamina3_micra" type="text" class="texto_cen w90 factor_conversion_lam3" id="lamina3_micra" value="0">
            <input name="lamina3_material" id="lamina2_material" type="hidden" value="<?php echo $lamina3_factor_material; ?>">
            <input name="lamina3_milpul" id="lamina3_milpul" type="hidden" value="0">
            <input name="conversion3_factor" id="conversion3_factor" type="hidden" value="1">
        </fieldset>  
        <fieldset class="alto50 w120" id="grm2_lam3">
            <label for="lamina3_grm2">GR / M2</label>
            <input class="texto_cen w90" name="lamina3_grm2" type="text" id="lamina3_grm2" value="0" readonly>
            <input name="conversion3_grm2" id="conversion3_grm2" type="hidden" value="0">
        </fieldset>
    <?php }} ?>
    
<?php } ?>

<?php if($convertir1=="OK"){ ?>
	<!-- LAMINA 1 -->
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
    <?php }}elseif($conversion1_factor==0 and $conversion1_grm2==1){
			$lamina1_material=seleccionTabla($lamina1_factor_material, "id_factor", "syCoesa_mantenimiento_factor_conversion", $conexion);
			if($lamina1_material["tipo"]==1){
				$lamina1_factor_milpul=$lamina1_grm2 / $lamina1_material["factor"];
	?>
    	<fieldset class="alto50 w120" id="grm2_lam1">
            <label for="lamina1_grm2">GR / M2</label>
            <input class="texto_cen w90" name="lamina1_grm2" type="text" id="lamina1_grm2" value="<?php echo $lamina1_grm2; ?>">
            <input name="conversion1_grm2" id="conversion1_grm2" type="hidden" value="1">
        </fieldset>
        <fieldset class="alto50 w120" id="factor_lam1">
            <label for="lamina1_milpul">Mil. Pulgada:</label>
            <input name="lamina1_milpul" type="text" class="texto_cen w90 factor_conversion_lam1" id="lamina1_milpul" value="<?php echo $lamina1_factor_milpul; ?>" readonly>
            <input name="lamina1_material" id="lamina1_material" type="hidden" value="<?php echo $lamina1_factor_material; ?>">
            <input name="lamina1_micra" id="lamina1_micra" type="hidden" value="0">
            <input name="conversion1_factor" id="conversion1_factor" type="hidden" value="0">
        </fieldset>
    <?php }elseif($lamina1_material["tipo"]==2){
			$lamina1_factor_micra=$lamina1_grm2 / $lamina1_material["factor"];
	?>
    	<fieldset class="alto50 w120" id="grm2_lam1">
            <label for="lamina1_grm2">GR / M2</label>
            <input class="texto_cen w90" name="lamina1_grm2" type="text" id="lamina1_grm2" value="<?php echo $lamina1_grm2; ?>">
            <input name="conversion1_grm2" id="conversion1_grm2" type="hidden" value="1">
        </fieldset>
    	<fieldset class="alto50 w120" id="factor_lam1">
            <label for="lamina1_micra">Micras:</label>
            <input name="lamina1_micra" type="text" class="texto_cen w90 factor_conversion_lam1" id="lamina1_micra" value="<?php echo $lamina1_factor_micra; ?>" readonly>
            <input name="lamina1_material" id="lamina1_material" type="hidden" value="<?php echo $lamina1_factor_material; ?>">
            <input name="lamina1_milpul" id="lamina1_milpul" type="hidden" value="0">
            <input name="conversion1_factor" id="conversion1_factor" type="hidden" value="0">
        </fieldset>            
    <?php }} ?>
<?php } ?>

<?php if($convertir2=="OK"){ ?>
	<!-- LAMINA 2 -->
	<?php if($conversion2_factor==1 and $conversion2_grm2==0){
            $lamina2_material=seleccionTabla($lamina2_factor_material, "id_factor", "syCoesa_mantenimiento_factor_conversion", $conexion);
            if($lamina2_material["tipo"]==1){
				$lamina2_grm2=$lamina2_factor_milpul * $lamina2_material["factor"];
	?>
        <fieldset class="alto50 w120" id="factor_lam2">
            <label for="lamina2_milpul">Mil. Pulgada:</label>
            <input name="lamina2_milpul" type="text" class="texto_cen w90 factor_conversion_lam2" id="lamina2_milpul" value="<?php echo $lamina2_factor_milpul; ?>">
            <input name="lamina2_material" id="lamina2_material" type="hidden" value="<?php echo $lamina2_factor_material; ?>">
            <input name="lamina2_micra" id="lamina2_micra" type="hidden" value="0">
            <input name="conversion2_factor" id="conversion2_factor" type="hidden" value="1">
        </fieldset>
        <fieldset class="alto50 w120" id="grm2_lam2">
            <label for="lamina2_grm2">GR / M2</label>
            <input class="texto_cen w90" name="lamina2_grm2" type="text" id="lamina2_grm2" value="<?php echo $lamina2_grm2; ?>" readonly>
            <input name="conversion2_grm2" id="conversion2_grm2" type="hidden" value="0">
        </fieldset>
    <?php }elseif($lamina2_material["tipo"]==2){
			$lamina2_grm2=$lamina2_factor_micra * $lamina2_material["factor"];
	?>
        <fieldset class="alto50 w120" id="factor_lam2">
            <label for="lamina2_micra">Micras:</label>
            <input name="lamina2_micra" type="text" class="texto_cen w90 factor_conversion_lam2" id="lamina2_micra" value="<?php echo $lamina2_factor_micra; ?>" >
            <input name="lamina2_material" id="lamina2_material" type="hidden" value="<?php echo $lamina2_factor_material; ?>">
            <input name="lamina2_milpul" id="lamina2_milpul" type="hidden" value="0">
            <input name="conversion2_factor" id="conversion2_factor" type="hidden" value="1">
        </fieldset>
        <fieldset class="alto50 w120" id="grm2_lam2">
            <label for="lamina2_grm2">GR / M2</label>
            <input class="texto_cen w90" name="lamina2_grm2" type="text" id="lamina2_grm2" value="<?php echo $lamina2_grm2; ?>" readonly>
            <input name="conversion2_grm2" id="conversion2_grm2" type="hidden" value="0">
        </fieldset>        
    <?php }}elseif($conversion2_factor==0 and $conversion2_grm2==1){
			$lamina2_material=seleccionTabla($lamina2_factor_material, "id_factor", "syCoesa_mantenimiento_factor_conversion", $conexion);
			if($lamina2_material["tipo"]==1){
				$lamina2_factor_milpul=$lamina2_grm2 / $lamina2_material["factor"];
	?>
    	<fieldset class="alto50 w120" id="grm2_lam2">
            <label for="lamina2_grm2">GR / M2</label>
            <input class="texto_cen w90" name="lamina2_grm2" type="text" id="lamina2_grm2" value="<?php echo $lamina2_grm2; ?>">
            <input name="conversion2_grm2" id="conversion2_grm2" type="hidden" value="1">
        </fieldset>
        <fieldset class="alto50 w120" id="factor_lam2">
            <label for="lamina2_milpul">Mil. Pulgada:</label>
            <input name="lamina2_milpul" type="text" class="texto_cen w90 factor_conversion_lam2" id="lamina2_milpul" value="<?php echo $lamina2_factor_milpul; ?>" readonly>
            <input name="lamina2_material" id="lamina2_material" type="hidden" value="<?php echo $lamina2_factor_material; ?>">
            <input name="lamina2_micra" id="lamina2_micra" type="hidden" value="0">
            <input name="conversion2_factor" id="conversion2_factor" type="hidden" value="0">
        </fieldset>
    <?php }elseif($lamina2_material["tipo"]==2){
			$lamina2_factor_micra=$lamina2_grm2 / $lamina2_material["factor"];
	?>
    	<fieldset class="alto50 w120" id="grm2_lam2">
            <label for="lamina2_grm2">GR / M2</label>
            <input class="texto_cen w90" name="lamina2_grm2" type="text" id="lamina2_grm2" value="<?php echo $lamina2_grm2; ?>">
            <input name="conversion2_grm2" id="conversion2_grm2" type="hidden" value="1">
        </fieldset>
    	<fieldset class="alto50 w120" id="factor_lam2">
            <label for="lamina2_micra">Micras:</label>
            <input name="lamina2_micra" type="text" class="texto_cen w90 factor_conversion_lam2" id="lamina2_micra" value="<?php echo $lamina2_factor_micra; ?>" readonly>
            <input name="lamina2_material" id="lamina2_material" type="hidden" value="<?php echo $lamina2_factor_material; ?>">
            <input name="lamina2_milpul" id="lamina2_milpul" type="hidden" value="0">
            <input name="conversion2_factor" id="conversion2_factor" type="hidden" value="0">
        </fieldset>            
    <?php }} ?>
<?php } ?>

<?php if($convertir3=="OK"){ ?>
	<!-- LAMINA 3 -->
	<?php if($conversion3_factor==1 and $conversion3_grm2==0){
            $lamina3_material=seleccionTabla($lamina3_factor_material, "id_factor", "syCoesa_mantenimiento_factor_conversion", $conexion);
            if($lamina3_material["tipo"]==1){
				$lamina3_grm2=$lamina3_factor_milpul * $lamina3_material["factor"];
	?>
        <fieldset class="alto50 w120" id="factor_lam3">
            <label for="lamina3_milpul">Mil. Pulgada:</label>
            <input name="lamina3_milpul" type="text" class="texto_cen w90 factor_conversion_lam3" id="lamina3_milpul" value="<?php echo $lamina3_factor_milpul; ?>">
            <input name="lamina3_material" id="lamina3_material" type="hidden" value="<?php echo $lamina3_factor_material; ?>">
            <input name="lamina3_micra" id="lamina3_micra" type="hidden" value="0">
            <input name="conversion3_factor" id="conversion3_factor" type="hidden" value="1">
        </fieldset>
        <fieldset class="alto50 w120" id="grm2_lam3">
            <label for="lamina3_grm2">GR / M2</label>
            <input class="texto_cen w90" name="lamina3_grm2" type="text" id="lamina3_grm2" value="<?php echo $lamina3_grm2; ?>" readonly>
            <input name="conversion3_grm2" id="conversion3_grm2" type="hidden" value="0">
        </fieldset>
    <?php }elseif($lamina3_material["tipo"]==2){
			$lamina3_grm2=$lamina3_factor_micra * $lamina3_material["factor"];
	?>
        <fieldset class="alto50 w120" id="factor_lam3">
            <label for="lamina3_micra">Micras:</label>
            <input name="lamina3_micra" type="text" class="texto_cen w90 factor_conversion_lam3" id="lamina3_micra" value="<?php echo $lamina3_factor_micra; ?>" >
            <input name="lamina3_material" id="lamina3_material" type="hidden" value="<?php echo $lamina3_factor_material; ?>">
            <input name="lamina3_milpul" id="lamina3_milpul" type="hidden" value="0">
            <input name="conversion3_factor" id="conversion3_factor" type="hidden" value="1">
        </fieldset>
        <fieldset class="alto50 w120" id="grm2_lam3">
            <label for="lamina3_grm2">GR / M2</label>
            <input class="texto_cen w90" name="lamina3_grm2" type="text" id="lamina3_grm2" value="<?php echo $lamina3_grm2; ?>" readonly>
            <input name="conversion3_grm2" id="conversion3_grm2" type="hidden" value="0">
        </fieldset>        
    <?php }}elseif($conversion3_factor==0 and $conversion3_grm2==1){
			$lamina3_material=seleccionTabla($lamina3_factor_material, "id_factor", "syCoesa_mantenimiento_factor_conversion", $conexion);
			if($lamina3_material["tipo"]==1){
				$lamina3_factor_milpul=$lamina3_grm2 / $lamina3_material["factor"];
	?>
    	<fieldset class="alto50 w120" id="grm2_lam3">
            <label for="lamina3_grm2">GR / M2</label>
            <input class="texto_cen w90" name="lamina3_grm2" type="text" id="lamina3_grm2" value="<?php echo $lamina3_grm2; ?>">
            <input name="conversion3_grm2" id="conversion3_grm2" type="hidden" value="1">
        </fieldset>
        <fieldset class="alto50 w120" id="factor_lam3">
            <label for="lamina3_milpul">Mil. Pulgada:</label>
            <input name="lamina3_milpul" type="text" class="texto_cen w90 factor_conversion_lam3" id="lamina3_milpul" value="<?php echo $lamina3_factor_milpul; ?>" readonly>
            <input name="lamina3_material" id="lamina3_material" type="hidden" value="<?php echo $lamina3_factor_material; ?>">
            <input name="lamina3_micra" id="lamina3_micra" type="hidden" value="0">
            <input name="conversion3_factor" id="conversion3_factor" type="hidden" value="0">
        </fieldset>
    <?php }elseif($lamina3_material["tipo"]==2){
			$lamina3_factor_micra=$lamina3_grm2 / $lamina3_material["factor"];
	?>
    	<fieldset class="alto50 w120" id="grm2_lam3">
            <label for="lamina3_grm2">GR / M2</label>
            <input class="texto_cen w90" name="lamina3_grm2" type="text" id="lamina3_grm2" value="<?php echo $lamina3_grm2; ?>">
            <input name="conversion3_grm2" id="conversion3_grm2" type="hidden" value="1">
        </fieldset>
    	<fieldset class="alto50 w120" id="factor_lam3">
            <label for="lamina3_micra">Micras:</label>
            <input name="lamina3_micra" type="text" class="texto_cen w90 factor_conversion_lam3" id="lamina3_micra" value="<?php echo $lamina3_factor_micra; ?>" readonly>
            <input name="lamina3_material" id="lamina3_material" type="hidden" value="<?php echo $lamina3_factor_material; ?>">
            <input name="lamina3_milpul" id="lamina3_milpul" type="hidden" value="0">
            <input name="conversion3_factor" id="conversion3_factor" type="hidden" value="0">
        </fieldset>            
    <?php }} ?>
<?php } ?>