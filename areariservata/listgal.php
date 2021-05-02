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
$argo = apici($_GET['argo']);
echo "<div class=\"contenitore\">
<a href=\"javascript:history.go(-1)\">Ritorna alle Gallerie</a><br/>";
$dir='../gals/'.$argo.'/'.$id;    
echo "<h5>FILES CARICATI NELLA GALLERIA IMMAGINI: $argo</h5><br/>";
function tree( $dir,$liv,$argo,$id )
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
           	echo "<div class=\"azzerafloat\"></div>";              
           	tree( $dir. "/" . $item, $liv+1,$argo,$id);
           	echo "<div class=\"azzerafloat\"></div>"; 
         }
         else
         {
         	for ($i=0;$i<$liv;$i++)
       			echo "<div class=\"float20\">&nbsp;</div>\n"; 			     
           	echo "<div class=\"float100\"><a class=\"del\" href=\"del_imggal.php?argo=$argo&amp;id=$id&amp;what=$dir/$item\"><img align=\"middle\" border=\"0\" src=\"./img/elimina.gif\" \></a></div>\n";
           	echo "<div class=\"float300\"><a href=\"$dir/$item\">";
           	echo "<img valign=\"middle\" src=\"../utility/thump.php?w=30&amp;h=30&amp;file=$dir/$item&amp;nowa=1\"/> $item</a></div>\n";
           	echo "<div class=\"azzerafloat\"></div>";           
         }
		}   
	}}
tree ($dir,0,$argo,$id);
echo "</div>";
?>  
