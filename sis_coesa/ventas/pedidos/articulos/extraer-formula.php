<?php
session_start();
require_once("../../../../connect/conexion.php");
require_once("../../../../connect/function.php");
require_once("../../../../connect/sesion/verificar_sesion.php");

//VARIABLES
$producto=$_POST["producto"];
$cliente=$_POST["cliente"];
$grm2=$_POST["grm2"];
$aux=0;
$grm2_total=0;
$grm2_OK=$_POST["grm2OK"]; //PARA EXTRAER FORMULA DE TOTAL GRM2
$QR_OK=$_POST["qrOK"]; //PARA EXTRAER FORMULA DE TOTAL QR

if($grm2_OK==1){
	//EXTRAER CODIGO UNICO DE PRODUCTO TERMINADO
	$codUnico=seleccionTabla($producto, "id_articulo", "syCoesa_articulo", $conexion);	
	
	//EXTRAER LAS LAMINAS RELACIONADAS AL PRODUCTO
	$rst_exlam=mysql_query("SELECT * FROM syCoesa_datos_tecnicos_laminas_procesos WHERE cod_unico='".$codUnico["cod_unico"]."';", $conexion);
	$fila_exlam=mysql_fetch_array($rst_exlam);
	$exlam_lamina1=seleccionTabla($fila_exlam["lamina1"], "id_articulo", "syCoesa_articulo", $conexion);
	$exlam_lamina2=seleccionTabla($fila_exlam["lamina2"], "id_articulo", "syCoesa_articulo", $conexion);
	$exlam_lamina3=seleccionTabla($fila_exlam["lamina3"], "id_articulo", "syCoesa_articulo", $conexion);
	$exlam_grm2_tintaseca=$fila_exlam["lamina1_impresion_grm2"];
	$exlam_grm2_bilaminado=$fila_exlam["lamina2_bilaminado_grm2"];
	$exlam_grm_trilaminado=$fila_exlam["lamina3_trilaminado_grm2"];
	
	//SUMA DE GRM2 DE LAMINAS
	$grm2_laminas=$exlam_lamina1["grm2_articulo"] + $exlam_lamina2["grm2_articulo"] + $exlam_lamina3["grm2_articulo"];
	
	//GRM2 TOTAL
	$grm2_total=$grm2_laminas + $exlam_grm2_tintaseca + $exlam_grm2_bilaminado + $exlam_grm_trilaminado;
	
}elseif($QR_OK==1){	
	
	//CANTIDAD REQUERIDA
	$cantidad=$_POST["cantidad"];
	$tolerancia=$_POST["tolerancia"];
	$grm2=$_POST["grm2"];
	
	//FORMUlA DE CANTIDAD PARA PRODUCCION
	$qr_total=$cantidad * (1 + ($tolerancia / 100));
	
	//EXTRAER DATOS DE DATOS TECNICOS BASICOS
	$rst_dtb=mysql_query("SELECT * FROM syCoesa_datos_tecnicos WHERE id_articulo=$producto AND id_cliente=$cliente;", $conexion);
	$fila_dtb=mysql_fetch_array($rst_dtb);
	
	$ancho_final=$fila_dtb["ancho_final_datos_tecnicos"];
	$nro_bandas=$fila_dtb["nro_bandas_datos_tecnicos"];
	$cant_colores=$fila_dtb["nro_colores_datos_tecnicos"];
	
	if($grm2==0){
		$mensaje_error="El Gr / m2 es igual a 0, por ello no se puede calcular los METROS A PRODUCIR";
	}else{
		//FORMUlA PARA METROS A PRODUCIR
		$mtrprod=($qr_total / ($ancho_final * $nro_bandas) / $grm2) * 1000000;
	}
}

?>
<?php if($grm2_OK==1){ ?>
<fieldset class="alto50 w180">
    <label for="grm2_pedido">GR / m2:</label>
    <input name="grm2_pedido" type="text" class="an50 texto_cen w130" id="grm2_pedido" value="<?php echo $grm2_total; ?>" size="50" readonly="readonly">
</fieldset>
<?php }elseif($QR_OK==1){ ?>
<fieldset class="alto50 w180">
    <label for="pedido_cantidad_produccion">Cantidad para producción:</label>
    <input name="pedido_cantidad_produccion" type="text" class="an50 texto_cen w130" id="pedido_cantidad_produccion" value="<?php echo round($qr_total); ?>" size="50" readonly="readonly">
</fieldset>

<?php if($grm2==0){ ?>
    <fieldset class="alto50 w180">
		<?php echo $mensaje_error; ?>
    </fieldset>
<?php }else{ ?>
	<fieldset class="alto50 w180">
        <label for="metros_producir">Metros a producir:</label>
        <input name="metros_producir" type="text" class="an50 texto_cen w130" id="metros_producir" value="<?php echo round($mtrprod); ?>" size="50" readonly="readonly">
    </fieldset>
<?php } ?>

<?php } ?>