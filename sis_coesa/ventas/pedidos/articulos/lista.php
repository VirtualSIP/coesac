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

//DATOS
$cliente=seleccionTabla($id_cliente,"id_cliente","syCoesa_clientes",$conexion);

//PEDIDO
$rst_pedido=mysql_query("SELECT * FROM syCoesa_pedidos_articulos WHERE id_pedido=$id_pedido AND id_cliente=$id_cliente ORDER BY id_pedido_articulo ASC;", $conexion);

//ARTICULO
$rst_articulo=mysql_query("SELECT * FROM syCoesa_datos_tecnicos WHERE id_cliente=$id_cliente ORDER BY id_articulo ASC;", $conexion);

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

<!-- PRODUCTO -->
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript" src="/libs_js/blockui/jquery.blockUI.js"></script>
<script type="text/javascript">
var jcladd = jQuery.noConflict();
jcladd(document).ready(function() { 
    jcladd('#producto_btn').click(function() { 
        jcladd.blockUI({ message: jcladd('#producto_add'), css: {top: '20%'} }); 
    });
	
	jcladd('#btncancelar').click(function() { 
		jcladd.unblockUI(); 
		return false; 
	});
	 
});
</script>

<!-- EXTRAER FORMULA -->
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
<script>
var jslpart = jQuery.noConflict();
jslpart(document).ready(function() { 
    jslpart('#pedido_articulo').change(function(){
		var pedart = jslpart("select#pedido_articulo option:selected").val();
		jslpart.post("extraer-formula.php", {producto: pedart, grm2OK: 1},
			function(data){
				jslpart('#formula_grm2').html(data);
			});
    });
	
	jslpart('#tolerancia_pedido').change(function(){
		var cantidad = jslpart("#pedido_cantidad").val();
		var tolerancia = jslpart("#tolerancia_pedido").val();
		var cliente = jslpart("#cliente").val();
		var grm2 = jslpart("#grm2_pedido").val();
		var producto = jslpart("select#pedido_articulo option:selected").val();
		jslpart.post("extraer-formula.php", {producto: producto, cliente: cliente, grm2: grm2, cantidad: cantidad, tolerancia: tolerancia, qrOK: 1},
			function(data){
				jslpart('#formula_qr').html(data);
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
	<?php } ?>
});
</script>
<?php } ?>

<!-- ELIMINAR -->
<script type="text/javascript">
function eliminarRegistro(registro, nombre, cliente, pedido) {
if(confirm("¿Está seguro de borrar este registro?\n"+nombre)) {
	document.location.href="eliminar.php?id="+registro+"&clt="+cliente+"&pedido="+pedido;
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
                    <a href="javascript:;" id="producto_btn">
                    	<img src="/imagenes/icons/icon-agregar.png" width="20" height="20" alt="Agregar"></a>
                </div>
                    
                <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
                    <thead>
                        <tr>
                            <th width="55%">Registros</th>
                            <th width="15%">Precio</th>
                            <th width="15%">Cantidad</th>
                            <th width="15%">Acciones</th>
                        </tr>
                    </thead>                    <tbody>
                    
                    	<?php while($fila_pedido=mysql_fetch_array($rst_pedido)){
							$pedido_id=$fila_pedido["id_pedido_articulo"];
							$pedido_nombre=seleccionTabla($fila_pedido["id_articulo"],"id_articulo","syCoesa_articulo",$conexion);
							$pedido_precio=$fila_pedido["precio_pedido"];
							$pedido_cantidad=$fila_pedido["cantidad_pedido"];
						?>
                        <tr>
                            <td><?php echo $pedido_nombre["nombre_articulo"]; ?></td>
                            <td align="center"><?php echo $pedido_precio; ?></td>
                            <td align="center"><?php echo $pedido_cantidad; ?></td>
                            <td class="center">
                            	<a href="form-editar.php?id=<?php echo $id_pedido; ?>&clt=<?php echo $id_cliente; ?>&pda=<?php echo $pedido_id; ?>" title="Modificar Registro">
                                <img src="/imagenes/icons/icon-editar.png" width="20" height="20" alt="Editar"></a>
                                &nbsp;
                                <a onclick="eliminarRegistro(<?php echo $pedido_id ?>, '<?php echo $pedido_nombre["nombre_articulo"]; ?>', <?php echo $id_cliente; ?>, <?php echo $id_pedido; ?>);" href="javascript:;">
                              	<img src="/imagenes/icons/icon-eliminar.png" width="20" height="20" alt="Eliminar"></a>
                            </td>
                        </tr>
                        <?php } ?>
                        
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>&nbsp;</th>
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

<div id="producto_add">
	
    <form method="post" action="guardar_articulo.php">
    	
        <h2>Seleccione Producto terminado:</h2>
        
        <fieldset class="alto50">
          	
          	<select name="pedido_articulo" id="pedido_articulo" class="pedido_articulo">
                <option value>[ Seleccionar opcion ]</option>
                <?php while($fila_articulo=mysql_fetch_array($rst_articulo)){
                    //VARIABLES
                    $articulo=seleccionTabla($fila_articulo["id_articulo"], "id_articulo", "syCoesa_articulo", $conexion);
                    $articulo_cliente=$fila_articulo["id_cliente"];
                ?>
                <option value="<?php echo $articulo["id_articulo"]; ?>" class="<?php echo $articulo_cliente; ?>"><?php echo $articulo["nombre_articulo"]; ?></option>
                <?php } ?>
          	</select>
        </fieldset>
        
        <fieldset class="alto50 w180">
            <label for="pedido_precio">Precio:</label>
          	<input name="pedido_precio" type="text" class="an50 texto_der w130" id="pedido_precio" value="0.00" size="50">
        </fieldset>
        
        <fieldset class="alto50 w180">
            <label for="pedido_cantidad">Cantidad para cliente:</label>
          	<input name="pedido_cantidad" type="text" class="an50 texto_cen w130" id="pedido_cantidad" value="0" size="50">
        </fieldset>
        
        <fieldset class="alto50 w180">
            <label for="tolerancia_pedido">% Tolerancia de Pedido:</label>
          	<input name="tolerancia_pedido" type="text" class="an50 texto_cen w130" id="tolerancia_pedido" value="0" size="50">
        </fieldset>
        
        <fieldset class="alto50 w180">
            <label for="utilidad_pedido">% Utilidad:</label>
          	<input name="utilidad_pedido" type="text" class="an50 texto_cen w130" id="utilidad_pedido" value="0" size="50">
        </fieldset>
        
        <div id="formula_grm2"></div>
        
        <div id="formula_qr"></div>
        
        <fieldset class="margin_0">
            <input name="btnenviar" type="submit" id="btnenviar" value="Guardar datos">
            <input name="btncancelar" type="button" id="btncancelar" value="Cancelar">
            <input name="cliente" id="cliente" type="hidden" value="<?php echo $id_cliente; ?>">
            <input name="pedido" id="pedido" type="hidden" value="<?php echo $id_pedido; ?>">
        </fieldset>
                
    </form>
    
</div>

</body>
</html>