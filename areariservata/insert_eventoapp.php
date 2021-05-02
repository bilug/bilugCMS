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
	$control[1] = $_GET["titolo"];
	$control[2] = $_GET["luogo"];
	$control[3] = $_GET["tipo"];
	$control[4] = $_GET["descrizione"];
	$anno = $_GET["anno"];
	$mese = $_GET["mese"];
	$giorno = $_GET["giorno"];
	$ora = $_GET["ora"];
	$minuti = $_GET["minuti"];
	$lingua = $_GET["lingua"];
	$link = $_GET["link"];
	
   // se il valore di id è vuoto, allora siamo in fase di inserimento 
	$annulla = "<input type=\"button\" 
	class=\"medio\" name=\"Annulla\" value=\"Annulla\" onclick=\"javascript:window.location='area.php?pag=elenco_eventoapp.php'\" />";
	if(!$anno and !$mese and !$giorno and !$ora and !$minuti)
	{
			$control[0]= time();
	}
	else
	{
		$anno="20".$anno;
		$secondi="00";
		$control[0]= $anno."-".$mese."-".$giorno." ".$ora.":".$minuti.":".$secondi."";
		$control[0]=strtotime($control[0]);
	}
	
}
else
{
	$parola=Modifica;
   // se id ha un valore, allora siamo in fase di modifica 
	$annulla ="<input type=\"button\" 
	class=\"medio\" name=\"Annulla\" value=\"Annulla\" onclick=\"javascript:window.location='area.php?pag=elenco_eventoapp.php'\" />";

   $str="SELECT dataora, titolo, luogo, tipo, descrizione, id_lingua, link FROM eventi WHERE ID = $id LIMIT 1";
   $risultato=mysql_query($str);
   if (mysql_num_rows($risultato)>0)
   {
   	$control=mysql_fetch_row($risultato);    
   }
  
   $control[0]=strtotime($control[0]);
   
   $lingua = $control[5];
   $link = $control[6];
}
?>

<div class="contenitore">
<form name="sondaggi" method="post" action="insert_eventoapp_query.php">
<input type="hidden" name="id" value="<?=$id?>"/>
<input type="hidden" name="utente" value="<?=$_SESSION['tux']?>"/>
<!-- il valore di id lo passiamo alla pagina di action con un campo nascosto -->
	<h3><?=$parola?> Evento/Appuntamento:</h3>
	<div class="azzerafloat"></div>
	<div class="float140">&nbsp;</div>
	<div class="float50">Data:</div>
	<div class="float230">
	<select name="giorno">
		<?
			for ($ore=1;$ore<32;$ore++){				 
				echo "<option value=\"".($ore<10?"0":"")."$ore\"".
				 (date("d",$control[0])== $ore ? "selected":"").
				">".($ore<10?"0":"")."$ore&nbsp;&nbsp;</option>";
			}
		?>
		</select>-<select name="mese">
		<?
			$nomemese = Array("Gennaio","Febbraio","Marzo","Aprile","Maggio","Giugno", "Luglio","Agosto","Settembre","Ottobre","Novembre","Dicembre");
			for ($ore=1;$ore<13;$ore++){				 
				echo "<option value=\"".($ore<10?"0":"")."$ore\"".
				 (date("m",$control[0])== $ore ? "selected":"").
				">".$nomemese[$ore-1]."&nbsp;&nbsp;</option>";
			}
		?>
		</select>-<select name="anno">
		<?
			for ($ore=date('Y');$ore<date('Y')+30;$ore++){				 
				echo "<option value=\"$ore\" ".
				 (date("Y",$control[0])== $ore ? "selected":"").
				">$ore&nbsp;&nbsp;</option>";
			}
		?>
		</select>
	</div>
	<div class="float50">Ora:</div>
	<div class="float140">
		<select name="ora">
		<?
			for ($ore=0;$ore<24;$ore++){				 
				echo "<option value=\"".($ore<10?"0":"")."$ore\"".
				 (date("G",$control[0])== $ore ? "selected":"").
				">".($ore<10?"0":"")."$ore&nbsp;&nbsp;</option>";
			}
		?>
		</select>:<select name="minuti">
		<?
			for ($ore=0;$ore<59;$ore+=5){				 
				echo "<option value=\"".($ore<10?"0":"")."$ore\"".
				 (((date("i",$control[0])>= $ore)and(date("i",$control[0])< $ore+5))  ? "selected":"").
				">".($ore<10?"0":"")."$ore&nbsp;&nbsp;</option>";
			}
		?>
		</select>		
	</div>
	<div class="azzerafloat"></div><br/>
	<div class="float140">Titolo:</div>
	<div class="float500">
		<input type="text" name="titolo" size="95" maxlength="200" tabindex="1" value="<?=$control[1]?>"/>
	</div>
	<div class="azzerafloat"></div>
	<div class="float140">Luogo:</div>
	<div class="float500">
		<input type="text" name="luogo" size="95" maxlength="200" tabindex="1" value="<?=$control[2]?>"/>
	</div>
	<div class="azzerafloat"></div>
	<div class="float140">Tipo:</div>
	<div class="float500">
		<select name="tipo">
			<option value="E" <? if ($control[3]== 'E') echo "selected";?>>Evento</option>
			<option value="A" <? if ($control[3]== 'A') echo "selected";?>>Appuntamento&nbsp;&nbsp;</option>
		</select>		
	</div>
	<div class="azzerafloat"></div>
	<div class="float140">Descrizione:</div>
	<div class="float500">
		<textarea name="descrizione" rows="11" cols="85"><?=$control[4]?></textarea>
		
	
<?
	if($_SESSION['typo']!= "U")
	{
?>
	</div>
	<div class="azzerafloat"></div>
	<div class="float140">Link aggiuntivo: (verr&agrave; inserito nella descrizione)</div>
	<div class="float500">
		<select name="link">
			<option value="">Nessuno</option>
<?
	$strs=" SELECT titolo, argomento, ID FROM notizie WHERE autorizza = 'si' ORDER BY argomento";
	$risultatos=mysql_query($strs);
	$argomento=0;
	$primo=0;
	while($controls=mysql_fetch_row($risultatos))
	{
		if ($argomento != $controls[1])
		{
			if ($primo!=0)
			{
				echo "</optgroup>";
				$primo =1;
			}
			$str1s=" SELECT argomenti FROM argomenti WHERE ID='$controls[1]'";
	   	$risultato2s=mysql_query($str1s);
	   	$control1s=mysql_fetch_row($risultato2s);
	   	echo "<optgroup label=\"Argomento - $control1s[0]\">";
	   	$argomento=$controls[1];
	   }
		$sel = '';
		if ( $controls[2] == $link ) {
			$sel = "selected='selected'";
		}	   
		
	   echo "<option value=\"$controls[2]\" $sel>$controls[0]</option>";
	}
}
?>
	 </select>
	</div>
	
	<div class="azzerafloat"></div>
	<div class="float140">Lingua evento</div>
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
