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
$anno = $_POST['anno'];
$mese = $_POST['mese'];
$giorno = $_POST['giorno'];
$ora = $_POST['ora'];
$minuti = $_POST['minuti'];
$luogo = apici($_POST['luogo']);
$tipo = $_POST['tipo'];
$descrizione = apici($_POST['descrizione']);
$lingua = $_POST["lingua"];
$link = (int)$_POST['link'];

$utente = apici($_POST['utente']);

if (!$id)
// se l'id non ha un valore, allora siamo in fase di inserimento
{
	if (($titolo=="") OR ($anno=="") OR ($mese=="") OR ($giorno=="") OR ($ora=="") OR ($minuti=="") OR ($luogo==""))
   {
		$tipoerr="ERRORE: NON HAI INSERITO UN CAMPO OBBLIGATORIO";
		//echo "ERRORE: NON HAI INSERITO UN CAMPO OBBLIGATORIO";
    	//echo "<br/><a href=\"area.php?pag=insert_eventoapp.php\">Riprova</a>";
    	echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_eventoapp.php&errore=si&tipoerr=$tipoerr&titolo=$titolo&luogo=$luogo&tipo=$tipo&descrizione=$descrizione&giorno=$giorno&anno=$anno&mese=$mese&ora=$ora&minuti=$minuti&lingua=$lingua&link=$link\" />";
   }
   else
   {
   	$str2=" SELECT titolo FROM eventi where titolo='$titolo'";
    	// facciamo una query per verificare se esiste nel DB una email già inserita
    	$risultato2=mysql_query($str2);
    	if (mysql_num_rows($risultato2)>0)
    	{
			$tipoerr="EVENTO/APPUNTAMENTO GIA' PRESENTE";
			// se la nostra query di controllo genera un risultato, generiamo un errore
        	//echo "EVENTO/APPUNTAMENTO GIA' PRESENTE";
        	//echo "<br/><a href=\"area.php?pag=insert_eventoapp.php\">Riprova</a>";
        	echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_eventoapp.php&errore=si&tipoerr=$tipoerr&titolo=$titolo&luogo=$luogo&tipo=$tipo&descrizione=$descrizione&lingua=$lingua&link=$link\" />";
    	}
    	else
    	// se la nostra query di controllo non genera alcun risultato, procediamo con l'inserimento
    	{
			$dataora = "$anno-$mese-$giorno $ora:$minuti:00";
    		$str="INSERT INTO eventi SET titolo = '$titolo', dataora = '$dataora', luogo = '$luogo', tipo = '$tipo', descrizione='$descrizione', idutente='$utente', id_lingua = $lingua, link = $link";
         // query di inserimento
         $risultato=mysql_query($str);
         if (!$risultato)
         // controllo se la query di inserimento è andata a buon fine
         {
         	$tipoerr="ERRORE: EVENTO/APPUNTAMENTO NON INSERITO";
         	//echo "ERRORE: EVENTO/APPUNTAMENTO NON INSERITO";
            //echo "<br/><a href=\"area.php?pag=insert_eventoapp.php\">Riprova</a>";
            echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_eventoapp.php&errore=si&tipoerr=$tipoerr&titolo=$titolo&luogo=$luogo&tipo=$tipo&descrizione=$descrizione&lingua=$lingua&link=$link\" />";
         }
         else
         	//Header("Location: ");
			echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=conferma.php&from=elenco_eventoapp.php\" />";
         
         exit;
		}
	}
}
else
// se l'id ha un valore, allora siamo in fase di modifica
{
	$dataora = "$anno-$mese-$giorno $ora:$minuti:00";
   $str=" UPDATE eventi SET titolo = '$titolo',  dataora = '$dataora',  luogo = '$luogo',  tipo = '$tipo', descrizione='$descrizione' , idutente='$utente', id_lingua = $lingua, link = $link WHERE ID = $id LIMIT 1";
   // query di modifica
   $risultato=mysql_query($str);
   if (!$risultato)
   // controllo se la query di modifica è andata a buon fine
   {
		$tipoerr="ERRORE: EVENTO/APPUNTAMENTO NON MODIFICATO";
		//echo "ERRORE: EVENTO/APPUNTAMENTO NON MODIFICATO";
		//echo "<br/><a href=\"area.php?pag=elenco_utenti.php\">Riprova</a>";
		echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_eventoapp.php&errore=si&tipoerr=$tipoerr&titolo=$titolo&luogo=$luogo&tipo=$tipo&descrizione=$descrizione&lingua=$lingua&link=$link\" />";
   }
   else
   	//Header("Location: ");
	echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=conferma.php&from=elenco_eventoapp.php\" />";
    
   exit;
}
?>
