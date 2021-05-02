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
//Verifico se esiste l'evidenziata
$str="SELECT ID ,titolo , sottotitolo , testo , autore , argomento , DATE_FORMAT(data,'%d/%m/%Y') , link,filmato FROM notizie WHERE evidenzia='si' AND autorizza='si'";
$risultato=mysql_query($str);
if (!$risultato OR mysql_num_rows($risultato)== 0)
{
	//Se non vi e' nessuna in evidenza visualizzo l'ultima inserita
	$str="SELECT Max(ID) FROM notizie WHERE autorizza='si' LIMIT 1";
	$risultato=mysql_query($str);
	$control=mysql_fetch_row($risultato);
	// calcoliamo l'ultimo ID dell'ultima notizia inserita

	$str2="SELECT ID ,titolo ,sottotitolo ,testo ,autore ,argomento ,DATE_FORMAT(data,'%d/%m/%Y'), link, filmato FROM notizie WHERE ID='$control[0]' LIMIT 1";
	$risultato2=mysql_query($str2);
	$control2=mysql_fetch_row($risultato2);
	// sapendo l'ID dell'ultima notizia, tiriamo fuori tutto il record
}
else {
	//Visualizzo la notizia che e' evidenziata
	$control2=mysql_fetch_row($risultato);
}
	
if ( $control2 != NULL ) :	
	$url_page = rurl( $control2[0], 'news' ); 
	
	$str3="SELECT nome, cognome FROM anagrafica WHERE ID = $control2[4] LIMIT 1";
	$risultato3=mysql_query($str3);
	$control3=mysql_fetch_row($risultato3);
	// query per sapere il nome dell'autore

	$str4="SELECT argomenti FROM argomenti WHERE ID = $control2[5] LIMIT 1";
	$risultato4=mysql_query($str4);
	$control4=mysql_fetch_row($risultato4);
	// query per sapere l'argomento
	?>
	<h1>
		<span><a href="<?=$url_page?>"><?=$control2[1]?></a></span>
		<?=adm_link('news', $control2[0])?>
	</h1>
	
	<?php if ( $control2[2] != '' ) : ?>
		<h2><span><?=$control2[2]?></span></h2>
	<?php endif; ?>
	
	<?php if ( _DATA OR _AUTORE ) : ?>
		<h4>
			<span class="autore">
				<?php if ( _DATA ) echo "NEWS INSERITA IL $control2[6]"; ?>
				<?php if (_AUTORE) echo " da $control3[0] $control3[1]"; ?>
			</span>
		</h4>
	<?php endif; ?>
	
	<?php if ( $control[10] != '' ) : ?>
		<h4><span class="argomento">Argomento: <?=$control4[0]?></span></h4>
	<?php endif; ?>
	
	<div class="testo">
		<?php if ( _SOCIAL_DINAMICHE_POSITION == 1 AND ( _SOCIAL_DINAMICHE_FB OR _SOCIAL_DINAMICHE_GP OR _SOCIAL_DINAMICHE_TW ) ) : ?>
			<div class="social_network"></div>
			<div class="azzerafloat"></div>
		<?php endif; ?>
		
		<?php 
			$filmato = unserialize($control2[8]);
			if ( $filmato->pos == 1 ) echo "$control2[3]";
			if ( $filmato->codice != '' ) {
				Render_Video($risoluzioni[$filmato->ris][0],$risoluzioni[$filmato->ris][1],
				$filmato->codice,$filmato->rel,$filmato->bordi,$sitivideo[$filmato->sito]);
			}
			if ( $filmato->pos == 0 ) echo "$control2[3]";
			if ( $control2[7] != '' ) : ?>
				<h5 class="citazione">
					<span>
						Citazione:<br />
						<a target="_blank" href="<?=$control2[7]?>"><?=$control2[7]?></a>
					</span>
				</h5>
			<?php endif; ?>
			
		<div class="azzerafloat"></div>
		
		<?php if ( $control2[7]!= '' ) : ?>
			<h5 class="citazione">
				<span>
					Citazione:<br />
					<a target="_blank" href="<?=$control2[7]?>"><?=$control2[7]?></a>
				</span>
			</h5>
		<?php endif; ?>

		<div class="azzerafloat"></div>
		
		<?php if ( _SOCIAL_DINAMICHE_POSITION == 2 AND ( _SOCIAL_DINAMICHE_FB OR _SOCIAL_DINAMICHE_GP OR _SOCIAL_DINAMICHE_TW ) ) : ?>
			<div class="social_network"></div>
			<div class="azzerafloat"></div>
		<?php endif; ?>
	
	</div>
	
	<?php 
	if ( _MAX_LAST_ARG > 0 ) :
		$str = "
			SELECT n.ID ,n.titolo, n.sottotitolo, n.testo, n.autore, n.argomento, DATE_FORMAT(n.data,'%d/%m/%Y'), n.link, an.nome, an.cognome, a.argomenti  
			FROM notizie n 
			INNER JOIN argomenti a ON a.ID = n.argomento 
			INNER JOIN anagrafica an ON an.ID = n.autore 
			WHERE n.autorizza='si' AND n.evidenzia='no' ORDER BY n.data DESC 
			LIMIT "._MAX_LAST_ARG."
		";
		//echo $str;
		$risultato = mysql_query($str); ?>
		
		<?php if ( mysql_num_rows($risultato) > 0 ) : ?>
			<h3 class="last_notice"><span>Le ultime <?=_MAX_LAST_ARG?> news:</span></h3>
			<?php while ( $control = mysql_fetch_row($risultato) ) : 
				$link = rurl( $control[0], 'news' ); ?>
				<div class="blocco_ultime_notizie">
				<h2><span><a href="<?=$link?>"><?=$control[1]?></a></span></h2>
				<?php if ( $control[2] != '' ) : ?> 
					<h3><span><?=$control[2]?></span></h3>
				<?php endif; ?>
				<?php if ( _DATA OR _AUTORE ) : ?>
					<h4><span class="autore">
						<?php if (_DATA) echo "NEWS INSERITA IL $control[6]"; ?>
						<?php if (_AUTORE) echo " da $control[8] $control[9]"; ?>
					</span></h4>
				<?php endif; ?>
				<?php if ( $control[10] != '' ) : ?>
					<h4><span class="argomento">Argomento: <?=$control[10]?></span></h4>
				<?php endif; ?>
				
				<p><?=substr( strip_tags( $control[3] ), 0, 200 )?>...</p>
				
				<h5><span class="leggi_tutto"><a href="<?=$link?>">leggi intero articolo..</a></span></h5>
				</div>
			<?php endwhile; ?>
		<?php endif; ?>
	<?php endif; ?>

	<script type="text/javascript">
		$(document).ready(function(){
			setTimeout( function(){
				$.ajax({
					url: '<?=_URLSITO?>/html/ajax/social_network_news.php',
					data: { url_page: "<?=$url_page?>", lingua_query: "<?=$lingua_query?>" },
					type: "post",
					async: false,
					success: function(data) {
						$('.social_network').html(data);
					}
				});
			}, 10 );
		})
	</script>	
	
<?php else : ?>
	<h1><span>Nessuna Notizia Disponibile</span></h1>
<?php endif; ?>

