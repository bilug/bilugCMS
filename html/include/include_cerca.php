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

<form name="form_cerca" method="get" action="<?=_URLSITO?>/index.php">
	<input type="hidden" name="pag" value="cerca.php">
	<p><input class="textlato" type="text" name="c" value="<?=@apici($_GET["c"])?>" placeholder="<?=$testo_cerca?>"></p>
	<p><input class="bottomlato" type="submit" value="Cerca"></p>
	<div class="azzerafloat"></div>
</form>
