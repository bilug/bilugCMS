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

$str="
	SELECT s.ID, s.titolo, DATE_FORMAT(s.data,'%d/%m/%Y'), s.multipli, s.attivo, s.utenti, l.lingua 
	FROM sondaggi AS s 
	INNER JOIN lingue AS l ON l.id = s.id_lingua
	ORDER BY s.data
";
// facciamo una query per caricare tutti i dati della tabella
$risultato=mysql_query($str);

echo "<h3> Sondaggi </h3>
	<div id=\"tabs\">
	<ul>
        <li><a href=\"#fragment-1\"><span>Elenco</span></a></li>
        <li><a href=\"#fragment-2\"><span>Nuovo</span></a></li>
	</ul>             
	                
	<div id=\"fragment-1\">";
	
	
if (mysql_num_rows($risultato)>0)
{
	echo "<div class=\"contenitore\"><div class=\"azzerafloat\"></div>
  		<div class=\"float20\">ID</div> <!-- id -->
   <div class=\"float70\">Data Ins.</div> <!-- Data -->
   <div class=\"float160\">Titolo</div> <!-- nome -->
   <div class=\"float50\">Multiplo</div> <!-- multipli -->
   <div class=\"float50\">Attivo</div> <!-- attivo -->
   <div class=\"float50\">Privato</div> <!-- utenti -->
   <div class=\"float70\">Lingua</div> <!-- Lingua del sondaggio da visualizzare -->
   <div class=\"azzerafloat\"></div>";
  	//se abbiamo un risultato dalla query costruiamo la tabella
  	while($control=mysql_fetch_row($risultato))
  	// ciclo per cui finchè abbiamo risultati ci costruisce una riga alla volta
   {
   	echo "<div class=\"evidenzia\">            
      <div class=\"float20\">$control[0]</div> <!-- id -->
      <div class=\"float70\">$control[2]</div> <!-- Data -->
      <div class=\"float160\">$control[1]</div> <!-- nome -->
      <div class=\"float50\">$control[3]</div> <!-- multipli -->
      <div class=\"float50\">$control[4]</div> <!-- attivo -->
      <div class=\"float50\">$control[5]</div> <!-- utenti -->
      <div class=\"float70\">$control[6]</div> <!-- lingua -->
      <div class=\"float70\"><a title=\"Elimina Il Sondaggio\" href=\"area.php?pag=delete.php&id=$control[0]&from=elenco_sondaggi.php\"><img src=\"./img/del.png\" class=\"ico\" /></a></div>
      <div class=\"float50\"><a title=\"Azzera il Sondaggio (elimina i voti inseriti)\" href=\"area.php?pag=delete.php&id=$control[0]&from=reset_elenco_sondaggi.php\"><img src=\"./img/res.png\" class=\"ico\" /></a></div>            
      <div class=\"float50\"><a title=\"Modifica il Sondaggio\" href=\"area.php?pag=insert_sondaggio.php&amp;id=$control[0]\"><img src=\"./img/mod.png\" class=\"ico\" /></a></div>
      <div class=\"float50\"><a title=\"Duplica il Sondaggio\" href=\"area.php?pag=duplica.php&id=$control[0]&from=elenco_sondaggi.php\"><img src=\"./img/dup.png\" class=\"ico\" /></a></div>
      <div class=\"float50\"><a title=\"Vota il Sondaggio\" href=\"area.php?pag=sondaggioutenti.php&amp;id=$control[0]\"><img src=\"./img/vot.png\" class=\"ico\" /></a></div>
      <div class=\"float50\"><a title=\"Visualizza i voti del Sondaggio\" href=\"area.php?pag=vedi_voto.php&amp;id=$control[0]\"><img src=\"./img/pre.png\" class=\"ico\" /></a></div>
      <div class=\"azzerafloat\"></div></div>";
	}
  	echo "</div>";
}
else 
{
	echo "<p>Tabella vuota</p>";
}
echo "<br></div>
<div id=\"fragment-2\">";
 include("./insert_sondaggio.php");
echo "</div>";
		

?>
