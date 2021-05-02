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
if ($_SESSION['typo']="A")
{
	
	require_once("../utility/connessione.php");
	require_once("../utility/funzioni.php");
	
	$id = $_POST['id'];
	$menu=pulisci_stringa_utenti(apici($_POST['menu']));
	$descr=pulisci_stringa_utenti(apici($_POST['descr']));
	$link = apici($_POST['link']);
	$extra = apici($_POST['extra']);
	$colonna = $_POST['colonna'];
	$ordine = $_POST['ordine'];
	$permessi = "A".$_POST['admin'];
	$visibile = $_POST['visibile'];
	
	if (!$id)
	// se l'id non ha un valore, allora siamo in fase di inserimento
	{
		if ($menu=="" OR $link=="" OR $colonna=="" OR $colonna<=0 OR $colonna>5 or $visibile=="")
	   {
	   	echo "ERRORE: NON HAI INSERITO IL MENU O IL SUO LINK O LA SUA POSIZIONE O POSIZIONE FUORI RANGE[1-5]";
	    	echo "<BR><a href=\"area.php?pag=insert_menuadmin.php\">Riprova</a>";
	   }
	   else
	   {
	   	$str2=" SELECT ID FROM menuadmin where link='$link'";
	    	// facciamo una query per verificare se esiste nel DB un argomento uguale a quello che si sta inserendo
	    	$risultato2=mysql_query($str2);
	    	if (mysql_num_rows($risultato2)>0)
	    	{
	      	// se la nostra query di controllo genera un risultato, generiamo un errore
	        	echo "MENU GIA' INSERITO";
	        	echo "<br/><a href=\"area.php?pag=insert_menuadmin.php\">Riprova</a>";
	    	}
	    	else
	    	// se la nostra query di controllo non genera alcun risultato, procediamo con l'inserimento
	    	{
	    		$str="INSERT INTO menuadmin (menu,link,extra,descr,permessi,colonna,ordine,visibile) VALUES ('$menu','$link','$extra','$descr','$permessi','$colonna','$ordine','$visibile')";
	         
	      	// query di inserimento
	      	$risultato=mysql_query($str);
	      	if (!$risultato)
	      	// controllo se la query di inserimento è andata a buon fine
	      	{
	      		echo "ERRORE: MENU NON INSERITO";
	         	echo "<br/><a href=\"area.php?pag=insert_menuadmin.php\">Riprova</a>";
	      	}
	      	else
	       		//Header("Location: ");
				echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=conferma.php&from=elenco_menuadmin.php\" />";
	            
	      	exit;
	   	}
		}
	}
	else
	// se l'id ha un valore, allora siamo in fase di modifica
	{
		if ($menu=="" OR $link=="" OR $colonna=="" OR $colonna<=0 OR $colonna>5)
	   {
	   	echo "ERRORE: NON HAI INSERITO IL MENU O IL SUO LINK O LA SUA POSIZIONE O POSIZIONE FUORI RANGE[1-5]";
	    	echo "<BR><a href=\"area.php?pag=insert_menuadmin.php\">Riprova</a>";
	   }
	   else
	   {
			$str=" UPDATE menuadmin SET menu='$menu' , link = '$link', extra = '$extra', descr = '$descr', colonna = '$colonna', ordine = '$ordine', permessi = '$permessi', visibile = '$visibile' WHERE ID = '$id'";
	   	// query di modifica
	   	$risultato=mysql_query($str);
	   	if (!$risultato)
	   	// controllo se la query di modifica è andata a buon fine
	   	{
	   		echo "ERRORE: MENU NON MODIFICATO";
	      	echo "<br/><a href=\"area.php?pag=elenco_menuadmin.php\">Riprova</a>";
	   	}
	   	else
	   		//Header("Location: ");
			echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=conferma.php&from=elenco_menuadmin.php\" />";
	   } 
	   exit;
	}
}
else
	//Header("Location: ");
	echo "<meta http-equiv=\"refresh\" content=\"0;url=index.php\" />";
?>
