<?php
session_start();
require_once("../../../../connect/conexion.php");
require_once("../../../../connect/function.php");
require_once("../../../../connect/sesion/verificar_sesion.php");

$web="http://coesac.marostsac.com/";

//VARIABLES URL
$id_articulo=$_REQUEST["dart"];
$id_dt_tecnicos=$_REQUEST["did"];

//DATOS TECNICOS
$rst_colores=mysql_query("SELECT * FROM syCoesa_datos_tecnicos_colores WHERE id_datos_tecnicos=$id_dt_tecnicos ORDER BY cuerpo_impresor_colores ASC;", $conexion);

?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>COESA</title>

<!-- ESTILOS -->
<link href="/css/normalize.css" rel="stylesheet" type="text/css">
<link href="/css/estilos_sis_coesa.css" rel="stylesheet" type="text/css">

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

<!-- ORDENAR -->
<script type="text/javascript" src="/libs_js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="/libs_js/jquery-ui-1.8.5.custom.min.js"></script>
<script type="text/javascript">
var jq = jQuery.noConflict();
jq(document).ready(function() {
	jq("#lista_colores").sortable({
	  handle : '.handle',
	  update : function () {
		var order = jq('#lista_colores').sortable('serialize');
		jq("#info").load("ordenar.php?"+order);
	  }
	});
});
</script>

<!-- ELIMINAR -->
<script type="text/javascript">
function eliminarRegistro(registro, dart, did) {
if(confirm("¿Está seguro de borrar este registro?")) {
	document.location.href="eliminar.php?id="+registro+"&dart="+dart+"&did="+did;
	}
}
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
                <h6><a href="../lista.php">
                	<img src="/imagenes/icons/icon-back.png" width="25" height="19" alt="Atrás"></a>
                    Datos Técnicos Producción - Lista</h6></div>
                            
                <div class="frmdt_contenido">
                
                <div class="frmdtc_acciones">
                    Acciones: 
                    <a href="form-agregar.php?dart=<?php echo $id_articulo; ?>&did=<?php echo $id_dt_tecnicos; ?>&ac=add">
                    	<img src="/imagenes/icons/icon-agregar.png" width="20" height="20" alt="Agregar"></a>
                </div>
                
                <table class="tabla_colores">
                  <tr align="center">
                    <td width="11%" height="45px">Cuerpo Impresor</td>
                    <td width="11%" height="45px">Tintas</td>
                    <td width="11%" height="45px">Cushion</td>
                    <td width="11%" height="45px">Stick Back</td>
                    <td width="11%" height="45px">Cilindro</td>
                    <td width="11%" height="45px">Anilox</td>
                    <td width="11%" height="45px">Viscosidad</td>
                    <td width="11%" height="45px">Area Impresa</td>
                    <td width="11%" height="45px">Acciones</td>
                  </tr>
                </table>

                <table class="tabla_colores">
                    <tr>
                        <td width="100%">
                            <ul id="lista_colores">
                                <?php while($fila_colores=mysql_fetch_array($rst_colores)){
									//NUMERO DE COLORES
									$num_colores=mysql_num_rows($rst_colores);
									
                                    //VARIABLES
                                    $colores_id=$fila_colores["id_colores"];
									$colores_cuerpo_impresor=$fila_colores["cuerpo_impresor_colores"];
									$colores_art_tinta=seleccionTabla($fila_colores["id_articulo_tintas"], "id_articulo", "syCoesa_articulo", $conexion);
									$colores_art_cushion=seleccionTabla($fila_colores["id_articulo_cushion"], "id_articulo", "syCoesa_articulo", $conexion);
									$colores_art_stickback=seleccionTabla($fila_colores["id_articulo_stickback"], "id_articulo", "syCoesa_articulo", $conexion);
									$colores_cilindro=$fila_colores["cilindro_engranaje_colores"];
									$colores_anilox=$fila_colores["anilox_colores"];
									$colores_viscosidad=$fila_colores["viscosidad_colores"];
									$colores_area_impresa=$fila_colores["area_impresa_colores"];
                                ?>
                                    <li id="listItem_<?php echo $colores_id; ?>" class="alto">
                                    	<table class="tabla_colores">
                                          <tr align="center">
                                            <td width="11%" height="45px">
                                            	<img src="/imagenes/icons/icon-drag.png" alt="move" width="20" height="20" class="handle" />
                                            </td>
                                            <td width="11%" height="45px"><?php echo $colores_art_tinta["nombre_articulo"]; ?></td>
                                            <td width="11%" height="45px"><?php echo $colores_art_cushion["nombre_articulo"]; ?></td>
                                            <td width="11%" height="45px"><?php echo $colores_art_stickback["nombre_articulo"]; ?></td>
                                            <td width="11%" height="45px"><?php echo $colores_cilindro; ?></td>
                                            <td width="11%" height="45px"><?php echo $colores_anilox; ?></td>
                                            <td width="11%" height="45px"><?php echo $colores_viscosidad; ?></td>
                                            <td width="11%" height="45px"><?php echo $colores_area_impresa; ?></td>
                                            <td width="11%" height="45px">
												<a href="form-editar.php?dart=<?php echo $id_articulo; ?>&did=<?php echo $id_dt_tecnicos; ?>&id=<?php echo $colores_id; ?>">
                                                <img src="/imagenes/icons/icon-editar.png" width="20" height="20" alt="Editar" title="Editar"></a>&nbsp;
                                                <?php if($num_colores>1){ ?>
                                                <a onclick="eliminarRegistro(<?php echo $colores_id.", ".$id_articulo.", ".$id_dt_tecnicos; ?>);" href="javascript:;">
                                                <img src="/imagenes/icons/icon-eliminar.png" width="20" height="20" alt="Eliminar" title="Eliminar"></a>
                                                <?php } ?>
                                          </td>                                          </tr>
                                        </table>
                                    </li>
                                <?php } ?>
                            </ul>
                        </td>
                    </tr>
                </table>
                    
              </div>
                     
            </div><!-- FIN FORMULARIO DATOS -->
        
        </div><!-- FIN DATOS PROCESOS -->
    
    </section><!-- FIN SECTION CONTENIDO -->
    
</section><!-- FIN SECTION -->
</body>
</html>