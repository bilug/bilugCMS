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
	$d = (int)$_GET['d']; 
	$sql = "SELECT cartella FROM galleria WHERE id = $d LIMIT 1";
	$rssql = mysql_query( $sql );

	$sql = "SELECT id, cartella FROM galleria WHERE id_padre = $d";
	$risultato = mysql_query( $sql );
	
	$max = mysql_num_rows( $risultato );
?>


<?php if ( $max > 0 ) : 
	$cartella = ucwords( mysql_result( $rssql, 0, 0 ) ); 
	?>
	<h1><span><?=galleria_visualizza($cartella)?></span></h1>	
	<ul class="argo">
	<?php while ( $control = mysql_fetch_row($risultato) ) : 
		$link = rurl( $control[0], 'gals-sub' );	?>		
		<li>
			<h2 class="elenco"><a class="elenco" href="<?=$link?>"><?=galleria_visualizza($control[1])?></a></h2>
			<div class="elencoimg"><a href="<?=$link?>"><img width="30" height="30" alt="" src="<?=_URLSITO?>/img/water.png"></a></div>
			<div class="azzerafloat"></div>
		</li>
	<?php endwhile; ?>
	</ul>
<?php else : ?>
	<h1><span>Nessuna galleria disponibile</span></h1>
<?php endif; ?>	
