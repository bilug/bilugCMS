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

<h1><span><?=_SITO?>: Cancellazione dalla newsletter</span></h1>

<?php
	$mail = ( isset( $_GET['xvmailvx'] ) ) ? apici( $_GET['xvmailvx'] ) : '';
	$code = ( isset( $_GET['acodeee'] ) ) ? apici( $_GET['acodeee'] ) : '';
	
	if ( $mail != '' AND $code != '' ) {
		$sql = "SELECT id FROM newsletter WHERE email = '$mail' AND code = '$code' LIMIT 1";
		$rssql = mysql_query( $sql );
		if ( mysql_num_rows( $rssql ) == 0 ) 
			$_SESSION['bilug_errore'] = "<div class=\"bilug-errore\">Non abbiamo trovato questa mail tra i nostri dati.</div>";
		else {
			$id = mysql_result( $rssql, 0, 0 );
			$del = "DELETE newsletter WHERE id = $id LIMIT 1";
			mysql_query( $del );
			$_SESSION['bilug_ok'] = "
				<div class=\"bilug-corretto\">Sei stato cancellato dalla nostra newsletter correttamente.</div>
				<div class=\"bilug-avvertimento\">Puoi reiscriverti alla nostra newsletter quando vuoi.</div>
				<h4><a href=\""._URLSITO."\">Clicca qui per tornare alla home</a></h4>	
			";
		}
	}
?>

<?php
if ( isset( $_SESSION['bilug_ok'] ) ) {
	echo $_SESSION['bilug_ok'];
	unset( $_SESSION['bilug_ok'] );
	unset( $_SESSION['bilug_errore'] );
}
elseif ( isset( $_SESSION['bilug_errore'] ) ) {
	echo $_SESSION['bilug_errore'];
	unset( $_SESSION['bilug_errore'] );
}
?>

<?php
if ( $mail == '' OR $code == '' ) {
	$mail = '';
	if ( isset( $_POST['canc_nw'] ) ) {
		$mail = apici( $_POST['mail'] );
		$captcha = (int)$_POST['captcha'];
		$cap_mail = apici( $_SESSION['cap_mail'] );
		
		if ( $cap_mail != $captcha ) $_SESSION['bilug_errore'] = "<div class=\"bilug-errore\">Codice captcha errato</div>";
		elseif ( $mail == '' ) $_SESSION['bilug_errore'] = "<div class=\"bilug-errore\">Inserire l'e-mail</div>";
		elseif ( !chkEmail1( $mail ) ) $_SESSION['bilug_errore'] = "<div class=\"bilug-errore\">La mail non &egrave; corretta</div>";
		else {
			$sql = "SELECT code FROM newsletter WHERE email = '$mail' LIMIT 1";
			$rssql = mysql_query( $sql );
			if ( mysql_num_rows( $rssql ) == 0 ) 
				$_SESSION['bilug_errore'] = "<div class=\"bilug-errore\">Non abbiamo trovato questa mail tra i nostri dati. Controlla che sia stata scritta nel modo corretto</div>";
		}
		
		if ( !isset( $_SESSION['bilug_errore'] ) ) {
			$from = _NOMENEWSLETTER;
			$destinatario = $mail;
			$mittente = $from;
			$sito = _SITO;
			$url_sito = _URLSITO;
			
			$code = mysql_result( $rssql, 0, 0 );
			$link = "$url_sito/cancellazione-newsletter.html?xvmailvx=$mail&acodeee=$code";
			
			$oggetto = "Cancellazione dalla newsletter dal sito $sito";
			
			$header = "From: $from \r\n";
			$header .="Reply-To: $mittente \r\n";
			$header .="X-Mailer : BiLugcms PHP/" . phpversion();
			
			$mail_body = "
Questo messaggio arriva dal sito $url_sito per la cancellazione dalla newsletter. \n\n

Clicca il link qui sotto per confermare la cancellazione. \n\n

$link \n\n

Oppure copia e incolla il link qui sotto sul browser \n\n

$link 
			";	

			if ( !mail( $destinatario, $oggetto, $mail_body, $header ) ) $_SESSION['bilug_errore'] = "<div class=\"bilug-errore\">Errore nell'invio mail</div>";
			else $_SESSION['bilug_ok'] = "<div class=\"bilug-corretto\">E' stata inviata un'e-mail al vostro indirizzo per la cancellazione alla newsletter.</div>";			
		}
	}

	?>

	<?php
	if ( isset( $_SESSION['bilug_ok'] ) ) {
		echo $_SESSION['bilug_ok'];
		unset( $_SESSION['bilug_ok'] );
		unset( $_SESSION['bilug_errore'] );
	}
	elseif ( isset( $_SESSION['bilug_errore'] ) ) {
		echo $_SESSION['bilug_errore'];
		unset( $_SESSION['bilug_errore'] );
	}
	?>


	<?php if ( !isset( $_SESSION['bilug_ok'] ) ) : ?>
		<div class="bilug-avvertimento">Inserisci la tua mail qui sotto. Ti invieremo una mail di conferma.</div>

		<div class="form">
			<form name="" method="post" action="" onsubmit="">
				<div class="form-campi">
					<label>Tua e-mail*: </label>
					<div class="form-input"><input class="textbox" type="text" name="mail" value="<?=$mail?>" /></div>
					<div class="azzerafloat"></div>
				</div>
				<div class="form-campi">
					<div class="form-input small-input"><img src="<?=_URLSITO?>/img/cap_mail.php" alt="CAPTCHA SYSTEM"/></div>
					<div class="form-input"><input class="textbox" type="text" name="captcha" value="" /></div>
					<div class="azzerafloat"></div>
				</div>
				<p>&nbsp;</p>
				<div class="form-campi">
					<div class="form-input"><input class="buttonbox" type="submit" name="canc_nw" value="Cancella" /></div>
					<div class="azzerafloat"></div>
				</div>		
			</form>
		</div>
	<?php else : ?>
		<h4><a href="<?=_URLSITO?>">Clicca qui per tornare alla home</a></h4>	
	<?php endif; ?>

<?php } ?>
