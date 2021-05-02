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

$errore = null;
$errore = $_GET["errore"];
$tipoerr = $_GET["tipoerr"];

if ( $errore == "si" ) echo "<h1><img src=\"./img/alert.png\" class=\"ico\" />$tipoerr<img src=\"./img/alert.png\" class=\"ico\" /></h1>";

?>

<div class="contenitore">

<h3>Importa un listino in CSV:</h3>

<form method="post" action="importa_articoli_csv_query.php" enctype="multipart/form-data">

	<p>Inserisci il file CSV da importare: </p>
	<p><input type="file" name="csv_articoli" value="" /></p>
	<p>&nbsp;</p>
	<p>
		Resettare tutti gli articoli: 
		SI <input type="radio" name="svuota_articoli" value="1" onclick="return confirm('Se confermi eliminerai tutti gli articoli e le categorie gi&agrave; presenti')" />
		NO <input type="radio" name="svuota_articoli" value="0" checked />
	</p>
	<p>&nbsp;</p>	
	<p>
		Formattare articoli in HTML: 
		SI <input type="radio" name="format_html" value="1" />
		NO <input type="radio" name="format_html" value="0" checked />
	</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<input type="submit" name="" value="Importa" />
	
</form>

</div>
















