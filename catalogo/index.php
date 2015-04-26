<?php require_once('../Connections/cnx.php'); ?>
<?php require_once('../procesos/funciones.php'); ?> 
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
?>
<?php
$colname_RsCatalogo = "-1";
if (isset($_GET['ogo'])) {
  $colname_RsCatalogo = $_GET['ogo'];
}
mysql_select_db($database_cnx, $cnx);
$query_RsCatalogo = sprintf("SELECT vy_catalogo.catalogo_id, vy_catalogo.activar, vy_catalogo.descripcion, vy_catalogo.cantidad, vy_catalogo.fechasubida, vy_catalogo.precio, vy_catalogo.peso, vy_catalogo.color, vy_catalogo.referencia, vy_catalogo.imagen60, vy_catalogo.imagen700, vy_cat_unterkategorie.unterkategorie_id, vy_cat_unterkategorie.nombre_subcategoria, vy_cat_unterkategorie.kategorie_id FROM vy_catalogo  INNER JOIN vy_cat_unterkategorie ON vy_catalogo.unterkategorie_id = vy_cat_unterkategorie.unterkategorie_id WHERE vy_cat_unterkategorie.kategorie_id = %s ORDER BY vy_catalogo.referencia ASC ", GetSQLValueString($colname_RsCatalogo, "int"));
$RsCatalogo = mysql_query($query_RsCatalogo, $cnx) or die(mysql_error());
$row_RsCatalogo = mysql_fetch_assoc($RsCatalogo);
$totalRows_RsCatalogo = mysql_num_rows($RsCatalogo);

$colname_RsCategoria = "-1";
if (isset($_GET['ogo'])) {
  $colname_RsCategoria = $_GET['ogo'];
}
mysql_select_db($database_cnx, $cnx);
$query_RsCategoria = sprintf("SELECT vy_cat_unterkategorie.unterkategorie_id, vy_cat_unterkategorie.nombre_subcategoria, vy_cat_unterkategorie.kategorie_id, vy_cat_unterkategorie.sujet_id, vy_cat_unterkategorie.activar, vy_cat_kategorie.nombre_categoria FROM vy_cat_unterkategorie INNER JOIN vy_cat_kategorie ON vy_cat_unterkategorie.kategorie_id = vy_cat_kategorie.kategorie_id WHERE vy_cat_unterkategorie.kategorie_id = %s ORDER BY nombre_subcategoria ASC", GetSQLValueString($colname_RsCategoria, "int"));
$RsCategoria = mysql_query($query_RsCategoria, $cnx) or die(mysql_error());
$row_RsCategoria = mysql_fetch_assoc($RsCategoria);
$totalRows_RsCategoria = mysql_num_rows($RsCategoria);

mysql_select_db($database_cnx, $cnx);
$query_RsMostrarSi = "SELECT DISTINCT vy_cat_kategorie.nombre_categoria, vy_catalogo.imagen700, vy_cat_kategorie.kategorie_id FROM vy_catalogo INNER JOIN vy_cat_unterkategorie ON vy_catalogo.unterkategorie_id = vy_cat_unterkategorie.unterkategorie_id  INNER JOIN vy_cat_kategorie ON vy_cat_unterkategorie.kategorie_id = vy_cat_kategorie.kategorie_id GROUP BY vy_cat_kategorie.nombre_categoria";
$RsMostrarSi = mysql_query($query_RsMostrarSi, $cnx) or die(mysql_error());
$row_RsMostrarSi = mysql_fetch_assoc($RsMostrarSi);
$totalRows_RsMostrarSi = mysql_num_rows($RsMostrarSi);

?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="es" class="no-js" > <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <title><?php echo "Catálogo ".$row_RsCatalogo['nombre_subcategoria']; ?></title>
  <meta name="viewport" content="width=device-width">
  <meta name="description" content="<?php echo "Catálogo ".$row_RsCatalogo['nombre_subcategoria'].", ".$row_RsCatalogo['descripcion']."."; ?>">
  <meta name="distribution" content="global">
  <link rel="shortcut icon"  href="../img/faviconvy.ico"> 
  <link rel="stylesheet"  href="../css/normalize.css">
  <link rel="stylesheet"  href="../css/base.css">
  <!-- beg. Google tag Analytics -->
  <script type="text/javascript">
    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-34176585-1']);
    _gaq.push(['_trackPageview']);

    (function() {
      var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
      ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
      var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();
  </script>
  <!-- end. Google tag Analytics -->
</head>

<body>
  <!-- beging header-->
  <header>
    <?php include('includes/header.php') ?>
  </header>
  <!-- end header-->

  <?php if ($totalRows_RsCatalogo > 0) { // Show if recordset not empty ?>
  <!--COMIENZO DE SIDEBAR-->
  <div id="sidebarCatalogo">
    <p class="author"><a href="index.php">Más<em>Catálagos</em></a></p>
    <ul id="nav">
        <li><a href="#arriba" class="first">Arriba</a></li>
        
        <?php do { ?>
            <li><a href="#<?php echo $row_RsCategoria['nombre_subcategoria']; ?>"><?php echo $row_RsCategoria['nombre_subcategoria']; ?></a></li>
        <?php } while ($row_RsCategoria = mysql_fetch_assoc($RsCategoria)); ?>
        
        <li><a href="#abajo" class="last">Abajo</a></li>
    </ul>
  </div>
  <!--FIN DE SIDEBAR-->

  <div class="container_16">
    <div id="catalogoMain">
      <h2 class="separadorVerde"><a href="../index.php">Inicio</a> &gt; Catálogo </h2>
      
      <div class="bordeBlanco">
      <a name="arriba"></a>
      <?php do { ?>
        <!--Comienzo del cuerpo-->
        <div class="catalogoCentrado">
          
          <!--Muestra el div de agotado-->
          <?php 
          $fecha_0 = $row_RsCatalogo['fechasubida']; 
          $hoy = date('Y-m-d'); 
          if ($row_RsCatalogo['activar']==1) { $ya = diferenciaEntreFechas( $fecha_0, $hoy, 'DIAS', true);
            if ($ya<=20) { /*este script verifica y comprueba que el producto sea nuevo O NO y si es true le coloca la etiqueta NUEVO*/?>
              <div class="nuevo">
                <?php diferenciaEntreFechas( $fecha_0, $hoy, 'DIAS', true)?>
                 <span>NUEVO</span><img src="../<?php echo $row_RsCatalogo['imagen700'];?>" alt="<?php echo $row_RsCatalogo['referencia']; ?>"/>
              </div>             
            <?php } else { ?>
              <img src="../<?php echo $row_RsCatalogo['imagen700'];?>" alt="<?php echo $row_RsCatalogo['referencia']; ?>"/>
            <?php } ?> 
          <?php } else { ?>
            <div class='agotado'><p>agotado</p></div><img src="../<?php echo $row_RsCatalogo['imagen700'];?>" alt="<?php echo $row_RsCatalogo['referencia']; ?>"/> 
          <?PHP } ?>
          <!--Muestra el div de agotado-->

          <div class="izquierda">
          <hgroup>
          	<h2><?php echo "Referencia: ".$row_RsCatalogo['referencia']; ?></h2>
            <h2><?php echo "Peso: ".number_format($row_RsCatalogo['peso'], 2, ',','.')." gr."; ?></h2>
            <h2><?php echo "Descripción: ".$row_RsCatalogo['descripcion']." ". $row_RsCatalogo['nombre_subcategoria']."."; ?><a name="<?php echo $row_RsCatalogo['nombre_subcategoria']; ?>"></a></h2>
          </hgroup>
          </div>

          <div class="derecha">

          	<h2><span><?php echo "Bs. ".number_format($row_RsCatalogo['precio'], 2, ',','.'); ?></span></h2>

            <?php if ($row_RsCatalogo['activar']==1) { ?>
            <form action="../cart/index.php" method="post" name="form2" class="formulario" target="new">
              <input name="cantidad"  type="hidden"   value="<?php echo $row_RsCatalogo['cantidad']; ?>"/>
              <input name="precio"  type="hidden"   value="<?php echo $row_RsCatalogo['precio']; ?>"/>
              <input name="producto"  type="hidden"   value="<?php echo $row_RsCatalogo['catalogo_id']; ?>"/>
              <input name="peso"  type="hidden"   value="<?php echo $row_RsCatalogo['peso']; ?>"/>
              <input name="codigo"  type="hidden"   value="<?php echo $row_RsCatalogo['referencia']; ?>" />
              <input name="color" type="hidden"   value="<?php echo $row_RsCatalogo['color']; ?>"/>
              <input name="carrito" type="submit" value="Añadir al carrito"/>
            </form>
            <?php }  ?>
          </div>
        </div>
        <!--fin del cuerpo-->
      <?php } while ($row_RsCatalogo = mysql_fetch_assoc($RsCatalogo)); ?>
      <div class="clear"></div>
    </div>

    <a name="abajo"></a>
    <?php } // Show if recordset not empty ?>

    <!--BEG. SCRIPT QUE MUESTRA LOS CATALOGOS CUANDO NO SE LE PASA NINGUN PARAMETRO AL INDEX-->
    <?php if ($totalRows_RsCatalogo == 0) { // MUESTRA SI LOS REGISTROS EXISTEN ?>
    <div class="mostrarSi">
      <?php do { ?>
        <div class="uno">
          <h4><a href="index.php?ogo=<?php echo $row_RsMostrarSi['kategorie_id']; ?>"><?php echo $row_RsMostrarSi['nombre_categoria']; ?></a></h4>
          <a href="index.php?ogo=<?php echo $row_RsMostrarSi['kategorie_id']; ?>"><img src="../<?php echo $row_RsMostrarSi['imagen700']; ?>" alt="imagen de catálogo"/></a>
        </div>
      <?php } while ($row_RsMostrarSi = mysql_fetch_assoc($RsMostrarSi)); ?>
    <div class="clear"></div>
    </div>
    <?php } // Show if recordset empty ?>
    <!--END. SCRIPT QUE MUESTRA LOS CATALOGOS CUANDO NO SE LE PASA NINGUN PARAMETRO AL INDEX-->
  </div>
  </div>

  <!--COMIENZA EL FOOTER-->
  <?PHP include('includes/footer.php'); ?>
  <!--FINALIZA EL FOOTER-->

  <script src='https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script> <!-- CDN de google actualizado 15/04/2015 -->
  <script src="../js/subir.js"></script>

  <!--COMIENZA EL TOOLTIP-->
  <div id='IrArriba'>
    <a href='#Arriba'><span><span/></a>
  </div>
  <!--FINALIZA EL TOOLTIP-->
</body>
</html>
<?php
  mysql_free_result($RsCatalogo);
  mysql_free_result($RsCategoria);
  mysql_free_result($RsMostrarSi);
?>
