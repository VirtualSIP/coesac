<?php
session_start();
require_once("../../../connect/conexion.php");
require_once("../../../connect/function.php");
require_once("../../../connect/sesion/verificar_sesion.php");

//VARIABLES
$cilindro=seleccionTabla($_POST["cilindro"], "id_cilindro", "syCoesa_mantenimiento_cilindro", $conexion);
$repeticion=round($_POST["repeticion"]);

//FORMULA
$Frecuencia=$cilindro["cilindro"] / $repeticion;
?>
<fieldset class="alto50 w180">
  <label for="dtecnicos_frecuencia">Frecuencia (mm):</label>
  <input name="dtecnicos_frecuencia" type="text" id="dtecnicos_frecuencia" class="w130" value="<?php echo round($Frecuencia); ?>" readonly>
</fieldset>