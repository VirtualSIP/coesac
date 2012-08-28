<?php
session_start();
require_once("../../../connect/conexion.php");
require_once("../../../connect/function.php");
require_once("../../../connect/sesion/verificar_sesion.php");

//VARIABLES
$maquina=$_POST["maquina"];
$extrusion1=$_POST["extrusion1"];
$extrusion2=$_POST["extrusion2"];
$extrusion3=$_POST["extrusion3"];
$proc_impresion=$_POST["impresion"];
$proc_bilaminado=$_POST["bilaminado"];
$proc_trilaminado=$_POST["trilaminado"];
$proc_cortefinal=$_POST["cortefinal"];
$proc_sellado=$_POST["sellado"];
$proc_habilitado=$_POST["habilitado"];
$proc_rebobinado=$_POST["rebobinado"];
$impresion1=$_POST["impresion1"];
$impresion2=$_POST["impresion2"];
$impresion3=$_POST["impresion3"];
$bilaminado1=$_POST["bilaminado1"];
$bilaminado2=$_POST["bilaminado2"];
$bilaminado3=$_POST["bilaminado3"];
$trilaminado1=$_POST["trilaminado1"];
$trilaminado2=$_POST["trilaminado2"];
$trilaminado3=$_POST["trilaminado3"];
$cortefinal1=$_POST["cortefinal1"];
$cortefinal2=$_POST["cortefinal2"];
$cortefinal3=$_POST["cortefinal3"];

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
$costoKwHora=(($tiempo)/60) * $costokw_hora;
$costoHoraHomb=(($tiempo)/60) * $costohora_hombre;
$costoDeprec=(($tiempo)/60) * $costodepreciacion_hora;
$costoFabrica=(($tiempo)/60) * $gastosfabrica_hora;
$costoTotal=$costoKwHora + $costoHoraHomb + $costoDeprec + $costoFabrica;

//AGREGANDO METROS DE PROCESO + METROS A PRODUCIR
if($proc_sellado>0){ //SELLADO
	$procprod_merma_sellado=seleccionTabla("'sellado'", "url", "syCoesa_mantenimiento_procesos_productivos", $conexion);
	$mtrprod_sellado=$mtrprod + ($mtrprod * ($procprod_merma_sellado["merma_proceso"] / 100));
}else{ $mtrprod_sellado=0; $procprod_merma_sellado=0; }

if($proc_habilitado>0){ //HABILITADO
	$mtrprod_habilitado=$mtrprod_sellado;
}else{ $mtrprod_habilitado=0; }

if($proc_cortefinal>0){ //CORTE FINAL
	$procprod_merma_cortefinal=seleccionTabla("'corte-final'", "url", "syCoesa_mantenimiento_procesos_productivos", $conexion);
	$mtrprod_cortefinal=($mtrprod + ($mtrprod * ($procprod_merma_cortefinal["merma_proceso"] / 100)));
}else{ $mtrprod_cortefinal=0; $procprod_merma_cortefinal=0; }

if($proc_trilaminado>0){ //TRILAMINADO
	$procprod_merma_trilaminado=seleccionTabla("'trilaminado'", "url", "syCoesa_mantenimiento_procesos_productivos", $conexion);
	$mtrprod_trilaminado=($mtrprod + $procprod_merma_trilaminado["merma_proceso"]) + ($mtrprod * ($procprod_merma_sellado["merma_proceso"] / 100)) + ($mtrprod * ($procprod_merma_cortefinal["merma_proceso"] / 100));
}else{ $mtrprod_trilaminado=0; $procprod_merma_trilaminado=0; }

if($proc_bilaminado>0){ //BILAMINADO
	$procprod_merma_bilaminado=seleccionTabla("'bilaminado'", "url", "syCoesa_mantenimiento_procesos_productivos", $conexion);
	$mtrprod_bilaminado=($mtrprod + $procprod_merma_bilaminado["merma_proceso"]) + ($procprod_merma_trilaminado["merma_proceso"]) + ($mtrprod * ($procprod_merma_sellado["merma_proceso"] / 100)) + ($mtrprod * ($procprod_merma_cortefinal["merma_proceso"] / 100));
}else{ $mtrprod_bilaminado=0; $procprod_merma_bilaminado=0; }

if($proc_rebobinado>0){ //REBOBINADO
	$mtrprod_rebobinado=$mtrprod_bilaminado;
}else{ $mtrprod_rebobinado=0; }

if($proc_impresion>0){ //IMPRESION
	$procprod_merma=seleccionTabla("'impresion'", "url", "syCoesa_mantenimiento_procesos_productivos", $conexion);
	$mtrprod_impresion=($mtrprod + ($procprod_merma["merma_proceso"] * $cant_colores)) + ($procprod_merma_bilaminado["merma_proceso"]) + ($procprod_merma_trilaminado["merma_proceso"]) + ($mtrprod * ($procprod_merma_sellado["merma_proceso"] / 100)) + ($mtrprod * ($procprod_merma_cortefinal["merma_proceso"] / 100));
}else{ $mtrprod_impresion=0; }

//TOTAL DE KILOS DE EXTRUSION
if($extrusion1>0 or $extrusion2>0 or $extrusion3>0){
	
	$procprod_merma=seleccionTabla("'extrusion'", "url", "syCoesa_mantenimiento_procesos_productivos", $conexion);
	
	if($extrusion1>0){
		if($impresion1>0){
			//LAMINA 1
			$selecLamina1=seleccionTabla($_POST["dt_articulo1"], "id_articulo", "syCoesa_articulo", $conexion);
			$mtrprod=(($mtrprod_impresion * ($selecLamina1["ancho_articulo"] * $selecLamina1["grm2_articulo"])) / 1000000) + $procprod_merma["merma_proceso"];
		}elseif($bilaminado1>0){
			//LAMINA 1
			$selecLamina4=seleccionTabla($_POST["dt_articulo1"], "id_articulo", "syCoesa_articulo", $conexion);
			$mtrprod=(($mtrprod_bilaminado * ($selecLamina4["ancho_articulo"] * $selecLamina4["grm2_articulo"])) / 1000000) + $procprod_merma["merma_proceso"];
		}elseif($trilaminado1>0){
			//LAMINA 1
			$selecLamina7=seleccionTabla($_POST["dt_articulo1"], "id_articulo", "syCoesa_articulo", $conexion);
			$mtrprod=(($mtrprod_trilaminado * ($selecLamina7["ancho_articulo"] * $selecLamina7["grm2_articulo"])) / 1000000) + $procprod_merma["merma_proceso"];
		}elseif($cortefinal1>0){
			//LAMINA 1
			$selecLamina10=seleccionTabla($_POST["dt_articulo1"], "id_articulo", "syCoesa_articulo", $conexion);
			$mtrprod=(($mtrprod_cortefinal * ($selecLamina10["ancho_articulo"] * $selecLamina10["grm2_articulo"])) / 1000000) + $procprod_merma["merma_proceso"];
		}
	}elseif($extrusion2>0){
		if($impresion2>0){
			//LAMINA 2
			$selecLamina2=seleccionTabla($_POST["dt_articulo2"], "id_articulo", "syCoesa_articulo", $conexion);
			$mtrprod=(($mtrprod_impresion * ($selecLamina2["ancho_articulo"] * $selecLamina2["grm2_articulo"])) / 1000000) + $procprod_merma["merma_proceso"];
		}elseif($bilaminado2>0){
			//LAMINA 2
			$selecLamina5=seleccionTabla($_POST["dt_articulo2"], "id_articulo", "syCoesa_articulo", $conexion);
			$mtrprod=(($mtrprod_bilaminado * ($selecLamina5["ancho_articulo"] * $selecLamina5["grm2_articulo"])) / 1000000) + $procprod_merma["merma_proceso"];
		}elseif($trilaminado2>0){
			//LAMINA 2
			$selecLamina8=seleccionTabla($_POST["dt_articulo2"], "id_articulo", "syCoesa_articulo", $conexion);
			$mtrprod=(($mtrprod_trilaminado * ($selecLamina8["ancho_articulo"] * $selecLamina8["grm2_articulo"])) / 1000000) + $procprod_merma["merma_proceso"];
		}elseif($cortefinal2>0){
			//LAMINA 2
			$selecLamina11=seleccionTabla($_POST["dt_articulo2"], "id_articulo", "syCoesa_articulo", $conexion);
			$mtrprod=(($mtrprod_cortefinal * ($selecLamina11["ancho_articulo"] * $selecLamina11["grm2_articulo"])) / 1000000) + $procprod_merma["merma_proceso"];
		}
	}elseif($extrusion3>0){
		if($impresion3>0){
			//LAMINA 3
			$selecLamina3=seleccionTabla($_POST["dt_articulo3"], "id_articulo", "syCoesa_articulo", $conexion);
			$mtrprod=(($mtrprod_impresion * ($selecLamina3["ancho_articulo"] * $selecLamina3["grm2_articulo"])) / 1000000) + $procprod_merma["merma_proceso"];
		}elseif($bilaminado3>0){
			//LAMINA 3
			$selecLamina6=seleccionTabla($_POST["dt_articulo3"], "id_articulo", "syCoesa_articulo", $conexion);
			$mtrprod=(($mtrprod_bilaminado * ($selecLamina6["ancho_articulo"] * $selecLamina6["grm2_articulo"])) / 1000000) + $procprod_merma["merma_proceso"];
		}elseif($trilaminado3>0){
			//LAMINA 3
			$selecLamina9=seleccionTabla($_POST["dt_articulo3"], "id_articulo", "syCoesa_articulo", $conexion);
			$mtrprod=(($mtrprod_trilaminado * ($selecLamina9["ancho_articulo"] * $selecLamina9["grm2_articulo"])) / 1000000) + $procprod_merma["merma_proceso"];
		}elseif($cortefinal3>0){
			//LAMINA 3
			$selecLamina12=seleccionTabla($_POST["dt_articulo3"], "id_articulo", "syCoesa_articulo", $conexion);
			$mtrprod=(($mtrprod_cortefinal * ($selecLamina12["ancho_articulo"] * $selecLamina12["grm2_articulo"])) / 1000000) + $procprod_merma["merma_proceso"];
		}
	}
}

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
<div style="width:6.1%; height:20px; padding:1% 0;" class="float_left texto_cen"><?php echo number_format($costoTotal, 2); ?></div>