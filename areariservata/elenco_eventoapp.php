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

$str="
	SELECT e.ID, DATE_FORMAT(e.dataora,'%d-%m-%Y %H:%i'), e.titolo, e.luogo, e.tipo, l.lingua 
	FROM eventi AS e 
	INNER JOIN lingue AS l ON l.id = e.id_lingua
	ORDER BY e.dataora
";
// facciamo una query per caricare tutti i dati della tabella
$risultato=mysql_query($str);

echo "<h3> Eventi </h3>
	<div id=\"tabs\">
	<ul>
        <li><a href=\"#fragment-1\"><span>Elenco</span></a></li>
        <li><a href=\"#fragment-2\"><span>Nuova</span></a></li>
        <li><a href=\"#fragment-3\"><span>Visualizza eventi</span></a></li>
	</ul>             
";	                

echo "<div id=\"fragment-1\">";
	if (mysql_num_rows($risultato)>0)
	{
		echo "<div class=\"contenitore\"><div class=\"azzerafloat\"></div>
		<div class=\"float20\">ID</div> <!-- id -->
	   <div class=\"float140\">Data</div> <!-- Data -->
	   <div class=\"float200\">Titolo</div> <!-- nome -->
	   <div class=\"float100\">Luogo</div> <!-- multipli -->
	   <div class=\"float100\">Tipo</div> <!-- attivo -->            
	   <div class=\"float100\">Lingua</div> <!-- Lingua evento -->            
	   <div class=\"azzerafloat\"></div>";
		//se abbiamo un risultato dalla query costruiamo la tabella
		while($control=mysql_fetch_row($risultato))
		// ciclo per cui finchè abbiamo risultati ci costruisce una riga alla volta
	   {
		echo "<div class=\"evidenzia\"><div class=\"".($control[4]=='E'? "evento":"appuntamento")."\">            
		  <div class=\"float20\">$control[0]</div> <!-- id -->
		  <div class=\"float140\">$control[1]</div> <!-- Data -->
		  <div class=\"float200\">$control[2]</div> <!-- nome -->
		  <div class=\"float100\">$control[3]</div> <!-- multipli -->
		  <div class=\"float100\">".($control[4]=='E'? "Evento":"Appuntamento")."</div> <!-- attivo -->            
		  <div class=\"float100\">$control[5]</div> <!-- attivo -->            
		  <div class=\"float70\"><img src=\"./img/del.png\" class=\"ico\" /><a href=\"area.php?pag=delete.php&id=$control[0]&from=elenco_eventoapp.php\">Elimina</a></div>                        
		  <div class=\"float70\"><img src=\"./img/mod.png\" class=\"ico\" /><a href=\"area.php?pag=insert_eventoapp.php&amp;id=$control[0]\">Modifica</a></div>            
		  <div class=\"float70\"><img src=\"./img/dup.png\" class=\"ico\" /><a href=\"area.php?pag=duplica.php&id=$control[0]&from=elenco_eventoapp.php\">Duplica</a></div>            
		  <div class=\"azzerafloat\"></div></div></div>";         
		}
		echo "</div>";
	}
	else 
	{
		echo "<p>Tabella vuota</p>";
	}
echo "</div>";


echo "<div id=\"fragment-2\">";
	include("./insert_eventoapp.php");
echo "</div>";


echo "<div id=\"fragment-3\">";
	include("./mese_eventoapp.php");
echo "</div>";

?>
