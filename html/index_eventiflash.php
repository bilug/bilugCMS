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
<div class="blocco">
<!-- tabella menù  -->

	<h3><span><?=$titolo?></span></h3>
	 
	<div class="modulo">
	<?
	$str=" SELECT ID,DATE_FORMAT(dataora,'%d-%m-%Y %H:%i') as data,titolo,tipo,DATE_FORMAT(dataora,'%m') FROM eventi order by dataora DESC";
	$risultato=mysql_query($str);
	if (mysql_num_rows($risultato)>0)
	{
		echo "<ul id=\"eventlat\">";
		while($control=mysql_fetch_row($risultato))
				{
				echo "
				<li><a class=\"evefl\" href=\"index.php?pag=mese_eventoapp.php&amp;id=$control[0]&amp;mese=$control[4]\">
				$control[1]<br />
					".($control[3]=='E' ? "Evento": "Appuntamento")."<br />
				".str_pad(substr (wordwrap(strip_tags($control[2]),21,"\n",1),0,80),80)."
				</a></li>
				";
				}
		echo "</ul>";
	}
	else
		echo "<ul><li>Nessun Evento</li></ul>";
	?>
	</div>
	
</div>
