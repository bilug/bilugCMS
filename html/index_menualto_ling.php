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
	$lang = $_GET["lang"];
	if (!isset($lang)) $lang="ita";
	$stringa="SELECT ID,sez,voce FROM menu where sez='a'";  
  	$risulta=mysql_query($stringa);  	
  	if (mysql_num_rows($risulta)>0)
  	{
  		$i=0;
  		while ($control=mysql_fetch_row($risulta))
  		{
  			$titolo[$i++]= $control[2];
  			$str1="SELECT voce,link,stat FROM menuvoci where (INSTR(voce,'_".$lang."')>0 or INSTR(voce,'_any')>0) and IDmenu='$control[0]' order by ordine";  
  			$risultato1=mysql_query($str1);
  			if (mysql_num_rows($risultato1)>0)
  			{
  				$j=0;
  				while ($control1 = mysql_fetch_row($risultato1))
  				{
  					$menu[$control[1]][$j]= substr($control1[0],0,strrpos($control1[0],"_"));
  					if ($control1[2]=='si')
  					{
  					$link[$control[1]][$j]= "index.php?pag=static.php&amp;stat=".$control1[1]."&amp;lang=".$lang;						
  					}  					
  					else
  					$link[$control[1]][$j]= $control1[1];
  					$j++;
  				}
  			}
  		}
  	}  	
	for ($numvoci=0; $numvoci<count($titolo); $numvoci++)
	{
		$let=chr(97+$numvoci);
		echo "<div class=\"modulo\">\n";
			echo "<ul>\n";
				echo "<li><a href=\"index.php\">Home</a></li>\n";
				for($i=0;$i<count($menu[$let]);$i++)
					echo "<li><a href=\"".$link[$let][$i]."\">".$menu[$let][$i]."</a></li>\n";
			echo "</ul>";
		echo "</div>";
	}
?>

