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
<?php

require_once("auth.php");

$aut = $_GET["aut"];
$id = $_GET["id"];
$from = $_GET["from"];


if($_SESSION['typo']== "U")
{
	echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=elenco_notargaut.php\" />";
	$msg = "AZIONE NON CONSENTITA";				  
	confirm($msg);
	exit;
}


$str="Update notizie Set autorizza='$aut' WHERE ID='$id'";
// facciamo una query di aggiornamento
$risultato=mysql_query($str);
if (!$risultato)
    {
    echo "ERRORE: NOTIZIA NON AUTORIZZATA";
    echo "<br/><a href=\"area.php?pag=elenco_notargaut.php\">Riprova</a>";
    }
else
{
	ob_start();
	require_once("gestionerss.php");
	//Header("Location: area.php?pag=conferma.php");
	echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=conferma.php&from=$from\" />";
	ob_end_flush();
}
exit;
?>
