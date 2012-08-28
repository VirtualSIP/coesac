<?php
session_start();
require_once("../../../../connect/conexion.php");
require_once("../../../../connect/function.php");
require_once("../../../../connect/sesion/verificar_sesion.php");

//VARIABLES URL
$id_registro=$_REQUEST["idlmpr"];
$did=$_REQUEST["did"];
$dart=$_REQUEST["dart"];
$clt=$_REQUEST["clt"];
$cont=0;

//SELECCIONAR LOS DATOS TECNICOS BASICOS
$rst_did=mysql_query("SELECT * FROM syCoesa_datos_tecnicos WHERE id_datos_tecnicos=$did", $conexion);
$fila_did=mysql_fetch_array($rst_did);

//MAXIMO REFILE DE MAQUINAS
$rst_maq=mysql_query("SELECT * FROM syCoesa_mantenimiento_maquinas_datos ORDER BY refile_maquina DESC;", $conexion);
$fila_maq=mysql_fetch_array($rst_maq);
$maq_refile=$fila_maq["refile_maquina"];

//FORMULA: ANCHO FINAL * BANDAS + REFILE
$did_ancho_final=$fila_did["ancho_final_datos_tecnicos"];
$did_nro_bandas=$fila_did["nro_bandas_datos_tecnicos"];
$formula_filtro=$did_ancho_final * $did_nro_bandas + $maq_refile;

//LAMINAS
$rst_lamina=mysql_query("SELECT * FROM syCoesa_datos_tecnicos_laminas_procesos WHERE id_laminas_procesos=$id_registro;", $conexion);
$fila_lamina=mysql_fetch_array($rst_lamina);

//VARIABLES
$lamina_datos_tecnicos=$fila_lamina["id_datos_tecnicos"];

//LAMINAS
$lamina1=$fila_lamina["lamina1"];
$lamina1_extrusion=$fila_lamina["lamina1_extrusion"];
$lamina1_impresion=$fila_lamina["lamina1_impresion"];
$lamina1_impresion_grm2=$fila_lamina["lamina1_impresion_grm2"];
$lamina1_bilaminado=$fila_lamina["lamina1_bilaminado"];
$lamina1_trilaminado=$fila_lamina["lamina1_trilaminado"];
$lamina1_rebobinado=$fila_lamina["lamina1_rebobinado"];
$lamina1_habilitado=$fila_lamina["lamina1_habilitado"];
$lamina1_cortefinal=$fila_lamina["lamina1_cortefinal"];
$lamina1_sellado=$fila_lamina["lamina1_sellado"];

$lamina2=$fila_lamina["lamina2"];
$lamina2_extrusion=$fila_lamina["lamina2_extrusion"];
$lamina2_impresion=$fila_lamina["lamina2_impresion"];
$lamina2_bilaminado=$fila_lamina["lamina2_bilaminado"];
$lamina2_bilaminado_grm2=$fila_lamina["lamina2_bilaminado_grm2"];
$lamina2_trilaminado=$fila_lamina["lamina2_trilaminado"];
$lamina2_rebobinado=$fila_lamina["lamina2_rebobinado"];
$lamina2_habilitado=$fila_lamina["lamina2_habilitado"];
$lamina2_cortefinal=$fila_lamina["lamina2_cortefinal"];
$lamina2_sellado=$fila_lamina["lamina2_sellado"];

$lamina3=$fila_lamina["lamina3"];
$lamina3_extrusion=$fila_lamina["lamina3_extrusion"];
$lamina3_impresion=$fila_lamina["lamina3_impresion"];
$lamina3_bilaminado=$fila_lamina["lamina3_bilaminado"];
$lamina3_trilaminado=$fila_lamina["lamina3_trilaminado"];
$lamina3_trilaminado_grm2=$fila_lamina["lamina3_trilaminado_grm2"];
$lamina3_rebobinado=$fila_lamina["lamina3_rebobinado"];
$lamina3_habilitado=$fila_lamina["lamina3_habilitado"];
$lamina3_cortefinal=$fila_lamina["lamina3_cortefinal"];
$lamina3_sellado=$fila_lamina["lamina3_sellado"];

//PRODUCTO TERMINADO
$producto_nombre=seleccionTabla($fila_did["id_articulo"], "id_articulo", "syCoesa_articulo", $conexion);

?>
<!DOCTYPE HTML>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>COESA</title>

<!-- ESTILOS -->
<link rel="stylesheet" type="text/css" href="/css/normalize.css">
<link rel="stylesheet" type="text/css" href="/css/estilos_sis_coesa.css">

<!-- FUENTES -->
<link href='http://fonts.googleapis.com/css?family=Cuprum:400,700' rel='stylesheet' type='text/css'>

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

<!-- SELECCIONAR PROCESOS DE LAMINA -->
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
<script>
var jProLam = jQuery.noConflict();
jProLam(document).ready(function(){
	
	jProLam("#dt_articulo1").change(function(){
		jProLam("#progressbar").removeClass("ocultar");
		var lamina = jProLam(this).val();
		jProLam.post("seleccionar-procesos.php", {lamina: lamina, rep: 1},
			function(data){
				jProLam("#progressbar").addClass("ocultar");
				jProLam("#procesos_laminas1").html(data);
			});
	});
	
	jProLam("#dt_articulo2").change(function(){
		jProLam("#progressbar").removeClass("ocultar");
		var lamina = jProLam(this).val();
		jProLam.post("seleccionar-procesos.php", {lamina: lamina, rep: 2},
			function(data){
				jProLam("#progressbar").addClass("ocultar");
				jProLam("#procesos_laminas2").html(data);
			});
	});
	
	jProLam("#dt_articulo3").change(function(){
		jProLam("#progressbar").removeClass("ocultar");
		var lamina = jProLam(this).val();
		jProLam.post("seleccionar-procesos.php", {lamina: lamina, rep: 3},
			function(data){
				jProLam("#progressbar").addClass("ocultar");
				jProLam("#procesos_laminas3").html(data);
			});
	});
	
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
            <h6>Datos Técnicos Básicos Laminas | <?php echo $producto_nombre["nombre_articulo"]; ?></h6></div>
            
                <div class="frmdt_contenido">
                    
                    <form action="actualizar.php" method="post">
                      
                      <div class="w250 float_left border_der margin_r10">
                      	
                        <h2>Monocapa</h2>
                        
                        <?php $rst_articulo1=mysql_query("SELECT * FROM syCoesa_articulo WHERE id_tipo_articulo=3 OR id_tipo_articulo=6 ORDER BY nombre_articulo ASC;", $conexion); ?>
                      
                        <fieldset class="alto50 w245">
                          <label for="dt_articulo1">Laminas:</label>
                          <select name="dt_articulo1" id="dt_articulo1" class="w245">
                                <option value>[ Seleccionar opcion ]</option>
                                <?php while ($fila_articulo1=mysql_fetch_array($rst_articulo1)){
                                  //VARIABLES
                                  $articulo_id=$fila_articulo1["id_articulo"];
                                  $articulo_nombre=$fila_articulo1["nombre_articulo"];
								  $articulo_ancho=$fila_articulo1["ancho_articulo"];
                                ?>
                                <?php if($articulo_ancho>=$formula_filtro){ ?>
									<?php if ($lamina1==$articulo_id){ ?>
                                        <option value=<?php echo $articulo_id ?> selected><?php echo $articulo_nombre ?></option>
                                    <?php }else{ ?>
                                        <option value=<?php echo $articulo_id ?>><?php echo $articulo_nombre ?></option>
                                    <?php }} ?>
                                <?php } ?>
                          </select>
                        </fieldset>
                        
                            <div id="procesos_laminas1" class="float_left w250">
                            
                            <fieldset class="w245">
                            <?php if($lamina1_extrusion==1){ ?><label><input checked id="procesos_maquinas_3" class="procesos_maquinas" name="extrusion1" type="checkbox" value="1">&nbsp;Extrusión</label>
                            <?php }else{ ?><label><input id="procesos_maquinas_3" class="procesos_maquinas" name="extrusion1" type="checkbox" value="1">&nbsp;Extrusión</label><?php } ?>
                            </fieldset>
                            
                            <fieldset class="w245">
                            <?php if($lamina1_impresion==1){ ?><label><input checked id="procesos_maquinas_4" class="procesos_maquinas" name="impresion1" type="checkbox" value="1">&nbsp;Impresión</label>
                            <?php }else{ ?><label><input id="procesos_maquinas_4" class="procesos_maquinas" name="impresion1" type="checkbox" value="1">&nbsp;Impresión</label><?php } ?>
                            </fieldset>
                            
                            <fieldset class="w245">
                                <label for="grm2_tintaseca_1">GR / m2 (Tinta seca)</label>
                                <input class="w140 texto_der" type="text" id="grm2_tintaseca" name="grm2_tintaseca" value="<?php echo $lamina1_impresion_grm2; ?>">
                            </fieldset>
                            
                            <fieldset class="w245">
                            <?php if($lamina1_bilaminado==1){ ?><label><input checked id="procesos_maquinas_5" class="procesos_maquinas" name="bilaminado1" type="checkbox" value="1">&nbsp;Bilaminado</label>
                            <?php }else{ ?><label><input id="procesos_maquinas_5" class="procesos_maquinas" name="bilaminado1" type="checkbox" value="1">&nbsp;Bilaminado</label><?php } ?>
                            </fieldset>
                            
                            <fieldset class="w245">
                            <?php if($lamina1_trilaminado==1){ ?><label><input checked id="procesos_maquinas_6" class="procesos_maquinas" name="trilaminado1" type="checkbox" value="1">&nbsp;Trilaminado</label>
                            <?php }else{ ?><label><input id="procesos_maquinas_6" class="procesos_maquinas" name="trilaminado1" type="checkbox" value="1">&nbsp;Trilaminado</label><?php } ?>
                            </fieldset>
                            
                            <fieldset class="w245">
                            <?php if($lamina1_rebobinado==1){ ?><label><input checked id="procesos_maquinas_9" class="procesos_maquinas" name="rebobinado1" type="checkbox" value="1">&nbsp;Rebobinado</label>
                            <?php }else{ ?><label><input id="procesos_maquinas_9" class="procesos_maquinas" name="rebobinado1" type="checkbox" value="1">&nbsp;Rebobinado</label><?php } ?>
                            </fieldset>
                            
                            <fieldset class="w245">
                            <?php if($lamina1_habilitado==1){ ?><label><input checked id="procesos_maquinas_10" class="procesos_maquinas" name="habilitado1" type="checkbox" value="1">&nbsp;Habilitado</label>
                            <?php }else{ ?><label><input id="procesos_maquinas_10" class="procesos_maquinas" name="habilitado1" type="checkbox" value="1">&nbsp;Habilitado</label><?php } ?>
                            </fieldset>
                            
                            <fieldset class="w245">
                            <?php if($lamina1_cortefinal==1){ ?><label><input checked id="procesos_maquinas_7" class="procesos_maquinas" name="cortefinal1" type="checkbox" value="1">&nbsp;Corte Final</label>
                            <?php }else{ ?><label><input id="procesos_maquinas_7" class="procesos_maquinas" name="cortefinal1" type="checkbox" value="1">&nbsp;Corte Final</label><?php } ?>
                            </fieldset>
                            
                            <fieldset class="w245">
                            <?php if($lamina1_sellado==1){ ?><label><input checked id="procesos_maquinas_8" class="procesos_maquinas" name="sellado1" type="checkbox" value="1">&nbsp;Sellado</label>
                            <?php }else{ ?><label><input id="procesos_maquinas_8" class="procesos_maquinas" name="sellado1" type="checkbox" value="1">&nbsp;Sellado</label><?php } ?>
                            </fieldset>
                            
                            </div>
                        
                        </div> <!-- FIN LAMINA 1 -->
                        
                        <div class="w250 float_left border_der margin_r10">
                      	<h2>Bilaminado</h2>
                        <?php $rst_articulo2=mysql_query("SELECT * FROM syCoesa_articulo WHERE id_tipo_articulo=3 OR id_tipo_articulo=6 ORDER BY nombre_articulo ASC;", $conexion); ?>
                      
                        <fieldset class="alto50 w245">
                          <label for="dt_articulo2">Laminas:</label>
                          <select name="dt_articulo2" id="dt_articulo2" class="w245">
                                <option value>[ Seleccionar opcion ]</option>
                                <?php while ($fila_articulo2=mysql_fetch_array($rst_articulo2)){
                                  //VARIABLES
                                  $articulo_id=$fila_articulo2["id_articulo"];
                                  $articulo_nombre=$fila_articulo2["nombre_articulo"];
								  $articulo_ancho=$fila_articulo2["ancho_articulo"];
                                ?>
                                <?php if($articulo_ancho>=$formula_filtro){ ?>
									<?php if ($lamina2==$articulo_id){ ?>
                                        <option value=<?php echo $articulo_id ?> selected><?php echo $articulo_nombre ?></option>
                                    <?php }else{ ?>
                                        <option value=<?php echo $articulo_id ?>><?php echo $articulo_nombre ?></option>
                                    <?php }} ?>
                                <?php } ?>
                          </select>
                        </fieldset>
                        
                            <div id="procesos_laminas2" class="float_left w250">
                            
                            <fieldset class="w245">
                            <?php if($lamina2_extrusion==1){ ?><label><input checked id="procesos_maquinas_3" class="procesos_maquinas" name="extrusion2" type="checkbox" value="1">&nbsp;Extrusión</label>
                            <?php }else{ ?><label><input id="procesos_maquinas_3" class="procesos_maquinas" name="extrusion2" type="checkbox" value="1">&nbsp;Extrusión</label><?php } ?>
                            </fieldset>
                            
                            <fieldset class="w245">
                            <?php if($lamina2_bilaminado==1){ ?><label><input checked id="procesos_maquinas_5" class="procesos_maquinas" name="bilaminado2" type="checkbox" value="1">&nbsp;Bilaminado</label>
                            <?php }else{ ?><label><input id="procesos_maquinas_5" class="procesos_maquinas" name="bilaminado2" type="checkbox" value="1">&nbsp;Bilaminado</label><?php } ?>
                            </fieldset>
                            <fieldset class="w245">
                                <label for="grm2_bilaminado">GR / m2</label>
                                <input class="w140 texto_der" type="text" id="grm2_bilaminado" name="grm2_bilaminado" value="<?php echo $lamina2_bilaminado_grm2; ?>">
                            </fieldset>
                            
                            <fieldset class="w245">
                            <?php if($lamina2_trilaminado==1){ ?><label><input checked id="procesos_maquinas_6" class="procesos_maquinas" name="trilaminado2" type="checkbox" value="1">&nbsp;Trilaminado</label>
                            <?php }else{ ?><label><input id="procesos_maquinas_6" class="procesos_maquinas" name="trilaminado2" type="checkbox" value="1">&nbsp;Trilaminado</label><?php } ?>
                            </fieldset>
                            
                            <fieldset class="w245">
                            <?php if($lamina2_rebobinado==1){ ?><label><input checked id="procesos_maquinas_9" class="procesos_maquinas" name="rebobinado2" type="checkbox" value="1">&nbsp;Rebobinado</label>
                            <?php }else{ ?><label><input id="procesos_maquinas_9" class="procesos_maquinas" name="rebobinado2" type="checkbox" value="1">&nbsp;Rebobinado</label><?php } ?>
                            </fieldset>
                            
                            <fieldset class="w245">
                            <?php if($lamina2_habilitado==1){ ?><label><input checked id="procesos_maquinas_10" class="procesos_maquinas" name="habilitado2" type="checkbox" value="1">&nbsp;Habilitado</label>
                            <?php }else{ ?><label><input id="procesos_maquinas_10" class="procesos_maquinas" name="habilitado2" type="checkbox" value="1">&nbsp;Habilitado</label><?php } ?>
                            </fieldset>
                            
                            <fieldset class="w245">
                            <?php if($lamina2_cortefinal==1){ ?><label><input checked id="procesos_maquinas_7" class="procesos_maquinas" name="cortefinal2" type="checkbox" value="1">&nbsp;Corte Final</label>
                            <?php }else{ ?><label><input id="procesos_maquinas_7" class="procesos_maquinas" name="cortefinal2" type="checkbox" value="1">&nbsp;Corte Final</label><?php } ?>
                            </fieldset>
                            
                            <fieldset class="w245">
                            <?php if($lamina2_sellado==1){ ?><label><input checked id="procesos_maquinas_8" class="procesos_maquinas" name="sellado2" type="checkbox" value="1">&nbsp;Sellado</label>
                            <?php }else{ ?><label><input id="procesos_maquinas_8" class="procesos_maquinas" name="sellado2" type="checkbox" value="1">&nbsp;Sellado</label><?php } ?>
                            </fieldset>
                            
                            </div>
                        
                        </div> <!-- FIN LAMINA 2 -->
                       
                       <div class="w250 float_left border_der margin_r10">
                      	<h2>Trilaminado</h2>
                        <?php $rst_articulo3=mysql_query("SELECT * FROM syCoesa_articulo WHERE id_tipo_articulo=3 OR id_tipo_articulo=6 ORDER BY nombre_articulo ASC;", $conexion); ?>
                      
                        <fieldset class="alto50 w245">
                          <label for="dt_articulo3">Laminas:</label>
                          <select name="dt_articulo3" id="dt_articulo3" class="w245">
                                <option value>[ Seleccionar opcion ]</option>
                                <?php while ($fila_articulo3=mysql_fetch_array($rst_articulo3)){
                                  //VARIABLES
                                  $articulo_id=$fila_articulo3["id_articulo"];
                                  $articulo_nombre=$fila_articulo3["nombre_articulo"];
								  $articulo_ancho=$fila_articulo3["ancho_articulo"];
                                ?>
                                <?php if($articulo_ancho>=$formula_filtro){ ?>
									<?php if ($lamina3==$articulo_id){ ?>
                                        <option value=<?php echo $articulo_id ?> selected><?php echo $articulo_nombre ?></option>
                                    <?php }else{ ?>
                                        <option value=<?php echo $articulo_id ?>><?php echo $articulo_nombre ?></option>
                                    <?php }} ?>
                                <?php } ?>
                          </select>
                        </fieldset>
                        
                            <div id="procesos_laminas3" class="float_left w250">
                            
                            <fieldset class="w245">
                            <?php if($lamina3_extrusion==1){ ?><label><input checked id="procesos_maquinas_3" class="procesos_maquinas" name="extrusion3" type="checkbox" value="1">&nbsp;Extrusión</label>
                            <?php }else{ ?><label><input id="procesos_maquinas_3" class="procesos_maquinas" name="extrusion3" type="checkbox" value="1">&nbsp;Extrusión</label><?php } ?>
                            </fieldset>
                            
                            <fieldset class="w245">
                            <?php if($lamina3_trilaminado==1){ ?><label><input checked id="procesos_maquinas_6" class="procesos_maquinas" name="trilaminado3" type="checkbox" value="1">&nbsp;Trilaminado</label>
                            <?php }else{ ?><label><input id="procesos_maquinas_6" class="procesos_maquinas" name="trilaminado3" type="checkbox" value="1">&nbsp;Trilaminado</label><?php } ?>
                            </fieldset>
                            
                            <fieldset class="w245">
                                <label for="grm2_trilaminado">GR / m2</label>
                                <input class="w140 texto_der" id="grm2_trilaminado" type="text" name="grm2_trilaminado" value="<?php echo $lamina3_trilaminado_grm2; ?>">
                            </fieldset>
                            
                            <fieldset class="w245">
                            <?php if($lamina3_rebobinado==1){ ?><label><input checked id="procesos_maquinas_9" class="procesos_maquinas" name="rebobinado3" type="checkbox" value="1">&nbsp;Rebobinado</label>
                            <?php }else{ ?><label><input id="procesos_maquinas_9" class="procesos_maquinas" name="rebobinado3" type="checkbox" value="1">&nbsp;Rebobinado</label><?php } ?>
                            </fieldset>
                            
                            <fieldset class="w245">
                            <?php if($lamina3_habilitado==1){ ?><label><input checked id="procesos_maquinas_10" class="procesos_maquinas" name="habilitado3" type="checkbox" value="1">&nbsp;Habilitado</label>
                            <?php }else{ ?><label><input id="procesos_maquinas_10" class="procesos_maquinas" name="habilitado3" type="checkbox" value="1">&nbsp;Habilitado</label><?php } ?>
                            </fieldset>
                            
                            <fieldset class="w245">
                            <?php if($lamina3_cortefinal==1){ ?><label><input checked id="procesos_maquinas_7" class="procesos_maquinas" name="cortefinal3" type="checkbox" value="1">&nbsp;Corte Final</label>
                            <?php }else{ ?><label><input id="procesos_maquinas_7" class="procesos_maquinas" name="cortefinal3" type="checkbox" value="1">&nbsp;Corte Final</label><?php } ?>
                            </fieldset>
                            
                            <fieldset class="w245">
                            <?php if($lamina3_sellado==1){ ?><label><input checked id="procesos_maquinas_8" class="procesos_maquinas" name="sellado3" type="checkbox" value="1">&nbsp;Sellado</label>
                            <?php }else{ ?><label><input id="procesos_maquinas_8" class="procesos_maquinas" name="sellado3" type="checkbox" value="1">&nbsp;Sellado</label><?php } ?>
                            </fieldset>
                            
                            </div>
                        
                        </div> <!-- FIN LAMINA 3 -->
                       
                        <fieldset>
                                <input name="dtp_btnenviar" type="submit" id="dtp_btnenviar" value="Guardar datos">
                                <input name="dtp_btnenviar" type="button" id="dtp_btnenviar" value="Cancelar" onClick="parent.location='lista.php?did=<?php echo $did; ?>&dart=<?php echo $dart; ?>&clt=<?php echo $clt; ?>$idlmpr=<?php echo $id_registro; ?>'">
                                <input name="id_registro" type="hidden" id="id_registro" value="<?php echo $id_registro; ?>">
                                <input name="did" type="hidden" id="did" value="<?php echo $did; ?>">
                                <input name="dart" type="hidden" id="dart" value="<?php echo $dart; ?>">
                                <input name="clt" type="hidden" id="clt" value="<?php echo $clt; ?>">
                            </fieldset>
                            
                        </form>
                    
                </div>
                     
            </div><!-- FIN FORMULARIO DATOS -->
        
        </div><!-- FIN DATOS PROCESOS -->
    
    </section><!-- FIN SECTION CONTENIDO -->
    
</section><!-- FIN SECTION -->

</body>
</html>