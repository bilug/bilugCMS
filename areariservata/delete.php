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
<?


if( !isset( $_POST["delete"] ) )
{
	
@$id = $_GET['id'];
@$from = $_GET['from'];

//echo "$from  e  $id";
 echo "<div class=\"contenitore\">
<form name=\"conferma\" method=\"post\" action=\"delete.php\">

<input type=\"hidden\" name=\"id\" value=\"$id\"/>
<input type=\"hidden\" name=\"from\" value=\"$from\"/>

<h1>Sicuro di voler eliminare l'elemento?</h1>
<input type=\"submit\" name=\"delete\" value=\"SI\">";
if($from=="reset_elenco_sondaggi.php")
{
	echo"
	<input type=\"button\" class=\"medio\" name=\"Annulla\" value=\"NO\" onclick=\"javascript:window.location='area.php?pag=elenco_sondaggi.php'\" />";
}
else
{
	echo"
<input type=\"button\" class=\"medio\" name=\"Annulla\" value=\"NO\" onclick=\"javascript:window.location='area.php?pag=$from'\" />

</form>
</div>";	
}	
}
else
{
	
	require_once("auth.php");
	$id = $_POST['id'];

	$from = $_POST["from"];
//echo "$from  e  $id";
	switch ($from)
	{
		case "elenco_utenti.php": 	{
						if($_SESSION['typo']== "U")
						{
							echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=elenco_utenti.php\" />";
							$msg = "AZIONE NON CONSENTITA";				  
							confirm($msg);
							exit;
						}
							$table = "anagrafica";
						}
			break;
		case "elenco_arg.php": 	{
						if($_SESSION['typo']== "U")
						{
							echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=elenco_arg.php\" />";
							$msg = "AZIONE NON CONSENTITA";				  
							confirm($msg);
							exit;
						}
							$table = "argomenti";
						}
			break;
		case "elenco_statiche.php": 	{
						if($_SESSION['typo']== "U")
						{
							echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=elenco_statiche.php\" />";
							$msg = "AZIONE NON CONSENTITA";				  
							confirm($msg);
							exit;
						}
							$table = "statiche";
						}
			break;
		case "elenco_ecommerce_categorie.php": 	{
							if($_SESSION['typo']== "U")
							{
								echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=elenco_ecommerce_categorie.php\" />";
								$msg = "AZIONE NON CONSENTITA";				  
								confirm($msg);
								exit;
							}
							
							if ( @$_GET['riferimento'] == 'ecommerce_cerca_articolo.php' )
								$table = "ecommerce";
							else
								$table = "ecommercecategoria";
						}
			break;
		case "elenco_spedizioni.php": 	{
						if($_SESSION['typo']== "U")
						{
							echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=elenco_spedizioni.php\" />";
							$msg = "AZIONE NON CONSENTITA";				  
							confirm($msg);
							exit;
						}
							$table = "spedizione";
						}
			break;
		case "elenco_ecommerce.php": 	{
							if($_SESSION['typo']== "U")
							{
								echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=elenco_ecommerce_categorie.php\" />";
								$msg = "AZIONE NON CONSENTITA";				  
								confirm($msg);
								exit;
							}
							$table = "ecommerce";
							$from = "elenco_ecommerce_categorie.php";
						}
			break;
		case "elenco_email.php": 	{
						if($_SESSION['typo']== "U")
						{
							echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=elenco_email.php\" />";
							$msg = "AZIONE NON CONSENTITA";				  
							confirm($msg);
							exit;
						}
							$table = "email";
						}
			break;
		case "elenco_sondaggi.php": 	{
						if($_SESSION['typo']== "U")
						{
							echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=elenco_sondaggi.php\" />";
							$msg = "AZIONE NON CONSENTITA";				  
							confirm($msg);
							exit;
						}
							$table = "sondaggi";
						}
			break;
		case "reset_elenco_sondaggi.php": 	{
						if($_SESSION['typo']== "U")
						{
							echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=elenco_sondaggi.php\" />";
							$msg = "AZIONE NON CONSENTITA";				  
							confirm($msg);
							exit;
						}
							$str="UPDATE sondaggi SET totali='NULL', maxvoti='0' WHERE id='$id'";
							$risultato=mysql_query($str);
							$table = "voti";
							$from = "elenco_sondaggi.php";
						}
			break;
		case "elenco_eventoapp.php": 	{
						if($_SESSION['typo']== "U")
						{
							echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=elenco_eventoapp.php\" />";
							$msg = "AZIONE NON CONSENTITA";				  
							confirm($msg);
							exit;
						}
							$table = "eventi";
						}
			break;
		case "elenco_rubrica.php": 	{
						if($_SESSION['typo']== "U")
						{
							echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=elenco_rubrica.php\" />";
							$msg = "AZIONE NON CONSENTITA";				  
							confirm($msg);
							exit;
						}
							$table = "rubrica";
						}
			break;
			case "elenco_notizieint.php": 	{
						if($_SESSION['typo']== "U")
						{
							echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=elenco_notizieint.php\" />";
							$msg = "AZIONE NON CONSENTITA";				  
							confirm($msg);
							exit;
						}
							$table = "notizieint";
						}
			break;
			case "elenco_newsletter.php": 	{
						if($_SESSION['typo']== "U")
						{
							echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=elenco_newsletter.php\" />";
							$msg = "AZIONE NON CONSENTITA";				  
							confirm($msg);
							exit;
						}
							$table = "newsletter";
						}
			break;
			case "elenco_menu.php": 	{
						if($_SESSION['typo']== "U")
						{
							echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=elenco_menu.php\" />";
							$msg = "AZIONE NON CONSENTITA";				  
							confirm($msg);
							exit;
						}
							$table = "menu";
						}
			break;
			case "elenco_all_notizie.php": 	{
							if($_SESSION['typo']== "U")
							{
								$aut=$_SESSION['tux'];
								$queryaut="SELECT autore FROM notizie WHERE id='$id' AND autore='$aut'";
								$ris= mysql_query($queryaut);
								$ris = mysql_fetch_array($ris);
								if(!$ris)
								{
										echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=elenco_all_notizie.php\" />";
										$msg = "AZIONE NON CONSENTITA";				  
										confirm($msg);
										exit;
								}
							}
							$table = "notizie";
						}
			break;
			case "elenco_notargaut.php": 	{
							if($_SESSION['typo']== "U")
							{
								$aut=$_SESSION['tux'];
								$queryaut="SELECT autore FROM notizie WHERE id='$id' AND autore='$aut'";
								$ris= mysql_query($queryaut);
								$ris = mysql_fetch_array($ris);
								if(!$ris)
								{
										echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=elenco_all_notizie.php\" />";
										$msg = "AZIONE NON CONSENTITA";				  
										confirm($msg);
										exit;
								}
							}
							$table = "notizie";
						}
			break;			
			case "elenco_arg_notizie.php": 	{
							if($_SESSION['typo']== "U")
							{
								$aut=$_SESSION['tux'];
								$queryaut="SELECT autore FROM notizie WHERE id='$id' AND autore='$aut'";
								$ris= mysql_query($queryaut);
								$ris = mysql_fetch_array($ris);
								if(!$ris)
								{
										echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=elenco_notizie.php\" />";
										$msg = "AZIONE NON CONSENTITA";				  
										confirm($msg);
										exit;
								}
							}
								$table = "notizie";
								$from="elenco_notizie.php";
							
						}
			break;
			case "elenco_aut_notizie.php": 	{
							if($_SESSION['typo']== "U")
							{
								$aut=$_SESSION['tux'];
								$queryaut="SELECT autore FROM notizie WHERE id='$id' AND autore='$aut'";
								$ris= mysql_query($queryaut);
								$ris = mysql_fetch_array($ris);
								if(!$ris)
								{
										echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=elenco_notizieaut.php\" />";
										$msg = "AZIONE NON CONSENTITA";				  
										confirm($msg);
										exit;
								}
							}
							$table = "notizie";
							$from="elenco_notizieaut.php";
						}
			break;
			case "elenco_nonaut_notizie.php": 	{
							if($_SESSION['typo']== "U")
							{
								$aut=$_SESSION['tux'];
								$queryaut="SELECT autore FROM notizie WHERE id='$id' AND autore='$aut'";
								$ris= mysql_query($queryaut);
								$ris = mysql_fetch_array($ris);
								if(!$ris)
								{
										echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=elenco_nonaut_notizie.php\" />";
										$msg = "AZIONE NON CONSENTITA";				  
										confirm($msg);
										exit;
								}
							}
							$table = "notizie";
						}
			break;
			case "elenco_menu_new.php": 	{
							$qcontr = "SELECT titolo FROM menutipo WHERE idpadre='$id'";
							$controllo=mysql_query($qcontr);
							$contr=mysql_fetch_assoc($controllo);
							if($contr)
							{
								//Header("Location: ");
								echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=$from&errore=Cancellare prima il sottomenu\" />";
							}
							else
							$table="menutipo";
						}
			break;
			case "elenco_utenti_ecommerce.php": 	{
						if($_SESSION['typo']== "U")
						{
							echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=elenco_utenti_ecommerce.php\" />";
							$msg = "AZIONE NON CONSENTITA";				  
							confirm($msg);
							exit;
						}
							$table = "ecommerceris";
						}		
			break;						
			case "elenco_partners.php": 	{
						if($_SESSION['typo']== "U")
						{
							echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=elenco_partners.php\" />";
							$msg = "AZIONE NON CONSENTITA";				  
							confirm($msg);
							exit;
						}
							$table = "partners";
						}		
			break;				
			case "gestione_tag.php": 	{
						if($_SESSION['typo']== "U")
						{
							echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=elenco_partners.php\" />";
							$msg = "AZIONE NON CONSENTITA";				  
							confirm($msg);
							exit;
						}
							$del = "DELETE FROM collegamento_tag WHERE id_tag = $id LIMIT 1";
							mysql_query($del);
							$table = "tag";
						}		
			break;				
			case "elenco_social.php": 	{
						if($_SESSION['typo']== "U")
						{
							echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=elenco_social.php\" />";
							$msg = "AZIONE NON CONSENTITA";				  
							confirm($msg);
							exit;
						}

							$table = "social";
						}		
			break;						
	}


	$str="DELETE FROM $table WHERE id=$id";
		
	$risultato=mysql_query($str);
	if (!$risultato)
	{
		echo "ERRORE: DATO NON ELIMINATO";
		echo "<br/><a href=\"area.php?pag=$from\">Riprova</a>";
	}
	else
		//Header("Location: ");
		echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=conferma.php&from=$from\" />";
	exit;
}


?>
