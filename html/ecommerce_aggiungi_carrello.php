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

include( "../utility/headers.php" );

$maxartxcarrello = 50; //Numero massimo di articoli che si possono associare ad un carrello

$id = (int)$_GET["id"];
$agg = apici( $_GET["aggiungi"] );
$quant = apici( $_GET["quant"] );
$carrello2 = apici( $_GET["carrello2"] );

do {
	$idecom = session_id();
	$sql = "SELECT id FROM acquisti WHERE utente = '$idecom' LIMIT 1";
	$rssql = mysql_query($sql);		
	
	if ( mysql_num_rows($rssql) == 1 ) session_regenerate_id();

} while( mysql_num_rows($rssql) == 1 );


$link = ( $id == 0 ) ? rurl( 0, 'ecommerce' ) : rurl( $id, 'ecommerce-dettaglio' );

if ( $agg != "" ) {
	// controllo che lo stesso "utente" script/aggiorna pag loop non carichi troppi articoli sul carello
	$queryctl = "SELECT COUNT(*) FROM carrello WHERE utente = '$idecom' LIMIT 1";
	$queryctl = mysql_query ($queryctl);
	$ctl = mysql_fetch_row($queryctl);
	if ($ctl[0] <= $maxartxcarrello) {
		//estraggo le informazioni necessarie sull'articolo
		$query = "SELECT id, titolo, prezzo, codice, spedizione, quantita FROM ecommerce WHERE id = '$id' LIMIT 1";
		$ris = mysql_query($query);
		$prod = mysql_fetch_row($ris);
		$prezzo = $prod[2]+$prod[4];
		if ( $quant <= $prod[5] ) {
			for($i=0;$i<$quant;$i++)
			{
				$str="INSERT INTO carrello (titolo, codice, utente, prezzo, spedizione, data) VALUES ('$prod[1]', '$prod[3]', '$idecom' ,'$prod[2]', '$prod[4]', CURRENT_DATE())";
				mysql_query($str);
			}
		}
	}
}

if ( $carrello2 != '' ) $_SESSION['carrello2'] = "si";

header( "Location: $link" );

?>