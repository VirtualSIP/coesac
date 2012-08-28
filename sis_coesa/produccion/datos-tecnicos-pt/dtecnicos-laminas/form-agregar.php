<?php
//REQUIRE
require_once("../../../../connect/conexion.php");

//WEB
$web="http://coesac.marostsac.com/";

//VARIABLES URL
$id_articulo=$_REQUEST["dart"];
$dt_accion=$_REQUEST["ac"];
$dt_n_laminas=$_REQUEST["clm"];

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

              <div class="frmdt_cabecera">
                <h6>Datos Técnicos Básicos Laminas</h6></div>
            
                <div class="frmdt_contenido">
                    
                  <form action="guardar.php" method="post">
                  
                  <?php for($i=1;$i<=$dt_n_laminas;$i++){ ?>
                  
                  <?php
				  	$rst_articulo=mysql_query("SELECT * FROM syCoesa_articulo WHERE id_tipo_articulo=3 ORDER BY nombre_articulo ASC;", $conexion); //LAMINAS
					
					$rst_articulo_id=mysql_query("SELECT * FROM syCoesa_articulo WHERE id_tipo_articulo=3;", $conexion); //LAMINAS ID
					$fila_articulo_id=mysql_fetch_array($rst_articulo_id);
				  ?>
                  
                    <fieldset class="alto50 w245">
                      <label for="dt_articulo<?php echo $i;?>">Laminas:</label>
                      <select name="dt_articulo<?php echo $i;?>" id="dt_articulo<?php echo $i;?>" class="cmbSelc">
                        <option value>[ Seleccionar opcion ]</option>
                        <?php while($fila_articulo=mysql_fetch_array($rst_articulo)){
								//VARIABLES
								$articulo_id=$fila_articulo["id_articulo"];
								$articulo_nombre=$fila_articulo["nombre_articulo"];
							?>
                        	<option value="<?php echo $articulo_id; ?>"><?php echo $articulo_nombre; ?></option>
                        <?php } ?>
                      </select>
                    </fieldset>
                    
                    <?php
					//PROCESOS PRODUCTIVOS
					$rst_procesos=mysql_query("SELECT * FROM syCoesa_mantenimiento_procesos_productivos ORDER BY nombre_proceso ASC;", $conexion);
                    ?>
                    
                    <?php
                    	while($fila_procesos=mysql_fetch_array($rst_procesos)){
							//VARIABLES
							$procesos_id=$fila_procesos["id_proceso"];
							$procesos_nombre=$fila_procesos["nombre_proceso"];
					?>
                    	
                        <fieldset class="w245">
                        	<label><input name="procesos<?php echo $i;?>[]" type="checkbox" value="<?php echo $procesos_id; ?>">&nbsp;<?php echo $procesos_nombre; ?></label>
                        </fieldset>
                        
                    <?php } ?>
                        
                    <fieldset class="an100"><hr></fieldset>
                    
                   <?php } ?>
                   
                    <fieldset>
                        <input name="dtp_btnenviar" type="submit" id="dtp_btnenviar" value="Guardar datos">
                        <input name="cantidad_laminas" type="hidden" id="cantidad_laminas" value="<?php echo $dt_n_laminas; ?>">
                    </fieldset>
                        
                    </form>
                    
                </div>
                     
            </div><!-- FIN FORMULARIO DATOS -->
        
        </div><!-- FIN DATOS PROCESOS -->
    
    </section><!-- FIN SECTION CONTENIDO -->
    
</section><!-- FIN SECTION -->

</body>
</html>