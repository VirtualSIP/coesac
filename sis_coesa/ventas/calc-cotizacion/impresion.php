<?php
session_start();
require_once("../../../connect/conexion.php");
require_once("../../../connect/function.php");
require_once("../../../connect/sesion/verificar_sesion.php");

//VARIABLES
$idImpresion=$_REQUEST["imp"];

//EXTRAER DATOS
$impresion=seleccionTabla($idImpresion, "id_cotizacion", "syCoesa_cotizacion", $conexion);
$impresion_cliente=$impresion["cliente_cotizacion"];
$impresion_producto=$impresion["producto_cotizacion"];
$impresion_grm2=$impresion["grm2_cotizacion"];
$impresion_repeticion=$impresion["repeticion_cotizacion"];
$impresion_frecuencia=$impresion["frecuencia_cotizacion"];
$impresion_cilindro=seleccionTabla($impresion["cilindro_cotizacion"], "id_cilindro", "syCoesa_mantenimiento_cilindro", $conexion);
$impresion_anchofinal=$impresion["ancho_final_cotizacion"];
$impresion_nrobandas=$impresion["nrobandas_cotizacion"];
$impresion_nrocolores=$impresion["nrocolores_cotizacion"];
$impresion_cantcliente=$impresion["cantcliente_cotizacion"];
$impresion_tolerancia=$impresion["tolerancia_cotizacion"];
$impresion_unidadmedida=seleccionTabla($impresion["unidad_medida_cotizacion"], "id_unidad_medida", "syCoesa_unidad_medida", $conexion);
$impresion_precio=$impresion["precio_cotizacion"];

$impresion_lamina1=seleccionTabla($impresion["lamina1_cotizacion"], "id_articulo", "syCoesa_articulo", $conexion);
$impresion_lamina1_extrusion=$impresion["extrusion1_cotizacion"];
$impresion_lamina1_impresion=$impresion["impresion1_cotizacion"];
$impresion_lamina1_impresion_grm2=$impresion["impresion1_grm2_cotizacion"];
$impresion_lamina1_bilaminado=$impresion["bilaminado1_cotizacion"];
$impresion_lamina1_bilaminado_grm2=$impresion["bilaminado1_grm2_cotizacion"];
$impresion_lamina1_trilaminado=$impresion["trilaminado1_cotizacion"];
$impresion_lamina1_trilaminado_grm2=$impresion["trilaminado1_grm2_cotizacion"];
$impresion_lamina1_rebobinado=$impresion["rebobinado1_cotizacion"];
$impresion_lamina1_habilitado=$impresion["habilitado1_cotizacion"];
$impresion_lamina1_cortefinal=$impresion["cortefinal1_cotizacion"];
$impresion_lamina1_sellado=$impresion["sellado1_cotizacion"];

$impresion_lamina2=seleccionTabla($impresion["lamina2_cotizacion"], "id_articulo", "syCoesa_articulo", $conexion);
$impresion_lamina2_extrusion=$impresion["extrusion2_cotizacion"];
$impresion_lamina2_impresion=$impresion["impresion2_cotizacion"];
$impresion_lamina2_impresion_grm2=$impresion["impresion2_grm2_cotizacion"];
$impresion_lamina2_bilaminado=$impresion["bilaminado2_cotizacion"];
$impresion_lamina2_bilaminado_grm2=$impresion["bilaminado2_grm2_cotizacion"];
$impresion_lamina2_trilaminado=$impresion["trilaminado2_cotizacion"];
$impresion_lamina2_trilaminado_grm2=$impresion["trilaminado2_grm2_cotizacion"];
$impresion_lamina2_rebobinado=$impresion["rebobinado2_cotizacion"];
$impresion_lamina2_habilitado=$impresion["habilitado2_cotizacion"];
$impresion_lamina2_cortefinal=$impresion["cortefinal2_cotizacion"];
$impresion_lamina2_sellado=$impresion["sellado2_cotizacion"];

$impresion_lamina3=seleccionTabla($impresion["lamina3_cotizacion"], "id_articulo", "syCoesa_articulo", $conexion);
$impresion_lamina3_extrusion=$impresion["extrusion3_cotizacion"];
$impresion_lamina3_impresion=$impresion["impresion3_cotizacion"];
$impresion_lamina3_impresion_grm2=$impresion["impresion3_grm2_cotizacion"];
$impresion_lamina3_bilaminado=$impresion["bilaminado3_cotizacion"];
$impresion_lamina3_bilaminado_grm2=$impresion["bilaminado3_grm2_cotizacion"];
$impresion_lamina3_trilaminado=$impresion["trilaminado3_cotizacion"];
$impresion_lamina3_trilaminado_grm2=$impresion["trilaminado3_grm2_cotizacion"];
$impresion_lamina3_rebobinado=$impresion["rebobinado3_cotizacion"];
$impresion_lamina3_habilitado=$impresion["habilitado3_cotizacion"];
$impresion_lamina3_cortefinal=$impresion["cortefinal3_cotizacion"];
$impresion_lamina3_sellado=$impresion["sellado3_cotizacion"];
$impresion_grm2total=$impresion["grm2total_cotizacion"];
$impresion_cantproduccion=$impresion["cantproduccion_cotizacion"];
$impresion_metrosproducir=$impresion["metrosproducir_cotizacion"];

//PROCESOS DE LAMINAS
$rst_proc_extrusion=mysql_query("SELECT * FROM syCoesa_mantenimiento_maquinas_datos WHERE id_maquina=".$impresion["proc_extrusion_maq_cotizacion"]." AND mostrar_maquina=1;", $conexion);
$proc_extrusion=mysql_fetch_array($rst_proc_extrusion);
$proc_extrusion_nombre=seleccionTabla($proc_extrusion["id_maquina"], "id_maquina", "syCoesa_mantenimiento_maquinas", $conexion);

$rst_proc_impresion=mysql_query("SELECT * FROM syCoesa_mantenimiento_maquinas_datos WHERE id_maquina=".$impresion["proc_impresion_maq_cotizacion"]." AND mostrar_maquina=1;", $conexion);
$proc_impresion=mysql_fetch_array($rst_proc_impresion);
$proc_impresion_nombre=seleccionTabla($proc_impresion["id_maquina"], "id_maquina", "syCoesa_mantenimiento_maquinas", $conexion);

$rst_proc_bilaminado=mysql_query("SELECT * FROM syCoesa_mantenimiento_maquinas_datos WHERE id_maquina=".$impresion["proc_bilaminado_maq_cotizacion"]." AND mostrar_maquina=1;", $conexion);
$proc_bilaminado=mysql_fetch_array($rst_proc_bilaminado);
$proc_bilaminado_nombre=seleccionTabla($proc_bilaminado["id_maquina"], "id_maquina", "syCoesa_mantenimiento_maquinas", $conexion);

$rst_proc_trilaminado=mysql_query("SELECT * FROM syCoesa_mantenimiento_maquinas_datos WHERE id_maquina=".$impresion["proc_trilaminado_maq_cotizacion"]." AND mostrar_maquina=1;", $conexion);
$proc_trilaminado=mysql_fetch_array($rst_proc_trilaminado);
$proc_trilaminado_nombre=seleccionTabla($proc_trilaminado["id_maquina"], "id_maquina", "syCoesa_mantenimiento_maquinas", $conexion);

$rst_proc_rebobinado=mysql_query("SELECT * FROM syCoesa_mantenimiento_maquinas_datos WHERE id_maquina=".$impresion["proc_rebobinado_maq_cotizacion"]." AND mostrar_maquina=1;", $conexion);
$proc_rebobinado=mysql_fetch_array($rst_proc_rebobinado);
$proc_rebobinado_nombre=seleccionTabla($proc_rebobinado["id_maquina"], "id_maquina", "syCoesa_mantenimiento_maquinas", $conexion);

$rst_proc_habilitado=mysql_query("SELECT * FROM syCoesa_mantenimiento_maquinas_datos WHERE id_maquina=".$impresion["proc_habilitado_maq_cotizacion"]." AND mostrar_maquina=1;", $conexion);
$proc_habilitado=mysql_fetch_array($rst_proc_habilitado);
$proc_habilitado_nombre=seleccionTabla($proc_habilitado["id_maquina"], "id_maquina", "syCoesa_mantenimiento_maquinas", $conexion);

$rst_proc_cortefinal=mysql_query("SELECT * FROM syCoesa_mantenimiento_maquinas_datos WHERE id_maquina=".$impresion["proc_cortefinal_maq_cotizacion"]." AND mostrar_maquina=1;", $conexion);
$proc_cortefinal=mysql_fetch_array($rst_proc_cortefinal);
$proc_cortefinal_nombre=seleccionTabla($proc_cortefinal["id_maquina"], "id_maquina", "syCoesa_mantenimiento_maquinas", $conexion);

$rst_proc_cortefinal=mysql_query("SELECT * FROM syCoesa_mantenimiento_maquinas_datos WHERE id_maquina=".$impresion["proc_sellado_maq_cotizacion"]." AND mostrar_maquina=1;", $conexion);
$proc_sellado=mysql_fetch_array($rst_proc_cortefinal);
$proc_sellado_nombre=seleccionTabla($proc_sellado["id_maquina"], "id_maquina", "syCoesa_mantenimiento_maquinas", $conexion);

//INSUMOS
$insumo_tinta=seleccionTabla($impresion["insumo_tinta"], "id_articulo", "syCoesa_articulo", $conexion);
$insumo_bilaminado=seleccionTabla($impresion["insumo_bilaminado"], "id_articulo", "syCoesa_articulo", $conexion);
$insumo_trilaminado=seleccionTabla($impresion["insumo_trilaminado"], "id_articulo", "syCoesa_articulo", $conexion);
$insumo_cushion=seleccionTabla($impresion["insumo_cushion"], "id_articulo", "syCoesa_articulo", $conexion);
$insumo_clises=seleccionTabla($impresion["insumo_clises"], "id_articulo", "syCoesa_articulo", $conexion);

//VARIABLES
$mtrprod=$impresion_metrosproducir;
$cant_colores=$impresion_nrocolores;

//AGREGANDO METROS DE PROCESO + METROS A PRODUCIR
if($proc_sellado>0){ //SELLADO
	$procprod_merma_sellado=seleccionTabla("'sellado'", "url", "syCoesa_mantenimiento_procesos_productivos", $conexion);
	$mtrprod_sellado=$mtrprod + ($mtrprod * ($procprod_merma_sellado["merma_proceso"] / 100));
	$proc_sellado_merma=round($mtrprod * ($procprod_merma_sellado["merma_proceso"] / 100));
}else{ $mtrprod_sellado=0; $procprod_merma_sellado=0; }

if($proc_habilitado>0){ //HABILITADO
	$mtrprod_habilitado=$mtrprod_sellado;
	$proc_habilitado_merma=round($mtrprod * ($procprod_merma_sellado["merma_proceso"] / 100));
}else{ $mtrprod_habilitado=0; }

if($proc_cortefinal>0){ //CORTE FINAL
	$procprod_merma_cortefinal=seleccionTabla("'corte-final'", "url", "syCoesa_mantenimiento_procesos_productivos", $conexion);
	$mtrprod_cortefinal=($mtrprod + ($mtrprod * ($procprod_merma_cortefinal["merma_proceso"] / 100)));
	$proc_cortefinal_merma=round($mtrprod * ($procprod_merma_cortefinal["merma_proceso"] / 100));
}else{ $mtrprod_cortefinal=0; $procprod_merma_cortefinal=0; }

if($proc_trilaminado>0){ //TRILAMINADO
	$procprod_merma_trilaminado=seleccionTabla("'trilaminado'", "url", "syCoesa_mantenimiento_procesos_productivos", $conexion);
	$mtrprod_trilaminado=($mtrprod + $procprod_merma_trilaminado["merma_proceso"]) + ($mtrprod * ($procprod_merma_sellado["merma_proceso"] / 100)) + ($mtrprod * ($procprod_merma_cortefinal["merma_proceso"] / 100));
	$proc_trilaminado_merma=round($procprod_merma_trilaminado["merma_proceso"]);
}else{ $mtrprod_trilaminado=0; $procprod_merma_trilaminado=0; }

if($proc_bilaminado>0){ //BILAMINADO
	$procprod_merma_bilaminado=seleccionTabla("'bilaminado'", "url", "syCoesa_mantenimiento_procesos_productivos", $conexion);
	$mtrprod_bilaminado=($mtrprod + $procprod_merma_bilaminado["merma_proceso"]) + ($procprod_merma_trilaminado["merma_proceso"]) + ($mtrprod * ($procprod_merma_sellado["merma_proceso"] / 100)) + ($mtrprod * ($procprod_merma_cortefinal["merma_proceso"] / 100));
	$proc_bilaminado_merma=round($procprod_merma_bilaminado["merma_proceso"]);
}else{ $mtrprod_bilaminado=0; $procprod_merma_bilaminado=0; }

if($proc_rebobinado>0){ //REBOBINADO	
	$mtrprod_rebobinado=$mtrprod_bilaminado;
	$proc_rebobinado_merma=round($procprod_merma_bilaminado["merma_proceso"]);
}else{ $mtrprod_rebobinado=0; }

if($proc_impresion>0){ //IMPRESION
	$procprod_merma=seleccionTabla("'impresion'", "url", "syCoesa_mantenimiento_procesos_productivos", $conexion);
	$mtrprod_impresion=($mtrprod + ($procprod_merma["merma_proceso"] * $cant_colores)) + ($procprod_merma_bilaminado["merma_proceso"]) + ($procprod_merma_trilaminado["merma_proceso"]) + ($mtrprod * ($procprod_merma_sellado["merma_proceso"] / 100)) + ($mtrprod * ($procprod_merma_cortefinal["merma_proceso"] / 100));
	$proc_impresion_merma=round($procprod_merma["merma_proceso"] * $cant_colores);
}else{ $mtrprod_impresion=0; }

//TOTAL DE KILOS DE EXTRUSION
if($extrusion1>0 or $extrusion2>0 or $extrusion3>0){
	
	$procprod_merma=seleccionTabla("'extrusion'", "url", "syCoesa_mantenimiento_procesos_productivos", $conexion);
	
	if($extrusion1>0){
		if($impresion1>0){
			//LAMINA 1
			$mtrprod_extrusion=(($mtrprod_impresion * ($impresion_lamina1["ancho_articulo"] * $impresion_lamina1["grm2_articulo"])) / 1000000) + $procprod_merma["merma_proceso"];
		}elseif($bilaminado1>0){
			//LAMINA 1
			$mtrprod_extrusion=(($mtrprod_bilaminado * ($impresion_lamina1["ancho_articulo"] * $impresion_lamina1["grm2_articulo"])) / 1000000) + $procprod_merma["merma_proceso"];
		}elseif($trilaminado1>0){
			//LAMINA 1
			$mtrprod_extrusion=(($mtrprod_trilaminado * ($impresion_lamina1["ancho_articulo"] * $impresion_lamina1["grm2_articulo"])) / 1000000) + $procprod_merma["merma_proceso"];
		}elseif($cortefinal1>0){
			//LAMINA 1
			$mtrprod_extrusion=(($mtrprod_cortefinal * ($impresion_lamina1["ancho_articulo"] * $impresion_lamina1["grm2_articulo"])) / 1000000) + $procprod_merma["merma_proceso"];
		}
	}elseif($extrusion2>0){
		if($bilaminado2>0){
			//LAMINA 2
			$mtrprod_extrusion=(($mtrprod_bilaminado * ($impresion_lamina2["ancho_articulo"] * $impresion_lamina2["grm2_articulo"])) / 1000000) + $procprod_merma["merma_proceso"];
		}elseif($trilaminado2>0){
			//LAMINA 2
			$mtrprod_extrusion=(($mtrprod_trilaminado * ($impresion_lamina2["ancho_articulo"] * $impresion_lamina2["grm2_articulo"])) / 1000000) + $procprod_merma["merma_proceso"];
		}elseif($cortefinal2>0){
			//LAMINA 2
			$mtrprod_extrusion=(($mtrprod_cortefinal * ($impresion_lamina2["ancho_articulo"] * $impresion_lamina2["grm2_articulo"])) / 1000000) + $procprod_merma["merma_proceso"];
		}
	}elseif($extrusion3>0){
		if($trilaminado3>0){
			//LAMINA 3
			$mtrprod_extrusion=(($mtrprod_trilaminado * ($impresion_lamina3["ancho_articulo"] * $impresion_lamina3["grm2_articulo"])) / 1000000) + $procprod_merma["merma_proceso"];
		}elseif($cortefinal3>0){
			//LAMINA 3
			$mtrprod_extrusion=(($mtrprod_cortefinal * ($impresion_lamina3["ancho_articulo"] * $impresion_lamina3["grm2_articulo"])) / 1000000) + $procprod_merma["merma_proceso"];
		}
	}
}

//AGREGANDO METROS DE PROCESO + METROS A PRODUCIR PARA LAS LAMINAS SELECCIONADAS
if($proc_trilaminado>0){ //TRILAMINADO
	$procprod_merma_trilaminado=seleccionTabla("'trilaminado'", "url", "syCoesa_mantenimiento_procesos_productivos", $conexion);
	$mtrprod_lamina_trilaminado=round((($mtrprod + $procprod_merma_trilaminado["merma_proceso"]) * $impresion_lamina3["grm2_articulo"] * $impresion_lamina3["ancho_articulo"]) / 1000000);
}else{ $mtrprod_lamina_trilaminado=0; }

if($proc_bilaminado>0){ //BILAMINADO
	$procprod_merma_bilaminado=seleccionTabla("'bilaminado'", "url", "syCoesa_mantenimiento_procesos_productivos", $conexion);
	$mtrprod_lamina_bilaminado=round((($mtrprod + $procprod_merma_bilaminado["merma_proceso"]) * $impresion_lamina2["grm2_articulo"] * $impresion_lamina2["ancho_articulo"]) / 1000000);
}else{ $mtrprod_lamina_bilaminado=0; }

if($proc_impresion>0){ //IMPRESION
	$procprod_merma=seleccionTabla("'impresion'", "url", "syCoesa_mantenimiento_procesos_productivos", $conexion);
	$mtrprod_lamina_impresion=((($mtrprod + ($procprod_merma["merma_proceso"] * $cant_colores)) * $impresion_lamina1["grm2_articulo"] * $impresion_lamina1["ancho_articulo"]) / 1000000);;
}else{ $mtrprod_lamina_impresion=0; }

//FORMULA GRM2 TINTA LIQUIDA
$rst_grm2tlq=mysql_query("SELECT * FROM syCoesa_articulo WHERE id_tipo_articulo=2;", $conexion);
$num_grm2tlq=mysql_num_rows($rst_grm2tlq);
$suma_grm2tlq=0;
while($fila_grm2tlq=mysql_fetch_array($rst_grm2tlq)){ $suma_grm2tlq=$fila_grm2tlq["solido_tinta"] + $suma_grm2tlq; }
$TotalTintaLiquida=$impresion_lamina1_impresion_grm2 + ($suma_grm2tlq / $num_grm2tlq);

//VARIABLES PARA EXTRUSION
$proc_extrusion_prep_reg=Sumar2Tiempos($proc_extrusion["preparacion_maquina"], $proc_extrusion["regulacion_maquina"]);
$proc_extrusion_tiempo_num=round(Division2Num($mtrprod_extrusion, $proc_extrusion["velocidad_maquina"]));
$proc_extrusion_tiempo=NumAHora($proc_extrusion_tiempo_num);
$proc_extrusion_tiempo_produc=Sumar2Tiempos($proc_extrusion_prep_reg, $proc_extrusion_tiempo);
$proc_extrusion_total_horahombre=number_format(CostoLamina(($proc_extrusion_tiempo_produc), $proc_extrusion["costohora_hombre_maquina"]), 2);
$proc_extrusion_total_kwhora=number_format(CostoLamina(($proc_extrusion_tiempo_produc), $proc_extrusion["costokw_hora_maquina"]), 2);
$proc_extrusion_total_deprec=number_format(CostoLamina(($proc_extrusion_tiempo_produc), $proc_extrusion["costodepreciacion_hora_maquina"]), 2);
$proc_extrusion_total_gastos=number_format(CostoLamina(($proc_extrusion_tiempo_produc), $proc_extrusion["gastosfabrica_hora_maquina"]), 2);
$proc_extrusion_total_depgas=number_format($proc_extrusion_total_deprec + $proc_extrusion_total_gastos, 2);
$proc_extrusion_total_costo=($proc_extrusion_total_horahombre + $proc_extrusion_total_kwhora + $proc_extrusion_total_deprec + $proc_extrusion_total_gastos);

//VARIABLES PARA IMPRESION
$proc_impresion_prep_reg=Sumar2Tiempos($proc_impresion["preparacion_maquina"], $proc_impresion["regulacion_maquina"]);
$proc_impresion_tiempo_num=round(Division2Num($mtrprod_impresion, $proc_impresion["velocidad_maquina"]));
$proc_impresion_tiempo=NumAHora($proc_impresion_tiempo_num);
$proc_impresion_tiempo_produc=Sumar2Tiempos($proc_impresion_prep_reg, $proc_impresion_tiempo);
$proc_impresion_total_horahombre=number_format(CostoLamina(($proc_impresion_tiempo_produc), $proc_impresion["costohora_hombre_maquina"]), 2);
$proc_impresion_total_kwhora=number_format(CostoLamina(($proc_impresion_tiempo_produc), $proc_impresion["costokw_hora_maquina"]), 2);
$proc_impresion_total_deprec=number_format(CostoLamina(($proc_impresion_tiempo_produc), $proc_impresion["costodepreciacion_hora_maquina"]), 2);
$proc_impresion_total_gastos=number_format(CostoLamina(($proc_impresion_tiempo_produc), $proc_impresion["gastosfabrica_hora_maquina"]), 2);
$proc_impresion_total_depgas=number_format($proc_impresion_total_deprec + $proc_impresion_total_gastos, 2);
$proc_impresion_total_costo=($proc_impresion_total_horahombre + $proc_impresion_total_kwhora + $proc_impresion_total_deprec + $proc_impresion_total_gastos);

//VARIABLES PARA BILAMINADO
$proc_bilaminado_prep_reg=Sumar2Tiempos($proc_bilaminado["preparacion_maquina"], $proc_bilaminado["regulacion_maquina"]);
$proc_bilaminado_tiempo_num=round(Division2Num($mtrprod_bilaminado, $proc_bilaminado["velocidad_maquina"]));
$proc_bilaminado_tiempo=NumAHora($proc_bilaminado_tiempo_num);
$proc_bilaminado_tiempo_produc=Sumar2Tiempos($proc_bilaminado_prep_reg, $proc_bilaminado_tiempo);
$proc_bilaminado_total_horahombre=number_format(CostoLamina(($proc_bilaminado_tiempo_produc), $proc_bilaminado["costohora_hombre_maquina"]), 2);
$proc_bilaminado_total_kwhora=number_format(CostoLamina(($proc_bilaminado_tiempo_produc), $proc_bilaminado["costokw_hora_maquina"]), 2);
$proc_bilaminado_total_deprec=number_format(CostoLamina(($proc_bilaminado_tiempo_produc), $proc_bilaminado["costodepreciacion_hora_maquina"]), 2);
$proc_bilaminado_total_gastos=number_format(CostoLamina(($proc_bilaminado_tiempo_produc), $proc_bilaminado["gastosfabrica_hora_maquina"]), 2);
$proc_bilaminado_total_depgas=number_format($proc_bilaminado_total_deprec + $proc_bilaminado_total_gastos, 2);
$proc_bilaminado_total_costo=($proc_bilaminado_total_horahombre + $proc_bilaminado_total_kwhora + $proc_bilaminado_total_deprec + $proc_bilaminado_total_gastos);

//VARIABLES PARA TRILAMINADO
$proc_trilaminado_prep_reg=Sumar2Tiempos($proc_trilaminado["preparacion_maquina"], $proc_trilaminado["regulacion_maquina"]);
$proc_trilaminado_tiempo_num=round(Division2Num($mtrprod_trilaminado, $proc_trilaminado["velocidad_maquina"]));
$proc_trilaminado_tiempo=NumAHora($proc_trilaminado_tiempo_num);
$proc_trilaminado_tiempo_produc=Sumar2Tiempos($proc_trilaminado_prep_reg, $proc_trilaminado_tiempo);
$proc_trilaminado_total_horahombre=number_format(CostoLamina(($proc_trilaminado_tiempo_produc), $proc_trilaminado["costohora_hombre_maquina"]), 2);
$proc_trilaminado_total_kwhora=number_format(CostoLamina(($proc_trilaminado_tiempo_produc), $proc_trilaminado["costokw_hora_maquina"]), 2);
$proc_trilaminado_total_deprec=number_format(CostoLamina(($proc_trilaminado_tiempo_produc), $proc_trilaminado["costodepreciacion_hora_maquina"]), 2);
$proc_trilaminado_total_gastos=number_format(CostoLamina(($proc_trilaminado_tiempo_produc), $proc_trilaminado["gastosfabrica_hora_maquina"]), 2);
$proc_trilaminado_total_depgas=number_format($proc_trilaminado_total_deprec + $proc_trilaminado_total_gastos, 2);
$proc_trilaminado_total_costo=($proc_trilaminado_total_horahombre + $proc_trilaminado_total_kwhora + $proc_trilaminado_total_deprec + $proc_trilaminado_total_gastos);

//VARIABLES PARA REBOBINADO
$proc_rebobinado_prep_reg=Sumar2Tiempos($proc_rebobinado["preparacion_maquina"], $proc_rebobinado["regulacion_maquina"]);
$proc_rebobinado_tiempo_num=round(Division2Num($mtrprod_rebobinado, $proc_rebobinado["velocidad_maquina"]));
$proc_rebobinado_tiempo=NumAHora($proc_rebobinado_tiempo_num);
$proc_rebobinado_tiempo_produc=Sumar2Tiempos($proc_rebobinado_prep_reg, $proc_rebobinado_tiempo);
$proc_rebobinado_total_horahombre=number_format(CostoLamina(($proc_rebobinado_tiempo_produc), $proc_rebobinado["costohora_hombre_maquina"]), 2);
$proc_rebobinado_total_kwhora=number_format(CostoLamina(($proc_rebobinado_tiempo_produc), $proc_rebobinado["costokw_hora_maquina"]), 2);
$proc_rebobinado_total_deprec=number_format(CostoLamina(($proc_rebobinado_tiempo_produc), $proc_rebobinado["costodepreciacion_hora_maquina"]), 2);
$proc_rebobinado_total_gastos=number_format(CostoLamina(($proc_rebobinado_tiempo_produc), $proc_rebobinado["gastosfabrica_hora_maquina"]), 2);
$proc_rebobinado_total_depgas=number_format($proc_rebobinado_total_deprec + $proc_rebobinado_total_gastos, 2);
$proc_rebobinado_total_costo=($proc_rebobinado_total_horahombre + $proc_rebobinado_total_kwhora + $proc_rebobinado_total_deprec + $proc_rebobinado_total_gastos);

//VARIABLES PARA HABILITADO
$proc_habilitado_prep_reg=Sumar2Tiempos($proc_habilitado["preparacion_maquina"], $proc_habilitado["regulacion_maquina"]);
$proc_habilitado_tiempo_num=round(Division2Num($mtrprod_habilitado, $proc_habilitado["velocidad_maquina"]));
$proc_habilitado_tiempo=NumAHora($proc_habilitado_tiempo_num);
$proc_habilitado_tiempo_produc=Sumar2Tiempos($proc_habilitado_prep_reg, $proc_habilitado_tiempo);
$proc_habilitado_total_horahombre=number_format(CostoLamina(($proc_habilitado_tiempo_produc), $proc_habilitado["costohora_hombre_maquina"]), 2);
$proc_habilitado_total_kwhora=number_format(CostoLamina(($proc_habilitado_tiempo_produc), $proc_habilitado["costokw_hora_maquina"]), 2);
$proc_habilitado_total_deprec=number_format(CostoLamina(($proc_habilitado_tiempo_produc), $proc_habilitado["costodepreciacion_hora_maquina"]), 2);
$proc_habilitado_total_gastos=number_format(CostoLamina(($proc_habilitado_tiempo_produc), $proc_habilitado["gastosfabrica_hora_maquina"]), 2);
$proc_habilitado_total_depgas=number_format($proc_habilitado_total_deprec + $proc_habilitado_total_gastos, 2);
$proc_habilitado_total_costo=($proc_habilitado_total_horahombre + $proc_habilitado_total_kwhora + $proc_habilitado_total_deprec + $proc_habilitado_total_gastos);

//VARIABLES PARA CORTE FINAL
$proc_cortefinal_prep_reg=Sumar2Tiempos($proc_cortefinal["preparacion_maquina"], $proc_cortefinal["regulacion_maquina"]);
$proc_cortefinal_tiempo_num=round(Division2Num($mtrprod_cortefinal, $proc_cortefinal["velocidad_maquina"]));
$proc_cortefinal_tiempo=NumAHora($proc_cortefinal_tiempo_num);
$proc_cortefinal_tiempo_produc=Sumar2Tiempos($proc_cortefinal_prep_reg, $proc_cortefinal_tiempo);
$proc_cortefinal_total_horahombre=number_format(CostoLamina(($proc_cortefinal_tiempo_produc), $proc_cortefinal["costohora_hombre_maquina"]), 2);
$proc_cortefinal_total_kwhora=number_format(CostoLamina(($proc_cortefinal_tiempo_produc), $proc_cortefinal["costokw_hora_maquina"]), 2);
$proc_cortefinal_total_deprec=number_format(CostoLamina(($proc_cortefinal_tiempo_produc), $proc_cortefinal["costodepreciacion_hora_maquina"]), 2);
$proc_cortefinal_total_gastos=number_format(CostoLamina(($proc_cortefinal_tiempo_produc), $proc_cortefinal["gastosfabrica_hora_maquina"]), 2);
$proc_cortefinal_total_depgas=number_format($proc_cortefinal_total_deprec + $proc_cortefinal_total_gastos, 2);
$proc_cortefinal_total_costo=($proc_cortefinal_total_horahombre + $proc_cortefinal_total_kwhora + $proc_cortefinal_total_deprec + $proc_cortefinal_total_gastos);

//VARIABLES PARA SELLADO
$proc_sellado_prep_reg=Sumar2Tiempos($proc_sellado["preparacion_maquina"], $proc_sellado["regulacion_maquina"]);
$proc_sellado_tiempo_num=round(Division2Num($mtrprod_sellado, $proc_sellado["velocidad_maquina"]));
$proc_sellado_tiempo=NumAHora($proc_sellado_tiempo_num);
$proc_sellado_tiempo_produc=Sumar2Tiempos($proc_sellado_prep_reg, $proc_sellado_tiempo);
$proc_sellado_total_horahombre=number_format(CostoLamina(($proc_sellado_tiempo_produc), $proc_sellado["costohora_hombre_maquina"]), 2);
$proc_sellado_total_kwhora=number_format(CostoLamina(($proc_sellado_tiempo_produc), $proc_sellado["costokw_hora_maquina"]), 2);
$proc_sellado_total_deprec=number_format(CostoLamina(($proc_sellado_tiempo_produc), $proc_sellado["costodepreciacion_hora_maquina"]), 2);
$proc_sellado_total_gastos=number_format(CostoLamina(($proc_sellado_tiempo_produc), $proc_sellado["gastosfabrica_hora_maquina"]), 2);
$proc_sellado_total_depgas=number_format($proc_sellado_total_deprec + $proc_sellado_total_gastos, 2);
$proc_sellado_total_costo=($proc_sellado_total_horahombre + $proc_sellado_total_kwhora + $proc_sellado_total_deprec + $proc_sellado_total_gastos);

//TOTAL COSTO DE PROCESOS PRODUCTIVOS
$TotalCostoProcesos=$proc_extrusion_total_costo + $proc_impresion_total_costo + $proc_bilaminado_total_costo + $proc_trilaminado_total_costo + $proc_rebobinado_total_costo + $proc_habilitado_total_costo + $proc_cortefinal_total_costo + $proc_sellado_total_costo;

//VALORES DE GRM2
$tintaseca_lamina=$impresion_lamina1_impresion_grm2;
$bilaminado_lamina=$impresion_lamina2_bilaminado_grm2;
$trilaminado_lamina=$impresion_lamina3_trilaminado_grm2;

//DATOS IMPRESION
$Lamina_impresion_refile=number_format(PorcRefile($impresion_lamina1["ancho_articulo"],$impresion_anchofinal, $impresion_nrobandas), 3);
$Lamina_impresion_total=number_format(CostoLamina($mtrprod_lamina_impresion, $impresion_lamina1["precio_articulo"]),2);

//DATOS BILAMINADO
$Lamina_bilaminado_refile=number_format(PorcRefile($impresion_lamina2["ancho_articulo"],$impresion_anchofinal, $impresion_nrobandas), 3);
$Lamina_bilaminado_total=number_format(CostoLamina($mtrprod_lamina_bilaminado, $impresion_lamina2["precio_articulo"]),2);

//DATOS TRILAMINADO
$Lamina_trilaminado_refile=number_format(PorcRefile($impresion_lamina3["ancho_articulo"],$impresion_anchofinal, $impresion_nrobandas), 3);
$Lamina_trilaminado_total=number_format(CostoLamina($mtrprod_lamina_trilaminado, $impresion_lamina3["precio_articulo"]),2);

//KG REQUERIDOS PARA INSUMOS
if($impresion["insumo_tinta"]>0){
	//TINTA
	$rst_insTinta=mysql_query("SELECT * FROM syCoesa_articulo WHERE id_articulo=".$insumo_tinta["id_articulo"].";", $conexion);
	$fila_insTinta=mysql_fetch_array($rst_insTinta);
	$insumo_id=$fila_insTinta["id_articulo"];
	$insumo_precio=$fila_insTinta["precio_articulo"];
	$porcentaje_solido=$fila_insTinta["solido_tinta"];
	
	//FORMULA: TOTAL KG = (METROSIMPRESION * (GRM2TOTAL * (ANCHOFINAL * BANDAS))/1000000)
	$totalKg = ($mtrprod_impresion * ($impresion_grm2total * ($impresion_anchofinal * $impresion_nrobandas)) / 1000000);
	
	//FORMULA: KG TINTA SECA = (GRM2TINTASECA * TOTAL KG) / TOTAL GRM2
	$KgTintaseca = ($tintaseca_lamina * $totalKg) / $impresion_grm2total;
	
	//FORMULA: CANTIDADRQ = KGTINTASECA + (KGTINTASECA * % DE TINTA SOLIDA)
	$AgregadoEstruc_tinta=($KgTintaseca + ($KgTintaseca * ($porcentaje_solido / 100)));
	
	//TOTAL DE COSTOS
	$TotalCosto_tinta=$AgregadoEstruc_tinta * $insumo_precio;
}else{ $TotalCosto_tinta=0; }

if($impresion["insumo_cushion"]>0){
	//SELECCIONAR DATOS DE MAQUINA
	$rst_insumos=mysql_query("SELECT * FROM syCoesa_articulo WHERE id_articulo=".$insumo_cushion["id_articulo"].";", $conexion);
	$fila_insumos=mysql_fetch_array($rst_insumos);
	$insumo_precio=$fila_insumos["precio_articulo"];
	
	//FORMULA: CANTIDADRQ = (((ANCHOFINAL * BANDAS) / 10) * (REPETICION * FRECUENCIA) / 10) * (NROCOLORES * 1.15)
	$AgregadoEstruc_cushion=( ( ( ($impresion_anchofinal / 10) * $impresion_nrobandas) * ( ($impresion_repeticion / 10 ) * $impresion_frecuencia) ) * 1.10);
	
	//TOTAL DE COSTOS
	$TotalCosto_cushion=($AgregadoEstruc_cushion * $insumo_precio) * $impresion_nrocolores;
}else{ $TotalCosto_cushion=0; }

if($impresion["insumo_clises"]>0){
	//SELECCIONAR DATOS DE MAQUINA
	$rst_insumos=mysql_query("SELECT * FROM syCoesa_articulo WHERE id_articulo=".$insumo_clises["id_articulo"].";", $conexion);
	$fila_insumos=mysql_fetch_array($rst_insumos);
	$insumo_precio=$fila_insumos["precio_articulo"];
	
	//FORMULA: CANTIDADRQ = (((ANCHOFINAL * BANDAS) / 10) * (REPETICION * FRECUENCIA) / 10) * (NROCOLORES * 1.15)
	$AgregadoEstruc_clises=( ( ( ($impresion_anchofinal / 10) * $impresion_nrobandas) * ( ($impresion_repeticion / 10 ) * $impresion_frecuencia) ) * 1.10);
	
	//TOTAL DE COSTOS
	$TotalCosto_clises=($AgregadoEstruc_clises * $insumo_precio) * $impresion_nrocolores;
}else{ $TotalCosto_clises=0; }

if($impresion["insumo_bilaminado"]>0){
	//SELECCIONAR DATOS DE MAQUINA
	$rst_insumos=mysql_query("SELECT * FROM syCoesa_articulo WHERE id_articulo=".$insumo_bilaminado["id_articulo"].";", $conexion);
	$fila_insumos=mysql_fetch_array($rst_insumos);
	$insumo_precio=$fila_insumos["precio_articulo"];
	
	//FORMULA: TOTAL KG = (METROSIMPRESION * (GRM2TOTAL * (ANCHOFINAL * BANDAS))/1000000)
	$totalKg = ($mtrprod_bilaminado * ($impresion_grm2total * ($impresion_anchofinal * $impresion_nrobandas)) / 1000000);
	
	//FORMULA: KG TINTA SECA = (GRM2TINTASECA * TOTAL KG) / TOTAL GRM2
	$AgregadoEstruc_bilaminado = ($bilaminado_lamina * $totalKg) / $impresion_grm2total;
	
	//TOTAL DE COSTOS
	$TotalCosto_bilaminado=$AgregadoEstruc_bilaminado * $insumo_precio;
}else{ $TotalCosto_bilaminado=0; }

if($impresion["insumo_trilaminado"]>0){
	//SELECCIONAR DATOS DE MAQUINA
	$rst_insumos=mysql_query("SELECT * FROM syCoesa_articulo WHERE id_articulo=".$insumo_trilaminado["id_articulo"].";", $conexion);
	$fila_insumos=mysql_fetch_array($rst_insumos);
	$insumo_precio=$fila_insumos["precio_articulo"];
	
	//FORMULA: TOTAL KG = (METROSIMPRESION * (GRM2TOTAL * (ANCHOFINAL * BANDAS))/1000000)
	$totalKg = ($mtrprod_trilaminado * ($impresion_grm2total * ($impresion_anchofinal * $impresion_nrobandas)) / 1000000);
	
	//FORMULA: KG TINTA SECA = (GRM2TINTASECA * TOTAL KG) / TOTAL GRM2
	$AgregadoEstruc_trilaminado = (($trilaminado_lamina * $totalKg) / $impresion_grm2total);
	
	//TOTAL DE COSTOS
	$TotalCosto_trilaminado=$AgregadoEstruc_trilaminado * $insumo_precio;
}else{ $TotalCosto_trilaminado=0; }

//TOTAL COSTO DE MATERIALES (INSUMOS Y LAMINAS)
$totalCostoMaterial=$Lamina_impresion_total + $Lamina_bilaminado_total + $Lamina_trilaminado_total + $TotalCosto_tinta + $TotalCosto_bilaminado + $TotalCosto_trilaminado + $TotalCosto_cushion + $TotalCosto_clises;

//CANTIDAD REQUERIDA POR EL CLIENTE. CONVERSION DE MILLAR A KILOS
if($impresion_unidadmedida["id_unidad_medida"]==3){
	$factorConversion=($impresion_anchofinal * $impresion_repeticion * $impresion_grm2total) / 1000000;
	$impresion_cantcliente=$impresion_cantcliente * $factorConversion;
}else{
	$impresion_cantcliente=$impresion_cantcliente;
}

//RESUMEN
$TotalResumenCostos=($totalCostoMaterial + $TotalCostoProcesos) / $impresion_cantcliente;
$TotalResumenUtilidad=$impresion_precio - $TotalResumenCostos;

$TotalFinal=$TotalResumenCostos + $TotalResumenUtilidad;

//RESULTADOS PARA GRAFICO PIE
$grafCostoMaterial=$totalCostoMaterial / $TotalFinal;
$grafCostoProceso=$TotalCostoProcesos / $TotalFinal;
$grafUtilidad=$TotalResumenUtilidad / $TotalFinal;

//TOTALES DE PROCESOS
//TIEMPOS
if($proc_extrusion==""){ $proc_extrusion_prep_reg="00:00:00"; $proc_extrusion_tiempo_produc="00:00:00"; }
if($proc_impresion==""){ $proc_impresion_prep_reg="00:00:00"; $proc_impresion_tiempo_produc="00:00:00"; }
if($proc_bilaminado==""){ $proc_bilaminado_prep_reg="00:00:00"; $proc_bilaminado_tiempo_produc="00:00:00"; }
if($proc_trilaminado==""){ $proc_trilaminado_prep_reg="00:00:00"; $proc_trilaminado_tiempo_produc="00:00:00"; }
if($proc_habilitado==""){ $proc_habilitado_prep_reg="00:00:00"; $proc_habilitado_tiempo_produc="00:00:00"; }
if($proc_rebobinado==""){ $proc_rebobinado_prep_reg="00:00:00"; $proc_rebobinado_tiempo_produc="00:00:00"; }
if($proc_cortefinal==""){ $proc_cortefinal_prep_reg="00:00:00"; $proc_cortefinal_tiempo_produc="00:00:00"; }
if($proc_sellado==""){ $proc_sellado_prep_reg="00:00:00"; $proc_sellado_tiempo_produc="00:00:00"; }
$TotalPrepReg=Sumar2Tiempos(Sumar2Tiempos(Sumar2Tiempos($proc_extrusion_prep_reg, $proc_impresion_prep_reg), Sumar2Tiempos($proc_bilaminado_prep_reg, $proc_trilaminado_prep_reg)), Sumar2Tiempos(Sumar2Tiempos($proc_habilitado_prep_reg, $proc_rebobinado_prep_reg), Sumar2Tiempos($proc_cortefinal_prep_reg, $proc_sellado_prep_reg)));
$TotalTiempoTodo=Sumar2Tiempos(Sumar2Tiempos(Sumar2Tiempos($proc_extrusion_tiempo_produc, $proc_impresion_tiempo_produc), Sumar2Tiempos($proc_bilaminado_tiempo_produc, $proc_trilaminado_tiempo_produc)), Sumar2Tiempos(Sumar2Tiempos($proc_habilitado_tiempo_produc, $proc_rebobinado_tiempo_produc), Sumar2Tiempos($proc_cortefinal_tiempo_produc, $proc_sellado_tiempo_produc)));
$TotalTiempo_PrepReg=Sumar2Tiempos($TotalPrepReg, $TotalTiempoTodo);

//HORA HOMBRE
$TotalHoraHombre=$proc_extrusion_total_horahombre + $proc_impresion_total_horahombre + $proc_bilaminado_total_horahombre + $proc_trilaminado_total_horahombre + $proc_habilitado_total_horahombre + $proc_rebobinado_total_horahombre + $proc_cortefinal_total_horahombre + $proc_sellado_total_horahombre;

//ENERGIA
$TotalKwHora=$proc_extrusion_total_kwhora + $proc_impresion_total_kwhora + $proc_bilaminado_total_kwhora + $proc_trilaminado_total_kwhora + $proc_habilitado_total_kwhora + $proc_rebobinado_total_kwhora + $proc_cortefinal_total_kwhora  + $proc_sellado_total_kwhora;

//DEPRECIACION Y GASTROS GENERALES
$TotalDepGas=$proc_extrusion_total_depgas + $proc_impresion_total_depgas + $proc_bilaminado_total_depgas + $proc_trilaminado_total_depgas + $proc_habilitado_total_depgas + $proc_rebobinado_total_depgas + $proc_cortefinal_total_depgas  + $proc_sellado_total_depgas;

?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Cotización</title>
<link href="/css/estilos_impresion.css" rel="stylesheet" type="text/css">
<link href="/css/estilos_impresion_print.css" rel="stylesheet" type="text/css" media="print">
</head>

<body>
<div class="interior">

<table width="1000" align="center" cellspacing="3">
  <tr>
    <th colspan="2" align="left" class="titulo_empresa" scope="col"><img src="/imagenes/logo-coesa.png" width="300" alt="Logo"></th>
    <th width="2%" scope="col">&nbsp;</th>
    <th width="13%" scope="col">&nbsp;</th>
    <th width="16%" scope="col">&nbsp;</th>
    <th width="4%" align="right" class="titulo_tipo" scope="col">&nbsp;</th>
    <th colspan="2" align="right" class="titulo_tipo" scope="col">COTIZACION</th>
    </tr>
  <tr>
    <th width="10%" height="18" align="right" scope="col"><strong>FECHA</strong></th>
    <th height="18" align="left" scope="col">SIP; <?php echo FechaHoraActual(); ?></th>
    <th height="18" align="right" scope="col">&nbsp;</th>
    <th height="18" align="right" scope="col">USUARIO</th>
    <th height="18" scope="col"><?php echo $usuario_user; ?></th>
    <th align="right" class="titulo_tipo" scope="col">&nbsp;</th>
    <th width="10%" align="right" class="titulo_tipo" scope="col">&nbsp;</th>
    <th width="13%" align="right" class="titulo_tipo" scope="col">&nbsp;</th>
  </tr>
  <tr>
    <th height="18" scope="col">&nbsp;</th>
    <th height="18" scope="col">DESCRIPCION</th>
    <th height="18" scope="col">&nbsp;</th>
    <th height="18" scope="col">&nbsp;</th>
    <th height="18" scope="col">&nbsp;</th>
    <th height="18" scope="col">&nbsp;</th>
    <th height="18" scope="col">&nbsp;</th>
    <th height="18" scope="col">&nbsp;</th>
  </tr>
  <tr>
    <th height="18" align="right" scope="col" class="texto_14">CLIENTE</th>
    <th height="18" class="border_rb1s0 texto_14" scope="col"><?php echo $impresion_cliente; ?></th>
    <th height="18" scope="col">&nbsp;</th>
    <th height="18" scope="col">&nbsp;</th>
    <th height="18" scope="col">&nbsp;</th>
    <th height="18" scope="col">&nbsp;</th>
    <th height="18" align="right" class="texto_14" scope="col">TOTAL</th>
    <th height="18" class="border_rb1s0" scope="col"><?php echo $impresion_cantcliente; ?></th>
  </tr>
  <tr>
    <th height="18" align="right" scope="col" class="texto_14">PRODUCTO</th>
    <th height="18" class="border_rb1s0 texto_14" scope="col"><?php echo $impresion_producto; ?></th>
    <th height="18" scope="col">&nbsp;</th>
    <th height="18" align="right" scope="col" class="texto_14">PRESENTACION</th>
    <th height="18" class="border_rb1s0" scope="col"><?php echo $impresion_unidadmedida["nombre_unidad_medida"]; ?></th>
    <th height="18" scope="col">&nbsp;</th>
    <th height="18" align="right" scope="col" class="texto_14">US$</th>
    <th height="18" class="border_rb1s0" scope="col"><?php echo number_format($impresion_precio, 3); ?></th>
  </tr>
</table>

<table width="1000" align="center" cellpadding="0" cellspacing="3">
  <tr>
    <th height="18" colspan="8" scope="col" class="titulo_tabla">DATOS GENERALES</th>
  </tr>
  <tr>
    <th width="125" height="20" align="right" scope="col">ANCHO FINAL</th>
    <th width="125" height="20" class="border_rb1s0" scope="col"><?php echo $impresion_anchofinal; ?></th>
    <th width="125" height="20" scope="col">ENGRANAJE</th>
    <th width="125" height="20" class="border_rb1s0" scope="col"><?php echo $impresion_cilindro["engranaje"]; ?></th>
    <th width="125" height="20" scope="col">FRECUENCIA</th>
    <th width="125" height="20" class="border_rb1s0" scope="col"><?php echo $impresion_frecuencia; ?></th>
    <th width="125" height="20" scope="col"><?php if($impresion_unidadmedida==3){ ?>KG x MILLAR<?php } ?></th>
    <th width="125" height="20" <?php if($impresion_unidadmedida==3){ ?>class="border_rb1s0"<?php } ?> scope="col">&nbsp;</th>
  </tr>
  <tr>
    <th width="125" height="20" align="right" scope="col">BANDAS</th>
    <th width="125" height="20" class="border_rb1s0" scope="col"><?php echo $impresion_nrobandas; ?></th>
    <th width="125" height="20" scope="col">CILINDRO</th>
    <th width="125" height="20" class="border_rb1s0" scope="col"><?php echo $impresion_cilindro["cilindro"]; ?></th>
    <th width="125" height="20" scope="col">DISTANCIA REPETICIÓN</th>
    <th width="125" height="20" class="border_rb1s0" scope="col"><?php echo $impresion_repeticion; ?></th>
    <th width="125" height="20" scope="col"><!--INSPECCION --></th>
    <th width="125" height="20" scope="col">&nbsp;</th>
  </tr>
</table>

<table width="1000" align="center" cellpadding="0" cellspacing="3">
  <tr>
    <th colspan="21" scope="col" class="titulo_tabla">INSUMOS</th>
  </tr>
  <tr>
    <th width="119" height="22" scope="col" class="texto_14">LAMINAS</th>
    <th height="22" colspan="6" scope="col">DESCRIPCION</th>
    <th width="19" height="22" scope="col">&nbsp;</th>
    <th width="66" height="22" scope="col">ANCHO</th>
    <th width="1" height="22" scope="col">&nbsp;</th>
    <th width="59" height="22" scope="col">&nbsp;</th>
    <th width="1" height="22" scope="col">&nbsp;</th>
    <th width="53" height="22" scope="col">GR/M2</th>
    <th width="1" height="22" scope="col">&nbsp;</th>
    <th width="61" height="22" scope="col">KG REQUERIDO</th>
    <th width="1" height="22" scope="col">&nbsp;</th>
    <th width="55" height="22" scope="col">% REFILE</th>
    <th width="1" height="22" scope="col">&nbsp;</th>
    <th width="59" height="22" scope="col">US / KG</th>
    <th width="1" height="22" scope="col">&nbsp;</th>
    <th width="122" height="22" scope="col">TOTAL US$</th>
  </tr>
  <?php if($impresion_lamina1>0){ ?>
  <tr>
    <th height="22" align="right" scope="col">IMPRIME</th>
    <th height="22" colspan="6" scope="col" class="border_rb1s0"><?php echo $impresion_lamina1["nombre_articulo"]; ?></th>
    <th height="22" scope="col">&nbsp;</th>
    <th height="22" scope="col" class="border_rb1s0"><?php echo $impresion_lamina1["ancho_articulo"]; ?></th>
    <th height="22" scope="col">&nbsp;</th>
    <th height="22" scope="col">&nbsp;</th>
    <th height="22" scope="col">&nbsp;</th>
    <th height="22" scope="col" class="border_rb1s0"><?php echo $impresion_lamina1["grm2_articulo"]; ?></th>
    <th height="22" scope="col">&nbsp;</th>
    <th height="22" scope="col" class="border_rb1s0"><?php echo $mtrprod_lamina_impresion; ?></th>
    <th height="22" scope="col">&nbsp;</th>
    <th height="22" scope="col" class="border_rb1s0"><?php echo $Lamina_impresion_refile; ?></th>
    <th height="22" scope="col">&nbsp;</th>
    <th height="22" scope="col" class="border_rb1s0"><?php echo $impresion_lamina1["precio_articulo"]; ?></th>
    <th height="22" scope="col">&nbsp;</th>
    <th height="22" scope="col" class="border_rb1s0"><?php echo $Lamina_impresion_total; ?></th>
  </tr>
  <?php } ?>
  <?php if($impresion_lamina2>0){ ?>
  <tr>
    <th height="22" align="right" scope="col">BILAMINA</th>
    <th height="22" colspan="6" scope="col" class="border_rb1s0"><?php echo $impresion_lamina2["nombre_articulo"]; ?></th>
    <th height="22" scope="col">&nbsp;</th>
    <th height="22" scope="col" class="border_rb1s0"><?php echo $impresion_lamina2["ancho_articulo"]; ?></th>
    <th height="22" scope="col">&nbsp;</th>
    <th height="22" scope="col">&nbsp;</th>
    <th height="22" scope="col">&nbsp;</th>
    <th height="22" scope="col" class="border_rb1s0"><?php echo $impresion_lamina2["grm2_articulo"]; ?></th>
    <th height="22" scope="col">&nbsp;</th>
    <th height="22" scope="col" class="border_rb1s0"><?php echo $mtrprod_lamina_bilaminado; ?></th>
    <th height="22" scope="col">&nbsp;</th>
    <th height="22" scope="col" class="border_rb1s0"><?php echo $Lamina_bilaminado_refile; ?></th>
    <th height="22" scope="col">&nbsp;</th>
    <th height="22" scope="col" class="border_rb1s0"><?php echo $impresion_lamina2["precio_articulo"]; ?></th>
    <th height="22" scope="col">&nbsp;</th>
    <th height="22" scope="col" class="border_rb1s0"><?php echo $Lamina_bilaminado_total; ?></th>
  </tr>
  <?php } ?>
  <?php if($impresion_lamina3>0){ ?>
  <tr>
    <th height="22" align="right" scope="col">TRILAMINA</th>
    <th height="22" colspan="6" scope="col" class="border_rb1s0"><?php echo $impresion_lamina3["nombre_articulo"]; ?></th>
    <th height="22" scope="col">&nbsp;</th>
    <th height="22" scope="col" class="border_rb1s0"><?php echo $impresion_lamina3["ancho_articulo"]; ?></th>
    <th height="22" scope="col">&nbsp;</th>
    <th height="22" scope="col">&nbsp;</th>
    <th height="22" scope="col">&nbsp;</th>
    <th height="22" scope="col" class="border_rb1s0"><?php echo $impresion_lamina3["grm2_articulo"]; ?></th>
    <th height="22" scope="col">&nbsp;</th>
    <th height="22" scope="col" class="border_rb1s0"><?php echo $mtrprod_lamina_trilaminado; ?></th>
    <th height="22" scope="col">&nbsp;</th>
    <th height="22" scope="col" class="border_rb1s0"><?php echo $Lamina_trilaminado_refile; ?></th>
    <th height="22" scope="col">&nbsp;</th>
    <th height="22" scope="col" class="border_rb1s0"><?php echo $impresion_lamina3["precio_articulo"]; ?></th>
    <th height="22" scope="col">&nbsp;</th>
    <th height="22" scope="col" class="border_rb1s0"><?php echo $Lamina_trilaminado_total; ?></th>
  </tr>
  <?php } ?>
  <tr>
    <th height="22" scope="col" class="texto_14">INSUMOS</th>
    <th height="22" colspan="6" scope="col">&nbsp;</th>
    <th height="22" scope="col">&nbsp;</th>
    <th height="22" scope="col">&nbsp;</th>
    <th height="22" scope="col">&nbsp;</th>
    <th height="22" scope="col">&nbsp;</th>
    <th height="22" scope="col">&nbsp;</th>
    <th height="22" scope="col">&nbsp;</th>
    <th height="22" scope="col">&nbsp;</th>
    <th height="22" scope="col">&nbsp;</th>
    <th height="22" scope="col">&nbsp;</th>
    <th height="22" scope="col">&nbsp;</th>
    <th height="22" scope="col">&nbsp;</th>
    <th height="22" scope="col">&nbsp;</th>
    <th height="22" scope="col">&nbsp;</th>
    <th height="22" scope="col">&nbsp;</th>
  </tr>
  <?php if($proc_impresion>0){ ?>
  <tr>
    <th height="22" align="right" scope="col">TINTA</th>
    <th height="22" colspan="6" scope="col" class="border_rb1s0"><?php echo $insumo_tinta["nombre_articulo"]; ?></th>
    <th height="22" scope="col">&nbsp;</th>
    <th height="22" scope="col" class="border_rb1s0"><?php echo $insumo_tinta["ancho_articulo"]; ?></th>
    <th height="22" scope="col">&nbsp;</th>
    <th height="22" scope="col">&nbsp;</th>
    <th height="22" scope="col">&nbsp;</th>
    <th height="22" scope="col" class="border_rb1s0"><?php echo $insumo_tinta["grm2_articulo"]; ?></th>
    <th height="22" scope="col">&nbsp;</th>
    <th height="22" scope="col" class="border_rb1s0"><?php echo number_format($AgregadoEstruc_tinta, 2); ?></th>
    <th height="22" scope="col">&nbsp;</th>
    <th height="22" scope="col">&nbsp;</th>
    <th height="22" scope="col">&nbsp;</th>
    <th height="22" scope="col" class="border_rb1s0"><?php echo $insumo_tinta["precio_articulo"]; ?></th>
    <th height="22" scope="col">&nbsp;</th>
    <th height="22" scope="col" class="border_rb1s0"><?php echo number_format($TotalCosto_tinta, 2); ?></th>
  </tr>
  <?php } ?>
  <?php if($proc_bilaminado>0){ ?>
  <tr>
    <th height="22" align="right" scope="col">ADHESIVO BILAMINADO</th>
    <th height="22" colspan="6" scope="col" class="border_rb1s0"><?php echo $insumo_bilaminado["nombre_articulo"]; ?></th>
    <th height="22" scope="col">&nbsp;</th>
    <th height="22" scope="col" class="border_rb1s0"><?php echo $insumo_bilaminado["ancho_articulo"]; ?></th>
    <th height="22" scope="col">&nbsp;</th>
    <th height="22" scope="col">&nbsp;</th>
    <th height="22" scope="col">&nbsp;</th>
    <th height="22" scope="col" class="border_rb1s0"><?php echo $insumo_bilaminado["grm2_articulo"]; ?></th>
    <th height="22" scope="col">&nbsp;</th>
    <th height="22" scope="col" class="border_rb1s0"><?php echo number_format($AgregadoEstruc_bilaminado, 2); ?></th>
    <th height="22" scope="col">&nbsp;</th>
    <th height="22" scope="col">&nbsp;</th>
    <th height="22" scope="col">&nbsp;</th>
    <th height="22" scope="col" class="border_rb1s0"><?php echo $insumo_bilaminado["precio_articulo"]; ?></th>
    <th height="22" scope="col">&nbsp;</th>
    <th height="22" scope="col" class="border_rb1s0"><?php echo number_format($TotalCosto_bilaminado, 2); ?></th>
  </tr>
  <?php } ?>
  <?php if($proc_trilaminado>0){ ?>
  <tr>
    <th height="22" align="right" scope="col">ADHESIVO TRILAMINADO</th>
    <th height="22" colspan="6" scope="col" class="border_rb1s0"><?php echo $insumo_trilaminado["nombre_articulo"]; ?></th>
    <th height="22" scope="col">&nbsp;</th>
    <th height="22" scope="col" class="border_rb1s0"><?php echo $insumo_trilaminado["ancho_articulo"]; ?></th>
    <th height="22" scope="col">&nbsp;</th>
    <th height="22" scope="col">&nbsp;</th>
    <th height="22" scope="col">&nbsp;</th>
    <th height="22" scope="col" class="border_rb1s0"><?php echo $insumo_trilaminado["grm2_articulo"]; ?></th>
    <th height="22" scope="col">&nbsp;</th>
    <th height="22" scope="col" class="border_rb1s0"><?php echo number_format($AgregadoEstruc_trilaminado, 2); ?></th>
    <th height="22" scope="col">&nbsp;</th>
    <th height="22" scope="col">&nbsp;</th>
    <th height="22" scope="col">&nbsp;</th>
    <th height="22" scope="col" class="border_rb1s0"><?php echo $insumo_trilaminado["precio_articulo"]; ?></th>
    <th height="22" scope="col">&nbsp;</th>
    <th height="22" scope="col" class="border_rb1s0"><?php echo number_format($TotalCosto_trilaminado, 2); ?></th>
  </tr>
  <?php } ?>
  <?php if($proc_impresion>0){ ?>
  <tr>
    <th height="22" align="right" scope="col">CUSHION</th>
    <th height="22" colspan="6" scope="col" class="border_rb1s0"><?php echo $insumo_cushion["nombre_articulo"]; ?></th>
    <th height="22" scope="col">&nbsp;</th>
    <th height="22" scope="col" class="border_rb1s0"><?php echo $insumo_cushion["ancho_articulo"]; ?></th>
    <th height="22" scope="col">&nbsp;</th>
    <th height="22" scope="col">&nbsp;</th>
    <th height="22" scope="col">&nbsp;</th>
    <th height="22" scope="col" class="border_rb1s0"><?php echo $insumo_cushion["grm2_articulo"]; ?></th>
    <th height="22" scope="col">&nbsp;</th>
    <th height="22" scope="col" class="border_rb1s0"><?php echo number_format($AgregadoEstruc_cushion, 2); ?></th>
    <th height="22" scope="col">&nbsp;</th>
    <th height="22" scope="col">&nbsp;</th>
    <th height="22" scope="col">&nbsp;</th>
    <th height="22" scope="col" class="border_rb1s0"><?php echo $insumo_cushion["precio_articulo"]; ?></th>
    <th height="22" scope="col">&nbsp;</th>
    <th height="22" scope="col" class="border_rb1s0"><?php echo number_format($TotalCosto_cushion, 2); ?></th>
  </tr>
  <?php } ?>
  <?php if($proc_impresion>0){ ?>
  <tr>
    <th height="22" align="right" scope="col">CLISES</th>
    <th height="22" colspan="6" scope="col" class="border_rb1s0"><?php echo $insumo_clises["nombre_articulo"]; ?></th>
    <th height="22" scope="col">&nbsp;</th>
    <th height="22" scope="col" class="border_rb1s0"><?php echo $insumo_clises["ancho_articulo"]; ?></th>
    <th height="22" scope="col">&nbsp;</th>
    <th height="22" scope="col">&nbsp;</th>
    <th height="22" scope="col">&nbsp;</th>
    <th height="22" scope="col" class="border_rb1s0"><?php echo $insumo_clises["grm2_articulo"]; ?></th>
    <th height="22" scope="col">&nbsp;</th>
    <th height="22" scope="col" class="border_rb1s0"><?php echo number_format($AgregadoEstruc_clises, 2); ?></th>
    <th height="22" scope="col">&nbsp;</th>
    <th height="22" scope="col">&nbsp;</th>
    <th height="22" scope="col">&nbsp;</th>
    <th height="22" scope="col" class="border_rb1s0"><?php echo $insumo_clises["precio_articulo"]; ?></th>
    <th height="22" scope="col">&nbsp;</th>
    <th height="22" scope="col" class="border_rb1s0"><?php echo number_format($TotalCosto_clises, 2); ?></th>
  </tr>
  <?php } ?>
  <tr>
    <th height="12" colspan="21" scope="col"><hr></th>
  </tr>
  <tr>
    <th height="22" scope="col">&nbsp;</th>
    <th width="70" height="22" scope="col">&nbsp;</th>
    <th width="18" height="22" scope="col">&nbsp;</th>
    <th width="52" height="22" scope="col">&nbsp;</th>
    <th width="14" height="22" scope="col">&nbsp;</th>
    <th width="55" height="22" scope="col">&nbsp;</th>
    <th width="60" height="22" scope="col">&nbsp;</th>
    <th height="22" scope="col">&nbsp;</th>
    <th height="22" scope="col">&nbsp;</th>
    <th height="22" scope="col">&nbsp;</th>
    <th height="22" scope="col">&nbsp;</th>
    <th height="22" scope="col">&nbsp;</th>
    <th height="22" scope="col">&nbsp;</th>
    <th height="22" scope="col">&nbsp;</th>
    <th height="22" colspan="5" scope="col">TOTAL COSTO DE MATERIALES</th>
    <th height="22" scope="col">&nbsp;</th>
    <th height="22" scope="col" class="border_rb1s0"><?php echo number_format($totalCostoMaterial, 2); ?></th>
  </tr>
</table>

<table width="1000" align="center" cellspacing="3">
  <tr>
    <th colspan="15" class="titulo_tabla" scope="col">PROCESOS PRODUCTIVOS</th>
  </tr>
  <tr>
    <th width="110" height="20" scope="col">&nbsp;</th>
    <th width="118" height="20" scope="col">&nbsp;</th>
    <th width="45" height="20" scope="col">&nbsp;</th>
    <th width="45" height="20" scope="col">&nbsp;</th>
    <th width="45" height="20" scope="col">&nbsp;</th>
    <th height="20" colspan="2" scope="col">TIEMPO</th>
    <th height="20" colspan="2" scope="col">MANO DE OBRA</th>
    <th height="20" colspan="2" scope="col">ENERGIA</th>
    <th width="45" height="20" scope="col">&nbsp;</th>
    <th width="45" height="20" scope="col">&nbsp;</th>
    <th width="45" height="20" scope="col">&nbsp;</th>
    <th width="104" height="20" scope="col">&nbsp;</th>
  </tr>
  <tr>
    <th width="110" height="37" scope="col">PROCESOS</th>
    <th width="118" height="37" scope="col">MAQUINAS</th>
    <th width="45" height="37" scope="col"><p>MERMA PROCESO</p>
      <p>(Mtr)</p></th>
    <th width="45" height="37" scope="col"><p>CANTIDAD</p>
    <p>(ML O M2)</p></th>
    <th width="45" height="37" scope="col">VELOC.</th>
    <th width="45" height="37" scope="col"><p>PREP./</p>
      <p>REGUL.</p></th>
    <th width="45" height="37" scope="col">PRODUC.</th>
    <th width="45" height="37" scope="col"><p>US$ / </p>
    <p>HORA</p></th>
    <th width="45" height="37" scope="col"><p>TOTAL</p>
      <p> US$</p></th>
    <th width="45" height="37" scope="col"><p>US$ / </p>
    <p>HORA</p></th>
    <th width="45" height="37" scope="col"><p>TOTAL</p>
      <p> US$</p></th>
    <th width="45" height="37" scope="col"><p>DEPRE-</p>
    <p>CIACION</p></th>
    <th width="45" height="37" scope="col"><p>GASTOS</p>
      GENERAS</th>
    <th width="45" height="37" scope="col"><p>TOTAL</p>
      <p> US$</p></th>
    <th width="104" height="37" scope="col">COSTO TOTAL US$</th>
  </tr>
  <?php if($proc_extrusion>0){ ?>
  <tr>
    <th width="110" height="23" scope="col" class="border_rb1s0">EXTRUSIÓN</th>
    <th width="118" height="23" scope="col" class="border_rb1s0"><?php echo $proc_extrusion_nombre["nombre_maquina"]; ?></th>
    <th width="45" height="23" scope="col" class="border_rb1s0"></th>
    <th width="45" height="23" scope="col" class="border_rb1s0"><?php echo round($mtrprod_extrusion); ?></th>
    <th width="45" height="23" scope="col" class="border_rb1s0"><?php echo $proc_extrusion["velocidad_maquina"]; ?></th>
    <th width="45" height="23" scope="col" class="border_rb1s0"><?php echo $proc_extrusion_prep_reg; ?></th>
    <th width="45" height="23" scope="col" class="border_rb1s0 fondo_total"><?php echo $proc_extrusion_tiempo_produc;  ?></th>
    <th width="45" height="23" scope="col" class="border_rb1s0"><?php echo $proc_extrusion["costohora_hombre_maquina"]; ?></th>
    <th width="45" height="23" scope="col" class="border_rb1s0 fondo_total"><?php echo $proc_extrusion_total_horahombre; ?></th>
    <th width="45" height="23" scope="col" class="border_rb1s0"><?php echo $proc_extrusion["costokw_hora_maquina"]; ?></th>
    <th width="45" height="23" scope="col" class="border_rb1s0 fondo_total"><?php echo $proc_extrusion_total_kwhora; ?></th>
    <th width="45" height="23" scope="col" class="border_rb1s0"><?php echo $proc_extrusion["costodepreciacion_hora_maquina"]; ?></th>
    <th width="45" height="23" scope="col" class="border_rb1s0"><?php echo $proc_extrusion["gastosfabrica_hora_maquina"]; ?></th>
    <th width="45" height="23" scope="col" class="border_rb1s0 fondo_total"><?php echo $proc_extrusion_total_depgas; ?></th>
    <th width="104" height="23" scope="col" class="border_rb1s0"><?php echo number_format($proc_extrusion_total_costo, 2); ?></th>
  </tr>
  <?php } ?>
  <?php if($proc_impresion>0){ ?>
  <tr>
    <th width="110" height="23" scope="col" class="border_rb1s0">IMPRESIÓN</th>
    <th width="118" height="23" scope="col" class="border_rb1s0"><?php echo $proc_impresion_nombre["nombre_maquina"]; ?></th>
    <th width="45" height="23" scope="col" class="border_rb1s0"><?php echo $proc_impresion_merma; ?></th>
    <th width="45" height="23" scope="col" class="border_rb1s0"><?php echo round($mtrprod_impresion); ?></th>
    <th width="45" height="23" scope="col" class="border_rb1s0"><?php echo $proc_impresion["velocidad_maquina"]; ?></th>
    <th width="45" height="23" scope="col" class="border_rb1s0"><?php echo $proc_impresion_prep_reg; ?></th>
    <th width="45" height="23" scope="col" class="border_rb1s0 fondo_total"><?php echo $proc_impresion_tiempo_produc;  ?></th>
    <th width="45" height="23" scope="col" class="border_rb1s0"><?php echo $proc_impresion["costohora_hombre_maquina"]; ?></th>
    <th width="45" height="23" scope="col" class="border_rb1s0 fondo_total"><?php echo $proc_impresion_total_horahombre; ?></th>
    <th width="45" height="23" scope="col" class="border_rb1s0"><?php echo $proc_impresion["costokw_hora_maquina"]; ?></th>
    <th width="45" height="23" scope="col" class="border_rb1s0 fondo_total"><?php echo $proc_impresion_total_kwhora; ?></th>
    <th width="45" height="23" scope="col" class="border_rb1s0"><?php echo $proc_impresion["costodepreciacion_hora_maquina"]; ?></th>
    <th width="45" height="23" scope="col" class="border_rb1s0"><?php echo $proc_impresion["gastosfabrica_hora_maquina"]; ?></th>
    <th width="45" height="23" scope="col" class="border_rb1s0 fondo_total"><?php echo $proc_impresion_total_depgas; ?></th>
    <th width="104" height="23" scope="col" class="border_rb1s0"><?php echo number_format($proc_impresion_total_costo, 2); ?></th>
  </tr>
  <?php } ?>
  <?php if($proc_bilaminado>0){ ?>
  <tr>
    <th width="110" height="23" scope="col" class="border_rb1s0">BILAMINADO</th>
    <th width="118" height="23" scope="col" class="border_rb1s0"><?php echo $proc_bilaminado_nombre["nombre_maquina"]; ?></th>
    <th width="45" height="23" scope="col" class="border_rb1s0"><?php echo $proc_bilaminado_merma; ?></th>
    <th width="45" height="23" scope="col" class="border_rb1s0"><?php echo round($mtrprod_bilaminado); ?></th>
    <th width="45" height="23" scope="col" class="border_rb1s0"><?php echo $proc_bilaminado["velocidad_maquina"]; ?></th>
    <th width="45" height="23" scope="col" class="border_rb1s0"><?php echo $proc_bilaminado_prep_reg; ?></th>
    <th width="45" height="23" scope="col" class="border_rb1s0 fondo_total"><?php echo $proc_bilaminado_tiempo_produc;  ?></th>
    <th width="45" height="23" scope="col" class="border_rb1s0"><?php echo $proc_bilaminado["costohora_hombre_maquina"]; ?></th>
    <th width="45" height="23" scope="col" class="border_rb1s0 fondo_total"><?php echo $proc_bilaminado_total_horahombre; ?></th>
    <th width="45" height="23" scope="col" class="border_rb1s0"><?php echo $proc_bilaminado["costokw_hora_maquina"]; ?></th>
    <th width="45" height="23" scope="col" class="border_rb1s0 fondo_total"><?php echo $proc_bilaminado_total_kwhora; ?></th>
    <th width="45" height="23" scope="col" class="border_rb1s0"><?php echo $proc_bilaminado["costodepreciacion_hora_maquina"]; ?></th>
    <th width="45" height="23" scope="col" class="border_rb1s0"><?php echo $proc_bilaminado["gastosfabrica_hora_maquina"]; ?></th>
    <th width="45" height="23" scope="col" class="border_rb1s0 fondo_total"><?php echo $proc_bilaminado_total_depgas; ?></th>
    <th width="104" height="23" scope="col" class="border_rb1s0"><?php echo number_format($proc_bilaminado_total_costo, 2); ?></th>
  </tr>
  <?php } ?>
  <?php if($proc_trilaminado>0){ ?>
  <tr>
    <th width="110" height="23" scope="col" class="border_rb1s0">TRILAMINADO</th>
    <th width="118" height="23" scope="col" class="border_rb1s0"><?php echo $proc_trilaminado_nombre["nombre_maquina"]; ?></th>
    <th width="45" height="23" scope="col" class="border_rb1s0"><?php echo $proc_trilaminado_merma; ?></th>
    <th width="45" height="23" scope="col" class="border_rb1s0"><?php echo round($mtrprod_trilaminado); ?></th>
    <th width="45" height="23" scope="col" class="border_rb1s0"><?php echo $proc_trilaminado["velocidad_maquina"]; ?></th>
    <th width="45" height="23" scope="col" class="border_rb1s0"><?php echo $proc_trilaminado_prep_reg; ?></th>
    <th width="45" height="23" scope="col" class="border_rb1s0 fondo_total"><?php echo $proc_trilaminado_tiempo_produc;  ?></th>
    <th width="45" height="23" scope="col" class="border_rb1s0"><?php echo $proc_trilaminado["costohora_hombre_maquina"]; ?></th>
    <th width="45" height="23" scope="col" class="border_rb1s0 fondo_total"><?php echo $proc_trilaminado_total_horahombre; ?></th>
    <th width="45" height="23" scope="col" class="border_rb1s0"><?php echo $proc_trilaminado["costokw_hora_maquina"]; ?></th>
    <th width="45" height="23" scope="col" class="border_rb1s0 fondo_total"><?php echo $proc_trilaminado_total_kwhora; ?></th>
    <th width="45" height="23" scope="col" class="border_rb1s0"><?php echo $proc_trilaminado["costodepreciacion_hora_maquina"]; ?></th>
    <th width="45" height="23" scope="col" class="border_rb1s0"><?php echo $proc_trilaminado["gastosfabrica_hora_maquina"]; ?></th>
    <th width="45" height="23" scope="col" class="border_rb1s0 fondo_total"><?php echo $proc_trilaminado_total_depgas; ?></th>
    <th width="104" height="23" scope="col" class="border_rb1s0"><?php echo number_format($proc_trilaminado_total_costo, 2); ?></th>
  </tr>
  <?php } ?>
  <?php if($proc_rebobinado>0){ ?>
  <tr>
    <th width="110" height="23" scope="col" class="border_rb1s0">REBOBINADO</th>
    <th width="118" height="23" scope="col" class="border_rb1s0"><?php echo $proc_rebobinado_nombre["nombre_maquina"]; ?></th>
    <th width="45" height="23" scope="col" class="border_rb1s0"><?php echo $proc_rebobinado_merma; ?></th>
    <th width="45" height="23" scope="col" class="border_rb1s0"><?php echo round($mtrprod_rebobinado); ?></th>
    <th width="45" height="23" scope="col" class="border_rb1s0"><?php echo $proc_rebobinado["velocidad_maquina"]; ?></th>
    <th width="45" height="23" scope="col" class="border_rb1s0"><?php echo $proc_rebobinado_prep_reg; ?></th>
    <th width="45" height="23" scope="col" class="border_rb1s0 fondo_total"><?php echo $proc_rebobinado_tiempo_produc;  ?></th>
    <th width="45" height="23" scope="col" class="border_rb1s0"><?php echo $proc_rebobinado["costohora_hombre_maquina"]; ?></th>
    <th width="45" height="23" scope="col" class="border_rb1s0 fondo_total"><?php echo $proc_rebobinado_total_horahombre; ?></th>
    <th width="45" height="23" scope="col" class="border_rb1s0"><?php echo $proc_rebobinado["costokw_hora_maquina"]; ?></th>
    <th width="45" height="23" scope="col" class="border_rb1s0 fondo_total"><?php echo $proc_rebobinado_total_kwhora; ?></th>
    <th width="45" height="23" scope="col" class="border_rb1s0"><?php echo $proc_rebobinado["costodepreciacion_hora_maquina"]; ?></th>
    <th width="45" height="23" scope="col" class="border_rb1s0"><?php echo $proc_rebobinado["gastosfabrica_hora_maquina"]; ?></th>
    <th width="45" height="23" scope="col" class="border_rb1s0 fondo_total"><?php echo $proc_rebobinado_total_depgas; ?></th>
    <th width="104" height="23" scope="col" class="border_rb1s0"><?php echo number_format($proc_rebobinado_total_costo, 2); ?></th>
  </tr>
  <?php } ?>
  <?php if($proc_habilitado>0){ ?>
  <tr>
    <th height="23" scope="col" class="border_rb1s0">HABILITADO</th>
    <th height="23" scope="col" class="border_rb1s0"><?php echo $proc_habilitado_nombre["nombre_maquina"]; ?></th>
    <th width="45" height="23" scope="col" class="border_rb1s0"><?php echo $proc_habilitado_merma; ?></th>
    <th width="45" height="23" scope="col" class="border_rb1s0"><?php echo round($mtrprod_habilitado); ?></th>
    <th width="45" height="23" scope="col" class="border_rb1s0"><?php echo $proc_habilitado["velocidad_maquina"]; ?></th>
    <th width="45" height="23" scope="col" class="border_rb1s0"><?php echo $proc_habilitado_prep_reg; ?></th>
    <th width="45" height="23" scope="col" class="border_rb1s0 fondo_total"><?php echo $proc_habilitado_tiempo_produc;  ?></th>
    <th width="45" height="23" scope="col" class="border_rb1s0"><?php echo $proc_habilitado["costohora_hombre_maquina"]; ?></th>
    <th width="45" height="23" scope="col" class="border_rb1s0 fondo_total"><?php echo $proc_habilitado_total_horahombre; ?></th>
    <th width="45" height="23" scope="col" class="border_rb1s0"><?php echo $proc_habilitado["costokw_hora_maquina"]; ?></th>
    <th width="45" height="23" scope="col" class="border_rb1s0 fondo_total"><?php echo $proc_habilitado_total_kwhora; ?></th>
    <th width="45" height="23" scope="col" class="border_rb1s0"><?php echo $proc_habilitado["costodepreciacion_hora_maquina"]; ?></th>
    <th width="45" height="23" scope="col" class="border_rb1s0"><?php echo $proc_habilitado["gastosfabrica_hora_maquina"]; ?></th>
    <th width="45" height="23" scope="col" class="border_rb1s0 fondo_total"><?php echo $proc_habilitado_total_depgas; ?></th>
    <th width="104" height="23" scope="col" class="border_rb1s0"><?php echo number_format($proc_habilitado_total_costo, 2); ?></th>
  </tr>
  <?php } ?>
  <?php if($proc_cortefinal>0){ ?>
  <tr>
    <th height="23" scope="col" class="border_rb1s0">CORTE FINAL</th>
    <th height="23" scope="col" class="border_rb1s0"><?php echo $proc_cortefinal_nombre["nombre_maquina"]; ?></th>
    <th width="45" height="23" scope="col" class="border_rb1s0"><?php echo $proc_cortefinal_merma; ?></th>
    <th width="45" height="23" scope="col" class="border_rb1s0"><?php echo round($mtrprod_cortefinal); ?></th>
    <th width="45" height="23" scope="col" class="border_rb1s0"><?php echo $proc_cortefinal["velocidad_maquina"]; ?></th>
    <th width="45" height="23" scope="col" class="border_rb1s0"><?php echo $proc_cortefinal_prep_reg; ?></th>
    <th width="45" height="23" scope="col" class="border_rb1s0 fondo_total"><?php echo $proc_cortefinal_tiempo_produc;  ?></th>
    <th width="45" height="23" scope="col" class="border_rb1s0"><?php echo $proc_cortefinal["costohora_hombre_maquina"]; ?></th>
    <th width="45" height="23" scope="col" class="border_rb1s0 fondo_total"><?php echo $proc_cortefinal_total_horahombre; ?></th>
    <th width="45" height="23" scope="col" class="border_rb1s0"><?php echo $proc_cortefinal["costokw_hora_maquina"]; ?></th>
    <th width="45" height="23" scope="col" class="border_rb1s0 fondo_total"><?php echo $proc_cortefinal_total_kwhora; ?></th>
    <th width="45" height="23" scope="col" class="border_rb1s0"><?php echo $proc_cortefinal["costodepreciacion_hora_maquina"]; ?></th>
    <th width="45" height="23" scope="col" class="border_rb1s0"><?php echo $proc_cortefinal["gastosfabrica_hora_maquina"]; ?></th>
    <th width="45" height="23" scope="col" class="border_rb1s0 fondo_total"><?php echo $proc_cortefinal_total_depgas; ?></th>
    <th width="104" height="23" scope="col" class="border_rb1s0"><?php echo number_format($proc_cortefinal_total_costo, 2); ?></th>
  </tr>
  <?php } ?>
  <?php if($proc_sellado>0){ ?>
  <tr>
    <th height="23" scope="col" class="border_rb1s0">SELLADO</th>
    <th height="23" scope="col" class="border_rb1s0"><?php echo $proc_sellado_nombre["nombre_maquina"]; ?></th>
    <th width="45" height="23" scope="col" class="border_rb1s0"><?php echo $proc_sellado_merma; ?></th>
    <th width="45" height="23" scope="col" class="border_rb1s0"><?php echo round($mtrprod_sellado); ?></th>
    <th width="45" height="23" scope="col" class="border_rb1s0"><?php echo $proc_sellado["velocidad_maquina"]; ?></th>
    <th width="45" height="23" scope="col" class="border_rb1s0"><?php echo $proc_sellado_prep_reg; ?></th>
    <th width="45" height="23" scope="col" class="border_rb1s0 fondo_total"><?php echo $proc_sellado_tiempo_produc;  ?></th>
    <th width="45" height="23" scope="col" class="border_rb1s0"><?php echo $proc_sellado["costohora_hombre_maquina"]; ?></th>
    <th width="45" height="23" scope="col" class="border_rb1s0 fondo_total"><?php echo $proc_sellado_total_horahombre; ?></th>
    <th width="45" height="23" scope="col" class="border_rb1s0"><?php echo $proc_sellado["costokw_hora_maquina"]; ?></th>
    <th width="45" height="23" scope="col" class="border_rb1s0 fondo_total"><?php echo $proc_sellado_total_kwhora; ?></th>
    <th width="45" height="23" scope="col" class="border_rb1s0"><?php echo $proc_sellado["costodepreciacion_hora_maquina"]; ?></th>
    <th width="45" height="23" scope="col" class="border_rb1s0"><?php echo $proc_sellado["gastosfabrica_hora_maquina"]; ?></th>
    <th width="45" height="23" scope="col" class="border_rb1s0 fondo_total"><?php echo $proc_sellado_total_depgas; ?></th>
    <th width="104" height="23" scope="col" class="border_rb1s0"><?php echo number_format($proc_sellado_total_costo, 2); ?></th>
  </tr>
  <?php } ?>
  <tr>
    <th height="10" colspan="15" scope="col"><hr></th>
  </tr>
  <tr>
    <th height="23" scope="col">&nbsp;</th>
    <th height="23" scope="col">&nbsp;</th>
    <th height="23" scope="col">&nbsp;</th>
    <th colspan="2" rowspan="2" scope="col">TOTAL</th>
    <th height="23" scope="col" class="border_rb1s0"><?php echo $TotalPrepReg; ?></th>
    <th height="23" scope="col" class="border_rb1s0"><?php echo $TotalTiempoTodo; ?></th>
    <th height="23" colspan="2" class="border_rb1s0" scope="col"><?php echo number_format($TotalHoraHombre, 2); ?></th>
    <th height="23" colspan="2" class="border_rb1s0" scope="col"><?php echo number_format($TotalKwHora, 2); ?></th>
    <th height="23" scope="col">&nbsp;</th>
    <th height="23" colspan="2" class="border_rb1s0" scope="col"><?php echo number_format($TotalDepGas, 2); ?></th>
    <th height="23" scope="col">&nbsp;</th>
  </tr>
  <tr>
    <th height="23" scope="col">&nbsp;</th>
    <th colspan="2" scope="col">&nbsp;</th>
    <th height="23" colspan="2" class="border_rb1s0" scope="col"><?php echo $TotalTiempo_PrepReg; ?></th>
    <th height="23" scope="col">&nbsp;</th>
    <th height="23" scope="col">&nbsp;</th>
    <th height="23" scope="col">&nbsp;</th>
    <th height="23" scope="col">&nbsp;</th>
    <th height="23" colspan="3" scope="col">TOTAL US$ OPERACIONES</th>
    <th height="23" scope="col" class="border_rb1s0"><?php echo number_format($TotalCostoProcesos, 2); ?></th>
  </tr>
</table>

<table width="1000" align="center" cellspacing="3">
  <tr>
    <th height="20" colspan="6" scope="col" class="titulo_tabla">RESUMEN</th>
    </tr>
  <tr>
    <th width="335" rowspan="5" scope="col">
    <img src="/libs/graphpico/graphpastel.php?fil=100&bkg=ffffff&wdt=300&hgt=100&dat=<?php echo $grafUtilidad; ?>,<?php echo $grafCostoMaterial; ?>,<?php echo $grafCostoProceso; ?>" width="300" height="100">
    </th>
    <th width="97" height="20" align="left" scope="col"><img src="/imagenes/graficos/pie-1.gif" width="5" height="5"> UTILIDAD</th>
    <th width="70" height="20" scope="col">&nbsp;</th>
    <th width="85" height="20" scope="col">&nbsp;</th>
    <th width="178" height="20" scope="col">&nbsp;</th>
    <th width="200" height="20" align="left" scope="col">VALOR DE VENTA</th>
  </tr>
  <tr>
    <th height="20" align="left" scope="col"><img src="/imagenes/graficos/pie-2.gif" width="5" height="5"> INSUMOS</th>
    <th height="20" scope="col">&nbsp;</th>
    <th height="20" scope="col">&nbsp;</th>
    <th width="178" height="20" scope="col">US$ x KG</th>
    <th width="200" height="20" scope="col">TOTAL US$</th>
  </tr>
  <tr>
    <th height="20" align="left" scope="col"><img src="/imagenes/graficos/pie-3.gif" width="5" height="5"> PROCESOS</th>
    <th height="20" align="right" scope="col">COSTOS</th>
    <th height="20" scope="col">&nbsp;</th>
    <th width="178" height="20" class="border_rb1s0" scope="col"><?php echo number_format($TotalResumenCostos, 2); ?></th>
    <th width="200" height="20" class="border_rb1s0" scope="col"><?php echo number_format(($totalCostoMaterial + $TotalCostoProcesos), 2); ?></th>
  </tr>
  <tr>
    <th height="20" align="left" scope="col">&nbsp;</th>
    <th height="20" align="right" scope="col">UTILIDAD</th>
    <th height="20" scope="col" class="border_rb1s0">&nbsp;</th>
    <th width="178" height="20" class="border_rb1s0" scope="col"><?php echo number_format($TotalResumenUtilidad, 2); ?></th>
    <th width="200" height="20" class="border_rb1s0" scope="col"><?php echo number_format(($impresion_cantcliente * $impresion_precio) - ($totalCostoMaterial + $TotalCostoProcesos), 2); ?></th>
  </tr>
  <tr>
    <th height="20" align="left" scope="col">&nbsp;</th>
    <th height="20" align="right" scope="col">TOTAL</th>
    <th height="20" scope="col">&nbsp;</th>
    <th width="178" height="20" class="border_rb1s0" scope="col">&nbsp;</th>
    <th width="200" height="20" class="border_rb1s0" scope="col"><?php echo number_format((($totalCostoMaterial + $TotalCostoProcesos) + (($impresion_cantcliente * $impresion_precio) - ($totalCostoMaterial + $TotalCostoProcesos))), 2); ?></th>
  </tr>
</table>

<table width="1000" align="center">
  <tr>
    <th width="10" scope="col">&nbsp;</th>
  </tr>
  <tr>
    <th scope="col">&nbsp;</th>
  </tr>
  <tr>
    <th scope="col"><input onClick="print();" type="submit" name="button" id="button" value="Enviar"></th>
  </tr>
</table>

</div>

</body>
</html>