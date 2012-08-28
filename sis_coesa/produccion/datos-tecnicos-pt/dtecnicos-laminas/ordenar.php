<?php
//REQUIRE
require_once("../../../../connect/conexion.php");

//ORDENAR
foreach ($_GET['listItem'] as $position => $item) :
	$sql[] = mysql_query("UPDATE syCoesa_datos_tecnicos_colores SET cuerpo_impresor_colores=$position+1 WHERE id_colores=$item", $conexion);
endforeach;
?>