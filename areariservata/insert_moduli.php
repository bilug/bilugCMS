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
	$control[0]=$_GET["titolo"];
	$control[1]=$_GET["titvideo"];
	$control[7]=$_GET["titvideo_en"];
	$control[8]=$_GET["titvideo_fr"];
	$control[9]=$_GET["titvideo_de"];
	$control[10]=$_GET["titvideo_es"];
	$control[11]=$_GET["titvideo_pt"];
	$control[2]=$_GET["modulo"];
	$control[3]=$_GET["posizione"];
	$control[4]=$_GET["attivo"];
	$control[5]=$_GET["zona"];
	if(!$control[4])
	{
		$control[4]="no";
	}
   // se il valore di id è vuoto, allora siamo in fase di inserimento 
	$annulla = "<input type=\"button\" 
	class=\"medio\" name=\"Annulla\" value=\"Annulla\" onclick=\"javascript:window.location='area.php?pag=elenco_moduli_new.php'\" />";
}
else
{
	$parola=Modifica;
   // se id ha un valore, allora siamo in fase di modifica 
	$annulla ="<input type=\"button\" 
	class=\"medio\" name=\"Annulla\" value=\"Annulla\" onclick=\"javascript:window.location='area.php?pag=elenco_moduli_new.php'\" />";

   $str=" SELECT titolo, titvideo, modulo, posizione, attivo, zona, ordine, titvideo_en, titvideo_fr, titvideo_de, titvideo_es, titvideo_pt FROM moduli where ID = $id LIMIT 1";
   $risultato=mysql_query($str);
   if (mysql_num_rows($risultato)>0)
   	$control=mysql_fetch_row($risultato);
}
?>

<div class="contenitore">
<form name="statiche" method="post" action="insert_moduli_query.php" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?=$id?>"/>
<!-- il valore di id lo passiamo alla pagina di action con un campo nascosto -->
	<h3><?=$parola?> Modulo:</h3>
	<div class="azzerafloat"></div>
	<div class="float160">Titolo:</div>
	<div class="float500">
		<input type="text" name="titolo" size="95" maxlength="200" tabindex="1" value="<?=$control[0]?>" />
	</div><br /><br />

	<div class="azzerafloat"></div>
	<div class="float160">Titolo a Video in Italiano (se applicabile):</div>
	<div class="float500">
		<input type="text" name="titvideo" size="95" maxlength="255" tabindex="1" value="<?=$control[1]?>" />
	</div><br /><br />

	<div class="azzerafloat"></div>
	<div class="float160">Titolo a Video in inglese (se applicabile):</div>
	<div class="float500">
		<input type="text" name="titvideo_en" size="95" maxlength="255" tabindex="1" value="<?=$control[7]?>" />
	</div><br /><br />

	<div class="azzerafloat"></div>
	<div class="float160">Titolo a Video in francese (se applicabile):</div>
	<div class="float500">
		<input type="text" name="titvideo_fr" size="95" maxlength="255" tabindex="1" value="<?=$control[8]?>" />
	</div><br /><br />
	
	<div class="azzerafloat"></div>
	<div class="float160">Titolo a Video in tedesco (se applicabile):</div>
	<div class="float500">
		<input type="text" name="titvideo_de" size="95" maxlength="255" tabindex="1" value="<?=$control[9]?>" />
	</div><br /><br />
	
	<div class="azzerafloat"></div>
	<div class="float160">Titolo a Video in spagnolo (se applicabile):</div>
	<div class="float500">
		<input type="text" name="titvideo_es" size="95" maxlength="255" tabindex="1" value="<?=$control[10]?>" />
	</div><br /><br />
	
	<div class="azzerafloat"></div>
	<div class="float160">Titolo a Video in portoghese (se applicabile):</div>
	<div class="float500">
		<input type="text" name="titvideo_pt" size="95" maxlength="255" tabindex="1" value="<?=$control[11]?>" />
	</div><br /><br />
	
	<div class="azzerafloat"></div>		
	<div class="float160">Modulo:</div>
	<div class="float500">
		<input type="text" name="modulo" size="95" maxlength="200" tabindex="1" value="<?=$control[2]?>"/>
	</div><br /><br />
	
	<div class="azzerafloat"></div>	
	<div class="float160">&nbsp;</div>
	<div class="float500">
		Posizione:
		<input type="radio" class="little" value="a" name="posizione" <? if ($control[3]=="a" or !$id) echo "checked"; ?> />Alto
		<input type="radio" class="little" value="b" name="posizione" <? if ($control[3]=="b") echo "checked"; ?> />Basso
		<input type="radio" class="little" value="s" name="posizione" <? if ($control[3]=="s")  echo "checked"; ?> />Sinistra
		<input type="radio" class="little" value="d" name="posizione" <? if ($control[3]=="d")  echo "checked"; ?> />Destra
		<input type="radio" class="little" value="c" name="posizione" <? if ($control[3]=="c")  echo "checked"; ?> />Corpo
		<br/>
		Zona: 
		<input type="radio" class="little" value="t" name="zona" <? if ($control[5]=="t" or !$id) echo "checked"; ?> />Tutti
		<input type="radio" class="little" value="u" name="zona" <? if ($control[5]=="u") echo "checked"; ?> />Solo Utenti
		<input type="radio" class="little" value="a" name="zona" <? if ($control[5]=="a")  echo "checked"; ?> />Solo Admin
		<br/>
		Attivo:
		<input type="radio" class="little" value="si" name="attivo" <? if ($control[4]=="si") echo "checked"; ?> />si
		<input type="radio" class="little" value="no" name="attivo" <? if ($control[4]=="no") echo "checked"; ?> />no		
	</div>
		<div class="float140">
		<p>Moduli presenti e ordine di visualizzazione:</p>
		<? 
		$str1=" SELECT titolo,ordine FROM moduli order by ordine";
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
			$str1=" SELECT max(ordine) FROM moduli";
        	$risultato1=mysql_query($str1);        
        	$var = mysql_fetch_row($risultato1);
        	$control[5] = ++$var[0];
		}		
		?>
		<input type="hidden" name="ordine" value="<?=$control[6]?>"/>		
		
	<br/>
	<input type="submit" class="medio" value="<?=$parola?>" tabindex="7"/>  
	<?=$annulla?>              
</form>
</div>
