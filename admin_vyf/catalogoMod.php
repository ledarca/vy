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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE vy_catalogo SET unterkategorie_id=%s, referencia=%s, fechasubida=%s, cantidad=%s, precio=%s, peso=%s, color=%s, descripcion=%s, activar=%s WHERE catalogo_id=%s",
                       GetSQLValueString($_POST['unterkategorie_id'], "int"),
                       GetSQLValueString($_POST['referencia'], "text"),
                       GetSQLValueString($_POST['fechasubida'], "date"),
                       GetSQLValueString($_POST['cantidad'], "int"),
                       GetSQLValueString($_POST['precio'], "double"),
                       GetSQLValueString($_POST['peso'], "double"),
                       GetSQLValueString($_POST['color'], "text"),
                       GetSQLValueString($_POST['descripcion'], "text"),
                       GetSQLValueString(isset($_POST['activar']) ? "true" : "", "defined","'1'","'0'"),
                       GetSQLValueString($_POST['catalogo_id'], "int"));

  mysql_select_db($database_cnx, $cnx);
  $Result1 = mysql_query($updateSQL, $cnx) or die(mysql_error());

  $updateGoTo = "catalogoRes.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_RsModCat = "-1";
if (isset($_GET['id'])) {
  $colname_RsModCat = $_GET['id'];
}
mysql_select_db($database_cnx, $cnx);
$query_RsModCat = sprintf("SELECT * FROM vy_catalogo WHERE catalogo_id = %s", GetSQLValueString($colname_RsModCat, "int"));
$RsModCat = mysql_query($query_RsModCat, $cnx) or die(mysql_error());
$row_RsModCat = mysql_fetch_assoc($RsModCat);
$totalRows_RsModCat = mysql_num_rows($RsModCat);
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
      <section>
        <div class="primeraLinea">Complete los siguientes datos</div>
        <h2 class="segundaLinea">Modificar Tabla</h2>
        <form method="post" name="form1" action="<?php echo $editFormAction; ?>">
          <table align="center">
            <tr valign="baseline">
              <td nowrap align="right">Sub categoria:</td>
              <td><input type="text" name="unterkategorie_id" value="<?php echo htmlentities($row_RsModCat['unterkategorie_id'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
            </tr>
            <tr valign="baseline">
              <td nowrap align="right">Referencia:</td>
              <td><input type="text" name="referencia" value="<?php echo htmlentities($row_RsModCat['referencia'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
            </tr>
            <tr valign="baseline">
              <td nowrap align="right">Imagen Grande:</td>
              <td><img src="../<?php echo $row_RsModCat['imagen700']; ?>" width="150" height="150"></td>
            </tr>
            <tr valign="baseline">
              <td nowrap align="right">Fecha subida:</td>
              <td><input type="text" name="fechasubida" value="<?php echo htmlentities($row_RsModCat['fechasubida'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
            </tr>
            <tr valign="baseline">
              <td nowrap align="right">Cantidad:</td>
              <td><input type="text" name="cantidad" value="<?php echo htmlentities($row_RsModCat['cantidad'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
            </tr>
            <tr valign="baseline">
              <td nowrap align="right">Precio:</td>
              <td><input type="text" name="precio" value="<?php echo htmlentities($row_RsModCat['precio'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
            </tr>
            <tr valign="baseline">
              <td nowrap align="right">Peso:</td>
              <td><input type="text" name="peso" value="<?php echo htmlentities($row_RsModCat['peso'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
            </tr>
              <tr valign="baseline">
              <td nowrap align="right">Color:</td>
              <td><input type="text" name="color" value="<?php echo htmlentities($row_RsModCat['color'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
            </tr>
            <tr valign="baseline">
              <td nowrap align="right" valign="top">Descripcion:</td>
              <td><textarea name="descripcion" cols="50" rows="5"><?php echo htmlentities($row_RsModCat['descripcion'], ENT_COMPAT, 'utf-8'); ?></textarea></td>
            </tr>
            <tr valign="baseline">
              <td nowrap align="right">Activar:</td>
              <td><input type="checkbox" name="activar" value=""  <?php if (!(strcmp(htmlentities($row_RsModCat['activar'], ENT_COMPAT, 'utf-8'),1))) {echo "checked=\"checked\"";} ?>></td>
            </tr>
            <tr valign="baseline">
              <td nowrap align="right">&nbsp;</td>
              <td><input type="submit" value="Actualizar registro"></td>
            </tr>
          </table>
          <input type="hidden" name="MM_update" value="form1">
          <input type="hidden" name="catalogo_id" value="<?php echo $row_RsModCat['catalogo_id']; ?>">
        </form>
      </section>
    </div><!--FINALIZAZA CONTENIDO-->
  <!-- end .container --></div>
</body>
</html>