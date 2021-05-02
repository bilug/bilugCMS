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

$tipo = apici($_POST['tipo']);
$minore = apici($_POST['minore']);
$maggiore = apici($_POST['maggiore']);
$prezzo = apici($_POST['prezzo']);
$standard = apici($_POST['standard']);

if($standard == "pred")
{
	$standard = "checked";
}
if($maggiore=="")
{
		$maggiore="2000000000";
}


// se l'id non ha un valore, allora siamo in fase di inserimento
if (!$_POST['id']) {
    if (($tipo=="") OR ($minore=="")) {
    	$tipoerr="ERRORE: NON HAI INSERITO UN CAMPO OBBLIGATORIO";
    	echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_spedizioni.php&errore=si&tipoerr=$tipoerr&tipo=$tipo&minore=$minore&maggiore=$maggiore&prezzo=$prezzo&standard=$standard/>";
    }
    else {
    		$str="INSERT INTO spedizione (tipo, minore, maggiore, prezzo, standard) VALUES ('$tipo', '$minore', '$maggiore', '$prezzo','$standard')";
             // query di inserimento
             $risultato=mysql_query($str);
             if (!$risultato)
             // controllo se la query di inserimento è andata a buon fine
             {
             	$tipoerr="ERRORE: ARTICOLO NON INSERITO";
             	
                echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_spedizioni.php&errore=si&tipoerr=$tipoerr&tipo=$tipo&minore=$minore&maggiore=$maggiore&prezzo=$prezzo&standard=$standard/>";
             }
             else
             {            	
             	//Header("Location: ");
    			echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=conferma.php&from=elenco_spedizioni.php\" />";
             }
             exit;
    }
}
else {	
  $id = (int)($_POST['id']);
	if (($tipo=="") OR ($minore==""))
    {
    	$tipoerr="ERRORE: NON HAI INSERITO UN CAMPO OBBLIGATORIO";
    	 echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_spedizioni.php&errore=si&tipoerr=$tipoerr&tipo=$tipo&minore=$minore&maggiore=$maggiore&prezzo=$prezzo&standard=$standard/>";
    }
    else
    {
		$str="UPDATE spedizione SET tipo = '$tipo', minore = '$minore', maggiore = '$maggiore', prezzo = '$prezzo', standard = '$standard' WHERE id = '$id' LIMIT 1";
	// query di modifica
    	$risultato=mysql_query($str);
    	if (!$risultato)
    	// controllo se la query di modifica è andata a buon fine
    	{
    		$tipoerr="ERRORE: ARTICOLO NON MODIFICATA";
    		
      	 echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_spedizioni.php&errore=si&tipoerr=$tipoerr&tipo=$tipo&minore=$minore&maggiore=$maggiore&prezzo=$prezzo&standard=$standard/>";
    	}
    	else
    		//Header("Location: ");
			echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=conferma.php&from=elenco_spedizioni.php\" />";
    }
    exit;
	
}
?>

