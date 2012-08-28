<?php
session_start();
require_once("../../../connect/conexion.php");
require_once("../../../connect/function.php");
require_once("../../../connect/sesion/verificar_sesion.php");

//VARIABLES
$maquina=$_POST["maquina"];

//SELECCIONAR DATOS DE MAQUINA
$rst_maquina=mysql_query("SELECT * FROM syCoesa_mantenimiento_maquinas_datos WHERE id_maquina=$maquina AND mostrar_maquina=1", $conexion);
$fila_maquina=mysql_fetch_array($rst_maquina);

//VARIABLES
$preparacion=$fila_maquina["preparacion_maquina"];
$regulacion=$fila_maquina["regulacion_maquina"];
$velocidad=$fila_maquina["velocidad_maquina"];
$costokw_hora=$fila_maquina["costokw_hora_maquina"];
$costohora_hombre=$fila_maquina["costohora_hombre_maquina"];
$costodepreciacion_hora=$fila_maquina["costodepreciacion_hora_maquina"];
$gastosfabrica_hora=$fila_maquina["gastosfabrica_hora_maquina"];
$mtrprod=round($_POST["metroproducir"]);

//TIEMPO
$tiempo=round($mtrprod / $velocidad);

//MULTIPLICAR EL TIEMPO POR LOS COSTOS
$costoKwHora=$tiempo * $costokw_hora;
$costoHoraHomb=$tiempo * $costohora_hombre;
$costoDeprec=$tiempo * $costodepreciacion_hora;
$costoFabrica=$tiempo * $gastosfabrica_hora;
$costoTotal=$costoKwHora + $costoHoraHomb + $costoDeprec + $costoFabrica;

?>
<div style="width:8%; height:20px; padding:1% 0;" class="float_left texto_cen"><?php echo $mtrprod; ?></div>
<div style="width:8%; height:20px; padding:1% 0;" class="float_left texto_cen"><?php echo $velocidad; ?></div>
<div style="width:8.3%; height:20px; padding:1% 0;" class="float_left texto_cen"><?php echo $preparacion; ?></div>
<div style="width:8.3%; height:20px; padding:1% 0;" class="float_left texto_cen"><?php echo $regulacion; ?></div>
<div style="width:8%; height:20px; padding:1% 0;" class="float_left texto_cen"><?php echo NumAHora($tiempo); ?></div>
<div style="width:8%; height:20px; padding:1% 0;" class="float_left texto_cen"><?php echo $costokw_hora; ?></div>
<div style="width:8%; height:20px; padding:1% 0;" class="float_left texto_cen"><?php echo $costohora_hombre; ?></div>
<div style="width:8%; height:20px; padding:1% 0;" class="float_left texto_cen"><?php echo $costodepreciacion_hora; ?></div>
<div style="width:8%; height:20px; padding:1% 0;" class="float_left texto_cen"><?php echo $gastosfabrica_hora; ?></div>
<div style="width:6.1%; height:20px; padding:1% 0;" class="float_left texto_cen"><?php echo number_format($costoTotal, 2); ?></div>