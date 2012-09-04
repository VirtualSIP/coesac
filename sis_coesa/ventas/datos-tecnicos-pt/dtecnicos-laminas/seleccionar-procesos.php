<?php
session_start();
require_once("../../../../connect/conexion.php");
require_once("../../../../connect/function.php");
require_once("../../../../connect/sesion/verificar_sesion.php");

//VARIABLES
$lamina=$_POST["lamina"];
$i=$_POST["rep"];

//SELECCIONAR LAMINA Y VERIFICAR SU TIPO DE ARTICULO
$rst_proclamina=mysql_query("SELECT * FROM syCoesa_articulo WHERE id_articulo=$lamina LIMIT 1;", $conexion);
$fila_proclamna=mysql_fetch_array($rst_proclamina);
$proclamina_tipo=$fila_proclamna["id_tipo_articulo"];
?>

<?php if($i==1){ ?>

<?php if($proclamina_tipo==6){ ?>
<fieldset class="w245">
    <label><input id="procesos_maquinas_3" class="procesos_maquinas" name="extrusion<?php echo $i;?>" type="checkbox" value="1">&nbsp;Extrusión</label>
</fieldset>
<?php } ?>

<fieldset class="w245">
    <label><input id="procesos_maquinas_4" class="procesos_maquinas" name="impresion<?php echo $i;?>" type="checkbox" value="1">&nbsp;Impresión</label>
</fieldset>
<fieldset class="w245">
    <label for="grm2_tintaseca">GR / m2 (Tinta seca)</label>
    <input class="w140 texto_der" type="text" id="grm2_tintaseca" name="grm2_tintaseca" value="0">
</fieldset>

<fieldset class="w245">
    <label><input id="procesos_maquinas_9" class="procesos_maquinas" name="rebobinado<?php echo $i;?>" type="checkbox" value="1">&nbsp;Rebobinado</label>
</fieldset>

<fieldset class="w245">
    <label><input id="procesos_maquinas_5" class="procesos_maquinas" name="bilaminado<?php echo $i;?>" type="checkbox" value="1">&nbsp;Bilaminado</label>
</fieldset>

<fieldset class="w245">
    <label><input id="procesos_maquinas_6" class="procesos_maquinas" name="trilaminado<?php echo $i;?>" type="checkbox" value="1">&nbsp;Trilaminado</label>
</fieldset>

<input name="habilitado<?php echo $i;?>" type="hidden" value="0">

<fieldset class="w245">
    <label><input id="procesos_maquinas_7" class="procesos_maquinas" name="cortefinal<?php echo $i;?>" type="checkbox" value="1">&nbsp;Corte</label>
</fieldset>

<fieldset class="w245">
    <label><input id="procesos_maquinas_8" class="procesos_maquinas" name="sellado<?php echo $i;?>" type="checkbox" value="1">&nbsp;Sellado</label>
</fieldset>
<?php } ?>

<?php if($i==2){ ?>

<?php if($proclamina_tipo==6){ ?>
<fieldset class="w245">
    <label><input id="procesos_maquinas_3" class="procesos_maquinas" name="extrusion<?php echo $i;?>" type="checkbox" value="1">&nbsp;Extrusión</label>
</fieldset>
<?php } ?>

<fieldset class="w245">
    <label><input id="procesos_maquinas_5" class="procesos_maquinas" name="bilaminado<?php echo $i;?>" type="checkbox" value="1">&nbsp;Bilaminado</label>
</fieldset>
<fieldset class="w245">
    <label for="grm2_bilaminado">GR / m2 (Adhesivo)</label>
    <input class="w140 texto_der" type="text" id="grm2_bilaminado" name="grm2_bilaminado" value="0">
</fieldset>

<fieldset class="w245">
    <label><input id="procesos_maquinas_6" class="procesos_maquinas" name="trilaminado<?php echo $i;?>" type="checkbox" value="1">&nbsp;Trilaminado</label>
</fieldset>

<input name="rebobinado<?php echo $i;?>" type="hidden" value="0">

<input name="habilitado<?php echo $i;?>" type="hidden" value="0">

<fieldset class="w245">
    <label><input id="procesos_maquinas_7" class="procesos_maquinas" name="cortefinal<?php echo $i;?>" type="checkbox" value="1">&nbsp;Corte</label>
</fieldset>

<fieldset class="w245">
    <label><input id="procesos_maquinas_8" class="procesos_maquinas" name="sellado<?php echo $i;?>" type="checkbox" value="1">&nbsp;Sellado</label>
</fieldset>
<?php } ?>

<?php if($i==3){ ?>

<?php if($proclamina_tipo==6){ ?>
<fieldset class="w245">
    <label><input id="procesos_maquinas_3" class="procesos_maquinas" name="extrusion<?php echo $i;?>" type="checkbox" value="1">&nbsp;Extrusión</label>
</fieldset>
<?php } ?>

<fieldset class="w245">
    <label><input id="procesos_maquinas_6" class="procesos_maquinas" name="trilaminado<?php echo $i;?>" type="checkbox" value="1">&nbsp;Trilaminado</label>
</fieldset>
<fieldset class="w245">
    <label for="grm2_trilaminado">GR / m2 (Adhesivo)</label>
    <input class="w140 texto_der" type="text" id="grm2_trilaminado" name="grm2_trilaminado" value="0">
</fieldset>

<input name="rebobinado<?php echo $i;?>" type="hidden" value="0">

<input name="habilitado<?php echo $i;?>" type="hidden" value="0">

<fieldset class="w245">
    <label><input id="procesos_maquinas_7" class="procesos_maquinas" name="cortefinal<?php echo $i;?>" type="checkbox" value="1">&nbsp;Corte</label>
</fieldset>

<fieldset class="w245">
    <label><input id="procesos_maquinas_8" class="procesos_maquinas" name="sellado<?php echo $i;?>" type="checkbox" value="1">&nbsp;Sellado</label>
</fieldset>
<?php } ?>