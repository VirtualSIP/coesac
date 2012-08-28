<?php
session_start();
require_once("../../../connect/conexion.php");
require_once("../../../connect/function.php");
require_once("../../../connect/sesion/verificar_sesion.php");

//WEB
$web="http://coesac.marostsac.com/";

//CLIENTE
$rst_cliente=mysql_query("SELECT * FROM syCoesa_clientes ORDER BY id_cliente ASC;", $conexion);

//ARTICULO
$rst_articulo=mysql_query("SELECT * FROM syCoesa_articulo WHERE producto_terminado='A' ORDER BY id_articulo ASC;", $conexion);

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

<!-- CHAINED -->
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript" src="/libs_js/chained/jquery.chained.js"></script>
<script type="text/javascript">
var jchn = jQuery.noConflict();
jchn(document).ready(function(){
	jchn(".pedido_articulo").chained("#pedido_cliente");
});
</script>

<!-- TEXT AREA -->
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript" src="/libs_js/jquery.textareaCounter.plugin.js"></script>
<script type="text/javascript">
var jtxtar = jQuery.noConflict();
jtxtar(document).ready(function(){
	var pedido_observaciones = {
			'maxCharacterSize': 255,
			'originalStyle': 'originalTextareaInfo',
			'warningStyle' : 'warningTextareaInfo',
			'warningNumber': 40,
			'displayFormat' : '#input/#max'
	};
	jtxtar('#pedido_observaciones').textareaCount(pedido_observaciones);
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

<?php include("../../../sis_coesa/header.php"); ?>

<section id="cuerpo">
  
  	<?php require_once("../../../sis_coesa/menu.php"); ?>
    
    <section id="contenido">
    	
        <div id="datos_procesos">
        	
            <div class="formulario_datos">

              <div class="frmdt_cabecera"><h6>Pedidos</h6></div>
            
                <div class="frmdt_contenido">
                    
                  <form action="guardar.php" method="post" enctype="multipart/form-data">
                        
                        <fieldset class="alto50">
                          <label for="pedido_cliente">Cliente:</label>
                          <span id="spry_pedido_cliente">
                          <select name="pedido_cliente" id="pedido_cliente">
                            <option value>[ Seleccionar opcion ]</option>
                            <?php while($fila_cliente=mysql_fetch_array($rst_cliente)){
								//VARIABLES
								$cliente_id=$fila_cliente["id_cliente"];
								$cliente_nombre=$fila_cliente["nombre_cliente"];
								$cliente_documento=$fila_cliente["documento_cliente"];
							?>
                            <option value="<?php echo $cliente_id; ?>"><?php echo $cliente_nombre." (".$cliente_documento.")"; ?></option>
                            <?php } ?>
                          </select>
                          <span class="selectInvalidMsg">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(*)</span>
                          <span class="selectRequiredMsg">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(*)</span></span>
                        </fieldset>
                        
                        <fieldset class="alto50">
                          <label for="pedido_articulo">Articulo:</label>
                          <span id="spry_pedido_articulo">
                          <select name="pedido_articulo" id="pedido_articulo" class="pedido_articulo">
                            <option value>[ Seleccionar opcion ]</option>
                            <?php while($fila_articulo=mysql_fetch_array($rst_articulo)){
								//VARIABLES
								$articulo_id=$fila_articulo["id_articulo"];
								$articulo_nombre=$fila_articulo["nombre_articulo"];
								$articulo_cliente=$fila_articulo["id_cliente"];
							?>
                            <option value="<?php echo $articulo_id; ?>" class="<?php echo $articulo_cliente; ?>">
								<?php echo $articulo_nombre; ?></option>
                            <?php } ?>
                          </select>
                          <span class="selectInvalidMsg">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(*)</span>
                          <span class="selectRequiredMsg">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(*)</span></span>
                        </fieldset>
                        
                        <fieldset class="alto50 w180">
                            <label for="pedido_precio">Precio:</label>
                          <span id="spry_pedido_precio">
                          <input name="pedido_precio" type="text" class="an50 texto_der w130" id="pedido_precio" value="0.00" size="50">
                          <span class="textfieldRequiredMsg">(*)</span>
                          <span class="textfieldInvalidFormatMsg">(*)</span></span>
                        </fieldset>
                        
                        <fieldset class="alto50 w180">
                            <label for="pedido_cantidad">Cantidad:</label>
                          <span id="spry_pedido_cantidad">
                          <input name="pedido_cantidad" type="text" class="an50 texto_cen w130" id="pedido_cantidad" value="0" size="50">
                          <span class="textfieldRequiredMsg">(*)</span>
                          <span class="textfieldInvalidFormatMsg">(*)</span></span>
                        </fieldset>
                        
                    <fieldset>
                            <input name="dtp_btnenviar" type="submit" id="dtp_btnenviar" value="Guardar datos">
                            <input name="dtp_btnenviar" type="button" id="dtp_btnenviar" value="Cancelar" onClick="parent.location='lista.php'">
                        </fieldset>
                        
                    </form>
                    
                </div>
                     
            </div><!-- FIN FORMULARIO DATOS -->
        
        </div><!-- FIN DATOS PROCESOS -->
    
    </section><!-- FIN SECTION CONTENIDO -->
    
</section><!-- FIN SECTION -->

<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("spry_pedido_precio", "real");
var sprytextfield2 = new Spry.Widget.ValidationTextField("spry_pedido_cantidad", "integer");
var spryselect1 = new Spry.Widget.ValidationSelect("spry_pedido_articulo", {invalidValue:"-1"});
var spryselect2 = new Spry.Widget.ValidationSelect("spry_pedido_cliente", {invalidValue:"-1"});
</script>
</body>
</html>