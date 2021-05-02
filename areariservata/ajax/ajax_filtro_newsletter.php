<?php

    require_once("include_ajax.php");
    
    $email = $_GET['email'];
    $gruppo = $_GET['gruppo'];
	
	$sql = "
		SELECT n.ID, n.email, n.stato, DATE_FORMAT( n.log,'%d-%m-%Y %H:%i' ), g.nome, l.lingua  
		FROM newsletter AS n 
		INNER JOIN gruppi_newsletter AS g ON n.gruppo = g.id 
		INNER JOIN lingue AS l ON l.id = n.id_lingua 
		WHERE
	";
	
	
    if ( $email != '' OR $gruppo > 0 ) {
		if ( $email != '' )
			$sql .= "  n.email LIKE '%$email%' AND ";		
		if ( $gruppo > 0 )			
			$sql .= "  g.id LIKE '%$gruppo%' AND ";		
    }

	$sql .= " 1 ORDER BY n.log";
	$risultato = mysql_query( $sql );

	if ( mysql_num_rows( $risultato ) > 0 ) {
		echo"
			<div class=\"float20\">&nbsp;</div> <!-- checkbox -->
			<div class=\"float20\">Id</div> <!-- id -->
		   <div class=\"float200\">E-mail</div> 
		   <div class=\"float100\">Nome</div> 
		   <div class=\"float50\">Stato</div> 
		   <div class=\"float100\">Gruppo</div>                
		   <div class=\"float100\">lingua</div>                
		   <div class=\"float140\">Log</div>                
		   <div class=\"azzerafloat\"></div>";
	   
	   echo "<form action=\"cambia_gruppo_utenti_query.php\" method=\"POST\" style=\"text-align:left;\">";
	   
	   $cont = 0;
			//se abbiamo un risultato dalla query costruiamo la tabella
			while($control=mysql_fetch_row($risultato))
			// ciclo per cui finchè abbiamo risultati ci costruisce una riga alla volta
		   {
			echo "<div class=\"evidenzia\">            
			  <div class=\"float20\"><input type=\"checkbox\" name=\"utente[$cont]\" value=\"$control[0]\" /></div> <!-- checkbox -->
			  <div class=\"float20\">$control[0]</div> 
			  <div class=\"float200\">$control[1]</div> 
			  <div class=\"float100\">&nbsp;$control[6]</div> 
			  <div class=\"float50\">" . ( $control[2] == -1 ? "Attesa" : "Valida" ) . "</div> 
			  <div class=\"float100\">$control[4]</div> 
			  <div class=\"float100\">$control[5]</div> 
			  <div class=\"float140\">$control[3]</div>                   
			  <div class=\"float70\"><img src=\"./img/del.png\" class=\"ico\" /><a href=\"area.php?pag=delete.php&id=$control[0]&from=elenco_newsletter.php\">Elimina</a></div>";                        
			  if ($control[2] == -1)
				 echo "<div class=\"float100\"><img src=\"./img/ok.png\" class=\"ico\" /><a href=\"attdiv_newsletter.php?dir=C&amp;id=$control[0]\">Conferma</a></div>";
			  else
				 echo "<div class=\"float70\"><img src=\"./img/dis.png\" class=\"ico\" /><a href=\"attdiv_newsletter.php?dir=D&amp;id=$control[0]\">Disattiva</a></div>";            
			  echo "<div class=\"azzerafloat\"></div></div>";         
			  
			  $cont++;
			}
			
			echo "<select name=\"gruppo_utente\">";
				$sql = "SELECT id, nome FROM gruppi_newsletter";
				$rssql = mysql_query( $sql );						
				while( $r = mysql_fetch_array( $rssql ) ) {
					echo "<option value=\"$r[0]\">$r[1]</option>";
				}
			echo "</select>";
			echo "&nbsp;&nbsp;&nbsp;";
			echo "<input type=\"submit\" value=\"Inserisci gruppo selezionati\" name=\"\" />";
			
		echo "</form>";			
	}
?>
