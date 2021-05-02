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

$id = (int)$_GET['id'];

$errore = null;
$errore = $_GET["errore"];
$tipoerr = $_GET["tipoerr"];

if($errore=="si")
	echo "<h1><img src=\"./img/alert.png\" class=\"ico\" />$tipoerr<img src=\"./img/alert.png\" class=\"ico\" /></h1>";

$annulla = "<input type=\"button\" 
	class=\"medio\" name=\"Annulla\" value=\"Annulla\" onclick=\"javascript:window.location='area.php?pag=elenco_menu_new.php'\" />";

$str = "SELECT titolo, tipo FROM menutipo WHERE id = '$id' LIMIT 1";
$risultato = mysql_query($str);
if ( mysql_num_rows($risultato) > 0 )
  	$control = mysql_fetch_row($risultato);

?>

<div class="contenitore">
<form name="modify_link" method="post" action="insert_sotmenu_link_query.php">
<input type="hidden" name="id" value="<?=$id?>"/>

<!-- il valore di id lo passiamo alla pagina di action con un campo nascosto -->
	<h3>link:</h3>
<div class="azzerafloat"></div>
	<div class="float100">	<h1>Titolo:</h1>  </div>
	<div class="float200">	<?=$control[0]?>	</div>
	<div class="float100"> <h1>Tipo:</h1> </div>
	<div class="float100"> <?=$control[1]?> </div>
	<br><br>
	<div class="float100">	<h1>link:</h1>  </div>
	<div class="azzerafloat"></div>
	<br><br>
	<div class="float100"> &nbsp; </div>
	<div class="float100">	<h1>news:</h1> </div>
	<div class="float20"> <input type="radio" class="little" name="tipolink" value="nw"> </div>
    <div class="float500">	
    <select name="news" onfocus="document.modify_link.tipolink[0].checked='true'">
		<option value="">--------</option>
		<?php
		$strs=" SELECT titolo, argomento, ID FROM notizie WHERE autorizza='si' ORDER BY argomento";
		$risultatos=mysql_query($strs);
		$argomento=0;
		$primo=0;
		
		while( $controls = mysql_fetch_row($risultatos) ) {
			if ($argomento != $controls[1]) {
				if ($primo!=0) {
					echo "</optgroup>";
					$primo =1;
				}
				$str1s=" SELECT argomenti FROM argomenti WHERE ID = '$controls[1]' LIMIT 1";
				$risultato2s=mysql_query($str1s);
				$control1s=mysql_fetch_row($risultato2s);

				echo "<optgroup label=\"$control1s[0]\">";
				$argomento=$controls[1];

				$link = rurl( $controls[1], 'argo' );
				echo "<option value=\"$link\">Argomento: $control1s[0]</option>";				
		   }
		   $link = rurl( $controls[2], 'news' );
		   echo "<option value=\"$link\">$controls[0]</option>";
		}
		?>
    </select>
    </div>
    <br><br>
	
    <div class="float100"> &nbsp; </div>
	<div class="float100">	<h1>statiche:</h1>  </div>
    <div class="float20">	<input type="radio" class="little" name="tipolink" value="st"></div>
    <div class="float500">	
    <select name="statiche" onfocus="document.modify_link.tipolink[1].checked='true'">
		<option value="">--------</option>
	<?
    $stat=" SELECT id, titolo FROM statiche ORDER BY ordine";
	$ristat=mysql_query($stat);
	while($statiche=mysql_fetch_row($ristat)) {
		$link = rurl( $statiche[0], 'static' );
		echo "<option value=\"$link\">$statiche[1]</option>";
	}
    ?>
    </select>
    </div>
    <br><br>
	
    <div class="float100"> &nbsp; </div>
    <div class="float100">	<h1>gallerie:</h1>  </div>
    <div class="float20">	<input type="radio" class="little" name="tipolink" value="gl"></div>
    <div class="float500">	
    <select name="gallerie" onfocus="document.modify_link.tipolink[2].checked='true'">
		<option value="">--------</option>
		<?php
		$sql = "SELECT id, cartella FROM galleria WHERE id_padre = 0 ORDER BY cartella DESC";
		$rssql = mysql_query( $sql );	
		if ( mysql_num_rows( $rssql ) > 0 ) {
			while ( $r = mysql_fetch_row( $rssql ) ){
				echo "<optgroup label=\"$r[1]\">";
					$sql = "SELECT id, cartella FROM galleria WHERE id_padre = $r[0] ORDER BY cartella DESC";
					$rssql2 = mysql_query( $sql );
					while ( $k = mysql_fetch_row( $rssql2 ) ){
						$link = rurl( $k[0], 'gals-sub' );
						echo "<option value=\"$link\">$k[1]</option>";
					}
				echo "</optgroup>";
			}
		}	
		?>
    </select>
    </div>
    <br><br>

    <div class="float100"> &nbsp; </div>
    <div class="float100">	<h1>interno:</h1>  </div>
    <div class="float20">	<input type="radio" class="little" name="tipolink" value="in"></div>
    <div class="float20">&nbsp;</div>
	<div class="float100">	<input type="text" name="int" value="" onfocus="document.modify_link.tipolink[3].checked='true'">
    </div>
    <br><br>
	
    <div class="float100"> &nbsp; </div>
    <div class="float100">	<h1>esterno:</h1>  </div>
    <div class="float20">	<input type="radio" class="little" name="tipolink" value="ex"></div>
    <div class="float20">&nbsp;</div>
	<div class="float100">	<input type="text" name="ext" value="" onfocus="document.modify_link.tipolink[4].checked='true'">
    </div>
    <br><br>
	
    <div class="float100"> &nbsp; </div>
    <div class="float100">	<h1>Home:</h1>  </div>
    <div class="float20">	<input type="radio" class="little" name="tipolink" value="hm"></div>
    <div class="float20">&nbsp;</div>
	<div class="float100">	&nbsp;
    </div>
    <br><br>
	
     <div class="float100"> &nbsp; </div>
    <div class="float100">	<h1>Scrivici:</h1>  </div>
    <div class="float20">	<input type="radio" class="little" name="tipolink" value="sc"></div>
    <div class="float20">&nbsp;</div>
	<div class="float100">	&nbsp;
    </div>
    <br><br>
	
     <div class="float100"> &nbsp; </div>
    <div class="float100">	<h1>Ecommerce:</h1>  </div>
    <div class="float20">	<input type="radio" class="little" name="tipolink" value="ec"></div>
    <div class="float500">	
    <select name="ecommerce" onfocus="document.modify_link.tipolink[7].checked='true'">
		<option value="">--------</option>
		<?php
		$sql = "
			SELECT e.id, e.categoria, l.lingua 
			FROM ecommercecategoria AS e 
			INNER JOIN lingue AS l ON l.id = e.id_lingua 
			WHERE e.id_padre = 0
		";	
		$rssql = mysql_query( $sql );	
		if ( mysql_num_rows( $rssql ) > 0 ) {
			$link = rurl(0, 'ecommerce');
			echo "<option value=\"$link\">Tutti</option>";
			while ( $r = mysql_fetch_row( $rssql ) ){
				$link = rurl($r[0], 'ecommerce-categorie');
				echo "<option value=\"$link\">$r[1]</option>";
				select_categorie_ecommerce( $r[0], 0, 0 );
			}
		}	
		?>
    </select>
    
    </div>
    <br><br>
	
     <div class="float100"> &nbsp; </div>
    <div class="float100">	<h1>Nessuno:</h1>  </div>
    <div class="float20">	<input type="radio" class="little" name="tipolink" value=""></div>
    <div class="float20">&nbsp;</div>
	<div class="float100">	&nbsp;
    </div>	
    <br><br>
	
    <input class="medio" type="submit" value="invia"/>
	<?=$annulla?>
	
</form>
</div>	
	
