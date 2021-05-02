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

$id = (int)$_GET['id'];
$argo = (int)$_GET['argo'];

$errore=null;
$errore=$_GET["errore"];
$tipoerr=$_GET["tipoerr"];
if($errore=="si")
{
		echo "<h1><img src=\"./img/alert.png\" class=\"ico\" />$tipoerr<img src=\"./img/alert.png\" class=\"ico\" /></h1>";
}

if ( $id <= 0 ) {
	$parola = Inserisci;
	
	$argomento=$_GET["arg"];
	$descrizione=$_GET["desc"];		 
}
else
{
	$parola = Modifica;

	$sql = "SELECT cartella, descrizione FROM galleria WHERE id = $id LIMIT 1";
	$rssql = mysql_query( $sql );
	$argomento = mysql_result( $rssql, 0, 0 );
	$descrizione = mysql_result( $rssql, 0, 1 );
}
?>
<div class="contenitore">
<form name="modify_arggal" method="post" action="insert_gal_query.php" enctype="multipart/form-data">
	
	<input type="hidden" name="id" value="<?=$id?>"/>
	<input type="hidden" name="argo" value="<?=$argo?>"/>	
	
	<h3><?=$parola?> <?=$argo?>&raquo;Galleria:</h3>	
	
	<p>Titolo <input type="text" name="arg" size="45" maxlength="50" value="<?=$argomento?>"/></p>
	<p>Descrizione <textarea name="desc" rows="6" cols="75"><?=$descrizione?></textarea></p>
	
	<p>
		<input type="submit"  class="medio" value="<?=$parola?>"/>
		<input type="button" class="medio" name="Annulla" value="Annulla" onclick="javascript:window.location='area.php?pag=elenco_arg_gallerie.php'" />
	</p>
	
</form>
</div>
