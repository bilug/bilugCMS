<?php
	
	/***** Construzione del TITLE della pagina dinamico in modo dinamico ******/
	
	$char_replace_pag = Array( "http://", " ", "?", "&", "&amp;" );
	$pag = (isset($_GET['pag'])) ? str_replace( $char_replace_pag, '', $_GET['pag'] ) : '';
	
	$TITLE = '';
	
	switch( $pag ) {
		case "mail.php": 
			$TITLE .= "Contatti | ";
			$TITLE .=  _SITO;
		break;

		case "argo.php":
			$sql = "SELECT argomenti FROM argomenti WHERE id = " . ((int)$_GET['argo']) . " LIMIT 1";
			$rssql = mysql_query( $sql );
			if ( mysql_num_rows( $rssql ) > 0 ) {
				$argomento = mysql_result( $rssql, 0, 0 );
				$TITLE .= "Argomento $argomento | ";
			}
			$TITLE .=  _SITO;
		break;
			
		case "news.php":
			$sql = "
				SELECT n.titolo, n.sottotitolo, a.argomenti  
				FROM notizie AS n 
				INNER JOIN argomenti AS a ON n.argomento = a.ID 
				WHERE n.id = " . ((int)$_GET['news']) . " 
				LIMIT 1
			";
			$rssql = mysql_query( $sql );
			if ( mysql_num_rows( $rssql ) > 0 ) {
				$argomento = mysql_result( $rssql, 0, 2 );
				$titolo = mysql_result( $rssql, 0, 0 );
				$sottotitolo = mysql_result( $rssql, 0, 1 );
				$TITLE .= "$titolo, argomento $argomento | ";
			}
			$TITLE .=  _SITO;
		break;
			
		case "static.php":
			$sql = "SELECT titolo FROM statiche WHERE id = " . ((int)$_GET['stat']) . " LIMIT 1";
			$rssql = mysql_query( $sql );
			if ( mysql_num_rows( $rssql ) > 0 ) {
				$titolo = mysql_result( $rssql, 0, 0 );
				$TITLE .= "$titolo | ";
			}
			$TITLE .=  _SITO;
		break;

		case "tag.php":
			$sql = "SELECT nome_tag FROM tag WHERE id = " . ((int)$_GET['tag']) . " LIMIT 1";
			$rssql = mysql_query( $sql );
			if ( mysql_num_rows( $rssql ) > 0 ) {
				$titolo = mysql_result( $rssql, 0, 0 );
				$TITLE .= "Tag: $titolo | ";
			}
			$TITLE .=  _SITO;
		break;	
		
		case "ecommerce.php":  
		case "ecommerce_ris.php":
			if ( isset( $_GET['categoria'] ) ) {
				$sql = "SELECT categoria FROM ecommercecategoria WHERE id = " . (int)$_GET['categoria'] . " LIMIT 1";
				$rssql = mysql_query( $sql );
				$categoria = mysql_result( $rssql, 0, 0 );
				$TITLE .= ( mysql_num_rows( $rssql ) > 0 ) ? $categoria . ' ' : 'e-commerce ';
			}
			if ( isset( $_GET['prod'] ) ) {
				$prod = apici( $_GET['prod'] ) . " ";
				$TITLE .= '- ' . $prod;
				$TITLE .= ", offerte $categoria in vendita | ";
			}
			elseif ( isset( $_POST['cerca'] ) == "si" ) {
				$cerca = "Cerca \"".apici( $_POST['parola'] )."\" | ";
				$TITLE = $cerca;
			}
			else {
				$TITLE .= "E-commerce | ";	
			}

			$TITLE .=  _SITO;			
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
				$TITLE .= "$titolo - Categoria $categoria | ";
			}
			$TITLE .=  _SITO;
		break;	
		
		case "ecommerce_dettaglio_carrello.php":
			$TITLE .= "E-commerce dettaglio del carrello | " . _SITO;
		break;
					
		case "mese_eventoapp.php":
			$nomemese = Array("Gennaio","Febbraio","Marzo","Aprile","Maggio","Giugno", "Luglio","Agosto","Settembre","Ottobre","Novembre","Dicembre");
			
			$sql = "SELECT YEAR(dataora), MONTH(dataora) FROM eventi WHERE YEAR(dataora) = " . ((int)$_POST['anno']) . " AND MONTH(dataora) = " . ((int)$_POST['mese']) . " LIMIT 1";
			$rssql = mysql_query( $sql );
			
			if ( mysql_num_rows( $rssql ) > 0 ) {
				$yyyy = mysql_result( $rssql, 0, 0 );
				$mm = mysql_result( $rssql, 0, 1 );
				$mm = $nomemese[$mm-1];

				$TITLE .= "Eventi e Appuntamenti di $mm $yyyy | ";
			}
			$TITLE .=  _SITO;
		break;
			
		case "cerca.php":
			if ( @$_POST["cerca"] )
				$TITLE .= apici( $_POST["cerca"] ) . " | ";
			$TITLE .= "Cerca nel sito | ";
			$TITLE .=  _SITO;
		break;

		case "google.php": // Il cerca di Google viene fatto con ajax, quindi non riesco a recuperare il valore della ricerca
			$TITLE .= "Cerca con GOOGLE | ";
			$TITLE .=  _SITO;
		break;
			
		case "vedi_voto.php": // sondaggi 
			$sql = "SELECT titolo FROM sondaggi WHERE id = " . ((int)$_GET['id']) . " LIMIT 1";
			$rssql = mysql_query( $sql );
			if ( mysql_num_rows( $rssql ) > 0 ) {
				$titolo = mysql_result( $rssql, 0, 0 );
				$TITLE .= "$titolo | Sondaggio numero " . ((int)$_GET['id']);
				$TITLE .= " | Sondaggi | ";
				$TITLE .=  _SITO;
			}
		break;
			
		case "galleriaarg.php":
			$sql = "SELECT cartella FROM galleria WHERE id = " . ((int)$_GET['d']) . " LIMIT 1";
			$rssql = mysql_query( $sql );
			if ( mysql_num_rows( $rssql ) > 0 ) {
				$titolo = galleria_visualizza(mysql_result( $rssql, 0, 0 ));
				$TITLE .= "Galleria $titolo | ";
				$TITLE .=  _SITO;
			}
			else
				$TITLE .=  "Galleria | " . _SITO;
		break;
			
		case "galleria.php":
			$sql = "SELECT cartella FROM galleria WHERE id = " . ((int)$_GET['d']) . " LIMIT 1";
			$rssql = mysql_query( $sql );

			$sql = "SELECT cartella FROM galleria WHERE id = " . ((int)$_GET['argo']) . " LIMIT 1";
			$rssql2 = mysql_query( $sql );

			if ( mysql_num_rows( $rssql ) > 0 AND mysql_num_rows( $rssql2 ) > 0 ) {
				$titolo = galleria_visualizza(mysql_result( $rssql, 0, 0 ));
				$titolo2 = galleria_visualizza(mysql_result( $rssql2, 0, 0 ));
				
				$TITLE .= "Galleria $titolo &gt;&gt; $titolo2 | ";
				$TITLE .=  _SITO;
			}
			else
				$TITLE .=  "Galleria | " . _SITO;			
		break;
		
		default: 
			$TITLE =  _SITO;
			if ( _SLOGAN != '' ) $TITLE .= ' - ' . _SLOGAN;
		break;
	}
	
	echo "<title>$TITLE</title>";

?>
