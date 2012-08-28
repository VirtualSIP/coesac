<?php
session_start();
require_once("../../../connect/conexion.php");
require_once("../../../connect/function.php");
require_once("../../../connect/sesion/verificar_sesion.php");

//VARIABLES
$maquina_id=$_POST["maquina_id"];
$maquina_estado=$_POST["maquina_estado"];
$maquina_nombre=$_POST["maquina_nombre"];
$maquina_tipo=$_POST["maquina_tipo"];
$maquina_abreviacion=$_POST["maquina_abreviacion"];
$maquina_amperios=$_POST["maquina_amperios"];
$maquina_potenciakw=$_POST["maquina_potenciakw"];
$maquina_costokw_hora=$_POST["maquina_costokw_hora"];
$maquina_costohora_hombre=$_POST["maquina_costohora_hombre"];
$maquina_costodepreciacion_hora=$_POST["maquina_costodepreciacion_hora"];
$maquina_gastosfabrica_hora=$_POST["maquina_gastosfabrica_hora"];
$maquina_estaciones_cuerpo=$_POST["maquina_estaciones_cuerpo"];
$maquina_refile=$_POST["maquina_refile"];
$maquina_ancho_maximo=$_POST["maquina_ancho_maximo"];
$maquina_velocidad=$_POST["maquina_velocidad"];
$maquina_personas_requeridas=$_POST["maquina_personas_requeridas"];
$merma_proceso_permitida=$_POST["merma_proceso_permitida"];
$maquina_preparacion=$_POST["preparacion_maq"];
$maquina_regulacion=$_POST["regulacion_maq"];
$maquina_tolerancia=$_POST["maquina_tolerancia"];
$maquina_observaciones=$_POST["maquina_observaciones"];

//ARRAY DE PROCESOS
$procesos=$_POST["procesos"];
if($procesos==""){ $union_procesos=0;}
elseif($procesos<>""){ $union_procesos=implode(",", $procesos); } //JUNTAR ARRAY DE PROCESOS

//DATOS USUARIO
$dato_fecha=$fechaActual;
$dato_usuario=$usuario_user;
$mostrar_maquina_nuevo=1;
$mostrar_maquina_ant=2;

//VERIFICAR SI DATOS SON IGUALES
$rst_verificar=mysql_query("SELECT * FROM syCoesa_mantenimiento_maquinas_datos WHERE id_maquina_dato=$maquina_id;", $conexion);
$fila_verficar=mysql_fetch_array($rst_verificar);

if($maquina_estado<>$fila_verficar["id_estado"] or 
$maquina_nombre<>$fila_verficar["id_maquina"] or 
$maquina_tipo<>$fila_verficar["id_tipo_maquina"] or 
$maquina_amperios<>$fila_verficar["amperios_maquina"] or 
$maquina_potenciakw<>$fila_verficar["potenciakw_maquina"] or 
$maquina_costokw_hora<>$fila_verficar["costokw_hora_maquina"] or 
$maquina_costohora_hombre<>$fila_verficar["costohora_hombre_maquina"] or 
$maquina_costodepreciacion_hora<>$fila_verficar["costodepreciacion_hora_maquina"] or 
$maquina_gastosfabrica_hora<>$fila_verficar["gastosfabrica_hora_maquina"] or 
$maquina_estaciones_cuerpo<>$fila_verficar["estacion_cuerpo_maquina"] or 
$maquina_refile<>$fila_verficar["refile_maquina"] or 
$maquina_ancho_maximo<>$fila_verficar["ancho_max_maquina"] or 
$maquina_velocidad<>$fila_verficar["velocidad_maquina"] or 
$maquina_personas_requeridas<>$fila_verficar["persona_requeridas_maquina"] or 
$maquina_tolerancia<>$fila_verficar["tolerancia_mm_maquina"] or 
$merma_proceso_permitida<>$fila_verficar["merma_proceso_permitida"] or 
$maquina_preparacion<>$fila_verficar["preparacion_maquina"] or 
$maquina_regulacion<>$fila_verficar["regulacion_maquina"] or 
"'0,'.$union_procesos.',0'"<>$fila_verficar["procesos_productivos_maquina"] or 
$maquina_observaciones<>$fila_verficar["observaciones_maquina"] ){
	
	//OCULTAR MAQUINA EDITADA
	$rst_ocultar=mysql_query("UPDATE syCoesa_mantenimiento_maquinas_datos SET mostrar_maquina=$mostrar_maquina_ant WHERE id_maquina_dato=$maquina_id;", $conexion);
	
	//GUARDAR
	$rst_guardar=mysql_query("INSERT INTO syCoesa_mantenimiento_maquinas_datos (id_maquina,
	id_estado,
	id_maquina_tipo,
	amperios_maquina,
	potenciakw_maquina,
	costokw_hora_maquina,
	costohora_hombre_maquina,
	costodepreciacion_hora_maquina,
	gastosfabrica_hora_maquina,
	estacion_cuerpo_maquina,
	refile_maquina,
	ancho_max_maquina,
	velocidad_maquina,
	personas_requeridas_maquina,
	tolerancia_mm_maquina,
	merma_proceso_permitida,
	preparacion_maquina, 
	regulacion_maquina,
	procesos_productivos_maquina,
	observaciones_maquina,
	datos_fecha_hora,
	datos_usuario,
	mostrar_maquina)
	VALUES ($maquina_nombre,
	$maquina_estado,
	$maquina_tipo,
	$maquina_amperios,
	$maquina_potenciakw,
	$maquina_costokw_hora,
	$maquina_costohora_hombre,
	$maquina_costodepreciacion_hora,
	$maquina_gastosfabrica_hora,
	$maquina_estaciones_cuerpo,
	$maquina_refile,
	$maquina_ancho_maximo,
	$maquina_velocidad,
	$maquina_personas_requeridas,
	$maquina_tolerancia,
	$merma_proceso_permitida,
	'$maquina_preparacion',
	'$maquina_regulacion',
	'0,$union_procesos,0',
	'$maquina_observaciones',
	'$dato_fecha',
	'$dato_usuario',
	$mostrar_maquina_nuevo)", $conexion);
	
	if (mysql_errno()!=0){
		header("Location:lista.php?m=4");
		mysql_close($conexion);
	} else {
		mysql_close($conexion);
		header("Location:lista.php?m=3");
	}
}

?>