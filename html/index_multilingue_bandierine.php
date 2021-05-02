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
<!-- tabella menu  --> 
<div class="blocco blocco-bandierine-multilingua">
	<h3><span><?=$titolo?></span></h3>
	<div class="modulo">
		<ul>
		<?php
			$sql = "SELECT sigla, lingua, img FROM lingue WHERE attiva = 1";
			$rssql = mysql_query( $sql );
			while( $r = mysql_fetch_array( $rssql ) ) : ?>
				<li><a href="<?=_URLSITO?>/html/cambia_lingua.php?lingua=<?=$r[0]?>"><img src="<?=_URLSITO?><?=$r[2]?>" title="<?=$r[1]?>" alt="<?=$r[1]?>" width="" height="" /></a></li>
			<?php endwhile; 
		?>
		</ul>
	</div>
	
</div>


