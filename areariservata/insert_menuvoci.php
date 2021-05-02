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
$idm = $_GET['idm'];
if (!$id)
{
	$parola=Inserisci;
  	// se il valore di id è vuoto, allora siamo in fase di inserimento
  	$control[0]=$idm; 
}
else
{
	$parola=Modifica;
  	// se id ha un valore, allora siamo in fase di modifica 

   $str=" SELECT IDmenu,voce,ordine,link,stat FROM menuvoci where ID='$id'";
   $risultato=mysql_query($str);
   if (mysql_num_rows($risultato)>0)
   {
   	$control=mysql_fetch_row($risultato);
   }
}
?>

<div class="contenitore">
<form name="modify_menu" method="post" action="insert_menuvoci_query.php" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?=$id?>"/>
<input type="hidden" name="idm" value="<?=$control[0]?>"/>

<!-- il valore di id lo passiamo alla pagina di action con un campo nascosto -->
	<h3><?=$parola?> la Voce di Menu:
	<?
			$str2=" SELECT voce FROM menu where ID='$control[0]'";
        	$risultato2=mysql_query($str2);        
        	$var1 = mysql_fetch_row($risultato2);
        	echo " ".$var1[0];
	?>
	</h3>
	<div class="azzerafloat"></div>
	<div class="float140">Link:</div>
	<div class="float300">
	DbInterno <input type="radio" value="si" name="stat" <? if($control[4]=='si' or !$id) echo "checked";?>/>
	Esterna<input type="radio" value="no" name="stat" <? if($control[4]=='no') echo "checked";?>/>
	<br/>	
		<select name="links" size="1" tabindex="5">
     <?
     $str=" SELECT ID, titolo FROM statiche";
     $risultato=mysql_query($str);
     while($control1=mysql_fetch_row($risultato))
         {
         echo "<option value=\"$control1[0]\" ";
         if ($control[4] == 'si')
         	if ($control[3]==$control1[0]) echo "selected=\"selected\"";
         echo "> $control1[1]</option>";
         }
     ?>
     </select>
     <p>I dati successivi sono da inserire solo se non si e' scelto una pagina da db</p>
	</div>
	<div class="azzerafloat"></div>
	<div class="float140">Voce:</div>
	<div class="float300">
		<input type="text" name="arg" size="45" maxlength="50" tabindex="1" value="<?=$control[1]?>"/>
	</div>
	<div class="azzerafloat"></div>
	<div class="float140">Link:</div>
	<div class="float300">
     <input type="text" name="linkt" size="45" maxlength="255" tabindex="1" value="<?=$control[3]?>"/>	
	</div>
	<?
		
		if (!$id)
		{
			$str1=" SELECT max(ordine) FROM menuvoci where IDmenu='$control[0]'";
        	$risultato1=mysql_query($str1);        
        	$var = mysql_fetch_row($risultato1);
        	$control[2] = ++$var[0];
		}		
		?>
		<input type="hidden" name="ordine" value="<?=$control[2]?>"/>
	<div class="azzerafloat"></div>
	<input type="submit" class="medio" value="<?=$parola?>"/>
	<input type="button" class="medio" name="Annulla" value="Annulla" onclick="javascript:history.go(-1)" /> 
</form>
</div>