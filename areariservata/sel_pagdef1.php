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
<?php

$parola = "Conferma";

$annulla = "<input type=\"button\" 
class=\"medio\" name=\"Annulla\" value=\"Annulla\" onclick=\"javascript:window.location='area.php?pag=inser_pagdef.php'\" />";

$dir='../gals';    
$selezione = array("RANDOM");

function tree( $dir,$liv,$argo="",$sel = array())
//funzione di scansione delle gallerie
{      
	if( is_dir( $dir ) )
   {
   	foreach( scandir( $dir) as $item )
      {
       	
      	if( !strcmp( $item, '.' ) || !strcmp( $item, '..' ) || !strcmp( $item, 'index.php' )|| !strcmp( $item, 'index.php' )|| !strcmp( $item, '.htaccess' )|| !strcmp( $item, '.gitignore' )|| !strcmp( $item, '.txt' ) )
         continue;       
         if(is_dir($dir."/".$item)==TRUE)
         {
         	if ($liv!=0) $sel[]="$argo/$item";
           	$sel = tree( $dir. "/" . $item, $liv+1,$item,$sel);           	           	           	           	 
         }
		}   
	}
	return $sel;	
}

if (isset($_POST["op"]))
{
	if ($_POST["scelta"]=="RANDOM")
	{
		$str="UPDATE parametri Set valore = '../html/imgrandom.php' where nomecampo='_CORPO' and  sezione = 0";
		$risultato=mysql_query($str);
		if (!$risultato)
   	// controllo se la query di inserimento è andata a buon fine
   	{
      	echo "ERRORE: Modifica PAGINA INIZIALE non andato a Buon Fine";         
   	}
   	else 
   	{
	   	include_once ("genera_param_query.php"); 
	      //Header("Location: area.php?pag=insert_pagdef.php");
			echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=conferma.php&from=insert_pagdef.php\" />";
	   }
   }
   else
   {
		$str="UPDATE parametri Set valore = '../utility/galleria.php' where nomecampo='_CORPO' and  sezione = 0";
		$risultato=mysql_query($str);
		if (!$risultato)
	   // controllo se la query di inserimento è andata a buon fine
	   {
	      	echo "ERRORE: Modifica PAGINA INIZIALE non andato a Buon Fine";         
	   }
	   else
	   {
	   	$val=split("/",$_POST["scelta"]);
			$str="UPDATE parametri Set valore = '".apici($val[0])."' where nomecampo='_DEFARGGAL' and  sezione = 2";
			$risultato=mysql_query($str);
			if (!$risultato)
	   	 //controllo se la query di inserimento è andata a buon fine
	   	{
	      		echo "ERRORE: Modifica PARAMETRI Argomento Galleria non andato a Buon Fine";         
	   	}
	   	else
	   	{
	   		$str="UPDATE parametri Set valore = '".apici($val[1])."' where nomecampo='_DEFGAL' and  sezione = 2";
				$risultato=mysql_query($str);
				if (!$risultato)
	   	 	//controllo se la query di inserimento è andata a buon fine
	   		{
	      		echo "ERRORE: Modifica PARAMETRI Galleria non andato a Buon Fine";         
	   		}
	   		else
	   		{
	   			include_once ("genera_param_query.php"); 
	      		//Header("Location: area.php?pag=insert_pagdef.php");
				echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=conferma.php&from=insert_pagdef.php\" />";
	      	}
	      }    
		}  	
   }
   exit;
}
else
{
	$selezione += tree($dir,0);
}
?>
<hr/>
<form name="modify_pagdef1" method="post" action="./area.php?pag=sel_pagdef1.php">
<div>
	- Pagina Iniziale con Galleria<br/>
	- Possibilit&agrave; di selezionare una galleria specifica o un Immagine RANDOM da tutte le gallerie<br/><br/>
<?
	$testa ="";
	foreach ($selezione as $key => $value)
	{
		if ($key==0) 
		{
			echo "<h3>Immagine a tutto schermo</h3>";
			echo "<input type=\"radio\" name=\"scelta\" value=\"$value\"/> ".$value."<br/>";
		}
		else
		{
			list($argo,$desc) = split("/",$value);
			if (($testa=="")OR $testa!= $argo)
			{
				echo "<h3>Argomento=>".str_replace("_"," ",$argo)."</h3>";
				$testa = $argo;
			}
			$desc = substr($desc,strpos($desc,"_")+1);
			$desc = str_replace("_"," ",$desc);		
			echo "<input type=\"radio\" name=\"scelta\" value=\"$value\"/> ".$desc."<br/>";
		} 		
	}
?>
</div>
	<input class="medio" type="submit" name="op" value="<?=$parola?>"/>	
	<?=$annulla?>
</form>
