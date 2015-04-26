<?php require_once('Connections/cnx.php'); ?>
<?php require_once('procesos/funciones.php'); ?>
<?php

mysql_select_db($database_cnx, $cnx);
$query_RsProducto = "SELECT * FROM vy_cat_productos ORDER BY produkt_id DESC limit 0,15 ";
$RsProducto = mysql_query($query_RsProducto, $cnx) or die(mysql_error());
$row_RsProducto = mysql_fetch_assoc($RsProducto);
$totalRows_RsProducto = mysql_num_rows($RsProducto);

$maxRows_RsCms = 20;
$pageNum_RsCms = 0;
if (isset($_GET['pageNum_RsCms'])) {
  $pageNum_RsCms = $_GET['pageNum_RsCms'];
}
$startRow_RsCms = $pageNum_RsCms * $maxRows_RsCms;

mysql_select_db($database_cnx, $cnx);
$query_RsCms = "SELECT * FROM vy_cms ORDER BY nombre_cms ASC";
$query_limit_RsCms = sprintf("%s LIMIT %d, %d", $query_RsCms, $startRow_RsCms, $maxRows_RsCms);
$RsCms = mysql_query($query_limit_RsCms, $cnx) or die(mysql_error());
$row_RsCms = mysql_fetch_assoc($RsCms);

if (isset($_GET['totalRows_RsCms'])) {
  $totalRows_RsCms = $_GET['totalRows_RsCms'];
} else {
  $all_RsCms = mysql_query($query_RsCms);
  $totalRows_RsCms = mysql_num_rows($all_RsCms);
}
$totalPages_RsCms = ceil($totalRows_RsCms/$maxRows_RsCms)-1;


$maxRows_RsLoNuevo = 3;
$pageNum_RsLoNuevo = 0;
if (isset($_GET['pageNum_RsLoNuevo'])) {
  $pageNum_RsLoNuevo = $_GET['pageNum_RsLoNuevo'];
}
$startRow_RsLoNuevo = $pageNum_RsLoNuevo * $maxRows_RsLoNuevo;

mysql_select_db($database_cnx, $cnx);
$query_RsLoNuevo = "SELECT * FROM vy_cat_productos ORDER BY produkt_id DESC";
$query_limit_RsLoNuevo = sprintf("%s LIMIT %d, %d", $query_RsLoNuevo, $startRow_RsLoNuevo, $maxRows_RsLoNuevo);
$RsLoNuevo = mysql_query($query_limit_RsLoNuevo, $cnx) or die(mysql_error());
$row_RsLoNuevo = mysql_fetch_assoc($RsLoNuevo);

if (isset($_GET['totalRows_RsLoNuevo'])) {
  $totalRows_RsLoNuevo = $_GET['totalRows_RsLoNuevo'];
} else {
  $all_RsLoNuevo = mysql_query($query_RsLoNuevo);
  $totalRows_RsLoNuevo = mysql_num_rows($all_RsLoNuevo);
}
$totalPages_RsLoNuevo = ceil($totalRows_RsLoNuevo/$maxRows_RsLoNuevo)-1;

mysql_select_db($database_cnx, $cnx);
$query_RsCursos = "SELECT vy_curso_categoria.nombre_cat_vid, Count(vy_curso_categoria.categoria_vid_id), vy_curso.categoria_vid_id FROM vy_curso_categoria INNER JOIN vy_curso ON vy_curso_categoria.categoria_vid_id = vy_curso.categoria_vid_id GROUP BY vy_curso_categoria.categoria_vid_id ORDER BY vy_curso_categoria.nombre_cat_vid ASC";
$RsCursos = mysql_query($query_RsCursos, $cnx) or die(mysql_error());
$row_RsCursos = mysql_fetch_assoc($RsCursos);
$totalRows_RsCursos = mysql_num_rows($RsCursos);
$totalvideos = $row_RsCursos['Count(vy_curso_categoria.categoria_vid_id)'];


mysql_select_db($database_cnx, $cnx);
$query_RsTema = "SELECT * FROM vy_cat_sujet ORDER BY vy_cat_sujet.nombre_tema  ASC ";
$RsTema = mysql_query($query_RsTema, $cnx) or die(mysql_error());
$row_RsTema = mysql_fetch_assoc($RsTema);
$totalRows_RsTema = mysql_num_rows($RsTema);

mysql_select_db($database_cnx, $cnx);
$query_RsMasVendido = "SELECT  Sum(vy_comprado.cantidad) AS total,  vy_cat_productos.nombre_prod, vy_cat_productos.kategorie_id,  vy_cat_productos.produkt_id,  vy_cat_productos.imagen60 FROM vy_comprado  INNER JOIN vy_cat_productos ON vy_cat_productos.produkt_id = vy_comprado.produkt_id GROUP BY vy_comprado.produkt_id ORDER BY total desc  LIMIT 0, 3 ";
$RsMasVendido = mysql_query($query_RsMasVendido, $cnx) or die(mysql_error());
$row_RsMasVendido = mysql_fetch_assoc($RsMasVendido);
$totalRows_RsMasVendido = mysql_num_rows($RsMasVendido);
?>

<div id="sidebar" class="grid_4">
  <!--   COMIENZA TEMA-->
  <nav id="categoria">
    <h2 class="separadorVerde">CATEGOR&Iacute;AS</h2>
    
    <ul>
     	<?php do { ?>
      <li>
          <h3><a href="detalleCat.php?ema=<?php echo $row_RsTema['sujet_id']; ?>"><?php if ($row_RsTema['activar']==true) echo $row_RsTema['nombre_tema']; ?></a></h3>
      </li>
      <?php } while ($row_RsTema = mysql_fetch_assoc($RsTema)); ?>
    </ul>
  </nav>
  <!--   FINALIZA TEMA-->

  <!--   COMIENZA MAS VENDIDO-->
  <?php if ($totalRows_RsMasVendido > 0) { // Show if recordset not empty ?>
  <div id="masVendido">
    <h2 class="separadorVerde">M&Aacute;S VENDIDO</h2> 

    <?php do { ?>
    <div class="nuevoMain">
      <div class="nuevoImagen">
        <a href="detallePro.php?cto=<?php echo $row_RsMasVendido['produkt_id']; ?>&dos=<?php echo $row_RsMasVendido['kategorie_id']; ?>" title="Ir a detalle">
          <img src="<?php echo $row_RsMasVendido['imagen60']; ?>" alt="mas vendido" />
        </a>
      </div>

      <div class="nuevoTexto">
        <h3><a href="detallePro.php?cto=<?php echo $row_RsMasVendido['produkt_id']; ?>&dos=<?php echo $row_RsMasVendido['kategorie_id']; ?>" title="<?php echo $row_RsMasVendido['nombre_prod']; ?>"><?php echo $row_RsMasVendido['nombre_prod']; ?></a></h3>
      </div>
    </div>
    <?php } while ($row_RsMasVendido = mysql_fetch_assoc($RsMasVendido)); ?>
  </div>
  <?php } // Show if recordset not empty ?>
  <!--   FINALIZA MAS VENDIDO-->   

  <!--   COMIENZA LO NUEVO-->                       
  <div id="nuevo">
    <h2 class="separadorVerde">LO NUEVO</h2>
      
    <?php do { ?>
    <div class="nuevoMain">
      <div class="nuevoImagen">
        <a href="detallePro.php?cto=<?php echo $row_RsLoNuevo['produkt_id']; ?>&dos=<?php echo $row_RsProducto['kategorie_id']; ?>">
          <img src="<?php echo $row_RsLoNuevo['imagen60']; ?>" alt="<?php echo $row_RsLoNuevo['nombre_prod']; ?>"/>
        </a>
      </div>

      <div class="nuevoTexto">
        <h3>
          <a href="detallePro.php?cto=<?php echo $row_RsLoNuevo['produkt_id']; ?>&dos=<?php echo $row_RsProducto['kategorie_id']; ?>" title="<?php echo $row_RsLoNuevo['nombre_prod']; ?>"><?php echo $row_RsLoNuevo['nombre_prod']; ?></a>
        </h3>
      </div>
    </div>
    <?php } while ($row_RsLoNuevo = mysql_fetch_assoc($RsLoNuevo)); ?>
  </div>
  <!--   FINALIZA LO NUEVO--> 
  
  <!--   COMIENZA INFORMACION-->
  <div id="informacion">
    <h2 class="separadorVerde">INFORMACI&Oacute;N</h2>
      <?php do { ?>
      <ul>
        <li>
          <h3>
            <a href="legal.php?cms=<?php echo $row_RsCms['cms_id']; ?>"><?php if ($row_RsCms['activar']==true)echo ucwords($row_RsCms['nombre_cms']); ?></a>
          </h3>
        </li>
      </ul>
      <?php } while ($row_RsCms = mysql_fetch_assoc($RsCms)); ?>
  </div>
  <!--   FINALIZA INFORMACION-->  

  <!--   COMIENZA CURSOS-->
  <div id="cursos">
    <h2 class="separadorVerde">CURSOS</h2>
      <?php do { ?>
      <ul>
        <li>
          <h3><a href="cursos.php?sos=<?php echo $row_RsCursos['categoria_vid_id']; ?>"><?php echo ucwords($row_RsCursos['nombre_cat_vid']); ?></a><span class="total"><?php echo "(". $row_RsCursos['Count(vy_curso_categoria.categoria_vid_id)'].")"; ?></span></h3>
        </li>
      </ul>
      <?php } while ($row_RsCursos = mysql_fetch_assoc($RsCursos)); ?>
  </div>
  <!--   FINALIZA CURSOS--> 

  <!--   COMIENZA BLOG-->
  <div id="blog">
    <h2 class="separadorVerde">BLOG</h2>

    <ul>
      <li><h3><a href="http://venyor.blogspot.com/" rel="nowfollow">Bisutería</a></h3></li>
    </ul>
  </div>
  <!--   FINALIZA BLOG-->  

  <!--   COMIENZA CATEGORIA-->
    <h2 class="separadorVerde"><a href="catalogo/index.php">VER CATÁLOGO</a></h2>
  <!--   FINALIZA CATEGORIA-->   
</div> 
 
