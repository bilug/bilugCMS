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
<!-- controllo del form mail -->
<script type="text/javascript"><!--
	function ChkFrm(oForm)
	{
	sAlert1 = "Valore mancante per il campo ";
	sAlert2 = "Indirizzo e-mail non valido per il campo ";
	if (oForm.mail.value == "" || oForm.mail.value.indexOf ('@', 0) < 1 || oForm.mail.value.indexOf ('.', 0) < 1)
	{
	  oForm.mail.focus();
	  alert(sAlert2 + "'indirizzo'");
	  return (false);
	}
	return (true);
	}
	//-->
</script>


<div class="blocco">
	
	<h3><span><?=$titolo?></span></h3>
	
	<div class="modulo">
		<form name="modify_maillist" method="post" action="<?=_URLSITO?>/html/insert_mailinglist_query.php" onsubmit="return ChkFrm(this)">
			<p>
				<label for="mail">
					Iscriviti alla mailing-list pubblica, aperta a tutti,
					per ricevere e partecipare alle discussioni coi soci del BiLug<br/>
					Inserisci la tua e-mail:<br/>
				</label>
			</p>
			<p>
				<input type="text" class="textlato ctrl-textlato" id="mail" name="mail" value="E-mail" onfocus="togli_mostra_scritta(this, 'E-mail', 'm');" onblur="togli_mostra_scritta(this, 'E-mail', 'n');" />
		   </p>
		   
		   <p>
				<select name="attivo">
					<option value="SI">Iscrizione</option>
					<option value="NO">Cancellazione</option>
				</select>
			</p>
			
			<p>
				<input type="submit" value="Conferma" class="bottomlato" />
			</p>

			<!-- il valore di id lo passiamo alla pagina di action con un campo nascosto -->
			<input type="hidden" name="id" value="<?=$id?>"/>
		</form>
	</div>
	
</div>
