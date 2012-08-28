<?php
//VARIABLES
$anchoFinal=$_POST["anchofinal"];
$anchoMax=$_POST["anchomax"];

//NRO DE BANDAS = (ANCHO MAX / ANCHO FINAL)
$nroBandas=($anchoMax / $anchoFinal)
?>
<label for="dtecnicos_numbandas">Número de bandas:</label>
<select name="dtecnicos_numbandas" id="dtecnicos_numbandas" class="w140">
    <option value>Seleccione</option>
    <?php for($i=1; $i<=$nroBandas; $i++){ ?>
    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
    <?php } ?>
</select>