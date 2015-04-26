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
$query_Recordset1 = "SELECT * FROM vy_cat_unterkategorie WHERE kategorie_id=".$_GET["id"]." ORDER BY nombre_subcategoria ASC";
$Recordset1 = mysql_query($query_Recordset1, $cnx) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

/*print_r($_GET);*/?>

<!DOCTYPE html>
<head>
<meta charset="utf-8">
</head>
Sub Categor&iacute;a

  <select name="categoriaSub">
    <option value="0">Seleccione Sub Categor&iacute;a</option>
    
    <?php do { ?>
    <option value="<?php echo $row_Recordset1['unterkategorie_id']; ?>"><?php echo $row_Recordset1['nombre_subcategoria']; ?></option>
    
    <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>  
  </select>

<?php
mysql_free_result($Recordset1);
?>
</html>
