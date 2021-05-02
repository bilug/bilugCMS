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
$note=pulisci_stringa_utenti(apici($_POST['note']));
$pwd=pulisci_stringa_utenti(apici($_POST['pwd']));


if (!$id) // se l'id non ha un valore, allora siamo in fase di inserimento
{
	if (($nome=="") OR ($pwd==""))
   {
	   $tipoerr="ERRORE: NON HAI INSERITO UN CAMPO OBBLIGATORIO";
    	echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_utenti_ecommerce.php&errore=si&tipoerr=$tipoerr&nome=$nome&note=$note&pwd=$pwd\" />";
   }
   else
   {
   	$str2=" SELECT ID FROM ecommerceris where pwd='$pwd'";
    	// facciamo una query per verificare se esiste nel DB una pwd già inserita
    	$risultato2=mysql_query($str2);
    	if (mysql_num_rows($risultato2)>0)
    	{
      	$tipoerr="PASSWORD GIA' PRESENTE";
      	// se la nostra query di controllo genera un risultato, generiamo un errore
    	echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_utenti_ecommerce.php&errore=si&tipoerr=$tipoerr&nome=$nome&note=$note&pwd=$pwd\" />";
    	}
    	else
    		// se la nostra query di controllo non genera alcun risultato, procediamo con l'inserimento
    	{
	   	$oggi=date("Y-m-d");
			$str="INSERT INTO ecommerceris SET  nome = '$nome',  note = '$note',  pwd = '$pwd',  data = '$oggi'";
         // query di inserimento
         $risultato=mysql_query($str);
         if (!$risultato)
         // controllo se la query di inserimento è andata a buon fine
         {
         	echo "ERRORE: UTENTE NON INSERITO";
            echo "<br/><a href=\"area.php?pag=insert_utenti_ecommerce.php\">Riprova</a>";
         }
         else
			echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=conferma.php&from=elenco_ecommerce_categorie.php\" />";
         
         exit;
    	}
	}
}
else
	// se l'id ha un valore, allora siamo in fase di modifica
{
	if (($nome=="") OR ($pwd==""))
   {
   	echo "ERRORE: NON HAI INSERITO UN CAMPO OBBLIGATORIO";
    	echo "<br/><a href=\"area.php?pag=insert_utenti_ecommerce.php&amp;id=".$id."\">Riprova</a>";
   }
   else
   {
		$str2=" SELECT ID FROM ecommerceris where pwd='$pwd'";
    	// facciamo una query per verificare se esiste nel DB una pwd già inserita
    	$risultato2=mysql_query($str2);
    	if (mysql_num_rows($risultato2)>0)
			{
			/*$tipoerr="PASSWORD GIA' PRESENTE";
			// se la nostra query di controllo genera un risultato, generiamo un errore
			echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_utenti_ecommerce.php&errore=si&tipoerr=$tipoerr&nome=$nome&note=$note&pwd=$pwd\" />";*/
			// se la nostra query di controllo genera un risultato, procediamo con la modifica senza pwd
			$str=" UPDATE ecommerceris SET nome = '$nome', note = '$note' WHERE ID = '$id'";
			// query di modifica
			$risultato=mysql_query($str);
			}
    	else
    		{
			// se la nostra query di controllo non genera alcun risultato, procediamo con la modifica
			$str=" UPDATE ecommerceris SET nome = '$nome', note = '$note', pwd = '$pwd' WHERE ID = '$id'";
			// query di modifica
			$risultato=mysql_query($str);
			}
    	if (!$risultato)
    	// controllo se la query di modifica è andata a buon fine
      {
      	echo "ERRORE: UTENTE NON MODIFICATO";
        	echo "<br/><a href=\"area.php?pag=elenco_ecommerce_categorie.php\">Riprova</a>";
      }
    	else
			echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=conferma.php&from=elenco_ecommerce_categorie.php\" />";
    	exit;
	}
}
?>
