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
	$str="UPDATE parametri Set valore = './html/ecommerce.php' WHERE nomecampo='_CORPO' AND sezione = 0";
	$risultato=mysql_query($str);
	
	if (!$risultato)
   // controllo se la query di inserimento è andata a buon fine
   {
      	echo "ERRORE: Modifica PAGINA INIZIALE non andato a Buon Fine";         
   }
   else
	{	
		$lingua_statica = strtoupper( $_POST['lingua'] );
		$str="UPDATE parametri SET valore = '".apici($_POST["op"])."' WHERE nomecampo = '_ECOMMERCEDB_$lingua_statica' AND sezione = 6 LIMIT 1";
		$risultato=mysql_query($str);

		if (!$risultato)
			echo "ERRORE: Modifica PARAMETRI ecommerce non andato a Buon Fine"; //controllo se la query di inserimento è andata a buon fine
	   else
	   {
			include_once ("genera_param_query.php"); 
			echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=conferma.php&from=insert_pagdef.php\" />";
	   }
	}
   exit;
}

?>

	<br />
	<hr />
	<form name="modify_pagdef2" method="post" action="./area.php?pag=insert_pagdef.php">
		<div>
			Selezionare La lingua dove visualizzare la homepage:
			<select name="lingua">
			<?php
				$sql = "SELECT sigla, lingua FROM lingue WHERE attiva = 1";
				$rssql = mysql_query( $sql );
				while( $r = mysql_fetch_array( $rssql ) ){
					if ( isset( $_POST['lingua'] ) AND $_POST['lingua'] == $r[0] )
						echo "<option value=\"$r[0]\" selected=\"selected\">$r[1]</option>";
					else	
						echo "<option value=\"$r[0]\">$r[1]</option>";
				}
			?>
			</select>
		</div>	
		
		<input class="medio" type="submit" name="selezione_lingua" value="<?=$parola?>"/>
		<?=$annulla?>
		
		<input type="hidden" name="selezione" value="<?=$_POST['selezione']?>" />
		<input type="hidden" name="default" value="<?=$_POST['default']?>" />
		
	</form>
	
<?php if ( isset( $_POST['lingua'] ) ) { ?>	
	<hr/>
	<form name="modify_pagdef6" method="post" action="./area.php?pag=sel_pagdef6.php">
	<div>
		- Seleziona una categoria dell'e-commerce da visualizzare come homepage<br/>	
		<br />
		<?php
			$sql = "
				SELECT e.id, e.categoria 
				FROM ecommercecategoria e 
				INNER JOIN lingue l ON e.id_lingua = l.id 
				WHERE l.sigla = '$_POST[lingua]' 
				ORDER BY e.categoria
			";
			$rssql = mysql_query($sql);
			if (mysql_num_rows($rssql)>0)
			{	
				echo "<input class=\"little\" type=\"submit\" name=\"op\" value=\"0\"/> Tutte<br/>";		
				while($controllo=mysql_fetch_row($rssql))
				{
					echo "<input class=\"little\" type=\"submit\" name=\"op\" value=\"$controllo[0]\"/> $controllo[1]<br/>";		
				}
			}
			else
				echo "<p>Tabella vuota</p>";
		?>
		
		<input type="hidden" name="lingua" value="<?=$_POST['lingua']?>" />
	</div><br />	
		<?=$annulla?>
	</form>
<?php } ?>
