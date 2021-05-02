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

$errore=null;
$errore=$_GET["errore"];
$tipoerr=$_GET["tipoerr"];

if($errore=="si") echo "<h1><img src=\"./img/alert.png\" class=\"ico\" />$tipoerr<img src=\"./img/alert.png\" class=\"ico\" /></h1>";

$id = (int)$_GET['id'];

$sql = "SELECT titolo FROM notizie WHERE id = $id LIMIT 1";
$rssql = mysql_query( $sql );
$titolo = mysql_result( $rssql, 0, 0 );

?>

<h3>Assegna TAG per questo articolo</h3>

<?php
	$sql = "SELECT id, nome_tag, link_tag FROM tag";
	$rssql = mysql_query( $sql );
	
	if ( mysql_num_rows( $rssql ) > 0 ) {
		echo "<div class=\"contenitore\"><div class=\"azzerafloat\"></div>";
		
		echo "<h4>Titolo: \"$titolo\"</h4>";
		
		echo "<div class=\"evidenzia\">
			   <div class=\"float20\">Id</div> <!-- id -->
			   <div class=\"float160\">Nome TAG</div> <!-- nome_tag -->
			   <div class=\"float160\">Link TAG</div> <!-- link_tag -->
			   <div class=\"azzerafloat\"></div>
			</div>
		";
		
		echo "<form action=\"insert_tag_notizie_query.php\" method=\"post\">";
			echo "<input type=\"hidden\" name=\"id\" value=\"$id\" />";
			while( $r = mysql_fetch_row( $rssql ) ){
				$ctrl = "SELECT id FROM collegamento_tag WHERE id_notizia = $id AND id_tag = $r[0]";
				$rsctrl = mysql_query( $ctrl );
				$check = ( mysql_num_rows( $rsctrl ) > 0 ) ? "checked" : "";
				echo "<div class=\"evidenzia\">
					   <div class=\"float20\">$r[0]</div> <!-- id -->
					   <div class=\"float160\">$r[1]</div> <!-- nome_tag -->
					   <div class=\"float160\">$r[2]</div> <!-- link_tag -->
					   <div class=\"float160\"><input type=\"checkbox\" name=\"tag[]\" value=\"$r[0]\" $check /></div> <!-- checkbox -->
					   <div class=\"azzerafloat\"></div>
					</div>
				";
			}
			echo "<p><input type=\"submit\" value=\"Assegna TAG\" /></p>";
		echo "</form>";
		echo "</div>";
	}
	else
		echo "<p>Non sono ancora presenti dei tag</p>";
?>