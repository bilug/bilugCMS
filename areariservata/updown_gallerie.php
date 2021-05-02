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
require_once("auth.php");

$argo = $_GET['argo'];
$id = $_GET['id'];
$updw = $_GET['dir'];
$dir = '../gals/'.$argo.'/';

$order = substr($id,0,strpos($id,"_"));


if (is_numeric($order)) $id= substr($id,strpos($id,"_")+1);
else 
{
	$order = "";	
}  
		  	
switch ($updw)
{
case "U":
	if ($order > 0)
	{
		$norder = str_pad($order-1,4,"0",STR_PAD_LEFT);
		foreach( scandir( $dir) as $item )
		{
			if( !strcmp( $item, '.' ) ||
				!strcmp( $item, '..' ) ||
			  	!strcmp( $item, 'index.php' )|| 
			  	!strcmp( $item, 'index.php' )|| 
			  	!strcmp( $item, '.htaccess' ) )
      	continue;
      	if(is_dir($dir.$item)==TRUE)
      	{
      		if (strcmp(substr($item,0,strpos($item,"_")),$norder)==0)
      		{
      			$new = $order."_".substr($item,strpos($item,"_")+1);      			
      			rename  ( $dir.$item  , $dir.$new);
   				@rename  ( $dir.$new."/".$item.".txt",$dir.$new."/".$new.".txt");
   				
				}    
      	}	         
		}
		$new1 = $norder."_".$id;		
		rename  ( $dir.$order."_".$id  , $dir.$new1);
   	@rename  ( $dir.$new1."/".$order."_".$id.".txt",$dir.$new1."/".$new1.".txt");	
	}
break;

case "D":
		$norder = str_pad($order+1,4,"0",STR_PAD_LEFT);
		foreach( scandir( $dir) as $item )
		{
			if( !strcmp( $item, '.' ) ||
				!strcmp( $item, '..' ) ||
			  	!strcmp( $item, 'index.php' )|| 
			  	!strcmp( $item, 'index.php' )|| 
			  	!strcmp( $item, '.htaccess' ) )
      	continue;
      	if(is_dir($dir.$item)==TRUE)
      	{
      		if (strcmp(substr($item,0,strpos($item,"_")),$norder)==0)
      		{
      			$new = $order."_".substr($item,strpos($item,"_")+1);      			
      			rename  ( $dir.$item  , $dir.$new);
   				@rename  ( $dir.$new."/".$item.".txt",$dir.$new."/".$new.".txt");
   				
				}    
      	}	         
		}
		$new1 = $norder."_".$id;		
		rename  ( $dir.$order."_".$id  , $dir.$new1);
   	@rename  ( $dir.$new1."/".$order."_".$id.".txt",$dir.$new1."/".$new1.".txt");	
	
break;
}

//Header("Location: area.php?");
echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=elenco_gallerie.php&argo=$argo\" />";
exit;

?>