<?php
require_once("../areariservata/auth.php");
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
 *     1.4.1      Jan 2008 - table_select check moved up  *
 **********************************************************/
$phpMySQLAutoBackup_version="1.4.1";
// ---------------------------------------------------------
// For support and help please try the forum at: http://www.dwalker.co.uk/forum/

if(($db=="")OR($mysql_username=="")OR($mysql_password==" "))
{
 echo "Configure your installation BEFORE running, add your details to the file /phpmysqlautobackup/run.php";
 exit;
}
if (isset($table_select))
{
 $backup_type="\nBACKUP Type: partial, includes tables:\n";
 foreach ($table_select as $key => $value) $backup_type.= "$value;\n";
}
else $backup_type="\nBACKUP Type: Full database backup (all tables included)\n\n";


include(LOCATION."phpmysqlautobackup_extras.php");
include(LOCATION."schema_for_export.php");


// zip the backup and email it
$backup_file_name = 'mysql_'.$db.strftime("_%d_%b_%Y_time_%H_%M_%S_",time()).rand().'.sql.gz';
$dump_buffer = gzencode($buffer);
if ($from_emailaddress>"") 
{
	xmail($to_emailaddress,$from_emailaddress, "phpMySQLAutoBackup: $backup_file_name", $dump_buffer, $backup_file_name, $backup_type);
	echo "<h3>Backup eseguito</h3>";
}
if ($save_backup_zip_file_to_server) 
{
	write_backup($dump_buffer, $backup_file_name);
	echo "<h3>Backup eseguito</h3>";
	echo "<a href=\"../phpmysqlautobackup/backups/$backup_file_name\">$backup_file_name</a>"; 
}

?>
