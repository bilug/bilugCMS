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
<!-- tabella menù  --> 
<div class="blocco blocco-select-multilingua">
	<h3><span><?=$titolo?></span></h3>
	<div class="modulo">
		<form action="<?=_URLSITO?>/html/cambia_lingua.php" method="get">
			<p>
				<select name="lingua" onchange="this.form.submit();">
				<?php
					$sql = "SELECT sigla, lingua FROM lingue WHERE attiva = 1";
					$rssql = mysql_query( $sql );
					while( $r = mysql_fetch_array( $rssql ) ){
						$sel = '';
						if ( $r[0] == $lingua_query )
							$sel = "selected=\"selected\"";
						?>
						<option value="<?=$r[0]?>" <?=$sel?>><?=$r[1]?></option>
					<?php
					}
				?>
				</select>
			</p>
		</form>
	</div>
</div>


