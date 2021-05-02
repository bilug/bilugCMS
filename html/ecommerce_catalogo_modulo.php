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
		$ECOMMERCE_CERCAARTICOLILINGUA = 'Cerca negli articoli';
		$ECOMMERCE_NESSUNARGOMENTOLINGUA = 'Nessun Argomento';
	break;
	case 'en':
		$ECOMMERCE_CERCAARTICOLILINGUA = 'Search for articles';
		$ECOMMERCE_NESSUNARGOMENTOLINGUA = 'No Argument';
	break;
	case 'fr':
		$ECOMMERCE_CERCAARTICOLILINGUA = 'Recherche dans les articles';
		$ECOMMERCE_NESSUNARGOMENTOLINGUA = 'Aucun sujet';
	break;
	case 'de':
		$ECOMMERCE_CERCAARTICOLILINGUA = 'Suche in den Artikeln';
		$ECOMMERCE_NESSUNARGOMENTOLINGUA = 'Kein Artikeln';
	break;
	case 'es':
		$ECOMMERCE_CERCAARTICOLILINGUA = 'Buscar en los artículos';
		$ECOMMERCE_NESSUNARGOMENTOLINGUA = 'No hay temas';
	break;
	case 'pt':
		$ECOMMERCE_CERCAARTICOLILINGUA = 'Pesquisa nos artigos';
		$ECOMMERCE_NESSUNARGOMENTOLINGUA = 'No t&oacute;pico';
	break;
}
?>

<?/* ricerca tra gli articoli */?>
<div class="blocco blocco-ecommerce-cerca">
	<h3><span><?=$ECOMMERCE_CERCAARTICOLILINGUA?></span></h3>	
	<div class="modulo">
		<form name="ecommercericerca" method="post" action="<?=_URLSITO?>/ecommerce-cataloghi/">
			<?php $cerca = ( isset( $_POST['parola'] ) ) ? apici( $_POST['parola'] ) : ''; ?>
			<input type="text" name="parola" value="<?=$cerca?>" class="textlato">
			<input type="submit" name="cerca" value="Cerca" class="bottomlato">
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
			<ul>
			<?php $link = rurl( 0, 'ecommerce-categorie' ); ?>
				<li><a href="<?=$link?>"><?=$ECOMMERCE_TUTTILINGUA?></a></li>
				<?php while($control=mysql_fetch_row($risultato)) : 
					$link = rurl( $control[0], 'ecommerce-categorie' ); ?>
					<li>
						<a href="<?=$link?>"><?=$control[1]?></a>
						<?php if ( in_array( $control[0], $v_id_cat ) ) li_categorie_ecommerce( $control[0] ); ?>
					</li>
				<?php endwhile; ?>
			</ul>
			<?php
		}
		else
			echo "<ul><li>$ECOMMERCE_NESSUNARGOMENTOLINGUA</li></ul>";
		?>
	</div>
</div>

