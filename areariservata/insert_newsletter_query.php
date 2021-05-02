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
require_once("auth.php");

$soggetto = apici($_POST['soggetto']);
$testo = $_POST['testo'];
$gruppo_utente = $_POST['gruppo_utente'];
$lingua = $_POST['lingua'];

if (strlen($testo)<=6)
{
	$tipoerr="ERRORE: NON HAI SCRITTO NULLA";
   echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_newsletter.php&errore=si&tipoerr=$tipoerr&soggetto=$soggetto&testo=$testo\" />";
}


if ( $gruppo_utente == 0 ) {
		$tipoerr="ERRORE: INSERIRE IL GRUPPO DI DESTINAZIONE";
		echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_newsletter.php&errore=si&tipoerr=$tipoerr&soggetto=$soggetto&testo=$testo\" />";
}
else {
	if ( $gruppo_utente == 1 )
		$str = "SELECT email FROM newsletter WHERE stato = 0 AND id_lingua = $lingua";
	else	
		$str = "SELECT email FROM newsletter WHERE stato = 0 AND gruppo = $gruppo_utente AND id_lingua = $lingua";

	// query email
	$risultato=mysql_query($str);
	if (mysql_num_rows($risultato)>0) {					   
		$mail ="";
		while($control=mysql_fetch_row($risultato))
		{
			if ($mail != "") $mail .= ",";
			$mail .= $control[0]; 		
		}
		// recupero informazioni inserite
		$body = stripslashes($testo);
		$body = str_ireplace("src=\"/","src=\"http://".$_SERVER['SERVER_NAME']."/",$body);
		$body = str_ireplace("href=\"/","href=\"http://".$_SERVER['SERVER_NAME']."/",$body);
		
		//preparazione struttura corpo email
		
		//lettura dell'intestazione base dell'email
		$filename = "../custom/templatemail.html";
		$handle = fopen($filename, "r");
		$corpoemail = fread($handle, filesize($filename));
		fclose($handle);			
		$corpoemail = str_replace("src=\"..", "src=\"http://".$_SERVER['SERVER_NAME'],$corpoemail);
		if (strpos($corpoemail,"<versione>")!== false)
		{
			$corpoemail = str_replace("<versione>",$versione,$corpoemail);
		}    		
		// lettura del logo personalizzato
		if (strpos($corpoemail,"<logo>")!== false) {
			$filename = "../html/intestazione.php";
			$handle = fopen($filename, "r");
			$contenuto = fread($handle, filesize($filename));
			fclose($handle);
			$contenuto = substr($contenuto,strpos($contenuto,"?>")+2);
			//$contenuto = str_replace("src=\"..", "style=\"width: auto; height: auto;\" src=\"http://".$_SERVER['SERVER_NAME'],$contenuto);
			$contenuto = str_replace("src=\"<?=_URLSITO?>", "style=\"width: auto; height: auto;\" src=\"<?=_URLSITO?>", $contenuto);
			$contenuto = str_replace("href=\"./", "href=\"http://".$_SERVER['SERVER_NAME'], $contenuto);
			$contenuto = str_replace("href=\"/", "href=\"http://".$_SERVER['SERVER_NAME'], $contenuto);
			$contenuto = str_replace('<?=_TEMPLATE?>', _TEMPLATE, $contenuto);
			$contenuto = str_replace('<?=_URLSITO?>', _URLSITO, $contenuto);
			$contenuto = str_replace('<?=_SITO?>', _SITO, $contenuto);
			$contenuto = str_replace("index.php", "http://".$_SERVER['SERVER_NAME'],$contenuto);
			$corpoemail = str_replace("<logo>",$contenuto,$corpoemail);
		}
		// lettura del piede personalizzato
		if (strpos($corpoemail,"<piede>")!== false)
		{
			$filename = "../html/index_piedipagina.php";
			$handle = fopen($filename, "r");
			$contenuto = fread($handle, filesize($filename));
			fclose($handle);
			$contenuto = substr($contenuto,strpos($contenuto,"?>")+2);
			$contenuto = str_replace("src=\"..", "src=\"http://".$_SERVER['SERVER_NAME'],$contenuto);
			$contenuto = str_replace('<?=_PIEDIPAGINA?>', _PIEDIPAGINA, $contenuto);
			$link = rurl(0, 'newsletter-cancellazione');
			$piede = "<p><i>Se non vuoi pi&ugrave; ricevere e-mail da questo sito, <a href=\"$link\">clicca qui</a> per la cancellazione.<i></p>";
			$corpoemail = str_replace("<piede>",$piede.$contenuto,$corpoemail);
		}
		
		$corpoemail = str_replace("<corpo>",$body,$corpoemail);
		 
		$header = "From: " . _NOMENEWSLETTER . "\n";
		$header .= "Bcc: " . $mail . "\n";
		$header .= "MIME-Version: 1.0" . "\n";
		$header .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
		$header .= "X-Mailer: BiLugCMS PHP/" . phpversion();
		
		$body = $corpoemail;
		$messaggio .= "
			<html>
				<head><title>Newsletter ".$_SERVER['SERVER_NAME']."</title></head>
				<body>$body</body>
			</html>
		";
		
		if ( $soggetto == "" ) $soggetto = "Email dalla Newsletter di ".$_SERVER['SERVER_NAME'];
	
		if ( mail( '', $soggetto, stripslashes($messaggio), $header) ) {
				//Header("Location: ");
				echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=conferma.php&from=insert_newsletter.php\" />";
		}
		else {
			$tipoerr="ERRORE: EMAIL NON INVIATE";
			//echo "ERRORE: EMAIL NON INVIATE";
			//echo "<br /><a href=\"area.php?pag=insert_newsletter.php\">Riprova</a>";
			echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_newsletter.php&errore=si&tipoerr=$tipoerr&soggetto=$soggetto&testo=$testo\" />";
		}
	}
	else {	  	
			$tipoerr="ERRORE: NESSUN INSCRITTO ALLA NEWSLETTER";
			echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_newsletter.php&errore=si&tipoerr=$tipoerr&soggetto=$soggetto&testo=$testo\" />";
	}
}	
?>
