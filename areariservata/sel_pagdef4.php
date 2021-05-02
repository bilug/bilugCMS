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
	$str="UPDATE parametri Set valore = '../html/sondaggio.php' where nomecampo='_CORPO' and  sezione = 0";
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
<form name="modify_pagdef4" method="post" action="./area.php?pag=sel_pagdef4.php">
<div>
	- Conferma il  Sondaggio attivo da visualizzare come homepage<br/>	
	<br/>	
	<?
	$str=" SELECT ID,titolo,DATE_FORMAT(data,'%d-%m-%Y'),multipli FROM sondaggi where attivo='si' and utenti='no' ORDER BY data";
	$risultato=mysql_query($str);
	if (mysql_num_rows($risultato)>0)
	{
		while($controllo=mysql_fetch_row($risultato))
		{
			echo "<input class=\"little\" type=\"submit\" name=\"op\" value=\"$controllo[0]\"/> $controllo[1] inserito il $controllo[2] Multiplo?($controllo[3])<br/>";
					
		}
	}
	else
 		echo "<p>Tabella vuota</p>";
 	?>
</div>	
	
	<?=$annulla?>
</form>
