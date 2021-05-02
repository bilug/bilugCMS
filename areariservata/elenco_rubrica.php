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
<script type="text/javascript">
$(document).ready(function(){
	$('a.rub[@title]').cluetip({splitTitle: '|', dropShadow: true,cluetipClass: 'sito', sticky: true, closePosition: 'title', closeText: 'X',fx :{open : 'fadeIn',openSpeed:  '3'}});
});
</script>
<h3>Rubrica</h3>
<?php

$filter = $_GET["filter"];
$ricerca = $_POST["ricerca"];
if ($ricerca == "")
{
	if ($filter == '')
		$str="SELECT ID,ragsoc,ragsoc1,ragsoc2,citta,cap,prov,tel,email,note FROM rubrica order by ragsoc";
	else
		$str="SELECT ID,ragsoc,ragsoc1,ragsoc2,citta,cap,prov,tel,email,note FROM rubrica where substr(ragsoc,1,1) = '$filter' order by ragsoc";
}
else
	$str="SELECT ID,ragsoc,ragsoc1,ragsoc2,citta,cap,prov,tel,email,note FROM rubrica WHERE ragsoc LIKE '%$ricerca%' or ragsoc1 LIKE '%$ricerca%' or ragsoc2 LIKE '%$ricerca%' or tel LIKE '%$ricerca%' or email LIKE '%$ricerca%' order by ragsoc";
	
// facciamo una query per caricare gli argomenti
$risultato=mysql_query($str);  
// facciamo una query per caricare le notizie  
echo "<div class=\"contenitore\"><div class=\"azzerafloat\"></div>";
echo "<form name=\"ricrubrica\" method=\"post\" action=\"?pag=elenco_rubrica.php\">";
echo "<a href=\"?pag=elenco_rubrica.php\"><b>Tutti</b></a>";
$str1="SELECT DISTINCT substr(ragsoc,1,1) FROM rubrica order by ragsoc";
$risultato1=mysql_query($str1);
$alista =array();
while($lista=mysql_fetch_row($risultato1))
{
	$alista[] =strtoupper($lista[0]);
}
for ($i=65;$i<91;$i++)
{
	if (in_array(chr($i),$alista))
		echo " - <a href=\"?pag=elenco_rubrica.php&filter=".chr($i)."\">".chr($i)."</a>";
	else
		echo " - <span style=\"color:lightgrey;\">".chr($i)."</span>";
}
echo " -- <img src=\"./img/add.png\" class=\"ico\" /><a href=\"?pag=insert_rubrica.php\">Nuovo Contatto</a>";?>

	<input type="text" class="medio" name="ricerca"/>
	<input type="submit" class="medio" name="submit" value="Ricerca"/>
</form>
<? 
echo "<hr/>"; 
if (mysql_num_rows($risultato)>0)
{	      
   echo "
   	<div class=\"float50\">Vis.</div>
   	<div class=\"float200\">Cognome Nome/Rag. Soc.</div>
      <div class=\"float200\">Indirizzo</div>      
      <div class=\"float70\">Elimina</div>
      <div class=\"float70\">Modifica</div>
      ";              
   echo "<div class=\"azzerafloat\"></div>";          
   while($control=mysql_fetch_row($risultato))
   // ciclo per cui finchè abbiamo risultati ci costruisce una riga alla volta
   {
   	echo "<div class=\"evidenzia\">
   			<div class=\"float50\"><a class=\"rub\" title =\"$control[1]|".
   			($control[2]!=""?$control[2]."<br/>":"").
   			($control[3]!=""?$control[3]."<br/>":"").
   			($control[5]>0?"$control[5] ":"").
   			($control[4]!=""?"$control[4] ":"").
   			($control[6]!=""?($control[6])."<br/>|":"")."<br/>";
   	$telefoni = explode(";",$control[7]);
		foreach ($telefoni as $key => $value)
		{
			$option = array("TD" => "Tel. Ditta","TP" => "Tel. Privato","FA" => "Fax ","CD" =>"Cel. Ditta","CP" => "Cel. Privato");
			if (substr($value,2) != "")
			{
				foreach ($option as $key1 => $value1)
					if (substr($value,0,2) == $key1) echo $value1.": ";
				echo substr($value,2)."<br/>";
			}
		}
		echo "<br/>";	
		$emailarray = explode(";",$control[8]);
		foreach ($emailarray as $key => $value)
		{
			$option = array("ED" => "Ditta","EP" => "Privata");
			if (substr($value,2) != "")
			{
				foreach ($option as $key1 => $value1)
					if (substr($value,0,2) == $key1) echo $value1.": ";
				echo substr($value,2)."<br/>";
			}
		}
		echo "<br/>";
		echo ($control[9]!=""?"Note:<br/><b>".str_replace("\n","<br/>",$control[9])."</b>":"");
   	echo	"\" href=\"#\"><img src=\"./img/rubrica.gif\" width=\"19\" height=\"20\" alt=\"\" /></a></div>
   			<div class=\"float200\">$control[1]</div>
      		<div class=\"float200\">".($control[3]!=""?$control[3]:"&nbsp;")."</div> ";     		
		if ($typo =="A")
      {
      	echo "<div class=\"float70\"><img src=\"./img/del.png\" class=\"ico\" /><a title=\"Elimina il Contatto\" href=\"area.php?pag=delete.php&id=$control[0]&from=elenco_rubrica.php\">Elimina</a></div>             
      			<div class=\"float70\"><img src=\"./img/mod.png\" class=\"ico\" /><a title=\"Modifica i dati del Contatto\" href=\"area.php?pag=insert_rubrica.php&amp;id=$control[0]\">Modifica</a></div>";
      }
		echo "<div class=\"azzerafloat\"></div></div>";
   }
   echo "</div>";
}
else
	echo "<p>Tabella vuota</p>";
?>
