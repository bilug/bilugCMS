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

$str=" SELECT * FROM anagrafica where id='$id'";
$risultato=mysql_query($str);
$control=mysql_fetch_row($risultato);

echo "<br/><br/>";
echo "Complimenti $control[1]<br/>";
echo "Hai effettuato la registrazione con successo.<br/>";
echo "Il tuo Nome Utente è:<br/>$control[3]<br/>";
echo "La tua Password è:<br/>$control[4]<br/>";
echo "<br/><br/>";

?>