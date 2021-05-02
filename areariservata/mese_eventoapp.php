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
 
$mese = $_POST['mese'];
$anno = $_POST['anno'];
?>

<form name="viseventi" method="post" action="?pag=mese_eventoapp.php" enctype="multipart/form-data">
VIsualizza Appuntamenti del mese :
<select name="mese">
		<?
			$nomemese = Array("Gennaio","Febbraio","Marzo","Aprile","Maggio","Giugno", "Luglio","Agosto","Settembre","Ottobre","Novembre","Dicembre");
			if (!isset($mese)) $mese=date("m");			
			for ($ore=1;$ore<13;$ore++){				 
				echo "<option value=\"".($ore<10?"0":"")."$ore\"".
				 ($mese == $ore ? "selected":"").
				">".$nomemese[$ore-1]."</option>";
			}
		?>
		</select>-20<input type="text" class="little" name="anno" size="2" maxlength="2" tabindex="1" value="<?=date("y")?>"/>
		<input type="submit" class="medio" value="Ricerca" tabindex="7"/>
</form>
<?  
if (isset($mese) AND isset($anno)) 
{ 
$anno= 2000+$anno;
$str=" SELECT ID,DATE_FORMAT(dataora,'%d-%m-%Y %H:%i'),titolo,luogo,tipo,descrizione FROM eventi where MONTH(dataora) = $mese and YEAR(dataora) = $anno";
$risultato=mysql_query($str);
if (mysql_num_rows($risultato)>0)
        {
        echo "<div class=\"contenitore\"><div class=\"azzerafloat\"></div>        		
            <div class=\"float140\">Data</div> <!-- Data -->
            <div class=\"float200\">Titolo</div> <!-- nome -->
            <div class=\"float100\">Luogo</div> <!-- multipli -->
            <div class=\"float100\">Tipo</div> <!-- attivo -->                        
            <div class=\"azzerafloat\"></div>
                       <div>Descrizione</div> <!-- attivo -->";
        //se abbiamo un risultato dalla query costruiamo la tabella
        while($control=mysql_fetch_row($risultato))
        // ciclo per cui finchè abbiamo risultati ci costruisce una riga alla volta
            {
            echo "<div class=\"".($control[4]=='E'? "evento":"appuntamento")."\">            
            <div class=\"float140\">$control[1]</div> <!-- Data -->
            <div class=\"float200\">$control[2]</div> <!-- nome -->
            <div class=\"float100\">$control[3]</div> <!-- multipli -->
            <div class=\"float100\">".($control[4]=='E'? "Evento":"Appuntamento")."</div> <!-- attivo -->
            <div class=\"azzerafloat\"></div>
            <div>$control[5]</div> <!-- attivo -->
            </div>";
            
            
            }
        echo "</div>";
        }    
        echo "<br><div class=\"contenitore\"><div class=\"azzerafloat\"></div>
		<div class=\"evidenzia\">
			
				<a href=\"area.php?pag=elenco_eventoapp.php\">Elenco eventi</a>
			
		</div>
	  </div>";
    }
?>
