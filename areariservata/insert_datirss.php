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

$parola=Modifica;

$errore=null;
$errore=$_GET["errore"];
$tipoerr=$_GET["tipoerr"];
if($errore=="si")
{
		echo "<h1><img src=\"./img/alert.png\" class=\"ico\" />$tipoerr<img src=\"./img/alert.png\" class=\"ico\" /></h1>";
}

$str=" SELECT ID,titolo,descrizione,copyright,image,vimage FROM datirss ";
$risultato=mysql_query($str);
if (mysql_num_rows($risultato)>0)
{
	$control=mysql_fetch_row($risultato);        	
}
?>

<div class="contenitore">
<form name="statiche" method="post" action="insert_datirss_query.php" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?=$control[0]?>"/>
<!-- il valore di id lo passiamo alla pagina di action con un campo nascosto -->
	<h3><?=$parola?> Modulo:</h3>
	<div class="azzerafloat"></div>
	<div class="float140">Titolo:</div>
	<div class="float500">
		<input type="text" name="titolo" size="95" maxlength="200" tabindex="1" value="<?=$control[1]?>"/>
	</div>
	<div class="azzerafloat"></div>	
	
	<div class="float140">Descrizione:</div>
	<div class="float500">
		<input type="text" name="descrizione" size="95" maxlength="200" tabindex="1" value="<?=$control[2]?>"/>
	</div>	
	<div class="azzerafloat"></div>	
		
	<div class="float140">Copyright:</div>
	<div class="float500">
		<input type="text" name="copyright" size="95" maxlength="200" tabindex="1" value="<?=$control[3]?>"/>
	</div>	
	<div class="azzerafloat"></div>	

	<div class="float140">Immagine:</div>
	<div class="float500">
		<input type="text" name="image" size="95" maxlength="200" tabindex="1" value="<?=$control[4]?>"/>
	</div>	
	<div class="azzerafloat"></div>	
	 <div class="float200">
   	
   </div>
   <div class="float500">
		<input type="radio" class="little" name="vimage" value="si" <? if ($control[5]=="si") echo "checked "; ?> tabindex="6"/> Visualizza Imagine
      <input type="radio" class="little" name="vimage" value="no" <? if ($control[5]=="no") echo "checked "; ?> tabindex="7"/> Nessuna Immagine
   </div>
   <div class="azzerafloat"></div>
	<input type="submit" class="medio" value="<?=$parola?>" tabindex="7"/>
	<input type="button"	class="medio" name="Annulla" value="Annulla" onclick="javascript:window.location='area.php'" />           
</form>
</div>
