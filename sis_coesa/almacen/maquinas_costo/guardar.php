<?php
session_start();
require_once("../../../connect/conexion.php");
require_once("../../../connect/function.php");
require_once("../../../connect/sesion/verificar_sesion.php");

//VARIABLES
$maquina_nombre=$_POST["maquina_nombre"];
$maquina_estado=$_POST["maquina_estado"];
$maquina_tipo=$_POST["maquina_tipo"];
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
$maquina_tolerancia=$_POST["maquina_tolerancia"];
$merma_proceso_permitida=$_POST["merma_permitida"];
$maquina_preparacion=$_POST["preparacion_maq"];
$maquina_regulacion=$_POST["regulacion_maq"];
$maquina_observaciones=$_POST["maquina_observaciones"];

//ARRAY DE PROCESOS
$procesos=$_POST["procesos$i"];
if($procesos==""){ $union_procesos=0;}
elseif($procesos<>""){ $union_procesos=implode(",", $procesos); } //JUNTAR ARRAY DE PROCESOS

//DATOS
$dato_fecha=$fechaActual;
$dato_usuario=$usuario_user;
$mostrar_maquina=1;

//GUARDAR
$rst_guardar=mysql_query("INSERT INTO syCoesa_mantenimiento_maquinas_datos (id_maquina, id_estado, id_maquina_tipo, amperios_maquina, potenciakw_maquina, costokw_hora_maquina, 
costohora_hombre_maquina, costodepreciacion_hora_maquina, gastosfabrica_hora_maquina, estacion_cuerpo_maquina, refile_maquina, ancho_max_maquina, velocidad_maquina, 
personas_requeridas_maquina, tolerancia_mm_maquina, merma_proceso_permitida, preparacion_maquina, regulacion_maquina, procesos_productivos_maquina, observaciones_maquina, datos_fecha_hora, datos_usuario, mostrar_maquina)
VALUES ($maquina_nombre, $maquina_estado, $maquina_tipo, $maquina_amperios, $maquina_potenciakw, $maquina_costokw_hora, $maquina_costohora_hombre, $maquina_costodepreciacion_hora, 
$maquina_gastosfabrica_hora, $maquina_estaciones_cuerpo, $maquina_refile, $maquina_ancho_maximo, $maquina_velocidad, $maquina_personas_requeridas, $maquina_tolerancia, 
$merma_proceso_permitida, '$maquina_preparacion', '$maquina_regulacion', '0,$union_procesos,0', '$maquina_observaciones', '$dato_fecha', '$dato_usuario', $mostrar_maquina)", $conexion);

if (mysql_errno()!=0){
	header("Location:lista.php?m=2");
	mysql_close($conexion);
} else {
	mysql_close($conexion);
	header("Location:lista.php?m=1");
}

?>