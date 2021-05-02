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
require_once("auth.php");

$id = $_POST['id']; 
$arg = $_POST['categoria'];
$sotto_arg = pulisci_stringa(apici($_POST['sotto_cat']));


if ($sotto_arg=="")
{
$tipoerr="ERRORE: NON HAI INSERITO IL SOTTO-ARGOMENTO";
	//echo "ERRORE: NON HAI INSERITO L'ARGOMENTO";
	//echo "<BR><a href=\"area.php?pag=insert_arg.php\">Riprova</a>";
	 echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_ecommerce_categorie.php&errore=si&tipoerr=$tipoerr&arg=$arg&sotto_arg=$sotto_arg\" />";
}


if (!$id)
// se l'id non ha un valore, allora siamo in fase di inserimento
{
    	$str2=" SELECT id, categoria FROM ecommercecategoria WHERE ID = $arg LIMIT 1";
    	// facciamo una query per verificare se esiste nel DB un argomento uguale a quello che si sta inserendo
    	$risultato2=mysql_query($str2);
    	
      $tipoerr = '';
      
      $r = mysql_fetch_array( $risultato2 );
      $v1 = explode( '||', $r[1] );
      if ( isset($v1[1]) ) {
          $v2 = explode( '--', $v1[1] );
          if ( in_array( $sotto_arg, $v2 ) )
             $tipoerr="SOTTO-ARGOMENTO GIA' INSERITO"; 
      }
      
      if ( $tipoerr != '' )
      	echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_ecommerce_sottocategorie.php&errore=si&tipoerr=$tipoerr&arg=$arg&sotto_arg=$sotto_arg\" />";
    	else {
    	// se la nostra query di controllo non genera alcun risultato, procediamo con l'inserimento
      	$str="UPDATE ecommercecategoria SET categoria = '" . $r[1] . $sotto_arg . "--' WHERE id = $arg";  
                
         // query di inserimento
         $risultato=mysql_query($str);
         if (!$risultato)
         // controllo se la query di inserimento è andata a buon fine
         {
         	$tipoerr="ERRORE: SOTTO-ARGOMENTO NON INSERITO";
         	
                    
           echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_ecommerce_sottocategorie.php&errore=si&tipoerr=$tipoerr&arg=$arg&sotto_arg=$sotto_arg\" />";
           
         }
         else
              	//Header("Location: ");
			echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=conferma.php&from=elenco_ecommerce_categorie.php\" />";
            
         exit;
    	}
}
else
// se l'id ha un valore, allora siamo in fase di modifica
{
  $id_sc = $_POST['id_sc'];

  $str2=" SELECT id, categoria FROM ecommercecategoria WHERE id = $id LIMIT 1";
	// facciamo una query per verificare se esiste nel DB un argomento uguale a quello che si sta inserendo
	$risultato2=mysql_query($str2);
	
  $tipoerr = '';
  
  $r = mysql_fetch_array( $risultato2 );
  $r[1] = substr(  $r[1], 0, ( strlen(  $r[1] ) - 2 ) );
  $v1 = explode( '||', $r[1] );
  $v2 = explode( '--', $v1[1] );
  
  if ( in_array( $sotto_arg, $v2 ) )
     $tipoerr="SOTTO-ARGOMENTO GIA' INSERITO"; 
  
  if ( $tipoerr != '' )
  	echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_ecommerce_sottocategorie.php&errore=si&tipoerr=$tipoerr&id=$arg&sotto_arg=$id_sc\" />";
  else {
       $v2[$id_sc] = $sotto_arg;
       $ins = "$v1[0]||";
       foreach( $v2 as $value )
          $ins .= "$value--";
          
      $str=" UPDATE ecommercecategoria SET categoria = '$ins' WHERE id = '$id'";
     $risultato=mysql_query($str);
     if (!$risultato)
     // controllo se la query di modifica è andata a buon fine
     {
         	$tipoerr="ERRORE: SOTTO-ARGOMENTO NON MODIFICATO";
         	//echo "ERRORE: ARGOMENTO NON MODIFICATO";
            //echo "<br/><a href=\"area.php?pag=elenco_arg.php\">Riprova</ainsert_ecommerce_sottocategorie
           echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=insert_ecommerce_sottocategorie.php&errore=si&tipoerr=$tipoerr&id=$arg&sotto_arg=$id_sc\" />";
      }
      else {
       	//Header("Location: ");
    	   echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=conferma.php&from=elenco_ecommerce_categorie.php\" />";
      }
  }
}



?>
