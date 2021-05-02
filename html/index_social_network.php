<div class="blocco blocco_plugins_social">
	<h3><span><?=$titolo?></span></h3>
	<div class="modulo">
		<?php if ( _SOCIAL_SITO_FB OR _SOCIAL_SITO_GP OR _SOCIAL_SITO_TW ) : ?>
			<div class="social_network_modulo"></div>
			<div class="azzerafloat"></div>
		<?php endif; ?>

		<script type="text/javascript">
			$(document).ready(function(){
				var loaderfb = "<img src=\"<?=_URLSITO?>/img/loader-fb.gif\" alt=\"Loading Facebook\">";
				$('.social_network_modulo').html(loaderfb);
				$.ajax({
					url: '<?=_URLSITO?>/html/ajax/social_network_modulo.php',
					data: { url_page: "<?=$url_page?>", lingua_query: "<?=$lingua_query?>" },
					type: "post",
					async: true,
					success: function(data) {
						$('.social_network_modulo').html(data);
					}
				});
			})
		</script>			
	</div>
</div>
