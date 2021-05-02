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

$parola=Modifica;

$errore=null;
$errore=$_GET["errore"];
$tipoerr=$_GET["tipoerr"];
if($errore=="si")
{
		echo "<h1><img src=\"./img/alert.png\" class=\"ico\" />$tipoerr<img src=\"./img/alert.png\" class=\"ico\" /></h1>";
}

$str="select business,no_shipping,quantity,cancel_return,cn,cbt,no_note,returnok,rm,currency_code,lc,image_url from pagamento limit 1";
$risultato=mysql_query($str);
if (mysql_num_rows($risultato)>0)
{
	$control=mysql_fetch_row($risultato);    
}    
?>

<div class="contenitore">
<form name="sondaggi" method="post" action="insert_datipag_query.php" enctype="multipart/form-data">
	<h3><?=$parola?> Dati Per Pagamento Online:</h3>
	<div class="azzerafloat"></div>
	<div class="float140">Utente PayPal:</div>
	<div class="float500">
		<input type="text" name="business" size="95" maxlength="200" tabindex="1" value="<?=$control[0]?>"/>
	</div>
	<div class="azzerafloat"></div>
	<div class="float140">Richiesta dati Spedizione:</div>
	<div class="float500">
		<input type="radio" class="little" value="1" name="no_shipping" <? if ($control[1]=="1") echo "checked"; ?> />si
		<input type="radio" class="little" value="0" name="no_shipping" <? if ($control[1]=="0") echo "checked"; ?> />no
	</div>
	<div class="azzerafloat"></div>
	<div class="float140">Quantit&aacute;(def. 1):</div>
	<div class="float500">
		<input type="text" name="quantity" size="95" maxlength="200" tabindex="1" value="<?=$control[2]?>"/>
	</div>
	<div class="azzerafloat"></div>
	<div class="float140">Indirizzo di ritorno su Annullo:</div>
	<div class="float500">
		<input type="text" name="cancel_return" size="95" maxlength="200" tabindex="1" value="<?=$control[3]?>"/>
	</div>
	<div class="azzerafloat"></div>
	<div class="float140">Messaggio su Note aggiumtive</div>
	<div class="float500">
		<input type="text" name="cn" size="95" maxlength="200" tabindex="1" value="<?=$control[4]?>"/>
	</div>
	<div class="azzerafloat"></div>
	<div class="float140">Desc. Bottone fine Transazione</div>
	<div class="float500">
		<input type="text" name="cbt" size="95" maxlength="200" tabindex="1" value="<?=$control[5]?>"/>
	</div>
	<div class="azzerafloat"></div>
	<div class="float140">Richiesta Note Aggiuntive:</div>
	<div class="float500">
		<input type="radio" class="little" value="1" name="no_note" <? if ($control[6]=="1") echo "checked"; ?> />si
		<input type="radio" class="little" value="0" name="no_note" <? if ($control[6]=="0") echo "checked"; ?> />no
	</div>
	<div class="azzerafloat"></div>
	<div class="float140">Ritorno Su transazione terminata con successo</div>
	<div class="float500">
		<input type="text" name="returnok" size="95" maxlength="200" tabindex="1" value="<?=$control[7]?>"/>
	</div>
	<div class="azzerafloat"></div>
	<div class="float140">Tipo Ritorno Dati</div>
	<div class="float500">
		<input type="radio" class="little" value="0" name="rm" <? if ($control[8]=="0") echo "checked"; ?> />Nessuno
		<input type="radio" class="little" value="1" name="rm" <? if ($control[8]=="1") echo "checked"; ?> />via Get
		<input type="radio" class="little" value="2" name="rm" <? if ($control[8]=="2") echo "checked"; ?> />via Post
	</div>
	<div class="azzerafloat"></div>
	<div class="float140">Codice Valuta(US, EUR):</div>
	<div class="float500">
		<input type="text" name="currency_code" size="95" maxlength="200" tabindex="1" value="<?=$control[9]?>"/>
	</div>
	<div class="azzerafloat"></div>
	<div class="float140">Lingua default(IT,US)</div>
	<div class="float500">
		<input type="text" name="lc" size="95" maxlength="200" tabindex="1" value="<?=$control[10]?>"/>
	</div>
	<div class="azzerafloat"></div>
	<div class="float140">Immagine Testata</div>
	<div class="float500">
		<input type="text" name="image_url" size="95" maxlength="200" tabindex="1" value="<?=$control[11]?>"/>
	</div>
	<div class="azzerafloat"></div>	
	<br/>
	<input type="submit" class="medio" value="<?=$parola?>" tabindex="7"/>  
	<input type="button"	class="medio" name="Annulla" value="Annulla" onclick="javascript:window.location='area.php'" />             
</form>
</div>
