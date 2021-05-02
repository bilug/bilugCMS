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

<?
echo "<h3> Argomenti Gallerie </h3>
	<div id=\"tabs\">
	<ul>
        <li><a href=\"#fragment-1\"><span>Elenco</span></a></li>
        <li><a href=\"#fragment-2\"><span>Nuovo</span></a></li>
        <li><a href=\"#fragment-3\"><span>Importa gallerie</span></a></li>
	</ul>             
	                
	<div id=\"fragment-1\">";

$dir = "../gals";	

$sql = "SELECT id, cartella FROM galleria WHERE id_padre = 0";
$rssql = mysql_query( $sql );

echo "<div class=\"contenitore\">";

if ( mysql_num_rows( $rssql ) > 0 ) {
	echo "<div class=\"evidenzia \">";
		echo "<div class=\"float160\">Nome galleria</div>";
		echo "<div class=\"float180\">Link associato</div>";
		echo "<div class=\"azzerafloat\"></div>";
	echo "</div>";

	while ( $r = mysql_fetch_row( $rssql ) ){
		  $file = $r[1];
		  $link = rurl( $r[0], 'gals' );  
		  
		  echo "<div class=\"evidenzia\">
		  <div class=\"float160\">$file</div> <!-- titolo -->
		  <div class=\"float180\">$link</div> <!-- Link associato -->
		  <div class=\"float50\"><a title=\"Elimina l'Argomento (eliminare prima le gallerie e le immagini)\" href=\"del_arggal.php?id=$r[0]\"><img src=\"./img/del.png\" class=\"ico\" /></a></div>
		  <!-- Assegnamo all'id il valore che otteniamo con la query -->
		  <div class=\"float50\"><a title=\"Modifica il nome dell'argomento e la descrizione\" href=\"area.php?pag=insert_arggal.php&amp;id=$r[0]\"><img src=\"./img/mod.png\" class=\"ico\" /></a></div>
		  <div class=\"float50\"><a title=\"Visualizza le gallerie disponibili nell'Argomento\" href=\"area.php?pag=elenco_gallerie.php&amp;argo=$r[0]\"><img src=\"./img/cam.png\" class=\"ico\" /></a></div>
		  <div class=\"azzerafloat\"></div></div>";
	}
}
else echo "<p>Nessuna Argomento Galleria</p>";		

echo "</div>";

echo "</div>";


echo "<div id=\"fragment-2\">";
	include("./insert_arggal.php");
echo "</div>";

echo "<div id=\"fragment-3\">";
	include("./importa_gallerie.php");
echo "</div>";

closedir($handle); 
?>
