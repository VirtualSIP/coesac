<?php
require_once("../conexion.php");

//VARIABLES DE USARIO Y PASS
$user=$_POST["loginUser"];
$clave=$_POST["loginPass"];

//FUNCION ANTI-INJECTION SQL
$usuario=mysql_real_escape_string($user);
$pass=mysql_real_escape_string($clave);

$crypt_user=hash("sha256", $usuario);
$crypt_pass=hash("sha512", $pass);
$pass_final=$crypt_pass.$crypt_user;

//QUUERY
$query=sprintf("SELECT * FROM syCoesa_usuario WHERE usuario='".$usuario."' AND clave='".$pass_final."' AND estadoErrorSession='A';");
$rst=mysql_query($query, $conexion);
$num_registros=mysql_num_rows($rst);

if($num_registros==1){
	$fila=mysql_fetch_array($rst);
	session_start();
	
	//SESSIONES DE USUARIO
	$_SESSION["user-".$sesion_pre.""]=$fila["usuario"];
	$_SESSION["user_nombre-".$sesion_pre.""]=$fila["nombre"];
	$_SESSION["user_apellido-".$sesion_pre.""]=$fila["apellidos"];
	$_SESSION["user_email-".$sesion_pre.""]=$fila["email"];	
	$_SESSION["user_priv-".$sesion_pre.""]=$fila["tipo_acceso"];
	
	header("Location:../../sis_coesa");
}elseif($num_registros==0) {
	//ERROR DE SESION SI EL USUARIO EXISTE
	$rst_errUser=mysql_query("SELECT usuario FROM syCoesa_usuario WHERE usuario='".$usuario."' LIMIT 1;", $conexion);
	$num_errUser=mysql_num_rows($rst_errUser);
	if($num_errUser==1){
		$rst_slerrUser=mysql_query("SELECT usuario, error_sesion FROM syCoesa_usuario WHERE usuario='".$usuario."' LIMIT 1;", $conexion);
		$fila_slerrUser=mysql_fetch_array($rst_slerrUser);
		$errUser_intento=$fila_slerrUser["error_sesion"];
		$errUser_intento=$errUser_intento+1;
		$rst_uperrUser=mysql_query("UPDATE syCoesa_usuario SET error_sesion=".$errUser_intento." WHERE usuario='".$usuario."';");
		
		//SI TIENE 3 INTENTOS FALLIDOS LA CUENTA SE BLOQUEA(I) HASTA QUE EL ADMINTRADOR GENERAL LO DESBLOQUEE
		if($errUser_intento>=3){
			$rst_bloUser=mysql_query("UPDATE syCoesa_usuario SET estadoErrorSession='I' WHERE usuario='".$usuario."';");
			mysql_close($conexion);
			header("Location:../../bloquear");
		}else{
			mysql_close($conexion);
			header("Location:../../?nosesion=2");
		}
	}else{
		mysql_close($conexion);
		header("Location:../../?nosesion=2");
	}	
}
?>