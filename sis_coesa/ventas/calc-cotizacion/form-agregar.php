<?php
session_start();
require_once("../../../connect/conexion.php");
require_once("../../../connect/function.php");
require_once("../../../connect/sesion/verificar_sesion.php");

//VARIABLES
$aux=0;

//UNIDAD DE MEDIDA
$rst_unmedida=mysql_query("SELECT * FROM syCoesa_unidad_medida WHERE id_unidad_medida=1 OR id_unidad_medida=3 ORDER BY nombre_unidad_medida ASC;", $conexion);

//NUMERO DE BANDAS
$rst_mqdt_bandas=mysql_query("SELECT * FROM syCoesa_mantenimiento_maquinas_datos ORDER BY ancho_max_maquina DESC LIMIT 1;", $conexion);
$fila_mqdt_bandas=mysql_fetch_array($rst_mqdt_bandas);
$mqdt_bandas_ancho=$fila_mqdt_bandas["ancho_max_maquina"];

//NUMERO DE COLORES
$rst_mqdt_colores=mysql_query("SELECT * FROM syCoesa_mantenimiento_maquinas_datos ORDER BY estacion_cuerpo_maquina DESC LIMIT 1;", $conexion);
$fila_mqdt_colores=mysql_fetch_array($rst_mqdt_colores);
$mqdt_colores_estacion=$fila_mqdt_colores["estacion_cuerpo_maquina"];

//CILINDROS
$rst_cilindro=mysql_query("SELECT * FROM syCoesa_mantenimiento_cilindro ORDER BY cilindro ASC;", $conexion);

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
	jnrobd("#dtecnicos_anchofinal").change(function(){
		jnrobd("#progressbar").removeClass("ocultar");
		var anchofinal = jnrobd("#dtecnicos_anchofinal").val();
		jnrobd.post("formula.php", {anchofinal: anchofinal, anchomax: <?php echo $mqdt_bandas_ancho; ?>},
			function(data){
				jnrobd("#progressbar").addClass("ocultar");
				jnrobd("#item-nrobandas").html(data);
			});
	});	
});
</script>

<!-- SELECCIONAR MAQUINAS -->
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript" src="/libs_js/jnotify/lib/jquery.jnotify.min.js"></script>
<link type="text/css" href="/libs_js/jnotify/css/jquery.jnotify.css" rel="stylesheet" title="default" media="all" />
<link type="text/css" href="/libs_js/jnotify/css/jquery.jnotify-alt.css" rel="alternate stylesheet" title="alt" media="all" />
<script>
var jslcmaq = jQuery.noConflict();
jslcmaq(document).ready(function(){
	
	jslcmaq("#dtp_selecmaq").click(function(){
		if(jslcmaq("#dtecnicos_cliente").val() == ""){
		    jslcmaq("#dtecnicos_cliente").focus();
			jslcmaq.jnotify("Ingrese dato del Cliente.", "error", 5000);
		    return false;
		}else if(jslcmaq("#dtecnicos_articulo").val() == ""){
		    jslcmaq("#dtecnicos_articulo").focus();
			jslcmaq.jnotify("Ingrese dato del Producto.", "error", 5000);
		    return false;
		}else if(jslcmaq("#dtecnicos_repeticion").val() == 0) {
		    jslcmaq("#dtecnicos_repeticion").focus();
			jslcmaq.jnotify("Ingrese Distancia de Repetición.", "error", 5000);
		    return false;
		}else if(jslcmaq("#dtecnicos_cilindro").val() == "") {
		    jslcmaq("#dtecnicos_cilindro").focus();
			jslcmaq.jnotify("Seleccione Cilindro.", "error", 5000);
		    return false;
		}else if(jslcmaq("#dtecnicos_anchofinal").val() == 0) {
		    jslcmaq("#dtecnicos_anchofinal").focus();
			jslcmaq.jnotify("Ingrese Ancho Final.", "error", 5000);
		    return false;
		}else if(jslcmaq("#dtecnicos_numbandas").val() == "") {
		    jslcmaq("#dtecnicos_numbandas").focus();
			jslcmaq.jnotify("Seleccione Número de Bandas.", "error", 5000);
		    return false;
		}else if(jslcmaq("#dtecnicos_numcolores").val() == "") {
		    jslcmaq("#dtecnicos_numcolores").focus();
			jslcmaq.jnotify("Seleccione Número de Colores.", "error", 5000);
		    return false;
		}else if(jslcmaq("#dtecnicos_tolerancia").val() == 0) {
		    jslcmaq("#dtecnicos_tolerancia").focus();
			jslcmaq.jnotify("Ingrese Porcentaje de Tolerancia.", "error", 5000);
		    return false;
		}else if(jslcmaq("#dtecnicos_unidadmedida").val() == "") {
		    jslcmaq("#dtecnicos_unidadmedida").focus();
			jslcmaq.jnotify("Seleccione Unidad de Medida.", "error", 5000);
		    return false;
		}else if(jslcmaq("#dtecnicos_cantrq").val() == 0) {
		    jslcmaq("#dtecnicos_cantrq").focus();
			jslcmaq.jnotify("Ingrese Cantidad Requerida.", "error", 5000);
		    return false;
		}else if(jslcmaq("#dtecnicos_precio").val() == 0) {
		    jslcmaq("#dtecnicos_precio").focus();
			jslcmaq.jnotify("Ingrese Precio (US$).", "error", 5000);
		    return false;
		}else if(jslcmaq("#dtecnicos_formato").val() == "") {
		    jslcmaq("#dtecnicos_formato").focus();
			jslcmaq.jnotify("Seleccione Formato de Producto Terminado.", "error", 5000);
		    return false;
		}else if(jslcmaq("#procesos_maquinas_4").attr("checked") == "checked" && jslcmaq("#grm2_tintaseca_1").val() == 0) {
			jslcmaq("#grm2_tintaseca_1").focus();
			jslcmaq.jnotify("Ingrese Gr/m2 (Tinta seca) para Impresión.", "error", 5000);
			return false;
		}else if(jslcmaq("#procesos_maquinas_5").val() == 1 && jslcmaq("#bilaminado_proceso_2").val() == 0) {
			jslcmaq("#bilaminado_proceso_2").focus();
			jslcmaq.jnotify("Ingrese Gr/m2 (Adhesivo) para Bilaminado.", "error", 5000);
			return false;
		}else if(jslcmaq("#procesos_maquinas_6").val() == 1 && jslcmaq("#trilaminado_proceso_3").val() == 0) {
			jslcmaq("#trilaminado_proceso_3").focus();
			jslcmaq.jnotify("Ingrese Gr/m2 (Adhesivo) para Trilaminado.", "error", 5000);
			return false;
		}else{
			jslcmaq("#progressbar").removeClass("ocultar");
			var datos = jslcmaq("#formGuardar").serialize();
			jslcmaq.ajax({
				type: "POST", url: "seleccionar-maquinas.php", data: datos,
				success: function(data){
					jslcmaq("#progressbar").addClass("ocultar");
					jslcmaq("#selccion_procesos_maquinas").html(data);
				}
			});
		}
		
	});
});
</script>

<!-- UNIDAD DE MEDIDA -->
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script>
var jundmed = jQuery.noConflict();
jundmed(document).ready(function(){
	jundmed("#dtecnicos_unidadmedida").change(function(){
		jundmed("#progressbar").removeClass("ocultar");
		var unidadmedida = jundmed(this).val();
		jundmed.post("undad-medida.php", {unidadmedida: unidadmedida},
			function(data){
				jundmed("#progressbar").addClass("ocultar");
				jundmed("#dtecnicos_cantrq_texto").html(data);
			});
	});	
});
</script>

<!-- CILINDRO -->
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script>
var jCilRep=jQuery.noConflict();
jCilRep(document).ready(function(){
	jCilRep("#dtecnicos_repeticion").change(function(){
		jCilRep("#progressbar").removeClass("ocultar");
		var cilindro = jCilRep("#dtecnicos_cilindro").val();
		var distancia = jCilRep(this).val();
		var tipo = "repeticion";
		jCilRep.post("cilindro-repeticion.php", {distancia: distancia, cilindro: cilindro, tipo: tipo},
			function(data){
				jCilRep("#dato_nrorepeticion").html(data);
				jCilRep("#progressbar").addClass("ocultar");
			});
	});	
});
</script>

<!-- SELECCIONAR LAMINAS -->
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script>
var jlamproc = jQuery.noConflict();
jlamproc(document).ready(function(){
	jlamproc("#dtecnicos_formato").change(function(){
		jlamproc("#progressbar").removeClass("ocultar");
		var formato = jlamproc(this).val();
		jlamproc.post("seleccionar-laminas.php", {formato: formato},
			function(data){
				jlamproc("#progressbar").addClass("ocultar");
				jlamproc("#datos_lamproc").html(data);
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
                <h6>Cotización</h6></div>
            
                <div class="frmdt_contenido">
                    
                  <form id="formGuardar" action="guardar.php" method="post">
                        
                    	<fieldset class="alto50">
                          <label for="dtecnicos_cliente">Cliente:</label>
                          <input name="dtecnicos_cliente" type="text" id="dtecnicos_cliente">
						</fieldset>
                        
                        <fieldset class="alto50">
                          <label for="dtecnicos_articulo">Producto:</label>
                          <input name="dtecnicos_articulo" type="text" id="dtecnicos_articulo">
                          <input name="dtecnicos_grm2" type="hidden" value="0">
						</fieldset>
                        
                        <fieldset class="alto50 w180">
                            <label for="dtecnicos_cilindro">Cilindro (mm):</label>
                            <select name="dtecnicos_cilindro" id="dtecnicos_cilindro" class="w140">
                                <option value>Seleccione</option>
                                <?php while($fila_cilindro=mysql_fetch_array($rst_cilindro)){
                                    $cilindro_id=$fila_cilindro["id_cilindro"];
                                    $cilindro_nombre=$fila_cilindro["cilindro"]."/".$fila_cilindro["engranaje"];
                                ?>
                                <option value="<?php echo $cilindro_id; ?>"><?php echo $cilindro_nombre; ?></option>
                                <?php } ?>
                            </select>
                        </fieldset>
                        
                        <fieldset class="alto50 w180">
                          <label for="dtecnicos_repeticion">Distancia de repetición (mm):</label>
                          <input name="dtecnicos_repeticion" type="text" id="dtecnicos_repeticion" class="w130" value="0">
						</fieldset>
                                                
                        <div class="float_left w180" id="dato_nrorepeticion">
                        <fieldset class="alto50 w180">
                          <label for="dtecnicos_frecuencia">Nro de Repeticiones (Und):</label>
                          <input name="dtecnicos_frecuencia" type="text" id="dtecnicos_frecuencia" class="w130" value="0" readonly>
						</fieldset>
                        </div>
                        
                        <fieldset class="alto50 w180">
                          <label for="dtecnicos_anchofinal">Ancho Final (mm):</label>
                          <input name="dtecnicos_anchofinal" type="text" id="dtecnicos_anchofinal" class="w130" value="0">
						</fieldset>
                        
                        <fieldset class="alto50 w180" id="item-nrobandas">
                            <label for="dtecnicos_numbandas">Número de bandas:</label>
                            <select name="dtecnicos_numbandas" id="dtecnicos_numbandas" class="w140">
                              <option value>Seleccione</option>
                            </select>
                        </fieldset>
                        
                        <fieldset class="alto50 w180">
                            <label for="dtecnicos_numcolores">Número de colores:</label>
                            <select name="dtecnicos_numcolores" id="dtecnicos_numcolores" class="w140">
                              <option value>Seleccione</option>
                              <?php for($j=1; $j<=$mqdt_colores_estacion; $j++){ ?>
                              <option value="<?php echo $j; ?>"><?php echo $j; ?></option>
                              <?php } ?>
                            </select>
						</fieldset>
                        
                        <fieldset class="alto50 w180">
                          <label for="dtecnicos_tolerancia">% Tolerancia:</label>
                          <input name="dtecnicos_tolerancia" type="text" id="dtecnicos_tolerancia" class="w130" value="0">
						</fieldset>
                        
                        <fieldset class="alto50 w180">
                            <label for="dtecnicos_unidadmedida">Unidad de medida:</label>
                            <select name="dtecnicos_unidadmedida" id="dtecnicos_unidadmedida" class="w140">
                              <option value>Seleccione</option>
                              <?php while($fila_unmedida=mysql_fetch_array($rst_unmedida)){
								  $unmedida_id=$fila_unmedida["id_unidad_medida"];
								  $unmedida_nombre=$fila_unmedida["nombre_unidad_medida"];
								?>
                              <option value="<?php echo $unmedida_id; ?>"><?php echo $unmedida_nombre; ?></option>
                              <?php } ?>
                            </select>
						</fieldset>
                        
                        <fieldset class="alto50 w180">
                          <div id="dtecnicos_cantrq_texto"><label for="dtecnicos_cantrq">Cantidad Requerida:</label></div>
                          <input name="dtecnicos_cantrq" type="text" id="dtecnicos_cantrq" class="w130" value="0">
						</fieldset>
                        
                        <fieldset class="alto50 w180">
                          <label for="dtecnicos_precio">Precio (US$):</label>
                          <input name="dtecnicos_precio" type="text" id="dtecnicos_precio" class="w130" value="0">
						</fieldset>
                        
                        <fieldset class="alto50 w215">
                            <label for="dtecnicos_formato">Formato de Producto Terminado:</label>
                            <select name="dtecnicos_formato" id="dtecnicos_formato" class="w140">
                              <option value>Seleccione</option>
                              <option value="1">Lamina</option>
                              <option value="2">Manga</option>
                            </select>
						</fieldset>
                        
                        <div id="datos_lamproc" class="an100 float_left"></div><!-- FIN datos_lamproc -->
                        
                        <fieldset class="an100 float_left">
                            <a href="javascript:;" name="dtp_selecmaq" id="dtp_selecmaq">Seleccionar maquinas</a>
                        </fieldset>
                        	
                        <div id="selccion_procesos_maquinas" class="an100 float_left padding_tb10"></div>
                            
                    	<fieldset>
                            <input name="dtp_btnenviar" type="submit" id="dtp_btnenviar" value="Guardar datos y mostrar informe">
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