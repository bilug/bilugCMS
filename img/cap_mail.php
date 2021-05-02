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
/*
* CAPTCHA SYSTEM
* CREATO DA REMOTES
* SITO: http://www.remotes.it
* EMAIL: webmaster@remotes.it
*
* QUESTO SCRIPT E' SCRITTO IN PHP E NECESSITA DELLE LIBRERIE GD
*
* PER VISUALIZZARE L'IMMAGINE USATE IL TAG HTML:
* <img src="cap_mail.php">
*
* IL NUMERO CORRETTO PER ESEGUIRE IL CONFRONTO SI TROVA NELLA VARIABILE:
* $_SESSION['cap_mail']
*/



// LO SCRIPT DEVE ESSERE CARICATO A SE' STANTE, NON PUO' ESSERE INCLUSO LATO SERVER
//if (!eregi("cap_mail.php",$_SERVER['PHP_SELF'])) header ("Location: index.php");

// AVVIA LA SESSIONE
session_start();

// GENERA 5 CIFRE A RANDOM

do{
	
	$cap1 = rand("1","9");
	$cap2 = rand("1","9");
	$cap3 = "=";
	$cap4 = rand("0","2");
	
}while($cap4==1 and $cap2>=$cap1);

switch ($cap4)
{
	case 0:{ 
			$operat="+";
			$operaz= $cap1+$cap2;
		}
	break;
	case 1:{ 
			$operat="-";
			$operaz= $cap1-$cap2;
		}
	break;
	case 2:{ 
			$operat="*";
			$operaz= $cap1*$cap2;
		}
	break;
}


// COMPONE IL NUMERO E LO SALVA IN UNA SESSIONE
unset( $_SESSION['cap_mail'] );
$_SESSION['cap_mail'] = $operaz;

// AVVIA l'ISTANZA PER LA CREAZIONE DELL'IMMAGINE
$immagine = imageCreate(88, 36);

// DEFINISCE I COLORI CHE UTILIZZEREMO NELL'IMMAGINE
// (IL PRIMO COLORE INSERITO DIVIENE AUTOMATICAMENTE LO SFONDO)
$arancio = imageColorAllocate($immagine, 255, 136, 0);
$blu = imageColorAllocate($immagine, 0, 0, 255);

// GENERA A RANDOM UN NUMERO DI PUNTI (COMPRESO TRA 50 E 100)
$ndot = rand("50","100");

// CICLO PER L'INSERIMENTO DEI PUNTI
$zdot = 1;
while ($zdot <= $ndot) {
	$dotx = rand("2","86");
	$doty = rand("2","34");
	imageline($immagine, $dotx, $doty, $dotx, $doty, $blu);
	$zdot++;
}

// SCRIVE LE CIFRE INSERENDOLE CON UNA X FISSA E UNA Y VARIABILE
imageString($immagine, 5, 15, rand("5","15"), $cap1, $blu);
imageString($immagine, 5, 30, rand("5","15"), $operat, $blu);
imageString($immagine, 5, 45, rand("5","15"), $cap2, $blu);
imageString($immagine, 5, 60, rand("5","15"), $cap3, $blu);
//imageString($immagine, 5, 75, rand("5","15"), $_SESSION['cap_mail'], $blu);

//imageString($immagine, 5, 70, rand("5","15"), $cap5, $blu);

// DEFINISCE IL MIME-TYPE DELL'IMMAGINE (IN QUESTO CASO COME IMMAGINE PNG)
header("Content-type: image/png");

// CREA L'IMMAGINE PNG
imagepng($immagine);

// LIBERA LA MEMORIA
imageDestroy($immagine);

exit();
?> 
