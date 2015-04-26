<?php
session_start();
require_once('../Connections/cnx.php');
	if(isset($_SESSION['carritovyf'])){
			$carrito_mio=$_SESSION['carritovyf'];
			if(isset($_POST['cantidad'])){
			}}

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

$nombre 	= strtolower(strip_tags($_POST['nombre']));
$email		= strip_tags($_POST['correo']);
$ci			= strip_tags($_POST['cedula']);
$telefono	= strip_tags($_POST['telefono']);
$direccion	= strtolower(strip_tags($_POST['direccion']));

$fecha		= date('Y-m-d');
$ip			= $remote_addr = $_SERVER['REMOTE_ADDR']; 
	
//GUARDAR EN BASE DE DATOS TABLAS DE CLIENTES

if (mysql_select_db($database_cnx,$cnx))
{
	$consulta="insert into vy_comprado_clientes	(nombre, email, ci, telefono, direccion, ip, fecha) 
										 values	('$nombre', '$email', '$ci', '$telefono', '$direccion', '$ip', '$fecha')"; 
}
if (mysql_query($consulta,$cnx))
	echo "<h3>Su orden ha sido recibida y guardada Que Deseas Hacer? </h3>";  
else 
{
	echo "<p style='color:red'>error al guardar en db";
}
$cliente_id = mysql_insert_id(); // recupera el ultimo id agregado
///////////////////////////////////////////////////////////////////////////////
if(isset($_SESSION['carritovyf']))
{
	for($i=0;$i<=count($carrito_mio)-1;$i++)
	{
			$cod=$carrito_mio[$i]['producto'];
			$cant=$carrito_mio[$i]['cantidad'];
			
			//GUARDAR EN BASE DE DATOS PRODUCTOS
		if (mysql_select_db($database_cnx,$cnx))
		{
			$consulta="insert into vy_comprado	( cliente_id, produkt_id, cantidad, fecha) 
									values		('$cliente_id', '$cod', '$cant', '$fecha')"; 
			if (!mysql_query($consulta,$cnx)) 
				echo "<p style='color:red'>error al guardar en db";			
		}
	}	
}
////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////COMIENZA EL ENVIO DE CORREOS ELECTRONICOS//////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////

//CORREO NUMERO 1
$para = $email;
$asunto = 'Estimado usuario gracias por su compra';
$cuerpo = 
"
Estimado $email acabas de comprar con venyor.com\r\n  
Numero de Cuentas a depositar:\r\n 
johana caceres, ci 17298612 cuenta: corriente\r\n 
Banesco: 0134-0946-3100-0103-2741\r\n 
johana caceres, ci 17208612 cuenta: ahorro\r\n 
B.O.D: 0116-0039-5002-0527-0468\r\n 
leonard arrioja, ci 17863357 cuenta: ahorro\r\n 
Sofitasa: 0137-0031-1100-0105-0902\r\n 
leonrd arrioja, ci 17863357 cuenta: ahorro\r\n 
Mercantil: 0105-0735-9007-3506-4075\r\n 
";
$cabecera_extra_str = "From: Ventas@venyor.com\r\nbcc:
//phb@sendhost\r\nContent-type: text/plain\r\nX-mailer: PHP/"
. phpversion();
$mailsend = mail($para, $asunto, $cuerpo, $cabecera_extra_str);

//CORREO NUMERO 2
$para2	= $row_RsDestino2['correo'];
$asunto2 = 'Alguien compro un articulo revisa.';
$cuerpo2 = 
"
Esta persona $email compro revisa.\r\n  
";
$cabecera_extra_str = "From: Ventas@venyor.com\r\nbcc:
//phb@sendhost\r\nContent-type: text/plain\r\nX-mailer: PHP/". phpversion();
$mailsend2 = mail($para2, $asunto2, $cuerpo2, $cabecera_extra_str);

//VERIFICAMOS QUE SE ENVIEN LOS MENSAJES
if($mailsend and $mailsend2 = true)
{
	echo"<script type='text/javascript'>alert('Tu orden ha sido recibida y guardada.');
		window.location='../legal.php?cms=14';</script>
		"; 
//destruyo la secion carrito
		unset($_SESSION['carritovyf']);
//DESTRUYO TODAS LAS SECIONES 
		session_destroy();

}
else echo"En estos momentos su solicitud no pudo ser procesada intente mas tarde";
////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////FINALIZA EL ENVIO DE CORREOS ELECTRONICOS//////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////
?>
<?php
mysql_free_result($RsDestino2);
?>