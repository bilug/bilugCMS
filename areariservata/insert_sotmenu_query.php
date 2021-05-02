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

$titolo=pulisci_stringa(apici($_POST['titolo']));
$idpadre = $_POST['idpadre'];
$tipo = $_POST['tipo'];
$link = $_POST['link'];

if ($titolo=="")
{
 	$tipoerr="ERRORE: NON HAI INSERITO IL SOTTOMENU";
	//echo "ERRORE: NON HAI INSERITO IL SOTTOMENU";
  	//echo "<br/><a href=\"area.php?pag=insert_menus.php&sez=$sez&liv=$liv\">Riprova</a>";
  	echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_sotmenu.php&errore=si&tipoerr=$tipoerr&titolo=$titolo&link=$link\" />";
}
else
{
	$str2=" SELECT id,idpadre FROM menutipo where titolo='$titolo' and idpadre=$idpadre";
  	// facciamo una query per verificare se esiste nel DB un argomento uguale a quello che si sta inserendo
  	$risultato2=mysql_query($str2);
  	if (mysql_num_rows($risultato2)>0)
  	{
     	// se la nostra query di controllo genera un risultato, generiamo un errore
      $tipoerr="SOTTOMENU GIA' INSERITO";
      //echo "SOTTOMENU GIA' INSERITO";
      //echo "<br/><a href=\"area.php?pag=insert_menus.php&sez=$sez&liv=$liv\">Riprova</a>";
      echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_sotmenu.php&errore=si&tipoerr=$tipoerr&titolo=$titolo&link=$link\" />";
	}
	else
   // se la nostra query di controllo non genera alcun risultato, procediamo con l'inserimento
   {
	   $qpos=" SELECT count(posizione) FROM menutipo where idpadre='$idpadre'";
	   $posiz = mysql_query($qpos);
	   $pos=mysql_fetch_array($posiz);
	   $pos[0]=$pos[0]+1;
	
   	$str="INSERT INTO menutipo (titolo,tipo,idpadre,link,posizione) VALUES ('$titolo','$tipo',$idpadre,'$link','$pos[0]')";
         
      // query di inserimento
      $risultato=mysql_query($str);
      if (!$risultato)
      // controllo se la query di inserimento è andata a buon fine
      {
      	$tipoerr="ERRORE: SOTTOMENU NON INSERITO";
      	//echo "ERRORE: SOTTOMENU NON INSERITO";
        //echo "<br/><a href=\"area.php?pag=insert_menus.php&sez=$sez&liv=$liv\">Riprova</a>";
        // echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_sotmenu.php&errore=si&tipoerr=$tipoerr&titolo=$titolo&link=$link\" />";
      }
       else
       	//Header("Location: ");
		echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=conferma.php&from=elenco_menu_new.php\" />";
            
      exit;
   }
}
?>

