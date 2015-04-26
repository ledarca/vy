<?php require_once('Connections/cnx.php'); ?>
<?php require_once('procesos/funciones.php'); ?>
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

$maxRows_Rsproducto = 35;
$pageNum_Rsproducto = 0;
if (isset($_GET['pageNum_Rsproducto'])) {
  $pageNum_Rsproducto = $_GET['pageNum_Rsproducto'];
}
$startRow_Rsproducto = $pageNum_Rsproducto * $maxRows_Rsproducto;

mysql_select_db($database_cnx, $cnx);
$query_Rsproducto = "SELECT vy_cat_productos.produkt_id, vy_cat_productos.kategorie_id, vy_cat_productos.unterkategorie_id, vy_cat_productos.sujet_id, vy_cat_productos.nombre_prod, vy_cat_productos.precio_prod, vy_cat_productos.fecha_ingreso, vy_cat_productos.imagen100 FROM vy_cat_productos ORDER BY vy_cat_productos.produkt_id DESC";
$query_limit_Rsproducto = sprintf("%s LIMIT %d, %d", $query_Rsproducto, $startRow_Rsproducto, $maxRows_Rsproducto);
$Rsproducto = mysql_query($query_limit_Rsproducto, $cnx) or die(mysql_error());
$row_Rsproducto = mysql_fetch_assoc($Rsproducto);

if (isset($_GET['totalRows_Rsproducto'])) {
  $totalRows_Rsproducto = $_GET['totalRows_Rsproducto'];
} else {
  $all_Rsproducto = mysql_query($query_Rsproducto);
  $totalRows_Rsproducto = mysql_num_rows($all_Rsproducto);
}
$totalPages_Rsproducto = ceil($totalRows_Rsproducto/$maxRows_Rsproducto)-1;
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="es" class="no-js" > <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <title>Venyor ventas al mayor de Bisutería, cotillones, juguetes y merceria</title>
  <meta name="viewport" content="width=device-width">
  <meta name="description" content="Ventas al mayor bisuteria lazos papel de regalo bolsas de regalo merceria cintas gross juguetes mario princesas">
  <meta name="keywords" content="<?php echo getMetaKeywords('Ventas al mayor bisuteria lazos papel de regalo bolsas de regalo merceria cintas gross juguetes mario princesas'); ?>">
  <meta name="author" content="Ing. Arrioja Leonard, ledarca@venyor.com, +58 426-1445000">
  <meta name="distribution" content="global">
  <meta http-equiv="refresh" content="1800">
  <link rel="shortcut icon"  href="img/faviconvy.ico">
  <link rel="stylesheet"  href="css/normalize.css">
  <link rel="stylesheet"  href="css/base.css">
  <link rel="stylesheet" type="text/css" href="css/style_common.css">
  <link rel="stylesheet" type="text/css" href="css/style1.css">

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
  	<?php include('includes/header.php') ?>
  </header>
  <!-- end header-->

  <div class="container_16">

    <!-- beging sidebar-->
    <?php include('includes/sidebar.php') ?>
    <!-- end sidebar-->                
        
    <!--COMIENZO DE PRODUCTOS DESTACADOS-->
    <section id="productosDestacados" class="grid_12">
      <!--COMIENZO DE GALERIA-->  
      <div id="galeria">
        <img src="photo/slider/slide_00.jpg" alt="segunda"/>
        <img src="photo/slider/slide_01.jpg" alt="segunda"/>
        <img src="photo/slider/slide_02.jpg" alt="tercera"/>
        <img src="photo/slider/slide_03.jpg" alt="cuarta"/>
      </div>
      <!--FIN DE GALERIA--> 

      <h2 class="separadorVerde">productos destacados</h2>

        <?php do { ?>
        <article>
            <?php /* este script verifica y comprueba que el producto sea nuevo para colocarle la etiqueta*/
            $fecha_0 = $row_Rsproducto['fecha_ingreso']; 
            $hoy = date('Y-m-d'); 
            if (diferenciaEntreFechas( $fecha_0, $hoy, "DIAS", true) < 85) 
            { ?>
            <div class="view view-first nuevo">
              <span>NUEVO</span>
              <img src="<?php echo $row_Rsproducto['imagen100']; ?>">
              <h3><?php echo ucwords($row_Rsproducto['nombre_prod']); ?></h3>
              <div class="mask">
                <h2><?php echo "Bs. ". number_format($row_Rsproducto['precio_prod'], 2, ',', ' '); ?></h2>
                <p><?php echo ucwords($row_Rsproducto['nombre_prod']); ?></p>
                <a href="detallePro.php?cto=<?php echo $row_Rsproducto['produkt_id']; ?>&dos=<?php echo $row_Rsproducto['kategorie_id']; ?>" class="info">Ver más</a>
                </div>  
            </div>
            <?php } 
            else 
            { ?>
            <div class="view view-first">
              <img src="<?php echo $row_Rsproducto['imagen100']; ?>">
              <h3><?php echo ucwords($row_Rsproducto['nombre_prod']); ?></h3>
              <div class="mask">
                <h2><?php echo "Bs. ". number_format($row_Rsproducto['precio_prod'], 2, ',', ' '); ?></h2>
                <p><?php echo ucwords($row_Rsproducto['nombre_prod']); ?></p>
                <a href="detallePro.php?cto=<?php echo $row_Rsproducto['produkt_id']; ?>&dos=<?php echo $row_Rsproducto['kategorie_id']; ?>" class="info">Ver más</a>
                </div>
            </div>
            <?php }
            ?>
          </article>
          <?php } while ($row_Rsproducto = mysql_fetch_assoc($Rsproducto)); ?>
    </section>
    <div class="clear"></div>
  </div>     
    <!--FIN DE PRODUCTOS DESTACADOS--> 
  </div>
  	<?php include('includes/footer.php') ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script src="js/modernizr.js"></script>
    <script src="js/base.js"></script>

  </body>
</html>

 <?php
mysql_free_result($Rsproducto);


mysql_free_result($RsCms);

mysql_free_result($RsProducto);

mysql_free_result($RsLoNuevo);

mysql_free_result($RsCursos);

mysql_free_result($RsTema);

mysql_free_result($RsMasVendido);
?>