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
	$str="UPDATE parametri Set valore = '../html/mese_eventoapp.php' where nomecampo='_CORPO' and  sezione = 0";
	$risultato=mysql_query($str);
	if (!$risultato)
   // controllo se la query di inserimento è andata a buon fine
   {
      	echo "ERRORE: Modifica PAGINA INIZIALE non andato a Buon Fine";         
   }
   else
   {
		$str="UPDATE parametri Set valore = ".$_POST["_MESE"]." where nomecampo='_MESE' and  sezione = 4";
		$risultato=mysql_query($str);
		if (!$risultato)
   	// controllo se la query di inserimento è andata a buon fine
   	{
      		echo "ERRORE: Modifica PARAMETRI EVENTI non andato a Buon Fine";         
   	}
   	else
   	{
   		$str="UPDATE parametri Set valore = ".$_POST["_ANNO"]." where nomecampo='_ANNO' and  sezione = 4";
			$risultato=mysql_query($str);
			if (!$risultato)
   		// controllo se la query di inserimento è andata a buon fine
   		{
      			echo "ERRORE: Modifica PARAMETRI EVENTI non andato a Buon Fine";         
   		}
   		else
   		{
   			include_once ("genera_param_query.php"); 
      		//Header("Location: area.php?pag=insert_pagdef.php");
			echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=conferma.php&from=insert_pagdef.php\" />";
      	}
      }      	
   }
   exit;
}
else
{
	$str="SELECT nomecampo,valore FROM  parametri WHERE sezione = 4";
	$risultato=mysql_query($str);
   if (mysql_num_rows($risultato)>0)
	{
		while ($controllo=mysql_fetch_row($risultato))
		{
			if ($controllo[0]=="_MESE") $cont[0]=$controllo[1];
			if ($controllo[0]=="_ANNO") $cont[1]=$controllo[1];
		}
	}
}
?>
<hr/>
<form name="modify_pagdef2" method="post" action="./area.php?pag=sel_pagdef2.php">
<div>
	- Pagina con Eventi/Appuntamenti fissi ad un mese e/o anno arbitrario o legaro al mese in cui si attiva il sito<br/>
	<br/>
	Mese da visualizzare (0 per automatico): <input type="text" name="_MESE" size="95" maxlength="254" value="<?=$cont[0]?>"/><br/>
	Anno da visualizzare (0 per automatico): <input type="text" name="_ANNO" size="95" maxlength="254" value="<?=$cont[1]?>"/>
</div>	
	<input class="medio" type="submit" name="op" value="<?=$parola?>"/>
	<?=$annulla?>
</form>
