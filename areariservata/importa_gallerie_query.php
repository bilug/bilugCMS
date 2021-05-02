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

$dir = '../gals';

if (file_exists($dir)) { 
	// Svuolo la tabelle delle gallerie 
	mysql_query( "TRUNCATE galleria" );	

	import_gals( $dir, 0 );
	
	echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=conferma.php&from=elenco_arg_gallerie.php\" />";
	exit();
}
else {
	$tipoerr = "La cartella gals non pu&ograve; essere aperta. Controllare i permessi!";
	echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=elenco_arg_gallerie.php&tipoerr=$tipoerr&errore=si#fragment-3\" />";
	exit();					
}

function import_gals( $directory, $id_padre ) {
	if (file_exists($directory)) {
		if ( $dh = opendir( $directory ) ) {
			while ( ($file = readdir($dh)) !== false ) {
				if ( $file == ".." OR $file == "." ) continue;

				$path = $directory.'/'.$file;
				
				$info_file = pathinfo( $file );
				$nome_file = rurl_rewrite2( apici( $info_file['filename'] ) );
				//$nome_filesystem_dir = ( is_dir( $path ) ) ? implode( ' ', explode( '-', $nome_file ) ) : '';
				$nome_filesystem_dir = ( is_dir( $path ) ) ? $nome_file : '';
				$ext_file = strtolower( $info_file['extension'] );
				
				global $estensioni_immagini;
				$estensioni_immagini[] = 'txt';
				if ( !is_dir( $path ) AND !in_array( $ext_file, $estensioni_immagini ) ) continue;
				
				$path_new = ( is_dir( $path ) ) ? $directory.'/'.$nome_filesystem_dir : $directory.'/'.$nome_file.'.'.$ext_file;
								
				if ( rename( $path, $path_new ) ) {
					if ( is_dir( $path ) )
						$sql = "INSERT INTO galleria SET id_padre = $id_padre, cartella = '$nome_file'";
					elseif( $ext_file != 'txt' )
						$sql = "INSERT INTO galleria SET id_padre = $id_padre, immagine = '".$nome_file.'.'.$ext_file."'";
					elseif ( $ext_file == 'txt' AND $f = fopen( $path_new, 'r' ) ) {
						$content = fread( $f, filesize( $path_new ) );
						$content = nl2br( $content );
						$content = str_replace( '<br>', '<br />', $content );
						
						$sql = "UPDATE galleria SET descrizione = '$content' WHERE id = $id_padre";
					}
					
					mysql_query( $sql );
					
					if ( is_dir( $path ) ) {
						$id_padre2 = mysql_insert_id();
						import_gals( $path, $id_padre2 );
					}
				}
				else {
					$tipoerr = "Non sono riuscito a rinominare i file e le cartelle, Controllare i permessi ed il nome dei file!";
					echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=elenco_arg_gallerie.php&tipoerr=$tipoerr&errore=si#fragment-3\" />";
					exit();					
				}	
			}
		}
	}
}

?>
