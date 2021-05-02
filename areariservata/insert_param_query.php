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
require_once("auth.php");

if ($_POST["op"] == "Aggiungi")
{
	$label= mysql_real_escape_string($_POST["label"]);
	$nomecampo = strtoupper(mysql_real_escape_string($_POST["nomecampo"]));
	$valore = mysql_real_escape_string($_POST["valore"]);
	$sezione= mysql_real_escape_string($_POST["sezione"]);
	$tipo = mysql_real_escape_string($_POST["tipo"]);
	
	if (($label == "")OR($nomecampo == "")OR($valore == "")OR($sezione == "")OR($tipo == ""))
	{
		$tipoerr="ERRORE: NON TUTTI I VALORI SONO STATI INSERITI ";
		//echo "ERRORE: NON TUTTI I VALORI SONO STATI INSERITI ";
    	//echo "<br/><a href=\"area.php?pag=insert_param.php\">Riprova</a>";
    	echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_param.php&errore=si&tipoerr=$tipoerr\" />";
	}
	else
	{
		$str="INSERT INTO parametri SET sezione = '$sezione', label = '$label', nomecampo=  '$nomecampo',
			valore = '$valore', tipo = '$tipo'";
		$risultato=mysql_query($str);
      if (!$risultato)
      // controllo se la query di inserimento è andata a buon fine
      {
      	$tipoerr="ERRORE: DATI NUOVO PARAMETRO NON INSERITI";
      	//echo "ERRORE: DATI NUOVO PARAMETRO NON INSERITI";
         //echo "<br/><a href=\"area.php?pag=insert_param.php\">Riprova</a>";
         echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_param.php&errore=si&tipoerr=$tipoerr\" />";
      }
      else 
      	//Header("Location: ");
      	echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_param.php\" />";
      exit;
	}
}
else
{
	$err = false;
	foreach ($_POST as $key => $value)
	{
		if (is_numeric($key)) 
		{
			$value1 = mysql_real_escape_string($_POST[$key."_tipo"]);
			$value = mysql_real_escape_string($value);			
			$str=" UPDATE parametri SET valore = '$value', tipo = '$value1' WHERE ID = '$key' LIMIT 1";
			$risultato=mysql_query($str);
    		if (!$risultato)
    		// controllo se la query di modifica è andata a buon fine
      	{
      		$tipoerr="ERRORE: DATI $value di $key non completi";        		
      		//echo "ERRORE: DATI $value di $key non completi";        		
        		$err = true;
      	}
		}
	}
	if ($err) echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_param.php&errore=si&tipoerr=$tipoerr\" />";//echo "<br/><a href=\"area.php?pag=insert_param.php\">Riprova</a>";
  	else
  	{
  		
		include_once ("genera_param_query.php");
  		//Header("Location: ");
		echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=conferma.php&from=insert_param.php\" />";
  	}
  	exit;
}
?>
