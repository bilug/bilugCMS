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
<?php

require_once("auth.php");

if($_SESSION['typo']== "U")
{
	echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=listafile.php	\" />";
	$msg = "AZIONE NON CONSENTITA";				  
	confirm($msg);
	exit;
}


$id = (int)$_GET['id'];

$sql = "SELECT id_padre, immagine FROM galleria WHERE id = $id LIMIT 1";
$rssql = mysql_query( $sql );
$img = mysql_result( $rssql, 0, 1 );
$id_padre = mysql_result( $rssql, 0, 0 );

$sql = "SELECT cartella, id_padre FROM galleria WHERE id = $id_padre LIMIT 1";
$rssql = mysql_query( $sql );
$id_padre2 = mysql_result( $rssql, 0, 1 );
$sottodir = mysql_result( $rssql, 0, 0 );

$sql = "SELECT cartella FROM galleria WHERE id = $id_padre2 LIMIT 1";
$rssql = mysql_query( $sql );
$dirpadre = mysql_result( $rssql, 0, 0 );

$dir ="../gals/".$dirpadre."/".$sottodir."/";

echo $dir.$img;
if ( unlink( $dir.$img ) )
{
	$del = "DELETE FROM galleria WHERE id = $id LIMIT 1";
	mysql_query( $del );
	
	echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=conferma.php&from=listafile.php-id=$id_padre\" />";
}
else
{
	echo "ERRORE: IMMAGINE/MATERIALE NON ELIMINATA";
   echo "<br/><a href=\"javascript:history.go(-1)\">Ritorna</a>";
}

exit;
?>
