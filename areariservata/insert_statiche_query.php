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
$description = apici($_POST['description']);
$keywords = apici($_POST['keywords']);
$corpo = $_POST['corpo'];
$ordine = $_POST['ordine'];
$menu = apici($_POST['menu']);
$lingua = $_POST['lingua'];

if (($titolo=="") OR ($corpo==""))
{
	$tipoerr="ERRORE: NON HAI INSERITO UN CAMPO OBBLIGATORIO";
	//echo "ERRORE: NON HAI INSERITO UN CAMPO OBBLIGATORIO";
	//echo "<br/><a href=\"area.php?pag=insert_statiche.php\">Riprova</a>";
	echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_statiche.php&errore=si&tipoerr=$tipoerr&id=$id&titolo=$titolo&corpo=$corpo&lingua=$lingua&description=$description&keywords=$keywords\" />";
}
elseif (!$id)
{
	// se l'id non ha un valore, allora siamo in fase di inserimento
   	$str2=" SELECT ID FROM statiche WHERE titolo = '$titolo' LIMIT 1";
	// facciamo una query per verificare se esiste nel DB una notizia già inserita
	$risultato2=mysql_query($str2);
	if (mysql_num_rows($risultato2)>0)
	{
		$tipoerr="statica GIA' PRESENTE";
	// se la nostra query di controllo genera un risultato, generiamo un errore
		//echo "statica GIA' PRESENTE";
		//echo "<br/><a href=\"area.php?pag=insert_statiche.php\">Riprova</a>";
		echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_statiche.php&errore=si&tipoerr=$tipoerr&titolo=$titolo&corpo=$corpo&lingua=$lingua&description=$description&keywords=$keywords\" />";
	}
	else
	// se la nostra query di controllo non genera alcun risultato, procediamo con l'inserimento
	{
		$str="INSERT INTO statiche (titolo, description, keywords, corpo, ordine, id_lingua) VALUES ('$titolo', '$description', '$keywords', '$corpo', '$ordine', $lingua)";
	 // query di inserimento
	 $risultato=mysql_query($str);
	 if (!$risultato)
		// controllo se la query di inserimento è andata a buon fine
	 {
		$tipoerr="ERRORE: STATICA NON INSERITA";
		//echo "ERRORE: STATICA NON INSERITA";
	   // echo "<br/><a href=\"area.php?pag=insert_statiche.php\">Riprova</a>";
	   echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_statiche.php&errore=si&tipoerr=$tipoerr&titolo=$titolo&corpo=$corpo&lingua=$lingua&description=$description&keywords=$keywords\" />";
	 }
	 else
	 {
		$str3=" SELECT ID FROM statiche WHERE titolo = '$titolo' LIMIT 1";
			$risultato3=mysql_query($str3);
			if (mysql_num_rows($risultato3)>0)
			{
				$id = mysql_fetch_row($risultato3);
				$str=" INSERT INTO menuvoci(voce,link,stat,IDmenu) VALUES ('$titolo', '$id[0]','si',$menu)";
				// query di modifica per legare notizia ad un menu esistente
				$risultato=mysql_query($str);
			}	
		//Header("Location: ");
		echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=conferma.php&from=elenco_statiche.php\" />";
		}         
	 exit;
	}
}
else
{
	// se l'id ha un valore, allora siamo in fase di modifica
	$str="UPDATE statiche SET titolo = '$titolo', description = '$description', keywords = '$keywords', corpo = '$corpo', ordine = '$ordine', id_lingua = $lingua WHERE ID = '$id' LIMIT 1";
   // query di modifica
   $risultato=mysql_query($str);
   if (!$risultato)
   // controllo se la query di modifica è andata a buon fine
   {
   	$tipoerr="ERRORE: STATICA NON MODIFICATA";
   	//echo "ERRORE: STATICA NON MODIFICATA";
      //echo "<br/><a href=\"area.php?pag=elenco_notizie.php\">Riprova</a>";
    echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_statiche.php&errore=si&tipoerr=$tipoerr&id=$id&titolo=$titolo&corpo=$corpo&lingua=$lingua&description=$description&keywords=$keywords\" />";
   }
   else
   {
   	$str="SELECT IDmenu FROM menuvoci WHERE link = '$id' AND stat='si'";
   	$risultato=mysql_query($str);
   	if (mysql_num_rows($risultato)>0)
   	{ 
   		$str=" UPDATE menuvoci SET IDmenu = '$menu' WHERE link = '$id' AND stat='si'";
   			// query di modifica per legare notizia ad un menu esistente
   		$risultato=mysql_query($str);
   	}
   	else
   	{
   		$str="INSERT INTO menuvoci(voce,link,stat,IDmenu) VALUES ('$titolo', '$id','si',$menu)";
   		$risultato=mysql_query($str);
   	}
   	//Header("Location: ");
	echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=conferma.php&from=elenco_statiche.php\" />";
   }
   exit;
}
?>
