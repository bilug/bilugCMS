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
	$parametro = "a1";

	//query dove estraggo le voci principali del menu 'alto'
	$sql = "SELECT id, titolo, link, posizione, descrizione FROM menutipo WHERE tipo='$parametro' AND idpadre=0 ORDER BY posizione";
	$rssql = mysql_query($sql);
	$num = mysql_num_rows($rssql);
?>

<div class="blocco">
	<h3><span><?=$titolo?></span></h3>		
	<div class="modulo">
	<?php if( $num > 0 ) : ?>
		<ul class="accordion" id="accordion-1">
		<?php while( $r = mysql_fetch_row( $rssql ) ) : ?>
			<?php $title = ( $r[4] != '' ) ? $voci[4] : ''; ?>			
			<li>
				<h4><a title="<?=$title?>" href="<?=$r[2]?>"><?=$r[1]?></a></h4>
				<?php according( $r[0], $parametro ); ?>
			</li>
		<?php endwhile; ?>	
		</ul>		
	<?php endif; ?>	
	</div>
</div>

