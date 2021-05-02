<?php
	
	include( "./connessione.php" );
	
	$old_path = "/html/img";
	$new_path = "/custom/archivio";


	//	prima query ecommerce //
	$sql = "
		UPDATE ecommerce SET foto = REPLACE(
			foto, 
			'$old_path', 
			'$new_path'
		), fotofacoltative = REPLACE(
			fotofacoltative, 
			'$old_path', 
			'$new_path'
		) 	
	";
	
	if ( @mysql_query( $sql ) )
		echo "ok<br>";
	else	
		echo "non ok<br>";
	
	
	//	seconda query newsbox //
	$sql = "
		UPDATE newsbox SET immagine = REPLACE(
			immagine, 
			'$old_path', 
			'$new_path'
		) 	
	";
	
	if ( @mysql_query( $sql ) )
		echo "ok<br>";
	else	
		echo "non ok<br>";
	
	
	
	//	terza query notizie //
	$sql = "
		UPDATE notizie SET testo = REPLACE(
			testo, 
			'$old_path', 
			'$new_path'
		) 	
	";
	
	if ( @mysql_query( $sql ) )
		echo "ok<br>";
	else	
		echo "non ok<br>";
	
	
	//	quarta query notizieint //
	$sql = "
		UPDATE notizieint SET testo = REPLACE(
			testo, 
			'$old_path', 
			'$new_path'
		) 	
	";
	
	if ( @mysql_query( $sql ) )
		echo "ok<br>";
	else	
		echo "non ok<br>";
	
	
	//	quinta query statiche //
	$sql = "
		UPDATE statiche SET corpo = REPLACE(
			corpo, 
			'$old_path', 
			'$new_path'
		) 	
	";
	
	if ( @mysql_query( $sql ) )
		echo "ok<br>";
	else	
		echo "non ok<br>";
	
	
	
	
	//	sesta query statiche //
	$sql = "
		UPDATE menuadmin SET link = REPLACE(
			link, 
			'$old_path', 
			'$new_path'
		) 	
	";
	
	if ( @mysql_query( $sql ) )
		echo "ok<br>";
	else	
		echo "non ok<br>";
	
?>
