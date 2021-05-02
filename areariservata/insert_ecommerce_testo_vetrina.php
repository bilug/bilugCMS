<?php

	$filevetrina= "../custom/testo_vetrina.php";

	if(file_exists($filevetrina))
	{
			$vetrina=fopen($filevetrina,"r");
			$contvetrina = fread($vetrina, filesize($filevetrina));
	}

	$annulla = "<input type=\"button\" 
		class=\"medio\" name=\"Annulla\" value=\"Annulla\" onclick=\"javascript:window.location='area.php'\" />";	

?>

<div class="contenitore">
<form name="form" method="post" action="insert_ecommerce_testo_vetrina_query.php" enctype="multipart/form-data">
	
	<textarea name="vetrina"><?=$contvetrina?></textarea>
	<script type="text/javascript">
		CKEDITOR.replace( 'vetrina' );
	</script>
			

	<div class="azzerafloat"></div><br /><br />
	
	
	<input type="submit" class="medio" value="Modifica" tabindex="7"/>  
	<?=$annulla?>  
	<?
		@fclose($testa);
		@fclose($piede);
	?>
	
	
</form>
</div>
