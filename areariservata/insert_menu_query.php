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
$arg=pulisci_stringa(apici($_POST['arg']));
$sez = $_POST['sez'];

if (!$id)
// se l'id non ha un valore, allora siamo in fase di inserimento
{
	if ($arg=="")
   {
   	$tipoerr="ERRORE: NON HAI INSERITO IL MENU";
   	//echo "ERRORE: NON HAI INSERITO IL MENU";
    	//echo "<BR><a href=\"area.php?pag=insert_menu.php\">Riprova</a>";
    	echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_menu.php&errore=si&tipoerr=$tipoerr&arg=$arg&sez=$sez\" />";
   }
   else
   {
   	$str2=" SELECT ID FROM menu where voce='$arg'";
    	// facciamo una query per verificare se esiste nel DB un argomento uguale a quello che si sta inserendo
    	$risultato2=mysql_query($str2);
    	if (mysql_num_rows($risultato2)>0)
    	{
      	// se la nostra query di controllo genera un risultato, generiamo un errore
        	$tipoerr="MENU GIA' INSERITO";
        	//echo "MENU GIA' INSERITO";
        	//echo "<br/><a href=\"area.php?pag=insert_menu.php\">Riprova</a>";
        	echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_menu.php&errore=si&tipoerr=$tipoerr&arg=$arg&sez=$sez\" />";
    	}
    	else
    	// se la nostra query di controllo non genera alcun risultato, procediamo con l'inserimento
    	{
      	$str="INSERT INTO menu (sez,voce) VALUES ('$sez','$arg')";
         
      	// query di inserimento
      	$risultato=mysql_query($str);
      	if (!$risultato)
      	// controllo se la query di inserimento è andata a buon fine
      	{
      		$tipoerr="ERRORE: MENU NON INSERITO";
      		//echo "ERRORE: MENU NON INSERITO";
         	//echo "<br/><a href=\"area.php?pag=insert_menu.php\">Riprova</a>";
         	echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_menu.php&errore=si&tipoerr=$tipoerr&arg=$arg&sez=$sez\" />";
      	}
      	else
       		//Header("Location: ");
			echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=conferma.php&from=elenco_menu.php\" />";
            
      	exit;
   	}
	}
}
else
// se l'id ha un valore, allora siamo in fase di modifica
{
	$str=" UPDATE menu SET sez='$sez' , voce = '$arg' WHERE ID = '$id'";
   // query di modifica
   $risultato=mysql_query($str);
   if (!$risultato)
   // controllo se la query di modifica è andata a buon fine
   {
   	$tipoerr="ERRORE: MENU NON MODIFICATO";
   //	echo "ERRORE: MENU NON MODIFICATO";
     // echo "<br/><a href=\"area.php?pag=elenco_menu.php\">Riprova</a>";
     echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_menu.php&errore=si&tipoerr=$tipoerr&arg=$arg&sez=$sez\" />";
   }
   else
   	//Header("Location: ");
    echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=conferma.php&from=elenco_menu.php\" />";
   exit;
}
?>
