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

$str="
	SELECT a.ID, a.argomenti, a.menu_arg, l.lingua
	FROM argomenti AS a 
	INNER JOIN lingue AS l ON l.id = a.id_lingua
	ORDER BY a.argomenti
";
  	// facciamo una query per caricare tutti i dati della tabella
  	$risultato=mysql_query($str);
	
	echo "<h3> Argomenti </h3>
	<div id=\"tabs\">
	<ul>
        <li><a href=\"#fragment-1\"><span>Elenco</span></a></li>
        <li><a href=\"#fragment-2\"><span>Nuovo</span></a></li>
	</ul>             
	                
	<div id=\"fragment-1\">";
	
	
  	if (mysql_num_rows($risultato)>0)
{
	echo "<div class=\"contenitore\"><div class=\"azzerafloat\"></div>";
   //se abbiamo un risultato dalla query costruiamo la tabella

   	echo "<div class=\"evidenzia \">
      <div class=\"float20\">Id</div>
      <div class=\"float160\">Argomento</div>
      <div class=\"float180\">Link associato</div>
      <div class=\"float100\">Men&ugrave;</div>
      <div class=\"float70\">Lingua</div>
      <div class=\"azzerafloat\"></div></div>";
	
	echo "<br />";

   while($control=mysql_fetch_row($risultato))
   // ciclo per cui finch� abbiamo risultati ci costruisce una riga alla volta
   {
	   $link = rurl( $control[0], 'argo' );
	   
   	echo "<div class=\"evidenzia\">
      <div class=\"float20\">$control[0]</div>
      <div class=\"float160\">$control[1]</div>
      <div class=\"float180\">$link</div>
      <div class=\"float100\">$control[2]</div>
      <div class=\"float70\">$control[3]</div>
      <div class=\"float50\"><a title=\"Elimina Argomento\" href=\"area.php?pag=delete.php&id=$control[0]&from=elenco_arg.php\"><img src=\"./img/del.png\" class=\"ico\" /></a></div>
      <!-- Assegnamo all'id il valore che otteniamo con la query -->
      <div class=\"float50\"><a title=\"Modifica Argomento\" href=\"area.php?pag=insert_arg.php&amp;id=$control[0]&menu_arg=$control[2]\"><img src=\"./img/mod.png\" class=\"ico\" /></a></div>
      <div class=\"float50\"><a title=\"Duplica Argomento\" href=\"area.php?pag=duplica.php&id=$control[0]&from=elenco_arg.php\"><img src=\"./img/dup.png\" class=\"ico\" /></a></div>
      <div class=\"azzerafloat\"></div></div>";
	}
   echo "</div>";
}
else 
{
	echo "<p>Tabella vuota</p>";
}
echo "<br></div>
<div id=\"fragment-2\">";
 include("./insert_arg.php");
echo "</div>";
		

?>
