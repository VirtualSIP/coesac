<?php
session_start();
require_once("../../../connect/conexion.php");
require_once("../../../connect/function.php");
require_once("../../../connect/sesion/verificar_sesion.php");

//CLIENTE
$rst_cliente=mysql_query("SELECT * FROM syCoesa_clientes ORDER BY id_cliente ASC;", $conexion);

//ARTICULO
$rst_articulo=mysql_query("SELECT * FROM syCoesa_articulo WHERE id_articulo>0;", $conexion);

//UNIDADES DE MEDIDA
$rst_unidad_medida=mysql_query("SELECT * FROM syCoesa_unidad_medida WHERE id_unidad_medida=1 OR id_unidad_medida=3 ORDER BY id_unidad_medida ASC;", $conexion);

//NUMERO DE COLORES
$rst_mqdt_colores=mysql_query("SELECT * FROM syCoesa_mantenimiento_maquinas_datos ORDER BY estacion_cuerpo_maquina DESC LIMIT 1;", $conexion);
$fila_mqdt_colores=mysql_fetch_array($rst_mqdt_colores);
$mqdt_colores_estacion=$fila_mqdt_colores["estacion_cuerpo_maquina"];

//NUMERO DE BANDAS
$rst_mqdt_bandas=mysql_query("SELECT * FROM syCoesa_mantenimiento_maquinas_datos ORDER BY ancho_max_maquina DESC LIMIT 1;", $conexion);
$fila_mqdt_bandas=mysql_fetch_array($rst_mqdt_bandas);
$mqdt_bandas_ancho=$fila_mqdt_bandas["ancho_max_maquina"];

//SENTIDO DE BOBINA
$rst_sentbob=mysql_query("SELECT * FROM syCoesa_mantenimiento_sentido_bobina ORDER BY id_sentido_bobina ASC;", $conexion);

//CILINDROS
$rst_cilindro=mysql_query("SELECT * FROM syCoesa_mantenimiento_cilindro ORDER BY id_cilindro ASC;", $conexion);

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
	var dtecnicos_observaciones = {
			'maxCharacterSize': 255,
			'originalStyle': 'originalTextareaInfo',
			'warningStyle' : 'warningTextareaInfo',
			'warningNumber': 40,
			'displayFormat' : '#input/#max'
	};
	jtxtar('#dtecnicos_observaciones').textareaCount(dtecnicos_observaciones);
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

<!-- NUMERO DE BANDAS -->
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
<script>
var jnrobd = jQuery.noConflict();
jnrobd(document).ready(function(){
	jnrobd("#dtecnicos_ancho_final").change(function(){
		var anchofinal = jnrobd("#dtecnicos_ancho_final").val();
		jnrobd.post("formula.php", {anchofinal: anchofinal, anchomax: <?php echo $mqdt_bandas_ancho; ?>},
			function(data){
				jnrobd("#item-nrobandas").html(data);
			});
	});
});
</script>

<!-- SELECT CON IMAGEN -->
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script src="/libs_js/ddslick/jquery.ddslick.min.js"></script>
<script>
var jcmbimg = jQuery.noConflict();
jcmbimg(document).ready(function() {
	jcmbimg('#dtecnicos_sentido_bobina').ddslick({
		width: 225,
		height: 215,
		selectText: "Seleccione"
	});	
});
</script>

<!-- FRECUENCIA -->
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script>
var jFrec = jQuery.noConflict();
jFrec(document).ready(function(){
	jFrec("#dtecnicos_repeticion").change(function(){
		var cilindro = jFrec("#dtecnicos_cilindro").val();
		var repeticion = jFrec(this).val();
		jFrec.post("frecuencia.php", {cilindro: cilindro, repeticion: repeticion},
			function(data){
				jFrec("#frecuencia").html(data);
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
                <h6>Productos</h6></div>
            
                <div class="frmdt_contenido">
                    
                  <form action="guardar.php" method="post" enctype="multipart/form-data">
                        
                        <div class="panel_izq">
                        
                        <fieldset class="alto50">
                          <label for="dtecnicos_cliente">Cliente:</label>
                          <span id="spry_dtecnicos_cliente">
                          <select name="dtecnicos_cliente" id="dtecnicos_cliente" class="cmbSlc">
                            <option value>[ Seleccionar opcion ]</option>
                            <?php while($fila_cliente=mysql_fetch_array($rst_cliente)){
								//VARIABLES
								$cliente_id=$fila_cliente["id_cliente"];
								$cliente_nombre=$fila_cliente["nombre_cliente"];
								$cliente_documento=$fila_cliente["documento_cliente"];
							?>
                            <option value=<?php echo $cliente_id; ?>><?php echo $cliente_nombre." (".$cliente_documento.")"; ?></option>
                            <?php } ?>
                          </select>
                          <span class="selectInvalidMsg">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(*)</span>
                          <span class="selectRequiredMsg">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(*)</span></span>
                        </fieldset>
                        
                        <fieldset class="alto50">
                          <label for="dtecnicos_articulo">Producto:</label>
                          <input name="dtecnicos_articulo" id="dtecnicos_articulo" type="text">
                        </fieldset>
                        
                        <fieldset class="alto50 w180">
                          <label for="dtecnicos_cilindro">Cilindro (mm):</label>
                          <select name="dtecnicos_cilindro" id="dtecnicos_cilindro" class="w140">
                            <option value>Seleccione</option>
                            <?php while($fila_cilindro=mysql_fetch_array($rst_cilindro)){
								//VARIABLES
								$cilindro_id=$fila_cilindro["id_cilindro"];
								$cilindro_nombre=$fila_cilindro["cilindro"]."/".$fila_cilindro["engranaje"];
							?>
                            	<option value="<?php echo $cilindro_id; ?>"><?php echo $cilindro_nombre; ?></option>
                            <?php } ?>
                          </select>
                        </fieldset>
                        
                        <fieldset class="alto50 w180">
                            <label for="dtecnicos_repeticion">Distancia de repetición (mm):</label>
                          <input type="text" name="dtecnicos_repeticion" id="dtecnicos_repeticion" size="50" class="w130 texto_der" value="0">
                        </fieldset>
                        
                        <div id="frecuencia" class="w180 float_left">
                        <fieldset class="alto50 w180">
                            <label for="dtecnicos_frecuencia">Nro de Repeticiones (Und):</label>
                          <input name="dtecnicos_frecuencia" type="text" class="w130 texto_der" id="dtecnicos_frecuencia" value="0" size="50" readonly>
                        </fieldset>
                        </div>
                        
                        <fieldset class="alto50 w180">
                            <label for="dtecnicos_ancho_final">Ancho final (mm):</label>
                          <span id="spry_dtecnicos_ancho_final">
                          <input name="dtecnicos_ancho_final" type="text" class="w130 texto_der" id="dtecnicos_ancho_final" value="0" size="50" >
                          <span class="textfieldRequiredMsg">(*)</span>
                          <span class="textfieldInvalidFormatMsg">(*)</span></span>
                        </fieldset>
                        
                        <fieldset class="alto50 w180" id="item-nrobandas">
                            <label for="dtecnicos_numbandas">Número de bandas:</label>
                          	<span id="spry_dtecnicos_numbandas">
                            <select name="dtecnicos_numbandas" id="dtecnicos_numbandas" class="w140">
                              <option value>Seleccione</option>
                            </select>
                            <span class="selectInvalidMsg">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(*)</span>
                          <span class="selectRequiredMsg">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(*)</span></span>
                        </fieldset>
                        
                        <fieldset class="alto50 w180">
                            <label for="dtecnicos_numcolores">Número de colores:</label>
                             <span id="spry_dtecnicos_numcolores">
                            <select name="dtecnicos_numcolores" id="dtecnicos_numcolores" class="w140">
                              <option value>Seleccione</option>
                              <?php for($j=1; $j<=$mqdt_colores_estacion; $j++){ ?>
                              <option value="<?php echo $j; ?>"><?php echo $j; ?></option>
                              <?php } ?>
                            </select>
                            <span class="selectInvalidMsg">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(*)</span>
                          <span class="selectRequiredMsg">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(*)</span></span>
						</fieldset>
                        
                        <fieldset>
                            <label for="dtecnicos_observaciones">Observaciones:</label>
                            <textarea name="dtecnicos_observaciones" cols="100" rows="8" id="dtecnicos_observaciones"></textarea>
                        </fieldset>
                    
                    </div><!-- FIN PANEL IZQUIERDA -->
                    
                    <div class="panel_der">
                        
                        <fieldset class="alto50">
                          <label for="dtecnicos_unidad_medida">Unidad de Medida:</label>
                          <span id="spry_dtecnicos_unidad_medida">
                          <select name="dtecnicos_unidad_medida" id="dtecnicos_unidad_medida" class="cmbSlc">
                            <option value>[ Seleccionar opcion ]</option>
                            <?php while($fila_unidad_medida=mysql_fetch_array($rst_unidad_medida)){
								//VARIABLES
								$unidad_medida_id=$fila_unidad_medida["id_unidad_medida"];
								$unidad_medida_nombre=$fila_unidad_medida["nombre_unidad_medida"];
								$unidad_medida_factor_conversion=$fila_unidad_medida["factor_conversion_unidad_medida"];
							?>
                            	<option value="<?php echo $unidad_medida_id; ?>"><?php echo $unidad_medida_nombre."(".$unidad_medida_factor_conversion.")"; ?></option>
                            <?php } ?>
                          </select>
                          <span class="selectInvalidMsg">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(*)</span>
                          <span class="selectRequiredMsg">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(*)</span></span>
                        </fieldset>
                        
                        <fieldset class="w180">
                            <label for="dtecnicos_sentido_bobina" style="float:none;">Sentido de bobina:</label>
                            <span id="spry_dtecnicos_sentido_bobina">
                            <select name="dtecnicos_sentido_bobina" id="dtecnicos_sentido_bobina" class="w140">
                            	<?php while($fila_sentbob=mysql_fetch_array($rst_sentbob)){
									$sentbob_id=$fila_sentbob["id_sentido_bobina"];
									$sentbob_numero=$fila_sentbob["numero_sentido_bobina"];
									$sentbob_imagen=$fila_sentbob["imagen_sentido_bobina"];
									$sentbob_tipo=seleccionTabla($fila_sentbob["tipo_sentido_bobina"], "id_sentido_bobina_tipo", "syCoesa_mantenimiento_sentido_bobina_tipo", $conexion);
								?>
                                  <option value="<?php echo $sentbob_id; ?>" data-imagesrc="/imagenes/sentidos_bobina/<?php echo $sentbob_imagen; ?>" data-description="Tipo de Impresión: <?php echo $sentbob_tipo["nombre_sentido_bobina_tipo"]; ?>"><?php echo $sentbob_numero; ?></option>
                              	<?php } ?>
                            </select>
                            <span class="selectInvalidMsg">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(*)</span>
                          <span class="selectRequiredMsg">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(*)</span></span>
                    	</fieldset>
                        
                    	<fieldset class="alto50">
                            <label for="dtecnicos_imagen">Imagen:</label>
                          	<input name="dtecnicos_imagen" type="file" id="dtecnicos_imagen">
                        </fieldset>
                        
                   		<fieldset>
                            <input name="dtp_btnenviar" type="submit" id="dtp_btnenviar" value="Guardar datos">
                            <input name="dtp_btnenviar" type="button" id="dtp_btnenviar" value="Cancelar" onClick="parent.location='lista.php'">
                        </fieldset>
                    
                    </div><!-- FIN PANEL DERECHA -->
                    
                    </form>
                    
                </div>
                     
            </div><!-- FIN FORMULARIO DATOS -->
        
        </div><!-- FIN DATOS PROCESOS -->
    
    </section><!-- FIN SECTION CONTENIDO -->
    
</section><!-- FIN SECTION -->

<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("spry_dtecnicos_ancho_final", "real");
var spryselect2 = new Spry.Widget.ValidationSelect("spry_dtecnicos_cliente", {invalidValue:"-1"});
var spryselect4 = new Spry.Widget.ValidationSelect("spry_dtecnicos_numcolores", {invalidValue:"-1"});
var spryselect5 = new Spry.Widget.ValidationSelect("spry_dtecnicos_sentido_bobina", {invalidValue:"-1"});
var spryselect6 = new Spry.Widget.ValidationSelect("spry_dtecnicos_unidad_medida", {invalidValue:"-1"});
</script>
</body>
</html>