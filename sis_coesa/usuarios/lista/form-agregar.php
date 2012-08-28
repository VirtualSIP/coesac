<?php
session_start();
require_once("../../../connect/conexion.php");
require_once("../../../connect/function.php");
require_once("../../../connect/sesion/verificar_sesion.php");

//TIPOS DE USUARIO
$rst_userTipo=mysql_query("SELECT * FROM syCoesa_usuario_tipo ORDER BY usuario_tipo ASC;", $conexion);

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

<!-- VERIFICAR EMAIL Y USUARIO -->
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script>
var jEmlUs = jQuery.noConflict();
jEmlUs(document).ready(function(){
	
	jEmlUs("#usuario_email").change(function(){
		jEmlUs("#progressbar").removeClass("ocultar");
		var verTipo = "email";
		var verEmail = jEmlUs("#usuario_email").val();
		jEmlUs.post("verEmailUser.php", {email: verEmail, tipo: verTipo},
			function(data){
				jEmlUs("#progressbar").addClass("ocultar");
				jEmlUs("#msjEmail").html(data);
			});
	});
	
	jEmlUs("#dt_usuario").change(function(){
		jEmlUs("#progressbar").removeClass("ocultar");
		var verTipo = "usuario";
		var verUser = jEmlUs("#dt_usuario").val();
		jEmlUs.post("verEmailUser.php", {usuario: verUser, tipo: verTipo},
			function(data){
				jEmlUs("#progressbar").addClass("ocultar");
				jEmlUs("#msjUser").html(data);
			});
	});
	
});
</script>

<!-- CONTRASEÑA SEGURA -->
<link rel="stylesheet" type="text/css" href="/libs/validatePass/styles.css">
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script src="/libs/validatePass/script.js">

</script>

</head>

<body>

<?php include("../../header.php"); ?>

<section id="cuerpo">
  
  	<?php require_once("../../menu.php"); ?>
    
    <section id="contenido">
    	
        <div id="datos_procesos">
        	
            <div class="formulario_datos">

              <div class="frmdt_cabecera">
                <h6>Usuarios</h6></div>
            
                <div class="frmdt_contenido">
                    
                  <form action="guardar.php" method="post" onsubmit="return checkform($('#dt_pass').val());">
                        
                        <fieldset class="alto50">
                            <label for="usuario_nombre">Nombre:</label>
                            <input type="text" name="usuario_nombre" id="usuario_nombre" size="50">
                        </fieldset>
                        
                        <fieldset class="alto50">
                            <label for="usuario_apellidos">Apellidos:</label>
                            <input type="text" name="usuario_apellidos" id="usuario_apellidos" size="50">
                        </fieldset>
                        
                        <fieldset class="alto50">
                            <label for="usuario_email">Email:</label>
                            <input type="text" name="usuario_email" id="usuario_email" size="50">
                            <div style="width:24px; height:24px; float:right !important; margin-right:18px;" id="msjEmail" class="float_left"></div>
                        </fieldset>
                        
                        <fieldset class="alto50">
                            <label for="dt_usuario">Usuario:</label>
                            <input type="text" name="dt_usuario" id="dt_usuario" size="50">
                            <div style="width:24px; height:24px; float:right !important; margin-right:18px;" id="msjUser"></div>
                        </fieldset>
                        
                    	<fieldset class="alto50">
                            <label for="dt_pass">Contraseña:</label>
                      		<input type="password" name="dt_pass" id="dt_pass" size="50" class="an50">
                      	</fieldset>
                      
						<fieldset class="alto50">
                            <label for="dt_pass">Tipo de usuario:</label>
                      		<select name="tipo_usuario" id="tipo_usuario">
                            	<option value>Seleccionar</option>
                                <?php while($fila_userTipo=mysql_fetch_array($rst_userTipo)){
									$userTipo_id=$fila_userTipo["id_usuario_tipo"];
									$userTipo_tipo=$fila_userTipo["usuario_tipo"];
								?>
                                <option value="<?php echo $userTipo_id; ?>"><?php echo $userTipo_tipo; ?></option>
                                <?php } ?>                                
                            </select>
                      	</fieldset>
                        
                        <fieldset>
                            <input name="dtp_btnenviar" type="submit" id="dtp_btnenviar" value="Guardar datos">
                            <input name="dtp_btnenviar" type="button" id="dtp_btnenviar" value="Cancelar" onClick="parent.location='lista.php'">
                        </fieldset>
                        
                    </form>
                    
                    <div id="pswd_info">

                        <h4>Requerimiento para una contraseña segura:</h4>
                
                        <ul>
                
                            <li id="letter" class="invalid">Por lo menos <strong>una letra</strong></li>
                
                            <li id="capital" class="invalid">Por lo menos <strong>una letra mayúscula</strong></li>
                
                            <li id="number" class="invalid">Por lo menos <strong>un número</strong></li>
                
                            <li id="length" class="invalid">Tener por lo menos <strong>8 caracteres</strong></li>
                
                        </ul>
                
                    </div>
                    
                </div><!-- FIN CONTENIDO -->
                     
            </div><!-- FIN FORMULARIO DATOS -->
        
        </div><!-- FIN DATOS PROCESOS -->
    
    </section><!-- FIN SECTION CONTENIDO -->
    
</section><!-- FIN SECTION -->
</body>
</html>