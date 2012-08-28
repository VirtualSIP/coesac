<?php
session_start();
require_once("../../../connect/conexion.php");
require_once("../../../connect/function.php");
require_once("../../../connect/sesion/verificar_sesion.php");

//VARIABLES
$IdCotizacion=$_POST["cotizacion"];
$cotizacion_cliente=$_POST["cliente"];
$datoFecha=$fechaActual;
$datoUsuario=$usuario_user;

//COTIZACION
$cotizacion=seleccionTabla($IdCotizacion, "id_cotizacion", "syCoesa_cotizacion", $conexion);

//DATOS PARA DATOS TECNICOS Y PRODUCTO TERMINADO
$cotizacion_producto=$cotizacion["producto_cotizacion"];
$cotizacion_grm2=$cotizacion["grm2_cotizacion"];
$cotizacion_repeticion=$cotizacion["repeticion_cotizacion"];
$cotizacion_frecuencia=$cotizacion["frecuencia_cotizacion"];
$cotizacion_cilindro=$cotizacion["cilindro_cotizacion"];
$cotizacion_anchofinal=$cotizacion["ancho_final_cotizacion"];
$cotizacion_nrobandas=$cotizacion["nrobandas_cotizacion"];
$cotizacion_nrocolores=$cotizacion["nrocolores_cotizacion"];
$cotizacion_cantcliente=$cotizacion["cantcliente_cotizacion"];
$cotizacion_tolerancia=$cotizacion["tolerancia_cotizacion"];
$cotizacion_unidadmedida=$cotizacion["unidad_medida_cotizacion"];
$cotizacion_precio=$cotizacion["precio_cotizacion"];

//DATOS PARA PROCESOS DE LAMINA 1
if($cotizacion["lamina1_cotizacion"]==""){ $lamina1=0; }else{ $lamina1=$cotizacion["lamina1_cotizacion"]; };
if($cotizacion["extrusion1_cotizacion"]==""){ $cotizacion_lamina1_extrusion=0; }else{ $cotizacion_lamina1_extrusion=$cotizacion["extrusion1_cotizacion"]; };
if($cotizacion["impresion1_cotizacion"]==""){ $cotizacion_lamina1_impresion=0; }else{ $cotizacion_lamina1_impresion=$cotizacion["impresion1_cotizacion"]; };
if($cotizacion["bilaminado1_cotizacion"]==""){ $cotizacion_lamina1_bilaminado=0; }else{ $cotizacion_lamina1_bilaminado=$cotizacion["bilaminado1_cotizacion"]; };
if($cotizacion["trilaminado1_cotizacion"]==""){ $cotizacion_lamina1_trilaminado=0; }else{ $cotizacion_lamina1_trilaminado=$cotizacion["trilaminado1_cotizacion"]; };
if($cotizacion["rebobinado1_cotizacion"]==""){ $cotizacion_lamina1_rebobinado=0; }else{ $cotizacion_lamina1_rebobinado=$cotizacion["rebobinado1_cotizacion"]; };
if($cotizacion["habilitado1_cotizacion"]==""){ $cotizacion_lamina1_habilitado=0; }else{ $cotizacion_lamina1_habilitado=$cotizacion["habilitado1_cotizacion"]; };
if($cotizacion["cortefinal1_cotizacion"]==""){ $cotizacion_lamina1_cortefinal=0; }else{ $cotizacion_lamina1_cortefinal=$cotizacion["cortefinal1_cotizacion"]; };
if($cotizacion["sellado1_cotizacion"]==""){ $cotizacion_lamina1_sellado=0; }else{ $cotizacion_lamina1_sellado=$cotizacion["sellado1_cotizacion"]; };
$cotizacion_lamina1_impresion_grm2=$cotizacion["impresion1_grm2_cotizacion"];

//DATOS PARA PROCESOS DE LAMINA 2
if($cotizacion["lamina2_cotizacion"]==""){ $lamina2=0; }else{ $lamina2=$cotizacion["lamina2_cotizacion"]; };
if($cotizacion["extrusion2_cotizacion"]==""){ $cotizacion_lamina2_extrusion=0; }else{ $cotizacion_lamina2_extrusion=$cotizacion["extrusion2_cotizacion"]; };
if($cotizacion["impresion2_cotizacion"]==""){ $cotizacion_lamina2_impresion=0; }else{ $cotizacion_lamina2_impresion=$cotizacion["impresion2_cotizacion"]; };
if($cotizacion["bilaminado2_cotizacion"]==""){ $cotizacion_lamina2_bilaminado=0; }else{ $cotizacion_lamina2_bilaminado=$cotizacion["bilaminado2_cotizacion"]; };
if($cotizacion["trilaminado2_cotizacion"]==""){ $cotizacion_lamina2_trilaminado=0; }else{ $cotizacion_lamina2_trilaminado=$cotizacion["trilaminado2_cotizacion"]; };
if($cotizacion["rebobinado2_cotizacion"]==""){ $cotizacion_lamina2_rebobinado=0; }else{ $cotizacion_lamina2_rebobinado=$cotizacion["rebobinado2_cotizacion"]; };
if($cotizacion["habilitado2_cotizacion"]==""){ $cotizacion_lamina2_habilitado=0; }else{ $cotizacion_lamina2_habilitado=$cotizacion["habilitado2_cotizacion"]; };
if($cotizacion["cortefinal2_cotizacion"]==""){ $cotizacion_lamina2_cortefinal=0; }else{ $cotizacion_lamina2_cortefinal=$cotizacion["cortefinal2_cotizacion"]; };
if($cotizacion["sellado2_cotizacion"]==""){ $cotizacion_lamina2_sellado=0; }else{ $cotizacion_lamina2_sellado=$cotizacion["sellado2_cotizacion"]; };
$cotizacion_lamina2_bilaminado_grm2=$cotizacion["bilaminado2_grm2_cotizacion"];

//DATOS PARA PROCESOS DE LAMINA 3
if($cotizacion["lamina3_cotizacion"]==""){ $lamina3=0; }else{ $lamina3=$cotizacion["lamina3_cotizacion"]; };
if($cotizacion["extrusion3_cotizacion"]==""){ $cotizacion_lamina3_extrusion=0; }else{ $cotizacion_lamina3_extrusion=$cotizacion["extrusion3_cotizacion"]; };
if($cotizacion["impresion3_cotizacion"]==""){ $cotizacion_lamina3_impresion=0; }else{ $cotizacion_lamina3_impresion=$cotizacion["impresion3_cotizacion"]; };
if($cotizacion["bilaminado3_cotizacion"]==""){ $cotizacion_lamina3_bilaminado=0; }else{ $cotizacion_lamina3_bilaminado=$cotizacion["bilaminado3_cotizacion"]; };
if($cotizacion["trilaminado3_cotizacion"]==""){ $cotizacion_lamina3_trilaminado=0; }else{ $cotizacion_lamina3_trilaminado=$cotizacion["trilaminado3_cotizacion"]; };
if($cotizacion["rebobinado3_cotizacion"]==""){ $cotizacion_lamina3_rebobinado=0; }else{ $cotizacion_lamina3_rebobinado=$cotizacion["rebobinado3_cotizacion"]; };
if($cotizacion["habilitado3_cotizacion"]==""){ $cotizacion_lamina3_habilitado=0; }else{ $cotizacion_lamina3_habilitado=$cotizacion["habilitado3_cotizacion"]; };
if($cotizacion["cortefinal3_cotizacion"]==""){ $cotizacion_lamina3_cortefinal=0; }else{ $cotizacion_lamina3_cortefinal=$cotizacion["cortefinal3_cotizacion"]; };
if($cotizacion["sellado3_cotizacion"]==""){ $cotizacion_lamina3_sellado=0; }else{ $cotizacion_lamina3_sellado=$cotizacion["sellado3_cotizacion"]; };
$cotizacion_lamina3_trilaminado_grm2=$cotizacion["trilaminado3_grm2_cotizacion"];

//DATOS PARA COSTOS DE PRODUCCION
$cotizacion_grm2total=$cotizacion["grm2total_cotizacion"];
$cotizacion_cantproduccion=$cotizacion["cantproduccion_cotizacion"];
$cotizacion_metrosproducir=$cotizacion["metrosproducir_cotizacion"];
$proc_extrusion=$cotizacion["proc_extrusion_maq_cotizacion"];
$proc_impresion=$cotizacion["proc_impresion_maq_cotizacion"];
$proc_bilaminado=$cotizacion["proc_bilaminado_maq_cotizacion"];
$proc_trilaminado=$cotizacion["proc_trilaminado_maq_cotizacion"];
$proc_rebobinado=$cotizacion["proc_rebobinado_maq_cotizacion"];
$proc_habilitado=$cotizacion["proc_habilitado_maq_cotizacion"];
$proc_cortefinal=$cotizacion["proc_cortefinal_maq_cotizacion"];
$proc_sellado=$cotizacion["proc_sellado_maq_cotizacion"];
$insumo_tinta=$cotizacion["insumo_tinta"];
$insumo_bilaminado=$cotizacion["insumo_bilaminado"];
$insumo_trilaminado=$cotizacion["insumo_trilaminado"];
$insumo_cushion=$cotizacion["insumo_cushion"];
$insumo_clises=$cotizacion["insumo_clises"];

//DATOS TECNICOS
$dtecnicos_estado="I";
$codigo_unico=codigoAleatorio(20,true,true,false);
$producto_terminado="A";

//GUARDAR DATOS EN ARTICULO
$rst_guardar_articulo=mysql_query("INSERT INTO syCoesa_articulo (id_cliente, nombre_articulo, grm2_articulo, 
ancho_articulo, unidad_medida_articulo, producto_terminado, cod_unico)
VALUES ($cotizacion_cliente, '".htmlspecialchars($cotizacion_producto)."', $cotizacion_grm2, $cotizacion_anchofinal, 
$cotizacion_unidadmedida, '$producto_terminado', '$codigo_unico')", $conexion);

//EXTRAER ID DEL NUEVO ARTICULO
$rst_articulo=mysql_query("SELECT * FROM syCoesa_articulo WHERE cod_unico='".$codigo_unico."';", $conexion);
$fila_articulo=mysql_fetch_array($rst_articulo);
$articulo_id=$fila_articulo["id_articulo"];

if($articulo_id<>""){
	//GUARDA DATOS EN DATOS TECNICOS
	$rst_guardar_dt=mysql_query("INSERT INTO syCoesa_datos_tecnicos (id_articulo, 
	id_cliente, 
	ancho_final_datos_tecnicos,
	nro_bandas_datos_tecnicos, 
	nro_colores_datos_tecnicos, 
	distancia_repeticion, 
	frecuencia, 
	cilindro, 
	estado_datos_tecnicos, 
	cod_unico, 
	dato_fecha, 
	dato_usuario)
	VALUES ($articulo_id, 
	$cotizacion_cliente, 
	$cotizacion_anchofinal, 
	$cotizacion_nrobandas, 
	$cotizacion_nrocolores, 
	$cotizacion_repeticion, 
	$cotizacion_frecuencia, 
	$cotizacion_cilindro,  
	'$dtecnicos_estado', 
	'$codigo_unico', 
	'$datoFecha', 
	'$datoUsuario');", $conexion);
	
	//DATO TECNICO AGREGADO
	$rst_dato_tecnico=mysql_query("SELECT * FROM syCoesa_datos_tecnicos WHERE cod_unico='$codigo_unico';", $conexion);
	$fila_dato_tecnico=mysql_fetch_array($rst_dato_tecnico);
	$dato_tecnico=$fila_dato_tecnico["id_datos_tecnicos"];
	
	//GUARDAR LAMINAS
	$rst_guardar_lamina=mysql_query("INSERT INTO syCoesa_datos_tecnicos_laminas_procesos (id_articulo_prin, 
	id_cliente,
	id_datos_tecnicos,
	lamina1,
	lamina1_extrusion,
	lamina1_impresion,
	lamina1_impresion_grm2,
	lamina1_bilaminado,
	lamina1_trilaminado,
	lamina1_rebobinado,
	lamina1_habilitado,
	lamina1_cortefinal,
	lamina1_sellado,
	lamina2,
	lamina2_extrusion,
	lamina2_impresion,
	lamina2_bilaminado,
	lamina2_bilaminado_grm2,
	lamina2_trilaminado,
	lamina2_rebobinado,
	lamina2_habilitado,
	lamina2_cortefinal,
	lamina2_sellado,
	lamina3,
	lamina3_extrusion,
	lamina3_impresion,
	lamina3_bilaminado,
	lamina3_trilaminado,
	lamina3_trilaminado_grm2,
	lamina3_rebobinado,
	lamina3_habilitado,
	lamina3_cortefinal,
	lamina3_sellado,
	cod_unico)
	VALUES ($articulo_id, 
	$cotizacion_cliente, 
	$dato_tecnico,
	$lamina1,
	$cotizacion_lamina1_extrusion,
	$cotizacion_lamina1_impresion,
	$cotizacion_lamina1_impresion_grm2,
	$cotizacion_lamina1_bilaminado,
	$cotizacion_lamina1_trilaminado,
	$cotizacion_lamina1_rebobinado,
	$cotizacion_lamina1_habilitado,
	$cotizacion_lamina1_cortefinal,
	$cotizacion_lamina1_sellado,
	$lamina2,
	$cotizacion_lamina2_extrusion,
	$cotizacion_lamina2_impresion,
	$cotizacion_lamina2_bilaminado,
	$cotizacion_lamina2_bilaminado_grm2,
	$cotizacion_lamina2_trilaminado,
	$cotizacion_lamina2_rebobinado,
	$cotizacion_lamina2_habilitado,
	$cotizacion_lamina2_cortefinal,
	$cotizacion_lamina2_sellado,
	$lamina3,
	$cotizacion_lamina3_extrusion,
	$cotizacion_lamina3_impresion,
	$cotizacion_lamina3_bilaminado,
	$cotizacion_lamina3_trilaminado,
	$cotizacion_lamina3_trilaminado_grm2,
	$cotizacion_lamina3_rebobinado,
	$cotizacion_lamina3_habilitado,
	$cotizacion_lamina3_cortefinal,
	$cotizacion_lamina3_sellado,
	'$codigo_unico');", $conexion);
}

//GUARDAR CLIENTE EN PEDIDO
$rst_guardar_pedart=mysql_query("INSERT INTO syCoesa_pedidos (id_cliente) VALUES ($cotizacion_cliente);", $conexion);
$verpedido=seleccionTabla($cotizacion_cliente, "id_cliente", "syCoesa_pedidos", $conexion);

//VARIABLES PARA PEDIDO
$pedido_id=$verpedido["id_pedido"];
$pedido_cliente=$cotizacion_cliente;
$pedido_articulo=$articulo_id;
$pedido_precio=$cotizacion_precio;
$pedido_cantidad=$cotizacion_cantcliente;
$pedido_tolerancia=$cotizacion_tolerancia;
$pedido_grm2=$cotizacion_grm2total;
$pedido_cantidad_produccion=$cotizacion_cantproduccion;
$pedido_metros=$cotizacion_metrosproducir;

//GUARDAR
$rst_guardar_pedido=mysql_query("INSERT INTO syCoesa_pedidos_articulos (id_pedido,
id_cliente,
id_articulo,
precio_pedido,
cantidad_pedido,
tolerancia_pedido,
grm2_total,
cantidad_produccion,
metros_producir,
cod_unico)
VALUES ($pedido_id,
$pedido_cliente,
$pedido_articulo,
$pedido_precio,
$pedido_cantidad,
$pedido_tolerancia,
$pedido_grm2,
$pedido_cantidad_produccion,
$pedido_metros,
'$codigo_unico')", $conexion);

//GUARDAR
$rst_guardar_costos=mysql_query("INSERT INTO syCoesa_costo_produccion (id_cliente, 
id_articulo, 
grm2total, 
cantproduccion, 
metrosproducir, 
proc_extrusion_maq, 
proc_impresion_maq, 
proc_bilaminado_maq, 
proc_trilaminado_maq, 
proc_rebobinado_maq, 
proc_habilitado_maq, 
proc_cortefinal_maq, 
proc_sellado_maq, 
insumo_tinta, 
insumo_bilaminado, 
insumo_trilaminado, 
insumo_cushion, 
insumo_clises) 
VALUES ($cotizacion_cliente, 
$articulo_id, 
$cotizacion_grm2total, 
$cotizacion_cantproduccion, 
$cotizacion_metrosproducir, 
$proc_extrusion, 
$proc_impresion, 
$proc_bilaminado, 
$proc_trilaminado, 
$proc_rebobinado, 
$proc_habilitado, 
$proc_cortefinal, 
$proc_sellado, 
$insumo_tinta, 
$insumo_bilaminado, 
$insumo_trilaminado, 
$insumo_cushion, 
$insumo_clises)", $conexion);

if (mysql_errno()!=0){
	mysql_close($conexion);
	header("Location:lista.php?msj=tcpE");
} else {
	mysql_close($conexion);
	header("Location:lista.php?msj=tcp");
}

?>