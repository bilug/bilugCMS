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

$testa = $_POST["testa"];
$piede = $_POST["piede"];

$filetesta= "../custom/testaform.php";
$filepiede= "../custom/piedeform.php";


if($testa=="")
{
	if(file_exists($filetesta))
	{
		unlink($filetesta);
	}
	$scrittura = "ok";
}
else
{
	$apertura = fopen("$filetesta","w+");
	$scrittura=fwrite($apertura,$testa);
}


if($piede=="")
{
	if(file_exists($filepiede))
	{
		unlink($filepiede);
	}
	$scrittura1 = "ok";
}
else
{
	$apertura1 = fopen("$filepiede","w+");
	$scrittura1=fwrite($apertura1,$piede);
}



if($scrittura and $scrittura1)
	{
		
				//Header("Location: ");
				echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=conferma.php\" />";
		
		
	}
	else
	{
		if(!$scrittura)
		{
			?>
				<div class="contenitore"><div class="azzerafloat"></div>
				<h2>Errore scrittura di testa pagina</h2>
				</div>
			<?
		}
		if(!$scrittura1)
		{
			?>
				<div class="contenitore"><div class="azzerafloat"></div>
				<h2>Errore scrittura di piede pagina</h2>
				</div>
			<?
		}
		
	}
	//chiusura file	
	@fclose($apertura);
	@fclose($apertura1);

?>
