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

$operazione = $_GET["s"];
$email = $_GET["e"];
$code = $_GET["c"];

if ($operazione == 'a') {
	$str = "UPDATE newsletter SET stato = 0 WHERE email = '$email' AND code = '$code'";
	mysql_query($str);
	if (mysql_affected_rows() == 1)
	{
		echo "<h3>Registrazione alla Newsletter eseguita correttamente</h3>";
	}
	else
	{
		echo "<h3>Registrazione alla Newsletter non eseguita <br/> Riprovare piu' tardi</h3>";
	}
}
else if ($operazione == 'd') {
	$str = "DELETE FROM newsletter WHERE email = '$email' AND code = '$code'";
	mysql_query($str);		
	if (mysql_affected_rows() == 1)
	{
		echo "<h3>Cancellazione dalla Newsletter eseguita correttamente</h3>";
	}
	else
	{
		echo "<h3>Cancellazione dalla Newsletter non eseguita <br/> Riprovare piu' tardi</h3>";
	}
}

?>

<p>
	<a href="<?=_URLSITO?>">Clicca qui per tornare alla home page</a>
</p>