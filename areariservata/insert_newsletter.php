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
<?

$errore=null;
$errore=$_GET["errore"];
$tipoerr=$_GET["tipoerr"];
if($errore=="si")
{
		echo "<h1><img src=\"./img/alert.png\" class=\"ico\" />$tipoerr<img src=\"./img/alert.png\" class=\"ico\" /></h1>";
}

$parola=Invia;

if ( isset( $_GET['id'] ) ) {
	$id = $_GET['id'];
	
	if ( $_GET['tipo'] == 's' )
		$sql_nl = "SELECT titolo, corpo FROM statiche WHERE ID = $id LIMIT 1";
	elseif ( $_GET['tipo'] == 'd' )
		$sql_nl = "SELECT titolo, testo FROM notizie WHERE ID = $id LIMIT 1";
	
	$rssql_nl = mysql_query( $sql_nl );
	$soggetto = mysql_result( $rssql_nl, 0, 0 );
	$testo = mysql_result( $rssql_nl, 0, 1 );
}
else {
	$soggetto = $_GET['soggetto'];
	$testo = $_GET['testo'];
}


$annulla = "<input type=\"button\" 
class=\"medio\" name=\"Annulla\" value=\"Annulla\" onclick=\"javascript:window.location='area.php?pag=elenco_newsletter.php'\" />";

?>
<div class="contenitore">
<form name="notizie" method="post" action="insert_newsletter_query.php" enctype="multipart/form-data">
	<h3><?=$parola?> Newsletter:</h3>
	
	
	<div class="azzerafloat"></div>
	<div class="float140">Soggetto:</div>
	<div class="float500">
		<input type="text" name="soggetto" size="95" maxlength="200"  value="<?=$soggetto;?>"/>
	</div>
	<div class="azzerafloat"></div>
	
	
	
	<div class="float140">Testo:</div>
	<div class="float615">
		<?
		echo "<textarea name=\"testo\">$testo</textarea> <script type=\"text/javascript\"> CKEDITOR.replace( 'testo' );	</script>";
		?>
	</div>
	<div class="azzerafloat"></div>
	
	
	
	<div class="float140">Gruppo newsletter:</div>
	<div class="float500">
		<select name="gruppo_utente">
		<?php
			echo "<option value=\"0\">--------</option>";
			$sql = "SELECT id, nome FROM gruppi_newsletter";
			$rssql = mysql_query( $sql );						
			while( $r = mysql_fetch_array( $rssql ) ) {
				echo "<option value=\"$r[0]\">$r[1]</option>";
			}
		?>
		</select>	
	</div>
	<div class="azzerafloat"></div>
	
	
	<div class="float140">Lingua:</div>
	<div class="float500">
		<select name="lingua">
		<?php
			$sql = "SELECT id, sigla FROM lingue";
			$rssql = mysql_query( $sql );						
			while( $r = mysql_fetch_array( $rssql ) ) {
				echo "<option value=\"$r[0]\">$r[1]</option>";
			}
		?>
		</select>	
	</div>
	<div class="azzerafloat"></div>
	
	
	
	<input type="submit" class="medio" value="<?=$parola?>"/>  
	<?=$annulla?>             
</form>
</div>
