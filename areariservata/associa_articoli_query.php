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
<?php 

require_once("auth.php");

$id = $_POST['id'];
$articoli = ",";
foreach ($_POST as $chiave => $valore)
{
	if ($chiave == "id")
	{
		}
	else
	{
		//echo "$chiave -- $valore <br />";
		$articoli .= $valore.",";
		}
	
	}

if (!$id)
// se l'id non ha un valore, non abbiamo un utente a cui abbinare gli articoli
{
    	$tipoerr="ERRORE: MANCA L'ASSOCIAZIONE CON L'ID UTENTE DELL'AREA RISERVATA";
    	 echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=elenco_ecommerce_categorie.php&errore=si&tipoerr=$tipoerr\" />";
}
else
// se l'id ha un valore, allora siamo in fase di modifica nell'associazione articoli-utente
{
	$str="UPDATE ecommerceris SET articoli = '$articoli' WHERE ID = '$id'";
   // query di modifica
   $risultato=mysql_query($str);
   if (!$risultato)
   // controllo se la query di modifica è andata a buon fine
   {
   	$tipoerr="ERRORE: ARTICOLI NON MODIFICATI";
    echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=elenco_ecommerce_categorie.php&errore=si&tipoerr=$tipoerr\" />";
   }
   else
	echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=elenco_ecommerce_categorie.php&from=elenco_utenti_ecommerce.php\" />";
   
   exit;
}
?>
