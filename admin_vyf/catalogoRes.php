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

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_RsCatalogo = 50;
$pageNum_RsCatalogo = 0;
if (isset($_GET['pageNum_RsCatalogo'])) {
  $pageNum_RsCatalogo = $_GET['pageNum_RsCatalogo'];
}
$startRow_RsCatalogo = $pageNum_RsCatalogo * $maxRows_RsCatalogo;

mysql_select_db($database_cnx, $cnx);
$query_RsCatalogo = "SELECT * FROM vy_catalogo ORDER BY catalogo_id DESC";
$query_limit_RsCatalogo = sprintf("%s LIMIT %d, %d", $query_RsCatalogo, $startRow_RsCatalogo, $maxRows_RsCatalogo);
$RsCatalogo = mysql_query($query_limit_RsCatalogo, $cnx) or die(mysql_error());
$row_RsCatalogo = mysql_fetch_assoc($RsCatalogo);

if (isset($_GET['totalRows_RsCatalogo'])) {
  $totalRows_RsCatalogo = $_GET['totalRows_RsCatalogo'];
} else {
  $all_RsCatalogo = mysql_query($query_RsCatalogo);
  $totalRows_RsCatalogo = mysql_num_rows($all_RsCatalogo);
}
$totalPages_RsCatalogo = ceil($totalRows_RsCatalogo/$maxRows_RsCatalogo)-1;

$queryString_RsCatalogo = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_RsCatalogo") == false && 
        stristr($param, "totalRows_RsCatalogo") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RsCatalogo = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RsCatalogo = sprintf("&totalRows_RsCatalogo=%d%s", $totalRows_RsCatalogo, $queryString_RsCatalogo);

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

  <div id="container">
  
    <!-- beg .sidebar1 -->
    <div id="sidebar">
    <?PHP include('includes/sidebar1.php') ?>
    <!--Ejemplo se puede borrar es solo para saber como organizar-->

    <?php do { ?>
      <p><?php echo $row_RsMostrarSi['nombre_categoria']; ?></p>
      <?php } while ($row_RsMostrarSi = mysql_fetch_assoc($RsMostrarSi)); ?>  

    </div>
    <!--  FINALIZA EL  SIDEBAR1-->

    <div id="content"><!--COMIENZA CONTENIDO-->
      <div class="primeraLinea">Resumen<!--Comienza la primera linea gris-->
        <a href="catalogoAdd.php?"><img src="../img/index_add.gif" width="20" height="19" alt="add" title="Nuevo producto"></a>
        <p class="registro">Registros <?php echo min($startRow_RsCatalogo + $maxRows_RsCatalogo, $totalRows_RsCatalogo) ?> de <?php echo $totalRows_RsCatalogo ?></p>
      </div><!--finaliza la primera linea gris-->

      <div class="segundaLinea"><!--Comienza la segunda linea gris-->
        <div>Tabla de Catalogo</div>
      </div><!--Finaliza la segunda linea gris-->      
       
      <!--COMIENZA SECTION--><section>
        <?php do { ?>
          
        <!--COMIENZA SECCION ALINEADA A LA DERECHA--><div class="productoText">
          <div class="imgResumen textoResumen">
            <ul>
              <li><h3>Imagen</h3></li>
              <li><img src="../<?php echo $row_RsCatalogo['imagen700'] ;?>" alt="nombre"><?php if ($row_RsCatalogo['activar'] == 0) echo "No Activo"; ?></li>
            </ul>          
          </div>
            
          <div class="textoResumen">
            <ul>
              <li><h3>Ficha Técnica</h3></li>
              <li><?php echo "Referencia: ".$row_RsCatalogo['referencia'] ;?></li>
              <li><?php echo "Cantidad miníma: ".$row_RsCatalogo['cantidad'] ;?></li>
              <li><?php echo "Precio: ".number_format($row_RsCatalogo['precio'],2,',','.') ;?></li>
              <li><?php echo "Peso: ".number_format($row_RsCatalogo['peso'],2,',','.'); ?></li>
              <li><?php echo "Color: ".$row_RsCatalogo['color'] ;?></li>
              <li><?php echo "Descripcion: ".$row_RsCatalogo['descripcion'] ;?></li>
              <li><?php echo "Activo: ";if ($row_RsCatalogo['activar'] == 0) echo "No"; else echo "Si"; ?></li>
              <li><?php echo "Fecha de subida: ".$row_RsCatalogo['fechasubida'] ;?></li>
            </ul>
          </div>
            
          <div class="textoResumen textoAcciones">
            <ul>
              <li><h3>Acciones</h3></li>
              <li><a href="catalogoMod.php?id=<?php echo $row_RsCatalogo['catalogo_id']; ?>"><span>Modificar</span></a></li>
              <li><a href="catalogoDel.php?id=<?php echo $row_RsCatalogo['catalogo_id']; ?>"><span>Eliminar</span></a></li>
            </ul>
          </div>
          <!--FINALIZA SECCION ALINEADA A LA DERECHA--></div>
          <?php } while ($row_RsCatalogo = mysql_fetch_assoc($RsCatalogo)); ?>              
        <div class="paginador"><!--Comienza el paginador-->
          <div class="paginadorPrimero">
            <?php if ($pageNum_RsCatalogo > 0) { // Show if not first page ?>
            <a href="<?php printf("%s?pageNum_RsCatalogo=%d%s", $currentPage, 0, $queryString_RsCatalogo); ?>">Primero</a>
            <?php } // Show if not first page ?>
          </div>
          <div class="paginadorAnterior">
            <?php if ($pageNum_RsCatalogo > 0) { // Show if not first page ?>
            <a href="<?php printf("%s?pageNum_RsCatalogo=%d%s", $currentPage, max(0, $pageNum_RsCatalogo - 1), $queryString_RsCatalogo); ?>">Anterior</a>
            <?php } // Show if not first page ?>
          </div>
          <div class="paginadorSiguiente">
            <?php if ($pageNum_RsCatalogo < $totalPages_RsCatalogo) { // Show if not last page ?>
            <a href="<?php printf("%s?pageNum_RsCatalogo=%d%s", $currentPage, min($totalPages_RsCatalogo, $pageNum_RsCatalogo + 1), $queryString_RsCatalogo); ?>">Siguiente</a>
            <?php } // Show if not last page ?>
          </div>
          <div class="paginadorUltimo">
            <?php if ($pageNum_RsCatalogo < $totalPages_RsCatalogo) { // Show if not last page ?>
            <a href="<?php printf("%s?pageNum_RsCatalogo=%d%s", $currentPage, $totalPages_RsCatalogo, $queryString_RsCatalogo); ?>">&Uacute;ltimo</a>
            <?php } // Show if not last page ?>
          </div>
        </div><!--Finaliza el paginador-->
      <!--FINALIZA SECTION--></section>
    <!--FINALIZA CONTENIDO--></div>
  <!-- end .container --></div>
</body>
</html>
<?php
mysql_free_result($RsCatalogo);

mysql_free_result($RsMostrarSi);
?>
