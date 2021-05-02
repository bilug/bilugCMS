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
$maxsize = _MAX_DIMENSIONE_W;
$file = $_FILES['file'];
$file1 = $_FILES['file1'];

if ( $file['name']=="" ) echo "Non e' stato inviato alcun file per le miniature<BR>";
else
{ 
	if ( $file['type'] != "image/png" )	echo "Inviare un file png per le miniature<BR>";
	else 
	{
		if ($file['size'] < $maxsize ) 
		{
			if (copy($file['tmp_name'],"../img/water.png"))
			{
				echo "<B>Invio del Watermark per le miniature riuscito</B>";
				# cancella il file temporaneo
				unlink($file['tmp_name']);
			} 
			else echo "Invio del Watermark per le miniature fallito";
		} 
		else	echo "Spiacente, il file da inviare per le miniature non deve superare le dimensioni di 3 KB<br/>";
	}
}
if ( $file1['name'] =="")	echo "Non e' stato inviato alcun file per le originali<BR>";
else 
{
	if ( $file1['type'] != "image/png" ) echo "Inviare un file png per le originali<BR>";
	else 
	{
		if ($file1['size'] < $maxsize ) 
		{
			if (copy($file1['tmp_name'],"../img/waterb.png"))
			{
				echo "<B>Invio del Watermark per originali riuscito</B>";
				# cancella il file temporaneo
				unlink($file1['tmp_name']);
			} 
			else echo "Invio del Watermark per originali fallito";			
		} 
		else echo "Spiacente, il file da inviare per le originali non deve superare le dimensioni di 3 KB<br/>";
	}
}
?>