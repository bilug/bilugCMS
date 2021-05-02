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
	include( "utility/connessione.php" ); 
	include( "utility/funzioni.php" ); 
?>

<html>
<head>

<title>Configurazione parametri BilugCMS</title>

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

.clear { clear: both }

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

#content { width: 900px; margin: 30px auto; background: #eee; padding: 20px; border: 1px solid #333; border-radius: 10px; }
	
.contenitore{ margin: 0 auto;  }

#install{
	margin-bottom: 20px;
	font-size: 25px;
	color: #ffac0b;
	text-shadow: 3px 3px 6px #000;
	text-align: center;
}

.float100 { float: left; width: 100px; }
.float100 h1 { text-align: left; }
.float100 input[type="password"], .float100 input[type="text"] { padding: 0 5px; border: 1px solid #888; }


.submit { text-align: center; }
input[type="submit"] { padding: 5px 10px; border: 1px solid #888; background: #ccc; cursor: pointer; border-radius: 5px; }
input[type="submit"]:hover { background: #333; color: #fff; }

.campo-big {
	font-weight: bold;
	font-size: 20px;
	text-align: center;
	margin-bottom: 20px;
}


.campo { margin-bottom: 20px; }

.campo1 { 
	width: 250px; 
	font-size: 11px;
	margin-left: 10px;
}
.campo1, .campo2 { 
	float: left;
}
.campo2 { 
	width: 600px; 
}
.campo2 input[type="text"] { 
	width: 600px;
	border: 1px solid #888;	
}
.campo2 textarea { 
	width: 600px;
	height: 200px;
	border: 1px solid #888;	
}
.campo2 select { 
	width: 150px;
	border: 1px solid #888;	
}


blockquote { padding: 20px; background-color: #f2dede; border: 1px solid #eed3d7; border-radius: 5px; color: #b94a48; }
blockquote h3 { text-align: left; font-size: large; margin-bottom: 15px; }
blockquote p { line-height: 20px; padding-left: 20px; }
blockquote cite { font-size: larger; line-height: 40px; }

</style>

</head>

<body>
<?php


if ( !isset( $_POST["script"] ) OR $_POST["script"] != "ok" ) {
	?>
	<div id="content">
		<h2 id="install">Configurazione parametri BilugCMS</h2>
		
		<blockquote>
			<h3>Inserire la variabile "_URLSITO" per il corretto funzionamento del sito</h3>
			<p>Esempio in locale: http://localhost/nome_sito</p>
			<p>Esempio online: http://www.nome_sito.it</p>
			<p><cite><strong>Importante!</strong> Non devi inserire lo slash finale</cite></p>
		</blockquote>
		
		<p>&nbsp;</p>
		
		<div class="contenitore">
			<form name="install" method="post" action="<?=$_SERVER['PHP_SELF']?>">
				<input type="hidden" name="script" value="ok">
				<div class="campo-big">Completa i parametri standard del tuo sito:</div>
				
				<div class="clear"></div>

				<?php
					$annulla = "<input type=\"button\" 
					class=\"medio\" name=\"Annulla\" value=\"Annulla\" onclick=\"javascript:window.location='area.php'\" />";

					
					$sezione = "<br/><div><h1>sezione</h1><hr/></div>\n";
					$label = "<div class=\"campo1\">label:</div>\n<div class=\"campo2\">\n";
					$campo = "<input type=\"text\" name=\"nome\" size=\"95\" maxlength=\"254\" value=\"valore\"/>\n";
					$campotesto = "<textarea name=\"nome\" rows=\"righe\" cols=\"95\">valore</textarea>\n";
					$div = "</div>\n<div class=\"clear\"></div>\n";
					
					$sql = "SELECT sezione, label, nomecampo, valore, tipo, ID FROM parametri WHERE sezione = 0 ORDER BY ID";
					$rssql = mysql_query( $sql );
					while ( $r = mysql_fetch_row( $rssql ) ) {
						echo "<div class=\"campo\">";
							$label1 = str_replace( "label", $r[1]."(".$r[2].")", $label );
							echo $label1;						
							
							if (strlen($r[3])<95)	
								$campo1 = str_replace(array("nome","valore"),array($r[5],$r[3]),$campo);
							else
								$campo1 = str_replace(array("nome","valore","righe"),array($r[5],$r[3],((strlen($r[3])/50)+1)),$campotesto);	   	
								
							echo $campo1;
							
							selezione( $r[5]."_tipo",$tipivariabile,$r[4]);
							echo $div;
						echo "</div>";
					}
				?>
				<div class="clear"></div>
				
				<br />
								
				<div class="submit"><input type="submit" value=".:Avanti:."></div>
			</form>
		</div>
	</div>
	<?
}
else
{	
	$err = false;
	foreach ($_POST as $key => $value) {
		if ( is_numeric( $key ) ) {
			$value1 = mysql_real_escape_string($_POST[$key."_tipo"]);
			$value = mysql_real_escape_string($value);			
			$str=" UPDATE parametri SET valore = '$value', tipo = '$value1' WHERE ID = '$key' LIMIT 1";
			$risultato=mysql_query($str);
    		if ( !$risultato ) {
				$tipoerr="ERRORE: DATI $value di $key non completi";        		       		
				$err = true;
			}
		}
	}
	if ( $err ) 
		echo "<meta http-equiv=\"refresh\" content=\"0;url=config-bilugcms-parametri.php\" />";
  	else {  		
		include_once ("bilugcms-genera-parametri.php");
		header("Location: ./success3.php");			
  	}
}


?>
</body>
</html>
