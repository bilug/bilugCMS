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
$menu_arg = $_POST['menu_arg'];
$lingua = $_POST['lingua'];
$arg=apici($_POST['arg']);

if (!$id)
// se l'id non ha un valore, allora siamo in fase di inserimento
{
    if ($arg=="")
    {
		$tipoerr="ERRORE: NON HAI INSERITO L'ARGOMENTO";
    	//echo "ERRORE: NON HAI INSERITO L'ARGOMENTO";
    	//echo "<BR><a href=\"area.php?pag=insert_arg.php\">Riprova</a>";
    	 echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_arg.php&errore=si&tipoerr=$tipoerr&arg=$arg&menu_arg=$menu_arg&lingua=$lingua\" />";
    }
    else
    {
    	$str2=" SELECT ID FROM argomenti WHERE argomenti = '$arg' AND id_lingua = $lingua LIMIT 1";
    	// facciamo una query per verificare se esiste nel DB un argomento uguale a quello che si sta inserendo
    	$risultato2=mysql_query($str2);
    	if (mysql_num_rows($risultato2)>0)
    	{
      	// se la nostra query di controllo genera un risultato, generiamo un errore
        	$tipoerr="ARGOMENTO GIA' INSERITO";
        	//echo "ARGOMENTO GIA' INSERITO";
        	//echo "<br/><a href=\"area.php?pag=insert_arg.php\">Riprova</a>";
        	echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_arg.php&errore=si&tipoerr=$tipoerr&arg=$arg&menu_arg=$menu_arg&lingua=$lingua\" />";
    	}
    	else
    	// se la nostra query di controllo non genera alcun risultato, procediamo con l'inserimento
    	{
      	$str="INSERT INTO argomenti (argomenti, menu_arg, id_lingua) VALUES ('$arg', '$menu_arg', $lingua)";
         // query di inserimento
         $risultato=mysql_query($str);
         if (!$risultato)
         // controllo se la query di inserimento è andata a buon fine
         {
         	$tipoerr="ERRORE: ARGOMENTO NON INSERITO";
         	//echo "ERRORE: ARGOMENTO NON INSERITO";
          // echo "<br/><a href=\"area.php?pag=insert_arg.php\">Riprova</a>";
           echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_arg.php&errore=si&tipoerr=$tipoerr&arg=$arg&menu_arg=$menu_arg&lingua=$lingua\" />";
           
         }
         else
         	//Header("Location: ");
			echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=conferma.php&from=elenco_arg.php\" />";
            
         exit;
    	}
   }
}
else
// se l'id ha un valore, allora siamo in fase di modifica
{	
	$str2 = " SELECT ID FROM argomenti WHERE ID <> $id AND argomenti = '$arg' LIMIT 1";
	// facciamo una query per verificare se esiste nel DB un argomento uguale a quello che si sta modificando
	$risultato2=mysql_query($str2);
	if (mysql_num_rows($risultato2)>0)
	{
	// se la nostra query di controllo genera un risultato, generiamo un errore
		$tipoerr="ARGOMENTO GIA' INSERITO";
		//echo "ARGOMENTO GIA' INSERITO";
		//echo "<br/><a href=\"area.php?pag=insert_arg.php\">Riprova</a>";
		echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_arg.php&errore=si&tipoerr=$tipoerr&arg=$arg&id=$id&menu_arg=$menu_arg&lingua=$lingua\" />";
	}
	else
	// se la nostra query di controllo non genera alcun risultato, procediamo con la modifica
	{	
		$str = " UPDATE argomenti SET argomenti = '$arg', menu_arg = '$menu_arg', id_lingua = $lingua WHERE ID = $id LIMIT 1";
	   // query di modifica
	   $risultato=mysql_query($str);
	   if (!$risultato)
	   // controllo se la query di modifica è andata a buon fine
	   {
		$tipoerr="ERRORE: ARGOMENTO NON MODIFICATO";
		//echo "ERRORE: ARGOMENTO NON MODIFICATO";
		  //echo "<br/><a href=\"area.php?pag=elenco_arg.php\">Riprova</a>";
		 echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_arg.php&errore=si&tipoerr=$tipoerr&arg=$arg&menu_arg=$menu_arg&lingua=$lingua\" />";
	   }
	   else
		//Header("Location: ");
		echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=conferma.php&from=elenco_arg.php\" />";
		
		exit;
   }
}
?>
