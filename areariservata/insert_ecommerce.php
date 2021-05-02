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

$id = (int)$_GET['id'];

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
	$control = array();
	$control[0]= $_GET["titolo"];
	$control[1]= $_GET["descrizione"];
	$control[2]= $_GET["categoria"];
	$control[3]= $_GET["prezzo"];
	$control[4]= $_GET["quantita"];
	$control[5]= $_GET["foto"];
	$control[6]= $_GET["fotofac"];
	$control[7] = $_GET["codice"];
	$control[8] = $_GET["produttore"];
	$control[9] = $_GET["spedizione"];
	$control[10] = $_GET["riservato"];
	$control[11] = $_GET["prezzo_intero"];
	$control[12] = $_GET["colore"];
	$control[13] = $_GET["taglia"];
	$control[14] = $_GET["evidenzia"];
	$control[15] = $_GET["offerta"];

	if($control[3]=="")
	{
		$control[3]=0;
	}
	if($control[9]=="")
	{
		$control[9]=0;
	}
	if($control[11]=="")
	{
		$control[11]=0;
	}
	
	// se il valore di id è vuoto, allora siamo in fase di inserimento 
	$annulla = "<input type=\"button\" 
	class=\"medio\" name=\"Annulla\" value=\"Annulla\" onclick=\"javascript:window.location='area.php?pag=elenco_ecommerce_categorie.php'\" />";

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
	$annulla ="<input type=\"button\" 
	class=\"medio\" name=\"Annulla\" value=\"Annulla\" onclick=\"javascript:window.location='area.php?pag=elenco_ecommerce_categorie.php'\" />";

	$str=" SELECT titolo , descrizione , categoria , prezzo , quantita , foto, fotofacoltative, codice, produttore, spedizione, riservato, prezzo_intero, colore, taglia, evidenzia, offerta FROM ecommerce WHERE id='$id' LIMIT 1";
	$risultato=mysql_query($str);
	$control=mysql_fetch_row($risultato);
}
?>

<div class="contenitore">
<form name="ecommerce" method="post" action="insert_ecommerce_query.php" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?=$id?>"/>
<h3><?=$parola?> Articolo:</h3>
<div class="azzerafloat"><br></div>
	<div class="float140">Codice:</div>
	<div class="float500">
		<input type="text" name="codice" class="medio" size="95" maxlength="200" tabindex="1" value="<?=$control[7]?>"/>
	</div>
<div class="azzerafloat"><br></div>
	<div class="float140">Titolo:</div>
	<div class="float500">
		<input type="text" name="titolo" size="95" maxlength="200" tabindex="1" value="<?=$control[0]?>"/>
	</div>
<div class="azzerafloat"><br></div>
	<div class="float140">Produttore:</div>
	<div class="float500">
		<input type="text" name="produttore" size="95" maxlength="200" tabindex="1" value="<?=$control[8]?>"/>
	</div>
	<div class="azzerafloat"><br></div>
	<div class="float140">Descrizione:</div>
	<div class="float615">
		<?
			echo "<textarea id=\"corpo_ck\" name=\"descrizione\">$control[1]</textarea>
					<script type=\"text/javascript\">
						CKEDITOR.replace( 'descrizione');
					</script>
			";
		?>
	</div>
	<div class="azzerafloat"><br></div>
	<div class="float160">&nbsp;</div>
	<div class="float140">Categoria:</div>
	<div class="float300">
    <select name="categoria" size="1" tabindex="6">
	<?php
		$query="
			SELECT e.id, e.categoria, l.lingua 
			FROM ecommercecategoria AS e 
			INNER JOIN lingue AS l ON l.id = e.id_lingua 
			WHERE e.id_padre = 0
		";
		$rssql = mysql_query( $query );
		echo "<option value=\"0\"> -------------- </option>";
		while( $r = mysql_fetch_row( $rssql ) ){
			$sel = ( $r[0] == $control[2] ) ? "selected='selected'" : "";
			echo "<option value=\"$r[0]\" $sel> $r[1] - $r[2] </option>";
			select_categorie_ecommerce( $r[0], 1, $control[2] );
		}
	?>
    </select>
     </div>
    <div class="azzerafloat"><br></div>
    
    
    <div class="float160">&nbsp;</div>
	<div class="float140">Prezzo:</div>
	<div class="float300">
		<input type="text" class="medio" name="prezzo" size="20" maxlength="10" tabindex="1" value="<?=$control[3]?>"/> &euro;
	</div>
    <div class="azzerafloat"><br></div>
    <div class="float160">&nbsp;</div>
	<div class="float140">Prezzo intero:</div>
	<div class="float300">
		<input type="text" class="medio" name="prezzo_intero" size="20" maxlength="10" tabindex="1" value="<?=$control[11]?>"/> &euro;
	</div>
	<div class="azzerafloat"><br></div>
    <div class="float160">&nbsp;</div>
	<div class="float140">Spese agg di spedizione:</div>
	<div class="float300">
		<input type="text" class="medio" name="spedizione" size="20" maxlength="10" tabindex="1" value="<?=$control[9]?>"/> &euro;
	</div>
	<div class="azzerafloat"><br></div>
	<div class="float160">&nbsp;</div>
	<div class="float140">Quantit&agrave;:</div>
	<div class="float300">
		<input type="text" class="little" name="quantita" size="20" maxlength="10" tabindex="1" value="<?=$control[4]?>"/>
	</div>
	<div class="azzerafloat"><br></div>
	<div class="float160">&nbsp;</div>
	<div class="float140">Colore:</div>
	<div class="float300">
		<input type="text" class="little" name="colore" size="20" maxlength="10" tabindex="1" value="<?=$control[12]?>"/>
	</div>
	<div class="azzerafloat"><br></div>
	<div class="float160">&nbsp;</div>
	<div class="float140">Taglia:</div>
	<div class="float300">
		<input type="text" class="little" name="taglia" size="20" maxlength="10" tabindex="1" value="<?=$control[13]?>"/>
	</div>
	<div class="azzerafloat"><br></div>
	<div class="float160">&nbsp;</div>
	<div class="float140">Riservato:</div>
	<div class="float300">
		<?php
		$checked_si = $checked_no = "";
		if ( $control[10] == 1 )
			$checked_si = "checked=\"checked\"";
		elseif ( $control[10] == 0 )	
			$checked_no = "checked=\"checked\"";
		?>
		
		si <input type="radio" name="riservato" tabindex="1" value="1" <?=$checked_si?> /> / 
		no <input type="radio" name="riservato" tabindex="1" value="0" <?=$checked_no?> />
	</div>
	
	<div class="azzerafloat"><br></div>
	<div class="float160">&nbsp;</div>
	<div class="float140">Metti in evidenza:</div>
	<div class="float300">
		<?php
		$checked_si = $checked_no = "";
		if ( $control[14] == 1 )
			$checked_si = "checked=\"checked\"";
		elseif ( $control[14] == 0 )	
			$checked_no = "checked=\"checked\"";
		?>
		si <input type="radio" name="evidenzia" tabindex="1" value="1" <?=$checked_si?> /> / 
		no <input type="radio" name="evidenzia" tabindex="1" value="0" <?=$checked_no?> />
	</div>
	
	<div class="azzerafloat"><br></div>
	<div class="float160">&nbsp;</div>
	<div class="float140">Offerta speciale:</div>
	<div class="float300">
		<?php
		$checked_si = $checked_no = "";
		if ( $control[15] == 1 )
			$checked_si = "checked=\"checked\"";
		elseif ( $control[15] == 0 )	
			$checked_no = "checked=\"checked\"";
		?>
		
		si <input type="radio" name="offerta" tabindex="1" value="1" <?=$checked_si?> /> / 
		no <input type="radio" name="offerta" tabindex="1" value="0" <?=$checked_no?> />
	</div>
	
	
	<div class="azzerafloat"><br></div>


<script type="text/javascript">
function openKCFinder(field) {
    window.KCFinder = {
        callBack: function(url) {
            window.KCFinder = null;
            field.value = url;
        }
    };
    window.open('../kcfinder/browse.php?type=images', 'kcfinder_textbox',
        'status=0, toolbar=0, location=0, menubar=0, directories=0, ' +
        'resizable=1, scrollbars=0, width=800, height=600'
    );
}
</script>


	<div class="float140">Foto principale:</div>
	<div class="float500">
		<input type="text" class="medio" size="95" name="foto" tabindex="1" readonly="readonly" onclick="openKCFinder(this)" value="<?=$control[5]?>" />
	</div>
	<div class="azzerafloat"><br></div>
	
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
	
	
	<div class="float140">Foto facoltative: <br /><br />Cliccare nel box e scegliere piu' file con il tasto CTRL. <br /><br />
Quindi fare click destro su uno di essi e scegliere SELECT.</div>
	<div class="float500">
		<textarea name="fotofac" cols="80" rows="8" id="files" readonly="readonly" onclick="openKCFinder(this)" value="<?=$control[6]?>"><?=$control[6]?></textarea>
	</div>
	<div class="azzerafloat"><br></div>
		<br/>
	<input type="submit" class="medio" value="<?=$parola?>" tabindex="7"/>  
	<?=$annulla?> 
<div class="azzerafloat"><br></div>

</form>	
</div>


<?=onbeforeunload()?>
