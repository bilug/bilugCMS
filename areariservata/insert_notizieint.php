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

$errore=null;
$errore=$_GET["errore"];
$tipoerr=$_GET["tipoerr"];
if($errore=="si")
{
		echo "<h1>$tipoerr</h1>";
}

if (!$id)
{
	$parola=Inserisci;
   // se il valore di id è vuoto, allora siamo in fase di inserimento 
    $control[0] = $_GET["titolo"];
    $control[1] = $_GET["sottotitolo"];
    $control[2] = $_GET["testo"];
    $control[3] = $_GET["link"];
	$annulla = "<input type=\"button\" 
	class=\"medio\" name=\"Annulla\" value=\"Annulla\" onclick=\"javascript:window.location='area.php?pag=elenco_notizieint.php'\" />";
}
else
{
	$parola=Modifica;
   // se id ha un valore, allora siamo in fase di modifica 
	$annulla ="<input type=\"button\" 
	class=\"medio\" name=\"Annulla\" value=\"Annulla\" onclick=\"javascript:window.location='area.php?pag=elenco_notizieint.php'\" />";

   $str=" SELECT titolo , sottotitolo , testo , link  FROM notizieint where ID='$id'";
   $risultato=mysql_query($str);
   if (mysql_num_rows($risultato)>0)
   {
		$control=mysql_fetch_row($risultato);
      // assegnamo alla var (array) $control[x] (che ci serve nella form per assegnare il value) i valori della query
   }
}
?>
<div class="contenitore">
<form name="notizie" method="post" action="insert_notizieint_query.php" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?=$id?>"/>
<!-- il valore di id lo passiamo alla pagina di action con un campo nascosto -->
	<h3><?=$parola?> notizia interna:</h3>
	<div class="azzerafloat"></div>
	<div class="float140">Titolo:</div>
	<div class="float500">
		<input type="text" name="titolo" size="95" maxlength="200" tabindex="1" value="<?=$control[0]?>"/>
	</div>
	<div class="azzerafloat"></div>
	<div class="float140">Sottotitolo:</div>
	<div class="float500">
		<input type="text" name="sottotitolo" size="95" maxlength="200" tabindex="2" value="<?=$control[1]?>"/>
	</div>
	<div class="azzerafloat"></div>
	<div class="float140">Testo:</div>
	<div class="float615">
		<?
			echo "<textarea name=\"testo\">$control[2]</textarea>
					<script type=\"text/javascript\">
						CKEDITOR.replace( 'testo' );
					</script>
			";
		?>
		
		
	</div>
	<div class="azzerafloat"></div>
	<div class="float140">Link:</div>
	<div class="float500">
		<input type="text" name="link" size="95" maxlength="200" tabindex="4" value="<?=$control[3]?>"/>
	</div>
	<div class="azzerafloat"></div>
	<input type="submit" class="medio" value="<?=$parola?>" tabindex="7"/>  
	<?=$annulla?>             
</form>
</div>
