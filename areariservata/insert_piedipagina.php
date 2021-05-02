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

	$parola=Modifica;
    
	$annulla = "<input type=\"button\" 
	class=\"medio\" name=\"Annulla\" value=\"Annulla\" onclick=\"javascript:window.location='area.php'\" />";

	$filename= "../custom/index_piedipagina.php";
	$handle = @fopen($filename,"r");
	$piedipagina = @fread($handle,filesize($filename));
	@fclose($handle);

?>
<div class="contenitore">
<form name="notizie" method="post" action="insert_piedipagina_query.php">
<!-- il valore di id lo passiamo alla pagina di action con un campo nascosto -->
	<h3><?=$parola?> Pi&egrave; di pagina:</h3>
	<div class="azzerafloat"></div>
	<div class="float140"> Pi&egrave; di pagina:</div>
	<div class="float615">
		<textarea name="testo" rows="20" cols="90"><?=$piedipagina?></textarea>
		<script type="text/javascript">
			CKEDITOR.replace( 'testo');
		</script>
	</div>
	<div class="azzerafloat"></div>
	<br />

	<input type="submit" class="medio" value="<?=$parola?>" tabindex="7"/>  
	<?=$annulla?>             
</form>
</div>

