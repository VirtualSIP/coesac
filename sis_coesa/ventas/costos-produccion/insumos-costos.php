<?php
session_start();
require_once("../../../connect/conexion.php");
require_once("../../../connect/function.php");
require_once("../../../connect/sesion/verificar_sesion.php");

//VARIABLES
$idInsumo=$_POST["id"];
$insumos=$_POST["insumo"];
$insumo_tinta=$_POST["insumo_tinta"];
$grm2total=$_POST["grm2total"];
$anchofinal=$_POST["anchofinal"];
$nrobandas=$_POST["nrobandas"];
$nrocolores=$_POST["nrocolores"];
$metrototal=$_POST["metrototal"];
$repeticion=$_POST["repeticion"];
$frecuencia=$_POST["frecuencia"];
$grm2=$_POST["grm2"];
$tipo=$_POST["tipo"];

if($tipo=="tinta" and $insumo_tinta>0){
	//TINTA
	$rst_insTinta=mysql_query("SELECT * FROM syCoesa_articulo WHERE id_articulo=$insumo_tinta;", $conexion);
	$fila_insTinta=mysql_fetch_array($rst_insTinta);
	$insumo_id=$fila_insTinta["id_articulo"];
	$insumo_precio=$fila_insTinta["precio_articulo"];
	$porcentaje_solido=$fila_insTinta["solido_tinta"];
	
	//FORMULA: TOTAL KG = (METROSIMPRESION * (GRM2TOTAL * (ANCHOFINAL * BANDAS))/1000000)
	$totalKg = ($metrototal * ($grm2total * ($anchofinal * $nrobandas)) / 1000000);
	
	//FORMULA: KG TINTA SECA = (GRM2TINTASECA * TOTAL KG) / TOTAL GRM2
	$KgTintaseca = ($grm2 * $totalKg) / $grm2total;
	
	//FORMULA: CANTIDADRQ = KGTINTASECA + (KGTINTASECA * % DE TINTA SOLIDA)
	$AgregadoEstruc=($KgTintaseca + ($KgTintaseca * ($porcentaje_solido / 100)));
	
	//TOTAL DE COSTOS
	$TotalCosto=$AgregadoEstruc * $insumo_precio;
?>
<input name="insumotinta" id="insumotinta" type="hidden" value="<?php echo $insumo_id; ?>">
<?php
}elseif($tipo=="tinta"){
	//TINTA
	$rst_insTinta=mysql_query("SELECT * FROM syCoesa_articulo WHERE id_tipo_articulo=2 ORDER BY precio_articulo DESC;", $conexion);
	$fila_insTinta=mysql_fetch_array($rst_insTinta);
	$insumo_id=$fila_insTinta["id_articulo"];
	$insumo_precio=$fila_insTinta["precio_articulo"];
	$porcentaje_solido=$fila_insTinta["solido_tinta"];
	
	//FORMULA: TOTAL KG = (METROSIMPRESION * (GRM2TOTAL * (ANCHOFINAL * BANDAS))/1000000)
	$totalKg = ($metrototal * ($grm2total * ($anchofinal * $nrobandas)) / 1000000);
	
	//FORMULA: KG TINTA SECA = (GRM2TINTASECA * TOTAL KG) / TOTAL GRM2
	$KgTintaseca = ($grm2 * $totalKg) / $grm2total;
	
	//FORMULA: CANTIDADRQ = KGTINTASECA + (KGTINTASECA * % DE TINTA SOLIDA)
	$AgregadoEstruc=($KgTintaseca + ($KgTintaseca * ($porcentaje_solido / 100)));
	
	//TOTAL DE COSTOS
	$TotalCosto=$AgregadoEstruc * $insumo_precio;
?>
<input name="insumotinta" id="insumotinta" type="hidden" value="<?php echo $insumo_id; ?>">
<?php
}elseif($tipo=="cushion" or $tipo=="clises"){
	//SELECCIONAR DATOS DE MAQUINA
	$rst_insumos=mysql_query("SELECT * FROM syCoesa_articulo WHERE id_articulo=$insumos;", $conexion);
	$fila_insumos=mysql_fetch_array($rst_insumos);
	$insumo_precio=$fila_insumos["precio_articulo"];
	
	//FORMULA: CANTIDADRQ = (((ANCHOFINAL * BANDAS) / 10) * (REPETICION * FRECUENCIA) / 10) * (NROCOLORES * 1.15)
	$AgregadoEstruc = (($anchofinal * $nrobandas) / 10) * (($repeticion * $frecuencia) / 10) * ($nrocolores * 1.15);
	
	//TOTAL DE COSTOS
	$TotalCosto=$AgregadoEstruc * $insumo_precio;
}else{	
	//SELECCIONAR DATOS DE MAQUINA
	$rst_insumos=mysql_query("SELECT * FROM syCoesa_articulo WHERE id_articulo=$insumos;", $conexion);
	$fila_insumos=mysql_fetch_array($rst_insumos);
	$insumo_precio=$fila_insumos["precio_articulo"];
	
	//FORMULA: TOTAL KG = (METROSIMPRESION * (GRM2TOTAL * (ANCHOFINAL * BANDAS))/1000000)
	$totalKg = ($metrototal * ($grm2total * ($anchofinal * $nrobandas)) / 1000000);
	
	//FORMULA: KG TINTA SECA = (GRM2TINTASECA * TOTAL KG) / TOTAL GRM2
	$AgregadoEstruc = ($grm2 * $totalKg) / $grm2total;
	
	//TOTAL DE COSTOS
	$TotalCosto=$AgregadoEstruc * $insumo_precio;
}
?> 

<div style="width:150px; height:20px; padding:1% 0;" class="float_left texto_cen"><?php echo $insumo_precio; ?></div>
<div style="width:150px; height:20px; padding:1% 0;" class="float_left texto_cen"><?php echo number_format($AgregadoEstruc, 2); ?></div>
<div style="width:150px; height:20px; padding:1% 0;" class="float_left texto_cen"><?php echo number_format($TotalCosto, 2); ?></div>