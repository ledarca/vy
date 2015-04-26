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

if ((isset($_GET['id'])) && ($_GET['id'] != "") && (isset($_POST['procesar']))) {
  $deleteSQL = sprintf("DELETE FROM vy_catalogo WHERE catalogo_id=%s",
                       GetSQLValueString($_GET['id'], "int"));

  mysql_select_db($database_cnx, $cnx);
  $Result1 = mysql_query($deleteSQL, $cnx) or die(mysql_error());

  @unlink("../".$_POST["imagen700"]);

  $deleteGoTo = "catalogoRes.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}

$colname_RsCatalogoDel = "-1";
if (isset($_GET['id'])) {
  $colname_RsCatalogoDel = $_GET['id'];
}
mysql_select_db($database_cnx, $cnx);
$query_RsCatalogoDel = sprintf("SELECT * FROM vy_catalogo WHERE catalogo_id = %s", GetSQLValueString($colname_RsCatalogoDel, "int"));
$RsCatalogoDel = mysql_query($query_RsCatalogoDel, $cnx) or die(mysql_error());
$row_RsCatalogoDel = mysql_fetch_assoc($RsCatalogoDel);
$totalRows_RsCatalogoDel = mysql_num_rows($RsCatalogoDel);

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
  
    <!--  COMIENZO DEL SIDEBAR1-->
    <!-- beg .sidebar1 -->
    <div id="sidebar">
    <?PHP include('includes/sidebar1.php') ?>
    </div>  
    <!--  FINALIZA EL  SIDEBAR1-->

    <!--COMIENZA CONTENIDO-->
    <div id="content">
      <section>
      <form action="" method="post">
      <p>Desea eliminar el producto?</p>
      <p><?php echo $row_RsCatalogoDel['referencia']; ?></p>
      <img src="../<?php echo $row_RsCatalogoDel['imagen700']; ?>" width="350" >
     
      <input name="btnAceptar" type="submit" class="botones" id="btnAceptar" value="Aceptar" />
      <input name="btnCancelar" type="button" class="botones" id="btnCancelar" onclick="javascript:history.back();" value="Cancelar" />
      <input name="procesar" type="hidden" id="procesar" value="1" />
      <input name="imagen700" type="hidden" value="<?php echo $row_RsCatalogoDel['imagen700']; ?>">
      </form>      
      </section>
    </div>
    <!--FINALIZAZA CONTENIDO-->
  <!-- end .container --></div>
</body>
</html>
<?php
mysql_free_result($RsCatalogoDel);
?>
