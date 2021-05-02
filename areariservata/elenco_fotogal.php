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

$id = $_GET['id'];

$sql = "SELECT cartella, id_padre FROM galleria WHERE id = $id LIMIT 1";
$rssql = mysql_query( $sql );
$sottodir = mysql_result( $rssql, 0, 0 );
$id_padre = mysql_result( $rssql, 0, 1 );

$sql = "SELECT cartella FROM galleria WHERE id = $id_padre LIMIT 1";
$rssql = mysql_query( $sql );
$dirpadre = mysql_result( $rssql, 0, 0 );

$dir ="../gals/".$dirpadre."/".$sottodir."/";

 echo "<div class=\"contenitore\">";
 echo "<h5>FILES CARICATI NELLA GALLERIA IMMAGINI: $sottodir</h5><br/>";
 echo "<form name=\"foto\" method=\"POST\" action=\"insert_desc_query.php\" enctype=\"multipart/form-data\">";
 echo "<input type=\"hidden\" name=\"id\" value=\"$id\"/>";


	$sql = "SELECT id, immagine, descrizione FROM galleria WHERE id_padre = $id";
	$rssql = mysql_query( $sql );
	
	if ( mysql_num_rows( $rssql ) > 0 ) {
		while( $r = mysql_fetch_row( $rssql ) ){
			echo "<div class=\"float200\">";
				echo "<img valign=\"middle\" src=\"../utility/thump.php?w=140&amp;h=140&amp;file=".$dir.$r[1]."\"/>";
			echo "</div>";
			echo "<div class=\"float200\">";
				echo "Nome Immagine: $r[1]";
			echo "</div>";
			echo "<div class=\"float400\">";
				echo "<textarea rows=\"7\" cols=\"35\" name=\"titolo[$r[0]]\" class=\"fotodesc\">$r[2]</textarea>";
            echo "</div>";
			echo "<div class=\"azzerafloat\"></div>";
			echo "<p>&nbsp;</p>";
		}
	}
	else
		echo "<h3>Nessuna immagine presente in questa cartella</h3>";
		
 
 echo "<br />";
 echo "<input class=\"medio\" type=\"submit\" value=\"Salva Cambiamenti\"/>";
 echo" <input type=\"button\" class=\"medio\" name=\"Annulla\" value=\"Annulla\" 
 onclick=\"javascript:history.go(-1)\" />";
 echo "</form> </div>";  
?>  
