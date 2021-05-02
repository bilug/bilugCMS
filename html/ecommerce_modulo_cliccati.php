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
<!-- tabella menù  -->
<div class="blocco">
	<h3><span><?=$titolo?></span></h3>
	
	<div class="modulo cliccato">		
	<?php
	$str="SELECT id, titolo, descrizione, foto FROM ecommerce ORDER BY cliccato DESC LIMIT " . _MAXCLICCATIECOMMERCE;
	$risultato=mysql_query($str);
	if (mysql_num_rows($risultato)>0)
	{
		while( $r = mysql_fetch_array( $risultato ) ) {
			$id = $r[0];
			$titolo = $r[1];
			$desc = trim( strip_tags( $r[2] ) );
			$desc = substr( $desc, 0, 49 )."... <a href=\""._URLSITO."/aggiorna_click.php?tab=ecommerce&pag=ecommerce_dettaglio.php&id=$id\"><img src=\""._URLSITO."/img/freccia_vai.gif\" alt=\"&lt;&lt;\" /></a>";
			$img = $r[3];
			$img = substr( $img, 0, strlen( $img )-1 );
			
			echo "<div class=\"riga_cliccato\">";
			
				echo "<div class=\"immagine\">";
					echo "<a href=\""._URLSITO."/aggiorna_click.php?tab=ecommerce&pag=ecommerce_dettaglio.php&id=$id\"><img src=\"$img\" alt=\"\" title=\"\" height=\"\" width=\"\" /></a>";
				echo "</div>";

				
					echo "<p class=\"titolo\">$titolo</p>";
					echo "<p class=\"descrizione\">$desc</p>";
				
				echo "<div class=\"azzerafloat\"></div>";
				
			echo "</div>";
		}
	}
	else
		echo "<ul><li>Nessun Argomento</li></ul>";
	?>
	</div>
	
</div>

