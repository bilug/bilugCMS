<script type="text/javascript">
var headline_interval;

$(document).ready(function() {
	caricabody();
	headline_interval = setInterval(caricabody,15000);				
});
function caricabody(){
	$("#resultsbody").hide();
	$("#loadingbody").show();
	$("#resultsbody").load("<?=_URLSITO?>/utility/randomimghome.php",function(){
		$("#resultsbody a").fancyzoom({Speed:1000,showoverlay:true,overlay:7/10});
		$("#resultsbody a[@title]").cluetip({splitTitle: '|', dropShadow: true,cluetipClass: 'sito',arrows: true, showTitle: false});
		$("#loadingbody").hide();
		$("#resultsbody").fadeIn("slow");
	});		
}
</script>
<div class="blocco">
<div class="random">
	<div id="resultsbody">
		<?include("utility/randomimghome.php");?>				
	</div>
	<span id="loadingbody" style="display:none">
		<img src="<?=_URLSITO?>/img/loading.gif" width="32" height="32" alt="" />
	</span>
</div>
</div>