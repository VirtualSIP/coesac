<?php
session_start();
require_once("../../../connect/conexion.php");
require_once("../../../connect/function.php");
require_once("../../../connect/sesion/verificar_sesion.php");

//VARIABLES DE URL
$notificacion=$_REQUEST["msj"];

//COTIZACION
$rst_cotizacion=mysql_query("SELECT * FROM syCoesa_cotizacion ORDER BY id_cotizacion DESC;", $conexion);

//MENSAJE
$varMsj=$_REQUEST["msj"];
if($varMsj=="tcp"){
	$mensaje="Los datos de la Cotizacion seleccionada, fueron enviados a Costos de Producción.";
}

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

<!-- MOVER A COTIZACION -->
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript" src="/libs_js/blockui/jquery.blockUI.js"></script>
<script type="text/javascript">
var jcladd = jQuery.noConflict();
jcladd(document).ready(function() { 
	jcladd('.registro').click(function(){ 
		jcladd("#progressbar").removeClass("ocultar");
		var cotizacion = jcladd(this).attr("id");
		jcladd.post("mostrar-cliente.php", {cotizacion: cotizacion},
		function(data){
			jcladd("#cliente_add").html(data);
			jcladd.blockUI({ 
				message: jcladd('#cliente_add')
			});
			jcladd("#progressbar").addClass("ocultar");
		});
		
	});	 
});
</script>

<?php if($notificacion<>""){ ?>
<!-- NOTICIFICACIONES -->
<link type="text/css" href="/libs_js/jnotify/css/jquery.jnotify.css" rel="stylesheet" title="default" media="all" />
<link type="text/css" href="/libs_js/jnotify/css/jquery.jnotify-alt.css" rel="alternate stylesheet" title="alt" media="all" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="/libs_js/jnotify/lib/jquery.jnotify.min.js"></script>
<script type="text/javascript">
var jNotify = jQuery.noConflict();
jNotify(document).ready(function (){
	<?php if($notificacion==1){ ?>
	jNotify.jnotify("El registro se ha guardado correctamente.", 5000);
	<?php }elseif($notificacion==2){ ?>
	jNotify.jnotify("El registro NO se ha guardado correctamente, ingrese nuevamente los datos.", "error", 5000);
	<?php }elseif($notificacion==3){ ?>
	jNotify.jnotify("El registro se ha actualizó correctamente.", 5000);
	<?php }elseif($notificacion==4){ ?>
	jNotify.jnotify("El registro NO se ha actualizado correctamente, ingrese nuevamente los datos.", "error", 5000);
	<?php }elseif($notificacion==5){ ?>
	jNotify.jnotify("El registro se eliminó correctamente.", 5000);
	<?php }elseif($notificacion==6){ ?>
	jNotify.jnotify("El registro NO eliminó correctamente, intente nuevamente.", "error", 5000);
	<?php }elseif($notificacion=="tcp"){ ?>
	jNotify.jnotify("Los datos de la Cotizacion seleccionada, fueron enviados a Costos de Producción.", 7000);
	<?php }elseif($notificacion=="tcpE"){ ?>
	jNotify.jnotify("Se produjo un error a la hora de enviar la Cotizacion a Costos de Producción.", "error", 7000);
	<?php } ?>
});
</script>
<?php } ?>

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
                <h6>Cotización - Lista</h6></div>
                            
                <div class="frmdt_contenido">
                
                <?php if($mensaje<>""){ ?>
                <div class="frmdtc_acciones texto_cen">
                    <p class="text_mensaje"><?php echo $mensaje; ?></p>
                </div>
                <?php } ?>
                
                <div class="frmdtc_acciones">
                    Acciones: 
                    <a href="form-agregar.php">
                    	<img src="/imagenes/icons/icon-agregar.png" width="20" height="20" alt="Agregar"></a>
                </div>
                    
                <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
                    <thead>
                        <tr>
                            <th width="40%">Cliente</th>
                            <th width="40%">Producto</th>
                            <th width="20%">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    
                    	<?php while($fila_cotizacion=mysql_fetch_array($rst_cotizacion)){
							$cotizacion_id=$fila_cotizacion["id_cotizacion"];
							$cotizacion_cliente=$fila_cotizacion["cliente_cotizacion"];
							$cotizacion_producto=$fila_cotizacion["producto_cotizacion"];							
						?>
                        <tr>
                            <td align="center"><?php echo $cotizacion_cliente; ?></td>
                            <td class="center"><?php echo $cotizacion_producto; ?></td>
                          	<td class="center">
                            	<a href="form-editar.php?id=<?php echo $cotizacion_id; ?>" title="Modificar Registro">
                                <img src="/imagenes/icons/icon-editar.png" width="20" height="20" alt="Editar"></a>
                                &nbsp;
                                <a onclick="eliminarRegistro(<?php echo $cotizacion_id; ?>, '<?php echo $cotizacion_cliente; ?>');" href="javascript:;" title="Eliminar registro">
                              	<img src="/imagenes/icons/icon-eliminar.png" width="20" height="20" alt="Eliminar"></a>
                                &nbsp;
                                <a href="impresion.php?imp=<?php echo $cotizacion_id; ?>" target="_blank" title="Imprimir">
                              	<img src="/imagenes/icons/icon-imprimir.png" width="21" height="20" alt="Imprimir"></a>
                                &nbsp;
                                <a id="<?php echo $cotizacion_id; ?>" class="registro" href="javascript:;" title="Mover a COSTOS DE PRODUCCIÓN">
                              	<img src="/imagenes/icons/icon-mover-registro.png" width="20" height="20" alt="Mover a COSTOS DE PRODUCCIÓN"></a>
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

<div id="cliente_add">
    
</div>

</body>
</html>