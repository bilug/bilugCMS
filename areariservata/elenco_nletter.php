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
<h3>Mailing-List</h3>

<?php

$str=" SELECT * FROM maillist ORDER BY id";
// facciamo una query per caricare tutti i dati della tabella
$risultato=mysql_query($str);
if (mysql_num_rows($risultato)>0)
{
	echo "<div class=\"contenitore\"><div class=\"azzerafloat\"></div>";
   echo "
   <div class=\"float20\"><h5>ID</h5></div>
   <div class=\"float100\"><h4>Iscritto</h4></div>
   <div class=\"float300\"><h5>Indirizzo email</h5></div>
   <div class=\"azzerafloat\"></div>";		
   //se abbiamo un risultato dalla query costruiamo la tabella
   while($control=mysql_fetch_row($risultato))
   // ciclo per cui finchè abbiamo risultati ci costruisce una riga alla volta
   {
   	echo "<div class=\"evidenzia\">
      <div class=\"float20\">$control[0]</div>
      <div class=\"float100\"><h4>$control[2]</h4></div>
      <div class=\"float300\">$control[1]</div>
      <div class=\"azzerafloat\"></div></div>";
   }
   echo "</div>";
}
else 
   echo "<p>Tabella vuota</p>";
?>

