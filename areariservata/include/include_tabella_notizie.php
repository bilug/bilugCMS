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

	echo "<div class=\"contenitore\"><div class=\"azzerafloat\"></div>";

	echo "<div class=\"evidenzia\">
		   <div class=\"float20\">Id</div> <!-- id -->
		   <div class=\"float160\">Titolo</div> <!-- titolo -->
		   <div class=\"float70\">Click</div> <!-- click -->
		   <div class=\"float180\">Link associato</div> <!-- Link associato -->
		   <div class=\"float70\">Argomento</div> <!-- argomento -->
		   <div class=\"float70\">Data</div> <!-- data -->
		   <div class=\"azzerafloat\"></div>
		</div>
	";

	//se abbiamo un risultato dalla query costruiamo la tabella
	// ciclo per cui finchè abbiamo risultati ci costruisce una riga alla volta
	while($control=mysql_fetch_row($risultato)) {    
		$link = rurl( $control[0], 'news' );
		  
		$str2="SELECT email FROM anagrafica WHERE ID='$control[4]'";
		$risultato2=mysql_query($str2);
		$control2=mysql_fetch_row($risultato2);
		$str3="SELECT argomenti FROM argomenti WHERE ID='$control[5]'";
		$risultato3=mysql_query($str3);
		$control3=mysql_fetch_row($risultato3);
		if($control[1]=="")
			$control[1]="&nbsp;";	
		if($control[2]=="")
			$control[2]="&nbsp;";	
		if($control2[0]=="")
			$control2[0]="&nbsp;";	
		if($control3[0]=="")
			$control3[0]="&nbsp;";	
		if($control[6]=="")
			$control[6]="&nbsp;";	

		echo "<div class=\"evidenzia\">
			<div class=\"float20\">$control[0]</div> <!-- id -->
			<div class=\"float160\">$control[1]</div> <!-- titolo -->
			<div class=\"float70\">$control[9]</div> <!-- click -->
			<div class=\"float180\">$link</div> <!-- Link associato -->
			<!-- <div class=\"float100\">$control2[0]</div>  (autore) -->
			<div class=\"float70\">$control3[0]</div> <!-- argomento -->
			<div class=\"float70\">$control[6]</div> <!-- data -->
			<!--div class=\"float50\"><a title=\"Anteprima della Notizia\" href=\"area.php?pag=view_notizia.php&amp;id=$control[0]\"><img src=\"./img/pre.png\" class=\"ico\" /></a></div-->
			<div class=\"float50\"><a title=\"Elimina la Notizia\" href=\"area.php?pag=delete.php&id=$control[0]&from=elenco_all_notizie.php\"><img src=\"./img/del.png\" class=\"ico\" /></a></div>
			<!-- Assegnamo all'id il valore che otteniamo con la query -->
			<div class=\"float50\"><a title=\"Modifica la Notizia\" href=\"area.php?pag=insert_notizie.php&amp;id=$control[0]\"><img src=\"./img/mod.png\" class=\"ico\" /></a></div>
			<div class=\"float50\"><a title=\"Inserisci TAG\" href=\"area.php?pag=insert_tag_notizie.php&amp;id=$control[0]\"><img src=\"./img/icona_tag.jpg\" class=\"ico\" /></a></div>
			<div class=\"float50\"><a title=\"Duplica la Notizia\" href=\"area.php?pag=duplica.php&id=$control[0]&from=elenco_notargaut.php\"><img src=\"./img/dup.png\" class=\"ico\" /></a></div>
		";
	
		if ($control[7] =='no')
			echo "<div class=\"float50\"><a title=\"Autorizzazione per visualizzare la notizia\" href=\"autorizza_notizie.php?id=$control[0]&from=elenco_all_notizie.php&amp;aut=si\"><img src=\"./img/ok.png\" class=\"ico\" /></a></div>";
		else
			echo "<div class=\"float50\"><a title=\"Non Autorizzare la notizia per essere visualizzata\" href=\"autorizza_notizie.php?id=$control[0]&from=elenco_all_notizie.php&amp;aut=no\"><img src=\"./img/dis.png\" class=\"ico\" /></a></div>";
		
		if ($control[8] =='no')
			echo "<div class=\"float50\"><a title=\"Questa Notizia sar&agrave; sempre visualizzata in Homepage\" href=\"evidenzia_notizie.php?id=$control[0]&from=elenco_all_notizie.php&amp;evi=si\"><img src=\"./img/ok.png\" class=\"ico\" /></a></div>";
		else
			echo "<div class=\"float50\"><a title=\"In Homepage verr&agrave; visualizzata l'ultima notizia inserita\" href=\"evidenzia_notizie.php?id=$control[0]&from=elenco_all_notizie.php&amp;evi=no\"><img src=\"./img/dis.png\" class=\"ico\" /></a></div>";

		echo "<div class=\"float50\"><a title=\"Invia come newsletter\" href=\"area.php?pag=insert_newsletter.php&amp;id=$control[0]&amp;tipo=d\"><img src=\"./img/newsletter.gif\" class=\"ico\" /></a></div> ";

		echo "<div class=\"azzerafloat\"></div></div>";  
	}
	echo "</div>";

?>