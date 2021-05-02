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

if ($_SESSION['typo']="A")
{
	if (!$id)
  	{
  		$parola=Inserisci;
  		// se il valore di id è vuoto, allora siamo in fase di inserimento 
  		$annulla = "<input type=\"button\" 
		class=\"medio\" name=\"Annulla\" value=\"Annulla\" onclick=\"javascript:window.location='area.php?pag=elenco_menuadmin.php'\" />";
  	}
  	else
  	{
  		$parola=Modifica;
  		// se id ha un valore, allora siamo in fase di modifica 
		$annulla ="<input type=\"button\" 
		class=\"medio\" name=\"Annulla\" value=\"Annulla\" onclick=\"javascript:history.go(-1)\" />";
    	$str=" SELECT menu,link,extra,descr,colonna,ordine,permessi,visibile FROM menuadmin where ID='$id'";
      $risultato=mysql_query($str);
      if (mysql_num_rows($risultato)>0)
      {
      	$control=mysql_fetch_row($risultato);
      }
  	}
}
else
	//Header("Location: index.php"); 
	echo "<meta http-equiv=\"refresh\" content=\"0;url=index.php\" />";
?>

<div class="contenitore">
<form name="modify_menuadm" method="post" action="insert_menuadmin_query.php">
<input type="hidden" name="id" value="<?=$id?>"/>
<!-- il valore di id lo passiamo alla pagina di action con un campo nascosto -->
	<h3><?=$parola?> Modulo:</h3>
	<div class="azzerafloat"></div>
	<div class="float140">Menu:</div>
	<div class="float500">
		<input type="text" name="menu" size="95" maxlength="200" tabindex="1" value="<?=$control[0]?>"/>
	</div>
	<div class="azzerafloat"></div>
		
	<div class="float140">link:</div>
	<div class="float500">
		<input type="text" name="link" size="95" maxlength="200" tabindex="1" value="<?=$control[1]?>"/>
	</div>	
	<div class="azzerafloat"></div>
	
	<div class="float140">Extra:</div>
	<div class="float500">
		<input type="text" name="extra" size="95" maxlength="200" tabindex="1" value="<?=$control[2]?>"/>
	</div>	
	<div class="azzerafloat"></div>
	
	<div class="float140">Descrizione:</div>
	<div class="float500">
		<input type="text" name="descr" size="95" maxlength="200" tabindex="1" value="<?=$control[3]?>"/>
	</div>	
	<div class="azzerafloat"></div>
	<div class="float140"></div>
	<div class="float500">
	   <input type="checkbox" class="little" name="admin" value="S" <? if (strpos($control[6],'S') !== false) echo "checked "; ?> /> SuperUser	   	   
    </div>
   <div class="azzerafloat"></div>
	<div class="float140">Colonna:[1-5]
	<input type="text" class="little" name="colonna" size="10" maxlength="2" value="<?=$control[4]?>"/>	
	</div>
	<div class="float140">visibile:[si-no]
	<input type="text" class="little" name="visibile" size="10" maxlength="2" value="<?=$control[7]?>"/>	
	</div>
	<div class="azzerafloat"></div>
	<div class="float800">
		<p>Moduli presenti e ordine di visualizzazione:</p>
 <? 
		$str1=" SELECT menu,colonna,ordine FROM menuadmin order by colonna,ordine";
      $risultato1=mysql_query($str1);
      $vari=0;        
		if (mysql_num_rows($risultato1)>0)
		{
			while ($var = mysql_fetch_row($risultato1))
			{
				if ($vari<>$var[1])
				{ 
					if ($vari<>0) echo "</ul><hr/></div>";
					echo "<div class=\"float200\"><ul>";
					$vari= $var[1];													
				}				
				echo "<li>$var[1] - $var[2] - $var[0]</li>";				
			}
			echo "</ul></div>";
      }
   ?>		
	</div>
	<div class="azzerafloat"></div>		
		<?if (!$id)
		{
			$str1=" SELECT max(ordine) FROM menuadmin";
        	$risultato1=mysql_query($str1);        
        	$var = mysql_fetch_row($risultato1);
        	$control[5] = ++$var[0];
		}		
		?>
		<input type="hidden" name="ordine" value="<?=$control[5]?>"/>		
		
	<br/>
	<input type="submit" class="medio" value="<?=$parola?>" tabindex="7"/>  
	<?=$annulla?>             
</form>
