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
<?error_reporting(0);
require_once("../utility/connessione.php");
require_once("../utility/secureform.php");
require_once("../utility/funzioni.php");
require_once("../utility/alert.php");
$email = form_sicuro(apici($_POST['Nomeutente']),"","256"); //controllo delle var
$pwd = form_sicuro(apici($_POST['Parola']),"","256"); //controllo delle var


//controllo attaacchi
$inizio = substr($email,0,1); 
if ($email!="" AND $inizio!="/" AND $inizio!="<" AND stristr($email, 'http://')==FALSE AND stristr($email, 'https://')==FALSE AND stristr($email, 'ftp://')==FALSE AND stristr($email, '<script>')==FALSE AND stristr($email, '<applet>')==FALSE AND stristr($email, '<embed>')==FALSE AND stristr($email, '<object>')==FALSE)
{
	$query= "SELECT ID,pwd,admin FROM anagrafica where email='$email'";
	//Facciamo una query ricercando se esiste un record con l'email digitata
	$risultato=mysql_query($query);
	if (mysql_num_rows($risultato)>0)
	{
		//procediamo se la query genera un risultato
	   $control=mysql_fetch_row($risultato);
	   if (md5(md5($pwd))==$control[1])
	   {
		//Siamo entrati con un utente del DB
		  session_start();         
		  $_SESSION['tux']=$control[0];
		  $_SESSION['typo']=$control[2];
		  // Passiamo alla var di sessione tux il valore di control[0] corrispondente all'ID dell'utente

		  // scriviamo il log dell'utente che si autentica         
		  $querylog="INSERT INTO log SET utente='$email', data='".time()."', ip='".
		  $_SERVER['REMOTE_ADDR']."', browser='".$_SERVER['HTTP_USER_AGENT']."', tipo='admin'";
			$risultatolog=mysql_query($querylog);
		  //echo mysql_error();
		  //Header("Location: area.php");
		  echo"<meta http-equiv=\"refresh\" content=\"0;url=area.php\" />";
		}
	   else
	   {
		//header("Refresh: 0; url=../html/index.php");
		echo"<meta http-equiv=\"refresh\" content=\"0;url=../bilugcms-admin\" />";
		$msg = "PASSWORD SBAGLIATA";				  
		confirm($msg);
		exit;
	   }
	}
	else
		//non procediamo perchè la query non genera un risultato
	{
		//header("Refresh: 0; url=../html/index.php");	
		echo"<meta http-equiv=\"refresh\" content=\"0;url=../bilugcms-admin\" />";
		$msg = "UTENTE NON ESISTENTE";				  
		confirm($msg);
	   exit;
	}
}
else {
	//header("Refresh: 0; url=../html/index.php");
	echo"<meta http-equiv=\"refresh\" content=\"0;url=../\" />";
}
?>
