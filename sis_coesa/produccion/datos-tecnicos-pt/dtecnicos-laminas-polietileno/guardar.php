<?php
session_start();
require_once("../../../../connect/conexion.php");
require_once("../../../../connect/function.php");
require_once("../../../../connect/sesion/verificar_sesion.php");

//VARIABLES
$cantidad_poliet=$_POST["cantidad_polietileno"];

for($i=1; $i<=$cantidad_poliet; $i++){
	
	//VARIABLES
	$laminas_articulo=$_POST["laminas_articulo$i"];
	$laminas_mezcla=$_POST["laminas_mezcla$i"];
	$laminas_calculo_kg=$_POST["laminas_calculo_kg$i"];
	$datos_tecnicos=$_POST["did"];
	
	//GUARDAR
	$rst_guardar=mysql_query("INSERT INTO syCoesa_datos_tecnicos_laminas_polietileno (id_articulo,
	id_datos_tecnicos,
	mezcla_lamina_polietileno,
	calculo_kg_lamina_polietileno)
	VALUES ($laminas_articulo,
	$datos_tecnicos,
	$laminas_mezcla,
	$laminas_calculo_kg)", $conexion);
}

if (mysql_errno()!=0){
	echo "ERROR: ". mysql_errno() . " - ". mysql_error();
	mysql_close($conexion);
} else {
	mysql_close($conexion);
	header("Location:lista.php?did=$datos_tecnicos&m=1");
}

?>