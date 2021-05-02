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

$dataoggi = date("Y/m/d");
$dataoggi1 = $dataoggi; 
$dataoggi = explode("/", $dataoggi);


if($dataoggi[1] == "01")
{
		$dataoggi[1] = "12";
		$dataoggi[0]--;
}
else
{
	$dataoggi[1]--;
	
	if($dataoggi[1]<10)
	{
		$dataoggi[1] = "0".$dataoggi[1];
	}
}


$data = $dataoggi[0]."/".$dataoggi[1]."/".$dataoggi[2];

	// cancello tutti quei carrelli che non hanno portato ad un ordine di acquisto
	$str="DELETE FROM carrello WHERE data<'$data' AND email=''";
	$risultato=mysql_query($str);
	 echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=elenco_ecommerce_categorie.php\">";
?>
