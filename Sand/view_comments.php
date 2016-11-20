<?php
include "header.php";
echo "<div id=view_comments>";

$pid_comments = htmlentities($_GET['pid']);

 // ID-nr
	$ip_count_post = $_SERVER['REMOTE_ADDR'];

	mysql_query("INSERT INTO online (time, ip, track) VALUES
	(NOW(),'$ip_count_post', '$pid_comments')") or die (mysql_error());

	mysql_query("DELETE FROM online WHERE time < ADDDATE(NOW(), INTERVAL - 10 MINUTE) AND track = '$pid_comments'");

$sql_comments=
"SELECT
    p.post_title, p.post_views, p.post_id, p.post_content, p.post_time,
    COUNT(c.comment_id) post_comment_count
FROM
    posts p
JOIN
    comments c ON (c.comment_on_post_id = p.post_id)
WHERE 
	p.post_id = '".$pid_comments."' LIMIT 1"
;

$res_comments = mysql_query($sql_comments) or die (mysql_error());

if(mysql_num_rows($res_comments) == 1){
		
		$row = mysql_fetch_assoc($res_comments);
		
		$sql_pic = "SELECT upload_dir_606 FROM upload where upload_to_post_id=$pid_comments";
		$res_pic = MYSQL_QUERY($sql_pic) or die(mysql_error()); 
	
		echo"<div class='view_comments_artikel'><div class='view_comments_title'><h1>" .$row['post_title'] . "</h1></div><br>";
			
			if(mysql_num_rows($res_pic) == 1){
				$row_pic = mysql_fetch_assoc($res_pic);
				$pic = "<img src='".$row_pic['upload_dir_606']."' height='336' width='476' />";
			
				echo $pic;
			
			}
			
			// BYTA ID PÃ¥ ALLA DIVAR
			
			echo "
			<div class='view_comments_content'>
				<p>" . nl2br($row['post_content']) ."</p>
			</div>
			<p class='view_comments_time'>". $row['post_time'] ."</p>
			<div class='post_comments_comment'>
				<form method='POST' action=''>";
					
				if(!isset($_SESSION['username'])){
				
				echo	"<input type='text' name='comment_by' value='GÃ¤st' />";
				
				}
					
			echo	"<textarea name='post_comment'></textarea>
					<input type='submit' name='send_comment' value='Kommentera' />
				</form>
			</div>";
			
			$new_views = $row['post_views'] + 1;
			$sql2 = "UPDATE posts SET post_views='$new_views' WHERE post_id='$pid_comments' LIMIT 1";
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
				VALUES('$post_comment', '$username_comment', '$post_comment_time', '$pid_comments', '".$_SERVER['REMOTE_ADDR']."')";
				
				mysql_query($sql_comment) or die(mysql_error());
			}
				
				
				
				
				if( !isset ( $_GET['pg_c'] ) ) {$_GET['pg_c'] = 1;}
				
				 
				 
				 // Pagingvariablar
					$sida = intval($_GET['pg_c']); 
					$forr = ($sida - 1);
					$nest = ($sida + 1);
					$lim = ($sida * $antal_kom);
					$slut = ($antal_kom + 1);
				 
				 
					$sql_get_comments = "SELECT * FROM comments WHERE comment_on_post_id='$pid_comments' ORDER BY comment_time DESC LIMIT $lim, $slut ";
					$res_get_comments = mysql_query($sql_get_comments) or die(mysql_error());
					
					for ($i = 0; $i < $antal_kom && $rad=mysql_fetch_array($res_get_comments); $i++) { 
							echo '<div id="news">hejk';
								/*	<div id="forfattarkom"><h2>'.nl2br(htmlentities($rad['namn'])).'</h2></div>
									<div id="datumkom">'.nl2br(htmlentities($rad['datum'])).'</div>
									<div id="kom">'.nl2br(htmlentities($rad['text'])).'</div>';
										if (isset($_SESSION['sess_user'])){
											echo '<a href="viewer.php?id='.$_GET['id'].'&radera='.$rad['id'].'"><img src="images/radera.png" align="right" alt="Radera kommentaren" border="0" /></a> ';
											echo '<a href="viewer.php?id='.$_GET['id'].'&bannlys='.$rad['ip'].'"><img src="images/ban.png" align="right" alt="Bannlys användaren" border="0" /></a>'.$rad['ip'];
									*/
					}
									echo '</div>';
						
						
					if(mysql_num_rows($result) > $antal_kom){
						echo '<a class="rightalign" href="view_comments.php?id='.$_GET['id'].'&pg_c='.$nest.'">Nästa sida</a>';
					}

					if(!$sida == 0){
						echo '<a class="leftalign" href="view_comments?id='.$_GET['id'].'&pg_c='.$forr.'">Föregående sida</a><br>';
					}

					if(mysql_num_rows($result)==0){	
						echo 	'<div id="news">Det finns inga kommentarer än.</div>';
					}

				 
				 
				
			}	
}
				
echo '</div>
	<div id="right_list">
	<table>
		<th>Flest kommentarer</th>
		<th>Kommentarer</th>
		<th>Visningar</th>';

	$time_minus = strtotime("-1 weeks"); 

	$time_week =	date("Y-m-d H:i:s", $time_minus);
	$time_now = date("Y-m-d H:i:s");
		
$sql_weekly = "SELECT
    p.post_title, p.post_views, p.post_id, 
    COUNT(c.comment_id) post_comment_count
FROM
    posts p
JOIN
    comments c ON (c.comment_on_post_id = p.post_id)
WHERE 
	p.post_conf = 1 
AND
	c.comment_time BETWEEN '".$time_week."'  AND '".$time_now."' 
GROUP BY
    p.post_id
ORDER BY
    post_comment_count DESC LIMIT 5"
;
	
$res_weekly = mysql_query($sql_weekly) or die(mysql_error());

if(mysql_num_rows($res_weekly) > 0){
	while($row_weekly = mysql_fetch_assoc($res_weekly)){
		
		$title_weekly = "<a href='view_comments.php?pid=". $row_weekly['post_id'] ."'>". $row_weekly['post_title'] . "</a>";
		$comment_count_weekly = "<a href='view_comments.php?pid=". $row_weekly['post_id'] ."'>". $row_weekly['post_comment_count'] . "</a>";
		$views_weekly = "<a href='view_comments.php?pid=". $row_weekly['post_id'] ."'>". $row_weekly['post_views'] . "</a>";
		
		echo '
		
		<tr>
		<td> ' . $title_weekly . ' </td>
		<td> '. $comment_count_weekly . ' </td>
		<td> '. $views_weekly . '</td>
		</tr>
		';
	}
}
echo '</table><table>
		<th>Flest läsare just nu</th>
		<th>Läsare</th>
		<th>Visningar</th>';


		
$sql_list_viewers = 
			"SELECT
				p.post_title, p.post_id, p.post_views,
				COUNT(DISTINCT o.ip) AS count_ip
			FROM
				posts p
			JOIN
				online o ON (o.track = p.post_id)
			WHERE 
				p.post_conf = 1  
			GROUP BY
				p.post_id
			ORDER BY
				count_ip DESC LIMIT 25"
			; 
	
$res_viewers = mysql_query($sql_list_viewers) or die(mysql_error());

if(mysql_num_rows($res_viewers) > 0){
	while($row_viewers = mysql_fetch_assoc($res_viewers)){
		
		$title_viewers = "<a href='view_comments.php?pid=". $row_viewers['post_id'] ."'>". $row_viewers['post_title'] . "</a>";
		$count_viewers_ip = "<a href='view_comments.php?pid=". $row_viewers['post_id'] ."'>". $row_viewers['count_ip'] . "</a>";
		$views_viewers = "<a href='view_comments.php?pid=". $row_viewers['post_id'] ."'>". $row_viewers['post_views'] . "</a>";
		
		echo '
		
		<tr>
		<td> ' . $title_viewers . ' </td>
		<td> '. $count_viewers_ip . ' </td>
		<td> '. $views_viewers . '</td>
		</tr>
		';
	}
}


echo "</table></div></div>";

include "footer.php";
?>