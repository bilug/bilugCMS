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

$id_categoria = $_GET["categoria"];

$sql = "SELECT categoria FROM ecommercecategoria WHERE id = $id_categoria LIMIT 1";
$rssql = mysql_query($sql);
$categoria = mysql_result($rssql, 0, 0);
    
echo "<h3> $categoria </h3>
	<div id=\"tabs\">
	<ul>
        <li><a href=\"#fragment-1\"><span>Elenco</span></a></li>
	</ul>             
	                
	<div id=\"fragment-1\">";

if ( $sc == '' ) {  
    $query = "
        Select id, titolo, categoria, prezzo, quantita, codice, produttore, prezzo_intero, colore, taglia, riservato, evidenzia, offerta 
        FROM ecommerce 
        WHERE categoria = $id_categoria
    ";
}
else {
    $query = "
        Select id, titolo, categoria, prezzo, quantita, codice, produttore, prezzo_intero, colore, taglia, riservato, evidenzia, offerta 
        FROM ecommerce 
        WHERE categoria = $id_categoria
    ";
}

$ecommerce = mysql_query($query);

echo"<div class=\"contenitore\"><div class=\"azzerafloat\"></div>";
echo "<ul>";
echo "<li class=\"evidenzia\">
		<div class=\"float100\">Codice</div>
		<div class=\"float100\">Articolo</div>
		<div class=\"float100\">Produttore</div>
		<div class=\"float70\">Prezzo</div>
		<div class=\"float70\">Prezzo intero</div>
		<div class=\"float50\">Q.ta</div>
		<div class=\"float50\">Colore</div>
		<div class=\"float50\">Taglia</div>
		<div class=\"float50\" title=\"Prodotti riservati\">Ris</div>
		<div class=\"float50\" title=\"Prodotti evidenziati\">Evi</div>
		<div class=\"float50\" title=\"Prodotti in offerta\">Off</div>
		<div class=\"azzerafloat\"></div></li>";


while($ecom=mysql_fetch_row($ecommerce))
{   
	echo "<li class=\"evidenzia\">
		<div class=\"float100\">$ecom[5]</div>
		<div class=\"float100\">$ecom[1]</div>
		<div class=\"float100\">$ecom[6]</div>";
    
		echo "<div class=\"float70\">$ecom[3]</div>";
	
	if ( $ecom[7] > $ecom[3] )
		echo "<div class=\"float70\">$ecom[7]</div>";
	else
		echo "<div class=\"float70\">-</div>";
		
	echo "<div class=\"float50\">$ecom[4]</div>";
	
	if ( @$ecom[9] )
		echo "<div class=\"float50\">$ecom[8]</div>";
	else
		echo "<div class=\"float50\">-</div>";
		
	if ( @$ecom[9] )
		echo "<div class=\"float50\">$ecom[9]</div>";
	else	
		echo "<div class=\"float50\">-</div>";
	
	echo "<div class=\"float50\">";
	if ( $ecom[10] == 1 )
		echo "O";
	else
		echo "X";
	echo "</div>";
	
	echo "<div class=\"float50\">";
	if ( $ecom[11] == 1 )
		echo "O";
	else
		echo "X";
	echo "</div>";
	
	echo "<div class=\"float50\">";
	if ( $ecom[12] == 1 )
		echo "O";
	else
		echo "X";
	echo "</div>";
	
	echo "<div class=\"float20\"><a title=\"|Elimina articolo\" href=\"area.php?pag=delete.php&id=$ecom[0]&from=elenco_ecommerce.php\"><img src=\"./img/del.png\" class=\"ico\" /></a></div>
		<div class=\"float20\"><a title=\"|Modifica articolo\" href=\"area.php?pag=insert_ecommerce.php&amp;id=$ecom[0]\"><img src=\"./img/mod.png\" class=\"ico\" /></a></div>
		<div class=\"float20\"><a title=\"|Duplica articolo\" href=\"area.php?pag=duplica.php&id=$ecom[0]&from=elenco_ecommerce.php&categoria=$id_categoria\"><img src=\"./img/dup.png\" class=\"ico\" /></a></div>
		 <div class=\"azzerafloat\"></div>
		  </li>";
}
echo "</ul>";

echo "</div>";

echo"<div class=\"azzerafloat\"></div>";
echo "<div class=\"float160\"><img src=\"./img/ind.png\" class=\"ico\" /><a title=\"|torna indietro\" href=\"area.php?pag=elenco_ecommerce_categorie.php\">Indietro</a></div>";
echo "</div>";






?>
