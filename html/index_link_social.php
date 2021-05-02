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

<div class="blocco blocco-link-social">
	<h3><?=$titolo?></h3>
	<div class="modulo">
	<?php
		$sql = "SELECT * FROM social ORDER BY id ASC";
		$rssql = mysql_query($sql);
		if ( mysql_num_rows($rssql) > 0 ) : ?>
			<ul>
			<?php while( $r = mysql_fetch_assoc($rssql) ) : ?>
				<li><a href="<?=$r['link']?>" target="_blank"><img src="<?=_URLSITO?>/img/social/<?=$r['img']?>" height="0" width="0" alt="<?=$r['nome']?>"></a></li>
			<?php endwhile; ?>
			</ul>
		<?php else : ?>
			<p>Nessun social attivo</p>
		<?php endif ; ?>
	</div>
</div>