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


<html>
<head>

<style type="text/css">

* { border: 0; margin: 0; padding: 0; }

body {
	margin: 0;
	padding: 0;
	background: #fff;
	font-family : Verdana,Arial,Helvetica;
	font-size : 11px;
	color : #333;
}

a, a:visited, a:link, a:active, a:focus{
	text-decoration: none;
	margin:0;
	border:0;
	color: #333;	
} 
a:hover{		
	text-decoration: underline;
} 

h1,h2,h3,h4,h5{
	margin: 0;
	padding: 0;
	font-weight: bolder;
	font-size: 8pt;	
	text-align: center;	
}
	
.contenitore{
	width: 700px; 
	margin: 100px auto 0; 
	background: #eee;  
	border: 1px solid #333; 
	border-radius: 10px;
}

.install{
	font-size: 25px;
	color: #ffac0b;
	text-shadow: 2px 2px 3px #000;
	margin: 30px 0;
}
.install a { color: #ffac0b; font-size: 30px; }
.install a:hover { color: #00f; text-decoration: none; }

.installer{
	margin: 20px;
	font-size: 25px;
	color: #f00;
	text-shadow: 2px 2px 3px #000;
}

</style>
</head>

<body>
	
	
<div class="contenitore">

	<h2 class="install">File dei parametri modificato !</h2>

<?php

@$canc1 = unlink("success2.php");
@$canc2 = unlink("config-bilugcms-parametri.php");
@$canc3 = unlink("bilugcms-genera-parametri.php");

if(!$canc1 OR !$canc2 OR !$canc3) {
?>
	<h2 class="installer">Errore nella cancellazione dei Files !</h2>
<?php
}
else {
?>
	<h2 class="install">Files cancellati correttamente!</h2>
<?php } ?>
	
	
	<h2 class="install"><a href="index.php">Play to BilugCMS</a></h2>

</div>

</body>

</html>