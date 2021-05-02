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
function control($pag)
{
	session_start();
	$utid=$_SESSION['tux'];
	$utpri=$_SESSION['typo'];
	//echo"<h1>$pag</h1>";
	//echo "$utpri<br>";
	
	switch($utpri)
	{
			case "S": $utpri="AS";
				break;
			case "U": $utpri="ASU";
				break;
	}
	
	if($utpri=="A" or $pag=="")
	{
		return ok;
	}
	else
	{
		$query= "SELECT permessi FROM menuadmin WHERE link='$pag'";
		$risultato=mysql_query($query);
		$ris=mysql_fetch_row($risultato);
		if (mysql_num_rows($risultato))
		{
			
				if($ris[0]==$utpri or $ris[0]=="ASU")
				{
						
						return ok;
				}
				else
				{
						echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php\" />";
						$msg = "NON POSSIEDI I PRIVILEGI RICHIESTI";				  
						confirm($msg);
						exit;
				}
		}
		else
		{
			return ok;
		}
	}
	
	
	
}
?>
