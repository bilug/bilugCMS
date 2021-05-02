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
	$nome=$_GET["arg"];
	$menu_arg=$_GET["menu_arg"];
	$lingua=$_GET["lingua"];
	$annulla = "<input type=\"button\" 
	class=\"medio\" name=\"Annulla\" value=\"Annulla\" onclick=\"javascript:window.location='area.php?pag=elenco_arg.php'\" />";
}
else
{
	$parola=Modifica;
  	// se id ha un valore, allora siamo in fase di modifica 
	$annulla ="<input type=\"button\" 
	class=\"medio\" name=\"Annulla\" value=\"Annulla\" onclick=\"javascript:window.location='area.php?pag=elenco_arg.php'\" />";
   $str=" SELECT ID, argomenti, menu_arg, id_lingua FROM argomenti where ID='$id' LIMIT 1";
   $risultato=mysql_query($str);
	if (mysql_num_rows($risultato)>0)
	{
		$control=mysql_fetch_row($risultato);
		$nome=$control[1];
		$menu_arg=$control[2];
		$lingua=$control[3];
		// assegnamo alla var $nome (che ci serve nella form per assegnare il value) il valore della query
	}
}
?>
<div class="contenitore">
<form name="modify_arg" method="post" action="insert_arg_query.php" enctype="multipart/form-data">

<input type="hidden" name="id" value="<?=$id?>"/>

<!-- il valore di id lo passiamo alla pagina di action con un campo nascosto -->
	<h3><?=$parola?> l'argomento:</h3>

	Argomento: <input type="text" name="arg" size="45" maxlength="50" tabindex="1" value="<?=$nome?>"/>
	<br /><br />

	Numero men&ugrave;
	<select name="menu_arg">
		<?php
		for( $i=1; $i<=5; $i++ ) {
			$sel = '';
			if ( $menu_arg == $i ) {
				$sel = "selected='selected'";
			}
				
			echo "<option value=\"$i\" $sel> $i </option>";
		}
		?>
	</select>	

	Lingua
	<select name="lingua">
	<?php
		$sql = "SELECT id, sigla FROM lingue";
		$rssql = mysql_query( $sql );
		while( $r = mysql_fetch_row( $rssql ) ){
			$sel = '';
			if ( $r[0] == $lingua ) {
				$sel = "selected='selected'";
			}
				
			echo "<option value=\"$r[0]\" $sel> $r[1] </option>";
		}
	?>
	</select>	
	
	<input class="medio" type="submit" value="<?=$parola?>"/>
	<?=$annulla?>
</form>
</div>
