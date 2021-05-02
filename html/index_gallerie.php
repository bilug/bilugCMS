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
<div class="blocco">
	<h3><span><?=$titolo?></span></h3>
	
	<div class="modulo">
		<ul>	
		<?php

		$sql = "SELECT id, cartella FROM galleria WHERE id_padre = 0";
		$rssql = mysql_query( $sql );
		
		if ( mysql_num_rows( $rssql ) > 0 ) :
			while ( $r = mysql_fetch_row( $rssql ) ) :
				$link = rurl( $r[0], 'gals' ); ?>
				<li><h4><a href="<?=$link?>"><?=galleria_visualizza($r[1])?></a></h4></li>
			<?php endwhile; 
		else : ?> 
			<li>Nessuna Galleria Disponibile</li>
		<?php endif; ?>
		</ul>
	</div>
	
</div>


