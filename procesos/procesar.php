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
$comentario	= ucfirst(strtolower(strip_tags($_POST['comentario'])));
$fecha		= date('Y-m-d');
$video_id	= $_POST['video_id'];
$activar 	= 1;



   if (!validarFormulario($_POST)) 
   {
     echo "No has cubierto el formulario correctamente - Por favor vuelve"
           ." e int&eacute;ntalo de nuevo.";
      exit;
   }
   
 if (!validarEmail($email))
   {
     
      echo "Direcci&oacute;n email no v&aacute;lida.  Por favor vuelve "
           ." e int&eacute;ntalo de nuevo.";
      exit;
   }
   

	
if (isset($_POST) and $_POST["grabar"]=="si")
{
		if ($_SESSION["real"] == $_POST["captcha"])
		{
			if (mysql_select_db($database_cnx,$cnx))
			{
				$consulta="insert into vy_curso_comentario(video_id, nombre, comentario, fecha, email, activar) 
										values('$video_id', '$nombre', '$comentario', '$fecha', '$email', '$activar')"; 
			}
			if (mysql_query($consulta,$cnx))
			{
////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////COMIENZA EL ENVIO DE CORREOS ELECTRONICOS//////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////
			$nombre 	=  "Estimado usuario, gracias por realizar comentarios nos alegramos que te interese nuestro humilde trabajo...";
			$destino 	= 	$email;

		//*****************************************************************
		//ahora envío el mail de notificación a mi cuenta
			$remitente="venyor.com<info@venyor.com>";
			$asunto="Gracias estimado usuario por opinar, tu opinión es muy valiosa.";
			$cuerpo=
			"
			<html>
			<head>
			<body>
			<table align='center' width='500' style='background:#9f6;'>
			<tr>
				<td valign='top' align='right' width='200'>
				Mensaje:
				</td>
				<td valign='top' align='left' width='300'>".$nombre."
				</td>
			</tr>
			
			<tr>
				<td valign='top' align='right' width='200'>
				E-Mail:
				</td>
				<td valign='top' align='left' width='200'>".$destino."
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
			$asunto2="Alguien comento los cursos.";
			$cuerpo2="Esta persona $destino, realizo un comentario del video <<$video_id>> el mensaje fue: <<$comentario>>.";
			
			$sheader2="From:".$remitente2."\nReply-To:".$remitente2."\n"; 
			$sheader2=$sheader."X-Mailer:PHP/".phpversion()."\n"; 
			$sheader2=$sheader."Mime-Version: 1.0\n"; 
			$sheader2=$sheader."Content-Type: text/html";
			
			$destino2 = $row_RsDestino2['correo'];
			$mailsend2 = mail($destino2,$asunto2,$cuerpo2,$sheader2);

////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////FINALIZA EL ENVIO DE CORREOS ELECTRONICOS//////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////
			} 
			if ($mailsend and $mailsend2 = true)
			{	echo "<script type='text/javascript'>alert('Gracias por comentar.');
					window.location='../detalle.php?deo=$video_id'</script>";
			}		
		}
		else 
			echo "<script type='text/javascript'>alert('Error en el captcha! vuelve e inténtalo de nuevo.');window.location='../detalle.php?deo=$video_id';</script>";
}	
?>
<?php
mysql_free_result($RsDestino2);
?>