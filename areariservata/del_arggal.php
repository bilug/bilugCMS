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

$sql = "SELECT cartella FROM galleria WHERE id = $id LIMIT 1";
$rssql = mysql_query($sql);
$dir_figlio = mysql_result( $rssql, 0, 0 );

$dir = '../gals/'.$dir_figlio.'/';

// Cancello tutto il contenuto di una cartella
if ( !rmdirr($dir) ) {	
	$tipoerr = "GALLERIA NON ELIMINATA - SONO PRESENTI DELLE SOTTO-GALLERIE";
	echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=elenco_arg_gallerie.php&errore=si&tipoerr=$tipoerr&id=$id\" />";
}
else {
	$sql = "SELECT id FROM galleria WHERE id_padre = $id";
	$rssql = mysql_query($sql);
	if ( mysql_num_rows($rssql) > 0 ) {
		while( $r = mysql_fetch_row($rssql) ) {
			$id_padre = $r[0];
			$sql = "DELETE FROM galleria WHERE id_padre = $id_padre";
			mysql_query($sql);
		}
	}
	
	$sql = "DELETE FROM galleria WHERE id = $id OR id_padre = $id";
	mysql_query($sql);
	
	echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=conferma.php&from=elenco_arg_gallerie.php-id=$id\" />";
}
	
?>
