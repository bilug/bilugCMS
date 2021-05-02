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

function Vis_Menu($liv=-1,$space=0)
{
	if ($liv == -1)
  	{
  		$menu .="<div class=\"contenitore\"><div class=\"azzerafloat\"></div>\n".Vis_Menu(0,0)."</div>";
  	}
	$stringa="SELECT ID,sez,voce,liv FROM menu where liv = '$liv' order by sez,id";
	$risulta=mysql_query($stringa);
	if (mysql_num_rows($risulta)>0)
  	{
  		while ($control=mysql_fetch_row($risulta))
  		{
  		
  		for ($i=0; $i<$space; $i++)	$menu .= "<div class=\"float20\">&nbsp;</div>";   	
   	$menu .= "<div class=\"evidenzia\">";
      if ($space==0) $menu .= "<div class=\"float20\">$control[1]</div>";
      else $menu .= "<div class=\"float20\">$space</div>";
      $menu .= "<div class=\"float200\"><a title=\"|Visualizza le voci del Menu/Sottomenu\" href=\"area.php?pag=elenco_menuvoci.php&amp;id=$control[0]\">$control[2]</a></div>
      <div class=\"float70\"><img src=\"./img/del.png\" class=\"ico\" /><a title=\"|Elimina Menu/Sottomenu\" href=\"area.php?pag=delete.php&id=$control[0]&from=elenco_menu.php\">Elimina</a></div>
      <div class=\"float70\"><img src=\"./img/mod.png\" class=\"ico\" /><a title=\"|Modifica il nome del Menu/Sottomenu\" href=\"area.php?pag=insert_menu.php&amp;id=$control[0]\">Modifica</a></div>
      <div class=\"float70\"><a title=\"|Aggiungi un Sottomenu\" href=\"area.php?pag=insert_smenu.php&amp;sez=$control[1]&amp;liv=$control[0]\">Sottomenu</a></div>
      <div class=\"azzerafloat\"></div></div>";
  		$menu .= Vis_Menu($control[0],$space+1);
  		
  		}
  	}  		
  	$menu = str_replace("<ul>\n</ul>","",$menu);
  	return $menu; 
}
$str=" SELECT ID,sez,voce,liv FROM menu order by sez,liv";
// facciamo una query per caricare tutti i dati della tabella
$risultato=mysql_query($str);
if (mysql_num_rows($risultato)>0)
{
	$menu = Vis_Menu();
	echo $menu;
}
else 
{
	echo "<p>Tabella vuota</p>";
}
echo "<br>";

echo "<div class=\"contenitore\"><div class=\"azzerafloat\"></div>
		<div class=\"evidenzia\">
			
				<img src=\"./img/add.png\" class=\"ico\" /> <a href=\"area.php?pag=insert_menu.php\">Nuovo menu'</a>
			
		</div>
	  </div>";
		
?>
