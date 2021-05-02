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
$titolo = apici( $_POST['titolo'] );
$tipo = $_POST['tipo'];
$lingua = $_POST['lingua'];
$descrizione = apici( $_POST['descrizione'] );
$img = mysql_real_escape_string($_POST['img']);

if (!$id)
// se l'id non ha un valore, allora siamo in fase di inserimento
{
	if ($titolo=="")
   {
   	$tipoerr="ERRORE: NON HAI INSERITO IL MENU";
   	//echo "ERRORE: NON HAI INSERITO IL MENU";
    	//echo "<BR><a href=\"area.php?pag=insert_menu.php\">Riprova</a>";
    	echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_menu_new.php&errore=si&tipoerr=$tipoerr&titolo=$titolo&lingua=$lingua&descrizione=$descrizione&img=$img\" />";
   }
   else
   {
   	$str2=" SELECT id FROM menutipo WHERE titolo = '$titolo' AND tipo = $tipo LIMIT 1";
    	// facciamo una query per verificare se esiste nel DB un argomento uguale a quello che si sta inserendo
    	$risultato2=mysql_query($str2);
    	if (mysql_num_rows($risultato2)>0)
    	{
      	// se la nostra query di controllo genera un risultato, generiamo un errore
        	$tipoerr="MENU GIA' INSERITO";
        	//echo "MENU GIA' INSERITO";
        	//echo "<br/><a href=\"area.php?pag=insert_menu.php\">Riprova</a>";
        	echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_menu_new.php&errore=si&tipoerr=$tipoerr&titolo=$titolo&lingua=$lingua&descrizione=$descrizione&img=$img\" />";
    	}
    	else
    	// se la nostra query di controllo non genera alcun risultato, procediamo con l'inserimento
    	{
		$qpos=" SELECT COUNT(posizione) FROM menutipo WHERE idpadre='0' AND tipo = '$tipo'";
	   $posiz = mysql_query($qpos);
	   $pos=mysql_fetch_array($posiz);
	   $pos[0]=$pos[0]+1;
      	$str = "INSERT INTO menutipo ( titolo, tipo, idpadre, posizione, id_lingua, descrizione, img ) VALUES ( '$titolo', '$tipo', 0, $pos[0], $lingua, '$descrizione', '$img' )";
         
      	// query di inserimento
      	$risultato=mysql_query($str);
      	if (!$risultato)
      	// controllo se la query di inserimento è andata a buon fine
      	{
      		$tipoerr="ERRORE: MENU NON INSERITO";
      		//echo "ERRORE: MENU NON INSERITO";
         	//echo "<br/><a href=\"area.php?pag=insert_menu.php\">Riprova</a>";
         	echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_menu_new.php&errore=si&tipoerr=$tipoerr&titolo=$titolo&lingua=$lingua&descrizione=$descrizione&img=$img\" />";
      	}
      	else
       		//Header("Location: ");
			echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=conferma.php&from=elenco_menu_new.php\" />";
            
      	exit;
   	}
	}
}
else
// se l'id ha un valore, allora siamo in fase di modifica
{
	if ($titolo=="")
   {
   	$tipoerr="ERRORE: NON HAI INSERITO IL MENU";
   	//echo "ERRORE: NON HAI INSERITO IL MENU";
    	//echo "<BR><a href=\"area.php?pag=insert_menu.php\">Riprova</a>";
    	echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_menu_new.php&id=$id&errore=si&tipoerr=$tipoerr&titolo=$titolo&lingua=$lingua&descrizione=$descrizione&img=$img\" />";
   }
   else
   {
		$str = " UPDATE menutipo SET titolo = '$titolo', id_lingua = $lingua, descrizione = '$descrizione', tipo = '$tipo', img = '$img' WHERE ID = $id LIMIT 1";
	   // query di modifica
	   $risultato=mysql_query($str);
	   if (!$risultato)
	   // controllo se la query di modifica è andata a buon fine
	   {
		$tipoerr="ERRORE: MENU NON MODIFICATO";
	   //	echo "ERRORE: MENU NON MODIFICATO";
		 // echo "<br/><a href=\"area.php?pag=elenco_menu.php\">Riprova</a>";
		 echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_menu_new.php&id=$id&errore=si&tipoerr=$tipoerr&titolo=$titolo&lingua=$lingua&descrizione=$descrizione&img=$img\" />";
	   }
	   else
	   //	Header("Location: ");
		echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=conferma.php&from=elenco_menu_new.php\" />";
    }
   exit;
}
?>
