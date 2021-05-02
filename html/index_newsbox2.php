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
$str="
	SELECT ne.id, n.testo, n.immagine, ne.titolo 
	FROM newsbox AS n 
	INNER JOIN lingue AS l ON l.id = n.id_lingua 
	INNER JOIN notizie AS ne ON ne.ID = n.notizia 
	WHERE n.modulo = 2 AND l.sigla = '$lingua_query' 
	LIMIT 1
";
$risultato = mysql_query($str);
if ( mysql_num_rows($risultato) > 0 ) {
	$id_news = mysql_result( $risultato, 0, 0 );
	$testo = mysql_result( $risultato, 0, 1 );
	$img = mysql_result( $risultato, 0, 2 );
	$img = substr( $img, 0, strlen( $img )-1 );
	$news = mysql_result( $risultato, 0, 3 );

	$link = rurl( $id_news, 'news' );
    ?>
	<div class="blocco blocco-newsbox">
		<h3><span><?=$titolo?></span></h3>
		
		<div class="modulo">	
			<div class="immagine">
				<a href="<?=$link?>"><img src="<?=$img?>" alt="<?=$news?>" title="<?=$news?>" height="" width="" /></a>
			</div>	
			<div class="testo">
				<p><?=$testo?></p>
				<h4><a class="link_inline" href="<?=$link?>">Leggi tutto...</a></h4>
			</div>
		</div>
	</div>			
<?php
}
?>

