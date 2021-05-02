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
$testo = apici( $_POST['testo'] );
$img = apici($_POST['immagine']);
$notizia = (int)$_POST['notizia'];
$lingua = $_POST['lingua'];
 
if ($id)
// se l'id non ha un valore, allora siamo in fase di inserimento
{
    if ( $testo == "" )
    {
    	$tipoerr="ERRORE: NON HAI INSERITO UN CAMPO OBBLIGATORIO";
    	echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_newsbox.php&errore=si&tipoerr=$tipoerr&immagine=$img&notizia=$notizia&lingua=$lingua\" />";
    }
    else
    {
          $str = "UPDATE newsbox SET testo = '$testo', immagine = '$img', notizia = '$notizia', id_lingua = $lingua WHERE id = $id LIMIT 1";
         // query di inserimento
         $risultato=mysql_query($str);
         if (!$risultato)
         // controllo se la query di inserimento è andata a buon fine
         {
         	$tipoerr="ERRORE: NEWSBOX NON INSERITA";
            echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_newsbox.php&errore=si&tipoerr=$tipoerr&immagine=$img&notizia=$notizia&lingua=$lingua\" />";
         }
         else
         {            	
           	//Header("Location: ");
  	         echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=conferma.php&from=elenco_newsbox.php\" />";
         }
         exit;
    	}
}
else {
   	$tipoerr="ERRORE: PAGINA NON TROVATA";
      echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_newsbox.php&errore=si&tipoerr=$tipoerr\" />";  
}
?>
