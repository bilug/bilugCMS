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
	<?php
		$str="
			SELECT a.ID, a.argomenti, a.menu_arg, COUNT(n.argomento) 
			FROM argomenti AS a 
			INNER JOIN notizie AS n ON a.id = n.argomento 
			INNER JOIN lingue AS l ON l.id = a.id_lingua 
			WHERE menu_arg = 4 AND n.autorizza = 'si' AND l.sigla = '$lingua_query' 
			GROUP BY n.argomento 
			ORDER BY a.argomenti
		";	
		$risultato=mysql_query($str);

		if ( mysql_num_rows($risultato)>0 ) : ?>
			<ul>
				<?php while( $control = mysql_fetch_row( $risultato ) ) : 
					$link = rurl( $control[0], 'argo' ); ?>
					<li>
						<h4>
							<a href="<?=$link?>"><?=$control[1]?></a>
							<small>Numero news: <?=$control[3]?></small>
						</h4>
					</li>
				<?php endwhile;?>	
			</ul>
		<?php endif; ?>
	</div>
</div>	 