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

$id = $_GET['id'];

$errore=null;
$errore=$_GET["errore"];
$tipoerr=$_GET["tipoerr"];
if($errore=="si")
{
		echo "<h1><img src=\"./img/alert.png\" class=\"ico\" />$tipoerr<img src=\"./img/alert.png\" class=\"ico\" /></h1>";
}

if (!$id)
{
	$parola=Inserisci;
	$contatel = $_GET["contatel"];
	$contemeil = $_GET["contaemeil"];
	$control[1] = $_GET["ragsoc"];
	$control[2] = $_GET["ragsoc1"];
	$control[3] = $_GET["ragsoc2"];
	$control[4] = $_GET["citta"];
	$control[5] = $_GET["cap"];
	$control[6] = $_GET["prov"];
	$control[9] = $_GET["note"];
	$email[0] = $_GET["email"];
  	// se il valore di id è vuoto, allora siamo in fase di inserimento
  	
  	if(!$contatel and !$contaemail)
  	{
		$contatel=1;
		$contaemail=1; 
	}
  	echo "$contatel e $contaemail ";
  	$annulla = "<input type=\"button\" 
	class=\"medio\" name=\"Annulla\" value=\"Annulla\" onclick=\"javascript:window.location='area.php?pag=elenco_rubrica.php'\" />";

}
else
{
	$parola=Modifica;
	$annulla ="<input type=\"button\" 
	class=\"medio\" name=\"Annulla\" value=\"Annulla\" onclick=\"javascript:window.location='area.php?pag=elenco_rubrica.php'\" />";

	$str=" SELECT ID,ragsoc,ragsoc1,ragsoc2,citta,cap,prov,tel,email,note FROM rubrica where ID='$id' ";
	$risultato=mysql_query($str);
	if (mysql_num_rows($risultato)>0)
	{
		$control=mysql_fetch_row($risultato);        	
	}
	$telefoni = explode(";",$control[7]);
	foreach ($telefoni as $key => $value)
	{
		$tipotel[] = substr($value,0,2);
		$tel[] = substr($value,2);
	}	
	$contatel = count($tel)-1;
	$emailarray = explode(";",$control[8]);
	foreach ($emailarray as $key => $value)
	{
		$tipoemail[] = substr($value,0,2);
		$email[] = substr($value,2);
	}
	$contaemail = count($email)-1; 	
}
?>
<script type="text/javascript">
$(document).ready(function(){
	var int=$("#contatel").val();
	var out=$("#contaemail").val();
	$(":button[name='AggTel']").click(function(){
			$("#Telefono").append("<span id='divtel"+int+"'><br/><select name='tipotel"+int+"'><option value='TD' label='Tel. Ditta'>Tel. Ditta</option><option value='TP' label='Tel. Privato'>Tel. Privato</option><option value='FA' label='Fax'>Fax</option><option value='CD' label='Cel. Ditta'>Cel. Ditta</option><option value='CP' label='Cel. Privato'>Cel. Privato</option></select> <input class='medio' type='text' name='telefoni"+int+"' size='80' maxlength='200'/></span>");
			$("#contatel").val(++int);			
		});
	$(":button[name='RemTel']").click(function(){
			if (int>1) int--;
			var name1= "divtel"+int;			
			$("#"+name1).remove();
			$("#contatel").val(int);		
		});
	$(":button[name='AggEmail']").click(function(){
			$("#Email").append("<span id='divemail"+out+"'><br/><select name='tipoemail"+out+"'><option value='ED' label='Ditta'>Ditta</option><option value='EP' label='Privata'>Privata</option></select> <input class='login' type='text' name='emailtxt"+out+"' size='80' maxlength='200'/></span>");
			$("#contaemail").val(++out);			
		});
	$(":button[name='RemEmail']").click(function(){
			if (out>1) out--;
			var name1= "divemail"+out;			
			$("#"+name1).remove();
			$("#contaemail").val(out);		
		});
});
</script>
<div class="contenitore">
<form name="rubrica" method="post" action="insert_rubrica_query.php" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?=$control[0]?>"/>
<input type="hidden" name="contatel" id="contatel" value="<?=$contatel?>" />
<input type="hidden" name="contaemail" id="contaemail" value="<?=$contaemail?>" />
<!-- il valore di id lo passiamo alla pagina di action con un campo nascosto -->
	<h3><?=$parola?> Rubrica:</h3>
	<div class="azzerafloat"></div>
	<div class="float200">Cognome Nome/Rag. Soc:</div>
	<div class="float500">
		<input type="text" name="ragsoc" size="80" maxlength="254" tabindex="1" value="<?=$control[1]?>"/>
	</div>
	<div class="azzerafloat"></div>
		
	<div class="float200">Riferimento:</div>
	<div class="float500">
		<input type="text" name="ragsoc1" size="80" maxlength="254" tabindex="1" value="<?=$control[2]?>"/>
	</div>
	<div class="azzerafloat"></div>
	
	<div class="float200">Indirizzo:</div>
	<div class="float500">
		<input type="text" name="ragsoc2" size="80" maxlength="254" tabindex="1" value="<?=$control[3]?>"/>
	</div>
	<div class="azzerafloat"></div>
	
	<div class="float200">Citt&aacute;:</div>
	<div class="float500">
		<input type="text" class="login" name="citta" size="50" maxlength="50" tabindex="1" value="<?=$control[4]?>"/>
	</div>
	<div class="azzerafloat"></div>
	
	<div class="float200">Cap. :</div>
	<div class="float500">
		<input type="text" class="medio" name="cap" size="80" maxlength="5" tabindex="1" value="<?=$control[5]?>"/>
	</div>
	<div class="azzerafloat"></div>
	
	<div class="float200">Provincia:</div>
	<div class="float500">
		<input type="text" class="little" name="prov" size="80" maxlength="2" tabindex="1" value="<?=$control[6]?>"/>
	</div>	
	<div class="azzerafloat"></div>	
		
	<div class="float200">Telefoni :</div>
	<div class="float500">
	<?
		$i=0;
		$option = array("TD" => "Tel. Ditta","TP" => "Tel. Privato","FA" => "Fax ","CD" =>"Cel. Ditta","CP" => "Cel. Privato");		
		do
		{
			echo "\t<span id='divtel".$i."'>\n";
			if ($i>0) echo "<br/>";
			echo "\t<select name='tipotel".$i."'>\n";
			foreach ($option as $key => $value)
			{
				echo "\t\t\t<option value='".$key."' label='".$value."' ";
				if ($tipotel[$i] == $key) echo "selected";
				echo ">".$value."</option>\n";
			}
			echo "\t\t</select>\n";
			echo "\t\t<input class='medio' type='text' name='telefoni".$i."' size='80' maxlength='200' value='".$tel[$i]."'/>\n";
			echo "</span>";
		}
		while (++$i<$contatel);
	?>	 
		<span id="Telefono"></span> 
		<br/><input type="button" class="medio" name="AggTel" value="Aggiungi"/>
		<input type="button" class="medio" name="RemTel" value="Rimuovi"/>
	</div>	
	<div class="azzerafloat"></div>	

	<div class="float200">Email:</div>
	<div class="float500">
	<?
		$i=0;
		$option = array("ED" => "Ditta","EP" => "Privata");
		do
		{
			echo "\t<span id='divemail".$i."'>\n";
			if ($i>0) echo "<br/>";			
			echo "\t<select name='tipoemail".$i."'>\n";
			foreach ($option as $key => $value)
			{
				echo "\t\t\t<option value='".$key."' label='".$value."' ";
				if ($tipoemail[$i] == $key) echo "selected";
				echo ">".$value."</option>\n";
			}
			echo "\t\t</select>\n";
			echo "\t\t<input class='login' type='text' name='emailtxt".$i."' size='80' maxlength='200' value='".$email[$i]."'/>\n";
			echo "</span>";
		}
		while (++$i<$contaemail); 		
	?>	
		<span id="Email"></span> 
		<br/><input type="button" class="medio" name="AggEmail" value="Aggiungi"/>
		<input type="button" class="medio" name="RemEmail" value="Rimuovi"/>
	</div>	
	<div class="azzerafloat"></div>
	<div class="float200">Note:</div>
	<div class="float500">
		<textarea name="note" rows="6" cols="75"><?=$control[9]?></textarea>	
		
	</div>
	<div class="azzerafloat"></div>	
	<input type="submit" class="medio" value="<?=$parola?>" tabindex="7"/>
	<?=$annulla?>              
</form>
</div>
