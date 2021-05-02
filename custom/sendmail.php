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
require_once("../utility/alert.php"); 
require_once("../utility/funzioni.php");
require_once("../utility/connessione.php");
require_once("../utility/secureform.php");

$destinatario = form_sicuro($_POST["destinatario"],"","256"); //controllo delle var
$mittente = form_sicuro($_POST["$mittente"],"","20"); //controllo delle var
$oggetto = form_sicuro($_POST["$oggetto"],"","25"); //controllo delle var
$testo = form_sicuro($_POST["$testo"],"","2008"); //controllo delle var
$captcha = form_sicuro($_POST['captcha'],"INTEGER,ONELINE,NOSPACE","5"); //controllo delle var



/*
coded by Remotes (www.remotes.it)

arriviamo al cuore dello script, questo file si incarica di riconoscere il destinatario, di fare tutta una serie di controlli e di spedire l'email, seguite i commenti successivi per capirne meglio il funzionamento

il codice qua sotto è nato dopo svariate modifiche al codice creato da ALBERTO GIULIANI (www.agwebsolutions.it) per l'invio delle email in formato html dal web
*/

// avvia la sessione, importante per il sistema di captcha (vedi cap_mail.php)
session_start();


// destinatario tutto in minuscolo prelevato dalla stringa di post
$destinatario = $_POST['destinatario'];
$str= "SELECT email from email where ID='$destinatario'";
$risultato=mysql_query($str);
if (mysql_num_rows($risultato)>0)
{
	$control=mysql_fetch_row($risultato);
	$destinatario = $control[0];	
}
else
{
	$destinatario ="";	
}	
// qui associa le variabili utilizzate nello script alle variabili di post facendo le dovute modifiche (alcune serviranno per verificare che non ci siano valori non validi)
$mittente = $_POST['mittente'];
$testoc = trim(strip_tags($_POST['testo']));
//$testo = nl2br(strip_tags($_POST['testo']));
$oggetto = strip_tags($_POST['oggetto']);
$oggettog = trim(strip_tags($_POST['oggetto']));
$captcha = $_POST['captcha'];
$real_cap = $_SESSION['cap_mail'];
$ip = $_SERVER['REMOTE_ADDR'];
$ua = $_SERVER['HTTP_USER_AGENT'];


// controlli, tutti in un unico IF
if ((!isset($destinatario)) || (!$destinatario) || (!isset($mittente)) || (!$mittente) || (!isset($testoc)) || (!$testoc) || (!isset($captcha)) || (!$captcha) || (!isset($real_cap)) || (!$real_cap) || (!isset($ip)) || (!$ip) || (!isset($ua)) || (!$ua) || (!isset($oggettog)) || (!$oggettog)) 
	{
	// nel caso in cui qualche controllo vada storto restituisce un errore
	$msg = "ERRORE, CONTROLLARE DI AVERE RIEMPITO TUTTI I CAMPI";
	
	}
else {
// controlla se i codici coincidono
		if ($captcha != $real_cap) 
		  {
		  		$msg = "IL CODICE DI PROTEZIONE INSERITO NON E' CORRETTO";		   
		  }
		// se è tutto ok manda l'email (o almeno ci prova)
		else {
				//solo per verifica remmare o eliminare da qui				
				//ini_set('SMTP','mail.vilnet.it');
				//echo "Porta: ".ini_set('smtp_port', '25');
				//echo "from": ".ini_set('sendmail_from', 'vilnet@vilnet.it');
				//echo ini_set('sendmail_path', '/usr/sbin/sendmail -t -i');
				
				//solo per verifica remmare o eliminare fin qui
																			
				$mail_body = " OGGETTO: \n $oggetto \n\n TESTO DEL MESSAGGIO: \n $testoc \n\n EMAIL SPEDITA DA: $mittente \n TRAMITE IL MODULO DI INVIO EMAIL DA WEB \n I DATI DEL MITTENTE SONO SPECIFICATI QUI SOTTO: \n IP: $ip \n USER AGENT: $ua";
				
				//Verifico se il mittente e' un email o un nome e setto le intestazioni
				if (chkEmail1($mittente))
				{
					$header = "From: $mittente \r\n";
					$header .="Reply-To: $mittente \r\n";
								
					$header .="X-Mailer : BiLugcms PHP/" . phpversion();
								
					// Intestazioni HTML
					//$mail_in_html = "MIME-Version: 1.0\r\n";
					//$mail_in_html .= "Content-type: text/html; charset=iso-8859-1\r\n";
				
					// Processo di invio, con relativi avvisi di riuscito/mancato invio				
								 
					if (mail($destinatario, $oggetto, $mail_body, $header)) 
					{
						$msg = "EMAIL INVIATA";
					}
					else 
					{
				  		$msg = "ERRORE DURANTE L'INVIO";
			   	}
			   }
				else
				{
					//$header = "From: $mittente@{$_SERVER['SERVER_NAME']} \r\n";
					//$header .="Reply-To: webmaster@{$_SERVER['SERVER_NAME']} \r\n";
					$msg = "EMAIL NON VALIDA REINSERIRE";
				} 
		}
}
header("Refresh: 0; url=../html/index.php?pag=../custom/mail.php");
confirm($msg);
?>

