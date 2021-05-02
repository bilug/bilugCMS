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
<link type="text/css" href="css/ui-lightness/jquery-ui-1.7.3.custom.css" rel="stylesheet" />	
		<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
		<script type="text/javascript" src="js/jquery-ui-1.7.3.custom.min.js"></script>
<style type="text/css">
	#tabs {
		width: 99%;
	}
	</style>
	<script type="text/javascript">
	$(function() {
		$("#tabs").tabs();
	});
	</script>
<?

$parola = "Conferma";
	
$errore=null;
$errore=$_GET["errore"];
$tipoerr=$_GET["tipoerr"];
if($errore=="si")
{
		echo "<h1><img src=\"./img/alert.png\" class=\"ico\" />$tipoerr<img src=\"./img/alert.png\" class=\"ico\" /></h1>";
}

	$annulla = "<input type=\"button\" 
	class=\"medio\" name=\"Annulla\" value=\"Annulla\" onclick=\"javascript:window.location='area.php'\" />";

	
	$sezione = "<br/><div><h1>sezione</h1><hr/></div>\n";
	$label = "<div class=\"float200\">label:</div>\n<div class=\"float500\">\n";
	$campo = "<input type=\"text\" name=\"nome\" size=\"95\" maxlength=\"254\" value=\"valore\"/>\n";
	$campotesto = "<textarea name=\"nome\" rows=\"righe\" cols=\"95\">valore</textarea>\n";
	$div = "</div>\n<div class=\"azzerafloat\"></div>\n";
?>
<form name="modify_param" method="post" action="insert_param_query.php" enctype="multipart/form-data">
<h3> Parametri </h3>
	<div id="tabs">
	<ul>
        <li><a href="#fragment-1"><span>Sito</span></a></li>
        <li><a href="#fragment-2"><span>Argomenti</span></a></li>
        <li><a href="#fragment-3"><span>Galleria</span></a></li>
        <li><a href="#fragment-4"><span>Galleria Random</span></a></li>
        <li><a href="#fragment-5"><span>Eventi</span></a></li>
        <li><a href="#fragment-6"><span>Pagine Statiche</span></a></li>
        <li><a href="#fragment-7"><span>E-commerce</span></a></li>
        <li><a href="#fragment-9"><span>Conferma</span></a></li>
        <li><a href="#fragment-8"><span>Aggiungi costante</span></a></li>
	</ul>             

<?
$str="SELECT sezione,label,nomecampo,valore,tipo,ID FROM parametri order by sezione";
$risultato=mysql_query($str);
$sez ="";
 $pr=1;
 $prima='si';
if (mysql_num_rows($risultato)>0)
{
	while ($control=mysql_fetch_row($risultato))
	{

		if (($sez=="")OR($sez != $control[0]))
		{
		if($prima == 'no')
		{	$pr++;
			echo " </div>
			</div>";
		}
			echo "<div id=\"fragment-$pr\">
<div class=\"contenitore\">";
	$prima = 'no';
			$sez = $control[0];
			$sezione1 = str_replace("sezione",$tipisezione[$control[0]],$sezione);
			echo $sezione1;
			
		}	
		$label1 = str_replace("label",$control[1]."(".$control[2].")",$label);
		echo $label1;
		if (strlen($control[3])<95)
		{	
		 $campo1 = str_replace(array("nome","valore"),array($control[5],$control[3]),$campo);
		}
	   else
	   {
	   	$campo1 = str_replace(array("nome","valore","righe"),array($control[5],$control[3],((strlen($control[3])/50)+1)),$campotesto);	   	
	   }
	   echo $campo1;
	   selezione($control[5]."_tipo",$tipivariabile,$control[4]);
	   echo $div;

   }

}
  
?>
</div>
	</div>
<div id="fragment-8">
	<div class="contenitore">
	<div class="azzerafloat"></div>
	<div>
	Aggiunta Costante<br/>
	Descrizione	<input type="text" name="label" size="95" maxlength="100"  value=""/><br/>
	Nome del campo	<input type="text" name="nomecampo" size="95" maxlength="50" value=""/><br/>
	Valore	<textarea name="valore" rows="5" cols="95"></textarea><br/>	
	Sezione e Tipo	
	<?
		selezione("sezione",$tipisezione);
		selezione("tipo",$tipivariabile);
	?>
	<input class="medio" type="submit" name="op" value="Aggiungi"/>	
	</div>
	<br/><br/>
</div>
</div>
<div id="fragment-9">
	<input class="medio" type="submit" value="<?=$parola?>"/>
	<?=$annulla?>
</div>
</form>
</div>
