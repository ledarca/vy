<?php 	
session_start();
require_once('../Connections/cnx.php');

if(isset($_SESSION['carritovyf'])||isset($_POST['producto'])){
	if(isset($_SESSION['carritovyf'])){
		// 	VARIABLE DE SESION CARRITO_MIO			
		$carrito_mio =	$_SESSION['carritovyf'];
		if(isset($_POST['producto'])){
			$cantidad 	=	$_POST['cantidad'];
			$precio 	= 	$_POST['precio'];
			$nombre 	= 	$_POST['producto'];
			$peso 		= 	$_POST['peso'];
			$codigo 	= 	$_POST['codigo'];
			$color 		= 	$_POST['color'];
			
//	CODIGO DE CONTROL ************
		$donde=-1;
		for($i=0; $i<=count($carrito_mio)-1;$i++){
			if ($nombre==$carrito_mio[$i]['producto']){
				$donde=$i; } 
				}
// CONTROLADOR DE los elementos: PARA QUE NO SE DUPLIQUEN EN LA MATRIZ ***************************************************************
			if ($donde !=-1){
				$cuanto=$carrito_mio[$donde]['cantidad']+ $cantidad;
				$carrito_mio[$donde]=array("producto"=>$nombre, "precio"=>$precio, "cantidad"=>$cuanto, "peso"=>$peso, "color"=>$color, "codigo"=>$codigo );
			}else{
// matriz asociativa***********************************************************************************************************
		$carrito_mio[]=array("producto"=>$nombre,"precio"=>$precio, "cantidad"=>$cantidad, "peso"=>$peso, "color"=>$color, "codigo"=>$codigo );
		} 		}		}
		else{
			$nombre=$_POST['producto'];
			$precio=$_POST['precio'];
			$cantidad=$_POST['cantidad'];
			$peso=$_POST['peso'];
			$codigo=$_POST['codigo'];
			$color= $_POST['color'];
			$carrito_mio[]=array("producto"=>$nombre,"precio"=>$precio,"cantidad"=> $cantidad, "peso"=>$peso, "color"=>$color, "codigo"=>$codigo);}
// permite cambiar los datos de cantidad manualmente actualizar*********************************************
			if(isset ($_POST['cantidad2'])){
				$id=$_POST['id'];
				$cuantos=$_POST['cantidad2'];
				if($cuantos<1){
					$carrito_mio[$id]=NULL;	
				}else{
					$carrito_mio[$id]['cantidad']=$cuantos;
				}}}
// permite borrar  papelera******************************************************************************************
				if(isset($_POST['id2'])){
					$id=$_POST['id2'];
					$carrito_mio[$id]=NULL;	}
$_SESSION['carritovyf']= $carrito_mio;	
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="es" class="no-js"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
    <title>Carrito de Compra</title>
    <meta name="viewport" content="width=device-width">
	<meta name="distribution" content="global">
	<meta name="robots" content="none,nofollow">
	<link rel="shortcut icon"  href="img/faviconvy.ico">
	<link rel="stylesheet"  href="../css/normalize.css">
	<link rel="stylesheet"  href="../css/base.css">
</head>

<body>
	<!-- beging header-->
	<header>
		<?php include('includes/header.php') ?>
	</header>
	<!-- end header-->


	<div class="container_16">
	
	   <div id="carritoMain"> 
	   		<h1>Carrito de compras</h1>
	   		
	   		<div id="titulo">	 
			    <ul>
			        <li><h2>Referencia</h2></li>
			        <li><h2>Cod-des</h2></li>
			        <li><h2>P. Unit (Bs.)</h2></li>
			        <li><h2>Cantidad</h2></li>
			        <li><h2>Color</h2></li>
			        <li><h2>Peso (Gr.)</h2></li>
			        <li><h2>Sub-total</h2></li>                
			        <li><h2>Eliminar</h2></li>
			    </ul>
			</div>

		   <?php
		   	if(isset($_SESSION['carritovyf'])){
			  $total=0;
			  $totalgramos=0;
			  $totalcantidad=0;
			 				for($i=0;$i<=count($carrito_mio)-1;$i++){
							 if($carrito_mio[$i]!=NULL){
		    ?>    
	  
			<div class="descripcion">
				<ul>
	    			<li><h2><?php print $carrito_mio[$i]['codigo'];?></h2></li>
	        		<li><h2><?php print $carrito_mio[$i]['producto'];?></h2></li>
	        		<li><h2 class="derecha"><?php print number_format($carrito_mio[$i]['precio'], 2, ',', '.');?></h2></li>
	        		<li>
						<form id="form1" name="form1" method="post" action="">
				    		<label>
				        		<input name="id" type="hidden" id="id" value="<?php $can= print $i;?>" />
				          		<input name="cantidad2" type="text" id="cantidad2" value="<?php print $carrito_mio[$i]['cantidad']; ?>" size="4" maxlength="4" />
				         		<input name="actualizar" type="submit" class="actualizar" value="Actualizar"  />
				        	</label>
				    	</form>
				    </li>
	    			<li><h2><?php print $carrito_mio[$i]['color']; ?></h2></li>
	    			<li><h2 class="derecha"><?php print number_format($carrito_mio[$i]['peso'] * $carrito_mio[$i]['cantidad'], 2, ',', '.'); ?></h2></li>
	        		<li><h2 class="derecha"><?php print number_format($carrito_mio[$i]['precio'] * $carrito_mio[$i]['cantidad'], 2, ',', '.'); ?></h2></li>
	   				<li>
						<form id="form2" name="form2" method="post" action="">
							<label>
								<input name="id2" type="hidden" id="id2" value="<?php print $i;?>" />
								<input name="eliminar" type="submit" class="actualizar" value="Eliminar"  />
	      					</label>
	    				</form>
	    			</li>
	   			</ul>
			</div>
    
		     <?php
	     $total= $total+($carrito_mio[$i]['precio'] * $carrito_mio[$i]['cantidad']);
		 $totalgramos= $totalgramos+(($carrito_mio[$i]['peso'] * $carrito_mio[$i]['cantidad'])/1000);
		 $totalcantidad= $totalcantidad+($carrito_mio[$i]['cantidad']);
			 }	}  } ;		    
			 ?>

			 <div class="descripcion">
	        	<ul>
	                <li><h2>Total:</h2></li>
	                <li></li>
	                <li></li>
	                <li></li>
	                <li></li>
	                <li><h2>Kg: 
	                  <?php if(isset($_SESSION['carritovyf'])){print number_format($totalgramos, 2, ',', '.');}?>
	                </h2>
	                </li>
	                <li><h2>BsF. <?php if(isset($_SESSION['carritovyf'])){print number_format($total, 2, ',', '.');} ?></h2></li>                
	                <li><h1></h1></li>
	            </ul>
	 		</div>

			<!--CONTROLADOR DE COMPRAS PARA DESBLOQUER EL BOTON **********-->
			
					<form name="form4" method="post" action="resumen.php"/>
						<input type="submit" value="Enviar Pedido"/>
					</form>
			
		</div>
	<div class="clear"></div>
	</div>
	
	<!--Comienzo del pie-->
	<header>
	<?php include('includes/footer.php'); ?>
	</header>
	<!--fin del pie-->
</body>
</html>