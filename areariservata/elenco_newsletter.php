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

		<link type="text/css" href="css/ui-lightness/jquery-ui-1.7.3.custom.css" rel="stylesheet" />	
		<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
		<script type="text/javascript" src="js/jquery-ui-1.7.3.custom.min.js"></script>
<style type="text/css">
	#tabs {
		width: 99%;
	}
	</style>
	<script type="text/javascript">
	$(function() {
		$("#tabs").tabs();
	});
	</script>

<?php

echo "<h3>Gestione Newsletter</h3>";

echo "
	<div id=\"tabs\">
	<ul>
        <li><a href=\"#fragment-1\"><span>Elenco utenti</span></a></li>
        <li><a href=\"#fragment-2\"><span>Elenco gruppi</span></a></li>
        <li><a href=\"#fragment-3\"><span>Testo privacy</span></a></li>
        <li><a href=\"#fragment-4\"><span>Importa e-mail</span></a></li>
        <li><a href=\"#fragment-5\"><span>Esporta e-mail</span></a></li>
	</ul>";            



// Elenco degli associati alla newsletter	
echo "<div id=\"fragment-1\">";
		echo "
			<div class=\"contenitore\">
				<div class=\"azzerafloat\"></div>
				<div class=\"evidenzia\">
					
						<img src=\"./img/add.png\" class=\"ico\" /> <a href=\"area.php?pag=insert_newsletter.php\">Nuova newsletter</a>
						<img src=\"./img/add_utente.png\" class=\"ico\" /> <a href=\"area.php?pag=insert_gruppo_newsletter.php\">Nuovo gruppo newsletter</a>
					
				</div>
			</div>
		";
		
		$str="
			SELECT n.ID, n.email, n.stato, DATE_FORMAT( n.log,'%d-%m-%Y %H:%i' ), g.nome, l.lingua, n.nome  
			FROM newsletter AS n 
			INNER JOIN gruppi_newsletter AS g ON n.gruppo = g.id 
			INNER JOIN lingue AS l ON l.id = n.id_lingua 
			ORDER BY n.log
		";
		
		// facciamo una query per caricare tutti i dati della tabella
		$risultato=mysql_query($str);
		if (mysql_num_rows($risultato)>0)
		{
			echo "<div class=\"contenitore\">";
		
				echo "<div class=\"filtri\">";
					echo "<div class=\"campo\">E-mail: <input type=\"text\" id=\"f_email\" name=\"\" value=\"\" /></div>";
					echo "<div class=\"campo\">";
						echo "<select id=\"f_gruppo\">";
							$sql = "SELECT id, nome FROM gruppi_newsletter";
							$rssql = mysql_query( $sql );
							echo "<option value=\"0\">----------</option>";
							while( $r = mysql_fetch_row( $rssql ) ) {
								echo "<option value=\"$r[0]\">$r[1]</option>";
							}
						echo "</select>";
					echo "</div>";
					$page = "'ajax/ajax_filtro_newsletter.php'";
					$key = "'email=' + document.getElementById('f_email').value";
					$key .= " + '&gruppo=' + document.getElementById('f_gruppo').value";
					$where = "'#elenco_newsletter'";
					echo "<div class=\"campo\"><input type=\"button\" name=\"\" value=\"Filtra\" onclick=\"genera_ajax( $page, $key, $where );\" /></div>";
					echo "<div class=\"azzerafloat\"></div>";
				echo "</div>";
					
				echo "<div class=\"azzerafloat\"></div>";
				
				echo "<div id=\"elenco_newsletter\">";
				
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
				   
				   echo "<form action=\"cambia_gruppo_utenti_query.php\" method=\"post\">";
				   
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
					
				echo "</div>"; // fine elenco newsletter
				
			echo "</div>"; // fine contenitore
		}
		else 
		{
			echo "<p>Tabella vuota</p>";
		}
		echo "<br>";

echo "</div>";



// Elenco dei gruppi delle newsletter
echo "<div id=\"fragment-2\">";
	echo "
		<div class=\"contenitore\">
			<div class=\"azzerafloat\"></div>
			<div class=\"evidenzia\">
				
					<img src=\"./img/add.png\" class=\"ico\" /> <a href=\"area.php?pag=insert_newsletter.php\">Nuova newsletter</a>
					<img src=\"./img/add_utente.png\" class=\"ico\" /> <a href=\"area.php?pag=insert_gruppo_newsletter.php\">Nuovo gruppo newsletter</a>
				
			</div>
		</div>
	";

	$sql = "SELECT id, nome FROM gruppi_newsletter ";
	$rssql = mysql_query( $sql );
	
	echo "<div class=\"contenitore\"><div class=\"azzerafloat\"></div>
	<div class=\"float20\">ID</div> <!-- id -->
   <div class=\"float200\">Nome gruppo</div>          
   <div class=\"azzerafloat\"></div>";	
   
	while( $r = mysql_fetch_array( $rssql ) ){
		echo "<div class=\"evidenzia\"> 
		
		  <div class=\"float20\">$r[0]</div> 
		  <div class=\"float200\">$r[1]</div> 
		  ";
		  
		  if ( $r[0] != 1 )
			echo "<div class=\"float20\"><a title=\"|Modifica gruppo newsletter\" href=\"area.php?pag=insert_gruppo_newsletter.php&amp;id=$r[0]\"><img src=\"./img/mod.png\" class=\"ico\" /></a></div>";
		  
		echo "<div class=\"azzerafloat\"></div></div>";		
	}
	
	echo "</div>";	
	
echo "</div>";


// Testo della newsletter
echo "<div id=\"fragment-3\">";

	$parola=Modifica;
    
	$annulla = "<input type=\"button\" 
	class=\"medio\" name=\"Annulla\" value=\"Annulla\" onclick=\"javascript:window.location='area.php'\" />";

	$filename= "../custom/privacy_newsletter.html";
	$handle = @fopen($filename,"r");
	$pr_nl = @fread($handle,filesize($filename));
	@fclose($handle);

	?>
	<div class="contenitore">
		<form name="" method="post" action="insert_privacy_newsletter_query.php">
		<!-- il valore di id lo passiamo alla pagina di action con un campo nascosto -->
			<h3><?=$parola?> Testo privacy newsletter:</h3>
			<div class="azzerafloat"></div>
			<div class="float140">HTML:</div>
			<div class="float615">
				<textarea name="testo"><?=$pr_nl?></textarea>
				<script type="text/javascript">
					CKEDITOR.replace('testo');
				</script>
			</div>
			<div class="azzerafloat"></div>
			<br/>
			<input type="submit" class="medio" value="<?=$parola?>" tabindex="7"/>  
			<?=$annulla?>             
		</form>
	</div>

<?	
echo "</div>";



// Importazione delle email
echo "<div id=\"fragment-4\">";
	
	echo "<div class=\"contenitore\">";
		
		echo "<h3>Importazione delle e-mail nella newsletter</h3>";
		
		echo "<div class=\"azzerafloat\"></div>";
		
		echo "<form action=\"importa_mail_newsletter_ext.php\" method=\"post\">";
		
			echo "<p><textarea name=\"mails\" class=\"area_mail\"></textarea></p>";
			echo "<br />";			
			
			echo "<center>";
				echo "<p>";
					echo "<select name=\"gruppo\">";
						$sql = "SELECT id, nome FROM gruppi_newsletter";
						$rssql = mysql_query( $sql );
						echo "<option value=\"0\">------------</option>";
						while( $r = mysql_fetch_row( $rssql ) ){							
							echo "<option value=\"$r[0]\"> $r[1] </option>";
						}
					echo "</select>";					
				echo "</p>";
				echo "<br />";
				
				echo "<p>";
					echo "<select name=\"lingua\">";
					
						$sql = "SELECT id, sigla FROM lingue";
						$rssql = mysql_query( $sql );
						while( $r = mysql_fetch_row( $rssql ) ){
							echo "<option value=\"$r[0]\"> $r[1] </option>";
						}
					
					echo "</select>";					
				echo "</p>";
				echo "<br />";

				echo "<p><input type=\"submit\" name=\"enter\" value=\"Importa e-mail\" /></p>";
				echo "<br />";
				
				echo "<div class=\"bilug-consiglio\">Inserire tutte le e-mail separate da virgola, virgola e spazio, o da a capo</div>";
			echo "</center>";
			
		echo "</form>";

	echo "</div>";
	
echo "</div>";



// Esportazione delle email
echo "<div id=\"fragment-5\">";
	
	echo "<div class=\"contenitore\">";
		
		echo "<h3>Esportazione delle e-mail della newsletter</h3>";
		
		echo "<div class=\"azzerafloat\"></div>";
		
		echo "<center>";
			
			echo "<p>";
				echo "<select id=\"gruppo_utente\">";
					$sql = "SELECT id, nome FROM gruppi_newsletter";
					$rssql = mysql_query( $sql );						
					while( $r = mysql_fetch_row( $rssql ) ) {
						echo "<option value=\"$r[0]\">$r[1]</option>";
					}					
				echo "</select>";
				echo "<input type=\"submit\" name=\"enter\" value=\"Esporta e-mail\" onclick=\"genera_ajax( 'ajax/ajax_visualizza_mail_nl.php', 'key=0&gruppo_utente=' + document.getElementById('gruppo_utente').value, '#mail_export' );\" />";
			echo "</p>";
			
			echo "<br />";			
			echo "<p><div id=\"mail_export\"></div></p>";
		echo "</center>";

	echo "</div>";

echo "</div>";



?>
