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

$news = $_GET["id"];
$str="Select ID ,titolo , sottotitolo , testo , autore , argomento , DATE_FORMAT(data,'%d-%m-%Y') , link,filmato FROM notizie WHERE ID=$news";
$risultato=mysql_query($str);
$control=mysql_fetch_row($risultato);
// sapendo l'ID dell'ultima notizia, tiriamo fuori tutto il record

$str2="SELECT nome,cognome FROM anagrafica WHERE ID=$control[4]";
$risultato2=mysql_query($str2);
$control2=mysql_fetch_row($risultato2);
// query per sapere il nome dell'autore

$str3="SELECT argomenti FROM argomenti WHERE ID=$control[5]";
$risultato3=mysql_query($str3);
$control3=mysql_fetch_row($risultato3);
// query per sapere l'argomento

echo "<h1 class=\"autore\">NEWS INSERITA IL $control[6], da $control2[0] $control2[1]</h1>";
echo "<h4 class=\"argomento\">Argomento: $control3[0]</h4>";
echo "<div class=\"sottotitolo\"><h2>$control[1]</h2>$control[2]</div>";
$filmato = unserialize($control[8]);
if ($filmato->pos == 1) echo "$control[3]";
if ($filmato->codice !="")
{
	Render_Video($risoluzioni[$filmato->ris][0],$risoluzioni[$filmato->ris][1],
		$filmato->codice,$filmato->rel,$filmato->bordi,$sitivideo[$filmato->sito]);
}
if ($filmato->pos == 0) echo "$control[3]";
if ($control[7]!="")
{
	echo "<h5>Link di approfondimento:<br/><a target=\"_blank\" href=\"$control[7]\">$control[7]</a><h5>";
}

?>
<br/>
<a href="javascript:history.go(-1)">Precedente</a> -
<a href="area.php?pag=elenco_notargaut.php">Altre notizie</a>
