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

error_reporting(0);
require_once("../utility/connessione.php");
require_once("../utility/secureform.php");
require_once("../utility/funzioni.php");
require_once("../utility/alert.php");
require_once("../custom/costanti.php");

$pwd = apici($_POST['pwd_ris']); //controllo delle var
$user = apici($_POST['user_ris']); //controllo delle var

//controllo attacchi
$inizio = substr($pwd,0,1); 
if ($pwd !="")
		{
		$query= "SELECT ID, pwd FROM ecommerceris WHERE pwd = '$pwd' AND nome = '$user' LIMIT 1";
		//Facciamo una query ricercando se esiste un record con la password digitata
		$risultato=mysql_query($query);
		if (mysql_num_rows($risultato)>0)
			{
				//procediamo se la query genera un risultato
				$control=mysql_fetch_row($risultato);
				//Siamo entrati con un utente del DB
				         
				$_SESSION['arearis']=$control[0];
				// Passiamo alla var di sessione arearis il valore di control[0] corrispondente all'ID della password
				// scriviamo il log dell'utente che si autentica         
				$querylog="INSERT INTO log SET utente='ris-$user', data='".time()."', ip='".
				$_SERVER['REMOTE_ADDR']."', browser='".$_SERVER['HTTP_USER_AGENT']."', tipo='ecommerce'";
				$risultatolog=mysql_query($querylog);
				session_regenerate_id();
				 echo"<meta http-equiv=\"refresh\" content=\"0;url="._URLSITO."\" />";
			}
		else
		//non procediamo perchè la query non genera un risultato
			{
				$_SESSION['bilugcms_errore'] = 1;
				header( "Location: "._URLSITO );
				exit;
			}
		}
else
{
	$_SESSION['bilugcms_errore'] = 1;
	header( "Location: "._URLSITO );
	exit;
}
?>
