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

<div class="blocco blocco-statiche">
	<h3><span><?=$titolo?></span></h3>
	<div class="modulo">
		<ul>
			<?php if ( _MODULO_STATICHE_HOME != '' ) : ?>
				<li><h4><a href="<?=_URLSITO?>/index.php"><?=_MODULO_STATICHE_HOME?></a></h4></li>
			<?php endif; ?>
			
			<?php
			$str="
				SELECT s.ID, s.titolo 
				FROM statiche AS s 
				INNER JOIN lingue AS l ON l.id = s.id_lingua 
				WHERE l.sigla = '$lingua_query' 
				ORDER BY s.ordine
			";
			
			$risultato=mysql_query($str);
			if ( mysql_num_rows( $risultato ) > 0 ) {
				while( $control = mysql_fetch_row( $risultato ) ) :
					$link = rurl( $control[0], 'static' );
					?><li><h4><a href="<?=$link?>"><?=$control[1]?></a></h4></li><?php
				endwhile;
			}
			?>
			
			<?php if ( _MODULO_STATICHE_SCRIVICI != '' ) : ?>
				<li><h4><a href="<?=_URLSITO?>/contatti/"><?=_MODULO_STATICHE_SCRIVICI?></a></h4></li>
			<?php endif; ?>			
		</ul>
	</div>
</div>


