<div class="adm-menu">
	<ul>
		<li><a target="_blank" href="<?=_URLSITO?>/bilugcms-admin/">Area riservata</a></li>
		<li><a id="adm-disattiva-modifiche" href="#">Disattiva modifiche moduli</a></li>
	</ul>
	
	<div class="adm-chiudi"><a href="#">-</a></div>
	
	<script>
		$('#adm-disattiva-modifiche').click(function(){
			var titoli = $('.adm-laterale');
			if ( titoli.css('display') != 'none' ) {
				titoli.css('display', 'none');
				$(this).html('Attiva modifiche moduli');
				$('.adm-blocco').addClass('adm-blocco-no').removeClass('adm-blocco');
			}
			else {
				titoli.css('display', 'block');
				$(this).html('Disattiva modifiche moduli');
				$('.adm-blocco-no').addClass('adm-blocco').removeClass('adm-blocco-no');
			}
		});
		
		$('.adm-chiudi a').click(function(){ 
			if ( $(this).html() == '-' ) {
				$('.adm-menu').animate({width: '55px'}, 500);
				$('.adm-menu ul').hide('fast');
				$(this).html('+');
			}
			else {
				$('.adm-menu').animate({width: '100%'}, 500);
				$('.adm-menu ul').show('fast');			
				$(this).html('-');
			}
		});
	</script>
</div>
