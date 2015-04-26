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

mysql_select_db($database_cnx, $cnx);
$query_Rsproducto = "SELECT * FROM vy_cat_productos ORDER BY produkt_id DESC limit 0,15 ";
$Rsproducto = mysql_query($query_Rsproducto, $cnx) or die(mysql_error());
$row_Rsproducto = mysql_fetch_assoc($Rsproducto);
$totalRows_Rsproducto = mysql_num_rows($Rsproducto);


$colname_Rscmslegal = "-1";
if (isset($_GET['cms'])) {
  $colname_Rscmslegal = $_GET['cms'];
}

mysql_select_db($database_cnx, $cnx);
$query_Rscmslegal = sprintf("SELECT * FROM vy_cms WHERE cms_id = %s", GetSQLValueString($colname_Rscmslegal, "int"));
$Rscmslegal = mysql_query($query_Rscmslegal, $cnx) or die(mysql_error());
$row_Rscmslegal = mysql_fetch_assoc($Rscmslegal);
$totalRows_Rscmslegal = mysql_num_rows($Rscmslegal);

?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="es" class="no-js" > <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <title><?php echo "venyor ".$row_Rscmslegal['nombre_cms']; ?></title>
  <meta name="viewport" content="width=device-width">
  <meta name="description" content="<?php echo "venyor pagina de ventas al mayor info: ".$row_Rscmslegal['nombre_cms']; ?>">
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
    <?php include('includes/header.php') ?>
  </header>
  <!-- end header-->
     
  <div class="container_16">

    <!-- beging sidebar-->
   	<?php include('includes/sidebar.php') ?>
    <!-- end sidebar-->      

    <!--beg contenedor legal-->
    <div class="grid_12" id="contenedorLegal">
      <h2 class="separadorVerde"><a href="index.php" title="Ir a inicio">Inicio</a> &gt; <?php echo ucwords($row_Rscmslegal['nombre_cms']); ?></h2>
      
      <?php if ($totalRows_Rscmslegal > 0 ) { // Show if recordset not empty ?>
      <div class="cont_legal">
          <?php echo $row_Rscmslegal['contenido_cms']; ?>
      </div>
      <?php } // Show if recordset not empty ?>

      <!--verificador de url-->
      <?php if ($totalRows_Rscmslegal == 0) { // Show if recordset not empty ?>
      <div class="cont_legal">
        <h1>Hey! Error 404 no le hagas daño a la pagina... </h1>
      </div>
      <?php } // Show if recordset not empty ?>
  </div>
  <div class="clear"></div>
</div>  

  <!--beg. footer-->
  <?php include('includes/footer.php') ?>
  <!--end. footer-->

</body>
</html>
<?php
mysql_free_result($Rsproducto);

mysql_free_result($RsCms);

mysql_free_result($Rscmslegal);

mysql_free_result($RsCursos);

mysql_free_result($RsTema);

mysql_free_result($RsLoNuevo);

mysql_free_result($RsMasVendido);
?>
