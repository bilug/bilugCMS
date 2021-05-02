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

<div class="contenitore">
	<h3>Elenco di tutti i TAG</h3>

	<?php

	$sql = "
		SELECT t.id, t.nome_tag, t.link_tag, COUNT( ct.id_tag ) AS notizie_associate
		FROM tag t 
		LEFT OUTER JOIN collegamento_tag ct ON ct.id_tag = t.id  
		LEFT OUTER JOIN notizie n ON ct.id_notizia = n.id 
		GROUP BY t.id 
	";
	$rssql = mysql_query( $sql );

	if ( mysql_num_rows( $rssql ) > 0 ) {
		echo "<div class=\"contenitore\"><div class=\"azzerafloat\"></div>";

		echo "<div class=\"evidenzia\">
			   <div class=\"float20\">Id</div> <!-- id -->
			   <div class=\"float160\">Nome TAG</div> <!-- nome_tag -->
			   <div class=\"float160\">Link TAG</div> <!-- link_tag -->
			   <div class=\"float100\">Notizie associate</div> <!-- num_notizie -->
			   <div class=\"azzerafloat\"></div>
			</div>
		";

		while( $r = mysql_fetch_row( $rssql ) ){
			echo "<div class=\"evidenzia\">
				<div class=\"float20\">$r[0]</div> <!-- id -->
				<div class=\"float160\">$r[1]</div> <!-- nome_tag -->
				<div class=\"float160\">$r[2]</div> <!-- link_tag -->
				<div class=\"float100\">$r[3]</div> <!-- num_notizie -->
				<div class=\"float50\"><a title=\"Elimina il TAG\" href=\"area.php?pag=delete.php&id=$r[0]&from=gestione_tag.php\"><img src=\"./img/del.png\" class=\"ico\" /></a></div>
				<div class=\"float50\"><a title=\"Modifica il TAG\" href=\"area.php?pag=insert_tag.php&amp;id=$r[0]\"><img src=\"./img/mod.png\" class=\"ico\" /></a></div>
			";
		
			echo "<div class=\"azzerafloat\"></div></div>";  			
		}
		
		echo "</div>";
	}
	else
		echo "<p>Non sono ancora presenti dei tag</p>";
		
	?>
</div>