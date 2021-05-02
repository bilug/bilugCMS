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
<?error_reporting(0);
session_start();
require_once("../utility/alert.php");
if (!isset($_SESSION['tux']) or $_SESSION['tux']<=0)
{
	//Non procedo sessione non valida
	$msg = "SESSIONE SCADUTA O NON VALIDA";
	//header("Refresh: 0; url");  	
	echo "<meta http-equiv=\"refresh\" content=\"0;url=../html/index.php\" />";
  	confirm($msg);	
   exit;
}
?>
