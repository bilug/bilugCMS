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
	$str = "SELECT business, no_shipping, quantity, cancel_return, cn, cbt, no_note, returnok, rm, currency_code, lc, image_url FROM pagamento LIMIT 1";
	$risultato = mysql_query( $str );
	if ( mysql_num_rows( $risultato ) > 0 )
		$control = mysql_fetch_row($risultato);
?>

<div class="contenitore">
	<h1><span>Donazioni con PayPal</span></h1>

	<form class="paypalform" action="https://www.paypal.com/cgi-bin/webscr" method="post">
		<!-- Comando Obbligatorio -->
	   <input type="hidden" name="cmd" value="_donations"/>
	   <!-- Account Paypal -->
	   <input type="hidden" name="business" value="<?=$control[0]?>"/>
	   <!-- Variabile indirizzo spedizione -->	  
		<input type="hidden" name="no_shipping" value="0"/>
		<!-- Indirizzo di ritorno per annullo transazione -->	
		<input type="hidden" name="cancel_return" value="<?=$control[3]?>"/>	
		<!-- Messaggio per Note aggiuntive -->
		<input type="hidden" name="cn" value="<?=$control[4]?>"/>
		<!-- Testo Bottone di fine transazione -->
		<input type="hidden" name="cbt" value="<?=$control[5]?>"/>
		<!--  Richiesta Note aggiuntive (1 disabilita)-->
	   <input type="hidden" name="no_note" value="<?=$control[6]?>"/>
	   <!--  Indirizzo di ritorno fine transazione -->
		<input type="hidden" name="return" value="<?=$control[7]?>"/>
		<!--  1: RItorna dati via get 2: ritorna dati via Post-->
		<input type="hidden" name="rm" value="<?=$control[8]?>"/>
		<!--  Immagine Logo pagina Pagamento e moneta-->
		<input type="hidden" name="currency_code" value="<?=$control[9]?>"/>
		<input type="hidden" name="lc" value="<?=$control[10]?>"/>
		<input type="hidden" name="bn" value="PP-DonationsBF"/>
		<input type="hidden" name="image_url" value="<?=$control[11]?>"/>
		<!--  Donazione tassa nulla-->
		<input type="hidden" name="tax" value="0"/>
		<!-- Dati inseriti da utente e inviati a paypal -->
		<div class="float140">
		Nome :
		</div>	     
		<div class="float300">
			<input type="text" class="login" name="last_name" size="50" maxlength="200" value=""/>
		</div>
		<div class="azzerafloat"></div>
		<div class="float140">
		Cognome :
		</div>	     
		<div class="float300">
			<input type="text" class="login" name="first_name" size="50" maxlength="200" value=""/>
		</div>
		<div class="azzerafloat"></div>
		<div class="float140">
		Causale :
		</div>	     
		<div class="float300">
			<input type="text" class="login" name="item_name" size="50" maxlength="200" value=""/>
		</div>
		<div class="azzerafloat"></div>
		<div class="float140">
		Importo :
		</div>	     
		<div class="float300">
			<input type="text" class="login" name="amount" size="50" maxlength="200" value=""/>
		</div>
	   <div class="azzerafloat"></div>
	   <!-- Tasto di invio -->
	   <div class="float140"> 

		<input type="image" class="paypald" src="https://www.paypal.com/it_IT/IT/i/btn/btn_donate_SM.gif" name="submit" alt="PayPal - Il sistema di pagamento online pi&ugrave; facile e sicuro!"/>
		<img alt="" border="0" src="https://www.paypal.com/it_IT/i/scr/pixel.gif" width="1" height="1"/>
		</div>
	   <div class="azzerafloat"></div>
	</form>
</div>
