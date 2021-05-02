<div class="blocco blocco-imgrandom">
	<h3><span><?=$titolo?></span></h3>
	<div class="modulo">
		<script type="text/javascript" src="<?=_URLSITO?>/js/jquery.cycle-min.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				/* consultare il sito http://malsup.com/jquery/cycle/ */
				$('#imgrandom').cycle({
					fx: 'shuffle',
					easing: 'easeOutBack',
					delay:  3000,
					sync:  false
				});
			});
		</script>
		<div id="imgrandom">
			<?php
				$sql = "
					SELECT CONCAT('"._URLSITO."/gals/', g3.cartella, '/', g2.cartella, '/', g1.immagine), g1.descrizione 
					FROM galleria g1 
					INNER JOIN galleria g2 ON g1.id_padre = g2.id 
					INNER JOIN galleria g3 ON g2.id_padre = g3.id 
					WHERE g1.immagine != '' 
					ORDER BY RAND() 
					LIMIT 10
				";
				$rssql = mysql_query($sql);
				while( $r = mysql_fetch_row($rssql) ) : 
					$link_img = _URLSITO . "/utility/thump.php?w=".(_MAX_LARG_FOTO-10)."&amp;h=".(_MAX_LARG_FOTO-10)."&amp;file=".$r[0]; ?>
					<a class="lightbox" href="<?=$r[0]?>"><img src="<?=$link_img?>" width="0" height="0" alt="<?=$r[1]?>"></a>
				<?php endwhile;
			?>		
		</div>
	</div>
</div>
