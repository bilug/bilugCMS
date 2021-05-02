<?php
    /*
        carica le sottocategorie da scegliere dinamicamente...
    */

    require_once("include_ajax.php");
    
    $gruppo = $_GET['gruppo_utente'];
    
	$where = "";
    if ( $gruppo > 1 )
		$where = " WHERE gruppo = $gruppo";
		
	$sql = "SELECT nome, email FROM newsletter $where";
	$rssql = mysql_query( $sql );
	
	if ( mysql_num_rows( $rssql ) > 0 ) {
		$mail = '';
		while( $r = mysql_fetch_array( $rssql ) ){
			$mail .= "$r[0] &lt;$r[1]&gt;, ";
		}
		
		echo "<div class=\"area_mail\">$mail</div>";
	}
	else
		echo "";
?>
