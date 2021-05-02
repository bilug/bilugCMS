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

include( "../utility/headers.php" );

$id = (int)$_GET["id"];
$idc = (int)$_GET["idc"];
$delete = apici( $_GET["delete"] );
$idecom = session_id();

$link = ( $id == 0 ) ? rurl( 0, 'ecommerce' ) : rurl( $id, 'ecommerce-dettaglio' );
$link = ( isset( $_GET['pag'] ) ) ? rurl( 0, 'ecommerce-dettaglio-carrello' ) : $link;

if ( $delete != "" ) {
	$str = "UPDATE carrello SET elimina = 1 WHERE id = '$idc' AND utente = '$idecom' AND elimina = 0 LIMIT 1";
	mysql_query($str);
}

header( "Location: $link" );

?>