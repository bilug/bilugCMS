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

$news = (int)$_GET["news"];
$argo = (int)$_GET["argo"];

$str = "
	SELECT n.ID ,n.titolo ,n.sottotitolo ,n.testo ,n.autore ,n.argomento ,DATE_FORMAT(n.data,'%d/%m/%Y') AS data_news, n.link, n.filmato, an.nome, an.cognome, a.argomenti 
	FROM notizie AS n 
	INNER JOIN argomenti AS a ON a.ID = n.argomento 
	INNER JOIN anagrafica AS an ON an.ID = n.autore 
	WHERE n.ID = $news AND n.autorizza = 'si' 
	LIMIT 1
";
$risultato = mysql_query( $str );

if ( mysql_num_rows( $risultato ) == 1 ) :
	$control = mysql_fetch_assoc( $risultato );
	$url_page = rurl( $control['ID'], 'news' );

	$immagine_principale = estrai_immagine_principale( $control['testo'] ); ?>

	<link rel="image_src" href="<?=$immagine_principale?>">

	<?php breadcrumbs( array(
		'Home' => _URLSITO,
		'Argomenti' => _URLSITO.'/argo/',
		$control['argomenti'] => rurl( $control['argomento'], 'argo' ),
		$control['titolo'] => ''
	) ); ?>
	
	<h1>
		<span><?=$control['titolo']?></span>
		<?=adm_link('news', $news)?>
	</h1>
	
	<?php if ( $control['sottotitolo'] != '' ) : ?>
		<h2><span><?=$control['sottotitolo']?></span></h2>
	<?php endif; ?>
	<?php if ( $control['argomenti'] != '' ) : ?>
		<h3><?=$control['argomenti']?></h3>
	<?php endif; ?>
	<?php if ( _DATA OR _AUTORE ) : ?>
		<h4><span class="autore">
			<?php if ( _DATA ) echo "News Inserita Il $control[data_news]"; ?>
			<?php if ( _AUTORE ) echo " da $control[nome] $control[cognome]"; ?>
		</span></h4>	
	<?php endif; ?>
	
	<?php if ( _SOCIAL_DINAMICHE_POSITION == 1 AND ( _SOCIAL_DINAMICHE_FB OR _SOCIAL_DINAMICHE_GP OR _SOCIAL_DINAMICHE_TW ) ) : ?>
		<div class="social_network"></div>
		<div class="azzerafloat"></div>
	<?php endif; ?>
	
	<?php
	$filmato = unserialize($control['filmato']);
	if ($filmato->pos == 1) echo "$control[testo]";
	if ($filmato->codice !="")
	{
		Render_Video($risoluzioni[$filmato->ris][0],$risoluzioni[$filmato->ris][1],
			$filmato->codice,$filmato->rel,$filmato->bordi,$sitivideo[$filmato->sito]);
	}
	if ($filmato->pos == 0) echo "$control[testo]";
	if ($control['link']!="") : ?>
		<h5 class="citazione">
			<span>
				Citazione:<br />
				<a target="_blank" href="<?=$control['link']?>"><?=$control['link']?></a>
			</span>
		</h5>
	<?php endif; ?>
	
	<div class="azzerafloat"></div>

	<?php if ( _SOCIAL_DINAMICHE_POSITION == 2 AND ( _SOCIAL_DINAMICHE_FB OR _SOCIAL_DINAMICHE_GP OR _SOCIAL_DINAMICHE_TW ) ) : ?>
		<div class="social_network"></div>
		<div class="azzerafloat"></div>
	<?php endif; ?>
	
	<?php if ( _NEWS_NAVIGAZIONE_ARTICOLI ) : ?>
		<?php $news_precedente = "SELECT id, titolo FROM notizie WHERE argomento = $argo AND id < $news AND autorizza = 'si' ORDER BY id DESC LIMIT 1";
			$news_precedente = mysql_query( $news_precedente ); ?>
		<?php $news_successiva = "SELECT id, titolo FROM notizie WHERE argomento = $argo AND id > $news AND autorizza = 'si' ORDER BY id ASC LIMIT 1"; 
			$news_successiva = mysql_query( $news_successiva ); ?>
		<nav class="navigazione-news">
			<?php if ( mysql_num_rows($news_precedente) > 0 ) : $link = rurl( mysql_result($news_precedente, 0, 0), 'news' ); ?>
				<a title="Notizia precedente" class="navigazione-news-precente" href="<?=$link?>">
					<span class="navigazione-news-left navigazione-news-freccia">&#9668;</span> 
					<span class="navigazione-news-right navigazione-news-link"><?=mysql_result($news_precedente, 0, 1)?></span>
					<span class="azzerafloat"></span>
				</a>
			<?php endif; ?> 
			<?php if ( mysql_num_rows($news_successiva) > 0 ) : $link = rurl( mysql_result($news_successiva, 0, 0), 'news' ); ?>
				<a title="Notizia successiva" class="navigazione-news-successivo" href="<?=$link?>">
					<span class="navigazione-news-left navigazione-news-link"><?=mysql_result($news_successiva, 0, 1)?></span>
					<span class="navigazione-news-right navigazione-news-freccia">&#9658;</span>
					<span class="azzerafloat"></span>
				</a>
			<?php endif; ?>
			<div class="azzerafloat"></div>
		</nav>
	<?php endif; ?>

	<?php if ( _DISQUS_BLOG_COMMENTS ) : ?>
		<div class="disqus-comment-code"><?php include( "./custom/disqus_code_comments.php" ); ?></div>
	<?php endif; ?>
	
	<?php 
	// Aggiornamento del click sulla pagina per questa notizia
	if ( !isset( $_SESSION["news_$news"] ) ) {
		$_SESSION["news_$news"] = 1;
		$sql = "SELECT cliccato, cliccato_oggi FROM notizie WHERE id = $news LIMIT 1";
		$rssql = mysql_query( $sql );
		
		$click = ( (int)mysql_result( $rssql, 0, 0 ) ) + 1;
		$click_oggi = ( (int)mysql_result( $rssql, 0, 1 ) ) + 1;
		
		$sql = "UPDATE notizie SET cliccato = $click, cliccato_oggi = $click_oggi WHERE id = $news LIMIT 1";
		mysql_query( $sql );	
	}	
	?>

	<script type="text/javascript">
		$(document).ready(function(){
			var loaderfb = "<img src=\"<?=_URLSITO?>/img/loader-fb.gif\" alt=\"Loading Facebook\">";
			$('.social_network').html(loaderfb);
			$.ajax({
				url: '<?=_URLSITO?>/html/ajax/social_network_news.php',
				data: { url_page: "<?=$url_page?>", lingua_query: "<?=$lingua_query?>" },
				type: "post",
				async: true,
				success: function(data) {
					$('.social_network').html(data);
				}
			});
		})
	</script>		
<?php else : 
   $link = rurl( $argo, 'argo' ); ?>
	<script language="javascript">
		document.location.href = '<?=$link?>';
	</script>
<?php endif; ?>

