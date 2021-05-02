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

<div class="blocco blocco-newsletter">
	<h3><span><?=$titolo?></span></h3>
	<div class="modulo">
		<form target="newsletter" name="modify_newsletter" method="post" action="<?=_URLSITO?>/html/insert_newsletter_query.php" onsubmit="return ChkFrm1(this)">
			<input type="hidden" name="id" value="<?=$id?>" />
			<?php switch( $lingua_query ) : 
				case 'it': ?>	
					<p>
						<label>Iscriviti alla Newsletter, per ricevere le news dal sito:</label>
					</p>
					<p>
						<input type="text" class="textlato ctrl-textlato" placeholder="E-mail" name="mail" value="" />
					</p>
					<p>
						<input type="text" class="textlato ctrl-textlato" placeholder="Nome" name="nome" value="" />
					</p>
					<p>
						<select name="attivo">
							<option value="SI">Iscrizione</option>
							<option value="NO">Cancellazione</option>
						</select>
					</p>
					<p>
						<input type="checkbox" name="check_privacy" value="ok" /> 
						<a class="link_inline" href="javascript:Popup( '<?=_URLSITO?>/custom/privacy_newsletter.html' );">Nota informativa sulla privacy</a>
					</p>
					<p>
						<input type="submit" value="Conferma" class="bottomlato" />
					</p>
				<?php break; ?>
				<?php case 'en': ?>	
					<p>
						<label>Subscribe to our Newsletter to receive news from the site:</label>
					</p>
					<p>
						<input type="text" class="textlato ctrl-textlato" placeholder="E-mail" name="mail" value="" />
					</p>
					<p>
						<input type="text" class="textlato ctrl-textlato" placeholder="Name" name="nome" value="" />
					</p>
					<p>
						<select name="attivo">
							<option value="SI">Registration</option>
							<option value="NO">cancellation</option>
						</select>
					</p>
					<p>
						<input type="checkbox" name="check_privacy" value="ok" /> 
						<a class="link_inline" href="javascript:Popup( '<?=_URLSITO?>/custom/privacy_newsletter.html' );">The privacy policy</a>
					</p>
					<p>
						<input type="submit" value="Confirm" class="bottomlato" />
					</p>
				<?php break; ?>
				<?php case 'fr': ?>	
					<p>
						<label>Abonnez-vous &agrave; notre Newsletter pour recevoir des nouvelles sur le site:</label>
					</p>
					<p>
						<input type="text" class="textlato ctrl-textlato" placeholder="E-mail" name="mail" value="" />
					</p>
					<p>
						<input type="text" class="textlato ctrl-textlato" placeholder="Nom" name="nome" value="" />
					</p>
					<p>
						<select name="attivo">
							<option value="SI">Inscription</option>
							<option value="NO">Annulation</option>
						</select>
					</p>
					<p>
						<input type="checkbox" name="check_privacy" value="ok" /> 
						<a class="link_inline" href="javascript:Popup( '<?=_URLSITO?>/custom/privacy_newsletter.html' );">Politique de confidentialit&eacute;</a>
					</p>
					<p>
						<input type="submit" value="Valider" class="bottomlato" />
					</p>
				<?php break; ?>
				<?php case 'de': ?>	
					<p>
						<label>Abonnieren Sie unseren Newsletter, um Nachrichten von der Website erhalten:</label>
					</p>
					<p>
						<input type="text" class="textlato ctrl-textlato" placeholder="E-mail" name="mail" value="" />
					</p>
					<p>
						<input type="text" class="textlato ctrl-textlato" placeholder="Name" name="nome" value="" />
					</p>
					<p>
						<select name="attivo">
							<option value="SI">Einschreibung</option>
							<option value="NO">Stornierung</option>
						</select>
					</p>
					<p>
						<input type="checkbox" name="check_privacy" value="ok" /> 
						<a class="link_inline" href="javascript:Popup( '<?=_URLSITO?>/custom/privacy_newsletter.html' );">die Privacy Policy</a>
					</p>
					<p>
						<input type="submit" value="Best&auml;tigung" class="bottomlato" />
					</p>
				<?php break; ?>
				<?php case 'es': ?>	
					<p>
						<label>Suscríbete a nuestro newsletter para recibir noticias del sitio:</label>
					</p>
					<p>
						<input type="text" class="textlato ctrl-textlato" placeholder="E-mail" name="mail" value="" />
					</p>
					<p>
						<input type="text" class="textlato ctrl-textlato" placeholder="Nombre" name="nome" value="" />
					</p>
					<p>
						<select name="attivo">
							<option value="SI">Inscripci&oacute;n</option>
							<option value="NO">Cancelaci&oacute;n</option>
						</select>
					</p>
					<p>
						<input type="checkbox" name="check_privacy" value="ok" /> 
						<a class="link_inline" href="javascript:Popup( '<?=_URLSITO?>/custom/privacy_newsletter.html' );">La pol&iacute;tica de privacidad</a>
					</p>
					<p>
						<input type="submit" value="Confirmaci&oacute;n" class="bottomlato" />
					</p>
				<?php break; ?>
				<?php case 'pt': ?>	
					<p>
						<label>Assine a nossa newsletter para receber as novidades do site:</label>
					</p>
					<p>
						<input type="text" class="textlato ctrl-textlato" placeholder="E-mail" name="mail" value="" />
					</p>
					<p>
						<input type="text" class="textlato ctrl-textlato" placeholder="Nome" name="nome" value="" />
					</p>
					<p>
						<select name="attivo">
							<option value="SI">Inscri&ccedil;&atilde;o</option>
							<option value="NO">Cancelamento</option>
						</select>
					</p>
					<p>
						<input type="checkbox" name="check_privacy" value="ok" /> 
						<a class="link_inline" href="javascript:Popup( '<?=_URLSITO?>/custom/privacy_newsletter.html' );">A pol&iacute;tica de privacidade</a>
					</p>
					<p>
						<input type="submit" value="Confirma&ccedil;&atilde;o" class="bottomlato" />
					</p>
				<?php break; ?>				
			<?php endswitch; ?>
		</form>
		<iframe src="#" name="newsletter" style="display:none"></iframe>
	</div>
	
	<? /* controllo del form mail */ ?>

	<script type="text/javascript"><!--
	function ChkFrm1( oForm )
	{
		var sAlert1 = "Indirizzo e-mail non valido per il campo";
		var sAlert2 = "Inserire un nome valido";
		var sAlert3 = "Prendere visione della nota informativa sulla privacy";
		
		if ( ctrl_mail_statico( oForm.mail.value ) ) { // Se l'errore viene trovato...
			oForm.mail.focus();
			alert( sAlert1 );
			return false;
		}
		
		if ( Trim( oForm.nome.value ) == '' ) { 
			oForm.nome.focus();
			alert( sAlert2 );
			return false;
		}

		if ( !oForm.check_privacy.checked ) { 
			alert( sAlert3 );
			return false;
		}
		
		return true;
	}


	//--></script>	
</div>
