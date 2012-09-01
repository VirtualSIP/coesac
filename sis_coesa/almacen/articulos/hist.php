<?php
session_start();
require_once("../../../connect/conexion.php");
require_once("../../../connect/function.php");
require_once("../../../connect/sesion/verificar_sesion.php");

//VARIABLES DE URL
$id_articulo=$_REQUEST["id"];

//ARTICULOS
$rst_articulos=mysql_query("SELECT * FROM syCoesa_articulo WHERE id_articulo=$id_articulo;", $conexion);
$fila_articulos=mysql_fetch_array($rst_articulos);
$articulo_nombre=$fila_articulos["nombre_articulo"];
$articulo_codunico_hist=$fila_articulos["cod_unico_historia"];

//HISTORIAL
$rst_historia=mysql_query("SELECT * FROM syCoesa_articulo WHERE cod_unico_historia='$articulo_codunico_hist' ORDER BY dato_fecha DESC;", $conexion);

//GRAFICO
$rst_grafico=mysql_query("SELECT * FROM syCoesa_articulo WHERE cod_unico_historia='$articulo_codunico_hist' ORDER BY dato_fecha ASC;", $conexion);

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

<!-- GRAFICO -->
<script src="/libs_js/amcharts/amcharts.js" type="text/javascript"></script>        
<script type="text/javascript">
	var lineChartData = [
	<?php while($fila_grafico=mysql_fetch_array($rst_grafico)){
		$precio=$fila_grafico["precio_articulo"];
		$fecha_hora=explode(" ", $fila_grafico["dato_fecha"]);
		$fecha_sep=explode("-", $fecha_hora[0]);
	?>
	{
		date: new Date(<?php echo $fecha_sep[0]; ?>, <?php echo $fecha_sep[1]-1; ?>, <?php echo $fecha_sep[2]; ?>),
		value: <?php echo $precio; ?>
	},
	<?php } ?>
	];

	AmCharts.ready(function () {
		var chart = new AmCharts.AmSerialChart();
		chart.dataProvider = lineChartData;
		chart.pathToImages = "/libs_js/amcharts/images/";
		chart.categoryField = "date";

		// sometimes we need to set margins manually
		// autoMargins should be set to false in order chart to use custom margin values
		chart.autoMargins = false;
		chart.marginRight = 0;
		chart.marginLeft = 0;
		chart.marginBottom = 0;
		chart.marginTop = 0;

		// AXES
		// category                
		var categoryAxis = chart.categoryAxis;
		categoryAxis.parseDates = true; // as our data is date-based, we set parseDates to true
		categoryAxis.minPeriod = "DD"; // our data is daily, so we set minPeriod to DD
		categoryAxis.inside = true;
		categoryAxis.gridAlpha = 0;
		categoryAxis.tickLength = 0;
		categoryAxis.axisAlpha = 0;

		// value
		var valueAxis = new AmCharts.ValueAxis();
		valueAxis.dashLength = 4;
		valueAxis.axisAlpha = 0;
		chart.addValueAxis(valueAxis);

		// GRAPH
		var graph = new AmCharts.AmGraph();
		graph.type = "line";
		graph.valueField = "value";
		graph.lineColor = "#0066CC";
		graph.customBullet = "/libs_js/amcharts/images/star.gif"; // bullet for all data points
		graph.bulletSize = 14; // bullet image should be a rectangle (width = height)
		graph.customBulletField = "customBullet"; // this will make the graph to display custom bullet (red star)
		chart.addGraph(graph);

		// CURSOR
		var chartCursor = new AmCharts.ChartCursor();
		chart.addChartCursor(chartCursor);

		// WRITE
		chart.write("chartdiv");
	});
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
                <h6><a href="lista.php" title="Atrás">
              	<img src="/imagenes/icons/icon-back.png" width="25" height="19" alt="Atrás"></a>
              Historia | Insumos: <?php echo $articulo_nombre; ?></h6></div>
                            
                <div class="frmdt_contenido">                
                    
                <table cellpadding="5" cellspacing="0" border="1" class="display float_left an100" id="example">
                    <thead>
                        <tr>
                            <th width="30%">Fecha</th>
                            <th width="30%">Usuario</th>
                            <th width="30%">Precio</th>
                        </tr>
                    </thead>
                    <tbody>
                    
                    	<?php while($fila_historia=mysql_fetch_array($rst_historia)){
							$articulo_precio=$fila_historia["precio_articulo"];
							$articulo_usuario=$fila_historia["dato_usuario"];
							$articulo_fecha=$fila_historia["dato_fecha"];
						?>
                        <tr>
                            <td class="texto_cen"><?php echo $articulo_fecha; ?></td>
                            <td class="texto_cen"><?php echo $articulo_usuario; ?></td>
                            <td class="texto_cen"><?php echo $articulo_precio; ?></td>
                        </tr>
                        <?php } ?>
                        
                    </tbody>
                </table>
                
                <div id="chartdiv" class="float_left padding_tb10" style="width:100%; height:400px;"></div>
                    
                </div>
                     
            </div><!-- FIN FORMULARIO DATOS -->
        
        </div><!-- FIN DATOS PROCESOS -->
    
    </section><!-- FIN SECTION CONTENIDO -->
    
</section><!-- FIN SECTION -->
</body>
</html>