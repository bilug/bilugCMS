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
	
<h3> NewsBox </h3>
	<div id="tabs">
	<ul>
        <li><a href="#fragment-1"><span>Elenco NewsBox</span></a></li>
	</ul>             
	                
	<div id="fragment-1">
	
  <?php
  
      $str="
		SELECT n.id, n.notizia, n.immagine, n.modulo, l.lingua 
		FROM newsbox AS n 
		INNER JOIN lingue AS l ON l.id = n.id_lingua 
		ORDER BY n.modulo ASC
		";
      $risultato = mysql_query( $str );
      
      
      // facciamo una query per caricare gli argomenti
      
      
      if (mysql_num_rows($risultato)>0)
      {
        	echo "<div class=\"contenitore\"><div class=\"azzerafloat\"></div>";					              
        	echo "<div class=\"float100\">N.</div>
           		<div class=\"float200\">Titolo</div>              
           		<div class=\"float200\">Lingua</div>";              
        	echo "<div class=\"azzerafloat\"></div>";             // ciclo per cui finchè abbiamo risultati ci costruisce una riga alla volta
          while( $control = mysql_fetch_row($risultato) ){
              $sql = "SELECT titolo FROM notizie WHERE id = $control[1] LIMIT 1";
              $rssql = mysql_query( $sql );
              $titolo = mysql_result( $rssql, 0, 0 );
              
          		echo "
				<div class=\"evidenzia\">
					<div class=\"float100\">N. $control[3]</div>
					<div class=\"float200\">&nbsp;$titolo</div>
					<div class=\"float200\">&nbsp;$control[4]</div>

			        <div class=\"float70\"><img src=\"./img/mod.png\" class=\"ico\" /><a title=\"|Modifica newsbox\" href=\"area.php?pag=insert_newsbox.php&amp;id=$control[0]\">Modifica</a></div>
					<div class=\"azzerafloat\"></div>
				</div>";              
          }
          echo "</div>";
      }
      else 
      	echo "<p>Tabella vuota</p>";
  
  ?>


	</div>


		
