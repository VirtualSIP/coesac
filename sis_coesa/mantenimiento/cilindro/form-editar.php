<?php
session_start();
require_once("../../../connect/conexion.php");
require_once("../../../connect/function.php");
require_once("../../../connect/sesion/verificar_sesion.php");

//VARIABLES URL
$id_registro=$_REQUEST["id"];

//CILINDRO
$rst_cilindro=mysql_query("SELECT * FROM syCoesa_mantenimiento_cilindro WHERE id_cilindro=$id_registro;", $conexion);
$fila_cilindro=mysql_fetch_array($rst_cilindro);
$num_cilindro=mysql_num_rows($rst_cilindro);
if($num_cilindro==0){ header("Location:lista.php"); }

//CILINDRO - VARIABLES
$cilindro_id=$fila_cilindro["id_cilindro"];
$cilindro=$fila_cilindro["cilindro"];
$engranaje=$fila_cilindro["engranaje"];
$cilindro_observaciones=$fila_cilindro["observaciones_cilindro"];

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

<!-- TEXT AREA -->
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript" src="/libs_js/jquery.textareaCounter.plugin.js"></script>
<script type="text/javascript">
var jtxtar = jQuery.noConflict();
jtxtar(document).ready(function(){
	var cilindro_observaciones = {
			'maxCharacterSize': 255,
			'originalStyle': 'originalTextareaInfo',
			'warningStyle' : 'warningTextareaInfo',
			'warningNumber': 40,
			'displayFormat' : '#input/#max'
	};
	jtxtar('#cilindro_observaciones').textareaCount(cilindro_observaciones);	
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

              <div class="frmdt_cabecera"><h6>Cilindros | ID: <?php echo $cilindro_id; ?></h6></div>
            
                <div class="frmdt_contenido">
                    
                  <form action="actualizar.php" method="post">
                        
                        <fieldset class="alto50">
                            <label for="cilindro">Cilindro:</label>
                            <input name="cilindro" type="text" id="cilindro" value="<?php echo $cilindro; ?>" size="50">
                      	</fieldset>
                        
                        <fieldset class="alto50">
                            <label for="engranaje">Engranaje:</label>
                            <input name="engranaje" type="text" id="engranaje" value="<?php echo $engranaje; ?>" size="50">
                      	</fieldset>
                                                
                        <fieldset>
                            <label for="cilindro_observaciones">Observaciones:</label>
                            <textarea name="cilindro_observaciones" cols="100" rows="8" id="cilindro_observaciones"><?php echo $cilindro_observaciones; ?></textarea>
                        </fieldset>
                        
                        <fieldset>
                        	<input name="cilindro_id" type="hidden" id="cilindro_id" value="<?php echo $cilindro_id; ?>">
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