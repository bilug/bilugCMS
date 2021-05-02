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

$inizio = $_POST['inizio'];
$Nav = $_POST['Nav'];
$Page = 50;
if (!isset($inizio))
{  	
	$inizio = 0;
  	$str="SELECT * FROM log ORDER BY data";
  	$risultato=mysql_query($str);
  	$Max = mysql_num_rows($risultato);	
}
else
{
  	if($Nav== 'Successivi') $inizio-= $Page;
  	if($Nav== 'Precedenti') $inizio+= $Page;  	
}
$str="SELECT * FROM log ORDER BY data DESC LIMIT $inizio,$Page";
// facciamo una query per caricare 100 record della tabella dei log
$risultato=mysql_query($str);
if (mysql_num_rows($risultato)>0)
{
	echo "<div class=\"contenitore\">";
   if ($Max>$Page)
   {          
   	//setto il valore max e minimo della pagina da visualizzare a video
       $t =$Max-$inizio;
       ($f = $Max-$Page-$inizio+1)<0? $f=1: $f;               
       
   	//Creo la form per navigare
      echo "<form method=\"post\" action=\"area.php?pag=log.php\" name=\"log\">
      		<h3>" . $t . " - " . $f . "</h3>
      		<input type=\"hidden\" name=\"inizio\" value=\"$inizio\"/>
       		<input type=\"hidden\" name=\"Max\" value=\"$Max\"/>";
       
		if ($inizio != 0) echo "<input type=\"submit\" class=\"medio\" value=\"Successivi\" name=\"Nav\"/>";
		if ($inizio+$Page<$Max) echo "<input type=\"submit\" class=\"medio\" value=\"Precedenti\" name=\"Nav\" />";
		echo "</form>";
	}
   //fine Nav Inizio Tabella
   echo "<div class=\"float50\"><h5>ID</h5></div> 
			<div class=\"float200\"><h5>UTENTE</h5></div> 
       	<div class=\"float140\"><h5>DATA</h5></div> 
       	<div class=\"float100\"><h5>IP</h5></div> 
       	<div class=\"float400\"><h5>BROWSER E SISTEMA OPERATIVO</h5></div> 
       	<div class=\"float20\"><h5>TIPO</h5></div> 
       	<div class=\"azzerafloata\"></div>";
	//se abbiamo un risultato dalla query costruiamo la tabella
   while($control=mysql_fetch_row($risultato))
   // ciclo per cui finchè abbiamo risultati ci costruisce una riga alla volta
   {
   	$datait=date ("d-m-Y H:i:s", $control[2]);
      echo "<div class=\"float50\">$control[0]</div> <!-- id -->
				<div class=\"float200\">$control[1]</div> <!-- utente -->
           	<div class=\"float140\">$datait</div> <!-- data -->
           	<div class=\"float100\">$control[3]</div> <!-- ip -->
           	<div class=\"float400\">$control[4]</div> <!-- browser -->
           	<div class=\"float20\">$control[5]</div> <!-- tipo -->
           	<div class=\"azzerafloata\"></div>";
	}
   if ($Max>$Page)
   {
   	echo "<form method=\"post\" action=\"area.php?pag=log.php\" name=\"log\">
  				<h3>" . $t . " - " . $f . "</h3>
       		<input type=\"hidden\" name=\"inizio\" value=\"$inizio\"/>
       		<input type=\"hidden\" name=\"Max\" value=\"$Max\"/>";
       
      if ($inizio != 0) echo "<input type=\"submit\" class=\"medio\" value=\"Successivi\" name=\"Nav\"/>";
		if ($inizio+$Page<$Max) echo "<input type=\"submit\" class=\"medio\" value=\"Precedenti\" name=\"Nav\" />";
		echo "</form>";
	}
   echo "</div>";
}
else 
	echo "<p>Tabella vuota</p>";  
?>