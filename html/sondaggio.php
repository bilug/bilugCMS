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

$str = "
	SELECT s.ID, s.titolo, s.opzioni, s.totali, s.maxvoti, s.multipli, s.utenti 
	FROM sondaggi AS s 
	INNER JOIN lingue AS l ON l.id = s.id_lingua 
	WHERE s.attivo = 'si' AND s.utenti = 'no' AND l.sigla = '$lingua_query'
";
$risultato = mysql_query($str);
if ( mysql_num_rows($risultato) > 0 ) :
	$control = mysql_fetch_row($risultato);	?>
	<div class="blocco">
		<h3><span><?=$titolo?></span></h3>
		<div class="modulo">
			<?php $link = rurl( 0, 'sondaggio-vota' ); ?>
			<form name="sondaggi" method="post" action="<?=$link?>">
				<input type="hidden" name="id" value="<?=$control[0]?>">
				<input type="hidden" name="multipli" value="<?=$control[5]?>">
				<h4>
					<?=$control[1]?>
					<?php if ( $control[5] == "si" ) : ?>
						<small>(selz. multipla)</small>
					<?php endif; ?>
				</h4>
				<ul>
					<?php $opzioni = explode(";",$control[2]);   
					for ( $i=0; $i<count($opzioni); $i++ ) :
						$v=$i+1;
						if ($control[5] == "no") : ?>
							<li><input class="ie" type="radio" name="voto" value="<?=$v?>"> <?=$opzioni[$i]?></li>
						<?php else : ?>
							<li><input class="ie" type="checkbox" name="voto<?=$i?>" value="<?=$v?>"> <?=$opzioni[$i]?></li>
						<?php endif; ?>
					<?php endfor; ?>
					<input type="hidden" name="i" value="<?=$i?>">
				</ul>
				<p><input type="submit" name="Vota" value="Vota" class="bottomlato"></p>
				<?php $link = rurl( $control[0], 'sondaggio-vedi-voti' ); ?>
				<p><a href="<?=$link?>">Num.voti: <?=$control[4]?></a></p>     
			</form>
		</div>
	</div>
<?php endif; ?>

