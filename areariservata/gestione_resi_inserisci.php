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
			<form name=\"conferma\" method=\"GET\" action=\"gestione_resi_inserisci.php\">
			<input type=\"hidden\" name=\"idut\" value=\"$idut\"/>
			<input type=\"hidden\" name=\"canc\" value=\"$canc\"/>
			<h1>Sicuro di voler eliminare il reso?</h1>
			<input type=\"submit\" name=\"delete\" value=\"SI\">";
			echo"<input type=\"button\" class=\"medio\" name=\"Annulla\" value=\"NO\" onclick=\"javascript:window.location='area.php?pag=gestione_resi.php'\" /></form></div>";	
		}
		else
		{
			$str3="UPDATE acquisti SET reso = 0 WHERE utente = '$idut'";
			$risultato3=mysql_query($str3);
			echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=gestione_resi.php\" />";
		}
	}
else
	{
	if($conferma=="")
				{
				//form di richiesta conferma evasione transazione
				echo "<div class=\"contenitore\">
				<form name=\"conferma2\" method=\"GET\" action=\"gestione_resi_inserisci.php\">
				<input type=\"hidden\" name=\"idut\" value=\"$idut\"/>
				<input type=\"hidden\" name=\"canc\" value=\"$canc\"/>
				<h1>Sicuro di voler confermare il reso?</h1>
				<input type=\"submit\" name=\"conferma\" value=\"SI\">";
				echo"<input type=\"button\" class=\"medio\" name=\"Annulla\" value=\"NO\" onclick=\"javascript:window.location='area.php?pag=gestione_resi.php'\" /></form></div>";	
				}
				else
				{				
					// gestico una transazione
					if($idut == "")
					{
						echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=gestione_resi.php\" />";
					}
					else
					{
						//estraggo dal carrello i record dell'utente.
						$query="SELECT utente, codice, nome, cognome, mail, data, indirizzo, citta, cap, importo, articolo, prezzo, spedizione, id FROM acquisti WHERE utente = '$idut' AND reso = 1";
						$resi= mysql_query($query);
						$art_delete = "";
						
						while($acq = mysql_fetch_row($resi))
						{
							$id_acquisto = $acq[13];
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
							
							if(mysql_num_rows($quant) == 1) {
								$q=mysql_fetch_row($quant);
								$quantita = $q[0]+1;
							
								$strq = "UPDATE ecommerce SET quantita = '$quantita' WHERE id = '$q[1]' LIMIT 1";
								mysql_query($strq);
							} 
							else {
								$art_delete .= "<p>$articolo ($codice) - $prezzo</p>";
							}
							
							//Cancello gli articoli resi dagli acquisti
							$str = "UPDATE acquisti SET reso = 2 WHERE id = $id_acquisto LIMIT 1";
							mysql_query($str);
						}
						
						$importo = $importo - $tot_prezzi;
						$strq="UPDATE acquisti SET importo = '$importo' WHERE utente = '$utente'";
						mysql_query($strq);
						
						//invio mail al compratore di conferma reso
						$queryven= "SELECT email FROM email WHERE nome = 'Ecommerce' LIMIT 1";
						$risven=mysql_query($queryven);
						$ven=mysql_fetch_row($risven);
						$venditore = $ven[0];	
						$oggettoc = "Reso Ordine";
						$mail_bodyc = "
							OGGETTO: \r $oggettoc \n\n 
							
							CONFERMA RESO ORDINE: \n 
							Abbiamo ricevuto gli articoli del reso relativo al vostro ordine con Codice transazione: $utente. \n
							
							Ricever&agrave; a breve $tot_prezzi euro. \n\n
						";
						$headerc = "From: $venditore \r\n";
						$headerc .="Reply-To: $venditore \r\n";
						$headerc .="X-Mailer : BiLugcms PHP/" . phpversion();	
						mail($email, $oggettoc, $mail_bodyc, $headerc);	
						
						echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=gestione_resi.php&disp=$disp\" />";
					}
				}
}
