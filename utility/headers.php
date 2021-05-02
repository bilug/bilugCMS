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


license */ ?><?php

// Non visualizzo gli errori del PHP
error_reporting(0);

session_start();

define( '_PATH_SERVER', str_replace("\\", "/", dirname(__DIR__)) );
define( '_PATH_PAGINE', 'html/' );

$file = _PATH_SERVER . '/utility/connessione.php';

if (!file_exists($file)) {
	header( "Location: install.php" );
} else {
	@unlink("success3.php");
}

// Recupero la variabile dell'accessibilità
if ( isset($_SESSION['bilug-accessibilita']) AND $_SESSION['bilug-accessibilita'] > 0 )
	define( '_ACCESSIBILITA', $_SESSION['bilug-accessibilita'] );
else
	define( '_ACCESSIBILITA', 0 );

// Abilitazione del keep-alive, per mantenere aperta la connessione al server sul dominio e velocizzare l'apertura della pagine
header("Connection: keep-alive");
header("Keep-Alive: timeout=10, max=5");

// Controllo della cache del sito tra browser e server
$offset = 3600 * 24 * 8;
$expire = gmdate("D, d M Y H:i:s", time() + $offset) . " GMT";
header("Cache-Control: max-age=28800"); // HTTP/1.1
header("Expires: $expire"); // Date in the past

// Richiamo file importanti
include_once(_PATH_SERVER."/custom/costanti.php");
include_once(_PATH_SERVER."/utility/versione.php");
include_once(_PATH_SERVER."/utility/connessione.php");
include_once(_PATH_SERVER."/utility/funzioni.php");
require_once(_PATH_SERVER."/utility/alert.php"); 

if ( _COMPRESSIONE_GZIP ) {
	ini_set('zlib.output_compression', 'On');
	ini_set('zlib.output_compression_level', 9);

	if ( substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip') ) ob_start("ob_gzhandler"); 
}

// Controllo la data dell'ultimo accesso al sito
$sql = "SELECT DATE_FORMAT( data_ultimo_accesso, '%d' ) FROM generale";
$rssql = mysql_query( $sql );

$giorno_ultimo_accesso = mysql_result( $rssql, 0, 0 );
$giorno_odierno = date( 'd', time() );

if ( $giorno_ultimo_accesso != $giorno_odierno ) {
	$sql = "UPDATE notizie SET cliccato_oggi = 0";
	mysql_query( $sql );
}

// Aggiorno la data dell'ultimo accesso
$sql = "UPDATE generale SET data_ultimo_accesso = NOW()";
mysql_query( $sql );

// Evito la direttiva magic_quotes_gpc se attiva
if ( in_array( strtolower( ini_get( 'magic_quotes_gpc' ) ), array( '1', 'on' ) ) ) {
    $_POST = array_map( 'stripslashes', $_POST );
    $_GET = array_map( 'stripslashes', $_GET );
    $_COOKIE = array_map( 'stripslashes', $_COOKIE );
    $_REQUEST = array_map( 'stripslashes', $_REQUEST );
}

?>