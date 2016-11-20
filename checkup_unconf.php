<?php
include "header.php";

echo '<div id="checkup_content"><h1>Ogranskade artiklar</h1>';

$sql_unconfirmed_posts = "SELECT * FROM posts WHERE post_conf = ". 0 ." ORDER BY post_time DESC";
$res_unconfirmed_posts = mysql_query($sql_unconfirmed_posts) or die (mysql_error());

if(mysql_num_rows($res_unconfirmed_posts) > 0){
	while($row = mysql_fetch_assoc($res_unconfirmed_posts)){
		
		$title = stripslashes(nl2br($row['post_title']));
		$content = stripslashes(nl2br($row['post_content']));
		$time = $row['post_time'];
		
			echo "
			<div id='checkup_posts_div'>
			<div id='checkup_post_title'><h1>" . $title . "</h1></div><br />
			<div id='checkup_post_content'>" . $content ."</div><br />
			<a href='' id='checkup_post_comment'>Kommentera</a><p id='checkup_post_time'>". $time ."</p>";
			
			
			if(isset($_SESSION['uid']) && $_SESSION['user_level'] == 1){
				
				
				echo "<a href='admin_mod/admin_conf.php?pid_unconf=".$row['post_id']."'>Ändra som admin</a>";
			
			}
			echo "</div>";
	}
}
else {
	echo 'Det finns inga ogranskade artiklar';
}
echo '<a href="checkup_denied.php">Nekade artiklar</a></div>';
include "footer.php";