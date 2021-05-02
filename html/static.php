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

if ( !isset( $_GET["stat"] ) OR $_GET["stat"] <= 0 ) {
	// Controllo se la home page è una pagina statica	
	$homepage = "SELECT id FROM parametri WHERE valore = './html/static.php' AND nomecampo = '_CORPO' LIMIT 1";
	$rshomepage = mysql_query( $homepage );
	$home = mysql_num_rows( $rshomepage );

	$stat = ( $home == 0 ) ? 0 : $home_statica;
}
else {
	$stat = (int)$_GET["stat"];
}

$str="
	SELECT s.corpo, s.maps, s.titolo 
	FROM statiche AS s 
	INNER JOIN lingue AS l ON l.id = s.id_lingua 
	WHERE s.ID = $stat AND l.sigla = '$lingua_query' 
	LIMIT 1
";

$risultato = mysql_query($str);
if ( mysql_num_rows( $risultato ) == 1 ) :
	$control = mysql_fetch_row($risultato);
	$url_page = rurl( $stat, 'static' );
	?>
	
	<?php if ( isset( $_GET["stat"] ) ) : 
		breadcrumbs( array(
			'Home' => _URLSITO,
			'Men&ugrave;' => _URLSITO.'/static/',
			$control[2] => ''
		) ); 
	endif; ?>
	
	<h1>
		<span><?=$control[2]?></span>
		<?=adm_link('statica', $stat)?>
	</h1>
	
	<?php if ( _SOCIAL_STATICHE_POSITION == 1 AND ( _SOCIAL_STATICHE_FB OR _SOCIAL_STATICHE_GP OR _SOCIAL_STATICHE_TW ) ) : ?>
		<div class="social_network"></div>
		<div class="azzerafloat"></div>
	<?php endif; ?>
	
	<?php
	// google maps se prevista
	if ( $control[1] != '' ) {
		$maps = explode( '||', $control[1] );
		
		if ( $maps[1] == 'p' ) echo "<div class=\"testo\">$control[0]</div>";
			
		include( _PATH_PAGINE."index_googlemaps.php" );

		if ( $maps[1] == 'd' ) echo "<div class=\"testo\">$control[0]</div>";
	}
	else {
		echo "<div class=\"testo\">$control[0]</div>";
	}
	?>
	
	<div class="azzerafloat"></div>

	<?php if ( _SOCIAL_STATICHE_POSITION == 2 AND ( _SOCIAL_STATICHE_FB OR _SOCIAL_STATICHE_GP OR _SOCIAL_STATICHE_TW ) ) : ?>
		<div class="social_network"></div>
		<div class="azzerafloat"></div>
	<?php endif; ?>	

	<script type="text/javascript">
		$(document).ready(function(){
			var loaderfb = "<img src=\"<?=_URLSITO?>/img/loader-fb.gif\" alt=\"Loading Facebook\">";
			$('.social_network').html(loaderfb);
			$.ajax({
				url: '<?=_URLSITO?>/html/ajax/social_network_static.php',
				data: { url_page: "<?=$url_page?>", lingua_query: "<?=$lingua_query?>" },
				type: "post",
				async: true,
				success: function(data) {
					$('.social_network').html(data);
				}
			});
		})
	</script>	
	
<?php endif ; ?>
