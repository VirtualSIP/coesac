<?php
//REQUIRE
require_once("../../../../connect/conexion.php");

//WEB
$web="http://coesac.marostsac.com/";

//VARIABLES URL
$id_registro=$_REQUEST["id"];
$colores_dart=$_REQUEST["dart"];
$colores_did=$_REQUEST["did"];

//COLORES
$rst_colores=mysql_query("SELECT * FROM syCoesa_datos_tecnicos_colores WHERE id_colores=$id_registro;", $conexion);
$fila_colores=mysql_fetch_array($rst_colores);
$num_colores=mysql_num_rows($rst_colores);
if($num_colores==0){ header("Location:lista.php"); }

//LAMINAS - VARIABLES
$colores_id=$fila_colores["id_colores"];
$colores_nombre=$fila_colores["nombre_colores"];
$colores_cuerpo_impresor=$fila_colores["cuerpo_impresor_colores"];
$colores_cilindro=$fila_colores["cilindro_engranaje_colores"];
$colores_anilox=$fila_colores["anilox_colores"];
$colores_viscosidad=$fila_colores["viscosidad_colores"];
$colores_area_impresa=$fila_colores["area_impresa_colores"];
$colores_art_tintas=$fila_colores["id_articulo_tintas"];
$colores_art_cushion=$fila_colores["id_articulo_cushion"];
$colores_art_stickback=$fila_colores["id_articulo_stickback"];

//TINTAS
$rst_art_tintas=mysql_query("SELECT * FROM syCoesa_articulo WHERE id_tipo_articulo=2 ORDER BY nombre_articulo ASC;", $conexion);

//CUSHION
$rst_art_cushion=mysql_query("SELECT * FROM syCoesa_articulo WHERE id_tipo_articulo=7 ORDER BY nombre_articulo ASC;", $conexion);

//STICK BACK
$rst_art_stickback=mysql_query("SELECT * FROM syCoesa_articulo WHERE id_tipo_articulo=8 ORDER BY nombre_articulo ASC;", $conexion);

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
	jcmb( "#colores_art_tintas" ).combobox();
	jcmb( "#colores_art_cushion" ).combobox();
	jcmb( "#colores_art_stickback" ).combobox();
});
</script>

<!-- SPRY -->
<link rel="stylesheet" type="text/css" href="/libs_js/SpryAssets/SpryValidationTextField.css">
<link rel="stylesheet" type="text/css" href="/libs_js/SpryAssets/SpryValidationSelect.css">
<link rel="stylesheet" type="text/css" href="/libs_js/SpryAssets/SpryValidationTextarea.css">
<script type="text/javascript" src="/libs_js/SpryAssets/SpryValidationSelect.js"></script>
<script type="text/javascript" src="/libs_js/SpryAssets/SpryValidationTextField.js"></script>
<script type="text/javascript" src="/libs_js/SpryAssets/SpryValidationTextarea.js"></script>

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
            <h6>Datos Técnicos Básicos Laminas | ID: <?php echo $colores_id; ?></h6></div>
            
                <div class="frmdt_contenido">
                    
                  <form action="actualizar.php" method="post">
                                         
                        <fieldset class="alto50">
                              <label for="colores_cuerpo_impresor">Cuerpo impresor:</label>
                          	<span id="spry_colores_cuerpo_impresor">
                              <input type="text" name="colores_cuerpo_impresor" id="colores_cuerpo_impresor" size="50" class="an50" value="<?php echo $colores_cuerpo_impresor; ?>">
                              <span class="textfieldRequiredMsg">(*)</span></span>
                        </fieldset>
                        
                    <fieldset class="alto50">
                          <label for="colores_art_tintas">Tintas:</label>
                          <span id="spry_colores_art_tintas">
                          <select name="colores_art_tintas" id="colores_art_tintas">
                            <option value>[ Seleccionar opcion ]</option>
                            <?php while ($fila_art_tintas=mysql_fetch_array($rst_art_tintas)){
								  	//VARIABLES
									$art_tintas_id=$fila_art_tintas["id_articulo"];
									$art_tintas_nombre=$fila_art_tintas["nombre_articulo"];
								?>
                            <?php if ($colores_art_tintas==$art_tintas_id){ ?>
                            <option selected='' value=<?php echo $art_tintas_id; ?>><?php echo $art_tintas_nombre; ?></option>
                            <?php }else{ ?>
                            <option value=<?php echo $art_tintas_id; ?>><?php echo $art_tintas_nombre; ?></option>
                            <?php }} ?>
                          </select>
                          <span class="selectInvalidMsg">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(*)</span>
                          <span class="selectRequiredMsg">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(*)</span></span>
                    </fieldset>
                        
                        <fieldset class="alto50">
                          <label for="colores_art_cushion">Cushion:</label>
                          <span id="spry_colores_art_cushion">
                          <select name="colores_art_cushion" id="colores_art_cushion">
                            <option value>[ Seleccionar opcion ]</option>
                            <?php while ($fila_art_cushion=mysql_fetch_array($rst_art_cushion)){
								  	//VARIABLES
									$art_cushion_id=$fila_art_cushion["id_articulo"];
									$art_cushion_nombre=$fila_art_cushion["nombre_articulo"];
								?>
                            <?php if ($colores_art_cushion==$art_cushion_id){ ?>
                            <option selected='' value=<?php echo $art_cushion_id; ?>><?php echo $art_cushion_nombre; ?></option>
                            <?php }else{ ?>
                            <option value=<?php echo $art_cushion_id; ?>><?php echo $art_cushion_nombre; ?></option>
                            <?php }} ?>
                          </select>
                          <span class="selectInvalidMsg">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(*)</span>
                          <span class="selectRequiredMsg">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(*)</span></span>
                        </fieldset>
                        
                        <fieldset class="alto50">
                          <label for="colores_art_stickback">Stick Back:</label>
                          <span id="spry_colores_art_stickback">
                          <select name="colores_art_stickback" id="colores_art_stickback">
                            <option value>[ Seleccionar opcion ]</option>
                            <?php while ($fila_art_stickback=mysql_fetch_array($rst_art_stickback)){
								  	//VARIABLES
									$art_stickback_id=$fila_art_stickback["id_articulo"];
									$art_stickback_nombre=$fila_art_stickback["nombre_articulo"];
								?>
                            <?php if ($colores_art_stickback==$art_stickback_id){ ?>
                            <option selected='' value=<?php echo $art_stickback_id; ?>><?php echo $art_stickback_nombre; ?></option>
                            <?php }else{ ?>
                            <option value=<?php echo $art_stickback_id; ?>><?php echo $art_stickback_nombre; ?></option>
                            <?php }} ?>
                          </select>
                          <span class="selectInvalidMsg">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(*)</span>
                          <span class="selectRequiredMsg">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(*)</span></span>
                        </fieldset>
                        
                    <fieldset class="alto50">
                            <label for="colores_cilindro">Cilindro / Engranaje:</label>
                      <span id="spry_colores_cilindro">
                            <input type="text" name="colores_cilindro" id="colores_cilindro" size="50" class="an50"  value="<?php echo $colores_cilindro; ?>">
                            <span class="textfieldRequiredMsg">(*)</span></span>
                        </fieldset>
                            
                        <fieldset class="alto50">
                          	<label for="colores_anilox">Anilox:</label>
                       	  <span id="spry_colores_anilox">
                            <input type="text" name="colores_anilox" id="colores_anilox" size="50" class="an50" value="<?php echo $colores_anilox; ?>">
                            <span class="textfieldRequiredMsg">(*)</span></span>
                        </fieldset>
                            
                        <fieldset class="alto50">
                            <label for="colores_viscocidad">Viscosidad:</label>
                       	  <span id="spry_colores_viscocidad">
                            <input type="text" name="colores_viscocidad" id="colores_viscocidad" size="50" class="an50" value="<?php echo $colores_viscosidad; ?>">
                            <span class="textfieldRequiredMsg">(*)</span></span>
                        </fieldset>
                            
                        <fieldset class="alto50">
                            <label for="colores_area_impresa">Área Impresa:</label>
                          <span id="spry_colores_area_impresa">
                            <input type="text" name="colores_area_impresa" id="colores_area_impresa" size="50" class="an50" value="<?php echo $colores_area_impresa; ?>">
                            <span class="textfieldRequiredMsg">(*)</span></span>
                        </fieldset>
                        
                   	<fieldset>
                        	<input name="colores_id" type="hidden" id="colores_id" value="<?php echo $colores_id; ?>">
                            <input name="colores_dart" type="hidden" id="colores_dart" value="<?php echo $colores_dart; ?>">
                            <input name="colores_did" type="hidden" id="colores_did" value="<?php echo $colores_did; ?>">
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
var sprytextfield2 = new Spry.Widget.ValidationTextField("spry_colores_cuerpo_impresor");
var sprytextfield3 = new Spry.Widget.ValidationTextField("spry_colores_cilindro");
var sprytextfield4 = new Spry.Widget.ValidationTextField("spry_colores_anilox");
var sprytextfield5 = new Spry.Widget.ValidationTextField("spry_colores_viscocidad");
var sprytextfield6 = new Spry.Widget.ValidationTextField("spry_colores_area_impresa");
var spryselect1 = new Spry.Widget.ValidationSelect("spry_colores_art_tintas", {invalidValue:"-1"});
var spryselect2 = new Spry.Widget.ValidationSelect("spry_colores_art_cushion", {invalidValue:"-1"});
var spryselect3 = new Spry.Widget.ValidationSelect("spry_colores_art_stickback", {invalidValue:"-1"});
</script>
</body>
</html>