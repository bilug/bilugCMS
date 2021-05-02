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

$tipo = $_GET['tipo'];
$idpadre = $_GET['idpadre'];

$errore=null;
$errore=$_GET["errore"];
$tipoerr=$_GET["tipoerr"];
if($errore=="si")
{
		echo "<h1><img src=\"./img/alert.png\" class=\"ico\" />$tipoerr<img src=\"./img/alert.png\" class=\"ico\" /></h1>";
		$titolo=$_GET["titolo"];
		$link=$_GET["link"];
}

$parola=Inserisci;
$annulla ="<input type=\"button\" 
class=\"medio\" name=\"Annulla\" value=\"Annulla\" onclick=\"javascript:window.location='area.php?pag=elenco_menu_new.php'\" />";
?>

<div class="contenitore">
<form name="modify_sotmenu" method="post" action="insert_sotmenu_query.php" enctype="multipart/form-data">
<input type="hidden" name="tipo" value="<?=$tipo?>"/>
<input type="hidden" name="idpadre" value="<?=$idpadre?>"/>
<!-- il valore di id lo passiamo alla pagina di action con un campo nascosto -->
	<h3><?=$parola?> il Sottomenu:</h3>
	<input type="text" name="titolo" size="45" maxlength="50" value="<?=$titolo?>"/>
	<br><br>
	<input type="submit" class="medio" value="<?=$parola?>" />  
	<?=$annulla?>             

</form>
</div>
