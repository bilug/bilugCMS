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

<?php breadcrumbs( array(
	'Home' => _URLSITO,
	'Men&ugrave;' => ''
) ); ?>

<h1>Pagine del sito <?=_SITO?></h1>

<ul>
<?php
$str="
	SELECT s.id, s.titolo 
	FROM statiche AS s 
	INNER JOIN lingue AS l ON l.id = s.id_lingua 
	WHERE l.sigla = '$lingua_query' 
";
$risultato = mysql_query($str);
while ( $control = mysql_fetch_row($risultato) ) : 
	$link = rurl( $control[0], 'static' ); ?>
	<li><h3><a href="<?=$link?>"><?=$control[1]?></a></h3></li>
<?php endwhile; ?>
</ul>