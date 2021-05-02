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

$id = $_POST['id'];

if (!$id)
// se l'id non ha un valore, allora siamo in fase di inserimento
{
    
}

else
// se l'id ha un valore, allora siamo in fase di modifica
{
    $nome=pulisci_stringa_utenti(apici($_POST['nome']));
    $cognome=pulisci_stringa_utenti(apici($_POST['cognome']));
    $email=pulisci_stringa_utenti(apici($_POST['email']));
    $pwd=pulisci_stringa_utenti(apici($_POST['pwd']));
    $pwd2=apici($_POST['pwd2']);
    $pwdold=apici($_POST['pwdold']);
  	 $sesso=$_POST['sesso'];
    $eta=$_POST['eta'];
    $citta=pulisci_stringa_utenti(apici($_POST['citta']));
    if (($nome=="") OR ($email=="") OR ($pwd=="") OR ($pwd!=$pwd2))
    {
    	echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=profilo.php\" />";
      exit;
    }
    else
    {    
    	if ($pwdold != $pwd)    
    		$str=" UPDATE anagrafica SET nome = '$nome', cognome = '$cognome', email = '$email', pwd = '".md5(md5($pwd))."', sesso = '$sesso', eta = '$eta', citta = '$citta' WHERE ID = '$id'";
	 	else
			$str=" UPDATE anagrafica SET nome = '$nome', cognome = '$cognome', email = '$email', sesso = '$sesso', eta = '$eta', citta = '$citta' WHERE ID = '$id'";
	 		     
    	// query di modifica
    	$risultato=mysql_query($str);
    	if (!$risultato)
    	// controllo se la query di modifica è andata a buon fine
      {
        echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=profilo.php\" />";
        
      }
    	else
    	//Header("Location: area.php?pag=conferma.php");
		echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=conferma.php\" />";
    	
    }
}
exit;
?>
