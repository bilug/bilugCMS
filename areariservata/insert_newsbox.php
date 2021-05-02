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
if ($id)
{
	$parola=Modifica;
   // se id ha un valore, allora siamo in fase di modifica 
	$annulla ="<input type=\"button\" 
	class=\"medio\" name=\"Annulla\" value=\"Annulla\" onclick=\"javascript:window.location='area.php?pag=elenco_newsbox.php'\" />";

	$str=" SELECT id, notizia, immagine, modulo, testo, id_lingua FROM newsbox WHERE id = $id LIMIT 1";
   $risultato=mysql_query($str);
   if (mysql_num_rows($risultato)>0)
   $control=mysql_fetch_row($risultato);
	
	$lingua = $control[5];
}
?>
<div class="contenitore">
<form name="statiche" method="post" action="insert_newsbox_query.php" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?=$id?>"/>
<!-- il valore di id lo passiamo alla pagina di action con un campo nascosto -->
	<h3><?=$parola?> Newsbox:</h3>
  
	<div class="azzerafloat"></div>
	<div class="float140">Testo:</div>
	<div class="float200">
		<textarea name="testo" style="width:500px;height:100px;"><?=$control[4]?></textarea>				 
	</div>

  <div class="azzerafloat"></div><br />
  <div class="float140">Notizia:</div>
  <div class="float200">
	   <select name="notizia">
      <?php
          $sql3 = "SELECT id, argomenti FROM argomenti";
          $rssql3 = mysql_query( $sql3 );
          while( $k = mysql_fetch_array( $rssql3 ) ) {
              $sql2 = "SELECT id, titolo FROM notizie WHERE argomento = $k[0]";
              $rssql2 = mysql_query( $sql2 );
              echo "<optgroup label=\"------------ $k[1] ------------\">";
              while( $r = mysql_fetch_array( $rssql2 ) ) {
                  $sel = "";
                  if ( $r[0] == $control[1] )
                      $sel = "selected=\"selected\"";
                      
                  echo "<option value=\"$r[0]\" $sel>$r[1]</option>";
              }
              echo "</optgroup>";
          }
      ?>
     </select>	
  </div>
  
  <div class="azzerafloat"></div><br />
  <div class="float140">Lingua:</div>
  <div class="float200">
	   <select name="lingua">
      <?php
 		$sql = "SELECT id, sigla FROM lingue";
		$rssql = mysql_query( $sql );
		while( $r = mysql_fetch_row( $rssql ) ){
			$sel = '';
			if ( $r[0] == $lingua ) {
				$sel = "selected='selected'";
			}
				
			echo "<option value=\"$r[0]\" $sel> $r[1] </option>";
		}
      ?>
     </select>	
  </div>
  
  <div class="azzerafloat"></div><br />
  <div class="float140">Immagine:</div>
	<div class="float500">
		<input type="text" class="medio" size="95" name="immagine" tabindex="1" readonly="readonly" onclick="openKCFinder(this)" value="<?=$control[2]?>" />
	</div>
  <script type="text/javascript">
  
  function openKCFinder(textarea) {
      window.KCFinder = {
          callBackMultiple: function(files) {
              window.KCFinder = null;
              textarea.value = "";
              for (var i = 0; i < files.length; i++)
                  textarea.value += files[i] + ";";
          }
      };
      window.open('../kcfinder/browse.php?type=images',
          'kcfinder_multiple', 'status=0, toolbar=0, location=0, menubar=0, ' +
          'directories=0, resizable=1, scrollbars=0, width=800, height=600'
      );
  }
  
  </script>

	<div class="azzerafloat"></div><br />
	<input type="submit" class="medio" value="<?=$parola?>" tabindex="7"/>  
	<?=$annulla?>             
</form>
</div>



