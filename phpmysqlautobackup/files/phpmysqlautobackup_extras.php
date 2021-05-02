<?php
require_once("auth.php");
/**********************************************************
 *               phpMySQLAutoBackup                       *
 *           Author:  http://www.DWalker.co.uk            *
 *            Now released under GPL License              *
 *                                                        *
 **********************************************************
 *     Version    Date              Comment               *
 *     0.2.0      7th July 2005     GPL release           *
 *     0.3.0      19th June 2006  Upgrade                 *
 *           - added ability to backup separate tables    *
 *     0.4.0      Dec 2006   removed bugs/improved code   *
 *     1.4.0      Dec 2007   improved faster version      *
 **********************************************************/
$phpMySQLAutoBackup_version="1.4.0";
// ---------------------------------------------------------
// For support and help please try the forum at: http://www.dwalker.co.uk/forum/

function has_data($value)
{
 if (is_array($value)) return (sizeof($value) > 0)? true : false;
 else return (($value != '') && (strtolower($value) != 'null') && (strlen(trim($value)) > 0)) ? true : false;
}

function xmail ($to_emailaddress,$from_emailaddress, $subject, $content, $file_name, $backup_type)
{

 $mail_attached = "";
 $boundary = "----=_NextPart_000_01FB_010".md5($to_emailaddress);
 $mail_attached.="--".$boundary."\n"
                       ."Content-Type: application/octet-stream;\n name=\"$file_name\"\n"
                       ."Content-Transfer-Encoding: base64\n"
                       ."Content-Disposition: attachment; \n filename=\"$file_name\"\n\n"
                       .chunk_split(base64_encode($content))."\n";
 $mail_attached .= "--".$boundary."--\n";
 $add_header ="MIME-Version: 1.0\nContent-Type: multipart/mixed;\n        boundary=\"$boundary\" \n\n";
 $mail_content="--".$boundary."\n"."Content-Type: text/plain; \n charset=\"iso-8859-1\"\n"."Content-Transfer-Encoding: 7bit\n\nBACKUP ESEGUITO CON SUCCESSO/BACKUP Successful...\n\nApri l'allegato per il file di Backup zippato\n\nPlease see attached for your zipped Backup file; $backup_type \nSe questo e' il primo backup e' consigliato verificare su un server di test che sia generato correttamente\n\nIf this is the first backup then you should test it restores correctly to a test server.\n\n phpMySQLAutoBackup is developed by http://www.dwalker.co.uk/ \n\n Have a good day now you have a backup of your MySQL db  ;-) \n\nPlease consider making a donation at: \n http://www.dwalker.co.uk/make_a_donation.php \n (any amount is gratefully received)\n".$mail_attached;
 return mail($to_emailaddress, $subject, $mail_content, "From: $from_emailaddress\nReply-To:$from_emailaddress\n".$add_header);
}

function write_backup($gzdata, $backup_file_name)
{

 $fp = fopen(LOCATION."../backups/".$backup_file_name, "w");
 fwrite($fp, $gzdata);
 fclose($fp);
 //check folder is protected - stop HTTP access
 /*if (!file_exists(".htaccess"))
 {
  $fp = fopen(LOCATION."../backups/.htaccess", "w");
  //fwrite($fp, "deny from all");
  fwrite($fp, "<Files ~ \"*.*\">");
  fwrite($fp, "Order allow,deny");
  fwrite($fp, "Deny from all");
  fwrite($fp, "Satisfy All");
  fwrite($fp, "</Files>");
  fclose($fp);
 }*/
}
?>
