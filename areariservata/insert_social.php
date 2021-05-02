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

$id = $_GET['id'];
if (!$id)
{
	$parola=Inserisci;
   // se il valore di id è vuoto, allora siamo in fase di inserimento 
   
   $control[0]=$_GET["nome"];
   $control[1]=$_GET["img"];
   $control[2]=$_GET["link"];

	$annulla = "<input type=\"button\" 
	class=\"medio\" name=\"Annulla\" value=\"Annulla\" onclick=\"javascript:window.location='area.php?pag=elenco_social.php'\" />";	
}
else
{
	$parola=Modifica;
   // se id ha un valore, allora siamo in fase di modifica 
	$annulla ="<input type=\"button\" 
	class=\"medio\" name=\"Annulla\" value=\"Annulla\" onclick=\"javascript:window.location='area.php?pag=elenco_social.php'\" />";

	$str=" SELECT nome, img, link FROM social WHERE id = $id LIMIT 1";
	$risultato=mysql_query($str);
	
	if ( mysql_num_rows( $risultato ) > 0 )
		$control = mysql_fetch_row( $risultato );
}
?>
<div class="contenitore">
<form name="statiche" method="post" action="insert_social_query.php" enctype="multipart/form-data">
	<input type="hidden" name="id" value="<?=$id?>"/>

	<h3><?=$parola?> link social:</h3>
	<div class="azzerafloat"></div>
	<div class="float140">Nome social:</div>
	<div class="float500">
		<input type="text" name="nome" size="70" value="<?=$control[0]?>"/>
	</div>		
	
	<div class="azzerafloat"></div><br />
	<div class="float140">Link:</div>
	<div class="float500">
		<input type="text" name="link" size="70" value="<?=$control[2]?>"/>
	</div>		
	
	<div class="azzerafloat"></div><br />
	<div class="float140">Immagine:</div>
	<div class="float500">
		<input type="file" name="img" value=""/>
		<br /><br />
		<?php if ( $control[1] != '' ) : ?>
			<img src="../img/social/<?=$control[1]?>" height="" width="" alt="" />
		<?php endif; ?>
	</div>	
	<div class="azzerafloat"></div><br />
	
	<input type="submit" class="medio" value="<?=$parola?>" />  
	<?=$annulla?>             
</form>
</div>



