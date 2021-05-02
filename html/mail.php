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
/*
questo è il modulo di invio che serve per inviare l'email ad un destinatario a scelta tra quelli dell'elenco, è possibile in ogni momento aggiungere o togliere undestinatario, l'importante è che si facciano coincidere i dati del modulo con quelli dello script di invio.


qua c'è la spiegazione del singolo tag per un destinatario:
<option value="id_destinatario"> NOME DESTINATARIO

id_destinatario: è un id qualsiasi che si fornisce al destinatario, è importante che sia IDENTICO a quello inserito nello script di invio
NOME DESTINATARIO: è il nome che comparirà nel menu a tendina del modulo di invio, il maiuscolo è consigliato per fini estetici

NB: i nomi dei destinari devono essere comprensibili per gli utenti, ad esempio, se io ho tre email: webmaster, forum e php per far capire agli utenti a chi stanno inviando le email potrò mettere rispettivamente ADMIN, FORUM e SEZIONE PHP (è un esempio)


il modulo è stato creato per prevenire i problemi di spam legati alla pubblicazione degli indirizzi email, non dobbiamo però sottovalutare il problema degli spambot che mirano un modulo e lo tartassano di informazioni, per questo ho integrato un sistema di captcha da me creato perfettamente configurato per l'utilizzo con questo script (leggi informazioni nel file cap_mail.php per saperne di più sul captcha)

*/
?>


<?php

switch( $lingua_query ) {
	case 'it':
		$SCRIVI_A = 'Scrivi a';
		$MITTENTE = 'MITTENTE';
		$DESTINATARIO = 'DESTINATARIO';
		$OGGETTO = 'OGGETTO';
		$TESTO = 'TESTO';
		$DA_COMPLETARE = 'DA COMPLETARE';
		$RISULTATO = 'RISULTATO DELL\'OPERAZIONE';
		$INVIA = 'INVIA MAIL';
		$CANCELLA = 'CANCELLA';
	break;
	case 'en':
		$SCRIVI_A = 'Write to';
		$MITTENTE = 'SENDER';
		$DESTINATARIO = 'CONSIGNEE';
		$OGGETTO = 'OBJECT';
		$TESTO = 'TEXT';
		$DA_COMPLETARE = 'To fill';
		$RISULTATO = 'COMPUTATION RESULT';
		$INVIA = 'SEND EMAIL';
		$CANCELLA = 'DELETE';
	break;
	case 'fr':
		$SCRIVI_A = '&Eacute;crire &agrave;';
		$MITTENTE = 'EXP&Eacute;DITEUR';
		$DESTINATARIO = 'B&Eacute;N&Eacute;FICIAIRE';
		$OGGETTO = 'OBJET';
		$TESTO = 'TEXTE';
		$DA_COMPLETARE = 'A REMPLIR';
		$RISULTATO = 'R&Eacute;SULTAT D\'EXPLOITATION';
		$INVIA = 'ENVOYER MAIL';
		$CANCELLA = 'EFFACER';
	break;
	case 'de':
		$SCRIVI_A = 'Kontaktformular';
		$MITTENTE = 'ABSENDER';
		$DESTINATARIO = 'EMPF&Auml;NGER';
		$OGGETTO = 'BETREFF';
		$TESTO = 'NACHRICHT';
		$DA_COMPLETARE = 'Bitte ausfullen';
		$RISULTATO = 'ERGEBNIS';
		$INVIA = 'MAIL SENDEN';
		$CANCELLA = 'MAIL L&Ouml;SCHEN';
	break;
	case 'es':
		$SCRIVI_A = 'Escribir a';
		$MITTENTE = 'REMITENTE';
		$DESTINATARIO = 'BENEFICIARIO';
		$OGGETTO = 'OBJETO';
		$TESTO = 'TEXTO';
		$DA_COMPLETARE = 'PARA SER LLENADO';
		$RISULTATO = 'RESULTADO DE LA OPERACI&Oacute;N';
		$INVIA = 'ENVIAR MAIL';
		$CANCELLA = 'CLEAR';
	break;
	case 'pt':
		$SCRIVI_A = 'Escreva para';
		$MITTENTE = 'SENDER';
		$DESTINATARIO = 'BENEFICI&Aacute;RIO';
		$OGGETTO = 'oBJETO';
		$TESTO = 'TEXTO';
		$DA_COMPLETARE = 'A PREENCHER';
		$RISULTATO = 'RESULTADO DA OPERA&Ccedil;&Atilde;O';
		$INVIA = 'ENVIAR MAIL';
		$CANCELLA = 'LIMPAR';
	break;
}

?>

<script type="text/javascript">

/*abilitare il tasto invia*/
function abilita()
{
	var mit = $("#mit").html();
	var og = $("#og").html();
	var tes = $("#tes").html();

	if(mit=='<img src=\"<?=_URLSITO?>/img/ok.png\" class=\"ico\">' && mit==og && mit==tes)
	{
		$("input[value=INVIA]").attr("disabled", false);
	}
	else
	{
		$("input[value=INVIA]").attr("disabled", true);
	}
}

/*evidenzio la text selezionata*/
$(function(){	
	$(":text").bind("focus blur", {}, function (event) {
            if (event.type == "focus") {
                $(this).css(event.data);
            } else {
                $(this).css("background-color","");
            }
    	});
	$("textarea").bind("focus blur", {}, function (event) {
            if (event.type == "focus") {
                $(this).css(event.data);
            } else {
                $(this).css("background-color","");
            }
    	});
abilita();
});

/*controllomail*/
function controllomail(){
	var mail = $("input[name=mittente]").val();
	var espressione = /^[_a-z0-9+-]+(\.[_a-z0-9+-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)+$/;
	if (!espressione.test(mail))
	{
	    	$("input[name=mittente]").css("color","red");
		$("#mit").html("<img src='<?=_URLSITO?>/img/del.png' class='ico'>");
	}
	else
		{
			$("input[name=mittente]").css("color","green");
			$("#mit").html("<img src='<?=_URLSITO?>/img/ok.png' class='ico'>");
		}
abilita();
}

function contr(id)
{
	var x = "#" + id;
	if(id=='og')
	{
		var valore = $("input[name=oggetto]").val();
		if(valore!="")
		{
			$(x).html("<img src='<?=_URLSITO?>/img/ok.png' class='ico'>");
		}
		else
		{
			$(x).text("<?=$DA_COMPLETARE?>").css("color","red");
		}
	}
	if(id=='tes')
	{
		var valore = $("textarea").val();
		if(valore!="")
		{
			$(x).html("<img src='<?=_URLSITO?>/img/ok.png' class='ico'>")
		}
		else
		{
			$(x).text("<?=$DA_COMPLETARE?>").css("color","red");
		}
	}
abilita();	
}

/*controllo al caricamento*/
$(document).ready(function() {
var mail = $("input[name=mittente]").val();
	var espressione = /^[_a-z0-9+-]+(\.[_a-z0-9+-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)+$/;
	if (!espressione.test(mail))
	{
		$("#mit").text("<?=$DA_COMPLETARE?>").css("color","red");
	}
	else
		{
			$("input[name=mittente]").css("color","green");
			$("#mit").html("<img src='<?=_URLSITO?>/img/ok.png' class='ico'>");
		}

	if($("input[name=mittente]").val()!='')
	{
		$("#og").html("<img src='<?=_URLSITO?>/img/ok.png' class='ico'>")
	}
	if($("textarea").val()!='')
	{
		$("#tes").html("<img src='<?=_URLSITO?>/img/ok.png' class='ico'>")
	}
abilita();
});

</script>


<h1>
	<span><?=$SCRIVI_A?> <?=_SITO?></span>
	<?=adm_link('contatti')?>
</h1>

<?php

//testa
$filetesta = "./custom/testaform.php";
if(file_exists($filetesta))
{
	$testa=fopen($filetesta,"r");
	$conttesta = fread($testa, filesize($filetesta));
	if($conttesta!="")
	{
			echo "<div class=\"contenitore\">";
				@include($filetesta);
			echo"</div><br>";
	}
	@fclose($testa);
}


$destinatario = form_sicuro($_POST["destinatario"],"","256"); //controllo delle var
$mittente = form_sicuro($_POST["mittente"],"","20"); //controllo delle var
$oggetto = form_sicuro($_POST["oggetto"],"","25"); //controllo delle var
$testo = form_sicuro($_POST["testo"],"","2008"); //controllo delle var
$captcha = form_sicuro($_POST["captcha"],"INTEGER,ONELINE,NOSPACE","5"); //controllo delle var



//variabile per il primo ingresso
$volta = $_POST['volta'];
//echo "$volta";

// avvia la sessione, importante per il sistema di captcha (vedi cap_mail.php)
	session_start();



if ( isset($_POST['invia_mail']) ) {
	// destinatario tutto in minuscolo prelevato dalla stringa di post
	$destinatario = $_POST['destinatario'];
	$str = "SELECT email FROM email WHERE ID='$destinatario' LIMIT 1";
	$risultato=mysql_query($str);
	if ( mysql_num_rows($risultato) > 0 ) {
		$control=mysql_fetch_row($risultato);
		$destinatario = $control[0];	
	}
	else
		$destinatario = "";	

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
	$site = $_SERVER['SCRIPT_FILENAME'];


	// controlli, tutti in un unico IF
	if ((!isset($destinatario)) || (!$destinatario) || (!isset($mittente)) || (!$mittente) || (!isset($testoc)) || (!$testoc) || (!isset($captcha)) || (!$captcha) || (!isset($real_cap)) || (!$real_cap) || (!isset($ip)) || (!$ip) || (!isset($ua)) || (!$ua) || (!isset($oggettog)) || (!$oggettog)) 
	{
			// nel caso in cui qualche controllo vada storto restituisce un errore
			echo"<div class=\"bilug-errore\">ERRORE, CONTROLLARE DI AVERE RIEMPITO TUTTI I CAMPI</div>";
			
	}
	else {
	// controlla se i codici coincidono
		if ($captcha != $real_cap) {
			echo"<div class=\"bilug-errore\">IL CODICE DI PROTEZIONE INSERITO NON E' CORRETTO</div>";		
		}
		else {
			// se è tutto ok manda l'email (o almeno ci prova)
			
			$mail_body = " OGGETTO: \n $oggetto \n\n TESTO DEL MESSAGGIO: \n $testoc \n\n EMAIL SPEDITA DA: $mittente \n DAL SITO $site \n TRAMITE IL MODULO DI INVIO EMAIL DA WEB \n I DATI DEL MITTENTE SONO SPECIFICATI QUI SOTTO: \n IP: $ip \n USER AGENT: $ua";

			//Verifico se il mittente e' un email o un nome e setto le intestazioni
			if (chkEmail1($mittente))
			{ 
				$header = "From: $mittente \r\n";
				$header .="Reply-To: $mittente \r\n";						
				$header .="X-Mailer : BiLugcms PHP/" . phpversion();

				// Processo di invio, con relativi avvisi di riuscito/mancato invio						 
				if (mail($destinatario, $oggetto, $mail_body, $header)) 
					echo "<div class=\"bilug-corretto\">EMAIL INVIATA</div>";
				else {
					echo "<div class=\"bilug-errore\">ERRORE DURANTE L'INVIO</div>";
					form($mittente, $oggetto, $testo);
				}

			}
			else
			{
					echo "<div class=\"bilug-errore\">MITTENTE ERRATO</div>";
					form($mittente, $oggetto, $testo);
			}

		}
	}
}


	

$str = "SELECT ID, nome FROM email ORDER BY ord";
$risultato=mysql_query($str);
if (mysql_num_rows($risultato)>0)
{
	$dati = array();
	while($control=mysql_fetch_row($risultato))
	{
		$dati[$control[0]]= "-  ".$control[1]."   -"; 
	}	
}
else
{
	echo "<h3>Nessuna Email Inserita a cui inviare</h3>";
	exit;
}


echo "
	
	<div class=\"contenitore\">
	<form id=\"email\" method=\"post\" action=\"\">
	<input type=\"hidden\" name=\"volta\" value=\"uno\" />
	<div class=\"azzerafloat\"></div>
	<div class=\"float140\">
	<div class=\"label\">$DESTINATARIO:</div>
	</div>
	<div class=\"float400\">";
	selezione("destinatario",$dati);
echo "
	</div>
	<div class=\"azzerafloat\"></div>
	<div class=\"float140\">
	<div class=\"label\">$MITTENTE (Email):</div>
	</div>
	<div class=\"float400\">&nbsp;&nbsp;&nbsp;
	<input type=\"text\" class=\"login\" name=\"mittente\" size=\"68\" value=\"$mittente\" onKeyup=\"controllomail()\" onChange=\"controllomail()\" onBlur=\"controllomail()\" onSelect=\"controllomail()\"/>
	</div>
<div class=\"float100\" id=\"mit\"><font color=red>$DA_COMPLETARE</font></div>
	<div class=\"azzerafloat\"></div>
	<div class=\"float140\">
	<div class=\"label\">$OGGETTO:</div>
	</div>
	<div class=\"float400\">&nbsp;&nbsp;&nbsp;
	<input type=\"text\" class=\"login\" name=\"oggetto\" size=\"68\" value=\"$oggetto\" onkeyup=\"contr('og')\"/>
	</div>
<div class=\"float100\" id=\"og\"><font color=red>$DA_COMPLETARE</font></div>
	<div class=\"azzerafloat\"></div>
	<div class=\"float140\">
	<div class=\"label\">$TESTO:</div>
	</div>
	<div class=\"float400\">&nbsp;&nbsp;&nbsp;
	<textarea name=\"testo\" cols=\"60\" rows=\"5\" onkeyup=\"contr('tes')\">$testo</textarea>
	</div>
<div class=\"float100\" id=\"tes\" style=\"padding-top: 45px;\"><font color=red>$DA_COMPLETARE</font></div>
	<div class=\"azzerafloat\"></div>
	<br /><br />
	<div class=\"float140\" style=\"float:left; margin-top:16px;\"><img src=\""._URLSITO."/img/cap_mail.php\" alt=\"CAPTCHA SYSTEM\"/></div>
	<div class=\"float400\"><b>$RISULTATO:</b><br /><br />
	<input type=\"text\" class=\"login\" name=\"captcha\" size=\"15\" maxlength=\"5\"/>
	<br /><br /></div>
  
	<div class=\"azzerafloat\"></div>
	<div class=\"float140\">&nbsp;</div>
	<div class=\"float400\">
		<input type=\"submit\" class=\"medio\" name=\"invia_mail\" value=\"$INVIA\" />
		<input type=\"reset\" class=\"medio\" name=\"cancella\" value=\"$CANCELLA\" />
	</div>
	<div class=\"azzerafloat\"></div>
  
	</form>
	</div>";


//piede
$filepiede= "./custom/piedeform.php";
if(file_exists($filepiede)) {
	$piede=fopen($filepiede,"r");
	$contpiede = fread($piede, filesize($filepiede));
	if($contpiede!="")
	{
			echo "<br><div class=\"contenitore\">";
				@include($filepiede);
			echo"</div>";
	}
	@fclose($piede);
}
?>
