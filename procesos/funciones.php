<?php
//FUNCION PARA VALIDAR FORMULARIO COMPRUEBA QUE CADA VARIABLE TENGA UN VALOR
function validarFormulario($form_vars)
{
  foreach ($form_vars as $key => $value)
  {
     if (!isset($key) || ($value == "")) 
        return false;
  } 
  return true;
} 

//FUNCION PARA VALIDAR EL EMAIL COMPRUEBA QUE UNA DIRECCION SEA VALIDA
function validarEmail($address)
{
  if (preg_match("^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$^", $address))
    return true;
  else 
    return false;
}

//FUNCION GUARDAR FORMULARIO SE GUARDA DIRECTAMENTE DESDE LA PAGINA
/*function guardarFormulario($vid, $nom, $com, $fec, $ema, $act)
{
	include('../Connections/cnx.php');

	if (mysql_select_db($database_cnx,$cnx)){
	$consulta="insert into vy_curso_comentario(video_id, nombre, comentario, fecha, email, activar) 
										values('$vid', '$nom', '$com', '$fec', '$ema', '$act')"; }
	if (mysql_query($consulta,$cnx))
	$regresar = "../detalle.php?deo=$vid";
	header("Location: " . $regresar );
}*/

//FUNCION GUARDAR FORMULARIO PREGUNTA DE PRODUCTO
/*function guardarFormularioPregunta($pro, $nom, $com, $fec, $ema, $act, $res)
{
	include('../Connections/cnx.php');

	if (mysql_select_db($database_cnx,$cnx)){
	$consulta="insert into vy_cat_productos_pregunta (produkt_id, nombre, pregunta, fecha, email, activar, respuesta_si) 
												 values('$pro', '$nom', '$com', '$fec', '$ema', '$act', '$res')"; }
	if (mysql_query($consulta,$cnx))
	$regresar = "../detallePro.php?cto=$pro&dos=11";
	header("Location: " . $regresar );
}*/

//FUNCION GUARDAR NEWSLETTER
function guardarNewsletter($fec, $ema) //$fec = fecha; $ema = email
{
	include('../Connections/cnx.php');

	if (mysql_select_db($database_cnx,$cnx))
	{
		$consulta="insert into vy_newsletter	(fecha, email) 
									  values	('$fec', '$ema')"; 
	}
	if (mysql_query($consulta,$cnx))
	{
		echo "";			
	}
	else 
	{
		echo "error al guardar en db";
	}
	/* header("Location: " . '../index.php'); */
}

//ETIQUETAS QUE DE HTML5 segundo parametro que son las etiquetas que se pueden permitir
/*
$palabraformateada='leo';
$ALLOWABLE_TAGS = '<a><abbr><acronym><address><article><aside><b><bdo><big><blockquote><br><caption><cite><code><col><colgroup><dd><del><details><dfn><div><dl><dt><em><figcaption><figure><font><h1><h2><h3><h4><h5><h6><hgroup><hr><i><img><ins><li><map><mark><menu><meter><ol><p><pre><q><rp><rt><ruby><s><samp><section><small><span><strong><style><sub><summary><sup><table><tbody><td><tfoot><th><thead><time><tr><tt><u><ul><var><wbr>';

strip_tags($palabraformateada,$ALLOWABLE_TAGS); */

//FUNCION PARA VALIDAR Y DAR FORMATO A FECHA
function fechador($fecha){ 

$separado= explode("-",$fecha);  

$ano=$separado[0]; 
$dia=$separado[2]; 

if($separado[1]=='01'){ 
$mes='Ene'; 
}elseif($separado[1]=='02'){ 
$mes='Feb'; 
}elseif($separado[1]=='03'){ 
$mes='Mar'; 
}elseif($separado[1]=='04'){ 
$mes='Abr'; 
}elseif($separado[1]=='05'){ 
$mes='May'; 
}elseif($separado[1]=='06'){ 
$mes='Jun'; 
}elseif($separado[1]=='07'){ 
$mes='Jul'; 
}elseif($separado[1]=='08'){ 
$mes='Ago'; 
}elseif($separado[1]=='09'){ 
$mes='Sep'; 
}elseif($separado[1]=='10'){ 
$mes='Oct'; 
}elseif($separado[1]=='11'){ 
$mes='Nov'; 
}elseif($separado[1]=='12'){ 
$mes='Dic'; 
} 

$fechafinal=$dia.'/'.$mes.'/'.$ano; 

return $fechafinal; 
} 

//FUNCION PARA LOS META-TAGS KEYWORDS Y DESCRIPTION
function getMetaDescription($text) {
    $text = strip_tags($text);
    $text = trim($text);
    $text = substr($text, 0, 247);
    return $text."...";
}

function getMetaKeywords($text) {
    // Limpiamos el texto
    $text = strip_tags($text);
    $text = strtolower($text);
    $text = trim($text);
    $text = preg_replace('/[^a-zA-Z0-9 -]/', ' ', $text);
    // extraemos las palabras
    $match = explode(" ", $text);
    // contamos las palabras
    $count = array();
    if (is_array($match)) {
        foreach ($match as $key => $val) {
            if (strlen($val)> 3) {
                if (isset($count[$val])) {
                    $count[$val]++;
                } else {
                    $count[$val] = 1;
                }
            }
        }
    }
    // Ordenamos los totales
    arsort($count);
    $count = array_slice($count, 0, 10);
    return implode(", ", array_keys($count));
}

/**
 * Devuelve la diferencia entre 2 fechas según los parámetros ingresados
 *uthor Gerber Pacheco
 * param string $fecha_principal Fecha Principal o Mayor
 * param string $fecha_secundaria Fecha Secundaria o Menor
 * param string $obtener Tipo de resultado a obtener, puede ser SEGUNDOS, MINUTOS, HORAS, DIAS, SEMANAS
 * param boolean $redondear TRUE retorna el valor entero, FALSE retorna con decimales
 * return int Diferencia entre fechas
 */
function diferenciaEntreFechas($fecha_principal, $fecha_secundaria, $obtener = 'SEGUNDOS', $redondear = false)
{
   $f0 = strtotime($fecha_principal);
   $f1 = strtotime($fecha_secundaria);
   if ($f0 < $f1) { $tmp = $f1; $f1 = $f0; $f0 = $tmp;}
   $resultado = ($f0 - $f1);
   switch ($obtener) {
       default: break;
       case "MINUTOS"   :   $resultado = $resultado / 60;   break;
       case "HORAS"     :   $resultado = $resultado / 60 / 60;   break;
       case "DIAS"      :   $resultado = $resultado / 60 / 60 / 24;   break;
       case "SEMANAS"   :   $resultado = $resultado / 60 / 60 / 24 / 7;   break;
   }
   if($redondear) $resultado = round($resultado);
   return $resultado;
}


?>