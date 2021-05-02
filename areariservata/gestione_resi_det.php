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

$id = $_GET["utente"];

$query="SELECT utente, cognome, nome, mail, data, indirizzo, citta, cap, id, importo, spedizione FROM acquisti WHERE reso = 1 AND utente = '$id'";
$utente= mysql_query($query);
$utente = mysql_fetch_row($utente);

$reso_tot = $utente[9] - $utente[10];

?>
<h3>Dati Cliente</h3>
<div class="contenitore"><div class="azzerafloat"></div>
<div class="float100"> <h5>Nome:</h5></div>
<div class="float200"> <?echo "$utente[1]"?></div>
<div class="float100"> <h5>Cognome:</h5> </div>
<div class="float300"> <?echo "$utente[2]"?></div>
<div class="float100"> <h5>Data acquisto:</h5></div>
<div class="float100"> <?echo "$utente[4]"?></div>
<div class="azzerafloat"><br /></div>
<div class="float100"> <h5>E-mail:</h5></div>
<div class="float230">  <?echo "$utente[3]"?></div>
<div class="azzerafloat"><br /></div>
<div class="float100"> <h5>Indirizzo: </h5></div>
<div class="float200"> <?echo "$utente[5]"?></div>
<div class="float70"> <h5>CAP: </h5></div>
<div class="float140"> <?echo "$utente[7]"?></div>
<div class="float100"> <h5>Citta:</h5> </div>
<div class="float160"> <?echo "$utente[6]"?></div>
<div class="azzerafloat"><br /></div>
<div class="float100"> <h5>Transazione:</h5></div>
<div class="float200"> <?echo "$utente[0]"?></div>
<div class="float100"> <h5>Reso Totale:</h5></div>
<div class="float100">  <?echo "$reso_tot"?> &euro;</div>
<div class="azzerafloat"><br /></div>
</div><br>
<h3>Articoli Acquistati</h3>
<div class="contenitore">
<h4>Articoli acquistati</h4>
<?php
$query="SELECT articolo, codice, prezzo FROM acquisti WHERE utente = '$id'";
$acquisto= mysql_query($query);
while ( $acq = mysql_fetch_row($acquisto) ) {
	echo "<div class=\"azzerafloat\"><br /></div>";
	echo "<div class=\"float160\"><strong>Articolo:</strong></div>";
	echo "<div class=\"float400\">$acq[0] ($acq[1]) &gt;&gt; $acq[2] &euro;</div>";
}
?>
<div class="azzerafloat"></div><br /><br />

<?php
$query="SELECT articolo, codice, prezzo FROM acquisti WHERE reso > 0 AND utente = '$id'";
$acquisto= mysql_query($query);
if ( mysql_num_rows($acquisto) > 0 ) { ?>
	<h4>Articoli resi</h4> <?php
	while ( $acq = mysql_fetch_row($acquisto) ) {
		echo "<div class=\"azzerafloat\"><br /></div>";
		echo "<div class=\"float160\"><strong>Articolo:</strong></div>";
		echo "<div class=\"float400\">$acq[0] ($acq[1]) &gt;&gt; -$acq[2] &euro;</div>";
	}
}
?>
<div class="azzerafloat"></div><br /><br />
<div class="float70"><img src="./img/ind.png" class="ico" /><a title="|Torna Indietro" href="area.php?pag=gestione_resi.php">Indietro</a></div>
<br>					
</div>
