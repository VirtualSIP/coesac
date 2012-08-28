<?php
session_start();
require_once("../../../connect/conexion.php");
require_once("../../../connect/function.php");
require_once("../../../connect/sesion/verificar_sesion.php");

//VARIABLES
$dtecnicos_id=$_POST["dtecnicos_id"];
$dtecnicos_cliente=$_POST["dtecnicos_cliente"];
$dtecnicos_articulo=$_POST["dtecnicos_articulo"];
$dtecnicos_imagen=actualizarArchivo("../../../imagenes/upload/", $_FILES["dtecnicos_imagen"], $_POST["dtecnicos_imagen_actual"]);
$dtecnicos_ancho_final=$_POST["dtecnicos_ancho_final"];
$dtecnicos_numbandas=$_POST["dtecnicos_numbandas"];
$dtecnicos_numcolores=$_POST["dtecnicos_numcolores"];

//ACTUALIZAR
$rst_guardar=mysql_query("UPDATE syCoesa_datos_tecnicos SET id_cliente=$dtecnicos_cliente,
id_articulo=$dtecnicos_articulo,
imagen_prod_datos_tecnicos='$dtecnicos_imagen',
ancho_final_datos_tecnicos='$dtecnicos_ancho_final',
nro_bandas_datos_tecnicos=$dtecnicos_numbandas,
nro_colores_datos_tecnicos=$dtecnicos_numcolores WHERE id_datos_tecnicos=$dtecnicos_id;", $conexion);

if (mysql_errno()!=0){
	echo "ERROR: ". mysql_errno() . " - ". mysql_error();
	mysql_close($conexion);
} else {
	mysql_close($conexion);
	header("Location:lista.php?m=2");
}

?>