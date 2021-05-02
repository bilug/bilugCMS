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
<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="it">
<?php include_once( "utility/headers.php" ); ?>
<head>
<?php
	include_once("include/title.php");
	include_once("include/head.html");
	include_once("include/head.php");
	include_once("custom/google_analytics.php");	
?>
</head>

<body onload="initialize();">

<?php include_once( "include/fb_instance.php" ); ?>


<?php

/****** VARIABILI PER MULTILINGUE ******/

if ( _LINGUADEFAULT != '' )
	$lingua = mysql_real_escape_string( _LINGUADEFAULT );
else
	$lingua = 'IT';

if ( isset( $_SESSION['lingua'] ) ) $lingua = $_SESSION['lingua'];	
	
$lingua_query = strtolower( $lingua );

$sql = "SELECT id FROM lingue WHERE sigla = '$lingua_query' LIMIT 1";
$rssql = mysql_query( $sql );
if ( mysql_num_rows( $rssql ) == 0 ) {
	$lingua = _LINGUADEFAULT;
	$lingua_query = strtolower( $lingua );
	$id_lingua = 1;
}
else {
	$id_lingua = mysql_result( $rssql, 0, 0 );
}

$lingua = strtoupper( $lingua );

switch( $lingua_query ) {
	case 'it': $titvideo = "titvideo"; $home_statica = _STATICADB_IT; $ecommerce_statica = _ECOMMERCEDB_IT; break;
	case 'en': $titvideo = "titvideo_en"; $home_statica = _STATICADB_EN; $ecommerce_statica = _ECOMMERCEDB_EN; break;
	case 'de': $titvideo = "titvideo_de"; $home_statica = _STATICADB_DE; $ecommerce_statica = _ECOMMERCEDB_DE; break;
	case 'es': $titvideo = "titvideo_es"; $home_statica = _STATICADB_ES; $ecommerce_statica = _ECOMMERCEDB_ES; break;
	case 'pt': $titvideo = "titvideo_pt"; $home_statica = _STATICADB_PT; $ecommerce_statica = _ECOMMERCEDB_PT; break;
	case 'fr': $titvideo = "titvideo_fr"; $home_statica = _STATICADB_FR; $ecommerce_statica = _ECOMMERCEDB_FR; break;
	
	default: $titvideo = "titvideo"; $home_statica = _STATICADB_IT; $ecommerce_statica = _ECOMMERCEDB_IT; break;
}

/***************************************/




//recupero Variabili Globali;
$pag = (isset($_GET["pag"])) ? apici($_GET["pag"]) : '';
require_once("utility/secureform.php");
$pag = form_sicuro($pag,"","256"); //controllo delle var

?>

<?php if ( isset( $_SESSION["tux"] ) ) include_once("include/adm_menu.php"); ?>

<div class="content">
	<div class="contenuto">
		
		<header><div class="testa">
			<?php
					$stringamoduli="SELECT modulo, $titvideo, id, titolo FROM moduli WHERE posizione='a' AND attivo='si' AND zona='t' ORDER BY ordine";  	
					$modulo=mysql_query($stringamoduli);
					if (mysql_num_rows($modulo)>0) {
						while($inserire=mysql_fetch_row($modulo)) { ?>
							<?php if ( isset( $_SESSION["tux"] ) ) : ?>
								<div class="adm-blocco">
									<p class="adm-laterale">
										<span><?=$inserire[3]?></span>
										<?=adm_link('modulo', $inserire[2])?>
									</p>
							<?php endif;
							
							$titolo = $inserire[1];
							include (_PATH_PAGINE.$inserire[0]); 

							if ( isset( $_SESSION["tux"] ) ) : ?>
								</div>
							<?php endif;
						}
					}             
			?>	
			<div class="azzerafloat"></div>
		</div></header>
		
		<div class="centrale">		
			
			<div class="laterale sinistra">
				<div class="content-interno">
				<?php
					$stringamoduli="SELECT modulo, $titvideo, id, titolo FROM moduli WHERE posizione='s' AND attivo='si' AND zona='t' ORDER BY ordine";  	
					$modulo=mysql_query($stringamoduli);
					if (mysql_num_rows($modulo)>0) {
						while($inserire=mysql_fetch_row($modulo)) { ?>
							<?php if ( isset( $_SESSION["tux"] ) ) : ?>
								<div class="adm-blocco">
									<p class="adm-laterale">
										<span><?=$inserire[3]?></span>
										<?=adm_link('modulo', $inserire[2])?>
									</p>
							<?php endif;
							
							$titolo = $inserire[1];
							include (_PATH_PAGINE.$inserire[0]); 

							if ( isset( $_SESSION["tux"] ) ) : ?>
								</div>
							<?php endif;
						}
					}              
				?>
				</div>
			</div>

			<div class="corpo">
				<div class="content-interno">
				<?php
					$stringamoduli="SELECT modulo, $titvideo, id, titolo FROM moduli WHERE posizione='c' AND attivo='si' AND zona='t' ORDER BY ordine";  	
					$modulo=mysql_query($stringamoduli);
					if (mysql_num_rows($modulo)>0) {
						while($inserire=mysql_fetch_row($modulo)) { ?>
							<?php if ( isset( $_SESSION["tux"] ) ) : ?>
								<div class="adm-blocco">
									<p class="adm-laterale">
										<span><?=$inserire[3]?></span>
										<?=adm_link('modulo', $inserire[2])?>
									</p>
							<?php endif;
							
							$titolo = $inserire[1];
							include (_PATH_PAGINE.$inserire[0]); 

							if ( isset( $_SESSION["tux"] ) ) : ?>
								</div>
							<?php endif;
						}
					}              
				?>
				</div>		
			</div>
			
			<div class="laterale destra">		
				<div class="content-interno">
				<?php
					$stringamoduli="SELECT modulo, $titvideo, id, titolo FROM moduli WHERE posizione='d' AND attivo='si' AND zona='t' ORDER BY ordine";  	
					$modulo=mysql_query($stringamoduli);
					if (mysql_num_rows($modulo)>0) {
						while($inserire=mysql_fetch_row($modulo)) { ?>
							<?php if ( isset( $_SESSION["tux"] ) ) : ?>
								<div class="adm-blocco">
									<p class="adm-laterale">
										<span><?=$inserire[3]?></span>
										<?=adm_link('modulo', $inserire[2])?>
									</p>
							<?php endif;
							
							$titolo = $inserire[1];
							include (_PATH_PAGINE.$inserire[0]); 

							if ( isset( $_SESSION["tux"] ) ) : ?>
								</div>
							<?php endif;
						}
					}           
				?>
				</div>
			</div>
			
			<div class="azzerafloat"></div>
		</div>
		
		<footer><div class="piede">
		<?php
			$stringamoduli="SELECT modulo, $titvideo, id, titolo FROM moduli WHERE posizione='b' AND attivo='si' AND zona='t' ORDER BY ordine";  	
			$modulo=mysql_query($stringamoduli);
			if (mysql_num_rows($modulo)>0) {
				while($inserire=mysql_fetch_row($modulo)) { ?>
					<?php if ( isset( $_SESSION["tux"] ) ) : ?>
						<div class="adm-blocco">
							<p class="adm-laterale">
								<span><?=$inserire[3]?></span>
								<?=adm_link('modulo', $inserire[2])?>
							</p>
					<?php endif;
					
					$titolo = $inserire[1];
					include (_PATH_PAGINE.$inserire[0]); 

					if ( isset( $_SESSION["tux"] ) ) : ?>
						</div>
					<?php endif;
				}
			}             
		?>
		</div></footer>
	</div>
</div>

<?php if ( _ACCESSIBILITA != 4 ) include_once("include/script.html"); ?>
<?php if ( _ACCESSIBILITA != 4 ) include_once("include/script_finali.php"); ?>

</body>
</html>
