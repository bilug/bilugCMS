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

echo "<h3> Argomenti </h3>
	<div id=\"tabs\">
	<ul>
        <li><a href=\"#fragment-1\"><span>Elenco</span></a></li>
        <li><a href=\"#fragment-2\"><span>Nuova</span></a></li>
	</ul>             
	                
	<div id=\"fragment-1\">";
	
//query di controllo spediz predefinita
$query1="SELECT id FROM spedizione WHERE standard = 'checked'";
$std= mysql_query($query1);
$row=mysql_num_rows($std);
if($row>1)
{
		echo"<h1>Attenzione ci sono piu spedizione impostate come standard: CONTROLLARE!!</h1>";
}

// facciamo una query per caricare le spedizioni
$query="SELECT id, tipo, minore, maggiore, prezzo, standard FROM spedizione ORDER BY tipo, minore";
$spedizione= mysql_query($query);


echo"<div class=\"contenitore\"><div class=\"azzerafloat\"></div>";
echo"<div class=\"float230\">Tipo:</div>
			<div class=\"float70\">limite inf &euro; </div>
			<div class=\"float70\"> - </div>
			<div class=\"float100\">limite sup &euro;</div>
			<div class=\"float100\">costo: &euro;</div>
			<div class=\"float50\">pred: </div>
			<div class=\"float70\">&nbsp;</div>
			<div class=\"float70\">&nbsp;</div><br><br><br>";
echo "<ul>";

			
while($sped=mysql_fetch_row($spedizione))
{
	if($sped[5]=="checked")
	{
		$sped[5] = "v";	
	}
	if($sped[3]=="2000000000")
	{
		$sped[3] = "no limit";	
	}
	echo "<div class=\"evidenzia\"><li>
			<div class=\"float230\">$sped[1]</div>
			<div class=\"float70\">$sped[2] &euro; </div>
			<div class=\"float70\"> - </div>
			<div class=\"float100\">$sped[3] &euro;</div>
			<div class=\"float100\">$sped[4] &euro;</div>
			<div class=\"float50\">$sped[5] &nbsp; </div>
			<div class=\"float70\"><img src=\"./img/del.png\" class=\"ico\" /><a title=\"|Elimina spedizione\" href=\"area.php?pag=delete.php&id=$sped[0]&from=elenco_spedizioni.php\">Elimina</a></div>
			<div class=\"float70\"><img src=\"./img/mod.png\" class=\"ico\" /><a title=\"|Modifica Argomento\" href=\"area.php?pag=insert_spedizioni.php&amp;id=$sped[0]\">Modifica</a></div>
			<div class=\"float70\"><img src=\"./img/dup.png\" class=\"ico\" /><a title=\"|Duplica Argomento\" href=\"area.php?pag=duplica.php&id=$sped[0]&from=elenco_spedizioni.php\">Duplica</a></div>
		  </li></div><br><br>";
}
echo "<ul>";
echo "</div>";
echo"<br><br><div class=\"azzerafloat\"></div>";
echo "<div class=\"float160\"><img src=\"./img/ind.png\" class=\"ico\" /><a title=\"|torna indietro\" href=\"area.php?pag=elenco_ecommerce_categorie.php#fragment-4\">Indietro</a></div>";
echo "<br></div>
<div id=\"fragment-2\"";
 include("./insert_spedizioni.php");
echo "</div>";

?>
