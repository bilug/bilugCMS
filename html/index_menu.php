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
<?
	$stringa="SELECT ID,sez,voce FROM menu order by sez";  
  	$risulta=mysql_query($stringa);  	
  	if (mysql_num_rows($risulta)>0)
  	{
  		$i=0;
  		while ($control=mysql_fetch_row($risulta))
  		{
  			$titolo[$i++]= $control[2];
  			$str1="SELECT voce,link,stat FROM menuvoci where IDmenu='$control[0]' order by ordine";  
  			$risultato1=mysql_query($str1);
  			if (mysql_num_rows($risultato1)>0)
  			{
  				$j=0;
  				while ($control1 = mysql_fetch_row($risultato1))
  				{
  					$menu[$control[1]][$j]= $control1[0];
  					if ($control1[2]=='si')
  					{
  					$link[$control[1]][$j]= "index.php?pag=static.php&amp;stat=".$control1[1]  ;						
  					}  					
  					else
  					$link[$control[1]][$j]= $control1[1];
  					$j++;
  				}
  			}
  		}
  	}  	
echo "<div class=\"blocco\">\n";

echo "<a href=\"index.php\">Home</a>\n";
if ($titolo[0]!= "")
{
	echo "<h3>$titolo[0]</h3>\n";	
		
	echo "<div class=\"modulo\">\n";		
		echo "<ul>\n";
			for($i=0;$i<count($menu['a']);$i++)
				echo "<li><a href=\"".$link['a'][$i]."\">".$menu['a'][$i]."</a></li>\n";

		echo "</ul>\n";
	echo "</div>\n";
}
if ($titolo[1]!= "")
{	
	echo "<h3>$titolo[1]</h3>\n";
	
	echo "<div class=\"modulo\">\n";
		echo "<ul>\n";
			for($i=0;$i<count($menu['b']);$i++)
				echo "<li><a href=\"".$link['b'][$i]."\">".$menu['b'][$i]."</a></li>\n";
		echo "</ul>\n";
	echo "</div>\n";
}
if ($titolo[2]!= "")
{	
	echo "<h3>$titolo[2]</h3>\n";
	
	echo "<div class=\"modulo\">\n";
		echo "<ul>\n";
			for($i=0;$i<count($menu['c']);$i++)
				echo "<li><a href=\"".$link['c'][$i]."\">".$menu['c'][$i]."</a></li>\n";
		echo "</ul>\n";
	echo "</div>\n";
}
if ($titolo[3]!= "")
{	
	echo "<h3>$titolo[3]</h3>\n";
	
	echo "<div class=\"modulo\">\n";
		echo "<ul>\n";
			for($i=0;$i<count($menu['d']);$i++)
				echo "<li><a href=\"".$link['d'][$i]."\">".$menu['d'][$i]."</a></li>\n";
		echo "</ul>\n";
	echo "</div>\n";
}
echo "</div>\n";
