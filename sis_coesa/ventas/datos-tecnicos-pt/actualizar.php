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

//VERIFICAR DATOS DE ARTICULO
$rst_ver_art=mysql_query("SELECT * FROM syCoesa_articulo WHERE id_articulo=$dtecnicos_articulo_id;", $conexion);
$fila_ver_art=mysql_fetch_array($rst_ver_art);

//VERFICICAR DATOS DE DATOS TECNICOS BASICOS
$rst_ver_dtb=mysql_query("SELECT * FROM syCoesa_datos_tecnicos WHERE id_datos_tecnicos=$dtecnicos_id;", $conexion);
$fila_ver_dtb=mysql_fetch_array($rst_ver_dtb);

if($dtecnicos_imagen<>$fila_ver_dtb["imagen_prod_datos_tecnicos"] or 
$dtecnicos_ancho_final<>$fila_ver_dtb["ancho_final_datos_tecnicos"] or 
$dtecnicos_numbandas<>$fila_ver_dtb["nro_bandas_datos_tecnicos"] or 
$dtecnicos_numcolores<>$fila_ver_dtb["nro_colores_datos_tecnicos"] or 
$dtecnicos_laminas<>$fila_ver_dtb["laminas_datos_tecnicos"] or
$dtecnicos_repeticion<>$fila_ver_dtb["distancia_repeticion"] or 
$dtecnicos_cilindro<>$fila_ver_dtb["cilindro"] or 
$dtecnicos_frecuencia<>$fila_ver_dtb["frecuencia"] or 
$dtecnicos_sentbob<>$fila_ver_dtb["sentido_bobina_dtecnicos"] or 
$dtecnicos_grm2<>$fila_ver_art["grm2_articulo"] or  
$dtecnicos_unidad_medida<>$fila_ver_art["unidad_medida_articulo"] or 
$dtecnicos_observaciones<>$fila_ver_art["observaciones_articulo"] ){
	//GUARDAR DATOS EN ARTICULO
	$rst_guardar_articulo=mysql_query("INSERT INTO syCoesa_articulo (id_cliente,
	nombre_articulo, 
	grm2_articulo, 
	ancho_articulo, 
	precio_articulo, 
	unidad_medida_articulo,
	observaciones_articulo,
	producto_terminado,
	cod_unico)
	VALUES ($dtecnicos_cliente_id,
	'".htmlspecialchars($dtecnicos_articulo)."', 
	$dtecnicos_grm2, 
	$dtecnicos_ancho_final, 
	'$dtecnicos_precio', 
	$dtecnicos_unidad_medida,
	'$dtecnicos_observaciones',
	'$producto_terminado',
	'$codigo_unico')", $conexion);
	
	//EXTRAER ID DEL NUEVO ARTICULO
	$rst_articulo=mysql_query("SELECT * FROM syCoesa_articulo WHERE cod_unico='$codigo_unico' LIMIT 1;", $conexion);
	$fila_articulo=mysql_fetch_array($rst_articulo);
	$articulo_id=$fila_articulo["id_articulo"];
	
	//GUARDA DATOS EN DATOS TECNICOS
	$rst_guardar=mysql_query("INSERT INTO syCoesa_datos_tecnicos (id_cliente,
	id_articulo,
	imagen_prod_datos_tecnicos,
	ancho_final_datos_tecnicos,
	nro_bandas_datos_tecnicos,
	nro_colores_datos_tecnicos,
	sentido_bobina_dtecnicos,
	distancia_repeticion,
	frecuencia,
	cilindro,
	estado_datos_tecnicos,
	cod_unico,
	dato_fecha,
	dato_usuario)
	VALUES ($dtecnicos_cliente_id,
	$articulo_id,
	'$dtecnicos_imagen',
	'$dtecnicos_ancho_final',
	$dtecnicos_numbandas,
	$dtecnicos_numcolores,
	$dtecnicos_sentbob,
	$dtecnicos_repeticion,
	$dtecnicos_frecuencia,
	$dtecnicos_cilindro,
	'$dtecnicos_estado',
	'$codigo_unico',
	'$datoFecha',
	'$datoUsuario')", $conexion);
	
	//DATO TECNICO AGREGADO
	$rst_dato_tecnico=mysql_query("SELECT * FROM syCoesa_datos_tecnicos WHERE cod_unico='$codigo_unico' LIMIT 1;", $conexion);
	$fila_dato_tecnico=mysql_fetch_array($rst_dato_tecnico);
	$dato_tecnico=$fila_dato_tecnico["id_datos_tecnicos"];
	
	if (mysql_errno()!=0){
		echo "ERROR: ". mysql_errno() . " - ". mysql_error();
		mysql_close($conexion);
	} else {
		mysql_close($conexion);
		header("Location:lista.php?m=2");
	}

}else{
	mysql_close($conexion);
	header("Location:lista.php?m=2");
}

?>