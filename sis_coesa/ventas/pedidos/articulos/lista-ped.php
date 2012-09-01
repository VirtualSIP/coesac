<?php
session_start();
require_once("../../../../connect/conexion.php");
require_once("../../../../connect/function.php");
require_once("../../../../connect/sesion/verificar_sesion.php");

//VARIABLES DE URL
$notificacion=$_REQUEST["m"];

//VARIABLES URL
$id_pedido=$_REQUEST["id"];
$id_cliente=$_REQUEST["clt"];
$codigo_unico=$_REQUEST["cun"];

//DATOS
$cliente=seleccionTabla($id_cliente,"id_cliente","syCoesa_clientes",$conexion);

//PEDIDO
$rst_pedido=mysql_query("SELECT * FROM syCoesa_pedidos_final WHERE id_pedido=$id_pedido ORDER BY id_pedidos_final ASC;", $conexion);

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
		"aaSorting": [ [0,'asc']],
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
	<?php } ?>
});
</script>
<?php } ?>

<!-- ELIMINAR -->
<script type="text/javascript">
function eliminarRegistro(registro, cliente, pedido, cod_unico) {
if(confirm("¿Está seguro de borrar este registro?")) {
	document.location.href="eliminar.php?id="+registro+"&clt="+cliente+"&cun="+cod_unico+"&ped="+pedido;
	}
}
</script>

</head>

<body>

<?php include("../../../../sis_coesa/header.php"); ?>

<section id="cuerpo">
  
  	<?php require_once("../../../../sis_coesa/menu.php"); ?>
    
    <section id="contenido">
    	
        <div id="datos_procesos">
        	
            <div class="formulario_datos">

              <div class="frmdt_cabecera">
           	  	<h6><a href="../lista.php" title="Atrás">
              	<img src="/imagenes/icons/icon-back.png" width="25" height="19" alt="Atrás"></a>
              Pedido - Lista | Cliente: <?php echo $cliente["nombre_cliente"]; ?></h6></div>
                            
                <div class="frmdt_contenido">
                
                <div class="frmdtc_acciones">
                    Acciones: 
                    <a href="guardar-pedido.php?ped=<?php echo $id_pedido; ?>&clt=<?php echo $id_cliente; ?>&cun=<?php echo $codigo_unico; ?>" id="producto_btn">
                    	<img src="/imagenes/icons/icon-agregar.png" width="20" height="20" alt="Agregar"></a>
                </div>
                    
                <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
                    <thead>
                        <tr>
                            <th width="55%">Pedidos</th>
                            <th width="15%">Precio</th>
                            <th width="15%">Acciones</th>
                        </tr>
                    </thead>                    <tbody>
                    
                    	<?php while($fila_pedido=mysql_fetch_array($rst_pedido)){
							$pedido_id=$fila_pedido["id_pedidos_final"];
							$pedido_cod=$fila_pedido["cod_unico"];
							$pedido_cod_final=$fila_pedido["cod_unico_final"];
							
							//SELECCIONAR LOS PRODUCTOS DEL PEDIDO
							$rst_ver=mysql_query("SELECT * FROM syCoesa_pedidos_articulos WHERE cod_unico='$pedido_cod' AND cod_unico_final='$pedido_cod_final';", $conexion);
							
							while($fila_ver=mysql_fetch_array($rst_ver)){
								$productoFinal=seleccionTabla($fila_ver["id_articulo"], "id_articulo", "syCoesa_costo_produccion", $conexion);
								$productoPrecio=$productoFinal["precio"];
								$precioFinal=$productoPrecio + $precioFinal;
							}							
							$precio=$precioFinal;
						?>
                        <tr>
                            <td align="center"><?php echo $pedido_id; ?></td>
                            <td align="center"><?php echo number_format($precio, 2); ?></td>
                            <td class="center">
                                <a onclick="eliminarRegistro(<?php echo $pedido_id ?>, <?php echo $id_cliente; ?>, <?php echo $id_pedido; ?>, '<?php echo $codigo_unico; ?>');" href="javascript:;">
                              	<img src="/imagenes/icons/icon-eliminar.png" width="20" height="20" alt="Eliminar"></a>
                                &nbsp;
                                <a href="lista.php?ped=<?php echo $id_pedido; ?>&pedf=<?php echo $pedido_id; ?>&clt=<?php echo $id_cliente; ?>&cun=<?php echo $pedido_cod; ?>&cunf=<?php echo $pedido_cod_final; ?>">
                              	<img src="/imagenes/icons/icon-producto.png" width="20" height="20" alt="Eliminar"></a>
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