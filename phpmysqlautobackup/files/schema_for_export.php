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

$link = mysql_connect($db_server,$mysql_username,$mysql_password);
if ($link) mysql_select_db($db);
if (mysql_error()) {
	echo "<h3>Errore DB:</h3>";
	exit(mysql_error($link));
}
//add new phpmysqlautobackup table if not there...

if(mysql_num_rows(mysql_query("SHOW TABLES LIKE 'phpmysqlautobackup' "))==0)
{
   $query = "
    CREATE TABLE phpmysqlautobackup (
    id int(11) NOT NULL,
    version varchar(6) default NULL,
    time_last_run int(11) NOT NULL,
    PRIMARY KEY (id)
    ) TYPE=MyISAM;";
   $result=mysql_query($query);
   $query="INSERT INTO phpmysqlautobackup (id, version, time_last_run)
             VALUES ('1', '$phpMySQLAutoBackup_version', '0');";
   $result=mysql_query($query);
}

//check time last run - to prevent malicious over-load attempts
$query="SELECT * from phpmysqlautobackup WHERE id=1 LIMIT 1 ;";
$result=mysql_query($query);
$time_last_run=mysql_result($result,0,'time_last_run');
if (time() < ($time_last_run+$time_internal))
{	
	echo "<h3>Backup Eseguito alle ".date("H:m",$time_last_run)." - attendere fino alle ".
	date("H:m",$time_last_run+$time_internal)."</h3>";
	exit();
}// exit if already run within last time_interval
////////////////////////////////////////////////////////////////////////////////////

$query="UPDATE phpmysqlautobackup SET time_last_run = '".time()."' WHERE id=1 LIMIT 1 ;";
$result=mysql_query($query);

if (!isset($table_select))
{
  $t_query = mysql_query('show tables');
  $i=0;
  $table="";
  while ($tables = mysql_fetch_array($t_query, MYSQL_ASSOC) )
        {
         list(,$table) = each($tables);
         $table_select[$i]=$table;
         $i++;
        }
}

$thedomain = $_SERVER['HTTP_HOST'];
if (substr($thedomain,0,4)=="www.") $thedomain=substr($thedomain,4,strlen($thedomain));

$buffer = '# MySQL backup created by phpMySQLAutoBackup' . "\r\n" .
          '#' . "\r\n" .
          '# http://www.dwalker.co.uk/phpmysqlautobackup/' . "\r\n" .
          '#' . "\r\n" .
          '# Database: '. $db . "\r\n" .
          '# Domain name: ' . $thedomain . "\r\n" .
          '# (c)' . date('Y') . ' ' . $thedomain . "\r\n" .
          '#' . "\r\n" .
          '# Backup Date: ' . strftime("%d %b %Y",time()) . "\r\n\r\n";
$i=0;
foreach ($table_select as $table)
        {
          $i++;
          $export = "\r\n" .'drop table if exists ' . $table . ';' . "\r\n\r\n" .
                    'create table ' . $table . ' (' . "\r\n";
          $table_list = array();
          $fields_query = mysql_query("show fields from " . $table);
          while ($fields = mysql_fetch_array($fields_query)) {
            $table_list[] = $fields['Field'];
            $export .= '  ' . $fields['Field'] . ' ' . $fields['Type'];
            if ($fields['Type']!='timestamp')
            	if (strlen($fields['Default']) > 0) $export .= ' default \'' . $fields['Default'] . '\'';
            if ($fields['Null'] != 'YES') $export .= ' not null';
            if (isset($fields['Extra'])) $export .= ' ' . $fields['Extra'];
            $export .= ',' . "\r\n";
          }
          $export = ereg_replace(",\r\n$", '', $export);
          // add the keys
          $index = array();
          $keys_query = mysql_query("show keys from " . $table);
          while ($keys = mysql_fetch_array($keys_query)) {
            $kname = $keys['Key_name'];
            if (!isset($index[$kname])) {
              $index[$kname] = array('unique' => !$keys['Non_unique'],
                                     'columns' => array());
            }
            $index[$kname]['columns'][] = $keys['Column_name'];
          }
          while (list($kname, $info) = each($index)) {
            $export .= ',' . "\r\n";
            $columns = implode($info['columns'], ', ');
            if ($kname == 'PRIMARY') {
              $export .= '  PRIMARY KEY (' . $columns . ')';
            } elseif ($info['unique']) {
              $export .= '  UNIQUE ' . $kname . ' (' . $columns . ')';
            } else {
              $export .= '  KEY ' . $kname . ' (' . $columns . ')';
            }
          }
          $export .= "\r\n" . ');' . "\r\n\r\n";
          $buffer.=$export;
          // dump the data
          $query="select * from " . $table ." LIMIT ". $limit_from .", ". $limit_to." ";
          $rows_query = mysql_query($query);
          while ($rows = mysql_fetch_array($rows_query)) {
            $export = 'insert into ' . $table . ' (' . implode(', ', $table_list) . ') values (';
            reset($table_list);
            while (list(,$i) = each($table_list)) {
              if (!isset($rows[$i])) {
                $export .= 'NULL, ';
              } elseif (has_data($rows[$i])) {
                $row = addslashes($rows[$i]);
                $row = ereg_replace("\r\n#", "\r\n".'\#', $row);

                $export .= '\'' . $row . '\', ';
              } else {
                $export .= '\'\', ';
              }
            }
            $export = ereg_replace(', $', '', $export) . ');' . "\r\n";
            $buffer.= $export;
          }
        }
mysql_close();
?>
