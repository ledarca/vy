<?php require_once('../Connections/cnx.php'); 

$colname_RsVendido = "25";
if (isset($_GET['id'])) {
  $colname_RsVendido = $_GET['id'];
}
mysql_select_db($database_cnx, $cnx);
$query_RsVendido = sprintf("SELECT  vy_comprado.cliente_id, vy_comprado_clientes.nombre, vy_comprado_clientes.email, vy_comprado_clientes.ci, vy_comprado_clientes.telefono, vy_comprado_clientes.direccion, vy_comprado.cantidad, vy_catalogo.catalogo_id, vy_catalogo.imagen700, vy_catalogo.referencia FROM  vy_comprado INNER JOIN vy_comprado_clientes ON vy_comprado.cliente_id = vy_comprado_clientes.clientes_id INNER JOIN vy_catalogo ON vy_catalogo.catalogo_id = vy_comprado.produkt_id WHERE  vy_comprado.cliente_id = %s  ORDER BY vy_catalogo.referencia ASC ", GetSQLValueString($colname_RsVendido, "int"));
$RsVendido = mysql_query($query_RsVendido, $cnx) or die(mysql_error());
$row_RsVendido = mysql_fetch_assoc($RsVendido);
$totalRows_RsVendido = mysql_num_rows($RsVendido);
?>
<html>
<?php do { ?>
  <h1><?php echo $row_RsVendido['cantidad']; ?></h1>
  <?php } while ($row_RsVendido = mysql_fetch_assoc($RsVendido)); ?>
</html>
<?php
mysql_free_result($RsVendido);
?>