<?php
include "header.php";
echo '<div id="checkup_content"><h1>Nekade artiklar</h1><br>';

$sql_denied_posts = "SELECT * FROM posts WHERE post_conf = ". 2 ."";
$res_denied_posts = mysql_query($sql_denied_posts) or die (mysql_error());

if(mysql_num_rows($res_denied_posts) > 0){
	while($row = mysql_fetch_assoc($res_denied_posts)){
		 echo "
			<div id='checkup_posts_div'>
			<div id='checkup_post_title'><h1>" . $row['post_title'] . "</h1></div><br>
			<div id='checkup_post_content'><p>" . $row['post_content'] ."</p></div>
			<a href='' id='checkup_post_comment'>Kommentera</a><p id='checkup_post_time'>". $row['post_time'] ."</p>";
			
			
			if(isset($_SESSION['uid']) && $_SESSION['user_level'] == 1){
				
				
				echo "<a href='admin_mod/admin_conf.php?pid_denied=".$row['post_id']."'>Ändra som admin</a>";
			
			}
			
			echo "</div>";
		
		
	
	}
}
else{
	echo 'Det finns inga nekade artiklar artiklar';
}
echo '<a href="checkup_unconf.php">Ogranskade artiklar</a></div>';
include "footer.php";