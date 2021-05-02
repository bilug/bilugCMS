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
<div class="contenitore"><div class="azzerafloat"></div>
<h3>Gestione degli utenti/carrelli del modulo Ecommerce riservato</h3>
<?

$str=" SELECT * FROM ecommerceris ORDER BY data";
// facciamo una query per caricare tutti i dati della tabella
$risultato=mysql_query($str);
if (mysql_num_rows($risultato)>0)
{
   //se abbiamo un risultato dalla query costruiamo la tabella
   while($control=mysql_fetch_row($risultato))
   // ciclo per cui finchè abbiamo risultati ci costruisce una riga alla volta
   {
      $anno=substr($control[4],0,4);
      $mese=substr($control[4],5,2);
      $giorno=substr($control[4],8,2);
      $datait="$giorno"."-"."$mese"."-"."$anno";
      // con le 4 righe sopra convertiamo la data da americana in italiana
	if($control[2]=="")
    //se trovo una variabile non obbligatoria vuota la inizializzo a &nbsp; -> solo per validare il div	
	{
			$control[2]= "&nbsp;";
	}
	  echo "<div class=\"evidenzia\">
      <div class=\"float20\">$control[0]</div> <!-- id -->
      <div class=\"float100\">$control[1]</div> <!-- nome -->
      <div class=\"float230\">$control[2]</div> <!-- note -->
      <div class=\"float70\">$control[3]</div> <!-- pwd -->
      <div class=\"float70\">$datait</div> <!-- data -->
      <div class=\"float70\"><img src=\"./img/del.png\" class=\"ico\" /><a title=\"|Elimina L'Utente\" href=\"area.php?pag=delete.php&id=$control[0]&from=elenco_utenti_ecommerce.php\">Elimina</a></div>
      <!-- Assegnamo all'id il valore che otteniamo con la query -->
      <div class=\"float70\"><img src=\"./img/mod.png\" class=\"ico\" /><a title=\"|Modifica L'Utente\" href=\"area.php?pag=insert_utenti_ecommerce.php&amp;id=$control[0]\">Modifica</a></div>
      <div class=\"float100\"><img src=\"./img/ind.png\" class=\"ico\" /><a title=\"|Associa gli articoli\" href=\"area.php?pag=associa_articoli.php&amp;id=$control[0]\">Associa articoli</a></div>
      <div class=\"azzerafloat\"></div></div>";
	}
echo "</div>";
}
else 
{
	//	echo "<p>Tabella vuota</p>";
	echo "<a href=\"area.php?pag=insert_utenti_ecommerce.php\">Inserisci il primo Utente E-commerce</a>";

}
?>
