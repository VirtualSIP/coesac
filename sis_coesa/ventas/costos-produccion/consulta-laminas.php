<?php
session_start();
require_once("../../../connect/conexion.php");
require_once("../../../connect/function.php");
require_once("../../../connect/sesion/verificar_sesion.php");

//VARIABLES
$dtecnicos_cliente=$_POST["cliente"];
$dtecnicos_articulo=$_POST["articulo"];
$aux=0;

//EXTRAER CODIGO UNICO DE PRODUCTO TERMIANDO
$codUnico=seleccionTabla($dtecnicos_articulo, "id_articulo", "syCoesa_articulo", $conexion);

//SELECCIONAR LAMINAS
$rst_ver=mysql_query("SELECT * FROM syCoesa_datos_tecnicos_laminas_procesos WHERE cod_unico='".$codUnico["cod_unico"]."';", $conexion);
$fila_ver=mysql_fetch_array($rst_ver);

//LAMINA 1
$articulo_lamina1=seleccionTabla($fila_ver["lamina1"], "id_articulo", "syCoesa_articulo", $conexion);
$artlamina1_id=$articulo_lamina1["id_articulo"];
$artlamina1_nombre=$articulo_lamina1["nombre_articulo"];
$artlamina1_grm2=$articulo_lamina1["grm2_articulo"];
$artlamina1_ancho=$articulo_lamina1["ancho_articulo"];
$artlamina1_precio=$articulo_lamina1["precio_articulo"];

//LAMINA 2
$articulo_lamina2=seleccionTabla($fila_ver["lamina2"], "id_articulo", "syCoesa_articulo", $conexion);
$artlamina2_id=$articulo_lamina2["id_articulo"];
$artlamina2_nombre=$articulo_lamina2["nombre_articulo"];
$artlamina2_grm2=$articulo_lamina2["grm2_articulo"];
$artlamina2_ancho=$articulo_lamina2["ancho_articulo"];
$artlamina2_precio=$articulo_lamina2["precio_articulo"];

//LAMINA 3
$articulo_lamina3=seleccionTabla($fila_ver["lamina3"], "id_articulo", "syCoesa_articulo", $conexion);
$artlamina3_id=$articulo_lamina3["id_articulo"];
$artlamina3_nombre=$articulo_lamina3["nombre_articulo"];
$artlamina3_grm2=$articulo_lamina3["grm2_articulo"];
$artlamina3_ancho=$articulo_lamina3["ancho_articulo"];
$artlamina3_precio=$articulo_lamina3["precio_articulo"];

?>

<!-- SELECCIONAR -->
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
<script>
var jcmbPed = jQuery.noConflict();
jcmbPed(document).ready(function(){
	jcmbPed("#progressbar").removeClass("ocultar");
	jcmbPed.post("consulta-maquinas.php", {artTerm: <?php echo $dtecnicos_articulo; ?>, cliente: <?php echo $dtecnicos_cliente; ?>},
		function(data){
			jcmbPed("#progressbar").addClass("ocultar");
			jcmbPed('#maquinas_articulo').html(data);
		});
});
</script>

<table width="100%" border="1" cellspacing="5" cellpadding="5">
	<thead>
        <tr>
            <td width="55%" class="texto_cen texto_11 fondo_c1 texto_bold">Lamina</td>
            <td width="15%" class="texto_cen texto_11 fondo_c1 texto_bold">GR / m2</td>
            <td width="15%" class="texto_cen texto_11 fondo_c1 texto_bold">Ancho</td>
            <td width="15%" class="texto_cen texto_11 fondo_c1 texto_bold">Precio</td>
        </tr>
	</thead>
    <tbody>
    
    <?php if($articulo_lamina1>0){ ?>
	<tr>
        <td class="texto_izq"><?php echo $artlamina1_nombre; ?></td>
        <td class="texto_der"><?php echo $artlamina1_grm2; ?></td>
        <td class="texto_der"><?php echo $artlamina1_ancho; ?></td>
        <td class="texto_der"><?php echo $artlamina1_precio; ?></td>
    </tr>
    <?php } ?>
    
    <?php if($articulo_lamina2>0){ ?>
	<tr>
        <td class="texto_izq"><?php echo $artlamina2_nombre; ?></td>
        <td class="texto_der"><?php echo $artlamina2_grm2; ?></td>
        <td class="texto_der"><?php echo $artlamina2_ancho; ?></td>
        <td class="texto_der"><?php echo $artlamina2_precio; ?></td>
    </tr>
    <?php } ?>
    
    <?php if($articulo_lamina3>0){ ?>
	<tr>
        <td class="texto_izq"><?php echo $artlamina3_nombre; ?></td>
        <td class="texto_der"><?php echo $artlamina3_grm2; ?></td>
        <td class="texto_der"><?php echo $artlamina3_ancho; ?></td>
        <td class="texto_der"><?php echo $artlamina3_precio; ?></td>
    </tr>
    <?php } ?>
      
	</tbody>
</table>

<div id="maquinas_articulo" class="float_left"></div>