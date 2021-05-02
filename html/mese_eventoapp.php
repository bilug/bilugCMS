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
$nomemese = Array("Gennaio","Febbraio","Marzo","Aprile","Maggio","Giugno", "Luglio","Agosto","Settembre","Ottobre","Novembre","Dicembre");

$anno = ( isset($_POST["anno"]) ? $_POST["anno"] : $_GET["anno"]);
$id = ( isset($_POST["id"]) ? $_POST["id"] : $_GET["id"]);
$mese = ( isset($_POST["mese"]) ? $_POST["mese"] : $_GET["mese"]);

$anno = (int) mysql_real_escape_string($anno);
$mese = (int) mysql_real_escape_string($mese);


if (!isset($mese))
{
	if (_MESE!=0) $mese= _MESE;
	else $mese=date("m");
}
if (!isset($anno))
{
	if (_ANNO!=0) $anno= _ANNO;
	else $anno=date("Y");
}

$str = "
	SELECT e.ID, DATE_FORMAT( e.dataora, '%d-%m-%Y %H:%i'), e.titolo, e.luogo, e.tipo, e.descrizione, e.idutente 
	FROM eventi AS e 
	INNER JOIN lingue AS l ON l.id = e.id_lingua 
	WHERE MONTH( e.dataora ) = $mese AND YEAR( e.dataora ) = $anno AND l.sigla = '$lingua_query' 
	ORDER BY e.dataora DESC
";

if ( isset( $id ) ) {
	$id = (int) mysql_real_escape_string($id);
	$str="SELECT ID, DATE_FORMAT( dataora, '%d-%m-%Y %H:%i' ), titolo, luogo, tipo, descrizione, idutente FROM eventi WHERE ID = $id LIMIT 1";
}

$risultato = mysql_query($str);
if ( mysql_num_rows( $risultato ) > 0 ) {
	echo "<h1><span>"._APPTITOLO."</div></span>
	<h3>Mese di ".$nomemese[intval($mese)-1]."</h3>
   
   	<div class=\"contenitore\">   	
   	<div class=\"azzerafloat\"></div>        		
      <div class=\"float140\">Data/Descrizione</div> <!-- Data -->
      <div class=\"float200\">Titolo</div> <!-- nome -->
      <div class=\"float100\">Luogo</div> <!-- multipli -->
      <div class=\"float100\">Tipo</div> <!-- attivo -->                        
      <div class=\"azzerafloat\"></div>";
        
	while( $control = mysql_fetch_row( $risultato ) )
   {
	   echo "<div class=\"".($control[4]=='E'? "evento":"appuntamento")."\">            
	   <div class=\"float140\">$control[1]</div> <!-- Data -->
	   <div class=\"float200\">".wordwrap($control[2],28,"\n",1)."</div> <!-- nome -->
	   <div class=\"float100\">$control[3]</div> <!-- multipli -->
	   <div class=\"float100\">".($control[4]=='E'? "Evento":"Appuntamento")."</div> <!-- attivo -->
	   <div class=\"azzerafloat\"></div>
	   <div>$control[5]</div>";
	   
		$str3="SELECT nome, cognome FROM anagrafica WHERE ID = $control[6] LIMIT 1";
			$risultato3=mysql_query($str3);
			$control3=mysql_fetch_row($risultato3);
			// query per sapere il nome dell'autore	   
		echo "<h5>Inserita da $control3[0] $control3[1]</h5>";
	   echo "</div>";
	   
	}
	echo "</div>";
}
else
	echo "<h2>Nessun Evento o Appuntamento nel ".$nomemese[intval($mese)-1]." $anno</h2>";


 
?>
