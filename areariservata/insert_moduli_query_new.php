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

if ( isset($_POST['id']) ) {
	foreach ( $_POST['id'] as $key => $value ) {
		switch ( $_POST['posizione'] ) {
			case '0': $str = "DELETE FROM moduli WHERE ID = '$value' LIMIT 1"; break;
			case '1': $str = "UPDATE moduli SET ordine = '$key', attivo = 'no' WHERE ID = '$value' LIMIT 1"; break;
			
			default: $str = "UPDATE moduli SET ordine = '$key', attivo = 'si', posizione = '".$_POST['posizione']."' WHERE ID = '$value' LIMIT 1"; break;
		}
		
		mysql_query($str);
		echo mysql_query($str) ? "$str ok \n\n" : "$str no \n\n";
	}
}


?>