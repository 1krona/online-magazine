<?php
$mysql_server =  "" ;
$mysql_user = "";
$mysql_password = "";
$mysql_database = "";
 
$conn = mysql_connect($mysql_server, $mysql_user, $mysql_password);
mysql_select_db($mysql_database, $conn);
 
function db_escape ($post)
{
   if (is_string($post)) {
     if (get_magic_quotes_gpc()) {
        $post = stripslashes($post);
     }
     return mysql_real_escape_string($post);
   }
   
   foreach ($post as $key => $val) {
      $post[$key] = db_escape($val);
   }
   
   return $post;
}
// Hämtar iställninganra från databasen
$sql = "SELECT * FROM settings";
$result = mysql_query($sql);
$rad=mysql_fetch_array($result);
$antal_ny = $rad["antal_ny"];
$antal_kom = $rad["antal_kom"];
$title = $rad["title"];

// Sätter lite variablara som används på de flesta sidor
$datum = date("Y-m-d H:i:s");
?>