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
$mail = mysql_real_escape_string( $_POST["mail"] );

if ( !chkEmail1( $mail ) ) {
	echo "<meta http-equiv=\"refresh\" content=\"0;url=index.php?pag=err1.php\" />";
	exit;
}

$inizio = substr($mail,0,1); 
if ($mail!="" AND $inizio!="/" AND $inizio!="<" AND stristr($mail, 'http://')==FALSE  AND stristr($mail, 'ftp://')==FALSE  AND stristr($mail, 'https://')==FALSE AND stristr($mail, '<script>')==FALSE AND stristr($mail, '<object>')==FALSE AND stristr($mail, '<applet>')==FALSE AND stristr($mail, '<embed>')==FALSE AND stristr($mail, '<%')==FALSE)
{
	if ($attivo=='SI')
	// se $attivo è SI, allora siamo in fase di inserimento
	{
				$str="INSERT INTO maillist (mail, attivo) VALUES ('$mail', '$attivo')";
				// query di inserimento
				$risultato=mysql_query($str);
				if (!$risultato)
				// controllo se la query di inserimento è andata a buon fine
					{
					//Header("Location: index.php?pag=err1.php");
					echo "<meta http-equiv=\"refresh\" content=\"0;url=index.php?pag=err1.php\" />";
					exit;
					// errore generico se nel DB non viene inserita la mail
					}
				else
					{
					//ini_set('SMTP','mail.vilnet.it');
					mail( "linux-subscribe@ml.bilug.linux.it", "subscribe", "Subscribe", "From: $mail\r\n");
					//Header("Location: index.php?pag=ok.php");
					echo "<meta http-equiv=\"refresh\" content=\"0;url=index.php?pag=ok.php\" />";
					exit;
					// conferma dell'inserimento della mail
					}
	}
	elseif ($attivo=='NO')
	// se $attivo è NO, allora siamo in fase di cancellazione
	{
			$str="UPDATE maillist SET attivo = 'NO' WHERE mail = '$mail'";
			// facciamo una query di cancellazione passando mail del record da cancellare
			$risultato=mysql_query($str);
				if (!$risultato)
				// controllo se la query di inserimento è andata a buon fine
					{
					//Header("Location: index.php?pag=err1.php");
					echo "<meta http-equiv=\"refresh\" content=\"0;url=index.php?pag=err1.php\" />";
					exit;
					// errore generico se nel DB non viene cancellata la mail
					}
				else
					{
					//ini_set('SMTP','mail.vilnet.it');
					mail( "linux-unsubscribe@ml.bilug.linux.it", "unsubscribe", "Unsubscribe", "From: $mail\r\n");				
					//Header("Location: index.php?pag=ok.php");
					echo "<meta http-equiv=\"refresh\" content=\"0;url=index.php?pag=ok.php\" />";
					exit;
					// conferma dell'eliminazione della mail
					}
	}
	else {
		//header("Refresh: 0; url=../html/index.php");
		echo "<meta http-equiv=\"refresh\" content=\"0;url="._URLSITO."\" />";
	}	
}
else {
	//header("Refresh: 0; url=../html/index.php");
	echo "<meta http-equiv=\"refresh\" content=\"0;url="._URLSITO."\" />";
}

?>
