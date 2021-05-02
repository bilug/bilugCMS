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

if ($_SESSION['typo'] == "A") $str=" SELECT * FROM anagrafica ORDER BY data";
else	$str=" SELECT * FROM anagrafica where admin!='A' ORDER BY data";

echo "<h3> Utenti </h3>
	<div id=\"tabs\">
	<ul>
        <li><a href=\"#fragment-1\"><span>Elenco</span></a></li>
        <li><a href=\"#fragment-2\"><span>Nuovo</span></a></li>
	</ul>             
	                
	<div id=\"fragment-1\">";


// facciamo una query per caricare tutti i dati della tabella
$risultato=mysql_query($str);
if (mysql_num_rows($risultato)>0)
{
	echo "<div class=\"contenitore\"><div class=\"azzerafloat\"></div>";
   //se abbiamo un risultato dalla query costruiamo la tabella
   while($control=mysql_fetch_row($risultato))
   // ciclo per cui finchè abbiamo risultati ci costruisce una riga alla volta
   {
   	$anno=substr($control[6],0,4);
      // substr (variabile, carattere di inizio, lunghezza della sottostringa)
      $mese=substr($control[6],5,2);
      $giorno=substr($control[6],8,2);
      $datait="$giorno"."-"."$mese"."-"."$anno";
      // con le 4 righe sopra convertiamo la data da americana in italiana
      // substr è una funzione che serve a selezionare parte di una stringa
	//se trovo una variabile non obbligatoria vuota la inizializzo a &nbsp; -> solo per validare il div	
	if($control[2]=="")
	{
			$control[2]= "&nbsp;";
	}
	if($control[5]=="")
	{
			$control[5]= "&nbsp;";
	}
	if($control[7]=="")
	{
			$control[7]= "&nbsp;";
	}
	if($control[8]=="")
	{
			$control[8]= "&nbsp;";
	}
	if($control[9]=="")
	{
			$control[9]= "&nbsp;";
	}
      echo "<div class=\"evidenzia\">
      <div class=\"float20\">$control[0]</div> <!-- id -->
      <div class=\"float70\">$control[1]</div> <!-- nome -->
      <div class=\"float70\">$control[2]</div> <!-- cognome -->
      <div class=\"float160\">$control[3]</div> <!-- email -->
      <div class=\"float230\">$control[4]</div> <!-- pwd -->
      <div class=\"float20\">$control[5]</div> <!-- admin -->
      <div class=\"float70\">$datait</div> <!-- data -->
      <div class=\"float20\">$control[7]</div> <!-- sesso -->
      <div class=\"float20\">$control[8]</div> <!-- eta -->
      <div class=\"float70\">$control[9]</div> <!-- citta -->
      <div class=\"float70\"><img src=\"./img/del.png\" class=\"ico\" /><a title=\"Elimina L'Utente\" href=\"area.php?pag=delete.php&id=$control[0]&from=elenco_utenti.php\">Elimina</a></div>
      <!-- Assegnamo all'id il valore che otteniamo con la query -->
      <div class=\"float70\"><img src=\"./img/mod.png\" class=\"ico\" /><a title=\"Modifica L'Utente\" href=\"area.php?pag=insert_utenti.php&amp;id=$control[0]\">Modifica</a></div>
      <div class=\"azzerafloat\"></div></div>";
	}
   echo "</div>";
}
else 
{
	echo "<p>Tabella vuota</p>";

}
echo "<br /> </div><div id=\"fragment-2\">";
 include("./insert_utenti.php");
echo "</div>";
?>
