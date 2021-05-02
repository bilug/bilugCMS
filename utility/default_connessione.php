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
$host="$localhost";
// si mette localhost perchè il mysql risiede sulla stessa macchina dell'apache
$username="root";
$pass="root";
$dbname="provainstall";
$connect = mysql_connect($host, $username, $pass);
// se si mette @mysql_connect, cioè la @ davanti, inibisce i messaggi di errore
// mysql_select come lo fa Alberto
$controllo=mysql_select_db($dbname,$connect) or die ("Attenzione, non è possibile connettersi al DB");
// mysql_select come la fa Davide
//mysql_select_db ($dbname);
?>