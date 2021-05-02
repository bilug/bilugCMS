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
$arg=pulisci_stringa_utenti(apici($_POST['arg']));
$stat = apici($_POST['stat']);
$idm = $_POST['idm'];
$links = apici($_POST['links']);
$ordine = $_POST['ordine'];
$linkt = htmlspecialchars(apici($_POST['linkt']));

if (!$id)
// se l'id non ha un valore, allora siamo in fase di inserimento
{
	if ($arg=="" and $stat=='no')
   {
   	echo "ERRORE: NON HAI INSERITO LA VOCE DI MENU";
    	echo "<BR><a href=\"area.php?pag=insert_menuvoci.php&amp;idm=$idm\">Riprova</a>";
   }
   else
   {
   	$str2=" SELECT ID FROM menuvoci where voce='$arg'";
    	// facciamo una query per verificare se esiste nel DB un argomento uguale a quello che si sta inserendo
    	$risultato2=mysql_query($str2);
    	if (mysql_num_rows($risultato2)>0)
    	{
      	// se la nostra query di controllo genera un risultato, generiamo un errore
        	echo "VOCE DI MENU GIA' INSERITO";
        	echo "<br/><a href=\"area.php?pag=insert_menuvoci.php&amp;idm=$idm\">Riprova</a>";
    	}
    	else
    	// se la nostra query di controllo non genera alcun risultato, procediamo con l'inserimento
    	{
    		if ($stat == 'si')
    		{
    			$ric ="Select ID,titolo from statiche where id='$links'";
    			$ris =mysql_query($ric);
    			$val = mysql_fetch_row($ris);
    			$str="INSERT INTO menuvoci (IDmenu,voce,ordine,link,stat) VALUES ('$idm','$val[1]','$ordine','$val[0]','$stat')";
    		}
    		else
    			$str="INSERT INTO menuvoci (IDmenu,voce,ordine,link,stat) VALUES ('$idm','$arg','$ordine','$linkt','$stat')";
            
         // query di inserimento
         $risultato=mysql_query($str);
         if (!$risultato)
         // controllo se la query di inserimento è andata a buon fine
         {
         	echo "ERRORE: VOCE DI MENU NON INSERITO";
            echo "<br/><a href=\"area.php?pag=insert_menuvoci.php&amp;idm=$idm\">Riprova</a>";
         }
         else
         	//Header("Location: ");
			echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=conferma.php\" />";
            
         exit;
    	}
   }
}
else
// se l'id ha un valore, allora siamo in fase di modifica
{
	if ($stat == 'si')
   {
   	$ric ="Select ID,titolo from statiche where id='$links'";
    	$ris =mysql_query($ric);
    	$val = mysql_fetch_row($ris);    				
    	$str=" UPDATE menuvoci SET voce = '$val[1]', link= '$val[0]',stat='$stat' WHERE ID = '$id'";
	}
	else
	   $str=" UPDATE menuvoci SET voce = '$arg', link= '$linkt',stat='$stat' WHERE ID = '$id'";
    	
   // query di modifica
   $risultato=mysql_query($str);
   if (!$risultato)
   // controllo se la query di modifica è andata a buon fine
   {
    	echo "ERRORE: VOCE DI MENU NON MODIFICATO";
     	echo "<br/><a href=\"area.php?pag=elenco_menuvoci.php&amp;id=$idm\">Riprova</a>";
   }
   else
   	//Header("Location: ");
	echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=confermam.php\" />";
    
   exit;
}
?>