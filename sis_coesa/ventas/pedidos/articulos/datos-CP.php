<?php
session_start();
require_once("../../../../connect/conexion.php");
require_once("../../../../connect/function.php");
require_once("../../../../connect/sesion/verificar_sesion.php");

//VARIABLES
$producto=$_POST["producto"];
$pedido=$_POST["pedido"];
$cliente=$_POST["cliente"];
$cod_unico=$_POST["cod_unico"];
$cod_unico_final=$_POST["cod_unico_final"];

//EXTRAER DATOS DE COSTOS DE PRODUCCION
$rst_costos=mysql_query("SELECT * FROM syCoesa_costo_produccion WHERE id_articulo=$producto", $conexion);
$fila_costos=mysql_fetch_array($rst_costos);
$costos_cantcliente=$fila_costos["cantcliente"];
$costos_precio=$fila_costos["precio"];

?>
<fieldset class="alto50 w180">
    <label for="pedido_cantidad">Cantidad para cliente:</label>
    <input name="pedido_cantidad" type="text" class="an50 texto_cen w130" id="pedido_cantidad" value="<?php echo $costos_cantcliente; ?>" size="50" readonly>
</fieldset>

<fieldset class="alto50 w180">
    <label for="pedido_precio">Precio:</label>
    <input name="pedido_precio" type="text" class="an50 texto_der w130" id="pedido_precio" value="<?php echo $costos_precio; ?>" size="50" readonly>
</fieldset>