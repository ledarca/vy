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

$maxRows_RsCursosMostrar = 10;
$pageNum_RsCursosMostrar = 0;
if (isset($_GET['pageNum_RsCursosMostrar'])) {
  $pageNum_RsCursosMostrar = $_GET['pageNum_RsCursosMostrar'];
}
$startRow_RsCursosMostrar = $pageNum_RsCursosMostrar * $maxRows_RsCursosMostrar;

$colname_RsCursosMostrar = "-1";
if (isset($_GET['sos'])) {
  $colname_RsCursosMostrar = $_GET['sos'];
}
mysql_select_db($database_cnx, $cnx);
$query_RsCursosMostrar = sprintf("
SELECT
vy_curso.video_id,
vy_curso.comentario_id,
vy_curso.titulo_vid,
vy_curso.contenido_vid,
vy_curso.fecha_publicacion_vid,
vy_curso.miniatura_vid,
vy_curso.video_vid,
vy_curso_categoria.nombre_cat_vid,
vy_curso_categoria.categoria_vid_id
FROM
vy_curso
INNER JOIN vy_curso_categoria ON vy_curso.categoria_vid_id = vy_curso_categoria.categoria_vid_id
WHERE
vy_curso_categoria.categoria_vid_id = %s"

, GetSQLValueString($colname_RsCursosMostrar, "int"));
$query_limit_RsCursosMostrar = sprintf("%s LIMIT %d, %d", $query_RsCursosMostrar, $startRow_RsCursosMostrar, $maxRows_RsCursosMostrar);
$RsCursosMostrar = mysql_query($query_limit_RsCursosMostrar, $cnx) or die(mysql_error());
$row_RsCursosMostrar = mysql_fetch_assoc($RsCursosMostrar);

if (isset($_GET['totalRows_RsCursosMostrar'])) {
  $totalRows_RsCursosMostrar = $_GET['totalRows_RsCursosMostrar'];
} else {
  $all_RsCursosMostrar = mysql_query($query_RsCursosMostrar);
  $totalRows_RsCursosMostrar = mysql_num_rows($all_RsCursosMostrar);
}
$totalPages_RsCursosMostrar = ceil($totalRows_RsCursosMostrar/$maxRows_RsCursosMostrar)-1;

?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="es" class="no-js" > <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <title><?php echo "venyor.com cursos de ".$row_RsCursosMostrar['nombre_cat_vid']; ?></title>
  <meta name="viewport" content="width=device-width">
  <meta name="description" content="<?php echo "venyor.com cursos de ".$row_RsCursosMostrar['nombre_cat_vid']; ?>">
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
	
    <div class="grid_12" id="cursosMain">
      <h2 class="separadorVerde"><a href="index.php" title="Ir a inicio">Inicio</a> &gt; Cursos<?php echo " &gt; ".$row_RsCursosMostrar['nombre_cat_vid']; ?></h2>
      
      <?php if (isset($_GET['sos'])) {  // si no hay nada el muestra el mensaje 404?>
      <?php do { ?>
      <div class="cont_curso">  

        <div class="imgCont_curso">
          <img src="<?php echo $row_RsCursosMostrar['miniatura_vid']; ?>" alt="imagenes" width="120" heigth="120"/>
        </div>

        <div class="texCont_curso">
          <ul>
            <li><h2><?php echo ucfirst($row_RsCursosMostrar['titulo_vid']); ?></h2></li>
            <li><h3><?php echo substr(ucfirst($row_RsCursosMostrar['contenido_vid']),0,145)."..."; ?></h3></li>
            <li><time datetime="<?php echo $row_RsCursosMostrar['fecha_publicacion_vid']; ?>">Subido el <?php echo fechador($row_RsCursosMostrar['fecha_publicacion_vid']); ?></time></li>
            <li><h4 class="boton"><a href="detalle.php?deo=<?php echo $row_RsCursosMostrar['video_id']; ?>">Ver video</a></h4></li>
          </ul>
        </div>       
      </div>
      <?php } while ($row_RsCursosMostrar = mysql_fetch_assoc($RsCursosMostrar)); ?>
      <?php } else {echo "<h1>estas en los cursos mira aquí colocar una imagen<h1>";} ?>
    </div>
    <div class="clear"></div>
  </div>
  <div class="clear"></div>
  
  <!--beg. footer-->
  <?php include('includes/footer.php') ?>
  <!--end. footer-->
  
</body>
</html>
<?php

mysql_free_result($RsCms);

mysql_free_result($Rsproducto);

mysql_free_result($RsMasVendido);

mysql_free_result($RsLoNuevo);

mysql_free_result($RsCursos);

mysql_free_result($RsCursosMostrar);

mysql_free_result($RsTema);

 ?>
