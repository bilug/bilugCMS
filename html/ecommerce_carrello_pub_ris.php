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
$maxartxcarrello = 50; //Numero massimo di articoli che si possono associare ad un carrello

$id=$_GET["id"];
$idc=$_GET["idc"];
$agg=$_GET["aggiungi"];
$delete=$_GET["delete"];
$quant=$_GET["quant"];
$idecom=session_id();
$carrello=$_POST["carrello"];

$data = date("Y-m-d");

if($carrello=="")
{
	//aggiungo merce al carrello
	if($agg!="")
	{
		// controllo che lo stesso "utente" script/aggiorna pag loop non carichi troppi articoli sul carello
		$queryctl = "SELECT COUNT(*) FROM carrello WHERE utente = '$idecom' LIMIT 1";
		$queryctl = mysql_query ($queryctl);
		$ctl = mysql_fetch_row($queryctl);
		if ($ctl[0] <= $maxartxcarrello)
			{
			//estraggo le informazioni necessarie sull'articolo
			$query = "SELECT id, titolo, prezzo, codice, spedizione, quantita FROM ecommerce WHERE id = '$id' LIMIT 1";
			$ris = mysql_query($query);
			$prod = mysql_fetch_row($ris);
			$prezzo = $prod[2]+$prod[4];
			if ($quant <= $prod[5])
			{
				for($i=0;$i<$quant;$i++)
				{
					$str="INSERT INTO carrello (titolo, codice, utente, prezzo, spedizione, data) VALUES ('$prod[1]', '$prod[3]', '$idecom' ,'$prod[2]', '$prod[4]', '$data')";
					// query di inserimento	
					$risultato = mysql_query($str);
				}
			}
		}
	}
	if($delete!="")
	{
		$str="DELETE FROM carrello WHERE id='$idc' AND utente = '$idecom' LIMIT 1";
		$risultato=mysql_query($str);
	}
}






//estraggo merce carrello e la visualizzo
$query="SELECT id, titolo, codice, prezzo, spedizione FROM carrello WHERE utente = '$idecom'";
$ris=mysql_query($query);

$tot=0;
$spedizione=0;
	
if ( mysql_num_rows( $ris ) > 0 ) {	
	while($merce=mysql_fetch_row($ris))
	{$merce[1] = substr( $merce[1], 0, 10 );
		$prezzo1=$merce[3];
		$prezzo=number_format($prezzo1, 2, ',', '.');
		echo "<div class=\"riga\">";
			echo "<div class=\"col1\">$merce[1]</div>";
			echo "<div class=\"col2\">
				$prezzo &euro;&nbsp;&nbsp;
				<a href=\""._URLSITO."/index.php?pag=ecommerce_dettaglio_carrello.php&id=$id&idc=$merce[0]&delete=$merce[0]\" class=\"linkico\">
					<img src=\""._URLSITO."/img/cestino.gif\" class=\"linkico\">
				</a>		
			</div>";
			echo "<div class=\"azzerafloat\"></div>";
		echo "</div>";
		
		$spedizione += $merce[4];
		$tot += $merce[3] + $merce[4];
	}
	
	$spedizione = number_format($spedizione, 2, ',', '.');
	$tot = number_format($tot, 2, ',', '.');
	
	echo "<div class=\"azzerafloat\"></div><hr />";
	echo "
		<div class=\"riga\">
			<div class=\"col1\">Spedizione</div>
			<div class=\"col2\">$spedizione &euro;</div>
			<div class=\"azzerafloat\"></div>
		</div>
		<div class=\"riga\">
			<div class=\"col1\">Totale</div>
			<div class=\"col2\">$tot &euro;</div>
			<div class=\"azzerafloat\"></div>
		</div>
		<hr />
	";
	
}
else {
	echo "<div class=\"col1\">Nessun prodotto</div>";
	echo "<div class=\"azzerafloat\"></div><hr />";
	echo "
		<div class=\"col1\">Spedizione</div>
		<div class=\"col2\">0,00&euro;</div>
		<div class=\"azzerafloat\"></div>
		<div class=\"col1\">Totale</div>
		<div class=\"col2\">0,00&euro;</div>
		<div class=\"azzerafloat\"></div><hr />
	";
}	



?>


