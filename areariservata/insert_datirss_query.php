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
$descrizione = apici($_POST['descrizione']);
$copyright = apici($_POST['copyright']);
$image = apici($_POST['image']);
$vimage = $_POST['vimage'];

if (!$id)
// se l'id non ha un valore, allora siamo in fase di inserimento
{
	if (($titolo=="") OR ($descrizione==""))
   {
   	$tipoerr="ERRORE: NON HAI INSERITO UN CAMPO OBBLIGATORIO ";
   	//echo "ERRORE: NON HAI INSERITO UN CAMPO OBBLIGATORIO ";
    	//echo "<br/><a href=\"area.php?pag=insert_datirss.php\">Riprova</a>";
    	echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_datirss.php&errore=si&tipoerr=$tipoerr\" />";
   }
   else
   	// se la nostra query di controllo non genera alcun risultato, procediamo con l'inserimento
   {
		$str="INSERT INTO datirss SET  titolo = '$titolo',  descrizione = '$descrizione',  copyright = '$copyright',  image = '$image',  vimage = '$vimage'";
      // query di inserimento
      $risultato=mysql_query($str);
      if (!$risultato)
      // controllo se la query di inserimento è andata a buon fine
      {
      	$tipoerr="ERRORE: DATI RSS NON INSERITI";
      	//echo "ERRORE: DATI RSS NON INSERITI";
         //echo "<br/><a href=\"area.php?pag=insert_datirss.php\">Riprova</a>";
         echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_datirss.php&errore=si&tipoerr=$tipoerr\" />";
      }
      else
      //	Header("Location: ");
		echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=conferma.php&from=insert_datirss.php\" />";
         
      exit;
   }   
}
else
// se l'id ha un valore, allora siamo in fase di modifica
{
	if (($titolo=="") OR ($descrizione==""))
   {
   	   	$tipoerr="ERRORE: NON HAI INSERITO UN CAMPO OBBLIGATORIO ";
   	   	//echo "ERRORE: NON HAI INSERITO UN CAMPO OBBLIGATORIO ";
    	//echo "<br/><a href=\"area.php?pag=insert_datirss.php\">Riprova</a>";
    	echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_datirss.php&errore=si&tipoerr=$tipoerr\" />";
   }
   else
   {
   	$str=" UPDATE datirss  SET  titolo = '$titolo',  descrizione = '$descrizione',  copyright = '$copyright',  image = '$image',  vimage = '$vimage' WHERE ID = '$id'";
	
    	// query di modifica
    	$risultato=mysql_query($str);
    	if (!$risultato)
    	// controllo se la query di modifica è andata a buon fine
      {
      	$tipoerr="ERRORE: DATI RSS NON MODIFICATI";
      	//echo "ERRORE: DATI RSS NON MODIFICATI";
        //	echo "<br/><a href=\"area.php?pag=insert_datirss.php\">Riprova</a>";
        echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_datirss.php&errore=si&tipoerr=$tipoerr\" />";
      }
    	else
    		//Header("Location: ");
			echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=conferma.php&from=insert_datirss.php\" />";
    
    	exit;
   }
}
?>
