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

// Lista delle parole da non tenere conto
$parole_inutili = array( 
	'il', 'lo', 'la', 'i', 'gli', 'le', // articoli determinativi
	'un', 'una', 'uno', // articoli indeterminativi 
	'di', 'a', 'da', 'in', 'con', 'su', 'per', 'tra', 'fra', // preposizioni
	'del', 'della', 'delle', 'dei', 'degli', 'dalla', 'dalle', 'dagli', 'sul', 'sulle', 'sugli', 'sui', 'nel', 'nelle', 'negli', 'nella', 'nei', // preposizioni articolate
	'dell', 'all', 'l', 'dall', // preposizioni con apostrofi
	'che', 'ma', 'pero', 'o', 'e'  // congiunzioni
);
$caratteri_inutili = array( 
	'.', ',', ';', ':', '\'', '\"', '"', "'", // punteggiatura
	'-', '_', '+', '*', '/', '=', '\\', '?', '!', // altro
	'§', '#', '°', '’' // altro
);
$caratteri_speciali = array(
	'&amp;', '&deg;', '&ccedil;', '&quot;', '&rsquot;', '&gt;', '&lt;', '&sect;', '&#039;'
);
$estensioni_immagini = array( 'jpg', 'jpeg', 'gif', 'png' );

//Array
$nomemese = Array("Gennaio","Febbraio","Marzo","Aprile","Maggio","Giugno", "Luglio","Agosto","Settembre","Ottobre","Novembre","Dicembre");
$tipivariabile = array("Testo","Numerico","Vero/Falso","Oggetto");
$tipisezione = array("Sito","Argomenti","Galleria","Galleria Random","Eventi","Pagine Statiche","E-commerce");
$risoluzioni = array(array(425,264),array(480,295),array(560,345),array(640,385),array(670,405));
$sitivideo = array("YouTube"=>"http://www.youtube-nocookie.com/v/","Google Video"=>"http://video.google.com/googleplayer.swf?docid=");
// classi
class DatiFilmato
{
	var $sito= "YouTube";
	var $ris = 0;
	var $codice = "";
	var $rel = 1;
	var $bordi = 0;
	var $pos = 0;	
}

//Funzioni

function pulisci_stringa($parola)
{
    /*con str_replace sostituiamo un carattere nella stringa con un altro*/
    //$parola=str_replace("à","a'",$parola); 
    //$parola=str_replace("è","e'",$parola);
    //$parola=str_replace("é","e'",$parola);
    //$parola=str_replace("ì","i'",$parola);
    //$parola=str_replace("ù","u'",$parola);
    //$parola=str_replace("ò","o'",$parola);
    
    $parola=str_replace("*","",$parola);
    $parola=str_replace("+","",$parola);
    $parola=str_replace("(","",$parola);
    $parola=str_replace(")","",$parola);
    $parola=str_replace("=","",$parola);
    $parola=str_replace("^","",$parola);
    $parola=str_replace("&","",$parola);
    $parola=str_replace("%","",$parola);
    $parola=str_replace("$","",$parola);
    $parola=str_replace("€","E",$parola);
    $parola=str_replace("£","",$parola);
    $parola=str_replace("|","",$parola);
    $parola=str_replace("#","",$parola);
    $parola=str_replace("°","",$parola);
    $parola=str_replace("§","",$parola);
    $parola=str_replace("[","",$parola);
    $parola=str_replace("]","",$parola);
    $parola=str_replace(">","",$parola);
    $parola=str_replace("<","",$parola);
        
    $parola=str_replace("'","`",$parola);

    return $parola;
}

function pulisci_stringa_utenti($parola)
{
	$parola=trim($parola);
    $parola=str_replace("*","",$parola);
    $parola=str_replace("+","",$parola);
    $parola=str_replace("(","",$parola);
    $parola=str_replace(")","",$parola);
    $parola=str_replace("=","",$parola);
    $parola=str_replace("^","",$parola);
    $parola=str_replace("&","",$parola);
    $parola=str_replace("%","",$parola);
    $parola=str_replace("$","",$parola);
    $parola=str_replace("€","E",$parola);
    $parola=str_replace("£","",$parola);
    $parola=str_replace("|","",$parola);
    $parola=str_replace("#","",$parola);
    $parola=str_replace("°","",$parola);
    $parola=str_replace("§","",$parola);
    $parola=str_replace("[","",$parola);
    $parola=str_replace("]","",$parola);
    $parola=str_replace(">","",$parola);
    $parola=str_replace("<","",$parola);        
    $parola=str_replace("'","`",$parola);
          
    return $parola;
}
function pulisci_stringa_gal($parola)
{
	$parola=trim($parola);
    $parola=str_replace("*","",$parola);
    $parola=str_replace("+","",$parola);
    $parola=str_replace("(","",$parola);
    $parola=str_replace(")","",$parola);
    $parola=str_replace("=","",$parola);
    $parola=str_replace("^","",$parola);
    $parola=str_replace("&","",$parola);
    $parola=str_replace("%","",$parola);
    $parola=str_replace("$","",$parola);
    $parola=str_replace("€","E",$parola);
    $parola=str_replace("£","",$parola);
    $parola=str_replace("|","",$parola);
    $parola=str_replace("#","",$parola);
    $parola=str_replace("°","",$parola);
    $parola=str_replace("§","",$parola);
    $parola=str_replace("[","",$parola);
    $parola=str_replace("]","",$parola);
    $parola=str_replace(">","",$parola);
    $parola=str_replace("<","",$parola);
        
    $parola=str_replace("'''","`",$parola);
	 //$parola=str_replace(" ","_",$parola);
    $parola =stripslashes($parola);
    //con strtoupper trasformiamo tutto in maiuscolo               
    return $parola;
}
function pulisci_stringa_dir($parola)
{
    /*con str_replace sostituiamo un carattere nella stringa con un altro*/
    //$parola=str_replace("à","a'",$parola); 
    //$parola=str_replace("è","e'",$parola);
    //$parola=str_replace("é","e'",$parola);
    //$parola=str_replace("ì","i'",$parola);
    //$parola=str_replace("ù","u'",$parola);
    //$parola=str_replace("ò","o'",$parola);
    
	$parola=trim($parola);
    $parola=str_replace("*","",$parola);
    $parola=str_replace("+","",$parola);
    $parola=str_replace("(","",$parola);
    $parola=str_replace(")","",$parola);
    $parola=str_replace("=","",$parola);
    $parola=str_replace("^","",$parola);
    $parola=str_replace("&","",$parola);
    $parola=str_replace("%","",$parola);
    $parola=str_replace("$","",$parola);
    $parola=str_replace("€","E",$parola);
    $parola=str_replace("£","",$parola);
    $parola=str_replace("|","",$parola);
    $parola=str_replace("#","",$parola);
    $parola=str_replace("°","",$parola);
    $parola=str_replace("§","",$parola);
    $parola=str_replace("[","",$parola);
    $parola=str_replace("]","",$parola);
    $parola=str_replace(">","",$parola);
    $parola=str_replace("<","",$parola);
        
    $parola=str_replace("'","`",$parola);
	 $parola=str_replace(" ","_",$parola);	 
    //$parola=strtolower($parola);
    $parola =stripslashes($parola);
    //con strtoupper trasformiamo tutto in maiuscolo               
    return $parola;
}

// cancella l'intero contenuto di una cartella
function rmdirr($dir) {
	if($objs = @glob($dir."/*")){
		foreach($objs as $obj)
			$r = @is_dir($obj) ? rmdirr($obj) : @unlink($obj);
	}

	$r = @rmdir($dir);
	
	return $r;
}

function apici($parola)
{
	$parola = trim($parola);
	$parola = htmlentities( $parola, ENT_QUOTES, 'UTF-8' );
	
	return mysql_real_escape_string( $parola );
}

function controlla_mail($mail) 
{
		if (!ereg("@",$mail) OR !ereg("\.",$mail)) 
		{
			return false;
			exit;
		} 
		else
		return $mail;
}

function chkEmail1($email)
{  
	// elimino spazi, "a capo" e altro alle estremità della stringa
	$email = trim($email);
 
	// se la stringa è vuota sicuramente non è una mail
	if(!$email) {
		return false;
	}
 
	// controllo che ci sia una sola @ nella stringa
	$num_at = count(explode( '@', $email )) - 1;
	if($num_at != 1) {
		return false;
	}
 
	// controllo la presenza di ulteriori caratteri "pericolosi":
	if(strpos($email,';') || strpos($email,',') || strpos($email,' ')) {
		return false;
	}
 
	// la stringa rispetta il formato classico di una mail?
	if(!preg_match( '/^[\w\.\-]+@\w+[\w\.\-]*?\.\w{1,4}$/', $email)) {
		return false;
	}
 
	return true;
} 

function TagliaStringa($stringa, $max_char){
        if(strlen($stringa)>$max_char){
            $stringa_tagliata=substr($stringa, 0,$max_char);
            $last_space=strrpos($stringa_tagliata," ");
            $stringa_ok=substr($stringa_tagliata, 0,$last_space);
            return $stringa_ok."...";
        }else{
            return $stringa;
        }
    }


function galleria_visualizza($gal) {
	$gal = str_replace( array('_', '-'), ' ', $gal );
	
	return $gal;
} 


function breadcrumbs( $lista ){
	if ( _ABILITA_BREADCRUMBS ) {
		echo "<ul class=\"breadcrumb\">";
			foreach( $lista as $menu => $link ) {
				echo ( $link != '' ) ?
					"<li><a href=\"$link\">$menu</a> <span class=\"divider\">/</span></li>" :
					"<li class=\"active\">$menu</li>" ;
			}
		echo "</ul>";
	}
}


function selezione($nome,$valori,$default=0)
// Funzione per creare select runtime
// var nome della select , un array valori con le scelte e eventuale default di scelta
{
	echo "<select name='$nome'>\n";
	foreach ($valori as $key => $value)
	{
		echo "<option value='$key' label='$value' ";
		if ($default == $key) echo "selected";
		echo ">".$value."</option>\n";
	}
	echo "</select>\n";
}

/*
function Crea_Menu($liv=-1)
// Funzione che crea la struttura dei menu a tendina (Menu sezione a) come ul li a nidificati
{
	if ($liv == -1)
  	{
  		$menu .="<ul>\n".Crea_Menu(0)."</ul>";			
  	}
	$stringa="SELECT ID,sez,voce,liv FROM menu where sez='a' and liv = '$liv' order by id";
	$risulta=mysql_query($stringa);
	if (mysql_num_rows($risulta)>0)
  	{
  		while ($control=mysql_fetch_row($risulta))
  		{
  			$voci = "";
  			$str1="SELECT voce,link,stat FROM menuvoci where IDmenu='$control[0]' order by ordine";
 			$risultato1=mysql_query($str1);
 			if (mysql_num_rows($risultato1)>0)
  			{
  				while ($control1 = mysql_fetch_row($risultato1))
  				{
  					if ($control1[2]=='si')
  						$link= "index.php?pag=static.php&amp;stat=".$control1[1]  ;						
  					else
  						$link= $control1[1];
  						
  					$voci .= "\t<li><a href=\"".$link."\">".$control1[0]."</a></li>\n";
  					$link = "";  						  						 						
  				}
  			}
  			if ($liv == 0)
  			{
  				if ($voci<>"")
  					$menu .=$voci.Crea_Menu($control[0]);
  				else
  					$menu .=Crea_Menu($control[0]);
  			}	
  			else
  			{
  				if ($voci<>"")
  					$menu .= "<li><a href=\"#\">$control[2]</a>\n<ul>\n".$voci."\n".Crea_Menu($control[0])."</ul></li>\n";
  				else
  					$menu .= "<li><a href=\"#\">$control[2]</a>\n<ul>\n".Crea_Menu($control[0])."</ul></li>\n";
  			}
  		}
  	}  		
  	$menu = str_replace("<ul>\n</ul>","",$menu);
  	return $menu; 
}
******************************/



// Funzione ricorsiva per i menù laterali according
function according( $id, $parametro )
{	
	//query dove estraggo le voci del sottomenu 
	$query = "SELECT id, titolo, link, tipolink, descrizione FROM menutipo WHERE tipo='$parametro' and idpadre=$id ORDER BY posizione";
	$risultato = mysql_query($query);
	$row = mysql_num_rows($risultato);
	
	if ( $row > 0 ) {
		echo "<ul>";
		while( $voci = mysql_fetch_row( $risultato ) ) {
			$title = ( $voci[4] != '' ) ? "title=\"$voci[4]\"" : "";			
			echo "<li><a $title href=\"$voci[2]\">$voci[1]</a>";
				according( $voci[0], $parametro );
			echo "</li>";
		}
		echo"</ul>";
	}
}




function Render_Video($width,$height,$codefilm,$rel,$bordi,$sitivideo)
{
	$color1=_COLOR1;
	$color2=_COLOR2;
	$value = $sitivideo;
	$value .= "$codefilm&hl=it&fs=1&rel=$rel&color1=$color1&color2=$color2&border=$bordi";
	echo "<div align=\"center\"><object width=\"$width\" height=\"$height\">";
	echo "<param name=\"movie\" value=\"$value\"></param>";
	echo "<param name=\"allowFullScreen\" value=\"true\"></param>";
	echo "<param name=\"allowscriptaccess\" value=\"always\"></param>";
	echo "<embed src=\"$value\" type=\"application/x-shockwave-flash\" allowscriptaccess=\"always\" wmode=\"transparent\" allowfullscreen=\"true\" width=\"$width\" height=\"$height\"></embed>";
	echo"</object></div>";
}





// Funzione ricorsiva per recuperare il contenuto completo di una cartella per le immagini
function recupera_dir_img( $dir, &$vet ) {
	$ext_img = Array( 'jpg', 'jpeg', 'png', 'gif' );
	
	if ( $dh = opendir( $dir ) ) {	
		while ( ( $file = readdir( $dh ) ) !== false ) {
			if( filetype( $dir . $file ) == "dir" ) {
				if ( $file != '.' AND $file != '..' )
					recupera_dir_img( $dir . $file . "/", $vet );
			}
			else {
				$info_file = pathinfo( $dir.$file );
				$ext_file =  strtolower( $info_file['extension'] );
				$ext = array_search( $ext_file, $ext_img );

				if ( is_numeric( $ext ) ) {
					array_push( $vet, $dir );
					break;
				}
			}
		}
				
		closedir( $dh );
	}

	return $vet;
}

// rewriting url
function rurl( $id, $tab ) {
	switch( $tab ){
		case 'static':
			$sql = "SELECT titolo FROM statiche WHERE ID = $id LIMIT 1";
			$rssql = mysql_query( $sql );
			$key = _URLSITO."/static/";
			if ( mysql_num_rows($rssql) > 0 ) {
				$r = mysql_fetch_row( $rssql );
				$titolo = rurl_rewrite( $r[0] ).'-';
				$link = $key.$titolo.$id.'/';
			}
			else {
				$link = $key;
			}
		break;	

		case 'argo':
			$sql = "SELECT argomenti FROM argomenti WHERE ID = $id LIMIT 1";
			$rssql = mysql_query( $sql );
			
			$key = _URLSITO."/argo/";
			
			if ( mysql_num_rows($rssql) > 0 ) {
				$r = mysql_fetch_row( $rssql );
				$titolo = rurl_rewrite( $r[0] ).'-';
				$link = $key.$titolo.$id.'/';
			}
			else {
				$link = $key;
			}
		break;	
				
		case 'news':
			$sql = "
				SELECT n.titolo, a.argomenti, a.id 
				FROM notizie AS n 
				INNER JOIN argomenti AS a ON a.ID = n.argomento  
				WHERE n.ID = $id  
				LIMIT 1
			";
			$rssql = mysql_query( $sql );
         
			$key = _URLSITO."/argo/";
         
			if ( mysql_num_rows($rssql) > 0 ) {
				$r = mysql_fetch_row( $rssql );
				$key = rurl($r[2], 'argo').'news/';
				$titolo = rurl_rewrite( $r[0] ).'-';
				$link = $key.$titolo.$id.'/';
			}
			else {
				$link = $key;
			}			
		break;
		
		case 'eventi-appupntamenti':
			$sql = "
				SELECT titolo, tipo 
				FROM eventi
				WHERE id = $id 
			";
			$rssql = mysql_query( $sql );
			$r = mysql_fetch_row( $rssql );
			
			$tipo = ($r[1]=='E') ? 'evento' : 'appuntamento';
			
			$key = _URLSITO."/$tipo/".rurl_rewrite( $r[0] );
			$link = $key.'-'.$id.'/';
		break;		
		
		case 'tag':
			$sql = "
				SELECT t.link_tag
				FROM tag t 
				INNER JOIN collegamento_tag ct ON ct.id_tag = t.id 
				WHERE t.id = $id 
				GROUP BY t.id 
				LIMIT 1
			";
			$rssql = mysql_query( $sql );
			$link_tag = mysql_result( $rssql, 0, 0 );
			$key = rurl_rewrite( $link_tag ) . '-' . $id;
			$link = _URLSITO."/tag/$key/";
			
		break;
		
		case 'gals':
			$sql = "SELECT cartella, id FROM galleria WHERE id = $id LIMIT 1";
			$rssql = mysql_query( $sql );
			$cartella = mysql_result( $rssql, 0, 0 );
			$id = mysql_result( $rssql, 0, 1 );
			$key = rurl_rewrite( $cartella ) . '-' . $id;
			$link = _URLSITO."/gallery/$key/";
		break;
		
		case 'gals-sub':
			$sql = "SELECT cartella, id, id_padre FROM galleria WHERE id = $id LIMIT 1";
			$rssql = mysql_query( $sql );
			$cartella = mysql_result( $rssql, 0, 0 );
			$id = mysql_result( $rssql, 0, 1 );
			$id_padre = mysql_result( $rssql, 0, 2 );
			$key = rurl_rewrite( $cartella ) . '-' . $id;

			$sql = "SELECT cartella, id FROM galleria WHERE id = $id_padre LIMIT 1";
			$rssql = mysql_query( $sql );
			$cartella = mysql_result( $rssql, 0, 0 );
			$id = mysql_result( $rssql, 0, 1 );
			$key2 = rurl_rewrite( $cartella ) . '-' . $id;
	
			$link = _URLSITO."/gallery/$key2/$key/";
		break;
		
		case 'cerca': $link = _URLSITO."/search/"; break;	
		case 'contatti': $link = _URLSITO."/contatti/"; break;	
		case 'paypal': $link = _URLSITO."/paypal/"; break;	
		
		case 'sondaggio-vota': $link = _URLSITO."/sondaggio/vota/"; break;
		case 'sondaggio-vedi-voti': $link = _URLSITO."/sondaggio/vedi-voti/$id/"; break;
		
		case 'newsletter': $link = _URLSITO."/"; break;
		case 'newsletter-cancellazione': $link = _URLSITO."/cancellazione-newsletter/"; break;
		
		case 'ecommerce': $link = _URLSITO."/ecommerce/"; break;		
		case 'ecommerce-dettaglio-carrello': $link = _URLSITO."/ecommerce/dettaglio-carrello/"; break;		
		case 'ecommerce-compilazione-form': $link = _URLSITO."/ecommerce/compilazione-form/"; break;		
		case 'ecommerce-aggiungi-carrello': $link = _URLSITO."/ecommerce/aggiungi-carrello/"; break;	
		case 'ecommerce-cancella-carrello': $link = _URLSITO."/ecommerce/cancella-carrello/"; break;		
		case 'ecommerce-reso': $link = _URLSITO."/ecommerce/reso/"; break;		
		
		case 'ecommerce-categorie':
			$key = _URLSITO."/ecommerce/";

			$sql = "SELECT categoria, id_padre, id FROM ecommercecategoria WHERE id = $id LIMIT 1";
			$rssql = mysql_query( $sql );
			if ( mysql_num_rows( $rssql ) > 0 ) {
				$r = mysql_fetch_row( $rssql );
				$cat = rurl_rewrite( $r[0] );
				$link_cat = $cat . '/';				
				while ( $r[1] > 0 ) {
					$sql = "SELECT categoria, id_padre, id FROM ecommercecategoria WHERE id = $r[1] LIMIT 1";
					$rssql = mysql_query( $sql );
					$r = mysql_fetch_row( $rssql );
					$cat = rurl_rewrite( $r[0] );
					$link_cat = $cat . '/' . $link_cat;
				}
				
				$link_cat .= $id . "/";
			}
			
			$link = $key.$link_cat;
		break;	
		
		case 'ecommerce-dettaglio':
			$key = _URLSITO."/ecommerce/";
			
			$sql = "SELECT titolo, categoria FROM ecommerce WHERE id = $id LIMIT 1";
			$rssql = mysql_query( $sql );
			$titolo = rurl_rewrite( mysql_result( $rssql, 0, 0 ) );
			$categoria = mysql_result( $rssql, 0, 1 );
			
			$sql = "SELECT categoria, id_padre, id FROM ecommercecategoria WHERE id = $categoria LIMIT 1";
			$rssql = mysql_query( $sql );
			if ( mysql_num_rows( $rssql ) > 0 ) {
				$r = mysql_fetch_row( $rssql );
				$cat = rurl_rewrite( $r[0] );
				$link_cat = $cat . '/';
				while ( $r[1] > 0 ) {
					$sql = "SELECT categoria, id_padre, id FROM ecommercecategoria WHERE id = $r[1] LIMIT 1";
					$rssql = mysql_query( $sql );
					$r = mysql_fetch_row( $rssql );
					$cat = rurl_rewrite( $r[0] );
					$link_cat = $cat . '/' . $link_cat;
				}
				
				$link_cat .= $categoria . "/";
			}
			
			$link = $key.$link_cat."dettaglio/".$titolo."-$id/";
		break;
	}
	
	return strtolower( $link );
}


// formattazione stringhe per Rewriting URL
function rurl_rewrite( $text ){
	global $parole_inutili;
	global $caratteri_inutili;
	global $caratteri_speciali;
	
	$text = trim( $text );
	$text = strtolower( $text ); 
	
	$text = str_replace( '&agrave;', 'a', $text );
	$text = str_replace( '&aacute;', 'a', $text );
	$text = str_replace( '&atilde;', 'a', $text );
	$text = str_replace( '&egrave;', 'e', $text );
	$text = str_replace( '&eacute;', 'e', $text );
	$text = str_replace( '&igrave;', 'i', $text );
	$text = str_replace( '&iacute;', 'i', $text );
	$text = str_replace( '&ograve;', 'o', $text );
	$text = str_replace( '&oacute;', 'o', $text );
	$text = str_replace( '&ugrave;', 'u', $text );
	$text = str_replace( '&uacute;', 'u', $text );
	$text = str_replace( '&ccedil;', 'c', $text );
	$text = str_replace( '&ccedil;', 'c', $text );
	
	if ( strlen( $text ) > 2 ) {
		$text = explode( ' ', $text );
		foreach( $text as $key => $value ) {
			$value = trim( $value );
			if ( strlen( $value ) <= 2 OR in_array( $value, $parole_inutili ) )
				unset( $text[$key] );
		}
		$text = implode( '-', $text );
	
		$text = str_replace( $caratteri_speciali, '-', $text );
		$text = str_replace( $caratteri_inutili, '-', $text );	

		$text = explode( '-', $text );
		foreach( $text as $key => $value ) {
			$value = trim( $value );
			if ( strlen( $value ) <= 2 OR in_array( $value, $parole_inutili ) )
				unset( $text[$key] );
		}
		$text = implode( '-', $text );
	}
	
	$text = preg_replace( '/\%/',' percentage ', $text );
	$text = preg_replace( '/\@/', ' at ', $text );
	$text = preg_replace( '/\&/', ' and ', $text );
	$text = preg_replace( '/\s[\s]+/', '-', $text );    // Strip off multiple spaces
	$text = preg_replace( '/[\s\W]+/', '-', $text );    // Strip off spaces and non-alpha-numeric
	$text = preg_replace( '/^[\-]+/', '', $text ); // Strip off the starting hyphens
	$text = preg_replace( '/[\-]+$/', '', $text ); // // Strip off the ending hyphens 
	$text = preg_replace( '/^_|_$/', '', $text ); // // Strip off the starting and ending underscore 
			
	return $text;
}


// formattazione stringhe per Rewriting URL con meno condizioni
function rurl_rewrite2( $text ){
	global $parole_inutili;
	global $caratteri_inutili;
	global $caratteri_speciali;
	
	$text = trim( $text );
	$text = strtolower( $text ); 
	
	$text = str_replace( '&agrave;', 'a', $text );
	$text = str_replace( '&aacute;', 'a', $text );
	$text = str_replace( '&atilde;', 'a', $text );
	$text = str_replace( '&egrave;', 'e', $text );
	$text = str_replace( '&eacute;', 'e', $text );
	$text = str_replace( '&igrave;', 'i', $text );
	$text = str_replace( '&iacute;', 'i', $text );
	$text = str_replace( '&ograve;', 'o', $text );
	$text = str_replace( '&oacute;', 'o', $text );
	$text = str_replace( '&ugrave;', 'u', $text );
	$text = str_replace( '&uacute;', 'u', $text );
	$text = str_replace( '&ccedil;', 'c', $text );
	$text = str_replace( '&ccedil;', 'c', $text );

	$text = str_replace( $caratteri_speciali, '-', $text );
	$text = str_replace( $caratteri_inutili, '-', $text );	
	
	$text = preg_replace( '/\%/',' percentage ', $text );
	$text = preg_replace( '/\@/', ' at ', $text );
	$text = preg_replace( '/\&/', ' and ', $text );
	$text = preg_replace( '/\s[\s]+/', '-', $text );    // Strip off multiple spaces
	$text = preg_replace( '/[\s\W]+/', '-', $text );    // Strip off spaces and non-alpha-numeric
	$text = preg_replace( '/^[\-]+/', '', $text ); // Strip off the starting hyphens
	$text = preg_replace( '/[\-]+$/', '', $text ); // // Strip off the ending hyphens 
	$text = preg_replace( '/^_|_$/', '', $text ); // // Strip off the starting and ending underscore 
			
	return $text;
}


// formatta scritta per XML
function formatta_xml( $text ) {
	$text = trim( $text );

	$text = str_replace( '&agrave;', '&#224;', $text );
	$text = str_replace( '&aacute;', '&#225;', $text );
	$text = str_replace( '&egrave;', '&#232;', $text );
	$text = str_replace( '&eacute;', '&#233;', $text );
	$text = str_replace( '&igrave;', '&#236;', $text );
	$text = str_replace( '&iacute;', '&#237;', $text );
	$text = str_replace( '&ograve;', '&#242;', $text );
	$text = str_replace( '&oacute;', '&#243;', $text );
	$text = str_replace( '&ugrave;', '&#249;', $text );
	$text = str_replace( '&uacute;', '&#250;', $text );
	$text = str_replace( '&ccedil;', '&#231;', $text );
		
	return $text;
}


// link per area amministrativa
function adm_link( $tipo, $id = 0 ){
	$span = "";
	
	if ( isset( $_SESSION["tux"] ) ) {
		switch($tipo){
			case 'statica': $link = _URLSITO."/areariservata/area.php?pag=insert_statiche.php&id=$id"; break;
			case 'news': $link = _URLSITO."/areariservata/area.php?pag=insert_notizie.php&id=$id"; break;
			case 'ecommerce': $link = _URLSITO."/areariservata/area.php?pag=insert_ecommerce.php&id=$id"; break;
			case 'contatti': $link = _URLSITO."/areariservata/area.php?pag=personalizza_form.php"; break;
			case 'modulo': $link = _URLSITO."/areariservata/area.php?pag=insert_moduli.php&id=$id"; break;
		}
		
		$span = "<span class=\"adm-modifica\">
			<a target=\"_blank\" href=\"$link\">
				<img src=\""._URLSITO."/img/mod.png\" alt=\"Modifica\">
			</a>
		</span>";
	}
	
	return $span;
}



// Evita la chiusura immediata della pagina se ci sono state modifiche al testo del ckeditor
function onbeforeunload( $id = 'corpo_ck' ) {
	return "<script>
		$(document).ready(function(){
			a = window.onbeforeunload = function(){ 
				if (typeof(CKEDITOR)!='undefined') {
					var oEditor = CKEDITOR.instances.$id;
					if (oEditor.checkDirty())
						return 'Hai fatto delle modifiche alla pagina.';
				}
				return undefined;
			}
		});
	</script>";
}


// Estraggo la prima immagine da un testo
function estrai_immagine_principale( $testo ) {
	//verifico tramite l'espressioni regolari tutte le stringhe immagini
	//che inserirò nell'array corrispondenze da cui estraggo la prima immagine
	preg_match_all('/<img[^>]+>/i', $testo, $corrispondenze);

	//Prendo il primo valore dell'array (matrice) corrispondenze
	$immagine = (isset($corrispondenze[0][0])) ? $corrispondenze[0][0] : NULL;
	
	//Se l'immagine è vuota richiamo un immagine di default
	if( empty( $immagine ) )
		$url_img = _URLSITO . "/templates/"._TEMPLATE."/img/logo.png";
	else {
		preg_match_all('/src="[^"]+"/i', $immagine, $attributi);
		$url_img = $attributi[0][0];
		$url_img = str_replace( array( 'src="', '"' ), '', $url_img );
		
		if ( strpos( $url_img, 'http://' ) === false AND strpos( $url_img, 'https://' ) === false )
			$url_img = _URLSITO . $url_img;
	}	
	
	return $url_img;	
}


// Funzione per visualizzare la select delle categorie
function select_categorie_ecommerce( $id_categoria, $livello, $riferimento_cat ) {
	$query = "
		SELECT e.id, e.categoria, l.lingua 
		FROM ecommercecategoria AS e 
		INNER JOIN lingue AS l ON l.id = e.id_lingua 
		WHERE e.id_padre = $id_categoria
	";	
	
	$rssql = mysql_query( $query );
	if ( mysql_num_rows( $rssql ) > 0 ) {
		$spazi = '';
		for( $i=0; $i<=$livello*3; $i++ )
			$spazi .= '&nbsp;';
			
		while( $r = mysql_fetch_row( $rssql ) ){
			$sel = ( $r[0] == $riferimento_cat ) ? "selected='selected'" : "";
			$value = $spazi.$r[1];
			echo "<option value=\"$r[0]\" $sel>$value</option>";
			$livello++;
			select_categorie_ecommerce( $r[0], $livello, $riferimento_cat );
		}
	}	
}


// Funzione per visualizzare la lista delle categorie
function li_categorie_ecommerce( $id_categoria ) {
	global $lingua_query;
	
	$query = "
		SELECT e.id, e.categoria 
		FROM ecommercecategoria AS e 
		INNER JOIN lingue AS l ON l.id = e.id_lingua 
		WHERE l.sigla = '$lingua_query' AND e.id_padre = $id_categoria 
		ORDER BY e.categoria
	";	
	
	$rssql = mysql_query( $query );
	if ( mysql_num_rows( $rssql ) > 0 ) {
		global $v_id_cat;
		echo "<ul>";
		while( $r = mysql_fetch_row( $rssql ) ){
			echo "<li>";
				$link = rurl( $r[0], 'ecommerce-categorie' );
				echo "<a href=\"$link\">$r[1]</a>";
				if ( in_array( $r[0], $v_id_cat ) ) li_categorie_ecommerce( $r[0] );
			echo "</li>";
		}
		echo "</ul>";
	}	
}


// Recupero tutti le sottocategorie collegate ad una categoria
function id_categorie_ecommerce( $id_categoria, &$v_id_cat ){
	$sql = "SELECT id FROM ecommercecategoria WHERE id_padre = $id_categoria";
	$rssql = mysql_query( $sql );
	if ( mysql_num_rows( $rssql ) > 0 ) {
		while( $r = mysql_fetch_row( $rssql ) ){
			$v_id_cat .= ",$r[0]";
			id_categorie_ecommerce( $r[0], $v_id_cat );
		}
	}
}


// Recupero tutti le categorie collegate ad una categoria
function id_categorie_ecommerce_tutte( $id_categoria, &$v_id_cat ){
	$sql = "SELECT id_padre FROM ecommercecategoria WHERE id = $id_categoria";
	$rssql = mysql_query( $sql );
	if ( mysql_num_rows( $rssql ) > 0 ) {
		while( $r = mysql_fetch_row( $rssql ) ){
			if ( $r[0] == 0 ) continue;
			
			$v_id_cat .= ",$r[0]";
			id_categorie_ecommerce_tutte( $r[0], $v_id_cat );
		}
	}
}



/*

// funzioni per recupero API di bitly (https://bitly.com), per gli shorten URL 

// returns the shortened url 
function get_bitly_short_url($url,$login=_BITLY_LOGIN,$appkey=_BITLY_KEY,$format='txt') {
	$connectURL = 'http://api.bit.ly/v3/shorten?login='.$login.'&apiKey='.$appkey.'&uri='.urlencode($url).'&format='.$format;
	return curl_get_result($connectURL);
}

// returns expanded url 
function get_bitly_long_url($url,$login=_BITLY_LOGIN,$appkey=_BITLY_KEY,$format='txt') {
	$connectURL = 'http://api.bit.ly/v3/expand?login='.$login.'&apiKey='.$appkey.'&shortUrl='.urlencode($url).'&format='.$format;
	return curl_get_result($connectURL);
}

// returns a result form url 
function curl_get_result($url) {
	$ch = curl_init();
	$timeout = 5;
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
	$data = curl_exec($ch);
	curl_close($ch);
	return $data;
}
*/

?>
