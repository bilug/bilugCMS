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

$id = $_GET['id'];
$str=" SELECT ID,IDmenu,voce,ordine FROM menuvoci where IDmenu='$id' order by ordine";
// facciamo una query per caricare tutti i dati della tabella
$risultato=mysql_query($str);
if (mysql_num_rows($risultato)>0)
{
	echo "<div class=\"contenitore\"><div class=\"azzerafloat\"></div>";
   //se abbiamo un risultato dalla query costruiamo la tabella
   while($control=mysql_fetch_row($risultato))
   // ciclo per cui finchè abbiamo risultati ci costruisce una riga alla volta
   {
   	echo "<div class=\"evidenzia\">
      <div class=\"float20\">$control[3]</div>
      <div class=\"float200\">$control[2]</div>
      <div class=\"float50\"><a href=\"del_menuvoce.php?id=$control[0]&amp;idm=$id\">Elimina</a></div>
      <!-- Assegnamo all'id il valore che otteniamo con la query -->
      <div class=\"float50\"><a href=\"area.php?pag=insert_menuvoci.php&amp;id=$control[0]\">Modifica</a></div>
      <div class=\"float50\"><a href=\"updown_voci.php?dir=U&amp;id=$control[0]&amp;idm=$id\">Alzare</a></div>
      <div class=\"float50\"><a href=\"updown_voci.php?dir=D&amp;id=$control[0]&amp;idm=$id\">Abbassa</a></div>
      <div class=\"azzerafloat\"></div></div>";
    }
    echo "</div>";
}
else 
	echo "<p>Tabella Vuota</p>";
   	
echo "<a href=\"area.php?pag=insert_menuvoci.php&amp;idm=$id\">Aggiungi</a><br/>";
echo "<a href=\"javascript:history.go(-1)\">Indietro</a>";
?>