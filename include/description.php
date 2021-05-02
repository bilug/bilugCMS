<?php
	
	/***** Construzione del meta description in modo dinamico ******/
	
	$DESCRIPTION = '';
	
	$char_replace_pag = Array( "http://", " ", "?", "&", "&amp;" );
	$pag = (isset($_GET['pag'])) ? str_replace( $char_replace_pag, '', $_GET['pag'] ) : '';

	switch( $pag ) {
		case "mail.php": 
			$DESCRIPTION .= "Scrivi a " . _SITO . " con un'email dal sito";
			break;

		case "argo.php":
			$sql = "SELECT argomenti FROM argomenti WHERE id = " . ((int)$_GET['argo']) . " LIMIT 1";
			$rssql = mysql_query( $sql );
			if ( mysql_num_rows( $rssql ) > 0 ) {
				$argomento = mysql_result( $rssql, 0, 0 );
				$DESCRIPTION = "Articoli su $argomento, " . _SITO;
			}
			
			break;
			
		case "news.php":
			$sql = "SELECT titolo, sottotitolo, description FROM notizie WHERE id = " . ((int)$_GET['news']) . " LIMIT 1";
			$rssql = mysql_query( $sql );
			if ( mysql_num_rows( $rssql ) > 0 ) {
				$titolo = mysql_result( $rssql, 0, 0 );
				$sottotitolo = mysql_result( $rssql, 0, 1 );
				$description = mysql_result( $rssql, 0, 2 );
				
				if ( trim( $description ) != '' )
					$DESCRIPTION = $description;
				else	
					$DESCRIPTION = substr( "$titolo, $sottotitolo", 0, 160 );
			}
			
			break;
			
		case "static.php":
			$sql = "SELECT titolo, description FROM statiche WHERE id = " . ((int)$_GET['stat']) . " LIMIT 1";
			$rssql = mysql_query( $sql );
			if ( mysql_num_rows( $rssql ) > 0 ) {
				$titolo = mysql_result( $rssql, 0, 0 );
				$description = mysql_result( $rssql, 0, 1 );
				if ( trim( $description ) != '' )
					$DESCRIPTION = $description;
				else	
					$DESCRIPTION = substr( "Pagina $titolo", 0, 160 );
			}
				
			break;

		case "tag.php":
			$sql = "SELECT nome_tag FROM tag WHERE id = " . ((int)$_GET['tag']) . " LIMIT 1";
			$rssql = mysql_query( $sql );
			if ( mysql_num_rows( $rssql ) > 0 ) {
				$titolo = mysql_result( $rssql, 0, 0 );
				
				$sql = "
					SELECT COUNT(ct.id) 
					FROM notizie n 
					INNER JOIN collegamento_tag ct ON ct.id_notizia = n.id
					WHERE n.autorizza = 'si' AND ct.id_tag = " . ((int)$_GET['tag']) . " 
				";
				$rssql = mysql_query( $sql );
				$num_news = mysql_result( $rssql, 0, 0 );
				$DESCRIPTION .= "Articoli corrispondenti al TAG '$titolo': $num_news news presenti";
			}
		break;	
			
		case "ecommerce.php":  
		case "ecommerce_ris.php":
			$DESCRIPTION = "Articoli ";
			if ( isset( $_GET['categoria'] ) ) {
				$sql = "SELECT categoria FROM ecommercecategoria WHERE id = " . (int)$_GET['categoria'] . " LIMIT 1";
				$rssql = mysql_query( $sql );
				$categoria = mysql_result( $rssql, 0, 0 );
				$DESCRIPTION .= "$categoria ";
			}
			if ( isset( $_GET['prod'] ) ) {
				$prod = apici( $_GET['prod'] ) . " ";
				$DESCRIPTION .= "- $prod ";
			}
			if ( isset( $_POST['cerca'] ) == "si" ) {
				$cerca = apici( $_POST['parola'] ) . " ";
				$DESCRIPTION = "$cerca in vendita " . _SITO;
			}
			
			break;
			
		case "ecommerce_dettaglio.php":
			$DESCRIPTION = "Entra nel nostro ecommerce";
			$sql = "
				SELECT e.titolo, ec.categoria 
				FROM ecommerce e 
				INNER JOIN ecommercecategoria ec ON ec.id = e.categoria 
				WHERE e.id = " . ((int)$_GET['id']) . " 
				LIMIT 1
			";
			$rssql = mysql_query( $sql );
			if ( mysql_num_rows( $rssql ) > 0 ) {
				$r = mysql_fetch_row( $rssql );
				$titolo = trim( $r[0] );
				$catgegoria = trim( $r[1] );
							
				$DESCRIPTION = "$titolo in vendita su " . _SITO . ", cerca offerte e prezzi per $categoria.";
			}
					
			break;

		case "ecommerce_dettaglio_carrello.php":
			$DESCRIPTION = "Dettaglio del tuo carrello, riguarda i tuoi acquisti acquisti";
			break;
					
		case "mese_eventoapp.php":
			$nomemese = Array("Gennaio","Febbraio","Marzo","Aprile","Maggio","Giugno", "Luglio","Agosto","Settembre","Ottobre","Novembre","Dicembre");
			
			$sql = "SELECT YEAR(dataora), MONTH(dataora), descrizione, titolo, tipo FROM eventi WHERE YEAR(dataora) = " . ((int)$_POST['anno']) . " AND MONTH(dataora) = " . ((int)$_POST['mese']);
			$rssql = mysql_query( $sql );
			if ( mysql_num_rows( $rssql ) > 0 ) {
				$yyyy = mysql_result( $rssql, 0, 0 );
				$mm = mysql_result( $rssql, 0, 1 );
				$mm = $nomemese[$mm-1];
				$DESCRIPTION = "Eventi e Appuntamenti di $mm $yyyy";

				$rssql = mysql_query( $sql );
				
				if ( mysql_num_rows( $rssql ) > 0 ) {
					while( $r = mysql_fetch_array( $rssql ) ) {
						$tipo = $r[4];
						
						if ( $tipo == "A" )
							$DESCRIPTION .= ", Appuntamento";
						else
							$DESCRIPTION .= ", Evento";
							
						$titolo = $r[3];
						$DESCRIPTION .= " $titolo";
					}
				}
			}
			
			break;
			
		case "cerca.php":
			$DESCRIPTION = "Ricerca in " . _SITO;
			if ( @$_POST["cerca"] )
				$DESCRIPTION .= " " . apici( $_POST["cerca"] );
			break;

		case "google.php": // Il cerca di Google viene fatto con ajax, quindi non riesco a recuperare il valore della ricerca
			$DESCRIPTION = _META_DESCRIPTION;
			break;
			
		case "vedi_voto.php": // sondaggi
			$DESCRIPTION = "Compila i sondaggi,"; 

			$sql = "SELECT titolo FROM sondaggi WHERE id = " . ((int)$_GET['id']) . " LIMIT 1";
			$rssql = mysql_query( $sql );
			if ( mysql_num_rows( $rssql ) > 0 ) {
				$titolo = mysql_result( $rssql, 0, 0 );
				$DESCRIPTION .= " Sondaggio numero " . ((int)$_GET['id']) . " $titolo, ";
			}
			
			break;
			
		case "galleriaarg.php":
			$DESCRIPTION = "Visita la galleria "; 

			$sql = "SELECT cartella, descrizione FROM galleria WHERE id = " . ((int)$_GET['d']) . " LIMIT 1";
			$rssql = mysql_query( $sql );
			if ( mysql_num_rows( $rssql ) > 0 ) {
				$titolo = galleria_visualizza(mysql_result( $rssql, 0, 0 ));
				$descrizione = mysql_result( $rssql, 0, 1 );
				$DESCRIPTION .= "Visita la galleria $titolo";
				if ( $descrizione != '' )
					$DESCRIPTION .= ". $descrizione";
			}
			else
				$DESCRIPTION .=  "Visita la galleria.";
				
			break;
			
		case "galleria.php":
			$sql = "SELECT cartella FROM galleria WHERE id = " . ((int)$_GET['d']) . " LIMIT 1";
			$rssql = mysql_query( $sql );

			$sql = "SELECT cartella, descrizione FROM galleria WHERE id = " . ((int)$_GET['argo']) . " LIMIT 1";
			$rssql2 = mysql_query( $sql );

			if ( mysql_num_rows( $rssql ) > 0 AND mysql_num_rows( $rssql2 ) > 0 ) {
				$titolo = galleria_visualizza(mysql_result( $rssql, 0, 0 ));
				$titolo2 = galleria_visualizza(mysql_result( $rssql2, 0, 0 ));
				$descrizione = mysql_result( $rssql2, 0, 1 );				
				$DESCRIPTION .= "Visita la galleria $titolo &gt;&gt; $titolo2";
				if ( $descrizione != '' )
					$DESCRIPTION .= ". $descrizione";
			}
			else
				$DESCRIPTION .=  "Visita la galleria";	
			
			break;
			
		default: 
			$DESCRIPTION = _META_DESCRIPTION; 
			break;
	}
	
	$DESCRIPTION = substr( $DESCRIPTION, 0, 150 );
	
	echo "<meta name=\"description\" content=\"$DESCRIPTION\" />";

?>
