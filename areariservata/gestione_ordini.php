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

echo "<h3>Visualizzazione Ordine di Acquisto di ogni Articolo</h3>";


echo"<div class=\"contenitore\"><div class=\"azzerafloat\">
<div class=\"float615\">
<form class=\"acquisti\" action=\"area.php?pag=gestione_ordini.php\" method=\"post\">
	Cerca gli articoli in ordine immettendo il codice transazione: <input type=\"text\" name=\"ut\" class=\"medio\">
	<input type=\"submit\" value=\"Cerca\" class=\"medio\"> 
</form>
</div>
<div class=\"azzerafloat\"><br /></div>
 </div>";
 
$ut = $_POST["ut"];
if($ut=="")
{
$query="SELECT data, utente, nome, cognome, email, codice, id FROM carrello WHERE elimina = 2 AND email != '' ORDER BY data DESC";
$ordine= mysql_query($query);	
}
else
{	
$query="SELECT data, utente, nome, cognome, email, codice, id FROM carrello WHERE elimina = 2 AND utente = '$ut' AND email != '' ORDER BY data DESC";
$ordine= mysql_query($query);
	
}
 
echo"<div class=\"contenitore\"><div class=\"azzerafloat\"></div>";
echo "<div class=\"evidenzia\">
			<div class=\"float100\"> <b>Data</b> </div>	
			<div class=\"float200\"> <b>Transazione</b> </div>	
			<div class=\"float100\"> <b>Nome</b> </div>	
			<div class=\"float100\"> <b>Cognome</b> </div>	
			<div class=\"float100\"> <b>Codice Articolo</b> </div>				
			<br /><br />
		</div>";
while($ord=mysql_fetch_row($ordine))
{
echo "<div class=\"evidenzia\">
			<div class=\"float100\"> $ord[0] </div>	
			<div class=\"float200\"> $ord[1] </div>	
			<div class=\"float100\"> $ord[3] </div>	
			<div class=\"float100\"> $ord[2] </div>	
			<div class=\"float100\"> $ord[5] </div>				
			<div class=\"float70\"><img src=\"./img/pre.png\" class=\"ico\" /><a title=\"|Dettaglio Ordine\" href=\"area.php?pag=gestione_ordini_det.php&id=$ord[6]\">Dettaglio</a></div>					
			<br /><br />
		</div>";
		
};

echo "</div>";
echo"<br><br><div class=\"azzerafloat\"></div>";
echo "<div class=\"float160\"><img src=\"./img/ind.png\" class=\"ico\" /><a title=\"|torna indietro\" href=\"area.php?pag=elenco_ecommerce_categorie.php#fragment-4\">Indietro</a></div><br>";
echo "</div>";

?>
