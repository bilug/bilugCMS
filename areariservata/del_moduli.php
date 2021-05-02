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

$id = $_GET['id'];

$str="DELETE FROM moduli WHERE ID='$id'";
// facciamo una query di eliminazione passando l'id del record da cancellare
$risultato=mysql_query($str);
if (!$risultato)
{
	echo "ERRORE: MODULO NON ELIMINATO";
   echo "<br/><a href=\"area.php?pag=elenco_moduli.php\">Riprova</a>";
}
else
	//Header("Location: area.php?pag=conferma.php");
	echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=conferma.php\" />";
	
exit;
?>