<?php
	session_start();
	
	include_once("../utility/connessione.php");
	include_once("../custom/costanti.php");
	
	$c = (int)$_GET['c'];
	
	$_SESSION['bilug-accessibilita'] = ( isset( $_GET['c'] ) ) ? (int)$_GET['c'] : 1; 

	//header( "Location: " . _URLSITO );
?>

<meta http-equiv="refresh" content="0;url=<?=_URLSITO?>">