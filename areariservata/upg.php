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

$maxsize = _MAX_DIMENSIONE;
$maxw = _MAX_LARGHEZZA;
$maxh = _MAX_ALTEZZA;
$file = $_FILES['file'];
$quanti = count($file['name'])-1;
$id = $_POST['id'];
$argo = $_POST['argo'];
$swater = $_POST['water'];
$nored = $_POST['nored'];

if ( $file['name'][0] == "" ) {
	echo "Non e' stato inviato alcun file<br/>";
	echo "$dir <br/><a href=\"area.php?pag=uploadg.php&amp;argo=$argo&amp;id=$id\">Invia altre immagini</a>";
	exit;
}

$sql = "SELECT cartella, id_padre FROM galleria WHERE id = $id LIMIT 1";
$rssql = mysql_query( $sql );
$sottodir = mysql_result( $rssql, 0, 0 );
$id_padre = mysql_result( $rssql, 0, 1 );

$sql = "SELECT cartella FROM galleria WHERE id = $id_padre LIMIT 1";
$rssql = mysql_query( $sql );
$dirpadre = mysql_result( $rssql, 0, 0 );

$dir ="../gals/".$dirpadre."/".$sottodir."/";

for ($i=0;$i<$quanti;$i++)
{
	echo "Nome originale del file remoto: ".$file['name'][$i]."\n<br/>";	
	echo "Dimensioni del file in byte: ".$file['size'][$i]."\n<br/>";
	echo "Tipo di file: ".$file['type'][$i]."\n<br/>";
	echo "<br/>";		
	# controlla innanzitutto le dimensioni del file	
	if ($file['size'][$i] < $maxsize ) 
	{
		# lo copia in una nuova posizione
		$nome_file = pulisci_stringa_dir( $file["name"][$i] );
		$file_name = $dir.$nome_file;		
		if (copy($file["tmp_name"][$i],$file_name)) {
			// Inserisco l'immagine nella tabella
			$sql = "INSERT INTO galleria ( id_padre, immagine ) VALUES ( $id, '$nome_file' )";
			mysql_query( $sql );
			
			$dati= getimagesize($file_name);
			// Verifica Dimensione Immagine se no ridimensiono
			list($w,$h)=getimagesize($file_name);
			echo "Dimensioni del file Originali: Larg: ".$w." - Alt: ".$h."\n<br/>";
			if ($nored != "on")
			{			
				if (($w > $maxw )|($h > $maxh ))
				{
					$x_ratio = $maxw / $w;
					$y_ratio = $maxh / $h;
					
					if (($x_ratio * $h) < $maxh)
					{
	        				$tn_h = ceil($x_ratio * $h);
	        				$tn_w = $maxw;
	    			}			
	    			else
	    			{
	        			$tn_w = ceil($y_ratio * $w);
	        			$tn_h = $maxh;
					}
					echo "Ridimensionamento del file : Larg: ".$tn_w." - Alt: ".$tn_h."\n<br/>";				
					switch ($dati['mime'])
		 			{
		  				case "image/jpg":
					  		$original = imagecreatefromjpeg($file_name) or die("Error Opening original");
					  		$tempImg = imagecreatetruecolor($tn_w, $tn_h);
					  		imagecopyresampled($tempImg,$original,0,0,0,0,$tn_w,$tn_h,$w, $h);
					  		imagedestroy($original);  	  	
					  		imagejpeg($tempImg,$file_name);	
					  		break;
					  	case "image/jpeg":
					  		$original = imagecreatefromjpeg($file_name) or die("Error Opening original");
					  		$tempImg = imagecreatetruecolor($tn_w, $tn_h);
					  		imagecopyresampled($tempImg,$original,0,0,0,0,$tn_w,$tn_h,$w, $h);
					  		imagedestroy($original);  	
					  		imagejpeg($tempImg,$file_name);  		
					  		break;
					  	case "image/gif":
					  		$original = imagecreatefromgif($file_name) or die("Error Opening original");
					  		$tempImg = imagecreatetruecolor($tn_w, $tn_h);
					  		imagecopyresampled($tempImg,$original,0,0,0,0,$tn_w,$tn_h,$w, $h);
					  		imagedestroy($original);  	
					  		imagegif($tempImg,$file_name);
					  		break;
					  	case "image/png":
					  		$original = imagecreatefrompng($file_name) or die("Error Opening original");
					  		$tempImg = imagecreatetruecolor($tn_w, $tn_h);
					  		imagecopyresampled($tempImg,$original,0,0,0,0,$tn_w,$tn_h,$w, $h);
					  		imagedestroy($original);  	
					  		imagepng($tempImg,$file_name,0,PNG_ALL_FILTERS);	
					  	break;
					}
				}
			}
			else echo "Nessuna Riduzione Richiesta<br/>";
			
			if ($swater=="on")
			{
				// Aggiungo una scritta
				echo "Aggiunta Watermark alla foto<br/>";
				
				$water = @imagecreatefrompng("../img/waterb.png");
				if (!$water){}
				else				
				{				
					imagealphablending($water,true);
					$dati= getimagesize($file_name);
					switch ($dati['mime'])
		 			{
		  				case "image/jpg":
					  		$original = imagecreatefromjpeg($file_name) or die("Error Opening original");
					  		imagecopyresampled($original,$water,0,0,0,0,$dati[0], $dati[1],imagesx($water),imagesy($water));  	
					  		imagejpeg($original,$file_name);	
					  		break;
					  	case "image/jpeg":
					  		$original = imagecreatefromjpeg($file_name) or die("Error Opening original");
					  		imagecopyresampled($original,$water,0,0,0,0,$dati[0], $dati[1],imagesx($water),imagesy($water));
					  		imagejpeg($original,$file_name);  		
					  		break;
					  	case "image/gif":
					  		$original = imagecreatefromgif($file_name) or die("Error Opening original");
					  		imagecopyresampled($original,$water,0,0,0,0,$dati[0], $dati[1],imagesx($water),imagesy($water));  		
					  		imagegif($original,$file_name);
					  		break;
					  	case "image/png":
					  		$original = imagecreatefrompng($file_name) or die("Error Opening original");
					  		imagecopyresampled($original,$water,0,0,0,0,$dati[0], $dati[1],imagesx($water),imagesy($water));  	
							imagepng($original,$file_name,0,PNG_ALL_FILTERS);	
					  	break;
					}
					echo "Aggiunta Watermark riuscita<br/>";
				}     
			}
			echo "<B>Invio del file riuscito</B><br/>";
			# cancella il file temporaneo
			unlink($file['tmp_name'][$i]);
		} 
		else 
		{
			echo "Invio del file fallito<br/>";
		}
	} 
	else 
	{
		echo "Spiacente, il file da inviare non deve superare le dimensioni di 3 KB<br/>";
	}
	echo "<hr/><br/>";
}
echo "$dir <br/><a href=\"area.php?pag=uploadg.php&amp;argo=$argo&amp;id=$id\">Invia altre immagini</a>";
?>
