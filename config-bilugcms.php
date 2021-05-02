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

<?php include( "utility/connessione.php" ); ?>

<html>
<head>

<title>Configurazione parametri BilugCMS</title>

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.lightbox.min.js" ></script>

<link rel="stylesheet" type="text/css" href="css/jquery.lightbox.css">

<script type="text/javascript">
// Effetto sulle immagini
$(document).ready(function(){ 
	// Opzioni per la lightbox
	var options = {
		imageLoading: 'img/lightbox/lightbox-ico-loading.gif',
		imageBtnClose: 'img/lightbox/lightbox-btn-close.gif',
		imageBtnPrev: 'img/lightbox/lightbox-btn-prev.gif',
		imageBtnNext: 'img/lightbox/lightbox-btn-next.gif',
		txtImage: 'Immagine',
		txtOf: 'di'
	}
	
	// Effetto lightbox sulle gallerie
	$('a.lightbox').lightBox(options);
});
</script>

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


.templates {}
.templates .temp { float: left; margin-left: 14px; width: 286px; margin-bottom: 30px; }
.templates .temp p { text-align: center; font-size: 14px; }
.templates .temp a { display: block; border: 3px solid #eee; }
.templates .temp a:hover { display: block; border: 3px solid #333; }
.templates .temp a img { width: 280px; height: auto; }


</style>

</head>

<body>
<?php


if ( !isset( $_POST["script"] ) OR $_POST["script"] != "ok" ) {
	?>
	<div id="content">
		<h2 id="install">Configurazione parametri BilugCMS</h2>
		<br />
		<div class="contenitore">
			<form name="install" method="post" action="<?=$_SERVER['PHP_SELF']?>">
				<input type="hidden" name="script" value="ok">
				<div class="campo-big">Scegli il template:</div>
				
				<div class="clear"></div>
				
				<div class="templates">
				<?php
					$sql = "SELECT nome, cartella FROM templates ORDER BY id";
					$rssql = mysql_query( $sql );
					$cont = 0;
					$cont_checked = 0;
					while( $r = mysql_fetch_row( $rssql ) ) : ?>
						<div class="temp">
							<?php $link = "templates/$r[1]/img/stamp.jpg"; ?>
							
							<?php if ( $cont_checked != 0 ) : ?>
								<p><?=$r[0]?> <input type="radio" name="template" value="<?=$r[1]?>"></p>
							<?php else : ?>
								<p><?=$r[0]?> <input type="radio" name="template" value="<?=$r[1]?>" checked></p>
							<?php endif; ?>
							
							<p>&nbsp;</p>
							<p><a class="lightbox" href="<?=$link?>"><img src="<?=$link?>" width="" height="" alt="<?=$r[0]?>" title="<?=$r[0]?>" /></a></p>
						</div>
						
						<?php $cont++; $cont_checked++;
						if ( $cont == 3 ) : $cont = 0; ?>
							<div class="clear"></div>
						<?php endif; ?>
					<?php endwhile; ?>
				</div>
				
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
	$template = $_POST["template"];
	
	if ( $template == '' ) {
		echo "<script type=\"text/javascript\"> alert( 'Specificare il template' ); </script>";
		echo "<meta http-equiv=\"refresh\" content=\"0;url=config-bilugcms.php\" />";	
	}
	else {
		//importazione
		$link = "templates/$template/dump.sql";
		header("Location: ./bigdump.php?parte=2&template=$template&dbname=$dbname&pass=$pass&username=$username&host=$host&start=1&fn=$link&foffset=0&totalqueries=0");		
	}
		

}


?>
</body>
</html>
