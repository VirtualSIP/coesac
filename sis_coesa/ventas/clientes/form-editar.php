<?php
session_start();
require_once("../../../connect/conexion.php");
require_once("../../../connect/function.php");
require_once("../../../connect/sesion/verificar_sesion.php");

//VARIABLES URL
$id_registro=$_REQUEST["id"];

//CLIENTE
$rst_articulo=mysql_query("SELECT * FROM syCoesa_clientes WHERE id_cliente=$id_registro;", $conexion);
$fila_articulo=mysql_fetch_array($rst_articulo);
$num_articulo=mysql_num_rows($rst_articulo);
if($num_articulo==0){ header("Location:lista.php"); }

//CLIENTE - VARIABLES
$cliente_id=$fila_articulo["id_cliente"];
$cliente_nombre=$fila_articulo["nombre_cliente"];
$cliente_documento=$fila_articulo["documento_cliente"];
$cliente_documento_tipo=$fila_articulo["documento_tipo_cliente"];
$cliente_logo=$fila_articulo["logo_cliente"];
$cliente_contacto_nombre=$fila_articulo["cliente_contacto_nombre"];
$cliente_contacto_email=$fila_articulo["cliente_contacto_email"];
$cliente_observaciones=$fila_articulo["observaciones_cliente"];

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
<style>
.ui-combobox {
	position: relative;
	display: inline-block;
}
.ui-button {
	position: absolute;
	top: 0;
	bottom: 0;
	margin-left: -1px;
	padding: 0;
	/* adjust styles for IE 6/7 */
	*height: 1.7em;
	*top: 0.1em;
}
.ui-autocomplete-input {
	margin: 0;
	padding: 0.3em;
}
</style>
<script>
var jcmb = jQuery.noConflict();
(function( jcmb ) {
	jcmb.widget( "ui.combobox", {
		_create: function() {
			var input,
				self = this,
				select = this.element.hide(),
				selected = select.children( ":selected" ),
				value = selected.val() ? selected.text() : "",
				wrapper = jcmb( "<span>" )
					.addClass( "ui-combobox" )
					.insertAfter( select );

			input = jcmb( "<input>" )
				.appendTo( wrapper )
				.val( value )
				.addClass( "ui-state-default" )
				.autocomplete({
					delay: 0,
					minLength: 0,
					source: function( request, response ) {
						var matcher = new RegExp( jcmb.ui.autocomplete.escapeRegex(request.term), "i" );
						response( select.children( "option" ).map(function() {
							var text = jcmb( this ).text();
							if ( this.value && ( !request.term || matcher.test(text) ) )
								return {
									label: text.replace(
										new RegExp(
											"(?![^&;]+;)(?!<[^<>]*)(" +
											jcmb.ui.autocomplete.escapeRegex(request.term) +
											")(?![^<>]*>)(?![^&;]+;)", "gi"
										), "<strong>$1</strong>" ),
									value: text,
									option: this
								};
						}) );
					},
					select: function( event, ui ) {
						ui.item.option.selected = true;
						self._trigger( "selected", event, {
							item: ui.item.option
						});
					},
					change: function( event, ui ) {
						if ( !ui.item ) {
							var matcher = new RegExp( "^" + jcmb.ui.autocomplete.escapeRegex( jcmb(this).val() ) + "$", "i" ),
								valid = false;
							select.children( "option" ).each(function() {
								if ( jcmb( this ).text().match( matcher ) ) {
									this.selected = valid = true;
									return false;
								}
							});
							if ( !valid ) {
								jcmb( this ).val( "" );
								select.val( "" );
								input.data( "autocomplete" ).term = "";
								return false;
							}
						}
					}
				})
				.addClass( "ui-widget ui-widget-content ui-corner-left" );

			input.data( "autocomplete" )._renderItem = function( ul, item ) {
				return jcmb( "<li></li>" )
					.data( "item.autocomplete", item )
					.append( "<a>" + item.label + "</a>" )
					.appendTo( ul );
			};

			jcmb( "<a>" )
				.attr( "tabIndex", -1 )
				.attr( "title", "Show All Items" )
				.appendTo( wrapper )
				.button({
					icons: {
						primary: "ui-icon-triangle-1-s"
					},
					text: false
				})
				.removeClass( "ui-corner-all" )
				.addClass( "ui-corner-right ui-button-icon" )
				.click(function() {
					if ( input.autocomplete( "widget" ).is( ":visible" ) ) {
						input.autocomplete( "close" );
						return;
					}
					jcmb( this ).blur();
					input.autocomplete( "search", "" );
					input.focus();
				});
		},
		destroy: function() {
			this.wrapper.remove();
			this.element.show();
			jcmb.Widget.prototype.destroy.call( this );
		}
	});
})( jQuery );

jcmb(function() {
	jcmb( "#cliente_documento_tipo" ).combobox();
});
</script>

<!-- TEXT AREA -->
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript" src="/libs_js/jquery.textareaCounter.plugin.js"></script>
<script type="text/javascript">
var jtxtar = jQuery.noConflict();
jtxtar(document).ready(function(){
	var cliente_observaciones = {
			'maxCharacterSize': 255,
			'originalStyle': 'originalTextareaInfo',
			'warningStyle' : 'warningTextareaInfo',
			'warningNumber': 40,
			'displayFormat' : '#input/#max'
	};
	jtxtar('#cliente_observaciones').textareaCount(cliente_observaciones);	
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

              <div class="frmdt_cabecera">
                <h6>Clientes | ID: <?php echo $cliente_id; ?></h6></div>
            
                <div class="frmdt_contenido">
                    
                  <form action="actualizar.php" method="post" enctype="multipart/form-data">
                                                
                    	<fieldset class="alto50">
                            <label for="cliente_nombre">Nombre:</label>
                          <span id="spry_cliente_nombre">
                            <input name="cliente_nombre" type="text" id="cliente_nombre" value="<?php echo $cliente_nombre; ?>" size="50">
                            <span class="textfieldRequiredMsg">(*)</span></span>
                    	</fieldset>
                        
                        <fieldset class="alto50">
                          	<label for="cliente_logo">Logo:</label>
                            <input name="cliente_logo" type="file" id="cliente_logo">
                            <input name="cliente_logo_actual" type="hidden" id="cliente_logo_actual" value="<?php echo $cliente_logo; ?>">
                        </fieldset>
                        
                        <fieldset class="alto50">
                          <label for="cliente_documento_tipo">Tipo de Documento:</label>
                          <span id="spry_cliente_documento_tipo">
                          <select name="cliente_documento_tipo" id="cliente_documento_tipo">
                            <option value>[ Seleccionar opcion ]</option>
                            <?php if($cliente_documento_tipo=="DNI"){ ?>
                            <option selected='' value="DNI">DNI</option>
                            <option value="RUC">RUC</option>
                            <?php }elseif($cliente_documento_tipo=="RUC"){ ?>
                            <option value="DNI">DNI</option>
                            <option selected='' value="RUC">RUC</option>
                            <?php } ?>
                          </select>
                          <span class="selectInvalidMsg">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(*)</span>
                          <span class="selectRequiredMsg">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(*)</span></span>
                        </fieldset>
                                                
                   	<fieldset class="alto50">
                            <label for="cliente_documento_numero">Número de Documento:</label>
                            <span id="spry_cliente_documento_numero">
                            <input type="text" name="cliente_documento_numero" id="cliente_documento_numero" size="50"  value="<?php echo $cliente_documento; ?>" class="an50 texto_cen">
                            <span class="textfieldRequiredMsg">(*)</span>
                            <span class="textfieldMinCharsMsg">(*)</span>
                            <span class="textfieldMaxCharsMsg">(*)</span>
                            <span class="textfieldInvalidFormatMsg">(*)</span></span>
                   	</fieldset>
                        
                        <fieldset class="alto50">
                            <label for="cliente_contacto">Persona de Contacto:</label>
                          <input type="text" name="cliente_contacto" id="cliente_contacto" size="50" value="<?php echo $cliente_contacto_nombre; ?>" >
                        </fieldset>
                        
                        <fieldset class="alto50">
                            <label for="cliente_contacto_email">Email:</label>
                            <span id="spry_cliente_contacto_email">
                            <input type="text" name="cliente_contacto_email" id="cliente_contacto_email" size="50" value="<?php echo $cliente_contacto_email; ?>">
                          <span class="textfieldInvalidFormatMsg">(*)</span></span>
                        </fieldset>
                                                
                        <fieldset>
                            <label for="cliente_observaciones">Observaciones:</label>
                            <textarea name="cliente_observaciones" cols="100" rows="8" id="cliente_observaciones"><?php echo $cliente_observaciones; ?></textarea>
                        </fieldset>
                        
                        <fieldset>
                        	<img src="/imagenes/clientes/<?php echo $cliente_logo; ?>" height="112">
                        </fieldset>
                        
                        <fieldset>
                        	<input name="cliente_id" type="hidden" id="cliente_id" value="<?php echo $cliente_id; ?>">
                            <input name="dtp_btnenviar" type="submit" id="dtp_btnenviar" value="Guardar datos">
                            <input name="dtp_btnenviar" type="button" id="dtp_btnenviar" value="Cancelar" onClick="parent.location='<?php echo $web_url; ?>lista.php'">
                        </fieldset>
                        
                    </form>
                    
                </div>
                     
            </div><!-- FIN FORMULARIO DATOS -->
        
        </div><!-- FIN DATOS PROCESOS -->
    
    </section><!-- FIN SECTION CONTENIDO -->
    
</section><!-- FIN SECTION -->

<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("spry_cliente_nombre");
var spryselect1 = new Spry.Widget.ValidationSelect("spry_cliente_documento_tipo", {invalidValue:"-1"});
var sprytextfield2 = new Spry.Widget.ValidationTextField("spry_cliente_documento_numero", "integer", {minChars:8, maxChars:11});
var sprytextfield3 = new Spry.Widget.ValidationTextField("spry_cliente_contacto_email", "email", {isRequired:false});
</script>
</body>
</html>