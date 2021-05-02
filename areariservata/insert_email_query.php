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
$nome=apici($_POST['nome']);
$email=apici($_POST['email']);
$retry = "<br/><a href=\"area.php?pag=insert_email.php\">Riprova</a>";
$retrym = "<br/><a href=\"area.php?pag=elenco_email.php\">Riprova</a>";

if (!$id)
// se l'id non ha un valore, allora siamo in fase di inserimento
{
	if (($nome=="")OR(!chkEmail1($email)))
   {
		$tipoerr="ERRORE: NON HAI INSERITO L'EMAIL/NOME";
		//echo "ERRORE: NON HAI INSERITO L'EMAIL/NOME";
    	//echo $retry;
    	echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_email.php&errore=si&tipoerr=$tipoerr&nome=$nome&email=$email\" />";
   }
   else
   {
   	$str= "select count(ID) from email";
    	$risultato=mysql_query($str);
    	if (!$risultato) $ord=0;
    	else 
    	{
    		$contr = mysql_fetch_row($risultato);
    		$ord = $contr[0]+1;
    	}
    		
      $str="INSERT INTO email (nome,email,ord) VALUES ('$nome','$email','$ord')";
      // query di inserimento
      $risultato=mysql_query($str);
      if (!$risultato)
      // controllo se la query di inserimento è andata a buon fine
      {
      	$tipoerr="ERRORE: EMAIL NON INSERITA";
		//echo "ERRORE: EMAIL NON INSERITA";
    	//echo $retry;
    	echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_email.php&errore=si&tipoerr=$tipoerr&nome=$nome&email=$email\" />";
      	
      }
      else
      	//Header("Location: "); 
	echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=conferma.php&from=elenco_email.php\" />";		
   }
}
else
// se l'id ha un valore, allora siamo in fase di modifica
{
	if (($nome=="")OR(!chkEmail1($email)))
   {
		$tipoerr="ERRORE: NON HAI INSERITO L'EMAIL/NOME";
		//echo "ERRORE: NON HAI INSERITO L'EMAIL/NOME";
    	//echo $retry;
    	echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_email.php&errore=si&tipoerr=$tipoerr&nome=$nome&email=$email\" />";
   }
   else
   {
		$str=" UPDATE email SET nome='$nome' , email = '$email' WHERE ID = '$id'";
   	// query di modifica
   	$risultato=mysql_query($str);
   	if (!$risultato)
   	// controllo se la query di modifica è andata a buon fine
   	{
   		$tipoerr="ERRORE: EMAIL NON MODIFICATA";
		//echo "ERRORE: NON HAI INSERITO L'EMAIL/NOME";
    	//echo $retry;
    	echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_email.php&errore=si&tipoerr=$tipoerr&nome=$nome&email=$email\" />";  
   	}
   	else
   		//Header("Location: ");
		echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=conferma.php&from=elenco_email.php\" />";
   }
   
}
exit;
?>
