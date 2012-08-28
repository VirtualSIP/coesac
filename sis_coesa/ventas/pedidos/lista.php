<?php
session_start();
require_once("../../../connect/conexion.php");
require_once("../../../connect/function.php");
require_once("../../../connect/sesion/verificar_sesion.php");

//VARIABLES
$aux=0;

//ARTICULOS
$rst_pedidos=mysql_query("SELECT * FROM syCoesa_pedidos ORDER BY id_pedido ASC;", $conexion);

//CLIENTE
$rst_cliente=mysql_query("SELECT * FROM syCoesa_datos_tecnicos ORDER BY id_cliente ASC;", $conexion);

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

<!-- COMBO -->
<link rel="stylesheet" href="/libs_js/jquery_ui/themes/base/jquery.ui.all.css">
<script src="/libs_js/jquery-1.7.2.min.js"></script>
<script src="/libs_js/jquery_ui/ui/jquery.ui.core.js"></script>
<script src="/libs_js/jquery_ui/ui/jquery.ui.widget.js"></script>
<script src="/libs_js/jquery_ui/ui/jquery.ui.button.js"></script>
<script src="/libs_js/jquery_ui/ui/jquery.ui.position.js"></script>
<script src="/libs_js/jquery_ui/ui/jquery.ui.autocomplete.js"></script>
<link rel="stylesheet" href="/libs_js/combo/css-select.css">
<script src="/libs_js/combo/js-select.js"></script>

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
		"aaSorting": [],
		"sPaginationType": "full_numbers",
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

<!-- CLIENTE -->
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript" src="/libs_js/blockui/jquery.blockUI.js"></script>
<script type="text/javascript">
var jcladd = jQuery.noConflict();
jcladd(document).ready(function() { 
    jcladd('#cliente_btn').click(function() { 
        jcladd.blockUI({ message: jcladd('#cliente_add') }); 
    });
	
	jcladd('#btncancelar').click(function() { 
		jcladd.unblockUI(); 
		return false; 
	});
	 
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

              <div class="frmdt_cabecera"><h6>Pedidos - Lista</h6></div>
                            
                <div class="frmdt_contenido">
                
                <div class="frmdtc_acciones">
                    Acciones: 
                    <a href="javascrip:;" id="cliente_btn">
                    	<img src="/imagenes/icons/icon-agregar.png" width="20" height="20" alt="Agregar"></a>
                </div>
                    
                <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
                    <thead>
                        <tr>
                            <th width="20%">Pedido</th>
                            <th width="60%">Cliente</th>
                            <th width="20%">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    
                    	<?php while($fila_pedidos=mysql_fetch_array($rst_pedidos)){
							$pedido_id=$fila_pedidos["id_pedido"];
							$pedido_cliente=seleccionTabla($fila_pedidos["id_cliente"], "id_cliente", "syCoesa_clientes", $conexion);
						?>
                        <tr>
                            <td align="center"><?php echo $pedido_id; ?></td>
                            <td class="center"><?php echo $pedido_cliente["nombre_cliente"]; ?></td>
                            <td class="center">
                            	<a href="form-editar.php?id=<?php echo $pedido_id; ?>" title="Modificar Registro">
                                <img src="/imagenes/icons/icon-editar.png" width="20" height="20" alt="Editar"></a>
                                &nbsp;
                                <a onclick="eliminarRegistro(<?php echo $pedido_id ?>, '<?php echo $pedido_cliente["nombre_cliente"]; ?>');" href="javascript:;">
                              	<img src="/imagenes/icons/icon-eliminar.png" width="20" height="20" alt="Eliminar"></a>
                                &nbsp;
                                <a href="articulos/lista.php?id=<?php echo $pedido_id; ?>&clt=<?php echo $pedido_cliente["id_cliente"]; ?>">
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

<div id="cliente_add">
	<form method="post" action="guardar_cliente.php">
    	
        <h2>Seleccionar Cliente:</h2>
        
        <fieldset>
          <select name="pedido_cliente" id="pedido_cliente" class="cmbSlc">
            <option value>[ Seleccionar opcion ]</option>
            <?php while($fila_cliente=mysql_fetch_array($rst_cliente)){
				
				$cliente=seleccionTabla($fila_cliente["id_cliente"], "id_cliente", "syCoesa_clientes", $conexion);
				
				if($cliente["id_cliente"]<>$aux){
					$aux=$cliente["id_cliente"];
            ?>
            	<option value="<?php echo $cliente["id_cliente"]; ?>"><?php echo $cliente["nombre_cliente"]; ?></option>
            <?php }} ?>
          </select>
        </fieldset>
        
        <fieldset class="margin_0">
            <input name="btnenviar" type="submit" id="btnenviar" value="Guardar datos">
            <input name="btncancelar" type="button" id="btncancelar" value="Cancelar">
        </fieldset>
        
    </form>
</div>

</body>
</html>