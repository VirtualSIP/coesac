<?php
session_start();
require_once("../../../../connect/conexion.php");
require_once("../../../../connect/function.php");
require_once("../../../../connect/sesion/verificar_sesion.php");

//VARIABLES
$lamina=$_POST["lamina"];
$i=$_POST["rep"];

//VARIABLES
$lamina1=$_POST["lamina1"];
$lamina2=$_POST["lamina2"];
$lamina3=$_POST["lamina3"];

//SELECCIONAR LAMINA Y VERIFICAR SU TIPO DE ARTICULO
$rst_proclamina=mysql_query("SELECT * FROM syCoesa_articulo WHERE id_articulo=$lamina LIMIT 1;", $conexion);
$fila_proclamna=mysql_fetch_array($rst_proclamina);
$proclamina_tipo=$fila_proclamna["id_tipo_articulo"];

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

?>

<?php if($lamina1>0){ ?>

<fieldset class="w120">
    <label for="lamina1_ancho">Ancho</label>
    <input class="w100 texto_der" name="lamina1_ancho" type="text" id="lamina1_ancho" value="<?php echo $lamina1_dato["ancho_articulo"]; ?>" readonly>
</fieldset>

<fieldset class="w120">
    <label for="lamina1_grm2">GR / M2</label>
    <input class="w100 texto_der" name="lamina1_grm2" type="text" id="lamina1_grm2" value="<?php echo $lamina1_dato["grm2_articulo"] ?>" readonly>
</fieldset>

<?php if($filtro1_polietileno==1 or $filtro1_pebd==1 or $filtro1_pead==1 or $filtro1_ppp==1){ ?>
<fieldset class="w245">
    <label><input id="procesos_maquinas_3" class="procesos_maquinas" name="extrusion1" type="checkbox" value="1">&nbsp;Extrusión</label>
</fieldset>
<?php }?>

<fieldset class="w245">
    <label><input id="procesos_maquinas_4" class="procesos_maquinas" name="impresion1" type="checkbox" value="1">&nbsp;Impresión</label>
</fieldset>
<fieldset class="w245">
    <label for="grm2_tintaseca">GR / M2 (Tinta seca)</label>
    <input class="w140 texto_der" name="grm2_tintaseca" type="text" id="grm2_tintaseca" value="0">
</fieldset>

<fieldset class="w245">
    <label><input id="procesos_maquinas_9" class="procesos_maquinas" name="rebobinado1" type="checkbox" value="1">&nbsp;Rebobinado</label>
</fieldset>
<?php } ?>

<?php if($lamina2>0){ ?>

<fieldset class="w120">
    <label for="lamina2_ancho">Ancho</label>
    <input class="w100 texto_der" name="lamina2_ancho" type="text" id="lamina2_ancho" value="<?php echo $lamina2_dato["ancho_articulo"]; ?>" readonly>
</fieldset>

<fieldset class="w120">
    <label for="lamina2_grm2">GR / M2</label>
    <input class="w100 texto_der" name="lamina2_grm2" type="text" id="lamina2_grm2" value="<?php echo $lamina2_dato["grm2_articulo"] ?>" readonly>
</fieldset>

<?php if($filtro2_polietileno==1 or $filtro2_pebd==1 or $filtro2_pead==1 or $filtro2_ppp==1){ ?>
<fieldset class="w245">
    <label><input id="procesos_maquinas_3" class="procesos_maquinas" name="extrusion2" type="checkbox" value="1">&nbsp;Extrusión</label>
</fieldset>
<?php } ?>

<input id="procesos_maquinas_5" name="bilaminado2" type="hidden" value="1">

<fieldset class="w245">
    <label for="grm2_bilaminado">GR / m2 (Adhesivo)</label>
    <input class="w140 texto_der" name="grm2_bilaminado" type="text" id="grm2_bilaminado" value="0">
</fieldset>

<input name="rebobinado2" type="hidden" value="0">
<?php } ?>

<?php if($lamina3>0){ ?>

<fieldset class="w120">
    <label for="lamina3_ancho">Ancho</label>
    <input class="w100 texto_der" name="lamina3_ancho" type="text" id="lamina3_ancho" value="<?php echo $lamina3_dato["ancho_articulo"]; ?>" readonly>
</fieldset>

<fieldset class="w120">
    <label for="lamina3_grm2">GR / M2</label>
    <input class="w100 texto_der" name="lamina3_grm2" type="text" id="lamina3_grm2" value="<?php echo $lamina3_dato["grm2_articulo"] ?>" readonly>
</fieldset>

<?php if($filtro3_polietileno==1 or $filtro3_pebd==1 or $filtro3_pead==1 or $filtro3_ppp==1){ ?>
<fieldset class="w245">
    <label><input id="procesos_maquinas_3" class="procesos_maquinas" name="extrusion3" type="checkbox" value="1">&nbsp;Extrusión</label>
</fieldset>
<?php } ?>

<input id="procesos_maquinas_6" name="trilaminado3" type="hidden" value="1">

<fieldset class="w245">
    <label for="grm2_trilaminado">GR / m2 (Adhesivo)</label>
    <input class="w140 texto_der" name="grm2_trilaminado" type="text" id="grm2_trilaminado" value="0">
</fieldset>

<input name="rebobinado3" type="hidden" value="0">
<?php } ?>