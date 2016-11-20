<?php
include "admin_header.php";

echo '<div id="admin_conf">';



if(isset($_GET['pid_unconf'])){

	$pid_unconf = htmlentities($_GET['pid_unconf']);

	$sql_unconfirmed_posts = "SELECT * FROM posts WHERE post_conf=". 0 ." AND post_id = '$pid_unconf' LIMIT 1";
	$res_unconfirmed_posts = mysql_query($sql_unconfirmed_posts) or die (mysql_error());

	if(isset($_SESSION['uid']) && $_SESSION['user_level'] == 1){
		
		if(mysql_num_rows($res_unconfirmed_posts) > 0){
			
			while($row = mysql_fetch_assoc($res_unconfirmed_posts)){
			 
			 echo "
			 
				<div id='checkup_posts_div'><h1>Artikel</h1><form method='get' action='admin_update_parse.php'>
				
				<input type='hidden' name='unconf_post_id' value=".$row['post_id']." />
				<input type='hidden' name='unconf_post_creator' value=".$row['post_creator']." />
		
				
				<div id='checkup_post_title'><h1>Rubrik:<textarea name='unconf_post_title'>" .$row['post_title'] . "</textarea></h1></div>
				
				<div id='checkup_post_desc'><b>Kort inledning 510 tecken:</b><textarea name='unconf_post_desc'>" .$row['post_desc']. "</textarea></div>
				
				<div id='checkup_post_content'><p>Innehåll 5000 tecken:</p><textarea name='unconf_post_content' class='mceEditor'>" . $row['post_content'] . "</textarea></div>
				
				<b>Post rank:</b><input type='text' name='unconf_post_rank' value=".$row['post_rank']."><br>
				
				<input type='hidden' name='unconf_post_id' value=".$row['post_id']." /><br />
				
				<input type='submit' name='send_unconf_to_conf' value='Acceptera artikel'><input type='submit' name='send_unconf_to_denied' value='Neka artikel'>
				
				</form></div>";
		
				}
				
		}
		else{
			echo 'finns inge';
		}
	}
}
elseif(isset($_GET['pid_confed'])){
	
	$pid_confed = htmlentities($_GET['pid_confed']);
	
	
	if(isset($_SESSION['uid']) && $_SESSION['user_level'] == 1){
		
		
		
		$sql_posts = "SELECT * FROM posts WHERE post_conf=". 1 ." AND post_id = '$pid_confed' LIMIT 1"; // SELECT ((SUBSTRING(post_content, 1, 255) AS inledning), post_title, post_time, post_rank)
		$res_posts = mysql_query($sql_posts) or die (mysql_error());
		
		if(mysql_num_rows($res_posts) == 1){
				
				$row = mysql_fetch_assoc($res_posts);
		
			$post_id = $row['post_id'];
			$post_title = $row['post_title'];
			$title_link = "<a href='view_post.php?pid=". $post_id ."'>". $post_title . "</a>";
			$post_content = truncate($row['post_content'], 400);
			$content_link = "<a href='view_post.php?pid=". $post_id ."'>". $post_content . "</a>";
			$post_time = $row['post_time'];
			$post_rank = $row['post_rank'];
			$post_desc = truncate($row['post_desc'], 100);
			$desc_link = "<a href='view_post.php?pid=". $post_id . "'>" . $post_desc . "</a>";
	

						
				
			echo "<div class='artikel'>
					
					<form method='GET' action='admin_update_parse.php'>
						
						<div class='artikel_rubrik'>
							<h1>Title:</h1>
							<textarea name='update_title'>" . $post_title . "</textarea>
						</div>
						<div class='artikel_innehall'>
							<p>Innehåll:</p>
							<textarea name='update_content' class='mceEditor'>" . $post_content . "</textarea>
						</div>
						<p class='artikel_tid'>". $post_time ."</p>
						<p>post ID:".$post_id."</p><input type='hidden' name='post_id_update' value=".$post_id." /><br>
						<p>Post rank:</p><input type='text' name='update_rank' value=".$post_rank." />
						<input type='submit' name='send_update_confed' value='Uppdatera artikel' />
					
					</form>
				</div><br>";
				}
				
	}
}
elseif(isset($_GET['pid_denied'])){
	
	$pid_denied = htmlentities($_GET['pid_denied']);
	
	$sql_denied_posts = "SELECT * FROM posts WHERE post_conf=". 2 ." AND post_id = '$pid_denied' LIMIT 1";
	$res_denied_posts = mysql_query($sql_denied_posts) or die (mysql_error());
	
	if(isset($_SESSION['uid']) && $_SESSION['user_level'] == 1){
	if(mysql_num_rows($res_denied_posts) > 0){
		while($row = mysql_fetch_assoc($res_denied_posts)){
		 echo "
		 
			<div id='checkup_posts_div'><h1>Artikel</h1><form method='GET' action=''>
			
			<input type='hidden' name='denied_post_id' value=".$row['post_id']." />
			<input type='hidden' name='denied_post_creator' value=".$row['post_creator']." />
	
			
			<div id='checkup_post_title'><h1>Rubrik:<textarea name='denied_post_title'>" .$row['post_title'] . "</textarea></h1></div>
			
			<div id='checkup_post_desc'><b>Kort inledning 510 tecken:</b><textarea name='denied_post_desc'>" .$row['post_desc']. "</textarea></div>
			
			<div id='checkup_post_content'><p>Innehåll 5000 tecken:</p><textarea name='denied_post_content' class='mceEditor'>" . $row['post_content'] ."</textarea></div>
			
			<b>Post rank:</b><input type='text' name='denied_post_rank' value=".$row['post_rank']."><br>
			
			<p>post ID:".$row['post_id']."</p><br>
			
			<input type='submit' name='send_denied_to_conf' value='Acceptera artikel'><input type='submit' name='send_denied_to_unconf' value='Granska artikel'>
			
			</form></div>";
	
			}
	}
	else{
		echo 'finns int';
	}
}
else {
	echo "greger";
}
	
}

echo '</div>';
?>