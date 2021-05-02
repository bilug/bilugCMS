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

$errore = null;
$errore = $_GET["errore"];
$tipoerr = $_GET["tipoerr"];
if ( $errore == "si" ) {
		echo "<h1><img src=\"./img/alert.png\" class=\"ico\" />$tipoerr<img src=\"./img/alert.png\" class=\"ico\" /></h1>";
		$control[0] = $_GET["titolo"];
		$lingua = $_GET["link"];
		$control[4] = $_GET["descrizione"];
		$control[5] = $_GET["img"];
}

if ( !$id ) {
  	// se il valore di id è vuoto, allora siamo in fase di inserimento 
	$parola=Inserisci;
}
else {
  	// se id ha un valore, allora siamo in fase di modifica 
	$parola=Modifica;

   $str = "SELECT titolo, tipo, link, id_lingua, descrizione, img FROM menutipo WHERE id = $id LIMIT 1";
   $risultato=mysql_query($str);
	if (mysql_num_rows($risultato)>0)
	{
		$control=mysql_fetch_row($risultato);
		$lingua = $control[3];
	}
}

?>

<div class="contenitore">
<form name="modify_menu" method="post" action="insert_menu_new_query.php">

	<input type="hidden" name="id" value="<?=$id?>"/>

	<!-- il valore di id lo passiamo alla pagina di action con un campo nascosto -->
	<h3><?=$parola?> il Menu:</h3>
	
	Nome *: 
	<input type="text" name="titolo" size="45" maxlength="50" tabindex="1" value="<?=$control[0]?>"/>
	<br /><br />
		
	Breve descrizione: 
	<input type="text" name="descrizione" size="45" maxlength="50" tabindex="2" value="<?=$control[4]?>"/>
	<br /><br />
	
	Tipo:
	<select name="tipo">
	<?
		$tipi = array('Tendina','According 1','According 2','According 3','According 4','According 5');
		$tipi_post = array( 't', 'a1', 'a2', 'a3', 'a4', 'a5' );
		for($i=0; $i<=5; $i++)
		{
		echo "<option value=\"$tipi_post[$i]\" ";
          if ($control[1]==$tipi_post[$i]) echo "selected";
         echo "> $tipi[$i]</option>";
		}
	?>
	</select>
	<br /><br />
	
	Inserisci immagine:
	<input type="text" class="medio" size="95" name="img" tabindex="1" onclick="openKCFinder(this)" value="<?=$control[5]?>" />
	<br /><br />

	<script type="text/javascript">

	function openKCFinder(textarea) {
		window.KCFinder = {
			callBackMultiple: function(files) {
				window.KCFinder = null;
				textarea.value = "";
				for (var i = 0; i < files.length; i++)
					textarea.value += files[i] + ";";
			}
		};
		window.open('../kcfinder/browse.php?type=images',
			'kcfinder_multiple', 'status=0, toolbar=0, location=0, menubar=0, ' +
			'directories=0, resizable=1, scrollbars=0, width=800, height=600'
		);
	}

	</script>
	
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
	<br /><br />
	
	<input type="submit" class="medio" value="<?=$parola?>"/>
	<input type="button" class="medio" name="Annulla" value="Annulla" onclick="javascript:window.location='area.php?pag=elenco_menu_new.php'" />
</form>
</div>
