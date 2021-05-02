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
switch( $lingua_query ) {
	case 'it':
		$ECOMMERCE_COLORELINGUA = 'Colore:';
		$ECOMMERCE_TAGLIALINGUA ='Taglia';
		$ECOMMERCE_PREZZOLINGUA = 'Prezzo:';
		$ECOMMERCE_CODICELINGUA = 'Codice:';
		$ECOMMERCE_PRODUTTORELINGUA = 'Produttore:';
		$ECOMMERCE_QUANTITALINGUA = 'Quantit&agrave;:';
		$ECOMMERCE_DISPONIBILITALINGUA = 'Disponibilit&agrave;:';
		$ECOMMERCE_ARTICOLOESAURITOLINGUA = 'Articolo esaurito';
		$ECOMMERCE_AGGIUNGICARRELLOLINGUA = 'Aggiungi al carrello:';
		$ECOMMERCE_DESCRIZIONELINGUA = 'Descrizione:';
		$ECOMMERCE_COMEDECIDERETAGLIALINGUA = 'Come decidere la taglia?';
	break;
	case 'en':
		$ECOMMERCE_COLORELINGUA = 'Colour:';
		$ECOMMERCE_TAGLIALINGUA ='Size';
		$ECOMMERCE_PREZZOLINGUA = 'Price:';
		$ECOMMERCE_CODICELINGUA = 'Product key:';
		$ECOMMERCE_PRODUTTORELINGUA = 'Producer:';
		$ECOMMERCE_QUANTITALINGUA = 'Quantity:';
		$ECOMMERCE_DISPONIBILITALINGUA = 'Availability:';
		$ECOMMERCE_ARTICOLOESAURITOLINGUA = 'Product sold out';
		$ECOMMERCE_AGGIUNGICARRELLOLINGUA = 'Add to Cart:';
		$ECOMMERCE_DESCRIZIONELINGUA = 'Description:';
		$ECOMMERCE_COMEDECIDERETAGLIALINGUA = 'How to decide the size?';
	break;
	case 'fr':
		$ECOMMERCE_COLORELINGUA = 'Couleur:';
		$ECOMMERCE_TAGLIALINGUA ='Taille';
		$ECOMMERCE_PREZZOLINGUA = 'Prix:';
		$ECOMMERCE_CODICELINGUA = 'Code:';
		$ECOMMERCE_PRODUTTORELINGUA = 'Fabricant:';
		$ECOMMERCE_QUANTITALINGUA = 'Montant:';
		$ECOMMERCE_DISPONIBILITALINGUA = 'Disponibilit&eacute;:';
		$ECOMMERCE_ARTICOLOESAURITOLINGUA = 'Produit &eacute;puis&eacute;';
		$ECOMMERCE_AGGIUNGICARRELLOLINGUA = 'Ajouter au panier:';
		$ECOMMERCE_DESCRIZIONELINGUA = 'Description:';
		$ECOMMERCE_COMEDECIDERETAGLIALINGUA = 'Comment d&eacute;cider de la taille?';
	break;
	case 'de':
		$ECOMMERCE_COLORELINGUA = 'Farbe:';
		$ECOMMERCE_TAGLIALINGUA ='Gr&ouml;&szlig;e';
		$ECOMMERCE_PREZZOLINGUA = 'Preis:';
		$ECOMMERCE_CODICELINGUA = 'Code:';
		$ECOMMERCE_PRODUTTORELINGUA = 'Hersteller:';
		$ECOMMERCE_QUANTITALINGUA = 'Betrag:';
		$ECOMMERCE_DISPONIBILITALINGUA = 'Verf&uuml;gbarkeit:';
		$ECOMMERCE_ARTICOLOESAURITOLINGUA = 'Produkt ausverkauft';
		$ECOMMERCE_AGGIUNGICARRELLOLINGUA = 'In den Warenkorb:';
		$ECOMMERCE_DESCRIZIONELINGUA = 'Beschreibung:';
		$ECOMMERCE_COMEDECIDERETAGLIALINGUA = 'Wie man die Gr&ouml;&szlig;e entscheiden?';
	break;
	case 'es':
		$ECOMMERCE_COLORELINGUA = 'Color:';
		$ECOMMERCE_TAGLIALINGUA ='Tama&ntilde;o';
		$ECOMMERCE_PREZZOLINGUA = 'Precio:';
		$ECOMMERCE_CODICELINGUA = 'Código:';
		$ECOMMERCE_PRODUTTORELINGUA = 'Fabricante:';
		$ECOMMERCE_QUANTITALINGUA = 'Cantidad:';
		$ECOMMERCE_DISPONIBILITALINGUA = 'disponibilidad:';
		$ECOMMERCE_ARTICOLOESAURITOLINGUA = 'Producto vendido hacia fuera';
		$ECOMMERCE_AGGIUNGICARRELLOLINGUA = 'A&ntilde;adir a la cesta:';
		$ECOMMERCE_DESCRIZIONELINGUA = 'Descripci&oacute;n:';
		$ECOMMERCE_COMEDECIDERETAGLIALINGUA = 'C&oacute;mo decidir el tama&ntilde;o?';
	break;
	case 'pt':
		$ECOMMERCE_COLORELINGUA = 'Cor:';
		$ECOMMERCE_TAGLIALINGUA ='Tamanho';
		$ECOMMERCE_PREZZOLINGUA = 'Pre&ccedil;o:';
		$ECOMMERCE_CODICELINGUA = 'C&oacute;digo:';
		$ECOMMERCE_PRODUTTORELINGUA = 'Fabricante:';
		$ECOMMERCE_QUANTITALINGUA = 'Quantidade:';
		$ECOMMERCE_DISPONIBILITALINGUA = 'Disponibilidade:';
		$ECOMMERCE_ARTICOLOESAURITOLINGUA = 'O produto vendeu fora';
		$ECOMMERCE_AGGIUNGICARRELLOLINGUA = 'Adicionar ao carrinho:';
		$ECOMMERCE_DESCRIZIONELINGUA = 'Descri&ccedil;&atilde;o:';
		$ECOMMERCE_COMEDECIDERETAGLIALINGUA = 'Como decidir o tamanho?';
	break;
}
//ricevo l'id del prodotto
$id = (int)$_GET["id"];
$op = $_GET["op"];
$quant = (int)$_GET["quant"];

//query per estrarre tutti i dettagli del prodotto
$query = "
	SELECT e.id, e.titolo, e.descrizione, e.prezzo, e.quantita, e.foto, e.fotofacoltative, e.codice, e.produttore, e.spedizione, e.prezzo_intero, e.colore, e.taglia, ec.categoria, ec.id
	FROM ecommerce e 
	INNER JOIN ecommercecategoria ec ON ec.id = e.categoria 
	WHERE e.id = '$id' 
	LIMIT 1
";
$ris = mysql_query($query);
$prod = mysql_fetch_row($ris);

if( $op == "" ) $quant=1;

if($op=="su")
	if( !( $prod[4] == $quant ) ) 
		$quant = $quant + 1;

if ( $op == "giu" )
	if( $quant > 1 )
		 $quant--;

?>

<?php breadcrumbs( array(
	'Home' => _URLSITO,
	'E-commerce' => _URLSITO.'/ecommerce/',
	$prod[13] => rurl( $prod[14], 'ecommerce-categorie' ),
	$prod[1] => ''
) ); ?>

<h1>
	<span><?=$prod[1]?></span>
	<?=adm_link('ecommerce', $id)?>
</h1>

<?php if ( _SOCIAL_ECOMMERCE_POSITION == 1 AND ( _SOCIAL_ECOMMERCE_FB OR _SOCIAL_ECOMMERCE_GP OR _SOCIAL_ECOMMERCE_TW ) ) : ?>
	<div class="social_network"></div>
	<div class="azzerafloat"></div>
<?php endif; ?>

<div class="ecommerce-dettaglio">	
	<div class="img_principale">
	<?php 
		if ( $prod[5] == "" )
			$src = _URLSITO . "/custom/archivio/images/standard.jpg";
		elseif ( strpos( $prod[5], array( 'http://', 'https://' ) ) === false )
			$src = $prod[5];	
		else {
			$fototrunk = strrpos($prod[5],"/");
			$fototrunk = $fototrunk + 1;
			$prod[5] = substr($prod[5], $fototrunk);
			$prod[5] = substr($prod[5], 0, strlen($prod[5])-1);
			$src = _URLSITO . "/custom/archivio/images/$prod[5]";
		}
				
		echo "<a class=\"lightbox\" href=\"$src\" title=\"$prod[1]\"><img src=\"$src\" alt=\"$prod[1]\" class=\"ecomsec\"></a>";
	?>
	</div>
		
	<div class="dettaglio">
		<div class="dettaglio-blocco-1">
			<h3><?=$ECOMMERCE_CODICELINGUA?></h3>
			<div class="dettaglio-testo"><?=$prod[7]?></div>
		</div>
		
		<div class="dettaglio-blocco-1">
			<h3><?=$ECOMMERCE_PRODUTTORELINGUA?></h3>
			<div class="dettaglio-testo"><?=$prod[8]?></div>
		</div>
		
		<div class="dettaglio-blocco-2">
			<h4> <?=$ECOMMERCE_PREZZOLINGUA?> </h4> 
			<div class="dettaglio-testo">
			<?php
				$prezzoprod = number_format( $prod[3], 2, ',', '.' );

				if ( $prod[10] > $prod[3] )
					echo "<p style=\"text-decoration:line-through; color:red;\">".number_format( $prod[10], 2, ',', '.' )." &euro;</p>";

				echo "<p>$prezzoprod &euro;</p>";
			?>
			</div>
		</div>

		<?php $link = rurl( 0, 'ecommerce-aggiungi-carrello' ) . "$id/$id/si/$quant/"; ?>
		<form action="<?=$link?>" method="post">	
			<div class="dettaglio-blocco-2">
				<h4><?=$ECOMMERCE_QUANTITALINGUA?></h4>
				<div class="dettaglio-testo">
				<?php
					if ( $prod[4] > 0 ) {
						$link_giu = rurl( $id, 'ecommerce-dettaglio' ) . "giu/$quant/";
						$link_su = rurl( $id, 'ecommerce-dettaglio' ) . "su/$quant/";
						echo"
							<a href=\"$link_giu\"> - </a> 
							&nbsp;&nbsp; $quant &nbsp;&nbsp; 
							<a href=\"$link_su\"> + </a>
						";
					}
					else
						echo "0";
						
				?>
				</div>
			</div>
		
			<div class="dettaglio-blocco-2">
				<h4><?=$ECOMMERCE_DISPONIBILITALINGUA?></h4>
				<div class="dettaglio-testo"><?=( $prod[4] > 0 ) ? $prod[4] : $ECOMMERCE_ARTICOLOESAURITOLINGUA?></div>
			</div>
			
			<div class="dettaglio-blocco-2">
				<h4><?=$ECOMMERCE_AGGIUNGICARRELLOLINGUA?></h4>
				<div class="dettaglio-testo">
				<?php if ( $prod[4] > 0 ) : ?>
						<input type="image" src="<?=_URLSITO?>/img/carrello_freccia.png" name="enter" class="ecomico" />
				<?php endif; ?>
				</div>	
			</div>
		</form>

	</div>

	<div class="azzerafloat"></div>

	<div class="dettaglio-descrizione">
		<h3><?=$ECOMMERCE_DESCRIZIONELINGUA?></h3>
		<?php
		if ( $prod[11] != '' ) echo "<strong>$ECOMMERCE_COLORELINGUA</strong>: $prod[11]<br />";
		if ( $prod[12] != '' ) echo "<strong>$ECOMMERCE_TAGLIALINGUA</strong>: $prod[12]<br /><br />";
		?>

		<div class="descrizione-foto">
		  <?php if ( $prod[6] != '' ) : ?>
		  <ul>
			<?php
				$foto = explode(';', $prod[6]);
				foreach( $foto as $value ) : 
					if ( $value != '' ) : ?>
					   <li><a href="<?=$value?>"><img src="<?=$value?>" class="ecomsec" alt="" height="" width=""></a></li>
					<?php endif; ?>
				<?php endforeach; ?>
			</ul>
		  <?php endif; ?>
		</div>
		
		<div class="descrizione-testo"><?=$prod[2]?></div>
	</div>

</div>

<?php if ( _SOCIAL_ECOMMERCE_POSITION == 2 AND ( _SOCIAL_ECOMMERCE_FB OR _SOCIAL_ECOMMERCE_GP OR _SOCIAL_ECOMMERCE_TW ) ) : ?>
	<div class="social_network"></div>
	<div class="azzerafloat"></div>
<?php endif; ?>

<script type="text/javascript">
	$(document).ready(function(){
		var loaderfb = "<img src=\"<?=_URLSITO?>/img/loader-fb.gif\" alt=\"Loading Facebook\">";
		$('.social_network').html(loaderfb);
		$.ajax({
			url: '<?=_URLSITO?>/html/ajax/social_network_ecommerce.php',
			data: { url_page: "<?=$url_page?>", lingua_query: "<?=$lingua_query?>" },
			type: "post",
			async: true,
			success: function(data) {
				$('.social_network').html(data);
			}
		});
	})
</script>	