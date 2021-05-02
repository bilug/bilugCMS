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
	$str = "UPDATE parametri SET valore = 'corpo.php' WHERE nomecampo='_CORPO' AND sezione = 0 LIMIT 1";
	$risultato = mysql_query($str);
	if (!$risultato)
   // controllo se la query di inserimento è andata a buon fine
   {
      	echo "ERRORE: Modifica PAGINA INIZIALE non andato a Buon Fine";         
   }
   else
   {
		$str="UPDATE parametri SET valore = ".$_POST["_MAX_LAST_ARG"]." WHERE nomecampo = '_MAX_LAST_ARG' AND sezione = 1 LIMIT 1";
		$risultato=mysql_query($str);
		if (!$risultato)
		// controllo se la query di inserimento è andata a buon fine
			echo "ERRORE: Modifica PARAMETRI Notizie non andato a Buon Fine";         
		else
		{
			include_once ("genera_param_query.php"); 
			echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=conferma.php&from=insert_pagdef.php\" />";
		}      	
   }
   exit;
}
else
{
	$str="SELECT valore FROM parametri WHERE nomecampo = '_MAX_LAST_ARG' AND sezione = 1 LIMIT 1";
	$risultato=mysql_query($str);
	if (mysql_num_rows($risultato)>0)
		$controllo=mysql_fetch_row($risultato);
}
?>
<hr/>
<form name="modify_pagdef0" method="post" action="./area.php?pag=sel_pagdef0.php">
<div>
	- Pagina Iniziale classica con 1 notizia in evidenza (ultima inserita o una selezionata)<br/>
	- Numero Arbitrario di ultime notizie inserite da visualizzare<br/><br/>
	Num. massimo di notizie precedenti: <input type="text" name="_MAX_LAST_ARG" size="95" maxlength="254" value="<?=$controllo[0]?>"/>
</div>	
	<input class="medio" type="submit" name="op" value="<?=$parola?>"/>
	<?=$annulla?>
</form>
