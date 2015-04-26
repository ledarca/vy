<?php require_once('Connections/cnx.php'); ?>
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

mysql_select_db($database_cnx, $cnx);
$query_RsTema = "SELECT * FROM vy_cat_sujet ORDER BY vy_cat_sujet.nombre_tema ASC";
$RsTema = mysql_query($query_RsTema, $cnx) or die(mysql_error());
$row_RsTema = mysql_fetch_assoc($RsTema);
$totalRows_RsTema = mysql_num_rows($RsTema);

$colname_RsCategoria = "-1";
if (isset($_GET['ema'])) {
  $colname_RsCategoria = $_GET['ema'];
}
mysql_select_db($database_cnx, $cnx);
$query_RsCategoria = sprintf("SELECT vy_cat_sujet.nombre_tema, vy_cat_kategorie.nombre_categoria, vy_cat_sujet.sujet_id, vy_cat_kategorie.activar, vy_cat_kategorie.kategorie_id FROM vy_cat_kategorie INNER JOIN vy_cat_sujet ON vy_cat_kategorie.sujet_id = vy_cat_sujet.sujet_id WHERE vy_cat_kategorie.sujet_id = %s  ORDER BY vy_cat_kategorie.nombre_categoria ASC", GetSQLValueString($colname_RsCategoria, "int"));
$RsCategoria = mysql_query($query_RsCategoria, $cnx) or die(mysql_error());
$row_RsCategoria = mysql_fetch_assoc($RsCategoria);
$totalRows_RsCategoria = mysql_num_rows($RsCategoria);

$colname_RsSubcategoria = "-1";
if (isset($_GET['ria'])) {
  $colname_RsSubcategoria = $_GET['ria'];
}
mysql_select_db($database_cnx, $cnx);
$query_RsSubcategoria = sprintf("SELECT  vy_cat_unterkategorie.unterkategorie_id, vy_cat_unterkategorie.nombre_subcategoria, vy_cat_sujet.sujet_id, vy_cat_sujet.nombre_tema, vy_cat_kategorie.kategorie_id, vy_cat_kategorie.nombre_categoria, vy_cat_unterkategorie.activar FROM vy_cat_unterkategorie INNER JOIN vy_cat_sujet ON vy_cat_sujet.sujet_id = vy_cat_unterkategorie.sujet_id INNER JOIN vy_cat_kategorie ON vy_cat_unterkategorie.kategorie_id = vy_cat_kategorie.kategorie_id WHERE vy_cat_kategorie.kategorie_id  = %s ORDER BY vy_cat_unterkategorie.nombre_subcategoria ASC", GetSQLValueString($colname_RsSubcategoria, "int"));
$RsSubcategoria = mysql_query($query_RsSubcategoria, $cnx) or die(mysql_error());
$row_RsSubcategoria = mysql_fetch_assoc($RsSubcategoria);
$totalRows_RsSubcategoria = mysql_num_rows($RsSubcategoria);

$maxRows_RsProductosTema = 10;
$pageNum_RsProductosTema = 0;
if (isset($_GET['pageNum_RsProductosTema'])) {
  $pageNum_RsProductosTema = $_GET['pageNum_RsProductosTema'];
}
$startRow_RsProductosTema = $pageNum_RsProductosTema * $maxRows_RsProductosTema;

$colname_RsProductosTema = "-1";
if (isset($_GET['ema'])) {
  $colname_RsProductosTema = $_GET['ema'];
}
mysql_select_db($database_cnx, $cnx);
$query_RsProductosTema = sprintf("SELECT vy_cat_productos.produkt_id, vy_cat_productos.nombre_prod, vy_cat_productos.descripcion_prod, vy_cat_productos.color_prod, vy_cat_productos.unidad_prod, vy_cat_productos.precio_prod,  vy_cat_productos.peso_prod, vy_cat_productos.cantidad_prod, vy_cat_productos.imagen60, vy_cat_productos.imagen100, vy_cat_productos.activar, vy_cat_productos.fecha_ingreso, vy_cat_sujet.sujet_id, vy_cat_sujet.nombre_tema, vy_cat_productos.catalogo, vy_cat_productos.kategorie_id FROM vy_cat_productos INNER JOIN vy_cat_sujet ON vy_cat_sujet.sujet_id = vy_cat_productos.sujet_id WHERE vy_cat_productos.sujet_id = %s ORDER BY vy_cat_productos.produkt_id desc", GetSQLValueString($colname_RsProductosTema, "int"));
$query_limit_RsProductosTema = sprintf("%s LIMIT %d, %d", $query_RsProductosTema, $startRow_RsProductosTema, $maxRows_RsProductosTema);
$RsProductosTema = mysql_query($query_limit_RsProductosTema, $cnx) or die(mysql_error());
$row_RsProductosTema = mysql_fetch_assoc($RsProductosTema);

if (isset($_GET['totalRows_RsProductosTema'])) {
  $totalRows_RsProductosTema = $_GET['totalRows_RsProductosTema'];
} else {
  $all_RsProductosTema = mysql_query($query_RsProductosTema);
  $totalRows_RsProductosTema = mysql_num_rows($all_RsProductosTema);
}
$totalPages_RsProductosTema = ceil($totalRows_RsProductosTema/$maxRows_RsProductosTema)-1;

$queryString_RsProductosTema = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_RsProductosTema") == false && 
        stristr($param, "totalRows_RsProductosTema") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RsProductosTema = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RsProductosTema = sprintf("&totalRows_RsProductosTema=%d%s", $totalRows_RsProductosTema, $queryString_RsProductosTema);

$maxRows_RsProductosCate = 10;
$pageNum_RsProductosCate = 0;
if (isset($_GET['pageNum_RsProductosCate'])) {
  $pageNum_RsProductosCate = $_GET['pageNum_RsProductosCate'];
}
$startRow_RsProductosCate = $pageNum_RsProductosCate * $maxRows_RsProductosCate;

$colname_RsProductosCate = "-1";
if (isset($_GET['ria'])) {
  $colname_RsProductosCate = $_GET['ria'];
}

mysql_select_db($database_cnx, $cnx);
$query_RsProductosCate = sprintf("SELECT vy_cat_productos.produkt_id, vy_cat_kategorie.kategorie_id, vy_cat_kategorie.nombre_categoria, vy_cat_kategorie.sujet_id, vy_cat_productos.nombre_prod, vy_cat_productos.descripcion_prod, vy_cat_productos.color_prod, vy_cat_productos.peso_prod, vy_cat_productos.unidad_prod, vy_cat_productos.precio_prod, vy_cat_productos.cantidad_prod, vy_cat_productos.nuevo_prod, vy_cat_productos.imagen100, vy_cat_productos.fecha_ingreso, vy_cat_productos.catalogo, vy_cat_productos.kategorie_id  FROM vy_cat_productos INNER JOIN vy_cat_kategorie ON vy_cat_productos.kategorie_id = vy_cat_kategorie.kategorie_id WHERE vy_cat_productos.kategorie_id = %s ORDER BY vy_cat_productos.nombre_prod asc", GetSQLValueString($colname_RsProductosCate, "int"));
$query_limit_RsProductosCate = sprintf("%s LIMIT %d, %d", $query_RsProductosCate, $startRow_RsProductosCate, $maxRows_RsProductosCate);
$RsProductosCate = mysql_query($query_limit_RsProductosCate, $cnx) or die(mysql_error());
$row_RsProductosCate = mysql_fetch_assoc($RsProductosCate);

if (isset($_GET['totalRows_RsProductosCate'])) {
  $totalRows_RsProductosCate = $_GET['totalRows_RsProductosCate'];
} else {
  $all_RsProductosCate = mysql_query($query_RsProductosCate);
  $totalRows_RsProductosCate = mysql_num_rows($all_RsProductosCate);
}
$totalPages_RsProductosCate = ceil($totalRows_RsProductosCate/$maxRows_RsProductosCate)-1;


$queryString_RsProductosCate = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_RsProductosCate") == false && 
        stristr($param, "totalRows_RsProductosCate") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RsProductosCate = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RsProductosCate = sprintf("&totalRows_RsProductosCate=%d%s", $totalRows_RsProductosCate, $queryString_RsProductosCate);

$maxRows_RsProductosScat = 10;
$pageNum_RsProductosScat = 0;
if (isset($_GET['pageNum_RsProductosScat'])) {
  $pageNum_RsProductosScat = $_GET['pageNum_RsProductosScat'];
}
$startRow_RsProductosScat = $pageNum_RsProductosScat * $maxRows_RsProductosScat;

$colname_RsProductosScat = "-1";
if (isset($_GET['sria'])) {
  $colname_RsProductosScat = $_GET['sria'];
}
mysql_select_db($database_cnx, $cnx);

$query_RsProductosScat = sprintf("SELECT  vy_cat_productos.produkt_id, vy_cat_productos.kategorie_id, vy_cat_unterkategorie.unterkategorie_id, vy_cat_unterkategorie.nombre_subcategoria, vy_cat_unterkategorie.kategorie_id, vy_cat_unterkategorie.sujet_id, vy_cat_productos.nuevo_prod, vy_cat_productos.cantidad_prod, vy_cat_productos.precio_prod, vy_cat_productos.unidad_prod, vy_cat_productos.peso_prod, vy_cat_productos.color_prod, vy_cat_productos.descripcion_prod, vy_cat_productos.nombre_prod, vy_cat_productos.imagen100, vy_cat_productos.activar, vy_cat_productos.fecha_ingreso, vy_cat_productos.catalogo, vy_cat_productos.kategorie_id FROM vy_cat_productos INNER JOIN vy_cat_unterkategorie ON vy_cat_productos.unterkategorie_id = vy_cat_unterkategorie.unterkategorie_id WHERE vy_cat_productos.unterkategorie_id = %s ORDER BY vy_cat_productos.produkt_id desc", GetSQLValueString($colname_RsProductosScat, "int"));
$query_limit_RsProductosScat = sprintf("%s LIMIT %d, %d", $query_RsProductosScat, $startRow_RsProductosScat, $maxRows_RsProductosScat);
$RsProductosScat = mysql_query($query_limit_RsProductosScat, $cnx) or die(mysql_error());
$row_RsProductosScat = mysql_fetch_assoc($RsProductosScat);

if (isset($_GET['totalRows_RsProductosScat'])) {
  $totalRows_RsProductosScat = $_GET['totalRows_RsProductosScat'];
} else {
  $all_RsProductosScat = mysql_query($query_RsProductosScat);
  $totalRows_RsProductosScat = mysql_num_rows($all_RsProductosScat);
}
$totalPages_RsProductosScat = ceil($totalRows_RsProductosScat/$maxRows_RsProductosScat)-1;

$queryString_RsProductosScat = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_RsProductosScat") == false && 
        stristr($param, "totalRows_RsProductosScat") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RsProductosScat = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RsProductosScat = sprintf("&totalRows_RsProductosScat=%d%s", $totalRows_RsProductosScat, $queryString_RsProductosScat);
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="es" class="no-js" > <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <title><?php echo "Venyor ventas al mayor de ".$row_RsProductosTema['nombre_tema']." ".$row_RsProductosCate['nombre_categoria']." ".$row_RsProductosScat['nombre_subcategoria']; ?></title>
  <meta name="viewport" content="width=device-width">
  <meta name="description" content="<?php echo "Ventas al mayor de ".$row_RsProductosTema['nombre_tema']." ".$row_RsProductosCate['nombre_categoria']." ".$row_RsProductosScat['nombre_subcategoria']; ?>">
  <meta name="author" content="Ing. Arrioja Leonard, ledarca@venyor.com, +58 426-1445000">
  <meta name="distribution" content="global">
  <link rel="shortcut icon"  href="img/faviconvy.ico">
  <link rel="stylesheet"  href="css/normalize.css">
  <link rel="stylesheet"  href="css/base.css">

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
  <!-- Google Tag Manager -->
  <noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-H5D3"
  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
  new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
  j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
  '//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
  })(window,document,'script','dataLayer','GTM-H5D3');</script>
  <!-- End Google Tag Manager -->

  <!-- beging header-->
  <header>
    <?php include('includes/header.php'); ?>
  </header>
  <!-- end header-->

  <div class="container_16">

    <!--   COMIENZA SIDEBAR CATEGORIA-->
    <?php include('includes/sidebarCat.php');?>
    <!--   FINALIZA SIDEBAR CATEGORIA-->	

    <!--   COMIENZA CONTENEDOR DE PRODUCTOS-->   
    <div class="grid_12">
      <h2 class="separadorVerde"><a href="index.php">Inicio</a><?php echo" &gt; ". $row_RsProductosTema['nombre_tema']." &gt; ". $row_RsProductosCate['nombre_categoria']." &gt; ". $row_RsProductosScat['nombre_subcategoria']; ?></h2>

      <!--==========COMIENZO DEL BLOQUE INTERIOR DETALLE CATEGORIA=======================-->      
      <?php if($totalRows_RsProductosCate !==0 and $totalRows_RsProductosScat !==0) {	echo"
      <div class='detalleCatMain'>"; do { if ($row_RsProductosScat['catalogo'] == true) print "<!--/*==========COMIENZA EL DIV SUB-CATEGORIA=======================*/-->

        <div class='contenidoDetalle'> <!--/*==========COMIENZO DEL CONTENIDO DETALLE DONDE ES ENLACE AL CATÁLOGO=======================*/-->
          <div class='contenidoDetalleImagen'>
            <a href=\"detallePro.php?cto=".$row_RsProductosScat['produkt_id']."&dos=".$row_RsProductosScat['kategorie_id']."\"><img src='".$row_RsProductosScat['imagen100']."' alt='imagen'/></a>     
          </div>
          
          <div class='contenidoDetalleTexto'>
            <h2><a href=\"detallePro.php?cto=".$row_RsProductosScat['produkt_id']."&dos=".$row_RsProductosScat['kategorie_id']."\">".$row_RsProductosScat['nombre_prod']."</a></h2>
            <h3>".$row_RsProductosScat['descripcion_prod']."</h3>
            <h4> Bs. ". number_format($row_RsProductosScat['precio_prod'], 2, ',', ' ')."</h4>
          </div>

          <div class='contenidoDetalleBoton'>
          <p class='boton'><a href=catalogo/index.php?ogo=".$row_RsProductosScat['kategorie_id'].">Ver Catálogo</a></p>
          </div>
        </div> <!--/*==========FINAL DEL CONTENIDO DETALLE=======================*/-->

        "; else { print	"

        <div class='contenidoDetalle'> <!--/*==========COMIENZO DEL CONTENIDO DETALLE DONDE ES BOTON AL CATÁLOGO=======================*/-->
          <div class='contenidoDetalleImagen'>
            <a href=\"detallePro.php?cto=".$row_RsProductosScat['produkt_id']."&dos=".$row_RsProductosScat['kategorie_id']."\"><img src='".$row_RsProductosScat['imagen100']."' alt='imagen'/></a>     
          </div>
          
          <div class='contenidoDetalleTexto'>
            <h2><a href=\"detallePro.php?cto=".$row_RsProductosScat['produkt_id']."&dos=".$row_RsProductosScat['kategorie_id']."\">".$row_RsProductosScat['nombre_prod']."</a></h2>
            <h3>".$row_RsProductosScat['descripcion_prod']."</h3>
            <h4> Bs. ". number_format($row_RsProductosScat['precio_prod'], 2, ',', ' ')."</h4>
          </div>

          <div class='contenidoDetalleBoton'>
            <form   action='carrito.php' method='post'  name='form1' target='new'>
              <input name='cantidad'  type='hidden'   value='1'/>
              <input name='precio'  type='hidden'   value='\$row_RsProducto['precio_prod']\'/>
              <input name='producto'  type='hidden'   value=''/>
              <input name='peso'    type='hidden' value='10'/>
              <input name='codigo'  type='hidden'   value=''/>
              <input name='color'   type='hidden'   value=''/>      
              <input name='carrito'   type='submit'   value='A&ntilde;adir a carrito' />
            </form>
          </div>
        </div><!--/*==========FINAL DEL CONTENIDO DETALLE=======================*/-->"; }	
        } while ($row_RsProductosScat = mysql_fetch_assoc($RsProductosScat));	?>

        <div class="paginacion_1">
          <div class="contador">
            <P><?php echo ($startRow_RsProductosScat + 1) ?> de <?php echo $totalRows_RsProductosScat ?></P>
          </div>

          <div class="paginador">
            <?php if ($pageNum_RsProductosScat > 0) { // Show if not first page ?>
            <p class="boton"><a href="<?php printf("%s?pageNum_RsProductosScat=%d%s", $currentPage, 0, $queryString_RsProductosScat); ?>">Primero</a></p>
            <?php } // Show if not first page ?>
              
            <?php if ($pageNum_RsProductosScat > 0) { // Show if not first page ?>
            <p class="boton"><a href="<?php printf("%s?pageNum_RsProductosScat=%d%s", $currentPage, max(0, $pageNum_RsProductosScat - 1), $queryString_RsProductosScat); ?>">Anterior</a></p>
            <?php } // Show if not first page ?>
             
            <?php if ($pageNum_RsProductosScat < $totalPages_RsProductosScat) { // Show if not last page ?>
            <p class="boton"><a href="<?php printf("%s?pageNum_RsProductosScat=%d%s", $currentPage, min($totalPages_RsProductosScat, $pageNum_RsProductosScat + 1), $queryString_RsProductosScat); ?>">Siguiente</a></p>
            <?php } // Show if not last page ?>
              
            <?php if ($pageNum_RsProductosScat < $totalPages_RsProductosScat) { // Show if not last page ?>
            <p class="boton"><a href="<?php printf("%s?pageNum_RsProductosScat=%d%s", $currentPage, $totalPages_RsProductosScat, $queryString_RsProductosScat); ?>">&Uacute;ltimo</a></p>
            <?php } // Show if not last page ?>
          </div>
        </div>
      </div><!--FINLIZA DIV SUB-CATEGORIA-->

      <!--/*======================================================================================================================*/	-->
      <!--/*======================================================================================================================*/	-->
      	<?php } elseif ($totalRows_RsProductosCate !==0 ) {
      /*======================================================================================================================*/	
      /*======================================================================================================================*/	

      /*==========COMIENZO=============CATEGORIA=======================*/print"
      <div class='detalleCatMain'>";  do { if ($row_RsProductosCate['catalogo'] == true) print "

        <div class='contenidoDetalle'> <!--/*==========COMIENZO DEL CONTENIDO DETALLE DONDE ES ENLACE AL CATÁLOGO=======================*/-->
          <div class='contenidoDetalleImagen'>
            <a href=\"detallePro.php?cto=".$row_RsProductosCate['produkt_id']."&dos=".$row_RsProductosCate['kategorie_id']."\"><img src='".$row_RsProductosCate['imagen100']."' alt='imagen'/></a>         
          </div>
          
          <div class='contenidoDetalleTexto'>
            <h2><a href=\"detallePro.php?cto=".$row_RsProductosCate['produkt_id']."&dos=".$row_RsProductosCate['kategorie_id']."\">".$row_RsProductosCate['nombre_prod']."</a></h2>
            <h3>".$row_RsProductosCate['descripcion_prod']."</h3>
            <h4> Bs. ". number_format($row_RsProductosCate['precio_prod'], 2, ',', ' ')."</h4>
          </div>

          <div class='contenidoDetalleBoton'>
          <p class='boton'><a href=catalogo/index.php?ogo=".$row_RsProductosCate['kategorie_id'].">Ver Catálogo</a></p>
          </div>
        </div> <!--/*==========FINAL DEL CONTENIDO DETALLE=======================*/-->

      	"; else { print "

        <div class='contenidoDetalle'> <!--/*==========COMIENZO DE BOTON CATEGORIA=======================*/-->
          <div class='contenidoDetalleImagen'>
            <a href=\"detallePro.php?cto=".$row_RsProductosCate['produkt_id']."&dos=".$row_RsProductosCate['kategorie_id']."\"><img src='".$row_RsProductosCate['imagen100']."' alt='imagen'/></a>         
          </div>
          
          <div class='contenidoDetalleTexto'>
            <h2><a href=\"detallePro.php?cto=".$row_RsProductosCate['produkt_id']."&dos=".$row_RsProductosCate['kategorie_id']."\">".$row_RsProductosCate['nombre_prod']."</a></h2>
            <h3>".$row_RsProductosCate['descripcion_prod']."</h3>
            <h4> Bs. ". number_format($row_RsProductosCate['precio_prod'], 2, ',', ' ')."</h4>
          </div>

          <div class='contenidoDetalleBoton'>
            <form   action='carrito.php' method='post'  name='form1' target='new' >
              <input name='cantidad'  type='hidden'   value='1'/>
              <input name='precio'  type='hidden'   value='\$row_RsProducto['precio_prod']\'/>
              <input name='producto'  type='hidden'   value=''/>
              <input name='peso'    type='hidden' value='10'/>
              <input name='codigo'  type='hidden'   value=''/>
              <input name='color'   type='hidden'   value=''/>      
              <input name='carrito'   type='submit'   value='A&ntilde;adir a carrito' />
            </form>
          </div>
        </div>

        <!--/*==========FIN DE BOTON CATEGORIA=======================*/-->"; }
       	} while ($row_RsProductosCate = mysql_fetch_assoc($RsProductosCate));	?>

        <div class="paginacion_1">
          <div class="contador">
            <P><?php echo ($startRow_RsProductosCate + 1)." de ".$totalRows_RsProductosCate ?></P>
          </div>

          <div class="paginador">
            <?php if ($pageNum_RsProductosCate > 0) { // Show if not first page ?>
            <p class="boton"><a href="<?php printf("%s?pageNum_RsProductosCate=%d%s", $currentPage, 0, $queryString_RsProductosCate); ?>">Primero</a></p>
            <?php } // Show if not first page ?>
                
            <?php if ($pageNum_RsProductosCate > 0) { // Show if not first page ?>
            <p class="boton"><a href="<?php printf("%s?pageNum_RsProductosCate=%d%s", $currentPage, max(0, $pageNum_RsProductosCate - 1), $queryString_RsProductosCate); ?>">Anterior</a></p>
            <?php } // Show if not first page ?>
                
            <?php if ($pageNum_RsProductosCate < $totalPages_RsProductosCate) { // Show if not last page ?>
            <p class="boton"><a href="<?php printf("%s?pageNum_RsProductosCate=%d%s", $currentPage, min($totalPages_RsProductosCate, $pageNum_RsProductosCate + 1), $queryString_RsProductosCate); ?>">Siguiente</a></p>
            <?php } // Show if not last page ?>
                
           <?php if ($pageNum_RsProductosCate < $totalPages_RsProductosCate) { // Show if not last page ?>
            <p class="boton"><a href="<?php printf("%s?pageNum_RsProductosCate=%d%s", $currentPage, $totalPages_RsProductosCate, $queryString_RsProductosCate); ?>">&Uacute;ltimo</a></p>
            <?php } // Show if not last page ?>
          </div>
        </div>
      </div> <?php 			
      /*==========FIN=============CATEGORIA=======================*/
  	
      /*======================================================================================================================*/	
      /*======================================================================================================================*/	
      	} else { if ($totalRows_RsProductosTema > 0) { /* Show if recordset not empty*/ 
      /*======================================================================================================================*/	
      /*======================================================================================================================*/	

      /*==========COMIENZO DEL CONTENEDOR TEMA=======================*/print"
      <div class='detalleCatMain'>";/*==========COMIENZO DEL BLOQUE TEMA=======================*/do { if ($row_RsProductosTema['catalogo'] == true) print "

        <div class='contenidoDetalle'> <!--/*==========Cuando el producto tiene catalogo sale este boton=======================*/-->
          <div class='contenidoDetalleImagen'>
            <a href=\"detallePro.php?cto=".$row_RsProductosTema['produkt_id']."&dos=".$row_RsProductosTema['kategorie_id']."\"><img src='".$row_RsProductosTema['imagen100']."' alt='imagen'/></a> 
          </div>
          
          <div class='contenidoDetalleTexto'>
            <h2> <a href=\"detallePro.php?cto=".$row_RsProductosTema['produkt_id']."&dos=".$row_RsProductosTema['kategorie_id']."\">".$row_RsProductosTema['nombre_prod']."</a></h2>
            <h3>".$row_RsProductosTema['descripcion_prod']."</h3>
            <h4> Bs. ". number_format($row_RsProductosTema['precio_prod'], 2, ',', ' ')."</h4>
          </div>

          <div class='contenidoDetalleBoton'>
          <p class='boton'><a href=catalogo/index.php?ogo=".$row_RsProductosTema['kategorie_id'].">Ver Catalogo</a></p>
          </div>
        </div>
        
        "; else { print
        "
        <div class='contenidoDetalle'> <!--/*==========Cuando el producto no tiene OJO no tiene catalogo sale este boton=======================*/-->
          <div class='contenidoDetalleImagen'>
            <a href=\"detallePro.php?cto=".$row_RsProductosTema['produkt_id']."&dos=".$row_RsProductosTema['kategorie_id']."\"><img src='".$row_RsProductosTema['imagen100']."' alt='imagen'/></a> 
          </div>
          
          <div class='contenidoDetalleTexto'>
            <h2> <a href=\"detallePro.php?cto=".$row_RsProductosTema['produkt_id']."&dos=".$row_RsProductosTema['kategorie_id']."\">".$row_RsProductosTema['nombre_prod']."</a></h2>
            <h3>".$row_RsProductosTema['descripcion_prod']."</h3>
            <h4> Bs. ".number_format($row_RsProductosTema['precio_prod'], 2, ',', ' ')."</h4>
          </div>

          <div class='contenidoDetalleBoton'>
            <form   action='cart/index.php' method='post'   name='form1' target='new' >
              <input name='cantidad'  type='hidden'   value='1'/>
              <input name='precio'  type='hidden'   value='\$row_RsProducto['precio_prod']\'/>
              <input name='producto'  type='hidden'   value=''/>
              <input name='peso'    type='hidden' value='10'/>
              <input name='codigo'  type='hidden'   value=''/>
              <input name='color'   type='hidden'   value=''/>      
              <input name='carrito'   type='submit'   value='A&ntilde;adir a carrito' />
            </form>
          </div>
      </div>

      <!--/*==========FIN DE BOTON TEMA=======================*/-->		
      ";} //Termina la condicion que muestra si existe el catalogo
      } while ($row_RsProductosTema = mysql_fetch_assoc($RsProductosTema));	
      } /*Show if recordset not empty*/
  	 
      	 /*=======REDIRECCIONAR SI se ESTA METIENDO DATOS NO=======*/
         /*	 if ($totalRows_RsProductosTema == 0 && $totalRows_RsProductosTema == 0) 
      	 {  echo "<h1>Estas perdido ubicate por <a href='index.php'>aqui</a></h1>"; }*/
      	 /*=======REDIRECCIONAR SI ESTA METIENDO DATOS NO=======*/
      ?>        
      <div class="paginacion_1">
        <div class="contador">
          <p><?php echo ($startRow_RsProductosTema + 1) ?> de <?php echo $totalRows_RsProductosTema ?></p>
        </div>

        <div class="paginador">
          <?php if ($pageNum_RsProductosTema > 0) { // Show if not first page ?>
          <p class="boton"><a href="<?php printf("%s?pageNum_RsProductosTema=%d%s", $currentPage, 0, $queryString_RsProductosTema); ?>">Primero</a></p>
          <?php } // Show if not first page ?>
          
          <?php if ($pageNum_RsProductosTema > 0) { // Show if not first page ?>
          <p class="boton"><a href="<?php printf("%s?pageNum_RsProductosTema=%d%s", $currentPage, max(0, $pageNum_RsProductosTema - 1), $queryString_RsProductosTema); ?>">Anterior</a></p>
          <?php } // Show if not first page ?>
          
          <?php if ($pageNum_RsProductosTema < $totalPages_RsProductosTema) { // Show if not last page ?>
          <p class="boton"><a href="<?php printf("%s?pageNum_RsProductosTema=%d%s", $currentPage, min($totalPages_RsProductosTema, $pageNum_RsProductosTema + 1), $queryString_RsProductosTema); ?>">Siguiente</a></p>
          <?php } // Show if not last page ?>
          
          <?php if ($pageNum_RsProductosTema < $totalPages_RsProductosTema) { // Show if not last page ?>
          <p class="boton"><a href="<?php printf("%s?pageNum_RsProductosTema=%d%s", $currentPage, $totalPages_RsProductosTema, $queryString_RsProductosTema); ?>">&Uacute;ltimo</a></p>
          <?php } // Show if not last page ?>
        </div>
      </div>  <?php }   /*==========================FIN DE TEMA=======================*/ ?>
    <div class='clear'></div>
    </div>
  </div>
  <div class="clear"></div>
  </div>
  <!--   FINALIZA CONTENEDOR DE PRODUCTOS-->  

  <!--COMIENZO DE FOOTER-->
  <?php include('includes/footer.php') ?>
  <!--FIN DE FOOTER-->

</body>
</html>


<?php
mysql_free_result($RsTema);

mysql_free_result($RsCategoria);

mysql_free_result($RsSubcategoria);

mysql_free_result($RsProductosTema);

mysql_free_result($RsProductosCate);

mysql_free_result($RsProductosScat);
?>
