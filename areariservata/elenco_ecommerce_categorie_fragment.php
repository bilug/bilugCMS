<?php

	echo"<div class=\"contenitore\"><div class=\"azzerafloat\"></div>";
	echo "<ul>";
	
	echo "<div class=\"evidenzia\"><li>";
		echo "
			<div class=\"float50\">&nbsp;</div>
			<div class=\"float160\">Categoria</div>
			<div class=\"float70\">Lingua</div>
			<div class=\"azzerafloat\"></div>
	    ";
	echo "</li></div>";

	// facciamo una query per caricare gli argomenti
	$query="
		SELECT e.id, e.categoria, l.lingua 
		FROM ecommercecategoria AS e 
		INNER JOIN lingue AS l ON l.id = e.id_lingua 
		WHERE e.id_padre = 0
	";
	$cat = mysql_query( $query );
	
	if ( mysql_num_rows( $cat ) > 0 ) {
		while( $categoria = mysql_fetch_row( $cat ) ) { 
			echo "<li>";
				echo "<div class=\"evidenzia\">";
					echo "
						<div class=\"float50\"><img src=\"./img/freccia2.gif\" class=\"ico\" /></div>
						<div class=\"float160\"><a title=\"|Elenco articoli\" href=\"area.php?pag=elenco_ecommerce.php&categoria=$categoria[0]\">$categoria[1]</a></div>
						<div class=\"float70\">$categoria[2]</div>
						<div class=\"float70\"><img src=\"./img/del.png\" class=\"ico\" /><a title=\"|Elimina Argomento\" href=\"area.php?pag=delete.php&id=$categoria[0]&from=elenco_ecommerce_categorie.php\">Elimina</a></div>
						<div class=\"float70\"><img src=\"./img/mod.png\" class=\"ico\" /><a title=\"|Modifica Argomento\" href=\"area.php?pag=insert_ecommerce_categorie.php&amp;id=$categoria[0]\">Modifica</a></div>
						<div class=\"float70\"><img src=\"./img/dup.png\" class=\"ico\" /><a title=\"|Duplica Argomento\" href=\"area.php?pag=duplica.php&id=$categoria[0]&from=elenco_ecommerce_categorie.php\">Duplica</a></div>
					 "; 
					echo "<div class=\"azzerafloat\"></div>";
					categorie_ricorsive( $categoria[0] );
				echo "</div>";
			echo "</li>";	      		  
		}
	}
	else
		echo "<li> tabella vuota </li>";

	echo "<ul>";



	echo "</div>";

?>


<?php

function categorie_ricorsive( $id_categoria ) {
	$query="
		SELECT e.id, e.categoria, l.lingua 
		FROM ecommercecategoria AS e 
		INNER JOIN lingue AS l ON l.id = e.id_lingua 
		WHERE e.id_padre = $id_categoria
	";	
	
	$rssql = mysql_query( $query );
	if ( mysql_num_rows( $rssql ) > 0 ) {
		echo "<ul>";
		while( $categoria = mysql_fetch_row( $rssql ) ){
			echo "<li>";
				echo "
					<div class=\"float50\"><img src=\"./img/freccia2.gif\" class=\"ico\" /></div>
					<div class=\"float160\"><a title=\"|Elenco articoli\" href=\"area.php?pag=elenco_ecommerce.php&categoria=$categoria[0]\">$categoria[1]</a></div>
					<div class=\"float70\">$categoria[2]</div>
					<div class=\"float70\"><img src=\"./img/del.png\" class=\"ico\" /><a title=\"|Elimina Argomento\" href=\"area.php?pag=delete.php&id=$categoria[0]&from=elenco_ecommerce_categorie.php\">Elimina</a></div>
					<div class=\"float70\"><img src=\"./img/mod.png\" class=\"ico\" /><a title=\"|Modifica Argomento\" href=\"area.php?pag=insert_ecommerce_categorie.php&amp;id=$categoria[0]\">Modifica</a></div>
					<div class=\"float70\"><img src=\"./img/dup.png\" class=\"ico\" /><a title=\"|Duplica Argomento\" href=\"area.php?pag=duplica.php&id=$categoria[0]&from=elenco_ecommerce_categorie.php\">Duplica</a></div>
				 "; 
				echo "<div class=\"azzerafloat\"></div>";
				
				categorie_ricorsive( $categoria[0] );
				
			echo "</li>";		
		}
		echo "</ul>";
	}
	
}

?>


