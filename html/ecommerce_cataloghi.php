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
		$ECOMMERCE_COLORELINGUA = 'Colore:';
		$ECOMMERCE_PRODUTTORELINGUA = 'Produttore:';
		$ECOMMERCE_TAGLIALINGUA = 'Taglia:';
		$ECOMMERCE_TUTTILINGUA = 'Tutti';
		$ECOMMERCE_LEGGITUTTOLINGUA = 'Leggi tutto';
	break;
	case 'en':
		$ECOMMERCE_COLORELINGUA = 'Color:';
		$ECOMMERCE_PRODUTTORELINGUA = 'Producer:';
		$ECOMMERCE_TAGLIALINGUA = 'Size:';
		$ECOMMERCE_TUTTILINGUA = 'All';
		$ECOMMERCE_LEGGITUTTOLINGUA = 'Read more';
	break;
	case 'fr':
		$ECOMMERCE_COLORELINGUA = 'Couleur:';
		$ECOMMERCE_PRODUTTORELINGUA = 'Fabricant:';
		$ECOMMERCE_TAGLIALINGUA = 'Taille:';
		$ECOMMERCE_TUTTILINGUA = 'Tout';
		$ECOMMERCE_LEGGITUTTOLINGUA = 'En savoir plus';
	break;
	case 'de':
		$ECOMMERCE_COLORELINGUA = 'Farbe:';
		$ECOMMERCE_PRODUTTORELINGUA = 'Hersteller:';
		$ECOMMERCE_TAGLIALINGUA = 'Größe:';
		$ECOMMERCE_TUTTILINGUA = 'Jeder';
		$ECOMMERCE_LEGGITUTTOLINGUA = 'Lesen Sie mehr';
	break;
	case 'es':
		$ECOMMERCE_COLORELINGUA = 'Color:';
		$ECOMMERCE_PRODUTTORELINGUA = 'Fabricante:';
		$ECOMMERCE_TAGLIALINGUA = 'Tamaño:';
		$ECOMMERCE_TUTTILINGUA = 'Todo';
		$ECOMMERCE_LEGGITUTTOLINGUA = 'Leer más';
	break;
	case 'pt':
		$ECOMMERCE_COLORELINGUA = 'Cor:';
		$ECOMMERCE_PRODUTTORELINGUA = 'Fabricante:';
		$ECOMMERCE_TAGLIALINGUA = 'Tamanho:';
		$ECOMMERCE_TUTTILINGUA = 'Todo';
		$ECOMMERCE_LEGGITUTTOLINGUA = 'Leia mais';
	break;
}
?>
<script type="text/javascript">
	
	function link_produttore( produttore, link ) {
		if ( produttore != '-' && produttore != '' )
			window.location = link + 'produttore-' + produttore + '/';
		else
			window.location = link;
	}
	
</script>



<?php

$cat = (int)$_GET["categoria"];
$prod = ( isset( $_GET["prod"] ) ) ? $_GET["prod"] : '';
$prod = str_replace( '-', ' ', $prod );
$ind = (int)$_GET["ind"];

$ris = $_GET["ris"];

// controllo se la sessione e riservata o meno...
if ( @$ris == 'no' ) $_SESSION['riservato'] = 'no';

// Numero di articoli da visualizzare per ogni pagina
$page=10;

$pos = ( $ind == "" ) ? 0 : $ind;

if ( $cat > 0 ) {
	$sql = "SELECT categoria FROM ecommercecategoria WHERE id = $cat AND id_lingua = $id_lingua LIMIT 1";
	$rssql = mysql_query( $sql );
	$h_cat = mysql_result( $rssql, 0, 0 );
	
	$v_id_cat = '';
	id_categorie_ecommerce( $cat, $v_id_cat );
	$v_id_cat .= ",$cat";
	
	$categorie = substr( $v_id_cat, 1 );
	
	$ric_cat = " AND e.categoria IN ( $categorie ) ";
}

$ric_prod = ( isset( $prod ) AND $prod != "" ) ? " AND e.produttore = '$prod' " : "";

$select = "e.id, e.titolo, e.prezzo, e.foto, e.spedizione, e.quantita, e.prezzo_intero, e.colore, e.taglia, e.riservato, e.schedatecnica, e.disponibile";
		
if( !isset( $_POST['cerca'] ) ) {	//query di estrazione articoli -> se categoria vuota allora estraggo tutto
	$query = "
		SELECT $select 
		FROM ecommerce e 
		INNER JOIN ecommercecategoria ec ON ec.id = e.categoria 
		WHERE 1 $ric_cat $ric_prod AND ec.id_lingua = $id_lingua AND e.riservato = 0 
		ORDER BY e.titolo 
	";
	$ris = mysql_query( $query );
	$max = mysql_num_rows( $ris );	
	
	$query .= " LIMIT $pos, $page";
}
else {
	$parola = apici( $_POST['parola'] );
	$inizio = substr($parola,0,1); 
	$h_cat = "Cerca \"".$parola."\"";
	
	$query = "
		SELECT $select 
		FROM ecommerce e 
		INNER JOIN ecommercecategoria ec ON ec.id = e.categoria 
		WHERE e.riservato = 0 AND ec.id_lingua = $id_lingua AND ( 
			e.categoria LIKE '%$parola%' OR 
			e.titolo LIKE '%$parola%' OR 
			e.produttore LIKE '%$parola%' 
		)
	";
	$ris = mysql_query( $query );
	$max = mysql_num_rows( $ris );	
	
	$query .= " LIMIT $pos, $page";
}
	
$ris = mysql_query( $query );

if ( $h_cat == '' ) $h_cat = 'E-commerce ' . _SITO;

echo "<h1><div>$h_cat</div></h1>";
echo "<div class=\"contenitore contenitore-ecommerce\">";	

$link_prod = ( $cat <= 0 ) ? rurl( 0, 'ecommerce' ) : rurl( $cat, 'ecommerce-categorie' );

echo "	
		<div id=\"sel_produttore\">$ECOMMERCE_PRODUTTORELINGUA 
			<select name=\"prod\" onchange=\"link_produttore( this.value, '$link_prod' );\">
				<option value=\"\">$ECOMMERCE_TUTTILINGUA</option>			
				<option value=\"-\">-----------------------------------------</option>";
				if ( $cat <= 0 )		
					$sqlprod = "SELECT produttore, riservato FROM ecommerce WHERE riservato = 0 GROUP BY produttore ORDER BY produttore ASC";
				else
					$sqlprod = "SELECT produttore, riservato FROM ecommerce WHERE riservato = 0 $ric_cat GROUP BY produttore ORDER BY produttore ASC";
				$rssqlprod = mysql_query( $sqlprod );
				while( $row = mysql_fetch_array( $rssqlprod ) ) {
					$value = rurl_rewrite2( $row[0] );
					if ( strtolower( $row[0] ) == strtolower( $prod ) )
						echo "<option value=\"$value\" selected=\"selected\">$row[0]</option>";
					else	
						echo "<option value=\"$value\">$row[0]</option>";
				}
echo "		</select>
		</div>
";
?>

<div class="azzerafloat"></div>

<?php Nav($cat,$max,$pos,$page,$prod); ?>

<div class="azzerafloat"></div>

<div class="ecommerce-catalogo">
<?php while($art=mysql_fetch_row($ris)) : ?>
	<?php $link = rurl( $art[0], 'ecommerce-dettaglio' ); ?>
	<div class="cella-articolo"><div>
		<div class="cella-titolo">
			<h3><?=$art[1]?></h3>
			<?=( $art[10] != '' ) ? "<h4>$ECOMMERCE_PRODUTTORELINGUA $art[10]</h4>" : ''; ?>
		</div>
		<div class="cella-foto">
		<?php 
			if ( $art[3] == "" )
				$src = _URLSITO . "/custom/archivio/images/standard.jpg";
			elseif ( strpos( $art[3], array( 'http://', 'https://' ) ) === false )
				$src = $art[3];	
			else {
				$fototrunk = strrpos($art[3],"/");
				$fototrunk = $fototrunk + 1;
				$art[3] = substr($art[3], $fototrunk);
				$art[3] = substr($art[3], 0, strlen($art[3])-1);
				$src = _URLSITO . "/custom/archivio/images/$art[3]";
			}
			
			echo "<a href=\"$link\" title=\"$art[1]\"><img src=\"$src\" alt=\"$art[1]\" class=\"ecomsec\"></a>";
		?>
		</div>
		<div class="cella-descrizione">
			<?=( $art[7] != '' ) ? "<h5>$ECOMMERCE_COLORELINGUA $art[7]</h5>" : ''; ?>
			<?=( $art[8] != '' ) ? "<h5>$ECOMMERCE_TAGLIALINGUA $art[8]</h5>" : ''; ?>
			<?=( $art[11] != '' ) ? "<h5><a class=\"bottomlato\" target=\"blank\" href=\"$art[11]\">$ECOMMERCE_LEGGITUTTOLINGUA</a></h5>" : "<h5><a class=\"bottomlato\" href=\"$link\">$ECOMMERCE_LEGGITUTTOLINGUA</a></h5>"; ?>
		</div>
		
		<div class="azzerafloat"></div>
	</div></div>
<?php endwhile; ?>
<div class="azzerafloat"></div>
</div>

<?php Nav($cat,$max,$pos,$page,$prod); ?>


</div>


