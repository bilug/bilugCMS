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

$id = (int)$_GET["id"];
$str = "SELECT totali, maxvoti, opzioni, titolo, utenti FROM sondaggi WHERE id = '$id' AND utenti = 'no' LIMIT 1";
$risultato = mysql_query($str);

if ( mysql_num_rows($risultato) > 0 ) :
	$control = mysql_fetch_row($risultato);	
	$totvoto = explode(";",$control[0]);
	$opzioni = explode(";",$control[2]); ?>
	<h1><span>Sondaggio</span></h1>
	
	<div class="contenitore">
		<h3>"<?=$control[3]?>" - numero voti : <?=$control[1]?></h3>
	
		<?php for ( $i=0; $i < count($totvoto); $i++ ) :
			$Perc = ( ($totvoto[$i]/$control[1]) * 100 );
			$Percpix = ($Perc*500) / (100); ?>
			
			<div class="float100"><?=$opzioni[$i]?> :</div>
			<div class="float500">
				<div style="width: <?=$Percpix?>px">
					<div class="barra"><?php printf( " %u%%",$Perc); ?></div>
				</div>
			</div>
			<div class="azzerafloat"></div>
			<p>&nbsp;</p>
		<?php endfor; ?>
	</div>
<?php else : ?>
	<h1><span>Nessun Sondaggio attivo</span></h1>
<?php endif ; ?>



