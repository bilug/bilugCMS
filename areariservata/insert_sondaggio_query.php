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
$titolo = apici($_POST['titolo']);
$opzioni = apici($_POST['opzioni']);
$attivo = apici($_POST['attivo']);
$multipli = apici($_POST['multipli']);
$utenti = apici($_POST['utenti']);
$lingua = $_POST['lingua'];

if (!$id)
// se l'id non ha un valore, allora siamo in fase di inserimento
{
	if (($titolo=="") OR ($opzioni==""))
   {
		$tipoerr="ERRORE: NON HAI INSERITO UN CAMPO OBBLIGATORIO";
		//echo "ERRORE: NON HAI INSERITO UN CAMPO OBBLIGATORIO";
    	//echo "<br/><a href=\"area.php?pag=insert_utenti.php\">Riprova</a>";
    	echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_sondaggio.php&errore=si&tipoerr=$tipoerr&titolo=$titolo&opzioni=$opzioni&attivo=$attivo&multipli=$multipli&utenti=$utenti&lingua=$lingua\" />";
   }
   else
   {
   	$str2=" SELECT titolo FROM sondaggi where titolo='$titolo' LIMIT 1";
    	// facciamo una query per verificare se esiste nel DB una email già inserita
    	$risultato2=mysql_query($str2);
    	if (mysql_num_rows($risultato2)>0)
    	{
			$tipoerr="SONDAGGIO GIA' PRESENTE";
			// se la nostra query di controllo genera un risultato, generiamo un errore
        	//echo "SONDAGGIO GIA' PRESENTE";
        	//echo "<br/><a href=\"area.php?pag=insert_utenti.php\">Riprova</a>";
        	echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_sondaggio.php&errore=si&tipoerr=$tipoerr&titolo=$titolo&opzioni=$opzioni&attivo=$attivo&multipli=$multipli&utenti=$utenti&lingua=$lingua\" />";
    	}
    	else
    	// se la nostra query di controllo non genera alcun risultato, procediamo con l'inserimento
    	{
    		$opzioni = str_replace("\n",";",$opzioni);
    		$opzioni = str_replace("\r","",$opzioni);    
    		if ($attivo =="si")
    		{
    			$str ="UPDATE sondaggi SET attivo = 'no' WHERE utenti='$utenti'";
    		 	$risultato=mysql_query($str);
    		}
	      
	      $str="INSERT INTO sondaggi SET  titolo = '$titolo',  attivo = '$attivo',  opzioni = '$opzioni',  multipli = '$multipli', utenti='$utenti', id_lingua = $lingua";
         // query di inserimento
         $risultato=mysql_query($str);
         if (!$risultato)
         // controllo se la query di inserimento è andata a buon fine
         {
         	echo "ERRORE: SONDAGGIO NON INSERITO";
            echo "<br/><a href=\"area.php?pag=insert_utente.php\">Riprova</a>";
         }
         else
         	//Header("Location: ");
			echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=conferma.php&from=elenco_sondaggi.php\" />";
         
         exit;
		}
	}
}

else
// se l'id ha un valore, allora siamo in fase di modifica
{
	$opzioni = str_replace("\n",";",$opzioni);
   $opzioni = str_replace("\r","",$opzioni); 
   if ($attivo =="si")
   {
	 	$str ="UPDATE sondaggi SET attivo = 'no' WHERE utenti = '$utenti'";
    	$risultato=mysql_query($str);
   } 
   $str=" UPDATE sondaggi SET titolo = '$titolo',  attivo = '$attivo',  opzioni = '$opzioni',  multipli = '$multipli', utenti='$utenti', id_lingua = $lingua WHERE ID = $id LIMIT 1";
   // query di modifica
   $risultato=mysql_query($str);
   if (!$risultato)
   // controllo se la query di modifica è andata a buon fine
   {
	   echo "ERRORE: SONDAGGIO NON MODIFICATO";
      echo "<br/><a href=\"area.php?pag=elenco_utenti.php\">Riprova</a>";
   }
   else
   	echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=conferma.php&from=elenco_sondaggi.php\" />";
   
   exit;
}
?>
