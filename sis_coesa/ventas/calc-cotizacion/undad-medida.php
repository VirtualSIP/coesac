<?php
session_start();
require_once("../../../connect/conexion.php");
require_once("../../../connect/function.php");
require_once("../../../connect/sesion/verificar_sesion.php");

//VARIABLES
$unidadmedida=$_POST["unidadmedida"];

//1 = Kg
//3 = Millar
if($unidadmedida==1){
?>
<label for="dtecnicos_cantrq">Cantidad Requerida (Kg):</label>
<?php }elseif($unidadmedida==3){ ?>
<label for="dtecnicos_cantrq">Cantidad Requerida (Millar):</label>
<?php } ?>