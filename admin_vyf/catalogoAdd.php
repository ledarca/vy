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
$query_Recordset1 = "SELECT * FROM vy_cat_sujet order by nombre_tema asc";
$Recordset1 = mysql_query($query_Recordset1, $cnx) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="es"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Administrador</title>
  <meta name="viewport" content="width=device-width">

  <link rel="icon"    href="../img/faviconvy.ico" >
  <link rel="stylesheet"  href="css/menu.css" >
  <link rel="stylesheet" href="css/normalize.css">

  <script src="../js/ajax.js"></script>
  <script src="../js/modernizr-2.6.2.min.js"></script>
</head>          

<body>
  <header>
    <!--  COMIENZO DEL HEADER-->
    <h2>Nuevo catálogo</h2>
      <?PHP include('includes/menuHori.php') ?>  
    <!--  FINALIZA EL  HEADER-->
  </header>

  <div id="container">
    <!--  COMIENZO DEL SIDEBAR1-->
    <div id="sidebar">
    <?PHP include('includes/sidebar1.php') ?>  
    </div>
    <!--  FINALIZA EL  SIDEBAR1-->

    <div id="content">
      <div class="primeraLinea">Complete los siguientes datos</div>
      <h2 class="segundaLinea">Insertar catálogo</h2>
      
      <section class="formularioCatalogo">
        <div onLoad="limpiar()">
        <form name="form" action="catalogoAddProcesar.php" method="post" enctype="multipart/form-data">
          <div>

          <h2>Tema:</h2>
          <select name="tema" onChange="from(document.form.tema.value,'categoria','catalogoAddCategoria.php')">
            <option value="0">Seleccione Tema</option>
            <?php do { ?>
            <option value="<?php echo $row_Recordset1['sujet_id']; ?>"><?php echo $row_Recordset1['nombre_tema']; ?></option>
            <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
          </select>
          
          <div id="categoria">
            <h2>Categor&iacute;a:</h2>
            <select name="categoria">
            <option value="0">Seleccione Categor&iacute;a</option>
            </select>
          </div>

          <div id="categoriaSub">
            <h2>Sub Categor&iacute;a:</h2>
            <select name="categoriaSub">
            <option value="0">Seleccione Sub Categor&iacute;a</option>
            </select>
          </div>
          <hr>
          <input type="file" name="foto" />
          <hr>
          <label for="activar">Activar:</label>
          <input name="activar" type="radio" value="1" checked="checked" />
          
          <label for="cantidad">Cantidad:</label>  
          <input name="cantidad" type="text" value="1" maxlength="20"> 
          
          <label for="color">Color:</label>   
          <input name="color" type="text" value="" maxlength="20">

          <label for="descripcion">descripcion:</label>   
          <input name="descripcion" type="text" value="" maxlength="20">
          
          <label for="peso">peso:</label>
          <input name="peso" type="text" value="" maxlength="20">

          <label for="precio">precio:</label>
          <input name="precio" type="text" value="" maxlength="20">

          <label for="referencia">referencia:</label>
          <input type="text" name="referencia" value="" size="20">

          <hr><input type="submit" value="Insertar registro">

        </form>
        </section>
      <!-- end .content --></div>
  <!-- end .container --></div>
</body>
</html>
<?php mysql_free_result($Recordset1); ?>