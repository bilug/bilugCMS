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
$testo = $_POST['testo'];
$autore = $_POST['autore'];
$argomento = $_POST['argomento'];
$oldarg = $_POST['oldarg'];
$oldtitolo = apici($_POST['oldtitolo']);
$link = apici($_POST['link']);
$autorizza = $_POST['autorizza'];
$evidenzia = $_POST['evidenzia'];
$description = apici($_POST['description']);
$keywords = apici($_POST['keywords']);

$filmato = new DatiFilmato;
$filmato->sito =$_POST['sito'];
$filmato->ris = $_POST['ris'];
$filmato->codice = $_POST['codice'];
$filmato->rel =$_POST['rel'];
$filmato->bordi =$_POST['bordi'];
$filmato->pos =$_POST['posizione'];
$filmato = serialize($filmato);

if (($titolo=="") OR ($testo=="")) {
	$tipoerr="ERRORE: NON HAI INSERITO UN CAMPO OBBLIGATORIO (TITOLO O TESTO)";
	$codice = $_POST['codice'];
	$sito = $_POST['sito'];
	$ris = $_POST['ris'];
	$bordi = $_POST['bordi'];
	$pos = $_POST['posizione'];
	
	echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_notizie.php&errore=si&tipoerr=$tipoerr&id=$id&titolo=$titolo&sottotitolo=$sottotitolo&testo=$testo&autore=$autore&argomento=$argomento&autorizza=$autorizza&evidenzia=$evidenzia&link=$link&sito=$sito&codice=$codice&ris=$ris&bordi=$bordi&pos=$pos&description=$description&keywords=$keywords\" />";
}
elseif (!$id)
{
	// se l'id non ha un valore, allora siamo in fase di inserimento
	$str2 = " SELECT ID FROM notizie WHERE titolo = '$titolo' AND argomento = '$argomento' LIMIT 1";
	// facciamo una query per verificare se esiste nel DB una notizia già inserita
	$risultato2=mysql_query($str2);
	if (mysql_num_rows($risultato2)>0)
	{
	// se la nostra query di controllo genera un risultato, generiamo un errore
	$tipoerr = "NOTIZIA GIA' PRESENTE";
	echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_notizie.php&errore=si&tipoerr=$tipoerr&titolo=$titolo&sottotitolo=$sottotitolo&testo=$testo&autore=$autore&argomento=$argomento&autorizza=$autorizza&evidenzia=$evidenzia&link=$link&sito=$sito&codice=$codice&ris=$ris&bordi=$bordi&pos=$pos&description=$description&keywords=$keywords\" />";
	}
	else
	// se la nostra query di controllo non genera alcun risultato, procediamo con l'inserimento
	{
		if ($evidenzia == 'si')
		{
			$str = "UPDATE notizie SET evidenzia = 'no'" ;
			mysql_query($str);
		}
	$str="INSERT INTO notizie ( titolo, sottotitolo, testo, autore, argomento, link, autorizza , evidenzia, filmato, description, keywords ) VALUES ( '$titolo', '$sottotitolo', '$testo', '$autore', '$argomento', '$link', '$autorizza', '$evidenzia', '$filmato', '$description', '$keywords' )";
	 // query di inserimento
	 $risultato=mysql_query($str);
	 if (!$risultato)
	 // controllo se la query di inserimento è andata a buon fine
	 {
		$tipoerr="ERRORE: NOTIZIA NON INSERITA";
		echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_notizie.php&errore=si&tipoerr=$tipoerr&titolo=$titolo&sottotitolo=$sottotitolo&testo=$testo&autore=$autore&argomento=$argomento&autorizza=$autorizza&evidenzia=$evidenzia&link=$link&sito=$sito&codice=$codice&ris=$ris&bordi=$bordi&pos=$pos&description=$description&keywords=$keywords\" />";
	 }
	 else
	 {            	
		//Header("Location: ");
		echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=conferma.php&from=elenco_notargaut.php\" />";
	 }
	 exit;
	}
}
else
// se l'id ha un valore, allora siamo in fase di modifica
{
	$controllo = true;
	if ($oldarg != $argomento)
	{
		$str2=" SELECT ID FROM notizie WHERE titolo = '$titolo' AND argomento = '$argomento' LIMIT 1";
 		// facciamo una query per verificare se esiste nel DB una notizia già inserita
 		$risultato2=mysql_query($str2);
 		if (mysql_num_rows($risultato2)>0)
 		{
     		// se la nostra query di controllo genera un risultato, generiamo un errore
     		$tipoerr="TITOLO NOTIZIA GIA' PRESENTE NEL NUOVO ARGOMENTO";
     		echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_notizie.php&errore=si&tipoerr=$tipoerr&titolo=$titolo&sottotitolo=$sottotitolo&testo=$testo&autore=$autore&argomento=$argomento&autorizza=$autorizza&evidenzia=$evidenzia&link=$link&sito=$sito&codice=$codice&ris=$ris&bordi=$bordi&pos=$pos&description=$description&keywords=$keywords\" />";
     		$controllo = false;
 		}    	
 	}
 	else
 	{
 		if ($titolo != $oldtitolo)
 		{
 			$str2=" SELECT ID FROM notizie WHERE titolo = '$titolo' AND argomento = '$argomento' LIMIT 1";
 			// facciamo una query per verificare se esiste nel DB una notizia già inserita
 			$risultato2=mysql_query($str2);
 			if (mysql_num_rows($risultato2)>0)
 			{
     			// se la nostra query di controllo genera un risultato, generiamo un errore
     			$tipoerr="TITOLO NOTIZIA GIA' PRESENTE NEL ARGOMENTO";
     			echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_notizie.php&errore=si&tipoerr=$tipoerr\" />";
     			$controllo = false;
 			}    	
 		}
 	}
	if ($controllo)
   {
   	if ($evidenzia == 'si'){
		$str = "UPDATE notizie SET evidenzia='no'" ;
		mysql_query($str);
	}
	
   	$str = "UPDATE notizie SET titolo = '$titolo', sottotitolo = '$sottotitolo', testo = '$testo', autore = '$autore', argomento = '$argomento', link = '$link', autorizza='$autorizza', evidenzia='$evidenzia' , filmato = '$filmato', description = '$description', keywords = '$keywords' WHERE ID = $id LIMIT 1";
   	// query di modifica
    	$risultato=mysql_query($str);
    	if (!$risultato)
    	// controllo se la query di modifica è andata a buon fine
    	{
    		$tipoerr="ERRORE: NOTIZIA NON MODIFICATA";
      	echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_notizie.php&errore=si&tipoerr=$tipoerr&id=$id&titolo=$titolo&sottotitolo=$sottotitolo&testo=$testo&autore=$autore&argomento=$argomento&autorizza=$autorizza&evidenzia=$evidenzia&link=$link&sito=$sito&codice=$codice&ris=$ris&bordi=$bordi&pos=$pos&description=$description&keywords=$keywords\" />";
    	}
    	else
			echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=conferma.php&from=elenco_notargaut.php\" />";
    }
    exit;
}
?>
