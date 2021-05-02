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

<?php

	echo "<div class=\"contenitore\"><div class=\"azzerafloat\"></div>";
	
    if ( $Max > $Page ) {          
		//setto il valore max e minimo della pagina da visualizzare a video
		$t = $Max - $inizio;
		$tot = $Max - $Page - $inizio + 1;
		$f = ( $tot < 0 ) ? $f = 1: $f;               

		//Creo la form per navigare
		echo "<form method=\"post\" action=\"#fragment-8\" name=\"log\">
			<h3>" . $t . " - " . $f . "</h3>
			<input type=\"hidden\" name=\"inizio\" value=\"$inizio\"/>
			<input type=\"hidden\" name=\"Max\" value=\"$Max\"/>";

			if ($inizio != 0) echo "<input type=\"submit\" class=\"medio\" value=\"Successivi\" name=\"Nav\"/>";
			if ($inizio+$Page<$Max) echo "<input type=\"submit\" class=\"medio\" value=\"Precedenti\" name=\"Nav\" />";
		echo "</form>";
	}	
	
	echo "<div class=\"\">
		   <div class=\"float500\"><h5>Query</h5></div> <!-- query -->
		   <div class=\"float180\"><h5>IP</h5></div> <!-- ip -->
		   <div class=\"float180\"><h5>Data</h5></div> <!-- data -->
		   <div class=\"azzerafloata\"></div>
		</div>
	";

	//se abbiamo un risultato dalla query costruiamo la tabella
	// ciclo per cui finchè abbiamo risultati ci costruisce una riga alla volta
	while($control=mysql_fetch_assoc($risultato)) {    
		echo "<div class=\"\">
			<div class=\"float500\">$control[query]</div> <!-- query -->
			<div class=\"float180\">$control[ip]</div> <!-- ip -->
			<div class=\"float180\">$control[data]</div> <!-- data -->
		";
	
		echo "<div class=\"azzerafloata\"></div></div>";  
	}
	
	if ( $Max > $Page ) {
		echo "<form method=\"post\" action=\"#fragment-8\" name=\"log\">
			<h3>" . $t . " - " . $f . "</h3>
       		<input type=\"hidden\" name=\"inizio\" value=\"$inizio\"/>
       		<input type=\"hidden\" name=\"Max\" value=\"$Max\"/>";
       
			if ($inizio != 0) echo "<input type=\"submit\" class=\"medio\" value=\"Successivi\" name=\"Nav\"/>";
			if ($inizio+$Page<$Max) echo "<input type=\"submit\" class=\"medio\" value=\"Precedenti\" name=\"Nav\" />";
		echo "</form>";
	}	
	
	echo "</div>";

?>