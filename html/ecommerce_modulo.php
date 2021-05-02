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

<?php $idecom = session_id(); ?>

<?php
switch( $lingua_query ) {
	case 'it':
		$ECOMMERCE_CARRELLOLINGUA = 'Carrello';
		$ECOMMERCE_VAICARRELLOLINGUA = 'Vai al carrello';
		$ECOMMERCE_RESETTACARRELLOLINGUA = 'Resetta carrello';
		$ECOMMERCE_PLACEHOLDERLINGUA = 'Inserire il titolo o il codice';
		$ECOMMERCE_CATEGORIELINGUA = 'Categorie';
		$ECOMMERCE_CERCALINGUA = 'Cerca';
		$ECOMMERCE_NESSUNARGOMENTOLINGUA = 'Nessun argomento';
		$ECOMMERCE_TUTTILINGUA = 'Tutti';
	break;
	case 'en':
		$ECOMMERCE_CARRELLOLINGUA = 'Cart';
		$ECOMMERCE_VAICARRELLOLINGUA = 'Go to cart';
		$ECOMMERCE_RESETTACARRELLOLINGUA = 'Reset cart';
		$ECOMMERCE_PLACEHOLDERLINGUA = 'Insert article name or product key';
		$ECOMMERCE_CATEGORIELINGUA = 'Categories';
		$ECOMMERCE_CERCALINGUA = 'Search';
		$ECOMMERCE_NESSUNARGOMENTOLINGUA = 'No Argument';
		$ECOMMERCE_TUTTILINGUA = 'All';
	break;
	case 'fr':
		$ECOMMERCE_CARRELLOLINGUA = 'Panier';
		$ECOMMERCE_VAICARRELLOLINGUA = 'Aller au panier';
		$ECOMMERCE_RESETTACARRELLOLINGUA = 'r&eacute;initialiser panier';
		$ECOMMERCE_PLACEHOLDERLINGUA = 'Entrez le titre ou le code';
		$ECOMMERCE_CATEGORIELINGUA = 'cat&eacute;gories';
		$ECOMMERCE_CERCALINGUA = 'Rechercher';
		$ECOMMERCE_NESSUNARGOMENTOLINGUA = 'Pas de sujets';
		$ECOMMERCE_TUTTILINGUA = 'Tout';
	break;
	case 'de':
		$ECOMMERCE_CARRELLOLINGUA = 'Einkaufswagen';
		$ECOMMERCE_VAICARRELLOLINGUA = 'Zum Warenkorb';
		$ECOMMERCE_RESETTACARRELLOLINGUA = 'zur&uuml;cksetzen Warenkorb';
		$ECOMMERCE_PLACEHOLDERLINGUA = 'Geben Sie den Titel oder Code';
		$ECOMMERCE_CATEGORIELINGUA = 'Kategorien';
		$ECOMMERCE_CERCALINGUA = 'Suchen';
		$ECOMMERCE_NESSUNARGOMENTOLINGUA = 'Keine Themen';
		$ECOMMERCE_TUTTILINGUA = 'Jeder';
	break;
	case 'es':
		$ECOMMERCE_CARRELLOLINGUA = 'Cesta';
		$ECOMMERCE_VAICARRELLOLINGUA = 'Ir a la cesta';
		$ECOMMERCE_RESETTACARRELLOLINGUA = 'Restablecer la Cesta';
		$ECOMMERCE_PLACEHOLDERLINGUA  ='Escriba el t&iacute;tulo o el c&oacute;digo';
		$ECOMMERCE_CATEGORIELINGUA = 'Categor&iacute;as';
		$ECOMMERCE_CERCALINGUA = 'Buscar';
		$ECOMMERCE_NESSUNARGOMENTOLINGUA = 'No hay temas';
		$ECOMMERCE_TUTTILINGUA = 'Todo';
	break;
	case 'pt':
		$ECOMMERCE_CARRELLOLINGUA = 'Carrinho';
		$ECOMMERCE_VAICARRELLOLINGUA = 'Ir ao carrinho';
		$ECOMMERCE_RESETTACARRELLOLINGUA = 'Esvaziar o carrinho';
		$ECOMMERCE_PLACEHOLDERLINGUA = 'Digite o título ou o c&oacute;digo';
		$ECOMMERCE_CATEGORIELINGUA = 'Categorias';
		$ECOMMERCE_CERCALINGUA = 'Pesquisar';
		$ECOMMERCE_NESSUNARGOMENTOLINGUA = 'nenhum t&oacute;pico';
		$ECOMMERCE_TUTTILINGUA = 'Todo';
	break;
}
?>

<?php
//estraggo merce carrello e la visualizzo
$query = "
	SELECT c.id, c.titolo, c.codice, c.prezzo, c.spedizione, e.id 
	FROM carrello c 
	INNER JOIN ecommerce e ON e.codice = c.codice 
	WHERE c.utente = '$idecom' AND c.elimina = 0
";
$ris = mysql_query($query);
if ( mysql_num_rows( $ris ) > 0 ) : ?>
  <div class="blocco blocco-ecommerce-carrello">
  <?php
		$dettaglio_carrello = rurl( 0, 'ecommerce-dettaglio-carrello' );
		echo "<h3><span><a href=\"$dettaglio_carrello\">$ECOMMERCE_CARRELLOLINGUA<img src=\""._URLSITO."/img/carrello1.png\" class=\"linkico\"></a></span></h3>";
		echo "<div class=\"modulo\">";
			include(_PATH_SERVER."/html/ecommerce_carrello.php");
		echo "</div>";
		?>
		<div class="modulo">
			<p><a class="btn" href="<?=$dettaglio_carrello?>"><?=$ECOMMERCE_VAICARRELLOLINGUA?></a></p>
			<p><a class="link-inline" href="<?=_URLSITO?>/ecommerce/resetta-carrello/"><?=$ECOMMERCE_RESETTACARRELLOLINGUA?></a></p>
		</div>  	
  </div>
<?php endif; ?>

<?/* ricerca tra gli articoli */?>
<div class="blocco blocco-ecommerce-cerca">
	<h3><span><?=$titolo?></span></h3>	
	<div class="modulo">
		<form name="ecommercericerca" method="post" action="<?=_URLSITO?>/ecommerce/">
				<?php $cerca = ( isset( $_POST['parola'] ) AND $_POST['parola'] != '' ) ? apici( $_POST['parola'] ) : ''; ?>
				<p><input type="text" name="parola" value="<?=$cerca?>" class="textlato" placeholder="<?=$ECOMMERCE_PLACEHOLDERLINGUA?>"></p>
				<p><input type="submit" name="cerca" value="<?=$ECOMMERCE_CERCALINGUA?>" class="bottomlato"></p>
		</form>
	</div>
</div>


<div class="blocco blocco-ecommerce-categorie">	
	<h3><?=$ECOMMERCE_CATEGORIELINGUA?></h3>	
	<div class="modulo">
		<?php
		$str = "
			SELECT e.id, e.categoria 
			FROM ecommercecategoria AS e 
			INNER JOIN lingue AS l ON l.id = e.id_lingua 
			WHERE l.sigla = '$lingua_query' AND e.id_padre = 0
			ORDER BY e.categoria
		";
		$risultato=mysql_query($str);
    
		if (mysql_num_rows($risultato)>0) {
			$cat = 0;
			if ( isset( $_GET['categoria'] ) ) $cat = (int)$_GET['categoria']; 
			elseif ( isset( $_GET['id'] ) ) {
				$id_articolo = (int)$_GET['id'];
				$query = "SELECT categoria FROM ecommerce WHERE id = '$id_articolo' LIMIT 1";
				$ris = mysql_query($query);
				$cat = mysql_result($ris, 0, 0);
			}
			
			$v_id_cat = '';
			id_categorie_ecommerce_tutte( $cat, $v_id_cat );
			$v_id_cat .= ",$cat";	
			$v_id_cat = substr( $v_id_cat, 1 );
			$v_id_cat = explode( ',', $v_id_cat );
			?>
			<ul class="elenco-ecommerce">
			<?php $link = rurl( 0, 'ecommerce-categorie' ); ?>
				<li><a href="<?=$link?>"><?=$ECOMMERCE_TUTTILINGUA?></a></li>
				<?php while($control=mysql_fetch_row($risultato)) : 
					$link = rurl( $control[0], 'ecommerce-categorie' ); 
					$sql = "SELECT id FROM ecommercecategoria WHERE id_padre = $control[0] LIMIT 1";
					$rssql = mysql_query($sql); 
					$verifica_articoli = mysql_num_rows($rssql); ?>
					<?php if ( in_array( $control[0], $v_id_cat ) ) : ?>
						<li class="elenco-ecommerce-active <?=($verifica_articoli==1)?'elenco-ecommerce-sub-meno':''?>">
							<a href="<?=$link?>"><?=$control[1]?></a>
							<?php li_categorie_ecommerce( $control[0] ); ?>
						</li>
					<?php else : ?>
						<li class="<?=($verifica_articoli==1)?'elenco-ecommerce-sub-piu':''?>">
							<a href="<?=$link?>"><?=$control[1]?></a>
							<?php li_categorie_ecommerce( $control[0] ); ?>
						</li>
					<?php endif ; ?>
				<?php endwhile; ?>
			</ul>
			<?php
		}
		else
			echo "<ul><li>$ECOMMERCE_NESSUNARGOMENTOLINGUA</li></ul>";
		?>
	</div>
</div>

<script>

$('ul.elenco-ecommerce li:not(.elenco-ecommerce-active)').mouseenter(function(){
	$('ul', $(this)).stop(true, true).delay(800).show(500);
	if ( $(this).hasClass('elenco-ecommerce-sub-piu') ) {
		$(this).removeClass('elenco-ecommerce-sub-piu').addClass('elenco-ecommerce-sub-meno');
	}
})
$('ul.elenco-ecommerce li:not(.elenco-ecommerce-active)').mouseleave(function(){
	if ( $('ul', $(this)).length > 0 ) {
		$('ul', $(this)).stop(true, true).delay(1150).hide(500);	
		if ( $(this).hasClass('elenco-ecommerce-sub-meno') )
			$(this).removeClass('elenco-ecommerce-sub-meno').addClass('elenco-ecommerce-sub-piu');			
	}
})

</script>

