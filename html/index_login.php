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
 if (!isset($_SESSION['tux']) or $_SESSION['tux']<=0) {?>
	<div class="blocco bilug-login">
		<h3><span><?=$titolo?></span></h3>
		<div class="modulo">
			<form name="login" method="post" action="<?=_URLSITO?>/areariservata/guardian.php" target="_blank">
				<p>E-mail</p>
				<p><input type="text" name="Nomeutente" size="15" class="textlato"/></p>
				<p>Password</p>
				<p><input type="password" name="Parola" size="15" class="textlato"/></p>
				<p><input type="submit" value="Login" class="bottomlato"/></p>
			</form>
		</div>
	</div>
<?}
else
{?>
	<div class="blocco bilug-login">
		<h3><span><?=$titolo?></span></h3>
		
		<div class="modulo">
		<?php	
			$str="SELECT nome FROM anagrafica WHERE ID = $_SESSION[tux] LIMIT 1";
			$risultato=mysql_query($str);
			if (mysql_num_rows($risultato)>0)
				$control=mysql_fetch_row($risultato); 
			echo "<p>Utente: $control[0]</p>";
			?>
			<p><a class="link_inline" href="<?=_URLSITO?>/areariservata/area.php" target="_blank">Menu Amministratore</a></p>
			<p><a class="link_inline" href="<?=_URLSITO?>/areariservata/exit.php">Esci</a></p>
		</div>
	
	</div>
<?}?>
