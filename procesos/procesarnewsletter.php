<?php require_once('../Connections/cnx.php'); ?>
<?php
require_once('funciones.php');

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

mysql_select_db($database_cnx, $cnx);
$query_RsDestino2 = "SELECT * FROM vy_cms_contacto";
$RsDestino2 = mysql_query($query_RsDestino2, $cnx) or die(mysql_error());
$row_RsDestino2 = mysql_fetch_assoc($RsDestino2);
$totalRows_RsDestino2 = mysql_num_rows($RsDestino2);

$email		= strip_tags($_POST['email']);
$fecha		= date('Y-m-d');


	if (!validarFormulario($_POST)) 
	{
    	echo "No has cubierto el formulario correctamente - Por favor vuelve"." e int&eacute;ntalo de nuevo.";
		exit;
	}
   
	if (!validarEmail($email))
	{
		echo "Direcci&oacute;n email no v&aacute;lida.  Por favor vuelve "." e int&eacute;ntalo de nuevo.";
		exit;
	}
		  
	if (guardarNewsletter($fecha, $email))
	{
		echo "No se ha podido guardar el formulario.  Por favor vuelve "." e inténtalo de nuevo.";
		exit;
	} 	
		$nombre 	=  "Estimado usuario gracias por registrarte a nuestra newsletter...";
		$destino 	= 	$email;
		//*****************************************************************
		//ahora envío el mail de notificación a mi cuenta
		$remitente="venyor.com<info@venyor.com>";
		$asunto="Gracias por registrarse a nuestra newsletter";
		$cuerpo=
		"
<!doctype html>
<html lang='es'>
<head>
<meta charset='utf-8'>
</head>

<body style='background:#9900ff;'>
		<table align='center' width='300' style='background:#9f6;'>
		<tr>
			<td valign='top' align='right' width='200'>
				<img src='http://localhost/vyf/photo/slider/slide_03.jpg' style='width:300px'>
			</td>
		</tr>

		<tr>
			<td valign='top' align='left' width='200'>
			Mensaje:
			</td>
			<td valign='top' align='left' width='200'>".$nombre."
			</td>
		</tr>
		
		<tr>
			<td valign='top' align='left' width='200'>
			E-Mail:
			</td>
			<td valign='top' align='left' width='200'>".$destino."
			</td>
		</tr>
			</table>
<footer style='background:#999; alignment-adjust:central; color:white;''>
venyor.com <h2>Esto es una prueba diseño en construccion</h2>
</footer>
</body>
</html>

		";
		
		$sheader="From:".$remitente."\nReply-To:".$remitente."\n"; 
		$sheader=$sheader."X-Mailer:PHP/".phpversion()."\n"; 
		$sheader=$sheader."Mime-Version: 1.0\n"; 
		$sheader=$sheader."Content-Type: text/html";
		
		$mailsend = mail($destino,$asunto,$cuerpo,$sheader);
///////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////
		$remitente2="Newsletter<newsletter@venyor.com>";
		$asunto2="Alguien se registro al newsletter";
		$cuerpo2="Se agrego $destino a nuestra newsletter";
		
		$sheader2="From:".$remitente2."\nReply-To:".$remitente2."\n"; 
		$sheader2=$sheader."X-Mailer:PHP/".phpversion()."\n"; 
		$sheader2=$sheader."Mime-Version: 1.0\n"; 
		$sheader2=$sheader."Content-Type: text/html";
		
		$destino2 = $row_RsDestino2['correo'];
		$mailsend2 = mail($destino2,$asunto2,$cuerpo2,$sheader2);
///////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////
		if($mailsend and $mailsend2 = true)
		{
			echo "<script type='text/javascript'>alert('Gracias por unirte a nuestra newsletter');window.location='../index.php';</script>";
		}
		else
			echo"no fue enviado";
	?>
<?php
mysql_free_result($RsDestino2);
?>
