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
<!-- Non Mettere online utilizzare solo in Locale -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" lang="it">
<html>
<head>
<style>
<?$max=900?>
body{
	text-align:center;	
}
#corpo {
	margin: 0 auto;
	width:<?=$max+10?>px;
}
.infopos {
	color: yellow;
	background: green;
	font-size: 14pt;
}
.infoneg {
	background: red;
	color: yellow;
	font-size: 14pt;
}
.infomiss {
	color: yellow;
	background: black;
	font-size: 14pt;
}
.infodir {
	color: yellow;
	background: black;
	font-size: 14pt;
}
.arraycont {
	overflow: scroll;
	width: <?=$max/4-2?>px;
	height: 200px;
	text-align: left;
}
.contpos {
	color: white;
	background: green;	
	text-align: center;
	width: <?=$max/4?>x;	
	border: 1px solid #000;
	float:left;
}
.contneg {	
	background: red;
	color: white;
	text-align: center;
	width: <?=$max/4?>px;	
	border: 1px solid #000;
	float:left;
}
.contmiss {	
	color: yellow;
	background: black;
	text-align: center;
	width: <?=$max/4?>px;	
	border: 1px solid #000;
	float:left;
}
.contdir{	
	color: white;
	background: black;
	text-align: center;
	width: <?=$max/4?>px;	
	border: 1px solid #000;
	float:left;
}

</style>
</head>
<?

$ext = array(".php","html",".htm",".css");
$risultati = array("Eseguiti"=>array(),"Errori"=>array(),"Non Validi"=>array(),"Dir"=>array());
$nodir = array("fckeditor","phpmysqlautobackup");
$option = array ("all"=>"Tutte",
		"root"=>"Principale",
		"html"=>"Html",
		"areautente"=>"Area Utenti",
		"areariservata"=>"Area Riservata",
		"img"=>"Immagini",
		"utility"=>"Utility",
		"js"=>"Script",
		"custom"=>"Custom");	

if ($_POST['Avvio'] == "Avvio")
{
	$all = false;	
	switch ($_POST['Area'])
	{
		case "root":
			$directory ="./";	
			break;
		case "html":
			$directory ="./html/";	
			break;
		case "areautente":
			$directory ="./areautenti/";	
			break;
		case "areariservata":
			$directory ="./areariservata/";	
			break;
		case "utility":
			$directory ="./utility/";	
			break;
		case "img":
			$directory ="./img/";	
			break;
		case "js":
			$directory ="./js/";	
			break;
		case "custom":
			$directory ="./custom/";	
			break;
		case "all":
			$directory =".";
			$all=true;	
			break;
		default:
	}
	
	if (!$all)
	{
	$i=0;	
	if ($handle = opendir($directory)) 
	{
		$risultati["Dir"][$i]= $directory;
		while (false !== ($file = readdir($handle)))
		{
			if ($file != '.' and $file != '..' and filetype($directory.$file) == 'file')
			{
				if (in_array(substr($file,-4),$ext))
				{	
					if (substr($file,-3)!="css")
					{
						$strsopra ="<? /* ".$_POST['blocco'];
						$str =$_POST['blocco']." */ ?>";
					}
					else
					{
						$strsopra ="/* ".$_POST['blocco'];
						$str =$_POST['blocco']." */";
					}
					
					if (false !==($mod=@fopen($directory.$file,"r+")))
					{
						$risultati["Eseguiti"][$i]= $file;						
						$contenuto = @fread($mod,filesize($directory.$file));
						fclose($mod);
						$mod=@fopen($directory.$file,"w+");				
						if (false === ($startpos=stripos ($contenuto,$strsopra)))
						{
							$info =$strsopra."\n\n".stripslashes($_POST['informativa'])."\n\n".$str."\n";							
							$contenuto = $info.$contenuto;														
							fwrite($mod,$contenuto);
							fclose($mod);
						}
						else
						{
							$endpos = stripos($contenuto,$str)+strlen($str)+1;
							$contenuto = substr($contenuto,$endpos);
							$info =$strsopra."\n\n".stripslashes($_POST['informativa'])."\n\n".$str."\n";
							$contenuto = $info.$contenuto;							
							fwrite($mod,$contenuto);
							fclose($mod);
						}		
					}
					else 
					{
						$risultati["Errori"][$i]= $file;
					}
				}   	
				else 
				{
					$risultati["Non Validi"][$i]= $file;
				}		
			}			
			$i++;
		}		
	}
  	closedir($handle);
  	}
  	else
  	{
  	function tree( $dir, $ext,$risultati,$i,$nodir) 
   {  
   	if( is_dir( $dir ) )
      {
          foreach( scandir( $dir) as $item )
          {
          	
            if( !strcmp( $item, '.' ) || !strcmp( $item, '..' )|| in_array($item,$nodir)) continue;       
              if(is_dir($dir."/".$item)==TRUE)
              {
              		$risultati = tree( $dir. "/" . $item,$ext,$risultati,$i,$nodir);              		               
              }
              else
              {	
              		$file = $dir. "/" . $item;              		
              		if (in_array(substr($file,-4),$ext))
						{
							if (substr($file,-3)!="css")
							{
								$strsopra ="<? /* ".$_POST['blocco'];
								$str =$_POST['blocco']." */ ?>";
							}
							else
							{
								$strsopra ="/* ".$_POST['blocco'];
								$str =$_POST['blocco']." */";
							}
							if (false !==($mod=@fopen($file,"r+")))
							{
								$risultati["Eseguiti"][$i]= $file;								
								$contenuto = @fread($mod,filesize($file));
								fclose($mod);
								$mod=@fopen($directory.$file,"w+");
								if (false === ($startpos=stripos ($contenuto,$strsopra)))
								{
									$info =$strsopra."\n\n".stripslashes($_POST['informativa'])."\n\n".$str."\n";
									$contenuto = $info.$contenuto;									
									fwrite($mod,$contenuto);
									fclose($mod);
								}
								else
								{
									$endpos = stripos($contenuto,$str)+strlen($str)+1;
									$contenuto = substr($contenuto,$endpos);
									$info =$strsopra."\n\n".stripslashes($_POST['informativa'])."\n\n".$str."\n";
									$contenuto = $info.$contenuto;									
									fwrite($mod,$contenuto);
									fclose($mod);
								}		
							}	
							else
							{
								$risultati["Errori"][$i]= $file;								
							} 									
						}   	
						else 
						{
							$risultati["Non Validi"][$i]= $file;							
						}
						$i++;
            	}
				}   
      }      
      $risultati["Dir"][$i]= $dir;
      $i++;
      return $risultati;
   }
   $risultati = tree ($directory,$ext,$risultati,0,$nodir);
   }   
}
?>
<body>
<div id="corpo">
<form action="fill.php" method="post">
	<h2>Inserire la formativa da Aggiornare</h2>	
	<label for="blocco">Frase di apertura/chiusura:</label><input type="text" id="blocco" name="blocco" value="<?=$_POST['blocco']?>"/><br/>
	<label for="Area">Area di Aggiornamento:</label>
	<select name="Area" id="Area">
		<?
		for ($i = 0; $i <  count($option); $i++) 
		{
   		$key=key($option);
	   	$val=$option[$key];
   		if ($val<> ' ') 
    		{
    			echo "<option value=\"$key\"";
    			if ($_POST['Area']==$key) echo " selected ";
    			echo ">$val</option>";       
      	}
     		next($option);
   	}	
	?> 		
	</select><input type="submit" name="Avvio" value="Avvio" />
	<p>Estensioni Verificate : 
	<?
		for ($i = 0; $i <  count($ext); $i++) 
		{
   		$key=key($ext);
	   	$val=$ext[$key];
   		if ($val<> ' ') 
    		{
    			echo "&lt;$val&gt;";       
      	}
     		next($ext);
   	}	
	?> 
	</p>
	<p>Directory Escluse: 
	<?
		for ($i = 0; $i <  count($nodir); $i++) 
		{
   		$key=key($nodir);
	   	$val=$nodir[$key];
   		if ($val<> ' ') 
    		{
    			echo "&lt;$val&gt;";       
      	}
     		next($nodir);
   	}	
	?>
	</p>
	
	<br/>
	<textarea name="informativa" rows="20" cols="100"><?=stripslashes($_POST['informativa'])?></textarea><br/>
	<br/>			
</form>
<? 
	echo "<div class=\"contpos\">\n";
	echo "<span class=\"infopos\">Risultati Positivi</span><br/>\n";	
	echo "<div class=\"arraycont\">\n";
	for ($i = 0; $i <  count($risultati["Eseguiti"]); $i++) 
	{
   	$key=key($risultati["Eseguiti"]);
	   $val=$risultati["Eseguiti"][$key];
   	if ($val<> ' ') 
    	{
    		echo "$val<br/>\n";       
      }
     	next($risultati["Eseguiti"]);
   }	
	echo "</div>\n</div>\n";
	echo "<div class=\"contneg\">\n";
	echo "<span class=\"infoneg\">Risultati Errati</span><br/>\n";
	echo "<div class=\"arraycont\">\n";
	for ($i = 0; $i <  count($risultati["Errori"]); $i++) 
	{
   	$key=key($risultati["Errori"]);
	   $val=$risultati["Errori"][$key];
   	if ($val<> ' ') 
    	{
    		echo "$val<br/>\n";       
      }
     	next($risultati["Errori"]);
   }	
	echo "</div>\n</div>\n";
	echo "<div class=\"contmiss\">\n";
	echo "<span class=\"infomiss\">Risultati Non Validi</span><br/>\n";
	echo "<div class=\"arraycont\">\n";
	for ($i = 0; $i <  count($risultati["Non Validi"]); $i++) 
	{
   	$key=key($risultati["Non Validi"]);
	   $val=$risultati["Non Validi"][$key];
   	if ($val<> ' ') 
    	{
    		echo "$val<br/>\n";       
      }
     	next($risultati["Non Validi"]);
   }	
	echo "</div>\n</div>\n";
	echo "<div class=\"contdir\">\n";
	echo "<span class=\"infodir\">Dir Controllate</span><br/>\n";
	echo "<div class=\"arraycont\">\n";
	for ($i = 0; $i <  count($risultati["Dir"]); $i++) 
	{
   	$key=key($risultati["Dir"]);
	   $val=$risultati["Dir"][$key];
   	if ($val<> ' ') 
    	{
    		echo "$val<br/>\n";       
      }
     	next($risultati["Dir"]);
   }	
	echo "</div>\n</div>\n";
	echo "<div style=\"clear:both\"></div>";
?>
</div>
</body>
</html>