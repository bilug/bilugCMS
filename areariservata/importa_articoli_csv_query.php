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

require_once("auth.php");

$file = $_FILES['csv_articoli'];

$nome_file = $file['tmp_name'];
$size_file = $file['size'];

$tipoerr = '';

if (($handle = fopen($nome_file, "r")) !== FALSE) {
	$sql = "SHOW FIELDS FROM ecommerce";
	$rssql = mysql_query( $sql );
	while( $r = mysql_fetch_assoc( $rssql ) ) {
		$campi_table[] = $r['Field'];
	}

	$cont = 0;
	$articoli = array();
    while ( ( $data = fgetcsv($handle, $size_file, ";") ) !== FALSE ) {
        if ( $cont == 0 ) {
			$campi_csv = $data;
			$campi_obbligatori = array( 'titolo', 'descrizione', 'prezzo', 'categoria', 'codice', 'produttore', 'quantita' );
			unset( $data );
			
			/*foreach( $campi_csv as $value ) {
				if ( !in_array( $value, $campi_table ) ) {
					$tipoerr = "ALCUNI CAMPI NON SONO PRESENTI NELLA TABELLA!";
					echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=elenco_ecommerce_categorie.php&tipoerr=$tipoerr&errore=si#fragment-1-8\" />";
				}
			}*/

			foreach( $campi_obbligatori as $value ) {
				if ( !in_array( $value, $campi_csv ) ) {
					$tipoerr = "MANCANO ALCUNI CAMPI OBBLIGATORI NELLA TABELLA!";
					echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=elenco_ecommerce_categorie.php&tipoerr=$tipoerr&errore=si#fragment-1-8\" />";
				}
			}
		}
		else {
			$num = 0;
			foreach( $campi_csv as $campo ) {
				$articoli[$cont][$campo] = $data[$num];
				$num++;
			}
		}
		
		$cont++;
    }
    fclose($handle);	

	if ( $tipoerr == '' ) {
		$svuota_articoli = (int)$_POST['svuota_articoli'];
		$format_html = (int)$_POST['format_html'];
		
		if ( $svuota_articoli == 1 ) {
			mysql_query( "TRUNCATE ecommerce" );
			mysql_query( "TRUNCATE ecommercecategorie" );
		}
		
		mysql_query( "ALTER TABLE ecommerce AUTO_INCREMENT = 0" );
		mysql_query( "ALTER TABLE ecommercecategorie AUTO_INCREMENT = 0" );
		
		$insert_table = "INSERT INTO ecommerce ";
		
		$values = "";
		$cont = 0;
		foreach( $articoli as $articolo ) {
			$keys = '';
			$values .= ' ( ';
			foreach( $articolo as $key => $value ) {
				$value = ( $format_html == 0 ) ? apici( $value ) : mysql_real_escape_string( $value );
				if ( $key == 'categoria' ) {
					$sql = "SELECT id FROM ecommercecategoria WHERE categoria = '$value' LIMIT 1";
					$rssql = mysql_query( $sql );
					if ( mysql_num_rows( $rssql ) == 0 ){
						$cat = "INSERT INTO ecommercecategoria ( categoria ) VALUES ( '$value' )";
						mysql_query( $cat );
						$id_categoria = mysql_insert_id();
					}
					else
						$id_categoria = mysql_result( $rssql, 0, 0 );
				}	
				elseif ( $key == 'sottocategoria' ) {
					$sql = "SELECT id FROM ecommercecategoria WHERE categoria = '$value' AND id_padre = $id_categoria LIMIT 1";
					$rssql = mysql_query( $sql );
					if ( mysql_num_rows( $rssql ) == 0 ){
						$sottocat = "INSERT INTO ecommercecategoria ( id_padre, categoria ) VALUES ( $id_categoria, '$value' )";
						mysql_query( $sottocat );
						$id_sottocategoria = mysql_insert_id();
					}
					else
						$id_sottocategoria = mysql_result( $rssql, 0, 0 );
				}
				else {
					$values .= "'$value',";
					$keys .= "$key,";
				}
			}
			
			$keys .= "categoria,";
			$values .= ( isset( $id_sottocategoria ) ) ? "$id_sottocategoria," : "$id_categoria,";
			$values = substr( $values, 0, strlen( $values )-1 );
			$values .= ' ),';
			
			$cont++;
			if ( ($cont % 100) == 0 ) {
				$values = substr( $values, 0, strlen( $values )-1 ) . ';';
				$keys = ' ( ' . substr( $keys, 0, strlen( $keys )-1 ) . ' ) ';
				
				$query = $insert_table . $keys . ' VALUES ' . $values;
				$ok = ( mysql_query( $query ) ) ? "<h1>ok</h1>" : "<h1>no ok</h1>";				
				#echo $ok;
				
				$values = "";
			}
			
			//if ( $cont == 350 ) break;
		}

		if ( ($cont % 100) != 0 ) {
			$values = substr( $values, 0, strlen( $values )-1 ) . ';';
			$keys = ' ( ' . substr( $keys, 0, strlen( $keys )-1 ) . ' ) ';
			
			$query = $insert_table . $keys . ' VALUES ' . $values;
			$ok = ( mysql_query( $query ) ) ? "<h1>ok</h1>" : "<h1>no ok</h1>";				
			#echo $ok;
			
			$values = "";
		}
		
		$sql = "
		   SELECT id, titolo, categoria, COUNT( id ) AS cont 
		   FROM ecommerce 
		   GROUP BY titolo, categoria 
		   HAVING COUNT( id ) > 1
		";
		do {
			$rssql = mysql_query( $sql );
			$num_record = mysql_num_rows( $rssql );
			if ( $num_record > 0 ) {
				while( $r = mysql_fetch_assoc( $rssql ) ) {
					$del = "DELETE FROM ecommerce WHERE id = $r[id]";
					mysql_query( $del );
				}
				$rssql = mysql_query( $sql );
				$num_record = mysql_num_rows( $rssql );
			}
		} while( $num_record > 0 );
		
		echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=conferma.php&from=elenco_ecommerce_categorie.php\" />";
	}
}

?>