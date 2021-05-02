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
echo "<h3> Gallerie </h3>
	<div id=\"tabs\">
	<ul>
        <li><a href=\"#fragment-1\"><span>Elenco</span></a></li>
        <li><a href=\"#fragment-2\"><span>Nuovo</span></a></li>
	</ul>             
";	  
              
echo "<div id=\"fragment-1\">";
	$argo = (int)$_GET['argo'];
	$dir = '../gals/' . $argo;
	
	$sql = "SELECT id, cartella, id_padre FROM galleria WHERE id_padre = $argo";
	$rssql = mysql_query( $sql );		
	
	if ( mysql_num_rows( $rssql ) > 0 ) {
		echo "<div class=\"contenitore\"><div class=\"azzerafloat\"></div>";

		echo "<div class=\"evidenzia \">
		  <div class=\"float160\">Nome sotto-galleria</div>
		  <div class=\"float180\">Link associato</div>
		  <div class=\"azzerafloat\"></div></div>";
		  
		while ( $r = mysql_fetch_row( $rssql ) ){
			 $link = rurl( $r[0], 'gals-sub' );
			 echo "<div class=\"evidenzia\">
			   <div class=\"float160\">$r[1]</div> <!-- titolo -->
			   <div class=\"float180\">$link</div> <!-- link -->
			   <div class=\"float50\"><a title=\"Elimina la Galleria (eliminare prima le immagini presenti)\" href=\"del_gal.php?id=$r[0]&amp;argo=$argo\"><img src=\"./img/del.png\" class=\"ico\" /></a></div>
			   <!-- Assegnamo all'id il valore che otteniamo con la query -->
			   <div class=\"float50\"><a title=\"Modifica il nome della galleria e la sua descrizione\" href=\"area.php?pag=insert_gal.php&amp;argo=$argo&amp;id=$r[0]\"><img src=\"./img/mod.png\" class=\"ico\" /></a></div>
			   <div class=\"float50\"><a title=\"Carica Immagini nella Galleria\" href=\"area.php?pag=uploadg.php&amp;argo=$argo&amp;id=$r[0]\"><img src=\"./img/load.png\" class=\"ico\" /></a></div>
			   <div class=\"float50\"><a title=\"Gestisci le immagini della galleria (eliminazione)\" href=\"area.php?pag=listafile.php&amp;id=$r[0]\"><img src=\"./img/pre.png\" class=\"ico\" /></a></div>
			   <div class=\"float50\"><a title=\"Gestisci le descrizioni delle singole Immagini nella Galleria\" href=\"area.php?pag=elenco_fotogal.php&amp;id=$r[0]\"><img src=\"./img/cam.png\" class=\"ico\" /></a></div>
			   <div class=\"azzerafloat\"></div>
			 </div>";
		}
		
		echo "</div>";			
	}
	else echo "<p>Nessuna Galleria</p>";
	
	echo "<p><a href=\"area.php?pag=elenco_arg_gallerie.php\"><img src=\"./img/ind.png\" class=\"ico\" />Ritorna agli Argomenti</a></p>";

echo "</div>";
	
	
	
	echo "<div id=\"fragment-2\">";
		include ("insert_gal.php");
		//include ("insert_gal.php&amp;argo=$argo");
	echo "</div>";
	
	
	closedir($handle); 
	
?>
