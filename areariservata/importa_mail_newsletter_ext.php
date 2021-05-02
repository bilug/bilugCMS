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

	$mails = trim( $_POST['mails'] );
	$mails = nl2br( $mails );
	$mails = str_replace( '<br>', '<br />', $mails );
	$mails = str_replace( '<br />', ',', $mails );
	
	$gruppo = $_POST['gruppo'];
	$lingua = $_POST['lingua'];
	
	if ( $mails != '' AND $gruppo > 0 ) {
		$mails = explode( ',', $mails );
		$email_tot = '';
		
		foreach( $mails as $value ) {
			$value = trim( $value );
			$value = str_replace( ',', '', $value );
			if ( !chkEmail1( $value ) )
				continue;
				
			$sql = "SELECT id FROM newsletter WHERE email = '$value' LIMIT 1";
			if ( mysql_num_rows( mysql_query( $sql ) ) == 1 )
				continue;
			
			$code = hash('md5', mt_rand().hash('md5',"$value"));			
			$sql = "INSERT INTO newsletter ( email, code, gruppo, id_lingua, stato ) VALUES ( '$value', '$code', $gruppo, $lingua, 0 )";
			if ( !mysql_query( $sql ) ) {
				$msg = "Email non inserita nel DataBase";
				echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=elenco_newsletter.php\" />";
				confirm($msg);				
			}
			else
				$email_tot .= "$value,";
		}
		
		if ( $email_tot != '' ) {
			$msg = "Indirizzi e-mail inseriti ed inviati correttamente.";
			
			
			echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=elenco_newsletter.php\" />";
			confirm( $msg );
		}
		else {
			$msg = "Nessuna e-mail è stata inserita";
			echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=elenco_newsletter.php\" />";
			confirm( $msg );		
		}
	}
	else {
		$msg = "ERRORE: NON HAI INSERITO NESSUNA E-MAIL O NON HAI SELEZIONATO IL GRUPPO NEWSLETTER";
		echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=elenco_newsletter.php\" />";
		confirm( $msg );	
	}



?>


