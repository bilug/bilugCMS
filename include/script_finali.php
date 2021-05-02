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

<?php if ( ( _SOCIAL_STATICHE_FB OR _SOCIAL_STATICHE_GP OR _SOCIAL_STATICHE_TW ) OR 
			( _SOCIAL_DINAMICHE_FB OR _SOCIAL_DINAMICHE_GP OR _SOCIAL_DINAMICHE_TW ) OR 
			( _SOCIAL_SITO_FB OR _SOCIAL_SITO_GP OR _SOCIAL_SITO_TW ) OR 
			( _SOCIAL_GALS_FB OR _SOCIAL_GALS_GP OR _SOCIAL_GALS_TW ) 
		) : ?>

	<?php if ( _SOCIAL_STATICHE_FB OR _SOCIAL_DINAMICHE_FB OR _SOCIAL_SITO_FB OR _SOCIAL_GALS_FB ) : ?>	
		<script type="text/javascript">
			// Plugin di facebook
			(function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s); js.id = id;
			js.src = "//connect.facebook.net/it_IT/all.js#xfbml=1";
			fjs.parentNode.insertBefore(js, fjs);}
			(document, 'script', 'facebook-jssdk'));
		</script>
	<?php endif; ?>

	<?php if ( _SOCIAL_STATICHE_GP OR _SOCIAL_DINAMICHE_GP OR _SOCIAL_SITO_GP OR _SOCIAL_GALS_GP ) : ?>
		<script type="text/javascript" src="https://apis.google.com/js/plusone.js">
		  {lang: 'it', parsetags: 'explicit'}
		</script>
	<?php endif; ?>
	
<?php endif; ?>
