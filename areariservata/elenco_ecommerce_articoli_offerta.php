<div class="contenitore">
	
	<form name="ecommerce" method="post" action="upload_ecommerce.php" enctype="multipart/form-data">
	
	<input type="hidden" name="campo" value="offerta" />
	
	<?php
	$sql = "SELECT id, titolo FROM ecommerce WHERE offerta = 1";
	$rssql = mysql_query( $sql );
	
	while( $r = mysql_fetch_array( $rssql ) ){
	?>
	
		<div class="float140"><?=$r[1]?>:</div>
		<div class="float300">	
			si <input type="radio" name="riservato[<?=$r[0]?>]" value="1" checked="checked" /> / 
			no <input type="radio" name="riservato[<?=$r[0]?>]" value="0" />
		</div>
		
		<div class="azzerafloat"><br></div>
	
	<?php
	}
	?>
	
	<input type="submit" class="medio" value="Modifica" />
	
	</form>	

</div>
