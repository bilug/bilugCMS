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

<div class="blocco blocco-ultime-news">
	<h3><span><?=$titolo?></span></h3>
	
	<div class="modulo">
			
	<?php

	$str = "
		SELECT n.id, n.titolo, n.testo, a.argomenti 
		FROM notizie n 
		INNER JOIN argomenti a ON a.id = n.argomento 
		WHERE n.autorizza = 'si' 
		ORDER BY n.id DESC 
		LIMIT 15
	";
	$risultato=mysql_query($str);
	if (mysql_num_rows($risultato)>0)
	{	
		echo"<ul>";
		while( $r = mysql_fetch_row( $risultato ) ) {
			$link = rurl( $r[0], 'news' );
			echo "<li>";
				echo "<h4>";
					echo "<a href=\"$link\">$r[1]</a>";
					echo "<small>Argomento: $r[3]</small>";
				echo "</h4>";
			echo "</li>";
		}
		echo "</ul>";
	}
	else
		echo "<ul><li>Nessuna Notizia</li></ul>";
	?>
	
	</div>
	
</div>


