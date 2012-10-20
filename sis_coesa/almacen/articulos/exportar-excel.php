<?php
session_start();
require_once("../../../connect/conexion.php");
require_once("../../../connect/function.php");
require_once("../../../connect/sesion/verificar_sesion.php");

//ARTICULOS
$rst_articulos=mysql_query("SELECT * FROM syCoesa_articulo WHERE producto_terminado='I' AND mostrar_articulo=1 ORDER BY nombre_articulo ASC;", $conexion);

header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=insumos.xls");
header("Pragma: no-cache");
header("Expires: 0");

?>
<table cellspacing="0" cellpadding="0" border="1">
    <tr>
        <th width="600">Insumos</th>
        <th>Tipo de Articulo</th>
        <th>Grm2</th>
        <th>Ancho</th>
        <th>% Solido de Tinta</th>
        <th>Unidad de Medida</th>
        <th>Precio</th>
    </tr>
    
    <?php while($fila_articulos=mysql_fetch_array($rst_articulos)){
		$tipo_articulo=seleccionTabla($fila_articulos["id_tipo_articulo"], "id_tipo_articulo", "syCoesa_articulo_tipo", $conexion);
		$unidad_medida=seleccionTabla($fila_articulos["unidad_medida_articulo"], "id_unidad_medida", "syCoesa_unidad_medida", $conexion);
	?>
    <tr>
        <td><?php echo $fila_articulos["nombre_articulo"]; ?></td>
        <td><?php echo $tipo_articulo["nombre_tipo_articulo"]; ?></td>
        <td><?php echo $fila_articulos["grm2_articulo"]; ?></td>
        <td><?php echo $fila_articulos["ancho_articulo"]; ?></td>
        <td><?php echo $fila_articulos["solido_tinta"]; ?></td>
        <td><?php echo $unidad_medida["nombre_unidad_medida"]; ?></td>
        <td><?php echo $fila_articulos["precio_articulo"]; ?></td>
    </tr>
    <?php } ?>
 
</table>