<?php
session_start();
require_once("../../../connect/conexion.php");
require_once("../../../connect/function.php");
require_once("../../../connect/sesion/verificar_sesion.php");

//VARIABLES URL
$id_usuario=$_REQUEST["usr"];

//USUARIO
$rst_usuario=mysql_query("SELECT * FROM syCoesa_usuario WHERE usuario='$id_usuario';", $conexion);
$fila_usuario=mysql_fetch_array($rst_usuario);
$num_usuario=mysql_num_rows($rst_usuario);
if($num_usuario==0){ header("Location:lista.php"); }

//VARIABLES
$dtusuario_nombre=$fila_usuario["nombre"];
$dtusuario_apellidos=$fila_usuario["apellidos"];
$dtusuario_email=$fila_usuario["email"];
$dtusuario_estado=$fila_usuario["estadoErrorSession"];
$dtusuario_tipo=$fila_usuario["tipo_acceso"];

//TIPO DE USUARIO
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
                    
                  <form action="actualizar.php" method="post">
                                                
                    	<fieldset class="alto50">
                            <label for="usuario_nombre">Nombre:</label>
                            <input type="text" name="usuario_nombre" id="usuario_nombre" size="50" value="<?php echo $dtusuario_nombre; ?>">
                        </fieldset>
                        
                        <fieldset class="alto50">
                            <label for="usuario_apellido">Apellidos:</label>
                            <input type="text" name="usuario_apellido" id="usuario_apellido" size="50" value="<?php echo $dtusuario_apellidos; ?>">
                        </fieldset>
                        
                        <fieldset class="alto50">
                            <label for="usuario_email">Email:</label>
                            <input type="text" name="usuario_email" id="usuario_email" size="50" value="<?php echo $dtusuario_email; ?>">
                        </fieldset>
                        
                    	<fieldset class="alto50">
                      		<label for="dt_usuario">Usuario:</label>
                        	<input name="dt_usuario" type="text" id="dt_usuario" value="<?php echo $id_usuario; ?>" size="50" readonly>
                      </fieldset>
                        
                        <fieldset class="alto50">
                            <label for="dt_pass">Contraseña:</label>
                          	<input type="password" name="dt_pass" id="dt_pass" size="50" class="an50" value="">
                        </fieldset>
                        
                        <fieldset class="alto50">
                            <label for="dt_pass">Tipo de usuario:</label>
                      		<select name="tipo_usuario" id="tipo_usuario">
                            	<option value>Seleccionar</option>
                                <?php while($fila_userTipo=mysql_fetch_array($rst_userTipo)){
									$userTipo_id=$fila_userTipo["id_usuario_tipo"];
									$userTipo_tipo=$fila_userTipo["usuario_tipo"];
									
									if($dtusuario_tipo==$userTipo_id){
								?>
                                <option selected value="<?php echo $userTipo_id; ?>"><?php echo $userTipo_tipo; ?></option>
                                <?php }else{ ?>
                                <option value="<?php echo $userTipo_id; ?>"><?php echo $userTipo_tipo; ?></option>
                                <?php }} ?>
                            </select>
                      	</fieldset>
                        
                        <fieldset class="alto50">
                            <label for="dt_pass">Estado:</label>
                      		<select name="estado" id="estado">
                                <?php if($dtusuario_estado=="A"){ ?>
                                <option selected value="A">Activo</option>
                                <option value="I">Bloqueado</option>
                                <?php }elseif($dtusuario_estado=="I"){ ?>
                                <option value="A">Activo</option>
                                <option selected value="I">Bloqueado</option>
                                <?php } ?>                                
                            </select>
                      	</fieldset>
                        
                        <fieldset>
                        	<input name="usuario_id" type="hidden" id="usuario_id" value="<?php echo $id_usuario; ?>">
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