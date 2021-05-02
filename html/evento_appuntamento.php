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

$id = (int)$_GET['id_evento'];

$sql = "
	SELECT e.titolo, e.luogo, e.descrizione, e.tipo, DATE_FORMAT(e.dataora, '%d/%m/%Y alle %h:%i'), CONCAT(a.nome, ' ' ,a.cognome), e.link, n.titolo 
	FROM eventi e 
	INNER JOIN anagrafica a ON a.id = e.idutente 
	INNER JOIN lingue AS l ON l.id = e.id_lingua 
	LEFT OUTER JOIN notizie n ON n.id = e.link 
	WHERE l.sigla = '$lingua_query' AND e.id = $id 
	LIMIT 1
";
$rssql = mysql_query($sql);
$r = mysql_fetch_row($rssql);

$tipo = ( $r[3] == 'E' ) ? 'Evento' : 'Appuntamento';

?>

<h1><span><?=$r[0]?></span></h1>

<h2>Inserito da <?=$r[5]?></h2>

<div class="contenitore contenitore-evento">
	<ul>
		<li><strong>Tipo</strong>: <?=$tipo?></li>
		<li><strong>Data</strong>: <?=$r[4]?></li>
		<li><strong>Luogo</strong>: <?=$r[1]?></li>
		<?php if ( $r[6] > 0 ) : 
			$link = rurl( $r[6], 'news' ); ?>
			<li><strong>Link di approfondimento</strong>: <a href="<?=$link?>"><?=$r[7]?></a></li>
		<?php endif; ?>
	</ul>
	
	<h3>Descrizione <?=$tipo?></h3>
	
	<p><?=$r[2]?></p>
	
	<h5></h5>
</div>