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

if (!$id)
// se l'id non ha un valore, allora siamo in fase di inserimento
{

    if (($domanda=="") OR ($nick==""))
    {
    echo "ERRORE: NON HAI INSERITO UN CAMPO OBBLIGATORIO";
    echo "<br/><a href=\"area.php?pag=insert_domanda.php\">Riprova</a>";
    }
    else
    {
    $str2="SELECT ID FROM esperto where domanda='$domanda'";
    // facciamo una query per verificare se esiste nel DB una domanda già inserita
    $risultato2=mysql_query($str2);
    if (mysql_num_rows($risultato2)>0)
    {
        // se la nostra query di controllo genera un risultato, generiamo un errore
        echo "DOMANDA GIA' PRESENTE";
        echo "<br/><a href=\"area.php?pag=insert_domanda.php\">Riprova</a>";
    }
    else
    // se la nostra query di controllo non genera alcun risultato, procediamo con l'inserimento
    {
            $oggi=date("Y-m-d");
            $str="INSERT INTO esperto (domanda, nick, pubblicare, data) VALUES ('$domanda', '$nick', '$pubblicare', '$oggi')";
            // query di inserimento
            $risultato=mysql_query($str);
            if (!$risultato)
            // controllo se la query di inserimento è andata a buon fine
                {
                echo "ERRORE: DOMANDA NON INSERITA";
                echo "<br/><a href=\"area.php?pag=insert_domanda.php\">Riprova</a>";
                }
            else
            //Header("Location: ");
			echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=conferma.php\" />";
            exit;
    }
    }
}

else
// se l'id ha un valore, allora siamo in fase di modifica
{

    $str="UPDATE esperto SET domanda = '$domanda', nick = '$nick', risposta = '$risposta', pubblicare = '$pubblicare' WHERE ID = '$id'";
    // query di modifica
    $risultato=mysql_query($str);
    if (!$risultato)
    // controllo se la query di modifica è andata a buon fine
        {
        echo "ERRORE: MODIFICATA NON RIUSCITA";
        echo "<br/><a href=\"area.php?pag=elenco_domande.php\">Riprova</a>";
        }
    else
    //Header("Location: ");
	echo "<meta http-equiv=\"refresh\" content=\"0;url=area.php?pag=confermam.php\" />";
    exit;
}
?>