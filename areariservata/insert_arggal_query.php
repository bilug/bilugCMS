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
$arg = rurl_rewrite2( $_POST['arg'] );
$desc = apici( $_POST['desc'] );
$dir='../gals/';

if (!$id)
// se l'id non ha un valore, allora siamo in fase di inserimento
{
    if ($arg=="")
    {
    	$tipoerr="ERRORE: NON HAI INSERITO L'ARGOMENTO";
    	//echo "ERRORE: NON HAI INSERITO L'ARGOMENTO";
    	//echo "<BR><a href=\"area.php?pag=insert_arggal.php\">Riprova</a>";
    	echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_arggal.php&errore=si&tipoerr=$tipoerr&arg=$arg&desc=$desc\" />";
    }
    else
    {
    	if (file_exists($dir.$arg))
    	{
      	$tipoerr="ARGOMENTO GIA' INSERITO";
      	//echo "ARGOMENTO GIA' INSERITO";
       	//echo "<br/><a href=\"area.php?pag=insert_arggal.php\">Riprova</a>";
       	echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_arggal.php&errore=si&tipoerr=$tipoerr&arg=$arg&desc=$desc\" />";
    	}
    	else
    	// se la nostra query di controllo non genera alcun risultato, procediamo con l'inserimento
    	{
    	if (!mkdir($dir.$arg, 0777))            
         {
         	$tipoerr="ERRORE: ARGOMENTO NON INSERITO";
         	//echo "ERRORE: ARGOMENTO NON INSERITO";
			//echo "<br/><a href=\"area.php?pag=insert_arggal.php\">Riprova</a>";
			echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_arggal.php&errore=si&tipoerr=$tipoerr&arg=$arg&desc=$desc\" />";
         }
         else
         {	
			$cartella = $arg;		
         	
			$sql = "INSERT INTO galleria SET id_padre = 0, cartella = '$cartella', descrizione = '$desc'"; 
			mysql_query( $sql );
         	
         	echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=conferma.php&from=elenco_arg_gallerie.php\" />";
         }
        	exit;
    	}
    	
    }
}
else
// se l'id ha un valore, allora siamo in fase di modifica
{
	$sql = "SELECT cartella FROM galleria WHERE id = $id LIMIT 1";
	$rssql = mysql_query( $sql );
	$arg_old = mysql_result( $rssql, 0, 0 );
	
    if ( $arg_old != $arg AND !rename  ( $dir.$arg_old  , $dir.$arg))
    // controllo se la query di modifica è andata a buon fine
    {
		$tipoerr="ERRORE: ARGOMENTO NON MODIFICATO";
		//echo "ERRORE: ARGOMENTO NON MODIFICATO";
      //echo "<br/><a href=\"area.php?pag=elenco_arg_gallerie.php\">Riprova</a>";
      echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_arggal.php&errore=si&tipoerr=$tipoerr\" />";
    }
    else
    {	
		$cartella = $arg;	
    	@unlink($dir.$arg."/".$id.".txt");

		$sql = "UPDATE galleria SET id_padre = 0, cartella = '$cartella', descrizione = '$desc' WHERE id = $id LIMIT 1"; 
		mysql_query( $sql );		
    	//Header("Location: ");
		echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=conferma.php&from=elenco_arg_gallerie.php\" />";
    }
    exit;
}
?>
