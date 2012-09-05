<?php
session_start();
require_once("../../../connect/conexion.php");
require_once("../../../connect/function.php");
require_once("../../../connect/sesion/verificar_sesion.php");

//ARTICULOS
$rst_articulos_tipo=mysql_query("SELECT * FROM syCoesa_articulo_tipo ORDER BY id_tipo_articulo ASC;", $conexion);

//UNIDADES DE MEDIDA
$rst_unidad_medida=mysql_query("SELECT * FROM syCoesa_unidad_medida ORDER BY id_unidad_medida ASC;", $conexion);

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

<!-- DESHABILITAR ENTER -->
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script>
var jEnter = jQuery.noConflict();
jEnter(document).ready(function() {
    jEnter("form").keypress(function(e) {
        if (e.which == 13) {
            return false;
        }
    });
});
</script>

<!-- COMBO -->
<link rel="stylesheet" href="/libs_js/jquery_ui/themes/base/jquery.ui.all.css">
<script src="/libs_js/jquery-1.7.2.min.js"></script>
<script src="/libs_js/jquery_ui/ui/jquery.ui.core.js"></script>
<script src="/libs_js/jquery_ui/ui/jquery.ui.widget.js"></script>
<script src="/libs_js/jquery_ui/ui/jquery.ui.button.js"></script>
<script src="/libs_js/jquery_ui/ui/jquery.ui.position.js"></script>
<script src="/libs_js/jquery_ui/ui/jquery.ui.autocomplete.js"></script>
<link rel="stylesheet" href="/libs_js/combo/css-select.css">
<script src="/libs_js/combo/js-select.js"></script>

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

<?php include("../../../sis_coesa/header.php"); ?>

<section id="cuerpo">
  
  	<?php require_once("../../../sis_coesa/menu.php"); ?>
    
    <section id="contenido">
    	
        <div id="datos_procesos">
        	
            <div class="formulario_datos">

              <div class="frmdt_cabecera">
                <h6>Agregar Insumos</h6></div>
            
                <div class="frmdt_contenido">
                    
                  <form action="guardar.php" method="post">
                        
                        <fieldset class="an100">
                            <label for="almart_articulo">Nombre:</label>
                          <span id="spry_almart_articulo">
                            <input type="text" name="almart_articulo" id="almart_articulo" class="w450">
                            <span class="textfieldRequiredMsg">(*)</span></span>
                        </fieldset>
                        
                        <fieldset class="alto50">
                          <label for="almart_tipo_articulo">Tipo de Articulo:</label>
                          <span id="spry_almart_tipo_articulo">
                          <select name="almart_tipo_articulo" id="almart_tipo_articulo" class="cmbSlc">
                            <option value>[ Seleccionar opcion ]</option>
                            <?php while($fila_articulos_tipo=mysql_fetch_array($rst_articulos_tipo)){
								//VARIABLES
								$tipo_articulo_id=$fila_articulos_tipo["id_tipo_articulo"];
								$tipo_articulo_nombre=$fila_articulos_tipo["nombre_tipo_articulo"];
								$tipo_articulo_abreviacion=$fila_articulos_tipo["abreviado_tipo_articulo"];
							?>
                            	<option value="<?php echo $tipo_articulo_id; ?>"><?php echo $tipo_articulo_nombre."(".$tipo_articulo_abreviacion.")"; ?></option>
                            <?php } ?>
                          </select>
                          <span class="selectInvalidMsg">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(*)</span>
                          <span class="selectRequiredMsg">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(*)</span></span>
                        </fieldset>
                        
                        <fieldset class="alto50">
                            <label for="almart_abreviacion">Abreviación:</label>
                          <input type="text" name="almart_abreviacion" id="almart_abreviacion" size="50">
                        </fieldset>
                        
                        <fieldset class="alto50">
                            <label for="almart_grm2">Gr x M2:</label>
                          <span id="spry_almart_grm2">
                          <input name="almart_grm2" type="text" class="texto_cen" id="almart_grm2" value="0" size="50">
                          <span class="textfieldRequiredMsg">(*)</span>
                          <span class="textfieldInvalidFormatMsg">(*)</span></span>
                        </fieldset>
                        
                        <fieldset class="alto50">
                            <label for="almart_ancho">Ancho:</label>
                          <span id="spry_almart_ancho">
                          <input name="almart_ancho" type="text" class="texto_cen" id="almart_ancho" value="0" size="50">
                          <span class="textfieldRequiredMsg">(*)</span>
                          <span class="textfieldInvalidFormatMsg">(*)</span></span>
                        </fieldset>
                                                
                        <fieldset class="alto50">
                            <label for="almart_precio">Precio:</label>
                          <span id="spry_almart_precio">
                          <input name="almart_precio" type="text" class="texto_der" id="almart_precio" value="0.00" size="50">
                          <span class="textfieldRequiredMsg">(*)</span>
                          <span class="textfieldInvalidFormatMsg">(*)</span></span>
                        </fieldset>
                        
                        <fieldset class="alto50">
                            <label for="almart_solido">% Solido de tinta:</label>
                          <input name="almart_solido" type="text" class="texto_der" id="almart_solido" value="0" size="50">
                        </fieldset>
                        
                        <fieldset class="alto50">
                          <label for="almart_unidad_medida">Unidad de Medida:</label>
                          <span id="spry_almart_unidad_medida">
                          <select name="almart_unidad_medida" id="almart_unidad_medida" class="cmbSlc">
                            <option value>[ Seleccionar opcion ]</option>
                            <?php while($fila_unidad_medida=mysql_fetch_array($rst_unidad_medida)){
								//VARIABLES
								$unidad_medida_id=$fila_unidad_medida["id_unidad_medida"];
								$unidad_medida_nombre=$fila_unidad_medida["nombre_unidad_medida"];
							?>
                            	<option value="<?php echo $unidad_medida_id; ?>"><?php echo $unidad_medida_nombre; ?></option>
                            <?php } ?>
                          </select>
                          <span class="selectInvalidMsg">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(*)</span>
                          <span class="selectRequiredMsg">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(*)</span></span>
                        </fieldset>
                        
                        <fieldset>
                            <label for="almart_observaciones">Observaciones:</label>
                            <textarea name="almart_observaciones" cols="100" rows="8" id="almart_observaciones"></textarea>
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
var sprytextfield1 = new Spry.Widget.ValidationTextField("spry_almart_articulo");
var sprytextfield3 = new Spry.Widget.ValidationTextField("spry_almart_grm2");
var sprytextfield4 = new Spry.Widget.ValidationTextField("spry_almart_ancho");
var sprytextfield5 = new Spry.Widget.ValidationTextField("spry_almart_precio", "real");
var spryselect1 = new Spry.Widget.ValidationSelect("spry_almart_tipo_articulo", {invalidValue:"-1"});
var spryselect2 = new Spry.Widget.ValidationSelect("spry_almart_unidad_medida", {invalidValue:"-1"});
</script>
</body>
</html>