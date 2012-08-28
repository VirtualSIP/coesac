<?php
session_start();
require_once("../../../../connect/conexion.php");
require_once("../../../../connect/function.php");
require_once("../../../../connect/sesion/verificar_sesion.php");

//VARIABLES URL
$id_dt=$_REQUEST["did"];
$dt_accion=$_REQUEST["ac"];
$dt_n_laminas=$_REQUEST["clm"];
$dart=$_REQUEST["dart"];
$clt=$_REQUEST["clt"];
$codUnico=$_REQUEST["cun"];

//ACCIONES DE CANTIDAD
if($dt_accion=="add"){ $dtecnicos_ctdlaminas=1;}
else{ $dtecnicos_ctdlaminas=$dt_n_laminas; }

//SELECCIONAR LOS DATOS TECNICOS BASICOS
$rst_did=mysql_query("SELECT * FROM syCoesa_datos_tecnicos WHERE id_datos_tecnicos=$id_dt", $conexion);
$fila_did=mysql_fetch_array($rst_did);

//MAXIMO REFILE DE MAQUINAS
$rst_maq=mysql_query("SELECT * FROM syCoesa_mantenimiento_maquinas_datos ORDER BY refile_maquina DESC;", $conexion);
$fila_maq=mysql_fetch_array($rst_maq);
$maq_refile=$fila_maq["refile_maquina"];

//FORMULA: ANCHO FINAL * BANDAS + REFILE
$producto_nombre=seleccionTabla($fila_did["id_articulo"], "id_articulo", "syCoesa_articulo", $conexion);
$did_ancho_final=$fila_did["ancho_final_datos_tecnicos"];
$did_nro_bandas=$fila_did["nro_bandas_datos_tecnicos"];
$formula_filtro=$did_ancho_final * $did_nro_bandas + $maq_refile;

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
                <h6>Datos Técnicos Básicos Laminas | <?php echo $producto_nombre["nombre_articulo"]; ?></h6></div>
            
                <div class="frmdt_contenido">
                    
                  <form action="guardar.php" method="post">
                  
                  
                  <div class="w250 float_left border_der margin_r10">
                  	
                    <h2>Monocapa</h2>
                  
                  	<?php $rst_articulo1=mysql_query("SELECT * FROM syCoesa_articulo WHERE id_tipo_articulo=3 OR id_tipo_articulo=6 ORDER BY nombre_articulo ASC;", $conexion); ?>
                    <!-- SELECCIONAR PROCESOS DE LAMINA -->
                    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
                  	<script>
                    var jProLam1 = jQuery.noConflict();
					jProLam1(document).ready(function(){
						jProLam1("#dt_articulo1").change(function(){
							jProLam1("#progressbar").removeClass("ocultar");
							var lamina = jProLam1(this).val();
							jProLam1.post("seleccionar-procesos.php", {lamina: lamina, rep: 1},
								function(data){
									jProLam1("#progressbar").addClass("ocultar");
									jProLam1("#procesos_laminas_1").html(data);
								});
						});
					});
                    </script>
                  
                    <fieldset class="alto50 w245">
                      <label for="dt_articulo1">Laminas:</label>
                      <select name="dt_articulo1" id="dt_articulo1" class="w245">
                        <option value>[ Seleccionar opcion ]</option>
                        <?php while($fila_articulo1=mysql_fetch_array($rst_articulo1)){
								//VARIABLES
								$articulo_id=$fila_articulo1["id_articulo"];
								$articulo_nombre=$fila_articulo1["nombre_articulo"];
								$articulo_ancho=$fila_articulo1["ancho_articulo"];
								
								if($articulo_ancho>=$formula_filtro){
							?>
                        	<option value="<?php echo $articulo_id; ?>"><?php echo $articulo_nombre; ?></option>
                        <?php }} ?>
                      </select>
                    </fieldset>
                    
                    	<div id="procesos_laminas_1" class="float_left w250"></div>
                    
                    </div><!-- FIN LAMINA 1 -->
                    
                    <div class="w250 float_left border_der margin_r10">
                    
                    <h2>Bilaminado</h2>
                    
                  	<?php $rst_articulo2=mysql_query("SELECT * FROM syCoesa_articulo WHERE id_tipo_articulo=3 OR id_tipo_articulo=6 ORDER BY nombre_articulo ASC;", $conexion); ?>
                    <!-- SELECCIONAR PROCESOS DE LAMINA -->
                    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
                  	<script>
                    var jProLam2 = jQuery.noConflict();
					jProLam2(document).ready(function(){
						jProLam2("#dt_articulo2").change(function(){
							jProLam2("#progressbar").removeClass("ocultar");
							var lamina = jProLam2(this).val();
							jProLam2.post("seleccionar-procesos.php", {lamina: lamina, rep: 2},
								function(data){
									jProLam2("#progressbar").addClass("ocultar");
									jProLam2("#procesos_laminas_2").html(data);
								});
						});
					});
                    </script>
                  
                    <fieldset class="alto50 w245">
                      <label for="dt_articulo2">Laminas:</label>
                      <select name="dt_articulo2" id="dt_articulo2" class="w245">
                        <option value>[ Seleccionar opcion ]</option>
                        <?php while($fila_articulo2=mysql_fetch_array($rst_articulo2)){
								//VARIABLES
								$articulo_id=$fila_articulo2["id_articulo"];
								$articulo_nombre=$fila_articulo2["nombre_articulo"];
								$articulo_ancho=$fila_articulo2["ancho_articulo"];
								
								if($articulo_ancho>=$formula_filtro){
							?>
                        	<option value="<?php echo $articulo_id; ?>"><?php echo $articulo_nombre; ?></option>
                        <?php }} ?>
                      </select>
                    </fieldset>
                    
                    	<div id="procesos_laminas_2" class="float_left w250"></div>
                    
                    </div><!-- FIN LAMINA 2 -->
                    
                    <div class="w250 float_left border_der margin_r10">
                    
                    <h2>Trilaminado</h2>
                    
                  	<?php $rst_articulo3=mysql_query("SELECT * FROM syCoesa_articulo WHERE id_tipo_articulo=3 OR id_tipo_articulo=6 ORDER BY nombre_articulo ASC;", $conexion); ?>
                    <!-- SELECCIONAR PROCESOS DE LAMINA -->
                    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
                  	<script>
                    var jProLam3 = jQuery.noConflict();
					jProLam3(document).ready(function(){
						jProLam3("#dt_articulo3").change(function(){
							jProLam3("#progressbar").removeClass("ocultar");
							var lamina = jProLam3(this).val();
							jProLam3.post("seleccionar-procesos.php", {lamina: lamina, rep: 3},
								function(data){
									jProLam3("#progressbar").addClass("ocultar");
									jProLam3("#procesos_laminas_3").html(data);
								});
						});
					});
                    </script>
                  
                    <fieldset class="alto50 w245">
                      <label for="dt_articulo3">Laminas:</label>
                      <select name="dt_articulo3" id="dt_articulo3" class="w245">
                        <option value>[ Seleccionar opcion ]</option>
                        <?php while($fila_articulo3=mysql_fetch_array($rst_articulo3)){
								//VARIABLES
								$articulo_id=$fila_articulo3["id_articulo"];
								$articulo_nombre=$fila_articulo3["nombre_articulo"];
								$articulo_ancho=$fila_articulo3["ancho_articulo"];
								
								if($articulo_ancho>=$formula_filtro){
							?>
                        	<option value="<?php echo $articulo_id; ?>"><?php echo $articulo_nombre; ?></option>
                        <?php }} ?>
                      </select>
                    </fieldset>
                    
                    	<div id="procesos_laminas_3" class="float_left w250"></div>
                    
                    </div><!-- FIN LAMINA 3 -->
                    
                   
                    <fieldset>
                        <input name="dtp_btnenviar" type="submit" id="dtp_btnenviar" value="Guardar datos">
                        <?php if($dt_accion=="add"){ ?>
                        <input name="dtp_btnenviar" type="button" id="dtp_btnenviar" value="Cancelar" onClick="parent.location='lista.php?did=<?php echo $did; ?>&dart=<?php echo $dart; ?>&clt=<?php echo $clt; ?>'">
                        <input name="accion" type="hidden" id="accion" value="<?php echo $dt_accion; ?>">
                        <?php } ?>
                        <input name="dato_tecnico" type="hidden" id="dato_tecnico" value="<?php echo $id_dt; ?>">
                        <input name="cantidad_laminas" type="hidden" id="cantidad_laminas" value="<?php echo $dtecnicos_ctdlaminas; ?>">
                        <input name="dart" type="hidden" id="dart" value="<?php echo $dart; ?>">
                        <input name="clt" type="hidden" id="clt" value="<?php echo $clt; ?>">
                        <input name="cun" type="hidden" id="clt" value="<?php echo $codUnico; ?>">
                    </fieldset>
                        
                    </form>
                    
                </div>
                     
            </div><!-- FIN FORMULARIO DATOS -->
        
        </div><!-- FIN DATOS PROCESOS -->
    
    </section><!-- FIN SECTION CONTENIDO -->
    
</section><!-- FIN SECTION -->

</body>
</html>