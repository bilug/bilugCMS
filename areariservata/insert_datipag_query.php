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

$business = $_POST['business'];
$no_shipping = $_POST['no_shipping'];
$quantity = $_POST['quantity'];
$cancel_return = apici($_POST['cancel_return']);
$cn = $_POST['cn'];
$cbt = $_POST['cbt'];
$no_note = $_POST['no_note'];
$returnok = apici($_POST['returnok']);
$rm = $_POST['rm'];
$currency_code = $_POST['currency_code'];
$lc = $_POST['lc'];
$image_url = $_POST['image_url'];

$str=" UPDATE pagamento SET 
		business ='$business', 
		no_shipping='$no_shipping', 
		quantity='$quantity',
		cancel_return='$cancel_return',
		cn='$cn',
		cbt='$cbt',
		no_note='$no_note',
		returnok='$returnok',
		rm='$rm',
		currency_code='$currency_code',
		lc='$lc',
		image_url='$image_url' WHERE ID = 1";
    // query di modifica
    $risultato=mysql_query($str);
    if (!$risultato)
    // controllo se la query di modifica è andata a buon fine
        {
        $tipoerr="ERRORE: SONDAGGIO NON MODIFICATO";
        //echo "ERRORE: SONDAGGIO NON MODIFICATO";
        //echo "<br/><a href=\"area.php?pag=elenco_utenti.php\">Riprova</a>";
        echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_datipag.php&errore=si&tipoerr=$tipoerr\" />";
        }
    else
    //Header("Location: ");
	echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=conferma.php&from=insert_datipag.php\" />";
    exit;

?>
