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
$errore=null;
$errore=$_GET["errore"];
$tipoerr=$_GET["tipoerr"];
if($errore=="si")
{
		echo "<h1><img src=\"./img/alert.png\" class=\"ico\" />$tipoerr<img src=\"./img/alert.png\" class=\"ico\" /></h1>";
}

$id = $_GET['id'];
if (!$id)
{
	$parola=Inserisci;
	// se il valore di id è vuoto, allora siamo in fase di inserimento 
	$annulla = "<input type=\"button\" 
	class=\"medio\" name=\"Annulla\" value=\"Annulla\" onclick=\"javascript:window.location='area.php?pag=elenco_partners.php'\" />";
}
else
{
	$parola=Modifica;
  	// se id ha un valore, allora siamo in fase di modifica 
	$annulla ="<input type=\"button\" 
	class=\"medio\" name=\"Annulla\" value=\"Annulla\" onclick=\"javascript:window.location='area.php?pag=elenco_partners.php'\" />";
   $str=" SELECT link, link_video FROM partners WHERE id='$id' LIMIT 1";
   $risultato=mysql_query($str);
	if (mysql_num_rows($risultato)>0)
	{
		$control=mysql_fetch_row($risultato);
		$link = $control[0];
		$link_video = $control[1];
		// assegnamo alla var $nome (che ci serve nella form per assegnare il value) il valore della query
	}
}
?>
<div class="contenitore">
<form name="modify_arg" method="post" action="insert_partners_query.php" enctype="multipart/form-data">

<input type="hidden" name="id" value="<?=$id?>"/>

<!-- il valore di id lo passiamo alla pagina di action con un campo nascosto -->
	<h3><?=$parola?> Partners:</h3>

	Link: <input type="text" name="link" size="45" tabindex="1" value="<?=$link?>"/>
	<br /><br />
	Titolo link: <input type="text" name="link_video" size="45" tabindex="1" value="<?=$link_video?>"/>
	<br /><br />


	<input class="medio" type="submit" value="<?=$parola?>"/>
	<?=$annulla?>
</form>
</div>
