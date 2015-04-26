<?php 
	if ($row_RsProducto['catalogo'] == true) 
		{
			print "<p class='boton'>
			<a href=catalogo/index.php?ogo=".$row_RsProducto['kategorie_id'].">Ver catálogo</a></p>";
			}else{
			?>
			<form action='cart/index.php' 	method='post' 	name='form1' target='new' >
				<input name='cantidad'	type='hidden' 	value='1'/>
				<input name='precio' 	type='hidden' 	value="<?php echo $row_RsProducto['precio_prod']?>"/>
				<input name='producto'	type='hidden'  	value="<?php echo $row_RsProducto['produkt_id']?>"/>
				<input name='peso' 		type='hidden'	value="<?php echo $row_RsProducto['peso_prod']?>"/>
				<input name='codigo'	type='hidden'  	value="<?php echo $row_RsProducto['nombre_prod']?>"/>
				<input name='color' 	type='hidden' 	value="<?php echo $row_RsProducto['color_prod']?>"/>			
				<input name='carrito'	type='submit' 	value='A&ntilde;adir a carrito' />
             </form>

<?php	} ?> 



