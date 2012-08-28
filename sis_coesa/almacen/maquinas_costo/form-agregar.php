<?php
session_start();
require_once("../../../connect/conexion.php");
require_once("../../../connect/function.php");
require_once("../../../connect/sesion/verificar_sesion.php");

//MAQUINAS
$rst_maquina=mysql_query("SELECT * FROM syCoesa_mantenimiento_maquinas ORDER BY nombre_maquina ASC;", $conexion);

//TIPOS DE MAQUINA
$rst_maqtipo=mysql_query("SELECT * FROM syCoesa_mantenimiento_maquinas_tipo ORDER BY nombre_tipo_maquina ASC;", $conexion);

//ESTADO
$rst_estado=mysql_query("SELECT * FROM syCoesa_mantenimiento_estado ORDER BY nombre_estado ASC;", $conexion);

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

<!-- SPRY -->
<link rel="stylesheet" type="text/css" href="/libs_js/SpryAssets/SpryValidationTextField.css">
<link rel="stylesheet" type="text/css" href="/libs_js/SpryAssets/SpryValidationSelect.css">
<link rel="stylesheet" type="text/css" href="/libs_js/SpryAssets/SpryValidationTextarea.css">
<script type="text/javascript" src="/libs_js/SpryAssets/SpryValidationSelect.js"></script>
<script type="text/javascript" src="/libs_js/SpryAssets/SpryValidationTextField.js"></script>
<script type="text/javascript" src="/libs_js/SpryAssets/SpryValidationTextarea.js"></script>

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
	var maquina_observaciones = {
			'maxCharacterSize': 255,
			'originalStyle': 'originalTextareaInfo',
			'warningStyle' : 'warningTextareaInfo',
			'warningNumber': 40,
			'displayFormat' : '#input/#max'
	};
	jtxtar('#maquina_observaciones').textareaCount(maquina_observaciones);
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

<!-- TIMEPICKER -->
<link rel="stylesheet" href="/libs_js/timepicker/jquery-ui-timepicker-addon.css">
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
<script src="/libs_js/timepicker/jquery-ui-timepicker-addon.js"></script>
<script src="/libs_js/timepicker/jquery-ui-sliderAccess.js"></script>
<script>
var jTimeP = jQuery.noConflict();
jTimeP(document).ready(function(){
	jTimeP('#preparacion_maq, #regulacion_maq').timepicker({
		timeOnlyTitle: 'Seleccionar tiempo',
		timeText: 'Tiempo',
		hourText: 'Hora',
		minuteText: 'Minuto',
		secondText: 'Segundo',
		currentText: 'Ahora',
		closeText: 'Cerrar',
		showSecond: true,
		timeFormat: 'hh:mm:ss'
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

              <div class="frmdt_cabecera"><h6>Datos de Máquina</h6></div>
            
                <div class="frmdt_contenido">
                    
                  <form action="guardar.php" method="post" enctype="multipart/form-data">
                        
                        <fieldset class="alto50">
                          <label for="maquina_nombre">Máquina:</label>
                          <span id="spry_maquina_nombre">
                          <select name="maquina_nombre" id="maquina_nombre" class="cmbSlc">
                            <option value>[ Seleccionar opcion ]</option>
                            <?php while($fila_maquina=mysql_fetch_array($rst_maquina)){
								//VARIABLES
								$maquina_id=$fila_maquina["id_maquina"];
								$maquina_nombre=$fila_maquina["nombre_maquina"];
							?>
                            	<option value="<?php echo $maquina_id; ?>"><?php echo $maquina_nombre; ?></option>
                            <?php } ?>
                          </select>
                          <span class="selectInvalidMsg">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(*)</span>
                          <span class="selectRequiredMsg">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(*)</span></span>
                        </fieldset>
                        
                        <fieldset class="alto50">
                          <label for="maquina_tipo">Tipo de máquina:</label>
                          <select name="maquina_tipo" id="maquina_tipo" class="cmbSlc">
                            <option value>[ Seleccionar opcion ]</option>
                            <?php while($fila_maqtipo=mysql_fetch_array($rst_maqtipo)){
								//VARIABLES
								$maqtipo_id=$fila_maqtipo["id_tipo_maquina"];
								$maqtipo_nombre=$fila_maqtipo["nombre_tipo_maquina"];
							?>
                            	<option value="<?php echo $maqtipo_id; ?>"><?php echo $maqtipo_nombre; ?></option>
                            <?php } ?>
                          </select>
                        </fieldset>
                        
                        <fieldset class="alto50">
                          <label for="maquina_estado">Estado:</label>
                          <span id="spry_maquina_estado">
                          <select name="maquina_estado" id="maquina_estado" class="cmbSlc">
                            <option value>[ Seleccionar opcion ]</option>
                            <?php while($fila_estado=mysql_fetch_array($rst_estado)){
								//VARIABLES
								$estado_id=$fila_estado["id_estado"];
								$estado_nombre=$fila_estado["nombre_estado"];
							?>
                            	<option value="<?php echo $estado_id; ?>"><?php echo $estado_nombre; ?></option>
                            <?php } ?>
                          </select>
                          <span class="selectInvalidMsg">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(*)</span>
                          <span class="selectRequiredMsg">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(*)</span></span>
                        </fieldset>
                        
                        <fieldset class="alto50">
                            <label for="maquina_amperios">Amperios:</label>
                          <input name="maquina_amperios" type="text" class="an50 texto_cen" id="maquina_amperios" value="0" size="50">
                        </fieldset>
                        
                        <fieldset class="alto50">
                            <label for="maquina_potenciakw">Potencia Kw:</label>
                          <input name="maquina_potenciakw" type="text" class="an50 texto_cen" id="maquina_potenciakw" value="0" size="50">
                        </fieldset>
                                                
                        <fieldset class="alto50">
                            <label for="maquina_costokw_hora">Costo Kw / Hora:</label>
                          <input name="maquina_costokw_hora" type="text" class="an50 texto_cen" id="maquina_costokw_hora" value="0" size="50">
                        </fieldset>
                        
                        <fieldset class="alto50">
                            <label for="maquina_costohora_hombre">Costo Hora / Hombre:</label>
                          <input name="maquina_costohora_hombre" type="text" class="an50 texto_cen" id="maquina_costohora_hombre" value="0" size="50">
                        </fieldset>
                        
                        <fieldset class="alto50">
                          <label for="maquina_costodepreciacion_hora">Costo Depreciación / Hora:</label>
                          <input name="maquina_costodepreciacion_hora" type="text" class="an50 texto_cen" id="maquina_costodepreciacion_hora" value="0" size="50">
                        </fieldset>
                                                
                        <fieldset class="alto50">
                          <label for="maquina_gastosfabrica_hora">Gastos de Fábrica / Hora:</label>
                          <input name="maquina_gastosfabrica_hora" type="text" class="an50 texto_cen" id="maquina_gastosfabrica_hora" value="0" size="50">
                        </fieldset>
                        
                        <fieldset class="alto50">
                          <label for="maquina_estaciones_cuerpo">Estaciones / Cuerpo:</label>
                          <input name="maquina_estaciones_cuerpo" type="text" class="an50 texto_cen" id="maquina_estaciones_cuerpo" value="0" size="50">
                        </fieldset>
                        
                        <fieldset class="alto50">
                            <label for="maquina_refile">Refile:</label>
                          <input name="maquina_refile" type="text" class="an50 texto_cen" id="maquina_refile" value="0" size="50">
                        </fieldset>
                        
                        <fieldset class="alto50">
                            <label for="maquina_ancho_maximo">Ancho máximo:</label>
                          <input name="maquina_ancho_maximo" type="text" class="an50 texto_cen" id="maquina_ancho_maximo" value="0" size="50">
                        </fieldset>
                                                
                        <fieldset class="alto50">
                            <label for="maquina_velocidad">Velocidad:</label>
                          <input name="maquina_velocidad" type="text" class="an50 texto_cen" id="maquina_velocidad" value="0" size="50">
                        </fieldset>
                        
                        <fieldset class="alto50">
                            <label for="maquina_personas_requeridas">Nro. Personas requeridas:</label>
                          <input name="maquina_personas_requeridas" type="text" class="an50 texto_cen" id="maquina_personas_requeridas" value="0" size="50">
                        </fieldset>
                                                                        
                        <fieldset class="alto50">
                          <label for="maquina_tolerancia">Tolerancia MM:</label>
                          <input name="maquina_tolerancia" type="text" class="an50 texto_cen" id="maquina_tolerancia" value="0" size="50">
                        </fieldset>
                        
                        <fieldset class="alto50">
                          <label for="merma_permitida">Merma permitida:</label>
                          <input name="merma_permitida" type="text" class="an50 texto_cen" id="merma_permitida" value="0" size="50">
                        </fieldset>
                        
                        <fieldset class="alto50">
                          <label for="preparacion_maq">Preparación:</label>
                          <input name="preparacion_maq" type="text" class="an50 texto_cen" id="preparacion_maq" value="00:00:00" size="50">
                        </fieldset>
                        
                        <fieldset class="alto50">
                          <label for="regulacion_maq">Regulación:</label>
                          <input name="regulacion_maq" type="text" class="an50 texto_cen" id="regulacion_maq" value="00:00:00" size="50">
                        </fieldset>
                    
                    <div class="an100 float_left">
                    <p class="texto_bold">Procesos</p>
                    <p>&nbsp;</p>
                    <?php
					//PROCESOS PRODUCTIVOS
					$rst_procesos=mysql_query("SELECT * FROM syCoesa_mantenimiento_procesos_productivos ORDER BY orden_proceso ASC;", $conexion);
                    ?>
                    
                    <?php
                    	while($fila_procesos=mysql_fetch_array($rst_procesos)){
							//VARIABLES
							$procesos_id=$fila_procesos["id_proceso"];
							$procesos_nombre=$fila_procesos["nombre_proceso"];
					?>
                    	
                        <fieldset class="w245">
                        	<label><input name="procesos<?php echo $i;?>[]" type="checkbox" value="<?php echo $procesos_id; ?>">&nbsp;<?php echo $procesos_nombre; ?></label>
                        </fieldset>
                        
                    <?php } ?>
                    
                    </div>
                        
                        <fieldset>
                            <label for="maquina_observaciones">Observaciones:</label>
                            <textarea name="maquina_observaciones" cols="100" rows="8" id="maquina_observaciones"></textarea>
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
var spryselect1 = new Spry.Widget.ValidationSelect("spry_maquina_nombre", {invalidValue:"-1"});
var spryselect2 = new Spry.Widget.ValidationSelect("spry_maquina_estado", {invalidValue:"-1"});
</script>
</body>
</html>