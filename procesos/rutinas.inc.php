<?php 
/* $Id: rutinas.inc.php,v 3.0 30/05/2008 19:05 simar Exp $ */
/**
 * Libreria de funciones
 *
 * revisión: 12/02/2009 11:36 - simar - smrFilterIntVar()
 * revisión: 21/07/2008 15:17 - simar
 * revisión: 29/05/2008 09:09 - simar 
 * revisión: 15/05/2008 13:54 - simar 
 * revision: 12/09/2007 13:15 - simar
 * revisión: 3/7/2007 16.05 - simar
 * revisión: 21/5/2007 17.44 - simar
 * created.: 17/5/2006 23.03 - simar  
 * 
 * @access  public
 */  


/**
 * Retorna un Registro
 *
 *  @author     Alejandro Rodriguez <www.alejandrorodriguez.info>
 *  @version    1.0.0   
 *  @created	-
 *  @updated	30/05/2008 19:16
 *
 * @param	string	sql	 
 * @return 	array  matriz asociativa del registro
 **/  
function smrComando( $sql ) {
	global $database_cnx, $cnx;
	mysql_select_db($database_cnx, $cnx);
	$query_rs = $sql;
	$result = mysql_query($query_rs, $cnx) or die(mysql_error()."::".$query_rs);
	return(	$result );		
}


function smrPush( $destino, $data, $tipo="POST"){
	$ch = curl_init(); 
	if ($tipo=="POST") { 
		curl_setopt ($ch, CURLOPT_URL, $destino); 
		curl_setopt ($ch, CURLOPT_POST, 1); 
		curl_setopt ($ch, CURLOPT_POSTFIELDS, $data); 
	} else {
		curl_setopt ($ch, CURLOPT_URL, $destino."?".$data); 
	}
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
	$retornar=curl_exec ($ch); 
	curl_close ($ch); 
	return($retornar);
}


// By  Comvive
function GetIP()
{
	if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown"))
		$ip = getenv("HTTP_CLIENT_IP");
	else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown"))
		$ip = getenv("HTTP_X_FORWARDED_FOR");
	else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"),"unknown"))
		$ip = getenv("REMOTE_ADDR");
	else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown"))
		$ip = $_SERVER['REMOTE_ADDR'];
	else
		$ip = "unknown";
	return($ip);
}



/**
 * Genera un texto Aleatorio resaltando ciertos caracteres
 *   CAPTCHA
 *
 *  @author     Alejandro Rodriguez <www.alejandrorodriguez.info>
 *  @version    2.0   
 *  @created	-
 *  @updated	15/06/2009 17:39	Que no tome las var globales sino referenciales. soporte de <u>, cambios generales 	
 *  @updated	30/05/2008 19:16
 *
 * @param	string	Nombre de la clase CSS
 * @param	int	Largo cars del captcha
 *
 * @return  string
 * @access  public
 **/  
function smrGenCaptcha2(&$caracteres, &$captcha, $largo=6, $css="") { 
    $items="QWERTYUIPASDFGHJKLZXCVBNM123456789";  // saqe las O y los 0 os y ceros
	$cantidad=strlen($items);
    $captcha="";        
    $caracteres="";
	$resaltadas=false;
    for ( $i=0; $i< $largo; $i++) {
        $letra=substr( $items, mt_rand(0,$cantidad-1), 1);
        $resaltar=mt_rand(0,1);
        $captcha.=(  $resaltar==1)?$letra:"";            
        if ($css=="") {
            $caracteres.=(  $resaltar==1)?"<u>".$letra."</u>":$letra;         
        } else {
            $caracteres.=(  $resaltar==1)?"<span class=\"".$css."\">".$letra."</span>":$letra;        
        }        
		if ($resaltar==1) $resaltadas=true;
    }
	if ( !$resaltadas ) {
		$caracteres="<u>".substr( $caracteres, 0,1)."</u>".substr( $caracteres, 1);
	}
}   

function smrLimpiarVariables($tipo, $nombre, $predeterminado=0) {
	$retornar=$predeterminado;
	if ( $tipo=="GET") {	
		if (isset($_GET[$nombre])) {
		  $retornar =( get_magic_quotes_gpc())?
		  htmlspecialchars(strip_tags(trim($_GET[$nombre]))):
		  htmlspecialchars(strip_tags(addslashes(trim($_GET[$nombre]))));
		}
	} else {
		if (isset($_POST[$nombre])) {
			$retornar = (get_magic_quotes_gpc())?
		  	htmlspecialchars(strip_tags(trim($_POST[$nombre]))):
		  	htmlspecialchars(strip_tags(addslashes(trim($_POST[$nombre]))));
		}		
	}	
	return($retornar);
}

function smrFilterIntVar( $dato ) {
	$resultado=false;
	// Sanear dato.
	$resultado=filter_var($dato , FILTER_SANITIZE_NUMBER_INT);		
	if ( $resultado ) { 
		// Una vez  saneado validarlo.
		$resultado=filter_var( $resultado, FILTER_VALIDATE_INT)	;
	}
	return( $resultado );	
}

 
function smrTextoConCitas( $texto, $marca="##" ) {	
	// Variables
	$texto_con_citas="";
	$texto=nl2br( $texto );	// Tomar saltos de lineas
	// $texto_procesado=$texto;
	$clases=array("izquierda", "derecha");
	$flotar=0;	
	$procesar=true;
	while ( $procesar ){
		$abreCitas=strpos( $texto, $marca);		
		if ($abreCitas===false) { 	// No tiene citas					
			$procesar=false;
		} else { // Hay citas a por ellas..
			//  Generar el texto sin la apertura de cita
			$texto_cabecera=substr( $texto, 0, $abreCitas);	
			$texto_cola=substr( $texto, $abreCitas+2);	
			$texto=$texto_cabecera.$texto_cola;									
			// Ver Fin de cita
			$cierraCitas=strpos( $texto, $marca);			
			// Extraer cita
			$cita=substr( $texto, $abreCitas, $cierraCitas-$abreCitas);
			// Generar texto con cita
			$texto_cabecera=substr( $texto, 0, $cierraCitas);
			$texto_cola=substr( $texto, $cierraCitas+2);
			$clase=$clases[ ( ($flotar++%2==0)?0:1) ];
			// $texto=sprintf( "%s <pre class='%s'>%s</pre>%s", $texto_cabecera, $clase, $cita, $texto_cola ); 			
			$texto=sprintf( "%s <span class=\"observacion_noticia_%s\">%s</span>%s", $texto_cabecera, $clase, $cita, $texto_cola ); 						
		}
	}
	return($texto);
}


function smrOnlyCreativat($aIpsExtras=array()){	
	$aIP=array("192.168.1.2", "192.168.1.3", "192.168.1.4", "192.168.1.8", "217.125.151.168" );
	for ($i=0; $i<count($aIpsExtras); $i++) {
		$aIP[]=$aIpsExtras[$i];
	}			
	if ( !in_array( $_SERVER['REMOTE_ADDR'], $aIP ) ) {
		die(":".$_SERVER['REMOTE_ADDR'].":");	
	}	
}
 
/**********************************************************
                          DATE & TIME
***********************************************************/

// echo smrTiempoTranscurrido( "1971-12-31" ) ;
// echo smrAnios( "1971-12-31" );

function smrAnios( $fecha ) {
	$resultado=smrTiempoTranscurrido( $fecha );
	$pos=strpos( $resultado, " ");
	return( substr( $resultado,0, $pos ) );
}


function smrTiempoTranscurrido( $fecha ) {
list($year,$month,$day) = split("-",$fecha);
// This is a simple script to calculate the difference between two dates
// and express it in years, months and days
// 
// use as in: "my daughter is 4 years, 2 month and 17 days old" ... :-)
//
// Feel free to use this script for whatever you want
// 
// version 0.1 / 2002-10-3
//
// please send comments and feedback to webmaster@lotekk.net
//
// Modificada por simar
// ****************************************************************************

// configure the base date here
$base_day		= $day;		// no leading "0"
$base_mon		= $month;		// no leading "0"
$base_yr		= $year;		// use 4 digit years!

// get the current date (today) -- change this if you need a fixed date
$current_day		= date ("j");
$current_mon		= date ("n");
$current_yr		= date ("Y");

// and now .... calculate the difference! :-)

// overflow is always caused by max days of $base_mon
// so we need to know how many days $base_mon had
$base_mon_max		= date ("t",mktime (0,0,0,$base_mon,$base_day,$base_yr));

// days left till the end of that month
$base_day_diff 		= $base_mon_max - $base_day;

// month left till end of that year
// substract one to handle overflow correctly
$base_mon_diff 		= 12 - $base_mon - 1;

// start on jan 1st of the next year
$start_day		= 1;
$start_mon		= 1;
$start_yr		= $base_yr + 1;

// difference to that 1st of jan
$day_diff	= ($current_day - $start_day) + 1; 	// add today
$mon_diff	= ($current_mon - $start_mon) + 1;	// add current month
$yr_diff	= ($current_yr - $start_yr);

// and add the rest of $base_yr
$day_diff	= $day_diff + $base_day_diff;
$mon_diff	= $mon_diff + $base_mon_diff;

// handle overflow of days
if ($day_diff >= $base_mon_max)
{
	$day_diff = $day_diff - $base_mon_max;
	$mon_diff = $mon_diff + 1;
}

// handle overflow of years
if ($mon_diff >= 12)
{
	$mon_diff = $mon_diff - 12;
	$yr_diff = $yr_diff + 1;
}

// the results are here:

// $yr_diff  	--> the years between the two dates
// $mon_diff 	--> the month between the two dates
// $day_diff 	--> the days between the two dates

// ****************************************************************************

// simple output of the results 
/*
print "The difference between <b>".$base_yr."-".$base_mon."-".$base_day."</b> ";
print "and <b>".$current_yr."-".$current_mon."-".$current_day."</b> is:";
print "<br><br>";
*/
// this is just to make it look nicer
$years = "años";
$months = "meses";
$days = "días";
if ($yr_diff == "1") $years = "año";
if ($mon_diff == "1") $months = "mes";
if ($day_diff == "1") $days = "día";

// here we go
$resultado=sprintf( "%s %s, %s %s y %s %s",$yr_diff, $years, $mon_diff, $months, $day_diff, $days );
return( $resultado );
/*
print $yr_diff." ".$years.", ";
print $mon_diff." ".$months." y ";
print $day_diff." ".$days;
*/
}  


/**
 * Formatear una fecha
 *
 *  @author     Alejandro Rodriguez <www.alejandrorodriguez.info>
 *  @version    1.0.0   
 *  @created	-
 *  @updated	30/05/2008 19:12
 * @param   date 
 * 
 * @return  string Fecha formateada  como Viernes 7 de Septiembre de 2007
 * @access  public
 **/   
 function smrFechaTextDMY( $fecha ) {
	global $idioma_sufijo;
	$fechaDMY=smrFechaDMY( $fecha, ".");
	$anio=substr($fechaDMY, 6,4);
	$mesNum=substr($fechaDMY, 3,2);
	$mes=smrVerMes($mesNum, $idioma_sufijo);	
	$diaNum=substr($fechaDMY, 0,2);		
	$fechaMKT=mktime(0, 0, 0, $mesNum , $diaNum,$anio);
	$dia=date("w", $fechaMKT);	
	$dia=smrVerDia($dia, $idioma_sufijo);	
	$resultado=sprintf( "%s %s de %s de %s", $dia, $diaNum, $mes, $anio);
	return( $resultado);
}



/**
 * Función para formatear un TimeStamp
 *  @author     Alejandro Rodriguez <www.alejandrorodriguez.info>
 *  @version    1.0.0   
 *  @created	-
 *  @updated	30/05/2008 19:12
 *
 * @param   string Timestamp
 *
 * @return  string Dato formateado
 * @access  public
 **/  
function smrFormateaTS( $fecha ) { 
	$fecha=smrMuestraTS( $fecha );
	return(sprintf( "%s/%s/%s %s",substr($fecha,8,2),substr($fecha,5,2),substr($fecha,0,4),substr($fecha, -8) ) );
}


/**
 * Retornar el contenido recibido en el metodo especificado
 *
 *  @author     Alejandro Rodriguez <www.alejandrorodriguez.info>
 *  @version    1.0.0   
 *  @created	-
 *  @updated	30/05/2008 19:12
 *
 * @param   string 	fecha ej. echo fecha_completa(date("Y-m-d h:i:s"));
 *
 * @return  string	Fecha formateada ej. Lunes, 08 Octubre de 2007 10:59 am
 * @access  public
 **/ 
function fecha_completa($data, $tipos=1)
{
  if ($data != '' && $tipos == 0 || $tipos == 1)
  {
    $setmana = array('Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado');
    $mes = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'); 

    if ($tipos == 1)
    {
      ereg('([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2})', $data, $data);
      $data = mktime($data[4],$data[5],0,$data[2],$data[3],$data[1]);
    } 

    return $setmana[date('w', $data)].', '.date('d', $data).' '.$mes[date('m',$data)-1].' de '.date('Y', $data).' '.date('h', $data).':'.date('i', $data).' '.date('a', $data);
  }
  else
  {
    return 0;
  }
}


/**
 * Retorna un valor  formateado en HH:MM
 *
 *  @author     Alejandro Rodriguez <www.alejandrorodriguez.info>
 *  @version    1.0.0   
 *  @created	-
 *  @updated	30/05/2008 19:13
 *
 * @param   string 	Dato HHMM
 *
 * @return  string	Dato Formateado HH:MM
 * @access  public
 **/ 
function smrParseHora($hora) {
	return( substr($hora, 0,2).":".substr($hora,2));
}

/**
 * Procesar la fecha dada y devolver el nombre del dia en 3 cars.
 *  @author     Alejandro Rodriguez <www.alejandrorodriguez.info>
 *  @version    1.0.0   
 *  @created	-
 *  @updated	30/05/2008 19:15
 *
 * @param   date 	
 *
 * @return  string	Dato Formateado
 * @access  public
 **/ 
function smrDia3N( $fecha ) {
	$resultado="";	
	list($anio, $mes, $dia) = explode( "-", $fecha);	
	$myFecha=mktime(0, 0, 0, $mes  , $dia, $anio);
	$nDiaSemana=date("w", $myFecha );
	$resultado=substr( smrVerDia( $nDiaSemana ), 0,3)." ".$dia;	
	return( $resultado);
}


/**
 * Tiempo transcurrido desde una fecha
 *
 *  @author     Alejandro Rodriguez <www.alejandrorodriguez.info>
 *  @version    1.0.0   
 *  @created	-
 *  @updated	30/05/2008 19:15
 *
 * @param   timestamp    fecha limite
 *
 * @return  array   la cadena resultante
 * @access  public
 **/  
function formatetimestamp($until){

   $now = time();
   $difference = $now - $until ;// $until - $now;

   $days = floor($difference/86400);
   $difference = $difference - ($days*86400);

   $hours = floor($difference/3600);
   $difference = $difference - ($hours*3600);

   $minutes = floor($difference/60);
   $difference = $difference - ($minutes*60);

   $seconds = $difference;
// OUT BY BASNEK   $output = "You have to wait $days Days, $hours Hours, $minutes Minutes and $seconds Seconds until this Day.";
	$output=array( "dias" => $days, "horas" => $hours, "minutos" => $minutes, "segundos" => $seconds );
   return $output;

}


/**
 * Formatea una fecha
 *
 *  @author     Alejandro Rodriguez <www.alejandrorodriguez.info>
 *  @version    1.0.0   
 *  @created	-
 *  @updated	30/05/2008 19:16
 *
 * 	@param   date    fecha a covertir
 * 	@param   string  caracter de separación e dd?mm?yyyy
 *
 * 	@return  string   la cadena resultante
 * 	@access  public
 **/ 
function smrFechaDMY($fecha, $separador="/") {
	list($year,$month,$day) = split("-",$fecha);
return($day.$separador.$month.$separador.$year);
} 


/**
 * Retorna en nombre del día en el idioma  elegido
 *
 *  @author     Alejandro Rodriguez <www.alejandrorodriguez.info>
 *  @version    1.0.0   
 *  @created	-
 *  @updated	30/05/2008 19:16
 *
 * 	@param   int    numero de dia de la semana
 * 	@param   string	idioma 
 *
 * 	@return  string
 * 	@access  public
 **/ 
function smrVerDia( $nDia, $idioma="esp" ) {
	$nDia=(isset( $nDia) && $nDia>=0 && $nDia<=6 && $nDia!="")?$nDia:date("w");
	$aDias=array(
			"esp"=>array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado"),
			"eng"=>array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"),
			"cat"=>array("Diumenge","Dilluns","Dimarts","Dimecres","Dijous","Divendres","Dissabte")
			);
	return( $aDias[$idioma][$nDia] );
}


/**
 * Retorna en nombre del mes en el idioma  elegido
 *
 *  @author     Alejandro Rodriguez <www.alejandrorodriguez.info>
 *  @version    1.0.0   
 *  @created	-
 *  @updated	30/05/2008 19:16
 *
 * 	@param   int    numero de mes
 * 	@param   string	idioma 
 *
 * 	@return  string
 * 	@access  public
 */ 
function smrVerMes( $nMes, $idioma="esp" ) {
	$nMes=intval( $nMes) ;
	$aMeses = array( 
		"esp" => array( "","Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto" , "Septiembre", "Octubre", "Noviembre", "Diciembre" ),
		"cat" => array( "","Gener", "Febrer", "Març", "Abril", "Maig", "Juny", "Juliol", "Agost" , "Septembre", "Octubre", "Novembre", "Decembre" ),
		"eng" => array( "","January", "February", "March", "April", "May", "June", "July", "August" , "September", "October", "November", "December" )	
		);
	return( $aMeses[$idioma][$nMes] );
}


/**
 * Retorna un TIMESTAMP, legible.
 *
 *  @author     Alejandro Rodriguez <www.alejandrorodriguez.info>
 *  @version    1.0.0   
 *  @created	-
 *  @updated	30/05/2008 19:16
 *
 * 	@param   string    Fecha TIMESTAMP
 *
 * 	@return  string
 * 	@access  public
 **/ 
function smrMuestraTS( $sFecha ) {
	$nLargo=strlen($sFecha);
	switch ($nLargo) {
		case 14: // TIMESTAMP(14)  YYYYMMDDHHMMSS  
			$dia=substr($sFecha,6,2); 
			$mes=substr($sFecha,4,2);
			$anio=substr($sFecha,0,4);	
			$hora=substr($sFecha,8,2);	
			$minuto=substr($sFecha,10,2);	
			$segundo=substr($sFecha,12,2);	
			$sFecha=$dia."/".$mes."/".$anio." ".$hora.":".$minuto.":".$segundo;	
			break;
		case 12: // TIMESTAMP(12)  YYMMDDHHMMSS  
			$dia=substr($sFecha,4,2);
			$mes=substr($sFecha,2,2);
			$anio=substr($sFecha,0,2);	
			$hora=substr($sFecha,6,2);	
			$minuto=substr($sFecha,8,2);	
			$segundo=substr($sFecha,10,2);	
			$sFecha=$dia."/".$mes."/".$anio." ".$hora.":".$minuto.":".$segundo;
			break;
		case 10: // TIMESTAMP(10)  YYMMDDHHMM  
			$dia=substr($sFecha,4,2);
			$mes=substr($sFecha,2,2);
			$anio=substr($sFecha,0,2);	
			$hora=substr($sFecha,6,2);	
			$minuto=substr($sFecha,8,2);	
			$sFecha=$dia."/".$mes."/".$anio." ".$hora.":".$minuto;
			break;
		case 8: // TIMESTAMP(8)  YYYYMMDD  
			$dia=substr($sFecha,6,2);
			$mes=substr($sFecha,4,2);
			$anio=substr($sFecha,0,4);	
			$sFecha=$dia."/".$mes."/".$anio;	
			break;
		case 6: // TIMESTAMP(6)  YYMMDD  
			$dia=substr($sFecha,4,2);
			$mes=substr($sFecha,2,2);
			$anio=substr($sFecha,0,2);	
			$sFecha=$dia."/".$mes."/".$anio;
			break;
		case 4: // TIMESTAMP(4)  YYMM  
			$mes=substr($sFecha,2,2);
			$anio=substr($sFecha,0,2);	
			$sFecha=$mes."/".$anio;
			break;
		case 2: // TIMESTAMP(2)  YY  
			$anio=substr($sFecha,0,2);	
			$sFecha=$anio;
			break;
	}		
return($sFecha);
}

/**
 * Convierte minutos en format XX:XX HH:MM
 *
 *  @author     Alejandro Rodriguez <www.alejandrorodriguez.info>
 *  @version    1.0.0   
 *  @created	-
 *  @updated	30/05/2008 19:16
 *
 * 	@param   int    valor a convertir
 *
 * 	@return  string
 * 	@access  public
 **/ 
function smrFormateaMinutos( $cuantos ) { 
	//hora es la division entre el sobrante de horas y 3600 segundos que representa una hora;
	$horas=floor( ($cuantos*60)/3600);
	$mod_minutos=( ($cuantos*60)%3600);
	$minutos=floor($mod_minutos/60);
	return(str_pad($horas, 2, "0", STR_PAD_LEFT).":".str_pad($minutos, 2, "0", STR_PAD_LEFT));
}



/**********************************************************
                          STRING
***********************************************************/

/**
 * Agregar BRs para sitios mal armados en CSS
 *   Utilizar para estirar un area
 *
 *  @author     Alejandro Rodriguez <www.alejandrorodriguez.info>
 *  @version    1.0.0   
 *  @created	-
 *  @updated	30/05/2008 19:16
 *
 * @param   int Limite
 * @param   int Items actuales
 * @param   int Valor multiplicador
 *
 * @return  nothing
 * @access  public
 **/  
function smrEstirarArea($corte, $actual, $incremento=1) { 
	$comparar=$actual* $incremento ;
	if ( $corte > $comparar ) { 	
		echo str_repeat( "<br />", $corte-$comparar ); 
	} else {
		echo str_repeat( "<br />", 10 ); 
	}
} 


/**
 * Convierte una cadena de caracteres en url amigable
 *
 *  @author     unknow
 *  @version    1.0.0   
 *  @created	-
 *  @updated	30/05/2008 19:16
 *
 * 	@param   string    valor a convertir
 *
 * 	@return  string
 * 	@access  public
 **/ 
if (!function_exists("urls_amigables")) {
function urls_amigables($url) {
// Tranformamos todo a minusculas
$url = strtolower($url);
//Rememplazamos caracteres especiales latinos
$find = array('á', 'é', 'í', 'ó', 'ú', 'ñ', 'à', 'è', 'ì', 'ò', 'ù', 'ä', 'ë', 'ï', 'ö', 'ü');
$repl = array('a', 'e', 'i', 'o', 'u', 'n', 'a', 'e', 'i', 'o', 'u', 'a', 'e', 'i', 'o', 'u');
$url = str_replace ($find, $repl, $url);
// Añaadimos los guiones
$find = array(' ', '&', '\r\n', '\n', '+');
$url = str_replace ($find, '-', $url);
// Eliminamos y Reemplazamos demás caracteres especiales
$find = array('/[^a-z0-9\-<>]/', '/[\-]+/', '/<[^>]*>/');
$repl = array('', '-', '');
$url = preg_replace ($find, $repl, $url);
return $url;
}	
}

/**
 * Resaltar caracteres 
 *
 *  @author     unknow
 *  @version    1.0.0   
 *  @created	-
 *  @updated	30/05/2008 19:16
 *
 * 	@param   string    pajar
 * 	@param   string    aguja 
 *
 * 	@return  string
 * 	@access  public
 **/ 
function highlight($x,$var) {//$x is the string, $var is the text to be highlighted
   if ($var != "") {
       $xtemp = "";
       $i=0;
       while($i<strlen($x)){
           if((($i + strlen($var)) <= strlen($x)) && (strcasecmp($var, substr($x, $i, strlen($var))) == 0)) {
//this version bolds the text. you can replace the html tags with whatever you like.
                   $xtemp .= "<b>" . substr($x, $i , strlen($var)) . "</b>";
                   $i += strlen($var);
           }
           else {
               $xtemp .= $x{$i};
               $i++;
           }
       }
       $x = $xtemp;
   }
   return $x;
}

/**
 * Trunca los decimales 
 *
 *  @author     unknow
 *  @version    1.0.0   
 *  @created	-
 *  @updated	30/05/2008 19:16
 *
 * 	@param   numeric    valor númerico
 *
 * 	@return  int
 * 	@access  public
 **/ 
function truncate_decimals ($num) {
	$shift = pow(10, 2);
	return ((floor($num * $shift)) / $shift);
}


/**
 * Trunca una cadena de caracteres en un largo especifico agregando los caracteres ... o los deseados
 *
 *  @author     bob at 808medien dot de  16-Sep-2005 11:10
 *  @from    	php.net  
 * 	@param   string	texto a truncar
 * 	@param   int	cantidad de caracteres
 * 	@param   string extension para adjuntar al texto truncado
 *
 * 	@return  string
 *
 * 	@access  public
 **/  
function truncate_string ($string, $maxlength, $extension='...') {

   // Set the replacement for the "string break" in the wordwrap function
   $cutmarker = "**cut_here**";

   // Checking if the given string is longer than $maxlength
   if (strlen($string) > $maxlength) {

       // Using wordwrap() to set the cutmarker
       // NOTE: wordwrap (PHP 4 >= 4.0.2, PHP 5)
       $string = wordwrap($string, $maxlength, $cutmarker);

       // Exploding the string at the cutmarker, set by wordwrap()
       $string = explode($cutmarker, $string);

       // Adding $extension to the first value of the array $string, returned by explode()
       $string = $string[0] . $extension;
   }

   // returning $string
   return $string;

}

/**
 * Cut string to n symbols and add delim but do not break words.
 *
 * Example:
 * <code>
 *  $string = 'this is some content to be shortened';
 *  echo myfragment($string, 15);
 * </code>
 *
 * Output: 'this is some content...'
 *
 * @access public
 * @param string string we are operating with
 * @param integer character count to cut to
 * @param string|NULL delimiter. Default: '...'
 * @return string processed string
 **/
function myfragment($str, $n, $delim='...') { // {{{
   $len = strlen($str);
   if ($len > $n) {
       preg_match('/(.{' . $n . '}.*?)\b/', $str, $matches);
       return rtrim($matches[1]) . $delim;
   }
   else {
       return $str;
   }
} // }}}

/**
 * str_pad_html - Pad a string to a certain length with another string.
 * accepts HTML code in param: $strPadString.
 *
 * @name        str_pad_html()
 * @author        Tim Johannessen <root@it.dk>
 * @version        1.0.0
 * @param        string    $strInput    The array to iterate through, all non-numeric values will be skipped.
 * @param        int    $intPadLength    Padding length, must be greater than zero.
 * @param        string    [$strPadString]    String to pad $strInput with (default: &nbsp;)
 * @param        int        [$intPadType]        STR_PAD_LEFT, STR_PAD_RIGHT (default), STR_PAD_BOTH
 * @return        string    Returns the padded string
 **/
   function str_pad_html($strInput = "", $intPadLength, $strPadString = "&nbsp;", $intPadType = STR_PAD_RIGHT) {
       if (strlen(trim(strip_tags($strInput))) < intval($intPadLength)) {
          
           switch ($intPadType) {
                 // STR_PAD_LEFT
               case 0:
                   $offsetLeft = intval($intPadLength - strlen(trim(strip_tags($strInput))));
                   $offsetRight = 0;
                   break;
                  
               // STR_PAD_RIGHT
               case 1:
                   $offsetLeft = 0;
                   $offsetRight = intval($intPadLength - strlen(trim(strip_tags($strInput))));
                   break;
                  
               // STR_PAD_BOTH
               case 2:
                   $offsetLeft = intval(($intPadLength - strlen(trim(strip_tags($strInput)))) / 2);
                   $offsetRight = round(($intPadLength - strlen(trim(strip_tags($strInput)))) / 2, 0);
                   break;
                  
               // STR_PAD_RIGHT
               default:
                   $offsetLeft = 0;
                   $offsetRight = intval($intPadLength - strlen(trim(strip_tags($strInput))));
                   break;
           }
          
           $strPadded = str_repeat($strPadString, $offsetLeft) . $strInput . str_repeat($strPadString, $offsetRight);
           unset($strInput, $offsetLeft, $offsetRight);
          
           return $strPadded;
       }
      
       else {
           return $strInput;
       }
   }


/**
 * Genera un valor aleatorio 
 *
 *  @author     Alejandro Rodriguez <www.alejandrorodriguez.info>
 *  @version    1.0.0   
 *  @created	-
 *  @updated	30/05/2008 19:16
 *
 * @param	int	Valor numerico minimo 		
 * @param	int	Valor numerico maximo  
 * @param	string	1=Mezcla con la fecha 0=solo numeros
 *
 * @return string	Valor unico encriptado con MD5
 **/
function smrGenPin($minimo=1000,$maximo=9999,$compuesto="1") {	
	$valor = rand( $minimo,$maximo);
	if ( $compuesto=="1" ) {
		$letras="";
		for ( $i=0; $i<=5; $i++) {			
				$letras.=chr( rand(65,90) ) ;
		}
		
		$valor .= $valor.$letras.date('dmy').date('His');
		
	}		
	return md5( $valor ) ;
}


/**
 * Formatear un email en xx at xx dot com
 *
 *  @author     Alejandro Rodriguez <www.alejandrorodriguez.info>
 *  @version    1.0.0   
 *  @created	-
 *  @updated	30/05/2008 19:16
 *
 * @param	string	cuenta de email
 *
 * @return 	string	con el mail formateado
 **/  
function smrCorreoAntiSpam( $correo ) {
	$correo=str_replace( "@", " at ", $correo);
	$correo=str_replace( ".", " dot ", $correo);
	return ($correo);
}

/**
 * Genera una contraseña amigable
 *
 *  @author     Alejandro Rodriguez <www.alejandrorodriguez.info>
 *  @version    1.0.0   
 *  @created	-
 *  @updated	30/05/2008 19:16
 *
 * @return 	string	contraseña elegida
 **/  
function smrGenPass2() { 
	$signos="*-+._#@";
	$animales=array("perro", "gato", "caballo", "loro", "pajaro");
	$cosas=array("casa", "sol", "tierra", "agua", "aire", "lluvia", "luna", "simar", "maug");
	$animal=$animales[mt_rand(0,count($animales)-1)];
	$cosa=$cosas[mt_rand(0,count($cosas)-1)];
	$signo=substr( $signos, mt_rand(0,6), 1 );
	$numero=mt_rand(10,99);
	
	$mayusculas=( mt_rand(0,1) == 0)?true:false;
	if ($mayusculas) {
		$cCode=strtoupper( $animal ).$signo.$numero.$signo.strtolower( $cosa);		
	}else{
		$cCode=strtolower( $animal ).$signo.$numero.$signo.strtoupper( $cosa);		
	}
	return($cCode);
} 

/**
 * Genera una contraseña genérica
 *
 *  @author     Alejandro Rodriguez <www.alejandrorodriguez.info>
 *  @version    1.0.0   
 *  @created	-
 *  @updated	30/05/2008 19:16
 *
 * @return 	string	contraseña elegida
 **/  
function smrGenPass( $nLargo=6 ) { 
	$caracteres="012345678qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM*-+._#@";
	$cCode="";
	for ( $i=0; $i<=$nLargo; $i++) {			
			$cCode.=substr( $caracteres, rand(0,strlen( $caracteres) ),1 ) ;
	}
	return( $cCode);
}


/**
 * Trunca una cadena de caracteres en un largo especifico agregando los caracteres ... o los deseados
 *
 *  @author     Alejandro Rodriguez <www.alejandrorodriguez.info>
 *  @version    1.0.0   
 *  @created	-
 *  @updated	30/05/2008 19:16
 *
 * @param   string	texto a truncar
 * @param   int	cantidad de caracteres
 * @param   string extension para adjuntar al texto truncado
 *
 * @return  string
 * @access  public
 **/  
function smrFragmento( $string, $maxlength, $extension='...' ) {
	// Limpio los html
	$string=str_replace("<strong>", "", $string); 	$string=str_replace("<STRONG>", "", $string);
	$string=str_replace("</strong>", "", $string);	$string=str_replace("</STRONG>", "", $string);
	$string=str_replace("<p>", "", $string);		$string=str_replace("<P>", "", $string);	
	$string=str_replace("</p>", "", $string);		$string=str_replace("</P>", "", $string);	
	return( myfragment($string, $maxlength, $extension='...') );
}

/**
 * Elimina los digitos separadores de miles
 *   Usado para pasar valores a TPV
 *
 *  @author     Alejandro Rodriguez <www.alejandrorodriguez.info>
 *  @version    1.0.0   
 *  @created	-
 *  @updated	30/05/2008 19:16
 *
 * @param   double Valor a convertir	
 *
 * @return  string
 * @access  public
 **/  
function smrNumeroSinSeparadores( $monto ) {
	return( str_replace( ".", "", number_format(	$monto, 2, ".", "") ) );	
}

/**
 * Genera un texto Aleatorio resaltando ciertos caracteres
 *   CAPTCHA
 *
 *  @author     Alejandro Rodriguez <www.alejandrorodriguez.info>
 *  @version    1.0.0   
 *  @created	-
 *  @updated	30/05/2008 19:16
 *
 * @param	string	Nombre de la clase CSS
 * @param	int	Largo cars del captcha
 *
 * @return  string
 * @access  public
 **/  
function smrGenCaptcha($css="", $largo=6) { 
    global $captcha, $caracteres;
    //$items="qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM0123456789"; 
    $items="QWERTYUIPASDFGHJKLZXCVBNM123456789";  // saqe las O y los 0 os y ceros
    $captcha="";        
    $caracteres="";
	$resaltadas=false;
    for ( $i=0; $i< $largo; $i++) {
         
        $letra=substr( $items, mt_rand(0,strlen($items)-1), 1);
        $resaltar=mt_rand(0,1);
        $captcha.=(  $resaltar==1)?$letra:"";            
        if ($css=="") {
            $caracteres.=(  $resaltar==1)?"<strong><em>".$letra."</em></strong>":$letra;         
        } else {
            $caracteres.=(  $resaltar==1)?"<span class=\"".$css."\">".$letra."</span>":$letra;        
        }        
		if ($resaltar==1) $resaltadas=true;
    }
	if ( !$resaltadas ) {
		$caracteres="<span class=\"".$css."\">".substr( $caracteres, 0,1)."</span>".substr( $caracteres, 1);
	}
}   


/**
 * Codificar un email - antispam
 *
 *  @author     Alejandro Rodriguez <www.alejandrorodriguez.info>
 *  @version    1.0.0   
 *  @created	-
 *  @updated	30/05/2008 19:16
 *
 * @param   string cuenta de correo
 * @param   string texto en pantalla
 * @param   string clase css 
 *
 * @return  string 
 * @access  public
 **/  
function smrEmailAntiSpam( $email, $texto="", $css="" ) {
	if ( $css != "") {
		$css=sprintf( "class=\"%s\"", $css);
	}

	$emailHexadecimal="";	
	for ( $i=0; $i<strlen( $email ) ; $i++) {
	   $emailHexadecimal.="%".dechex( ord( substr( $email, $i, 1) ) ) ;
	}

	$emailDecimal="";	
	for ( $i=0; $i<strlen( $email ) ; $i++) {
	   $emailDecimal.="&#".ord( substr( $email, $i, 1) ).";" ;
	}
	
	$emailLink=sprintf( "<a href=\"mailto:%s\" %s>%s</a>", $emailHexadecimal, $css, ( ($texto!="")?$texto:$emailDecimal ));

	return ( $emailLink );
}

/**
 * Codificar un email - antispam
 *
 *  @author     Alejandro Rodriguez <www.alejandrorodriguez.info>
 *  @version    1.0.0   
 *  @created	-
 *  @updated	30/05/2008 19:16
 *
 * @param   string cuenta de correo
 * @param   boolean hexa or decimal 
 *
 * @return  string 
 * @access  public
 **/  

 function smrEmailAntiSpam2( $email, $hexa=true ) {

	$emailHexadecimal="";	
	for ( $i=0; $i<strlen( $email ) ; $i++) {
	   $emailHexadecimal.="%".dechex( ord( substr( $email, $i, 1) ) ) ;
	}

	$emailDecimal="";	
	for ( $i=0; $i<strlen( $email ) ; $i++) {
	   $emailDecimal.="&#".ord( substr( $email, $i, 1) ).";" ;
	}
	
	// $emailLink=sprintf( "<a href=\"mailto:%s\" %s>%s</a>", $emailHexadecimal, $css, ( ($texto!="")?$texto:$emailDecimal ));

	if ($hexa) { 
		$emailLink=$emailHexadecimal;
	} else { 
		$emailLink=$emailDecimal;
	}

	

	return ( $emailLink );
}


/**********************************************************
                          ARRAY
***********************************************************/

/**********************************************************
                          FILE
***********************************************************/

/**********************************************************
                          IDIOMAS
***********************************************************/

/**
 * Definir el nombre de la carpeta de idioma basandose en el sufijo o id de idioma
 *
 *  @author     Alejandro Rodriguez <www.alejandrorodriguez.info>
 *  @version    1.0.0   
 *  @created	-
 *  @updated	30/05/2008 22:46
 *
 * @param	string	id de idioma
 *
 * @return	string	siglas de la carpeta
 **/  
function idioma2to3( $cual ) {
	$idiomas=array( "ES"=>"esp", "EN" => "eng", "PO"=>"por", "CA"=>"cat", "FR"=>"fra");
	return ($idiomas[$cual]);
}


/**********************************************************
                          BBDD
***********************************************************/

/**
 * Retorna un Registro
 *
 *  @author     Alejandro Rodriguez <www.alejandrorodriguez.info>
 *  @version    1.0.0   
 *  @created	-
 *  @updated	30/05/2008 19:16
 *
 * @param	string	sql	 
 * @return 	array  matriz asociativa del registro
 **/  
function smr1Registro( $sql ) {
	global $database_cnx, $cnx;
	
	mysql_select_db($database_cnx, $cnx);
	$query_rs = $sql;
	$rs = mysql_query($query_rs, $cnx) or die(mysql_error()."::".$query_rs);
	$row_rs = mysql_fetch_assoc($rs);
	$totalRows_rs = mysql_num_rows($rs);

	if ($totalRows_rs==0) $row_rs=false;
	mysql_free_result($rs);
	
	return(	$row_rs );		
}


/**
 * Ejecutar un query
 *
 *  @author     Alejandro Rodriguez <www.alejandrorodriguez.info>
 *  @version    1.0.0   
 *  @created	-
 *  @updated	30/05/2008 19:16
 * @param   string Query SQL
 *
 * @return  recordset 
 * @access  public
 **/  
function smrSQL( $sql ) {
	global $database_cnx, $cnx;
	mysql_select_db($database_cnx, $cnx);
	$query_rs = $sql;
	$rs = mysql_query($query_rs, $cnx) or die(mysql_error());
	$totalRows_rs = mysql_num_rows($rs);
	if ($totalRows_rs == 0)  $rs=false;
	return( $rs );
}


/**
 * Configurar el CHARSET a utilizar
 *
 *  @author     Alejandro Rodriguez <www.alejandrorodriguez.info>
 *  @version    1.0.0   
 *  @created	-
 *  @updated	30/05/2008 19:16
 *
 * @param	string
 * 
 * @access  public
 **/   
function smrMysqlCharset($tipo='utf8') {
	global $database_cnx, $cnx;
	mysql_select_db($database_cnx, $cnx);
	$query_rsUTF8 = sprintf("SET NAMES '%s'", $tipo);
	$rsUTF8 = mysql_query($query_rsUTF8, $cnx) or die(mysql_error().$query_rsUTF8);
}


/**
 * Almacenar auditoria
 *
 *  @author     Alejandro Rodriguez <www.alejandrorodriguez.info>
 *  @version    1.0.0   
 *  @created	-
 *  @updated	30/05/2008 19:16
 *
 * @param   int		ID del Usuario
 * @param   strint	Acceso
 * @param   int		rubroID
 * @param   int		subrubroID
 * @param   int		marcaID
 * @param   string 	detalle
 *
 * @return  nothing 
 * @access  public
 **/   
function smrAuditar( $usuarioID, $acceso, $rubroID, $subrubroID, $marcaID, $detalle)  {
	global $database_cnx, $cnx;
	require_once('../Connections/cnx.php');	
	$insertSQL = sprintf("INSERT INTO auditorias (usuarioID, acceso, rubroID, subrubroID, marcaID, detalle) VALUES (%s,%s, %s, %s, %s, %s)",
                       SMRGetSQLValueString($usuarioID, "int"),
                       SMRGetSQLValueString($acceso, "text"),
                       SMRGetSQLValueString($rubroID, "int") ,
                       SMRGetSQLValueString($subrubroID, "int"),
                       SMRGetSQLValueString($marcaID, "int"),
                        SMRGetSQLValueString($detalle, "text")
                       );

	mysql_select_db($database_cnx, $cnx);
	$Result1 = mysql_query($insertSQL, $cnx) or die(mysql_error());
}


/**
 * Extraer un registro aleatorio de uan tabla.
 *
 *  @author     Alejandro Rodriguez <www.alejandrorodriguez.info>
 *  @version    1.0.0   
 *  @created	-
 *  @updated	30/05/2008 19:16
 *
 * @param	string	nombre de la tabla	
 * @param	string	sql	 
 * @param	string	filtro sql
 *
 * @return 	array  matriz asociativa del registro
 **/  
function smrRegistroAleatorio( $tabla, $sql, $filtro="" ) {
	global $database_cnx, $cnx;
	
	mysql_select_db($database_cnx, $cnx);
	$query_rs = sprintf( "SELECT count(*) as cantidad FROM %s %s", $tabla, $filtro );
	$rs = mysql_query($query_rs, $cnx) or die(mysql_error()."::".$query_rs);
	$row_rs = mysql_fetch_assoc($rs);
	$totalRows_rs = mysql_num_rows($rs);
	
	$elegido=rand( 0, $row_rs['cantidad']-1 ) ;

	mysql_free_result($rs);
	
	mysql_select_db($database_cnx, $cnx);
	$query_rs = $sql." ".$filtro." limit  ".$elegido.",1";
	$rs = mysql_query($query_rs, $cnx) or die(mysql_error()."::".$query_rs );
	$row_rs= mysql_fetch_assoc($rs);
	mysql_free_result($rs);

	return(	$row_rs );		
}


/**
 * Buscar campos descripcion de un ID
 *
 *  @author     Alejandro Rodriguez <www.alejandrorodriguez.info>
 *  @version    1.0.0   
 *  @created	-
 *  @updated	30/05/2008 19:16
 *
 * @param	string	campo de la tabla 
 * @param	string	nombre de la tabla
 * @param	string	nombre del campo clave 
 * @param	int		valor del campo clave a buscar
 * @return 	string	Descripción
 **/  
function smrBuscaDescripcion( $campo, $tabla, $campoID, $ID) {
	global $database_cnx, $cnx;
	
	mysql_select_db($database_cnx, $cnx);
	$query_rs = sprintf( "SELECT %s FROM %s where %s=%s",  $campo, $tabla, $campoID, $ID);
	$rs = mysql_query($query_rs, $cnx) or die(mysql_error());
	$row_rs= mysql_fetch_assoc($rs);
	$totalRows_rs = mysql_num_rows($rs);
	mysql_free_result($rs);
	return( ($totalRows_rs!=0)?$row_rs[ $campo]:"DESCONOCIDO!" );
} 


/**********************************************************
                          UPLOAD
***********************************************************/
/**
 * Upload de Imagenes con UPDATE de registro soporta Resize y Crop de imagen
 * Utilizada para casos donde a partir  de una foto se deben generar 3 
 *
 *  @author     Alejandro Rodriguez <www.alejandrorodriguez.info>
 *  @version    1.0.0   
 *  @created	-
 *  @updated	30/05/2008 19:16
 *
 * @param	string	nombre del campo de formulario que contiene la imagen a procesar
 * @param	string	nombre del campo de formulario que contiene el nombre  de la imagen actual
 * @param	string	directorio destino
 * @param	string	prefijo para las imagenes
 * @param	string	directorio de imagenes grandes
 * @param	int	medida de la imagen grande ancho
 * @param	int	medida de la imagen grande alto
 * @param	string	directorio de imagenes medianas
 * @param	int	medida de la imagen medianas ancho
 * @param	int	medida de la imagen medianas alto
 * @param	string	directorio de imagenes pequeñas
 * @param	int	medida de la imagen pequeña ancho
 * @param	int	medida de la imagen pequeña alto
 * @param	string	nombre de la tabla
 * @param	string	nombre del campo de la tabla
 * @param	string	nombre del campo clave   
 *
 * @return 	string	nombre del archivo destino
 **/  

function smrUpload3ImagesUpdateWC( $formCampo, $formCampo_ori, $destino, $prefijo , $dir1, $dir1_w, $dir1_h, $dir2="", $dir2_w=0, $dir2_h=0, $dir3="", $dir3_w=0, $dir3_h=0, $tabla, $tblCampo, $tblPKey ) {

/* Upload { */	
		$upl_archivo_final=$_POST[$formCampo_ori];
		$upl_ID=$_POST[$tblPKey];	# Capturo Ultimo ID ingresado
		$upl_campo=$formCampo; # <caratula> puede variar pues debe ser el nombre del campo.
		$upl_archivo=$_FILES[$upl_campo];	# Capturo File del Form
		if ($upl_archivo["name"]!="" ) {		# Subir Archivo				
			$upl_directorio=$dir1;	#  Esta ruta puede variar para cada archivo

			if ( $dir1_w != 0 ) {
				@unlink($destino.$dir1.$upl_archivo_final); # Borro Archivo anterior.						
			} 
			if ( $dir2_w != 0 ) {
				@unlink($destino.$dir2.$upl_archivo_final); # Borro Archivo anterior.						
			} 		
			if ( $dir3_w != 0 ) {
				@unlink($destino.$dir3.$upl_archivo_final); # Borro Archivo anterior.						
			} 			
			// @unlink($destino.$upl_GR.$upl_archivo_final); # Borro Archivo anterior.		
			
			
			/* Control de Extensión { */	
			$upl_punto=strrpos( $upl_archivo["name"], "." );	
			$upl_extension=strtolower( substr($upl_archivo["name"], $upl_punto ) );
			$upl_tipos_permitidos=array( ".jpg", ".gif",".png");
			if ( !in_array( strtolower( $upl_extension ), $upl_tipos_permitidos ) ) {
				die("Incorrect Extension File! ".$upl_extension );
			} /* End Control de Extensión  } */			
			
			$upl_archivo_final= $prefijo.$upl_ID.$upl_extension ;	# Genero nuevo nombre de Archivo		
			$upl_destino=$destino.$dir1.$upl_archivo_final;		# Ruta destino del archivo a subir			
			copy($upl_archivo["tmp_name"],$upl_destino);	# Copio el archivo a la carpeta destino	
								
			if ( $dir1_w != 0 ) {
				resize_then_crop( $upl_destino,
					$destino.$dir1.$upl_archivo_final,
					$dir1_w,
					$dir1_h,"255","255","255"); 
				// smrSaveThumbnail($upl_directorio.$upl_CH, $upl_directorio.$upl_GR, $upl_archivo_final, $upl_CH_size) ;	# Imagen pequeña
			}
			if ( $dir2_w != 0 ) {
				resize_then_crop( $upl_destino,
							$destino.$dir2.$upl_archivo_final,
							$dir2_w,
							$dir2_h,"255","255","255"); 
				// smrSaveThumbnail($upl_directorio.$upl_GR, $upl_directorio.$upl_GR, $upl_archivo_final, $upl_GR_size) ;			
			} 	
			if ( $dir3_w != 0 ) {
				resize_then_crop( $upl_destino,
							$destino.$dir3.$upl_archivo_final,
							$dir3_w,
							$dir3_h,"255","255","255"); 
				// smrSaveThumbnail($upl_directorio.$upl_GR, $upl_directorio.$upl_GR, $upl_archivo_final, $upl_GR_size) ;			
			} 	}
			
		return($upl_archivo_final) ;
}


/**
 * Upload de Imagenes para INSERT soporta Resize y Crop de imagen 
 * Utilizada para casos donde a partir  de una foto se deben generar 3 
 *
 *  @author     Alejandro Rodriguez <www.alejandrorodriguez.info>
 *  @version    1.0.0   
 *  @created	-
 *  @updated	30/05/2008 19:16
 *
 * @param	string	nombre del campo de formulario que contiene la imagen a procesar
 * @param	string	directorio destino
 * @param	string	prefijo para las imagenes
 * @param	string	directorio de imagenes grandes
 * @param	int	medida de la imagen grande ancho
 * @param	int	medida de la imagen grande alto
 * @param	string	directorio de imagenes medianas
 * @param	int	medida de la imagen medianas ancho
 * @param	int	medida de la imagen medianas alto
 * @param	string	directorio de imagenes pequeñas
 * @param	int	medida de la imagen pequeña ancho
 * @param	int	medida de la imagen pequeña alto
 * @param	string	nombre de la tabla
 * @param	string	nombre del campo de la tabla
 * @param	string	nombre del campo clave  
 * @param	int	valor campo clave
 *
 * @return 	string	nombre del archivo destino
 **/  
function smrUpload3ImagesWC( $formCampo, $destino, $prefijo , $dir1, $dir1_w, $dir1_h, $dir2="", $dir2_w=0, $dir2_h=0, $dir3="", $dir3_w=0, $dir3_h=0, $tabla, $tblCampo, $tblPKey, $PKey="-1" ) {
	global $database_cnx, $cnx;
	// Nucleo -----------------------------------------------------------------------------------
	if ($PKey=="-1") $PKey=mysql_insert_id(); 	# Capturo Ultimo ID ingresado
	$upl_archivo=$_FILES[$formCampo];		# Capturo File del Form
	$resultado="-1";
	if ($upl_archivo["name"]!="" ) {		# Subir Archivo
		# controlo la extension
		$upl_punto=strrpos( $upl_archivo["name"], "." );
		$upl_extension=strtolower( substr($upl_archivo["name"], $upl_punto ) );
		$upl_tipos_permitidos=array( ".jpg", ".gif",".png");
		if ( !in_array( strtolower( $upl_extension ), $upl_tipos_permitidos ) ) {
			die("Incorrect Extension File! ".$upl_extension );
		}
		$upl_archivo_final=$prefijo.$PKey.$upl_extension ;	# Genero nuevo nombre de Archivo
		$upl_destino=$destino.$dir1.$upl_archivo_final;		# Ruta destino del archivo a subir
		copy($upl_archivo["tmp_name"],$upl_destino);	# Copio el archivo a la carpeta destino
						
		if ( $dir1_w != 0 ) resize_then_crop( $upl_destino,
							$destino.$dir1.$upl_archivo_final,
							$dir1_w,
							$dir1_h,"255","255","255"); 
				
		if ( $dir2_w != 0 ) resize_then_crop( $upl_destino,
							$destino.$dir2.$upl_archivo_final,
							$dir2_w,
							$dir2_h,"255","255","255"); 
							
		if ( $dir3_w != 0 ) resize_then_crop( $upl_destino,
							$destino.$dir3.$upl_archivo_final,
							$dir3_w,
							$dir3_h,"255","255","255"); 							
	
		if ($tabla!="") {
				$updateSQL = sprintf("UPDATE %s set %s=%s where %s=%s",
						   $tabla,
						   $tblCampo,
						   GetSQLValueString($upl_archivo_final, "text"),							   
						   $tblPKey,
						   GetSQLValueString($PKey, "int"));
	
			mysql_select_db($database_cnx, $cnx);
			$Result1 = mysql_query($updateSQL, $cnx) or die(mysql_error());
		}
		$resultado=$upl_archivo_final;
	}
	return($resultado);
}


/**
 * Upload de Imagenes para  insert de registro
 *
 *  @author     Alejandro Rodriguez <www.alejandrorodriguez.info>
 *  @version    1.0.0   
 *  @created	-
 *  @updated	30/05/2008 19:16
 *
 * @param	string	nombre del campo de formulario
 * @param	string	directorio destino
 * @param	string	prefijo para las imagenes
 * @param	string	nombre de la tabla
 * @param	string	nombre del campo clave  
 * @param	int		valor campo clave ^
 *    
 * @return 	string	nombre del archivo destino
 **/  
function smrUploadFilesUpdate( $upl_campo_form, $upl_campo_ori_form, $upl_directorio, $upl_prefijo , $upl_tabla, $upl_campo_table, $upl_key ) {
	global $database_cnx, $cnx;
	// Nucleo -----------------------------------------------------------------------------------
	$upl_archivo_final=$_POST[$upl_campo_ori_form];
	$upl_ID=$_POST[$upl_key];	# Capturo Ultimo ID ingresado
	$upl_archivo=$_FILES[$upl_campo_form];	# Capturo File del Form
	if ($upl_archivo["name"]!="" ) {		# Subir Archivo
		@unlink($upl_directorio.$upl_archivo_final); # Borro Archivo anterior.	
		# controlo la extension
		$upl_punto=strrpos( $upl_archivo["name"], "." );
		$upl_extension=strtolower( substr($upl_archivo["name"], $upl_punto ) );
		$upl_archivo_final=$upl_prefijo.$upl_ID.$upl_extension ;	# Genero nuevo nombre de Archivo
		$upl_destino=$upl_directorio.$upl_archivo_final;		# Ruta destino del archivo a subir
		copy($upl_archivo["tmp_name"],$upl_destino);	# Copio el archivo a la carpeta destino
		if ($upl_tabla!="") {
				$updateSQL = sprintf("UPDATE %s set %s=%s where %s=%s",
						   $upl_tabla,
						   $upl_campo_table,
						   GetSQLValueString($upl_archivo_final, "text"),							   
						   $upl_key,
						   GetSQLValueString($upl_ID, "int"));
	
			mysql_select_db($database_cnx, $cnx);
			$Result1 = mysql_query($updateSQL, $cnx) or die(mysql_error());
		}
	}
	return($upl_archivo_final) ;
}


/**
 * Upload de archivos
 *
 *  @author     Alejandro Rodriguez <www.alejandrorodriguez.info>
 *  @version    1.0.0   
 *  @created	-
 *  @updated	30/05/2008 19:16
 *
 * @param	string	campo de la tabla 
 * @param	string	directorio destino
 * @param	string	nombre del archivo destino
 *
 * @return 	string	nombre del archivo destino
 **/  
function smrUploadArchivos( $upl_campo_form, $upl_directorio, $upl_nombre="" ) { 
// , $upl_prefijo , $upl_GR, $upl_GR_size, $upl_CH="", $upl_CH_size=0, $upl_tabla, $upl_campo_table, $upl_key, $upl_ID="-1" ) {
		$upl_archivo=$_FILES[$upl_campo_form];	# Capturo File del Form
		if ($upl_archivo["name"]!="" ) {		# Subir Archivo
			# controlo la extension
			$upl_punto=strrpos( $upl_archivo["name"], "." );
			$upl_extension=strtolower( substr($upl_archivo["name"], $upl_punto ) );
			$upl_tipos_permitidos=array( ".jpg", ".gif",".png", ".pdf", ".doc", ".ppt");
			if ( !in_array( strtolower( $upl_extension ), $upl_tipos_permitidos ) ) {
				die("Incorrect Extension File! ".$upl_extension );
			}
			if ($upl_nombre!="") { 
				$upl_archivo_final=  urls_amigables($upl_nombre).$upl_extension ;
			} else  {
				$upl_archivo_final=$upl_prefijo.$upl_ID.$upl_extension ;	# Genero nuevo nombre de Archivo
			}				

			$upl_destino=$upl_directorio.$upl_archivo_final;		# Ruta destino del archivo a subir
			copy($upl_archivo["tmp_name"],$upl_destino);	# Copio el archivo a la carpeta destino
		}
		return ($upl_archivo_final) ;
} 



/**
 * Upload de Imagenes para  update de registro
 *
 *  @author     Alejandro Rodriguez <www.alejandrorodriguez.info>
 *  @version    1.0.0   
 *  @created	-
 *  @updated	30/05/2008 19:16
 *
 * @param	string	nombre del campo de formulario
 * @param	string	nombre del campo original  de formulario 
 * @param	string	directorio destino
 * @param	string	prefijo para las imagenes
 * @param	string	directorio de imagenes grandes
 * @param	int		medida de la imagen grande 
 * @param	string	directorio de imagenes pequeñas
 * @param	int		medida de la imagen pequeña
 * @param	string	nombre de la tabla
 * @param	string	nombre del campo de la tabla
 * @param	string	nombre del campo clave  
 *
 * @return 	string	nombre del archivo destino
 **/  
function smrUploadImagesUpdate( $upl_campo_form, $upl_campo_form_ori,  $upl_directorio, $upl_prefijo , $upl_GR, $upl_GR_size, $upl_CH="", $upl_CH_size=0, $upl_tabla, $upl_campo_table, $upl_key ) {
/* Upload { */	
		$upl_archivo_final=$_POST[$upl_campo_form_ori];
		$upl_ID=$_POST[$upl_key];	# Capturo Ultimo ID ingresado
		$upl_campo=$upl_campo_form; # <caratula> puede variar pues debe ser el nombre del campo.
		$upl_archivo=$_FILES[$upl_campo];	# Capturo File del Form
		if ($upl_archivo["name"]!="" ) {		# Subir Archivo				
			$upl_directorio=$upl_directorio;	#  Esta ruta puede variar para cada archivo

			if ( $upl_CH_size != 0 ) {
				@unlink($upl_directorio.$upl_CH.$upl_archivo_final); # Borro Archivo anterior.						
			} 
			@unlink($upl_directorio.$upl_GR.$upl_archivo_final); # Borro Archivo anterior.		
			
			
			/* Control de Extensión { */	
			$upl_punto=strrpos( $upl_archivo["name"], "." );	
			$upl_extension=strtolower( substr($upl_archivo["name"], $upl_punto ) );
			$upl_tipos_permitidos=array( ".jpg", ".gif",".png");
			if ( !in_array( strtolower( $upl_extension ), $upl_tipos_permitidos ) ) {
				die("Incorrect Extension File! ".$upl_extension );
			} /* End Control de Extensión  } */			
			
			$upl_archivo_final= $upl_prefijo.$upl_ID.$upl_extension ;	# Genero nuevo nombre de Archivo		
			$upl_destino=$upl_directorio.$upl_GR.$upl_archivo_final;		# Ruta destino del archivo a subir			
			copy($upl_archivo["tmp_name"],$upl_destino);	# Copio el archivo a la carpeta destino						
			if ( $upl_CH_size != 0 ) {
				smrSaveThumbnail($upl_directorio.$upl_CH, $upl_directorio.$upl_GR, $upl_archivo_final, $upl_CH_size) ;	# Imagen pequeña
			}
			if ( $upl_GR_size != 0 ) {
				smrSaveThumbnail($upl_directorio.$upl_GR, $upl_directorio.$upl_GR, $upl_archivo_final, $upl_GR_size) ;			
			} 		}
		return($upl_archivo_final) ;
/* End Upload } */
}


/**
 * Upload de Imagenes para  insert de registro
 *
 *  @author     Alejandro Rodriguez <www.alejandrorodriguez.info>
 *  @version    1.0.0   
 *  @created	-
 *  @updated	30/05/2008 19:16
 *
 * @param	string	nombre del campo de formulario
 * @param	string	directorio destino
 * @param	string	prefijo para las imagenes
 * @param	string	directorio de imagenes grandes
 * @param	int		medida de la imagen grande 
 * @param	string	directorio de imagenes pequeñas
 * @param	int		medida de la imagen pequeña
 * @param	string	nombre de la tabla
 * @param	string	nombre del campo de la tabla
 * @param	string	nombre del campo clave  
 * @param	int		valor campo clave   
 *
 * @return 	string	nombre del archivo destino
 **/  
 // resize_then_crop( $filein,$fileout,$imagethumbsize_w,$imagethumbsize_h,$red,$green,$blue)
function smrUploadImages( $upl_campo_form, $upl_directorio, $upl_prefijo , $upl_GR, $upl_GR_size, $upl_CH="", $upl_CH_size=0, $upl_tabla, $upl_campo_table, $upl_key, $upl_ID="-1" ) {
		global $database_cnx, $cnx;
		// Parametros
		/*
		$upl_campo_form		="banner";	# <caratula> puede variar pues debe ser el nombre del campo.
		$upl_campo_table	="banner";	# <caratula> puede variar pues debe ser el nombre del campo.		
		$upl_directorio		="../assets/contenidos/";	#  Esta ruta puede variar para cada archivo
		$upl_prefijo		=$upl_campo."_";
		$upl_GR=""; $upl_GR_size=120;	# Si es solo una medida usar este 
		$upl_CH=""; $upl_CH_size=0; 	# Si es solo una medida poner 0 en ambos valores
		$upl_key			= "bannerID";
		$upl_tabla			="galerias";
		*/
		// Nucleo -----------------------------------------------------------------------------------
		if ($upl_ID=="-1") { 
			$upl_ID=mysql_insert_id();	# Capturo Ultimo ID ingresado
		} 
		
		$upl_archivo=$_FILES[$upl_campo_form];	# Capturo File del Form
		if ($upl_archivo["name"]!="" ) {		# Subir Archivo
			# controlo la extension
			$upl_punto=strrpos( $upl_archivo["name"], "." );
			$upl_extension=strtolower( substr($upl_archivo["name"], $upl_punto ) );
			$upl_tipos_permitidos=array( ".jpg", ".gif",".png");
			if ( !in_array( strtolower( $upl_extension ), $upl_tipos_permitidos ) ) {
				die("Incorrect Extension File! ".$upl_extension );
			}
			$upl_archivo_final=$upl_prefijo.$upl_ID.$upl_extension ;	# Genero nuevo nombre de Archivo
			$upl_destino=$upl_directorio.$upl_GR.$upl_archivo_final;		# Ruta destino del archivo a subir
			copy($upl_archivo["tmp_name"],$upl_destino);	# Copio el archivo a la carpeta destino
			if ( $upl_CH_size != 0 ) {
				smrSaveThumbnail($upl_directorio.$upl_CH, $upl_directorio.$upl_GR, $upl_archivo_final, $upl_CH_size) ;	# Imagen pequeña
			}
			smrSaveThumbnail($upl_directorio.$upl_GR, $upl_directorio.$upl_GR, $upl_archivo_final, $upl_GR_size) ;			

			if ($upl_tabla!="") {
					$updateSQL = sprintf("UPDATE %s set %s=%s where %s=%s",
							   $upl_tabla,
							   $upl_campo_table,
							   GetSQLValueString($upl_archivo_final, "text"),							   
							   $upl_key,
							   GetSQLValueString($upl_ID, "int"));

				mysql_select_db($database_cnx, $cnx);
				$Result1 = mysql_query($updateSQL, $cnx) or die(mysql_error());
			}
		}
}

/**
 * Upload de Imagenes para  insert de registro con Resize y Crop de imagen
 *
 *  @author     Alejandro Rodriguez <www.alejandrorodriguez.info>
 *  @version    1.0.0   
 *  @created	-
 *  @updated	30/05/2008 19:16
 *
 * @param	string	nombre del campo de formulario
 * @param	string	directorio destino
 * @param	string	prefijo para las imagenes
 * @param	string	directorio de imagenes grandes
 * @param	int		medida de la imagen grande ancho
 * @param	int		medida de la imagen grande alto
 * @param	string	directorio de imagenes pequeñas
 * @param	int		medida de la imagen pequeña ancho
 * @param	int		medida de la imagen pequeña alto
 * @param	string	nombre de la tabla
 * @param	string	nombre del campo de la tabla
 * @param	string	nombre del campo clave  
 * @param	int		valor campo clave  
 * 
 * @return 	string	nombre del archivo destino
 **/  
function smrUploadImagesWC( $formCampo, $destino, $prefijo , $dir1, $dir1_w, $dir1_h, $dir2="", $dir2_w=0, $dir2_h=0, $tabla, $tblCampo, $tblPKey, $PKey="-1" ) {
	global $database_cnx, $cnx;
	// Nucleo -----------------------------------------------------------------------------------
	if ($PKey=="-1") $PKey=mysql_insert_id(); 	# Capturo Ultimo ID ingresado
	$upl_archivo=$_FILES[$formCampo];		# Capturo File del Form
	$resultado="-1";
	if ($upl_archivo["name"]!="" ) {		# Subir Archivo
		# controlo la extension
		$upl_punto=strrpos( $upl_archivo["name"], "." );
		$upl_extension=strtolower( substr($upl_archivo["name"], $upl_punto ) );
		$upl_tipos_permitidos=array( ".jpg", ".gif",".png");
		if ( !in_array( strtolower( $upl_extension ), $upl_tipos_permitidos ) ) {
			die("Incorrect Extension File! ".$upl_extension );
		}
		$upl_archivo_final=$prefijo.$PKey.$upl_extension ;	# Genero nuevo nombre de Archivo
		$upl_destino=$destino.$dir1.$upl_archivo_final;		# Ruta destino del archivo a subir
		copy($upl_archivo["tmp_name"],$upl_destino);	# Copio el archivo a la carpeta destino
		
		// ( $filein,$fileout,$imagethumbsize_w,$imagethumbsize_h,$red,$green,$blue)
		
		if ( $dir1_w != 0 ) resize_then_crop( $upl_destino,
							$destino.$dir1.$upl_archivo_final,
							$dir1_w,
							$dir1_h,"255","255","255"); 
				
		if ( $dir2_w != 0 ) resize_then_crop( $upl_destino,
							$destino.$dir2.$upl_archivo_final,
							$dir2_w,
							$dir2_h,"255","255","255"); 
	
		if ($tabla!="") {
				$updateSQL = sprintf("UPDATE %s set %s=%s where %s=%s",
						   $tabla,
						   $tblCampo,
						   GetSQLValueString($upl_archivo_final, "text"),							   
						   $tblPKey,
						   GetSQLValueString($PKey, "int"));
	
			mysql_select_db($database_cnx, $cnx);
			$Result1 = mysql_query($updateSQL, $cnx) or die(mysql_error());
		}
		$resultado=$upl_archivo_final;
	}
	return($resultado);
}


/**
 * Upload de Imagenes para  update de registro con Resize y Crop de imagen
 *
 *  @author     Alejandro Rodriguez <www.alejandrorodriguez.info>
 *  @version    1.0.0   
 *  @created	-
 *  @updated	30/05/2008 19:16
 *
 * @param	string	nombre del campo de formulario
 * @param	string	nombre del campo de formulario que contiene el nombre original
 * @param	string	directorio destino
 * @param	string	prefijo para las imagenes
 * @param	string	directorio de imagenes grandes
 * @param	int		medida de la imagen grande ancho
 * @param	int		medida de la imagen grande alto
 * @param	string	directorio de imagenes pequeñas
 * @param	int		medida de la imagen pequeña ancho
 * @param	int		medida de la imagen pequeña alto
 * @param	string	nombre de la tabla
 * @param	string	nombre del campo de la tabla
 * @param	string	nombre del campo clave  
 * @param	int		valor campo clave  
 * 
 * @return 	string	nombre del archivo destino
 **/  
function smrUploadImagesUpdateWC( $formCampo, $formCampo_ori, $destino, $prefijo , $dir1, $dir1_w, $dir1_h, $dir2="", $dir2_w=0, $dir2_h=0, $tabla, $tblCampo, $tblPKey ) {

/* Upload { */	
		$upl_archivo_final=$_POST[$formCampo_ori];
		$upl_ID=$_POST[$tblPKey];	# Capturo Ultimo ID ingresado
		$upl_campo=$formCampo; # <caratula> puede variar pues debe ser el nombre del campo.
		$upl_archivo=$_FILES[$upl_campo];	# Capturo File del Form
		if ($upl_archivo["name"]!="" ) {		# Subir Archivo				
			$upl_directorio=$dir1;	#  Esta ruta puede variar para cada archivo

			if ( $dir1_w != 0 ) {
				@unlink($destino.$dir1.$upl_archivo_final); # Borro Archivo anterior.						
			} 
			if ( $dir2_w != 0 ) {
				@unlink($destino.$dir2.$upl_archivo_final); # Borro Archivo anterior.						
			} 			
			// @unlink($destino.$upl_GR.$upl_archivo_final); # Borro Archivo anterior.		
			
			
			/* Control de Extensión { */	
			$upl_punto=strrpos( $upl_archivo["name"], "." );	
			$upl_extension=strtolower( substr($upl_archivo["name"], $upl_punto ) );
			$upl_tipos_permitidos=array( ".jpg", ".gif",".png");
			if ( !in_array( strtolower( $upl_extension ), $upl_tipos_permitidos ) ) {
				die("Incorrect Extension File! ".$upl_extension );
			} /* End Control de Extensión  } */			
			
			$upl_archivo_final= $prefijo.$upl_ID.$upl_extension ;	# Genero nuevo nombre de Archivo		
			$upl_destino=$destino.$dir1.$upl_archivo_final;		# Ruta destino del archivo a subir			
			copy($upl_archivo["tmp_name"],$upl_destino);	# Copio el archivo a la carpeta destino	
								
			if ( $dir1_w != 0 ) {
				resize_then_crop( $upl_destino,
					$destino.$dir1.$upl_archivo_final,
					$dir1_w,
					$dir1_h,"255","255","255"); 
				// smrSaveThumbnail($upl_directorio.$upl_CH, $upl_directorio.$upl_GR, $upl_archivo_final, $upl_CH_size) ;	# Imagen pequeña
			}
			if ( $dir2_w != 0 ) {
				resize_then_crop( $upl_destino,
							$destino.$dir2.$upl_archivo_final,
							$dir2_w,
							$dir2_h,"255","255","255"); 
				// smrSaveThumbnail($upl_directorio.$upl_GR, $upl_directorio.$upl_GR, $upl_archivo_final, $upl_GR_size) ;			
			} 		}
			
		return($upl_archivo_final) ;
/* End Upload } */
}

/**
 * Upload de Imagenes para  insert de registro
 *
 *  @author     Alejandro Rodriguez <www.alejandrorodriguez.info>
 *  @version    1.0.0   
 *  @created	-
 *  @updated	30/05/2008 19:16
 *
 * @param	string	nombre del campo de formulario
 * @param	string	directorio destino
 * @param	string	prefijo para las imagenes
 * @param	string	nombre de la tabla
 * @param	string	nombre del campo clave  
 * @param	int		valor campo clave  
 *   
 * @return 	string	nombre del archivo destino
 **/  
function smrUploadFiles( $upl_campo_form, $upl_directorio, $upl_prefijo , $upl_tabla, $upl_campo_table, $upl_key, $upl_ID="-1" ) {
	global $database_cnx, $cnx;
	// Nucleo -----------------------------------------------------------------------------------
	if ($upl_ID=="-1") { 
		$upl_ID=mysql_insert_id();	# Capturo Ultimo ID ingresado
	} 
	$upl_archivo=$_FILES[$upl_campo_form];	# Capturo File del Form
	$upl_archivo_final="-1";
	if ($upl_archivo["name"]!="" ) {		# Subir Archivo
		# controlo la extension
		$upl_punto=strrpos( $upl_archivo["name"], "." );
		$upl_extension=strtolower( substr($upl_archivo["name"], $upl_punto ) );
/*
		$upl_tipos_permitidos=array( ".jpg", ".gif",".png");
		if ( !in_array( strtolower( $upl_extension ), $upl_tipos_permitidos ) ) {	
			die("Incorrect Extension File! ".$upl_extension );
		}
*/		
		$upl_archivo_final=$upl_prefijo.$upl_ID.$upl_extension ;	# Genero nuevo nombre de Archivo
		$upl_destino=$upl_directorio.$upl_archivo_final;		# Ruta destino del archivo a subir
		copy($upl_archivo["tmp_name"],$upl_destino);	# Copio el archivo a la carpeta destino
		if ($upl_tabla!="") {
				$updateSQL = sprintf("UPDATE %s set %s=%s where %s=%s",
						   $upl_tabla,
						   $upl_campo_table,
						   GetSQLValueString($upl_archivo_final, "text"),							   
						   $upl_key,
						   GetSQLValueString($upl_ID, "int"));
	
			mysql_select_db($database_cnx, $cnx);
			$Result1 = mysql_query($updateSQL, $cnx) or die(mysql_error());
		}
	}
	return($upl_archivo_final) ;
}


/***********************************************************************
 * IMAGES
 ***********************************************************************/


/**
 * Generar  Thumb con resize y crop
 * @author  Alan Reddan Silverarm Solutions
 * @date    27/01/2005
 * Function that works well with images.
 * It takes the image and reduces its size to best fit. i.e If you have an image
 * that is 200 X 100 and you want a thumbnail of 75 X 50,
 * it first resizes the image to 100 X 50
 * and then takes out a portion 75 X 50 from then center of the input image.
 * So loads of image information is retained.
 * The corollary also holds if your input image is 100 X 200
 * it first resizes image to 75 X 150 and then takes out a
 * portion 75 X 75 from the centre
 * The advantage here is that function decides on whether
 * resize is by width or height itself.
 * it also decides whether to use the height or the width as the base start point
 * in the case that athumbnail is rectangular
 *
 * <code>
 *	resize_then_crop( "imagen.jpg","destino,jpg",327, 327,"255","255","255");
 * </code>
 * @param	string	nombre del archivo origen 
 * @param	string	nombre del archivo destino
 * @param	int		ancho thumb
 * @param	int		alto thumb
 * @param	string	rojo
 * @param	string	verde
 * @param	string	azul 
 **/  
function resize_then_crop( $filein,$fileout,$imagethumbsize_w,$imagethumbsize_h,$red,$green,$blue) {
	// Get new dimensions
	$percent=100;
	$white="";
	list($width, $height) = getimagesize($filein);
	$new_width = $width * $percent;
	$new_height = $height * $percent;

	$upl_punto=strrpos( $filein, "." );	
	$upl_extension=strtolower( substr($filein, $upl_punto ) );
	$upl_tipos_permitidos=array( ".jpg", ".gif",".png");
	switch ($upl_extension) {
		case ".jpg":
			 $format = 'image/jpeg';
			break;
		case ".gif":
			$format = 'image/gif';
			break;
		case ".png":
			$format = 'image/png';		
			break;				
	}
	/*	
	   if(preg_match("/.jpg/i", "$filein"))
	   {
	       $format = 'image/jpeg';
	   }
	   if (preg_match("/.gif/i", "$filein"))
	   {
	       $format = 'image/gif';
	   }
	   if(preg_match("/.png/i", "$filein"))
	   {
	       $format = 'image/png';
	   }
	*/  
	switch($format)
	{
	   case 'image/jpeg':
	   $image = imagecreatefromjpeg($filein);
	   $extension=".JPG";
	   break;
	   case 'image/gif';
	   $image = imagecreatefromgif($filein);
	   $extension=".GIF";
	   break;
	   case 'image/png':
	   $image = imagecreatefrompng($filein);
	   $extension=".PNG";
	   break;
	}

	$width = $imagethumbsize_w ;
	$height = $imagethumbsize_h ;
	list($width_orig, $height_orig) = getimagesize($filein);
	
	if ($width_orig < $height_orig) {
	  $height = ($imagethumbsize_w / $width_orig) * $height_orig;
	} else {
	   $width = ($imagethumbsize_h / $height_orig) * $width_orig;
	}
	
	if ($width < $imagethumbsize_w)
	//if the width is smaller than supplied thumbnail size
	{
	$width = $imagethumbsize_w;
	$height = ($imagethumbsize_w/ $width_orig) * $height_orig;;
	}
	
	if ($height < $imagethumbsize_h)
	//if the height is smaller than supplied thumbnail size
	{
	$height = $imagethumbsize_h;
	$width = ($imagethumbsize_h / $height_orig) * $width_orig;
	}
	
	$thumb = imagecreatetruecolor($width , $height); 
	$bgcolor = imagecolorallocate($thumb, $red, $green, $blue); 
	ImageFilledRectangle($thumb, 0, 0, $width, $height, $bgcolor);
	imagealphablending($thumb, true);
	
	imagecopyresampled($thumb, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
	$thumb2 = imagecreatetruecolor($imagethumbsize_w , $imagethumbsize_h);
	// true color for best quality
	$bgcolor = imagecolorallocate($thumb2, $red, $green, $blue); 
	@ImageFilledRectangle($thumb2, 0, 0, $imagethumbsize_w , $imagethumbsize_h , $white);
	imagealphablending($thumb2, true);
	
	$w1 =($width/2) - ($imagethumbsize_w/2);
	$h1 = ($height/2) - ($imagethumbsize_h/2);
	
	imagecopyresampled($thumb2, $thumb, 0,0, $w1, $h1, $imagethumbsize_w , $imagethumbsize_h ,$imagethumbsize_w, $imagethumbsize_h);
	
	if ($extension  == ".JPG" ) { imagejpeg($thumb2,$fileout,100); }
	if ($extension  == ".GIF" ) { imagegif($thumb2,$fileout); }
	if ($extension  == ".PNG" ) { imagepng($thumb2,$fileout); }	
		
	// Output
	//header('Content-type: image/gif');
	//imagegif($thumb); //output to browser first image when testing
	/*
	if ($fileout !="")imagegif($thumb2, $fileout); //write to file
	header('Content-type: image/gif');
	imagegif($thumb2); //output to browser
	*/
}


/**
 * Definir si es o no un JPG
 *
 *  @author     Alejandro Rodriguez <www.alejandrorodriguez.info>
 *  @version    1.0.0   
 *  @created	-
 *  @updated	30/05/2008 19:16
 *  
 * @param	string		Nombre del archivo
 *
 * @return	bool	Es o no es.
 **/  
function smrJPG( $quien ) {
	$retornar=true;
	$punto=strrpos( $quien, "." );
	$extension=substr($quien, $punto );
	if ( $extension !=".jpg" && $extension !=".JPG" ) {
		$retornar=false;
	}
	return( $retornar );
}

/**
 * Definir si es o no un JPG ó GIF
 *
 *  @author     Alejandro Rodriguez <www.alejandrorodriguez.info>
 *  @version    1.0.0   
 *  @created	-
 *  @updated	30/05/2008 19:16
 *
 * @param	string		Nombre del archivo
 *
 * @return	bool	Es o no es.
 **/  
function smrGIFoJPG( $quien ) {
	$retornar=true;
	$punto=strrpos( $quien, "." );
	$extension=substr($quien, $punto );
	if ( $extension !=".jpg" && $extension !=".JPG"  && $extension !=".gif"  && $extension !=".GIF") {
		$retornar=false;
	}
	return( $retornar );
}


/**
 * Crea una miniatura de un archivo y lo graba.
 *
 *  @author     Alejandro Rodriguez <www.alejandrorodriguez.info>
 *  @version    1.0.0   
 *  @created	-
 *  @updated	30/05/2008 19:16
 *
 * @param	string		Directorio destino
 * @param	string		Directorio de la imagen original
 * @param	string		Nombre de la imagen original 
 * @param	int			Ancho en pixeles de la miniatura
 **/  
function smrSaveThumbnail($saveToDir, $imagePath, $imageName, $ancho) {
	$punto=strrpos( $imageName, "." );
	$extension=strtoupper( substr($imageName, $punto ) ) ;
	
	$thumbsize=$ancho;
	$imgfile = $imagePath.$imageName;
	
	list($width, $height) = getimagesize($imgfile);
	$imgratio=$width/$height;
	 $newheight = $thumbsize/$imgratio ; //  $thumbsize;	
	 $newwidth =  $thumbsize ;// $thumbsize*$imgratio;
	$thumb = ImageCreateTrueColor($newwidth,$newheight);
	
	
	
	if (  $extension == ".JPG" ) { $source = imagecreatefromjpeg($imgfile); }
	if ( $extension  == ".GIF" ) { $source = imagecreatefromgif($imgfile); }
	if (  $extension  == ".PNG" ) { $source = imagecreatefrompng($imgfile); }	
	
	imagecopyresampled($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
	
	if ($extension  == ".JPG" ) { imagejpeg($thumb,$saveToDir.$imageName,100); }
	if ($extension  == ".GIF" ) { imagegif($thumb,$saveToDir.$imageName); }
	if ($extension  == ".PNG" ) { imagepng($thumb,$saveToDir.$imageName); }	
	
} 

/**********************************************************
                          MISCELANEOUS
***********************************************************/

/**
 * Función para evitar cacheo
 *  @author     Alejandro Rodriguez <www.alejandrorodriguez.info>
 *  @version    1.0.0   
 *  @created	-
 *  @updated	21/07/2008
 *
 * @param   nothing
 *
 * @return  string querystring anticache
 * @access  public
 **/  
function smrNoCache($imprime=true) {
	if ($imprime) { 
		echo sprintf( "?ac=%s", md5( date("YmdHis")  ) )	;
	}  else {
		return (sprintf( "?ac=%s", md5( date("YmdHis")  ) ));
 	}
}

/**
 * Calcular tiempo de ejecución
 *  Se debe ejecutar 2 veces la primera al inicio y 
 *  la segunda vez que se ejecuta imprime el tiempo
 *
 *  @author     Alejandro Rodriguez <www.alejandrorodriguez.info>
 *  @version    1.0.0   
 *  @created	-
 *  @updated	30/05/2008 19:16
 *
 * @return  nothing
 * @access  public
 **/    
function smrRuntime ( $round = 20 ) {
	static $start_script_runtime=false;	 		
		if($start_script_runtime===false){
			list($msec, $sec) = explode(" ", microtime());
			$start_script_runtime = $sec + $msec;		
		} else {
	        list($msec, $sec) = explode(" ", microtime());
            echo round(($sec + $msec) -$start_script_runtime, $round);						
		}
}


/**
 * Retorna o imprime un parametro para pasarlea una imagen y asi evitar el cache
 *
 *  @author     Alejandro Rodriguez <www.alejandrorodriguez.info>
 *  @version    1.0.0   
 *  @created	-
 *  @updated	30/05/2008 19:16
 *
 * @param	boolean	Imprimir o Mostrar
 * @return  string / nothing	param with random 
 * @access  public
 **/    
function smrNoCacheImg( $imprime=false) {
	$retornar="?smrAC=".smrGenPin() ;
	if ($imprime)  {
		echo $retornar;
	} else {
		return( $retornar);
	}
}

/**
 * Obtener La URL actual
 *
 *  @author     Alejandro Rodriguez <www.alejandrorodriguez.info>
 *  @version    1.0.0   
 *  @created	-
 *  @updated	30/05/2008 19:16
 *
 * @return  string con la ruta actual
 * @access  public
 **/    
function smrURI() {
	$host="http://".$_SERVER['HTTP_HOST'];
	$currentPage=$_SERVER["PHP_SELF"];
	$lastBar=strrpos( $currentPage, "/");
	if ($lastBar===false) {
		$uri=$host;
	} else {
		$uri=$host.substr( $currentPage, 0,  $lastBar)."/";
	}
	return($uri);
}


/**
 * Obtner extension de un archivo
 *
 *  @author     Alejandro Rodriguez <www.alejandrorodriguez.info>
 *  @version    1.0.0   
 *  @created	-
 *  @updated	30/05/2008 19:16
 *
 * @param   string	Dato de donde extraer la fecha 
 * @return  string extension del archivo
 * @access  public
**/   
function extension( $quien ) {
	return( substr($quien, strrpos( $quien, "." ) )  );
}


/**
 * Forzar Download de Archivos
 *
 *  @author     N/A
 *  @version    1.0.0   
 *  @created	-
 *  @updated	30/05/2008 19:16
 *
 * @param   string nombre de archivo
 * @return  nothing
 * @access  public
 **/   
function smrDownloadFile( $filename ) {
	$ext = substr( $filename,-3 );
	if( $filename == "" ) {
	   echo "<html><body>ERROR: Empty file to download. USE download.php?file=[file path]</body></html>";
	   exit;
	} elseif ( ! file_exists( $filename ) ) {
	   echo "<html><body>ERROR: File not found. USE download.php?file=[file path]</body></html>";
	   exit;
	};
	switch( $ext ){
	   case "pdf": $ctype="application/pdf";              break;
	   case "exe": $ctype="application/octet-stream";      break;
	   case "zip": $ctype="application/zip";              break;
	   case "doc": $ctype="application/msword";            break;
	   case "xls": $ctype="application/vnd.ms-excel";      break;
	   case "ppt": $ctype="application/vnd.ms-powerpoint"; break;
	   case "gif": $ctype="image/gif";                    break;
	   case "png": $ctype="image/png";                    break;
	   case "jpg": $ctype="image/jpg";                    break;
	   default:    $ctype="application/force-download";
	}
	header("Pragma: public");
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("Content-Type: $ctype");
	$user_agent = strtolower ($_SERVER["HTTP_USER_AGENT"]);
	if ((is_integer (strpos($user_agent, "msie"))) && (is_integer (strpos($user_agent, "win")))) {
	   header( "Content-Disposition: filename=".basename($filename).";" );
	} else {
	   header( "Content-Disposition: attachment; filename=".basename($filename).";" );
	}
	header("Content-Transfer-Encoding: binary");
	header("Content-Length: ".filesize($filename));
	readfile("$filename");
	exit();
}

/**
 * Mostrar datos para debug
 *
 *  @author     Alejandro Rodriguez <www.alejandrorodriguez.info>
 *  @version    1.0.0   
 *  @created	-
 *  @updated	30/05/2008 19:16
 *
 * @param   any 
 *
 * @return  nothing
 * @access  public
 **/  

function smrOut( $quien ) {
	echo "<pre>";
	print_r($quien);
	echo "</pre>";
	
}


/**
 * Función de Macromedia/Adobe para la conversión de datos
 *
 * @param   any Variable
 * @param   string Tipo
 * @param   string  Valor para definidos
 * @param   string  Valor para indefinidos
 * @return  any Dato convertido
 * @access  public
 **/  
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}


/**
 * Retornar el contenido recibido en el metodo especificado
 *
 *  @author     Alejandro Rodriguez <www.alejandrorodriguez.info>
 *  @version    1.0.0   
 *  @created	-
 *  @updated	30/05/2008 19:16
 *
 * @param   string 	Nombre del metodo
 *
 * @return  string	Contenido del metodo
 * @access  public
 **/ 
function smrGET( $metodo, $html=true ) {
	switch ($metodo ) {
		case "GET":
			$metodo=$_GET;
			break;
		case "POST":
			$metodo=$_POST;
			break;			
		case "SESSION":
			$metodo=$_SESSION;		
			break;			
	}
	
	$mensaje="";
	while (list($clave, $valor) = each( $metodo ) ) { 
		if (substr( $clave, 0,2) != "h_")  {
			if ($html) { 
				$mensaje.="<b>".$clave."</b>=".$valor."<br>";
			} else { 
				$mensaje.=$clave."=".$valor."\r\n";
			}
		}
	}
	return( $mensaje );
}

/**
 * Generar un log de estado con impresión de un dato X
 *
 *  @author     Alejandro Rodriguez <www.alejandrorodriguez.info>
 *  @version    1.0.0   
 *  @created	-
 *  @updated	30/05/2008 19:16
 *  @updated    05/03/2009 11.35  -  soporte para windows y linux
 * 
 * @param	string		Datos a mostrar
 * @param	string		nombre del archivo base
 * @param	int		numero de linea
 * @param	int		ruta destino del archivo de log
 *
 * @return	nothing
 **/  

function smrLog( $data,  $archivo=__FILE__, $linea=__LINE__, $ruta="./_logs_/") {
	global $DEPURAR;
	
	$barra=strrpos(  $archivo, "/");		
	if ($barra===false) {
		$barra=strrpos(  $archivo, "\\");			
	}
	$ruta.=substr( $archivo, $barra ).".log";
	
	if ( isset( $DEPURAR ) && $DEPURAR ) { 
		error_log("==============================================\r\n", 3, $ruta);			
		error_log("LINE: ".$linea."\r\n".$data."\r\n", 3, $ruta);		
	}
}


/**
 * Genera una matriz con numeros aleatorios
 *
 *  @author     Alejandro Rodriguez <www.alejandrorodriguez.info>
 *  @version    1.0.0   
 *  @created	-
 *  @updated	30/05/2008 19:16
 *
 * @param	int		Directorio destino
 * @param	int		Directorio de la imagen original
 * @param	int		Nombre de la imagen original 
 *
 * @return	array		Ancho en pixeles de la miniatura
 **/  

function smrGenerarNumerosAleatoriosUnicos($desde, $hasta, $cantidad) {
	if ( ($hasta-$desde) < $cantidad )  return false;	
	$aElegidos=array();
	$nCantidad=count($aElegidos);
	while ($nCantidad<$cantidad) {
		$nAleatorio=rand($desde, $hasta);		
		if ( !in_array($nAleatorio, $aElegidos) ) {
			$aElegidos[]=$nAleatorio;
			$nCantidad++;
		}
	}
	return($aElegidos);
} 


/**
 * Navegar Adelante y atras...
 *
 *  @author     Alejandro Rodriguez <www.alejandrorodriguez.info>
 *  @version    1.0.0   
 *  @created	-
 *  @updated	30/05/2008 19:16
 *
 * @param	int	registro actual
 * @param	string	tabla
 * @param	int	campo clave
 * @param	string	campo de orden
 * @param	string	orientacion
 * @param	int	registro anterior (by ref)
 * @param	int	registro siguiente (by ref)
 **/ 
function smrAnteriorSiguiente( $actual, $tabla, $campoID, $ordCampo, $ordOrientacion="asc", &$anterior, &$siguiente ) {
	global $database_cnx, $cnx;
	$trabajos=array();
	// RS
	mysql_select_db($database_cnx, $cnx);
	$query_rs = sprintf( "SELECT * FROM %s order by %s %s", $tabla, $ordCampo, $ordOrientacion  );
	$rs = mysql_query($query_rs, $cnx) or die(mysql_error());
	// Cargo un array
	while ( $row_rs = mysql_fetch_assoc($rs) ) { 
		$registros[] = $row_rs[$campoID];
	}
	// Busco la posicion del ID actual
	$resultado=array_search ( $actual, $registros );
	if ($resultado===false) {
		// no lo encontro
		die("Error Interno. ID desconocido ".$_SERVER['SCRIPT_FILENAME']);	
	} else {
		// si lo encontro
		if ($resultado==0) {	// Verifico si es el primero
			$anterior=$registros[count($registros)-1];	
		}else {
			$anterior=$registros[$resultado-1];
		}
	
		if ($resultado==count($registros)-1) { // Verifico si es el ultimo
			$siguiente=$registros[0];	
		} else {
			$siguiente=$registros[$resultado+1];		
		}
	}
	mysql_free_result($rs);
}


/**
 * Imprime iconos sociales soportando WAI
 *
 *  @author     Alejandro Rodriguez <www.alejandrorodriguez.info>
 *  @version    1.0.0   
 *  @created	-
 *  @updated	30/05/2008 19:16
 *
 * @param	string	clase css 
 * @require	includes/wai-obw.js
 **/  
function smrSocialWAI( $clase="") {
	$url="http://".$_SERVER["HTTP_HOST"].$_SERVER['PHP_SELF'];
	$qs=@$_SERVER['QUERY_STRING'];
	$url2add=$url.( ($qs!="")?"?".$qs:"" );
	// Los iconos deben estar en la carpeta assets/imagenes y deben llamarse
	// ico_fresqui.gif, ico_meneame.gif, ico_yahoo.gif, ico_technorati.gif, ico_digg.gif, ico_delicious.gif
	$redes=array(
	"fresqui"=>array("ico_fresqui.gif","http://tec.fresqui.com/post?url="),	// puede recibir title
	"meneame"=>array("ico_meneame.gif","http://meneame.net/submit.php?url="),
	"yahoo"=>array("ico_yahoo.gif","http://myweb2.search.yahoo.com/myresults/bookmarklet?u="),
	"technorati"=>array("ico_technorati.gif","http://technorati.com/faves/basnek?sub=favthis&amp;add="),
	"digg"=>array("ico_digg.gif","http://digg.com/submit?phase=2&amp;url="),
	"delicious"=>array("ico_delicious.gif","http://del.icio.us/post?url="),
	"furl"=>array("ico_furl.gif","http://www.furl.net/storeIt.jsp?u="),		
	);
	
	
	$dirimg="assets/imagenes/";
	$social="<div".(( $clase != "" )?" class=".$clase:"").">";
	
	while (list($clave, $valor) = each($redes)) { 
		$social.=sprintf( "<a href='%s%s' title=\"ir a %s\" rel=\"nuevaVentana\" hreflang=\"es\" rel=\"nofollow\"><img src=\"%s\" class=\"sinBorde\" %s/></a>", $redes[$clave][1], $url2add, $clave, $dirimg.$redes[$clave][0], wai(urlencode($clave), true) );	
	}
		
	$social.="</div>";
	return($social); 	
}

/**
 * Simi DIE pero con muestreo de mensaje + variable + back()
 *
 *  @author     Alejandro Rodriguez <www.alejandrorodriguez.info>
 *  @version    1.0.0   
 *  @created	-
 *  @updated	30/05/2008 19:16
 *
 * @param	string	mensaje
 * @param	string	variable
 *
 * @return	nothing
 **/
function smrDie( $mensaje, $variable="" ) {
	echo $mensaje."<br />";	
	if ( is_array( $variable ) ) { 
		print_r( $variable );
	} else {
		echo $variable;
	}
	echo "<br />";
	echo "<a href='javascript:history.back();'>volver</a>";
	die();
} 


/**
 * Retornar el nombre del php con su extension
 *
 *  @author     Alejandro Rodriguez <www.alejandrorodriguez.info>
 *  @version    1.0.0   
 *  @created	-
 *  @updated	30/05/2008 19:16
 *
 * @param	string	url base
 *
 * @return	string	URL
 **/ 
function smrReferer( $url ) {
	$url = explode("?", basename($url));
	$url = $url[0]; 
	return($url)	;
} 


/**
 * Función de ayuda para debug. Escribe uncomentario html
 *
 *  @author     Alejandro Rodriguez <www.alejandrorodriguez.info>
 *  @version    1.0.0   
 *  @created	-
 *  @updated	30/05/2008 19:16
 *
 * @param	string	texto a comentar
 *
 * @return	nothing
 **/  
function smrCO( $que ) {
	echo sprintf( "<!-- smrCO: %s -->", $que);	
}


/**
 * Función compatibilidad con los requisitos de la WAI
 *
 *  @author     Alejandro Rodriguez <www.alejandrorodriguez.info>
 *  @version    1.0.0   
 *  @created	-
 *  @updated	30/05/2008 19:16
 *
 * @param	string	texto a mostrar
 * @param	boolean	Imprime or retorna valor?
 *
 * @return	string / nothing	
 **/  
function wai( $dato, $onlydata=false ) {
	if ($onlydata) { 
		return( sprintf( "title='%s' alt='%s' longdesc='longdesc.php?msg=%s'", $dato, $dato, urlencode( $dato ) ) ) ;
	} else {
		echo sprintf( "title='%s' alt='%s' longdesc='longdesc.php?msg=%s'", $dato, $dato, urlencode( $dato ) ) ;
	}
}

/**
 * Función de calculo de bytes
 *
 *  @author     N/A
 *  @version    1.0.0   
 *  @created	-
 *  @updated	30/05/2008 19:16
 *
 * @param	double	bytes
 *
 * @return	string	dato formateado	
 **/  
function compute_size ($byte_number) {
if ($byte_number < 1024) {
	return $byte_number.' bytes';
} elseif ($byte_number < 1048576) {
	return truncate_decimals($byte_number / (1024)).' KB';
} elseif ($byte_number < 1073741824) {
	return truncate_decimals($byte_number / (1048576)).' MB';
} elseif ($byte_number < 1099511627776) {
	return truncate_decimals($byte_number / (1073741824)).' GB';
}
} 

/**
 * SBoisvert at Don'tSpamMe dot Bryxal dot ca  25-Jul-2006 10:38
 * From php.net
 */
function dircpy($basePath, $source, $dest, $overwrite = false){
   if(!is_dir($basePath . $dest)) //Lets just make sure our new folder is already created. Alright so its not efficient to check each time... bite me
   mkdir($basePath . $dest);
   if($handle = opendir($basePath . $source)){        // if the folder exploration is sucsessful, continue
       while(false !== ($file = readdir($handle))){ // as long as storing the next file to $file is successful, continue
           if($file != '.' && $file != '..'){
               $path = $source . '/' . $file;
               if(is_file($basePath . $path)){
                   if(!is_file($basePath . $dest . '/' . $file) || $overwrite)
                   if(!@copy($basePath . $path, $basePath . $dest . '/' . $file)){
                       echo '<font color="red">File ('.$path.') could not be copied, likely a permissions problem.</font>';
                   }
               } elseif(is_dir($basePath . $path)){
                   if(!is_dir($basePath . $dest . '/' . $file))
                   mkdir($basePath . $dest . '/' . $file); // make subdirectory before subdirectory is copied
                   dircpy($basePath, $path, $dest . '/' . $file, $overwrite); //recurse!
               }
           }
       }
       closedir($handle);
   }
}

   
/**
 * Función de grabado de archivos = upload
 *
 *  @author     N/A
 *  @version    1.0.0   
 *  @created	-
 *  @updated	30/05/2008 19:16
 *
 * @param	string	nombre de variable
 * @param	string	destino
 * @param	string	nombre de archivo destino
 * @param	int	tamaño maximo
 *
 * @return	string	dato formateado	
 **/    
function storefile($var, $location, $filename=NULL, $maxfilesize=NULL) {
   $ok = false;

   // Check file
   $mime = $_FILES[$var]["type"];
   if($mime=="image/jpeg" || $mime=="image/pjpeg") {
     // Mime type is correct
     // Check extension
     $name  = $_FILES[$var]["name"];
     $array = explode(".", $name);
     $nr    = count($array);
     $ext  = $array[$nr-1];
     if($ext=="jpg" || $ext=="jpeg") {
       $ok = true;
     }
   }
  
   if(isset($maxfilesize)) {
     if($_FILES[$var]["size"] > $maxfilesize) {
       $ok = false;
     }
   }
  
   if($ok==true) {
     $tempname = $_FILES[$var]['tmp_name'];
     if(isset($filename)) {
       $uploadpath = $location.$filename;
     } else {
       $uploadpath = $location.$_FILES[$var]['name'];
     }
     if(is_uploaded_file($_FILES[$var]['tmp_name'])) { 
       while(move_uploaded_file($tempname, $uploadpath)) {
         // Wait for the script to finish its upload   
       }
     }
     return true;
   } else {
     return false;
   }
  }   


/**
 * Captura una URL
 *
 * @name        smrUrlOpen()
 *
 *  @author     Alejandro Rodriguez <www.alejandrorodriguez.info>
 *  @version    1.0.0   
 *  @created	-
 *  @updated	30/05/2008 19:16
 *
 * @param	string	URL a capturar
 * 
 * @return 	string	contenido de la URL
 */
function smrUrlOpen($url) 
{ 
	   // Fake the browser type 
	   ini_set('user_agent','MSIE 4\.0b2;'); 
	   $dh = fopen("$url",'r'); 
       $result	   ="";
	   while(!feof($dh)) {
		   $result.=fread($dh,8192);
	   }  
	   return $result; 
} 


/**
 * Calcular el tiempo de lectura de un texto
 *
 * @name        smrTiempoDeLectura()
 *
 *  @author     Alejandro Rodriguez <www.alejandrorodriguez.info>
 *  @version    1.0.0   
 *  @created	-
 *  @updated	30/05/2008 19:16
 * 
 * @param	string	texto a calcular
 *
 * @return 	int	tiempo de lectura
 */ 
function smrTiempoDeLectura( $texto ) { 
	$timeLetura=( strlen( $texto ) / 15 ) / 100 ;// Bajo 10-100 Medio 200-240
	$numero=$timeLetura;
	$numero=number_format ($numero, 2, '\'', ' ');
	return( $numero );
}




/**
 * Poner un link para regresar a la pagina anterior
 *
 *  @author     Alejandro Rodriguez <www.alejandrorodriguez.info>
 *  @version    1.0.0   
 *  @created	-
 *  @updated	30/05/2008 19:16
 * 
 * @return 	HTML	link a pagina anterior
 */  
function smrVolver() {
	return ( "<a href='javascript:history.back();'>Volver</a>");
}


/**
 * Extraer el nombre del script de una URL
 *
 *  @author     Alejandro Rodriguez <www.alejandrorodriguez.info>
 *  @version    1.0.0   
 *  @created	-
 *  @updated	30/05/2008 19:16
 * 
 * @param	string	url	
 *
 * @return 	string  nombre del script pasado en la URL
 **/  
function smrScriptname( $url ) {
	$posBarra=strrpos( $url, "/" );
	$scriptname=substr( $url, $posBarra+1 );
	$posPunto=strrpos( $scriptname, "." );
	$scriptname=substr( $scriptname, 0, $posPunto +4  );
	return ( $scriptname ) ;
}

/**
 * Mostrar el contenido de POST ó GET ó SESSION
 *
 *  @author     Alejandro Rodriguez <www.alejandrorodriguez.info>
 *  @version    1.0.0   
 *  @created	-
 *  @updated	30/05/2008 19:16
 * 
 * @param	string	tipo a mostrar P/G/S	
 *
 * @return 	string  nombre del script pasado en la URL
 **/  
function smrWatch( $tipo="P" ) {
	switch( $tipo ) {
		case "P":
			$mensaje="POST<hr>";		
			while (list($clave, $valor) = each( $_POST ) ) { 	$mensaje.="<b>".$clave."</b>=".$valor."<br>"; }
			break;
		case "G":	
			$mensaje="GET<hr>";
			while (list($clave, $valor) = each( $_GET ) ) { 	$mensaje.="<b>".$clave."</b>=".$valor."<br>"; }
			break;			
		case "S":		
			$mensaje="SESSION<hr>";					
			while (list($clave, $valor) = each( $_SESSION ) ) { 	$mensaje.="<b>".$clave."</b>=".$valor."<br>"; }		
			break;
	}			
	return( $mensaje );
}

/**
 * Controla la existencia y carga de las variables que enviamos
 *
 *  @author     Alejandro Rodriguez <www.alejandrorodriguez.info>
 *  @version    1.0.0   
 *  @created	-
 *  @updated	30/05/2008 19:16
 * 
 * @param	array	variables
 * @param	bool	controlar existencia? 
 * @param	bool	controlar carga? 
 *
 * @return 	string  si hubo o no errores
 **/ 
function smrChequearVariables( $variables, $existencia=true, $carga=true ) {
	$errores="";
	for ( $i=0; $i<count( $variables) ; $i++) {
		if ( $existencia ) {
			if ( !isset( $_POST[ $variables[$i] ] ) ) {			
				$errores.="<strong>".$variables[$i]."</strong>: no existe<br>";
			} elseif( $carga )  {
				if ( $_POST[ $variables[$i] ] =="" ) {			
					$errores.="<strong>".$variables[$i]."</strong>: esta vacia<br>";
				}
			}		
		}			
	}	
	return( $errores);
}


/**
 * Mostrar los iconos de redes sociales permitiendo enviar la url actual
 *
 * @name        smrSocial()
 *
 *  @author     Alejandro Rodriguez <www.alejandrorodriguez.info>
 *  @version    1.0.0   
 *  @created	-
 *  @updated	30/05/2008 19:16
 * 
 * @param	string	(Querystring)	
 *
 * @return 	div with images
 * @how to use	echo smrSocial();  or echo smrSocial("socialDiv"); 
 */  
function smrSocial( $clase="") {
	$url="http://".$_SERVER["HTTP_HOST"].$_SERVER['PHP_SELF'];
	$qs=@$_SERVER['QUERY_STRING'];
	$url2add=$url.( ($qs!="")?"?".$qs:"" );
	// Los iconos deben estar en la carpeta assets/imagenes y deben llamarse
	// ico_fresqui.gif, ico_meneame.gif, ico_yahoo.gif, ico_technorati.gif, ico_digg.gif, ico_delicious.gif
	$redes=array(
	"fresqui"=>array("ico_fresqui.gif","http://tec.fresqui.com/post?url="),	// puede recibir title
	"meneame"=>array("ico_meneame.gif","http://meneame.net/submit.php?url="),
	"yahoo"=>array("ico_yahoo.gif","http://myweb2.search.yahoo.com/myresults/bookmarklet?u="),
	"technorati"=>array("ico_technorati.gif","http://technorati.com/faves/basnek?sub=favthis&amp;add="),
	"digg"=>array("ico_digg.gif","http://digg.com/submit?phase=2&amp;url="),
	"delicious"=>array("ico_delicious.gif","http://del.icio.us/post?url="),
	"furl"=>array("ico_furl.gif","http://www.furl.net/storeIt.jsp?u="),		
	);
	
	
	$dirimg="assets/imagenes/";
	$social="<div".(( $clase != "" )?" class=".$clase:"").">";
	
	while (list($clave, $valor) = each($redes)) { 
		$social.=sprintf( "<a href='%s%s' title=\"ir a %s\" target=\"_blank\" hreflang=\"es\" rel=\"nofollow\"><img src=\"%s\" class=\"sinBorde\" %s/></a>", $redes[$clave][1], $url2add, $clave, $dirimg.$redes[$clave][0], wai(urlencode($clave), true) );	
	}
		
	$social.="</div>";
	return($social); 	
}

/**
 * Escribe el <a> para hacer un over segun libreria overlib
 *
 * @name        smrOverlib()
 *
 *  @author     Alejandro Rodriguez <www.alejandrorodriguez.info>
 *  @version    1.0.0   
 *  @created	-
 *  @updated	30/05/2008 19:16
 * 
 * @param	string	texto
 * @param	string	?? 
 *
 * @return 	div with images
 */ 
function smrOverlib( $text, $popup ) {
	echo sprintf( "<a href=\"javascript:void(0);\" onmouseover=\"return overlib('%s');\" onmouseout=\"return nd();\">%s</a>"	, $popup, $text);
}

/**
 * AntiCache
 *
 * @name        smrAntiCache()
 *
 *  @author     Alejandro Rodriguez <www.alejandrorodriguez.info>
 *  @version    1.0.0   
 *  @created	-
 *  @updated	30/05/2008 19:16
 *
 * @return 	string	var y dato para linkear
 */ 
function smrAntiCache() {
	return( "smrAC=".md5( date("Ymdhis") ) );
}


/**********************************************************
                   DIRECTORY
***********************************************************/

 
/***********************************
Author : M. Niyazi Yarar
Created : February, 2006
Description : Simply clean files
and removes the directory

If any error occurs or for your suggestions,
please send me e-mail
***********************************/
function ClearDirectory($path){
   if($dir_handle = opendir($path)){   
       while($file = readdir($dir_handle)){   
           if($file == "." || $file == ".."){
               if(!@unlink($path."/".$file)){
                   continue;
               }               
           }else{
               @unlink($path."/".$file);
           }
       }
       closedir($dir_handle);
       return true;
// all files deleted
   }else{
       return false;
// directory doesn?t exist
   }   
}
function RemoveDirectory($path){
   if(ClearDirectory($path)){
       if(rmdir($path)){
           return true;
// directory removed
       }else{
           return false;
// directory couldn?t removed
       }
   }else{
       return false;
// no empty directory
   }
}
/***************************************
Example Usage

if(RemoveDirectory("/mysite/images")){
   echo 'Uughh! All images gone!';
}else{
   echo 'Ohh, well done. I am so lucky';
}
***************************************/

function smrIs_Dir ($file) {
	$permisos=@fileperms("$file");
   if (( $permisos& 0x4000) == 0x4000) { 
       return TRUE;
   } else {
       return FALSE;
   }
}


/**********************************************************
                   EMAIL
***********************************************************/
/**
 * Funcion para el envio de mails.
 *
 * @name        smrEnviaEmail()
 *
 *  @author     Alejandro Rodriguez <www.alejandrorodriguez.info>
 *  @version    1.0.1 soporte utf-8    
 *  @version    1.0.0   
 *  @created	-
 *  @updated	30/05/2008 19:16
 *
 *	@param	string	de	remitente
 *	@param	string	para	destinatario 
 *	@param	string	asunto	asunto 
 *	@param	string	mensaje	mensaje 
 *	@param	string	formato	1=HTML 0=TEXT   
 *	@param 	string	ip	1=Si 0=no
 *
 *	@return 	int		resultado del envio  
 */
function smrEnviaEmail( $de, $para, $asunto, $mensaje, $formato="1", $ip="1", $utf8=false) { 
	$myname = $de; 
	$myemail = $de; 
	$contactname=$para;
	$contactemail=$para;
	$asunto=$asunto;
	$headers = "";
	$cuerpo  = "";
	$headers = "";
	$headers .= "MIME-Version: 1.0\n";
	if ($formato=="0") {
		$headers .= sprintf( "Content-type: text/plain; charset=%s\n", ( ($utf8)?"utf-8":"iso-8859-1") );
	} else {
		$headers .= sprintf( "Content-type: text/html; charset=%s\n", ( ($utf8)?"utf-8":"iso-8859-1") );		
	}
	// $headers .= "X-Priority: 1\n";
	// $headers .= "X-MSMail-Priority: High\n";
	$headers .= "X-MimeOLE: 1.0\n";	 // MIME-Version: 1.0
	$headers .= "X-Mailer: php\n";
	$headers .= "From: \"".$myname."\" <".$myemail.">\n";
	$cuerpo .= $mensaje;
	if ($ip=="1") {
		$hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);
		$cuerpo .= "IP:".$hostname."(".$_SERVER['REMOTE_ADDR'].")"."<BR>";
	}
	$resultado=mail($contactemail, $asunto, $cuerpo, $headers);
return($resultado)	;	
}


#
# RFC(2)822 Email Parser
#
# By Cal Henderson <cal@iamcal.com>
# This code is licensed under a Creative Commons Attribution-ShareAlike 2.5 License
# http://creativecommons.org/licenses/by-sa/2.5/
#
# Revision 4
#

##################################################################################

function is_valid_email_address($email){


	####################################################################################
	#
	# NO-WS-CTL       =       %d1-8 /         ; US-ASCII control characters
	#                         %d11 /          ;  that do not include the
	#                         %d12 /          ;  carriage return, line feed,
	#                         %d14-31 /       ;  and white space characters
	#                         %d127
	# ALPHA          =  %x41-5A / %x61-7A   ; A-Z / a-z
	# DIGIT          =  %x30-39

	$no_ws_ctl    = "[\\x01-\\x08\\x0b\\x0c\\x0e-\\x1f\\x7f]";
	$alpha        = "[\\x41-\\x5a\\x61-\\x7a]";
	$digit        = "[\\x30-\\x39]";
	$cr        = "\\x0d";
	$lf        = "\\x0a";
	$crlf        = "($cr$lf)";


	####################################################################################
	#
	# obs-char        =       %d0-9 / %d11 /          ; %d0-127 except CR and
	#                         %d12 / %d14-127         ;  LF
	# obs-text        =       *LF *CR *(obs-char *LF *CR)
	# text            =       %d1-9 /         ; Characters excluding CR and LF
	#                         %d11 /
	#                         %d12 /
	#                         %d14-127 /
	#                         obs-text
	# obs-qp          =       "\" (%d0-127)
	# quoted-pair     =       ("\" text) / obs-qp

	$obs_char    = "[\\x00-\\x09\\x0b\\x0c\\x0e-\\x7f]";
	$obs_text    = "($lf*$cr*($obs_char$lf*$cr*)*)";
	$text        = "([\\x01-\\x09\\x0b\\x0c\\x0e-\\x7f]|$obs_text)";
	$obs_qp        = "(\\x5c[\\x00-\\x7f])";
	$quoted_pair    = "(\\x5c$text|$obs_qp)";


	####################################################################################
	#
	# obs-FWS         =       1*WSP *(CRLF 1*WSP)
	# FWS             =       ([*WSP CRLF] 1*WSP) /   ; Folding white space
	#                         obs-FWS
	# ctext           =       NO-WS-CTL /     ; Non white space controls
	#                         %d33-39 /       ; The rest of the US-ASCII
	#                         %d42-91 /       ;  characters not including "(",
	#                         %d93-126        ;  ")", or "\"
	# ccontent        =       ctext / quoted-pair / comment
	# comment         =       "(" *([FWS] ccontent) [FWS] ")"
	# CFWS            =       *([FWS] comment) (([FWS] comment) / FWS)

	#
	# note: we translate ccontent only partially to avoid an infinite loop
	# instead, we'll recursively strip comments before processing the input
	#

	$wsp        = "[\\x20\\x09]";
	$obs_fws    = "($wsp+($crlf$wsp+)*)";
	$fws        = "((($wsp*$crlf)?$wsp+)|$obs_fws)";
	$ctext        = "($no_ws_ctl|[\\x21-\\x27\\x2A-\\x5b\\x5d-\\x7e])";
	$ccontent    = "($ctext|$quoted_pair)";
	$comment    = "(\\x28($fws?$ccontent)*$fws?\\x29)";
	$cfws        = "(($fws?$comment)*($fws?$comment|$fws))";
	$cfws        = "$fws*";


	####################################################################################
	#
	# atext           =       ALPHA / DIGIT / ; Any character except controls,
	#                         "!" / "#" /     ;  SP, and specials.
	#                         "$" / "%" /     ;  Used for atoms
	#                         "&" / "'" /
	#                         "*" / "+" /
	#                         "-" / "/" /
	#                         "=" / "?" /
	#                         "^" / "_" /
	#                         "`" / "{" /
	#                         "|" / "}" /
	#                         "~"
	# atom            =       [CFWS] 1*atext [CFWS]

	$atext        = "($alpha|$digit|[\\x21\\x23-\\x27\\x2a\\x2b\\x2d\\x2e\\x3d\\x3f\\x5e\\x5f\\x60\\x7b-\\x7e])";
	$atom        = "($cfws?$atext+$cfws?)";


	####################################################################################
	#
	# qtext           =       NO-WS-CTL /     ; Non white space controls
	#                         %d33 /          ; The rest of the US-ASCII
	#                         %d35-91 /       ;  characters not including "\"
	#                         %d93-126        ;  or the quote character
	# qcontent        =       qtext / quoted-pair
	# quoted-string   =       [CFWS]
	#                         DQUOTE *([FWS] qcontent) [FWS] DQUOTE
	#                         [CFWS]
	# word            =       atom / quoted-string

	$qtext        = "($no_ws_ctl|[\\x21\\x23-\\x5b\\x5d-\\x7e])";
	$qcontent    = "($qtext|$quoted_pair)";
	$quoted_string    = "($cfws?\\x22($fws?$qcontent)*$fws?\\x22$cfws?)";
	$word        = "($atom|$quoted_string)";


	####################################################################################
	#
	# obs-local-part  =       word *("." word)
	# obs-domain      =       atom *("." atom)

	$obs_local_part    = "($word(\\x2e$word)*)";
	$obs_domain    = "($atom(\\x2e$atom)*)";


	####################################################################################
	#
	# dot-atom-text   =       1*atext *("." 1*atext)
	# dot-atom        =       [CFWS] dot-atom-text [CFWS]

	$dot_atom_text    = "($atext+(\\x2e$atext+)*)";
	$dot_atom    = "($cfws?$dot_atom_text$cfws?)";


	####################################################################################
	#
	# domain-literal  =       [CFWS] "[" *([FWS] dcontent) [FWS] "]" [CFWS]
	# dcontent        =       dtext / quoted-pair
	# dtext           =       NO-WS-CTL /     ; Non white space controls
	# 
	#                         %d33-90 /       ; The rest of the US-ASCII
	#                         %d94-126        ;  characters not including "[",
	#                                         ;  "]", or "\"

	$dtext        = "($no_ws_ctl|[\\x21-\\x5a\\x5e-\\x7e])";
	$dcontent    = "($dtext|$quoted_pair)";
	$domain_literal    = "($cfws?\\x5b($fws?$dcontent)*$fws?\\x5d$cfws?)";


	####################################################################################
	#
	# local-part      =       dot-atom / quoted-string / obs-local-part
	# domain          =       dot-atom / domain-literal / obs-domain
	# addr-spec       =       local-part "@" domain

	$local_part    = "($dot_atom|$quoted_string|$obs_local_part)";
	$domain        = "($dot_atom|$domain_literal|$obs_domain)";
	$addr_spec    = "($local_part\\x40$domain)";


	#
	# we need to strip comments first (repeat until we can't find any more)
	#

	$done = 0;

	while(!$done){
		$new = preg_replace("!$comment!", '', $email);
		if (strlen($new) == strlen($email)){
			$done = 1;
		}
		$email = $new;
	}


	#
	# now match what's left
	#

	return preg_match("!^$addr_spec$!", $email) ? 1 : 0;
} 


/**********************************************************
                   PRUEBAS
***********************************************************/


function  smrRotarImagen( $imagen, $grados) {
	// header('Content-type: image/jpeg');
	$source = imagecreatefromjpeg($imagen);	
	$rotate = KERN_Rotate_Image($source,$grados);	
	imagejpeg($rotate);
//	imagecopyresampled($dst, $rotate, 0, 0, 0, 0, $width, $height, $width, $height);	
	
//	imagecopy($dst, $rotate,320, 240, 320, 240, 1, 1);	
//	imagedestroy($rotate); 
	return($xx);
}

/**
  * KERN_Rotate_Image
  * Ein Bild rotieren {{{
  * @access public
  * @param resource $resImage Ursprungsbild
  * @param integer $intAngle Gradanzahl
  * @return resource
  * @since  2.0.4
  */
  function KERN_Rotate_Image($resSourceImage,$intAngle){
  // copyright: http://docs.php.net/manual/en/function.imagerotate.php
  // darren at lucidtone dot com 08-Dec-2004 04:43
  // @archilles: removed bicubic recalcuation code as unused here...
  // this method is needed as stock imagerotate() currently does not support full 8-bit alpha channel :(

  $intAngle = $intAngle+180; // convert degrees to radians
  $intAngle = deg2rad($intAngle);
  $dblAngleCos = cos($intAngle);
  $dblAngleSin = sin($intAngle);
  $intSourceX = imagesx($resSourceImage);
  $intSourceY = imagesy($resSourceImage);
  $intCenterX = floor($intSourceX/2);
  $intCenterY = floor($intSourceY/2);
  $resRotateImage = imagecreatetruecolor($intSourceX,$intSourceY);
  imagealphablending($resRotateImage,false);
  imagesavealpha($resRotateImage,true);
    for ( $intY = 0 ; $intY < $intSourceY ; $intY++ ){
      for ( $intX = 0; $intX < $intSourceX ; $intX++ ){ // rotate...
      $intOldX = (($intCenterX-$intX) * $dblAngleCos + ($intCenterY-$intY) * $dblAngleSin) + $intCenterX;
      $intOldY = (($intCenterY-$intY) * $dblAngleCos - ($intCenterX-$intX) * $dblAngleSin) + $intCenterY;
      ( $intOldX >= 0 && $intOldX < $intSourceX && $intOldY >= 0 && $intOldY < $intSourceY )
      ? $resColor = imagecolorat($resSourceImage,$intOldX,$intOldY)
      : $resColor = imagecolorallocatealpha($resSourceImage,255,255,255,127); // this line sets the background colour
      imagesetpixel($resRotateImage,$intX,$intY,$resColor);
      }
    }
  return $resRotateImage;
  } //}}}


?>