<?php $max_link_sitemap = 15 ?>

<div class="blocco blocco-sitemap">
	<h3><span><?=$titolo?></span></h3>
	<div class="modulo">
	<?php
		// Pagine statiche
		$sql = "SELECT ID, titolo FROM statiche ORDER BY ordine LIMIT $max_link_sitemap";
		$rssql = mysql_query( $sql );
		if ( mysql_num_rows( $rssql ) > 0 )	{
			echo "<div class=\"modulo-princ-sitemap\">";
				echo "<div class=\"modulo-sitemap modulo-first\">";
					echo "<h3><span>Pagine principali</span></h3>";
					echo "<ul class=\"modulo-sitemap-content\">";
						while( $r = mysql_fetch_row( $rssql ) ) {
							$link = rurl( $r[0], 'static' );
							echo "<li><h4><a href=\"$link\">$r[1]</a></h4></li>";
						}		
					echo "</ul>";
				echo "</div>";
			echo "</div>";
		}
		
		
		// Pagine dinamiche
		$sql = "SELECT ID, titolo FROM notizie WHERE autorizza = 'si' ORDER BY ID DESC LIMIT $max_link_sitemap";
		$rssql = mysql_query( $sql );
		if ( mysql_num_rows( $rssql ) > 0 )	{
			echo "<div class=\"modulo-princ-sitemap\">";
				echo "<div class=\"modulo-sitemap\">";
					echo "<h3><span>News</span></h3>";
					echo "<ul class=\"modulo-sitemap-content\">";
						while( $r = mysql_fetch_row( $rssql ) ) {
							$link = rurl( $r[0], 'news' );
							echo "<li><h4><a href=\"$link\">$r[1]</a></h4></li>";
						}		
					echo "</ul>";
				echo "</div>";
			echo "</div>";
		}
		
		
		// Gallerie
		$path_dir = "../gals/";
		$v_img = Array();
		
		if ( is_dir( $path_dir ) ) {
			$v_img = recupera_dir_img( $path_dir, $v_img );
			if ( count( $v_img ) > 0 ) {
				echo "<div class=\"modulo-princ-sitemap\">";
					echo "<div class=\"modulo-sitemap\">";
						echo "<h3><span>Gallerie</span></h3>";
						echo "<ul class=\"modulo-sitemap-content\">";
							$cont = 0;
							foreach( $v_img as $value ) {
								$value = substr( $value, 0, strlen( $value ) - 1 );
								$path_sotto_dir = explode( '/', $value );					
								$argo = str_replace( "_", " ", $path_sotto_dir[2] );
								$gal = str_replace( "_", " ", substr( $path_sotto_dir[3], strpos( $path_sotto_dir[3], "_" ) + 1 ) );
								
								//$link = "index.php?pag=galleria.php&amp;d=$path_sotto_dir[3]&amp;argo=$path_sotto_dir[2]";
								$link = _URLSITO."/html/subgals-$path_sotto_dir[3]-$path_sotto_dir[2].html";
								echo "<li><h4><a href=\"$link\">$argo &raquo; $gal</a></h4></li>";
								
								$cont++;
								if ( $cont == $max_link_sitemap )
									break;
							}
						echo "</ul>";
					echo "</div>";
				echo "</div>";
			}
		}

		// Eventi e appuntamenti
		$sql = "SELECT ID, DATE_FORMAT( dataora, '%Y-%m-%d' ), titolo FROM eventi ORDER BY dataora DESC LIMIT $max_link_sitemap";
		$rssql = mysql_query( $sql );
		if ( mysql_num_rows( $rssql ) > 0 )	{
			echo "<div class=\"modulo-princ-sitemap\">";
				echo "<div class=\"modulo-sitemap\">";
					echo "<h3><span>Eventi</span></h3>";
					echo "<ul class=\"modulo-sitemap-content\">";
						while( $r = mysql_fetch_row( $rssql ) ) {
							$mese_app = substr( $r[1], 5, 2 );
							$link = _URLSITO."/html/eventi_appuntamenti-".rurl( $r[0] )."mese$mese_app.html";
							echo "<li><h4><a href=\"$link\">$r[2]</a></h4></li>";
						}		
					echo "</ul>";
				echo "</div>";
			echo "</div>";
		}
		
		
		// Info generali
		if ( trim( _INFO_SITEMAP ) != '' ) {
			echo "<div class=\"modulo-princ-sitemap\">";
				echo "<div class=\"modulo-sitemap modulo-last\">";
					echo "<h3><span>Info</span></h3>";
					echo "<div class=\"modulo-sitemap-content\">";				
						echo "<div>" . _INFO_SITEMAP . "</div>";
					echo "</div>";
				echo "</div>";
			echo "</div>";
		}
	?>
	
	<div class="azzerafloat"></div>
	</div>
</div>
