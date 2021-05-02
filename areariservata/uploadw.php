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

<div class="contenitore">
<form name="upload" method="post" action="area.php?pag=upw.php" enctype="multipart/form-data">
<h2>I Watermark devono essere file png con trasparenza.</h2>
<h3>Invia un Watermark per le miniature:</h3>
<br/>
<input type="file" name="file" size="69"/><br/>
<a class="del" href="del_water.php?what=mini"><img border="0" src="./img/elimina.gif" \></a>Elimina Watermark miniature<br/>
<h3>Invia un Watermark per le immagini originali: </h3>
<br/>
<input type="file" name="file1" size="69"/><br/>
<a class="del" href="del_water.php?what=ori"><img border="0" src="./img/elimina.gif" \></a>Elimina Watermark originali<br/>
<br/>
<input type="submit"  class="medio" value="Carica il/i file" tabindex="12"/>
<input type="button"	class="medio" name="Annulla" value="Annulla" onclick="javascript:window.location='area.php'" />
</form>
</div>
