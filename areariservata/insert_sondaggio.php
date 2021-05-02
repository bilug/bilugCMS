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
   $control[0] = $_GET["titolo"];
   $control[1] = $_GET["attivo"];
   $control[3] = $_GET["multipli"];
   $control[4] = $_GET["utenti"];
   $control[2] = $_GET["opzioni"];
   $lingua = $_GET["lingua"];
   if (!$control[1] and !$control[3] and !$control[4])
   {
	$control[1]="no";   
	$control[3]="no";
	$control[4]="no";
   }
	$annulla = "<input type=\"button\" 
	class=\"medio\" name=\"Annulla\" value=\"Annulla\" onclick=\"javascript:window.location='area.php?pag=elenco_sondaggi.php'\" />";
}
else
{
	$parola=Modifica;
   // se id ha un valore, allora siamo in fase di modifica 
	$annulla ="<input type=\"button\" 
	class=\"medio\" name=\"Annulla\" value=\"Annulla\" onclick=\"javascript:window.location='area.php?pag=elenco_sondaggi.php'\" />";
   $str=" SELECT titolo, attivo, opzioni, multipli, utenti, id_lingua FROM sondaggi WHERE ID = '$id' LIMIT 1";
   $risultato=mysql_query($str);
   if (mysql_num_rows($risultato)>0)
   {
		$control=mysql_fetch_row($risultato);    
   }
   
   $lingua=$control[5];
}
?>
<div class="contenitore">
<form name="sondaggi" method="post" action="insert_sondaggio_query.php" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?=$id?>"/>
<!-- il valore di id lo passiamo alla pagina di action con un campo nascosto -->
	<h3><?=$parola?> notizia:</h3>
	<div class="azzerafloat"></div>
	<div class="float140">Titolo:</div>
	<div class="float500">
		<input type="text" name="titolo" size="95" maxlength="200" tabindex="1" value="<?=$control[0]?>"/>
	</div>
	<div class="azzerafloat"></div>
	<div class="float140">Attivo:</div>
	<div class="float500">
		<input type="radio" class="little" value="si" name="attivo" <? if ($control[1]=="si") echo "checked"; ?> />si
		<input type="radio" class="little" value="no" name="attivo" <? if ($control[1]=="no") echo "checked"; ?> />no
	</div>
	<div class="azzerafloat"></div>
	<div class="float140">Opzioni Multiple:</div>
	<div class="float500">
		<input type="radio" class="little" value="si" name="multipli" <? if ($control[3]=="si") echo "checked"; ?> />si
		<input type="radio" class="little" value="no" name="multipli" <? if ($control[3]=="no") echo "checked"; ?> />no
	</div>
	<div class="azzerafloat"></div>
	<div class="float140">Sondaggio solo per utenti:</div>
	<div class="float500">
		<input type="radio" class="little" value="si" name="utenti" <? if ($control[4]=="si") echo "checked"; ?> />si
		<input type="radio" class="little" value="no" name="utenti" <? if ($control[4]=="no") echo "checked"; ?> />no
	</div>
	<div class="azzerafloat"></div>
	<div class="float140">Opzioni :</div>
	<div class="float500">
		<p>Inserire opzioni divise da invio (nessun invio dopo l'ultima)</p>
		<? if (isset($control[2]))
				$control[2] = str_replace(";","\n",$control[2]);
		?>
		<textarea name="opzioni" rows="11" cols="85"><?=$control[2]?></textarea>
	</div>	
	<div class="azzerafloat"></div>
	<div class="float140">Lingua :</div>
	<div class="float500">
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
	</div>
	
	<div class="azzerafloat"></div>
	<br/>
	<input type="submit" class="medio" value="<?=$parola?>" tabindex="7"/>  
	<?=$annulla?>             
</form>
</div>
