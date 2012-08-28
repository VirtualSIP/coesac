<?php
session_start();
require_once("../../../connect/conexion.php");
require_once("../../../connect/function.php");
require_once("../../../connect/sesion/verificar_sesion.php");

//VARIABLES
$registro=$_POST["cotizacion"];

//CLIENTE
$rst_cliente=mysql_query("SELECT * FROM syCoesa_clientes ORDER BY id_cliente ASC;", $conexion);

?>
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

<!-- CERRAR BLOCKUI -->
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript" src="/libs_js/blockui/jquery.blockUI.js"></script>
<script type="text/javascript">
var jcladdUI = jQuery.noConflict();
jcladdUI(document).ready(function() { 
	jcladdUI('#btncancelar').click(function() { 
		jcladdUI.unblockUI(); 
		return false; 
	});
});
</script>

<form method="post" action="guardar-costos-produccion.php">
        
    <h2>Seleccionar Cliente:</h2>
    
    <fieldset>
      <select name="cliente" id="cliente" class="cmbSlc">
        <option value>[ Seleccionar opcion ]</option>
        <?php while($fila_cliente=mysql_fetch_array($rst_cliente)){
            $cliente_id=$fila_cliente["id_cliente"];
            $cliente_nombre=$fila_cliente["nombre_cliente"];
        ?>
            <option value="<?php echo $cliente_id; ?>"><?php echo $cliente_nombre; ?></option>
        <?php } ?>
      </select>
    </fieldset>
    
    <fieldset class="margin_0">
        <input name="cotizacion" type="hidden" value="<?php echo $registro; ?>">
        <input name="btnenviar" type="submit" id="btnenviar" value="Guardar datos">
        <input name="btncancelar" type="button" id="btncancelar" value="Cancelar">
    </fieldset>
    
</form>