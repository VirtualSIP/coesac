<?php
function FechaHoraActual(){
	$meses = array("01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12");
	$dias = array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado");
	$dia = date(j); // devuelve el día del mes
	$dia2 = date(w); // devuelve el número de día de la semana
	$mes = date(n)-1; // devuelve el número del mes
	$ano = date(Y); // devuelve el año
	$fecha = $dias[$dia2]." ".$dia."/".$meses[$mes]."/".$ano." ".date("H:i"); //LUNES 13/08/2012
	return $fecha;
}

function codigoAleatorio($length=10,$uc=TRUE,$n=TRUE,$sc=FALSE)
{
	$source = 'abcdefghijklmnopqrstuvwxyz';
	if($uc==1) $source .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	if($n==1) $source .= '1234567890';
	if($sc==1) $source .= '|@#~$%()=^*+[]{}-_';
	if($length>0){
		$rstr = "";
		$source = str_split($source,1);
		for($i=1; $i<=$length; $i++){
			mt_srand((double)microtime() * 1000000);
			$num = mt_rand(1,count($source));
			$rstr .= $source[$num-1];
		}

	}
	return $rstr;
}

function guardarArchivo($carpeta,$archivo){
	if(is_uploaded_file($archivo['tmp_name']))
	{ 
		$fileName=$archivo['name'];
		$uploadDir=$carpeta;
		$uploadFile=$uploadDir.$fileName;
		$num = 0;
		$name = $fileName;
		$extension = end(explode('.',$fileName));     
		$onlyName = substr($fileName,0,strlen($fileName)-(strlen($extension)+1));
		$nombrese=codigoAleatorio(20, false, true, false);
		$todo=$nombrese.".".$extension;
		while(file_exists($uploadDir.$todo))
		{
			$num++;         
			$todo = $nombrese."".$num.".".$extension; 
		}
		$uploadFile = $uploadDir.$todo; 
		move_uploaded_file($archivo['tmp_name'], $uploadFile);  
		return $todo;
	}
}

function actualizarArchivo($carpeta,$archivo,$archivo_actual){
	if($archivo['name']!="")
	{
		if(is_uploaded_file($archivo['tmp_name']))
		{ 
			$fileName=$archivo['name'];
			$uploadDir=$carpeta;
			$uploadFile=$uploadDir.$fileName;
			$num = 0;
			$name = $fileName;
			$extension = end(explode('.',$fileName));     
			$onlyName = substr($fileName,0,strlen($fileName)-(strlen($extension)+1));
			$nombrese=codigoAleatorio(20, false, true, false);
			$todo=$nombrese.".".$extension;
			while(file_exists($uploadDir.$todo))
			{
				$num++;         
				$todo = $nombrese."".$num.".".$extension; 
			}
			$uploadFile = $uploadDir.$todo; 
			move_uploaded_file($archivo['tmp_name'], $uploadFile);  
			$todo;
		}
	}else{
		$todo=$archivo_actual;
		$todo;
	}
	return $todo;
}

function seleccionTabla($id, $id_tabla, $tabla, $conexion){
	$rst_query=mysql_query("SELECT * FROM ".$tabla." WHERE ".$id_tabla."=".$id , $conexion);
	return $fila_query=mysql_fetch_array($rst_query);
}

function NumAHora($num){
	$res=$num/60;
	$div=explode('.',$res);
	$hor=$div[0];
	$min=$num - (60*$hor);
	if($min<=9){ $min="0".$min; }
	if($hor<=9){ $hor="0".$hor; }
	return $hor.":".$min;
}

function UrlAmigable($s){

    $s = strtolower($s);
    $s = ereg_replace("[áàâãäª@]","a",$s);
    $s = ereg_replace("[éèêë]","e",$s);
    $s = ereg_replace("[íìîï]","i",$s);
    $s = ereg_replace("[óòôõºö]","o",$s);
    $s = ereg_replace("[úùûü]","u",$s);
    $s = ereg_replace("[ç]","c",$s);
    $s = ereg_replace("[ñ]","n",$s);
    $s = preg_replace( "/[^a-zA-Z0-9\-]/", "-", $s );
    $s = preg_replace( array("`[^a-z0-9]`i","`[-]+`") , "-", $s);

    return trim($s, '-');
}

function Sumar2Tiempos($h1,$h2){
	
	/* HORA1 */
	$hora1=explode(":", $h1);
	if( count($hora1) < 3 ){ $hora1[2] = 0; }
	//PASAMOS LA HORA1 A SEGUNDOS
	$hora1[0] = $hora1[0] * 60 * 60;
	$hora1[1] = $hora1[1] * 60;
	$hora1_minutos=(($hora1[0] + $hora1[1] + $hora1[2]) / 60);
	
	/* HORA 2 */
	$hora2=explode(":", $h2);
	if( count($hora2) < 3 ){ $hora2[2] = 0; }
	//PASAMOS LA HORA1 A SEGUNDOS
	$hora2[0] = $hora2[0] * 60 * 60;
	$hora2[1] = $hora2[1] * 60;
	$hora2_minutos=(($hora2[0] + $hora2[1] + $hora2[2]) / 60);
	
	$total_minutos=$hora1_minutos + $hora2_minutos;
	
	/* CONVERTIR MINUTOS A HORAS */
	$hours = floor($total_minutos / 60);
	$minutes = ($total_minutos) - ($hours * 60);

	if (!$minutes) {
		$minutes = "00";
	}
	else if ($minutes <= 9) {
		$minutes = "0" . $minutes;
	}
	
	return ("{$hours}:{$minutes}");

}

function PorcRefile($anchoarticulo, $anchofinal, $nrobandas){ return round((($anchoarticulo - ($anchofinal * $nrobandas)) / $anchoarticulo) * 100)." %"; }
function CostoLamina($num1, $num2){ $total=$num1 * $num2; return $total; }
function Division2Num($num1, $num2){ $total=($num1 / $num2); return $total; }
function BuscarPalabraLamina($palabra, $lamina1, $lamina2, $lamina3){	
	if($lamina1<>""){ if(preg_match("/\b".$palabra."\b/i",$lamina1)){ return "X"; }}
	if($lamina2<>""){ if(preg_match("/\b".$palabra."\b/i",$lamina2)){ return "X"; }}
	if($lamina3<>""){ if(preg_match("/\b".$palabra."\b/i",$lamina3)){ return "X"; }}
}

?>