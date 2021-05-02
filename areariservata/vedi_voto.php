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
<?

$id = $_GET['id'];

require_once("../utility/connessione.php");
$maxgrafo = 800;
$str="select totali,maxvoti,opzioni,titolo,utenti from sondaggi where ID='$id'";
$risultato=mysql_query($str);
$control = mysql_fetch_row($risultato);
$totvoto = explode(";",$control[0]);
$opzioni = explode(";",$control[2]);
echo "<h1>Sondaggio</h1><div class=contenitore><h3>\"$control[3]\" - numero votanti : $control[1]</h3>";
for ($i=0; $i < count($totvoto); $i++)
{
	$Perc=(($totvoto[$i]/$control[1])*100);
	$Percpix= ($Perc*$maxgrafo)/(100);
	echo "
	<div class=\"float100\">
	$opzioni[$i] :
	</div>
	<div class=\"float".$maxgrafo."\">
	<div style=\"width: ".$Percpix."px\">
	<div class=\"barra\">";
	printf( " %u%%",$Perc);
	echo "</div></div></div>
	<div class=\"azzerafloat\"></div>";	
}	
echo "</div><a href=\"area.php?pag=elenco_sondaggi.php\">Altri Sondaggi</a>";
?>


