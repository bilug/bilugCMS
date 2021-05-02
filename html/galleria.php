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

$argo = (int)$_GET['argo'];
$d = (int)$_GET['d'];

$ind = (isset($_GET["ind"])) ? (int)mysql_real_escape_string( $_GET["ind"] ) : 0;

if (!isset($argo)) $argo = apici( $_POST['argo'] );
if (!isset($d)) $d = apici( $_POST['d'] );
if (!isset($argo)) $argo = _DEFARGGAL;
if (!isset($d)) $d = _DEFGAL;


$url_page = rurl( $argo, 'gals-sub' );

$sql = "SELECT cartella FROM galleria WHERE id = $d LIMIT 1";
$rssql = mysql_query( $sql );
$titolo = mysql_result( $rssql, 0, 0 );

$sql = "SELECT cartella FROM galleria WHERE id = $argo LIMIT 1";
$rssql = mysql_query( $sql );
$titolo2 = mysql_result( $rssql, 0, 0 );

//Variabili
$directory = _URLSITO."/gals/".$titolo."/".$titolo2."/";

$filtro = array("image/jpg","image/jpeg","image/gif","image/png");
$spazio = _MAX_SPAZIO;
$col = floor($spazio/_MAX_LARG_FOTO);
$page = _MAX_FOTO;
$max = 0;





$sql = "SELECT id, immagine, descrizione FROM galleria WHERE id_padre = $argo";
$rssql = mysql_query( $sql );

$max = mysql_num_rows( $rssql );

?>


<h1><span><?=galleria_visualizza($titolo)?> &gt;&gt; <?=galleria_visualizza($titolo2)?></span></h1>	

<?php
if ( $max > 0 ) :
	// div per i social network
	if ( _SOCIAL_GALS_POSITION == 1 AND ( _SOCIAL_GALS_FB OR _SOCIAL_GALS_GP OR _SOCIAL_GALS_TW ) ) : ?>
		<div class="social_network"></div>
		<div class="azzerafloat"></div>
	<?php endif;

	if (isset($ind)) $index=$ind;
	if ($index<0 or !isset($index)) $index=0;
	if ( ($index % $page ) != 0 ) $index = 0;		
		
	$max = intval( ( mysql_num_rows( $rssql ) - 1 ) / $page ) + 1;
	
	Nav($argo,$max,$index,$page);
	
	$sql .= " ORDER BY id DESC LIMIT $index, $page";
	$rssql = mysql_query( $sql );
	?>
	<ul class="lightbox-gallery galleria">
	<?php while( $r = mysql_fetch_row( $rssql ) ) : 
		$link = $directory . $r[1];
		$link_img = _URLSITO . "/utility/thump.php?w=".(_MAX_LARG_FOTO-10)."&amp;h=".(_MAX_LARG_FOTO-10)."&amp;file=".$link;
		$alt = ( $r[2] != '' ) ? $r[2] : '';
		?>
		<li><div>
			<div class="gal-img">
				<a href="<?=$link?>"><img src="<?=$link_img?>" alt="<?=$alt?>" width="" height="" /></a>
			</div>
			<div class="gal-nome"><?=$r[2]?></div>				
		</div></li>		
	<?php endwhile; ?>
	</ul>
	<div class="azzerafloat"></div>
	<?php
	Nav($argo,$max,$index,$page);
	
	// div per i social network
	if ( _SOCIAL_GALS_POSITION == 2 AND ( _SOCIAL_GALS_FB OR _SOCIAL_GALS_GP OR _SOCIAL_GALS_TW ) ) : ?>
		<div class="social_network"></div>
		<div class="azzerafloat"></div>
	<?php endif; ?>	

	<script type="text/javascript">
		$(document).ready(function(){
			var loaderfb = "<img src=\"<?=_URLSITO?>/img/loader-fb.gif\" alt=\"Loading Facebook\">";
			$('.social_network').html(loaderfb);
			$.ajax({
				url: '<?=_URLSITO?>/html/ajax/social_network_gals.php',
				data: { url_page: "<?=$url_page?>", lingua_query: "<?=$lingua_query?>" },
				type: "post",
				async: true,
				success: function(data) {
					$('.social_network').html(data);
				}
			});
		})
	</script>		
	
<?php else : ?>
	<h1>Nessuna Immagine in questa Galleria</h1>
<?php endif; ?>



<?php

//funzione navigatore
function Nav($argo,$max,$pos,$pag)
{
	echo "<div class=\"navigazione\">";
	
	echo ( $max != 0 ) ? 
	 "<div class=\"numero-articoli\">Galleria: ".(($pos/$pag)+1)." di $max </div>" : 
	 "<div class=\"numero-articoli\">Nessuna galleria presente</div>";
	
	if ( $pos > 0 OR $max > ( ($pos/$pag)+1 ) ) {
		$link = rurl( $argo, 'gals-sub' );
		
		echo "<div class=\"numero-pagina\">";
			if ( $pos > 0 ) {
				echo "<div class=\"precedente\">";
					$link1 = $link . "indice-0/";
					echo "<a href=\"$link1\">&lt;&lt; Inizio</a> ";
					$link2 = $link . "indice-".($pos-$pag)."/";
					echo "<a href=\"$link2\">&lt; Precedente</a> ";
				echo "</div>";
			}
			if ( $max > ($pos/$pag)+1 ) {
				echo "<div class=\"successivo\">";
					$link1 = $link . "indice-".($pos+$pag)."/";
					echo "<a href=\"$link1\">Successivo &gt;</a>";
					$link2 = $link . "indice-".(($max*$pag)-$pag)."/";
					echo "<a href=\"$link2\">Fine &gt;&gt;</a>";
				echo "</div>";
			}
			echo "<div class=\"azzerafloat\"></div>";
		echo "</div>";
	}
	echo "</div>";

}


?>
