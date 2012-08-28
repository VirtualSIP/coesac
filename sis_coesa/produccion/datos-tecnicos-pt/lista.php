<?php
session_start();
require_once("../../../connect/conexion.php");
require_once("../../../connect/function.php");
require_once("../../../connect/sesion/verificar_sesion.php");

$web="http://coesac.marostsac.com/";

//DATOS TECNICOS
$rst_dtecnicos=mysql_query("SELECT * FROM syCoesa_datos_tecnicos ORDER BY id_datos_tecnicos DESC;", $conexion);

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

<!-- TABLAS -->
<link href="/libs/dataTables/media/css/demo_table.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript" src="/libs/dataTables/media/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf-8">
var jdtbl = jQuery.noConflict();
jQuery.fn.dataTableExt.oSort['string-case-asc']  = function(x,y) {
	return ((x < y) ? -1 : ((x > y) ?  1 : 0));
};
jQuery.fn.dataTableExt.oSort['string-case-desc'] = function(x,y) {
	return ((x < y) ?  1 : ((x > y) ? -1 : 0));
};

jdtbl(document).ready(function() {
	jdtbl('#example').dataTable( {
		"sPaginationType": "full_numbers",
		"aaSorting": [],
		"oLanguage": {
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron registros",
            "sInfo": "Mostrando _START_ a _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando 0 a 0 de 0 registros",
            "sInfoFiltered": "(Filtro: _MAX_ registros)",
			"sSearch": "Buscar:",
			"oPaginate": {
				"sFirst": "Pri",
				"sLast": "Últ",
				"sNext": "Sig",
				"sPrevious": "Ant"
			}
        }
	} );
} );
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

<!-- ELIMINAR -->
<script type="text/javascript">
function eliminarRegistro(registro, nombre) {
if(confirm("¿Está seguro de borrar este registro?\n"+nombre)) {
	document.location.href="eliminar.php?id="+registro;
	}
}
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
                <h6>Datos Técnicos Producción - Lista</h6></div>
                            
                <div class="frmdt_contenido">
                
                <div class="frmdtc_acciones">
                    Acciones: 
                    <a href="form-agregar.php">
                    	<img src="/imagenes/icons/icon-agregar.png" width="20" height="20" alt="Agregar"></a>
                </div>
                    
                <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
                    <thead>
                        <tr>
                            <th width="40%">Articulo</th>
                            <th width="40%">Cliente</th>
                            <th width="20%">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    
                    	<?php while($fila_dtecnicos=mysql_fetch_array($rst_dtecnicos)){
							$dtecnicos_id=$fila_dtecnicos["id_datos_tecnicos"];
							$dtecnicos_cliente=seleccionTabla($fila_dtecnicos["id_cliente"], "id_cliente", "syCoesa_clientes", $conexion);
							$dtecnicos_articulo=seleccionTabla($fila_dtecnicos["id_articulo"], "id_articulo", "syCoesa_articulo", $conexion);
							$dtecnicos_estado=$fila_dtecnicos["estado_datos_tecnicos"];
							
							//EXTRAER DATOS DE PROCESOS DE LAMINA
							$rst_lamina_proceso=mysql_query("SELECT * FROM syCoesa_datos_tecnicos_laminas_procesos WHERE id_datos_tecnicos=$dtecnicos_id AND id_articulo_tipo=6;", $conexion);
							$num_lamina_proceso=mysql_num_rows($rst_lamina_proceso);
							
						?>
                        <tr>
                            <td align="center"><?php echo $dtecnicos_articulo["nombre_articulo"]; ?></td>
                            <td class="center"><?php echo $dtecnicos_cliente["nombre_cliente"]; ?></td>
                          	<td class="center">
                            	<?php if($dtecnicos_estado=="I"){ ?>
                                <img src="/imagenes/icons/icon-listo-inactivo.png" width="20" height="20" alt="Esperando respuesta" title="Esperando respuesta">
                                <?php }elseif($dtecnicos_estado=="A"){ ?>
                                <img src="/imagenes/icons/icon-listo-activo.png" width="20" height="20" alt="Terminado" title="Terminado">
                                <?php } ?>
                                
                                &nbsp;
                                
                                <?php if($dtecnicos_estado=="I"){ ?>
                                <a href="dtecnicos-colores/form-agregar.php?dart=<?php echo $dtecnicos_articulo["id_articulo"]; ?>&did=<?php echo $dtecnicos_id; ?>" title="Colores">
                                <img src="/imagenes/icons/icon-color.png" width="20" height="20" alt="Colores"></a>
                                <?php }elseif($dtecnicos_estado=="A"){ ?>
                                <a href="dtecnicos-colores/lista.php?dart=<?php echo $dtecnicos_articulo["id_articulo"]; ?>&did=<?php echo $dtecnicos_id; ?>" title="Colores">
                                <img src="/imagenes/icons/icon-color.png" width="20" height="20" alt="Colores"></a>
                                <?php } ?>
                                
                                <?php if($num_lamina_proceso<>0){ ?>
                                &nbsp;
                                <a href="dtecnicos-laminas-polietileno/form-agregar.php?dart=<?php echo $dtecnicos_articulo["id_articulo"]; ?>&did=<?php echo $dtecnicos_id; ?>&cpl=<?php echo $num_lamina_proceso; ?>">
                                <img src="/imagenes/icons/icon-configuracion.png" width="20" height="20" align="Lámina Polietileno"></a>
								<?php } ?>
                                
                            </td>
                        </tr>
                        <?php } ?>
                        
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
                        </tr>
                    </tfoot>
                </table>
                    
                </div>
                     
            </div><!-- FIN FORMULARIO DATOS -->
        
        </div><!-- FIN DATOS PROCESOS -->
    
    </section><!-- FIN SECTION CONTENIDO -->
    
</section><!-- FIN SECTION -->
</body>
</html>