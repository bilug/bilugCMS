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

echo "<h3>Gestione Transazioni</h3>";
$disp=$_GET["disp"];
if($disp=="no")
{
echo "<h1><img src=\"./img/alert.png\" class=\"ico\"> ATTENZIONE: UNO O PIU' PRODOTTI NON SONO DISPONIBILI <img src=\"./img/alert.png\" class=\"ico\"></h1>";	
} 

echo"<div class=\"contenitore\"><div class=\"azzerafloat\">
<div class=\"float615\">
<form class=\"acquisti\" action=\"area.php?pag=gestione_transazioni.php\" method=\"post\">
	Cerca una transazione specifica: <input type=\"text\" name=\"ut\" class=\"medio\">
	<input type=\"submit\" value=\"Cerca\" class=\"medio\"> 
</form>
</div>
<div class=\"azzerafloat\"><br /></div>
 </div>";
 
$ut = $_POST["ut"];
if($ut=="")
{
$query="SELECT data, utente, nome, cognome, email, codice, id FROM carrello WHERE elimina = 2 AND email != '' ORDER BY id DESC";
$ordine= mysql_query($query);	
}
else
{	
$query="SELECT data, utente, nome, cognome, email, codice, id FROM carrello WHERE elimina = 2 AND utente = '$ut' AND email != '' ORDER BY id DESC";
$ordine= mysql_query($query);
	
}

 
echo"<div class=\"contenitore\"><div class=\"azzerafloat\"></div>";
echo "<div class=\"evidenzia\">
			<div class=\"float100\"> <b>Data</b> </div>	
			<div class=\"float200\"> <b>Transazione</b> </div>
			<br /><br />
		</div>";
while($ord=mysql_fetch_row($ordine))
{
if ($trans != $ord[1])
{	
echo "<div class=\"evidenzia\">
			<div class=\"float100\"> $ord[0] </div>	
			<div class=\"float200\"> $ord[1] </div>	
			<div class=\"float100\"><img src=\"./img/pre.png\" class=\"ico\" /><a title=\"|Dettaglio Transazione\" href=\"area.php?pag=gestione_transazioni_det.php&idut=$ord[1]\">Vedi Articoli</a></div>	
			<div class=\"float200\"><img src=\"./img/apply.png\" class=\"ico\" /><a title=\"|Conferma pagamento Transazione\" href=\"area.php?pag=gestione_acquisti_inserisci.php&idut=$ord[1]\">Conferma pagamento Transazione</a></div>				
			<div class=\"float200\"><img src=\"./img/del.png\" class=\"ico\" /><a title=\"|Cancella Transazione\" href=\"area.php?pag=gestione_acquisti_inserisci.php&idut=$ord[1]&canc=si\">Cancella Transazione non saldata</a></div>				
			<div class=\"azzerafloat\"></div>
			<br /><br />
		</div>";
}		
$trans = $ord[1];		
};

echo "</div>";
echo"<br><br><div class=\"azzerafloat\"></div>";
echo "<div class=\"float160\"><img src=\"./img/ind.png\" class=\"ico\" /><a title=\"|torna indietro\" href=\"area.php?pag=elenco_ecommerce_categorie.php#fragment-4\">Indietro</a></div><br>";
echo "</div>";

?>
