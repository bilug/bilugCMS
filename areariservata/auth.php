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

error_reporting(0);

session_start();

require_once("../utility/alert.php");

require_once("../utility/connessione.php");
require_once("../custom/costanti.php");
require_once("../utility/funzioni.php");
require_once("../utility/versione.php");

if ( !isset($_SESSION['tux']) OR $_SESSION['tux']<=0 ) {
	//Non procedo sessione non valida
	$msg = "SESSIONE SCADUTA O NON VALIDA";	
	echo "<meta http-equiv=\"refresh\" content=\"0;url="._URLSITO."\" />";
  	confirm($msg);	
	
	exit;
}

if ( in_array( strtolower( ini_get( 'magic_quotes_gpc' ) ), array( '1', 'on' ) ) ) {
    $_POST = array_map( 'stripslashes', $_POST );
    $_GET = array_map( 'stripslashes', $_GET );
    $_COOKIE = array_map( 'stripslashes', $_COOKIE );
	$_REQUEST = array_map( 'stripslashes', $_REQUEST );
}

?>
