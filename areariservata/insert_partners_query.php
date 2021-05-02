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
$link = $_POST['link'];
$link_video = apici( $_POST['link_video'] );

if (!$id)
// se l'id non ha un valore, allora siamo in fase di inserimento
{
    if ($link == "" OR $link_video == "" )
    {
		$tipoerr="ERRORE: NON HAI INSERITO NESSUN LINK";
    	//echo "ERRORE: NON HAI INSERITO L'ARGOMENTO";
    	//echo "<BR><a href=\"area.php?pag=insert_arg.php\">Riprova</a>";
    	 echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_partners.php&errore=si&tipoerr=$tipoerr&link=$link&link_video=$link_video\" />";
    }
    else
    {
    	$str2=" SELECT id, link_video FROM partners WHERE link_video = '$link_video' LIMIT 1";
    	// facciamo una query per verificare se esiste nel DB un argomento uguale a quello che si sta inserendo
    	$risultato2=mysql_query($str2);
    	if (mysql_num_rows($risultato2)>0)
    	{
      	// se la nostra query di controllo genera un risultato, generiamo un errore
        	$tipoerr="IL TITOLO DEL LINK GIA' ESISTE";
        	//echo "ARGOMENTO GIA' INSERITO";
        	//echo "<br/><a href=\"area.php?pag=insert_arg.php\">Riprova</a>";
        	echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_partners.php&errore=si&tipoerr=$tipoerr&link=$link&link_video=$link_video\" />";
    	}
    	else
    	// se la nostra query di controllo non genera alcun risultato, procediamo con l'inserimento
    	{
		$sql = "SELECT ordine FROM partners ORDER BY ordine DESC LIMIT 1";
		$rssql = mysql_query( $sql );
		$r = mysql_fetch_array( $rssql );
		$ord = $r[0] + 1;
			
      	$str="INSERT INTO partners ( id, link, link_video, ordine ) VALUES ( NULL, '$link', '$link_video', $ord)";
         // query di inserimento
         $risultato=mysql_query($str);
         if (!$risultato)
         // controllo se la query di inserimento è andata a buon fine
         {
         	$tipoerr="ERRORE: PARTNER NON INSERITO";
         	//echo "ERRORE: ARGOMENTO NON INSERITO";
          // echo "<br/><a href=\"area.php?pag=insert_arg.php\">Riprova</a>";
           echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_partners.php&errore=si&tipoerr=$tipoerr&link=$link&link_video=$link_video\" />";
           
         }
         else
         	//Header("Location: ");
			echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=conferma.php&from=elenco_partners.php\" />";
            
         exit;
    	}
   }
}
else
// se l'id ha un valore, allora siamo in fase di modifica
{	
	$str2=" SELECT id FROM partners WHERE link_video = '$link_video' AND id != '$id' LIMIT 1";
	// facciamo una query per verificare se esiste nel DB un titolo link uguale a quello che si sta modificando
	$risultato2=mysql_query($str2);
	if (mysql_num_rows($risultato2)>0)
	{
	// se la nostra query di controllo genera un risultato, generiamo un errore
		$tipoerr="IL TITOLO DEL LINK GIA' ESISTE";
		//echo "ARGOMENTO GIA' INSERITO";
		//echo "<br/><a href=\"area.php?pag=insert_arg.php\">Riprova</a>";
		echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_partners.php&errore=si&tipoerr=$tipoerr&link=$link&link_video=$link_video&id=$id\" />";
	}
	else
	// se la nostra query di controllo non genera alcun risultato, procediamo con la modifica
	{	
		$str=" UPDATE partners SET link = '$link', link_video = '$link_video' WHERE id = '$id'";
	   // query di modifica
	   $risultato=mysql_query($str);
	   if (!$risultato)
	   // controllo se la query di modifica è andata a buon fine
	   {
		$tipoerr="ERRORE: PARTNERS NON MODIFICATO";
		//echo "ERRORE: ARGOMENTO NON MODIFICATO";
		  //echo "<br/><a href=\"area.php?pag=elenco_arg.php\">Riprova</a>";
		 echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_arg.php&errore=si&tipoerr=$tipoerr&link=$link&link_video=$link_video\" />";
	   }
	   else
		//Header("Location: ");
		echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=conferma.php&from=elenco_partners.php\" />";
		
		exit;
   }
}
?>
