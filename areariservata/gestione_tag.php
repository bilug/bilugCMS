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

<link type="text/css" href="css/ui-lightness/jquery-ui-1.7.3.custom.css" rel="stylesheet" />	
<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.7.3.custom.min.js"></script>

<script type="text/javascript">
$(function() {
	$("#tabs").tabs();
});
</script>

<h3>Gestione dei TAG</h3>

<div id="tabs">
	<ul>
		<li><a href="#fragment-1"><span>Elenco TAG</span></a></li>
		<li><a href="#fragment-2"><span>Inserisci nuovo TAG</span></a></li>
	</ul>             
					
	<div id="fragment-1"><?php include("./elenco_tag.php") ?></div>
	<div id="fragment-2"><?php include("./insert_tag.php") ?></div>
</div>
