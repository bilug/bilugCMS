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

$maxsize = _MAX_DIMENSIONE_A;
$file = $_FILES['file'];
$dove= $_POST['dove'];

echo "Nome del file locale creato dopo l'invio: ".$file['tmp_name']."\n";
echo "<br/>";
echo "Nome originale del file remoto: ".$file['name']."\n";
echo "<br/>";
echo "Dimensioni del file in byte: ".$file['size']."\n";
echo "<br/>";
echo "Tipo di file: ".$file['type']."\n";
echo "<br/>";
echo "<hr/>";
# abbiamo veramente un file?
if ( $file['name'] == "" ) {
echo "Non e' stato inviato alcun file<BR>";
exit;
}
# controlla innanzitutto le dimensioni del file
# se e' meno di maxsize
if ($file['size'] < $maxsize ) {
# lo copia in una nuova posizione
if (copy($file['tmp_name'],"../html/$dove/".$file['name']))
{
echo "<B>Invio del file riuscito</B>";
# cancella il file temporaneo
unlink($file['tmp_name']);
} else {
echo "Invio del file fallito";
}
} else {
echo "Spiacente, il file da inviare non deve superare le dimensioni di 3 KB<br/>";
}
?>