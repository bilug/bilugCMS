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

$what = $_GET['what'];

if ($what=="mini")
{
	if (@unlink("./img/water.png"))
	{
		header("HTTP/1.1 301 Moved Permanently");
		//header ("Location: area.php?pag=conferma.php");
		echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=conferma.php\" />";
	}
	else
	{
		echo "Nessuna Watermark per miniature presente";
   	echo "<br/><a href=\"javascript:history.go(-1)\">Ritorna</a>";
	}
} 

if ($what=="ori")
{
	if (@unlink("./img/waterb.png"))
	{
		header("HTTP/1.1 301 Moved Permanently");
		//header ("Location: area.php?pag=conferma.php");
		echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=conferma.php\" />";
	}
	else
	{
		echo "Nessuna Watermark per originali presente";
   	echo "<br/><a href=\"javascript:history.go(-1)\">Ritorna</a>";
	}
} 

exit;
?>