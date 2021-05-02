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

$str="SELECT ID, nome, cognome FROM anagrafica ORDER BY ID DESC";
// facciamo una query per caricare gli autori

$risultato = mysql_query( $str );
$cont = mysql_num_rows( $risultato );

if ( mysql_num_rows( $risultato ) > 0 ) {
	echo "<div class=\"contenitore\"><div class=\"azzerafloat\"></div>";
	echo "<div class=\"float200\">
	<a href=\"area.php?pag=elenco_all_notizie.php\">TOTALE NOTIZIE PRESENTI</a></div>
	<div class=\"float100\">N. $cont</div>";
	echo "<div class=\"azzerafloat\"></div>";
	//se abbiamo un risultato dalla query costruiamo la tabella
	// ciclo per cui finchè abbiamo risultati ci costruisce una riga alla volta
	while( $control = mysql_fetch_row( $risultato ) ) {
		$str3 = "SELECT * FROM notizie WHERE autore = '$control[0]'";
		$risultato3 = mysql_query($str3);
		$cont2 = mysql_num_rows($risultato3);
		// calcoliamo il numero di righe con mysql_num_rows in base ad un autore
		echo "
		<div class=\"float200\"><a href=\"area.php?pag=elenco_aut_notizie.php&amp;aut=$control[0]\">$control[1] $control[2]</a></div>
		<div class=\"float100\">N. $cont2</div>
		<div class=\"azzerafloat\"></div>";
	}
	echo "</div>";
}
else 
	echo "<p>Tabella vuota</p>";
?>
