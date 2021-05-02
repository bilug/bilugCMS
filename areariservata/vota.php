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

$IP = $_SESSION['tux'];
$id = $_POST['id'];
$multipli = $_POST['multipli'];
$i = $_POST['i'];

$str="Select IP from voti where IP='$IP' and ID='$id'";
$risultato=mysql_query($str);
if (mysql_num_rows($risultato) == 0)
{
	if ($multipli=="no")
	{
		$voto = $_POST["voto"];
		$voto--;
		$str="INSERT INTO voti set ID='$id',IP='$IP', voto='$voto'";
		$risultato=mysql_query($str);
	}
	else
	{
		$j=0;
		while ($j<$i)
		{
			$str = "$"."_POST[\"voto".$j."\"]";
			eval("\$voto = $str;");		
			if ($voto>0)
			{		
				$voto--; 
				$str="INSERT INTO voti set ID='$id',IP='$IP', voto='$voto'";
				$risultato=mysql_query($str);
			}
			$j++;
		}
	}
	if (!$risultato)
		$msg = "Errore nell'inserimento del  voto";
	else
	{
		$str = "select count(*) from voti where ID='$id'";
		$risultato=mysql_query($str);
		$max = mysql_fetch_row($risultato);
		$str = "update sondaggi set maxvoti='$max[0]' where ID='$id'";
		$risultato=mysql_query($str);
	
		$str="select voto,count(voto) from voti where ID='$id' group by voto order by voto";
		$risultato=mysql_query($str);
		$i=0;	
		while ($cont=mysql_fetch_row($risultato))
		{
			while ($i !=	$cont[0])
				$totale[$i++] = "0";			
		
			$totale[$i++] = $cont[1];
		}
		if (count($totale)==1) 
			$totale = $totale[0].";";
		else		
			$totale = implode(";",$totale);
			
		$str="update sondaggi set totali='$totale' where ID='$id'";
		$risultato=mysql_query($str);
		$msg = "Il Voto è stato registrato correttamente";
	}
	//header("Refresh: 0; url=area.php?pag=vedi_voto.php&id=".$id);
	echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=vedi_voto.php&id=$id\" />";		
}
else
{
	$msg = "Hai già votato per questo Sondaggio";
	//header("Refresh: 0; url=area.php?pag=vedi_voto.php&id=".$id);	
	echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=vedi_voto.php&id=$id\" />";
}		 
confirm($msg);
?>


