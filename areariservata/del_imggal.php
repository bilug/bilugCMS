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

$what = apici($_GET['what']);
$argo = apici($_GET['argo']);
$id = $_GET['id'];
if (@unlink( $what))	
{
	$str="delete from galleria WHERE immagine ='".$argo."/".$id."'";			
   // query di modifica
   $risultato=mysql_query($str);
	header("HTTP/1.1 301 Moved Permanently");   
	//header ("Location: ");	
	echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=listgal.php&argo=$argo&id=$id\" />";
}
else
{
	echo "ERRORE: IMMAGINE NON ELIMINATA";
   echo "<br/><a href=\"javascript:history.go(-1)\">Ritorna</a>";
}

exit;
?>