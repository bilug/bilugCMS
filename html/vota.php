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

$IP = $_SERVER['REMOTE_ADDR'];
$id = (int)$_POST['id'];
$multipli = $_POST['multipli'];
$i = (int)$_POST['i'];

$link = rurl( $id, 'sondaggio-vedi-voti' );

$str = "SELECT ip FROM voti WHERE ip = '$IP' AND ID = '$id'";
$risultato = mysql_query($str);

if ( mysql_num_rows($risultato) == 0 ) {
	if ( $multipli == "no" ) {
		$voto = (int)$_POST["voto"];
		$voto--;
		$str = "INSERT INTO voti SET id = '$id', ip = '$IP', voto = '$voto'";
		$risultato = mysql_query($str);
	}
	else {
		$j = 0;
		while ( $j < $i ) {
			$str = "$"."_POST[\"voto".$j."\"]";			
			eval("\$voto = $str;");		
			if ( $voto > 0 ) {		 
				$voto--;
				$str = "INSERT INTO voti SET id = '$id', ip = '$IP', voto = '$voto'";
				$risultato = mysql_query($str);
			}
			$j++;
		}
	}
	
	if ( !$risultato ) $msg = "Errore nell'inserimento del voto";
	else {
		$str = "SELECT count(*) FROM voti WHERE id = '$id'";
		$risultato = mysql_query($str);
		$max = mysql_fetch_row($risultato);
		$str = "UPDATE sondaggi SET maxvoti = '$max[0]' WHERE id = '$id' LIMIT 1";
		$risultato = mysql_query($str);
		
		$str = "SELECT voto, count(voto) FROM voti WHERE id = '$id' GROUP BY voto ORDER BY voto";
		$risultato = mysql_query($str);
		$i = 0;	
		while ( $cont = mysql_fetch_row($risultato) ) {
			while ( $i != $cont[0] ) {
				$totale[$i++] = "0";			
			}
			$totale[$i++] = $cont[1];
		}	
		if (count($totale)==1) $totale = $totale[0].";";
		else $totale = implode(";",$totale);
		
		$str = "UPDATE sondaggi SET totali = '$totale' WHERE id = '$id' LIMIT 1";
		$risultato = mysql_query($str);
		$msg = "Il Voto e stato registrato correttamente";
	}
	
	confirm($msg);
	echo "<meta http-equiv=\"refresh\" content=\"0;url=$link\" />";		
}
else {
	$msg = "Hai gia votato per questo Sondaggio";
	confirm($msg);
	echo "<meta http-equiv=\"refresh\" content=\"0;url=$link\" />";
}	
?>


