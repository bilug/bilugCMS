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

$arg = $_GET['id'];
$str="Select ID ,titolo , sottotitolo , testo, DATE_FORMAT(data,'%d-%m-%Y') , link FROM notizieint WHERE ID='$arg'";
$risultato=mysql_query($str);
$control=mysql_fetch_row($risultato);
// sapendo l'ID dell'ultima notizia, tiriamo fuori tutto il record

echo "<h1>NEWS INSERITA IL $control[4]</h1>";
echo "<div id=\"sottotitolo\"><h2>$control[1]</h2>$control[2]</div>";
echo "$control[3]";
if ($control[5]!="")
{
	echo "<h5>Link di approfondimento:<br/><a target=\"_blank\" href=$control[7]>$control[5]</a><h5>";
}

?>
<br/>
<a href="area.php?pag=elenco_notizieint.php">Altre notizie</a>
