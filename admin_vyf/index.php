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
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['usuario_adm'])) {
  $loginUsername=$_POST['usuario_adm'];
  $password=$_POST['clave_adm'];
  $MM_fldUserAuthorization = "nivel_adm";
  $MM_redirectLoginSuccess = "principal.php";
  $MM_redirectLoginFailed = "loginError.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_cnx, $cnx);
  	
  $LoginRS__query=sprintf("SELECT usuario_adm, clave_adm, nivel_adm FROM vy_admin_usuarios WHERE usuario_adm=%s AND clave_adm=%s",
  GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $cnx) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
    
    $loginStrGroup  = mysql_result($LoginRS,0,'nivel_adm');
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="es" class="no-js" > <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  
  <title>Panel de Administraci&oacute;n</title>
  
  <link rel="shortcut icon"  href="img/faviconvy.ico">
  <link rel="stylesheet"  href="css/menu.css" >
  <link rel="stylesheet" href="css/normalize.css">
  <link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">
  <link href="../SpryAssets/SpryValidationPassword.css" rel="stylesheet" type="text/css">
  
  <script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
  <script src="../SpryAssets/SpryValidationPassword.js" type="text/javascript"></script>
</head>

<body>
  <div class="container_16">
    <div id="formadmin">
    <h1>Administrador venyor</h1><hr>
    
    <form action="<?php echo $loginFormAction; ?>" method="POST" name="form1" class="formulario"> 
      <span id="sprytextfield1">
      <label for="usuario_adm">Usuario:</label>
      <input type="text" name="usuario_adm" value="" size="32" id="usu" tabindex="1" />
      <span class="textfieldRequiredMsg">Se necesita un valor!</span><span class="textfieldInvalidFormatMsg">Formato no válido.</span></span>
              
      <span id="sprypassword1">
      <label for="clave_adm">Contrase&ntilde;a:</label>
      <input type="password" name="clave_adm" value="" size="32" id="cla" tabindex="2" />
      <span class="passwordRequiredMsg">Se necesita un valor.</span></span></br>
      
      <input type="submit" value="Entrar" tabindex="3" class="boton"/>       
    </form><hr>

    <h3><a href="#">¿Olvido su contrase&ntilde;a?</a></h3>  
    <p><a href="../">&copy; 2012 - 2013 Copyright by venyor C. A. all rights reserved.</a></p>
  </div>

  <script type="text/javascript">
  var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "custom");
  var sprypassword1 = new Spry.Widget.ValidationPassword("sprypassword1");
  </script>
  </div>
</body>
</html>