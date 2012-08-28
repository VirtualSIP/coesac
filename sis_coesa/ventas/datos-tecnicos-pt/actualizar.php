<?php
session_start();
require_once("../../../connect/conexion.php");
require_once("../../../connect/function.php");
require_once("../../../connect/sesion/verificar_sesion.php");

//VARIABLES
$dtecnicos_id=$_POST["dt_basico"];
$dtecnicos_cliente_id=$_POST["dtecnicos_cliente_id"];
$dtecnicos_articulo_id=$_POST["dtecnicos_articulo_id"];
$dtecnicos_cliente=$_POST["dtecnicos_cliente"];
$dtecnicos_articulo=$_POST["dtecnicos_articulo"];
$dtecnicos_sentbob=$_POST["valor-ddslick-select"];

//USUARIO
$datoFecha=$fechaActual;
$datoUsuario=$usuario_user;

//DT BASICO
$dtecnicos_numbandas=$_POST["dtecnicos_numbandas"];
$dtecnicos_numcolores=$_POST["dtecnicos_numcolores"];
$dtecnicos_laminas=$_POST["dtecnicos_laminas"];
$dtecnicos_repeticion=$_POST["dtecnicos_repeticion"];
$dtecnicos_frecuencia=$_POST["dtecnicos_frecuencia"];
$dtecnicos_cilindro=$_POST["dtecnicos_cilindro"];
$dtecnicos_estado="I"; //SE ACTIVA CUANDO SE RELLENAN LOS DATOS EN DATOS BASICOS DE PRODUCCION
if($_FILES["dtecnicos_imagen"]==""){
	$dtecnicos_imagen=$_POST["dtecnicos_imagen_actual"];
}elseif($_FILES["dtecnicos_imagen"]<>""){
	$dtecnicos_imagen=guardarArchivo("../../../imagenes/upload/", $_FILES["dtecnicos_imagen"]);
}

//ARTICULOS
$dtecnicos_ancho_final=$_POST["dtecnicos_ancho_final"];
$dtecnicos_grm2=$_POST["dtecnicos_grm2"];
$dtecnicos_precio=$_POST["dtecnicos_precio"];
$dtecnicos_unidad_medida=$_POST["dtecnicos_unidad_medida"];
$dtecnicos_observaciones=$_POST["dtecnicos_observaciones"];
$producto_terminado="A"; //ES "A" CUANDO SE CREA EL PRODUCTO DIRECTAMENTE PARA EL CLIENTE
$codigo_unico=codigoAleatorio(25,true,true,true);

//ACTUALIZAR DATOS DE ARTICULO
$rst_actArticulo=mysql_query("UPDATE syCoesa_articulo SET grm2_articulo=$dtecnicos_grm2, 
ancho_articulo=$dtecnicos_ancho_final, 
unidad_medida_articulo=$dtecnicos_unidad_medida,
observaciones_articulo='$dtecnicos_observaciones',
dato_fecha='$datoFecha', dato_usuario='$datoUsuario' WHERE id_articulo=$dtecnicos_articulo_id", $conexion);

$rst_actDTecnico=mysql_query("UPDATE syCoesa_datos_tecnicos SET imagen_prod_datos_tecnicos='$dtecnicos_imagen',
ancho_final_datos_tecnicos=$dtecnicos_ancho_final,
nro_bandas_datos_tecnicos=$dtecnicos_numbandas,
nro_colores_datos_tecnicos=$dtecnicos_numcolores,
sentido_bobina_dtecnicos=$dtecnicos_sentbob,
distancia_repeticion=$dtecnicos_repeticion,
frecuencia=$dtecnicos_frecuencia,
cilindro=$dtecnicos_cilindro,
dato_fecha='$datoFecha',
dato_usuario='$datoUsuario' WHERE id_datos_tecnicos=$dtecnicos_id;", $conexion);

if (mysql_errno()!=0){
	mysql_close($conexion);
	header("Location:lista.php?m=4");
} else {
	mysql_close($conexion);
	header("Location:lista.php?m=3");
}

?>