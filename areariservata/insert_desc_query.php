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

$i = 0;

$id = $_POST["id"];
$confirm = true;

$desc = $_POST['titolo'];

foreach( $desc as $key => $value ) {
	$value = apici( $value );
	$sql = "UPDATE galleria SET descrizione = '$value' WHERE id = $key LIMIT 1";
	mysql_query( $sql );
	
	$i++;
}

if ( $confirm ) {
	echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=conferma.php&from=elenco_fotogal.php-id=$id\" />";
	exit;
}


?>
