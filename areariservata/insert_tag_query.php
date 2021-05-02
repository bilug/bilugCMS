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
$nome_tag = apici( $_POST['nome_tag'] );
$link_tag = trim( $_POST['link_tag'] );

// se l'id non ha un valore, allora siamo in fase di inserimento
if (!$id) {
	$link_return = "area.php?pag=insert_tag.php&errore=si&nome_tag=$nome_tag&link_tag=$link_tag";
    
	if ($nome_tag == "" OR $link_tag == "")
    {
		$tipoerr="ERRORE: NON HAI INSERITO NESSUN TAG";
    	//echo "ERRORE: NON HAI INSERITO L'ARGOMENTO";
    	//echo "<BR><a href=\"area.php?pag=insert_arg.php\">Riprova</a>";
    	 echo "<meta http-equiv=\"refresh\" content=\"0;url=$link_return&tipoerr=$tipoerr\" />";
    }
    else
    {
    	$str2 = "SELECT id FROM tag WHERE nome_tag = '$nome_tag' OR link_tag = '$link_tag' LIMIT 1";
    	// facciamo una query per verificare se esiste nel DB un argomento uguale a quello che si sta inserendo
    	$risultato2=mysql_query($str2);
    	if (mysql_num_rows($risultato2)>0)
    	{
      	// se la nostra query di controllo genera un risultato, generiamo un errore
        	$tipoerr="TAG GIA' INSERITO";
        	//echo "ARGOMENTO GIA' INSERITO";
        	//echo "<br/><a href=\"area.php?pag=insert_arg.php\">Riprova</a>";
        	echo "<meta http-equiv=\"refresh\" content=\"0;url=$link_return&tipoerr=$tipoerr\" />";
    	}
    	else
    	// se la nostra query di controllo non genera alcun risultato, procediamo con l'inserimento
    	{
      	$str="INSERT INTO tag (nome_tag, link_tag) VALUES ('$nome_tag', '$link_tag')";
         // query di inserimento
         $risultato=mysql_query($str);
         if (!$risultato)
         // controllo se la query di inserimento è andata a buon fine
         {
         	$tipoerr="ERRORE: TAG NON INSERITO";
         	//echo "ERRORE: ARGOMENTO NON INSERITO";
          // echo "<br/><a href=\"area.php?pag=insert_arg.php\">Riprova</a>";
           echo "<meta http-equiv=\"refresh\" content=\"0;url=$link_return&tipoerr=$tipoerr\" />";
           
         }
         else
         	//Header("Location: ");
			echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=conferma.php&from=gestione_tag.php\" />";
            
         exit;
    	}
   }
}
// se l'id ha un valore, allora siamo in fase di modifica
else {
	$link_return = "area.php?pag=insert_tag.php&errore=si&id=$id&nome_tag=$nome_tag&link_tag=$link_tag";

	$str2 = "SELECT id FROM tag WHERE id <> $id AND ( nome_tag = '$nome_tag' OR link_tag = '$link_tag' ) LIMIT 1";
	// facciamo una query per verificare se esiste nel DB un argomento uguale a quello che si sta modificando
	$risultato2=mysql_query($str2);
	if (mysql_num_rows($risultato2)>0)
	{
	// se la nostra query di controllo genera un risultato, generiamo un errore
		$tipoerr="TAG GIA' INSERITO";
		echo "<meta http-equiv=\"refresh\" content=\"0;url=$link_return&tipoerr=$tipoerr\" />";
	}
	// se la nostra query di controllo non genera alcun risultato, procediamo con la modifica
	else {	
		$str = "UPDATE tag SET nome_tag = '$nome_tag', link_tag = '$link_tag' WHERE id = $id LIMIT 1";
	   // query di modifica
	   $risultato=mysql_query($str);
	   // controllo se la query di modifica è andata a buon fine
	   if (!$risultato) {
			$tipoerr="ERRORE: TAG NON MODIFICATO";
			echo "<meta http-equiv=\"refresh\" content=\"0;url=$link_return&tipoerr=$tipoerr\" />";
	   }
	   else
		//Header("Location: ");
		echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=conferma.php&from=gestione_tag.php\" />";
		
		exit;
   }
}
?>
