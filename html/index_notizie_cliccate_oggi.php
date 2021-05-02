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

/* Attivo il modulo solo quando ho almeno 5 notizie che sono state cliccate */

$arg = "";
if ( isset( $_GET['news'] ) ) {
	$news = (int)$_GET['news'];
	$sql = "SELECT argomento FROM notizie WHERE id = $news LIMIT 1";
	$rssql = mysql_query( $sql );
	$argomento = mysql_result( $rssql, 0, 0 );
	$arg = "AND argomento = $argomento";
}

$str="SELECT ID, titolo, cliccato_oggi FROM notizie WHERE autorizza = 'si' AND cliccato_oggi > 0 $arg ORDER BY cliccato_oggi DESC LIMIT 5";
$risultato=mysql_query($str);

if ( mysql_num_rows($risultato) >= 5 ) {?>
	<div class="blocco blocco-notizie-cliccate">
		<h3><span><?=$titolo?></span></h3>

		<div class="modulo">			
		<?php
			echo"<ul>";
			while( $r = mysql_fetch_row( $risultato ) ) {
				$link = rurl( $r[0], 'news' );
				echo "<li>";
					echo "<h4>";
						echo "<a href=\"$link\">$r[1]</a>";
						echo "<small>Numero visite: $r[2]</small>";
					echo "</h4>";
				echo "</li>";
			}
			echo "</ul>";
		?>
		</div>

	</div>
<?php 
} 
?>

