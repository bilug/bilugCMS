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
<!-- tabella menù  -->
 
<div class="blocco">
	<h3><span><?=$titolo?></span></h3>
	
	<div class="modulo">
		<ul>	
		<?php
		$dir = '../gals';
		$filename =array();
		if ($handle = @opendir($dir)) {   
		   while (false !== ($file = readdir($handle))) 
		   {    
				if ($file != '.' and $file != '..' and filetype($dir."/".$file) == 'dir')
				$filename[] = $file;
		   }
		   
		   closedir($handle);     
		   if (isset($filename) and count($filename)>0)	
			{	
			natcasesort($filename);
			foreach ( $filename as $key => $value )
				{
					$link = "gals-$value.html";
					echo "
					 <li><a class=\"Cap\" href=\"$link\">".
					 str_replace("_"," ",$value)
					 ."</a> <div class=\"descarg\">";
					 @include ($dir."/".$file."/".$file.".txt");
					 echo "</div></li>";
			   }
		   
		   }
		   else echo "<li>Nessuna Galleria Disponibile</li>";	 
		}
		else echo "<li>Cartella Argomenti Galleria non valida</li>";
		?>
		</ul>
	</div>
	
</div>


