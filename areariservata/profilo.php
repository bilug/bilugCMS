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

$str="SELECT * FROM anagrafica where ID=".$_SESSION['tux'];
$risultato=mysql_query($str);
if (mysql_num_rows($risultato)>0)
{
	$control=mysql_fetch_row($risultato);
   $sex=$control[7];
   $et=$control[8];
   $adm=$control[5];
   // assegnamo alla var (array) $control[x] (che ci serve nella form per assegnare il value) i valori della query
}
?>
<div class="contenitore">	
<form name="utenti" method="post" action="../areariservata/profilo_query.php" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?=$_SESSION['tux']?>"/>
<!-- il valore di id lo passiamo alla pagina di action con un campo nascosto -->
	<div class="azzerafloat"></div>
   <h3>Modifica l'utente:</h3>
   <div class="float100">
		Nome: (*)   
   </div>
   <div class="float300">
   	<input type="text" class="login"  name="nome" size="68" maxlength="50" tabindex="1" value="<?=$control[1]?>"/>
   </div>
   <div class="azzerafloat"></div>
   <div class="float100">
   	Cognome:
   </div>   
   <div class="float300">
		<input type="text" class="login" name="cognome" size="68" maxlength="50" tabindex="2" value="<?=$control[2]?>"/>   
   </div>
   <div class="azzerafloat"></div>         
   <div class="float100">
   	Email: (*)
   </div>
   <div class="float300">
   	<input type="text" class="login" name="email" size="68" maxlength="50" tabindex="3" value="<?=$control[3]?>"/>
   </div>
   <div class="azzerafloat"></div>
   <div class="float100">
   	Password: (*)
   </div>
   <div class="float300">
		<input type="hidden" name="pwdold" value="<?=$control[4]?>"/>   
   	<input type="password" class="login" name="pwd" size="68" maxlength="50" tabindex="4" value="<?=$control[4]?>"/>
   </div>
   <div class="azzerafloat"></div>
   <div class="float100">
   	Ridigita Password: (*)
   </div>
   <div class="float300">
   	<input type="password" class="login" name="pwd2" size="68" maxlength="50" tabindex="5" value="<?=$control[4]?>"/>
   </div>
   <div class="azzerafloat"></div>
   <div class="float100">
   	Sesso:
   </div>
   <div class="float300">
   	<input type="radio" class="little" name="sesso" value="M" <? if ($sex=="M") echo "checked "; ?> tabindex="6"/> Maschio
      <input type="radio" class="little" name="sesso" value="F" <? if ($sex=="F") echo "checked "; ?> tabindex="7"/> Femmina
   </div>
   <div class="azzerafloat"></div>
   <div class="float100">
   	Età:
   </div>
   <div class="float300">
     <select name="eta" size="1" tabindex="8">
     <option value="0">-----</option>
     <option value="1" <? if ($et==1) echo "selected"; ?>>0-18</option>
     <option value="2" <? if ($et==2) echo "selected"; ?>>19-40</option>
     <option value="3" <? if ($et==3) echo "selected"; ?>>41-60</option>
     <option value="4" <? if ($et==4) echo "selected"; ?>>Over 60</option>
     </select>
   </div>
   <div class="azzerafloat"></div>
   <div class="float100">
   	Città:
  	</div>
   <div class="float300">
   	<input type="text" class="login" name="citta" size="68" maxlength="50"  tabindex="9" value="<?=$control[9]?>"/>
   </div>
   <div class="azzerafloat"></div>
   <h1>(*) = Campi obbligatori</h1>
   <input type="submit" class="medio" value="Modifica" tabindex="12"/>
   <input type="button" class="medio" name="Annulla" value="Annulla" onclick="javascript:window.location='area.php'" />   
</form>
</div>
