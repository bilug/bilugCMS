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

<style type="text/css">
	#tabs {
		width: 99%;
	}
	</style>
	<script type="text/javascript">
	$(function() {
		$("#tabs").tabs();
	});
	</script>
	

<h3> Notizie </h3>
<div id="tabs">
	<ul>
		<li><a href="#fragment-1"><span>Per Argomento</span></a></li>
		<li><a href="#fragment-2"><span>Per Autore</span></a></li>
		<li><a href="#fragment-3"><span>Non Autorizzate (<?include("./daautorizzare.php")?>)</span></a></li>
		<li><a href="#fragment-4"><span>Ultime notizie</span></a></li>
		<li><a href="#fragment-5"><span>Notizie pi&ugrave; cliccate</span></a></li>
		<li><a href="#fragment-6"><span>Cerca notizia</span></a></li>
		<li><a href="#fragment-7"><span>Nuova Notizia</span></a></li>
		<li><a href="#fragment-8"><span>Log cerca</span></a></li>
	</ul>             
					
	<div id="fragment-1"><?php include("./elenco_notizie.php") ?></div>
	<div id="fragment-2"><?php include("./elenco_notizieaut.php") ?></div>
	<div id="fragment-3"><?php include("./elenco_nonaut_notizie.php") ?></div>
	<div id="fragment-4"><?php include("./ultime_notizie.php") ?></div>	
	<div id="fragment-5"><?php include("./elenco_notizie_cliccate.php") ?></div>	
	<div id="fragment-6"><?php include("./cerca_notizie.php") ?></div>	
	<div id="fragment-7"><?php include("./insert_notizie.php") ?></div>
	<div id="fragment-8"><?php include("./elenco_log_cerca.php") ?></div>
</div>
		
