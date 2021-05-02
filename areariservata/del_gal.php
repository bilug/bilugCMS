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
	
$id = (int)$_GET['id'];
$argo = (int)$_GET['argo'];

$sql = "SELECT cartella FROM galleria WHERE id = $id LIMIT 1";
$rssql = mysql_query($sql);
$dir_figlio = mysql_result( $rssql, 0, 0 );

$sql = "SELECT cartella FROM galleria WHERE id = $argo LIMIT 1";
$rssql = mysql_query($sql);
$dir_padre = mysql_result( $rssql, 0, 0 );

$dir = '../gals/'.$dir_padre.'/'.$dir_figlio.'/';

// Cancello tutto il contenuto di una cartella
if ( !rmdirr($dir) ) {	
	$tipoerr = "SOTTO-GALLERIA NON ELIMINATA - SONO PRESENTI DELLE IMMAGINI";
	echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=elenco_gallerie.php&errore=si&tipoerr=$tipoerr&argo=$argo\" />";
}
else {
	$sql = "DELETE FROM galleria WHERE id = $id OR id_padre = $id";
	mysql_query($sql);
	echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=conferma.php&from=elenco_gallerie.php-argo=$argo\" />";
}
	
?>
