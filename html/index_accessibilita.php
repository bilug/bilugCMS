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

<div class="blocco blocco-accessibilita">
	<div class="modulo">
		<?php if ( _ACCESSIBILITA != 4 ) : ?>
			Ingrandisci testo 
			<a title="Normale" style="font-size: 0.8em" href="<?=_URLSITO?>/html/cambia_accessibilita.php?c=1">A</a>
			<a title="Medio" style="font-size: 1em" href="<?=_URLSITO?>/html/cambia_accessibilita.php?c=2">A</a>
			<a title="Grande" style="font-size: 1.2em" href="<?=_URLSITO?>/html/cambia_accessibilita.php?c=3">A</a>
			&nbsp;|&nbsp;
			<a href="<?=_URLSITO?>/html/cambia_accessibilita.php?c=4">Solo testo</a>
		<?php else : ?>
			<a href="<?=_URLSITO?>/html/cambia_accessibilita.php?c=0">Versione completa</a>
		<?php endif;?>
	</div>
</div>