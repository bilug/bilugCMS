<?php

	// file da mettere alla radice del sito... Aggiunge per i vecchi siti dei caratteri speciali che servono per la
	// gestione delle sottocategorie nell'ecommerce

    require_once("../connessione.php");
    /*
    echo "<h1>ecommerce</h1><br>";
    $sql = "SELECT id, categoria FROM ecommerce";
    $rssql = mysql_query( $sql );
    while( $r = mysql_fetch_array( $rssql ) ) {
        $up = "UPDATE ecommerce SET categoria = '$r[1]||' WHERE id = $r[0]";
        if ( @mysql_query( $up ) )
          echo "ok";
        else
          echo "no";
          
        echo "<br>";
    }
    
    echo "<hr /><br><br><br>";
    
    echo "<h1>ecommercecategoria</h1><br>";
    
    $sql = "SELECT id, categoria FROM ecommercecategoria";
    $rssql = mysql_query( $sql );
    while( $r = mysql_fetch_array( $rssql ) ) {
        $up = "UPDATE ecommercecategoria SET categoria = '$r[1]||' WHERE id = $r[0]";
        if ( @mysql_query( $up ) )
          echo "ok";
        else
          echo "no";
          
        echo "<br>";
    }  */    
?>
