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

$idut = $_GET['idut'];
$canc = $_GET['canc'];
$delete=$_GET['delete'];
$conferma=$_GET['conferma'];

// cancellazione di una transazione
if ($canc == "si" AND $idut != "")
	{
		if($delete=="")
						{
						//form di richiesta conferma eliminazione transazione
						echo "<div class=\"contenitore\">
						<form name=\"conferma\" method=\"GET\" action=\"gestione_acquisti_inserisci.php\" enctype=\"text\">
						<input type=\"hidden\" name=\"idut\" value=\"$idut\"/>
						<input type=\"hidden\" name=\"canc\" value=\"$canc\"/>
						<h1>Sicuro di voler eliminare la transazione?</h1>
						<input type=\"submit\" name=\"delete\" value=\"SI\">";
						echo"<input type=\"button\" class=\"medio\" name=\"Annulla\" value=\"NO\" onclick=\"javascript:window.location='area.php?pag=gestione_transazioni.php'\" /></form></div>";	
						}
						else
						{
						$str3="DELETE FROM carrello WHERE utente='$idut'";
						$risultato3=mysql_query($str3);
						echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=gestione_transazioni.php&disp=$disp\" />";
						}
	}
else
	{
	if($conferma=="")
				{
				//form di richiesta conferma evasione transazione
				echo "<div class=\"contenitore\">
				<form name=\"conferma2\" method=\"GET\" action=\"gestione_acquisti_inserisci.php\" enctype=\"text\">
				<input type=\"hidden\" name=\"idut\" value=\"$idut\"/>
				<input type=\"hidden\" name=\"canc\" value=\"$canc\"/>
				<h1>Sicuro di voler evadere la transazione avendo ricevuto il pagamento?</h1>
				<input type=\"submit\" name=\"conferma\" value=\"SI\">";
				echo"<input type=\"button\" class=\"medio\" name=\"Annulla\" value=\"NO\" onclick=\"javascript:window.location='area.php?pag=gestione_transazioni.php'\" /></form></div>";	
				}
				else
				{				
					// gestico una transazione
					if($idut == "")
					{
						echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=gestione_transazioni.php\" />";
					}
					else
					{
						//estraggo dal carrello i record dell'utente.
						$query="SELECT utente, codice, nome, cognome, email, data, indirizzo, citta, cap, importo, titolo, prezzo, spedizione FROM carrello WHERE elimina = 2 AND utente = '$idut'";
						$acquisto= mysql_query($query);
						
						$tot_prezzi = 0;
						while($acq = mysql_fetch_row($acquisto))
						{
							$articolo = $acq[10];
							$codice = $acq[1];
							$prezzo = $acq[11];
							$utente = $acq[0];
							$nome = $acq[2];
							$cognome = $acq[3];
							$email = $acq[4];
							$data = $acq[5];
							$indirizzo = $acq[6];
							$citta = $acq[7];
							$cap = $acq[8];
							$importo = $acq[9];
							
							$tot_prezzi += $prezzo;
								
							$queryq="SELECT quantita, id FROM ecommerce WHERE codice = '$acq[1]' LIMIT 1";
							$quant= mysql_query($queryq);
							$q=mysql_fetch_row($quant);
							
							if($q[0] <= 0) {
								$disp="no";
							}
							$quantita = $q[0]-1;
							$strq=" UPDATE ecommerce SET quantita = '$quantita' WHERE id = '$q[1]' LIMIT 1";
							mysql_query($strq);

							//carico i dati della transazione sulla table acquisti
							$str="
								INSERT INTO acquisti (utente, articolo, codice, prezzo, importo, mail, indirizzo, citta, cap, nome, cognome, data) 
								VALUES ('$utente', '$articolo', '$codice', '$prezzo', '$importo', '$email', '$indirizzo', '$citta', '$cap', '$nome', '$cognome', '$data')
							"; 
							mysql_query($str);							
						}
						
						$spedizione = $importo - $tot_prezzi;
						$strq=" UPDATE acquisti SET spedizione = '$spedizione' WHERE utente = '$utente'";
						mysql_query($strq);
						
						//cancello la transazione dalla table carrello, poichè viene caricata sulla table acquisti
						$str2="DELETE FROM carrello WHERE utente='$idut'";
						mysql_query($str2);
						
						//invio mail al compratore di conferma evasione ordine
						$queryven= "SELECT email FROM email WHERE nome = 'Ecommerce' LIMIT 1";
						$risven=mysql_query($queryven);
						$ven=mysql_fetch_row($risven);
						$venditore = $ven[0];	
						$oggettoc = "Evasione Ordine";
						$mail_bodyc = "
							OGGETTO: \r $oggettoc \n\n 
							
							CONFERMA EVASIONE ORDINE: \n 
							Abbiamo ricevuto il pagamento relativo al vostro ordine con Codice transazione: $utente. \n
							Vi ringraziamo per l'acquisto effettuato. \n\n
							
							Raccomandiamo di conservare il Codice transazione per eventuali reclami. \n\n
							
							Per effettuare il reso degli articoli ricevuti, seguire la procedura al link qui sotto: \n
							".rurl(0, 'ecommerce-reso')." \n\n
						";
						$headerc = "From: $venditore \r\n";
						$headerc .="Reply-To: $venditore \r\n";
						//$headerc .="X-Mailer : BiLugcms PHP/" . phpversion();	
						mail($email, $oggettoc, $mail_bodyc, $headerc);	
						
						echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=gestione_transazioni.php&disp=$disp\" />";
					}
				}
}
