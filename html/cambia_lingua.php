<?php
	session_start();
	
	include_once("../utility/connessione.php");
	include_once("../custom/costanti.php");
		
	$_SESSION['lingua'] = ( isset( $_GET['lingua'] ) AND mysql_real_escape_string( $_GET['lingua'] ) != '' ) ? mysql_real_escape_string($_GET['lingua']) : _LINGUADEFAULT;

	//header( "Location: " . _URLSITO );
?>

<meta http-equiv="refresh" content="0;url=<?=_URLSITO?>">