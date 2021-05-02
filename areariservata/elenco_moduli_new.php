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

<h3>Gestione moduli</h3>

<div class="evidenzia">
	<img src="./img/add.png" class="ico" /> <a href="area.php?pag=insert_moduli.php">Nuovo modulo</a>	
</div>

<div class="help-block">* Un modulo spostato verr&agrave; modificato quando il colore bianco diventa del colore di default.</div>

<link type="text/css" href="../utility/smoothness/jqueryui.css" rel="stylesheet" />
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/jqueryui.js"></script>

  
<style>
	.gestione-moduli ul { list-style-type: none; margin: 0; padding: 0; margin-bottom: 10px; }
	.gestione-moduli li { margin-bottom: 5px; padding: 5px; width: auto; }
	.gestione-moduli .ui-state-none { background: none; border: 0; height: 5px; padding: 0; margin: 0; }
	
	.gestione-moduli-left { float: left; width: 730px; }
	.gestione-moduli-right { float: right; width: 200px; }
	.modulo-centrale { float: left; width: 200px; margin-right: 10px; }
	.moduli-corpo { width: 300px; }
	.moduli-corpo li { width: 290px; }
	.moduli-destra { margin-right: 0; }
	.ui-icon { float: right; }
	
	#centrale h4 { font-weight: normal; text-align: center; }
</style>

<script>
	$(function() {
		$( ".sortable" ).sortable({
			revert: true,
			connectWith: ".sortable-active",
			cursor: 'move',			
			placeholder: 'ui-state-highlight',
			forcePlaceholderSize: true,
			dropOnEmpty: false,
			activate: function(event, ui){
				ui.item.css('width', '100px').css('height', '100px');
				ui.item.removeClass('ui-state-error').removeClass('ui-state-default').addClass('ui-state-highlight');
			}
		});
		
		$( ".gestione-moduli ul, .gestione-moduli li" ).disableSelection();

		$( "#sortable-testa" ).sortable({
			deactivate: function(event, ui){
				var ordina = $(this).sortable('toArray', {attribute: 'data-id'});
				$.ajax({
					url: "insert_moduli_query_new.php",
					type: 'post',
					data: { 
						id: ordina, 
						posizione: 'a'
					}
				}).done(function(){
					ui.item.not("#sortable-noactive li").removeClass('ui-state-highlight').removeClass('ui-state-error').addClass('ui-state-default');
				});
			}
		});
		
		$( "#sortable-sinistra" ).sortable({
			deactivate: function(event, ui){
				var ordina = $(this).sortable('toArray', {attribute: 'data-id'});
				$.ajax({
					url: "insert_moduli_query_new.php",
					type: 'post',
					data: { 
						id: ordina, 
						posizione: 's'
					}
				}).done(function(){
					ui.item.not("#sortable-noactive li").removeClass('ui-state-highlight').removeClass('ui-state-error').addClass('ui-state-default');
				});
			}			
		})
		
		$( "#sortable-corpo" ).sortable({
			deactivate: function(event, ui){
				var ordina = $(this).sortable('toArray', {attribute: 'data-id'});
				$.ajax({
					url: "insert_moduli_query_new.php",
					type: 'post',
					data: { 
						id: ordina, 
						posizione: 'c'
					}
				}).done(function(){
					ui.item.not("#sortable-noactive li").removeClass('ui-state-highlight').removeClass('ui-state-error').addClass('ui-state-default');
				});
			}
		})
		
		$( "#sortable-destra" ).sortable({
			deactivate: function(event, ui){
				var ordina = $(this).sortable('toArray', {attribute: 'data-id'});
				$.ajax({
					url: "insert_moduli_query_new.php",
					type: 'post',
					data: { 
						id: ordina, 
						posizione: 'd'
					}
				}).done(function(){
					ui.item.not("#sortable-noactive li").removeClass('ui-state-highlight').removeClass('ui-state-error').addClass('ui-state-default');
				});
			}	
		})
		
		$( "#sortable-piede" ).sortable({
			deactivate: function(event, ui){
				var ordina = $(this).sortable('toArray', {attribute: 'data-id'});
				$.ajax({
					url: "insert_moduli_query_new.php",
					type: 'post',
					data: { 
						id: ordina, 
						posizione: 'b'
					}
				}).done(function(){
					ui.item.not("#sortable-noactive li").removeClass('ui-state-highlight').removeClass('ui-state-error').addClass('ui-state-default');
				});
			}
		})
		
		$( "#sortable-noactive" ).sortable({
			deactivate: function(event, ui){
				var ordina = $(this).sortable('toArray', {attribute: 'data-id'});
				$.ajax({
					url: "insert_moduli_query_new.php",
					type: 'post',
					data: { 
						id: ordina, 
						posizione: '1'
					}
				}).done(function(){
					ui.item.not('.gestione-moduli-left li').removeClass('ui-state-highlight').removeClass('ui-state-default').addClass('ui-state-error');
				});
			}
		})
	});
</script>

<div class="contenitore gestione-moduli"> 
	 
	<div class="gestione-moduli-left">
		<div class="moduli-testa">
			<h4>Testa</h4>
			<ul class="sortable sortable-active" id="sortable-testa">
				<?php $sql = "SELECT ID, titolo, posizione, attivo, zona, ordine, titvideo FROM moduli WHERE posizione = 'a' AND attivo = 'si' ORDER BY posizione, ordine";
				$rssql = mysql_query($sql); 
				while( $r = mysql_fetch_row($rssql) ) : 
				$link_modifica_modulo = "area.php?pag=insert_moduli.php&amp;id=$r[0]"; ?>
				<li class="ui-state-default" data-id="<?=$r[0]?>">
					<a title="Modifica il Modulo" href="<?=$link_modifica_modulo?>">
						<span class="ui-icon ui-icon-pencil"></span>
					</a><?=$r[1]?>
				</li>			
				<?php endwhile; ?>
				<li class="ui-state-default ui-state-none"></li>
			</ul>
		</div>
		
		<div class="moduli-sinistra modulo-centrale">
			<h4>Sinistra</h4>
			<ul class="sortable sortable-active" id="sortable-sinistra">
				<?php $sql = "SELECT ID, titolo, posizione, attivo, zona, ordine, titvideo FROM moduli WHERE posizione = 's' AND attivo = 'si' ORDER BY posizione, ordine";
				$rssql = mysql_query($sql); 
				while( $r = mysql_fetch_row($rssql) ) : 
				$link_modifica_modulo = "area.php?pag=insert_moduli.php&amp;id=$r[0]"; ?>
				<li class="ui-state-default" data-id="<?=$r[0]?>">
					<a title="Modifica il Modulo" href="<?=$link_modifica_modulo?>">
						<span class="ui-icon ui-icon-pencil"></span>
					</a><?=$r[1]?>
				</li>
				<?php endwhile; ?>
				<li class="ui-state-default ui-state-none"></li>
			</ul>
		</div>
		<div class="moduli-corpo modulo-centrale">
			<h4>Corpo</h4>
			<ul class="sortable sortable-active" id="sortable-corpo">
				<?php $sql = "SELECT ID, titolo, posizione, attivo, zona, ordine, titvideo FROM moduli WHERE posizione = 'c' AND attivo = 'si' ORDER BY posizione, ordine";
				$rssql = mysql_query($sql); 
				while( $r = mysql_fetch_row($rssql) ) : 
				$link_modifica_modulo = "area.php?pag=insert_moduli.php&amp;id=$r[0]"; ?>
				<li class="ui-state-default" data-id="<?=$r[0]?>">
					<a title="Modifica il Modulo" href="<?=$link_modifica_modulo?>">
						<span class="ui-icon ui-icon-pencil"></span>
					</a><?=$r[1]?>
				</li>		
				<?php endwhile; ?>
				<li class="ui-state-default ui-state-none"></li>
			</ul>
		</div>	
		<div class="moduli-destra modulo-centrale">
			<h4>Destra</h4>
			<ul class="sortable sortable-active" id="sortable-destra">
				<?php $sql = "SELECT ID, titolo, posizione, attivo, zona, ordine, titvideo FROM moduli WHERE posizione = 'd' AND attivo = 'si' ORDER BY posizione, ordine";
				$rssql = mysql_query($sql); 
				while( $r = mysql_fetch_row($rssql) ) : 
				$link_modifica_modulo = "area.php?pag=insert_moduli.php&amp;id=$r[0]"; ?>
				<li class="ui-state-default" data-id="<?=$r[0]?>">
					<a title="Modifica il Modulo" href="<?=$link_modifica_modulo?>">
						<span class="ui-icon ui-icon-pencil"></span>
					</a><?=$r[1]?>
				</li>			
				<?php endwhile; ?>
				<li class="ui-state-default ui-state-none"></li>
			</ul>
		</div>

		<div class="azzerafloat"></div>
		
		<div class="moduli-piede">
			<h4>Piede</h4>
			<ul class="sortable sortable-active" id="sortable-piede">
				<?php $sql = "SELECT ID, titolo, posizione, attivo, zona, ordine, titvideo FROM moduli WHERE posizione = 'b' AND attivo = 'si' ORDER BY posizione, ordine";
				$rssql = mysql_query($sql); 
				while( $r = mysql_fetch_row($rssql) ) : 
				$link_modifica_modulo = "area.php?pag=insert_moduli.php&amp;id=$r[0]"; ?>
				<li class="ui-state-default" data-id="<?=$r[0]?>">
					<a title="Modifica il Modulo" href="<?=$link_modifica_modulo?>">
						<span class="ui-icon ui-icon-pencil"></span>
					</a><?=$r[1]?>
				</li>				
				<?php endwhile; ?>
				<li class="ui-state-default ui-state-none"></li>
			</ul>
		</div>		
	</div>
		
		
	<div class="gestione-moduli-right">
		<h4>Moduli non attivi</h4>
		<ul class="sortable sortable-active" id="sortable-noactive">
			<li class="ui-state-default ui-state-none"></li>
			<?php $sql = "SELECT ID, titolo, posizione, attivo, zona, ordine, titvideo FROM moduli WHERE attivo = 'no' ORDER BY titolo";
			$rssql = mysql_query($sql); 
			while( $r = mysql_fetch_row($rssql) ) : 
				$link_modifica_modulo = "area.php?pag=insert_moduli.php&amp;id=$r[0]"; ?>
				<li class="ui-state-error" data-id="<?=$r[0]?>">
					<a title="Modifica il Modulo" href="<?=$link_modifica_modulo?>">
						<span class="ui-icon ui-icon-pencil"></span>
					</a><?=$r[1]?>
				</li>				
			<?php endwhile; ?>
		</ul>
	</div>
	
	<div class="azzerafloat"></div>
	
</div>
