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

$id = $_POST["id"];
$tipolink = $_POST["tipolink"];
$news = $_POST["news"];
$gallerie = $_POST["gallerie"];
$statiche = $_POST["statiche"];
$ecommerce = $_POST["ecommerce"];
$ext = $_POST["ext"];
$int = $_POST["int"];
 
switch( $tipolink ){
	case "nw":
		if( $news == "" ) {
			$tipoerr="ERRORE:NON HAI SELEZIONATO IL LINK NEWS";
			echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_sotmenu_link.php&errore=si&tipoerr=$tipoerr&id=$id/>";	
		}
		else
			$link = $news;
	break;
		
	case "st":
		if( $statiche == "" ) {
			$tipoerr="ERRORE:NON HAI SELEZIONATO IL LINK STATICHE";
			echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_sotmenu_link.php&errore=si&tipoerr=$tipoerr&id=$id/>";	
		}
		else
			$link = $statiche;
	break;
	
	case "gl":
		if( $gallerie == "" ) {
			$tipoerr="ERRORE:NON HAI SELEZIONATO IL LINK GALLERIE";
			echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_sotmenu_link.php&errore=si&tipoerr=$tipoerr&id=$id/>";	
		}
		else
			$link = $gallerie;		
	break;

	case "in":
		if( $int == "" ) {
			$tipoerr="ERRORE:NON HAI SCRITTO IL LINK INTERNO";
			echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_sotmenu_link.php&errore=si&tipoerr=$tipoerr&id=$id/>";	
		}
		else
			$link = $int;
	break;
	
	case "ex":
		if( $ext == "" ) {
			$tipoerr="ERRORE:NON HAI SCRITTO IL LINK ESTERNO";
			echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_sotmenu_link.php&errore=si&tipoerr=$tipoerr&id=$id/>";	
		}
		else
			$link = $ext;
	break;
	
	case "hm": $link = _URLSITO . "/index.php";
	break;
	
	case "sc": $link = _URLSITO . "/contatti/";
	break;

	case "ec":
		if( $ecommerce == "" ) {
			$tipoerr="ERRORE:NON HAI SELEZIONATO IL LINK ECOMMERCE";
			echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_sotmenu_link.php&errore=si&tipoerr=$tipoerr&id=$id/>";	
		}
		else
			$link = $ecommerce;			
	break;
	
	default: $link = "#";
	break;
}
$str="UPDATE menutipo SET link = '$link', tipolink = '$tipolink' WHERE id = '$id' LIMIT 1";
// query di modifica
$risultato=mysql_query($str);
if (!$risultato)
// controllo se la query di modifica è andata a buon fine
{
$tipoerr="ERRORE: LINK NON INSERITO";
//echo "ERRORE: STATICA NON MODIFICATA";
  //echo "<br/><a href=\"area.php?pag=elenco_notizie.php\">Riprova</a>";
echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_sotmenu_link.php&errore=si&tipoerr=$tipoerr&id=$id\" />";
}
else
	//Header("Location: ");
	echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=conferma.php&from=elenco_menu_new.php\" />";
	exit;


?>  
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
