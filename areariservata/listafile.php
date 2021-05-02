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
<h3>Lista Files</h3>

<?php

$id = (int)$_GET['id'];

$sql = "SELECT cartella, id_padre FROM galleria WHERE id = $id LIMIT 1";
$rssql = mysql_query( $sql );
$sottodir = mysql_result( $rssql, 0, 0 );
$id_padre = mysql_result( $rssql, 0, 1 );

$sql = "SELECT cartella FROM galleria WHERE id = $id_padre LIMIT 1";
$rssql = mysql_query( $sql );
$dirpadre = mysql_result( $rssql, 0, 0 );

$dir ="../gals/".$dirpadre."/".$sottodir."/";

$titolo = "Eliminazione immagini sotto $sottodir";

if (isset($_GET['g'])) $g=1;
else $g=0;
?>

<script type="text/javascript">
$(function() {
	 $('#lista li > ul').each(function(i) {
    	  var parent_li = $(this).parent('li');
        parent_li.addClass('folder');
        var sub_ul = $(this).remove();
        parent_li.wrapInner("<a/>").find('a').click(function() {
        		sub_ul.toggle();        		
        });
        parent_li.append(sub_ul);
        $('#lista a').not(".del").fancyzoom({Speed:1000,showoverlay:true,overlay:7/10});        
    });
    $('#lista ul ul').hide();
});
</script>
<style>
#lista ul {
    list-style: none;
    margin: 0;
    padding: 0;
    font-size: 10pt;
}
#lista li {
    background-image: none;
    background-position: 0 1px;
    background-repeat: no-repeat;
    padding-left: 20px;
}
#lista li.folder {
    background-image: url(../img/folder.png);
}

#lista a {
    color: #000000;
    cursor: pointer;
    text-decoration: none;
}
#lista a:hover {
    text-decoration: underline;
}

</style>
<?
echo "<div class=\"contenitore\">";
if ($g==1) echo "<a href=\"javascript:history.go(-1)\">Ritorna</a><br/>";
echo "<div id=\"lista\">";
$extension = array( ".jpg", ".jpeg", ".gif", ".png" );
echo "<h5>$titolo</h5>";

$sql = "SELECT id, immagine, descrizione FROM galleria WHERE id_padre = $id";
$rssql = mysql_query( $sql );

if ( mysql_num_rows( $rssql ) > 0 ) {
	while( $r = mysql_fetch_row( $rssql ) ){
		echo "<div class=\"float100\">";
			echo "<img valign=\"middle\" src=\"../utility/thump.php?w=30&amp;h=30&amp;file=".$dir.$r[1]."&amp;nowa=1\"/>";
		echo "</div>";
		echo "<div class=\"float200\">";
			echo "Nome Immagine: $r[1]";
		echo "</div>";
		echo "<div class=\"float400\">";
			echo "<a class=\"del\" href=\"del.php?id=$r[0]\">";
         		echo "<img border=\"0\" src=\"./img/elimina.gif\" \>";
         	echo "</a>";
		echo "</div>";
		echo "<div class=\"azzerafloat\"></div>";
		echo "<p>&nbsp;</p>";
	}
}
else
	echo "<h3>Nessuna immagine presente in questa cartella</h3>";

echo "</div>";
if ($g==1) echo "<a href=\"javascript:history.go(-1)\">Ritorna</a><br/>";
echo "</div>";
?>  
