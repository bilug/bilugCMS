<meta property="fb:admins" content="100000847123462,1329020353" />

<?php
	$char_replace_pag = Array( "http://", " ", "?", "&", "&amp;" );
	$pag = str_replace( $char_replace_pag, '', $_GET['pag'] );
	
	$og_image = '';
	$og_url = '';
	
	switch( $pag ) {
		case 'news.php':
			$sql = "SELECT testo, ID FROM notizie AS n WHERE n.id = " . ((int)$_GET['news']) . " LIMIT 1";
			$rssql = mysql_query( $sql );
			if ( mysql_num_rows( $rssql ) > 0 ) {
				$r = mysql_fetch_row( $rssql );		
				$og_image = estrai_immagine_principale( $r[0] );
				$og_url = rurl( $r[1], 'news' );				
			}
		break;		
		
		case 'static.php':
			$sql = "SELECT corpo, ID FROM statiche WHERE id = " . ((int)$_GET['stat']) . " LIMIT 1";
			$rssql = mysql_query( $sql );
			if ( mysql_num_rows( $rssql ) > 0 ) {
				$r = mysql_fetch_row( $rssql );		
				$og_image = estrai_immagine_principale( $r[0] );
				$og_url = rurl( $r[1], 'static' );				
			}
		break;
		
		/*case 'galleriaarg.php':
			$sql = "SELECT cartella FROM galleria WHERE id = " . ((int)$_GET['d']) . " LIMIT 1";
			$rssql = mysql_query( $sql );
			if ( mysql_num_rows( $rssql ) > 0 ) {
				$titolo = galleria_visualizza(mysql_result( $rssql, 0, 0 ));
				$TITLE .= "Galleria $titolo | ";
				$TITLE .=  _SITO;
			}
			else
				$TITLE .=  "Galleria | " . _SITO;	*/	
		break;
		
		case 'galleria.php':
			$sql = "SELECT cartella FROM galleria WHERE id = " . ((int)$_GET['d']) . " LIMIT 1";
			$rssql = mysql_query( $sql );

			$sql = "SELECT cartella FROM galleria WHERE id = " . ((int)$_GET['argo']) . " LIMIT 1";
			$rssql2 = mysql_query( $sql );
			
			if ( mysql_num_rows( $rssql ) > 0 AND mysql_num_rows( $rssql2 ) > 0 ) {
				$titolo = mysql_result( $rssql, 0, 0 );
				$titolo2 = mysql_result( $rssql2, 0, 0 );

				$id = (int)$_GET['argo'];
				$sql = "SELECT immagine FROM galleria WHERE id_padre = $id LIMIT 1";
				$rssql = mysql_query( $sql );

				$r = mysql_fetch_row( $rssql );		
				$og_image = $r[0];
				$directory = _URLSITO."/gals/".$titolo."/".$titolo2."/";
				$og_image = _URLSITO . "/utility/thump.php?w=".(_MAX_LARG_FOTO-10)."&amp;h=".(_MAX_LARG_FOTO-10)."&amp;file=".$directory.$r[0];
				$og_url = rurl( $id, 'gals-sub' );
			}
		break;
		
		default: 
			$og_image = estrai_immagine_principale( '' );
			$og_url = _URLSITO;
			break;
	}
?>

<?php
	// Recuper il titolo della pagina dal TITLE
	$og_title = $TITLE;
?>

<meta property="og:type" content="article" />
<meta property="og:title" content="<?=$og_title?>" />
<meta property="og:image" content="<?=$og_image?>" />
<meta property="og:url" content="<?=$og_url?>" />

<link rel="image_src" type="image/jpeg" href="<?=$og_image?>" />
