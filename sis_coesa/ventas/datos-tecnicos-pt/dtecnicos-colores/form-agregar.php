<?php
session_start();
require_once("../../../../connect/conexion.php");
require_once("../../../../connect/function.php");
require_once("../../../../connect/sesion/verificar_sesion.php");

//WEB
$web="http://coesac.marostsac.com/";

//VARIABLES URL
$id_articulo=$_REQUEST["dart"];
$id_cant_color=$_REQUEST["cid"];

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
	jcmb( ".cmbSelc" ).combobox();
	
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

<?php include("../../../header.php"); ?>

<section id="cuerpo">
  
  	<?php require_once("../../../menu.php"); ?>
    
    <section id="contenido">
    	
        <div id="datos_colores">
        	
            <div class="formulario_datos">

              <div class="frmdt_cabecera"><h6>Colores</h6></div>
            
                <div class="frmdt_contenido">
                    
                  <form action="guardar.php" method="post">
                  
                  <?php for($i=1;$i<=$id_cant_color;$i++){ ?>
                  
                  <?php
				  	//TINTAS
					$rst_art_tintas=mysql_query("SELECT * FROM syCoesa_articulo WHERE id_tipo_articulo=2 ORDER BY nombre_articulo ASC;", $conexion);
					
					//CUSHION
					$rst_art_cushion=mysql_query("SELECT * FROM syCoesa_articulo WHERE id_tipo_articulo=7 ORDER BY nombre_articulo ASC;", $conexion);
					
					//STICK BACK
					$rst_art_stickback=mysql_query("SELECT * FROM syCoesa_articulo WHERE id_tipo_articulo=8 ORDER BY nombre_articulo ASC;", $conexion);

				  ?>
                  
                    <fieldset class="alto50 w245">
                      <label for="colores_cuerpo_impresor<?php echo $i;?>">Cuerpo impresor:</label>
                      <input type="text" name="colores_cuerpo_impresor<?php echo $i;?>" id="colores_cuerpo_impresor<?php echo $i;?>" size="50" class="w215">
                    </fieldset>
                        
                    <fieldset class="alto50 w245">
                      <label for="colores_art_tintas<?php echo $i;?>">Tintas:</label>
                      <select name="colores_art_tintas<?php echo $i;?>" id="colores_art_tintas<?php echo $i;?>" class="cmbSelc">
                        <option value>[ Seleccionar opcion ]</option>
                        <?php while($fila_art_tintas=mysql_fetch_array($rst_art_tintas)){
								//VARIABLES
								$art_tintas_id=$fila_art_tintas["id_articulo"];
								$art_tintas_nombre=$fila_art_tintas["nombre_articulo"];
							?>
                        <option value="<?php echo $art_tintas_id; ?>"><?php echo $art_tintas_nombre; ?></option>
                        <?php } ?>
                      </select>
                    </fieldset>
                        
                    <fieldset class="alto50 w245">
                      <label for="colores_art_cushion<?php echo $i;?>">Cushion:</label>
                      <select name="colores_art_cushion<?php echo $i;?>" id="colores_art_cushion<?php echo $i;?>" class="cmbSelc">
                        <option value>[ Seleccionar opcion ]</option>
                        <?php while($fila_art_cushion=mysql_fetch_array($rst_art_cushion)){
								//VARIABLES
								$art_cushion_id=$fila_art_cushion["id_articulo"];
								$art_cushion_nombre=$fila_art_cushion["nombre_articulo"];
							?>
                        <option value="<?php echo $art_cushion_id; ?>"><?php echo $art_cushion_nombre; ?></option>
                        <?php } ?>
                      </select>
                    </fieldset>
                        
                    <fieldset class="alto50 w245">
                      <label for="colores_art_stickback<?php echo $i;?>">Stick Back:</label>
                      <select name="colores_art_stickback<?php echo $i;?>" id="colores_art_stickback<?php echo $i;?>" class="cmbSelc">
                        <option value>[ Seleccionar opcion ]</option>
                        <?php while($fila_art_stickback=mysql_fetch_array($rst_art_stickback)){
								//VARIABLES
								$art_stickback_id=$fila_art_stickback["id_articulo"];
								$art_stickback_nombre=$fila_art_stickback["nombre_articulo"];
							?>
                        <option value="<?php echo $art_stickback_id; ?>"><?php echo $art_stickback_nombre; ?></option>
                        <?php } ?>
                      </select>
                    </fieldset>
                        
                    <fieldset class="alto50 w245">
                      	<label for="colores_cilindro<?php echo $i;?>">Cilindro / Engranaje:</label>
                        <input type="text" name="colores_cilindro<?php echo $i;?>" id="colores_cilindro<?php echo $i;?>" size="50" class="w215">
                    </fieldset>
                        
                    <fieldset class="alto50 w245">
                      <label for="colores_anilox<?php echo $i;?>">Anilox:</label>
                      <input type="text" name="colores_anilox<?php echo $i;?>" id="colores_anilox<?php echo $i;?>" size="50" class="w215">
                    </fieldset>
                        
                    <fieldset class="alto50 w245">
                            <label for="colores_viscocidad<?php echo $i;?>">Viscosidad:</label>
                            <input type="text" name="colores_viscocidad<?php echo $i;?>" id="colores_viscocidad<?php echo $i;?>" size="50" class="w215">
                    </fieldset>
                        
                    <fieldset class="alto50 w245">
                            <label for="colores_area_impresa<?php echo $i;?>">Área Impresa:</label>
                            <input type="text" name="colores_area_impresa<?php echo $i;?>" id="colores_area_impresa<?php echo $i;?>" size="50" class="w215">
                    </fieldset>
                    
                    <fieldset class="an100"><hr></fieldset>
                    
                   <?php } ?>
                   
                    <fieldset>
                        <input name="dtp_btnenviar" type="submit" id="dtp_btnenviar" value="Guardar datos">
                        <input name="colores_articulo" type="hidden" value="<?php echo $id_articulo; ?>">
                        <input name="colores_cantidad" type="hidden" value="<?php echo $id_cant_color; ?>">
                    </fieldset>
                        
                    </form>
                    
                </div>
                     
            </div><!-- FIN FORMULARIO DATOS -->
        
        </div><!-- FIN DATOS PROCESOS -->
    
    </section><!-- FIN SECTION CONTENIDO -->
    
</section><!-- FIN SECTION -->

</body>
</html>