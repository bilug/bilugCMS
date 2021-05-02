$r= $_SERVER['REQUEST_URI'];
$q= $_SERVER['QUERY_STRING'];
$i= $_SERVER['REMOTE_ADDR'];
$u= $_SERVER['HTTP_USER_AGENT'];
$mess = $r . ' | ' . $q . ' | ' . $i . ' | ' .$u;
mail("villa@mediacreation.it","bad request",$mess,"from:webmaster@vilnet.it");
echo "Hot Damn!";