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
<?

$str="
	SELECT s.ID, s.titolo, s.ordine, s.maps, l.lingua 
	FROM statiche AS s 
	INNER JOIN lingue AS l ON l.id = s.id_lingua
	ORDER BY s.ID 
";
// facciamo una query per caricare gli argomenti
$risultato=mysql_query($str);  


echo "<h3> Pagine Statiche </h3>
	<div id=\"tabs\">
	<ul>
        <li><a href=\"#fragment-1\"><span>Elenco</span></a></li>
        <li><a href=\"#fragment-2\"><span>Nuova</span></a></li>
        <li><a href=\"#fragment-3\"><span>Nuova mappa</span></a></li>
	</ul>             
	                
	<div id=\"fragment-1\">";

// facciamo una query per caricare le notizie  
if (mysql_num_rows($risultato)>0)
{
	echo "<div class=\"contenitore\"><div class=\"azzerafloat\"></div>";					              
	echo "<div class=\"float100\">N.</div>
   		<div class=\"float180\">Titolo</div>             
   		<div class=\"float180\">Link associato</div>             
   		<div class=\"float100\">Lingua</div>";              
	echo "<div class=\"azzerafloat\"></div>";          
	while($control=mysql_fetch_row($risultato))
	// ciclo per cui finchè abbiamo risultati ci costruisce una riga alla volta
	{	
		$link = rurl( $control[0], 'static' );
		echo "<div class=\"evidenzia\">
		<div class=\"float100\">ID: $control[0]</div>
		<div class=\"float180\">$control[1]</div>
		<div class=\"float180\">$link</div>
		<div class=\"float100\">$control[4]</div>
   		<div class=\"float50\"><a title=\"Anteprima della Pagina Statica\" href=\"area.php?pag=view_static.php&amp;stat=$control[0]\"><img src=\"./img/pre.png\" class=\"ico\" /></a></div>
   		<div class=\"float50\"><a title=\"Elimina la pagina Statica\" href=\"area.php?pag=delete.php&id=$control[0]&from=elenco_statiche.php\"><img src=\"./img/del.png\" class=\"ico\" /></a></div>
        <!-- Assegnamo all'id il valore che otteniamo con la query -->
        ";
        
        if ( $control[3] == '' )
			echo "<div class=\"float50\"><a title=\"Modifica la pagina Statica\" href=\"area.php?pag=insert_statiche.php&amp;id=$control[0]\"><img src=\"./img/mod.png\" class=\"ico\" /></a></div>";
        else
			echo "<div class=\"float50\"><a title=\"Modifica la pagina Statica\" href=\"area.php?pag=insert_statiche_mappa.php&amp;id=$control[0]\"><img src=\"./img/mod.png\" class=\"ico\" /></a></div>";
			
        echo "<div class=\"float50\"><a title=\"Duplica la pagina Statica\" href=\"area.php?pag=duplica.php&id=$control[0]&from=elenco_statiche.php\"><img src=\"./img/dup.png\" class=\"ico\" /></a></div>
        <div class=\"float50\"><a title=\"Sposta pagina in alto\" href=\"updown_statiche.php?dir=U&amp;id=$control[0]\"><img src=\"./img/su.png\" class=\"ico\" /></a></div>
        <div class=\"float50\"><a title=\"Sposta pagina in basso\" href=\"updown_statiche.php?dir=D&amp;id=$control[0]\"><img src=\"./img/giu.png\" class=\"ico\" /></a></div>            
        <div class=\"float50\"><a title=\"Invia come newsletter\" href=\"area.php?pag=insert_newsletter.php&amp;id=$control[0]&amp;tipo=s\"><img src=\"./img/newsletter.gif\" class=\"ico\" /></a></div>            
        <div class=\"azzerafloat\"></div></div>";
 	}
 	echo "</div>";
}
else
{
 	echo "<p>Tabella vuota</p>";
 
}
echo "<br />

</div>
<div id=\"fragment-2\">";
 include("./insert_statiche.php");
echo "</div>";


echo "<div id=\"fragment-3\">";
 include("./insert_statiche_mappa.php");
echo "</div>";


		

?>
