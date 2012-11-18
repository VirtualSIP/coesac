<?php
session_start();
require_once("../../../connect/conexion.php");
require_once("../../../connect/function.php");
require_once("../../../connect/sesion/verificar_sesion.php");

//VARIABLES URL
$id_registro=$_REQUEST["id"];

//ARTICULOS
$rst_articulo=mysql_query("SELECT * FROM syCoesa_articulo WHERE id_articulo=$id_registro;", $conexion);
$fila_articulo=mysql_fetch_array($rst_articulo);
$num_articulo=mysql_num_rows($rst_articulo);
if($num_articulo==0){ header("Location:lista.php"); }

//ARTICULOS - VARIABLES
$articulo_id=$fila_articulo["id_articulo"];
$articulo_tipo_articulo=$fila_articulo["id_tipo_articulo"];
$articulo_nombre=$fila_articulo["nombre_articulo"];
$articulo_abreviado=$fila_articulo["abreviado_articulo"];
$articulo_factor_milpul=$fila_articulo["factor_milpul"];
$articulo_factor_micra=$fila_articulo["factor_micra"];
$articulo_factor_material=$fila_articulo["factor_material"];
$articulo_grm2=$fila_articulo["grm2_articulo"];
$articulo_ancho=$fila_articulo["ancho_articulo"];
$articulo_precio=$fila_articulo["precio_articulo"];
$articulo_solido=$fila_articulo["solido_tinta"];
$articulo_unidad_medida=$fila_articulo["unidad_medida_articulo"];
$articulo_observaciones=$fila_articulo["observaciones_articulo"];
$articulo_cod_unico_historia=$fila_articulo["cod_unico_historia"];

//TIPOS DE ARTICULO
$rst_articulo_tipo=mysql_query("SELECT * FROM syCoesa_articulo_tipo ORDER BY nombre_tipo_articulo;", $conexion);

//UNIDAD DE MEDIDA
$rst_unidad_medida=mysql_query("SELECT * FROM syCoesa_unidad_medida ORDER BY nombre_unidad_medida;", $conexion);

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

<!-- NOMBRE DE INSUMO -->
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script>
var jNomIns=jQuery.noConflict();
jNomIns(document).ready(function(){
	jNomIns("#almart_articulo").change(function(){
		jNomIns("#progressbar").removeClass("ocultar");
		var insumo=jNomIns(this).val();
		jNomIns.post("factor-conversion.php", {insumo: insumo},
			function(data){
				jNomIns("#progressbar").addClass("ocultar");
				jNomIns("#factor-conversion").html(data);
			});
	});
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
                <h6>Insumos | ID: <?php echo $articulo_id; ?></h6></div>
            
                <div class="frmdt_contenido">
                    
                  <form action="actualizar.php" method="post">
                                                
                    	<fieldset class="alto50 an100">
                            <label for="almart_articulo">Nombre:</label>
                            <span id="spry_almart_articulo">
                            <input name="almart_articulo" type="text" id="almart_articulo" value="<?php echo $articulo_nombre; ?>" class="w450">
                            <span class="textfieldRequiredMsg">(*)</span></span>
                      	</fieldset>
                        
                        <fieldset class="alto50">
                          <label for="almart_tipo_articulo">Tipo de Articulo:</label>
                          <span id="spry_almart_tipo_articulo">                         
                          <select name="almart_tipo_articulo" id="almart_tipo_articulo" class="cmbSlc">
                              <option value>[ Seleccionar opcion ]</option>
                              	<?php while ($fila_articulo_tipo=mysql_fetch_array($rst_articulo_tipo)){
                								  //VARIABLES
                								  $tipo_articulo_id=$fila_articulo_tipo["id_tipo_articulo"];
                								  $tipo_articulo_nombre=$fila_articulo_tipo["nombre_tipo_articulo"];
                								?>
                								<?php if ($tipo_articulo_id==$articulo_tipo_articulo){ ?>
                                                 	<option selected='' value=<?php echo $tipo_articulo_id ?>><?php echo $tipo_articulo_nombre ?></option>
                                                <?php }else{ ?>
                                                 	<option value=<?php echo $tipo_articulo_id ?>><?php echo $tipo_articulo_nombre ?></option>
                								<?php }} ?>
                          </select>
                          
                          <span class="selectInvalidMsg">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(*)</span>
                          <span class="selectRequiredMsg">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(*)</span></span>
                        </fieldset>
                        
                        <?php if($articulo_factor_milpul>0 and $articulo_grm2>0){ ?>
                        	<fieldset class="alto50">
                              <label for="almart_milpul">Milesimas de Pulgada:</label>
                              <input name="almart_milpul" type="text" class="an50 texto_cen" id="almart_milpul" value="<?php echo $articulo_factor_milpul; ?>" size="50">
                              <input name="almart_grm2" type="hidden" id="almart_grm2" value="<?php echo $articulo_grm2; ?>">
                              <input name="almart_micra" type="hidden" id="almart_micra" value="<?php echo $articulo_factor_micra; ?>">
                              <input name="almart_material" id="almart_material" type="hidden" value="<?php echo $articulo_factor_material; ?>">
                          </fieldset>
                        <?php }elseif($articulo_factor_micra>0 and $articulo_grm2>0){ ?>
                        	 <fieldset class="alto50">
                              <label for="almart_micra">Micra:</label>
                              <input name="almart_micra" type="text" class="an50 texto_cen" id="almart_micra" value="<?php echo $articulo_factor_micra; ?>" size="50">
                              <input name="almart_grm2" type="hidden" id="almart_grm2" value="<?php echo $articulo_grm2; ?>">
                              <input name="almart_milpul" type="hidden" id="almart_milpul" value="<?php echo $articulo_factor_milpul; ?>">
                              <input name="almart_material" id="almart_material" type="hidden" value="<?php echo $articulo_factor_material; ?>">
                            </fieldset>
                        <?php }elseif($articulo_factor_micra==0 and $articulo_factor_milpul==0 and $articulo_grm2>0){ ?>
                        	  <fieldset class="alto50">
                                <label for="almart_grm2">Gr x M2:</label>
                              	<input name="almart_grm2" type="text" class="an50 texto_cen" id="almart_grm2" value="<?php echo $articulo_grm2; ?>" size="50">
                                <input name="almart_milpul" type="hidden" id="almart_milpul" value="<?php echo $articulo_factor_milpul; ?>">
                                <input name="almart_micra" type="hidden" id="almart_micra" value="<?php echo $articulo_factor_micra; ?>">
                                <input name="almart_material" id="almart_material" type="hidden" value="<?php echo $articulo_factor_material; ?>">
                            </fieldset>
                        <?php } ?>
                        
                        <fieldset class="alto50">
                            <label for="almart_ancho">Ancho:</label>
                          <span id="spry_almart_ancho">
                          <input name="almart_ancho" type="text" class="an50 texto_cen" id="almart_ancho" value="<?php echo $articulo_ancho; ?>" size="50">
                          <span class="textfieldRequiredMsg">(*)</span>
                          <span class="textfieldInvalidFormatMsg">(*)</span></span>
                        </fieldset>
                                                
                        <fieldset class="alto50">
                            <label for="almart_precio">Precio:</label>
                          <span id="spry_almart_precio">
                          <input name="almart_precio" type="text" class="an50 texto_der" id="almart_precio" value="<?php echo $articulo_precio; ?>" size="50">
                          <span class="textfieldRequiredMsg">(*)</span>
                          <span class="textfieldInvalidFormatMsg">(*)</span></span>
                        </fieldset>
                        
                        <?php if($articulo_tipo_articulo==2){ ?>
                        <fieldset class="alto50">
                            <label for="almart_solido">% Solido de tinta:</label>
                          	<input name="almart_solido" type="text" class="an50 texto_der" id="almart_solido" value="<?php echo $articulo_solido; ?>" size="50">
                        </fieldset>
                        <?php } ?>
                        
                        <fieldset class="alto50">
                          <label for="almart_unidad_medida">Unidad de Medida:</label>
                          <span id="spry_almart_unidad_medida">                         
                          <select name="almart_unidad_medida" id="almart_unidad_medida" class="cmbSlc">
                              <option value>[ Seleccionar opcion ]</option>
                              	<?php while ($fila_unidad_medida=mysql_fetch_array($rst_unidad_medida)){
								  //VARIABLES
								  $unidad_medida_id=$fila_unidad_medida["id_unidad_medida"];
								  $unidad_medida_nombre=$fila_unidad_medida["nombre_unidad_medida"];
								?>
								<?php if ($articulo_unidad_medida==$unidad_medida_id){ ?>
                                 	<option selected='' value=<?php echo $unidad_medida_id; ?>><?php echo $unidad_medida_nombre; ?></option>
                                <?php }else{ ?>
                                 	<option value=<?php echo $unidad_medida_id; ?>><?php echo $unidad_medida_nombre; ?></option>
								<?php }} ?>
                          </select>
                          
                          <span class="selectInvalidMsg">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(*)</span>
                          <span class="selectRequiredMsg">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(*)</span></span>
                        </fieldset>
                        
                        <fieldset>
                        	<input name="almart_id" type="hidden" id="almart_id" value="<?php echo $articulo_id; ?>">
                            <input name="cod_unico" type="hidden" id="cod_unico" value="<?php echo $articulo_cod_unico_historia; ?>">
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
var sprytextfield4 = new Spry.Widget.ValidationTextField("spry_almart_ancho");
var sprytextfield5 = new Spry.Widget.ValidationTextField("spry_almart_precio");
var spryselect1 = new Spry.Widget.ValidationSelect("spry_almart_tipo_articulo", {invalidValue:"-1"});
var spryselect2 = new Spry.Widget.ValidationSelect("spry_almart_unidad_medida", {invalidValue:"-1"});
</script>
</body>
</html>