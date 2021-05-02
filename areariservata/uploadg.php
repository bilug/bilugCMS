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
<?

$id = $_GET['id'];
$argo = $_GET['argo'];

?>
<div class="contenitore">
<form name="upload" method="post" action="area.php?pag=upg.php" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?=$id?>"/>
<input type="hidden" name="argo" value="<?=$argo?>"/>

<!-- il valore di id lo passiamo alla pagina di action con un campo nascosto -->
<br/>
<div class="float50">
	<h2>File: </h2>
</div>
<div class="float400">
	<input type="file" name="file[]" class="multi {accept:'gif|jpg|png', STRING:{
  remove:'Rimuovi',
  selected:'Selezionato: <?=$file?>',
  denied:'Estensione <?=$ext?> non valida!',
  duplicate:'L\'immagine <?=$file?> &egrave; gi&agrave; stata selezionata'
 }}" size="80"/>
</div>
<div class="azzerafloat"></div>
<div class="float200">
	<h2>Inserire Watermark: </h2>
	<h2>Dim. Originali (sfondi): </h2>
</div>
<div class="float50">
	<input type="checkbox" name="water" /><br/>
	<input type="checkbox" name="nored" />
</div>
<div class="azzerafloat"></div>

<br/>
<input type="submit"  class="medio" value="Carica il file" tabindex="12"/>
<input type="button" class="medio" name="Annulla" value="Annulla" onclick="javascript:window.location='area.php?pag=elenco_gallerie.php&amp;argo=<?=$argo?>'" />
</form>
</div>
