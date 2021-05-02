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
$arg = apici( $_POST['cat'] );
$sottocat = (int)$_POST['sottocat'];
$lingua = (int)$_POST['lingua'];

if (!$id)
// se l'id non ha un valore, allora siamo in fase di inserimento
{
    if ($arg=="")
    {
		$tipoerr="ERRORE: NON HAI INSERITO L'ARGOMENTO";
    	//echo "ERRORE: NON HAI INSERITO L'ARGOMENTO";
    	//echo "<BR><a href=\"area.php?pag=insert_arg.php\">Riprova</a>";
    	 echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_ecommerce_categorie.php&errore=si&tipoerr=$tipoerr&arg=$arg&lingua=$lingua\" />";
    }
    else
    {
    	$str2 = "SELECT ID FROM ecommercecategoria WHERE categoria = '$arg' AND id_padre = $sottocat LIMIT 1";
    	// facciamo una query per verificare se esiste nel DB un argomento uguale a quello che si sta inserendo
    	$risultato2=mysql_query($str2);
      	// se la nostra query di controllo genera un risultato, generiamo un errore
    	if (mysql_num_rows($risultato2)>0) {
        	$tipoerr="ARGOMENTO GIA' INSERITO";
        	//echo "ARGOMENTO GIA' INSERITO";
        	//echo "<br/><a href=\"area.php?pag=insert_arg.php\">Riprova</a>";
        	echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_ecommerce_categorie.php&errore=si&tipoerr=$tipoerr&arg=$arg&lingua=$lingua\" />";
    	}
    	else {
    	// se la nostra query di controllo non genera alcun risultato, procediamo con l'inserimento
      	$str  ="INSERT INTO ecommercecategoria ( categoria, id_lingua, id_padre ) VALUES ( '$arg', $lingua, $sottocat )";
         // query di inserimento
         $risultato=mysql_query($str);
         if (!$risultato)
         // controllo se la query di inserimento è andata a buon fine
         {
         	$tipoerr="ERRORE: ARGOMENTO NON INSERITO";
         	//echo "ERRORE: ARGOMENTO NON INSERITO";
          // echo "<br/><a href=\"area.php?pag=insert_arg.php\">Riprova</a>";
           echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_ecommerce_categorie.php&errore=si&tipoerr=$tipoerr&arg=$arg&lingua=$lingua\" />";
           
         }
         else
         	//Header("Location: ");
			echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=conferma.php&from=elenco_ecommerce_categorie.php\" />";
            
         exit;
    	}
   }
}
else { // se l'id ha un valore, allora siamo in fase di modifica
	$str2 = "SELECT ID FROM ecommercecategoria WHERE categoria = '$arg' AND id_padre = $sottocat LIMIT 1";
	$risultato2 = mysql_query($str2);
	if (mysql_num_rows($risultato2)>0) {
		$tipoerr = "ARGOMENTO GIA' ESISTENTE";
		echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_ecommerce_categorie.php&errore=si&tipoerr=$tipoerr&arg=$arg&lingua=$lingua\" />";
	}
	else {
		$str=" UPDATE ecommercecategoria SET categoria = '$arg', id_lingua = $lingua, id_padre = $sottocat WHERE id = $id LIMIT 1";
	   // query di modifica
	   $risultato=mysql_query($str);
	   // controllo se la query di modifica è andata a buon fine
	   if (!$risultato) {
			$tipoerr="ERRORE: ARGOMENTO NON MODIFICATO";
			//echo "ERRORE: ARGOMENTO NON MODIFICATO";
			//echo "<br/><a href=\"area.php?pag=elenco_arg.php\">Riprova</a>";
			echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_ecommerce_categorie.php&errore=si&tipoerr=$tipoerr&arg=$arg&lingua=$lingua\" />";
	   }
	   else
		//Header("Location: ");
		echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=conferma.php&from=elenco_ecommerce_categorie.php\" />";
	}
	
	exit;
}
?>
