<?php
session_start();
require_once("../../../connect/conexion.php");
require_once("../../../connect/function.php");
require_once("../../../connect/sesion/verificar_sesion.php");

//VARIABLES
$maquina=$_POST["maquina"];

//LAMINAS
$lamina1=seleccionTabla($_POST["dt_articulo1"], "id_articulo", "syCoesa_articulo", $conexion);
$lamina2=seleccionTabla($_POST["dt_articulo2"], "id_articulo", "syCoesa_articulo", $conexion);
$lamina3=seleccionTabla($_POST["dt_articulo3"], "id_articulo", "syCoesa_articulo", $conexion);

//PROCESOS
$proc_impresion=$_POST["impresion"];
$proc_bilaminado=$_POST["bilaminado"];
$proc_trilaminado=$_POST["trilaminado"];
$proc_cortefinal=$_POST["cortefinal"];
$proc_sellado=$_POST["sellado"];
$proc_rebobinado=$_POST["rebobinado"];

//SELECCION DE PROCESOS
$extrusion1=$_POST["extrusion1"];
$extrusion2=$_POST["extrusion2"];
$extrusion3=$_POST["extrusion3"];
$impresion1=$_POST["impresion1"];
$bilaminado2=$_POST["bilaminado2"];
$trilaminado3=$_POST["trilaminado3"];
$cortefinal1=$_POST["cortefinal1"];
$cortefinal2=$_POST["cortefinal2"];
$cortefinal3=$_POST["cortefinal3"];

//OTRAS VARIABLES
$nrobandas=$_POST["nrobandas"];
$repeticion=$_POST["repeticion"];
$colores=$_POST["colores"];
$mtrprod=round($_POST["metroproducir"]);
$unidad_medida=$_POST["unidadmedida"];

//SELECCIONAR DATOS DE MAQUINA
$rst_maquina=mysql_query("SELECT * FROM syCoesa_mantenimiento_maquinas_datos WHERE id_maquina=$maquina AND mostrar_maquina=1", $conexion);
$fila_maquina=mysql_fetch_array($rst_maquina);

//VARIABLES
if($extrusion1>0 or $extrusion2>0 or $extrusion3>0){ $preparacion=HoraMinuto($fila_maquina["preparacion_maquina"]);
}elseif($proc_impresion>0){ $preparacion=Sumar2TiemposColores($fila_maquina["preparacion_maquina"], "00:00:00", $colores);
}else{ $preparacion=HoraMinuto($fila_maquina["preparacion_maquina"]); }
$regulacion=HoraMinuto($fila_maquina["regulacion_maquina"]);
$velocidad=$fila_maquina["velocidad_maquina"];
$costokw_hora=$fila_maquina["costokw_hora_maquina"];
$costohora_hombre=$fila_maquina["costohora_hombre_maquina"];
$costodepreciacion_hora=$fila_maquina["costodepreciacion_hora_maquina"];
$gastosfabrica_hora=$fila_maquina["gastosfabrica_hora_maquina"];

//TIEMPO
$tiempo=round($mtrprod / $velocidad);
$metros=$mtrprod;

//MULTIPLICAR EL TIEMPO POR LOS COSTOS
$proc_prep_reg=Sumar2Tiempos($preparacion, $regulacion);
$proc_tiempo_num=round(Division2Num($mtrprod, $velocidad));
$proc_tiempo=NumAHora($proc_tiempo_num);
$proc_tiempo_produc=Sumar2Tiempos($proc_prep_reg, $proc_tiempo);
$proc_total_horahombre=number_format(CostoLamina($proc_tiempo_produc, $costohora_hombre), 2);
$proc_total_kwhora=number_format(CostoLamina(($proc_tiempo_produc), $costokw_hora), 2);
$proc_total_deprec=number_format(CostoLamina(($proc_tiempo_produc), $costodepreciacion_hora), 2);
$proc_total_gastos=number_format(CostoLamina(($proc_tiempo_produc), $gastosfabrica_hora), 2);
$proc_total_depgas=number_format($proc_total_deprec + $proc_total_gastos, 2);
$costoTotal=($proc_total_horahombre + $proc_total_kwhora + $proc_total_deprec + $proc_total_gastos);

?>
<div style="width:8%; height:20px; padding:1% 0;" class="float_left texto_cen"><?php echo round($mtrprod); ?></div>
<div style="width:8%; height:20px; padding:1% 0;" class="float_left texto_cen"><?php echo $velocidad; ?></div>
<div style="width:8.3%; height:20px; padding:1% 0;" class="float_left texto_cen"><?php echo $preparacion; ?></div>
<div style="width:8.3%; height:20px; padding:1% 0;" class="float_left texto_cen"><?php echo $regulacion; ?></div>
<div style="width:8%; height:20px; padding:1% 0;" class="float_left texto_cen"><?php echo NumAHora($tiempo); ?></div>
<div style="width:8%; height:20px; padding:1% 0;" class="float_left texto_cen"><?php echo $costokw_hora; ?></div>
<div style="width:8%; height:20px; padding:1% 0;" class="float_left texto_cen"><?php echo $costohora_hombre; ?></div>
<div style="width:8%; height:20px; padding:1% 0;" class="float_left texto_cen"><?php echo $costodepreciacion_hora; ?></div>
<div style="width:8%; height:20px; padding:1% 0;" class="float_left texto_cen"><?php echo $gastosfabrica_hora; ?></div>
<div style="width:6.1%; height:20px; padding:1% 0;" class="float_left texto_cen"><?php echo number_format($costoTotal, 3); ?></div>