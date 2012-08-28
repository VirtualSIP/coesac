<?php
//REQUIRE
require_once("../../../../connect/conexion.php");
require_once("../../../../connect/function.php");

//VARIABLES
$cantidad_laminas=$_POST["cantidad_laminas"];

//INSERTAR TODOS LOS DATOS
for($i=1; $i<=$cantidad_laminas; $i++){
	
	$dt_articulos=$_POST["dt_articulo$i"];
	
	//ARRAY DE PROCESOS
	$procesos=$_POST["procesos$i"];
	if($procesos==""){ $union_procesos=0;}
	elseif($procesos<>""){ $union_procesos=implode(",", $procesos); } //JUNTAR ARRAY DE PROCESOS
	
	$rst_guardar=mysql_query("INSERT INTO syCoesa_datos_tecnicos_laminas_procesos (id_articulo,
	procesos_laminas)
	VALUES ($dt_articulos,
	'0,$union_procesos,0')", $conexion);
}

if (mysql_errno()!=0){
	echo "ERROR: ". mysql_errno() . " - ". mysql_error();
	mysql_close($conexion);
} else {	
	mysql_close($conexion);
	header("Location:../lista.php?m=1");
}

?>