<div class="grid_4" id="sidebarCat">
    
  <!--   COMIENZA TEMA-->
  <div id="temaDetalle">
    <h2 class="separadorVerde">CATEGOR&Iacute;AS</h2>
		
    <ul>
		 	<?php do { ?>
      <li>
        <h3><a href="detalleCat.php?ema=<?php echo $row_RsTema['sujet_id']; ?>"><?php if ($row_RsTema['activar']==true) echo $row_RsTema['nombre_tema']; ?></a></h3>
      </li>
      <?php } while ($row_RsTema = mysql_fetch_assoc($RsTema)); ?>
    </ul>
  </div>
  <!--   FINALIZA TEMA-->


  <!--   COMIENZA CATEGORIA-->
  <div id="categoriaDetalle">
    <h2 class="separadorFucsia"><?php echo $row_RsCategoria['nombre_tema']; ?></h2>
    
    <ul>
		 	<?php do { ?>
		  <li>
		    <h3><a href="detalleCat.php?ria=<?php echo $row_RsCategoria['kategorie_id']; ?>&ema=<?php echo $row_RsCategoria['sujet_id']; ?>"><?php echo $row_RsCategoria['nombre_categoria']; ?></a></h3>
      </li>
		  <?php } while ($row_RsCategoria = mysql_fetch_assoc($RsCategoria)); ?>
     </ul>
  </div>
 	<!--   FINALIZA CATEGORIA-->


  <!--   COMIENZA SUB-CATEGORIA-->
  <div id="subCategoriaDetalle">
  <?php if ($totalRows_RsSubcategoria > 0) { // Show if recordset not empty ?>
    <h2 class="separadorFucsia"><?php echo $row_RsSubcategoria['nombre_categoria']; ?></h2>

    <ul>
     <?php do { ?>
      <li>
        <h3><a href="detalleCat.php?sria=<?php echo $row_RsSubcategoria['unterkategorie_id']; ?>&ema=<?php echo $row_RsSubcategoria['sujet_id']; ?>&ria=<?php echo $row_RsSubcategoria['kategorie_id']; ?>"><?php echo $row_RsSubcategoria['nombre_subcategoria']; ?></a></h3>
      </li>
      <?php } while ($row_RsSubcategoria = mysql_fetch_assoc($RsSubcategoria)); ?>
    </ul>
  <?php } // Show if recordset not empty ?>
  </div>
  <!--   FINALIZA SUB-CATEGORIA-->

</div>