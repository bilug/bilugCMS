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

$id = $_GET['id'];


$errore=null;
$errore=$_GET["errore"];
$tipoerr=$_GET["tipoerr"];
if($errore=="si")
{
		echo "<h1><img src=\"./img/alert.png\" class=\"ico\" />$tipoerr<img src=\"./img/alert.png\" class=\"ico\" /></h1>";
}

if (!$id)
{
	$parola=Inserisci;
	$control[0]= $_GET["tipo"];
	$control[1]= $_GET["minore"];
	$control[2]= $_GET["maggiore"];
	$control[3]= $_GET["prezzo"];
	
	if($control[3]=="")
	{
		$control[3]=0;
	}
	
	// se il valore di id è vuoto, allora siamo in fase di inserimento 
	$annulla = "<input type=\"button\" 
	class=\"medio\" name=\"Annulla\" value=\"Annulla\" onclick=\"javascript:window.location='area.php?pag=elenco_spedizioni.php'\" />";	
}

else
{
	if($_SESSION['typo']== "U")
	{
		echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php\" />";
		$msg = "AZIONE NON CONSENTITA";				  
		confirm($msg);
		exit;
	}
	
	$parola=Modifica;
   // se id ha un valore, allora siamo in fase di modifica 
	$annulla = "<input type=\"button\" 
	class=\"medio\" name=\"Annulla\" value=\"Annulla\" onclick=\"javascript:window.location='area.php?pag=elenco_spedizioni.php'\" />";	
	
	$str=" SELECT tipo , minore , maggiore, prezzo, standard FROM spedizione where id='$id'";
	$risultato=mysql_query($str);
	$control=mysql_fetch_row($risultato);
	
}
?>
<div class="contenitore">
<form name="ecommerce" method="post" action="insert_spedizioni_query.php">
<input type="hidden" name="id" value="<?=$id?>"/>
<h3><?=$parola?> Spedizione:</h3>
<div class="azzerafloat"><br></div>
	<div class="float140">Tipo:</div>
	<div class="float500">
		<input type="text" name="tipo"  size="95" maxlength="200" tabindex="1" value="<?=$control[0]?>"/>
	</div>
<div class="azzerafloat"><br></div>
	<div class="float140">fascia limite minore <br>(+1 dal limite sup precedente):</div>
	<div class="float500">
		<input type="text" name="minore" class="medio" maxlength="200" tabindex="1" value="<?=$control[1]?>"/> &euro;
	</div>	
<div class="azzerafloat"><br></div>
	<div class="float140">fascia limite maggiore (vuoto se non c'e' limite):</div>
	<div class="float500">
		<input type="text" name="maggiore" class="medio" maxlength="200" tabindex="1" value="<?=$control[2]?>"/> &euro;
	</div>	
<div class="azzerafloat"><br></div>
	<div class="float140">Prezzo:</div>
	<div class="float500">
		<input type="text" name="prezzo" class="medio" size="95" maxlength="200" tabindex="1" value="<?=$control[3]?>"/> &euro;
	</div>	
<div class="azzerafloat"><br></div>
	<div class="float140">Standard:</div>
	<div class="float500">
		<input type="checkbox" name="standard" value="pred" <?=$control[4]?> />
	</div>	
<div class="azzerafloat"><br></div>
<br/>
	<input type="submit" class="medio" value="<?=$parola?>" tabindex="7"/>  
	<?=$annulla?> 
<div class="azzerafloat"><br></div>

</form>	
</div>
