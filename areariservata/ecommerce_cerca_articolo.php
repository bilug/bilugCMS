<div class="contenitore">

	<div class="float100">Codice articolo:</div>
	<div class="float160"><input type="text" id="codice" value="" /></div>
	
	<div class="float100">Nome articolo:</div>
	<div class="float160"><input type="text" id="articolo" value="" /></div>
	
	<div class="float100">Categoria:</div>
	<div class="float160">
		<select id="categoria" onchange="genera_ajax( 'ajax/ajax_sc_cerca.php', 'key=' + this.value, '#sc_cerca' );">
		<?php
			echo "<option value=\"\">--------------</option>";
			$sql = "SELECT id, categoria FROM ecommercecategoria";
			$rssql = mysql_query( $sql );
			while( $categoria = mysql_fetch_array( $rssql ) ) {
				$c = substr( $categoria[1], 0, ( strlen( $categoria[1] ) - 2 ) );
				$c = explode( '||', $c );				
				echo "<option value=\"$c[0]\">$c[0]</option>";
			}
		?>	
		</select>
	</div>

	
    <!-- richiamo la sottocategoria... name = 'sottocat' -->
    <div id="sc_cerca" class="float290"><input type="hidden" id="sottocategoria" name="" value="" /></div>
	
	
	<?php
	$get = "
		'codice=' + document.getElementById('codice').value +
		'&articolo=' + document.getElementById('articolo').value +
		'&categoria=' + document.getElementById('categoria').value +
		'&sottocategoria=' + document.getElementById('sottocategoria').value
	";
	
	?>
	 
	<div class="float100">
		<input type="button" name="" value="Cerca" onclick="genera_ajax( 'ajax/ajax_ecommerce_cerca.php', <?=$get?>, '#lista_articoli' );" />
	</div>
	
	<div class="azzerafloat"></div>
	
	<p>&nbsp;</p>
	
	<div id="lista_articoli"><input type="hidden" id="sottocategoria" value="" /></div>
	
</div>
