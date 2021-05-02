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

$aut = $_GET['aut'];
$str = "SELECT ID, titolo, sottotitolo, testo, autore, argomento, DATE_FORMAT(data,'%d-%m-%Y'), autorizza, evidenzia, cliccato FROM notizie WHERE autore = '$aut' ORDER BY id";
// facciamo una query per caricare tutti i dati della tabella
$risultato=mysql_query($str);
if (mysql_num_rows($risultato)>0) {
	include( "include/include_tabella_notizie.php" );
}
else 
	echo "<p>Tabella vuota</p>";
?>
