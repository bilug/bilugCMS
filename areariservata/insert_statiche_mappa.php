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
   $control[3]=$_GET["locazione"];
   $control[0]=$_GET["titolo"];
   $control[1]=$_GET["corpo"];
   $control[4]=$_GET["lingua"];
   $control[5]=$_GET["description"];
   $control[6]=$_GET["keywords"];
   
   $locazione = '';
	$posizione = '';
	
	$annulla = "<input type=\"button\" 
	class=\"medio\" name=\"Annulla\" value=\"Annulla\" onclick=\"javascript:window.location='area.php?pag=elenco_statiche.php'\" />";	
}
else
{
	$parola=Modifica;
   // se id ha un valore, allora siamo in fase di modifica 
	$annulla ="<input type=\"button\" 
	class=\"medio\" name=\"Annulla\" value=\"Annulla\" onclick=\"javascript:window.location='area.php?pag=elenco_statiche.php'\" />";

	$str=" SELECT titolo, corpo, ordine, maps, id_lingua, description, keywords FROM statiche WHERE id = $id LIMIT 1";
	$risultato=mysql_query($str);
	
	if ( mysql_num_rows( $risultato ) > 0 )
		$control = mysql_fetch_row( $risultato );
   
	if ( $control[3] != '' ) {
		$maps = explode( '||', $control[3] );
		$locazione = $maps[0];
		$posizione = $maps[1];
		$marker = $maps[2];
	}
}
?>
<div class="contenitore">
<form name="statiche_mappa" method="post" action="insert_statiche_mappa_query.php" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?=$id?>"/>
<!-- il valore di id lo passiamo alla pagina di action con un campo nascosto -->
	<h3><?=$parola?> Statica:</h3>
	<div class="azzerafloat"></div>
	<div class="float140">Titolo:</div>
	<div class="float500">
		<input type="text" name="titolo" size="95" maxlength="200" tabindex="1" value="<?=$control[0]?>"/>
	</div>

		
	<div class="azzerafloat"></div><br />
	<div class="float140">Descrizione:</div>
	<div class="float500">
		<textarea name="description" rows="4" cols="80" maxlength="160" tabindex="2"><?=$control[5]?></textarea>
	</div>		
	
	<div class="azzerafloat"></div><br />
	<div class="float140">Parole chiavi:</div>
	<div class="float500">
		<textarea name="keywords" rows="6" cols="80" maxlength="200" tabindex="3"><?=$control[6]?></textarea>
	</div>	
	
	<div class="azzerafloat"></div><br />
	<div class="float140">Lingua:</div>
	<div class="float500">
		<select name="lingua">
		<?php
			$sql = "SELECT id, sigla FROM lingue";
			$rssql = mysql_query( $sql );
			while( $r = mysql_fetch_row( $rssql ) ){
				$sel = '';
				if ( $r[0] == $control[4] ) {
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
			echo "<textarea id=\"corpo_ck\" name=\"corpo2\" tabindex=\"2\">$control[1]</textarea>
					<script type=\"text/javascript\">
						CKEDITOR.replace( 'corpo2');
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
	
	<div class="azzerafloat"></div><br /><br />	
	
	<h3>Inserisci Google Maps:</h3>
	
	<div class="float140">Locazione:</div>
	<div class="float500">
		<input type="text" name="locazione" size="95" tabindex="3" value="<?=$locazione?>"/>
	</div>
	<div class="azzerafloat"></div><br />	
	
	<div class="float200">Posizione rispetto al testo:</div>
	<div class="float140">
		<?php
		$check1 = $check2 = '';
		if ( $posizione == 'p' )	$check1 = "checked=\"checked\"";
		elseif ( $posizione == 'd' )	$check2 = "checked=\"checked\"";
		else 	$check1 = "checked=\"checked\"";
		?>
		Prima <input type="radio" name="posizione" size="95" tabindex="4" value="p" <?=$check1?> />
		Dopo <input type="radio" name="posizione" size="95" tabindex="5" value="d" <?=$check2?> />
	</div>
	<div class="azzerafloat"></div><br />	
	
  
	<div class="float200">Immagine per il marker:</div>
  <div class="float140">
	   <input type="text" size="50" class="medio" name="marker" onclick="openKCFinder(this)" value="<?=$marker?>" />
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
	</div>	
	<div class="azzerafloat"></div>	
			
		<?if (!$id)
		{
			$str1=" SELECT max(ordine) FROM statiche LIMIT 1";
        	$risultato1=mysql_query($str1);        
        	$var = mysql_fetch_row($risultato1);
        	$control[2] = ++$var[0];
		}
		else
			echo "<input type=\"hidden\" name=\"id\" value=\"$id\"/>";
		?>
		<input type="hidden" name="ordine" value="<?=$control[2]?>"/>
	<br />
	<input type="submit" class="medio" value="<?=$parola?>" tabindex="7"/>  
	<?=$annulla?>             
</form>
</div>


<?=onbeforeunload()?>