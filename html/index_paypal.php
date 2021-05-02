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
<div class="blocco blocco-pagamenti-paypal">
	
	<h3><span><?=$titolo?></span></h3>
	
	<div class="modulo">
		<div class="pagamenti"><p>
			<?php $link = rurl( 0, 'paypal' ); ?>
			<a class="skimg" href="<?=$link?>">
				<p><img src="<?=_URLSITO?>/img/btn_buynow_LG.gif" alt="Pagamenti Online" border="0"/></p>
			</a>
		</p></div>
	
		<div class="pagamenti"><p>
			<!-- PayPal Logo -->					
			<a href="#" class="skimg" onclick="javascript:window.open('https://www.paypal.com/it/cgi-bin/webscr?cmd=xpt/cps/popup/OLCWhatIsPayPal-outside','olcwhatispaypal','toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=400, height=350');"><img class="paypal" src="https://www.paypal.com/en_US/i/bnr/bnr_paymentsBy_150x40.gif" border="0" alt="Additional Options"/></a>
		</p></div>
		<!-- PayPal Logo -->
	</div>
</div>


