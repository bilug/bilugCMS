<?php error_reporting(0); ?>
<?php echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>"; ?>

<?php 
 /*
	Crezione sitemap.xml per crowler dei motori di ricerca
 */
?>

<?php

echo "<urlset 
		xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" 
		xsi:schemaLocation=\"http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd\" 
		xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\"
	>";

require_once("utility/connessione.php");	
require_once("utility/funzioni.php");	
require_once("custom/costanti.php");	

$nomeserver = "http://" . $_SERVER['SERVER_NAME'];


/* Genero pagine statiche */

$url_product = $nomeserver.'/index.php';
echo 
"
	<url>
		<loc>$url_product</loc>
		<changefreq>daily</changefreq>
		<priority>1.0</priority>
	</url>
";


//select them and put them into a dataset called $result
$query = "SELECT ID, titolo FROM statiche ORDER BY id";
$result = mysql_query( $query );

if ( mysql_num_rows( $result ) > 0 ) {
	$url_product = rurl( 0, 'static' );		
	echo 
	"
		<url>
			<loc>$url_product</loc>
			<changefreq>daily</changefreq>
			<priority>0.7</priority>
		</url>
	";	
	//loop through the entire resultset
	while( $control = mysql_fetch_row( $result ) ) {
		//your url-product as we worked out in #4
		$url_product = rurl( $control[0], 'static' );		
		//you can assign whatever changefreq and priority you like
		echo 
		"
			<url>
				<loc>$url_product</loc>
				<changefreq>daily</changefreq>
				<priority>0.9</priority>
			</url>
		";		
	}
}





/* Genero notizie */



//select them and put them into a dataset called $result
$query = "SELECT ID, DATE_FORMAT( data, '%Y-%m-%d' ), titolo FROM notizie WHERE autorizza='si' ORDER BY data DESC" ;
$result = mysql_query( $query );

if ( mysql_num_rows( $result ) > 0 ) {
	$url_product = rurl( 0, 'news' );		
	//you can assign whatever changefreq and priority you like
	echo 
	"
		<url>
			<loc>$url_product</loc>
			<changefreq>daily</changefreq>
			<priority>0.7</priority>
		</url>
	";

	//loop through the entire resultset		
	while( $control = mysql_fetch_row( $result ) ) {
		$url_product = rurl( $control[0], 'news' );
		$displaydate = $control[1];				
		//you can assign whatever changefreq and priority you like
		echo 
		"
			<url>
				<loc>$url_product</loc>
				<lastmod>$displaydate</lastmod>
				<changefreq>daily</changefreq>
				<priority>0.8</priority>
			</url>
		";
	}
}





/* Genero argomenti */



//select them and put them into a dataset called $result
$query = "SELECT a.ID, a.argomenti FROM argomenti a INNER JOIN notizie n ON a.ID = n.argomento GROUP BY a.ID" ;
$result = mysql_query( $query );

if ( mysql_num_rows( $result ) > 0 ) {
	$url_product = rurl( 0, 'argo' );				
	echo 
	"
		<url>
			<loc>$url_product</loc>
			<changefreq>daily</changefreq>
			<priority>0.7</priority>
		</url>
	";

	//loop through the entire resultset		
	while( $control = mysql_fetch_row( $result ) ) {
		$url_product = rurl( $control[0], 'argo' );				
		//you can assign whatever changefreq and priority you like
		echo 
		"
			<url>
				<loc>$url_product</loc>
				<changefreq>daily</changefreq>
				<priority>0.7</priority>
			</url>
		";
	}
}





/* Genero gallerie */

$query = "SELECT id FROM galleria WHERE id_padre = 0 ORDER BY id DESC";
$result = mysql_query( $query );	

if ( mysql_num_rows( $result ) > 0 ) {
	while ( $control = mysql_fetch_row( $result ) ){
		$url_product = rurl( $control[0], 'gals' );
		
		//you can assign whatever changefreq and priority you like
		echo 
		"
			<url>
				<loc>$url_product</loc>
				<changefreq>daily</changefreq>
				<priority>0.7</priority>
			</url>
		";
	}
}


/* Genero sotto-gallerie */

$query = "SELECT id FROM galleria WHERE id_padre > 0 AND cartella != '' ORDER BY id DESC";
$result = mysql_query( $query );	

if ( mysql_num_rows( $result ) > 0 ) {
	while ( $control = mysql_fetch_row( $result ) ){
		$url_product = rurl( $control[0], 'gals-sub' );
		
		//you can assign whatever changefreq and priority you like
		echo 
		"
			<url>
				<loc>$url_product</loc>
				<changefreq>daily</changefreq>
				<priority>0.8</priority>
			</url>
		";
	}
}





/* Genero e-commerce */

$query = "SELECT id FROM ecommerce ORDER BY id DESC";
$result = mysql_query( $query );	

if ( mysql_num_rows( $result ) > 0 ) {
	while ( $control = mysql_fetch_row( $result ) ){
		$url_product = rurl( $control[0], 'ecommerce-dettaglio' );
		//you can assign whatever changefreq and priority you like
		echo 
		"
			<url>
				<loc>$url_product</loc>
				<changefreq>daily</changefreq>
				<priority>0.8</priority>
			</url>
		";
	}
}



/* Genero e-commerce categorie */

$query = "SELECT id FROM ecommercecategoria ORDER BY id DESC";
$result = mysql_query( $query );	

if ( mysql_num_rows( $result ) > 0 ) {
	$url_product = rurl( 0, 'ecommerce' );
	echo 
	"
		<url>
			<loc>$url_product</loc>
			<changefreq>daily</changefreq>
			<priority>0.7</priority>
		</url>
	";
	
	while ( $control = mysql_fetch_row( $result ) ){
		$url_product = rurl( $control[0], 'ecommerce-categorie' );
		//you can assign whatever changefreq and priority you like
		echo 
		"
			<url>
				<loc>$url_product</loc>
				<changefreq>daily</changefreq>
				<priority>0.7</priority>
			</url>
		";
	}
}




//close the XML attribute that we opened in #3
echo "</urlset>";

mysql_close(); //close connection

header("Content-Type: text/xml;charset=utf-8");
?>
