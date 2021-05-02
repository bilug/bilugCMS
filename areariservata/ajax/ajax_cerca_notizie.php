<?php
    /*
        Ricerca notizie
    */
	
    require_once("include_ajax.php");
    
    $notizia = ( isset( $_GET['notizia'] ) ) ? apici( $_GET['notizia'] ) : '';
    $argomento = ( isset( $_GET['argomento'] ) ) ? (int)$_GET['argomento'] : 0;
    $quanti = ( isset( $_GET['quanti'] ) ) ? $_GET['quanti'] : '';

    $sql = "SELECT ID, titolo, sottotitolo, testo, autore, argomento, DATE_FORMAT(data,'%d-%m-%Y'), autorizza, evidenzia, cliccato FROM notizie WHERE";
    
    if ( $notizia != '' ) $sql .= " ( titolo LIKE '%$notizia%' OR sottotitolo LIKE '%$notizia%' ) AND ";    
    if ( $argomento > 0 ) $sql .= " argomento = $argomento AND ";    
    
	$sql .= " 1";
	
    if ( $quanti == '' ) $sql .= " ORDER BY ID DESC";
    else {
		$sql .= " ORDER BY cliccato DESC";
		if ( $quanti != '*' )
			$sql .= " LIMIT $quanti";
	}
	
    $risultato = mysql_query( $sql );
    
if ( mysql_num_rows( $risultato ) > 0 ) {
	include( "../include/include_tabella_notizie.php" );
}
else 
	echo "<p>Tabella vuota</p>";
	


	
?>
