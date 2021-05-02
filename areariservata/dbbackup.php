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

$email = array();
$aut = $_SESSION['tux'];

if ($_SESSION['typo'] == "A") 
$str="SELECT email,nome,cognome,id FROM anagrafica ORDER BY data";
else	
$str=" SELECT email,nome,cognome FROM anagrafica where id = $aut LIMIT 1";
// facciamo una query per caricare tutti i dati della tabella
$risultato=mysql_query($str);
if ($risultato>0)
{
	while($control=mysql_fetch_row($risultato))
	{
		$email[$control[0]] = "$control[1] $control[2]";
	}	
}
?>
<form id="email" method="post" action="area.php?pag=../phpmysqlautobackup/run.php">
	Selezionare email verso chi inviare il backup:
	<select name="destinatario" size="0">
	<?foreach ($email as $key=>$value)	
	{
		echo "<option value=\"$key\">$value</option>";
	}?>
	</select><br/>
	<input type="submit" name="Esegui Backup" />
</form>
