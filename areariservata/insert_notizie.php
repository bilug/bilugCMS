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
require_once("auth.php");

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
	$control[0]= $_GET["titolo"];
	$control[1]= $_GET["sottotitolo"];
	$control[2]= $_GET["testo"];
	$control[5]= $_GET["link"];
	$control[6]= $_GET["autorizza"];
	$control[7]= $_GET["evidenzia"];
    $control[9]=$_GET["description"];
    $control[10]=$_GET["keywords"];
   
	$filmato->codice= $_GET["codice"];
	$filmato->rel= $_GET["rel"];
	$filmato->sito= $_GET["sito"];
	$filmato->ris= $_GET["ris"];
	$filmato->bordi= $_GET["bordi"];
	$filmato->pos= $_GET["pos"];
	
	//echo "$filmato->codice e $filmato->rel e $filmato->sito e $filmato->ris e $filmato->bordi e $filmato->pos";
	
	if(!$control[6] and !$control[7])
	{
		$control[6] = "no";
		$control[7] = "no";
	}
	
   // se il valore di id è vuoto, allora siamo in fase di inserimento 
	$annulla = "<input type=\"button\" 
	class=\"medio\" name=\"Annulla\" value=\"Annulla\" onclick=\"javascript:window.location='area.php?pag=elenco_notargaut.php'\" />";
	$filmato = new DatiFilmato;
}
else
{
if($_SESSION['typo']== "U")
{
	$aut=$_SESSION['tux'];
	$queryaut = "SELECT autore FROM notizie WHERE id = $id AND autore = $aut LIMIT 1";
	$ris= mysql_query($queryaut);
	$ris = mysql_fetch_array($ris);
	if(!$ris)
	{
		echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=elenco_notargaut.php\" />";
		$msg = "AZIONE NON CONSENTITA";				  
		confirm($msg);
		exit;
	}
}
	$parola=Modifica;
   // se id ha un valore, allora siamo in fase di modifica 
	$annulla ="<input type=\"button\" 
	class=\"medio\" name=\"Annulla\" value=\"Annulla\" onclick=\"javascript:window.location='area.php?pag=elenco_notargaut.php'\" />";

   $str=" SELECT titolo, sottotitolo, testo, autore, argomento, link, autorizza, evidenzia, filmato, description, keywords FROM notizie WHERE ID = $id LIMIT 1";
   $risultato=mysql_query($str);
   if (mysql_num_rows($risultato)>0)
   {
   	$control=mysql_fetch_row($risultato);
      $aut=$control[3];
      $arg=$control[4];
      $filmato = unserialize ($control[8]);
      // assegnamo alla var (array) $control[x] (che ci serve nella form per assegnare il value) i valori della query      
	}
}
?>
<div class="contenitore">
<form name="notizie" method="post" action="insert_notizie_query.php" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?=$id?>"/>
<input type="hidden" name="oldarg" value="<?=$arg?>"/>
<input type="hidden" name="oldtitolo" value="<?=$control[0]?>"/>
<!-- il valore di id lo passiamo alla pagina di action con un campo nascosto -->
	<h3><?=$parola?> notizia:</h3>
	<div class="azzerafloat"></div>
	<div class="float140">Titolo:</div>
	<div class="float500">
		<input type="text" name="titolo" size="95" maxlength="200" tabindex="1" value="<?=$control[0]?>"/>
	</div>
	<div class="azzerafloat"></div>
	<div class="float140">Sottotitolo:</div>
	<div class="float500">
		<input type="text" name="sottotitolo" size="95" maxlength="200" tabindex="2" value="<?=$control[1]?>"/>
	</div>
	<div class="azzerafloat"></div>
	<div class="float140">Filmato Video:<br/>Codice Video:</div>
	<div class="float500">Dimensione filmato: 
		<? 
			foreach ($risoluzioni as $key=>$value)
			{
				echo "<input type=\"radio\" class=\"little\" name=\"ris\" value=\"$key\"";
				if ($filmato->ris == $key) echo "checked";
				echo " /> $value[0]x$value[1] "; 
			}
		?>		
		<br/>	
		 <input type="text" size="95" maxlength="200" name="codice" value ="<?=$filmato->codice?>"/><br/>
		 Sito di provenienza
		 <? 
			foreach ($sitivideo as $key=>$value)
			{
				echo "<input type=\"radio\" class=\"little\" name=\"sito\" value=\"$key\"";
				if ($filmato->sito == $key) echo "checked";
				echo " /> $key "; 
			}
		?>
			<br/>
		Mostra filmati relativi: <input type="checkbox" class="little" name="rel" value="1" <?=($filmato->rel==0 ?'':'checked')?> />
		Bordi: <input type="checkbox" name="bordi" class="little" value="1" <?=($filmato->bordi==0?'':'checked')?>/><br/>
		Posizione rispetto al testo: 
		Prima <input type="radio" name="posizione" class="little" value="0" <?=($filmato->pos==0?'checked':'')?>/> 
		Dopo <input type="radio" name="posizione"  class="little" value="1" <?=($filmato->pos==1?'checked':'')?>/>		
	</div>
	<div class="azzerafloat"></div>
	<div class="float140">Testo:</div>
	<div class="float615">
		<?
			echo "<textarea id=\"corpo_ck\" name=\"testo\">$control[2]</textarea>
					<script type=\"text/javascript\">
						CKEDITOR.replace( 'testo');
					</script>
			";
		?>
	</div>

	
	<div class="azzerafloat"></div><br />
	<div class="float140">Descrizione:</div>
	<div class="float500">
		<textarea name="description" rows="4" cols="80" maxlength="160" tabindex="3"><?=$control[9]?></textarea>
	</div>		
	
	<div class="azzerafloat"></div><br />
	<div class="float140">Parole chiavi:</div>
	<div class="float500">
		<textarea name="keywords" rows="6" cols="80" maxlength="200" tabindex="4"><?=$control[10]?></textarea>
	</div>	


	<div class="azzerafloat"></div>
	<div class="float140">Link:</div>
	<div class="float500">
		<input type="text" name="link" size="95" maxlength="200" tabindex="5" value="<?=$control[5]?>"/>
	</div>
	<div class="azzerafloat"></div>
	<div class="float140">Autore:</div>
	<div class="float500">
     <select name="autore" size="1" tabindex="6">
     <?
     if($_SESSION['typo']== "U")
{
		$str=" SELECT ID, nome FROM anagrafica WHERE ID=$aut";
		$risultato=mysql_query($str);
		$control1=mysql_fetch_row($risultato);
		echo"<option value=\"$control1[0]\">$control1[1]</option>";
}
else
{
     $str=" SELECT ID, nome FROM anagrafica";
     $risultato=mysql_query($str);
     while($control1=mysql_fetch_row($risultato))
         {
         echo "<option value=\"$control1[0]\" ";
          if ($aut==$control1[0]) echo "selected";
         echo "> $control1[1]</option>";
         }
}
     ?>
     </select>
	</div>
	<div class="azzerafloat"></div>
	<div class="float140">Argomento:</div>
	<div class="float500">
     <select name="argomento" size="1" tabindex="7">
     <?
     $str=" SELECT ID, argomenti, menu_arg FROM argomenti ORDER BY argomenti";
     $risultato=mysql_query($str);
     while($control1=mysql_fetch_row($risultato))
         {
         echo "<option value=\"$control1[0]\" ";
          if ($arg==$control1[0]) echo "selected";
         echo "> $control1[1] - Men&ugrave; argomenti $control1[2]</option>";
         }
     ?>
     </select>
     </div>
 <?
	if($_SESSION['typo']!= "U")
	{
?>
	
	<div class="azzerafloat"></div>	
	<br/>
	Autorizzata <input type="radio"  class="little" value="si" name="autorizza" <? if($control[6]=='si') echo "checked";?>/>
	NON Autorizzata<input type="radio"  class="little" value="no" name="autorizza" <? if($control[6]=='no') echo "checked";?>/><br/>
	Evidenziato <input type="radio" class="little" value="si" name="evidenzia" <? if($control[7]=='si') echo "checked";?>/>
	NON Evidenziato <input type="radio" class="little" value="no" name="evidenzia" <? if($control[7]=='no') echo "checked";?>/><br/>
<?
	}
?>
	<br/>
	<input type="submit" class="medio" value="<?=$parola?>" tabindex="7"/>  
	<?=$annulla?>             
</form>
</div>



<?=onbeforeunload()?>
