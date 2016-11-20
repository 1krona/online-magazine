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