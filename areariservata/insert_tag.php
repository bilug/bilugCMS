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

<?php
$errore=null;
$errore=$_GET["errore"];
$tipoerr=$_GET["tipoerr"];

if($errore=="si") echo "<h1><img src=\"./img/alert.png\" class=\"ico\" />$tipoerr<img src=\"./img/alert.png\" class=\"ico\" /></h1>";

$id = $_GET['id'];

if (!$id)
{
	$parola=Inserisci;
	// se il valore di id è vuoto, allora siamo in fase di inserimento 
	$nome_tag = $_GET["nome_tag"];
	$link_tag = $_GET["link_tag"];
	
	$annulla = "<input type=\"button\" 
	class=\"medio\" name=\"Annulla\" value=\"Annulla\" onclick=\"javascript:window.location='area.php?pag=gestione_tag.php'\" />";
}
else
{
	$parola=Modifica;
  	// se id ha un valore, allora siamo in fase di modifica 
	$annulla ="<input type=\"button\" 
	class=\"medio\" name=\"Annulla\" value=\"Annulla\" onclick=\"javascript:window.location='area.php?pag=gestione_tag.php'\" />";
   $str = "SELECT nome_tag, link_tag FROM tag WHERE id = '$id' LIMIT 1";
   $risultato=mysql_query($str);
	if (mysql_num_rows($risultato)>0)
	{
		$control=mysql_fetch_row($risultato);
		$nome_tag = $control[0];
		$link_tag = $control[1];
	}
}

?>

<div class="contenitore">
<form method="post" action="insert_tag_query.php">

<input type="hidden" name="id" value="<?=$id?>"/>

<!-- il valore di id lo passiamo alla pagina di action con un campo nascosto -->
	<h3><?=$parola?> TAG:</h3>

	Nome tag: <input type="text" name="nome_tag" tabindex="1" value="<?=$nome_tag?>"/> Nome visualizzato
	<br /><br />	
	Link tag: <input type="text" name="link_tag" tabindex="1" value="<?=$link_tag?>"/> Link friendly ( lettere, numeri e trattini )
	<br /><br />
	
	<input class="medio" type="submit" value="<?=$parola?>"/>
	<?=$annulla?>
</form>
</div>
