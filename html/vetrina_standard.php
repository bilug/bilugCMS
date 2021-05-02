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

<!-------- Parte catalogo degli articoli in offerta speciale ---------->
<?php
switch( $lingua_query ) {
	case 'it':
		$ECOMMERCE_LEGGITUTTOLINGUA = 'Leggi tutto...';
		$ECOMMERCE_PRODOTTIVETRINALINGUA = 'PRODOTTI IN VETRINA';
		$ECOMMERCE_VISUALIZZALINGUA = 'Visualizza';
		$ECOMMERCE_SLIDESUCCESSIVALINGUA = 'Slide successiva';
		$ECOMMERCE_SLIDEPRECEDENTELINGUA = 'Slide precedente';
	break;
	case 'en':
		$ECOMMERCE_LEGGITUTTOLINGUA = 'Read more...';
		$ECOMMERCE_PRODOTTIVETRINALINGUA = 'FEATURED PRODUCTS';
		$ECOMMERCE_VISUALIZZALINGUA = 'Display';
		$ECOMMERCE_SLIDESUCCESSIVALINGUA = 'Next slide';
		$ECOMMERCE_SLIDEPRECEDENTELINGUA = 'Previous slide';
	break;
	case 'fr':
		$ECOMMERCE_LEGGITUTTOLINGUA = 'Lire la suite ...';
		$ECOMMERCE_PRODOTTIVETRINALINGUA = 'PRODUITS VEDETTES';
		$ECOMMERCE_VISUALIZZALINGUA = 'Montrer';
		$ECOMMERCE_SLIDESUCCESSIVALINGUA = 'diapositive suivante';
		$ECOMMERCE_SLIDEPRECEDENTELINGUA = 'diapositive pr&eacute;c&eacute;dente';
	break;
	case 'de':
		$ECOMMERCE_LEGGITUTTOLINGUA = 'Lesen Sie mehr ...';
		$ECOMMERCE_PRODOTTIVETRINALINGUA = 'Empfohlene Produkte';
		$ECOMMERCE_VISUALIZZALINGUA = 'Zeigen';
		$ECOMMERCE_SLIDESUCCESSIVALINGUA = 'N&auml;chstes Bild';
		$ECOMMERCE_SLIDEPRECEDENTELINGUA = 'Voriges Bild';
	break;
	case 'es':
		$ECOMMERCE_LEGGITUTTOLINGUA = 'Leer m&aacute;s ...';
		$ECOMMERCE_PRODOTTIVETRINALINGUA = 'PRODUCTOS DESTACADOS';
		$ECOMMERCE_VISUALIZZALINGUA = 'Mostrar';
		$ECOMMERCE_SLIDESUCCESSIVALINGUA = 'Siguiente diapositiva';
		$ECOMMERCE_SLIDEPRECEDENTELINGUA = 'Diapositiva anterior';
	break;
	case 'pt':
		$ECOMMERCE_LEGGITUTTOLINGUA = 'Leia mais ...';
		$ECOMMERCE_PRODOTTIVETRINALINGUA = 'PRODUTOS EM DESTAQUE';
		$ECOMMERCE_VISUALIZZALINGUA = 'Mostrar';
		$ECOMMERCE_SLIDESUCCESSIVALINGUA = 'pr&oacute;ximo slide';
		$ECOMMERCE_SLIDEPRECEDENTELINGUA = 'Slide anterior';
	break;
}
?>
<div class="content-coda-slide">
	<div id="inner-body">
		
		<div class="coda-slider-wrapper">
			
			<!--div id="coda-nav-left-5" class="coda-nav-left"><a href="#" title="Slide sinistra">&#171;</a></div>
			<div id="coda-nav-5" class="coda-nav">
				<ul>
					<li class="tab1"><a href="#1">Panel 1</a></li>
					<li class="tab2"><a href="#2">Panel 2</a></li>
					<li class="tab3"><a href="#3">Panel 3</a></li>
					<li class="tab4"><a href="#4">Panel 4</a></li>
				</ul>
			</div>
			<div id="coda-nav-right-5" class="coda-nav-right"><a href="#" title="Slide destra">&#187;</a></div-->
		   
			<div class="coda-slider preload" id="slider1">
			
			<?php
			$sql = "
				SELECT e.id, e.titolo, e.descrizione, e.foto 
				FROM ecommerce e 
				INNER JOIN ecommercecategoria ec ON ec.id = e.categoria 
				WHERE ec.id_lingua = $id_lingua AND e.offerta = 1 
			";
			
			$rssql = mysql_query( $sql );
			
			while( $r = mysql_fetch_array( $rssql ) ){
				echo "<div class=\"panel\">";
					echo "<div class=\"panel-wrapper\">";
						echo "<h2 class=\"title\">$r[1]</h2>";
							$link = rurl( $r[0], 'ecommerce-dettaglio' );
							$img = str_replace( ';', '', $r[3] );
							echo "<div class=\"sinistro\" title=\"Offerta: $r[1]\"><a href=\"$link\"><img src=\"$img\" width=\"\" height=\"\" alt=\"Offerta: $r[1]\" /></a></div>";
							echo "<div class=\"destro\">";
								echo "<p>".substr( strip_tags( $r[2] ), 0, 400 )."...</p>";
								echo "<p class=\"leggi-tutto-vetrina\"><a href=\"$link\">$ECOMMERCE_LEGGITUTTOLINGUA</a></p>";
							echo "</div>";
							echo "<div class=\"azzerafloat\"></div>";
					echo "</div>";
				echo "</div>";
			}
			?>   
			</div>
		</div>
	</div>
</div>



<!-- testo extra della vetrina -->
<div class="vetrina-standard-testo">
	<?php
	// vetrina
	$filevetrina= _PATH_SERVER."/custom/testo_vetrina.php";
	if(file_exists($filevetrina))
	{
		$vetrina=fopen($filevetrina,"r");
		$contvetrina = fread($vetrina, filesize($filevetrina));
		if($contvetrina!="")
		{	
			@include($filevetrina);		
		}
		@fclose($vetrina);
	}
	?>
</div>




<!-------- Parte catalogo degli articoli evidenziati ---------->
<?php
	/***** trovo i primi 4 prodotti in evidenza con un random *****/
	
	$max_catalogo = 4;	// numero massimo di prodotti in evdenza da visualizzare
	
	$sql = "SELECT e.id FROM ecommerce e INNER JOIN ecommercecategoria ec ON ec.id = e.categoria 
				WHERE ec.id_lingua = $id_lingua AND e.evidenzia = 1";
	$rssql = mysql_query( $sql );
	
	// se il numero record prodotto e minore del numero massimo di prodotti in evidenzia, 
	//setto il numero massimo al numero di record trovati
	if ( mysql_num_rows( $rssql ) < $max_catalogo )
		$max_catalogo = mysql_num_rows( $rssql );
	
	if ( $max_catalogo >= 1 ) {
		echo "<div id=\"vetrina-standard-catalogo\">";
		
			// costruisco l'array dove cercare i 4 articoli casuali
			$arr = Array();
			while( $r = mysql_fetch_object( $rssql ) ){
				$arr[] = $r -> id;
			}
			
			if ( $max_catalogo > 1 ) {
				// recupero 4 chiavi casuali dall'array precedente
				$arr_random = Array();
				$arr_random = array_rand( $arr, $max_catalogo );
			
				// costrisco la stringa per la ricerca dei 4 articoli casuali
				$rand = "";
				foreach( $arr_random as $value ){
					$rand .= "$arr[$value],";
				}
				$rand = substr( $rand, 0, strlen( $rand )-1 );
			}
			else
				$rand = "$arr[0]";
			// recupero i 4 articoli casuali
			$rdm = "SELECT id, titolo, descrizione, foto, prezzo, prezzo_intero FROM ecommerce WHERE id IN ( $rand ) LIMIT $max_catalogo";
			$rsrdm = mysql_query( $rdm );
			
			/****************************************************************/

			
			echo "<h2 class=\"titolo-vetrina\">$ECOMMERCE_PRODOTTIVETRINALINGUA</h2>";
			
			echo "<ul class=\"blocco-catalogo\">";

				$cont = 0;
				while( $r = mysql_fetch_array( $rsrdm ) ){
					$img = str_replace( ';', '', $r[3] );
					
					$class = "";
					if ( $cont == 0 )
						$class = " primo-articolo ";
					elseif ( $cont == 3 )	
						$class = " ultimo-articolo ";
						
					echo "<li class=\"blocco-vetrina $class\">";
						echo "<div class=\"blocco-vetrina-articolo $class\">";
								$link = rurl( $r[0], 'ecommerce-dettaglio' );
							
								echo "<h3 class=\"titolo\">$r[1]</h3>";
								echo "<p class=\"testo\">".substr( strip_tags( $r[2] ), 0, 100 )."...</p>";
								echo "<p class=\"immagine\"><a href=\"$link\" title=\"Novit&agrave;: $r[1]\"><img src=\"$img\" width=\"\" height=\"\" alt=\"Novit&agrave;: $r[1]\" /></a></p>";
								
								if ( $r[5] > $r[4] )
									echo "<p class=\"prezzo\"><strike>".number_format( $r[5], 2, ',', '.' )." &euro;</strike></p>";

								echo "<p class=\"prezzo\">".number_format( $r[4], 2, ',', '.' )." &euro;</p>";
								echo "<p class=\"visualizza\"><a class=\"bottomlato\" href=\"$link\">$ECOMMERCE_VISUALIZZALINGUA</a></p>";
							
						echo "</div>";
					echo "</li>";
					
					$cont++;
				}
				echo "<li class=\"azzerafloat\"></li>";
				echo "</ul>";
			
		echo "</div>";
	}
?>
	


	
	
<!-- Initialize each slider on the page. Each slider must have a unique id -->
<script type="text/javascript">
	$(document).ready(function() {
		jQuery("div#slider1").codaSlider({
			autoSlide: true,
			autoSlideInterval: 5000,
			autoSlideStopWhenClicked: true,				
			autoHeightEaseDuration: 1000,
			autoHeightEaseFunction: "",		// opzioni: '', 'easeInBounce', 'easeInOutElastic'
			slideEaseDuration: 1000,
			slideEaseFunction: "",			// opzioni: '', 'easeInBounce', 'easeInOutElastic'	
			dynamicArrows: true,
			dynamicTabs: false,
			crossLinking: false,
			firstPanelToLoad: 1,
			dynamicArrowLeftText: "<img src=\"<?=_URLSITO?>/img/arrow-left.gif\" width=\"\" height=\"\" title=\"<?=$ECOMMERCE_SLIDEPRECEDENTELINGUA?>\" alt=\"&lt;&lt;\"  />",
			dynamicArrowRightText: "<img src=\"<?=_URLSITO?>/img/arrow-right.gif\" width=\"\" height=\"\" title=\"<?=$ECOMMERCE_SLIDESUCCESSIVALINGUA?>\" alt=\"&gt;&gt;\" />"			
		});
		// jQuery("div#slider2").codaSlider()
		// etc, etc. Beware of cross-linking difficulties if using multiple sliders on one page.
	});
</script>












