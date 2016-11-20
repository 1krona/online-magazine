<?php

$res = htmlentities(mysql_real_escape_string($_GET['search_value']));

if(isset($_GET['send_search'])){
	 echo 'duktig';
	 
	 header ("Location:search_result.php?res=".$res."");
}

?>