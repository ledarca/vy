<?php require_once('../Connections/cnx.php'); ?>
<?php
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
$query_RsPregunta = "SELECT Count(vy_cat_productos_pregunta.pregunta_id)FROM vy_cat_productos_pregunta WHERE vy_cat_productos_pregunta.respuesta_si = 1";
$RsPregunta = mysql_query($query_RsPregunta, $cnx) or die(mysql_error());
$row_RsPregunta = mysql_fetch_assoc($RsPregunta);
$totalRows_RsPregunta = mysql_num_rows($RsPregunta);

mysql_select_db($database_cnx, $cnx);
$query_RsComprado = "SELECT vy_comprado.cliente_id, vy_comprado_clientes.nombre FROM vy_comprado INNER JOIN vy_comprado_clientes ON vy_comprado.cliente_id = vy_comprado_clientes.clientes_id GROUP BY vy_comprado_clientes.clientes_id ORDER BY vy_comprado_clientes.clientes_id DESC ";
$RsComprado = mysql_query($query_RsComprado, $cnx) or die(mysql_error());
$row_RsComprado = mysql_fetch_assoc($RsComprado);
$totalRows_RsComprado = mysql_num_rows($RsComprado);
?>

  <h2 class="primeraLinea">MENU</h2>
  <h2 class="segundaLinea">Producto</h2>
  
  <div id="pregunta">
	 <h3 class="primeraLinea">Preguntas</h3>
	 <h2 class="boton"><?php if ($row_RsPregunta['Count(vy_cat_productos_pregunta.pregunta_id)'] == !0) echo"Tienes ".$row_RsPregunta['Count(vy_cat_productos_pregunta.pregunta_id)']." <a href='#'>Responder</a>"; else echo"No tienes preguntas";  ?></h2>
  </div>

  <div id="compras">
	 <h3 class="primeraLinea">Compras</h3>
	 <ul>
	   <?php do { ?>
	   <li><p class="boton"><?php echo $row_RsComprado['nombre']; ?><a href="compras.php?id=<?php echo $row_RsComprado['cliente_id']; ?>" title="ver">ver</a></p></li>
	   <?php } while ($row_RsComprado = mysql_fetch_assoc($RsComprado)); ?>
	 </ul>
  </div>

<?php
mysql_free_result($RsPregunta);

mysql_free_result($RsComprado);
?>
