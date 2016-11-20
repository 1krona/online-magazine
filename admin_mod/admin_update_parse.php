<?php
	session_start();
	$connect = mysql_connect('localhost', 'root', '');

	mb_language('uni');
	mb_internal_encoding('UTF-8');
	$db = mysql_select_db('test',$connect);
	mysql_select_db($db);

if(isset($_GET['send_update_confed_rank'])){

					$size = count($_GET['update_post_rank']);
					
					$i = 0;
					while ($i < $size) {
										$update_id = $_GET['hidden_update_rank_id'][$i];
										$update_rank = mysql_real_escape_string($_GET['update_post_rank'][$i]);	

										$sql_update = "UPDATE posts SET post_rank = '$update_rank' WHERE post_id = '$update_id' LIMIT 1";
										mysql_query($sql_update) or die (mysql_error());
																
										
					++$i;
					}							
					header ("Location:../index.php");
}
elseif(isset($_GET['send_update_confed'])){
	
					$update_title = mysql_real_escape_string(htmlspecialchars($_GET['update_title']));
					$update_content = mysql_real_escape_string($_GET['update_content']);
					$update_rank = mysql_real_escape_string(htmlspecialchars($_GET['update_rank']));
								
					$sql_update = "UPDATE posts SET post_title='$update_title', post_content='$update_content', post_rank='$update_rank' WHERE post_id = '".$_GET['post_id_update']."'";
					mysql_query($sql_update) or die(mysql_error());
					
					header ("Location:../index.php");
}
elseif(isset($_GET['send_unconf_to_conf'])){
					
					$sql_unconf_to_conf = "UPDATE posts SET post_title='".$_GET['unconf_post_title']."', post_desc='".$_GET['unconf_post_desc']."', 
					post_content='".$_GET['unconf_post_content']."', post_rank='".$_GET['unconf_post_rank']."', post_conf=". 1 ." 
					WHERE
						post_id='".$_GET['unconf_post_id']."'
					";
					
					mysql_query($sql_unconf_to_conf) or die (mysql_error());
					
					header ("Location:../checkup_unconf.php");
}
elseif(isset($_GET['send_unconf_to_denied'])){
					
					
					$sql_unconf_to_conf = "UPDATE posts SET post_title='".$_GET['unconf_post_title']."', post_desc='".$_GET['unconf_post_desc']."', 
					post_content='".$_GET['unconf_post_content']."', post_rank='".$_GET['unconf_post_rank']."', post_conf=". 2 ." 
					WHERE
						post_id='".$_GET['unconf_post_id']."'
					";
					
					
					mysql_query($sql_unconf_to_conf) or die (mysql_error());
					
					header ("Location:../checkup_denied.php");
}
elseif(isset($_GET['send_denied_to_conf'])){
				
					$sql_denied_to_conf = 
					"UPDATE posts SET post_title = '".$_GET['denied_post_title']."', post_desc = '".$_GET['denied_post_desc']."', post_content = '".$_GET['denied_post_content']."', 
					post_rank = '".$_GET['denied_post_rank']."', post_conf = ". 1 ."
					WHERE post_id = '".$_GET['denied_post_id']."' 
					";
					
					mysql_query($sql_denied_to_conf) or die (mysql_error());
					
					header ("Location:../index.php");
}
elseif(isset($_GET['send_denied_to_unconf'])){ // Byter ut till unconf i submit och insert into unconfirmed_posts
					
					$sql_denied_to_unconf = "UPDATE posts SET post_title = '".$_GET['denied_post_title']."', post_desc = '".$_GET['denied_post_desc']."', 
					post_content = '".$_GET['denied_post_content']."', post_rank = '".$_GET['denied_post_rank']."', post_conf = ". 0 ."
					WHERE post_id = '".$_GET['denied_post_id']."' 
					";
					
					mysql_query($sql_denied_to_unconf) or die (mysql_error());
					
					header ("Location:../checkup_unconf.php");
}
else{
	echo "Nu gick det fel";
}
?>
