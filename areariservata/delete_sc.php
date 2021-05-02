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


if( !isset( $_POST["delete"] ) ) {
      $id = $_GET['id'];
      $sotto_arg = $_GET['sotto_arg'];
      $from = $_GET['from'];
      
      //echo "$from  e  $id";
       echo "<div class=\"contenitore\">
      <form name=\"conferma\" method=\"post\" action=\"delete_sc.php\">
      
      <input type=\"hidden\" name=\"id\" value=\"$id\"/>
      <input type=\"hidden\" name=\"from\" value=\"$from\"/>
      <input type=\"hidden\" name=\"sotto_arg\" value=\"$sotto_arg\"/>
      
      <h1>Sicuro di voler eliminare l'elemento?</h1>
      <input type=\"submit\" name=\"delete\" value=\"SI\">";
      
      	echo"
      <input type=\"button\" class=\"medio\" name=\"Annulla\" value=\"NO\" onclick=\"javascript:window.location='area.php?pag=$from'\" />
      
      </form>
      </div>";	
}
else
{
	
	require_once("auth.php");

	$id = $_POST['id'];

	$from = $_POST["from"];
	$sotto_arg = $_POST['sotto_arg'];

  $sql = "SELECT categoria FROM ecommercecategoria WHERE id = $id LIMIT 1";
  $rssql = mysql_query( $sql );
  $cat = mysql_result( $rssql, 0, 0 );
  $cat = substr( $cat, 0, ( strlen( $cat ) - 2 ) );
  $cat = explode( '||', $cat );
  $sc = explode( '--', $cat[1] ); 
	unset( $sc[$sotto_arg] );
  $sc = implode( '--', $sc );
  $cat = "$cat[0]||$sc";

  $sql = "UPDATE ecommercecategoria SET categoria = '$cat' WHERE id = $id LIMIT 1";

	$risultato=mysql_query($sql);
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

