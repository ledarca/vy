<?PHP session_start(); print_r($carrito_mio['$i']); ?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="es" class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <title>Resumen de Compra</title>
    <meta name="viewport" content="width=device-width">
    <meta name="distribution" content="global">
    <meta name="robots" content="none,nofollow">
    <link rel="shortcut icon"  href="img/faviconvy.ico">
    <link rel="stylesheet"  href="../css/normalize.css">
    <link rel="stylesheet"  href="../css/base.css">
    <link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">
    <link href="../SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css">
    <link href="../SpryAssets/SpryCollapsiblePanel.css" rel="stylesheet" type="text/css">
    <script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
    <script src="../SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
	<script src="../SpryAssets/SpryCollapsiblePanel.js" type="text/javascript"></script>
</head>
<body>

    <!-- beging header-->
    <header>
    	<?php include('includes/header.php'); ?>
    </header>
    <!-- end header-->


    <div class="container_16">

    <div id="carritoMain"> 
        <h1>Resumen de la compra</h1>
        <p class="boton"><a href="index.php">Atras</a></p>
   		
        <div id="titulo"> 
		    <ul>
                    <li><h2>Referencia</h2></li>
                    <li><h2>Cod-des</h2></li>
                    <li><h2>P. Unit (Bs.)</h2></li>
                    <li><h2>Cantidad</h2></li>
                    <li><h2>Color</h2></li>
                    <li><h2>Peso (Gr.)</h2></li>
                    <li><h2>Sub-total</h2></li>                
       
            </ul>
		</div>

	   <?
	   	if(isset($_SESSION['carritovyf'])){
		  $total=0;
		  $totalgramos=0;
		  $totalcantidad=0;
		 				for($i=0;$i<=count($carrito_mio)-1;$i++){
						 if($carrito_mio[$i]!=NULL{

	    ?>    

		<div class="descripcion">
			<ul>
    			<li><h2><?php echo $carrito_mio[$i]['codigo'];?></h2></li>
        		<li><h2><?php print $carrito_mio[$i]['producto'];?></h2></li>
        		<li><h2 class="derecha"><?php print number_format($carrito_mio[$i]['precio'], 2, ',', '.');?></h2></li>
        		<li><h2 class="derecha"><?php print number_format($carrito_mio[$i]['cantidad'], 2, ',', '.'); ?></h2></li>
    			<li><h2><?php print $carrito_mio[$i]['color']; ?></h2></li>
    			<li><h2 class="derecha"><? print number_format($carrito_mio[$i]['peso'] * $carrito_mio[$i]['cantidad'], 2, ',', '.'); ?></h2></li>
        		<li><h2 class="derecha"><? print number_format($carrito_mio[$i]['precio'] * $carrito_mio[$i]['cantidad'], 2, ',', '.'); ?></h2></li>
   			</ul>
		</div>

	     <? 
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
                <li><h2> 
                  <? if(isset($_SESSION['carritovyf'])){print "Kg. ".number_format($totalgramos, 2, ',', '.');}?>
                </h2>
                </li>
                <li><h2>Bs. <? if(isset($_SESSION['carritovyf'])){print number_format($total, 2, ',', '.');} ?></h2></li>                
            </ul>
 		</div>
    <div class="clear"></div>
    </div>

        <div class="formularioMain">
            <div class="formulario">
            <form method="post" action="guardar.php">
                <fieldset>
                    <legend>Formulario para enviar el Pedido</legend>
                        
                    <label for="nombre">Nombre:</label>
                        <span id="sprytextfield1">
                        <input type="text" name="nombre" id="nombre" tabindex="1" />
                        <span class="textfieldRequiredMsg">Se necesita un valor!</span><span class="textfieldInvalidFormatMsg">Formato no válido.</span></span>                  
                        
                        
                        <label for="correo">Correo:</label>
            		<span id="sprytextfield2">
                        <input name="correo" type="text" id="correo" tabindex="2"  />
                        <span class="textfieldRequiredMsg">Se necesita un valor!</span><span class="textfieldInvalidFormatMsg">Formato no válido.</span></span>
                        
                                
                    <label for="cedula">Cédula:</label>
                        <span id="sprytextfield4">
                        <input type="text" name="cedula" id="cedula" maxlength="8" tabindex="3" />
                        <span class="textfieldRequiredMsg">Se necesita un valor.</span><span class="textfieldInvalidFormatMsg">Formato no válido.</span></span>
                        
                        
                    <label for="telefono">Teléfono:</label>
                    <span id="sprytextfield5">
                        <input name="telefono" type="text" id="telefono"maxlength="12" tabindex="4"   />
                        <span class="textfieldRequiredMsg">Se necesita un valor.</span><span class="textfieldInvalidFormatMsg">Formato no válido.</span></span>
                        
                        
                        <label for="direccion">Dirección:</label>
                        <span id="sprytextarea1">
                        <textarea rows="4" id="direccion" name="direccion" tabindex="5"/></textarea>
                        <span class="textareaRequiredMsg">Se necesita un valor!</span></span>
                        
                           <input name="grabar" type="hidden" value="si" />
                </fieldset>
                
                <input type="submit" value="Enviar Pedido"  tabindex="5"/>
            </form>
            </div>
            
            <div id="info">
                <div id="CollapsiblePanel1" class="CollapsiblePanel">
                  <div class="CollapsiblePanelTab" tabindex="0">Información</div>
                  <div class="CollapsiblePanelContent"><p>Estimado usuario es necesario rellenar los datos con información verdadera, ya que los datos se van a usar para mandar el producto.</p></div>
                </div>
            </div>
        </div>
    </div>

  <!--beg. footer-->
  <?php include('includes/footer.php') ?>
  <!--end. footer-->

    <script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "custom");
    var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "email");
    var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea1");
    var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "integer");
    var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5", "phone_number", {format:"phone_custom", hint:"Ejem 04121112222"});
	var CollapsiblePanel1 = new Spry.Widget.CollapsiblePanel("CollapsiblePanel1", {contentIsOpen:false});
    </script>
</body>
</html>