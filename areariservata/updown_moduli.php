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
require_once("auth.php");

$id = $_GET['id'];
$dir = $_GET['dir'];

$strmv="SELECT ordine FROM moduli where ID='$id'";
$risultatomv=mysql_query($strmv);
$order = mysql_fetch_row($risultatomv);

switch ($dir)
{
case "U":
	if ($order[0] != 0)
	{
		$strmv="Update moduli set ordine = $order[0] where ordine = $order[0]-1";
		$risultatomv=mysql_query($strmv);
		$strmv="update moduli set ordine = $order[0]-1 where ID='$id'";
		$risultatomv=mysql_query($strmv);
	}
break;
case "D":
	$strmv="Update moduli set ordine = $order[0] where ordine = $order[0]+1";
	$risultatomv=mysql_query($strmv);
	$strmv="update moduli set ordine = $order[0]+1 where ID='$id'";
	$risultatomv=mysql_query($strmv);
break;
}

//Header("Location: area.php?");
echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=elenco_moduli.php\" />";
exit;

?>