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

$stat = $_GET["stat"];
$str="SELECT corpo,titolo FROM statiche WHERE ID=$stat";
if ($risultato=mysql_query($str))
{
	$control=mysql_fetch_row($risultato);
	// pagina
	echo "<h3>Nome Pagina: $control[1]</h3>";
	echo "$control[0]";
}
else
   echo "<h3>Pagina Statica non esistente</h3>";
?>
<br/>
<a href="javascript:history.go(-1)">Precedente</a>