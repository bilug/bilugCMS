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

$dir = $_GET['dir'];
$id = $_GET['id'];

if ($dir=="si")
	$strmv="Update moduli Set attivo='no' where ID='$id'";
else
	$strmv="Update moduli Set attivo='si' where ID='$id'";
	
$risultatomv=mysql_query($strmv);

Header("Location: area.php?pag=");
echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=elenco_moduli.php\" />";
exit;

?>