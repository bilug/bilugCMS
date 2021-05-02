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
<link type="text/css" href="css/ui-lightness/jquery-ui-1.7.3.custom.css" rel="stylesheet" />	
		<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
		<script type="text/javascript" src="js/jquery-ui-1.7.3.custom.min.js"></script>
<style type="text/css">
	#tabs {
		width: 99%;
	}
	</style>
	<script type="text/javascript">
	$(function() {
		$("#tabs").tabs();
	});
	</script>
<?php

$str=" SELECT ID,nome,email FROM email order by ord";
// facciamo una query per caricare tutti i dati della tabella
$risultato=mysql_query($str);

echo "<h3> E-mail </h3>
	<div id=\"tabs\">
	<ul>
        <li><a href=\"#fragment-1\"><span>Elenco</span></a></li>
        <li><a href=\"#fragment-2\"><span>Nuova</span></a></li>
	</ul>             
	                
<div id=\"fragment-1\">";
	
if (mysql_num_rows($risultato)>0)
{
	echo "<div class=\"contenitore\"><div class=\"azzerafloat\"></div>";
   //se abbiamo un risultato dalla query costruiamo la tabella
   while($control=mysql_fetch_row($risultato))
   // ciclo per cui finchè abbiamo risultati ci costruisce una riga alla volta
   {
   	echo "<div class=\"evidenzia\">
      <div class=\"float20\">$control[0]</div>
      <div class=\"float500\"><a href=\"area.php?pag=insert_email.php&amp;id=$control[0]\">$control[1]($control[2])</a></div>
      <div class=\"float70\"><img src=\"./img/del.png\" class=\"ico\" /><a href=\"area.php?pag=delete.php&id=$control[0]&from=elenco_email.php\">Elimina</a></div>
      <div class=\"float70\"><img src=\"./img/su.png\" class=\"ico\" /><a href=\"updown_email.php?dir=U&amp;id=$control[0]\">Alzare</a></div>
      <div class=\"float70\"><img src=\"./img/giu.png\" class=\"ico\" /><a href=\"updown_email.php?dir=D&amp;id=$control[0]\">Abbassa</a></div>
      <div class=\"azzerafloat\"></div>
      </div>";
   }
   echo "</div>";
}
else 
{
	echo "<p>Tabella vuota</p>";
}
echo "<br /> </div><div id=\"fragment-2\">";
 include("./insert_email.php");
echo "</div>";

?>
