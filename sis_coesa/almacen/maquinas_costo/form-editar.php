<?php
session_start();
require_once("../../../connect/conexion.php");
require_once("../../../connect/function.php");
require_once("../../../connect/sesion/verificar_sesion.php");

//VARIABLES URL
$id_registro=$_REQUEST["id"];

//MAQUINAS
$rst_maquina=mysql_query("SELECT * FROM syCoesa_mantenimiento_maquinas_datos WHERE id_maquina_dato=$id_registro;", $conexion);
$fila_maquina=mysql_fetch_array($rst_maquina);
$num_maquina=mysql_num_rows($rst_maquina);
if($num_maquina==0){ header("Location:lista.php"); }

//MAQUINAS - VARIABLES
$maquina_id=$fila_maquina["id_maquina_dato"];
$maquina_estado=$fila_maquina["id_estado"];
$maquina_nombre=$fila_maquina["id_maquina"];
$maquina_tipo=$fila_maquina["id_maquina_tipo"];
$maquina_abreviacion=$fila_maquina["abreviacion_maquina"];
$maquina_amperios=$fila_maquina["amperios_maquina"];
$maquina_potenciakw=$fila_maquina["potenciakw_maquina"];
$maquina_costokw_hora=$fila_maquina["costokw_hora_maquina"];
$maquina_costohora_hombre=$fila_maquina["costohora_hombre_maquina"];
$maquina_costodepreciacion_hora=$fila_maquina["costodepreciacion_hora_maquina"];
$maquina_gastosfabrica_hora=$fila_maquina["gastosfabrica_hora_maquina"];
$maquina_estacion_cuerpo=$fila_maquina["estacion_cuerpo_maquina"];
$maquina_refile=$fila_maquina["refile_maquina"];
$maquina_ancho_max=$fila_maquina["ancho_max_maquina"];
$maquina_velocidad=$fila_maquina["velocidad_maquina"];
$maquina_personas_requeridas=$fila_maquina["personas_requeridas_maquina"];
$maquina_tolerancia_mm=$fila_maquina["tolerancia_mm_maquina"];
$merma_proceso_permitida=$fila_maquina["merma_proceso_permitida"];
$maquina_preparacion=$fila_maquina["preparacion_maquina"];
$maquina_regulacion=$fila_maquina["regulacion_maquina"];
$maquina_procesos=$fila_maquina["procesos_productivos_maquina"];
$maquina_observaciones=$fila_maquina["observaciones_maquina"];

//PROCESOS
$procesos=explode(",", $maquina_procesos);	//SEPARACION DE ARRAY CON COMAS
$rst_procesos=mysql_query("SELECT * FROM syCoesa_mantenimiento_procesos_productivos ORDER BY orden_proceso ASC;", $conexion);

//EXTRAER MAQUINAS
$rst_maq=mysql_query("SELECT * FROM syCoesa_mantenimiento_maquinas ORDER BY nombre_maquina ASC;", $conexion);

//EXTRAER TIPOS MAQUINA
$rst_maqtipo=mysql_query("SELECT * FROM syCoesa_mantenimiento_maquinas_tipo ORDER BY nombre_tipo_maquina ASC;", $conexion);

//EXTRAER ESTADO
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

              <div class="frmdt_cabecera"><h6>Datos de Máquina | ID: <?php echo $maquina_id; ?></h6></div>
            
                <div class="frmdt_contenido">
                    
                  <form action="actualizar.php" method="post">
                                                
                    	<fieldset class="alto50">
                          <label for="maquina_nombre">Maquina:</label>
                          <select name="maquina_nombre" id="maquina_nombre" class="cmbSlc">
                              <option value>[ Seleccionar opcion ]</option>
                              	<?php while ($fila_maq=mysql_fetch_array($rst_maq)){
								  //VARIABLES
								  $maq_id=$fila_maq["id_maquina"];
								  $maq_nombre=$fila_maq["nombre_maquina"];
								?>
								<?php if ($maq_id==$maquina_nombre){ ?>
                                 	<option selected='' value=<?php echo $maq_id; ?>><?php echo $maq_nombre; ?></option>
                                <?php }else{ ?>
                                 	<option value=<?php echo $maq_id; ?>><?php echo $maq_nombre; ?></option>
								<?php }} ?>
                          </select>
                        </fieldset>
                        
                        <fieldset class="alto50">
                          <label for="maquina_tipo">Tipo de máquina:</label>
                          <select name="maquina_tipo" id="maquina_tipo" class="cmbSlc">
                              <option value>[ Seleccionar opcion ]</option>
                              	<?php while ($fila_maqtipo=mysql_fetch_array($rst_maqtipo)){
								  //VARIABLES
								  $maqtipo_id=$fila_maqtipo["id_tipo_maquina"];
								  $maqtipo_nombre=$fila_maqtipo["nombre_tipo_maquina"];
								?>
								<?php if ($maqtipo_id==$maquina_tipo){ ?>
                                 	<option selected='' value=<?php echo $maqtipo_id; ?>><?php echo $maqtipo_nombre; ?></option>
                                <?php }else{ ?>
                                 	<option value=<?php echo $maqtipo_id; ?>><?php echo $maqtipo_nombre; ?></option>
								<?php }} ?>
                          </select>
                        </fieldset>
                          
                        <fieldset class="alto50">
                          <label for="maquina_estado">Estado:</label>
                          <select name="maquina_estado" id="maquina_estado" class="cmbSlc">
                              <option value>[ Seleccionar opcion ]</option>
                              	<?php while ($fila_estado=mysql_fetch_array($rst_estado)){
								  //VARIABLES
								  $estado_id=$fila_estado["id_estado"];
								  $estado_nombre=$fila_estado["nombre_estado"];
								?>
								<?php if ($estado_id==$maquina_estado){ ?>
                                 	<option selected='' value=<?php echo $estado_id; ?>><?php echo $estado_nombre; ?></option>
                                <?php }else{ ?>
                                 	<option value=<?php echo $estado_id; ?>><?php echo $estado_nombre; ?></option>
								<?php }} ?>
                          </select>
                        </fieldset>
                        
                        <fieldset class="alto50">
                            <label for="maquina_amperios">Amperios:</label>
                          <input type="text" name="maquina_amperios" id="maquina_amperios" value="<?php echo $maquina_amperios; ?>" size="50" class="an50 texto_cen">
                        </fieldset>
                        
                        <fieldset class="alto50">
                            <label for="maquina_potenciakw">Potencia Kw:</label>
                          <input type="text" name="maquina_potenciakw" id="maquina_potenciakw" value="<?php echo $maquina_potenciakw; ?>" size="50" class="an50 texto_cen">
                        </fieldset>
                                                
                        <fieldset class="alto50">
                            <label for="maquina_costokw_hora">Costo Kw / Hora:</label>
                          <input type="text" name="maquina_costokw_hora" id="maquina_costokw_hora" value="<?php echo $maquina_costokw_hora; ?>" size="50" class="an50 texto_cen">
                        </fieldset>
                        
                        <fieldset class="alto50">
                            <label for="maquina_costohora_hombre">Costo Hora / Hombre:</label>
                          <input type="text" name="maquina_costohora_hombre" id="maquina_costohora_hombre" value="<?php echo $maquina_costohora_hombre; ?>" size="50" class="an50 texto_cen">
                        </fieldset>
                        
                        <fieldset class="alto50">
                          <label for="maquina_costodepreciacion_hora">Costo Depreciación / Hora:</label>
                          <input type="text" name="maquina_costodepreciacion_hora" id="maquina_costodepreciacion_hora" value="<?php echo $maquina_costodepreciacion_hora; ?>" size="50" class="an50 texto_cen">
                        </fieldset>
                                                
                        <fieldset class="alto50">
                          <label for="maquina_gastosfabrica_hora">Gastos de Fábrica / Hora:</label>
                          <input type="text" name="maquina_gastosfabrica_hora" id="maquina_gastosfabrica_hora" value="<?php echo $maquina_gastosfabrica_hora; ?>" size="50" class="an50 texto_cen">
                        </fieldset>
                        
                        <fieldset class="alto50">
                          <label for="maquina_estaciones_cuerpo">Estaciones / Cuerpo:</label>
                          <input type="text" name="maquina_estaciones_cuerpo" id="maquina_estaciones_cuerpo" size="50" class="an50 texto_cen" value="<?php echo $maquina_estacion_cuerpo; ?>">
                        </fieldset>
                        
                        <fieldset class="alto50">
                            <label for="maquina_refile">Refile:</label>
                          <input type="text" name="maquina_refile" id="maquina_refile" size="50" class="an50 texto_cen" value="<?php echo $maquina_refile; ?>">
                        </fieldset>
                        
                        <fieldset class="alto50">
                            <label for="maquina_ancho_maximo">Ancho máximo:</label>
                          <input type="text" name="maquina_ancho_maximo" id="maquina_ancho_maximo" size="50" class="an50 texto_cen" value="<?php echo $maquina_ancho_max; ?>">
                        </fieldset>
                                                
                        <fieldset class="alto50">
                            <label for="maquina_velocidad">Velocidad:</label>
                          <input type="text" name="maquina_velocidad" id="maquina_velocidad" size="50" class="an50 texto_cen" value="<?php echo $maquina_velocidad; ?>">
                        </fieldset>
                        
                        <fieldset class="alto50">
                            <label for="maquina_personas_requeridas">Nro. Personas requeridas:</label>
                          <input type="text" name="maquina_personas_requeridas" id="maquina_personas_requeridas" size="50" class="an50 texto_cen" value="<?php echo $maquina_personas_requeridas; ?>">
                        </fieldset>
                                                
                        <fieldset class="alto50">
                          <label for="maquina_tolerancia">Tolerancia MM:</label>
                          <input type="text" name="maquina_tolerancia" id="maquina_tolerancia" size="50" class="an50 texto_cen" value="<?php echo $maquina_tolerancia_mm; ?>">
                        </fieldset>
                        
                        <fieldset class="alto50">
                          <label for="merma_proceso_permitida">Merma permitida:</label>
                          <input type="text" name="merma_proceso_permitida" id="merma_proceso_permitida" size="50" class="an50 texto_cen" value="<?php echo $maquina_tolerancia_mm; ?>">
                        </fieldset>
                        
                        <fieldset class="alto50">
                          <label for="preparacion_maq">Preparación:</label>
                          <input name="preparacion_maq" type="text" class="an50 texto_cen" id="preparacion_maq" value="<?php echo $maquina_preparacion; ?>" size="50">
                        </fieldset>
                        
                        <fieldset class="alto50">
                          <label for="regulacion_maq">Regulación:</label>
                          <input name="regulacion_maq" type="text" class="an50 texto_cen" id="regulacion_maq" value="<?php echo $maquina_regulacion; ?>" size="50">
                        </fieldset>
                        
                        <div class="an100 float_left">
                        
                        <p class="texto_bold">Procesos</p><p>&nbsp;</p>
                        	
                            <?php
								while($fila_procesos=mysql_fetch_array($rst_procesos)){
								
								//VARIABLES
								$procesos_id=$fila_procesos["id_proceso"];
								$procesos_nombre=$fila_procesos["nombre_proceso"];
								
								if(in_array($procesos_id, $procesos)){
							?>
								<fieldset class="w245">
									<label><input type="checkbox" name="procesos[]" value="<?php echo $procesos_id; ?>" id="item_procesos" checked="checked" />&nbsp;<?php echo $procesos_nombre; ?></label>
								</fieldset>
							<?php }else{ ?>
								<fieldset class="w245">
									<label><input type="checkbox" name="procesos[]" value="<?php echo $procesos_id; ?>" id="item_procesos" />&nbsp;<?php echo $procesos_nombre; ?></label>
								</fieldset>
							<?php }}  ?>
                        
                        </div>
                        
                        <fieldset>
                            <label for="maquina_observaciones">Observaciones:</label>
                            <textarea name="maquina_observaciones" cols="100" rows="8" id="maquina_observaciones"><?php echo $maquina_observaciones; ?></textarea>
                        </fieldset>
                        
                        <fieldset>
                        	<input name="maquina_id" type="hidden" id="maquina_id" value="<?php echo $maquina_id; ?>">
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