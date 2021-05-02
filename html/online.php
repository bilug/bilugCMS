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
<div class="blocco">
<?
$dataphp = _URLSITO."/custom/data.php";
$timemax = "300"; //Max. tempo utenti on line sul sito
$ipadress = $_SERVER['REMOTE_ADDR'];
$timenow = explode (" ", microtime());
$timenow = $timenow[1];
include ($dataphp);
$timedelete = $timemax;
$deleted = $deleted + $timedelete;
if ($deleted < $timenow){
$file = fopen($dataphp,"w+");
fputs($file, "<?PHP \$deleted = \"$timenow\"; ?>\n");
$number = count($visitor_b);
for ($tel = 0; $tel < $number; $tel++){
$visitor_a = $visitor_b[$tel];
$visitor_a[0] = $visitor_a[0] + $timemax;
if ($visitor_a[0] > $timenow)
fputs($file, "<?PHP \$visitor_b[] = array('$visitor_a[0]','$visitor_a[1]'); ?>\n");
}
fclose($file);
}
$visitor_b = "";
include ("data.php");
$number = count($visitor_b);
for ($tel = 0; $tel < $number; $tel++){
$visitor_a = $visitor_b[$tel];
if ($visitor_a[1] == $ipadress)
$save = "nee";
}
if (!$save){
$file = fopen("data.php","a");
fputs($file, "<?PHP \$visitor_b[] = array('$timenow','$ipadress'); ?>\n");
fclose($file);
}
$visitor_b = "";
include ("data.php");
$number = count($visitor_b);
for ($tel = 0; $tel < $number; $tel++){
$visitor_a = $visitor_b[$tel];
$visitor_a[0] = $visitor_a[0] + $timemax;
if ($visitor_a[0] > $timenow)
$online = $online + 1;
}
if (!$online)
$online = 1;
if ($online == 1)
print ("<h3>$online utente online</h3>");
else
print ("<h3>$online utenti online</h3>");
?>
</div>
