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
$nome=pulisci_stringa_utenti(apici($_POST['nome']));
$cognome=pulisci_stringa_utenti(apici($_POST['cognome']));
$pwd=pulisci_stringa_utenti(apici($_POST['Pass']));
$pwd2=apici($_POST['pwd2']);
$pwdold=apici($_POST['pwdold']);
$sesso=$_POST['sesso'];
$eta=$_POST['eta'];
$admin=$_POST['admin'];
$citta=pulisci_stringa_utenti(apici($_POST['citta']));
if ($_SESSION['typo']!='A')
	$email=controlla_mail(apici($_POST['NomeUtente']));
else
	$email=apici($_POST['NomeUtente']);

if (!$id) // se l'id non ha un valore, allora siamo in fase di inserimento
{
	if (($nome=="") OR ($email=="") OR ($pwd=="") OR ($pwd!=$pwd2))
   {
	   $tipoerr="ERRORE: NON HAI INSERITO UN CAMPO OBBLIGATORIO <BR>OPPURE HAI SBAGLIATO A RIDIGITARE LA PASSWORD <BR>O HAI INSERITO UNA EMAIL NON VALIDA";
		//echo "ERRORE: NON HAI INSERITO UN CAMPO OBBLIGATORIO <BR>OPPURE HAI SBAGLIATO A RIDIGITARE LA PASSWORD <BR>O HAI INSERITO UNA EMAIL NON VALIDA";
    	//echo "<br/><a href=\"area.php?pag=insert_utenti.php\">Riprova</a>";
    	echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_utenti.php&errore=si&tipoerr=$tipoerr&nome=$nome&cognome=$cognome&citta=$citta&email=$email&eta=$eta&admin=$admin&sesso=$sesso\" />";
   }
   else
   {
   	$str2=" SELECT ID FROM anagrafica where email='$email'";
    	// facciamo una query per verificare se esiste nel DB una email già inserita
    	$risultato2=mysql_query($str2);
    	if (mysql_num_rows($risultato2)>0)
    	{
      	$tipoerr="EMAIL GIA' PRESENTE";
      	// se la nostra query di controllo genera un risultato, generiamo un errore
        	//echo "EMAIL GIA' PRESENTE";
        	//echo "<br/><a href=\"area.php?pag=insert_utenti.php\">Riprova</a>";
        	echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_utenti.php&errore=si&tipoerr=$tipoerr&nome=$nome&cognome=$cognome&citta=$citta&email=$email&admin=$admin&sesso=$sesso\" />";
    	}
    	else
    		// se la nostra query di controllo non genera alcun risultato, procediamo con l'inserimento
    	{
	   	$oggi=date("Y-m-d");
			$str="INSERT INTO anagrafica SET  nome = '$nome',  cognome = '$cognome',  email = '$email',  pwd = '".md5(md5($pwd))."',  sesso = '$sesso',  eta = '$eta',  citta = '$citta',  data = '$oggi',  admin = '$admin'";
         // query di inserimento
         $risultato=mysql_query($str);
         if (!$risultato)
         // controllo se la query di inserimento è andata a buon fine
         {
         	echo "ERRORE: UTENTE NON INSERITO";
            echo "<br/><a href=\"area.php?pag=insert_utente.php\">Riprova</a>";
         }
         else
         	//Header("Location: ");
			echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=conferma.php&from=elenco_utenti.php\" />";
         
         exit;
    	}
	}
}
else
	// se l'id ha un valore, allora siamo in fase di modifica
{
	if (($nome=="") OR ($email=="") OR ($pwd=="") OR ($pwd!=$pwd2))
   {
   	echo "ERRORE: NON HAI INSERITO UN CAMPO OBBLIGATORIO <BR>OPPURE HAI SBAGLIATO A RIDIGITARE LA PASSWORD <BR>O HAI INSERITO UNA EMAIL NON VALIDA";
    	echo "<br/><a href=\"area.php?pag=insert_utenti.php&amp;id=".$id."\">Riprova</a>";
   }
   else
   {
   	if ($pwdold != $pwd)    
    		$str=" UPDATE anagrafica SET nome = '$nome', cognome = '$cognome', email = '$email', pwd = '".md5(md5($pwd))."', sesso = '$sesso', eta = '$eta', citta = '$citta',admin = '$admin' WHERE ID = '$id'";
	 	else
			$str=" UPDATE anagrafica SET nome = '$nome', cognome = '$cognome', email = '$email', sesso = '$sesso', eta = '$eta', citta = '$citta',admin = '$admin' WHERE ID = '$id'";
    	// query di modifica
    	$risultato=mysql_query($str);
    	if (!$risultato)
    	// controllo se la query di modifica è andata a buon fine
      {
      	echo "ERRORE: UTENTE NON MODIFICATO";
        	echo "<br/><a href=\"area.php?pag=elenco_utenti.php\">Riprova</a>";
      }
    	else
    		//Header("Location: ");
			echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=conferma.php&from=elenco_utenti.php\" />";
    	exit;
	}
}
?>
