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

echo "<h3>Visualizzazione Articoli resi</h3>";

$disp=$_GET["disp"];
echo"<div class=\"contenitore\"><div class=\"azzerafloat\">
<div class=\"float70\"> &nbsp; </div>
<div class=\"float400\">
<form class=\"acquisti\" action=\"area.php?pag=gestione_acquisti.php\" method=\"post\">
	Cerca codice: <input type=\"text\" name=\"ut\" class=\"medio\">
	<input type=\"submit\" value=\"Cerca\" class=\"medio\"> 
</form>
</div>
<div class=\"azzerafloat\"><br><br></div>
 </div>";
 
if($disp=="no")
{
echo "<h1><img src=\"./img/alert.png\" class=\"ico\"> ATTENZIONE DISPONIBILITA' PRODOTTO $acq[1] GIA' A ZERO <img src=\"./img/alert.png\" class=\"ico\"></h1>";	
} 
 
$ut = $_POST["ut"];
if($ut=="")
{
$query="SELECT utente, cognome, nome, mail, data, id, importo FROM acquisti WHERE reso = 1 GROUP BY utente ORDER BY data DESC";
$acquisto= mysql_query($query);	
}
else
{	
$query="SELECT utente, cognome, nome, mail, data, id FROM acquisti WHERE utente = '$ut' GROUP BY utente ORDER BY data DESC";
$acquisto= mysql_query($query);
	
}
 
echo"<div class=\"contenitore\"><div class=\"azzerafloat\"></div>";
while($acq=mysql_fetch_row($acquisto))
{
echo "<div class=\"evidenzia\">
			<div class=\"float100\"> $acq[4] </div>	
			<div class=\"float160\"> $acq[0] </div>	
			<div class=\"float100\"> $acq[1] </div>	
			<div class=\"float160\"> $acq[3] </div>		
			<div class=\"float100\"><img src=\"./img/pre.png\" class=\"ico\" /><a title=\"|Dettagli Resi\" href=\"area.php?pag=gestione_resi_det.php&utente=$acq[0]\">Dettaglio Resi</a></div>					
			<div class=\"float160\"><img src=\"./img/apply.png\" class=\"ico\" /><a title=\"|Conferma Reso\" href=\"area.php?pag=gestione_resi_inserisci.php&idut=$acq[0]&canc=\">Conferma Reso</a></div>				
			<div class=\"float120\"><img src=\"./img/del.png\" class=\"ico\" /><a title=\"|Cancella Reso\" href=\"area.php?pag=gestione_resi_inserisci.php&idut=$acq[0]&canc=si\">Cancella Reso</a></div>				
			<br><br>
		</div>";
		
};

echo "</div>";
echo"<br><br><div class=\"azzerafloat\"></div>";
echo "<div class=\"float160\"><img src=\"./img/ind.png\" class=\"ico\" /><a title=\"|torna indietro\" href=\"area.php?pag=elenco_ecommerce_categorie.php#fragment-4\">Indietro</a></div><br>";
echo "</div>";

?>
