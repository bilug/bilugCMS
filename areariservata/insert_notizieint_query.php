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
$sottotitolo = apici($_POST['sottotitolo']);
$testo = apici($_POST['testo']);
$link = apici($_POST['link']);

if (!$id)
// se l'id non ha un valore, allora siamo in fase di inserimento
{
	if (($titolo=="") OR ($sottotitolo=="") OR ($testo==""))
   {
		$tipoerr="ERRORE: NON HAI INSERITO UN CAMPO OBBLIGATORIO";
		//echo "ERRORE: NON HAI INSERITO UN CAMPO OBBLIGATORIO";
    	//echo "<br/><a href=\"area.php?pag=insert_notizieint.php\">Riprova</a>";
    	 echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_notizieint.php&errore=si&tipoerr=$tipoerr&titolo=$titolo&sottotitolo=$sottotitolo&testo=$testo&link=$link\" />";
   }
   else
   {
   	$str2=" SELECT ID FROM notizieint where titolo='$titolo'";
    	// facciamo una query per verificare se esiste nel DB una notizia già inserita
    	$risultato2=mysql_query($str2);
    	if (mysql_num_rows($risultato2)>0)
    	{
			$tipoerr="NOTIZIA GIA' PRESENTE";
      	// se la nostra query di controllo genera un risultato, generiamo un errore
        	//echo "NOTIZIA GIA' PRESENTE";
        	//echo "<br/><a href=\"area.php?pag=insert_notizieint.php\">Riprova</a>";
        	 echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_notizieint.php&errore=si&tipoerr=$tipoerr&titolo=$titolo&sottotitolo=$sottotitolo&testo=$testo&link=$link\" />";
    	}
    	else
    	// se la nostra query di controllo non genera alcun risultato, procediamo con l'inserimento
    	{
      	$str="INSERT INTO notizieint (titolo, sottotitolo, testo, link) VALUES ('$titolo', '$sottotitolo', '$testo', '$link')";
		          
         // query di inserimento
         $risultato=mysql_query($str);
         if (!$risultato)
         // controllo se la query di inserimento è andata a buon fine
         {
         	$tipoerr="ERRORE: NOTIZIA NON INSERITA";
         	//echo "ERRORE: NOTIZIA NON INSERITA";
            //echo "<br/><a href=\"area.php?pag=insert_notizieint.php\">Riprova</a>";
             echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_notizieint.php&errore=si&tipoerr=$tipoerr&titolo=$titolo&sottotitolo=$sottotitolo&testo=$testo&link=$link\" />";
         }
         else
         	//Header("Location: );
            echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=conferma.php&from=elenco_notizieint.php\" />";
         exit;
   	}
	}
}
else
// se l'id ha un valore, allora siamo in fase di modifica
{
	$str="UPDATE notizieint SET titolo = '$titolo', sottotitolo = '$sottotitolo', testo = '$testo', link = '$link' WHERE ID = '$id'";
   // query di modifica
   $risultato=mysql_query($str);
   if (!$risultato)
   // controllo se la query di modifica è andata a buon fine
   {
		$tipoerr="ERRORE: NOTIZIA NON MODIFICATA";
		//echo "ERRORE: NOTIZIA NON MODIFICATA";
      //echo "<br/><a href=\"area.php?pag=elenco_notizieint.php\">Riprova</a>";
      echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_notizieint.php&errore=si&tipoerr=$tipoerr&titolo=$titolo&sottotitolo=$sottotitolo&testo=$testo&link=$link\" />";
   }
   else
   	//Header("Location: ");
    echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=conferma.php&from=elenco_notizieint.php\" />";
   exit;
}
?>
