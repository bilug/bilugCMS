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

$cerca_sito = apici($_GET["c"]);
$page = _MAX_ARG;
$ind = (isset($_GET["ind"])) ? (int)mysql_real_escape_string( $_GET["ind"] ) : 0;

if ( isset( $_SESSION['bilug_ok'] ) ) {
	echo $_SESSION['bilug_ok'];
	unset( $_SESSION['bilug_ok'] );
	unset( $_SESSION['bilug_errore'] );
	echo "<meta http-equiv=\"refresh\" content=\"2;url="._URLSITO."\" />";
}
elseif ( isset( $_SESSION['bilug_errore'] ) ) {
	echo $_SESSION['bilug_errore'];
	unset( $_SESSION['bilug_errore'] );
}

if ( !isset( $_SESSION['bilug_ok'] ) AND $cerca_sito != "" ) {	
	$ip = $_SERVER['REMOTE_ADDR'];
	$data_cerca = date( 'Y-m-d H', time() );
	
	$ctrl = "SELECT query, ip FROM cerca WHERE query = '$cerca_sito' AND ip = '$ip' AND DATE_FORMAT( data, '%Y-%m-%d %H' ) = '$data_cerca' LIMIT 1";
	$rsctrl = mysql_query( $ctrl );
	if ( mysql_num_rows( $rsctrl ) == 0 ) {
		$insert = "INSERT INTO cerca SET query = '$cerca_sito', ip = '$ip', data = NOW();";
		mysql_query( $insert );
	}
	
	$str = "SELECT ID, titolo FROM notizie WHERE autorizza = 'si' AND (titolo LIKE '%$cerca_sito%' OR sottotitolo LIKE '%$cerca_sito%')";
	$risultato = mysql_query($str);
	$max = mysql_num_rows($risultato);

	if ( $max ) {
		if (isset($ind)) $index=$ind;
		if ($index<0 or !isset($index)) $index=0;
		if ( ($index % $page ) != 0 ) $index = 0;
		
		$max = intval( ( mysql_num_rows( $risultato ) - 1 ) / $page ) + 1;
		
		Nav($cerca_sito,$max,$index,$page);
		
		$str .= " LIMIT $index, $page";
		$risultato = mysql_query($str);	
		?>
		<h1><span>Risultato per la ricerca: &quot;<?=$cerca_sito?>&quot;</span></h1>
		<ul class="argo">
		<?php while ( $control = mysql_fetch_row($risultato) ) : 
			$link = rurl( $control[0], 'news' );	?>		
			<li>
				<h2 class="elenco"><a class="elenco" href="<?=$link?>"><?=$control[1]?></a></h2>
				<div class="elencoimg"><a href="<?=$link?>"><img width="30" height="30" alt="" src="<?=_URLSITO?>/img/water.png"></a></div>
				<div class="azzerafloat"></div>
			</li>
		<?php endwhile; ?>
		</ul>
		<?php
		
		Nav($cerca_sito,$max,$index,$page);
	}
	else { // errore nel caso in cui non troviamo nessun risultato ?>
		<h1><span>Nessun risultato trovato con la ricerca: &quot;<?=$cerca_sito?>&quot;</span></h1>
		
		<h2>Prova a fare un'altra ricerca sul form qui sotto</h2>
		
		<?php $testo_cerca = "Cerca nel sito"; ?>
		<div class="form"><?php include( "include/include_cerca.php" ) ?></div>
		
		<h2>Non hai trovato quello che cerchi?</h2>
		
		<div class="testo-consiglio">
			<p>Se cerchi una notizia che ancora non c'&egrave;, scrivi al form qui sotto.</p>
			<p>&nbsp;</p>
			<p>Se la notizia &egrave; pertinente col sito, ti manderemo un'e-mail della nuova notizia.</p>
			<p>&nbsp;</p>
		</div>
		
		<div class="form">
			<form name="form_cerca_utente" method="post" action="<?=_URLSITO?>/html/mail_cerca_notizia.php" onsubmit="return ctrl_cerca_utente(this);">
				<input type="hidden" name="c" value="<?=$cerca_sito?>" />
				<div class="form-campi">
					<label>Nome*: </label>
					<div class="form-input"><input class="textbox" type="text" name="nome" value="" /></div>
					<div class="azzerafloat"></div>
				</div>
				<div class="form-campi">
					<label>E-mail*: </label>
					<div class="form-input"><input class="textbox" type="text" name="mail" value="" /></div>
					<div class="azzerafloat"></div>
				</div>
				<div class="form-campi">
					<label>Testo*: </label>
					<div class="form-input"><textarea class="textbox" name="testo" value="" maxlength="255" cols="" rows=""></textarea></div>
					<div class="azzerafloat"></div>
					<p class="testo-consiglio">Inserisci un breve testo. Bastano poche righe... (MAX 255 caratteri)</p>
				</div>						
				
				<div class="form-campi">
					<div class="form-input small-input"><img src="<?=_URLSITO?>/img/cap_mail.php" alt="CAPTCHA SYSTEM"/></div>
					<div class="form-input"><input class="textbox" type="text" name="captcha" value="" /></div>
					<div class="azzerafloat"></div>
				</div>
				
				<div class="form-campi">
					<div class="form-input"><input class="buttonbox" type="submit" value="Invia" /></div>
					<div class="azzerafloat"></div>
				</div>
			</form>
		</div>
		 
		<script type="text/javascript">
		
		function ctrl_cerca_utente( f ) {
			var nome = Trim( f.nome.value );
			var mail = Trim( f.mail.value );
			var testo = Trim( f.testo.value );
			//var captcha = Trim( f.captcha.value );
			
			if ( nome == '' ) { alert( "Inserire un nome" ); return false; }
			if ( ctrl_mail_statico( mail ) ) { alert( "Inserire la mail correttamente" ); return false; }
			if ( testo == '' ) { alert( "Inserire il testo del messaggio" ); return false; }
			//if ( captcha != <?=$_SESSION['cap_mail']?> ) { alert( "Il captcha non e' corretto" ); return false; }
			
			return true;
		}
		
		</script>
		
	<?php
	}
}
else
	header("Refresh: 0; url="._URLSITO);

?> 




<?php

//funzione navigatore
function Nav($argo,$max,$pos,$pag)
{
	echo "<div class=\"navigazione\">";
	
	echo ( $max != 0 ) ? 
	 "<div class=\"numero-articoli\">Pagine Notizie: ".(($pos/$pag)+1)." di $max </div>" : 
	 "<div class=\"numero-articoli\">Nessuna notizia presente</div>";
	
	if ( $pos > 0 OR $max > ( ($pos/$pag)+1 ) ) {
		$link = _URLSITO . '/index.php?pag=cerca.php&c=' . $argo;
		
		echo "<div class=\"numero-pagina\">";
			if ( $pos > 0 ) {
				echo "<div class=\"precedente\">";
					$link1 = $link . "&ind=0";
					echo "<a href=\"$link1\">&lt;&lt; Inizio</a> ";
					$link2 = $link . "&ind=".($pos-$pag);
					echo "<a href=\"$link2\">&lt; Precedente</a> ";
				echo "</div>";
			}
			if ( $max > ($pos/$pag)+1 ) {
				echo "<div class=\"successivo\">";
					$link1 = $link . "&ind=".($pos+$pag);
					echo "<a href=\"$link1\">Successivo &gt;</a>";
					$link2 = $link . "&ind=".(($max*$pag)-$pag);
					echo "<a href=\"$link2\">Fine &gt;&gt;</a>";
				echo "</div>";
			}
			echo "<div class=\"azzerafloat\"></div>";
		echo "</div>";
	}
	echo "</div>";
}

?>


