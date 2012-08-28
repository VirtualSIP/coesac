<?php
session_start();
require_once("../../../connect/conexion.php");
require_once("../../../connect/function.php");
require_once("../../../connect/sesion/verificar_sesion.php");

//VARIABLES
$dtecnicos_cliente=$_POST["dtecnicos_cliente"];
$dtecnicos_articulo=$_POST["dtecnicos_articulo"];
$dtecnicos_ancho_final=$_POST["dtecnicos_ancho_final"];
$dtecnicos_numbandas=$_POST["dtecnicos_numbandas"];
$dtecnicos_numcolores=$_POST["dtecnicos_numcolores"];
$dtecnicos_imagen=guardarArchivo("../../../imagenes/pedidos/", $_FILES["dtecnicos_imagen"]);

//GUARDAR
$rst_guardar=mysql_query("INSERT INTO syCoesa_datos_tecnicos (id_cliente,
id_articulo,
imagen_prod_datos_tecnicos,
ancho_final_datos_tecnicos,
nro_bandas_datos_tecnicos,
nro_colores_datos_tecnicos)
VALUES ($dtecnicos_cliente,
$dtecnicos_articulo,
'$dtecnicos_imagen',
'$dtecnicos_ancho_final',
$dtecnicos_numbandas,
$dtecnicos_numcolores)", $conexion);

if (mysql_errno()!=0){
	echo "ERROR: ". mysql_errno() . " - ". mysql_error();
	mysql_close($conexion);
} else {
	mysql_close($conexion);
	header("Location:dtecnicos-colores/form-agregar.php?dart=$dtecnicos_articulo&cid=$dtecnicos_numcolores");
}

?>