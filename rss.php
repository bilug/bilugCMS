<?php session_start(); ?>
<?php error_reporting(0); ?>
<?php echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>"; ?>
<?php 
 /*
	Crezione rss.xml per crowler dei motori di ricerca
 */
?>
<?php

require_once("utility/connessione.php");	
require_once("utility/funzioni.php");	
require_once("custom/costanti.php");	

$sql = "SELECT * FROM datirss LIMIT 1";
$rssql = mysql_query($sql);
$rss = mysql_fetch_assoc($rssql);

?>
<?php

echo "<rss version=\"2.0\" xmlns:dc=\"http://purl.org/dc/elements/1.1/\" xmlns:content=\"http://purl.org/rss/1.0/modules/content/\">";

echo "<channel>";

$nomeserver = _URLSITO;


echo "<title>$rss[titolo]</title>";
echo "<link>$nomeserver</link>";
echo "<description>$rss[descrizione]</description>";
echo "<language>".strtolower($_SESSION['lingua'])."</language>";
echo "<copyright>$rss[copyright]</copyright>";

if ( $rss['image'] != '' ) {
	echo "
		<image>
			<url>$rss[image]</url>
			<title>$rss[titolo]</title>
			<link>$nomeserver</link>
		</image>	
	";
}
	
	

	
	
		

/* Genero pagine statiche */

$url_product = $nomeserver.'/index.php';
echo 
"
	<item>
		<title><![CDATA["._SITO."]]></title>
		<link>$url_product</link>
		<description><![CDATA[ "._META_DESCRIPTION." ]]></description>
		<author>"._SITO."</author>
		<guid isPermaLink=\"true\">$url_product</guid>
	</item>	
";


//select them and put them into a dataset called $result
$query = "SELECT ID, titolo, description FROM statiche ORDER BY id DESC LIMIT 100";
$result = mysql_query( $query );

if ( mysql_num_rows( $result ) > 0 ) {
	//loop through the entire resultset
	while( $control = mysql_fetch_row( $result ) ) {
		//your url-product as we worked out in #4
		$url_product = rurl( $control[0], 'static' );	
		$control[1] = formatta_xml($control[1]);
		$control[2] = formatta_xml($control[2]);
		
		//you can assign whatever changefreq and priority you like
		echo 
		"
			<item>
				<title><![CDATA[$control[1]]]></title>
				<link>$url_product</link>
				<description><![CDATA[$control[2]]]></description>
				<author>"._SITO."</author>
				<guid isPermaLink=\"true\">$url_product</guid>
			</item>	
		";		
	}
}




/* Genero notizie */



//select them and put them into a dataset called $result
$query = "
	SELECT n.ID, DATE_FORMAT( n.data, '%Y-%m-%d' ), n.titolo, n.description, a.argomenti, a.id 
	FROM notizie n 
	INNER JOIN argomenti a ON n.argomento = a.id 
	WHERE n.autorizza='si' 
	ORDER BY n.data DESC 
	LIMIT 100
";
$result = mysql_query( $query );

if ( mysql_num_rows( $result ) > 0 ) {
	//loop through the entire resultset		
	while( $control = mysql_fetch_row( $result ) ) {
		$url_product = rurl( $control[0], 'news' );
		$url_product_argo = rurl( $control[5], 'argo' );
		$control[2] = formatta_xml($control[2]);
		$control[3] = formatta_xml($control[3]);
		$control[4] = formatta_xml($control[4]);
		
		//you can assign whatever changefreq and priority you like
		echo 
		"
			<item>
				<title><![CDATA[$control[2]]]></title>
				<link>$url_product</link>
				<description><![CDATA[ $control[3] ]]></description>
				<author>"._SITO."</author>
				<pubDate>$control[1]</pubDate>
				<category domain=\"$url_product_argo\">$control[4]</category>
				<guid isPermaLink=\"true\">$url_product</guid>
			</item>
		";
	}
}





/* Genero gallerie */

$query = "SELECT id, cartella, descrizione FROM galleria WHERE id_padre > 0 AND cartella != '' ORDER BY id DESC LIMIT 100";
$result = mysql_query( $query );	

if ( mysql_num_rows( $result ) > 0 ) {
	while ( $control = mysql_fetch_row( $result ) ){
		$url_product = rurl( $control[0], 'gals-sub' );
		
		//you can assign whatever changefreq and priority you like
		echo 
		"
			<item>
				<title><![CDATA[$control[1]]]></title>
				<link>$url_product</link>
				<description><![CDATA[ $control[2] ]]></description>
				<author>"._SITO."</author>
				<guid isPermaLink=\"true\">$url_product</guid>
			</item>
		";
	}
}








/* Genero e-commerce */

$query = "
	SELECT e.id, e.titolo, ec.categoria 
	FROM ecommerce e 
	INNER JOIN ecommercecategoria ec ON ec.id = e.categoria 
	ORDER BY e.id DESC 
	LIMIT 100
";
$result = mysql_query( $query );	

if ( mysql_num_rows( $result ) > 0 ) {
	while ( $control = mysql_fetch_row( $result ) ){
		$url_product = rurl( $control[0], 'ecommerce-dettaglio' );
		$descrizione = "$control[1] in vendita su " . _SITO . ", cerca offerte e prezzi per $control[2].";
		
		//you can assign whatever changefreq and priority you like
		echo 
		"
			<item>
				<title><![CDATA[$control[1]]]></title>
				<link>$url_product</link>
				<description><![CDATA[ $descrizione ]]></description>
				<author>"._SITO."</author>
				<guid isPermaLink=\"true\">$url_product</guid>
			</item>
		";
	}
}


	
//close the XML attribute that we opened in #3
echo "</channel>";
echo "</rss>";

mysql_close(); //close connection

header("Content-Type: text/xml;charset=utf-8");

?>