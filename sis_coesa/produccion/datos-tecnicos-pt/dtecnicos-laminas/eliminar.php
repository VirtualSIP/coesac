<?php
//REQUIRE
require_once("../../../../connect/conexion.php");

//VARIABLES
$colores_id=$_REQUEST["id"];
$colores_dart=$_REQUEST["dart"];
$colores_did=$_REQUEST["did"];

//EXTRAER CANTIDAD DE COLORES
$rst_cantidad_colores=mysql_query("SELECT * FROM syCoesa_datos_tecnicos WHERE id_datos_tecnicos=$colores_did;", $conexion);
$fila_cantidad_colores=mysql_fetch_array($rst_cantidad_colores);
$cantidad_colores=$fila_cantidad_colores["nro_colores_datos_tecnicos"]-1;

//CAMBIAR ESTADO - CANTIDAD DE COLORES
mysql_query("UPDATE syCoesa_datos_tecnicos SET nro_colores_datos_tecnicos=$cantidad_colores WHERE id_datos_tecnicos=$colores_did;", $conexion);

//ELIMINAR
$rst_eliminar=mysql_query("DELETE FROM syCoesa_datos_tecnicos_colores WHERE id_colores=$colores_id;", $conexion);
	
if (mysql_errno()!=0){
	echo "ERROR: ".mysql_errno()." - ".mysql_error();
	mysql_close($conexion);
	header("Location:lista.php?dart=$colores_dart&did=$colores_did&m=4");
} else {
	mysql_close($conexion);
	header("Location:lista.php?dart=$colores_dart&did=$colores_did&m=3");
}

?>