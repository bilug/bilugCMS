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
		echo "<h1><img src=\"./img/alert.png\" class=\"ico\" />$tipoerr<img src=\"./img/alert.png\" class=\"ico\" /></h1>";
}

if (!$id)
{
	$parola=Inserisci;
  	// se il valore di id è vuoto, allora siamo in fase di inserimento 
  	$control[1] = $_GET["arg"];
  	$control[0] = $_GET["sez"];
}
else
{
	$parola=Modifica;
  	// se id ha un valore, allora siamo in fase di modifica 

   $str=" SELECT sez,voce FROM menu where ID='$id'";
   $risultato=mysql_query($str);
   if (mysql_num_rows($risultato)>0)
   {
   	$control=mysql_fetch_row($risultato);
	}
}
?>

<div class="contenitore">
<form name="modify_menu" method="post" action="insert_menu_query.php" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?=$id?>"/>

<!-- il valore di id lo passiamo alla pagina di action con un campo nascosto -->
	<h3><?=$parola?> il Menu:</h3>
	<input type="radio" class="little" value="a" name="sez" <? if ($control[0]=="a" or !$id) echo "checked"; ?> />Alto
	<input type="radio" class="little" value="b" name="sez" <? if ($control[0]=="b") echo "checked"; ?> />Destra
	<input type="radio" class="little" value="c" name="sez" <? if ($control[0]=="c")  echo "checked"; ?> />Basso
	<input type="radio" class="little" value="d" name="sez" <? if ($control[0]=="d")  echo "checked"; ?> />Sinistra<br/>
	<input type="text" name="arg" size="45" maxlength="50" tabindex="1" value="<?=$control[1]?>"/>
	<input type="submit" class="medio" value="<?=$parola?>"/>
	<input type="button" class="medio" name="Annulla" value="Annulla" onclick="javascript:window.location='area.php?pag=elenco_menu.php'" />
</form>
</div>
