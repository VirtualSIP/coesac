<?php
session_start();
require_once("../../../../connect/conexion.php");
require_once("../../../../connect/function.php");
require_once("../../../../connect/sesion/verificar_sesion.php");

//ORDENAR
foreach ($_GET['listItem'] as $position => $item) :
	$sql[] = mysql_query("UPDATE syCoesa_datos_tecnicos_colores SET cuerpo_impresor_colores=$position+1 WHERE id_colores=$item", $conexion);
endforeach;
?>