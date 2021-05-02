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

$idut = $_GET["idut"];

$query="SELECT * FROM carrello WHERE elimina = 2 AND utente = '$idut'";
$ordine2= mysql_query($query);
$dati = mysql_fetch_row($ordine2);
?>
<h3>Dati Ordine di Acquisto</h3>
<div class="contenitore"><div class="azzerafloat"></div>
<div class="float100"> <h5>Nome:</h5></div>
<div class="float200"> <?echo "$dati[8]"?></div>
<div class="float100"> <h5>Cognome:</h5> </div>
<div class="float300"> <?echo "$dati[7]"?></div>
<div class="float100"> <h5>Data acquisto:</h5></div>
<div class="float100"> <?echo "$dati[6]"?></div>
<div class="azzerafloat"><br /></div>
<div class="float100"> <h5>E-mail:</h5></div>
<div class="float230">  <?echo "$dati[9]"?></div>
<div class="azzerafloat"><br /></div>
<div class="float100"> <h5>Indirizzo: </h5></div>
<div class="float200"> <?echo "$dati[10]"?></div>
<div class="float70"> <h5>CAP: </h5></div>
<div class="float140"> <?echo "$dati[11]"?></div>
<div class="float100"> <h5>Citta:</h5> </div>
<div class="float160"> <?echo "$dati[12]"?></div>
<div class="azzerafloat"><br /></div>
<div class="float100"> <h5>Transazione:</h5></div>
<div class="float200">  <?echo "$dati[3]"?></div>
<div class="float100"> <h5>Importo Totale:</h5></div>
<div class="float100">  <?echo "$dati[13]"?> &euro;</div>
<div class="azzerafloat"><br /></div>
</div><br>

<?
echo "<h3>Dettaglio di tutti gli articoli della transazione</h3><div class=\"contenitore\">";
$c = 0;
$ordine= mysql_query($query);
while($ord=mysql_fetch_row($ordine))
{
	$c++;
?>
<div class="azzerafloat"><br /></div>
<div class="float100"> <h5>Articolo <? echo $c; ?>:</h5></div>
<div class="float400"> <?echo "$ord[1]"?></div>
<div class="float100"> <h5>Codice Articolo:</h5></div>
<div class="float100"> <?echo "$ord[2]"?></div>


<?
}
?>
<div class="azzerafloat"></div><br /><br />
<div class="float70"><img src="./img/ind.png" class="ico" /><a title="|Torna Indietro" href="area.php?pag=gestione_transazioni.php">Indietro</a></div>
<br>					
</div>
