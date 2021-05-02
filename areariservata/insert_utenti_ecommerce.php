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
	$annulla = "<input type=\"button\" 
	class=\"medio\" name=\"Annulla\" value=\"Annulla\" onclick=\"javascript:window.location='area.php?pag=elenco_ecommerce_categorie.php'\" />";
	
	$control[1]=$_GET["nome"];
	$control[2]=$_GET["note"];
	$control[3]=$_GET["pwd"];
	
}
else
{
	$parola=Modifica;
  	// se id ha un valore, allora siamo in fase di modifica 
	$annulla ="<input type=\"button\" 
	class=\"medio\" name=\"Annulla\" value=\"Annulla\" onclick=\"javascript:window.location='area.php?pag=elenco_ecommerce_categorie.php'\" />";
   $str=" SELECT * FROM ecommerceris where ID='$id'";
   $risultato=mysql_query($str);
   if (mysql_num_rows($risultato)>0)
   {
   	$control=mysql_fetch_row($risultato);
      // assegnamo alla var (array) $control[x] (che ci serve nella form per assegnare il value) i valori della query
   }
}
?>
<div class="contenitore">
<form name="utentiris" method="post" action="insert_utenti_ecommerce_query.php" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?=$id?>"/>
<!-- il valore di id lo passiamo alla pagina di action con un campo nascosto -->
   <h3><?=$parola?> l'utente dell'area riservata e-commerce:</h3>
   <div class="azzerafloat"></div>
	<div class="float200">
		Nome: (*)
	</div>
   <div class="float500">
   	<input type="text" name="nome" size="80" maxlength="50" tabindex="1" value="<?=$control[1]?>"/>
   </div>
   <div class="azzerafloat"></div>
   <div class="float200">
   	Note:
   </div>
   <div class="float500">
   	<input type="text" name="note" size="80" maxlength="50" tabindex="2" value="<?=$control[2]?>"/>
   </div>
   <div class="azzerafloat"></div>
	<div class="float200">
		Password di accesso: (*)
	</div>
   <div class="float500">
   	<input type="text" name="pwd" size="80" maxlength="50" tabindex="3" value="<?=$control[3]?>"/>
   </div>
   <div class="azzerafloat"></div>
	<br />
    <h3>(*) = Campi obbligatori</h3>
    <input type="submit" class="medio" value="<?=$parola?>" tabindex="13"/>  
    <?=$annulla?>             
</form>
</div>
