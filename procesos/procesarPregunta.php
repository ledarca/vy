<?php
session_start();
require_once('../Connections/cnx.php'); 
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

$nombre 	= ucwords(strtolower(strip_tags($_POST['nombre'])));
$email		= strip_tags($_POST['email']);
$pregunta	= ucfirst(strtolower(strip_tags($_POST['comentario'])));
$fecha		= date('Y-m-d');
$produkt_id	= $_POST['produkt_id']; 
$dos		= $_POST['dos']; 

$activar 	= 1;
$respuesta	= 1;

	if (!validarFormulario($_POST)) 
	{
    	echo "No has cubierto el formulario correctamente - Por favor vuelve"
           ." e int&eacute;ntalo de nuevo.";    exit;
	}
   
	if (!validarEmail($email))
	{
    	echo "Direcci&oacute;n email no v&aacute;lida.  Por favor vuelve "
           ." e int&eacute;ntalo de nuevo.";	exit;
	}
   
if (isset($_POST) and $_POST["grabar"]=="si")
{	
	if ($_SESSION["real"]==$_POST["captcha"]) 
	{	
		if (mysql_select_db($database_cnx,$cnx))
		{
			$consulta="insert into vy_cat_productos_pregunta (produkt_id, nombre, pregunta, fecha, email, activar, respuesta_si) 
												 values('$produkt_id', '$nombre', '$pregunta', '$fecha', '$email', '$activar', '$respuesta')"; 
		}
		
		if (mysql_query($consulta,$cnx))
		{
////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////COMIENZA EL ENVIO DE CORREOS ELECTRONICOS//////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////
			$nombre 	=  "Estimado usuario, gracias por preguntar nos alegramos que te interese nuestro humilde trabajo...";
			$destino 	= 	$email;

		//*****************************************************************
		//ahora envío el mail de notificación a mi cuenta
			$remitente="venyor.com<info@venyor.com>";
			$asunto="Gracias estimado usuario por preguntar.";
			$cuerpo=
			"
			<html>
			<head>
			<body>
			<table align='center' width='500' style='background:#9f6;'>
			<tr>
				<td valign='top' align='right' width='200'>
				Mensaje de venyor.com:
				</td>
				<td valign='top' align='left' width='300'>".$nombre."
				</td>
			</tr>
			
			<tr>
				<td valign='top' align='right' width='200'>
				Remitente:
				</td>
				<td valign='top' align='left' width='200'>".$destino."
				</td>
			</tr>

			<tr>
				<td valign='top' align='right' width='200'>
				Pregunta:
				</td>
				<td valign='top' align='left' width='200'> ¿".$pregunta."?
				</td>
			</tr>
		
			</table>
			</body>
			</head>
			<html>
			";		
			$sheader="From:".$remitente."\nReply-To:".$remitente."\n"; 
			$sheader=$sheader."X-Mailer:PHP/".phpversion()."\n"; 
			$sheader=$sheader."Mime-Version: 1.0\n"; 
			$sheader=$sheader."Content-Type: text/html";
			
			$mailsend = mail($destino,$asunto,$cuerpo,$sheader);
///////////////////////////////////////////////////////////////////////////////////////////////

			$remitente2="Comentarios cursos<info@venyor.com>";
			$asunto2="Alguien hizo una pregunta.";
			$cuerpo2="Esta persona $destino, realizo una pregunta del producto <<$produkt_id>> el mensaje fue: <<$pregunta>>.";
			
			$sheader2="From:".$remitente2."\nReply-To:".$remitente2."\n"; 
			$sheader2=$sheader."X-Mailer:PHP/".phpversion()."\n"; 
			$sheader2=$sheader."Mime-Version: 1.0\n"; 
			$sheader2=$sheader."Content-Type: text/html";
			
			$destino2 = $row_RsDestino2['correo'];
			$mailsend2 = mail($destino2,$asunto2,$cuerpo2,$sheader2);

			} 
			if ($mailsend and $mailsend2 = true)
			{	echo "<script type='text/javascript'>alert('Gracias por preguntar en breve te responderemos.');
					window.location='../detallePro.php?cto=$produkt_id&dos=$dos';</script>";
			}
////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////FINALIZA EL ENVIO DE CORREOS ELECTRONICOS//////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////
	}
	else
	{	
		echo "<script type='text/javascript'>alert('Error en el captcha! vuelve e inténtalo de nuevo.');
				window.location='../detallePro.php?cto=$produkt_id&dos=$dos';</script>";
	}
}
?>
<?php
mysql_free_result($RsDestino2);
?>