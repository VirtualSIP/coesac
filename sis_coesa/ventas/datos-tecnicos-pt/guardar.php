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
$dtecnicos_repeticion=$_POST["dtecnicos_repeticion"];
$dtecnicos_frecuencia=$_POST["dtecnicos_frecuencia"];
$dtecnicos_cilindro=$_POST["dtecnicos_cilindro"];
$dtecnicos_unidad_medida=$_POST["dtecnicos_unidad_medida"];
$dtecnicos_sentido_bobina=$_POST["valor-ddslick-select"];
$dtecnicos_observaciones=$_POST["dtecnicos_observaciones"];
$dtecnicos_estado="I"; //SE ACTIVA CUANDO SE RELLENAN LOS DATOS EN DATOS BASICOS DE PRODUCCION
$dtecnicos_imagen=guardarArchivo("../../../imagenes/upload/", $_FILES["dtecnicos_imagen"]);
$codigo_unico=codigoAleatorio(20,true,true,false);
$producto_terminado="A"; //ES "A" CUANDO SE CREA EL PRODUCTO DIRECTAMENTE PARA EL CLIENTE
$mostrar_dtb=1;

//USUARIO
$datoFecha=$fechaActual;
$datoUsuario=$usuario_user;

//GUARDAR DATOS DE PRODUCTO TERMINADO
$rst_guardar_articulo=mysql_query("INSERT INTO syCoesa_articulo (id_cliente,
nombre_articulo, 
ancho_articulo, 
unidad_medida_articulo,
observaciones_articulo,
producto_terminado,
mostrar_articulo,
cod_unico,
cod_unico_historia,
dato_fecha,
dato_usuario)
VALUES ($dtecnicos_cliente,
'".htmlspecialchars($dtecnicos_articulo)."', 
$dtecnicos_ancho_final, 
$dtecnicos_unidad_medida,
'".htmlspecialchars($dtecnicos_observaciones)."',
'$producto_terminado',
$mostrar_dtb,
'$codigo_unico',
'$codigo_unico',
'$datoFecha',
'$datoUsuario')", $conexion);

//EXTRAER ID DEL NUEVO ARTICULO
$rst_articulo=mysql_query("SELECT * FROM syCoesa_articulo WHERE cod_unico='".$codigo_unico."';", $conexion);
$fila_articulo=mysql_fetch_array($rst_articulo);
$articulo_id=$fila_articulo["id_articulo"];

if($articulo_id<>""){
	//GUARDA DATOS EN DATOS TECNICOS
	$rst_guardar=mysql_query("INSERT INTO syCoesa_datos_tecnicos (id_articulo, 
	id_cliente, 
	imagen_prod_datos_tecnicos, 
	ancho_final_datos_tecnicos,
	nro_bandas_datos_tecnicos, 
	nro_colores_datos_tecnicos, 
	distancia_repeticion, 
	frecuencia, 
	cilindro, 
	sentido_bobina_dtecnicos, 
	estado_datos_tecnicos, 
	mostrar_dtb,
	cod_unico,
	cod_unico_historia,
	dato_fecha, 
	dato_usuario)
	VALUES ($articulo_id, 
	$dtecnicos_cliente, 
	'$dtecnicos_imagen', 
	$dtecnicos_ancho_final, 
	$dtecnicos_numbandas, 
	$dtecnicos_numcolores, 
	$dtecnicos_repeticion, 
	$dtecnicos_frecuencia, 
	$dtecnicos_cilindro, 
	$dtecnicos_sentido_bobina, 
	'$dtecnicos_estado', 
	$mostrar_dtb,
	'$codigo_unico', 
	'$codigo_unico',
	'$datoFecha', 
	'$datoUsuario');", $conexion);
	
	//DATO TECNICO AGREGADO
	$rst_dato_tecnico=mysql_query("SELECT * FROM syCoesa_datos_tecnicos WHERE cod_unico='$codigo_unico';", $conexion);
	$fila_dato_tecnico=mysql_fetch_array($rst_dato_tecnico);
	$dato_tecnico=$fila_dato_tecnico["id_datos_tecnicos"];
	
	if (mysql_errno()!=0){
		mysql_close($conexion);
		header("Location:lista.php?m=2");
	} else {
		mysql_close($conexion);
		header("Location:dtecnicos-laminas/form-agregar.php?did=$dato_tecnico&clt=$dtecnicos_cliente&dart=$articulo_id&cun=$codigo_unico");
	}
}

?> 