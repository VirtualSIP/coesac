<?php
session_start();
require_once("../../../connect/conexion.php");
require_once("../../../connect/function.php");
require_once("../../../connect/sesion/verificar_sesion.php");

//WEB
$web="http://coesac.marostsac.com/";

//VARIABLES URL
$id_registro=$_REQUEST["id"];

//PEDIDO
$rst_dtecnicos=mysql_query("SELECT * FROM syCoesa_datos_tecnicos WHERE id_datos_tecnicos=$id_registro;", $conexion);
$fila_dtecnicos=mysql_fetch_array($rst_dtecnicos);
$num_dtecnicos=mysql_num_rows($rst_dtecnicos);
if($num_dtecnicos==0){ header("Location:lista.php"); }

//ARTICULOS - VARIABLES
$dtecnicos_id=$fila_dtecnicos["id_datos_tecnicos"];
$dtecnicos_cliente=$fila_dtecnicos["id_cliente"];
$dtecnicos_articulo=$fila_dtecnicos["id_articulo"];
$dtecnicos_imagen=$fila_dtecnicos["imagen_prod_datos_tecnicos"];
$dtecnicos_ancho_final=$fila_dtecnicos["ancho_final_datos_tecnicos"];
$dtecnicos_numbandas=$fila_dtecnicos["nro_bandas_datos_tecnicos"];
$dtecnicos_numcolores=$fila_dtecnicos["nro_colores_datos_tecnicos"];

//CLIENTES
$rst_cliente=mysql_query("SELECT * FROM syCoesa_clientes ORDER BY nombre_cliente ASC;", $conexion);

//ARTICULOS
$rst_articulo=mysql_query("SELECT * FROM syCoesa_articulo WHERE id_tipo_articulo=1 ORDER BY nombre_articulo ASC;", $conexion);

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
	jcmb( "#dtecnicos_cliente" ).combobox();
	jcmb( "#dtecnicos_articulo" ).combobox();
});
</script>

<!-- SPRY -->
<link rel="stylesheet" type="text/css" href="/libs_js/SpryAssets/SpryValidationTextField.css">
<link rel="stylesheet" type="text/css" href="/libs_js/SpryAssets/SpryValidationSelect.css">
<link rel="stylesheet" type="text/css" href="/libs_js/SpryAssets/SpryValidationTextarea.css">
<script type="text/javascript" src="/libs_js/SpryAssets/SpryValidationSelect.js"></script>
<script type="text/javascript" src="/libs_js/SpryAssets/SpryValidationTextField.js"></script>
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

</head>

<body>

<?php include("../../../sis_coesa/header.php"); ?>

<section id="cuerpo">
  
  	<?php require_once("../../../sis_coesa/menu.php"); ?>
    
    <section id="contenido">
    	
        <div id="datos_procesos">
        	
            <div class="formulario_datos">

              <div class="frmdt_cabecera"><h6>Datos Técnicos | ID: <?php echo $dtecnicos_id; ?></h6></div>
            
                <div class="frmdt_contenido">
                    
                  <form action="actualizar.php" method="post" enctype="multipart/form-data">
                        
                        <fieldset class="alto50">
                          <label for="dtecnicos_articulo">Articulo:</label>
                          <span id="spry_dtecnicos_articulo">                         
                          <select name="dtecnicos_articulo" id="dtecnicos_articulo">
                              <option value>[ Seleccionar opcion ]</option>
                              	<?php while ($fila_articulo=mysql_fetch_array($rst_articulo)){
								  //VARIABLES
								  $articulo_id=$fila_articulo["id_articulo"];
								  $articulo_nombre=$fila_articulo["nombre_articulo"];
								  $articulo_abreviacion=$fila_articulo["abreviado_articulo"];
								?>
								<?php if ($dtecnicos_articulo==$articulo_id){ ?>
                                 	<option selected='' value=<?php echo $articulo_id; ?>><?php echo $articulo_nombre."(".$articulo_abreviacion.")"; ?></option>
                                <?php }else{ ?>
                                 	<option value=<?php echo $articulo_id; ?>><?php echo $articulo_nombre."(".$articulo_abreviacion.")"; ?></option>
								<?php }} ?>
                          </select>
                          
                          <span class="selectInvalidMsg">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(*)</span>
                          <span class="selectRequiredMsg">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(*)</span></span>
                        </fieldset>
                        
                        <fieldset class="alto50">
                          <label for="dtecnicos_cliente">Cliente:</label>
                          <span id="spry_dtecnicos_cliente">                         
                          <select name="dtecnicos_cliente" id="dtecnicos_cliente">
                              <option value>[ Seleccionar opcion ]</option>
                              	<?php while ($fila_cliente=mysql_fetch_array($rst_cliente)){
								  //VARIABLES
								  $cliente_id=$fila_cliente["id_cliente"];
								  $cliente_nombre=$fila_cliente["nombre_cliente"];
								  $cliente_documento=$fila_cliente["documento_cliente"];
								?>
								<?php if ($cliente_id==$dtecnicos_cliente){ ?>
                                 	<option selected='' value=<?php echo $cliente_id; ?>><?php echo $cliente_nombre." (".$cliente_documento.")"; ?></option>
                                <?php }else{ ?>
                                 	<option value=<?php echo $cliente_id; ?>><?php echo $cliente_nombre." (".$cliente_documento.")"; ?></option>
								<?php }} ?>
                          </select>
                          
                          <span class="selectInvalidMsg">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(*)</span>
                          <span class="selectRequiredMsg">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(*)</span></span>
                        </fieldset>
             
                        <fieldset class="alto50">
                            <label for="dtecnicos_ancho_final">Ancho final:</label>
                          <span id="spry_dtecnicos_ancho_final">
                          <input name="dtecnicos_ancho_final" type="text" class="an50" id="dtecnicos_ancho_final" value="<?php echo $dtecnicos_ancho_final; ?>" size="50">
                          <span class="textfieldRequiredMsg">(*)</span>
                          <span class="textfieldInvalidFormatMsg">(*)</span></span>
                        </fieldset>
                        
                        <fieldset class="alto50">
                            <label for="dtecnicos_numbandas">Número de bandas:</label>
                          <span id="spry_dtecnicos_numbandas">
                          <input name="dtecnicos_numbandas" type="text" class="an50" id="dtecnicos_numbandas" value="<?php echo $dtecnicos_numbandas; ?>" size="50">
                          <span class="textfieldRequiredMsg">(*)</span>
                          <span class="textfieldInvalidFormatMsg">(*)</span></span>
                        </fieldset>
                        
                        <fieldset class="alto50">
                            <label for="dtecnicos_numcolores">Número de colores:</label>
                          <span id="spry_dtecnicos_numcolores">
                          <input name="dtecnicos_numcolores" type="text" class="an50" id="dtecnicos_numcolores" value="<?php echo $dtecnicos_numcolores; ?>" size="50">
                          <span class="textfieldRequiredMsg">(*)</span>
                          <span class="textfieldInvalidFormatMsg">(*)</span></span>
                        </fieldset>
                        
                        <fieldset class="alto50">
                            <label for="dtecnicos_imagen">Imagen:</label>
                          	<input name="dtecnicos_imagen" type="file" id="dtecnicos_imagen">
                            <input name="dtecnicos_imagen_actual" type="hidden" id="dtecnicos_imagen_actual" value="<?php echo $dtecnicos_imagen; ?>">
                        </fieldset>
                        
                        <fieldset>
                            <img src="/imagenes/upload/<?php echo $dtecnicos_imagen; ?>" height="120">
                        </fieldset>
                        
                    <fieldset>
                        	<input name="dtecnicos_id" type="hidden" id="dtecnicos_id" value="<?php echo $dtecnicos_id; ?>">
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
var sprytextfield2 = new Spry.Widget.ValidationTextField("spry_dtecnicos_numbandas", "integer", {maxChars:50});
var sprytextfield3 = new Spry.Widget.ValidationTextField("spry_dtecnicos_numcolores", "integer");
var sprytextfield4 = new Spry.Widget.ValidationTextField("spry_dtecnicos_ancho_final", "real");
var spryselect1 = new Spry.Widget.ValidationSelect("spry_dtecnicos_cliente", {invalidValue:"-1"});
var spryselect2 = new Spry.Widget.ValidationSelect("spry_dtecnicos_articulo", {invalidValue:"-1"});
</script>
</body>
</html>