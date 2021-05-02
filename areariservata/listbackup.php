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

echo "<div class=\"contenitore\">";
$dir="../phpmysqlautobackup/backups";
echo "<h5>FILES CARICATI NELL'AREA BACKUP:</h5><br/>";
function tree( $dir )
{
	if( is_dir( $dir ) )
   {
   	foreach( scandir( $dir) as $item )
      {
      	if( !strcmp( $item, '.' ) || !strcmp( $item, '..' ) || !strcmp( $item, 'index.php' )|| !strcmp( $item, 'index.php' )|| !strcmp( $item, '.htaccess' ) )
         continue;       
         if(is_dir($dir."/".$item)==TRUE)
         {
         	echo "<h3>Elenco files dell'utente: $item</h3>";
           	echo "<div class=\"azzerafloat\"></div>";
           	tree( $dir. "/" . $item); 
         }
         else
         {
         	echo "<div class=\"float100\"><a href=\"del.php?what=$dir/$item\"><img border=\"0\" src=\"./img/elimina.gif\" \></a></div>\n";
           	echo "<div class=\"float300\"><a href=\"$dir/$item\">$item</a></div>\n";
           	echo "<div class=\"azzerafloat\"></div>";
         }
		}   
	}
  	else
   {
   	echo "<div class=\"float100\"><a href=\"del.php?what=$dir/$item\"><img border=\"0\" src=\"./img/elimina.gif\" \></a></div>\n";
      echo "<div class=\"float300\"><a href=\"$dir/$item\">$item</a></div>\n";
      echo "<div class=\"azzerafloat\"></div>";
	}
}
tree ($dir);
echo "</div>";  
?>  
