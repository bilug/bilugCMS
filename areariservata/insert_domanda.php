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

if (!$id)
{
	$parola=Inserisci;
	// se il valore di id è vuoto, allora siamo in fase di inserimento 
}
else
{
	$parola=Modifica;
	// se id ha un valore, allora siamo in fase di modifica 

	$str=" SELECT * FROM esperto where ID='$id'";
	$risultato=mysql_query($str);
	if (mysql_num_rows($risultato)>0)
   {
   	$control=mysql_fetch_row($risultato);
      $sino=$control[4];
      // assegnamo alla var (array) $control[x] (che ci serve nella form per assegnare il value) i valori della query
   }
}
?>

<form name="domande" method="post" action="insert_domanda_query.php" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?=$id?>">
<!-- il valore di id lo passiamo alla pagina di action con un campo nascosto -->
   <table width="100%" height="100%" border="0">
      <tr>
         <td>
                        
              <table border="1" width="780" align="center" valign="middle">
               <tr>
                  <td colspan="2" width="780"><b><?=$parola?> domanda & risposta:</b></td>
               </tr>
               <tr>
                  <td width="120">Domanda:</td>
                  <td width="650"><textarea name="domanda" rows="7" cols="75"><?=$control[1]?></textarea></td>
               </tr>
               <tr>
                  <td>Nome:</td>
                  <td width="650"><input type="text" name="nick" size="100" maxlength="200" tabindex="2" value="<?=$control[2]?>"></td>
               </tr>
               <tr>
                  <td>Testo:</td>
                  <td width="650"><textarea name="risposta" rows="11" cols="75"><?=$control[3]?></textarea></textarea></td>
               </tr>
               <tr>
                  <td>Pubblicare:</td>
                  <td width="650">
                  <input type="radio" name="pubblicare" value="SI" <? if ($sino=="SI") echo "checked "; ?> > SI
                  <input type="radio" name="pubblicare" value="NO" <? if ($sino=="NO") echo "checked "; ?> > NO
                  </td>
               </tr>  
               <tr>
                    <td colspan="2" align="right"><input type="submit" value="<?=$parola?>" tabindex="6"></td>
               </tr>                            
            </table>
            
        </td>
      </tr>
   </table>
</form>
