<?php
session_start();
require_once("../../../connect/conexion.php");
require_once("../../../connect/function.php");
require_once("../../../connect/sesion/verificar_sesion.php");

//MAQUINAS
$rst_maquinas=mysql_query("SELECT * FROM syCoesa_mantenimiento_maquinas_datos WHERE mostrar_maquina=1 ORDER BY id_maquina ;", $conexion);

header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=maquinas.xls");
header("Pragma: no-cache");
header("Expires: 0");

?>
<table cellspacing="0" cellpadding="0" border="1">
    
    <tr>    
        <th width="25%">M&aacute;quinas</th>
        <th width="25%">Tipo de M&aacute;quina</th>
        <th width="25%">Merma</th>
        <th width="15%">Velocidad</th>
        <th width="15%">Tiempo de preparaci&oacute;n</th>
      	<th width="15%">Regulaci&oacute;n</th>
    	<th width="15%">Costo <br>Kw / Hora </th>
        <th width="15%">Costo <br>Hora / Hombre</th>
        <th width="15%">Depreciaci&oacute;n</th>
        <th width="15%">Gastos de F&aacute;brica</th>
    </tr>
    
    <?php while($fila_maquinas=mysql_fetch_array($rst_maquinas)){
		$maquinas_datos_id=$fila_maquinas["id_maquina_dato"];
		$maquinas_datos_merma=$fila_maquinas["merma_proceso_permitida"];
		$maquinas_datos_velocidad=$fila_maquinas["velocidad_maquina"];
		$maquinas_datos_preparacion=$fila_maquinas["preparacion_maquina"];
		$maquinas_datos_regulacion=$fila_maquinas["regulacion_maquina"];
		$maquinas_datos_costoKwHora=$fila_maquinas["costokw_hora_maquina"];
		$maquinas_datos_costoHoraHombre=$fila_maquinas["costohora_hombre_maquina"];
		$maquinas_datos_depreciacion=$fila_maquinas["costodepreciacion_hora_maquina"];
		$maquinas_datos_gastosFabrica=$fila_maquinas["gastosfabrica_hora_maquina"];
		$maquinas_datos_maquina=seleccionTabla($fila_maquinas["id_maquina"], "id_maquina", "syCoesa_mantenimiento_maquinas", $conexion);
		$maquinas_tipo=seleccionTabla($fila_maquinas["id_maquina_tipo"], "id_maquina_tipo", "syCoesa_mantenimiento_maquinas_tipo", $conexion);
	?>
	<tr>
		<td class="texto_izq"><?php echo $maquinas_datos_maquina["nombre_maquina"]; ?></td>
        <td class="texto_izq"><?php echo $maquinas_tipo["nombre_tipo_maquina"]; ?></td>
        <td class="center"><?php echo $maquinas_datos_merma; ?></td>
        <td class="center"><?php echo $maquinas_datos_velocidad; ?></td>
        <td class="center"><?php echo $maquinas_datos_preparacion; ?></td>
        <td class="center"><?php echo $maquinas_datos_regulacion; ?></td>
		<td class="center"><?php echo $maquinas_datos_costoKwHora; ?></td>
		<td class="center"><?php echo $maquinas_datos_costoHoraHombre; ?></td>
		<td class="center"><?php echo $maquinas_datos_depreciacion; ?></td>
		<td class="center"><?php echo $maquinas_datos_gastosFabrica; ?></td>
	</tr>
	<?php } ?>
 
</table>