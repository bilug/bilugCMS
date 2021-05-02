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

include( "../utility/headers.php" );

$attivo = $_POST["attivo"];
$mail = $_POST["mail"];
$nome = $_POST["nome"];

if ( isset( $_POST["check_privacy"] ) AND $_POST["check_privacy"] == 'ok' ) {
	$inizio = substr( $mail, 0, 1 ); 
	if ( chkEmail1( $mail ) OR trim( $nome ) == '' ) {
		// se $attivo è SI, allora siamo in fase di inserimento
		if ( $attivo == 'SI' ) {
			$invio=false;
			$str="select stato from newsletter where email like '$mail'";	
			$risultato = mysql_query($str);
				 
			if ( mysql_num_rows( $risultato ) == 0 ) {
				//non esiste quindi lo si puo' inserire
				// creo codice random
				$code = hash( 'md5', mt_rand() . hash( 'md5', $mail ) );				
				$str="INSERT INTO newsletter ( email, code, gruppo, nome ) VALUES ( '$mail', '$code', 1, '$nome' )";
				$risultato = mysql_query( $str );
					
				// controllo se la query di inserimento è andata a buon fine
				if ( !$risultato )
					$msg = "Email non inserita nel DataBase";   	  	
				else
					$invio = true;
			}
			else {
				$controllo = mysql_fetch_row( $risultato );
				if ( $controllo[0] != -1 )
					$msg = "Indirizzo Email gia\' inserito";
				else {
					$code = hash( 'md5', mt_rand() . hash( 'md5', $mail) );
					$str = "UPDATE newsletter SET code = '$code' WHERE email = '$mail' LIMIT 1";
					// query di Aggiornamento
					$risultato=mysql_query($str);
						
					// controllo se la query di aggiornamento è andata a buon fine
					if (!$risultato)            	
						$msg = "Codice Email non aggiornato";   	  	
					else
						$invio = true;
				}
			}
			if ( $invio ) {		
					$oggetto = "Verifica Email di " . $_SERVER['SERVER_NAME'];
				
					$link = "http://".$_SERVER['SERVER_NAME'].'/index.php?pag=newsletter_ver.php&amp;s=a&amp;e='.$mail.'&amp;c='.$code;
					
					
					/*
					 * 	PEZZO IN PIÙ DA AGGIUNGERE ALL'INFORMATIVA DELLA PRIVACY
					 * 
					 *						Per rimuovere il proprio indirizzo dalla newsletter
						<a href=\"\">cliccare qui</a>.
						<br /><br />
 
					 * */
					 
					$body = "
						OGGETTO: Verifica Email per la Newsletter di: ".$_SERVER['SERVER_NAME']."<br/><br/>
						Per completare la registrazione vai a questo link <br /><br />
						--------------------------------------------------------------------------<br />
						<a href=\"$link\">$link</a><br />
						--------------------------------------------------------------------------<br /><br />
						in caso non funzioni copia e incolla nel browser il seguente link:<br/><br />
						--------------------------------------------------------------------------<br />
						$link<br />
						--------------------------------------------------------------------------<br />
						<br /><br /><br />
						In riferimento al Dlgs 196/2003: Tutela delle persone e di altri soggetti rispetto 
						al trattamento dei dati personali; gli indirizzi e-mail presenti nel nostro archivio provengono o da richieste di 
						iscrizioni pervenute al nostro recapito o da elenchi e servizi di pubblico dominio pubblicati in Internet, 
						da dove sono stati prelevati.
					";

					$header = "From: webmaster@".$_SERVER['SERVER_NAME']." \n";
					$header .= "X-Mailer: BiLugCMS PHP/" . phpversion() . "\n";
					$header .= "MIME-Version: 1.0" . "\n";
					$header .= "Content-type:  text/html; charset=iso-8859-1" . "\r\n";
					
					if (mail( $mail, $oggetto, $body, $header))
						$msg = "Indirizzo email inserito correttamente. e\' stata inviata un'e-mail per confermare l'iscrizione";
					else 
						$msg = "indirizzo email inserito correttamente. Problemi con invio Email";         
			
			}
		}
		// se $attivo è NO, allora siamo in fase di cancellazione
		else {
			$str="SELECT code FROM newsletter WHERE email = '$mail' LIMIT 1";
			$risultato=mysql_query($str);	   
			if (mysql_num_rows($risultato) == 0)
				$msg = "Email non presente nel DataBase";
			else {	
				$oggetto = "Verifica Email di " . $_SERVER['SERVER_NAME'];
				
				$code = mysql_fetch_row($risultato);
				$link = "http://".$_SERVER['SERVER_NAME'].'/index.php?pag=newsletter_ver.php&amp;s=d&amp;e='.$mail.'&amp;c='.$code[0];
				$body = "
					OGGETTO: Verifica Email per la Newsletter di:".$_SERVER['SERVER_NAME']."<br /><br />
					Per completare la cancellazione vai a questo link <br /><br />
					--------------------------------------------------------------------------<br />
					<a href=\"$link\">$link</a><br />
					--------------------------------------------------------------------------<br /><br />
					in caso non funzioni copia e incolla nel browser il seguente link:<br /><br />
					--------------------------------------------------------------------------<br />
					$link<br />
					--------------------------------------------------------------------------<br/>
				";
					
				$header = "From: webmaster@".$_SERVER['SERVER_NAME']." \n";
				$header .= "X-Mailer: BiLugCMS PHP/" . phpversion() . "\n";
				$header .= "MIME-Version: 1.0" . "\n";
				$header .= "Content-type:  text/html; charset=utf-8" . "\r\n";
						
				if (mail( $mail, $oggetto, $body, $header))
					$msg = "Inviata un email per confermare la cancellazione";
				else 
					$msg = "Problemi con invio Email di conferma";
			}
		}

		confirm( $msg );
		echo "<meta http-equiv=\"refresh\" content=\"0;url=index.php\" />";
	}
	else
		echo "<meta http-equiv=\"refresh\" content=\"0;url=index.php\" />";
}
else {
	$msg = "Prendere visione della nota informativa sulla privacy";
	confirm($msg);
	echo "<meta http-equiv=\"refresh\" content=\"0;url=index.php\" />";
}

?>
