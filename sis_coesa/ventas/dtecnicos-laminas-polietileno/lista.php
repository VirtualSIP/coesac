<?php
session_start();
require_once("../../../connect/conexion.php");
require_once("../../../connect/function.php");
require_once("../../../connect/sesion/verificar_sesion.php");

$web="http://coesac.marostsac.com/";

//DATOS TECNICOS
$rst_laminas=mysql_query("SELECT * FROM syCoesa_datos_tecnicos_laminas_polietileno ORDER BY id_lamina_polietileno ASC;", $conexion);

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
    	
        <div id="datos_laminas">
        	
            <div class="formulario_datos">

              <div class="frmdt_cabecera">
                <h6>Datos Técnicos Láminas Polietileno - Lista</h6></div>
                            
                <div class="frmdt_contenido">
                
                <div class="frmdtc_acciones">
                    Acciones: 
                    <a href="form-agregar.php">
                    	<img src="/imagenes/icons/icon-agregar.png" width="20" height="20" alt="Agregar"></a>
                </div>
                    
                <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
                    <thead>
                        <tr>
                            <th width="85%">Registros</th>
                            <th width="15%">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    
                    	<?php while($fila_laminas=mysql_fetch_array($rst_laminas)){
							$lamina_id=$fila_laminas["id_lamina_polietileno"];
							$lamina_articulo=seleccionTabla($fila_laminas["id_articulo"], "id_articulo", "syCoesa_articulo", $conexion);
						?>
                        <tr>
                            <td align="center"><?php echo $lamina_articulo["nombre_articulo"]; ?></td>
                            <td class="center">
                            	<a href="form-editar.php?id=<?php echo $lamina_id; ?>" title="Modificar Registro">
                                <img src="/imagenes/icons/icon-editar.png" width="20" height="20" alt="Editar"></a>
                                &nbsp;
                                <a onclick="eliminarRegistro(<?php echo $lamina_id ?>, '<?php echo $lamina_articulo["nombre_articulo"]; ?>');" href="javascript:;">
                              	<img src="/imagenes/icons/icon-eliminar.png" width="20" height="20" alt="Eliminar"></a>
                            </td>
                        </tr>
                        <?php } ?>
                        
                    </tbody>
                    <tfoot>
                        <tr>
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