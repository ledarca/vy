<?php require_once('Connections/cnx.php'); ?>
<?php require_once('procesos/funciones.php'); ?>
<?php session_start();
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

$colname_RsVideo = "-1";
if (isset($_GET['deo'])) {
  $colname_RsVideo = $_GET['deo'];
}
mysql_select_db($database_cnx, $cnx);
$query_RsVideo = sprintf("SELECT * FROM vy_curso WHERE video_id = %s", GetSQLValueString($colname_RsVideo, "int"));
$RsVideo = mysql_query($query_RsVideo, $cnx) or die(mysql_error());
$row_RsVideo = mysql_fetch_assoc($RsVideo);
$totalRows_RsVideo = mysql_num_rows($RsVideo);

$colname_RsComentario = "-1";
if (isset($_GET['deo'])) {
  $colname_RsComentario = $_GET['deo'];
}
mysql_select_db($database_cnx, $cnx);
$query_RsComentario = sprintf("SELECT * FROM vy_curso_comentario WHERE video_id = %s ORDER BY comentario_id DESC", GetSQLValueString($colname_RsComentario, "int"));
$RsComentario = mysql_query($query_RsComentario, $cnx) or die(mysql_error());
$row_RsComentario = mysql_fetch_assoc($RsComentario);
$totalRows_RsComentario = mysql_num_rows($RsComentario);
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="es" class="no-js" > <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <title><?php echo "Video cursos y tutoriales ".$row_RsVideo['description']; ?></title>
  <meta name="viewport" content="width=device-width">
  <meta name="description" content="<?php echo getMetaDescription('detalle de cursos '.$row_RsVideo['description']); ?>">
  <meta name="author" content="Ing. Arrioja Leonard, ledarca@venyor.com, +58 426-1445000">
  <meta name="distribution" content="global">
  <link rel="stylesheet"  href="css/normalize.css">
  <link rel="stylesheet"  href="css/base.css">
  <link rel="icon"  href="img/faviconvy.ico">
  <link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">
  <link href="SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css">
  <script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
  <script src="SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>

<script type="text/javascript">
	contenido_textarea = "";
	num_caracteres_permitidos = 500;
	function valida_longitud(){
	num_caracteres = document.form.comentario.value.length;
	
	if (num_caracteres <= num_caracteres_permitidos){
	contenido_textarea = document.form.comentario.value;
	}else{
	document.form.comentario.value = contenido_textarea;
	}
		cuenta()
	}
	function cuenta(){
	document.form.contar.value=500-document.form.comentario.value.length;
  }
</script>

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
	
    <!--================================== comienza caja video-->
    <div class="grid_12" id="video">
      <h2 class="separadorVerde"><a href="index.php" title="Ir a inicio">Inicio</a> &gt; Cursos  <?php echo"&gt; ". ucfirst($row_RsVideo['titulo_vid']);?></h2>
    
      <!--comienza contenedor video-->  
      <ul>
        <li><h1><?php echo ucfirst($row_RsVideo['titulo_vid']); ?></h1></li>
        <li><p><?php echo ucfirst($row_RsVideo['contenido_vid']); ?></p></li>
        <li><time datetime="<?php echo $row_RsVideo['fecha_publicacion_vid']; ?>"><?php echo fechador($row_RsVideo['fecha_publicacion_vid']); ?></time></li>
        <li><div id="videoYoutube"><?php echo $row_RsVideo['video_vid']; ?></div></li>
        <li><h2 class="boton"><a href="procesos/descarga.php?archivo=<?php echo $row_RsVideo['revista']; ?>">Descargar</a></h2><br></li>
        <li><h3 class="separadorVerde"><?php echo "( ".$totalRows_RsComentario." )";?> Comentarios</h3></li>
      </ul>
      <!--finaliza contenedor video-->      
           
      <!--comienza formulario-->
      <div class="formulario">    
        <form name="form" action="procesos/procesar.php" method="post"><fieldset>
          <legend>Deja tu comentario</legend>
                            
            <label for="nombre">Nombre:</label>
            <span id="sprytextfield1">
            <input class="texto" name="nombre" type="text" size="30" tabindex="1" placeholder="introduce tu nombre y apellido" id="nombre" />
            <span class="textfieldRequiredMsg">Se necesita un valor!</span><span class="textfieldInvalidFormatMsg">Formato no válido.</span></span>
                
            <label for="email">E-mail:</label>
            <span id="sprytextfield2">
            <input class="texto" name="email" type="text" size="30" tabindex="2" placeholder="introduce tu e-mail" id="email" />
            <span class="textfieldRequiredMsg">Se necesita un valor!</span><span class="textfieldInvalidFormatMsg">Formato no válido.</span></span>
               
            <label for="comment">Comentario:</label>
            <span id="sprytextarea1">
            <textarea tabindex="3" rows="5" id="comment" name="comentario" onKeyDown="valida_longitud()" onKeyUp="valida_longitud()" placeholder="introduce tu comentario"></textarea>
            <span class="textareaRequiredMsg">Se necesita un valor!</span></span>
            
            <label for="contar">Caracteres m&aacute;ximos</label>
            <input type="text" size="10" value="500"  id="contar" readonly> 
            <div id="captcha"><img src="procesos/captcha.php" alt="captcha"></div>
               
            <label for="contar">C&oacute;digo de la imagen!</label>
            <span id="sprytextfield3">
            <input name='captcha' type='text' class="texto" tabindex="4" maxlength="6"/>
            <span class="textfieldRequiredMsg">Se necesita un valor!</span><span class="textfieldMinCharsMsg">Mínimo de caracteres (6).</span></span>
            <hr>  
                              
            <input type="submit" value="Comentar" tabindex="5" class="b_formulario" /> 
            <input name="video_id" type="hidden" value="<?php echo $row_RsVideo['video_id']; ?>">
            <input type="hidden" name="grabar" value="si" />
        </fieldset></form> 
    	</div>
      <!--finaliza formulario-->

      <!--comienza comentario-->
    	<div class="comentario">	
        <?php do { ?>
        <?php if ($totalRows_RsComentario > 0) { // Show if recordset not empty ?>
          <ul>
            <li><h3>Enviado por: <?php echo $row_RsComentario['nombre']; ?></h3></li>
            <li><time datetime="<?php echo $row_RsComentario['fecha'];?>"><?php echo fechador($row_RsComentario['fecha']);?></time></li>
            <li><p><?php if ($row_RsComentario['activar']==true){echo $row_RsComentario['comentario'];}else{echo "El mensaje ha sido eliminado por tener contenido inapropiado!";} ?></p></li>
          </ul>
        <?php } // Show if recordset not empty ?>
        <?php } while ($row_RsComentario = mysql_fetch_assoc($RsComentario)); ?>   
      </div>
      <!--finaliza comentario-->

     
    </div>
    <!--termina caja video-->
    <div class="clear"></div>
  </div>
  
  <!--beg. footer-->
  <?php include('includes/footer.php') ?>
  <!--end. footer-->
  
  <script type="text/javascript">
  var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "custom");
  var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "email");
  var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea1");
  var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "none", {minChars:6});
  </script>
</body>
</html>
<?php

mysql_free_result($RsCms);

mysql_free_result($Rsproducto);

mysql_free_result($RsMasVendido);

mysql_free_result($RsLoNuevo);

mysql_free_result($RsCursos);

mysql_free_result($RsVideo);

mysql_free_result($RsComentario);

mysql_free_result($RsTema);

?>
