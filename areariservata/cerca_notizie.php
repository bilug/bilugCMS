<div class="contenitore">

	<div class="float100">Titolo o sottotitolo:</div>
	<div class="float160"><input type="text" id="notizia" value="" /></div>

	<div class="float100">Argomento:</div>
	<div class="float200">
		<select id="argomento">
		<?php
			$sql = "SELECT ID, argomenti FROM argomenti ORDER BY argomenti";
			$rssql = mysql_query( $sql );
			echo "<option value=\"0\">--------</option>";
			if ( mysql_num_rows( $rssql ) > 0 ) {
				while( $r = mysql_fetch_row( $rssql ) ) {
					echo "<option value=\"$r[0]\">$r[1]</option>";
				}
			}
		?>
		</select>
	</div>
	
	<?php
	$get = "
		'notizia=' + document.getElementById('notizia').value + 
		'&argomento=' + document.getElementById('argomento').value
	";
	
	?>
	 
	<div class="float100">
		<input type="button" name="" value="Cerca" onclick="genera_ajax( 'ajax/ajax_cerca_notizie.php', <?=$get?>, '#lista_articoli' );" />
	</div>
	
	<div class="azzerafloat"></div>

	<p>&nbsp;</p>
	
	<div id="lista_articoli"></div>
	
</div>