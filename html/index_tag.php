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


<div class="blocco blocco-tag">
	<h3><span><?=$titolo?></span></h3>
	<div class="modulo">
		<?php
			$sql = "
				SELECT t.id, t.nome_tag, COUNT(t.id) AS notizie_associate
				FROM tag t 
				INNER JOIN collegamento_tag ct ON ct.id_tag = t.id 
				GROUP BY t.id 
			";			
			$rssql = mysql_query( $sql );
			if ( mysql_num_rows( $rssql ) > 0 ) :
				$sql2 = "
					(
						SELECT tab1.massimo
						FROM (
							SELECT COUNT( t.id ) AS massimo
							FROM tag t
							INNER JOIN collegamento_tag ct ON ct.id_tag = t.id
							GROUP BY t.id
							ORDER BY massimo DESC 
							LIMIT 1
						) AS tab1
					)
					UNION
					(
						SELECT tab1.minimo
						FROM (
							SELECT COUNT( t.id ) AS minimo
							FROM tag t
							INNER JOIN collegamento_tag ct ON ct.id_tag = t.id
							GROUP BY t.id
							ORDER BY minimo ASC 
							LIMIT 1
						) AS tab1
					)
					LIMIT 2
				";
				$rssql2 = mysql_query( $sql2 );
				$r = mysql_fetch_row( $rssql2 );
				$max = $r[0];
				$r = mysql_fetch_row( $rssql2 );
				$min = $r[0];
				
				$conteggio = $max - $min + 1;
				if ( $conteggio > 5 ) {
					$distacco = (int)( $conteggio / 5 );
					$resto = $conteggio % 5;
					
					$size1 = $min + $distacco;
					//if ( $resto > 0 ) { $size1 += 1; $resto--; }
					$size2 = $size1 + $distacco;
					//if ( $resto > 0 ) { $size2 += 1; $resto--; }
					$size3 = $size2 + $distacco;
					//if ( $resto > 0 ) { $size3 += 1; $resto--; }
					
					$size5 = $max - $distacco;
					//if ( $resto > 0 ) { $size5 -= 1; $resto--; }
					$size4 = $size5 - $distacco;
					//if ( $resto > 0 ) { $size4 -= 1; $resto--; }
					
					//echo "$size1 $size2 $size3 $size4 $size5 ";
				}
				else {
					$size1 = $min;
					$size2 = $min + 1;
					$size3 = $min + 2;
					$size4 = $min + 3;
					$size5 = $max;
				} ?>
				<ul>
				<?php while( $r = mysql_fetch_row( $rssql ) ) : 
					if ( $conteggio > 5 ) {
						switch( true ) {
							case ( $r[2] >= $min AND $r[2] <= $size1 ): $size = 'size1'; break;
							case ( $r[2] > $size1 AND $r[2] <= $size2 ): $size = 'size2'; break;
							case ( $r[2] > $size2 AND $r[2] <= $size3 ): $size = 'size3'; break;
							case ( $r[2] < $size5 AND $r[2] >= $size4 ): $size = 'size4'; break;
							case ( $r[2] <= $max AND $r[2] >= $size5 ): $size = 'size5'; break;
							default: $size = 'size1'; break;
						}
					}
					else {
						switch( $r[2] ) {
							case $size1: $size = 'size1'; break;
							case $size2: $size = 'size2'; break;
							case $size3: $size = 'size3'; break;
							case $size4: $size = 'size4'; break;
							case $size5: $size = 'size5'; break;
						}
					}

					$link = rurl( $r[0], 'tag' ); ?>
					<li><a title="<?=$r[2]?> post con TAG <?=$r[1]?>" class="<?=$size?>" href="<?=$link?>"><?=$r[1]?></a> </li>
				<?php endwhile; ?>
				</ul>
			<?php else : ?>
				<p>Nessun TAG presente</p>
			<?php endif; ?>
	</div>
</div>
