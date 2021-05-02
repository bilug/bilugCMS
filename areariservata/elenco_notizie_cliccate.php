<? /* license

BilugCMS (http://www.bilug.it) - Content Management System for dynamic web sites
Copyright (C) 2005-2008  Federico Villa and Alessio Loro Piana

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.

For reference, contact bilugcms@vilnet.it


license */ ?>

<div class="contenitore">

	<div class="float100">Numero notizie da visualizzare:</div>
	<div class="float200">
		<select id="quanti">
			<option value="">------------</option>
			<option value="10">10</option>
			<option value="50" selected>50</option>
			<option value="100">100</option>
			<option value="*">Tutte</option>
		</select>
	</div>

	<?php
	$get = "
		'quanti=' + document.getElementById('quanti').value
	";

	?>
	 
	<div class="float100">
		<input type="button" name="" value="Cerca" onclick="genera_ajax( 'ajax/ajax_cerca_notizie.php', <?=$get?>, '#lista_articoli_cliccati' );" />
	</div>

	<div class="azzerafloat"></div>

	<p>&nbsp;</p>

	<div id="lista_articoli_cliccati">
	<?php
		$sql = "SELECT ID, titolo, sottotitolo, testo, autore, argomento, DATE_FORMAT(data,'%d-%m-%Y'), autorizza, evidenzia, cliccato FROM notizie ORDER BY cliccato DESC LIMIT 50";
		$risultato = mysql_query( $sql );
		if (mysql_num_rows($risultato)>0) {
			include( "include/include_tabella_notizie.php" );
		}
		else 
			echo "<p>Tabella vuota</p>";	
	?>	
	</div>
	
</div>