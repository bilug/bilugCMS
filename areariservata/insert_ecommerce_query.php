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

$id = apici($_POST['id']);
$titolo = apici($_POST['titolo']);
$descrizione = $_POST['descrizione'];
$categoria = (int)$_POST['categoria'];
$prezzo = apici($_POST['prezzo']);
$prezzo_intero = apici($_POST['prezzo_intero']);
$quantita = apici($_POST['quantita']);
$foto = apici($_POST['foto']);
$foto = str_replace( ';', '', $foto );
$fotofac = apici($_POST['fotofac']);
$codice = apici($_POST['codice']);
$produttore = apici($_POST['produttore']);
$spedizione = apici($_POST['spedizione']);
$riservato = apici($_POST['riservato']);
$colore = apici($_POST['colore']);
$taglia = apici($_POST['taglia']);
$evidenzia = $_POST['evidenzia'];
$offerta = $_POST['offerta'];


if ( $titolo == "" OR $categoria == "" OR $codice == "" ) {
	$tipoerr="ERRORE: NON HAI INSERITO UN CAMPO OBBLIGATORIO";
	echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_ecommerce.php&errore=si&tipoerr=$tipoerr&titolo=$titolo&descrizione=$descrizione&categoria=$r&prezzo=$prezzo&prezzo_intero=$prezzo_intero&quantita=$quantita&foto=$foto&fotofac=$fotofac&codice=$codice&produttore=$produttore&spedizione=$spedizione&riservato=$riservato&colore=$colore&taglia=$taglia&evidenzia=$evidenzia&offerta=$offerta\" />";
} 
else {
	// se l'id non ha un valore, allora siamo in fase di inserimento
	if (!$id) {
		$ctrl = "SELECT id FROM ecommerce WHERE codice = '$codice' LIMIT 1";
		$rsctrl = mysql_query($ctrl);
		if ( mysql_num_rows($rsctrl) == 1 ) {
			$tipoerr="ERRORE: ARTICOLO GIA ESISTENTE";
			echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_ecommerce.php&errore=si&tipoerr=$tipoerr&titolo=$titolo&descrizione=$descrizione&categoria=$r&prezzo=$prezzo&prezzo_intero=$prezzo_intero&quantita=$quantita&foto=$foto&fotofac=$fotofac&codice=$codice&produttore=$produttore&spedizione=$spedizione&riservato=$riservato&colore=$colore&taglia=$taglia&evidenzia=$evidenzia&offerta=$offerta\" />";	
		}
		else
		{    
			$str="INSERT INTO ecommerce (titolo, descrizione, categoria, prezzo, prezzo_intero, quantita, foto, fotofacoltative, codice, produttore, spedizione, riservato, colore, taglia, evidenzia, offerta) VALUES ('$titolo', '$descrizione', '$categoria', '$prezzo', '$prezzo_intero', '$quantita', '$foto', '$fotofac', '$codice', '$produttore', '$spedizione', '$riservato', '$colore', '$taglia', $evidenzia, $offerta)";
			 // query di inserimento
			 $risultato=mysql_query($str);
			 if (!$risultato)
			 // controllo se la query di inserimento è andata a buon fine
			 {
				$tipoerr="ERRORE: ARTICOLO NON INSERITO";
				
				echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_ecommerce.php&errore=si&tipoerr=$tipoerr&titolo=$titolo&descrizione=$descrizione&categoria=$r&prezzo=$prezzo&prezzo_intero=$prezzo_intero&quantita=$quantita&foto=$foto&fotofac=$fotofac&codice=$codice&produttore=$produttore&spedizione=$spedizione&riservato=$riservato&colore=$colore&taglia=$taglia&evidenzia=$evidenzia&offerta=$offerta\" />";
			 }
			 else
			 {            	
				//Header("Location: ");
				echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=conferma.php&from=elenco_ecommerce_categorie.php\" />";
			 }
			 exit;
		}

	}
	else
	{
		$ctrl = "SELECT id FROM ecommerce WHERE codice = '$codice' AND id != $id LIMIT 1";
		$rsctrl = mysql_query($ctrl);
		if ( mysql_num_rows($rsctrl) == 1 ) {
			$tipoerr="ERRORE: ARTICOLO GIA ESISTENTE";
			echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_ecommerce.php&errore=si&tipoerr=$tipoerr&titolo=$titolo&descrizione=$descrizione&categoria=$r&prezzo=$prezzo&prezzo_intero=$prezzo_intero&quantita=$quantita&foto=$foto&fotofac=$fotofac&codice=$codice&produttore=$produttore&spedizione=$spedizione&riservato=$riservato&colore=$colore&taglia=$taglia&evidenzia=$evidenzia&offerta=$offerta\" />";	
		}
		else {
			$str="UPDATE ecommerce SET titolo = '$titolo', descrizione = '$descrizione', categoria = '$categoria', prezzo = '$prezzo', quantita = '$quantita', prezzo_intero = '$prezzo_intero', foto = '$foto', fotofacoltative = '$fotofac', codice = '$codice', produttore = '$produttore', spedizione = '$spedizione', riservato = $riservato, colore = '$colore', taglia = '$taglia', evidenzia = $evidenzia, offerta = $offerta WHERE id = '$id' LIMIT 1";
			// query di modifica
			$risultato=mysql_query($str);
			// controllo se la query di modifica è andata a buon fine
			if (!$risultato) {
				$tipoerr="ERRORE: ARTICOLO NON MODIFICATA";
				echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_ecommerce.php&errore=si&tipoerr=$tipoerr&titolo=$titolo&descrizione=$descrizione&categoria=$r&prezzo=$prezzo&prezzo_intero=$prezzo_intero&quantita=$quantita&foto=$foto&fotofac=$fotofac&codice=$codice&produttore=$produttore&spedizione=$spedizione&riservato=$riservato&colore=$colore&taglia=$taglia&evidenzia=$evidenzia&offerta=$offerta\" />";
			}
			else
				echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=conferma.php&from=elenco_ecommerce_categorie.php\" />";
		}
		exit;
		
	}
}
?>
