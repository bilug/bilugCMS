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
$contatel = $_POST['contatel'];
$contaemail = $_POST['contaemail'];
$ragsoc = apici($_POST['ragsoc']);
$ragsoc1 = apici($_POST['ragsoc1']);
$ragsoc2 = apici($_POST['ragsoc2']);
$citta = apici($_POST['citta']);
$cap = apici($_POST['cap']);
$prov = apici($_POST['prov']);
for ($i=0;$i<$contatel;$i++)
{
	$str = "$"."_POST[\"tipotel".$i."\"]".".$"."_POST[\"telefoni".$i."\"]";
	eval("\$tel .= $str.';';");
}
for ($i=0;$i<$contaemail;$i++)
{
	$str = "$"."_POST[\"tipoemail".$i."\"]".".$"."_POST[\"emailtxt".$i."\"]";
	eval("\$email .= $str.';';");
}
$note = $_POST['note'];


if (!$id)
// se l'id non ha un valore, allora siamo in fase di inserimento
{
	if ($ragsoc=="") 
   {
		$tipoerr="ERRORE: INSERIRE ALMENO UN NOME ";
		//echo "ERRORE: INSERIRE ALMENO UN NOME ";
    	//echo "<br/><a href=\"area.php?pag=insert_rubrica.php\">Riprova</a>";
    	//echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_rubrica.php&errore=si&tipoerr=$tipoerr&contatel=$contatel&contaemeil=$contaemeil&ragsoc=$ragsoc&ragsoc1=$ragsoc1&ragsoc2=$ragsoc2&citta=$citta&cap=$cap&prov=$prov&note=$note&email=$email\" />";
    	$refer=httpServletRequest.getHeader("Referer");
    	echo " $refer";
   }
   else
   	// se la nostra query di controllo non genera alcun risultato, procediamo con l'inserimento
   {
		$str="INSERT INTO rubrica SET  ragsoc = '$ragsoc',ragsoc1 = '$ragsoc1', ragsoc2 = '$ragsoc2'
		, citta = '$citta', cap = '$cap', prov = '$prov', tel = '$tel', email = '$email',note = '$note'";
		
      // query di inserimento
      $risultato=mysql_query($str);
      if (!$risultato)
      // controllo se la query di inserimento è andata a buon fine
      {
		$tipoerr="ERRORE: DATI RUBRICA NON INSERITI";
      	//echo "ERRORE: DATI RUBRICA NON INSERITI";
        // echo "<br/><a href=\"area.php?pag=insert_rubrica.php\">Riprova</a>";
        echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_rubrica.php&errore=si&tipoerr=$tipoerr&contatel=$contatel&contaemeil=$contaemeil&ragsoc=$ragsoc&ragsoc1=$ragsoc1&ragsoc2=$ragsoc2&citta=$citta&cap=$cap&prov=$prov&note=$note\" />";
      }
      else
      	//Header("Location: ");
		echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=conferma.php&from=elenco_rubrica.php\" />";
         
      exit;
   }   
}
else
// se l'id ha un valore, allora siamo in fase di modifica
{
	if ($ragsoc=="")
   {
		$tipoerr="ERRORE: INSERIRE ALMENO UN NOME ";
		//echo "ERRORE: INSERIRE ALMENO UN NOME ";
    	//echo "<br/><a href=\"area.php?pag=insert_rubrica.php\">Riprova</a>";
    	echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_rubrica.php&errore=si&tipoerr=$tipoerr&contatel=$contatel&contaemeil=$contaemeil&ragsoc=$ragsoc&ragsoc1=$ragsoc1&ragsoc2=$ragsoc2&citta=$citta&cap=$cap&prov=$prov&note=$note\" />";
   }
   else
   {
   	$str=" UPDATE rubrica  SET  ragsoc = '$ragsoc',ragsoc1 = '$ragsoc1', ragsoc2 = '$ragsoc2'
		, citta = '$citta', cap = '$cap', prov = '$prov', tel = '$tel', email = '$email',note = '$note' WHERE ID = '$id'";
	
    	// query di modifica
    	$risultato=mysql_query($str);
    	if (!$risultato)
    	// controllo se la query di modifica è andata a buon fine
      {
			$tipoerr="ERRORE: DATI RUBRICA NON MODIFICATI";
			//echo "ERRORE: DATI RUBRICA NON MODIFICATI";
			//echo "<br/><a href=\"area.php?pag=insert_rubrica.php\">Riprova</a>";
			echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_rubrica.php&errore=si&tipoerr=$tipoerr&contatel=$contatel&contaemeil=$contaemeil&ragsoc=$ragsoc&ragsoc1=$ragsoc1&ragsoc2=$ragsoc2&citta=$citta&cap=$cap&prov=$prov&note=$note\" />";
      }
    	else
    		//Header("Location: ");
			echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=conferma.php&from=elenco_rubrica.php\" />";
    
    	exit;
   }
}
?>
