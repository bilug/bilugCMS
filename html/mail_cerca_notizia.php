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

session_start();

require_once("../utility/connessione.php");
require_once("../utility/funzioni.php");
require_once("../custom/costanti.php");

$cerca = apici( $_POST['c'] );

$nome = apici( $_POST['nome'] );
$mail = apici( $_POST['mail'] );
$testo = apici( $_POST['testo'] );
$captcha = apici( $_POST['captcha'] );
$cap_mail = apici( $_SESSION['cap_mail'] );

if ( $cap_mail != $captcha ) $_SESSION['bilug_errore'] = "<div class=\"bilug-errore\">Codice captcha errato</div>";
elseif ( $nome == '' OR $mail == '' OR $testo == '' ) $_SESSION['bilug_errore'] = "<div class=\"bilug-errore\">Inserire tutti i campi</div>";
elseif ( !chkEmail1( $mail ) ) $_SESSION['bilug_errore'] = "<div class=\"bilug-errore\">La mail non &egrave; corretta</div>";

if ( !isset( $_SESSION['bilug_errore'] ) ) {
	$sql = "SELECT email FROM email ORDER BY ord ASC LIMIT 1";
	$rssql = mysql_query( $sql );
	
	$from = "cerca-noreply@" . str_replace( array('http://www.', 'https://www.'), '', _URLSITO );
	$destinatario = mysql_result( $rssql, 0, 0 );
	$mittente = $mail;
	
	$oggetto = "$nome sta cercando una notiza sul sito";
	
	$header = "From: $from \r\n";
	$header .="Reply-To: $from \r\n";
	$header .="X-Mailer : BiLugcms PHP/" . phpversion();
	
	$mail_body = "
Messaggio da $mittente\n\n

$testo
	";
	
	if ( !mail( $destinatario, $oggetto, $mail_body, $header ) ) $_SESSION['bilug_errore'] = "<div class=\"bilug-errore\">Errore nell'invio mail</div>";
	else $_SESSION['bilug_ok'] = "<div class=\"bilug-corretto\">E-mail inviata correttamente</div>";
}

$link = rurl( 0, 'cerca' );
header( "Location: $link?c=$cerca" );

?>