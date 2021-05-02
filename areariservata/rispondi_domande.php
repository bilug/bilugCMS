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

$str=" SELECT * FROM esperto WHERE pubblicare='NO' order by id";
// facciamo una query per caricare tutti i dati della tabella
$risultato=mysql_query($str);
if (mysql_num_rows($risultato)>0)
{
	echo "<TABLE>";
   //se abbiamo un risultato dalla query costruiamo la tabella
   while($control=mysql_fetch_row($risultato))
   // ciclo per cui finchè abbiamo risultati ci costruisce una riga alla volta
   {
   	$anno=substr($control[5],0,4);
      $mese=substr($control[5],5,2);
      $giorno=substr($control[5],8,2);
      $datait="$giorno"."-"."$mese"."-"."$anno";
      // con le 4 righe sopra convertiamo la data da americana in italiana
      // substr è una funzione che serve a selezionare parte di una stringa

      echo "<TR>
      <TD width=\"20\">$control[0]</TD> <!-- id -->
      <TD width=\"500\">$control[1]</TD> <!-- domanda -->
      <TD width=\"100\">$datait</TD> <!-- data -->
      <TD width=\"50\"><a href=\"del_domanda.php?id=$control[0]\">Elimina</a></TD>
      <!-- Assegnamo all'id il valore che otteniamo con la query -->
      <TD width=\"50\"><a href=\"area.php?pag=insert_domanda.php&id=$control[0]\">Rispondi</a></TD>
      </TR>";
	}
   echo "</TABLE>";
}
else 
	echo "Tabella vuota";
?>