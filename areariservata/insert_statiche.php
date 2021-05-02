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
   $control[2]=0;
   $control[0]=$_GET["titolo"];
   $control[1]=$_GET["corpo"];
   $control[3]=$_GET["lingua"];
   $control[4]=$_GET["description"];
   $control[5]=$_GET["keywords"];
	$annulla = "<input type=\"button\" 
	class=\"medio\" name=\"Annulla\" value=\"Annulla\" onclick=\"javascript:window.location='area.php?pag=elenco_statiche.php'\" />";	
}
else
{
	$parola=Modifica;
   // se id ha un valore, allora siamo in fase di modifica 
	$annulla ="<input type=\"button\" 
	class=\"medio\" name=\"Annulla\" value=\"Annulla\" onclick=\"javascript:window.location='area.php?pag=elenco_statiche.php'\" />";

	$str=" SELECT titolo, corpo, ordine, id_lingua, description, keywords FROM statiche WHERE id = $id LIMIT 1";
	$risultato=mysql_query($str);
	
	if ( mysql_num_rows( $risultato ) > 0 )
		$control = mysql_fetch_row( $risultato );
}
?>
<div class="contenitore">
<form name="statiche" method="post" action="insert_statiche_query.php" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?=$id?>"/>
<!-- il valore di id lo passiamo alla pagina di action con un campo nascosto -->
	<h3><?=$parola?> Statica:</h3>
	<div class="azzerafloat"></div>
	<div class="float140">Titolo:</div>
	<div class="float500">
		<input type="text" name="titolo" size="95" maxlength="50" tabindex="1" value="<?=$control[0]?>"/>
	</div>		
	
	<div class="azzerafloat"></div><br />
	<div class="float140">Descrizione:</div>
	<div class="float500">
		<textarea name="description" rows="4" cols="80" maxlength="160" tabindex="2"><?=$control[4]?></textarea>
	</div>		
	
	<div class="azzerafloat"></div><br />
	<div class="float140">Parole chiavi:</div>
	<div class="float500">
		<textarea name="keywords" rows="6" cols="80" maxlength="200" tabindex="3"><?=$control[5]?></textarea>
	</div>	
	
	<div class="azzerafloat"></div><br />
	<div class="float140">Lingua:</div>
	<div class="float500">
		<select name="lingua" tabindex="4">
		<?php
			$sql = "SELECT id, sigla FROM lingue";
			$rssql = mysql_query( $sql );
			while( $r = mysql_fetch_row( $rssql ) ){
				$sel = '';
				if ( $r[0] == $control[3] ) {
					$sel = "selected='selected'";
				}
					
				echo "<option value=\"$r[0]\" $sel> $r[1] </option>";
			}
		?>
		</select>		
	</div>
	
	<div class="azzerafloat"></div><br />
	<div class="float140">Corpo:</div>
	<div class="float615">
		<?
			echo "<textarea id=\"corpo_ck\" name=\"corpo\">$control[1]</textarea>
					<script type=\"text/javascript\">
						CKEDITOR.replace('corpo');
					</script>
			";	

	 ?>	 
	</div>	
	<div class="float140">
		<p>Pagine presenti e id di visualizzazione:</p>
		<? 
		$str1=" SELECT titolo,id FROM statiche order by id";
      $risultato1=mysql_query($str1);        
		if (mysql_num_rows($risultato1)>0)
		{
			echo "<ul>";
			while ($var = mysql_fetch_row($risultato1))
			{
				echo "<li>$var[1] - $var[0]</li>";
			}
			echo "</ul>";
      }?>		
	</div>
	<div class="azzerafloat"></div>	
			
		<?if (!$id)
		{
			$str1=" SELECT max(ordine) FROM statiche";
        	$risultato1=mysql_query($str1);        
        	$var = mysql_fetch_row($risultato1);
        	$control[2] = ++$var[0];
		}		
		else
			echo "<input type=\"hidden\" name=\"id\" value=\"$id\"/>";
		?>
		<input type="hidden" name="ordine" value="<?=$control[2]?>"/>
	<br/>
	<input type="submit" class="medio" value="<?=$parola?>" tabindex="6"/>  
	<?=$annulla?>             
</form>
</div>


<?=onbeforeunload()?>
