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

include_once("include_ajax.php");

$lingua_query = $_POST['lingua_query'];

if ( _SOCIAL_SITO_SIZE != 2 ) {
	$box_FB = "button_count";
	$box_GP = "medium";
	$box_TW = "horizontal";
}
else {
	$box_FB = "box_count";
	$box_GP = "tall";
	$box_TW = "vertical";
}

$url_page = _URLSITO;

?>

<ul>

	<?php if ( _SOCIAL_SITO_FB ) {?>
		<li class="fb_ico">
			<div class="fb-like" data-href="<?=$url_page?>" data-send="false" data-layout="<?=$box_FB?>" data-width="450" data-show-faces="false" data-action="recommend"></div>
		</li>
	<?php } ?>

	<?php if ( _SOCIAL_SITO_TW ) {?>
		<li class="twitter_ico">
			<a href="https://twitter.com/share" class="twitter-share-button" data-count="<?=$box_TW?>" data-url="<?=$url_page?>" data-lang="<?=$lingua_query?>"></a>
			<script type="text/javascript">	
				//codice per plugin Twetter
				!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");
			</script>
		</li>
	<?php } ?>

	<?php if ( _SOCIAL_SITO_GP ) {?>
		<li class="googlePlus_ico">			
			<script type="text/javascript">gapi.plusone.go();</script>
			<div class="divgoogle" ><div class="g-plusone" data-href="<?=$url_page?>" data-size="<?=$box_GP?>"></div></div>
		</li>
	<?php } ?>

</ul>