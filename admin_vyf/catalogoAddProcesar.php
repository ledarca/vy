<?php 
require_once('../Connections/cnx.php');
require_once('../procesos/funciones.php');

//******************************
$activar		=	$_POST['activar'];
$categoria		=	$_POST['categoria']; 
$cantidad		=	$_POST['cantidad'];
$color			=	$_POST['color'];
$descripcion	=	$_POST['descripcion'];
$fechasubida	=	date("Y-m-d");
$peso 			=	$_POST['peso'];
$nameimagen 	=	$_FILES['foto']['name'];	
$precio			=	$_POST['precio'];
$subCategoria	=	$_POST['categoriaSub']; 		
$referencia		=	$nameimagen;  //$_POST['referencia'];
$tema			=	$_POST['tema']; 
$tmpimagen 		=	$_FILES['foto']['tmp_name'];
$tipo 			=	$_FILES['foto']['type'];
$tmanoMaximo 	= 	$_FILES['foto']['size'];

//******************************COMIENO VALIDACIONES TODOS LOS CAMPOR LLENOSand isset($nameimagen)
if (!validarFormulario($_POST) ) 
{
    echo "<p style='color: red;'>No has cubierto el formulario correctamente - Por favor vuelve. e int&eacute;ntalo de nuevo.</p>"; exit;
} 
else
{
	//******************************COMPROBAMOS SI LOS CAMPOS ESTAN VACIOS
	if ($nameimagen =="" or $tmpimagen=="" )
	{
		echo "<p style='color: red;'>Por favor debe elegir una imagen</p>"; exit;
	}
	else
	{
		//establecemos el ancho de miniatura
		//ancho de la imagen nueva
		$info= pathinfo($nameimagen);
		$tamano = getimagesize($tmpimagen);
			
		$width = $tamano[0]; //ancho de la imagen
		$height = $tamano[1]; //alto de la imagen	

		if ($width > $height)
		{ 
			echo "<p style='color: red;'>Lo sentimos la imagen tiene que ser simetrica (Ejemplo 600px X 600px) vuelve e int&eacute;ntalo de nuevo.</p>"; exit;
			//$alto = intval($height * $ancho / $width) dejamos esta si queremos que el tamaño sea proporcional al ancho en este caso 60px
		}
		else
		{
			//comprobamos la extension de la imagen	
			if ($info['extension'] == "jpg" or $info['extension'] == "JPG")
			{
				if($tmanoMaximo > 1048577)
				{
					echo "<p style='color: red;'>Lo sentimos el tama&ntilde;o de la imagen es superior a 1 mb  prueba reduciendolo.</p>"; exit;
				}
				else
				{
					//============================PHOTO NUMERO 1================
					$ancho = 60;
					$alto = 60; //alto de la nueva imagen
					$viejaimgen = imagecreatefromjpeg($tmpimagen);
					$nuevaimagen = imagecreatetruecolor($ancho, $alto); //nueva imagen
					imagecopyresized($nuevaimagen, $viejaimgen,0,0,0,0,$ancho,$alto,$width,$height);
									
					$original = $tmpimagen;
								
					$prefijo = substr(md5(uniqid(rand())),0,50);
					$miniatura = "../catalogo/photo/small/60x60/venyor.com_60x60_$prefijo$nameimagen";
					$destino = "catalogo/photo/small/60x60/venyor.com_60x60_$prefijo$nameimagen";							
									
					copy($tmpimagen, $original);
					imagejpeg($nuevaimagen,$miniatura,90);
					//============================PHOTO NUMERO 1================					
								
					//============================PHOTO NUMERO 2================
					$ancho = 700;
					$alto = 700;
					$viejaimgen = imagecreatefromjpeg($tmpimagen);
					$nuevaimagen = imagecreatetruecolor($ancho, $alto); //nueva imagen
					imagecopyresized($nuevaimagen, $viejaimgen,0,0,0,0,$ancho,$alto,$width,$height);
									
					$original = $tmpimagen;
								
					$prefijo = substr(md5(uniqid(rand())),0,50);
					$miniatura = "../catalogo/photo/big/700x700/venyor.com_700x700_$prefijo$nameimagen";
					$destino4= "catalogo/photo/big/700x700/venyor.com_700x700_$prefijo$nameimagen";							
								
					copy($tmpimagen, $original);
					imagejpeg($nuevaimagen,$miniatura,90);
					//============================PHOTO NUMERO 2================
				}	
			}
			else{echo "Solo imagenes jpg";exit;}
		}
		//**************************COMIENZO DE GUARDADO DE IMAGENES	
		if (mysql_select_db($database_cnx,$cnx))
		{
			$consulta="
				insert into vy_catalogo (
					activar,				
					cantidad,
					color,
					descripcion,
					fechasubida,
					kategorie_id,
					peso,
					precio,
					referencia,					
					unterkategorie_id,
					sujet_id,
					imagen60, 
					imagen700	)
				values (
					'$activar',				
					'$cantidad',
					'$color',
					'$descripcion',
					'$fechasubida',
					'$categoria',
					'$peso',
					'$precio',
					'$referencia',					
					'$subCategoria',
					'$tema',
					'$destino', 
					'$destino4'	)
					";
			if (mysql_query($consulta,$cnx))
			{
				echo "Su Producto se ha guardado con exito en la base de datos <a href='catalogoAdd.php'>Seguir Agregando</a>";
			}
			else
			{
				echo mysql_error($cnx);
			}
		}
		//**************************FINAL DE GUARDADO DE IMAGENES	
	}
}
#******************************FIN VALIDACIONES TODOS LOS CAMPOR LLENOS
?>