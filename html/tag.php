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
	$tag = (int)$_GET['tag'];
	
	$sql = "
		SELECT n.ID ,n.titolo, n.sottotitolo, n.testo, n.autore, n.argomento, DATE_FORMAT(n.data,'%d/%m/%Y'), n.link, an.nome, an.cognome, a.argomenti
		FROM notizie n 
		INNER JOIN collegamento_tag ct ON ct.id_notizia = n.id
		INNER JOIN argomenti a ON a.ID = n.argomento 
		INNER JOIN anagrafica an ON an.ID = n.autore		
		WHERE n.autorizza = 'si' AND ct.id_tag = $tag 
		ORDER BY n.data DESC
	";
	$rssql = mysql_query( $sql );
	
	if ( mysql_num_rows( $rssql ) > 0 ) {
		$titolo = "SELECT nome_tag FROM tag WHERE id = $tag LIMIT 1";
		$titolo = mysql_query( $titolo );
		$titolo = mysql_result( $titolo, 0, 0 );
		
		echo "<h1>Articoli corrispondenti al TAG '$titolo'</h1>";
		
		while( $r = mysql_fetch_row( $rssql ) ){
			$link = rurl( $r[0], 'news' );
			echo "<div class=\"blocco_ultime_notizie\">";
			echo "<h2><span class=\"titolo\"><a href=\"$link\">$r[1]</a></span></h2>";
			if ( $r[2] != '' ) echo "<h3><span class=\"sottotitolo\">$r[2]</span></h3>";
			if ( _DATA OR _AUTORE ) {
				echo "<h4><span class=\"autore\">";
					if (_DATA) echo "NEWS INSERITA IL $r[6]";
					if (_AUTORE) echo " da $r[8] $r[9]";
				echo "</span></h4>";
			}
			if ( $r[10] != '' ) echo "<h4><span class=\"argomento\">Argomento: $r[10]</span></h4>";
			
			echo "<p>".substr( strip_tags( $r[3] ), 0, 200 )."...</p>";
			
			echo "<h5><span class=\"leggi_tutto\"><a href=\"$link\">leggi intero articolo..</a></span></h5>";
			echo "</div>";		
		}
	}
?>











