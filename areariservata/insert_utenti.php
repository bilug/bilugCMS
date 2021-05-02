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

$errore=$_GET["errore"];
$tipoerr=$_GET["tipoerr"];

if($errore=="si")
{
		echo "<h1><img src=\"./img/alert.png\" class=\"ico\" />$tipoerr<img src=\"./img/alert.png\" class=\"ico\" /></h1>";
}
$id = $_GET['id'];
if (!$id)
{
	$parola=Inserisci;
  	// se il valore di id è vuoto, allora siamo in fase di inserimento 
	$annulla = "<input type=\"button\" 
	class=\"medio\" name=\"Annulla\" value=\"Annulla\" onclick=\"javascript:window.location='area.php?pag=elenco_utenti.php'\" />";
	
	$control[1]=$_GET["nome"];
	$control[2]=$_GET["cognome"];
	$control[3]=$_GET["email"];
	$control[9]=$_GET["citta"];
	$et=$_GET["eta"];
	$adm=$_GET["admin"];
	$sex=$_GET["sesso"];
}
else
{
	$parola=Modifica;
  	// se id ha un valore, allora siamo in fase di modifica 
	$annulla ="<input type=\"button\" 
	class=\"medio\" name=\"Annulla\" value=\"Annulla\" onclick=\"javascript:window.location='area.php?pag=elenco_utenti.php'\" />";
   $str=" SELECT * FROM anagrafica where ID='$id'";
   $risultato=mysql_query($str);
   if (mysql_num_rows($risultato)>0)
   {
   	$control=mysql_fetch_row($risultato);
      $sex=$control[7];
      $et=$control[8];
      $adm=$control[5];
      // assegnamo alla var (array) $control[x] (che ci serve nella form per assegnare il value) i valori della query
   }
}
?>
<div class="contenitore">
<form name="utenti" method="post" action="insert_utenti_query.php" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?=$id?>"/>
<!-- il valore di id lo passiamo alla pagina di action con un campo nascosto -->
   <h3><?=$parola?> l'utente:</h3>
   <div class="azzerafloat"></div>
	<div class="float200">
		Nome: (*)
	</div>
   <div class="float500">
   	<input type="text" name="nome" size="80" maxlength="50" tabindex="1" value="<?=$control[1]?>"/>
   </div>
   <div class="azzerafloat"></div>
   <div class="float200">
   	Cognome:
   </div>
   <div class="float500">
   	<input type="text" name="cognome" size="80" maxlength="50" tabindex="2" value="<?=$control[2]?>"/>
   </div>
   <div class="azzerafloat"></div>
	<div class="float200">
		Email: (*)
	</div>
   <div class="float500">
   	<input type="text" name="NomeUtente" size="80" maxlength="50" tabindex="3" value="<?=$control[3]?>"/>
   </div>
   <div class="azzerafloat"></div>
   <div class="float200">
   	Password: (*)
   </div>
   <div class="float500">
   	<input type="hidden" name="pwdold" value="<?=$control[4]?>"/>
   	<input type="password" name="Pass" size="80" maxlength="50" tabindex="4" value="<?=$control[4]?>"/>
   </div>
   <div class="azzerafloat"></div>
   <div class="float200">
   	Ridigita Password: (*)
   </div>
   <div class="float500">
   	<input type="password" name="pwd2" size="80" maxlength="50" tabindex="5" value="<?=$control[4]?>"/>
   </div>
   <div class="azzerafloat"></div>      
   <div class="float200">
   	Sesso:
   </div>
   <div class="float500">
		<input type="radio" class="little" name="sesso" value="M" <? if ($sex=="M") echo "checked "; ?> tabindex="6"/> Maschio
      <input type="radio" class="little" name="sesso" value="F" <? if ($sex=="F") echo "checked "; ?> tabindex="7"/> Femmina
   </div>
   <div class="azzerafloat"></div>     
   <div class="float200">
   	Età:
   </div>
   <div class="float500">
     <select name="eta" size="1" tabindex="8">
	     <option value="0">-----</option>
	     <option value="1" <? if ($et==1) echo "selected"; ?>>0-18</option>
	     <option value="2" <? if ($et==2) echo "selected"; ?>>19-40</option>
	     <option value="3" <? if ($et==3) echo "selected"; ?>>41-60</option>
	     <option value="4" <? if ($et==4) echo "selected"; ?>>Over 60</option>
     </select>
    </div>
    <div class="azzerafloat"></div>          
    <div class="float200">
    	Città:
    </div>
    <div class="float500">
    	<input type="text" name="citta" size="80" maxlength="50" tabindex="9" value="<?=$control[9]?>"/>
    </div>
    <div class="azzerafloat"></div>     
    <div class="float200">
    	Admin:
    </div>
    <div class="float500">
    	<? if ($typo == "A") { ?>
	   <input type="radio" class="little" name="admin" value="A" <? if ($adm=="A") echo "checked "; ?> tabindex="10"/> Admin
	   <?}?>
	   <input type="radio" class="little" name="admin" value="S" <? if ($adm=="S") echo "checked "; ?> tabindex="11"/> SuperUser
	   <input type="radio" class="little" name="admin" value="U" <? if ($adm=="U") echo "checked "; ?> tabindex="12"/> User	   
    </div>
    <div class="azzerafloat"></div>
    <h3>(*) = Campi obbligatori</h3>
    <input type="submit" class="medio" value="<?=$parola?>" tabindex="13"/>  
    <?=$annulla?>             
</form>
</div>
