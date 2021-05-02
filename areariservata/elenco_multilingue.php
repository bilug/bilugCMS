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

$str="SELECT id, lingua, sigla, attiva FROM lingue";
  	// facciamo una query per caricare tutti i dati della tabella
  	$risultato=mysql_query($str);
	
	echo "<h3> Gestione Multilingue </h3>
	<div id=\"tabs\">
	<ul>
        <li><a href=\"#fragment-1\"><span>Elenco Lingue disponibili</span></a></li>
	</ul>             
	                
	<div id=\"fragment-1\">";
	
	
  	if (mysql_num_rows($risultato)>0)
{
	echo "<div class=\"contenitore\"><div class=\"azzerafloat\"></div>";
   //se abbiamo un risultato dalla query costruiamo la tabella

   	echo "<div class=\"evidenzia \">
      <div class=\"float20\">Id</div>
      <div class=\"float200\">Lingua</div>
      <div class=\"float100\">Sigla</div>
      <div class=\"float70\">Attiva</div>
      <div class=\"azzerafloat\"></div></div>";
	
	echo "<br />";

   while($control=mysql_fetch_row($risultato))
   // ciclo per cui finchè abbiamo risultati ci costruisce una riga alla volta
   {
   	echo "
	<div class=\"evidenzia\">
		<div class=\"float20\">$control[0]</div>
		<div class=\"float200\">$control[1]</div>
		<div class=\"float100\">".strtoupper( $control[2] )."</div>
		<div class=\"float70\">";
		if ( $control[3] == 1 )
			echo "Si";
		else	
			echo "No";
		echo "</div>";
	  
		if ( $control[3] == 1 )
			echo "<div class=\"float70\"><img src=\"./img/dis.png\" class=\"ico\" /><a href=\"update_lingua.php?id=$control[0]&azione=d\">Disattiva</a></div>";
		else	
			echo "<div class=\"float70\"><img src=\"./img/ok.png\" class=\"ico\" /><a href=\"update_lingua.php?id=$control[0]&azione=a\">Attiva</a></div>";
	  
      echo "<div class=\"azzerafloat\"></div></div>";
	}
   echo "</div>";
}
else 
{
	echo "<p>Tabella vuota</p>";
}
echo "<br></div>";

?>
