<?php
    /*
        Ricerca e-commerce
    */

    require_once("include_ajax.php");
    
    $codice = apici( $_GET['codice'] );
    $articolo = apici( $_GET['articolo'] );
    $categoria = $_GET['categoria'];
    @$sottocategoria = $_GET['sottocategoria'];
	

    $sql = "
        SELECT id, titolo, categoria, prezzo, quantita, codice, produttore, prezzo_intero, colore, taglia, riservato, evidenzia, offerta 
        FROM ecommerce 
        WHERE 
    ";
    
    if ( $codice != '' )
		$sql .= " codice LIKE '%$codice%' AND ";    
	if ( $articolo != '' )
		$sql .= " titolo LIKE '%$articolo%' AND ";
    if ( $categoria != '' ) {
		if ( @$sottocategoria != '' )
			$categoria = "$categoria||$sottocategoria";
		else
			$categoria = "$categoria||%";
		
		$sql .= " categoria LIKE '$categoria' AND ";
	}
    
    $sql .= " 1 ";
    $rssql = mysql_query( $sql );
    
	if ( mysql_num_rows( $rssql ) > 0 ) {
		echo "<br /><br /><hr />";
		
		echo"<div class=\"listato_cerca\"><div class=\"azzerafloat\"></div>";
		echo "<ul>";
		echo "<li class=\"evidenzia\">
				<div class=\"float100\">Codice</div>
				<div class=\"float100\">Articolo</div>
				<div class=\"float100\">Produttore</div>
				<div class=\"float100\">Categoria</div>
				<div class=\"float100\">Sotto-categoria</div>
				<div class=\"float70\">Prezzo</div>
				<div class=\"float50\">Q.ta</div>
				<div class=\"float50\">Colore</div>
				<div class=\"float50\">Taglia</div>
				<div class=\"float20\" title=\"Prodotti riservati\">Ris</div>
				<div class=\"float20\" title=\"Prodotti evidenziati\">Evi</div>
				<div class=\"float20\" title=\"Prodotti in offerta\">Off</div>
				<div class=\"azzerafloat\"></div><br><br></li>";   

		while( $ecom = mysql_fetch_row( $rssql ) )
		{   
			echo "<li class=\"evidenzia\">
				<div class=\"float100\">$ecom[5]</div>
				<div class=\"float100\">$ecom[1]</div>
				<div class=\"float100\">$ecom[6]</div>";
				
			$cat = explode( '||', $ecom[2] );

			echo "<div class=\"float100\">$cat[0]</div>";
				
			if ( isset( $cat[1] ) AND $cat[1] != '' )
				echo "<div class=\"float100\">$cat[1]</div>";
			else  
				echo "<div class=\"float100\" style=\"text-align:center;\"> - </div>";
			
				echo "<div class=\"float70\">$ecom[3]</div>";
				
			echo "<div class=\"float50\">$ecom[4]</div>";
			
			if ( @$ecom[9] )
				echo "<div class=\"float50\">$ecom[8]</div>";
			else
				echo "<div class=\"float50\">-</div>";
				
			if ( @$ecom[9] )
				echo "<div class=\"float50\">$ecom[9]</div>";
			else	
				echo "<div class=\"float50\">-</div>";
			
			echo "<div class=\"float20\">";
			if ( $ecom[10] == 1 )
				echo "O";
			else
				echo "X";
			echo "</div>";
			
			echo "<div class=\"float20\">";
			if ( $ecom[11] == 1 )
				echo "O";
			else
				echo "X";
			echo "</div>";
			
			echo "<div class=\"float20\">";
			if ( $ecom[12] == 1 )
				echo "O";
			else
				echo "X";
			echo "</div>";
			
			echo "<div class=\"float20\"><a title=\"|Elimina articolo\" href=\"area.php?pag=delete.php&id=$ecom[0]&from=elenco_ecommerce.php\"><img src=\"./img/del.png\" class=\"ico\" /></a></div>
				<div class=\"float20\"><a title=\"|Modifica Argomento\" href=\"area.php?pag=insert_ecommerce.php&amp;id=$ecom[0]\"><img src=\"./img/mod.png\" class=\"ico\" /></a></div>
				<div class=\"float20\"><a title=\"|Duplica Argomento\" href=\"area.php?pag=duplica.php&id=$ecom[0]&from=elenco_ecommerce.php&rif=ecommerce_cerca\"><img src=\"./img/dup.png\" class=\"ico\" /></a></div>
				 <div class=\"azzerafloat\"></div>
				  <br><br></li>";
		}

		echo "</ul>";

		echo "</div>";
	}
	


	
?>
