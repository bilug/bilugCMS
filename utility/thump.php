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
	require_once("funzioni.php");
	$file = pulisci_stringa( $_GET['file'] );
  	$w = $_GET['w'];
  	$h = $_GET['h'];
  	$wo = $w;
   $ho = $h;
  	$dati= getimagesize("$file");

  	if ($dati[0] > $dati[1])
  	{
  		$rapporto = $dati[1] / $dati[0];
		$h = $h * $rapporto;							
  	}
  	else 
  	{
		if ($dati[0]<$dati[1])
		{
			$rapporto = $dati[0]/$dati[1];
			$w = $w * $rapporto;				
		}	  	
  	 }  
  	if (isset($_GET['nowa']))
  		$add = 0;
  	else
  	{
  		$water = @imagecreatefrompng("../img/water.png");
  		if (!$water)
		{
  			$add = 0;
  		}
  		else
  		{
  			imagealphablending($water,true);
  			$add = 1;  		
  		}
  	}
  switch ($dati['mime'])
  {
  	case "image/jpg":
  		$original = imagecreatefromjpeg("$file") or die("Error Opening original");
  		$tempImg = imagecreatetruecolor($w, $h);
  		imagecopyresampled($tempImg, $original, 0, 0, 0, 0, $w, $h, $dati[0], $dati[1]);  		
  		imagedestroy($original);  		
  		if ($add==1) imagecopy($tempImg,$water,$w-imagesx($water),$h-imagesy($water),0,0,imagesx($water),imagesy($water));
  		//imagepng($tempImg,NULL,0,PNG_ALL_FILTERS);  		
  		imagejpeg($tempImg);
  		break;
  	case "image/jpeg":
  		$original = imagecreatefromjpeg("$file") or die("Error Opening original");
  		$tempImg = imagecreatetruecolor($w, $h);
  		imagecopyresampled($tempImg, $original, 0, 0, 0, 0, $w, $h, $dati[0], $dati[1]);
  		imagedestroy($original);
  		if ($add==1) imagecopy($tempImg,$water,$w-imagesx($water),$h-imagesy($water),0,0,imagesx($water),imagesy($water));
  		//imagepng($tempImg,NULL,0,PNG_ALL_FILTERS);
  		imagejpeg($tempImg);
  		break;
  	case "image/gif":
  		$original = imagecreatefromgif("$file") or die("Error Opening original");
  		$tempImg = imagecreatetruecolor($w, $h);
  		imagecopyresampled($tempImg, $original, 0, 0, 0, 0, $w, $h, $dati[0], $dati[1]);
  		imagedestroy($original);  		
  		if ($add==1) imagecopy($tempImg,$water,$w-imagesx($water),$h-imagesy($water),0,0,imagesx($water),imagesy($water));
		//imagepng($tempImg,NULL,0,PNG_ALL_FILTERS);  		
  		imagegif($tempImg);
  		break;
  	case "image/png":
  		$original = imagecreatefrompng("$file") or die("Error Opening original");
  		$tempImg = imagecreatetruecolor($w, $h);
  		imagecopyresampled($tempImg, $original, 0, 0, 0, 0, $w, $h, $dati[0], $dati[1]);
  		imagedestroy($original);
  		if ($add==1) imagecopy($tempImg,$water,$w-imagesx($water),$h-imagesy($water),0,0,imagesx($water),imagesy($water));
  		imagepng($tempImg,NULL,0,PNG_ALL_FILTERS);
  	break;
 }     
  header("Content-type: $dati[mime]");
  imagedestroy($water);
  imagedestroy($tempImg);
  flush();
  ob_flush();  
?>