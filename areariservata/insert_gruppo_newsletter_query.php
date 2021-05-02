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

$id = (int)$_POST['id'];
$gruppo = apici($_POST['gruppo']);

if (!$id)
// se l'id non ha un valore, allora siamo in fase di inserimento
{
    if ($gruppo=="")
    {
		$tipoerr="ERRORE: NON HAI INSERITO IL GRUPPO NEWSLETTER";
    	//echo "ERRORE: NON HAI INSERITO L'GRUPPO NEWSLETTER";
    	//echo "<BR><a href=\"area.php?pag=insert_gruppo_newsletter.php\">Riprova</a>";
    	 echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_gruppo_newsletter.php&errore=si&tipoerr=$tipoerr&gruppo=$gruppo\" />";
    }
    else
    {
    	$str2 = " SELECT ID FROM gruppi_newsletter WHERE nome = '$gruppo' LIMIT 1";
    	// facciamo una query per verificare se esiste nel DB un GRUPPO NEWSLETTER uguale a quello che si sta inserendo
    	$risultato2=mysql_query($str2);
    	if (mysql_num_rows($risultato2)>0)
    	{
      	// se la nostra query di controllo genera un risultato, generiamo un errore
        	$tipoerr="GRUPPO NEWSLETTER GIA' INSERITO";
        	//echo "GRUPPO NEWSLETTER GIA' INSERITO";
        	//echo "<br/><a href=\"area.php?pag=insert_gruppo_newsletter.php\">Riprova</a>";
        	echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_gruppo_newsletter.php&errore=si&tipoerr=$tipoerr&gruppo=$gruppo\" />";
    	}
    	else
    	// se la nostra query di controllo non genera alcun risultato, procediamo con l'inserimento
    	{
      	$str="INSERT INTO gruppi_newsletter ( nome ) VALUES ( '$gruppo' )";
         // query di inserimento
         $risultato=mysql_query($str);
         if (!$risultato)
         // controllo se la query di inserimento è andata a buon fine
         {
         	$tipoerr="ERRORE: GRUPPO NEWSLETTER NON INSERITO";
         	//echo "ERRORE: GRUPPO NEWSLETTER NON INSERITO";
          // echo "<br/><a href=\"area.php?pag=insert_gruppo_newsletter.php\">Riprova</a>";
           echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_gruppo_newsletter.php&errore=si&tipoerr=$tipoerr&gruppo=$gruppo\" />";
           
         }
         else
         	//Header("Location: ");
			echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=conferma.php&from=elenco_newsletter.php\" />";
            
         exit;
    	}
   }
}
else
// se l'id ha un valore, allora siamo in fase di modifica
{	
	$str2=" SELECT id FROM gruppi_newsletter WHERE nome='$gruppo' AND id <> $id LIMIT 1";
	// facciamo una query per verificare se esiste nel DB un GRUPPO NEWSLETTER uguale a quello che si sta modificando
	$risultato2=mysql_query($str2);
	if (mysql_num_rows($risultato2)>0)
	{
	// se la nostra query di controllo genera un risultato, generiamo un errore
		$tipoerr="GRUPPO NEWSLETTER GIA' INSERITO";
		//echo "GRUPPO NEWSLETTER GIA' INSERITO";
		//echo "<br/><a href=\"area.php?pag=insert_gruppo_newsletter.php\">Riprova</a>";
		echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_gruppo_newsletter.php&errore=si&tipoerr=$tipoerr&gruppo=$gruppo&id=$id\" />";
	}
	else
	// se la nostra query di controllo non genera alcun risultato, procediamo con la modifica
	{	
		$str=" UPDATE gruppi_newsletter SET nome = '$gruppo' WHERE id = '$id' LIMIT 1";
	   // query di modifica
	   $risultato=mysql_query($str);
	   if (!$risultato)
	   // controllo se la query di modifica è andata a buon fine
	   {
		$tipoerr="ERRORE: GRUPPO NEWSLETTER NON MODIFICATO";
		//echo "ERRORE: GRUPPO NEWSLETTER NON MODIFICATO";
		  //echo "<br/><a href=\"area.php?pag=elenco_arg.php\">Riprova</a>";
		 echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_gruppo_newsletter.php&errore=si&tipoerr=$tipoerr&gruppo=$gruppo\" />";
	   }
	   else
		//Header("Location: ");
		echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=conferma.php&from=elenco_newsletter.php\" />";
		
		exit;
   }
}
?>

