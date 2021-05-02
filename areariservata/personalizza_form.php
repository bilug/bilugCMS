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

	$filetesta= "../custom/testaform.php";
	$filepiede= "../custom/piedeform.php";

	if(file_exists($filetesta))
	{
			$testa=fopen($filetesta,"r");
			$conttesta = fread($testa, filesize($filetesta));
	}
	if(file_exists($filepiede))
	{
			$piede=fopen($filepiede,"r");
			$contpiede = fread($piede, filesize($filepiede));
	}

	$annulla = "<input type=\"button\" 
		class=\"medio\" name=\"Annulla\" value=\"Annulla\" onclick=\"javascript:window.location='area.php'\" />";	

?>


<div class="contenitore">
<form name="form" method="post" action="personalizza_form_query.php" enctype="multipart/form-data">
<div class="float400">	<h3>Intestazione:</h3> </div>
<div class="float100"> &nbsp; </div>
<div class="float400">	<h3>Pie Pagine:</h3>	</div>
<div class="azzerafloat"></div>
	<div class="float400">
		<?
			echo "<textarea name=\"testa\">$conttesta</textarea>
					<script type=\"text/javascript\">
						CKEDITOR.replace( 'testa' );
					</script>
			";
		?>
	</div>
<div class="float100"> &nbsp; </div>
	<div class="float400">
		<?
			echo "<textarea name=\"piede\">$contpiede</textarea>
					<script type=\"text/javascript\">
						CKEDITOR.replace( 'piede' );
					</script>
			";
		?>
	</div>
<div class="azzerafloat"></div>
<br><br>	
	<input type="submit" class="medio" value="Invia" tabindex="7"/>  
	<?=$annulla?>  
	<?
		@fclose($testa);
		@fclose($piede);
	?>
</form>
</div>

