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
		$("#tabs2").tabs();
		$("#tabs3").tabs();
	});
	</script>
<?php

echo "<h3> Ecommerce </h3>
	<div id=\"tabs\">
	<ul>
        <li><a href=\"#fragment-1\"><span>Categorie / Articoli</span></a></li>
        <li><a href=\"#fragment-2\"><span>Cerca articolo</span></a></li>
        <li><a href=\"#fragment-3\"><span>Testo vetrina</span></a></li>
        <li><a href=\"#fragment-4\"><span>Gestione Ecommerce</span></a></li>
        <li><a href=\"#fragment-5\"><span>Gestione utenti</span></a></li>
        <li><a href=\"#fragment-6\"><span>Info</span></a></li>
	</ul>             
";	  
	  
	                
echo "<div id=\"fragment-1\">";

	echo"<div id=\"tabs2\" class=\"contenitore\">";
		echo "<ul>";
			echo "<li><a href=\"#fragment-1-1\"><span>Elenco categorie / articoli</span></a></li>";
			echo "<li><a href=\"#fragment-1-2\"><span>Nuova categoria</span></a></li>";
			echo "<li><a href=\"#fragment-1-4\"><span>Nuovo articolo</span></a></li>";
			echo "<li><a href=\"#fragment-1-5\"><span>Art. riservati</span></a></li>";
			echo "<li><a href=\"#fragment-1-6\"><span>Art. in evidenza</span></a></li>";
			echo "<li><a href=\"#fragment-1-7\"><span>Art. in offerta</span></a></li>";
			echo "<li><a href=\"#fragment-1-8\"><span>Importa articoli CSV</span></a></li>";
		echo "</ul>";
	echo "</div>";

	echo "<div id=\"fragment-1-1\">";
		include("./elenco_ecommerce_categorie_fragment.php");
	echo "</div>";
	
	echo "<div id=\"fragment-1-2\">";
		include("./insert_ecommerce_categorie.php");
	echo "</div>";
	
	echo "<div id=\"fragment-1-4\">";
		include("./insert_ecommerce.php");
	echo "</div>";
	
	echo "<div id=\"fragment-1-5\">";
		include("./elenco_ecommerce_articoli_riservati.php");
	echo "</div>";
	
	echo "<div id=\"fragment-1-6\">";
		include("./elenco_ecommerce_articoli_evidenzia.php");
	echo "</div>";
	
	echo "<div id=\"fragment-1-7\">";
		include("./elenco_ecommerce_articoli_offerta.php");
	echo "</div>";	
	
	echo "<div id=\"fragment-1-8\">";
		include("./importa_articoli_csv.php");
	echo "</div>";

echo "</div>";


echo "<div id=\"fragment-2\">";
	include("./ecommerce_cerca_articolo.php");
echo "</div>";



echo "<div id=\"fragment-3\">";
	include("./insert_ecommerce_testo_vetrina.php");
echo "</div>";






echo "<div id=\"fragment-4\">";
	echo"<div class=\"contenitore\"><div class=\"azzerafloat\"></div><br />";
	echo "<div class=\"float400\"><img src=\"./img/carrello1.png\" class=\"ico\" /><a title=\"|Pulisci Carrello\" href=\"area.php?pag=allinea_carrello.php\"> Pulizia DB Carrello dalle transazioni non concluse</a></div>";
	echo "<div class=\"azzerafloat\"></div><br />";
	echo "<div class=\"float400\"><img src=\"./img/run.png\" class=\"ico\" /><a title=\"|Gestisci Spedizioni\" href=\"area.php?pag=elenco_spedizioni.php\"> Gestione Spedizioni</a></div>";
	echo "<div class=\"azzerafloat\"></div><br />";
	echo "<div class=\"float400\"><img src=\"./img/euro.png\" class=\"ico\" /><a title=\"|Gestisci Ordini\" href=\"area.php?pag=gestione_ordini.php\"> Gestione Ordini di Acquisto</a></div>";
	echo "<div class=\"azzerafloat\"></div><br />";
	echo "<div class=\"float400\"><img src=\"./img/euro.png\" class=\"ico\" /><a title=\"|Gestisci Transazioni\" href=\"area.php?pag=gestione_transazioni.php\"> Gestione Transazioni</a></div>";
	echo "<div class=\"azzerafloat\"></div><br />";
	echo "<div class=\"float400\"><img src=\"./img/euro.png\" class=\"ico\" /><a title=\"|Gestisci Acquisti\" href=\"area.php?pag=gestione_acquisti.php\"> Gestione Acquisti Completati</a></div>";
	echo "<div class=\"azzerafloat\"></div><br />";
	echo "<div class=\"float400\"><img src=\"./img/euro.png\" class=\"ico\" /><a title=\"|Gestisci Articoli Resi\" href=\"area.php?pag=gestione_resi.php\"> Gestione Articoli Resi</a></div>";
	echo "<div class=\"azzerafloat\"></div><br />";
	echo "<br /></div>";
echo "</div>";


echo "<div id=\"fragment-5\">";

	echo"<div id=\"tabs3\" class=\"contenitore\">";
		echo "<ul>";
			echo "<li><a href=\"#fragment-5-1\"><span>Elenco utenti</span></a></li>";
			echo "<li><a href=\"#fragment-5-2\"><span>Nuovo utente</span></a></li>";
		echo "</ul>";
	echo "</div>";

	echo "<div id=\"fragment-5-1\">";
		include("./elenco_utenti_ecommerce.php");
	echo "</div>";
	
	echo "<div id=\"fragment-5-2\">";
		include("./insert_utenti_ecommerce.php");
	echo "</div>";

echo "</div>";



echo "<div id=\"fragment-6\">";
	echo"<div class=\"contenitore\"><div class=\"azzerafloat\">La mail che viene generata e spedita sia al venditore che al compratore, dopo aver completato tutti i campi del carrello ecommerce, viene gestita dal file in <b>html/ecommerce_dettaglio_carrello.php</b><br /><br />L'indirizzo della mail del venditore, a cui vengono mandati tutti i dettagli dell'ordine di acquisto, viene presa dall'elenco delle mail del modulo <b>SCRIVICI</b>, ed esattamente viene selezionata quella mail che e' stata inserita col nome <b>Ecommerce</b></div></div>";
echo "</div>";
?>
