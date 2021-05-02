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

$id = $_GET["id"];

$query="SELECT * FROM carrello WHERE id = '$id'";
$ordine= mysql_query($query);
$ord = mysql_fetch_row($ordine);
?>
<h3>Dettaglio singolo Articolo</h3>
<div class="contenitore"><div class="azzerafloat"></div>
<div class="float100"> <h5>Nome:</h5></div>
<div class="float200"> <?echo "$ord[8]"?></div>
<div class="float100"> <h5>Cognome:</h5> </div>
<div class="float300"> <?echo "$ord[7]"?></div>
<div class="float100"> <h5>Data acquisto:</h5></div>
<div class="float100"> <?echo "$ord[6]"?></div>
<div class="azzerafloat"><br /></div>
<div class="float100"> <h5>E-mail:</h5></div>
<div class="float230">  <?echo "$ord[9]"?></div>
<div class="azzerafloat"><br /></div>
<div class="float100"> <h5>Indirizzo: </h5></div>
<div class="float200"> <?echo "$ord[10]"?></div>
<div class="float70"> <h5>CAP: </h5></div>
<div class="float140"> <?echo "$ord[11]"?></div>
<div class="float100"> <h5>Citta:</h5> </div>
<div class="float160"> <?echo "$ord[12]"?></div>
<div class="azzerafloat"><br /></div>
<div class="float100"> <h5>Articolo:</h5></div>
<div class="float615"> <?echo "$ord[1]"?></div><br /><br />
<div class="float100"> <h5>Codice Articolo:</h5></div>
<div class="float615"> <?echo "$ord[2]"?></div>
<div class="float100"> <h5>Importo:</h5></div>
<div class="float100">  <?echo "$ord[13]"?> &euro;</div>
<div class="azzerafloat"><br /></div>
<div class="float100"> <h5>Transazione:</h5></div>
<div class="float200">  <?echo "$ord[3]"?></div>
<div class="azzerafloat"><br /></div>
</div><br>
<div class="contenitore"><div class="azzerafloat"></div>
<div class="float70"><img src="./img/ind.png" class="ico" /><a title="|Torna Indietro" href="area.php?pag=gestione_ordini.php">Indietro</a></div>
<br>					
</div>
