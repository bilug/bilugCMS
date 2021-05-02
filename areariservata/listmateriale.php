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
$dir="../html/img/file/";
echo "<h5>FILES CARICATI NELL'AREA MATERIALE:</h5><br/>";
function tree( $dir,$liv )
{
	if( is_dir( $dir ) )
   {
   	foreach( scandir( $dir) as $item )
      {
      	if( !strcmp( $item, '.' ) || !strcmp( $item, '..' ) || !strcmp( $item, 'index.php' )|| !strcmp( $item, 'index.php' )|| !strcmp( $item, '.htaccess' ) )
         continue;       
         if(is_dir($dir."/".$item)==TRUE)
         {
         	for ($i=0;$i<$liv;$i++)
       			echo "<div class=\"float20\">&nbsp;</div>\n";
           	echo "<div class=\"float300\"><h3>Elenco files dell'utente: $item</h3></div>";              
           	tree( $dir. "/" . $item, $liv+1);
           	echo "<div class=\"azzerafloat\"></div>"; 
			}
         else
         {
         	for ($i=0;$i<$liv;$i++)
       			echo "<div class=\"float20\">&nbsp;</div>\n";
           	echo "<div class=\"float100\"><a class=\"del\" href=\"del.php?what=$dir/$item\"><img border=\"0\" src=\"./img/elimina.gif\" \></a></div>\n";
           	echo "<div class=\"float300\"><a href=\"$dir/$item\">$item</a></div>\n";
           	echo "<div class=\"azzerafloat\"></div>";
			}
		}   
	}
   echo "<hr/>";
}
tree ($dir,0);
echo "</div>";
?>