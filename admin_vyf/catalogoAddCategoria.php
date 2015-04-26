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

mysql_select_db($database_cnx, $cnx);
$query_RsCiudad = "SELECT * FROM vy_cat_kategorie WHERE sujet_id=".$_GET["id"]." order by nombre_categoria asc";
$RsCiudad = mysql_query($query_RsCiudad, $cnx) or die(mysql_error());
$row_RsCiudad = mysql_fetch_assoc($RsCiudad);
$totalRows_RsCiudad = mysql_num_rows($RsCiudad);

/*print_r($_GET);*/
?>
<!DOCTYPE html>
<head>
<meta charset="utf-8">
</head>
Categor&iacute;a:
<select name="categoria" onchange="from(document.form.categoria.value,'categoriaSub','catalogoAddCategoriaSub.php')">
<option value="0"><h2>Seleccione Categor&iacute;a</h2></option>

<?php do {?>
<option value="<?php echo $row_RsCiudad['kategorie_id']; ?>"><?php echo $row_RsCiudad['nombre_categoria']; ?></option>
<?php } while ($row_RsCiudad = mysql_fetch_assoc($RsCiudad)); ?>
</select>
<?php
mysql_free_result($RsCiudad);
?>
</html>