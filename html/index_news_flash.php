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
<div class="blocco blocco-news-flash">
	<h3><span><?=$titolo?></span></h3>	
	
	<div class="modulo">
		<?php
			$str = "SELECT ID, titolo, testo FROM notizie WHERE autorizza = 'si' ORDER BY data DESC LIMIT 5";
			$risultato=mysql_query($str);
			if ( mysql_num_rows($risultato) > 0 ) : ?>
				<ul id="newslat">
				<?php while( $control = mysql_fetch_row($risultato) ) : ?>
					<li>
						<h4><?=$control[1]?></h4>
						<p><?=str_pad(substr (wordwrap(strip_tags($control[2]),21,"\n",1),0,200),200)?></p>
						<a href="<?=rurl($control[0], 'news')?>">Leggi tutto</a>
					</li>
				<?php endwhile ; ?>
				</ul>
			<?php else : ?>
				<ul><li>Nessuna News</li></ul>
			<?php endif ; 
		?>
		
		<script>
			$(document).ready(function(){
			$("#newslat").css("display","block");
			$("#newslat").newsTicker();		
		});	
		</script>
	</div>

</div>
