<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>COESA</title>
<!-- ESTILOS -->
<link href="../css/normalize.css" rel="stylesheet" type="text/css">
<link href="../css/estilos_sis_coesa.css" rel="stylesheet" type="text/css">

<!-- FUENTES -->
<link href='http://fonts.googleapis.com/css?family=Cuprum:400,700' rel='stylesheet' type='text/css'>

<!-- MENU -->
<script type="text/javascript" src="../libs_js/effc_menu/jquery-1.2.6.js"></script>
<script type="text/javascript" src="../libs_js/effc_menu/jscript_jquery.dimensions.js"></script>
<script type="text/javascript" src="../libs_js/effc_menu/jscript_jquery.mousewheel.min.js"></script>
<script type="text/javascript" src="../libs_js/effc_menu/jscript_jzScrollHorizontalPane.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		if($("#nav")) {
			$("#nav dd").hide();
			$("#nav dt b").click(function() {
				if(this.className.indexOf("clicked") != -1) {
					$(this).parent().next().slideUp(200);
					$(this).removeClass("clicked");
				}
				else {
					$("#nav dt b").removeClass();
					$(this).addClass("clicked");
					$("#nav dd:visible").slideUp(200);
					$(this).parent().next().slideDown(500);
				}
				return false;
			});
		}
	});
</script>

</head>

<body>
<header>
	<div id="hd_logo">
    	<img src="../imagenes/logo.png" width="200" height="35" alt="Logo">
    </div>
    <div id="hd_datos">
    	Marco Lopez | <a href="/">SALIR</a>
    </div>
</header><!-- FIN HEADER -->
<section id="cuerpo">
  <dl id="nav">
        <dt class="items"><b>Almacen</b></dt>
        	<dd>
              <ul>
                    <li><a href="index.php">Maestro Articulos</a></li>
                    <li><a href="index.php">Movimientos</a></li>
                </ul>
            </dd>
        <dt class="items"><b>Ventas</b></dt>
        	<dd>
              <ul>
                    <li><a href="index.php">Clientes</a></li>
                    <li><a href="index.php">Cotización</a></li>
                </ul>
            </dd>
        <dt class="items"><b>Producción</b></dt>
        	<dd>
              <ul>
                    <li><a href="index.php">Procesos</a></li>
                    <li><a href="index.php">Maquinas</a></li>
                </ul>
            </dd>
        <dt class="items"><b>Contabilidad</b></dt>
        	<dd>
              <ul>
                    <li><a href="index.php">Mano de Obra </a></li>
                    <li><a href="index.php">Depreciación</a></li>
                    <li><a href="index.php">Energia</a></li>
                    <li><a href="index.php">Gastos Generales</a></li>
                </ul>
            </dd>
        <dt class="items"><b>Información Personal</b></dt>
        	<dd>
              <ul>
                    <li><a href="user_datos.php">Datos Personales</a></li>
                    <li><a href="index.php">Cambiar contraseña</a></li>
                </ul>
            </dd>
    </dl><!-- FIN MENU -->
    
    <section id="contenido">
    	
        <div class="formulario_datos">
        	
            <div class="frmdt_cabecera"><h6>Datos Personales</h6></div>
            
            <div class="frmdt_contenido">
            	
              <form>
                
                    <fieldset>
                        <label for="dtp_nombre">Nombre:</label>
                        <input type="text" name="dtp_nombre" id="dtp_nombre" value="Marco" size="50">
                  </fieldset>
                    
                    <fieldset>
                        <label for="dtp_apellidos">Apellidos:</label>
                        <input type="text" name="dtp_apellidos" id="dtp_apellidos" value="Lopez" size="50">
                    </fieldset>
                    
                    <fieldset>
                        <label for="dtp_email">Correo Electronico:</label>
                        <input type="text" name="dtp_email" id="dtp_email" value="nombre@midominio.com" size="50">
                    </fieldset>
                    
                    <fieldset>
                        <input name="dtp_btnenviar" type="button" id="dtp_btnenviar" value="Guardar datos">
                  </fieldset>
                    
                </form>
                
            </div>
        
        </div><!-- FORMULARIO DATOS -->
    
    </section><!-- FIN SECTION CONTENIDO -->
    
</section><!-- FIN SECTION -->
</body>
</html>