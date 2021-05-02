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

switch( $lingua_query ) {
	case 'it':
		$ECOMMERCE_SPEDIZIONELINGUA = 'Spedizione:';
		$ECOMMERCE_TOTALELINGUA = 'Totale:';
	break;
	case 'en':
		$ECOMMERCE_SPEDIZIONELINGUA = 'Shipping:';
		$ECOMMERCE_TOTALELINGUA = 'Total:';
	break;
	case 'fr':
		$ECOMMERCE_SPEDIZIONELINGUA = 'Livraison:';
		$ECOMMERCE_TOTALELINGUA = 'Totale:';
	break;
	case 'de':
		$ECOMMERCE_SPEDIZIONELINGUA = 'Schifffahrt:';
		$ECOMMERCE_TOTALELINGUA = 'Insgesamt:';
	break;
	case 'es':
		$ECOMMERCE_SPEDIZIONELINGUA = 'Env&aacute;o:';
		$ECOMMERCE_TOTALELINGUA = 'Total:';
	break;
	case 'pt':
		$ECOMMERCE_SPEDIZIONELINGUA = 'Expedi&ccedil;&atilde;o:';
		$ECOMMERCE_TOTALELINGUA = 'Total:';
	break;
}


$id = (int)$_GET["id"];
$idc = (int)$_GET["idc"];
$quant = (int)$_GET["quant"];
$idecom = session_id();
$carrello = apici( $_POST["carrello"] );

$data = date("Y-m-d");


$tot=0;
$spedizione=0;

while($merce=mysql_fetch_row($ris)) {
	$titolo_ec = substr( $merce[1], 0, 20 );
	$prezzo1 = $merce[3];
	$prezzo = number_format($prezzo1, 2, ',', '.');
	$link1 = rurl( $merce[5], 'ecommerce-dettaglio' );
	$link2 = rurl( 0, 'ecommerce-cancella-carrello' ) . "$id/$merce[0]/$merce[0]/";
	
	echo "<div class=\"riga\">";
		echo "<div class=\"col1\"><a title=\"$merce[1]\" href=\"$link1\">$titolo_ec</a></div>";
		echo "<div class=\"col2\">
			<a href=\"$link2\" class=\"linkico\">
				<img src=\""._URLSITO."/img/cestino.gif\" class=\"linkico\">
			</a>		
		</div>";
		echo "<div class=\"col2\">$prezzo &euro;&nbsp;&nbsp;</div>";
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
		<div class=\"col1\">$ECOMMERCE_SPEDIZIONELINGUA</div>
		<div class=\"col2\">$spedizione &euro;</div>
		<div class=\"azzerafloat\"></div>
	</div>
	<div class=\"riga\">
		<div class=\"col1\">$ECOMMERCE_TOTALELINGUA</div>
		<div class=\"col2\">$tot &euro;</div>
		<div class=\"azzerafloat\"></div>
	</div>
	<hr />
";


?>



