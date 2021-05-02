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

<style>
    .menu-new { display: none; }
</style>

<script>

    function mostra( tipo ) {
        var tipo = $('#'+tipo);

        if ( tipo.css('display') == 'block' )
            tipo.css('display', 'none');
        else
            tipo.css('display', 'block');
    }

</script>

<?php

$errore=$_GET["errore"];
echo"<h1>$errore</h1>";

echo"<h3>Lista dei men&ugrave;</h3>";

echo "<p>&nbsp;</p>";

echo "<div class=\"contenitore\"><div class=\"azzerafloat\"></div>";
echo " tipo = ax significa according &nbsp;&nbsp;&nbsp; tipo = tx significa tendina (solo orizzontale alto)";		
echo "</div><br>";

echo "<p>&nbsp;</p>";

echo "<p><big><strong>Clicca sui men&ugrave; per visualizzarli</strong></big></p>";

echo"<div class=\"contenitore\"><div class=\"azzerafloat\"></div>";

$query = "SELECT tipo FROM menutipo GROUP BY tipo";
$ris=mysql_query($query);
$row=mysql_num_rows($ris);

echo "<ul>";
if($row>0)
{

	while($tipo=mysql_fetch_array($ris))
	{	
	   echo "<li>";
	   
	   echo "<h3><a href=\"javascript:mostra('$tipo[0]')\">$tipo[0]</a></h3>";
	   
	   echo "<ul id=\"$tipo[0]\" class=\"menu-new\">";
	   
		$queryp = "
			SELECT m.id, m.titolo, m.tipo, m.idpadre, m.link, m.posizione, l.lingua 
			FROM menutipo AS m
			INNER JOIN lingue AS l ON l.id = m.id_lingua
			WHERE m.tipo='$tipo[0]' AND m.idpadre=0 
			ORDER BY m.posizione
		";
		$princ=mysql_query($queryp);
		$row1=mysql_num_rows($princ);
		  
			while($principali=mysql_fetch_row($princ))
			{
			   echo "<li>";
				echo "<div class=\"evidenzia\">
				<div class=\"float50\">$principali[2]</div>
				<div class=\"float100\">$principali[1]</div>
				<div class=\"float100\">$principali[6]</div>
				<div class=\"float50\"><a title=\"|Elimina Argomento\" href=\"area.php?pag=delete.php&id=$principali[0]&from=elenco_menu_new.php\"><img src=\"./img/del.png\" class=\"ico\" /></a></div>
				<div class=\"float50\"><a title=\"|Modifica Argomento\" href=\"area.php?pag=insert_menu_new.php&amp;id=$principali[0]\"><img src=\"./img/mod.png\" class=\"ico\" /></a></div>
				<div class=\"float50\"><a title=\"|up\" href=\"area.php?pag=up_down_menu.php&dir=D&id=$principali[0]\"><img src=\"./img/su.png\" class=\"ico\" /></a></div>
				<div class=\"float50\"><a title=\"|down\" href=\"area.php?pag=up_down_menu.php&dir=U&id=$principali[0]\"><img src=\"./img/giu.png\" class=\"ico\" /></a></div>
				<div class=\"float50\"><a title=\"|Aggiungi un Sottomenu\" href=\"area.php?pag=insert_sotmenu.php&amp;tipo=$tipo[0]&amp;idpadre=$principali[0]\"><img src=\"./img/sot.png\" class=\"ico\" /></a></div>
				<div class=\"float70\"><img src=\"./img/lnk.png\" class=\"ico\" /><a title=\"|Aggiungi un Link\" href=\"area.php?pag=insert_sotmenu_link.php&amp;id=$principali[0]\">Link</a></div>
				<div class=\"float230\">$principali[4]</div>
				";
				
				vismenu($principali[0],$tipo[0],1);
				
				echo"</div>";
				
				echo "<div class=\"azzerafloat\"></div>";
				echo "</li>";
			}
		  echo "</ul>";
	}
	echo "</ul>";
	echo "</div>";
}
else
	echo "<p>Tabella vuota</p>";

	
echo "<br>";

echo "<div class=\"contenitore\"><div class=\"azzerafloat\"></div>
		<div class=\"evidenzia\">
			
				<img src=\"./img/add.png\" class=\"ico\" /> <a href=\"area.php?pag=insert_menu_new.php\">Nuovo menu</a>
			
		</div>
	  </div>";
		

		
	



	
// Funzione di creazione dei sottomenu		
function vismenu($id,$tip,$space)
{
	$query="SELECT id, titolo, tipo, idpadre, link, posizione FROM menutipo WHERE tipo='$tip' AND idpadre = $id ORDER BY posizione";
	$risultato=mysql_query($query);
	$row=mysql_num_rows($risultato);
	//$voci=mysql_fetch_row($risultato);
	
	if(!$row)
	{
		return "no";
	}
	else
	{	
		
		$space++;
		echo "<div class=\"azzerafloat\"></div>";
		echo"<ul>";	
		while($voci=mysql_fetch_row($risultato))
		{
		  echo "<li>";

			echo "<div class=\"evidenzia\">
			<div class=\"float50\">$voci[2]</div>
			<div class=\"float100\">$voci[1]</div>
			<div class=\"float50\"><a title=\"|Elimina Argomento\" href=\"area.php?pag=delete.php&id=$voci[0]&from=elenco_menu_new.php\"><img src=\"./img/del.png\" class=\"ico\" /></a></div>
			<div class=\"float50\"><a title=\"|Modifica Argomento\" href=\"area.php?pag=insert_menu_new.php&amp;id=$voci[0]\"><img src=\"./img/mod.png\" class=\"ico\" /></a></div>
			<div class=\"float50\"><a title=\"|up\" href=\"area.php?pag=up_down_menu.php&dir=D&id=$voci[0]\"><img src=\"./img/su.png\" class=\"ico\" /></a></div>
			<div class=\"float50\"><a title=\"|down\" href=\"area.php?pag=up_down_menu.php&dir=U&id=$voci[0]\"><img src=\"./img/giu.png\" class=\"ico\" /></a></div>";
			$car=substr($voci[2],0,1);
			//echo "$car";
			if($car!="a")
			{
				echo"
					<div class=\"float50\"><a title=\"|Aggiungi un Sottomenu\" href=\"area.php?pag=insert_sotmenu.php&amp;tipo=$tip&amp;idpadre=$voci[0]\"><img src=\"./img/sot.png\" class=\"ico\" /></a></div>";
			}		
						
			echo"
				<div class=\"float70\"><img src=\"./img/lnk.png\" class=\"ico\" /><a title=\"|Aggiungi un Link\" href=\"area.php?pag=insert_sotmenu_link.php&amp;id=$voci[0]\">Link</a></div>
				<div class=\"float160\">$voci[4]</div>
			";

			vismenu($voci[0],$voci[2],$space);

			echo"</div>";
			
			echo "<div class=\"azzerafloat\"></div>";
			
			echo "</li>";
		}
		echo"</ul>";
		return "ok";
	} 
}		
		
		
		
		
?>
