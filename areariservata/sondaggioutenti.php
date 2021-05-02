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

$id = $_GET['id'];
$str="SELECT ID,titolo,opzioni,totali,maxvoti,multipli FROM sondaggi where ID='$id'";
$risultato=mysql_query($str);
if (mysql_num_rows($risultato)>0)
{
	$control=mysql_fetch_row($risultato);	
   echo "   
   <form name=\"sondaggiutenti\" method=\"post\" action=\"vota.php\">
   <input type=\"hidden\" name=\"id\" value=\"$control[0]\"/>
   <input type=\"hidden\" name=\"multipli\" value=\"$control[5]\"/>
   <input type=\"hidden\" name=\"tux\" value=\"$tux\"/>
   <div class=\"blocco\">
   <h3>Sondaggio Interno</h3>
   <h2>$control[1]</h2>";
   if ($control[5] == "si")
   	echo "<h2>(selz. multipla)</h2>";
   echo "<ul>";
   $opzioni = explode(";",$control[2]);   
 	for ($i=0;$i < count($opzioni);$i++)
 	{
 		$v=$i+1;
 		if ($control[5] == "no")
 		echo "<li><input type=\"radio\" class=\"ie\" name=\"voto\" value=\"$v\">$opzioni[$i]</input></li>";
 		else
 		echo "<li><input type=\"checkbox\" class=\"ie\" name=\"voto".$i."\" value=\"$v\">$opzioni[$i]</input></li>";
 	}
   echo "     
   </ul>
   <input type=\"hidden\" name=\"i\" value=\"$i\"/>
	<input type=\"submit\" class=\"medio\" nome=\"VotaUtenti\" value=\"Vota\" /><br/>
	<a href=\"area.php&amp;pag=vedi_voto.php&amp;id=$control[0]\">Num.voti: $control[4]</a>      
   </div></form>";
}
?>

