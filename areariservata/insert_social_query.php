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
$nome = apici($_POST['nome']);
$link = apici($_POST['link']);
$img = $_FILES['img'];


if (($nome=="") OR ($link=="") OR ($img==""))
{
	$tipoerr="ERRORE: NON HAI INSERITO UN CAMPO OBBLIGATORIO";
	//echo "ERRORE: NON HAI INSERITO UN CAMPO OBBLIGATORIO";
	//echo "<br/><a href=\"area.php?pag=insert_social.php\">Riprova</a>";
	echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_social.php&errore=si&tipoerr=$tipoerr&id=$id&nome=$nome&link=$link\" />";
}
elseif (!$id)
{
	// se l'id non ha un valore, allora siamo in fase di inserimento
   	$str2=" SELECT ID FROM social WHERE nome = '$nome' LIMIT 1";
	// facciamo una query per verificare se esiste nel DB una notizia già inserita
	$risultato2=mysql_query($str2);
	if (mysql_num_rows($risultato2)>0)
	{
		$tipoerr="SOCIAL GIA' PRESENTE";
	// se la nostra query di controllo genera un risultato, generiamo un errore
		//echo "statica GIA' PRESENTE";
		//echo "<br/><a href=\"area.php?pag=insert_social.php\">Riprova</a>";
		echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_social.php&errore=si&tipoerr=$tipoerr&nome=$nome&link=$link\" />";
	}
	else
	// se la nostra query di controllo non genera alcun risultato, procediamo con l'inserimento
	{
        if($img['error'] == UPLOAD_ERR_OK AND is_uploaded_file($img['tmp_name']))
        {
            move_uploaded_file($img['tmp_name'], '../img/social/'.$img['name']);
        }
	
		$str="INSERT INTO social (nome, link, img) VALUES ('$nome', '$link', '$img[name]')";
	 // query di inserimento
	 $risultato=mysql_query($str);
	 if (!$risultato)
		// controllo se la query di inserimento è andata a buon fine
	 {
		$tipoerr="ERRORE: SOCIAL NON INSERITO";
		//echo "ERRORE: STATICA NON INSERITA";
	   // echo "<br/><a href=\"area.php?pag=insert_social.php\">Riprova</a>";
	   echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_social.php&errore=si&tipoerr=$tipoerr&nome=$nome&link=$link\" />";
	 }
	 else
	 {
		echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=conferma.php&from=elenco_social.php\" />";
	 }  
	 
	 exit;
	}
}
else
{
        if($img['error'] == UPLOAD_ERR_OK AND is_uploaded_file($img['tmp_name']))
        {
            move_uploaded_file($img['tmp_name'], '../img/social/'.$img['name']);
        }

	// se l'id ha un valore, allora siamo in fase di modifica
	$str="UPDATE social SET nome = '$nome', link = '$link', img = '$img[name]' WHERE ID = '$id' LIMIT 1";
   // query di modifica
   $risultato=mysql_query($str);
   if (!$risultato)
   // controllo se la query di modifica è andata a buon fine
   {
   	$tipoerr="ERRORE: SOCIAL NON MODIFICATO";
   	//echo "ERRORE: STATICA NON MODIFICATA";
      //echo "<br/><a href=\"area.php?pag=elenco_notizie.php\">Riprova</a>";
    echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_social.php&errore=si&tipoerr=$tipoerr&id=$id&nome=$nome&link=$link\" />";
   }
	 else
	 {
		echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=conferma.php&from=elenco_social.php\" />";
	 }  
   exit;
}
?>
