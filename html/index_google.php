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

<div class="blocco blocco-cerca-google">
	<h3><span><?=$titolo?></span></h3>
	<div class="modulo">
		<form method="post" action="<?=_URLSITO?>/index.php?pag=google.php">
			<p><input type="text" name="testo" class="textlato" placeholder="<?=$titolo?>" /></p>    
			<p><input type="submit" value="Cerca" class="bottomlato"></p>
		</form>	
	</div>
</div>
