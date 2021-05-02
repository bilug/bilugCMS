<?php
	
	/***** Construzione del meta description in modo dinamico ******/
	
	$char_delete = Array( "'", "\"" );
	$char_replace = Array( ",", "." );

	$char_replace_pag = Array( "http://", " ", "?", "&", "&amp;" );
	$pag = (isset($_GET['pag'])) ? str_replace( $char_replace_pag, '', $_GET['pag'] ) : '';
	
	$KEYWORDS = '';
	
	switch( $pag ) {
		case "mail.php": 
			$KEYWORDS .= "contatti";
			break;

		case "argo.php":
			$sql = "SELECT argomenti FROM argomenti WHERE id = " . ((int)$_GET['argo']) . " LIMIT 1";
			$rssql = mysql_query( $sql );
			if ( mysql_num_rows( $rssql ) > 0 ) {
				$argomento = mysql_result( $rssql, 0, 0 );
				$KEYWORDS .= $argomento;
			}
				
			break;
			
		case "news.php":
			$sql = "SELECT titolo, keywords FROM notizie WHERE id = " . ((int)$_GET['news']) . " LIMIT 1";
			$rssql = mysql_query( $sql );
			
			if ( mysql_num_rows( $rssql ) > 0 ) {
				$titolo = str_replace( $char_delete, "", mysql_result( $rssql, 0, 0 ) );
				$titolo = str_replace( $char_replace, "-", $titolo );
				
				$keywords = mysql_result( $rssql, 0, 1 );
				
				if ( trim( $keywords ) != '' )
					$KEYWORDS .= $keywords;
				else {
					$titolo = explode( "-", $titolo );
					$cont = 0;
					foreach( $titolo as $value ) {
						if ( strlen( $value ) > 2 )
							$KEYWORDS .= ",$value";
					}
				}
			}
			
			break;
			
		case "static.php":
			$sql = "SELECT titolo, keywords FROM statiche WHERE id = " . ((int)$_GET['stat']) . " LIMIT 1";
			$rssql = mysql_query( $sql );
			if ( mysql_num_rows( $rssql ) > 0 ) {
				$titolo = str_replace( $char_delete, "", mysql_result( $rssql, 0, 0 ) );
				
				$keywords = mysql_result( $rssql, 0, 1 );
				
				if ( trim( $keywords ) != '' )
					$KEYWORDS .= $keywords;
				else {
					$titolo = explode( "|", $titolo );
					foreach( $titolo as $value ) {
						if ( strlen( $value ) > 2 )
							$KEYWORDS .= ",$value";
					}			
					
				}
			}
			
			break;
			
		case "ecommerce.php":  
		case "ecommerce_ris.php":
			if ( isset( $_GET['categoria'] ) )
				$KEYWORDS .= "ecommerce " . $_GET['categoria'];
			if ( isset( $_GET['prod'] ) )
				$KEYWORDS .= "ecommerce " . $_GET['categoria'] . " " . $_GET['prod'];
			if ( isset( $_POST['cerca'] ) == "si" ) {
				$parola = explode( " ", apici( $_POST['parola'] ) );
				$KEYWORDS .= "ecommerce";
				foreach( $parola as $value ) {
					if ( strlen( $value ) > 2 )
						$KEYWORDS .= " $value";
				}					
			}
			$KEYWORDS = 'E-commerce ' . _SITO;
			break;
			
		case "ecommerce_dettaglio.php":
			$sql = "
				SELECT e.titolo, ec.categoria 
				FROM ecommerce e 
				INNER JOIN ecommercecategoria ec ON ec.id = e.categoria 
				WHERE e.id = " . ((int)$_GET['id']) . " 
				LIMIT 1
			";
			$rssql = mysql_query( $sql );
			if ( mysql_num_rows( $rssql ) > 0 ) {
				$titolo = mysql_result( $rssql, 0, 0 );
				$categoria = mysql_result( $rssql, 0, 1 );
				
				$KEYWORDS .= "ecommerce " . ",$titolo";
				
				if ( $colore != '' )
					$KEYWORDS .= ",$titolo colore $colore";
				if ( $taglia != '' )
					$KEYWORDS .= ",$titolo taglia $taglia";
				if ( $offerta == 1 )
					$KEYWORDS .= ",$titolo in offerta";
			}
			$KEYWORDS = 'E-commerce ' . _SITO;
			
			break;

		case "ecommerce_dettaglio_carrello.php":
			$KEYWORDS .= "controlla carrello ecommerce";
			break;
					
		case "mese_eventoapp.php":
			$nomemese = Array("Gennaio","Febbraio","Marzo","Aprile","Maggio","Giugno", "Luglio","Agosto","Settembre","Ottobre","Novembre","Dicembre");
			
			$sql = "SELECT YEAR(dataora), MONTH(dataora), descrizione, titolo, tipo FROM eventi WHERE YEAR(dataora) = " . ((int)$_POST['anno']) . " AND MONTH(dataora) = " . ((int)$_POST['mese']);
			$rssql = mysql_query( $sql );
			if ( mysql_num_rows( $rssql ) > 0 ) {
				$yyyy = mysql_result( $rssql, 0, 0 );
				$mm = mysql_result( $rssql, 0, 1 );
				$mm = $nomemese[$mm-1];
				$KEYWORDS .= "eventi appuntamenti $mm $yyyy";
				$KEYWORDS .= ",appuntamenti $mm $yyyy";
				$KEYWORDS .= ",eventi $mm $yyyy";

				$rssql = mysql_query( $sql );
				
				if ( mysql_num_rows( $rssql ) > 1 ) {
					while( $r = mysql_fetch_array( $rssql ) ) {
						$tipo = $r[4];
						
						if ( $tipo == "A" )
							$KEYWORDS .= ",appuntamento";
						else
							$KEYWORDS .= ",evento";
							
						$titolo = $r[3];
						$KEYWORDS .= " $titolo";
					}
				}
			}
			
			break;
			
		case "cerca.php":
			if ( @$_POST["cerca"] ) {
				$parola = explode( " ", apici( $_POST['cerca'] ) );
				foreach( $parola as $key ) {
					if ( strlen( $key ) > 2 )
						$KEYWORDS .= " $key";
				}								
			}
				
			break;

		case "google.php": // Il cerca di Google viene fatto con ajax, quindi non riesco a recuperare il valore della ricerca
			$KEYWORDS .= "";
			break;
			
		case "vedi_voto.php": // sondaggi
			$sql = "SELECT titolo FROM sondaggi WHERE id = " . ((int)$_GET['id']) . " LIMIT 1";
			$rssql = mysql_query( $sql );
			if ( mysql_num_rows( $rssql ) > 0 ) {
				$titolo = mysql_result( $rssql, 0, 0 );
				$KEYWORDS .= "compila sondaggio"; 
				foreach( $titolo as $value ) {
					if ( strlen( $value ) > 2 )
						$KEYWORDS .= " $value";
				}
			}						

			break;
			
		case "galleriaarg.php":
			$KEYWORDS .= " galleria ";
			if ( @$_GET['d'] ) {
				$KEYWORDS .= $_GET['d'];
			}
			break;
			
		case "galleria.php":
			$KEYWORDS .= " galleria "; 
			if ( @$_GET['argo'] AND @$_GET['d'] ) {
				$KEYWORDS .= ",galleria " . $_GET['argo'];
				$KEYWORDS .= ",galleria " . $_GET['d'];
				$KEYWORDS .= ",galleria " . $_GET['argo'] . " " . $_GET['d'];
			}
			break;
			
		default: 
			$KEYWORDS = _META_KEYWORDS; 
			break;
	}
	
	$KEYWORDS .= ',' . trim( _META_KEYWORDS );
	$KEYWORDS = strtolower( $KEYWORDS );
	
	
	$KEYWORDS = ''; // Sospensione momentanea. Forse non servono più.
	
	echo "<meta name=\"keywords\" content=\"$KEYWORDS\" />";

?>

