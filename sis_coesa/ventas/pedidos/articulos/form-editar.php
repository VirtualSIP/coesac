<?php
session_start();
require_once("../../../../connect/conexion.php");
require_once("../../../../connect/function.php");
require_once("../../../../connect/sesion/verificar_sesion.php");



//VARIABLES URL
$id_pedido=$_REQUEST["id"];
$id_cliente=$_REQUEST["clt"];
$id_pda=$_REQUEST["pda"];

//ARTICULOS
$rst_articulo=mysql_query("SELECT * FROM syCoesa_pedidos_articulos WHERE id_pedido_articulo=$id_pda;", $conexion);
$fila_articulo=mysql_fetch_array($rst_articulo);

//ARTICULOS - VARIABLES
$pedido_articulo=seleccionTabla($fila_articulo["id_articulo"],"id_articulo","syCoesa_articulo",$conexion);
$pedido_precio=$fila_articulo["precio_pedido"];
$pedido_cantidad=$fila_articulo["cantidad_pedido"];
$pedido_tolerancia=$fila_articulo["tolerancia_pedido"];
$pedido_utilidad=$fila_articulo["utilidad_pedido"];
$pedido_grm2=$fila_articulo["grm2_total"];
$pedido_cantidad_produccion=$fila_articulo["cantidad_produccion"];
$pedido_metros=$fila_articulo["metros_producir"];

?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>COESA</title>

<!-- ESTILOS -->
<link rel="stylesheet" type="text/css" href="/css/normalize.css">
<link rel="stylesheet" type="text/css" href="/css/estilos_sis_coesa.css">

<!-- FUENTES -->
<link href='http://fonts.googleapis.com/css?family=Cuprum:400,700' rel='stylesheet' type='text/css'>

<!-- SPRY -->
<link rel="stylesheet" type="text/css" href="/libs_js/SpryAssets/SpryValidationTextField.css">
<link rel="stylesheet" type="text/css" href="/libs_js/SpryAssets/SpryValidationSelect.css">
<link rel="stylesheet" type="text/css" href="/libs_js/SpryAssets/SpryValidationTextarea.css">
<script type="text/javascript" src="/libs_js/SpryAssets/SpryValidationSelect.js"></script>
<script type="text/javascript" src="/libs_js/SpryAssets/SpryValidationTextField.js"></script>
<script type="text/javascript" src="/libs_js/SpryAssets/SpryValidationTextarea.js"></script>

<!-- TEXT AREA -->
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript" src="/libs_js/jquery.textareaCounter.plugin.js"></script>
<script type="text/javascript">
var jtxtar = jQuery.noConflict();
jtxtar(document).ready(function(){
	var almart_observaciones = {
			'maxCharacterSize': 255,
			'originalStyle': 'originalTextareaInfo',
			'warningStyle' : 'warningTextareaInfo',
			'warningNumber': 40,
			'displayFormat' : '#input/#max'
	};
	jtxtar('#almart_observaciones').textareaCount(almart_observaciones);	
});
</script>

<!-- MENU -->
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript" src="/libs_js/effc_menu/jscript_jzScrollHorizontalPane.js"></script>
<script type="text/javascript" src="/libs_js/effc_menu/jscript_jquery.dimensions.js"></script>
<script type="text/javascript" src="/libs_js/effc_menu/jscript_jquery.mousewheel.min.js"></script>
<script type="text/javascript">
var jmenu = jQuery.noConflict();
jmenu(document).ready(function(){
	if(jmenu("#nav")) {
		jmenu("#nav dd").hide();
		jmenu("#nav dt b").click(function() {
			if(this.className.indexOf("clicked") != -1) {
				jmenu(this).parent().next().slideUp(200);
				jmenu(this).removeClass("clicked");
			}
			else {
				jmenu("#nav dt b").removeClass();
				jmenu(this).addClass("clicked");
				jmenu("#nav dd:visible").slideUp(200);
				jmenu(this).parent().next().slideDown(500);
			}
			return false;
		});
	}
});
</script>

</head>

<body>

<?php include("../../../../sis_coesa/header.php"); ?>

<section id="cuerpo">
  
  	<?php require_once("../../../../sis_coesa/menu.php"); ?>
    
    <section id="contenido">
    	
        <div id="datos_procesos">
        	
            <div class="formulario_datos">

              <div class="frmdt_cabecera">
                <h6>Productos | ID: <?php echo $articulo_id; ?></h6></div>
            
                <div class="frmdt_contenido">
                    
                  <form action="actualizar.php" method="post">
                                                
                    	<fieldset class="alto50 an100">
                            <label for="almart_articulo">Nombre:</label>
                            <input name="almart_articulo" type="text" id="almart_articulo" value="<?php echo $pedido_articulo["nombre_articulo"]; ?>" size="50" class="w450">
                      	</fieldset>
                        
                        <fieldset class="alto50">
                            <label for="almart_precio">Precio:</label>
                          <span id="spry_almart_precio">
                          <input name="almart_precio" type="text" class="an50 texto_der" id="almart_precio" value="<?php echo $pedido_precio; ?>" size="50">
                          <span class="textfieldRequiredMsg">(*)</span>
                          <span class="textfieldInvalidFormatMsg">(*)</span></span>
                        </fieldset>
                        
                        <fieldset class="alto50">
                            <label for="almart_cantidad">Cantidad para cliente:</label>
                          <span id="spry_almart_cantidad">
                          <input name="almart_cantidad" type="text" class="an50 texto_cen" id="almart_cantidad" value="<?php echo $pedido_cantidad; ?>" size="50">
                          <span class="textfieldRequiredMsg">(*)</span>
                          <span class="textfieldInvalidFormatMsg">(*)</span></span>
                        </fieldset>
                        
                        <fieldset class="alto50">
                            <label for="tolerancia_pedido">% Tolerancia de Pedido:</label>
                          <input name="tolerancia_pedido" type="text" class="an50 texto_cen" id="tolerancia_pedido" value="<?php echo $pedido_tolerancia; ?>" size="50">
                        </fieldset>
                        
                        <fieldset class="alto50">
                            <label for="utilidad_pedido">% Utilidad:</label>
                          <input name="utilidad_pedido" type="text" class="an50 texto_cen" id="utilidad_pedido" value="<?php echo $pedido_utilidad; ?>" size="50">
                        </fieldset>
                        
                        <fieldset class="alto50">
                            <label for="grm2_pedido">GR / m2:</label>
                          <input name="grm2_pedido" type="text" class="an50 texto_cen" id="grm2_pedido" value="<?php echo $pedido_grm2; ?>" size="50">
                        </fieldset>
                        
                        <fieldset class="alto50">
                            <label for="cantidad_pedido_produccion">Cantidad para producción:</label>
                          <input name="cantidad_pedido_produccion" type="text" class="an50 texto_cen" id="cantidad_pedido_produccion" value="<?php echo $pedido_cantidad_produccion; ?>" size="50">
                        </fieldset>
                        
                        <fieldset class="alto50">
                            <label for="metros_pedido">Metros a producir:</label>
                          <input name="metros_pedido" type="text" class="an50 texto_cen" id="metros_pedido" value="<?php echo $pedido_metros; ?>" size="50">
                        </fieldset>
                        
                        <fieldset>
                        	<input name="pedido" type="hidden" id="pedido" value="<?php echo $id_pedido; ?>">
                            <input name="cliente" type="hidden" id="cliente" value="<?php echo $id_cliente; ?>">
                            <input name="pda" type="hidden" id="pda" value="<?php echo $id_pda; ?>">
                            <input name="dtp_btnenviar" type="submit" id="dtp_btnenviar" value="Guardar datos">
                            <input name="dtp_btnenviar" type="button" id="dtp_btnenviar" value="Cancelar" onClick="parent.location='lista.php?id=<?php echo $id_pedido; ?>&clt=<?php echo $id_cliente; ?>'">
                        </fieldset>
                        
                    </form>
                    
                </div>
                     
            </div><!-- FIN FORMULARIO DATOS -->
        
        </div><!-- FIN DATOS PROCESOS -->
    
    </section><!-- FIN SECTION CONTENIDO -->
    
</section><!-- FIN SECTION -->
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("spry_almart_cantidad", "integer");
var sprytextfield2 = new Spry.Widget.ValidationTextField("spry_almart_precio", "real");
</script>
</body>
</html>