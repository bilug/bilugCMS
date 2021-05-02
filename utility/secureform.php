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
    /*
    *                             SECURE FORM v 1.0
    *              a security tool to check your variables
    *
    *     by REMOTES - BiLUG (Biella Linux User Group) - ITALY
    *
    *            www.bilug.it                     www.remotes.it
    *
    */


    // let's start!
function secure_form($content,$options,$maxlength) {
    // if $maxlength wasn't specified set it automatically (default value: 256)
    if (!$maxlength) $maxlength = "256";
    // some little function to get ready the content of $option and $content
    $options = strtolower($options);
    $content = strtolower($content);
    $content = html_entity_decode($content);
    $option = explode(",",$options);
    // first check: variable length
    if (strlen($content) > $maxlength) return "toolong";
    // html not allowed here ;)
    elseif ((in_array("nohtml",$option)) && (strip_tags($content) != $content))  return "html";
    // spaces! you cannot pass here!!!
    elseif ((in_array("nospace",$option)) && (str_replace(" ","",$content) != $content)) return "spaces";
    // strings cannot contain more than a line
    elseif ((in_array("oneline",$option)) && ((strstr(nl2br($content),"<br>")) || (strstr(nl2br($content),"<br />")))) return "toolines";
    // no empty content
    elseif ((in_array("noempty",$option)) && (($content = "") || (trim($content) == ""))) return "empty";
    // the string may be only a number...
    elseif ((in_array("numeric",$option)) && (!is_numeric($content))) return "notonlynumbers";
    // ...and an integer number
    elseif ((in_array("integer",$option)) && ((!is_numeric($content)) || (intval($content) != $content))) return "notinteger";
    // the string cannot contain two or more ? together
    elseif (strstr($content,"??")) return "tooasks";
    // to avoid some injection, strings cannot contain $
    elseif (strstr($content,"$")) return "dollar";
    // only these html tags are allowed
    elseif (strip_tags($content,"<a> <b> <i> <br> <center> <img>") != $content) return "htmltagsnotallowed";
    // it it's all ok it returns... OK!!!
    else return 'OK';
}



function form_sicuro($contenutovariabile,$opzionicontrollo,$lunghezzamassima) {
  $risultatosecureform = secure_form($contenutovariabile,$opzionicontrollo,$lunghezzamassima);
  if ($risultatosecureform == "OK") return $contenutovariabile;
  else return NULL;
 }

?>
