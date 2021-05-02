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
	$nome=$_GET["arg"];
  $sotto_arg = $_GET["sotto_arg"];
 	$annulla = "<input type=\"button\" 
	class=\"medio\" name=\"Annulla\" value=\"Annulla\" onclick=\"javascript:window.location='area.php?pag=elenco_ecommerce_categorie.php'\" />";
}
else
{
	$parola=Modifica;
  	// se id ha un valore, allora siamo in fase di modifica 
  $sotto_arg = $_GET["sotto_arg"];

	$annulla ="<input type=\"button\" 
	class=\"medio\" name=\"Annulla\" value=\"Annulla\" onclick=\"javascript:window.location='area.php?pag=elenco_ecommerce_categorie.php'\" />";
   $str=" SELECT id, categoria FROM ecommercecategoria WHERE id='$id'";
   $risultato=mysql_query($str);
	if (mysql_num_rows($risultato)>0)
	{
		$control=mysql_fetch_row($risultato);

    $c = substr( $control[1], 0, ( strlen( $control[1] ) - 2 ) );
    $c = explode( '||', $c );
    $sc = explode( '--', $c[1] ); 
    $sotto_cat_val = $sc[$sotto_arg]; 
   	
    $nome=$control[1];
	}
  
}
?>
<div class="contenitore">
<form name="modify_arg" method="post" action="insert_ecommerce_sottocategorie_query.php" enctype="multipart/form-data">

<input type="hidden" name="id" value="<?=$id?>" />
<input type="hidden" name="id_sc" value="<?=$sotto_arg?>" />

<!-- il valore di id lo passiamo alla pagina di action con un campo nascosto -->
	<h3><?=$parola?> la sotto-categoria:</h3>
	Sotto-categoria: <input type="text" name="sotto_cat" size="45" maxlength="50" tabindex="1" value="<?=$sotto_cat_val?>"/>
  <br /><br />
  
  Categoria: 
  <?php if (!$id) { ?>
      <select name="categoria">
      <?php
      $sql = "SELECT id, categoria FROM ecommercecategoria";
      $rssql = mysql_query( $sql );
      while( $r = mysql_fetch_array( $rssql ) ){
          $cat = explode( '||', $r[1] );
          $cat = $cat[0];
          echo "<option value=\"$r[0]\">$cat</option>";
      }
      ?>
      </select>
  <?php 
      } else {
          $sql = "SELECT id, categoria FROM ecommercecategoria WHERE id = $id LIMIT 1";
          $rssql = mysql_query( $sql );
          $cat = mysql_result( $rssql, 0, 1 );
          $cat = explode( '||', $cat );
          $cat = $cat[0];
          echo "<strong>$cat</strong>";      
      } 
  ?>
  <br /><br />
	<input class="medio" type="submit" value="<?=$parola?>"/>
	<?=$annulla?>
</form>
</div>

