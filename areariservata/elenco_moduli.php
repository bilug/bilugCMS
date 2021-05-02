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

$str="SELECT ID, titolo,posizione,attivo,zona,ordine FROM moduli group by posizione,ID order by ordine";
// facciamo una query per caricare gli argomenti
$risultato=mysql_query($str);  
// facciamo una query per caricare le notizie  
if (mysql_num_rows($risultato)>0)
{
	echo "<div class=\"contenitore\"><div class=\"azzerafloat\"></div>";					              
   echo "
   	<div class=\"float100\">N.</div>
      <div class=\"float200\">Titolo</div>
      <div class=\"float50\">Posiz.</div>
      <div class=\"float50\">attivo</div>
      <div class=\"float50\">zona</div>
      ";              
   echo "<div class=\"azzerafloat\"></div>";          
   while($control=mysql_fetch_row($risultato))
   // ciclo per cui finchè abbiamo risultati ci costruisce una riga alla volta
   {
   	echo "<div class=\"evidenzia\">
   			<div class=\"float100\">N. $control[5]</div>
      		<div class=\"float200\">$control[1]</div>
      		<div class=\"float50\">$control[2]</div>
      		<div class=\"float50\">$control[3]</div>
      		<div class=\"float50\">$control[4]</div>";
		if ($typo =="A")
      {
      	echo "<div class=\"float50\"><a title=\"|Elimina Modulo\" href=\"del_moduli.php?id=$control[0]\">Elimina</a></div>             
      			<div class=\"float50\"><a title=\"|Modifica Modulo\" href=\"area.php?pag=insert_moduli.php&amp;id=$control[0]\">Modifica</a></div>";
      }
		echo "<div class=\"float50\"><a href=\"updown_moduli.php?dir=U&amp;id=$control[0]\">Alzare</a></div>
      	<div class=\"float50\"><a href=\"updown_moduli.php?dir=D&amp;id=$control[0]\">Abbassa</a></div>
         <div class=\"float50\"><a ".
         ($control[3]=="si"?"title=\"|Il modulo non sar&agrave; visualizzato nel Portale\"":"title=\"|Il modulo sar&agrave; visualizzato nel Portale\"").
         " href=\"attdiv_moduli.php?dir=$control[3]&amp;id=$control[0]\">".
         ($control[3]=="si"?"Disattiva":"Attiva")."</a></div>              
         <div class=\"azzerafloat\"></div></div>";
   }
   echo "</div>";
}
else
	echo "<p>Tabella vuota</p>";
?>