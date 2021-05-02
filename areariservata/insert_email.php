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
  	$control[0]=$_GET["nome"];
  	$control[1]=$_GET["email"];
}
else
{
	$parola=Modifica;
  	// se id ha un valore, allora siamo in fase di modifica 

   $str=" SELECT nome,email FROM email where ID='$id'";
   $risultato=mysql_query($str);
   if (mysql_num_rows($risultato)>0)
   {
   	$control=mysql_fetch_row($risultato);
	}
}
?>

<div class="contenitore">
<form name="modify_email" method="post" action="insert_email_query.php" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?=$id?>"/>

<!-- il valore di id lo passiamo alla pagina di action con un campo nascosto -->
	<h3><?=$parola?> l'email:</h3>
	Nome : <input type="text" name="nome" size="60" maxlength="254" value="<?=$control[0]?>"/><br/>
	E-mail : <input type="text" name="email" size="60" maxlength="254" value="<?=$control[1]?>"/><br/>
	<input type="submit" class="medio" value="<?=$parola?>"/>
	<input type="button" class="medio" name="Annulla" value="Annulla" onclick="javascript:window.location='area.php?pag=elenco_email.php'" />
</form>
</div>
