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

$parola = "Seleziona";

$annulla = "<input type=\"button\" 
class=\"medio\" name=\"Annulla\" value=\"Annulla\" onclick=\"javascript:window.location='area.php'\" />";

$defpag= array ("News(standard)","Gallerie","Eventi","Pagina Statica","Sondaggio","Custom","E-commerce","Vetrina e-commerce standard");

$def = 0;
$defrich="";

if (isset($_POST["selezione"])) {
	$def = $_POST["default"];
	$defrich = "sel_pagdef$def.php";
}
	
?>
<h3>Home Page</h3>
<div class="contenitore">
	
	<br />
	<hr />
	<form name="modify_pagdef" method="post" action="./area.php?pag=insert_pagdef.php">
		<div>
			Selezionare il tipo di pagina iniziale che vuoi abbia il sito:
			<?php
				selezione("default",$defpag,$def);		
			?>
		</div>
		
		<input class="medio" type="submit" name="selezione" value="<?=$parola?>"/>
		<?=$annulla?>
		
	</form>

	<br/>
	<?php if ( $defrich != "" ) include ( $defrich ); ?>
	
</div>
