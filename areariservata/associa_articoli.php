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
    function SelezTT()  
    {  
        var i = 0;  
        var modulo = document.modulo.elements;  
        for (i=0; i<modulo .length; i++)  
        {  
            if(modulo[i].type == "checkbox")  
            {  
                modulo[i].checked = !(modulo[i].checked);  
            }  
        }  
    }  
    </script>  
	
<?php

$id = $_GET['id'];

//query di estrazione elenco ecommerce articoli
$query = "Select id, titolo, categoria, prezzo, quantita, codice, produttore FROM ecommerce";
$ecommerce = mysql_query($query);

//query di estrazione articoli per ogni utente
$query2 = "SELECT articoli, nome, note FROM ecommerceris WHERE ID = '$id'";
$result=mysql_query($query2);
$eris=mysql_fetch_row($result);

?>

<form name="modulo" method="post" action="associa_articoli_query.php" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?=$id?>">

<?
echo "<h3>Selezione articoli per $eris[1] - $eris[2]</h3>";
echo"<div class=\"contenitore\"><div class=\"azzerafloat\"></div>";
echo "<ul>";
echo "<div class=\"evidenzia\"><li>
		<div class=\"float100\">Codice</div>
		<div class=\"float300\">Articolo</div>
		<div class=\"float100\">Produttore</div>
		<div class=\"float100\">Categoria</div>
		<div class=\"float70\">Prezzo</div>
		<div class=\"float50\">Q.ta</div>
		<div class=\"float50\">ID</div>
		<div class=\"float100\">Associa articolo</div>
		<div class=\"azzerafloat\"></li><br><br></div>";

while($ecom=mysql_fetch_row($ecommerce))
{
	// cerchiamo dentro la stringa degli articoli di un utente, se esiste l'articolo corrente 
	$ricerca = ",".$ecom[0].",";
	$arts = strpos($eris[0], $ricerca);
	if ($arts === false)
	{
		$checked = "";
		}
	else
	{
		$checked = "checked";
		}	
	echo "<div class=\"evidenzia\"><li>
		<div class=\"float100\">$ecom[5]</div>
		<div class=\"float300\">$ecom[1]</div>
		<div class=\"float100\">$ecom[6]</div>
		<div class=\"float100\">$ecom[2]</div>
		<div class=\"float70\">$ecom[3]</div>
		<div class=\"float50\">$ecom[4]</div>
		<div class=\"float50\">$ecom[0]</div>
		<div class=\"float100\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"checkbox\" name=\"art$ecom[0]\" value=\"$ecom[0]\" $checked> </div>
		</li></div><br><br>";
}
echo "</ul>";
?>
	<input value="Seleziona tutti gli articoli" onclick="SelezTT()" type="button">
 <button type="submit">Associa articoli </button>
 <button type="reset"> Resetta selezione </button>
</form>
<?
echo "<br><div class=\"azzerafloat\"></div>";
echo "</div>";
?>
