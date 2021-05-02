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

$dir = $_GET["dir"];
$id = $_GET["id"];

$query = "SELECT id, idpadre, posizione FROM menutipo WHERE id = '$id'";
$ris = mysql_query($query);
$record = mysql_fetch_array($ris);

switch($dir)
{
	case "U":{
				$posiz = $record[2]+1;
				$query2 = "SELECT id, idpadre, posizione FROM menutipo WHERE idpadre = '$record[1]' AND posizione = '$posiz'";
				$ris2 = mysql_query($query2);
				$record2 = mysql_fetch_array($ris2);
				if($record2)
				{
						$query3 = "UPDATE menutipo SET posizione = $record[2] WHERE id = '$record2[0]'";
						$ris3 = mysql_query($query3);
						$query4 = "UPDATE menutipo SET posizione = $record[2]+1 WHERE id = '$record[0]'";
						$ris4 = mysql_query($query4);
				}		
				
			}
		break;
	case "D":{
				$posiz = $record[2]-1;
				$query2 = "SELECT id, idpadre, posizione FROM menutipo WHERE idpadre = '$record[1]' AND posizione = '$posiz'";
				$ris2 = mysql_query($query2);
				$record2 = mysql_fetch_array($ris2);
				if($record2)
				{
						$query3 = "UPDATE menutipo SET posizione = $record[2] WHERE id = '$record2[0]'";
						$ris3 = mysql_query($query3);
						$query4 = "UPDATE menutipo SET posizione = $record[2]-1 WHERE id = '$record[0]'";
						$ris4 = mysql_query($query4);
				}
				
			}
		break;
}
echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=elenco_menu_new.php\" />";

?>
