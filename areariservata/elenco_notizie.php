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

$str="
	SELECT a.ID, a.argomenti, l.lingua 
	FROM argomenti AS a 
	INNER JOIN lingue AS l ON l.id = a.id_lingua 
	ORDER BY a.argomenti
";
// facciamo una query per caricare gli argomenti

$str2="SELECT * FROM notizie";
$risultato2=mysql_query($str2);
$cont=mysql_num_rows($risultato2);
// facciamo una query per caricare le notizie

$risultato=mysql_query($str);
if (mysql_num_rows($risultato)>0)
{
	echo "<div class=\"contenitore\"><div class=\"azzerafloat\"></div>";
   echo "<div class=\"float200\">
   <a href=\"area.php?pag=elenco_all_notizie.php\">TOTALE NOTIZIE PRESENTI</a></div>
   <div class=\"float100\">N. $cont</div>
   <div class=\"float160\">Lingua argomento</div>";
   echo "<div class=\"azzerafloat\"></div>";
   //se abbiamo un risultato dalla query costruiamo la tabella
   while($control=mysql_fetch_row($risultato))
   // ciclo per cui finchè abbiamo risultati ci costruisce una riga alla volta
   {
		$str3="SELECT * FROM notizie WHERE argomento = '$control[0]'";
		$risultato3=mysql_query($str3);
		$cont2=mysql_num_rows($risultato3);
		// calcoliamo il numero di righe con mysql_num_rows in base all'argomento
		echo "
		<div class=\"float200\"><a href=\"area.php?pag=elenco_arg_notizie.php&amp;arg=$control[0]\">$control[1]</a></div>
		<div class=\"float100\">N. $cont2</div>
		<div class=\"float160\">$control[2]</div>
		<div class=\"azzerafloat\"></div>";
	}
   echo "</div>";
}
else 
	echo "<p>Tabella vuota</p>";
?>