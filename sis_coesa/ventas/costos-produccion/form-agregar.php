<?php
session_start();
require_once("../../../connect/conexion.php");
require_once("../../../connect/function.php");
require_once("../../../connect/sesion/verificar_sesion.php");

//VARIABLES
$aux=0;

//CLIENTE
$rst_cliente=mysql_query("SELECT * FROM syCoesa_datos_tecnicos ORDER BY id_cliente ASC;", $conexion);

//PRODUCTO TERMINADO
$rst_prodterminado=mysql_query("SELECT * FROM syCoesa_articulo ORDER BY dato_fecha DESC;", $conexion);

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
<link rel="stylesheet" type="text/css" href="/libs_js/SpryAssets/SpryValidationSelect.css">
<link rel="stylesheet" type="text/css" href="/libs_js/SpryAssets/SpryValidationTextarea.css">
<script type="text/javascript" src="/libs_js/SpryAssets/SpryValidationSelect.js"></script>
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

<!-- CHAINED -->
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript" src="/libs_js/chained/jquery.chained.js"></script>
<script type="text/javascript">
var jcmb = jQuery.noConflict();
jcmb(document).ready(function(){
	jcmb("#dtecnicos_articulo").chained("#dtecnicos_cliente");
});
</script>

<!-- SELECCIONAR -->
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript">
var jefform = jQuery.noConflict();
jefform(document).ready(function(){
	jefform("#dtp_selecmaq").click(function() {
		jefform("#progressbar").removeClass("ocultar");
		var cliente = jefform("select#dtecnicos_cliente option:selected").val();
		var articulo = jefform("select#dtecnicos_articulo option:selected").val();
		var tolerancia = jefform("#dtecnicos_tolerancia").val();
		var cantidad = jefform("#dtecnicos_cantidadclt").val();
		var precio = jefform("#dtecnicos_precio").val();
		jefform.post("consulta-laminas.php", {articulo: articulo, cliente: cliente, tolerancia: tolerancia, cantidad: cantidad, precio: precio},
			function(data){
				jefform("#progressbar").addClass("ocultar");
				jefform('#laminas').html(data);
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
                <h6>Costos Producción</h6></div>
            
                <div class="frmdt_contenido">
                    
                  <form id="formGuardar" action="guardar.php" method="post">
                        
                    	<fieldset class="alto50">
                          <label for="dtecnicos_cliente">Cliente:</label>
                          <span id="spry_dtecnicos_cliente">
                          <select name="dtecnicos_cliente" id="dtecnicos_cliente">
                            <option value>[ Seleccionar opcion ]</option>
                            <?php while($fila_cliente=mysql_fetch_array($rst_cliente)){
								//VARIABLES
								$cliente=seleccionTabla($fila_cliente["id_cliente"], "id_cliente", "syCoesa_clientes", $conexion);
								
								if($cliente["id_cliente"]<>$aux){
									$aux=$cliente["id_cliente"];
							?>
                            <option value=<?php echo $cliente["id_cliente"]; ?>><?php echo $cliente["nombre_cliente"]; ?></option>
                            <?php }} ?>
                          </select>
                          <span class="selectInvalidMsg">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(*)</span>
                          <span class="selectRequiredMsg">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(*)</span></span>
                        </fieldset>
                        
                        <fieldset class="alto50">
                          <label for="dtecnicos_articulo">Producto Terminado:</label>
                          <span id="spry_dtecnicos_articulo">
                          <select name="dtecnicos_articulo" id="dtecnicos_articulo">
                            <option value>[ Seleccionar opcion ]</option>
                            <?php while($fila_prodterminado=mysql_fetch_array($rst_prodterminado)){
								//VARIABLES
								$prodterminado_id=$fila_prodterminado["id_articulo"];
								$prodterminado_nombre=$fila_prodterminado["nombre_articulo"];
								$prodterminado_cliente=$fila_prodterminado["id_cliente"];
								$prodterminado_fecha_hora=explode(" ", $fila_prodterminado["dato_fecha"]);
								$prodterminado_fecha=explode("-", $prodterminado_fecha_hora[0]);
								$prodterminado_fecha_final=$prodterminado_fecha[2]."/".$prodterminado_fecha[1]."/".$prodterminado_fecha[0];
							?>
                            <option value=<?php echo $prodterminado_id; ?> class="<?php echo $prodterminado_cliente; ?>"><?php echo $prodterminado_nombre." (".$prodterminado_fecha_final.")"; ?></option>
                            <?php } ?>
                          </select>
                          <span class="selectInvalidMsg">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(*)</span>
                          <span class="selectRequiredMsg">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(*)</span></span>
                        </fieldset>
                        
                        <fieldset class="alto50 w180">
                        	<label>% Tolerancia:</label>
                            <input name="dtecnicos_tolerancia" id="dtecnicos_tolerancia" type="text" class="w130 texto_der" value="0">
                        </fieldset>
                        
                        <fieldset class="alto50 w180">
                        	<label>Cantidad:</label>
                            <input name="dtecnicos_cantidadclt" id="dtecnicos_cantidadclt" type="text" class="w130 texto_der" value="0">
                        </fieldset>
                        
                        <fieldset class="alto50 w180">
                        	<label>Precio:</label>
                            <input name="dtecnicos_precio" id="dtecnicos_precio" type="text" class="w130 texto_der" value="0">
                        </fieldset>
                        
                        <fieldset class="float_left w180">
                            <a href="javascript:;" name="dtp_selecmaq" id="dtp_selecmaq">Seleccionar maquinas</a>
                        </fieldset>
                        
                        <div id="laminas"></div>
                        
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
var spryselect1 = new Spry.Widget.ValidationSelect("spry_dtecnicos_articulo", {invalidValue:"-1"});
var spryselect2 = new Spry.Widget.ValidationSelect("spry_dtecnicos_cliente", {invalidValue:"-1"});
</script>
</body>
</html>