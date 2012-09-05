<?php
session_start();
require_once("../../../connect/conexion.php");
require_once("../../../connect/function.php");
require_once("../../../connect/sesion/verificar_sesion.php");

//VARIABLES
$idInsumo=$_POST["id"];
$insumos=$_POST["insumo"];
$grm2total=$_POST["grm2total"];
$anchofinal=$_POST["anchofinal"];
$nrobandas=$_POST["nrobandas"];
$nrocolores=$_POST["nrocolores"];
$metrototal=$_POST["metrototal"];
$repeticion=$_POST["repeticion"];
$frecuencia=$_POST["frecuencia"];
$grm2=$_POST["grm2"];
$tipo=$_POST["tipo"];
$cantidad=$_POST["cantidad"];

if($tipo=="tinta" and $idInsumo<>""){
	//TINTA
	$rst_insTinta=mysql_query("SELECT * FROM syCoesa_articulo WHERE id_articulo=$idInsumo;", $conexion);
	$fila_insTinta=mysql_fetch_array($rst_insTinta);
	$insumo_id=$fila_insTinta["id_articulo"];
	$insumo_precio=$fila_insTinta["precio_articulo"];
	$porcentaje_solido=$fila_insTinta["solido_tinta"];
	
	//FORMULA: TOTAL KG = (METROSIMPRESION * (GRM2TOTAL * (ANCHOFINAL * BANDAS))/1000000)
	$totalKg = ($metrototal * ($grm2total * ($anchofinal * $nrobandas)) / 1000000);
	
	//FORMULA: KG TINTA SECA = (GRM2TINTASECA * TOTAL KG) / TOTAL GRM2
	$KgTintaseca = ($grm2 * $totalKg) / $grm2total;
	
	//FORMULA: CANTIDADRQ = KGTINTASECA + (KGTINTASECA * % DE TINTA SOLIDA)
	$AgregadoEstruc=number_format($KgTintaseca + ($KgTintaseca * ($porcentaje_solido / 100)), 1);
	
	//TOTAL DE COSTOS
	$TotalCosto=$AgregadoEstruc * $insumo_precio;
?>
<input name="insumotinta" id="insumotinta" type="hidden" value="<?php echo $idInsumo; ?>">
<?php
}elseif($tipo=="tinta"){
	//TINTA
	$rst_insTinta=mysql_query("SELECT * FROM syCoesa_articulo WHERE id_tipo_articulo=2 AND mostrar_articulo=1 ORDER BY precio_articulo DESC;", $conexion);
	$fila_insTinta=mysql_fetch_array($rst_insTinta);
	$insumo_id=$fila_insTinta["id_articulo"];
	$insumo_precio=$fila_insTinta["precio_articulo"];
	$porcentaje_solido=$fila_insTinta["solido_tinta"];
	
	//FORMULA: TOTAL KG = (METROSIMPRESION * (GRM2TOTAL * (ANCHOFINAL * BANDAS))/1000000)
	$totalKg = ($metrototal * ($grm2total * ($anchofinal * $nrobandas)) / 1000000);
	
	//FORMULA: KG TINTA SECA = (GRM2TINTASECA * TOTAL KG) / TOTAL GRM2
	$KgTintaseca = ($grm2 * $totalKg) / $grm2total;
	
	//FORMULA: CANTIDADRQ = KGTINTASECA + (KGTINTASECA * % DE TINTA SOLIDA)
	$AgregadoEstruc=number_format($KgTintaseca + ($KgTintaseca * ($porcentaje_solido / 100)), 1);
	
	//TOTAL DE COSTOS
	$TotalCosto=$AgregadoEstruc * $insumo_precio;
?>
<input name="insumotinta" id="insumotinta" type="hidden" value="<?php echo $insumo_id; ?>">
<?php
}elseif($tipo=="cushion"){
	//SELECCIONAR DATOS DE MAQUINA
	$rst_insumos=mysql_query("SELECT * FROM syCoesa_articulo WHERE id_articulo=$insumos;", $conexion);
	$fila_insumos=mysql_fetch_array($rst_insumos);
	$insumo_precio=$fila_insumos["precio_articulo"];

	//FORMULA: CANTIDADRQ = (( ((Ancho final[mm] / 10) * Bandas) * ((Distancia de repetición[mm] / 10) * Frecuencia)) * 1.10)
	$AgregadoEstruc=number_format((((($anchofinal / 10) * $nrobandas) * (($repeticion / 10) * $frecuencia)) * 1.10),0);
	$Total_AgregadoEstruc=(((($anchofinal / 10) * $nrobandas) * (($repeticion / 10) * $frecuencia)) * 1.10);
	
	//TOTAL DE COSTOS
	$TotalCosto=($Total_AgregadoEstruc * $insumo_precio) * $nrocolores;
}elseif($tipo=="clises"){
	//SELECCIONAR DATOS DE MAQUINA
	$rst_insumos=mysql_query("SELECT * FROM syCoesa_articulo WHERE id_articulo=$insumos;", $conexion);
	$fila_insumos=mysql_fetch_array($rst_insumos);
	$insumo_precio=$fila_insumos["precio_articulo"];

	//FORMULA: CANTIDADRQ = (( ((Ancho final[mm] / 10) * Bandas) * ((Distancia de repetición[mm] / 10) * Frecuencia)))
	$AgregadoEstruc = number_format((((($anchofinal / 10) * $nrobandas) * (($repeticion / 10) * $frecuencia))),0);
	$Total_AgregadoEstruc=(((($anchofinal / 10) * $nrobandas) * (($repeticion / 10) * $frecuencia)));
	
	//TOTAL DE COSTOS
	$Costo=($Total_AgregadoEstruc * $insumo_precio) * $nrocolores;
	
	//FORMULA: (PRECIO TOTAL * CANTIDADREQUERIDA) / 300000
	$TotalCosto=($Costo * $Total_AgregadoEstruc) / 300000;
	
}else{
	//SELECCIONAR DATOS DE MAQUINA
	$rst_insumos=mysql_query("SELECT * FROM syCoesa_articulo WHERE id_articulo=$insumos;", $conexion);
	$fila_insumos=mysql_fetch_array($rst_insumos);
	$insumo_precio=$fila_insumos["precio_articulo"];
	
	//FORMULA: TOTAL KG = (METROSIMPRESION * (GRM2TOTAL * (ANCHOFINAL * BANDAS))/1000000)
	$totalKg = ($metrototal * ($grm2total * ($anchofinal * $nrobandas)) / 1000000);
	
	//FORMULA: KG TINTA SECA = (GRM2TINTASECA * TOTAL KG) / TOTAL GRM2
	$AgregadoEstruc = number_format((($grm2 * $totalKg) / $grm2total), 1);
	
	//TOTAL DE COSTOS
	$TotalCosto=$AgregadoEstruc * $insumo_precio;
}
?> 

<div style="width:150px; height:20px; padding:1% 0;" class="float_left texto_cen"><?php echo number_format($insumo_precio,3); ?></div>
<div style="width:150px; height:20px; padding:1% 0;" class="float_left texto_cen"><?php echo $AgregadoEstruc; ?></div>
<div style="width:150px; height:20px; padding:1% 0;" class="float_left texto_cen"><?php echo number_format($TotalCosto, 3); ?></div>