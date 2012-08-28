<?php
session_start();
require_once("../../../../connect/conexion.php");
require_once("../../../../connect/function.php");
require_once("../../../../connect/sesion/verificar_sesion.php");

//VARIABLES URL
$id_dtb=$_REQUEST["did"];
$dart=$_REQUEST["dart"];
$clt=$_REQUEST["clt"];

//DATOS TECNICOS LAMINAS
$rst_laminas=mysql_query("SELECT * FROM syCoesa_datos_tecnicos_laminas_procesos WHERE id_datos_tecnicos=$id_dtb;", $conexion);
$fila_laminas=mysql_fetch_array($rst_laminas);

//VARIABLES DE LAMINAS
$proclamina_id=$fila_laminas["id_laminas_procesos"];
$proclamina_lamin1=seleccionTabla($fila_laminas["lamina1"], "id_articulo", "syCoesa_articulo", $conexion);
$proclamina_lamin2=seleccionTabla($fila_laminas["lamina2"], "id_articulo", "syCoesa_articulo", $conexion);
$proclamina_lamin3=seleccionTabla($fila_laminas["lamina3"], "id_articulo", "syCoesa_articulo", $conexion);

//DATOS TECNICOS
$rst_dtecnicos=mysql_query("SELECT * FROM syCoesa_datos_tecnicos WHERE id_datos_tecnicos=$id_dtb;", $conexion);
$fila_dtecnicos=mysql_fetch_array($rst_dtecnicos);

//VARIABLES
$dtbasic_articulo=seleccionTabla($fila_dtecnicos["id_articulo"], "id_articulo", "syCoesa_articulo", $conexion);

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
function eliminarRegistro(registro, did, dart, clt) {
if(confirm("¿Está seguro de borrar este registro?")) {
	document.location.href="eliminar.php?id="+registro+"&did="+did+"&dart="+dart+"&clt="+clt;
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
                Datos Técnicos Básicos Laminas - Lista | <?php echo $dtbasic_articulo["nombre_articulo"]; ?></h6></div>
                            
                <div class="frmdt_contenido">
                
                <div class="frmdtc_acciones">
                    Acciones: 
                    <a href="form-editar.php?did=<?php echo $id_dtb; ?>&dart=<?php echo $dart; ?>&clt=<?php echo $clt; ?>&idlmpr=<?php echo $proclamina_id; ?>">
                    	<img src="/imagenes/icons/icon-editar.png" width="20" height="20" alt="Agregar"></a>
                </div>
                
                <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
                    <thead>
                        <tr>
                            <th width="85%">Articulo</th>
                        </tr>
                    </thead>
                    <tbody>
                    	<?php if($fila_laminas["lamina1"]>0){ ?>
                        <tr>
                        	<td align="left"><?php echo $proclamina_lamin1["nombre_articulo"]; ?></td>
                       	</tr>
                        <?php } ?>
                        <?php if($fila_laminas["lamina2"]>0){ ?>
                        <tr>
                            <td align="left"><?php echo $proclamina_lamin2["nombre_articulo"]; ?></td>
                       	</tr>
                        <?php } ?>
                        <?php if($fila_laminas["lamina3"]>0){ ?>
                        <tr>
                            <td align="left"><?php echo $proclamina_lamin3["nombre_articulo"]; ?></td>
                       	</tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
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