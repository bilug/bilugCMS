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
<h3>Menu' Admin</h3>

<?php
if ($_SESSION['typo']="A")
{
	$str=" SELECT ID,menu,colonna,permessi,visibile FROM menuadmin order by colonna,ordine";
  	// facciamo una query per caricare tutti i dati della tabella
  	$risultato=mysql_query($str);
  	if (mysql_num_rows($risultato)>0)
   {
   	echo "<div class=\"contenitore\"><div class=\"azzerafloat\"></div>";
      //se abbiamo un risultato dalla query costruiamo la tabella
      while($control=mysql_fetch_row($risultato))
      // ciclo per cui finchè abbiamo risultati ci costruisce una riga alla volta
      {
      	echo "<div class=\"evidenzia\">
         <div class=\"float200\">$control[1]</div>
         <div class=\"float20\">$control[2]</div>
         <div class=\"float50\"><a title=\"Elmina men&ugrave;\" href=\"del_menuadmin.php?id=$control[0]\"><img src=\"./img/del.png\" class=\"ico\" /></a></div>
         <!-- Assegnamo all'id il valore che otteniamo con la query -->
         <div class=\"float50\"><a title=\"Elmina men&ugrave;\" href=\"area.php?pag=insert_menuadmin.php&amp;id=$control[0]\"><img src=\"./img/mod.png\" class=\"ico\" /></a></div>
         <div class=\"float50\"><a title=\"Sposta il men&ugrave; in alto\" href=\"updown_menuadmin.php?dir=U&amp;id=$control[0]\"><img src=\"./img/su.png\" class=\"ico\" /></a></div>
         <div class=\"float50\"><a title=\"Sposta il men&ugrave; in basso\" href=\"updown_menuadmin.php?dir=D&amp;id=$control[0]\"><img src=\"./img/giu.png\" class=\"ico\" /></a></div>
         <div class=\"float50\"><a title=\"Sposta il men&ugrave; di una colonna avanti\" href=\"colonna_menuadmin.php?dir=P&amp;id=$control[0]\"><img src=\"./img/piu.png\" class=\"ico\" /></a></div>
         <div class=\"float50\"><a title=\"Sposta il men&ugrave; di una colonna indietro\" href=\"colonna_menuadmin.php?dir=M&amp;id=$control[0]\"><img src=\"./img/men.png\" class=\"ico\" /></a></div>";
         if ($control[3] == "A")
         echo "<div class=\"float100\"><a title=\"Elmina men&ugrave;\" href=\"superadm_menuadmin.php?dir=S&amp;id=$control[0]\">Solo Admin</a></div>";
         if ($control[3] == "AS")
         echo "<div class=\"float100\"><img src=\"./img/usr.png\" class=\"ico\" /><a href=\"superadm_menuadmin.php?dir=U&amp;id=$control[0]\">Admin e Suser</a></div>";
         if ($control[3] == "ASU")
         echo "<div class=\"float100\"><img src=\"./img/tut.png\" class=\"ico\" /><a href=\"superadm_menuadmin.php?dir=A&amp;id=$control[0]\">Tutti</a></div>";
         if ($control[4]=="si")
         echo "<div class=\"float100\"><img src=\"./img/ok.png\" class=\"ico\" /><a href=\"vis_menuadmin.php?dir=no&amp;id=$control[0]\">vis</a></div>";
         if ($control[4]=="no")
         echo "<div class=\"float100\"><img src=\"./img/dis.png\" class=\"ico\" /><a href=\"vis_menuadmin.php?dir=si&amp;id=$control[0]\">no vis</a></div>";
         
         echo "<div class=\"azzerafloat\"></div></div>";
         
       }
       echo "</div>";
   }
   else 
   	echo "<p>Tabella Vuota</p>";
      	
   echo "<a href=\"area.php?pag=insert_menuadmin.php\">Aggiungi Menu</a><br/>";
   echo "<a href=\"javascript:history.go(-1)\">Indietro</a>";
}
else
	//Header("Location: ");
	echo "<meta http-equiv=\"refresh\" content=\"0;url=index.php\" />";
?>
