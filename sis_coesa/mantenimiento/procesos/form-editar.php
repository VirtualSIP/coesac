<?php
session_start();
require_once("../../../connect/conexion.php");
require_once("../../../connect/function.php");
require_once("../../../connect/sesion/verificar_sesion.php");

//VARIABLES URL
$id_registro=$_REQUEST["id"];

//ARTICULOS
$rst_proceso=mysql_query("SELECT * FROM syCoesa_mantenimiento_procesos_productivos WHERE id_proceso=$id_registro;", $conexion);
$fila_proceso=mysql_fetch_array($rst_proceso);
$num_proceso=mysql_num_rows($rst_proceso);
if($num_proceso==0){ header("Location:lista.php"); }

//ARTICULOS - VARIABLES
$proceso_id=$fila_proceso["id_proceso"];
$proceso_nombre=$fila_proceso["nombre_proceso"];
$merma_permitida=$fila_proceso["merma_proceso"];
$merma_tipo=$fila_proceso["merma_proceso_tipo"];
$orden=$fila_proceso["orden_proceso"];
$proceso_observaciones=$fila_proceso["observaciones_proceso"];

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
<link rel="stylesheet" type="text/css" href="/libs_js/SpryAssets/SpryValidationTextarea.css">
<script type="text/javascript" src="/libs_js/SpryAssets/SpryValidationTextField.js"></script>
<script type="text/javascript" src="/libs_js/SpryAssets/SpryValidationTextarea.js"></script>

<!-- TEXT AREA -->
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript" src="/libs_js/jquery.textareaCounter.plugin.js"></script>
<script type="text/javascript">
var jtxtar = jQuery.noConflict();
jtxtar(document).ready(function(){
	var proceso_observaciones = {
			'maxCharacterSize': 255,
			'originalStyle': 'originalTextareaInfo',
			'warningStyle' : 'warningTextareaInfo',
			'warningNumber': 40,
			'displayFormat' : '#input/#max'
	};
	jtxtar('#proceso_observaciones').textareaCount(proceso_observaciones);	
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

              <div class="frmdt_cabecera"><h6>Procesos | ID: <?php echo $proceso_id; ?></h6></div>
            
                <div class="frmdt_contenido">
                    
                  <form action="actualizar.php" method="post">
                                                
                    	<fieldset class="alto50">
                            <label for="proceso_nombre">Nombre:</label>
                            <span id="spry_proceso_nombre">
                            <input name="proceso_nombre" type="text" id="proceso_nombre" value="<?php echo $proceso_nombre; ?>" size="50">
                            <span class="textfieldRequiredMsg">(*)</span></span>
                      	</fieldset>
                        
                        <fieldset class="alto50">
                            <label for="merma_permitida">Merma proceso:</label>
                            <input class="w140 texto_der" name="merma_permitida" type="text" id="merma_permitida" value="<?php echo $merma_permitida; ?>" size="50">
                      	</fieldset>
                        
                        <fieldset class="alto50">
                            <label for="merma_tipo">Tipo de merma:</label>
                            <input class="w140 texto_der" name="merma_tipo" type="text" id="merma_tipo" value="<?php echo $merma_tipo; ?>" size="50">
                      	</fieldset>
                        
                        <fieldset class="alto50">
                            <label for="orden">Orden:</label>
                            <input class="w140 texto_der" name="orden" type="text" id="orden" value="<?php echo $orden; ?>" size="50">
                      	</fieldset>
                                                
                        <fieldset>
                            <label for="proceso_observaciones">Observaciones:</label>
                            <textarea name="proceso_observaciones" cols="100" rows="8" id="proceso_observaciones"><?php echo $proceso_observaciones; ?></textarea>
                        </fieldset>
                        
                        <fieldset>
                        	<input name="proceso_id" type="hidden" id="proceso_id" value="<?php echo $proceso_id; ?>">
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
var sprytextfield1 = new Spry.Widget.ValidationTextField("spry_proceso_nombre");
</script>
</body>
</html>