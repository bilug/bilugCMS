<?php

$max_giorni = _ECOMMERCE_RESO_MAX_GIORNI;

if ( isset($_POST['enter']) ) {
	$codice = apici($_POST['codice']);
	
	$err = '';
	
	$sql = "SELECT *, DATE_FORMAT(data, '%d/%m/%Y') AS data_acquisto FROM acquisti WHERE utente = '$codice' AND (TO_DAYS(NOW()) - TO_DAYS(data)) <= $max_giorni";
	$rssql = mysql_query($sql);

	$sql = "SELECT id FROM acquisti WHERE utente = '$codice' AND reso = 1 LIMIT 1";
	$rssql2 = mysql_query($sql);	
	
	$utente = mysql_result($rssql, 0, 'utente');
	$nome = mysql_result($rssql, 0, 'nome');
	$cognome = mysql_result($rssql, 0, 'cognome');
	$cap = mysql_result($rssql, 0, 'cap');
	$indirizzo = mysql_result($rssql, 0, 'indirizzo');
	$citta = mysql_result($rssql, 0, 'citta');
	$mail = mysql_result($rssql, 0, 'mail');
	$data_acquisto = mysql_result($rssql, 0, 'data_acquisto');
	$importo = mysql_result($rssql, 0, 'importo');
	$spedizione = mysql_result($rssql, 0, 'spedizione');
	
	if ( mysql_num_rows($rssql) == 0 ) $err = "<div class=\"bilug-errore\">Il codice inserito non &egrave; corretto oppure &egrave; passato troppo tempo per la richiesta del reso.</div>";
	elseif ( mysql_num_rows($rssql2) == 1 ) $err = "<div class=\"bilug-errore\">E' gi&agrave; in corso una pratica di reso con questo codice.</div>";
	else {
		$sql = "SELECT id, articolo, codice, prezzo FROM acquisti WHERE utente = '$codice' AND reso = 0";
		$rssql2 = mysql_query($sql);	
	}
}

if ( isset($_POST['invio-reso']) ) {
	$codice = apici($_POST['codice']);
	$descrizione = apici($_POST['descrizione']);
	$tipo_rimborso = apici($_POST['tipo_rimborso']);
	$informazioni = apici($_POST['informazioni']);
	$art = $_POST['art'];
	
	$err2 = '';
	
	if ( count($art) <= 0 ) $err2 = "<div class=\"bilug-errore\">Selezione gli articoli di cui effettuare il reso</div>";
	elseif ( $tipo_rimborso == '' ) $err2 = "<div class=\"bilug-errore\">Indicare il tipo di rimborso che si vuole ricevere</div>";
	elseif ( $descrizione == '' ) $err2 = "<div class=\"bilug-errore\">Indicare il motivo del reso</div>";
	
	if ( $err2 == '' ) {
		$art = implode(',', $art);
		$sql = "SELECT articolo, codice, prezzo FROM acquisti WHERE id IN ($art) AND utente = '$codice' AND reso = 0";
		$rssql = mysql_query($sql);

		$reso_tot = 0;
		$articoli = "";
		while( $r = mysql_fetch_row($rssql) ){
			$articoli .= "$r[0] \t $r[1] \t $r[2] euro \n";
			$reso_tot += $r[2];
		}		
		
		$ven = "SELECT email FROM email WHERE nome = 'Ecommerce' LIMIT 1";
		$rsven = mysql_query($ven);
		$venditore = mysql_result($rsven, 0, 0);

		$header = "From: $venditore \r\n";
		$header .="X-Mailer : BiLugcms PHP/" . phpversion();	
		
		$oggetto = "Richiesta reso da $utente";
		$mail_body = " 
			OGGETTO: \n $oggetto \n\n 
			DATI DELL'ORDINE: \n 
			Nome: $nome \n 
			Cognome: $cognome \n 
			Codice transazione: $utente \n 
			Email compratore: $mail \n 
			Indirizzo compratore: $indirizzo \n 
			CAP: $cap \n 
			Citta': $citta \n\n 
			
			Importo da restituire: $reso_tot euro \n\n 
			
			Tipo di rimborso: $tipo_rimborso \n
			Informazioni extra: \n $informazioni \n\n
		";
		
		if ( $descrizione != '' ) {
			$mail_body .= "Motivo del reso \n $descrizione \n\n";
		}
		
		$mail_body .= "Articoli da rendere: \n $articoli \n\n";
		
		mail($venditore, $oggetto, $mail_body, $header);
		
		mysql_query("UPDATE acquisti SET reso = 1 WHERE id IN ($art) AND utente = '$codice'");
		
		$oggetto = "Richiesta reso da $utente";
		$mail_body = " 
			OGGETTO: \n $oggetto \n\n 
			
			Abbiamo ricevuto la sua richiesta di reso per i seguenti articoli: \n $articoli \n\n
			
			L'importo totale e' di $reso_tot euro, che ricevera' non appena ricevermo gli articoli di cui sta effettuando il reso. \n\n
			
			Le spese di spedizione saranno a suo carico \n\n
			
			Grazie per aver utilizzato il nostro servizio,\n
			Staff "._SITO."
		";
		mail($mail, $oggetto, $mail_body, $header);
		
		$err3 = "<div class=\"bilug-corretto\">La richiesta di reso &egrave; avvenuta con successo. Riceverai un'e-mail con la conferma dell'operazione.</div>";
	}
}

?>

<?php breadcrumbs( array(
	'Home' => _URLSITO,
	'E-commerce' => _URLSITO.'/ecommerce/',
	'Reso' => ''
) ); ?>

<h1><span>Reso degli articoli</span></h1>

<div class="contenitore">
	<?php if ( $err != '' ) echo $err; ?>
	<?php if ( $err2 != '' ) echo $err2; ?>

	<?php if ( !isset($err3) ) : ?>
		<?php if ( !isset($_POST['enter']) OR (isset($_POST['enter']) AND $err != '') ) : ?>
			<form class="" action="" method="post">		
				<p>
					Inserisci il codice della transazione : <br>
					<input type="text" class="" name="codice" size="80" value="">
				</p>
				<p>
					<input type="submit" name="enter" value="Invia"> 
				</p>
			</form>
		<?php else : ?>
			<h2>ID utente: <small><?=$utente?></small></h2>
			<p><strong>Nome e cognome:</strong> <?=$nome?> <?=$cognome?></p>
			<p><strong>E-mail:</strong> <?=$mail?><p>
			<p><strong>Indirizzo:</strong> <?=$indirizzo?> - <?=$citta?>, <?=$cap?><p>
			<p><strong>Data acquisto:</strong> <?=$data_acquisto?><p>
			<p><strong>Totale acquisti:</strong> <?=$importo?> &euro;<p>
			<p><strong>Spese di spedizione:</strong> <?=$spedizione?> &euro;<p>
			
			<p>&nbsp;</p>
			
			<h4>Selezionare gli articoli di cui effettuare il reso *</h4>
			<form class="myform-reso" action="" method="post">
				<input type="hidden" name="enter" value="">
				<input type="hidden" name="codice" value="<?=$codice?>">
				<table class="table table-striped">
					<thead>
						<tr>
							<th><input type="checkbox" class="check-all"></th>
							<th>Codice</th>
							<th>Articolo</th>
							<th>Prezzo</th>
						</tr>
					</thead>
				<?php while( $r = mysql_fetch_row($rssql2) ) : ?>
						<tr>
							<td><input type="checkbox" name="art[]" value="<?=$r[0]?>"></td>
							<td><?=$r[1]?></td>
							<td><?=$r[2]?></td>
							<td><?=$r[3]?> &euro;</td>
						</tr>
				<?php endwhile ; ?>
				</table>
				
				<h4>Volete ricevere il rimborso tramite bonifico bancario o assegno? *</h4>
				<p>Indicare le informazioni aggiuntive nel box qui sotto. <br>In caso di assegno indicare l'indirizzo, se 
				diverso dai dati da lei inseriti in precendenza.  <br>Se con bonifico indicare le coordinate bancarie (IBAN).
				 <br>Queste informazioni sono necessarie per poter effettuare il reso.</p>
				<p>
					<select name="tipo_rimborso">
						<option value="">--------</option>
						<option value="Bonifico bancario">Bonifico bancario</option>
						<option value="Assegno">Assegno</option>
					</select>
				</p>
				<p><textarea name="informazioni" rows="7" cols="80" placeholder="Indicare qui le informazioni extra."><?=$informazioni?></textarea></p>
				
				<p>&nbsp;</p>
				
				<h4>Indica il motivo del reso *</h4>
				<p>Una breve descrizione potrebbe aiutare il nostro sistema nel miglioramento del servizio.</p>
				<p><textarea name="descrizione" rows="7" cols="80" placeholder="Bastano poche righe..."><?=$descrizione?></textarea></p>
				
				<p>&nbsp;</p>
				
				<p><input type="submit" name="invio-reso" value="Invia la richiesta di reso"></p>
				
			</form>

			<script>
				// Checco tutte le checkbox di un form myform
				$(document).delegate('.check-all', 'change', function(){
					if ( $(this).prop('checked') ) {
						$('.myform-reso :checkbox').prop('checked', true);
					}
					else {
						$('.myform-reso :checkbox').prop('checked', false);
					}
				});			
			</script>
		<?php endif ; ?>
	<?php else : echo $err3; ?>
		<meta http-equiv="refresh" content="0;url=<?=rurl(0, 'ecommerce')?>">
	<?php endif ; ?>
</div>