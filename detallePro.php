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

$maxRows_RsRelacionados = 7;
$pageNum_RsRelacionados = 0;
if (isset($_GET['pageNum_RsRelacionados'])) {
  $pageNum_RsRelacionados = $_GET['pageNum_RsRelacionados'];
}
$startRow_RsRelacionados = $pageNum_RsRelacionados * $maxRows_RsRelacionados;

$colname_RsRelacionados = "-1";
if (isset($_GET['dos'])) {
  $colname_RsRelacionados = $_GET['dos'];
}
mysql_select_db($database_cnx, $cnx);
$query_RsRelacionados = sprintf("SELECT * FROM vy_cat_productos WHERE kategorie_id = %s ORDER BY kategorie_id DESC", GetSQLValueString($colname_RsRelacionados, "int"));
$query_limit_RsRelacionados = sprintf("%s LIMIT %d, %d", $query_RsRelacionados, $startRow_RsRelacionados, $maxRows_RsRelacionados);
$RsRelacionados = mysql_query($query_limit_RsRelacionados, $cnx) or die(mysql_error());
$row_RsRelacionados = mysql_fetch_assoc($RsRelacionados);

if (isset($_GET['totalRows_RsRelacionados'])) {
  $totalRows_RsRelacionados = $_GET['totalRows_RsRelacionados'];
} else {
  $all_RsRelacionados = mysql_query($query_RsRelacionados);
  $totalRows_RsRelacionados = mysql_num_rows($all_RsRelacionados);
}
$totalPages_RsRelacionados = ceil($totalRows_RsRelacionados/$maxRows_RsRelacionados)-1;

$colname_RsProducto = "-1";
if (isset($_GET['cto'])) {
  $colname_RsProducto = $_GET['cto'];
}
mysql_select_db($database_cnx, $cnx);
$query_RsProducto = sprintf("SELECT vy_cat_productos.produkt_id, vy_cat_productos.nombre_prod, vy_cat_productos.descripcion_prod, vy_cat_productos.color_prod, vy_cat_productos.peso_prod, vy_cat_productos.unidad_prod, vy_cat_productos.precio_prod, vy_cat_productos.cantidad_prod, vy_cat_productos.nuevo_prod, vy_cat_productos.alto_prod, vy_cat_productos.ancho_prod, vy_cat_productos.largo_prod, vy_cat_productos.marca_prod, vy_cat_productos.imagen60_2, vy_cat_productos.imagen60_3, vy_cat_productos.imagen60_4, vy_cat_productos.imagen100, vy_cat_productos.imagen290, vy_cat_productos.imagen290_2, vy_cat_productos.imagen290_3, vy_cat_productos.imagen290_4, vy_cat_productos.imagen700, vy_cat_productos.imagen700_2, vy_cat_productos.imagen700_3, vy_cat_productos.imagen700_4, vy_cat_productos.imagen1500, vy_cat_productos.imagen1500_2, vy_cat_productos.imagen1500_3, vy_cat_productos.imagen1500_4,  vy_cat_productos.activar,  vy_cat_productos.fecha_ingreso, vy_cat_productos.garantia, vy_cat_productos.catalogo, vy_cat_productos.imagen60, vy_cat_sujet.sujet_id, vy_cat_sujet.nombre_tema, vy_cat_unterkategorie.unterkategorie_id, vy_cat_unterkategorie.nombre_subcategoria, vy_cat_kategorie.kategorie_id, vy_cat_kategorie.nombre_categoria FROM vy_cat_productos INNER JOIN vy_cat_sujet ON vy_cat_productos.sujet_id = vy_cat_sujet.sujet_id INNER JOIN vy_cat_unterkategorie ON vy_cat_productos.unterkategorie_id = vy_cat_unterkategorie.unterkategorie_id INNER JOIN vy_cat_kategorie ON vy_cat_productos.kategorie_id = vy_cat_kategorie.kategorie_id WHERE produkt_id = %s", GetSQLValueString($colname_RsProducto, "int"));
$RsProducto = mysql_query($query_RsProducto, $cnx) or die(mysql_error());
$row_RsProducto = mysql_fetch_assoc($RsProducto);
$totalRows_RsProducto = mysql_num_rows($RsProducto);

$colname_RsPregunta = "-1";
if (isset($_GET['cto'])) {
  $colname_RsPregunta = $_GET['cto'];
}
mysql_select_db($database_cnx, $cnx);
$query_RsPregunta = sprintf("SELECT  vy_cat_productos_pregunta.produkt_id, vy_cat_productos_pregunta.fecha, vy_cat_productos_pregunta.nombre, vy_cat_productos_pregunta.email, vy_cat_productos_pregunta.pregunta, vy_cat_productos_respuesta.respuesta, vy_cat_productos_respuesta.fecha, vy_cat_productos_pregunta.activar FROM  vy_cat_productos_pregunta INNER JOIN vy_cat_productos_respuesta ON vy_cat_productos_pregunta.pregunta_id = vy_cat_productos_respuesta.pregunta_id WHERE produkt_id = %s ORDER BY vy_cat_productos_pregunta.pregunta_id DESC", GetSQLValueString($colname_RsPregunta, "int"));
$RsPregunta = mysql_query($query_RsPregunta, $cnx) or die(mysql_error());
$row_RsPregunta = mysql_fetch_assoc($RsPregunta);
$totalRows_RsPregunta = mysql_num_rows($RsPregunta);
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="es" class="no-js" > <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <title><?php echo $row_RsProducto['descripcion_prod']; ?></title>
  <meta name="viewport" content="width=device-width">
  <meta name="description" content="<?php echo getMetaDescription('detalle de productos '.$row_RsProducto['descripcion_prod']); ?>" />
  <meta name="author" content="Ing. Arrioja Leonard, ledarca@venyor.com, +58 426-1445000">
  <meta name="distribution" content="global">
  <link rel="shortcut icon"  href="img/faviconvy.ico">
  <link rel="stylesheet"  href="css/normalize.css">
  <link rel="stylesheet"  href="css/base.css">
  <link rel="icon"    href="img/faviconvy.ico" >
  <link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">
  <link href="SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css">
  <script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
  <script src="SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
	
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
      
  <script type="text/javascript">
  function MM_showHideLayers() { 
    var i,p,v,obj,args=MM_showHideLayers.arguments;
    for (i=0; i<(args.length-2); i+=3) 
    with (document) if (getElementById && ((obj=getElementById(args[i]))!=null)) { v=args[i+2];
      if (obj.style) { obj=obj.style; v=(v=='show')?'visible':(v=='hide')?'hidden':v; }
      obj.visibility=v; }}
  </script>
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


  <!--COMIENZA CONTENEDOR DE PRODUCTO-->  
  <div id="productoMain" class="container_16">
  
    <!-- comienzo de separador-->
    <h2 class="separadorVerde"><a href="index.php">Inicio</a> &gt; <a href="detalleCat.php?ema=<?php echo $row_RsProducto['sujet_id']; ?>"><?php echo $row_RsProducto['nombre_tema']; ?></a> &gt; <a href="detalleCat.php?ria=<?php echo $row_RsProducto['kategorie_id']; ?>&ema=<?php echo $row_RsProducto['sujet_id']; ?>"><?php echo $row_RsProducto['nombre_categoria']; ?></a> &gt; <a href="detalleCat.php?sria=<?php echo $row_RsProducto['unterkategorie_id']; ?>&ria=<?php echo $row_RsProducto['kategorie_id']; ?>&ema=<?php echo $row_RsProducto['sujet_id']; ?>"><?php echo $row_RsProducto['nombre_subcategoria']; ?></a> &gt; <?php echo $row_RsProducto['nombre_prod']; ?></h2>
    <!--fin de separador-->

    <!--COMIENZO PRIMERA PRATE HEADER-->
    <div id="productoHeader">

      <!--comienzo de contenedor de imagenes -->
      <div class="imagen">
      <!--comienzo de contenedor de imagen grande-->
        <div class="imagenGrande">
          <div id="capa1"> 
            <a href="<?php echo $row_RsProducto['imagen700']; ?>" rel="lightbox[plants]" title="Clic para ampliar">
            <img src="<?php echo $row_RsProducto['imagen290']; ?>" alt="Plants: imagen 1 de 4 thumb" /></a>
          </div>
            
          <div id="capa2">   
            <a href="<?php echo $row_RsProducto['imagen700_2']; ?>" rel="lightbox[plants]" title="Clic para ampliar">
            <img src="<?php echo $row_RsProducto['imagen290_2']; ?>" alt="Plants: imagen 2 de 4 thumb" /></a>
          </div>
            
          <div id="capa3">
            <a href="<?php echo $row_RsProducto['imagen700_3']; ?>" rel="lightbox[plants]" title="Clic para ampliar">
            <img src="<?php echo $row_RsProducto['imagen290_3']; ?>" alt="Plants: imagen 3 de 4 thumb" /></a>    
          </div>
            
          <div id="capa4">    
            <a href="<?php echo $row_RsProducto['imagen700_4']; ?>" rel="lightbox[plants]" title="Clic para ampliar">
            <img src="<?php echo $row_RsProducto['imagen290_4']; ?>" alt="Plants: imagen 4 de 4 thumb" /></a>
          </div>
        </div>         
      <!--comienzo de contenedor de imagen pequena-->
         <div id="imagenPequena">
          <img src=" <?php echo $row_RsProducto['imagen60']; ?>" onMouseOver="MM_showHideLayers('capa1','','show','capa2','','hide','capa3','','hide','capa4','','hide')" onload="MM_showHideLayers('logo','','show','capa1','','show','capa2','','hide','capa3','','hide','capa4','','hide')"> 
          <img src=" <?php echo $row_RsProducto['imagen60_2']; ?>" onMouseOver="MM_showHideLayers('capa1','','hide','capa2','','show','capa3','','hide','capa4','','hide')"> 
          <img src=" <?php echo $row_RsProducto['imagen60_3']; ?>" onMouseOver="MM_showHideLayers('capa1','','hide','capa2','','hide','capa3','','show','capa4','','hide')"> 
          <img src=" <?php echo $row_RsProducto['imagen60_4']; ?>" onMouseOver="MM_showHideLayers('capa1','','hide','capa2','','hide','capa3','','hide','capa4','','show')">
        </div>
      </div>
      <!--fin de contenedor de imagen pequena-->
      <!--fin de contenedor de imagen-->

      <!--comienzo de contenedor de texto medio-->
      <div class="texto">
        <h1><?php echo $row_RsProducto['nombre_prod']; ?></h1>
        <h2 class="precioPro"><?php echo "Bs. ". number_format($row_RsProducto['precio_prod'], 2, ',', ' '); ?></h2>
        <?php if  ($row_RsProducto['cantidad_prod'] > 0){ print"<h4 class='stock'>En Stock</h4>";} else {print"<h4 class='no_stock'>No Stock</h4>";} ?>  
        <h2>Servicios incluidos</h2>
        <?php if ($row_RsProducto['garantia'] > 0) {echo "<p>Con garantia</p>";} else  echo "<p>Sin garantia</p>"; ?>
        <?php if ($row_RsProducto['nuevo_prod'] > 0) {echo "<p>Producto nuevo</p>";} else  echo "<p>Producto usado</p>"; ?>
        <h2>Medios de Envio</h2>
        <p>MRW</p>
        <p>Domesa</p>
        <p>ZOOM</p>
        <p>ipostel</p>
      </div>
      <!--fin de contenedor de texto medio-->

      <!--COMIENZO DEL DIV PARA EL BOTON-->
      <div class="comprar">
      	<?PHP include('includes/boton.php') ?>
      </div>
      <!--FIN DEL DIV PARA EL BOTON-->
    <div class="clear"></div>
    </div>
    <!--FIN DE PRIMERA PATE HEADER-->


    <!--COMIENZO DE SEGUNDA PARTE IMAGENES DEL CENTRO -->
    <div id="imagenGrande">
      <img src="<?php echo $row_RsProducto['imagen700']; ?>">
      <img src="<?php echo $row_RsProducto['imagen700_2']; ?>">
      <img src="<?php echo $row_RsProducto['imagen700_3']; ?>">
      <img src="<?php echo $row_RsProducto['imagen700_4']; ?>">
    </div>
    <!--FINAL DE SEGUNDA PARTE IMAGENES DEL CENTRO -->

    
    <!--COMIENZO DE TERCERA PARTE FICHA TECNICA-->
    <div id="fichaTecnica">
      <h2 class="separadorFucsia">Ficha t&eacute;cnica</h2>
      <!--COMIENZO CONTENDOR DERECHA-->
      <div id="fichaTecnicaDerecha">
        <h2>Dimensiones</h2>
          <ul>
            <li><?php if ($row_RsProducto['ancho_prod']==!NULL) echo "<p>Ancho: ".number_format($row_RsProducto['ancho_prod'], 2, ',', ' ')." cm</p>"; ?></li>
            <li><?php if ($row_RsProducto['largo_prod']==!NULL) echo "<p>Largo: ".number_format($row_RsProducto['largo_prod'], 2, ',', ' ')." cm</p>"; ?></li>
            <li><?php if ($row_RsProducto['alto_prod']==!NULL) echo "<p>Alto: ".number_format($row_RsProducto['alto_prod'], 2, ',', ' ')." cm</p>"; ?></li>
          </ul>
        <h2>Descripción</h2>
          <?php if($row_RsProducto['descripcion_prod']==!NULL) echo"<p>".$row_RsProducto['descripcion_prod'] ."</p>";?>
        <h2>Otros</h2>
          <?php if($row_RsProducto['catalogo']==!NULL) echo"<p>Catálogo: Si </p>";?>
          <?php if($row_RsProducto['color_prod']==!NULL) echo"<p>Color: ".$row_RsProducto['color_prod'] ."</p>"; ?>  
          <?php if($row_RsProducto['marca_prod']==!NULL) echo"<p>Marca: ".$row_RsProducto['marca_prod'] ."</p>";?> 
          <?php if($row_RsProducto['peso_prod']==!NULL) echo"<p>Peso: ".number_format($row_RsProducto['peso_prod'], 2, ',', ' ')." Gr.</p>";?> 
          <?php if($row_RsProducto['unidad_prod']==!NULL) echo"<p>Unidad de medida: ".$row_RsProducto['unidad_prod'] ."</p>";?>
      </div>
      <!--FINAL CONTENDOR DERECHA-->

      <!--COMIENZO CONTENDOR IZQUIERDA-->
      <div id="fichaTecnicaIzquierda">
        <h2>Promociones especiales</h2>
      </div>
      <!--FINAL CONTENDOR IZQUIERDA-->   
    </div>
    <!--FIN DE TERCERA PARTE FICHA TECNICA-->


    <!--COMIENZO DE CUARTA PARTE PRODUCTOS RELACIONADOS-->
    <div id="productosRelacionados">
      <h1 class="separadorFucsia">Productos Relacionados</h1> 
      
      <?php do { ?>
      <ul>
        <li><a href="#"><img src="<?php echo $row_RsRelacionados['imagen100']; ?>" alt="IMAGENES"></a></li>
      </ul>
      <?php } while ($row_RsRelacionados = mysql_fetch_assoc($RsRelacionados)); ?>
    </div>
    <!--FIN DE CUARTA PARTE PRODUCTOS RELACIONADOS-->


    <!--COMIENZO DE QUINTA PARTE PREGUNTAS PRODUCTOS RELACIONADOS-->
    <div id="preguntas">
      <h1 class="separadorFucsia"><?php echo "( ".$totalRows_RsPregunta." )"; ?> Preguntas</h1> 
      
      <!--comienza formulario-->
      <div class="formulario">    
        <form name="form" action="procesos/procesarPregunta.php" method="post">
          <fieldset >
            <legend>¿Pregunta?</legend>
                            
              <label for="nombre">Nombre:</label>
              <span id="sprytextfield1">
              <input class="texto" name="nombre" type="text" size="30" tabindex="1" placeholder="introduce tu nombre y apellido" id="nombre" />
              <span class="textfieldRequiredMsg">Se necesita un valor!</span><span class="textfieldInvalidFormatMsg">Formato no válido.</span></span>
                
              <label for="email">E-mail:</label>
              <span id="sprytextfield2">
              <input class="texto" name="email" type="text" size="30" tabindex="2" placeholder="introduce tu e-mail" id="email" />
              <span class="textfieldRequiredMsg">Se necesita un valor!</span><span class="textfieldInvalidFormatMsg">Formato no válido.</span></span>
                
              <label for="comment">Pregunta:</label>
              <span id="sprytextarea1">
              <textarea tabindex="3" rows="5" id="comment" name="comentario" onKeyDown="valida_longitud()" onKeyUp="valida_longitud()" placeholder="introduce tu pregunta"></textarea>
      
              <span class="textareaRequiredMsg">Se necesita un valor!</span></span>
              <label for="contar">Caracteres m&aacute;ximos</label>            
              <input type="text" size="10" value="500"  id="contar" readonly> 
              <div id="captcha"><img src="procesos/captcha.php" alt="captcha"></div>
                
              <label for="contar">C&oacute;digo de la imagen</label>
              <span id="sprytextfield3">
              <input name='captcha' type='text' class="texto" tabindex="4" maxlength="6"/>
              <span class="textfieldRequiredMsg">Se necesita un valor!</span><span class="textfieldMinCharsMsg">Mínimo de caracteres (6).</span></span>
              <hr>  
                              
              <input type="submit" value="Preguntar" tabindex="5" class="b_formulario" /> 
              <input name="produkt_id" type="hidden" id="produkt_id" value="<?php echo $row_RsProducto['produkt_id']; ?>">
              <input name="dos" type="hidden" id="produkt_id" value="<?php echo $colname_RsRelacionados ?>">
              <input type="hidden" name="grabar" value="si" />
          </fieldset>
        </form> 
    	</div>
    <!--finaliza formulario-->

    <!--COMIENZA DIV PREGUNTA-->
    <div id="divPreguntas">
      <?php if ($totalRows_RsPregunta > 0) { // Show if recordset not empty ?>
  <div class="comentario">     
    <?php do { ?>
      <ul>
        <li><h3>Enviado por: <?php echo $row_RsPregunta['nombre']; ?></h3></li>
        <li><div class="fechador"><?php echo $row_RsPregunta['fecha']; ?></div></li>
        <li><h3><?php echo $row_RsPregunta['pregunta']; ?></h3></li>
        <li><p><?php echo $row_RsPregunta['respuesta']; ?></p></li>
      </ul>
      <?php } while ($row_RsPregunta = mysql_fetch_assoc($RsPregunta)); ?>     
  </div>
  <?php } // Show if recordset not empty ?>
    </div>
    <!--FINALIZA DIV PREGUNTA-->

    </div>
    <!--FINALIZA DE QUINTA PARTE PREGUNTAS PRODUCTOS RELACIONADOS-->

    </div>
   <!--FIN CONTENEDOR DE PRODUCTO--> 
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

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
  <script src="js/lightbox.js"></script> 

</body>
</html>
<?php
mysql_free_result($RsRelacionados);

mysql_free_result($RsProducto);

mysql_free_result($RsPregunta);
?>

