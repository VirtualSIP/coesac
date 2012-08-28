<?php
include("../../panel@femip/conexion/conexion.php");

//VARIABLES - DATOS DE LA ASOCIACIÓN
$asoc_nombre=$_POST["asoc_nombre"];
$asoc_pais=$_POST["asoc_pais"];
$asoc_zip=$_POST["asoc_zip"];
$asoc_direccion=$_POST["asoc_direccion"];
$asoc_telcasa=$_POST["asoc_telcasa"];
$asoc_email=$_POST["asoc_email"];
$asoc_teloficina=$_POST["asoc_teloficina"];
$asoc_num=$_POST["asoc_num"];

//VARIABLES - DATOS DEL REPRESENTANTE DE LA ASOCIACIÓN
$rep_cargo=$_POST["rep_cargo"];
$rep_nombre=$_POST["rep_nombre"];
$rep_direccion=$_POST["rep_direccion"];
$rep_telcasa=$_POST["rep_telcasa"];
$rep_email=$_POST["rep_email"];
$rep_teloficina=$_POST["rep_teloficina"];
$rep_telcelular=$_POST["rep_telcelular"];

//GUARDAR EN LA BASE DE DATOS
mysql_query("INSERT INTO fmp_inscripcion (asociacion_nombre,
asociacion_pais,
asociacion_zip,
asociacion_direccion,
asociacion_telcasa,
asociacion_email,
asociacion_teloficina,
asociacion_numasoc,
representante_cargo,
representante_nombre,
representante_direccion,
representante_telcasa,
representante_email,
representante_teloficina,
representante_telcelular) VALUES ('$asoc_nombre', 
'$asoc_pais', 
'$asoc_zip', 
'$asoc_direccion', 
'$asoc_telcasa', 
'$asoc_email', 
'$asoc_teloficina', 
'$asoc_num',
'$rep_cargo', 
'$rep_nombre', 
'$rep_direccion', 
'$rep_telcasa', 
'$rep_email',
'$rep_teloficina', 
'$rep_telcelular')", $conexion);
	
$body = '<!DOCTYPE HTML> <html lang="es"> <head> <meta charset="utf-8">
<title>'.$web_nombre.'</title>
<style type="text/css">
	body{ font-family: Arial, Helvetica, sans-serif; font-size: 12px;}
	body{ margin:0;}
</style>
</head>
<body>
<h2>Inscripción</h2>
<h3>Datos de la Asociación</h3>
<p><strong>Nombre de la Asociación:</strong> '.$asoc_nombre.'</p>
<p><strong>País:</strong> '.$asoc_pais.'</p>
<p><strong>ZIP / Código Postal:</strong> '.$asoc_zip.'</p>
<p><strong>Dirección:</strong> '.$asoc_direccion.'</p>
<p><strong>Teléfono casa:</strong> '.$asoc_telcasa.'</p>
<p><strong>E-mail:</strong> '.$asoc_email.'</p>
<p><strong>Teléfono oficina:</strong> '.$asoc_teloficina.'</p>
<p><strong>N° Asociados:</strong> '.$asoc_num.'</p>
<p>&nbsp;</p>
<h3>Datos del Representante de la Asociación</h3>
<p><strong>Cargo:</strong> '.$rep_cargo.'</p>
<p><strong>Nombre completo:</strong> '.$rep_nombre.'</p>
<p><strong>Dirección:</strong> '.$rep_direccion.'</p>
<p><strong>Teléfono casa:</strong> '.$rep_telcasa.'</p>
<p><strong>E-mail:</strong> '.$rep_email.'</p>
<p><strong>Teléfono oficina:</strong> '.$rep_teloficina.'</p>
<p><strong>Teléfono celular:</strong> '.$rep_telcelular.'</p>
</body>
</html>';
	
$from="femip@femip.org";
$asunto="FEMIP | Inscripcion";
$headers= "From: FEMIP <".strip_tags($from)."> \r\n";
$headers.= "MIME-Version: 1.0\r\n";
$headers.= "Content-Type: text/html; charset=UTF-8\r\n";

mail($from, $asunto, $body, $headers);

?>