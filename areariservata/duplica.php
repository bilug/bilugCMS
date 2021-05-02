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
	
$id = $_GET['id'];
$from = $_GET['from'];

switch ($from)
	{
		case "elenco_arg.php": 	{
						if($_SESSION['typo']== "U")
						{
							echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=elenco_arg.php\" />";
							$msg = "AZIONE NON CONSENTITA";				  
							confirm($msg);
							exit;
						}
							$table = "argomenti";
							$str="INSERT INTO $table (argomenti) SELECT argomenti FROM $table WHERE id = $id LIMIT 1";
						}
			break;
		case "elenco_statiche.php": 	{
						if($_SESSION['typo']== "U")
						{
							echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=elenco_statiche.php\" />";
							$msg = "AZIONE NON CONSENTITA";				  
							confirm($msg);
							exit;
						}
							$table = "statiche";
							$str="INSERT INTO $table (titolo, corpo, ordine) SELECT titolo, corpo, ordine FROM $table WHERE id = $id LIMIT 1";
						}
			break;
		case "elenco_ecommerce_categorie.php": 	{
						if($_SESSION['typo']== "U")
						{
							echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=elenco_ecommerce_categorie.php\" />";
							$msg = "AZIONE NON CONSENTITA";				  
							confirm($msg);
							exit;
						}

							
							if ( @$_GET['riferimento'] == 'ecommerce_cerca_articolo.php' ) {
								$table = "ecommerce";
								$str="INSERT INTO $table (titolo, descrizione, categoria, prezzo, quantita, foto, fotofacoltative, codice, produttore, spedizione, prezzo_intero, colore, taglia, riservato, evidenzia, offerta) SELECT titolo, descrizione, categoria, prezzo, quantita, foto, fotofacoltative, codice, produttore, spedizione, prezzo_intero, colore, taglia, riservato, evidenzia, offerta FROM $table WHERE id = $id LIMIT 1";
							}
							else {
								$table = "ecommercecategoria";
								$str="INSERT INTO $table (categoria) SELECT categoria FROM $table WHERE id = $id LIMIT 1";
							}
						}
			break;
		case "elenco_spedizioni.php": 	{
						if($_SESSION['typo']== "U")
						{
							echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=elenco_spedizioni.php\" />";
							$msg = "AZIONE NON CONSENTITA";				  
							confirm($msg);
							exit;
						}
							$table = "spedizione";
							$str="INSERT INTO $table (tipo, minore, maggiore, prezzo, standard) SELECT tipo, minore, maggiore, prezzo, standard FROM $table WHERE id = $id LIMIT 1";
						}
			break;
		case "elenco_ecommerce.php": 	{
						if($_SESSION['typo']== "U")
						{
							echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=elenco_ecommerce_categorie.php\" />";
							$msg = "AZIONE NON CONSENTITA";				  
							confirm($msg);
							exit;
						}
							$table = "ecommerce";
							
							if ( @$_GET['rif'] == 'ecommerce_cerca' ) {
								$from = "elenco_ecommerce_categorie.php";
							}
							else {
								$from = "elenco_ecommerce.php&categoria=$_GET[categoria]";
								if ( @$_GET['pag_sc'] == 's' )	$from .= "&sottocat=$_GET[sottocat]";
							}	
							
							$str="INSERT INTO $table (titolo, descrizione, categoria, prezzo, quantita, foto, fotofacoltative, codice, produttore, spedizione, prezzo_intero, colore, taglia, riservato, evidenzia, offerta) SELECT titolo, descrizione, categoria, prezzo, quantita, foto, fotofacoltative, codice, produttore, spedizione, prezzo_intero, colore, taglia, riservato, evidenzia, offerta FROM $table WHERE id = $id LIMIT 1";
						}
			break;
		case "elenco_sondaggi.php": 	{
						if($_SESSION['typo']== "U")
						{
							echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=elenco_sondaggi.php\" />";
							$msg = "AZIONE NON CONSENTITA";				  
							confirm($msg);
							exit;
						}
							$table = "sondaggi";
							$str="INSERT INTO $table (titolo, attivo, opzioni, totali, maxvoti, multipli, data, utenti) SELECT titolo, attivo, opzioni, totali, maxvoti, multipli, data, utenti FROM $table WHERE id = $id LIMIT 1";
						}
			break;
		case "elenco_eventoapp.php": 	{
						if($_SESSION['typo']== "U")
						{
							echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=elenco_eventoapp.php\" />";
							$msg = "AZIONE NON CONSENTITA";				  
							confirm($msg);
							exit;
						}
							$table = "eventi";
							$str="INSERT INTO $table (tipo, dataora, titolo, luogo, descrizione, idutente) SELECT tipo, dataora, titolo, luogo, descrizione, idutente FROM $table WHERE id = $id LIMIT 1";
						}
			break;
			case "elenco_notizieint.php": 	{
						if($_SESSION['typo']== "U")
						{
							echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=elenco_notizieint.php\" />";
							$msg = "AZIONE NON CONSENTITA";				  
							confirm($msg);
							exit;
						}
							$table = "notizieint";
							$str="INSERT INTO $table (titolo, sottotitolo, testo, data, link) SELECT titolo, sottotitolo, testo, data, link FROM $table WHERE id = $id LIMIT 1";
						}
			break;
			case "elenco_all_notizie.php": 	{
							if($_SESSION['typo']== "U")
							{
								$aut=$_SESSION['tux'];
								$queryaut="SELECT autore FROM notizie WHERE id = $id AND autore = '$aut' LIMIT 1";
								$ris= mysql_query($queryaut);
								$ris = mysql_fetch_array($ris);
								if(!$ris)
								{
										echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=elenco_all_notizie.php\" />";
										$msg = "AZIONE NON CONSENTITA";				  
										confirm($msg);
										exit;
								}
							}
							$table = "notizie";
							$str="INSERT INTO $table (titolo, sottotitolo, testo, autore, argomento, data, link, autorizza, evidenzia, filmato) SELECT titolo, sottotitolo, testo, autore, argomento, CURDATE(), link, autorizza, evidenzia, filmato FROM $table WHERE id = $id LIMIT 1";
						}
			break;
			case "elenco_notargaut.php": 	{
							if($_SESSION['typo']== "U")
							{
								$aut=$_SESSION['tux'];
								$queryaut="SELECT autore FROM notizie WHERE id=$id AND autore='$aut'";
								$ris= mysql_query($queryaut);
								$ris = mysql_fetch_array($ris);
								if(!$ris)
								{
										echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=elenco_all_notizie.php\" />";
										$msg = "AZIONE NON CONSENTITA";				  
										confirm($msg);
										exit;
								}
							}
							$table = "notizie";
							$str="INSERT INTO $table (titolo, sottotitolo, testo, autore, argomento, data, link, autorizza, evidenzia, filmato) SELECT titolo, sottotitolo, testo, autore, argomento, CURDATE(), link, autorizza, evidenzia, filmato FROM $table WHERE id = '$id' LIMIT 1";
						}
			break;			
			case "elenco_arg_notizie.php": 	{
							if($_SESSION['typo']== "U")
							{
								$aut=$_SESSION['tux'];
								$queryaut="SELECT autore FROM notizie WHERE id=$id AND autore='$aut' LIMIT 1";
								$ris= mysql_query($queryaut);
								$ris = mysql_fetch_array($ris);
								if(!$ris)
								{
										echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=elenco_notizie.php\" />";
										$msg = "AZIONE NON CONSENTITA";				  
										confirm($msg);
										exit;
								}
							}
								$table = "notizie";
								$from="elenco_notizie.php";
								$str="INSERT INTO $table (titolo, sottotitolo, testo, autore, argomento, data, link, autorizza, evidenzia, filmato) SELECT titolo, sottotitolo, testo, autore, argomento, CURDATE(), link, autorizza, evidenzia, filmato FROM $table WHERE id = '$id' LIMIT 1";
							
						}
			break;
			case "elenco_aut_notizie.php": 	{
							if($_SESSION['typo']== "U")
							{
								$aut=$_SESSION['tux'];
								$queryaut="SELECT autore FROM notizie WHERE id=$id AND autore='$aut' LIMIT 1";
								$ris= mysql_query($queryaut);
								$ris = mysql_fetch_array($ris);
								if(!$ris)
								{
										echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=elenco_notizieaut.php\" />";
										$msg = "AZIONE NON CONSENTITA";				  
										confirm($msg);
										exit;
								}
							}
							$table = "notizie";
							$from="elenco_notizieaut.php";
							$str="INSERT INTO $table (titolo, sottotitolo, testo, autore, argomento, data, link, autorizza, evidenzia, filmato) SELECT titolo, sottotitolo, testo, autore, argomento, CURDATE(), link, autorizza, evidenzia, filmato FROM $table WHERE id = '$id' LIMIT 1";
						}
			break;
			case "elenco_nonaut_notizie.php": 	{
							if($_SESSION['typo']== "U")
							{
								$aut=$_SESSION['tux'];
								$queryaut="SELECT autore FROM notizie WHERE id=$id AND autore='$aut' LIMIT 1";
								$ris= mysql_query($queryaut);
								$ris = mysql_fetch_array($ris);
								if(!$ris)
								{
										echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=elenco_nonaut_notizie.php\" />";
										$msg = "AZIONE NON CONSENTITA";				  
										confirm($msg);
										exit;
								}
							}
							$table = "notizie";
							$str="INSERT INTO $table (titolo, sottotitolo, testo, autore, argomento, data, link, autorizza, evidenzia, filmato) SELECT titolo, sottotitolo, testo, autore, argomento, CURDATE(), link, autorizza, evidenzia, filmato FROM $table WHERE id = '$id' LIMIT 1";
						}
			break;
			case "elenco_partners.php": 	{
							if($_SESSION['typo']== "U")
							{
								$aut=$_SESSION['tux'];
								$queryaut="SELECT autore FROM notizie WHERE id=$id AND autore='$aut'";
								$ris= mysql_query($queryaut);
								$ris = mysql_fetch_array($ris);
								if(!$ris)
								{
										echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=elenco_partners.php\" />";
										$msg = "AZIONE NON CONSENTITA";				  
										confirm($msg);
										exit;
								}
							}
							$table = "partners";
							$str="
								INSERT INTO $table ( link, link_video, ordine ) 
								SELECT p.link, p.link_video, ( tb.ordine + 1 ) 								
								FROM $table AS p 
								JOIN (
									SELECT id, ordine FROM $table ORDER BY ordine DESC LIMIT 1
								) AS tb 
								WHERE p.id = $id
								LIMIT 1							
							";
						}
			break;
	}

	$risultato=mysql_query($str);
	if (!$risultato)
	{
		echo "ERRORE: DATO NON DUPLICATO";
		echo "<br/><a href=\"area.php?pag=$from\">Riprova</a>";
	}
	else
		echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=$from\" />";

	//	Header("Location: area.php?pag=conferma.php&from=$from");
?>
