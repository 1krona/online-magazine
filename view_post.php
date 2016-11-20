<?php 

include "header.php";



echo 

'<div id="main_content">

	<div class="side_div">

		<div class="side_menu">
			
			<form method="get" action="search_parse.php">
			<fieldset>
			<input type="text" name="search_value" value="Sök"/>
			<input type="submit" name="send_search" value="Gå" />
			</fieldset>
			</form>
			<ul>
			<li><a href="inrikes.php">Inrikes</a></li>
			<li><a href="utrikes.php">Utrikes</a></li>
			<li><a href="noje.php">Nöje</a></li>
			<li><a href="sport.php">Sport</a></li>
			</ul>
		</div>
		
		<div id="likebox">
		<fb:like-box href="http://www.facebook.com/pages/Folkets-Tidning/253131694762338" width="120" height="328" show_faces="true" stream="false" header="true"></fb:like-box>
		</div>
	</div>';

echo 
	'<div id="middle_div">

		<div id="banner_640"></div>';
echo '<div id="view_post">';
$pid = htmlentities($_GET['pid']);

 // ID-nr
	$ip_count_post = $_SERVER['REMOTE_ADDR'];

	mysql_query("INSERT INTO online (time, ip, track) VALUES
	(NOW(),'$ip_count_post', '$pid')") or die (mysql_error());

	mysql_query("DELETE FROM online WHERE time < ADDDATE(NOW(), INTERVAL - 10 MINUTE) AND track = '$pid'");
	
	//


$sql = "SELECT * FROM posts WHERE post_id = '$pid' LIMIT 1";
$res = mysql_query($sql) or die(mysql_error());

// Hämtar bild
		// Visar artikel
if(mysql_num_rows($res) == 1){
		
		
		$sql_pic = "SELECT upload_dir_606 FROM upload where upload_to_post_id=$pid";
		$res_pic = MYSQL_QUERY($sql_pic) or die(mysql_error()); 
		
		$row = mysql_fetch_assoc($res);
			echo "
			<div id='view_post_title'><h1>" .$row['post_title'] . "</h1></div>";
			
			if(mysql_num_rows($res_pic) == 1){
				$row_pic = mysql_fetch_assoc($res_pic);
				$pic = "<img src='".$row_pic['upload_dir_606']."' height='390' width='606' />";
			
				echo $pic;
			
			}
			
			echo "
			<div id='view_post_content'>
				<p>" . $row['post_content'] ."</p>
			</div>
			<p id='view_post_time'>". $row['post_time'] ."</p>
			
			<div id='post_post_comment'>
				<form method='POST' action=''>";
					
				if(!isset($_SESSION['username'])){
				
				echo	"<input type='text' name='comment_by' value='Namn här' />";
				
				}
						
			echo		"<textarea class='mceNoEditor' name='post_comment'></textarea>
						<input type='submit' name='send_comment' value='Kommentera' />
					
				</form>
			</div>";
			
			$new_views = $row['post_views'] + 1;
			$sql2 = "UPDATE posts SET post_views='$new_views' WHERE post_id='$pid' LIMIT 1";
			mysql_query($sql2) or die(mysql_error());
			
			if(isset($_POST['send_comment'])){ // Ordna isset för gäst, begränsa tidrum mellan kommentarerna och göra så att inte bara de 10 första visas
				
				$post_comment_time = date('Y-m-d H:i:s');
				$post_comment = mysql_real_escape_string(htmlspecialchars($_POST['post_comment']));
				
				
				if(!isset($_SESSION['username'])){
					$username_comment = mysql_real_escape_string(htmlspecialchars($_POST['comment_by']));
				}
				else{
					$username_comment = $_SESSION['username'];
				}
				
				$sql_comment = "INSERT INTO comments(comment_content, comment_by, comment_time, comment_on_post_id, comment_ip)
				VALUES('$post_comment', '$username_comment', '$post_comment_time', '$pid', '".$_SERVER['REMOTE_ADDR']."')";
				
				mysql_query($sql_comment) or die(mysql_error());
			}
				$sql_get_comments = "SELECT * FROM comments WHERE comment_on_post_id='$pid' ORDER BY comment_time DESC LIMIT 10";
				$res_get_comments = mysql_query($sql_get_comments) or die(mysql_error());
				
				if(mysql_num_rows($res_get_comments) > 0){
					while($row_comments = mysql_fetch_assoc($res_get_comments)){
						echo "
						<div id='view_post_comments'>
							<p>".$row_comments['comment_content']."</p>
							<p>".$row_comments['comment_by']. "" . $row_comments['comment_time'] ."
						</div>";
					
					}
				}
				
				// FIXA PARSE ISTÄLLET
				
			
			echo '<div style="float: right; clear: both; padding: 3px;"><a href="comments.php">Alla kommentarer</a>' .$row['post_views'] . "</div>";
		
}
echo '</div>';

if(!isset($_GET['p'])){

	$_GET['p'] = 0;
}
		 
		
$per_page = 5;
$sql_pg = "SELECT * FROM posts WHERE post_conf = ". 1 ." AND post_rank BETWEEN '5' AND '105'";
		
$sql_posts = "SELECT * FROM posts WHERE post_conf = ". 1 ." AND post_rank BETWEEN '5' AND '105' ORDER BY post_rank LIMIT ".$_GET['p'].",". $per_page; // SELECT ((SUBSTRING(post_content, 1, 255) AS inledning), post_title, post_time, post_rank)
$res_posts = mysql_query($sql_posts) or die (mysql_error());

$rows = mysql_num_rows ( mysql_query($sql_pg) );
$pages = ceil( $rows / $per_page );



if(mysql_num_rows($res_posts) > 0){
	while ($row = mysql_fetch_assoc($res_posts)){
		
		$post_id = $row['post_id'];
		$post_title = $row['post_title'];
		$title_link = "<a href='view_post.php?pid=". $post_id ."'>". $post_title . "</a>";
		$post_content = truncate($row['post_content'], 400);
		$content_link = "<a href='view_post.php?pid=". $post_id ."'>". $post_content . "</a>";
		$post_time = $row['post_time'];
		$post_rank = $row['post_rank'];
		$post_desc = truncate($row['post_desc'], 100);
		$desc_link = "<a href='view_post.php?pid=". $post_id . "'>" . $post_desc . "</a>";
		
			
			
						$sql_pic = "SELECT upload_dir_606, upload_dir_240 FROM upload where upload_to_post_id=$post_id";
						$res_pic = MYSQL_QUERY($sql_pic) or die(mysql_error()); 
							
			
				if($post_rank % 5 == 0){
				
				echo 
				
				"<div class='artikel'>
				<div class='artikel_rubrik'><h1>" . $title_link . "</h1></div>";
				
				if(mysql_num_rows($res_pic) == 1){
								
								$row_pic = mysql_fetch_assoc($res_pic);
								
								$pic_606 = "<img src='".$row_pic['upload_dir_606']."' height='390' width='606' />";
								$pic_240 = "<img src='".$row_pic['upload_dir_240']."' height='160' width='240' />";
				
						echo 	"<div class='artikel_bild'>" .$pic_606. "</div>";
				
				}
				
			
				
				echo "<div class='artikel_innehall'><p>" . $content_link . "</p></div>
					<p class='artikel_tid'>". $post_time ."</p>";
				
					if(isset($_SESSION['uid']) && $_SESSION['user_level'] == 1){
				
						echo "
							<form method='get' action='admin_mod/admin_update_parse.php'>
							<fieldset>
							<input type='text' name='update_post_rank' value=".$post_rank." />
							<input type='submit' name='send_update_confed_rank' value='uppdatera' />
							<input type='hidden' name='hidden_update_rank' value=".$post_id." />
							</fieldset>
							</form><br /><a href='admin_mod/admin_conf.php?pid_confed=".$row['post_id']."'>Ändra som admin</a>";
							
						
						
					
					}
				
				echo "</div>";
				}
				elseif($post_rank % 5 == 1){
					
					echo 
					"<div class='artikel2'>
						<div class='artikel_rubrik2'><p>" . $title_link . "</p></div>
						<div class='artikel_beskrivning2'><p>". $desc_link ."</p></div>
						<p class='artikel_tid2'>". $post_time ."</p>";
				
					if(isset($_SESSION['uid']) && $_SESSION['user_level'] == 1){
				
						echo "
							<form method='get' action='admin_mod/admin_update_parse.php'>
							<fieldset>
							<input type='text' name='update_post_rank' value=".$post_rank." />
							<input type='submit' name='send_update_confed_rank' value='uppdatera' />
							<input type='hidden' name='hidden_update_rank' value=".$post_id." />
							</fieldset>
							</form><br /><a href='admin_mod/admin_conf.php?pid_confed=".$row['post_id']."'>Ändra som admin</a>";
							
						
						
					
					}
				
					echo "</div>";
				}
				elseif($post_rank % 5 == 2){
				
				echo 
				"<div class='artikel3'>
					<div class='artikel_rubrik3'><p>" . $title_link . "</p></div>
					<div class='artikel_beskrivning3'><p>". $desc_link ."</p></div>
					<p class='artikel_tid3'>". $post_time ."</p>";
				
					if(isset($_SESSION['uid']) && $_SESSION['user_level'] == 1){
				
						echo "
							<form method='get' action='admin_mod/admin_update_parse.php'>
							<fieldset>
							<input type='text' name='update_post_rank' value=".$post_rank." />
							<input type='submit' name='send_update_confed_rank' value='uppdatera' />
							<input type='hidden' name='hidden_update_rank' value=".$post_id." />
							</fieldset>
							</form><br /><a href='admin_mod/admin_conf.php?pid_confed=".$row['post_id']."'>Ändra som admin</a>";
							
						
						
					
					}
				
				echo "</div>";
				}
				elseif($post_rank % 5 == 3){
				
				echo 
				"<div class='artikel4'>
					<div class='artikel_rubrik4'><h3>" . $title_link . "</h3></div>";
					
				if(mysql_num_rows($res_pic) == 1){
								
								$row_pic = mysql_fetch_assoc($res_pic);
								
								$pic_606 = "<img src='".$row_pic['upload_dir_606']."' height='390' width='606' />";
								$pic_240 = "<img src='".$row_pic['upload_dir_240']."' height='160' width='240' />";
				
						echo "<div class='artikel_bild4'>" .$pic_240. "</div>";
				
				}
					
					
					
				echo	"<div class='artikel_innehall4'><p>" . $content_link . "</p></div>
					<p class='artikel_tid4'>". $post_time ."</p>";
				
					if(isset($_SESSION['uid']) && $_SESSION['user_level'] == 1){
				
						echo "
							<form method='get' action='admin_mod/admin_update_parse.php'>
							<fieldset>
							<input type='text' name='update_post_rank' value=".$post_rank." />
							<input type='submit' name='send_update_confed_rank' value='uppdatera' />
							<input type='hidden' name='hidden_update_rank' value=".$post_id." />
							</fieldset>
							</form><br /><a href='admin_mod/admin_conf.php?pid_confed=".$row['post_id']."'>Ändra som admin</a>";
							
						
						
					
					}
				
				echo "</div>";
				}
				elseif($post_rank % 5 == 4){
				
				echo 
				"<div class='artikel5'>";
					
					
					if(mysql_num_rows($res_pic) == 1){
								
								$row_pic = mysql_fetch_assoc($res_pic);
								
								$pic_606 = "<img src='".$row_pic['upload_dir_606']."' height='390' width='606' />";
								$pic_240 = "<img src='".$row_pic['upload_dir_240']."' height='160' width='240' />";
				
						echo "<div class='artikel_bild5'>" .$pic_240. "</div>";
				
					}
					
				echo	
					"<div class='artikel_rubrik5'><h1>" . $title_link . "</h1></div>
					<div class='artikel_beskrivning5'><p>". $desc_link ."</p></div>
					<p class='artikel_tid5'>". $post_time ."</p>";
				
					if(isset($_SESSION['uid']) && $_SESSION['user_level'] == 1){
				
						echo "
							<form method='get' action='admin_mod/admin_update_parse.php'>
							<fieldset>
							<input type='text' name='update_post_rank' value=".$post_rank." />
							<input type='submit' name='send_update_confed_rank' value='uppdatera' />
							<input type='hidden' name='hidden_update_rank' value=".$post_id." />
							</fieldset>
							</form><br /><a href='admin_mod/admin_conf.php?pid_confed=".$row['post_id']."'>Ändra som admin</a>";
							
						
						
					
					}
				
				echo "</div>";
				}
			
			//elseif($post_rank == $post_rank >= 1 && $post_rank == $post_rank =< 3){}
			
	}
}
else{
	echo "Det finns inga artiklar just nu";
}
for( $i = 0; $i < $pages; $i++ ){
		 
			echo ' <a href="index.php?p=' .( $i * $per_page ) . '">'. ( $i + 1 ) .'</a> ';
		 
}
echo 
	'
	</div>
	<div id="side_menu_right">
		<div id="allow">
			<p>Tillåt chockrubriker och dylikt:</p>
		</div>
		<div class="banner_250">
		</div>
		<div class="banner_250">
		</div>
		<div class="banner_250">
		</div>
	</div>
</div>';
	
include "footer.php";
?>