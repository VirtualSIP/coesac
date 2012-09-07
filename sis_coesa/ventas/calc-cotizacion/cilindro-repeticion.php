<?php
session_start();
require_once("../../../connect/conexion.php");
require_once("../../../connect/function.php");
require_once("../../../connect/sesion/verificar_sesion.php");

//VARIABLES
$tipo=$_POST["tipo"];
$cilindro=$_POST["cilindro"];
$distancia=$_POST["distancia"];

//AUMENTO y REDUCCION DE 3MM EN DISTANCIA
$distancia_sup=$distancia + 3;
$distancia_inf=$distancia - 3;

//CILINDROS
$rst_cilindro=mysql_query("SELECT * FROM syCoesa_mantenimiento_cilindro WHERE cilindro>=$distancia_inf AND cilindro<=$distancia_sup ORDER BY cilindro ASC;", $conexion);

//VARIABLES
$cilindro=seleccionTabla($cilindro, "id_cilindro", "syCoesa_mantenimiento_cilindro", $conexion);

//FORMULA
$repeticion=round($cilindro["cilindro"] / $distancia);

?>
<?php if($tipo=="cilindro"){ ?>
<!-- CILINDRO -->
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script>
var jCil=jQuery.noConflict();
jCil(document).ready(function(){	
	jCil("#dtecnicos_cilindro").change(function(){
		jCil("#progressbar").removeClass("ocultar");
		var cilindro = jCil(this).val();
		var distancia = jCil("#dtecnicos_repeticion").val();
		var tipo = "repeticion";
		jCil.post("cilindro-repeticion.php", {distancia: distancia, cilindro: cilindro, tipo: tipo},
			function(data){
				jCil("#dato_nrorepeticion").html(data);
				jCil("#progressbar").addClass("ocultar");
			});
	});	
});
</script>
<fieldset class="alto50 w180">
    <label for="dtecnicos_cilindro">Cilindro (mm):</label>
    <select name="dtecnicos_cilindro" id="dtecnicos_cilindro" class="w140">
        <option value>Seleccione</option>
        <?php while($fila_cilindro=mysql_fetch_array($rst_cilindro)){
            $cilindro_id=$fila_cilindro["id_cilindro"];
            $cilindro_nombre=$fila_cilindro["cilindro"]."/".$fila_cilindro["engranaje"];
        ?>
        <option value="<?php echo $cilindro_id; ?>"><?php echo $cilindro_nombre; ?></option>
        <?php } ?>
    </select>
</fieldset>	
<?php }elseif($tipo=="repeticion"){ ?>
<fieldset class="alto50 w180">
  <label for="dtecnicos_frecuencia">Nro de Repeticiones (Und):</label>
  <input name="dtecnicos_frecuencia" type="text" id="dtecnicos_frecuencia" class="w130" value="<?php echo $repeticion; ?>" readonly>
</fieldset>
<?php } ?>