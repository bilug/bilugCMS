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

$str = "SELECT sezione, label, nomecampo, tipo, valore FROM parametri ORDER BY sezione";
$risultato=mysql_query($str);
if (mysql_num_rows($risultato)>0)
{
	if (defined("_LICENCE")) $testo = "<?php /* " . _LICENCE . " */ ?>";
	else
		$testo = "<?php /* License */ ?>";

	$testo .= "\n<?php\n";
	$sez="";
			
	while ($control=mysql_fetch_row($risultato))
	{
		if (($sez=="")OR($sez != $control[0]))
		{
			$sez = $control[0];
			$testo .= "//".$tipisezione[$control[0]]."\n";					
		}
		$testo .= "define(\"$control[2]\",";
		if ($control[3]== 0) $testo .= "\"$control[4]\");";
		else $testo .= "$control[4]);";
		$testo .= " //$control[1]\n";
	}
$testo .="?>";
  	
$filename= "custom/costanti.php";
$handle = fopen($filename,"w+");
@fwrite($handle,$testo);
fclose($handle);
}
?>
