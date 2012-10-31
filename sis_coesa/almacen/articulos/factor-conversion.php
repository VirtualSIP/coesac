<?php
session_start();
require_once("../../../connect/conexion.php");
require_once("../../../connect/function.php");
require_once("../../../connect/sesion/verificar_sesion.php");

//FACTOR DE CONVERSION
$rst_factor=mysql_query("SELECT * FROM sycoesa_mantenimiento_factor_conversion");

?>