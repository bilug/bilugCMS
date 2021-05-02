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

$str = "SELECT * FROM social ORDER BY nome";
// facciamo una query per caricare gli argomenti
$risultato=mysql_query($str);  

echo "<h3> Elenco dei vari social </h3>";
echo "<div id=\"tabs\">";
	echo "	
		<ul>
			<li><a href=\"#fragment-1\"><span>Elenco</span></a></li>
			<li><a href=\"#fragment-2\"><span>Nuova</span></a></li>
		</ul>
	";

	echo "<div id=\"fragment-1\">";
	if (mysql_num_rows($risultato)>0){
		echo "<div class=\"contenitore\"><div class=\"azzerafloat\"></div>";					              
		echo "
			<div class=\"float180\">Titolo</div>             
			<div class=\"float290\">Link associato</div>";              
		echo "<div class=\"azzerafloat\"></div>";          
		while($control=mysql_fetch_assoc($risultato)){	
			echo "<div class=\"evidenzia\">";
				echo "
				<div class=\"float180\">$control[nome]</div>
				<div class=\"float290\">$control[link]</div>";
				
				echo "
				<div class=\"float50\"><a title=\"Elimina link social\" href=\"area.php?pag=delete.php&id=$control[id]&from=elenco_social.php\"><img src=\"./img/del.png\" class=\"ico\" /></a></div>
				<div class=\"float50\"><a title=\"Modifica link social\" href=\"area.php?pag=insert_social.php&amp;id=$control[id]\"><img src=\"./img/mod.png\" class=\"ico\" /></a></div>
				<div class=\"azzerafloat\"></div>";			
			echo "</div>";
		}
		echo "</div>";
	}
	else
	{
		echo "<p>Tabella vuota</p>";
	}	
	echo "</div>";

	echo "<div id=\"fragment-2\">";
		include("./insert_social.php");
	echo "</div>";
	
	
echo "</div>";

?>