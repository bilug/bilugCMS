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
	session_start();
	
	include( "../custom/costanti.php" );
	
	if ( isset($_SESSION['tux']) AND $_SESSION['tux'] > 0 ) header( "Location: "._URLSITO."/areariservata/area.php" );
?>

<html>
<head>

<title>Login area riservata Bilug</title>

<style type="text/css">

* { border: 0; margin: 0; padding: 0; }

body {
	margin: 0;
	padding: 0;
	background: #f9f9f9;
	font-family : Arial, Verdana, Helvetica;
	font-size : 15px;
	color : #777;
}

.clear { clear:both; }

a, a:visited, a:link, a:active, a:focus{
	text-decoration: none;
	margin:0;
	border:0;
	color: #333;	
} 
a:hover{		
	text-decoration: underline;
} 

h1,h2,h3,h4,h5{}

.content {
	width: 500px;
	margin: 80px auto 0;
}

.piede { 
	width: 350px;
	margin: 30px auto;
}
.piede a {
	text-decoration: underline;
	color: #004280;
}


.logo {
	text-align: center;
} 
.logo img { 
	max-width: 100%;
	width: auto;
	height: auto;
}

.login { 
	width: 350px; 
	margin: 0 auto; 
}
.login > div {
	background: #fff; 
	padding: 30px; 
	border: 1px solid #e5e5e5; 
	border-radius: 3px;	

	box-shadow: 0px 1px 17px rgba(0, 0, 0, 0.25);
	-moz-box-shadow: 0px 1px 17px rgba(0, 0, 0, 0.25);
	-webkit-box-shadow: 0px 1px 17px rgba(0, 0, 0, 0.25);	
} 
.login p {
	line-height: 30px;
}
	
h1 { text-align: center; }
h2 { text-align: center; margin-bottom: 30px; }

.campo {
}

.submit { text-align: center; margin-top: 10px; }

.textbox { 
  font-size: 14px;
  font-weight: normal;
  line-height: 20px;
  width: 100%;
  
  display: inline-block;
  height: 35px;
  padding: 4px 6px;
  margin-bottom: 10px;
  font-size: 14px;
  line-height: 20px;
  color: #555555;
  vertical-align: middle;
  -webkit-border-radius: 4px;
     -moz-border-radius: 4px;
          border-radius: 4px;
  background-color: #ffffff;
  border: 1px solid #ccc;

  -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
     -moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
          box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
  -webkit-transition: border linear 0.2s, box-shadow linear 0.2s;
     -moz-transition: border linear 0.2s, box-shadow linear 0.2s;
       -o-transition: border linear 0.2s, box-shadow linear 0.2s;
          transition: border linear 0.2s, box-shadow linear 0.2s;          
}
.textbox:focus {
  border-color: rgba(82, 168, 236, 0.8);
  outline: 0;
  outline: thin dotted \9;
  /* IE6-9 */

  -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(0, 66, 128, 0.6);
     -moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(0, 66, 128, 0.6);
          box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(0, 66, 128, 0.6);
}

input[type="submit"] {
  display: inline-block;
  *display: inline;
  padding: 10px 20px;
  margin-bottom: 0;
  *margin-left: .3em;
  font-size: 14px;
  line-height: 20px;
  color: #fff;
  text-align: center;
  text-shadow: 0 1px 1px rgba(255, 255, 255, 0.75);
  vertical-align: middle;
  cursor: pointer;
  background-color: #f5f5f5;
  *background-color: #004280;
  background-image: -moz-linear-gradient(top, #55a1e1, #004280);
  background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#55a1e1), to(#004280));
  background-image: -webkit-linear-gradient(top, #55a1e1, #004280);
  background-image: -o-linear-gradient(top, #55a1e1, #004280);
  background-image: linear-gradient(to bottom, #55a1e1, #004280);
  background-repeat: repeat-x;
  border: 1px solid #cccccc;
  *border: 0;
  border-color: #004280 #004280 #bfbfbf;
  border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
  border-bottom-color: #b3b3b3;
  -webkit-border-radius: 4px;
     -moz-border-radius: 4px;
          border-radius: 4px;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffffff', endColorstr='#ffe6e6e6', GradientType=0);
  filter: progid:DXImageTransform.Microsoft.gradient(enabled=false);
  *zoom: 1;
  -webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
     -moz-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
          box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);	
}


input[type="submit"]:hover, input[type="submit"]:focus, input[type="submit"]:active {
  background-color: #004280;
  *background-color: #d9d9d9;
}

input[type="submit"]:active {
  background-color: #cccccc \9;
  background-image: none;
  outline: 0;
  -webkit-box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.15), 0 1px 2px rgba(0, 0, 0, 0.05);
     -moz-box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.15), 0 1px 2px rgba(0, 0, 0, 0.05);
          box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.15), 0 1px 2px rgba(0, 0, 0, 0.05);  
}

input[type="submit"]:hover,
input[type="submit"]:focus {
  text-decoration: none;
  background-position: 0 -15px;
  -webkit-transition: background-position 0.1s linear;
     -moz-transition: background-position 0.1s linear;
       -o-transition: background-position 0.1s linear;
          transition: background-position 0.1s linear;
}

input[type="submit"]:focus {
  outline: thin dotted #333;
  outline: 5px auto -webkit-focus-ring-color;
  outline-offset: -2px;
}



</style>

</head>

<body>
<div class="content">
	<div class="logo">
		<img src="<?=_URLSITO?>/areariservata/img/logo.png" height="" width="" alt="BilugCMS" />
	</div>
	<div class="login"><div>
		<form name="inserimento" method="post" action="<?=_URLSITO?>/areariservata/guardian.php">
			<div class="campo">
				<p>Nome Utente</p>
				<p><input class="textbox" type="text" name="Nomeutente" size="15" maxlength="50" tabindex="1"/></p>
			</div>
			<div class="campo">
				<p>Password</p>
				<p><input class="textbox" type="password" name="Parola" size="15" maxlength="20" tabindex="2"/></p>
			</div>
			<div class="campo submit">			
				<p><input type="submit" class="medio" value="Collegati"></p>
			</div>
		</form>
	</div></div>
	<div class="piede">
		<a href="<?=_URLSITO?>">Torna a <?=_SITO?></a>
	</div>
</div>

</body>
</html>
