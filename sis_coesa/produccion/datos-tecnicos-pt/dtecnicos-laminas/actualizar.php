<?php
//REQUIRE
require_once("../../../../connect/conexion.php");
require_once("../../../../connect/function.php");

//VARIABLES URL
$colores_dart=$_POST["colores_dart"];
$colores_did=$_POST["colores_did"];

//VARIABLES
$colores_id=$_POST["colores_id"];
$colores_cuerpo_impresor=$_POST["colores_cuerpo_impresor"];
$colores_cilindro=$_POST["colores_cilindro"];
$colores_anilox=$_POST["colores_anilox"];
$colores_viscocidad=$_POST["colores_viscocidad"];
$colores_area_impresa=$_POST["colores_area_impresa"];
$colores_art_tintas=$_POST["colores_art_tintas"];
$colores_art_cushion=$_POST["colores_art_cushion"];
$colores_art_stickback=$_POST["colores_art_stickback"];

//ACTUALIZAR
$rst_guardar=mysql_query("UPDATE syCoesa_datos_tecnicos_colores SET cuerpo_impresor_colores=$colores_cuerpo_impresor,
id_articulo_tintas=$colores_art_tintas,
id_articulo_cushion=$colores_art_cushion,
id_articulo_stickback=$colores_art_stickback,
cilindro_engranaje_colores=$colores_cilindro,
anilox_colores=$colores_anilox,
viscosidad_colores=$colores_viscocidad,
area_impresa_colores=$colores_area_impresa WHERE id_colores=$colores_id;", $conexion);

if (mysql_errno()!=0){
	echo "ERROR: ". mysql_errno() . " - ". mysql_error();
	mysql_close($conexion);
} else {
	mysql_close($conexion);
	header("Location:lista.php?dart=$colores_dart&did=$colores_did&m=2");
}

?>