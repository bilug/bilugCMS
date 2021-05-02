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

$arg = apici($_POST['arg']);
$sez = $_POST['sez'];
$liv = $_POST['liv'];

if ($arg=="")
{
 	$tipoerr="ERRORE: NON HAI INSERITO IL SOTTOMENU";
	//echo "ERRORE: NON HAI INSERITO IL SOTTOMENU";
  	//echo "<br/><a href=\"area.php?pag=insert_menus.php&sez=$sez&liv=$liv\">Riprova</a>";
  	echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_smenu.php&errore=si&tipoerr=$tipoerr\" />";
}
else
{
	$str2=" SELECT id,idpadre FROM menutipo where voce='$arg' and liv=$liv";
  	// facciamo una query per verificare se esiste nel DB un argomento uguale a quello che si sta inserendo
  	$risultato2=mysql_query($str2);
  	if (mysql_num_rows($risultato2)>0)
  	{
     	// se la nostra query di controllo genera un risultato, generiamo un errore
      $tipoerr="SOTTOMENU GIA' INSERITO";
      //echo "SOTTOMENU GIA' INSERITO";
      //echo "<br/><a href=\"area.php?pag=insert_menus.php&sez=$sez&liv=$liv\">Riprova</a>";
      echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_smenu.php&errore=si&tipoerr=$tipoerr\" />";
	}
   else
   // se la nostra query di controllo non genera alcun risultato, procediamo con l'inserimento
   {
   	$str="INSERT INTO menu (sez,voce,liv) VALUES ('$sez','$arg',$liv)";
         
      // query di inserimento
      $risultato=mysql_query($str);
      if (!$risultato)
      // controllo se la query di inserimento è andata a buon fine
      {
      	$tipoerr="ERRORE: SOTTOMENU NON INSERITO";
      	//echo "ERRORE: SOTTOMENU NON INSERITO";
        //echo "<br/><a href=\"area.php?pag=insert_menus.php&sez=$sez&liv=$liv\">Riprova</a>";
         echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_smenu.php&errore=si&tipoerr=$tipoerr\" />";
      }
      else
       	//Header("Location: ");
		echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=conferma.php&from=elenco_menu.php\" />";
            
      exit;
   }
}
?>
