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
$modulo = apici($_POST['modulo']);
$titolo = apici($_POST['titolo']);
$titvideo = apici($_POST['titvideo']);
$titvideo_en = apici($_POST['titvideo_en']);
$titvideo_fr = apici($_POST['titvideo_fr']);
$titvideo_de = apici($_POST['titvideo_de']);
$titvideo_es = apici($_POST['titvideo_es']);
$titvideo_pt = apici($_POST['titvideo_pt']);
$posizione = $_POST['posizione'];
$attivo = $_POST['attivo'];
$zona = $_POST['zona'];
$ordine = $_POST['ordine'];

if (!$id)
// se l'id non ha un valore, allora siamo in fase di inserimento
{
	if (($titolo=="") OR ($modulo==""))
   {
   	$tipoerr="ERRORE: NON HAI INSERITO UN CAMPO OBBLIGATORIO";
   	//echo "ERRORE: NON HAI INSERITO UN CAMPO OBBLIGATORIO";
    	//echo "<br/><a href=\"area.php?pag=insert_moduli.php\">Riprova</a>";
    	echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_moduli.php&errore=si&tipoerr=$tipoerr&titolo=$titolo&modulo=$modulo&titvideo=$titvideo&posizione=$posizione&attivo=$attivo&zona=$zona&ordine=$ordine&titvideo_en=$titvideo_en&titvideo_fr=$titvideo_fr&titvideo_de=$titvideo_de&titvideo_es=$titvideo_es&titvideo_pt=$titvideo_pt\" />";
   }
   else
   {
   	$str2=" SELECT ID FROM moduli where modulo='$modulo'";
    	// facciamo una query per verificare se esiste nel DB una notizia già inserita
    	$risultato2=mysql_query($str2);
    	if (mysql_num_rows($risultato2)>0)
    	{
      	// se la nostra query di controllo genera un risultato, generiamo un errore
        	$tipoerr="MODULO GIA' PRESENTE";
        	//echo "MODULO GIA' PRESENTE";
        	//echo "<br/><a href=\"area.php?pag=insert_moduli.php\">Riprova</a>";
        	echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_moduli.php&errore=si&tipoerr=$tipoerr&titolo=$titolo&modulo=$modulo&titvideo=$titvideo&posizione=$posizione&attivo=$attivo&zona=$zona&ordine=$ordine&titvideo_en=$titvideo_en&titvideo_fr=$titvideo_fr&titvideo_de=$titvideo_de&titvideo_es=$titvideo_es&titvideo_pt=$titvideo_pt\" />";
    	}
    	else
    	// se la nostra query di controllo non genera alcun risultato, procediamo con l'inserimento
    	{
    		$str="INSERT INTO moduli (titolo,titvideo,titvideo_en,titvideo_fr,titvideo_de,titvideo_es,titvideo_pt,modulo,posizione,attivo,zona, ordine) VALUES ('$titolo','$titvideo','$titvideo_en','$titvideo_fr','$titvideo_de','$titvideo_es','$titvideo_pt', '$modulo','$posizione','$attivo','$zona', '$ordine')";
         // query di inserimento
         $risultato=mysql_query($str);
         if (!$risultato)
         // controllo se la query di inserimento è andata a buon fine
         {
         	$tipoerr="ERRORE: MODULO NON INSERITA";
         	//echo "ERRORE: MODULO NON INSERITA";
            //echo "<br/><a href=\"area.php?pag=insert_moduli.php\">Riprova</a>";
            echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_moduli.php&errore=si&tipoerr=$tipoerr&titolo=$titolo&modulo=$modulo&titvideo=$titvideo&posizione=$posizione&attivo=$attivo&zona=$zona&ordine=$ordine&titvideo_en=$titvideo_en&titvideo_fr=$titvideo_fr&titvideo_de=$titvideo_de&titvideo_es=$titvideo_es&titvideo_pt=$titvideo_pt\" />";
         }
         else
         	//Header("Location: ");
			echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=conferma.php&from=elenco_moduli_new.php\" />";
            
         exit;
    	}
	}
}
else
// se l'id ha un valore, allora siamo in fase di modifica
{
	$str="UPDATE moduli SET titolo = '$titolo', titvideo = '$titvideo', titvideo_en = '$titvideo_en', titvideo_fr = '$titvideo_fr', titvideo_de = '$titvideo_de', titvideo_es = '$titvideo_es', titvideo_pt = '$titvideo_pt', modulo = '$modulo',posizione ='$posizione',attivo = '$attivo',zona='$zona', ordine = '$ordine' WHERE ID = '$id'";
   // query di modifica
   $risultato=mysql_query($str);
   if (!$risultato)
   // controllo se la query di modifica è andata a buon fine
   {
   	$tipoerr="ERRORE: MODULO NON MODIFICATO";
   	//echo "ERRORE: MODULO NON MODIFICATO";
      //echo "<br/><a href=\"area.php?pag=elenco_moduli_new.php\">Riprova</a>";
      echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_moduli.php&errore=si&tipoerr=$tipoerr&titolo=$titolo&modulo=$modulo&titvideo=$titvideo&posizione=$posizione&attivo=$attivo&zona=$zona&ordine=$ordine&titvideo_en=$titvideo_en&titvideo_fr=$titvideo_fr&titvideo_de=$titvideo_de&titvideo_es=$titvideo_es&titvideo_pt=$titvideo_pt\" />";
   }
   else
  		//Header("Location: ");
		echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=conferma.php&from=elenco_moduli_new.php\" />";
   
   exit;
}
?>
