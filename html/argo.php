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

<?php if ( isset($_GET["argo"]) AND (int)$_GET["argo"] > 0 ) : ?>
   <?php
   $argo = $pag = (int)$_GET["argo"];
   $ind = (isset($_GET["ind"])) ? (int)$_GET["ind"] : 0;

   $str2 = "
		SELECT a.argomenti 
		FROM argomenti AS a 
		INNER JOIN lingue AS l ON l.id = a.id_lingua 
		WHERE a.ID = $argo AND l.id = $id_lingua 
		LIMIT 1 
   ";
   $risultato2 = mysql_query($str2);
   $control2 = mysql_fetch_row($risultato2);

   // query per sapere l'argomento
   $page = _MAX_ARG;
   $max = mysql_num_rows( $risultato2 );

   if ( $max > 0 ) :
   	if (isset($ind)) $index=$ind;
   	if ($index<0 or !isset($index)) $index=0;
   	if ( ($index % $page ) != 0 ) $index = 0;

   	$str = "SELECT ID, titolo FROM notizie WHERE argomento = $argo AND autorizza='si'";
   	$risultato = mysql_query($str);
   	$max = intval( ( mysql_num_rows( $risultato ) - 1 ) / $page ) + 1;
   	
   	Nav($argo,$max,$index,$page);
   	
   	$str .= " ORDER BY data DESC LIMIT $index, $page";
   	$risultato = mysql_query($str);

   	?>
	
	<?php breadcrumbs( array(
		'Home' => _URLSITO,
		'Argomenti' => _URLSITO.'/argo/',
		$control2[0] => ''
	) ); ?>
	
	<h1><span><?=$control2[0]?></span></h1>
	
   	<ul class="argo">
   	<?php while ( $control = mysql_fetch_row($risultato) ) : 
   		$link = rurl( $control[0], 'news' );	?>		
   		<li>
   			<h3 class="elenco"><a href="<?=$link?>"><?=$control[1]?></a></h3>
   			<div class="elencoimg"><a href="<?=$link?>"><img width="30" height="30" alt="" src="<?=_URLSITO?>/img/water.png"></a></div>
   			<div class="azzerafloat"></div>
   		</li>
   	<?php endwhile; ?>
   	</ul>
   	
   	<?php
   	Nav($argo,$max,$index,$page);
   else : ?>
   	<h1><span>Nessun argomento disponibile</span></h1>
   <?php endif; ?>
<?php else : ?>
   <?php 
	$str = "
      	SELECT a.id, a.argomenti, a.menu_arg 
      	FROM argomenti AS a 
      	INNER JOIN lingue AS l ON l.id = a.id_lingua 
      	WHERE l.id = $id_lingua 
      	ORDER BY a.menu_arg, a.argomenti 
	";
	$risultato = mysql_query($str); ?>

	<?php breadcrumbs( array(
		'Home' => _URLSITO,
		'Argomenti' => ''
	) ); ?>	  
	  
   	<h1><span>Argomenti <?=_SITO?></span></h1>
   	
   	<?php $categoria = '';
   	while ( $control = mysql_fetch_row($risultato) ) : 
   	   $l = ( $lingua_query == 'it' ) ? '' : '_'.$lingua_query;
   	   $str2 = "SELECT titvideo$l FROM moduli WHERE modulo = 'index_arg$control[2].php' LIMIT 1";
   		$risultato2 = mysql_query($str2);
   		$h2_tit = mysql_result($risultato2, 0, 0);
   		$link = rurl( $control[0], 'argo' );
   		if ( $categoria == '' ) { ?>
   		    <h2><?=$h2_tit?></h2>
   		    <ul><?php 
   		    $categoria = $control[2]; 
   		}
   	   if ( $categoria != $control[2] ) { ?>
            </ul>
            <h2><?=$h2_tit?></h2>
            <ul><?php 
            $categoria = $control[2]; 
         } ?>
   		<li><h3><a href="<?=$link?>"><?=$control[1]?></a></h3></li>
   	<?php endwhile; ?>
   	</ul>
<?php endif; ?>






<?php

//funzione navigatore
function Nav($argo,$max,$pos,$pag)
{
	echo "<div class=\"navigazione\">";
	
	echo ( $max != 0 ) ? 
	 "<div class=\"numero-articoli\">Pagine Notizie: ".(($pos/$pag)+1)." di $max </div>" : 
	 "<div class=\"numero-articoli\">Nessuna notizia presente</div>";
	
	if ( $pos > 0 OR $max > ( ($pos/$pag)+1 ) ) {
		$link = rurl( $argo, 'argo' );
		
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



