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

$colname_RsVendido = "-1";
if (isset($_GET['id'])) {
  $colname_RsVendido = $_GET['id'];
}
mysql_select_db($database_cnx, $cnx);
$query_RsVendido = sprintf("SELECT  vy_comprado.cliente_id, vy_comprado_clientes.nombre, vy_comprado_clientes.email, vy_comprado_clientes.ci, vy_comprado_clientes.telefono, vy_comprado_clientes.direccion, vy_comprado.cantidad, vy_catalogo.catalogo_id, vy_catalogo.imagen700, vy_catalogo.referencia FROM  vy_comprado INNER JOIN vy_comprado_clientes ON vy_comprado.cliente_id = vy_comprado_clientes.clientes_id INNER JOIN vy_catalogo ON vy_catalogo.catalogo_id = vy_comprado.produkt_id WHERE  vy_comprado.cliente_id = %s  ORDER BY vy_catalogo.referencia ASC ", GetSQLValueString($colname_RsVendido, "int"));
$RsVendido = mysql_query($query_RsVendido, $cnx) or die(mysql_error());
$row_RsVendido = mysql_fetch_assoc($RsVendido);
$totalRows_RsVendido = mysql_num_rows($RsVendido);
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="es" class="no-js" > <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  
  <title>Administrador</title>
  
  <link rel="shortcut icon"  href="img/faviconvy.ico">
  <link rel="stylesheet" href="css/normalize.css">  
  <link rel="stylesheet"  href="css/menu.css" >

  <script src="../js/modernizr-2.6.2.min.js"></script>
</head>

<body>
  <!--  COMIENZO DEL HEADER--><header>
    <h2>Hola! Administrador</h2>
    <?PHP include_once('includes/menuHori.php') ?>  
  <!--  FINALIZA EL  HEADER--></header>

  <!-- beg .container --><div id="container">
  
    <!-- beg .sidebar1 -->
    <div id="sidebar">
    <?PHP include('includes/sidebar1.php') ?>  
    </div>
    <!--  FINALIZA EL  SIDEBAR1-->

    <!--COMIENZA CONTENIDO-->
    <div id="content">
    <table border="1" align="center">
    <tr align="center">
    	<td>Nombre:</td>
        <td>E-mail:</td>
        <td>Cedula:</td>
        <td>Telefono:</td>
        <td>Direccion:</td>
    </tr>
    <tr align="center">
    	<td><?php echo $row_RsVendido['nombre']; ?></td>
        <td><?php echo $row_RsVendido['email']; ?></td>
        <td><?php echo $row_RsVendido['ci']; ?></td>
        <td><?php echo $row_RsVendido['telefono']; ?></td>
        <td><?php echo $row_RsVendido['direccion']; ?></td> 
    </tr>
    </table>
    <table border="1" align="center">
      <tr align="center">
        <td>Id catalogo</td>
        <td>Codigo referencia</td>
        <td>imagen</td>
        <td>cantidad</td>
      </tr>
      <?php do { ?>
        <tr align="center">
          <td><?php echo $row_RsVendido['catalogo_id']; ?></td>
          <td><h3 class="mayusculas"><?php echo $row_RsVendido['referencia']; ?></h3></td>
          <td><img src="../<?php echo $row_RsVendido['imagen700']; ?>" width="50" height="50"></td>
          <td><h3 class="mayusculas"><?php echo $row_RsVendido['cantidad']; ?></h3></td>
        </tr>
        <?php } while ($row_RsVendido = mysql_fetch_assoc($RsVendido)); ?>
        <hr>
    </table>
    </div>
    <!--FINALIZAZA CONTENIDO-->
<!-- end .container --></div>
</body>
</html>
<?php
mysql_free_result($RsVendido);
?>
