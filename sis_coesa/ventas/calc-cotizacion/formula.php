<?php
session_start();
require_once("../../../connect/conexion.php");
require_once("../../../connect/function.php");
require_once("../../../connect/sesion/verificar_sesion.php");

//VARIABLES
$anchoFinal=$_POST["anchofinal"];
$anchoMax=$_POST["anchomax"];

//NRO DE BANDAS = (ANCHO MAX / ANCHO FINAL)
$nroBandas=($anchoMax / $anchoFinal)
?>
<!-- SELECCIONAR LAMINAS -->
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script>
var jlamproc = jQuery.noConflict();
jlamproc(document).ready(function(){
	jlamproc("#dtecnicos_numbandas").change(function(){
		jlamproc("#progressbar").removeClass("ocultar");
		var anchofinal = jlamproc("#dtecnicos_anchofinal").val();
		var nrobandas = jlamproc("select#dtecnicos_numbandas option:selected").val();
		jlamproc.post("seleccionar-laminas.php", {anchofinal: anchofinal, nrobandas: nrobandas},
			function(data){
				jlamproc("#progressbar").addClass("ocultar");
				jlamproc("#datos_lamproc").html(data);
			});
	});
});
</script>
<label for="dtecnicos_numbandas">Número de bandas:</label>
<select name="dtecnicos_numbandas" id="dtecnicos_numbandas" class="w140">
    <option value>Seleccione</option>
    <?php for($i=1; $i<=$nroBandas; $i++){ ?>
    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
    <?php } ?>
</select>