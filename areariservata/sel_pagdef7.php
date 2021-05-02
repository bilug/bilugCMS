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
if (isset($_POST["op"]))
{
	$str="UPDATE parametri Set valore = 'vetrina_".$_POST['vetrina'].".php' where nomecampo='_CORPO' and  sezione = 0";
	$risultato=mysql_query($str);
	if (!$risultato)
   // controllo se la query di inserimento è andata a buon fine
   {
      	echo "ERRORE: Modifica PAGINA INIZIALE non andato a Buon Fine";         
   }
   else
   {
		include_once ("genera_param_query.php"); 
		echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=conferma.php&from=insert_pagdef.php\" />";
   }
   exit;
}

?>
<hr/>
<form name="modify_pagdef7" method="post" action="./area.php?pag=sel_pagdef7.php">
<div><br />
	<select name="vetrina">
		<option value="standard">Standard</option>
	</select>
</div><br />	
	<input class="medio" type="submit" name="op" value="<?=$parola?>"/>
	<?=$annulla?>
</form>

