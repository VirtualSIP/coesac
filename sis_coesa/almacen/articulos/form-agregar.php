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

<!-- CLONAR REGISTROS 
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
<script>
var jClon=jQuery.noConflict();
jClon(document).ready(function(){
	
	jClon("#dtp_btnuevo").click(function(){
		jClon(".registro_nuevo").clone().prependTo("form");
	});	
});
</script>-->

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
                        
                        <div class="registro_nuevo">
                        
                        <fieldset class="w295">
                            <label for="almart_articulo">Nombre:</label>
                            <input name="almart_articulo" type="text" class="w270" id="almart_articulo" maxlength="250">
                        </fieldset>
                        
                        <fieldset class="alto50 w150 art-unimed">
                          <label for="almart_tipo_articulo">Tipo de Articulo:</label>
                          <select name="almart_tipo_articulo" id="almart_tipo_articulo" class="cmbSlc w100">
                            <option value>[ Seleccionar opcion ]</option>
                            <?php while($fila_articulos_tipo=mysql_fetch_array($rst_articulos_tipo)){
								//VARIABLES
								$tipo_articulo_id=$fila_articulos_tipo["id_tipo_articulo"];
								$tipo_articulo_nombre=$fila_articulos_tipo["nombre_tipo_articulo"];
								$tipo_articulo_abreviacion=$fila_articulos_tipo["abreviado_tipo_articulo"];
							?>
                            	<option value="<?php echo $tipo_articulo_id; ?>"><?php echo $tipo_articulo_nombre; ?></option>
                            <?php } ?>
                          </select>
                        </fieldset>
                        
                        <div id="factor-conversion" class="alto50 w110 float_left"></div>
                        
                        
                        <fieldset class="alto50 w110">
                            <label for="almart_ancho">Ancho:</label>
                          	<input name="almart_ancho" type="text" class="texto_cen w90" id="almart_ancho" value="0" size="50">
                        </fieldset>
                                                
                        <fieldset class="alto50 w110">
                            <label for="almart_precio">Precio:</label>
                          	<input name="almart_precio" type="text" class="texto_der w90" id="almart_precio" value="0.00" size="50">
                        </fieldset>
                        
                        <fieldset class="alto50 w110">
                            <label for="almart_solido">% Solido de tinta:</label>
                          	<input name="almart_solido" type="text" class="texto_der w90" id="almart_solido" value="0" size="50">
                        </fieldset>
                        
                        <fieldset class="alto50 w150 art-unimed">
                          <label for="almart_unidad_medida">Unidad de Medida:</label>
                          <select name="almart_unidad_medida" id="almart_unidad_medida" class="cmbSlc w100">
                            <option value>[ Seleccionar opcion ]</option>
                            <?php while($fila_unidad_medida=mysql_fetch_array($rst_unidad_medida)){
								//VARIABLES
								$unidad_medida_id=$fila_unidad_medida["id_unidad_medida"];
								$unidad_medida_nombre=$fila_unidad_medida["nombre_unidad_medida"];
							?>
                            	<option value="<?php echo $unidad_medida_id; ?>"><?php echo $unidad_medida_nombre; ?></option>
                            <?php } ?>
                          </select>
                        </fieldset>
                        
                        </div>
                        
                        <fieldset>
                            <!--<a id="dtp_btnuevo" href="javascript:;">Añadir registro</a> -->
                            <input name="dtp_btnenviar" type="submit" id="dtp_btnenviar" value="Guardar datos">
                            <input name="dtp_btnenviar" type="button" id="dtp_btnenviar" value="Cancelar" onClick="parent.location='lista.php'">
                        </fieldset>
                        
                    </form>
                    
                </div>
                     
            </div><!-- FIN FORMULARIO DATOS -->
        
        </div><!-- FIN DATOS PROCESOS -->
    
    </section><!-- FIN SECTION CONTENIDO -->
    
</section><!-- FIN SECTION -->
</body>
</html>