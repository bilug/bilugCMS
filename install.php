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

<title>Installazione BilugCMS</title>

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

.left { float: left; }
.clear { clear: both; }

#content { width: 700px; margin: 100px auto 0; background: #eee; padding: 20px; border: 1px solid #333; border-radius: 10px; }
	
.contenitore{ width: 440px; margin: 0 auto;  }

#install{
	margin-bottom: 20px;
	font-size: 25px;
	color: #ffac0b;
	text-shadow: 3px 3px 6px #000;
	text-align: center;
}

.float100 { float: left; width: 200px; }
.float100 h1 { text-align: left; }
.float100 input[type="password"], .float100 input[type="text"] { padding: 0 5px; border: 1px solid #888; }

input[type="submit"] { padding: 5px 10px; border: 1px solid #888; background: #ccc; cursor: pointer; border-radius: 5px; }
input[type="submit"]:hover { background: #333; color: fff; }
	
	
#loader {
	display: none;
	width: auto;
	height: auto;
}	
	
</style>

</head>

<body>
<?
//concatenazione parti fisse e variabili
function concatenazione($username,$pass,$dbname,$host)
{
	$licenza = "<? /* license

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

For reference, contact bilugcms@vilnet.it\n

license */ ?> \n";	
	
	$variabile = "<?
	\n\$host=\"$host\";\n// si mette localhost perchè il mysql risiede sulla stessa macchina dell'apache\n\$username=\"$username\";\n\$pass=\"$pass\";\n\$dbname=\"$dbname\";\n";

	$controllo = "\$connect = mysql_connect(\$host, \$username, \$pass);\n// se si mette @mysql_connect, cioè la @ davanti, inibisce i messaggi di errore\n// mysql_select come lo fa Alberto\n\$controllo=mysql_select_db(\$dbname,\$connect) or die (\"Attenzione, non &egrave; possibile connettersi al DB\");\n// mysql_select come la fa Davide\n//mysql_select_db (\$dbname);\n 
	?>";
	
	$conc = "".$licenza."".$variabile."".$controllo."";
	return $conc;
}


if ( !isset( $_POST["script"] ) OR $_POST["script"] != "ok" ) {
	?>
	<div id="content">
		<h2 id="install">Installazione BilugCMS: Credenziali MySQL</h2>
		<br><br>
		<div class="contenitore">
			<form name="install" method="post" action="<?=$_SERVER['PHP_SELF']?>">
				<input type="hidden" name="script" value="ok">
				
				<div class="float100"> <h1>Indirizzo server MySQL: </h1> </div>
				<div class="float100"> <input type="text" name="host" value="localhost"> </div>
				<br><br>				
				
				<div class="float100"> <h1>Username MySQL: </h1> </div>
				<div class="float100"> <input type="text" name="username"> </div>
				<br><br>
				
				<div class="float100"> <h1>Password MySQL: </h1> </div>
				<div class="float100"> <input type="password" name="pass"> </div>
				<br /><br />
				
				<div class="float100"> <h1>Nome DB MySQL: </h1> </div>
				<div class="float100"> <input type="text" name="dbname"> </div>
				<br /><br /><br />
				
				<div class="left"><input type="submit" value=".:Avanti:."></div>
				
				<div class="clear"></div>
			</form>
		</div>
	</div>
	
	<iframe name="dumpdb" style="display:none" />
	
	<?
}
else
{
	//si esegue lo script
	// si raccoglie tutti i dati
	$host=$_POST["host"];	
	$username=$_POST["username"];
	$pass=$_POST["pass"];
	$dbname=$_POST["dbname"];
	
	$connect = mysql_connect($host, $username, $pass);
	if ( !$connect ) {
		mysql_close();
		echo "<script type=\"text/javascript\"> alert( 'Parametri di connessione errati' ); </script>";
		echo "<meta http-equiv=\"refresh\" content=\"0;url=install.php\" />";
	} elseif ( !mysql_select_db($dbname,$connect) ) {
		mysql_close();
		echo "<script type=\"text/javascript\"> alert( 'Parametri di connessione corretti, ma database errato o insesistente' ); </script>";
		echo "<meta http-equiv=\"refresh\" content=\"0;url=install.php\" />";		
	} else {
		//si scrive nel file utility/connessione.php
		$filename= "./utility/connessione.php";
		//apro il file con w cosi sn sicuro che all'apertura sia vuoto.
		$file = fopen("$filename","w+");
		//funzione di concatenazione parti fisse e variabili
		$scritta=concatenazione($username,$pass,$dbname,$host);
		//scrittura nel file
		$scrittura=fwrite($file,$scritta);

		//chiusura file	
		@fclose($file);
		
		
		//importazione
		header("Location: ./bigdump.php?parte=1&dbname=$dbname&pass=$pass&username=$username&host=$host&start=1&fn=bilug.sql&foffset=0&totalqueries=0");
	}
}


?>
</body>
</html>
