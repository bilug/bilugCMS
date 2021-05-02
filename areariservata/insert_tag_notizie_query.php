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

$id = (int)$_POST['id'];
$tag = $_POST['tag'];

$link_return = "area.php?pag=insert_tag_notizie.php&errore=si&id=$id";

$del = "DELETE FROM collegamento_tag WHERE id_notizia = $id";
mysql_query( $del );
mysql_query( "ALTER TABLE collegamento_tag AUTO_INCREMENT = 0" );

if ( count( $tag ) > 0 ) {
	
	foreach( $tag as $value ) {
		$ins = "INSERT INTO collegamento_tag SET id_notizia = $id, id_tag = $value";
		mysql_query( $ins );
	}
	
}

echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=conferma.php&from=elenco_notargaut.php\" />";


?>
